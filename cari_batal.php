<?php 
require("koneksi.php");

//array utk menampung respon dari JSON
$response = array();

//cek apakah nilai yang dikirimkan android sudah terisi
if (isset($_POST['id'])&&isset($_POST['nama']&&isset($_POST['username'])) {
	
	$asal =$_POST['id'];
	$tujuan =$_POST['nama'];
	$tanggal =$_POST['username'];

	//query ambil dtaa member berdasarkan id
	$result= mysql_query("SELECT * FROM jadwal WHERE id_member='$username' AND id='$id' AND nama='$nama'");

	if(!empty($result)){
		if (mysql_num_rows($result)>0) {
			//bila sukses
			$response["success"]=1;
			$response["message"]="Pencarian ID berhasi";

		//mencetak JSON respon
			echo json_encode($response);
		}if (mysql_num_rows($result)==0) {
			//gagal update data
		}{
			//bila tidak ada member(nilai lbh kecil dari nol)
			$response["success"]=0;         
			$response["message"]="ID yang anda cari tidak ditemukan, atau anda tidak pernah memesan dengan ID tersebut.";

			//mencetak JSON respon
			echo json_encode($response);
			}
		}
	}
?>