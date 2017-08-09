<?php 
error_reporting(0);
require("koneksi.php");

//array utk menampung respon dari JSON
$response = array();

//cek apakah nilai yang dikirimkan android sudah terisi
if(empty($_POST['username']) || empty ($_POST['password']) || empty ($_POST['nama']) || empty ($_POST['alamat']) || empty ($_POST['telpon']) || empty ($_POST['jenis_kelamin'])){
	
	//jika data tidak terisi/tidak terseret
		$response["success"]=0;
		$response["message"]="Pastikan semua data terisi.";
	
	// memprint/mencetak JSON respon
		echo json_encode($response);
		}else{
			$nama = $_POST['nama'];
			$alamat = $_POST['alamat'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$telpon = $_POST['telpon'];
			$username = $_POST['username'];
			$password = $_POST['password'];
	
	$cek_email = mysql_query("SELECT * FROM member WHERE username ='$username'");

		if(mysql_num_rows($cek_email)>0){
		//jika email telah terdaftar
			$response["success"]= 0;
			$response["message"]="Email sudah pernah terdaftar.";
			
		// memprint/mencetak JSON respon
			echo json_encode($response);
		}

		if(mysql_num_rows($cek_email)==0){
		
		//query untuk menambah data member
		$result = mysql_query("INSERT INTO member(nama,  alamat, telpon, jenis_kelamin, username, password)VALUES('$nama','$alamat','$jenis_kelamin','$telpon','$username','$password')");
		
		if($result){
			//jika berhasil menambah data member ke mysql
				$response["success"]=1;
				$response["message"]="Berhasil menambah data member.";
				
				//memprint/mencetak JSON respon
				echo json_encode($response);
			}else{
				//bila gagal menambah data member
				$response["success"]=0;
				$response["message"]="Gagal menambah data.";
				//memprint/mencetak JSON respon
				echo json_encode($response);
				}
			}
		}
?>