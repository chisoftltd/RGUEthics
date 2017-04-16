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

if (!empty($_POST['yes'])) {
  // Yes
} else {
  // No
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
    </head>
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
                                <input type="text" name="name" class="form-control" placeholder="Name of Student" maxlength="50" value="<?php echo $name ?>" />
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
                                <input type="password" name="pass" class="form-control" placeholder="Student Number" maxlength="15" />
                            </div>
                            <span class="text-danger"><?php echo $passError; ?></span>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" name="pass" class="form-control" placeholder="Degree Programme (eg, BABS; MAHRM, LLB/LLM)" maxlength="15" />
                            </div>
                            <span class="text-danger"><?php echo $passError; ?></span>
                        </div>   

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" name="pass" class="form-control" placeholder="Research, Postgraduate or Undergraduate status" maxlength="15" />
                            </div>
                            <span class="text-danger"><?php echo $passError; ?></span>
                        </div>  

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" name="pass" class="form-control" placeholder="Name of student supervisor" maxlength="15" />
                            </div>
                            <span class="text-danger"><?php echo $passError; ?></span>
                        </div>  

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" name="pass" class="form-control" placeholder="Project Title" maxlength="15" />
                            </div>
                            <span class="text-danger"><?php echo $passError; ?></span>
                        </div> 

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" name="pass" class="form-control" placeholder="Proposed project start date" maxlength="15" />
                            </div>
                            <span class="text-danger"><?php echo $passError; ?></span>
                        </div> 


                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" name="pass" class="form-control" placeholder="Proposed project end date" maxlength="15" />
                            </div>
                            <span class="text-danger"><?php echo $passError; ?></span>
                        </div> 

                        <div class="form-group">
                            <div class="input-group">
                                <ul>
                                    <li>
                                        Does the research project involve any of the following risk factors:
                                        <ul>
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
                                    </li>
                                </ul>
                            </div>
                        </div> 
                        <h3>
                            Details of the Project
                        </h3>
                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="glyphicon glyphicon-lock" name="body" id="body" rows="20" cols="60" placeholder="Provide a brief outline of the aims and objectives of the proposed research project." maxlength="60"></textarea>
                            </div>
                        </div> 

                        <h3>
                            Details of Participants
                        </h3>

                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="glyphicon glyphicon-lock" name="body" id="body" rows="20" cols="60" placeholder="Please provide details of the potential participants for this project, including how they will be selected and recruited." maxlength="60"></textarea>
                            </div>
                        </div>

                        <h3>
                            Details of the Data being Processed
                        </h3>

                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="glyphicon glyphicon-lock" name="body" id="body" rows="20" cols="60" placeholder="Please describe the details of the personal data that is being collected, including the methods of data collection and analysis." maxlength="60"></textarea>
                            </div>
                        </div>

                        <h3>
                            Sharing (Disclosure)
                        </h3>

                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="glyphicon glyphicon-lock" name="body" id="body" rows="20" cols="60" placeholder="Please describe how the outcomes of the research will be disseminated (for example provide an explanation as to where, and how, will the results be published, or other mechanisms you will be using to share the potential participants personal data)." maxlength="60"></textarea>
                            </div>
                        </div>

                        <h3>
                            Consent
                        </h3>

                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="glyphicon glyphicon-lock" name="body" id="body" rows="20" cols="60" placeholder="Consent requirements for research projects can vary widely. Whether you are intending to use a consent form, information sheet, or verbally, it is recommended to assure compliance with the Data Protection Act and with ethical requirements.

                                          Please include the information sheet and consent forms you will be using for this project, and or protocol. If you are not including an information sheet and consent form, please explain how the consent will be recorded?
                                          " maxlength="60"></textarea>
                            </div>
                        </div>

                        <h3>
                            Data Storage
                        </h3>


                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="glyphicon glyphicon-lock" name="body" id="body" rows="20" cols="60" placeholder="Please describe the arrangements you will make for the security of the data, including how and where it will be stored. i.e. UCL network, *encrypted USB stick, *encrypted laptop etc." maxlength="60"></textarea>
                            </div>
                        </div>

                        <h3>
                            International Transfer
                        </h3>
                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="glyphicon glyphicon-lock" name="body" id="body" rows="10" cols="60" placeholder="
                                          Will identifiable data be transferred outside the UK as part of this study? YES / NO
                                          <br>
                                          The eighth principle of the Data Protection Act 1998 prohibits the transfer of personal data to countries or territories outside the European Economic Area (which consists of the 27 EU member states, Iceland, Liechtenstein and Norway).
                                          <br>
                                          At the time of writing the following countries have also been deemed adequate for the purposes of the 8th principle Andorra, Argentina, Canada, Faroe Islands, Guernsey, Isle of Man, Israel, Jersey, New Zealand, Switzerland and Uruguay.
                                          <br>
                                          The Data Protection Officer has produced guidance on the transfer of data overseas and particular to the United States. This is available from the Data Protection webpages.
                                          <br>
                                          If you intend to transfer data to a country not mentioned above, please supply details of adequate safeguards below:
                                          " maxlength="60"></textarea>
                                <textarea class="glyphicon glyphicon-lock" name="body" id="body" rows="5" cols="60" maxlength="60"></textarea>
                                <textarea class="glyphicon glyphicon-lock" name="body" id="body" rows="10" cols="60" placeholder="Use of cloud computing, or the transfer of personal data to other orgainsations providing a specific service e.g. transcriptions services.
                                          <br>
                                          If you are intending to use, or are considering using a cloud service (defined as access to computing resources, on demand, via network), or plan on using a third party orgainsation to deliver a service that will involve the transfer of personal data, you should ensure that there is an agreement in place which provides adequate levels of protection so that UCL can meets its obligations and protects the rights of the participants involved. 
                                          <br>
                                          " maxlength="60"></textarea>
                                <textarea class="glyphicon glyphicon-lock" name="body" id="body" rows="5" cols="60" maxlength="60"></textarea>
                            </div>
                        </div>
                        <div>
                            <h3>
                                Notification
                            </h3>
                            <h4 style="font-style: italic">(Please note that notification is a prerequisite for registration)</h4>
                            <h4>Have you informed your department's Data Protection Coordinator about your project? </h4>
                            <input type="radio" name="yes" value="1"><b>YES</b>
                            <input type="radio" name="yes" value="0"><b>NO</b>
                        </div>

                    </div>
                    <div class="form-group">
                        <hr />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Register</button>
                    </div>

                    <div class="form-group">
                        <hr />
                    </div>

                    <div class="form-group">
                        <a href="index.php">Sign in Here...</a>
                    </div>

            </div>

        </form>
    </div>

</div>
<div>
    <?php include 'include/footer.php'; ?>

</div>
</body>
</html>
<?php ob_end_flush(); ?>