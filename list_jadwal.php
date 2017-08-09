<?php 
error_reporting(0);
require("koneksi.php");

//array utk menampung respon dari JSON
$response = array();

//cek apakah nilai yang dikirimkan android sudah terisi
if (isset($_POST['id_asal'])&&isset($_POST['id_tujuan'])&&isset($_POST['tanggal'])) {
	$asal =$_POST['id_asal'];
	$tujuan =$_POST['id_tujuan'];
	$tanggal =$_POST['tanggal'];

	//query ambil dtaa member berdasarkan id
	$result= mysql_query("SELECT * FROM jadwal WHERE kota_asal='$asal' AND kota_tujuan='$tujuan' AND tanggal_berangkat='$tanggal'")or die(mysql_error());

	if(!empty($result)){
	//jika data jadwal ada(ada nilai atau lebih besar dr nol)
		if (mysql_num_rows($result)>0) {
			//node jadwal
			$response["jadwal"]=array();
			while ($row= mysql_fetch_array(result)) {
				$seat= mysql_query("SELECT sum(qty) as total FROM data_pemesanan WHERE id_jadwal=$row[id]");
				$hasil= mysql_fetch_array($seat);
				$jumlah = $hasil["total"];
				$sisa_seat = $row["seat"]-$jumlah;

				//temp jadwal array
				$jadwal = array();
				$jadwal["id"]= $row["id"];
				$jadwal["asal"]= $row["asal"];
				$jadwal["tujuan"]= $row["kota_tujuan"];
				$jadwal["tanggal"]= $row["tanggal_berangkat"];
				$jadwal["berangkat"]= $row["jam_berangkat"];
				$jadwal["harga"]= $row["harga"];
				$jadwal["seat"]= $sisa_seat;

				//tambahkan array $jadwal pd array final $respon
				array_push($response["jadwal"], $jadwal);
			}
			//bila berhasil 
			$response["sukses"]=1;

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
			$response["pesan"]="data JSON tidak terkirim";
			
			//mencetak JSON respon
			echo json_encode($response);
		}
?>