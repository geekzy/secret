		define('FPDF_FONTPATH','fpdf/font/');
		require('fpdf/fpdf.php');
		$pdf=new FPDF('P','mm','A4');
		$pdf->Open();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(180,7,'LAMPIRAN 566 II','T',0,'R');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'LAMPIRAN PERATURAN MENTERI KESEHATAN RI','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(30,7,'NOMOR','',0,'L');$pdf->cell(100,7,' : 1184/MENKES/PER/X/2004','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(30,7,'TANGGAL','',0,'L');$pdf->Cell(100,7,' : 19 Oktober 2004','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(180,7,'','B',0,'C');
		$pdf->Ln(10);
		$sqlx = "
		SELECT
		sp.id_sp,
		sp.nomor_surat,
		sp.lampiran_surat,
		sp.date_surat,
		st.nomor_surat as nomor_surat_tambahan,
		st.lampiran_surat as lampiran_surat_tambahan,
		st.date_surat as date_surat_tambahan,
		st.alat,
		pendaftar.nama_pabrik,
		pendaftar.alamat_pabrik,
		sp.nama,
		sp.nip,
		sp.insert_by,
		sp.date_insert
		FROM ".$GLOBALS[my_table]." sp
		LEFT OUTER JOIN ".$GLOBALS[my_cek]." cek ON (cek.id_cek_1 = sp.id_cek_1)
		LEFT OUTER JOIN ".$GLOBALS[my_tt]." tt ON (tt.no_tt = cek.no_tt)
		LEFT OUTER JOIN ".$GLOBALS[my_pendaftar]." pendaftar ON (pendaftar.kode_pendaftar = tt.kode_pendaftar)
		LEFT OUTER JOIN ".$GLOBALS[my_st]." st ON(st.kepada_surat = sp.id_cek_1)
		WHERE
			sp.id_sp ='".$_GET['id_sp']."'
		";
		//print $sqlx;

		$rsx = $adodb->Execute($sqlx);
		$nomor_surat = $rsx->fields['nomor_surat'];
		$lampiran_surat = $rsx->fields['lampiran_surat'];
		$date_surat = $rsx->fields['date_surat'];
		$nama_pabrik = $rsx->fields['nama_pabrik'];
		$alamat_pabrik = $rsx->fields['alamat_pabrik'];
  		if($rsx->fields['alat']==''){$alat = '...................';}else{ $alat=$rsx->fields['alat'];}
		$nomor_surat_tambahan = $rsx->fields['nomor_surat_tambahan'];
		if($rsx->fields['date_surat_tambahan'] == ''){$date_surat_tambahan = '';}else{$date_surat_tambahan = date('d M Y',$rsx->fields['date_surat_tambahan']);}
		$nama = $rsx->fields['nama'];
		$nip = $rsx->fields['nip'];


		$pdf->Cell(30,7,'Nomor','',0,'L');$pdf->Cell(75,7,' : '.$nomor_surat.'','',0,'L');$pdf->Cell(60,7,'Jakarta, '.date('d M Y',$date_surat).'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'Lampiran','',0,'L');$pdf->Cell(100,7,' : '.$lampiran_surat.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'Perihal','',0,'L');$pdf->Cell(75,7,' : Penolakan pendaftaran','',0,'L'); $pdf->Cell(60,7,'Kepada Yth,','',0,'L');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->setx(115);$pdf->multiCell(75,7,''.$nama_pabrik.'','','L');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(105,7,'','',0,'L');$pdf->Cell(60,7,'di','',0,'L');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->setx(115);$pdf->multiCell(75,7,''.$alamat_pabrik.'','','L');
/*
		$pdf->Cell(30,7,'Nomor','',0,'L');$pdf->Cell(100,7,' : '.$nomor_surat.'','',0,'L');$pdf->Cell(40,7,'Jakarta, '.date('d M Y',$date_surat).'','',0,'R');
		$pdf->Ln(5);
		$pdf->Cell(30,7,'Lampiran','',0,'L');$pdf->Cell(100,7,' : '.$lampiran_surat.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'Perihal','',0,'L');$pdf->Cell(100,7,' : Penolakan pendaftaran','',0,'L'); $pdf->Cell(40,7,'Kepada Yth,','',0,'L');
		$pdf->Ln(5);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(130,7,'','',0,'L');$pdf->Cell(40,7,''.$nama_pabrik.'','',0,'L');
		$pdf->SetFont('Arial','',12);
		$pdf->Ln(5);
		$pdf->Cell(130,7,'','',0,'L');$pdf->Cell(40,7,'di','',0,'L');
		$pdf->Ln(5);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(130,7,'','',0,'L');$pdf->Cell(40,7,''.$alamat_pabrik.'','',0,'L');
*/
		$pdf->SetFont('Arial','',12);
		$pdf->Ln(10);
		$pdf->multiCell(0,7,'  Mengingat Saudara belum menyerahkan tambahan data alat kesehatan/ Diagnostik Reagensia/ Kosmetik/ Perbekalan kesehatan rumah tangga*, '.$alat.' seperti dimaksud dalam surat kami nomor '.$nomor_surat_tambahan.' tanggal '.$date_surat_tambahan.', maka sesuai dengan ketentuan yang berlaku, pendaftar tersebut kami tolak.
		   Apabila Saudara masih  berminat  untuk mendaftar kembali, masih diberi kesempatan melalui pendaftaran baru dengan data yang lengkap.
			    Demikian agar maklum.');
/*
		$pdf->Cell(180,7,'  Mengingat Saudara belum menyerahkan tambahan data alat kesehatan/ Diagnostik Reagensia/ Kosmetik/','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'kesehatan rumah tangga*, '.$alat.' seperti dimaksud dalam surat kami nomor '.$nomor_surat_tambahan.'','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'tanggal '.$date_surat_tambahan.', maka sesuai dengan ketentuan yang berlaku, pendaftar tersebut kami tolak.',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'     Apabila Saudara masih  berminat  untuk mendaftar kembali, masih diberi kesempatan melalui','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'pendaftaran baru dengan data yang lengkap.','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'        Demikian agar maklum,','',0,'L');
*/
		$pdf->Ln(10);
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'a.n DIREKTUR JENDERAL PELAYANAN','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'KEFARMASIAN DAN ALAT  KESEHATAN','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'DIREKTUR BINA PRODUKSI DAN DISTRIBUSI','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'ALAT KESEHATAN','',0,'C');
		$pdf->Ln(30);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(80,7,'( '.$nama.' )','B',0,'C');
		$pdf->Ln(10);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(80,7,'NIP. '.$nip.'','',0,'C');
		$pdf->Ln(70);
		$pdf->Cell(180,7,'* Coret yang tidak 566 perlu','B',0,'L');


		$pdf->Output();
