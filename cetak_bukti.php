<?php 
error_reporting(0);
require("koneksi.php");

//array utk menampung respon dari JSON
$respon = array();

//cek apakah nilai yang dikirimkan android sudah terisi
if (isset($_POST['username'])) {
	$username =$_POST['username'];

	//query ambil dtaa member berdasarkan id
	$result= mysql_query("SELECT * FROM data_pemesanan WHERE id_member='$username' AND status='Lunas'");

	if(!empty($result)){
		//bila data jadwal ada(nilai lbh dari nol)
		if (mysql_num_rows($result)>0) {
			//utk node jadwal
			$respon["cetak"]=array();
			while($row = mysql_fetch_array($result)){
			
			//temp jadwal array
			$status = array();
			$cetak["id"] = $row["id"];

		//tambahkan array $jadwal pada array finsl $respon
			array_push($respon["cetak"], $cetak);	
		//sukses
			$respon["sukses"]=1;

		//memprint/mencetak JSON respon
			echo json_encode($respon);
		}else{
		//tidak ada member(kecil dari nol)
			$respon["sukses"]=0;
			$respon["pesan"]="Tidak ada data pesanan";

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
			$respon["sukses"]=0;         
			$respon["pesan"]="Data JSON tidak terkirim.";

		//mencetak JSON respon
			echo json_encode($respon);
		}

?>