<?php
/**
 * Created by PhpStorm.
 * User: Chisoft
 * Date: 2017-04-20
 * Time: 16:25
 */

ob_start();
session_start();
require_once 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['p'];
    $query = "SELECT * FROM projethics WHERE number =" . $id;
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
}
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Coding Cage - Login & Registration System</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <link rel="stylesheet" href="css/main-style.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
              crossorigin="anonymous">        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
              integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
              crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
                crossorigin="anonymous"></script>
    </head>
    <body>
    <div>
        <?php include 'include/loginheader.php'; ?>
    </div>
    <div>
        <hr>
    </div>
    <div class="container">
        <h3>Student Number: <?php echo $row['Number'] ?></h3>;
        <h3>Student Name: <?php echo $row['Name'] ?></h3>;
        <h3>Project Supervisor: <?php echo $row["supervisor"] ?></h3>;
        <h3>Department: <?php echo $row['Department1'] ?></h3>;
        <h3>Project Topice: <?php echo $row['ProjectTopic'] ?></h3>;
        <h3>Project Desc.: <?php echo $row['ProjectDesc'] ?></h3>;
        <h3>Data Detail: <?php echo $row['Datadetail'] ?></h3>;
        <h3>Data Storage: <?php echo $row['Datastorage'] ?></h3>;
        <h3></h3>
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