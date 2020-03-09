<?php
//database configuration
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'tchouatchoumlaup';
$dbName = 'precontAI';

//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

//get search term
$searchTerm = $_GET['term'];

//aaaaaaaaaa
$arr = explode(' ',  $searchTerm);
$request= "  (noms_ayant_droit LIKE '%".$arr[0]."%')";
for ($i=1; $i<sizeof($arr); $i++) {
    $request= $request." and noms_ayant_droit LIKE '%".$arr[$i]."%' ";
}

//get matched data from the table
$query = $db->query("SELECT noms_ayant_droit FROM reversion WHERE ".$request." ORDER BY  noms_ayant_droit ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['noms_ayant_droit'];
}

//return json data
echo json_encode($data);
?>
