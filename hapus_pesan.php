<?php 
error_reporting(0);
require("koneksi.php");

//array utk menampung respon dari JSON
$response = array();

//cek apakah nilai yang dikirimkan android sudah terisi
if (isset($_POST['id'])) {
	$id =$_POST['id'];

	//query ambil dtaa member berdasarkan id
	$result= mysql_query("DELETE FROM pesan WHERE id=$id");

	if(!empty($result)){
		if (mysql_affected_rows()>0) {
			//bila berhasil dihapus
			$response["sukses"]=1;
			$response["pesan"]="Pesanan berhasil dibatalkan";
			
			//memprint/mencetak JSON respon
				echo json_encode($respon);
		}else{
			//tidak ada member(kecil dari nol)
				$respon["sukses"]=0;
				$respon["pesan"]="Gagal dibatalkan";

			//memprint/mencetak JSON respon
				echo json_encode($respon);
			}
		}else{
			//bila data tidak terisi
			$response["success"]=0;         
			$response["pesan"]="Data belum terisi.";

			//mencetak JSON respon
			echo json_encode($response);
	}

?>