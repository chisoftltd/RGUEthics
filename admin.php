<?php

require_once 'dbconnect.php';

// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>RGUEthics - Administrator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <link rel="stylesheet" href="css/main-style.css">
</head>
<body>
<div>
    <?php include 'include/header.php'; ?>
</div>

<div>
    <hr>
</div>
<div class="container">

    <?php
    /* connect to the db */

    mysqli_select_db($link, "localdb");

    //show tables
    $result = mysqli_query($link, "Show tables") or die('cannot show tables');
    while ($tableName = mysqli_fetch_row($result)) {

        $table = $tableName[0];

        echo '<h3>', $table, '</h3>';
        $result2 = mysqli_query($link, "SELECT * FROM " . $table) or die('cannot show columns from ' . $table);
        $count = mysqli_num_rows($result2);
        if (mysqli_num_rows($result2)) {
            echo '<table cellpadding="0" cellspacing="0" class="table table-striped">';
            echo '<tr><th>Approval Number</th><th>Staff Name</th><th>Approval Date</th><th>Project Topic</th><th>Student<th>Supervisor</th></tr>';
            while ($row2 = mysqli_fetch_row($result2)) {
                echo '<tr>';
                foreach ($row2 as $key => $value) {
                    echo '<td>', $value, '</td>';
                }
                echo '</tr>';
            }
            echo '</table><br />';
        }
    }

    $sql = "SHOW COLUMNS FROM" . $table;
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo $row['Field'] . "<br>";
    }
    ?>
</div>
<div>
    <hr>
</div>
<div>
    <?php include 'include/loginheader.php'; ?>
</div>
<script>
    $(".container").delegate("td", "click", function () {
        window.location.href = $(this).find("form").attr("action");
    });
</script>
</body>
</html>
