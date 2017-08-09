<?php 
error_reporting(0);
require("koneksi.php");

//array utk menampung respon dari JSON
$response = array();

//cek apakah nilai yang dikirimkan android sudah terisi
if (isset($_POST['id_asal']) && isset($_POST['id_tujuan'])) {
	$asal =$_POST['id_asal'];
	$tujuan =$_POST['id_tujuan'];
	$tanggal =$_POST['tanggal'];

	//query ambil dtaa member berdasarkan id
	$result= mysql_query("SELECT * FROM jadwal WHERE kota_asal='$asal' AND kota_tujuan='$tujuan' AND tanggal_berangkat='$tanggal'");

	if(!empty($result)){
	//jika data jadwal ada(ada nilai atau lebih besar dr nol)
		if (mysql_num_rows($result)>0) {
			//bila sukses
			$response["sukses"]=1;
			$response["pesan"]="Pencarian jadwal berhasi";

		//mencetak JSON respon
			echo json_encode($response);
		}else{
			//bila tidak ada member(nilai lbh kecil dari nol)
			$response["sukses"]=0;                               
			$response["pesan"]="Maaf, Tidak ada jadwal keberangkatan.";

			//mencetak JSON respon
			echo json_encode($response);
			}
		}else{
			//jika query tidak menampilkan data
			$response["sukses"]=0;
			$response["pesan"]="Query gagal";

			//mencetak JSON respon
			echo json_encode($response);
			}
		}else{
			//jika tidak ada data
			$response["sukses"]=0;
			$response["pesan"]="Belum ada data yang terisi";
			
			//mencetak JSON respon
			echo json_encode($response);
		}
?>