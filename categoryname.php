<?php
// ket noi db object oriented
$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = 'dath';
// ket noi db
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
$db -> set_charset("utf8");
// lay chuoi nhap tu script
$searchTerm = $_GET['term'];
$query = $db->query("SELECT * FROM tblhoachat WHERE TenHoaChat LIKE '%".$searchTerm."%'");
//Tao mang dl
$skillData = array();
if($query->num_rows > 0){
while($row = $query->fetch_assoc()){
$data['id'] = $row['id'];
$data['value'] = $row['TenHoaChat'];
array_push($skillData, $data);
}
}
// tra ve kq kieu result code
echo json_encode($skillData);
?>