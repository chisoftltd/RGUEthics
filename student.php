<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// it will never let you open index(login) page if session is set
if (isset($_SESSION['user']) != "") {
    header("Location: login.php");
    exit;
}

$error = false;
$firstName = $lastName = $number = $program = $status = $supervisor = "";
$startDate = $endDate = $healthyes0 = $childrenyes1 = $sensitiveyes2 = "";
$aerodefenceyes3 = $nuclearyes4 = $projectDetails = $participants = $dataDetails = "";
$sharing = $consent = $datastorage = $anonymity = $intlTrfyes5 = $noneu = "";
$notfyes6 = $email = $project = "";

$firstNameError = $lastNameError = $numberError = $programError = $statusError = $supervisorError = "";
$startDateError = $endDateError = $healthyes0Error = $childrenyes1Error = $sensitiveyes2Error = "";
$aerodefenceyes3Error = $nuclearyes4Error = $projectDetailsError = $participantsError = $dataDetailsError = "";
$sharingError = $consentError = $datastorageError = $anonymityError = $intlTrfyes5Error = $noneuError = "";
$notfyes6Error = $emailError = "";


if (isset($_POST['btn-register'])) {
    
    // prevent sql injections / clear user invalid inputs
    if (empty($_POST["firstName"])) {
        $error = true;
        $firstNameError = "Please enter your First Name.";
    } else {
        $firstName = test_input($_POST["firstName"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
            $firstNameError = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["lastName"])) {
        $error = true;
        $lastNameError = "Please enter your last Name.";
    } else {
        $lastName = test_input($_POST["lastName"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
            $lastNameError = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["number"])) {
        $error = true;
        $numberError = "Please enter your last Name.";
    } else {
        $number = test_input($_POST["number"]);
        if (!preg_match("/^[0-9 ]*$/", $number)) {
            $numberError = "Only digits allowed";
        }
    }

    if (empty($_POST["program"])) {
        $error = true;
        $programError = "Please enter your degree programme (eg, BABS; MAHRM, LLB/LLM).";
    } else {
        $program = test_input($_POST["program"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $program)) {
            $programError = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["status"])) {
        $error = true;
        $statusError = "Please enter your Status - Postgraduate or Undergraduate status.";
    } else {
        $status = test_input($_POST["status"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $status)) {
            $statusError = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["supervisor"])) {
        $error = true;
        $supervisorError = "Please enter your project supervisor name.";
    } else {
        $supervisor = test_input($_POST["supervisor"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $supervisor)) {
            $supervisorError = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["project"])) {
        $error = true;
        $projectError = "Please enter your project title.";
    } else {
        $project = test_input($_POST["project"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $project)) {
            $projectError = "Only letters and white space allowed";
        }
    }
    if (empty($startDate)) {
        $error = true;
        $startDateError = "Please enter start date.";
    }

    if (empty($_POST["startDate"])) {
        $error = true;
        $startDateError = "Please enter start date.";
    } else {
        $startDate = test_input($_POST["startDate"]);
        if (!preg_match("/-[0-9]*$/", $startDate)) {
            $startDateError = "Only / - and digits are allowed";
        }
    }

    if (empty($_POST["endDate"])) {
        $error = true;
        $endDateError = "Please enter start date.";
    } else {
        $endDate = test_input($_POST["endDate"]);
        if (!preg_match("/-[0-9]*$/", $endDate)) {
            $endDateError = "Only /  - and digits are allowed";
        }
    }

    if (empty($_POST["healthyes0"])) {
        $error = true;
        $healthyes0Error = "Please select if health sector organisations are invlove.";
    } else {
        $healthyes0 = test_input($_POST["healthyes0"]);
    }

    if (empty($_POST["childrenyes1"])) {
        $error = true;
        $childrenyes1Error = "Please select if children or other vulnerable groups are invlove.";
    } else {
        $childrenyes1 = test_input($_POST["childrenyes1"]);
    }

    if (empty($_POST["sensitiveyes2"])) {
        $error = true;
        $sensitiveyes2Error = "Please select if sensitive topics is invlove.";
    } else {
        $sensitiveyes2 = test_input($_POST["sensitiveyes2"]);
    }

    if (empty($_POST["aerodefenceyes3"])) {
        $error = true;
        $aerodefenceyes3Error = "Please select if aerospace/defence organisations are invlove.";
    } else {
        $aerodefenceyes3 = test_input($_POST["aerodefenceyes3"]);
    }

    if (empty($_POST["nuclearyes4"])) {
        $error = true;
        $nuclearyes4Error = "Please select if nuclear production organisations are invlove.";
    } else {
        $nuclearyes4 = test_input($_POST["nuclearyes4"]);
    }

    if (empty($_POST["projectDetails"])) {
        $error = true;
        $projectDetailsError = "Please select if nuclear production organisations are invlove.";
    } else {
        $projectDetails = test_input($_POST["projectDetails"]);
    }

    if (empty($_POST["participants"])) {
        $error = true;
        $participantsError = "Please list participants.";
    } else {
        $participants = test_input($_POST["participants"]);
    }

    if (empty($_POST["dataDetails"])) {
        $error = true;
        $dataDetailsError = "Please enter data storage.";
    } else {
        $dataDetails = test_input($_POST["dataDetails"]);
    }

    if (empty($_POST["sharing"])) {
        $error = true;
        $sharingError = "Please state the extent of data sharing.";
    } else {
        $sharing = test_input($_POST["sharing"]);
    }

    if (empty($_POST["consent"])) {
        $error = true;
        $consentError = "Please state if you have the consent of participants.";
    } else {
        $consent = test_input($_POST["consent"]);
    }

    if (empty($_POST["datastorage"])) {
        $error = true;
        $datastorageError = "Please state how you intend to store data.";
    } else {
        $datastorage = test_input($_POST["datastorage"]);
    }

    if (empty($_POST["anonymity"])) {
        $error = true;
        $anonymityError = "Please state if participant have anonymity option.";
    } else {
        $anonymity = test_input($_POST["anonymity"]);
    }

    if (empty($_POST["intlTrfyes5"])) {
        $error = true;
        $intlTrfyes5Error = "Please indicate if data wil be transfered oversea.";
    } else {
        $intlTrfyes5 = test_input($_POST["intlTrfyes5"]);
    }

    if (empty($_POST["noneu"])) {
        $error = true;
        $noneuError = "Please state if you have the noneu of participants.";
    } else {
        $noneu = test_input($_POST["noneu"]);
    }

    if (empty($_POST["notfyes6"])) {
        $error = true;
        $notfyes6Error = "Please have you notify your department's Data Protection Coordinator?.";
    } else {
        $notfyes6 = test_input($_POST["notfyes6"]);
    }

    if (empty($_POST["email"])) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $emailError = "Please enter valid email address.";
        }
    }


    $query = ("INSERT INTO users($link, (student_number, student_email,student_program,
    student_status,supervisor,project_title,start_date,end_date,project_description,first_name,last_name,
	health_sector,children,sensitive_topics,aerospace_defence,nuclear_production,
	participants,sharing,consent,data_storage,anonymity,intl_transfer_uk,intl_transfer,notification, dataDetails) 
	VALUES('$number','$email','$program','$status', '$supervisor','$project', '$startDate', '$endDate',
	'$projectDetails','$firstName','$lastName','$healthyes0', '$childrenyes1', '$sensitiveyes2', '$aerodefenceyes3',
	'$nuclearyes4', '$participants', '$sharing', '$consent', '$datastorage', '$anonymity', '$intlTrfyes5', '$notfyes6', '$dataDetails'))");
    $res = mysqli_query($query);

    if ($res) {
        $errTyp = "success";
        $errMSG = "Successfully registered your project ethics ";
        unset($name);
        unset($email);
        unset($pass);
    } else {
        $errTyp = "danger";
        $errMSG = "Something went wrong, try again later...";
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Project Registration System</title>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <link rel="stylesheet" href="css/main-style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="http://formvalidation.io/vendor/formvalidation/js/formValidation.min.js"></script>
        <script src="http://formvalidation.io/vendor/formvalidation/js/framework/bootstrap.min.js"></script>
        <script src="http://formvalidation.io/vendor/jquery.steps/js/jquery.steps.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="http://formvalidation.io/vendor/jquery.steps/css/jquery.steps.css" rel="stylesheet"/>
        <link href="http://formvalidation.io/vendor/formvalidation/css/formValidation.min.css" rel="stylesheet"/>

    <body>
    <div>
        <?php include 'include/header.php'; ?>
    </div>
    <div class="container">

        <div id="login-form">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

                <div class="col-md-13">

                    <div class="form-group">
                        <h3 class="">Register Your Project.</h3>
                    </div>

                    <div class="form-group">
                        <hr/>
                    </div>

                    <?php
                    if (isset($errMSG)) {
                        ?>
                        <div class="form-group">
                            <div class="alert alert-<?php echo ($errTyp == "success") ? "success" : $errTyp; ?>">
                                <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" name="firstName" class="form-control" placeholder="Student First Name"
                                   maxlength="50" value="<?php echo $name ?>"/>
                        </div>
                        <span class="text-danger"><?php echo $nameError; ?></span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" name="lastName" class="form-control" placeholder="Student Last Name"
                                   maxlength="50" value="<?php echo $name ?>"/>
                        </div>
                        <span class="text-danger"><?php echo $nameError; ?></span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="email" name="email" class="form-control" placeholder="Enter Your Email"
                                   maxlength="40" value="<?php echo $email ?>"/>
                        </div>
                        <span class="text-danger"><?php echo $emailError; ?></span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-info-sign"></span></span>
                            <input type="text" name="number" class="form-control" placeholder="Student Number"
                                   maxlength="15"/>
                        </div>
                        <span class="text-danger"><?php echo $passError; ?></span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="text" name="program" class="form-control"
                                   placeholder="Degree Programme (eg, BABS; MAHRM, LLB/LLM)" maxlength="15"/>
                        </div>
                        <span class="text-danger"><?php echo $passError; ?></span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="text" name="status" class="form-control"
                                   placeholder="Research, Postgraduate or Undergraduate status" maxlength="15"/>
                        </div>
                        <span class="text-danger"><?php echo $passError; ?></span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="text" name="supervisor" class="form-control"
                                   placeholder="Name of student supervisor" maxlength="15"/>
                        </div>
                        <span class="text-danger"><?php echo $passError; ?></span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="text" name="project" class="form-control" placeholder="Project Title"
                                   maxlength="15"/>
                        </div>
                        <span class="text-danger"><?php echo $passError; ?></span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="text" name="startDate" class="form-control"
                                   placeholder="Proposed project start date" maxlength="15"/>
                        </div>
                        <span class="text-danger"><?php echo $passError; ?></span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="text" name="endDate" class="form-control"
                                   placeholder="Proposed project end date" maxlength="15"/>
                        </div>
                        <span class="text-danger"><?php echo $passError; ?></span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <p>
                                <strong>Does the research project involve any of the following risk factors:</strong>
                            </p>
                            <ul style="padding-left: 20px">
                                <li>
                                    Research involving health sector organisations:
                                    <input type="radio"
                                           name="healthyes0" <?php if (isset($healthyes0) && $healthyes0 == "yes") echo "checked"; ?>
                                           value="yes"><b>YES</b>
                                    <input type="radio"
                                           name="healthyes0" <?php if (isset($healthyes0) && $healthyes0 == "no") echo "checked"; ?>
                                           value="no"><b>NO</b>
                                    <span class="error">* <?php echo $healthyes0Error; ?></span>
                                </li>
                                <li>
                                    Research involving children or other vulnerable groups:
                                    <input type="radio" name="childrenyes1" <?php if (isset($childrenyes1) && $childrenyes1 == "yes") echo "checked"; ?> value="1"><b>YES</b>
                                    <input type="radio" name="childrenyes1" <?php if (isset($childrenyes1) && $childrenyes1 == "yes") echo "checked"; ?> value="0"><b>NO</b>
                                    <span class="error">* <?php echo $childrenyes1Error; ?></span>
                                </li>
                                <li>
                                    Research involving sensitive topics:
                                    <input type="radio" name="sensitiveyes2" <?php if (isset($sensitiveyes2) && $sensitiveyes2 == "yes") echo "checked"; ?> value="1"><b>YES</b>
                                    <input type="radio" name="sensitiveyes2" <?php if (isset($sensitiveyes2) && $sensitiveyes2 == "yes") echo "checked"; ?> value="0"><b>NO</b>
                                    <span class="error">* <?php echo $sensitiveyes2Error; ?></span>

                                </li>
                                <li>
                                    Research involving aerospace/defence organisations:
                                    <input type="radio" name="aerodefenceyes3" <?php if (isset($aerodefenceyes3) && $aerodefenceyes3 == "yes") echo "checked"; ?> value="1"><b>YES</b>
                                    <input type="radio" name="aerodefenceyes3" <?php if (isset($aerodefenceyes3) && $aerodefenceyes3 == "yes") echo "checked"; ?> value="0"><b>NO</b>
                                    <span class="error">* <?php echo $aerodefenceyes3Error; ?></span>

                                </li>
                                <li>
                                    Research involving nuclear production organisations:
                                    <input type="radio" name="nuclearyes4" <?php if (isset($nuclearyes4) && $nuclearyes4 == "yes") echo "checked"; ?> value="1"><b>YES</b>
                                    <input type="radio" name="nuclearyes4" <?php if (isset($nuclearyes4) && $nuclearyes4 == "yes") echo "checked"; ?> value="0"><b>NO</b>
                                    <span class="error">* <?php echo $nuclearyes4Error; ?></span>

                                </li>
                            </ul>
                        </div>
                    </div>
                    <p>
                        <strong>Details of the Project:</strong>
                    </p>
                    <div class="form-group">
                        <div class="input-group">
                            <textarea class="glyphicon glyphicon-lock" style="text-align: left; min-width: 100%"
                                      name="projectDetails" id="body" rows="20"
                                      placeholder="Provide a brief outline of the aims and objectives of the proposed research project."
                                      maxlength="60"></textarea>
                        </div>
                    </div>
                    <p>
                        <strong>Details of Participants:</strong>
                    </p>
                    <div class="form-group">
                        <div class="input-group">
                            <textarea class="glyphicon glyphicon-lock" style="text-align: left; min-width: 100%"
                                      name="participants" id="body" rows="20"
                                      placeholder="Please provide details of the potential participants for this project, including how they will be selected and recruited."
                                      maxlength="60"></textarea>
                        </div>
                    </div>

                    <p>
                        <strong>Details of the Data being Processed:</strong>
                    </p>

                    <div class="form-group">
                        <div class="input-group">
                            <textarea class="glyphicon glyphicon-lock" style="text-align: left; min-width: 100%"
                                      name="dataDetails" id="body" rows="20"
                                      placeholder="Please describe the details of the personal data that is being collected, including the methods of data collection and analysis."
                                      maxlength="60"></textarea>
                        </div>
                    </div>

                    <p>
                        <strong>Sharing (Disclosure):</strong>
                    </p>
                    <div class="form-group">
                        <div class="input-group">
                            <textarea class="glyphicon glyphicon-lock" style="text-align: left; min-width: 100%"
                                      name="sharing" id="body" rows="20"
                                      placeholder="Please describe how the outcomes of the research will be disseminated (for example provide an explanation as to where, and how, will the results be published, or other mechanisms you will be using to share the potential participants personal data)."
                                      maxlength="60"></textarea>
                        </div>
                    </div>

                    <p>
                        <strong>Consent:</strong>
                    </p>
                    <div class="form-group">
                        <div class="input-group">
                                <textarea class="glyphicon glyphicon-lock" style="text-align: left; min-width: 100%"
                                          name="consent" id="body" rows="20" placeholder="Consent requirements for research projects can vary widely. Whether you are intending to use a consent form, information sheet, or verbally, it is recommended to assure compliance with the Data Protection Act and with ethical requirements. Please include the information sheet and consent forms you will be using for this project, and or protocol. If you are not including an information sheet and consent form, please explain how the consent will be recorded?
                                          " maxlength="60"></textarea>
                        </div>
                    </div>

                    <p>
                        <strong>Data Storage:</strong>
                    </p>
                    <div class="form-group">
                        <div class="input-group">
                            <textarea class="glyphicon glyphicon-lock" style="text-align: left; min-width: 100%"
                                      name="datastorage" id="body" rows="20"
                                      placeholder="Please describe the arrangements you will make for the security of the data, including how and where it will be stored. i.e. UCL network, *encrypted USB stick, *encrypted laptop etc. Describe how you will store your data, who will have access to it, and what happens to the data at the end of the project."
                                      maxlength="60"></textarea>
                        </div>
                    </div>

                    <p>
                        <strong>Anonymity:</strong>
                    </p>
                    <div class="form-group">
                        <div class="input-group">
                            <textarea class="glyphicon glyphicon-lock" style="text-align: left; min-width: 100%"
                                      name="anonymity" id="body" rows="20"
                                      placeholder="Describe how you will maintain the confidentiality of the research data collected. Also, describe how you will ensure that research participants are anonymised in your data analysis."
                                      maxlength="60"></textarea>
                        </div>
                    </div>
                    <p>
                        <strong>International Transfer:</strong>
                    </p>
                    <p>
                        Will identifiable data be transferred outside the UK as part of this study?
                        <input type="radio" name="intlTrfyes5" <?php if (isset($intlTrfyes5) && $intlTrfyes5 == "yes") echo "checked"; ?> value="1"><b>YES</b>
                        <input type="radio" name="intlTrfyes5" <?php if (isset($intlTrfyes5) && $intlTrfyes5 == "yes") echo "checked"; ?> value="0"><b>NO</b>
                        <span class="error">* <?php echo $intlTrfyes5Error; ?></span>
                    </p>
                    <p style="font-style: italic"> The eighth principle of the Data Protection Act 1998 prohibits the
                        transfer of personal data to countries or territories outside the European Economic Area (which
                        consists of the 27 EU member states, Iceland, Liechtenstein and Norway).

                        At the time of writing the following countries have also been deemed adequate for the purposes
                        of the 8th principle Andorra, Argentina, Canada, Faroe Islands, Guernsey, Isle of Man, Israel,
                        Jersey, New Zealand, Switzerland and Uruguay.
                        <br>
                        The Data Protection Officer has produced guidance on the transfer of data overseas and
                        particular to the United States. This is available from the Data Protection webpages.
                        <br>
                    </p>
                    <div class="form-group">
                        <div class="input-group">
                                <textarea class="glyphicon glyphicon-lock" style="text-align: left; min-width: 100%"
                                          name="noneu" id="body" rows="10" placeholder="If you intend to transfer data to a country not mentioned above, please supply details of adequate safeguards below:
                                          " maxlength="60"></textarea>
                        </div>
                    </div>
                    <div>
                        <p>
                            <strong>Notification:</strong>
                        </p>
                        <p style="font-style: italic">(Please note that notification is a prerequisite for
                            registration)</p>
                        <p>Have you informed your department's Data Protection Coordinator about your project?
                            <input type="radio" name="notfyes6" <?php if (isset($notfyes6) && $notfyes6 == "yes") echo "checked"; ?> value="1"><b>YES</b>
                            <input type="radio" name="notfyes6" <?php if (isset($notfyes6) && $notfyes6 == "yes") echo "checked"; ?> value="0"><b>NO</b>
                            <span class="error">* <?php echo $notfyes6Error; ?></span>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6 col-xs-offset-3">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#termsModal">
                                Agree with the terms and conditions
                            </button>
                            <input type="hidden" name="agree" value="no"/>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <hr/>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" name="btn-register">Register</button>
                </div>

                <!-- Terms and conditions modal -->
                <div class="modal fade" id="termsModal" tabindex="-1" role="dialog"
                     aria-labelledby="Terms and conditions" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Terms and conditions</h3>
                            </div>

                            <div class="modal-body">

                                <h2>
                                    Relevant ethics terms and conditions
                                </h2>
                                <p>
                                    We expect that researchers will follow the guidance provided in the framework for
                                    research ethics which sets out what we consider best practice for social science
                                    research. At a minimum, we require that researchers and research organisations
                                    follow the RCUK grant terms and conditions as set out in the research funding guide.
                                    A research organisation takes responsibility for the management of the research
                                    project and the accountability of funds provided. Terms and conditions apply to the
                                    research organisation which by extension includes principal investigators, research
                                    teams, finance officers as well as administrators and any relevant individual acting
                                    on behalf of the research organisation in regards to an ESRC grant.
                                </p>
                                <p>
                                    The RCUK terms and conditions are mandatory and must be followed by all individuals
                                    and organisations involved in ESRC-funded research. The relevant conditions are:
                                </p>
                                <div>
                                    <ul>
                                        <li>
                                            Overall responsibility for ensuring that all ESRC-funded research is subject
                                            to appropriate ethics review and monitoring lies with the research
                                            organisation (RO). By submitting a proposal to ESRC, the RO accepts the
                                            proposal’s ethics information and confirms that it is prepared to administer
                                            any resulting grant on the basis specified in the proposal (and any
                                            additional conditions), and is committed to an appropriate and iterative
                                            ethics review process.
                                        </li>
                                        <li>
                                            Research organisations should have clear, transparent and effective
                                            procedures for ethics review and governance, and appropriate mechanisms for
                                            monitoring the operation of RECs and the decisions they take in relation to
                                            ESRC-funded research.
                                        </li>
                                        <li>
                                            The research organisation should also have in place a clear sanctions policy
                                            against an individual in instances where an allegation of misconduct is
                                            upheld, and must inform the ESRC of sanctions put in place in cases
                                            involving individuals who are receiving ESRC funding (see RCUK Policy and
                                            guidelines on governance of good research conduct (external website)).
                                        </li>
                                        <li>
                                            Ethics review should be carried out before any work requiring ethics review
                                            is undertaken.
                                        </li>
                                        <li>
                                            Interdisciplinary projects which include medical or health research should
                                            follow the Medical Research Council's guidance on the conduct of medical
                                            research (external website).
                                        </li>
                                        <li>
                                            Research organisations should have appropriate processes and systems in
                                            place to ensure that all ESRC-funded research (including studentships) is
                                            conducted in line with the requirements of regulatory and professional
                                            bodies, the guidance provided by this Framework for Research Ethics, the
                                            ESRC Research Funding Guide, the ESRC Postgraduate Funding Guide, and the
                                            RCUK policy and guidelines on the governance of good research conduct
                                            (external website).
                                        </li>
                                    </ul>
                                </div>
                                <p>
                                    We reserve the right to undertake audits of organisational arrangements to ensure
                                    that they are operating to the expectations outlined in this framework. Records of
                                    REC procedures, minutes of meetings, lists of reviewed proposals and research
                                    organisation's monitoring reports should also be made available to ESRC on request.
                                </p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="agreeButton" data-dismiss="modal">
                                    Agree
                                </button>
                                <button type="button" class="btn btn-default" id="disagreeButton" data-dismiss="modal">
                                    Disagree
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <hr/>
                </div>
        </div>

        </form>
    </div>

    </div>
    <div>
        <?php include 'include/footer.php'; ?>

    </div>

    <script>
        $(document).ready(function () {
            $('.container').formValidation({
                framework: 'bootstrap', icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    firstName: {
                        row: '.col-xs-4',
                        validators: {
                            notEmpty: {
                                message: 'The first name is required'
                            }
                        }
                    },
                    lastName: {
                        row: '.col-xs-4',
                        validators: {
                            notEmpty: {
                                message: 'The last name is required'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'The email address is required'
                            },
                            emailAddress: {
                                message: 'The input is not a valid email address'
                            }
                        }
                    },
                    agree: {
                        // The plugin will ignore the hidden field
                        // By setting excluded: false, the field will be validated as usual
                        excluded: false,
                        validators: {
                            callback: {
                                message: 'You must agree with the terms and conditions',
                                callback: function (value, validator, $field) {
                                    return value === 'yes';
                                }
                            }
                        }
                    }
                }
            });

            // Update the value of "agree" input when clicking the Agree/Disagree button
            $('#agreeButton, #disagreeButton').on('click', function () {
                var whichButton = $(this).attr('id');

                $('.container')
                    .find('[name="agree"]')
                    .val(whichButton === 'agreeButton' ? 'yes' : 'no')
                    .end()
                    // Revalidate the field manually
                    .formValidation('revalidateField', 'agree');
            });
        });
    </script>
    </body>
    </html>
<?php ob_end_flush(); ?>