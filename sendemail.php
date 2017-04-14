<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Block 1
$user = "user_name";
$password = "password";
$host = "host_name";
$dbase = "database_name";
$table = "table_name";

//Block 2
$from = 'email_address';

//Block 3
$subject = $_POST['subject'];
$body = $_POST['body'];

//Block 4
$dbc = mysqli_connect($host, $user, $password, $dbase)
        or die("Unable to select database");

//Block 5
$query = "SELECT * FROM $table";
$result = mysqli_query($dbc, $query)
        or die('Error querying database.');

//Block 6
while ($row = mysqli_fetch_array($result)) {
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];

//Block 7
    $msg = "Dear $first_name $last_name,\n$body";
    mail($email, $subject, $msg, 'From:' . $from);
    echo 'Email sent to: ' . $email . '<br>';
}

//Block 8
mysqli_close($dbc);
?>
