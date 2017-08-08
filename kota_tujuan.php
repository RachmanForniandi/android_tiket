<?php 
error_reporting(0);
require("koneksi.php");

////////////////////Script Kota Tujuan//////////////////
//array utk menampung respon dari JSON
$response = array();
$response["asal"]=array();

//Mysql select query
$result= mysql_query("SELECT*FROM kota_tujuan");

while($row = mysql_fetch_array($result)){
	//temporary array to create tujuan
		$tmp = array();
		$tmp["id"]= $row["id"];
		$tmp["kota"]= $row["kota"];
	
	//push category to final json array
		array_push($response["tujuan"], $tmp);
	}
	
	//agar respon header ke json
	header('Content-Type: application/json');
	
	//menampilkan hasil json
	echo json_encode($response);
	
?>