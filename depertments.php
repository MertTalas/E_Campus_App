<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Departments Info</title>
    </head>
    <body>
        <?php
        include("dbconnect.php");
        $query = "select distinct D.buildingName,D.dName
                    from department D;";
        $result = mysqli_query($conn, $query);
        $queryControl = mysqli_num_rows($result);
        ?>
        <table border="2" cellspacing="2" cellpadding="2">
            <tr>
                <th><font face="Arial,Helvetica,sans-serif">Building</font></th>
                <th><font face="Arial,Helvetica,sans-serif">Department Name</font></th>
            </tr>
            <?php
            echo "<h4>ALL DEPARTMENTS</h4>";
            $i = 0;
            while ($i < $queryControl) {
                $row = mysqli_fetch_assoc($result);
                $bname = $row['buildingName'];
                $dname = $row['dName'];
                ?>
                <tr>
                    <td><font face="Arial, Helvetica, sans-serif">
                        <?php echo $bname; ?>
                        </font></td>
                    <td><font face="Arial, Helvetica, sans-serif">
                        <?php echo $dname; ?>
                        </font></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
    </body>
</html>