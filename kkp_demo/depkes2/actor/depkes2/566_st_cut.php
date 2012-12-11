		define('FPDF_FONTPATH','fpdf/font/');
		require('fpdf/fpdf.php');
		$pdf=new FPDF('P','mm','A4');
		$pdf->Open();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(180,7,'LAMPIRAN I','T',0,'R');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'LAMPIRAN PERATURAN MENTERI KESEHATAN RI','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(30,7,'NOMOR','',0,'L');$pdf->cell(100,7,' : 1184/MENKES/PER/X/2004','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(30,7,'TANGGAL','',0,'L');$pdf->Cell(100,7,' : 19 OKTOBER 2004','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(180,7,'','B',0,'C');
		$pdf->Ln(10);
/*		if($GLOBAL[surf2]=='edar')
			{
				$nama_pemohon = "nama_pendaftar_edar_$GLOBAL[suf3]_$GLOBAL[suf4]";
				$alamat_pemohon ="alamat_pendaftar_edar_$GLOBAL[suf3]_$GLOBAL[suf4]";
			}
		else
			{
				$nama_pemohon = "nama_pendaftar";
				$alamat_pemohon ="alamat_pendaftar";
			}
*/
		$sqlx = "
		SELECT
		st.nomor_surat,
		st.lampiran_surat,
		st.date_surat,
		pendaftar.nama_pendaftar as nama_pabrik,
		pendaftar.alamat_pendaftar as alamat_pabrik,
		st.alat,
		st.isi_1,
		st.isi_2,
		st.isi_3,
		st.isi_4,
		st.isi_5,
		st.nama,
		st.nip,
		st.insert_by,
		st.date_insert
		FROM ".$GLOBALS[my_table]." st
		LEFT OUTER JOIN ".$GLOBALS[my_cek]." cek ON (cek.id_cek_1 = st.kepada_surat)
		LEFT OUTER JOIN ".$GLOBALS[my_tt]." tt ON (tt.no_tt = cek.no_tt)
		LEFT OUTER JOIN ".$GLOBALS[my_pendaftar]." pendaftar ON( pendaftar.kode_pendaftar = tt.kode_pendaftar)
		WHERE
		st.id_st ='".$_GET['id_st']."'
		";

		$rsx = $adodb->Execute($sqlx);
		$nomor_surat = $rsx->fields['nomor_surat'];
		$lampiran_surat = $rsx->fields['lampiran_surat'];
		$date_surat = $rsx->fields['date_surat'];
		$nama_pabrik = $rsx->fields['nama_pabrik'];
		$alamat_pabrik = $rsx->fields['alamat_pabrik'];
		if($rsx->fields['alat']==''){$alat = '...................';}else{ $alat=$rsx->fields['alat'];}
		$isi_1 = $rsx->fields['isi_1'];
		$isi_2 = $rsx->fields['isi_2'];
		$isi_3 = $rsx->fields['isi_3'];
		$isi_4 = $rsx->fields['isi_4'];
		$isi_5 = $rsx->fields['isi_5'];
		$nama = $rsx->fields['nama'];
		$nip = $rsx->fields['nip'];

		$pdf->Cell(30,7,'Nomor','',0,'L');$pdf->Cell(75,7,' : '.$nomor_surat.'','',0,'L');$pdf->Cell(60,7,'Jakarta, '.date('d M Y',$date_surat).'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'Lampiran','',0,'L');$pdf->Cell(100,7,' : '.$lampiran_surat.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'Perihal','',0,'L');$pdf->Cell(75,7,' : Permintaan tambahan data','',0,'L'); $pdf->Cell(60,7,'Kepada Yth,','',0,'L');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->setx(115);$pdf->multiCell(75,7,''.$nama_pabrik.'','','L');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(105,7,'','',0,'L');$pdf->Cell(60,7,'di','',0,'L');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->setx(115);$pdf->multiCell(75,7,''.$alamat_pabrik.'','','L');
		if($GLOBALS[suf1]=='pemutihan')
			{
				$nijin =" $GLOBALS[suf1] $GLOBALS[suf2]";
			}
		elseif($GLOBALS[suf1]=='ubah')
			{
				$nijin =" per$GLOBALS[suf1]an $GLOBALS[suf2]";
			}

		else
			{
				$nijin =" $GLOBALS[suf2]";
			}
		$pdf->SetFont('Arial','',12);
		$pdf->Ln(5);
		$pdf->multicell(0,7,'   Sehubungan dengan pendaftaran ijin '.$nijin.' alat kesehatan/ Diagnostik Reagensia/ Kosmetik/ kesehatan rumah tangga *, dengan ini kami beritahukan bahwa masih diperlukan tambahan data sebagai berikut :');
/*
		$pdf->Cell(180,7,'Sehubungan dengan pendaftaran ijin '.$nijin.' alat kesehatan/ Diagnostik Reagensia/ ','',0,'L');
		$pdf->Ln(7);
		$pdf->Cell(180,7,'Kosmetik/ kesehatan   rumah tangga *,  dengan   ini   kami   beritahukan   bahwa masih ','',0,'L');
		$pdf->Ln(7);
		$pdf->Cell(180,7,'diperlukan tambahan data sebagai berikut :','',0,'L');
*/
//		$pdf->Ln();
		if($isi_1 != ''){$pdf->Cell(180,7,'1. '.$isi_1.'','',0,'L');}
		if($isi_2 != ''){$pdf->ln();$pdf->Cell(180,7,'2. '.$isi_2.'','',0,'L');}
    if($isi_3 != ''){ $pdf->Ln(); $pdf->Cell(180,7,'3. '.$isi_3.'','',0,'L');}
		if($isi_4 != ''){ $pdf->Ln(); $pdf->Cell(180,7,'4. '.$isi_4.'','',0,'L');}
		if($isi_5 != ''){ $pdf->Ln(); $pdf->Cell(180,7,'5. '.$isi_5.'','',0,'L');}
		$pdf->Ln(7);
		$pdf->multicell(0,7,'   Sesuai dengan Peraturan  Menteri  Kesehatan   Nomor  1184/MENKES/PER/X/2004  tentang Wajib Daftar Alat Kesehatan, Kosmetik dan Perbekalan Kesehatan Rumah Tangga, tambahan data tersebut harus sudah diserahkan  kepada kami selambat - lambatnya 3 (tiga) bulan  sejak tanggal surat ini
		    Demikian agar maklum');

/*
		$pdf->Cell(180,7,'        Sesuai dengan Peraturan  Menteri  Kesehatan   Nomor  1184/MENKES/PER/X/2004  tentang ','',0,'L');
		$pdf->Ln(7);
		$pdf->Cell(180,7,'Wajib Daftar Alat Kesehatan, Kosmetik dan Perbekalan Kesehatan Rumah Tangga, tambahan','',0,'L');
		$pdf->Ln(7);
		$pdf->Cell(180,7,'data tersebut harus sudah diserahkan  kepada kami selambat - lambatnya 3 (tiga) bulan  sejak',0,'L');
		$pdf->Ln(7);
		$pdf->Cell(180,7,'tanggal surat ini .',0,'L');
		$pdf->Ln(7);
		$pdf->Cell(180,7,'        Demikian agar maklum','',0,'L');
*/
		$pdf->Ln(7);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(80,7,'a.n. DIREKTUR JENDERAL PELAYANAN','',0,'C');
		$pdf->Ln(6);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(80,7,'KEFARMASIAN DAN ALAT KESEHATAN','',0,'C');
		$pdf->Ln(6);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(80,7,'DIREKTUR BINA PRODUKSI DAN ','',0,'C');
		$pdf->Ln(6);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(80,7,'DISTRIBUSI ALAT KESEHATAN','',0,'C');

		$pdf->Ln(20);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(80,7,'( '.$nama.' )','B',0,'C');
		$pdf->Ln(10);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(80,7,'NIP. '.$nip.'','',0,'C');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'* Coret yang tidak perlu','B',0,'L');
		$pdf->Output();