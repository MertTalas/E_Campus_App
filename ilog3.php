<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
    <title>Instructor Operations</title>
</head>
<body>
    <h4>Choose your operation:</h4>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <select name="operation">
                <?php
                    echo "<option value='0'>","the courses s/he is teaching","\n"; 
                    echo "<option value='1'>","weekly schedule","\n"; 
                    echo "<option value='2'>","the grade reportstudents of each course","\n"; 
                    echo "<option value='3'>","the projects s/he is leading","\n"; 
                    echo "<option value='4'>","projects s/he is working","\n"; 
                    echo "<option value='5'>","the students s/he is advising","\n"; 
                    echo "<option value='6'>","the graduate students s/he is supervising","\n"; 
                    echo "<option value='7'>","display free hours report for the courses s/he teaching","\n"; 
                ?>
            </select>
            <input type="submit" value="Get the form">
        </form>
    <?php
    include ("dbconnect.php"); 
    if(isset($_POST["operation"])){
    if ($_POST["operation"]=='0') {
        $query = "select DISTINCT E.courseCode
                    from instructor I, enrollment E,activeinstructor AI
                    where I.ssn=AI.ssn and E.issn=I.ssn;";
        $result = mysqli_query($conn, $query);
        $queryControl= mysqli_num_rows($result);
        if($queryControl>0){ 
        while($row = mysqli_fetch_assoc($result)){
             $zero=$row['courseCode'];
             echo "<br>",$zero;
        }
        }else {
            echo "<br>", 'No table matched';
        }
    }
    if ($_POST["operation"]=='1') {
        $query = "select WS.courseCode, WS.dayy, WS.hourr,WS.buildingName, WS.roomNumber
                    from weeklyschedule WS, instructor I,activeinstructor AI
                    where I.ssn=AI.ssn and WS.issn=I.ssn;";
        $result = mysqli_query($conn, $query);
        $queryControl= mysqli_num_rows($result);
        if($queryControl>0){ 
        while($row = mysqli_fetch_assoc($result)){
             $first=$row['courseCode']." , ".$row['dayy']." , ".$row['hourr']." , ".$row['buildingName']." , ".$row['roomNumber'];
             echo "<br>",$first;    
        }
        }else {
            echo "<br>", 'No table matched';
        }
    }
    if ($_POST["operation"]=='2') {
        $query = "select E.courseCode, E.sssn
                    from instructor I,enrollment E,activeinstructor AI
                    where I.ssn=AI.ssn ;";
        $result = mysqli_query($conn, $query);
        $queryControl= mysqli_num_rows($result);
        if($queryControl>0){ 
        while($row = mysqli_fetch_assoc($result)){
             $second=$row['courseCode']." , ".$row['sssn'];
             echo "<br>",$second;    
        }
        }else {
            echo "<br>", 'No table matched';
        }
    }
    if ($_POST["operation"]=='3') {
        $query = "select P.pName
                    from Project P,Instructor I,activeinstructor AI
                    where I.ssn=AI.ssn and I.ssn=P.leadSsn;";
        $result = mysqli_query($conn, $query);
        $queryControl= mysqli_num_rows($result);
        if($queryControl>0){ 
        while($row = mysqli_fetch_assoc($result)){
             $third=$row['pName'];
             echo "<br>",$third;    
        }
        }else {
        echo "<br>", 'No table matched';
        }
    }
    if ($_POST["operation"]=='4') {
       $query = "select P.pName
                    from project_has_instructor P,Instructor I,activeinstructor AI
                    where I.ssn=AI.ssn and I.ssn=P.issn;";
        $result = mysqli_query($conn, $query);
        $queryControl= mysqli_num_rows($result);
        if($queryControl>0){ 
        while($row = mysqli_fetch_assoc($result)){
             $fourth=$row['pName'];
             echo "<br>",$fourth;    
        }
        }else {
        echo "<br>", 'No table matched';
        }
    }
    if ($_POST["operation"]=='5') {
       $query = "select S.ssn, S.studentname
                    from student S,Instructor I,activeinstructor AI
                    where I.ssn=AI.ssn and S.advisorSsn=I.ssn;";
        $result = mysqli_query($conn, $query);
        $queryControl= mysqli_num_rows($result);
        if($queryControl>0){ 
        while($row = mysqli_fetch_assoc($result)){
             $fifth=$row['ssn'].",".$row['studentname'];
             echo "<br>",$fifth;    
        }
        }else {
        echo "<br>", 'No table matched';
        }
    }
    if ($_POST["operation"]=='6') {
       $query = "select G.ssn
                    from gradstudent G, instructor I,activeinstructor AI
                    where I.ssn=AI.ssn and I.ssn=G.supervisorSsn;";
        $result = mysqli_query($conn, $query);
        $queryControl= mysqli_num_rows($result);
        if($queryControl>0){ 
        while($row = mysqli_fetch_assoc($result)){
             $sixth=$row['ssn'];
             echo "<br>",$sixth;    
        }
        }else {
        echo "<br>", 'No table matched';
        }
    }
    if ($_POST["operation"]=='7') {
       $query = "select T.dayy, T.hourr
                from timeslot T
                where (T.dayy, T.hourr) not in (select W.dayy, W.hourr
                                                from enrollment E NATURAL JOIN weeklyschedule W
                                                where E.sssn in (select E2.sssn
								from enrollment E2,weeklyschedule W,activeinstructor AC
								where E2.sssn = E.sssn and E2.issn=AC.ssn and W.courseCode=E2.courseCode));";
        $result = mysqli_query($conn, $query);
        $queryControl= mysqli_num_rows($result);
        if($queryControl>0){ 
        while($row = mysqli_fetch_assoc($result)){
             $seventh=$row['dayy'].",".$row['hourr'];
             echo "<br>",$seventh;    
        }
        }else {
        echo "<br>", 'No table matched';
        }
    }
    }
    ?>
</body>
</html>
