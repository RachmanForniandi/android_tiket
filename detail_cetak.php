<?php 
error_reporting(0);
require("koneksi.php");

//array utk menampung respon dari JSON
$respon= array();

//cek apakah nilai yang dikirimkan android sudah terisi
if (isset($_GET['username'])&&isset($_GET['idjadwal'])) {
	$username =$_GET['username'];
	$id = $_GET['idjadwal'];

	//query ambil dtaa member berdasarkan id
	$result= mysql_query("SELECT dp.*, j.id, j.kota_asal, j.kota_tujuan, j.tanggal_berangkat, j.jam_berangkat, j.harga FROM data_pemesanan AS dp, jadwal AS j WHERE dp.id_member='$username' AND dp.id='$id' AND j.id=dp.id_jadwal");

	if(!empty($result)){
		//bila data jadwal ada(lbh besar dr nol)
		if (mysql_num_rows($result)>0) {
			//utk node batal
			$respon["cetak"]=array();
			$row = mysql_fetch_array($result);

			$cetak = array();
			$cetak["id"] = $_GET["idjadwal"];
			$cetak["nama"]= $row["nama"];
			$cetak["telpon"]= $row["telpon"];
			$cetak["asal"]= $row["kota_asal"];
			$cetak["tujuan"]= $row["kota_tujuan"];
			$cetak["tanggal_berangkat"]= $row["tanggal_berangkat"];
			$cetak["jam_berangkat"]= $row["jam_berangkat"];
			$cetak["tanggal"]= $row["tanggal_pesan"];
			$cetak["harga"]= $row["harga"];
			$cetak["total"]= $row["total"];
			$cetak["jumlah"]= $row["qty"];
			$cetak["status"]= $row["status"];

		//tambahkan array $jadwal pada array finsl $respon
			array_push($respon["cetak"], $cetak);	
		//sukses
			$respon["sukses"]=1;
			$respon["pesan"]="Cetak Pesanan selesai dilakukan";

		//memprint/mencetak JSON respon
			echo json_encode($respon);
		}else{
		//tidak ada member(kecil dari nol)
			$respon["sukses"]=0;
			$respon["pesan"]="Error dalam cetak bukti.";

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
			$respon["pesan"]="Data belum terisi.";

		//mencetak JSON respon
			echo json_encode($respon);
		}

?>