<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
    <title>Student Operations</title>
</head>
<body>
    <h4>Choose your operation:</h4>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <select name="operation">
                <?php
                    echo "<option value='0'>","graduate student or not","\n"; 
                    echo "<option value='1'>","the course s/he is taking","\n"; 
                    echo "<option value='2'>","the grade report","\n"; 
                    echo "<option value='3'>","weekly schedule","\n"; 
                    echo "<option value='4'>","advisor","\n"; 
                    echo "<option value='5'>","the list of courses s/he is supposed to take","\n"; 
                    echo "<option value='6'>","the department s/he is studying","\n"; 
                    echo "<option value='7'>","supervisor the list of projects s/he is working","\n"; 
                ?>
            </select>
            <input type="submit" value="Get the form">
        </form>
    <?php
    include ("dbconnect.php"); 
    if(isset($_POST["operation"])){
    if ($_POST["operation"]=='0') {
        $query = "select S.gradorUgrad
                    from student S,activeStudent AC
                    where S.ssn=AC.ssn;";
        $result = mysqli_query($conn, $query);
        $queryControl= mysqli_num_rows($result);
        if($queryControl>0){ 
        while($row = mysqli_fetch_assoc($result)){
             $zero=$row['gradorUgrad'];
        }
        if($zero==0){
           echo "<br>",'you are ungrad student';
       }else{
           echo "<br>",'you are graduate student';
       }
    }
    }
    if ($_POST["operation"]=='1') {
        $query = "select C.courseCode
                    from curriculacourses C,student S,activeStudent AC
                    where S.dName=C.dName AND C.currCode=S.currCode AND AC.ssn=S.ssn;";
        $result = mysqli_query($conn, $query);
        $queryControl= mysqli_num_rows($result);
        if($queryControl>0){ 
        while($row = mysqli_fetch_assoc($result)){
             $first=$row['courseCode'];
             echo "<br>",$first;    
        }
        }else {
            echo "<br>", 'No table matched';
        }
    }
    if ($_POST["operation"]=='2') {
        $query = "select E.courseCode,E.grade
                    from enrollment E,student S,activeStudent AC
                    where S.ssn=E.sssn AND AC.ssn=S.ssn;;";
        $result = mysqli_query($conn, $query);
        $queryControl= mysqli_num_rows($result);
        echo '<br>'." courseCode,grade";
        if($queryControl>0){ 
        while($row = mysqli_fetch_assoc($result)){
             $second=$row['courseCode']." , ".$row['grade'];
             echo "<br>",$second;    
        }
        }else {
            echo "<br>", 'No table matched';
        }
    }
    if ($_POST["operation"]=='3') {
        $query = "select W.dayy,W.hourr,W.buildingName,W.roomNumber
                    from weeklyschedule W
                    where W.sectionId in (select E.sectionId
                                            from curriculacourses C,student S,enrollment E,activeStudent AC
                                            where (S.dName=C.dName AND C.currCode=S.currCode AND E.courseCode=C.courseCode AND AC.ssn=S.ssn));";
        $result = mysqli_query($conn, $query);
        $queryControl= mysqli_num_rows($result);
        if($queryControl>0){ 
        while($row = mysqli_fetch_assoc($result)){
             $third=$row['dayy']." , ".$row['hourr']." , ".$row['buildingName']." , ".$first=$row['roomNumber'];
             echo "<br>",$third;    
        }
        }else {
        echo "<br>", 'No table matched';
        }
    }
    if ($_POST["operation"]=='4') {
       $query = "select I.iname
                    from student S,instructor I,activeStudent AC
                    where S.advisorSsn=I.ssn AND AC.ssn=S.ssn;;";
        $result = mysqli_query($conn, $query);
        $queryControl= mysqli_num_rows($result);
        if($queryControl>0){ 
        while($row = mysqli_fetch_assoc($result)){
             $fourth=$row['iname'];
             echo "<br>",$fourth;    
        }
        }else {
        echo "<br>", 'No table matched';
        }
    }
    if ($_POST["operation"]=='5') {
       $query = "select C.courseCode
                    from  student S, curriculacourses C,activeStudent AC
                    where S.ssn=AC.ssn and S.currCode=C.currCode;";
        $result = mysqli_query($conn, $query);
        $queryControl= mysqli_num_rows($result);
        if($queryControl>0){ 
        while($row = mysqli_fetch_assoc($result)){
             $fifth=$row['courseCode'];
             echo "<br>",$fifth;    
        }
        }else {
        echo "<br>", 'No table matched';
        }
    }
    if ($_POST["operation"]=='6') {
       $query = "select S.dName
                   from student S,activeStudent AC
                   where S.ssn=AC.ssn;";
        $result = mysqli_query($conn, $query);
        $queryControl= mysqli_num_rows($result);
        if($queryControl>0){ 
        while($row = mysqli_fetch_assoc($result)){
             $sixth=$row['dName'];
             echo "<br>",$sixth;    
        }
        }else {
        echo "<br>", 'No table matched';
        }
    }
    if ($_POST["operation"]=='7') {
       $query = "select I.iname
                    from gradstudent G,instructor I,activeStudent AC
                    where G.ssn=AC.ssn and I.ssn=G.supervisorSsn";
        $result = mysqli_query($conn, $query);
        $queryControl= mysqli_num_rows($result);
        if($queryControl>0){ 
        while($row = mysqli_fetch_assoc($result)){
             $seventh=$row['iname'];
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
