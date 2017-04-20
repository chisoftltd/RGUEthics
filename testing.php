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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>RGUEthics - Experiment Approval Officers (EAO)</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <link rel="stylesheet" href="css/main-style.css">
    <style type="text/css">
        tr.header {
            font-weight: bold;
        }

        tr.alt {
            background-color: #777777;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.striped tr:even').addClass('alt');
        });
    </script>
</head>
<body>
<div>
    <?php include 'include/header.php'; ?>
</div>
<div class="container">

    <?php

    //   $server = mysqli_connect("localhost","root", "");
    //   $db =  mysqli_select_db("MyDatabase",$server);
    $query = mysqli_query($link, "SELECT Number, Name, supervisor FROM projethics");
    ?>
    <table class="striped">
        <tr class="header">
            <td>Id</td>
            <td>Name</td>
            <td>Title</td>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>" . $row[Number] . "</td>";
            echo "<td>" . $row[Name] . "</td>";
            echo "<td>" . $row[supervisor] . "</td>";
            echo "<td><a href=''>link</a></td>";
            echo "</tr>";
        }

        ?>
    </table>
</div>
<div>
    <?php include 'include/footer.php'; ?>
</div>
</body>
</html>
