<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php
// Create connection

$conn = mysqli_connect('packertestcom.fatcowmysql.com', 'phpclient', '0r0g3n', 'modeloutput'); 
if (!$conn) { 
    die('Could not connect: ' . mysqli_error()); 
} 

$text = 'Select '. $DBVal . '.lift, 
round(sum(if('. $DBVal . '.yval=41, ' .$step . ' ,null))*1,2) as fubar41, round(sum(if('. $DBVal . '.yval=40, ' .$step . ' ,null))*1,2) as fubar40, round(sum(if('. $DBVal . '.yval=39, ' .$step . ' ,null))*1,2) as fubar39, round(sum(if('. $DBVal . '.yval=38, ' .$step . ' ,null))*1,2) as fubar38, round(sum(if('. $DBVal . '.yval=37, ' .$step . ' ,null))*1,2) as fubar37,
round(sum(if('. $DBVal . '.yval=36, ' .$step . ' ,null))*1,2) as fubar1, round(sum(if('. $DBVal . '.yval=35, ' .$step . ' ,null))*1,2) as fubar2, round(sum(if('. $DBVal . '.yval=34, ' .$step . ' ,null))*1,2) as fubar3, round(sum(if('. $DBVal . '.yval=33, ' .$step . ' ,null))*1,2) as fubar4, round(sum(if('. $DBVal . '.yval=32, ' .$step . ' ,null))*1,2) as fubar5, round(sum(if('. $DBVal . '.yval=31, ' .$step . ' ,null))*1,2) as fubar6, round(sum(if('. $DBVal . '.yval=30, ' .$step . ' ,null))*1,2) as fubar7, round(sum(if('. $DBVal . '.yval=29, ' .$step . ' ,null))*1,2) as fubar8, round(sum(if('. $DBVal . '.yval=28, ' .$step . ' ,null))*1,2) as fubar9, round(sum(if('. $DBVal . '.yval=27, ' .$step . ' ,null))*1,2) as fubar10,
round(sum(if('. $DBVal . '.yval=26, ' .$step . ' ,null))*1,2) as fubar11, round(sum(if('. $DBVal . '.yval=25, ' .$step . ' ,null))*1,2) as fubar12, round(sum(if('. $DBVal . '.yval=24, ' .$step . ' ,null))*1,2) as fubar13, round(sum(if('. $DBVal . '.yval=23, ' .$step . ' ,null))*1,2) as fubar14, round(sum(if('. $DBVal . '.yval=22, ' .$step . ' ,null))*1,2) as fubar15,
round(sum(if('. $DBVal . '.yval=21, ' .$step . ' ,null))*1,2) as fubar16, round(sum(if('. $DBVal . '.yval=20, ' .$step . ' ,null))*1,2) as fubar17, round(sum(if('. $DBVal . '.yval=19, ' .$step . ' ,null))*1,2) as fubar18, round(sum(if('. $DBVal . '.yval=18, ' .$step . ' ,null))*1,2) as fubar19, round(sum(if('. $DBVal . '.yval=17, ' .$step . ' ,null))*1,2) as fubar20,
round(sum(if('. $DBVal . '.yval=16, ' .$step . ' ,null))*1,2) as fubar21, round(sum(if('. $DBVal . '.yval=15, ' .$step . ' ,null))*1,2) as fubar22, round(sum(if('. $DBVal . '.yval=14, ' .$step . ' ,null))*1,2) as fubar23, round(sum(if('. $DBVal . '.yval=13, ' .$step . ' ,null))*1,2) as fubar24, round(sum(if('. $DBVal . '.yval=12, ' .$step . ' ,null))*1,2) as fubar25,
round(sum(if('. $DBVal . '.yval=11, ' .$step . ' ,null))*1,2) as fubar26, round(sum(if('. $DBVal . '.yval=10, ' .$step . ' ,null))*1,2) as fubar27, round(sum(if('. $DBVal . '.yval=9, ' .$step . ' ,null))*1,2) as fubar28, round(sum(if('. $DBVal . '.yval=8, ' .$step . ' ,null))*1,2) as fubar29, round(sum(if('. $DBVal . '.yval=7, ' .$step . ' ,null))*1,2) as fubar30,
round(sum(if('. $DBVal . '.yval=6, ' .$step . ' ,null))*1,2) as fubar31,
round(sum(if('. $DBVal . '.yval=5, ' .$step . ' ,null))*1,2) as fubar32, round(sum(if('. $DBVal . '.yval=4, ' .$step . ' ,null))*1,2) as fubar33, round(sum(if('. $DBVal . '.yval=3, ' .$step . ' ,null))*1,2) as fubar34, round(sum(if('. $DBVal . '.yval=2, ' .$step . ' ,null))*1,2) as fubar35,
round(sum(if('. $DBVal . '.yval=1, ' .$step . ' ,null))*1,2) as fubar36
from '. $DBVal . ' where '. $DBVal . '.XVal= ' .$lift . ' group by '. $DBVal . '.lift, '. $DBVal . '.XVal ORDER BY '. $DBVal . '.lift DESC;';

 $result = mysqli_query($conn,$text) or die(mysqli_error()); 
 
$row = mysqli_fetch_array( $result );

echo "<table border='1'>";

 while($row = mysqli_fetch_array($result)) {
   echo "<tr>";
   echo "<td>" . $row[1] . "</td>";
   echo "<td>" . $row[2] . "</td>";
   echo "<td>" . $row[3] . "</td>";
   echo "<td>" . $row[4] . "</td>";
   echo "<td>" . $row[5] . "</td>";
   echo "<td>" . $row[6] . "</td>";
   echo "<td>" . $row[7] . "</td>";
   echo "<td>" . $row[8] . "</td>";
   echo "<td>" . $row[9] . "</td>";
   echo "<td>" . $row[10] . "</td>";
   echo "<td>" . $row[11] . "</td>";
   echo "<td>" . $row[12] . "</td>";
   echo "<td>" . $row[13] . "</td>";
   echo "<td>" . $row[14] . "</td>";
   echo "<td>" . $row[15] . "</td>";
   echo "<td>" . $row[16] . "</td>";
   echo "<td>" . $row[17] . "</td>";
   echo "<td>" . $row[18] . "</td>";
   echo "<td>" . $row[19] . "</td>";
   echo "<td>" . $row[20] . "</td>";
   echo "<td>" . $row[21] . "</td>";
   echo "<td>" . $row[22] . "</td>";
   echo "<td>" . $row[23] . "</td>";
   echo "<td>" . $row[24] . "</td>";
   echo "<td>" . $row[25] . "</td>";
   echo "<td>" . $row[26] . "</td>";
   echo "<td>" . $row[27] . "</td>";
   echo "<td>" . $row[28] . "</td>";
   echo "<td>" . $row[29] . "</td>";
   echo "<td>" . $row[30] . "</td>";
   echo "<td>" . $row[31] . "</td>";
   echo "<td>" . $row[32] . "</td>";
   echo "<td>" . $row[33] . "</td>";
   echo "<td>" . $row[34] . "</td>";
   echo "<td>" . $row[35] . "</td>";
   echo "<td>" . $row[36] . "</td>";
   echo "<td>" . $row[37] . "</td>";
   echo "<td>" . $row[38] . "</td>";
   echo "<td>" . $row[39] . "</td>";
   echo "<td>" . $row[40] . "</td>";
   echo "<td>" . $row[41] . "</td>";   
   echo "</tr>";
 }

echo "</table>";

mysqli_close($conn);
?>
</head>

<body>
</body>
</html>
