<?php 
//utk koneksi ke database
$dbhost ="localhost";
$dbuser ="root";
$dbpass="";
$dbname ="db_pemesanan";
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);
?>