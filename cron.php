<?php

$servername = "localhost";
$username ="mtgonline";
$password = "Mtgonline#121";
$dbname = "perfex_crm2";
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT id, dob FROM tblcontacts";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);


$currentDate = date('Y-m-d');
foreach ($rows as &$person) 
{
    $dob = $person['dob'];
    if ($dob == '0000-00-00') 
    {
        continue;
    }
    $dobDateTime = new DateTime($dob);
    $currentDateTime = new DateTime($currentDate);
    $ageInterval = $currentDateTime->diff($dobDateTime);
    $person['age'] = $ageInterval->y;
}

foreach ($rows as $person) 
{
    $id = $person['id'];
   
    if (isset($person['age'])) 
    {
      
        $age = $person['age'];
        $sqlUpdate = "UPDATE tblcontacts SET age = $age WHERE id = $id";
        $conn->query($sqlUpdate);
    }
   
    $conn->query($sqlUpdate);
}


$conn->close();
?>