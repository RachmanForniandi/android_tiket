<?php 
error_reporting(0);
require("koneksi.php");

//array utk menampung respon dari JSON
$response = array();

//cek apakah nilai yang dikirimkan android sudah terisi
if (isset($_GET['username'])) {
	$username =$_GET['username'];


	//query ambil data member berdasarkan id
	$result= mysql_query("SELECT * FROM pesan WHERE id_member='$username' ORDER BY id DESC LIMIT 1");
	
	if(!empty($result)){
		//bila data jadwal ada(besar dari nol)
		if (mysql_num_rows($result)>0) {
			//node jadwal
			$response["selesai"]=array();
			$row = mysql_fetch_array($result);
			$selesai = array();
			$selesai["id"]=$row["id"];
			$selesai["nama"]=$row["nama"];
			$selesai["total"]=$row["total"];
			//tambahkan array $jadwal pada array final $respon
			array_push($respon["selesai"], $selesai);

			//sukses
			$respon["sukses"]=1;
			$respon["pesan"]="Pesanan selesai dilakukan"

			//memprint/mencetak JSON respon
				echo json_encode($respon);
		}else{
			//tidak ada member(kecil dari nol)
				$respon["sukses"]=0;
				$respon["pesan"]="Error Pesanan";

			//memprint/mencetak JSON respon
				echo json_encode($respon);
			}
		}else{
			//tidak ada member(kecil dari nol)
				$respon["sukses"]=0;
				$respon["pesan"]="Gagal Query";

			//memprint/mencetak JSON respon
				echo json_encode($respon);
			}
		}else{
			//bila data tidak terisi
				$respon["sukses"]=0;
				$respon["pesan"]="data belum terisi";
			//memprint/mencetak JSON respon
				echo json_encode($respon);

		}

?>