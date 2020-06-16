<?php
    include ("dbconnect.php");
    $name = $_POST["name"];
    $ssn = $_POST["ssn"];
    if (($name == "") or ( $ssn == "") ) {
        echo "<br>Please enter your name and password!";
        exit();
    } else {
        $query = mysqli_query($conn, "select * from instructor where iname='$name' and ssn='$ssn' ");
        $count = mysqli_num_rows($query);
        if ($count == 1) {
            $sql="DROP TABLE IF EXISTS activeInstructor; ";
            $sqll = mysqli_query($conn, $sql);
            $createSql="create table activeInstructor(ssn varchar(20) NOT NULL) ; ";
            $queryenduser = mysqli_query($conn, $createSql);
            $insertSql="INSERT INTO activeInstructor (ssn) VALUES ('$ssn') ; ";
            $queryenduser = mysqli_query($conn, $insertSql);
            header( "Location:http://localhost/Project3/ilog3.php" );
        } else {
            echo "<font size='3'>Error:Can't Found This User!</font>";
            echo "<br><a href=studentlogin.php> Back to Log in page </a>";
        }
    }
    ?>