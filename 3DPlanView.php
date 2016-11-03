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
$DBVal= "dat";

$text = 'Select '. $DBVal . '.YVal, round(sum(if('. $DBVal . '.XVal=1,' . $step . ',null))*100,2) as fubar1,  round(sum(if('. $DBVal . '.XVal=2,' . $step . ',null))*100,2) as fubar2, round(sum(if('. $DBVal . '.XVal=3,' . $step . ',null))*100,2) as fubar3, round(sum(if('. $DBVal . '.XVal=4,' . $step . ',null))*100,2) as fubar4, round(sum(if('. $DBVal . '.XVal=5,'. $step . ',null))*100,2) as fubar5, round(sum(if('. $DBVal . '.XVal=6,' . $step . ',null))*100,2) as fubar6, round(sum(if('. $DBVal . '.XVal=7,'. $step . ',null))*100,2) as fubar7, round(sum(if('. $DBVal . '.XVal=8,' . $step . ',null))*100,2) as fubar8, round(sum(if('. $DBVal . '.XVal=9,'. $step . ',null))*100,2) as fubar9, round(sum(if('. $DBVal . '.XVal=10,' . $step . ',null))*100,2) as fubar10,  round(sum(if('. $DBVal . '.XVal=11,'. $step . ',null))*100,2) as fubar11,  round(sum(if('. $DBVal . '.XVal=12,' . $step . ',null))*100,2) as fubar12, round(sum(if('. $DBVal . '.XVal=13,'. $step . ',null))*100,2) as fubar13, round(sum(if('. $DBVal . '.XVal=14,' . $step . ',null))*100,2) as fubar14, round(sum(if('. $DBVal . '.XVal=15,'. $step . ',null))*100,2) as fubar15, round(sum(if('. $DBVal . '.XVal=16,' . $step . ',null))*100,2) as fubar16, round(sum(if('. $DBVal . '.XVal=17,'. $step . ',null))*100,2) as fubar17, round(sum(if('. $DBVal . '.XVal=18,' . $step . ',null))*100,2) as fubar18, round(sum(if('. $DBVal . '.XVal=19,'. $step . ',null))*100,2) as fubar19, round(sum(if('. $DBVal . '.XVal=20,' . $step . ',null))*100,2) as fubar20, round(sum(if('. $DBVal . '.XVal=21,'. $step . ',null))*100,2) as fubar21, round(sum(if('. $DBVal . '.XVal=22,' . $step . ',null))*100,2) as fubar22, round(sum(if('. $DBVal . '.XVal=23,'. $step . ',null))*100,2) as fubar23, round(sum(if('. $DBVal . '.XVal=24,' . $step . ',null))*100,2) as fubar24, round(sum(if('. $DBVal . '.XVal=25,'. $step . ',null))*100,2) as fubar25, round(sum(if('. $DBVal . '.XVal=26,' . $step . ',null))*100,2) as fubar26, round(sum(if('. $DBVal . '.XVal=27,'. $step . ',null))*100,2) as fubar27, round(sum(if('. $DBVal . '.XVal=28,' . $step . ',null))*100,2) as fubar28, round(sum(if('. $DBVal . '.XVal=29,'. $step . ',null))*100,2) as fubar29, round(sum(if('. $DBVal . '.XVal=30,' . $step . ',null))*100,2) as fubar30, round(sum(if('. $DBVal . '.XVal=31,'. $step . ',null))*100,2) as fubar31, round(sum(if('. $DBVal . '.XVal=32,' . $step . ',null))*100,2) as fubar32, round(sum(if('. $DBVal . '.XVal=33,'. $step . ',null))*100,2) as fubar33, round(sum(if('. $DBVal . '.XVal=34,' . $step . ',null))*100,2) as fubar34, round(sum(if('. $DBVal . '.XVal=35,'. $step . ',null))*100,2) as fubar35, round(sum(if('. $DBVal . '.XVal=36,' . $step . ',null))*100,2) as fubar36 from '. $DBVal .' where '. $DBVal .'.lift= '. $lift .' group by '. $DBVal .'.YVal ORDER BY  '. $DBVal .'.YVal DESC;';

//echo $text;

$result = mysqli_query($conn,$text) or die(mysqli_error()); 

$row = mysqli_fetch_array( $result );

$result->bind_result($id, $value);
while ($result->fetch()) {
    $ray[$id][] = $value;
}

echo $ray;
echo "<table border='1'>";

 while($row = mysqli_fetch_array($result)) {
   echo "<tr>";
   echo "<td>" . $row['fubar1'] . "</td>";
   echo "<td>" . $row['fubar2'] . "</td>";
   echo "<td>" . $row['fubar3'] . "</td>";
   echo "<td>" . $row['fubar4'] . "</td>";
   echo "<td>" . $row['fubar5'] . "</td>";
   echo "<td>" . $row['fubar6'] . "</td>";
   echo "<td>" . $row['fubar7'] . "</td>";
   echo "<td>" . $row['fubar8'] . "</td>";
   echo "<td>" . $row['fubar9'] . "</td>";
   echo "<td>" . $row['fubar10'] . "</td>";
   echo "<td>" . $row['fubar11'] . "</td>";
   echo "<td>" . $row['fubar12'] . "</td>";
   echo "<td>" . $row['fubar13'] . "</td>";
   echo "<td>" . $row['fubar14'] . "</td>";
   echo "<td>" . $row['fubar15'] . "</td>";
   echo "<td>" . $row['fubar16'] . "</td>";
   echo "<td>" . $row['fubar17'] . "</td>";
   echo "<td>" . $row['fubar18'] . "</td>";
   echo "<td>" . $row['fubar19'] . "</td>";
   echo "<td>" . $row['fubar20'] . "</td>";
   echo "<td>" . $row['fubar21'] . "</td>";
   echo "<td>" . $row['fubar22'] . "</td>";
   echo "<td>" . $row['fubar23'] . "</td>";
   echo "<td>" . $row['fubar24'] . "</td>";
   echo "<td>" . $row['fubar25'] . "</td>";
   echo "<td>" . $row['fubar26'] . "</td>";
   echo "<td>" . $row['fubar27'] . "</td>";
   echo "<td>" . $row['fubar28'] . "</td>";
   echo "<td>" . $row['fubar29'] . "</td>";
   echo "<td>" . $row['fubar30'] . "</td>";
   echo "<td>" . $row['fubar31'] . "</td>";
   echo "<td>" . $row['fubar32'] . "</td>";
   echo "<td>" . $row['fubar33'] . "</td>";
   echo "<td>" . $row['fubar34'] . "</td>";
   echo "<td>" . $row['fubar35'] . "</td>";
   echo "<td>" . $row['fubar36'] . "</td>";
   echo "</tr>";
 }

echo "</table>";

mysqli_close($conn);
?>
</head>

<body>
</body>
</html>