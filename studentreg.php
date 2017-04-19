<?php
//ob_start();
//session_start();
require_once 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = test_input($_POST["usernumber"]);
    $name = test_input($_POST["user"]);
    $email = test_input($_POST["email"]);
    $superv = test_input($_POST["superv"]);
    $depart = test_input($_POST["depart"]);
    $projtop = test_input($_POST["projtop"]);
    $projdesc = test_input($_POST["projdesc"]);
    $strdate = test_input($_POST["statdate"]);
    $endate = test_input($_POST["endate"]);
    $datadetail = test_input($_POST["datadetails"]);
    $datasto = test_input($_POST["datastorage"]);


    if (!empty($name) && !empty($email) && !empty($superv) && !empty($depart) && !empty($projtop) && !empty($projdesc) && !empty($strdate) && !empty($endate)
        && !empty($datadetail) && !empty($datasto) && !empty($number)
    ) {
        $connMSG = "Successfully registered your project ethics ";
        $query = "INSERT INTO ethics VALUES ('$number','$name', '$email', '$superv', '$depart','$projtop', '$projdesc', '$strdate', '$endate',
        '$datadetail', '$datasto')";
        $res = mysqli_query($link, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered your project ethics ";
        } else {
            $errTyp = "danger";
            $errMSG = "Data insertion failed";
        }
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="on">
        <div class="form-group">
            <label for="usr">Student Number:</label>
            <input type="number" class="form-control" id="usr" name="usernumber">
        </div>

        <div class="form-group">
            <label for="usr">Student Name:</label>
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
</div>
<div>
    <?php include 'include/footer.php'; ?>

</div>

</body>
</html>