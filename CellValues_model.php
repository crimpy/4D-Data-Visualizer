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
//echo 'Connected successfully'; 

$phaseIndex = (($Row-1) * 36) + $Col;
$Cell = (1476 * ($Lay - 1)) + $phaseIndex;
$value = $Lay;  //the lift value

$phaseVal = 'SELECT  `PhaseID` FROM  `PhaseID` WHERE XVal = '. $Col .  '  AND YVal ='. $Row . ';';
$AuVal = 'SELECT `dat`.'. $temp . ' FROM dat WHERE Cell=' . $Cell .';';
$moistVal = 'SELECT ROUND(Moisture.'. $temp . ',2) FROM Moisture WHERE Moisture.Cell=' . $Cell . '; ';
$cellThickVal = 'SELECT ROUND(CellThickness.CellThickness,1) FROM CellThickness WHERE CellThickness.Cell=' . $Cell . '; ';
$AuIntVal = 'SELECT ROUND(Inventory.Inventory,2) FROM Inventory WHERE Inventory.Cell=' . $Cell . ';';
$slnRatioVal = 'SELECT ROUND(Solution.Solution,2) FROM Solution WHERE Solution.Cell=' . $Cell . '; ';
$kPrimeVal = 'SELECT ROUND(KPrime.KPrime,2) FROM KPrime WHERE KPrime.Cell=' . $Cell . '; ';

$phaseRes  = mysqli_query($conn,$phaseVal)     or die(mysqli_error()); 
$qVal1 = mysqli_fetch_array($phaseRes);

$AuRes     = mysqli_query($conn,$AuVal)        or die(mysqli_error()); 
$qVal2 = mysqli_fetch_array($AuRes); 

$moistRes  = mysqli_query($conn,$moistVal)     or die(mysqli_error()); 
$qVal3 = mysqli_fetch_array($moistRes); 

$cellRes   = mysqli_query($conn,$cellThickVal) or die(mysqli_error()); 
$qVal4 = mysqli_fetch_array($cellRes); 

$AuIntRes  = mysqli_query($conn,$AuIntVal)     or die(mysqli_error()); 
$qVal5 = mysqli_fetch_array($AuIntRes); 

$slnRes    = mysqli_query($conn,$slnRatioVal)       or die(mysqli_error()); 
$qVal6 = mysqli_fetch_array($slnRes); 

$kPrimeRes = mysqli_query($conn,$kPrimeVal)    or die(mysqli_error()); 
$qVal7 = mysqli_fetch_array($kPrimeRes); 

echo 'Col: ' . $Col . ' Row: ' . $Row .  ' Lift: ' . $Lay . '<br>Phase:  ' . $qVal1[0] . ' <br>Au Rec.%: ' . $qVal2[0] . '<br> Moist. %: ' . $qVal3[0] . '<br> Cell Thickness(ft): ' . $qVal4[0] . '<br> Au Inv. tr.oz : ' .  $qVal5[0] . '<br> Soln. Ratio: ' . $qVal6[0] . '<br> Extraction kPrime: ' . $qVal7[0];

mysqli_close($conn);
?>
</head>

<body>
</body>
</html>