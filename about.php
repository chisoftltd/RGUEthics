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

if (isset($_POST['btn-login'])) {

    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>RGUEthics- Login & Registration System</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="css/main-style.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <div>
            <?php include 'include/header.php'; ?>
        </div>
        <div class="container">
            <p>
            <h3>Web Application Description - RGUEthics</h3>
            This web application which I called RGUEthics is an online application that will manage RGU student’s experiment ethics. </p>
        <p>The interface should have a logo, navigation bar with elements like “Home”, “About Us”, “Student”, “Experiment Approval Officers (EAO)”, “Contact US” and “Login”. </p>
        <p>The interface should have a “News Section” about current government and university policy on research ethics.  </p>
        <p>The landing page should contain a summary of, a least five, ongoing experiments. Also present on the interface is are logos to Social media platforms like Facebook etc. </p>
        <p>The application will allow students, after authentication to seek approval for their propose experiment from EAO. EAOs should be able to approve, request additional information or reject an experiment proposal. </p>
        <p>To implement fairness and objectivity each experiment will be randomly assign to two different EAOs, by an Administrator. 
        </p>
        <p>Furthermore, the application will allow students and staff to submit assessment of EAO and the EAOs in turn will also have same permission for the Administrators.  
        </p>

    </div>
    <div>
        <?php include 'include/footer.php'; ?>
    </div>
</body>
</html>
<?php ob_end_flush(); ?>