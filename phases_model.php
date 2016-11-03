<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php
// Create connection

$conn = mysqli_connect('packertestcom.fatcowmysql.com', 'dbuser', 'hlove123', 'model');  
if (!$conn) { 
    die('Could not connect: ' . mysqli_error()); 
} 
echo 'Connected successfully'; 

$text = 'SELECT PhaseID.PhaseID FROM PhaseID GROUP BY PhaseID.PhaseID;';

 $result = mysqli_query($conn,$text) or die(mysqli_error()); 

$row = mysqli_fetch_array( $result );

echo "<select name='phaseDrop'>";
 while($row = mysqli_fetch_array($result)) {
    echo "<option value='`" . $row['PhaseID'] . "`'>" . $row['PhaseID'] . "</option>";
}
echo "</select>";	 

mysqli_close($conn);
?>
</head>

<body>
</body>
</html>