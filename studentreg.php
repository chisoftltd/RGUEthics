<?php
//ob_start();
//session_start();
require_once 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["user"]);
    $email = test_input($_POST["email"]);
    $superv = test_input($_POST["superv"]);
    $depart = test_input($_POST["depart"]);
    $projtop = test_input($_POST["projtop"]);
    $projdesc = test_input($_POST["projdesc"]);
    $strdate = test_input($_POST["statdate"]);
    $endate = test_input($_POST["endate"]);
    $health = test_input($_POST["health"]);
    $vulnerable = test_input($_POST["vulnerable"]);
    $sensitive = test_input($_POST["sensitive"]);
    $aerodef = test_input($_POST["aerodef"]);
    $nuclear = test_input($_POST["nuclear"]);
    $datadetail = test_input($_POST["datadetails"]);
    $datasto = test_input($_POST["datastorage"]);


if (!empty($name)&& !empty($email) && !empty($superv)&& !empty($depart)&& !empty($projtop)&& !empty($projdesc)&& !empty($strdate)&& !empty($endate)
    && !empty($health)&& !empty($vulnerable)&& !empty($sensitive)&& !empty($aerodef)&& !empty($nuclear)&& !empty($datadetail)&& !empty($datasto)){
    $errMSG = "Successfully registered your project ethics ";
    }
} else{
$dataMSG = "Something went wrong, try again later...";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Project Registration</title>
    <meta charset="utf-8">
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
    <form>

        <div class="form-group">
            <label for="usr">Name:</label>
            <input type="text" class="form-control" id="usr" name="user">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="form-group">
            <label for="sup">Supervisor:</label>
            <input type="text" class="form-control" id="sup" name="superv">
        </div>

        <div class="form-group">
            <label for="dep">Department:</label>
            <input type="text" class="form-control" id="dep" name="depart">
        </div>

        <div class="form-group">
            <label for="protopc">Project Topic:</label>
            <input type="text" class="form-control" id="protopc" name="projtop">
        </div>

        <div class="form-group">
            <label for="comment">Project Description</label>
            <textarea class="form-control" rows="5" id="comment" name="projdesc"></textarea>
        </div>

        <div class="form-group">
            <label for="stadate">Start Date:</label>
            <input type="date" class="form-control" id="stadate" name="statdate">
        </div>

        <div class="form-group">
            <label for="enddate">Expected End Date:</label>
            <input type="date" class="form-control" id="enddate" name="endate">
        </div>
        <div class="form-group">
            <h2>Does the research project involve any of the following risk factors:</h2>
            <div class="checkbox">
                <label><input type="checkbox" value="" name="health">Research involving health sector organisations</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="" name="vulnerable">Research involving children or other vulnerable groups</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="" name="sensitive">Research involving sensitive topics</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="" name="aerodef">Research involving aerospace/defence organisations</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="" name="nuclear">Research involving nuclear production organisations</label>
            </div>
            <div class="form-group">
                <label for="comment">Details of the Data being Processed</label>
                <textarea class="form-control" rows="5" id="comment" name="datadetails"
                          placeholder="Please describe the details of the personal data that is being collected, including the methods of data collection and analysis."></textarea>
            </div>
            <div class="form-group">
                <label for="comment">Data Storage</label>
                <textarea class="form-control" rows="5" id="comment" name="datastorage"
                          placeholder="Please describe the arrangements you will make for the security of the data, including how and where it will be stored."></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary">Register</button>
            </div>
    </form>
</div>
<div>
    <?php include 'include/footer.php'; ?>

</div>

</body>
</html>

