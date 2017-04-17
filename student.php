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

if (isset($_POST['btn-register'])) {

    // prevent sql injections/ clear user invalid inputs
    //First name
    $firstName = trim($_POST['firstName']);
    $firstName = strip_tags($firstName);
    $firstName = htmlspecialchars($firstName);

    //Last Name
    $lastName = trim($_POST['lastName']);
    $lastName = strip_tags($lastName);
    $lastName = htmlspecialchars($lastName);

    //Number
    $number = trim($_POST['number']);
    $number = strip_tags($number);
    $number = htmlspecialchars($number);

    //Program
    $program = trim($_POST['program']);
    $program = strip_tags($program);
    $program = htmlspecialchars($program);

///////////////    
    $status = trim($_POST['status']);
    $status = strip_tags($status);
    $status = htmlspecialchars($status);


    $supervisor = trim($_POST['supervisor']);
    $supervisor = strip_tags($supervisor);
    $supervisor = htmlspecialchars($supervisor);


    $program = trim($_POST['program']);
    $program = strip_tags($program);
    $program = htmlspecialchars($program);


    $program = trim($_POST['program']);
    $program = strip_tags($program);
    $program = htmlspecialchars($program);

    $program = trim($_POST['program']);
    $program = strip_tags($program);
    $program = htmlspecialchars($program);

    //Email
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    //Password
    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    // prevent sql injections / clear user invalid inputs

    if (empty($firstName)) {
        $error = true;
        $firstNameError = "Please enter your First Name.";
    }

    if (empty($lastName)) {
        $error = true;
        $lastNameError = "Please enter your Last Name.";
    }

    if (empty($number)) {
        $error = true;
        $numberError = "Please enter your Student Number.";
    }

    if (empty($program)) {
        $error = true;
        $programError = "Please enter your degree programme (eg, BABS; MAHRM, LLB/LLM).";
    }


    ///////////
    if (empty($status)) {
        $error = true;
        $statusError = "Please enter your Status - Postgraduate or Undergraduate status.";
    }

    if (empty($supervisor)) {
        $error = true;
        $supervisorError = "Please enter your project supervisor name.";
    }

    if (empty($project)) {
        $error = true;
        $projectError = "Please enter your degree project.";
    }

    if (empty($program)) {
        $error = true;
        $programError = "Please enter your degree programme (eg, BABS; MAHRM, LLB/LLM).";
    }

    if (empty($program)) {
        $error = true;
        $programError = "Please enter your degree programme (eg, BABS; MAHRM, LLB/LLM).";
    }


    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }

    // if there's no error, continue to login
    if (!$error) {

        $password = hash('sha256', $pass); // password hashing using SHA256

        $res = mysql_query("SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
        $row = mysql_fetch_array($res);
        $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row

        if ($count == 1 && $row['userPass'] == $password) {
            $_SESSION['user'] = $row['userId'];
            header("Location: login.php");
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Coding Cage - Login & Registration System</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
        <link rel="stylesheet" href="style.css" type="text/css" />
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
        
        <!-- Include jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>



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
                            <hr />
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
                                <input type="text" name="firstName" class="form-control" placeholder="Student First Name" maxlength="50" value="<?php echo $name ?>" />
                            </div>
                            <span class="text-danger"><?php echo $nameError; ?></span>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" name="lastName" class="form-control" placeholder="Student Last Name" maxlength="50" value="<?php echo $name ?>" />
                            </div>
                            <span class="text-danger"><?php echo $nameError; ?></span>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
                            </div>
                            <span class="text-danger"><?php echo $emailError; ?></span>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="text" name="number" class="form-control" placeholder="Student Number" maxlength="15" />
                            </div>
                            <span class="text-danger"><?php echo $passError; ?></span>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="text" name="program" class="form-control" placeholder="Degree Programme (eg, BABS; MAHRM, LLB/LLM)" maxlength="15" />
                            </div>
                            <span class="text-danger"><?php echo $passError; ?></span>
                        </div>   

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="text" name="status" class="form-control" placeholder="Research, Postgraduate or Undergraduate status" maxlength="15" />
                            </div>
                            <span class="text-danger"><?php echo $passError; ?></span>
                        </div>  

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="text" name="supervisor" class="form-control" placeholder="Name of student supervisor" maxlength="15" />
                            </div>
                            <span class="text-danger"><?php echo $passError; ?></span>
                        </div>  

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="text" name="project" class="form-control" placeholder="Project Title" maxlength="15" />
                            </div>
                            <span class="text-danger"><?php echo $passError; ?></span>
                        </div> 

                        <div class="bootstrap-iso">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                        <!-- Form code begins -->
                                        <form method="post">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input class="form-control" id="date" name="date" placeholder="Proposed project start date - MM/DD/YYY" type="text"/>
                                            </div>
                                        </form>
                                        <!-- Form code ends --> 

                                    </div>
                                </div>    
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="text" name="startDate" class="form-control" placeholder="Proposed project start date" maxlength="15" />
                            </div>
                            <span class="text-danger"><?php echo $passError; ?></span>
                        </div> 


                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="text" name="endDate" class="form-control" placeholder="Proposed project end date" maxlength="15" />
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
                                        <input type="radio" name="yes" value="1"><b>YES</b>
                                        <input type="radio" name="yes" value="0"><b>NO</b>

                                    </li>
                                    <li>
                                        Research involving children or other vulnerable groups:
                                        <input type="radio" name="yes" value="1"><b>YES</b>
                                        <input type="radio" name="yes" value="0"><b>NO</b>

                                    </li>
                                    <li>
                                        Research involving sensitive topics:
                                        <input type="radio" name="yes" value="1"><b>YES</b>
                                        <input type="radio" name="yes" value="0"><b>NO</b>

                                    </li>
                                    <li>
                                        Research involving aerospace/defence organisations:
                                        <input type="radio" name="yes" value="1"><b>YES</b>
                                        <input type="radio" name="yes" value="0"><b>NO</b>

                                    </li>
                                    <li>
                                        Research involving nuclear production organisations:
                                        <input type="radio" name="yes" value="1"><b>YES</b>
                                        <input type="radio" name="yes" value="0"><b>NO</b>

                                    </li>
                                </ul>
                            </div>
                        </div> 
                        <p>
                            <strong>Details of the Project:</strong>
                        </p>
                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="glyphicon glyphicon-lock" style="text-align: left; min-width: 100%" name="body" id="body" rows="20" cols="60" placeholder="Provide a brief outline of the aims and objectives of the proposed research project." maxlength="60"></textarea>
                            </div>
                        </div> 
                        <p>
                            <strong>Details of Participants:</strong>
                        </p>
                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="glyphicon glyphicon-lock" style="text-align: left; min-width: 100%" name="body" id="body" rows="20" cols="60" placeholder="Please provide details of the potential participants for this project, including how they will be selected and recruited." maxlength="60"></textarea>
                            </div>
                        </div>

                        <p>
                            <strong>Details of the Data being Processed:</strong>
                        </p>

                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="glyphicon glyphicon-lock" style="text-align: left; min-width: 100%" name="body" id="body" rows="20" cols="60" placeholder="Please describe the details of the personal data that is being collected, including the methods of data collection and analysis." maxlength="60"></textarea>
                            </div>
                        </div>

                        <p>
                            <strong>Sharing (Disclosure):</strong>
                        </p>
                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="glyphicon glyphicon-lock"style="text-align: left; min-width: 100%" name="body" id="body" rows="20" cols="60" placeholder="Please describe how the outcomes of the research will be disseminated (for example provide an explanation as to where, and how, will the results be published, or other mechanisms you will be using to share the potential participants personal data)." maxlength="60"></textarea>
                            </div>
                        </div>

                        <p>
                            <strong>Consent:</strong>
                        </p>
                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="glyphicon glyphicon-lock" style="text-align: left; min-width: 100%" name="body" id="body" rows="20" cols="60" placeholder="Consent requirements for research projects can vary widely. Whether you are intending to use a consent form, information sheet, or verbally, it is recommended to assure compliance with the Data Protection Act and with ethical requirements. Please include the information sheet and consent forms you will be using for this project, and or protocol. If you are not including an information sheet and consent form, please explain how the consent will be recorded?
                                          " maxlength="60"></textarea>
                            </div>
                        </div>

                        <p>
                            <strong>Data Storage:</strong>
                        </p>
                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="glyphicon glyphicon-lock" style="text-align: left; min-width: 100%" name="body" id="body" rows="20" cols="60" placeholder="Please describe the arrangements you will make for the security of the data, including how and where it will be stored. i.e. UCL network, *encrypted USB stick, *encrypted laptop etc. Describe how you will store your data, who will have access to it, and what happens to the data at the end of the project." maxlength="60"></textarea>
                            </div>
                        </div>

                        <p>
                            <strong>Anonymity:</strong>
                        </p>
                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="glyphicon glyphicon-lock" style="text-align: left; min-width: 100%" name="body" id="body" rows="20" cols="60" placeholder="Describe how you will maintain the confidentiality of the research data collected. Also, describe how you will ensure that research participants are anonymised in your data analysis." maxlength="60"></textarea>
                            </div>
                        </div>
                        <p>
                            <strong>International Transfer:</strong>
                        </p>
                        <p>
                            Will identifiable data be transferred outside the UK as part of this study?
                            <input type="radio" name="yes" value="1"><b>YES</b>
                            <input type="radio" name="yes" value="0"><b>NO</b>
                        </p>
                        <p style="font-style: italic"> The eighth principle of the Data Protection Act 1998 prohibits the transfer of personal data to countries or territories outside the European Economic Area (which consists of the 27 EU member states, Iceland, Liechtenstein and Norway).

                            At the time of writing the following countries have also been deemed adequate for the purposes of the 8th principle Andorra, Argentina, Canada, Faroe Islands, Guernsey, Isle of Man, Israel, Jersey, New Zealand, Switzerland and Uruguay.
                            <br>
                            The Data Protection Officer has produced guidance on the transfer of data overseas and particular to the United States. This is available from the Data Protection webpages.
                            <br>
                        </p>
                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="glyphicon glyphicon-lock" style="text-align: left; min-width: 100%" name="body" id="body" rows="10" cols="60" placeholder="If you intend to transfer data to a country not mentioned above, please supply details of adequate safeguards below:
                                          " maxlength="60"></textarea>
                            </div>
                        </div>
                        <div>
                            <p>
                                <strong>Notification:</strong>
                            </p> 
                            <p style="font-style: italic">(Please note that notification is a prerequisite for registration)</p>
                            <p>Have you informed your department's Data Protection Coordinator about your project?<input type="radio" name="yes" value="1"><b>YES</b>
                                <input type="radio" name="yes" value="0"><b>NO</b> </p>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6 col-xs-offset-3">
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#termsModal">Agree with the terms and conditions</button>
                                <input type="hidden" name="agree" value="no" />
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <hr />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary" name="btn-register">Register</button>
                    </div>

                    <!-- Terms and conditions modal -->
                    <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="Terms and conditions" aria-hidden="true">
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
                                        We expect that researchers will follow the guidance provided in the framework for research ethics which sets out what we consider best practice for social science research. At a minimum, we require that researchers and research organisations follow the RCUK grant terms and conditions as set out in the research funding guide. A research organisation takes responsibility for the management of the research project and the accountability of funds provided. Terms and conditions apply to the research organisation which by extension includes principal investigators, research teams, finance officers as well as administrators and any relevant individual acting on behalf of the research organisation in regards to an ESRC grant.
                                    </p>
                                    <p> 
                                        The RCUK terms and conditions are mandatory and must be followed by all individuals and organisations involved in ESRC-funded research. The relevant conditions are:
                                    </p>
                                    <div>
                                        <ul>
                                            <li>
                                                Overall responsibility for ensuring that all ESRC-funded research is subject to appropriate ethics review and monitoring lies with the research organisation (RO). By submitting a proposal to ESRC, the RO accepts the proposal’s ethics information and confirms that it is prepared to administer any resulting grant on the basis specified in the proposal (and any additional conditions), and is committed to an appropriate and iterative ethics review process.   
                                            </li>
                                            <li>
                                                Research organisations should have clear, transparent and effective procedures for ethics review and governance, and appropriate mechanisms for monitoring the operation of RECs and the decisions they take in relation to ESRC-funded research. 
                                            </li>
                                            <li>
                                                The research organisation should also have in place a clear sanctions policy against an individual in instances where an allegation of misconduct is upheld, and must inform the ESRC of sanctions put in place in cases involving individuals who are receiving ESRC funding (see RCUK Policy and guidelines on governance of good research conduct (external website)).
                                            </li>
                                            <li>
                                                Ethics review should be carried out before any work requiring ethics review is undertaken.
                                            </li>
                                            <li>
                                                Interdisciplinary projects which include medical or health research should follow the Medical Research Council's guidance on the conduct of medical research (external website).
                                            </li>
                                            <li>
                                                Research organisations should have appropriate processes and systems in place to ensure that all ESRC-funded research (including studentships) is conducted in line with the requirements of regulatory and professional bodies, the guidance provided by this Framework for Research Ethics, the ESRC Research Funding Guide, the ESRC Postgraduate Funding Guide, and the RCUK policy and guidelines on the governance of good research conduct (external website). 
                                            </li>
                                        </ul>
                                    </div>
                                    <p>
                                        We reserve the right to undertake audits of organisational arrangements to ensure that they are operating to the expectations outlined in this framework. Records of REC procedures, minutes of meetings, lists of reviewed proposals and research organisation's monitoring reports should also be made available to ESRC on request.
                                    </p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="agreeButton" data-dismiss="modal">Agree</button>
                                    <button type="button" class="btn btn-default" id="disagreeButton" data-dismiss="modal">Disagree</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <hr />
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

<script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>

</body>
</html>
<?php ob_end_flush(); ?>