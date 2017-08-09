<?php 
error_reporting(0);
require("koneksi.php");

//array utk menampung respon dari JSON
$response = array();

//cek apakah nilai yang dikirimkan android sudah terisi
if(empty($_POST['idjadwal'])  || empty ($_POST['nama'])  || empty($_POST['telpon']) || empty($_POST['qty'])|| empty($_POST['status'])|| empty ($_POST['total'])|| empty ($_POST['username'])|| empty ($_POST['seat'])){
	
	//jika data tidak terisi/tidak terseret
		$response["success"]=0;
		$response["message"]="Data belum tersetting dengan benar.";
	
	// memprint/mencetak JSON respon
		echo json_encode($response);
		}else{
			$seat = mysql_query("SELECT * FROM jadwal WHERE id='$_POST[idjadwal]'");
			if (mysql_num_rows($seat)>0) {
				$qty_seat=$_POST['qty'];
				$sisa_seat=$_POST['seat'];

				if ($qty_seat > $sisa_seat) {
					$response["success"]= 0;
					$response["message"]="Jumlah beli kursi tidak boleh lebih besar dari seat yang tersedia";
					echo json_encode($response);
				}else{
					$telpon = $_POST['telpon'];
					$qty = $_POST['qty'];
					$status = $_POST['status'];
					$total = $_POST['total'];
					$tanggal = $_POST['tanggal'];
					$username = $_POST['username'];	

					//query menambah data member
					$result = mysql_query("INSERT INTO data_pesanan(idjadwal,nama, telpon, qty, status, total, tanggal_pesan,id_member)VALUES('$idjadwal',$nama','$telpon','$qty','$status','$total','$tanggal','$username')");

					//cek apakah query berhasil menambah data
					if($result){
					//jika berhasil menambah data member ke mysql
					$response["success"]=1;
					$response["message"]="Berhasil menambah data pesanan.";
				
					//memprint/mencetak JSON respon
					echo json_encode($response);
				}else{
					//bila gagal menambah data member
					$response["success"]=0;
					$response["message"]="Gagal menambah data pesan.";
					
					//memprint/mencetak JSON respon
					echo json_encode($response);	
				}
			}
		}
	}
?>