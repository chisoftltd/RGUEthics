<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['user'])) {
    header('Location: loginhome.php');
    exit;
}
// select loggedin users detail
$res = mysqli_query($link, ("SELECT * FROM users WHERE userId=" . $_SESSION['user']));

$userRow = mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Welcome - <?php echo $userRow['userEmail']; ?></title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <link rel="stylesheet" href="css/main-style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div>
    <?php include 'include/loginheader.php'; ?>
</div>
<nav class="navbar navbar-default navbar-fixed-top">

    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="studentreg.php">Student</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a
                            href="EAO.php">Experiment Approval Officers (EAO)</a></li>
                <li><a href="admin.php">Administrator</a></li>
                <li><a href="http://www.rgu.ac.uk/">RGU</a></li>
                <li>
                    <a href="http://www.rgu.ac.uk/about/schools-and-departments/school-of-pharmacy-and-life-sciences/ethics-procedures/">Ethics
                        Procedures</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['userEmail']; ?>
                        &nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="pageContent">
    <nav class="nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <br>
            <li><a href="about.php">About Us</a></li>
            <br>
            <li> <a href="studentreg.php">Student</a></li>
            <br>
            <li> <a href="EAO.php">Experiment Approval Officers (EAO)</a></li>
            <br>
            <li> <a href="admin.php">Administrator</a></li>
            <br>
            <li><a href="contact.php">Contact</a></li>
            <br>
            <li><a href="login.php">Login</a></li>
            <br>
        </ul>
    </nav>
    <article class="article">
        <h2>Research Ethics and Integrity</h2>
        <h3>Full Assessment Guidance Notes</h3>
        <h4>A Full Research Ethics and Integrity Assessment is required when the research project involves;</h4>
        <ul>
            <li>vulnerable human subjects (e.g. children, people who may not be fluent in English, people who may have
                cognitive disabilities, and – <br> especially where the research is to be undertaken in a developing
                country - people in limited economic circumstances)
            </li>
            <br>
            <li>invasive procedures or addressing sensitive issues (e.g. video-taping without informed consent,
                questions about sexuality or about criminal<br> behaviour)
            </li>
            <br>
            <li>and/or</li>
            <br>
            <li>biophysical research which requires extraordinary permission from landowners, involves significant
                disturbance to vulnerable species or habitats,<br> sampling rare/endangered or harmful taxa/species,
                and/or transporting samples/specimens between countries or significant ‘boundaries’.
            </li>
            <br>
        </ul>

    </article>
</div>
<div>
    <?php include 'include/footer.php'; ?>
</div>
<script src="assets/jquery-1.11.3-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
