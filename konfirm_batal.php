<?php 
error_reporting(0);
require("koneksi.php");

//array utk menampung respon dari JSON
$respon = array();

//cek apakah nilai yang dikirimkan android sudah terisi
if (isset($_GET['username'])&&isset($_GET['id']&&isset($_GET['nama'])) {
	$username =$_GET['username'];
	$id =$_GET['id'];
	$nama =$_GET['nama'];

	//query ambil dtaa member berdasarkan id
	$result= mysql_query("SELECT dp.*, j.id, j.kota_asal,j.kota_tujuan,j.tanggal_berangkat FROM data_pemesanan AS dp,jadwal as j WHERE dp.id_member='$username' AND dp.id='$id' AND dp.nama='$nama' AND j.id = dp.id_jadwal");

	if(!empty($result)){
		if (mysql_num_rows($result)>0) {
			//utk node batal
			$respons["batal"]=array();
			$row = mysql_fetch_array($result);
			
			$batal = array();
			$batal["id"] = $_GET["id"];
			$batal["asal"]= $row["kota_asal"];
			$batal["tujuan"]= $row["kota_tujuan"];
			$batal["tanggal"]= $row["tanggal_berangkat"];
			$batal["total"]= $row["total"];
			$batal["jumlah"]= $row["qty"];
			$batal["status"]= $row["status"];

			//tambahkan array $jadwal pada array finsl $respon
			array_push($respon["batal"], $batal);

			//sukses
			$respon["sukses"]=1;
			$respon["pesan"]="Pembatalan Pesanan selesai dilakukan"

			//memprint/mencetak JSON respon
				echo json_encode($respon);
		}else{
			//tidak ada member(kecil dari nol)
				$respon["sukses"]=0;
				$respon["pesan"]="Error Pembatalan";

			//memprint/mencetak JSON respon
				echo json_encode($respon);
			}
		}else{
			//tidak ada member(kecil dari nol)
				$respon["sukses"]=0;
				$respon["pesan"]="Gagal Query";
		//mencetak JSON respon
			echo json_encode($respon);
		   }
		}else{
			//bila tidak ada member(nilai lbh kecil dari nol)
			$respon["success"]=0;         
			$respon["message"]="Data belum terisi.";

			//mencetak JSON respon
			echo json_encode($respon);
		}

?>