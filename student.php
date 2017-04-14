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
                                <span class="input-group-addon"><textarea class="glyphicon glyphicon-lock" name="body" id="body" rows="20" cols="45" placeholder="Provide a brief outline of the aims and objectives of the proposed research project." maxlength="45"></textarea></span>
                                <input type="password" name="pass" class="form-control"  />
                            </div>
                            <span class="text-danger"><?php echo $passError; ?></span>
                        </div> 

                    </div>
                    <div class="form-group">
                        <hr />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
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