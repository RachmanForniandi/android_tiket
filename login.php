<?php 
require("koneksi.php");

//array utk menampung respon dari JSON
$response = array();

//cek apakah nilai yang dikirimkan android sudah terisi
if(isset($_POST['username']) && isset ($_POST['password'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	//query update bedasarkan id
	$result = mysql_query("SELECT * FROM member WHERE username ='$username' AND password='$password'");
	
	if(!empty($result)){
		if(mysql_num_rows($result)>0){
			//jika sukses login
			$response["success"]= 1;
			$response["message"]="Login Berhasil.";
			
		// memprint/mencetak JSON respon
		echo json_encode($response);
		}
			if(mysql_num_rows($result)==0){
				//gagal update data
				$response["success"]=0;
				$response["message"]="gagal login, username atau password salah atau belum terisi.";
				
				//memprint/mencetak JSON respon
				echo json_encode($response);
		}
	}
}
	
?>