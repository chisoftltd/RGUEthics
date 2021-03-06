<?php
ob_start();
session_start();
if (isset($_SESSION['user']) != "") {
    header("Location: login.php");
}
include_once 'dbconnect.php';

$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $id = test_input($_POST["id"]);
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["pass"]);

    // Check connection
    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }

    // basic name validation
    if (empty($name)) {
        $error = true;
        $nameError = "Please enter your full name.";
    } else if (strlen($name) < 3) {
        $error = true;
        $nameError = "Name must have atleat 3 characters.";
    } else if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $error = true;
        $nameError = "Name must contain alphabets and space.";
    }

    //basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    } else {
        // check email exist or not
        $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
        $result = mysqli_query($link, $query);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }
    // password validation
    if (empty($password)) {
        $error = true;
        $passError = "Please enter password.";
    } else if (strlen($password) < 6) {
        $error = true;
        $passError = "Password must have atleast 6 characters.";
    }

    if (empty($id)) {
        $error = true;
        $idError = "Please enter ID Number.";
    } else if (strlen($id) < 0 || strlen($id) > 11) {
        $error = true;
        $idError = "ID must have atleast 11 digits.";
    }
    // password encrypt using SHA256();
    $passwd = hash('sha256', $password);

    // if there's no error, continue to signup
    if (!$error) {

        $query = "INSERT INTO users VALUES('$id', '$name','$email','$passwd')";
        $res = mysqli_query($link, $query);


        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now";
            unset($name);
            unset($email);
            unset($passwd);
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
        }
    }
    // if session is not set this will redirect to login page
    if (!isset($_SESSION['user'])) {
        header("Location: loginhome.php");
        exit;
    }

    // clean user inputs to prevent sql injections
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}/*
if (!mysqli_query($link, "SET a=1")) {
    printf("Errormessage: %s\n", mysqli_error($link));
}
echo error_reporting(E_ALL);
*/
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>RGUEthics - Registration System</title>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <link rel="stylesheet" href="css/main-style.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
              crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
              integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
              crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
                crossorigin="anonymous"></script>
        <script>
            function newDoc() {
                window.location.assign("login.php")
            }
        </script>
    </head>
    <body>
    <div>
        <?php include 'include/header.php'; ?>
    </div>
    <div>
        <hr>
    </div>
    <div class="container">

        <div id="login-form">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="on">

                <div class="col-md-12">

                    <div class="form-group">
                        <h2 class="">Sign Up.</h2>
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
                            <input type="number" name="id" class="form-control" placeholder="Enter Student Number"
                                   maxlength="50" value="<?php echo $id ?>"/>
                        </div>
                        <span class="text-danger"><?php echo $idError; ?></span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" name="name" class="form-control" placeholder="Enter Student Name"
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
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="pass" class="form-control" placeholder="Enter Password"
                                   maxlength="20" value="<?php echo $passwd ?>"/>
                        </div>
                        <span class="text-danger"><?php echo $passError; ?></span>
                    </div>

                    <div class="form-group">
                        <hr/>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary" onclick="newDoc()">Sign Up</button>
                    </div>

                    <div class="form-group">
                        <hr/>
                    </div>

                    <div class="form-group">
                        <a href="loginhome.php">Sign in Here...</a>
                    </div>

                </div>

            </form>
        </div>

    </div>
    <div>
        <hr>
    </div>
    <div>
        <?php include 'include/footer.php'; ?>

    </div>
    </body>
    </html>
<?php ob_end_flush(); ?>