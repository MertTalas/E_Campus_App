<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Projects Info</title>
    </head>
    <body>
        <?php
        include("dbconnect.php");
        $query = "select distinct P.pName,P.subject,P.startDate,P.enddate,P.controllingDName
                    from project P;";
        $result = mysqli_query($conn, $query);
        $queryControl = mysqli_num_rows($result);
        ?>
        <table border="2" cellspacing="2" cellpadding="2">
            <tr>
                <th><font face="Arial,Helvetica,sans-serif">Project Name</font></th>
                <th><font face="Arial,Helvetica,sans-serif">Subject</font></th>
                <th><font face="Arial,Helvetica,sans-serif">Start Date</font></th>
                <th><font face="Arial,Helvetica,sans-serif">End Date</font></th>
                <th><font face="Arial,Helvetica,sans-serif">Controlling by Department</font></th>
            </tr>
            <?php
            echo "<h4>ALL PROJECTS</h4>";
            $i = 0;
            while ($i < $queryControl) {
                $row = mysqli_fetch_assoc($result);
                $pname = $row['pName'];
                $sub = $row['subject'];
                $sdate = $row['startDate'];
                $edate = $row['enddate'];
                $cdep = $row['controllingDName'];
                ?>
                <tr>
                    <td><font face="Arial, Helvetica, sans-serif">
                        <?php echo $pname; ?>
                        </font></td>
                    <td><font face="Arial, Helvetica, sans-serif">
                        <?php echo $sub; ?>
                        </font></td>
                    <td><font face="Arial, Helvetica, sans-serif">
                        <?php echo $sdate; ?>
                        </font></td>
                    <td><font face="Arial, Helvetica, sans-serif">
                        <?php echo $edate; ?>
                        </font></td>
                    <td><font face="Arial, Helvetica, sans-serif">
                        <?php echo $cdep; ?>
                        </font></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
    </body>
</html>
