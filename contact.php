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
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="css/main-style.css">
    </head>
    <body>
        <div>
            <?php include 'include/header.php'; ?>
        </div>
        <div>
            <form action="sendemail.php" method="post" style="margin: 0 auto; width:250px;">
                <label for="subject">Subject of email:</label><br>
                <input type="text" name="subject" id="subject"/><br>
                <label for="body">Body of email:</label><br>
                <textarea name="body" id="body" rows="10" cols="35"></textarea><br>
                <input type="submit" name=submit value="Submit"/>
            </form>
        </div>
        <div>
            <?php include 'include/footer.php'; ?>

        </div>
    </body>
</html>
<?php ob_end_flush(); ?>