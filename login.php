<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['user'])) {
    header("Location: loginhome.php");
    exit;
}
// select loggedin users detail
$res = mysqli_query($link, ("SELECT * FROM users WHERE userId=" . $_SESSION['user']));

$userRow = mysql_fetch_array($res);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Welcome - <?php echo $userRow['userEmail']; ?></title>
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
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="http://www.codingcage.com">Coding Cage</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="http://www.codingcage.com/2015/01/user-registration-and-login-script-using-php-mysql.html">Back to Article</a></li>
                        <li><a href="http://www.codingcage.com/search/label/jQuery">jQuery</a></li>
                        <li><a href="http://www.codingcage.com/search/label/PHP">PHP</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['userEmail']; ?>&nbsp;<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div id="wrapper">
            <div class="container">
                <div class="page-header">
                    <h3>Coding Cage - Programming Blog</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Focuses on PHP, MySQL, Ajax, jQuery, Web Design and more...</h1>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <?php include 'include/footer.php'; ?>
        </div>
        <script src="assets/jquery-1.11.3-jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>
</html>
<?php ob_end_flush(); ?>