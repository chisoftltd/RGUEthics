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
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>RGUEthics - Experiment Approval Officers (EAO)</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="css/main-style.css">
</head>
<body>
<div>
    <?php include 'include/header.php'; ?>
</div>
<div class="container">

    <?php
    /* connect to the db */

    mysqli_select_db('localdb',$link);

    /* show tables */
    $result = mysqli_query('SHOW TABLES',$link) or die('cannot show tables');
    while($tableName = mysqli_fetch_row($result)) {

        $table = $tableName[0];

        echo '<h3>',$table,'</h3>';
        $result2 = mysqli_query('SHOW COLUMNS FROM '.$table) or die('cannot show columns from '.$table);
        if(mysqli_num_rows($result2)) {
            echo '<table cellpadding="0" cellspacing="0" class="table table-striped">';
            echo '<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default<th>Extra</th></tr>';
            while($row2 = mysqli_fetch_row($result2)) {
                echo '<tr>';
                foreach($row2 as $key=>$value) {
                    echo '<td>',$value,'</td>';
                }
                echo '</tr>';
            }
            echo '</table><br />';
        }
    }
    ?>
</div>
<div>
    <?php include 'include/footer.php'; ?>
</div>
</body>
</html>
