<?php 

//$conn= mysqli_connect("localhost", "root", "", "diskografija");
$conn= new mysqli("localhost", "root", "", "diskografija");
global $conn;
/*
if($conn){
	echo "<h1>USPJEH!!!</h1>";
}else{
	die("Greška");
}*/
mysqli_query($conn, "SET NAMES utf8");
if(!$conn){
    die("Greška konekcije: " . mysqli_connect_error());
}