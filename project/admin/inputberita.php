<?php
session_start();
include "../koneksi.php";
include "../admin/library.php";
	$lokasifile = $_FILES ['fupload'] ['tmpname'];
	$namafile = $_FILES ['fupload'] ['name'];
//apabila ada gambar yang diupload

	if (!empty($lokasifile)) {
		move_uploaded_file($lokasifile,"fotoberita/$namafile");
		mysql_query("insert into berita (judul, idkategori,isiberita,iduser,jam,tanggal,hari,gambar) 
			          values ('$_POST[judul]', '$_POST[kategori]','$_POST[isiberita]','$_Session[namauser]','$jamsekarang',
			          	'$tanggalsekarang','$harisekarang','$namafile')");


	}

	//apabila tidak ada gambar yang diupload
	else{
		mysql_query("insert into berita (judul,idkategori,isiberita,iduser,jam,tanggal,hari) values ('$_POST[judul]',
			          '$_POST[kategori]', '$_POST[isiberita]', '$_Session[namauser]', '$jamsekarang','$tanggalsekarang','$harisekarang')");

	}

		header('location:tampilberita.php');
?>
