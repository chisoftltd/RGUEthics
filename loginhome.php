<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST["email"]);
    $pass = test_input($_POST["pass"]);

    // Check connection
    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }

    // prevent sql injections / clear user invalid inputs

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

        $res = mysqli_query($link, ("SELECT userId, userName, userPass FROM users WHERE userEmail='$email'"));
        $row = mysqli_fetch_array($res);
        $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

        if ($count == 1 && $row['userPass'] == $password) {
            $_SESSION['user'] = $row['userId'];
            header("Location: login.php");
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
        }
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
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>RGUEthics- Login Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/main-style.css">
    </head>
    <body>
    <div>
        <?php include 'include/header.php'; ?>
    </div>
    <div class="container">

        <div id="login-form">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="on">
                <div class="col-md-12">
                    <div class="form-group">
                        <h2 class="">Sign In.</h2>
                    </div>
                    <div class="form-group">
                        <hr />
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
                        </div>
                        <span class="text-danger"><?php echo $emailError; ?></span>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
                        </div>
                        <span class="text-danger"><?php echo $passError; ?></span>
                    </div>
                    <div class="form-group">
                        <hr />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Sign In</button>
                    </div>
                    <div class="form-group">
                        <hr />
                    </div>
                    <div class="form-group">
                        <a href="register.php">Sign Up Here...</a>
                    </div>
                </div>
            </form>

            <?php
            if (isset($errMSG)) {
                ?>
                <div class="form-group">
                    <div class="alert alert-danger-<?php echo ($errTyp == "success") ? "success" : $errTyp; ?>">
                        <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <div>
        <?php include 'include/footer.php'; ?>

    </div>
    </body>
    </html>
<?php ob_end_flush(); ?>