<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
Define("host","localhost");
Define("Username", "root");
Define("Password", "");
Define("db", "Jalees");
$connection = mysqli_connect(host, Username, Password, db);
if(!$connection)
die();
if(isset($_POST['confirmChanges'])){
$id = $_POST['id'];
$kidsNames = $_POST['kidsNames'];
$kidsAges = $_POST['kidsAges'];
$type = $_POST['serviceType'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$query = "UPDATE jobRequests SET kidsNames = '$kidsNames', kidsAges = '$kidsAges', serviceType = '$type', startDate = '$startDate' ,endDate = '$endDate', startTime ='$startTime' , endTime = '$endTime' WHERE  ID = ".$id.";"; 

$result = mysqli_query($connection, $query);
}
$connection -> close();
?>