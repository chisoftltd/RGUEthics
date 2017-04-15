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

                    <div class="col-md-12">

                        <div class="form-group">
                            <h2 class="">Register Your Project.</h2>
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
                                        <strong>Does the research project involve any of the following risk factors:</strong>
                                        <ul>
                                            <li>
                                                Research involving health sector organisations:
                                            </li>
                                            <li>
                                                Research involving children or other vulnerable groups
                                            </li>
                                            <li>
                                                Research involving sensitive topics
                                            </li>
                                            <li>
                                                Research involving aerospace/defence organisations
                                            </li>
                                            <li>
                                                Research involving nuclear production organisations
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div> 

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> </span>
                                <textarea class="glyphicon glyphicon-lock" name="body" id="body" rows="20" cols="60" placeholder="Provide a brief outline of the aims and objectives of the proposed research project." maxlength="60"></textarea>
                            </div>
                        </div> 

                        <div class="form-group">
                            <div class="input-group">
                                <h1>
                                    <strong>Details of Participants</strong>
                                </h1>
                                <textarea class="glyphicon glyphicon-lock" name="body" id="body" rows="20" cols="60" placeholder="Please provide details of the potential participants for this project, including how they will be selected and recruited." maxlength="60"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <h1>
                                    <strong>Details of the Data being Processed</strong>
                                </h1>
                                <textarea class="glyphicon glyphicon-lock" name="body" id="body" rows="20" cols="60" placeholder="Please describe the details of the personal data that is being collected, including the methods of data collection and analysis." maxlength="60"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <h1>
                                    <strong>Sharing (Disclosure)</strong>
                                </h1>
                                <textarea class="glyphicon glyphicon-lock" name="body" id="body" rows="20" cols="60" placeholder="Please describe how the outcomes of the research will be disseminated (for example provide an explanation as to where, and how, will the results be published, or other mechanisms you will be using to share the potential participants personal data)." maxlength="60"></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="input-group">
                                <h1>
                                    <strong>Consent</strong>
                                </h1>
                                <textarea class="glyphicon glyphicon-lock" name="body" id="body" rows="20" cols="60" placeholder="Consent requirements for research projects can vary widely. Whether you are intending to use a consent form, information sheet, or verbally, it is recommended to assure compliance with the Data Protection Act and with ethical requirements.
                                          <br>
                                          Please include the information sheet and consent forms you will be using for this project, and or protocol. If you are not including an information sheet and consent form, please explain how the consent will be recorded?
                                          " maxlength="60"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <h1>
                                    <strong>Data Storage</strong>
                                </h1>
                                <textarea class="glyphicon glyphicon-lock" name="body" id="body" rows="20" cols="60" placeholder="Please describe the arrangements you will make for the security of the data, including how and where it will be stored. i.e. UCL network, *encrypted USB stick, *encrypted laptop etc." maxlength="60"></textarea>
                            </div>
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