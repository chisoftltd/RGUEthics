<?php

ob_start();
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
}
include_once 'dbconnect.php';
//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
    $id = test_input($_POST["id"]);
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $cpassword = mysqli_real_escape_string($link, $_POST['cpassword']);


    //name can contain only alpha characters and space
    if (empty($id)) {
        $error = true;
        $idError = "Please enter ID Number.";
    } else if (strlen($id) < 0 || strlen($id) > 11) {
        $error = true;
        $id_Error = "ID must have atleast 11 digits.";
    }
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }
    if(strlen($password) < 6) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }
    if($password != $cpassword) {
        $error = true;
        $cpassword_error = "Password and Confirm Password doesn't match";
    }

    // if there's no error, continue to signup
    if (!$error) {

        $query = "INSERT INTO users (userId, userName, userEmail, userPass) VALUES('".$id."', '".$name."','".$email."','".md5($password)."')";
        $res = mysqli_query($link, $query);


        if ($res) {
            $errTyp = "success";
            $successMSG = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
            unset($name);
            unset($email);
            unset($password);
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
        }
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
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
    </head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- add header -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Koding Made Simple</a>
        </div>
        <!-- menu items -->
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="login.php">Login</a></li>
                <li class="active"><a href="registertesting.php">Sign Up</a></li>
            </ul>
        </div>
    </div>
</nav>
    <div>
        <?php include 'include/loginheader.php'; ?>
    </div>
    <div>
        <hr>
    </div>
    <div class="container">

        <div id="login-form">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="signupform" autocomplete="on">

                <div class="col-md-12">
<fieldset>
                    <legend>Student Sign Up</legend>

                    <div class="form-group">
                        <label for="id">Number</label>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="number" name="id" class="form-control" placeholder="Enter Student Number"
                                   maxlength="50"  value="<?php if($error) echo $id ?>" class="form-control" />
    <span class="text-danger"><?php if (isset($id_error)) echo $id_error; ?></span>
                    </div>

    <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" placeholder="Enter Full Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
    <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
    </div>

    <div class="form-group">
    <label for="name">Email</label>
    <input type="text" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>" class="form-control" />
    <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
    </div>

    <div class="form-group">
    <label for="name">Password</label>
    <input type="password" name="password" placeholder="Password" required class="form-control" />
    <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
    </div>

    <div class="form-group">
    <label for="name">Confirm Password</label>
<input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
    <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
    </div>

    <div class="form-group">
    <input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
    </div>
    </fieldset>
    </form>
            </form>
    <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
    <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
    </div>
    </div>
    <div class="row">
    <div class="col-md-4 col-md-offset-4 text-center">
    Already Registered? <a href="login.php">Login Here</a>
    <div>
        <hr>
    </div>
    <div>
        <?php include 'include/footer.php'; ?>

    </div>
    </body>
    </html>
<?php ob_end_flush(); ?>