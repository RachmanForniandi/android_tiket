<?php 
error_reporting(0);
require("koneksi.php");

//array utk menampung respon dari JSON
$respon = array();

//cek apakah nilai yang dikirimkan android sudah terisi
if (isset($_POST['username']])) {
	$username =$_POST['username'];

	//query ambil dtaa member berdasarkan id
	$result= mysql_query("SELECT dp.id AS idpesan,dp.total,dp.tanggal_pesan,dp.status, j.id, j.kota_asal, j.kota_tujuan FROM data_pemesanan AS dp, jadwal AS j WHERE dp.id_member='$username' AND dp.id_jadwal=j.id");

	if(!empty($result)){
		if (mysql_num_rows($result)>0) {
			//utk node jadwal
			$respon["status"]=array();
			while($row = mysql_fetch_array($result)){
			
			//temp jadwal array
			$status = array();
			$status["id"] = $row["idpesan"];
			$status["asal"]= $row["kota_asal"];
			$status["tujuan"]= $row["kota_tujuan"];
			$status["tanggal"]= $row["tanggal_pesan"];
			$status["total"]= $row["total"];
			$status["status"]= $row["status"];

		//tambahkan array $jadwal pada array finsl $respon
			array_push($respon["status"], $status);	
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
			echo json_encode($response);
		   }
		}else{
		//bila tidak ada member(nilai lbh kecil dari nol)
			$respon["sukses"]=0;         
			$respon["pesan"]="Data JSON tidak terkirim.";

		//mencetak JSON respon
			echo json_encode($respon);
		}

?>