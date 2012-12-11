		$pdf->AddPage();
		$pdf->SetFont('Arial','B',12);
		$pdf->Ln(55);
		$pdf->Cell(180,5,'KEPUTUSAN DIREKTUR JENDERAL PELAYANAN KEFARMASIAN','',1,'C');
		$pdf->Cell(180,5,'DAN ALAT KESEHATAN','',1,'C');
		$pdf->Cell(180,5,'DEPARTEMEN KESEHATAN REPUBLIK INDONESIA','',1,'C');
		$pdf->Cell(180,5,'NOMOR : '.$no_sk.'','',1,'C');
		//$pdf->Cell(180,5,'','',1,'C');
		$pdf->ln(3);
		$pdf->Cell(180,5,'TENTANG','',1,'C');
		$pdf->Cell(180,5,strtoupper($perihal),'',1,'C');

		$pdf->Ln(3);
		$pdf->Cell(180,5,'DIREKTUR JENDERAL PELAYANAN KEFARMASIAN DAN ALAT KESEHATAN','',1,'C');
//		$pdf->Cell(180,5,'DEPARTEMEN KESEHATAN REPUBLIK INDONESIA','',1,'C');
		$pdf->Cell(180,5,'','',1,'C');

		$xx = 0;
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(30,5,'MEMBACA','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
		$pdf->MultiCell(140,5,'Surat permohonan '.$nama_pendaftar.', '.$alamat_pendaftar.' '.$no_pemohon.
		' '.$date_pemohon.' tentang '.strtolower($map1[$suf1]).' '.$perubahan." ".$perihal.' beserta lampirannya.');

		if ($no_rekomendasi) {
			if ($date_rekomendasi) $date_rekomendasi = 'tanggal '.$date_rekomendasi;
			else $date_rekomendasi = '';
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Surat Rekomendasi DinKes Propinsi '.$nama_propinsi_1.
			' No. '.$no_rekomendasi.' '.$date_rekomendasi.'.');
		}

		if ($no_bap) {
			if ($date_bap) $date_bap = 'tanggal '.$date_bap;
			else $date_bap = '';
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Berita Acara Pemeriksaan dari Dinas Kesehatan Propinsi '.$nama_propinsi_1.
			' No. '.$no_bap.' '.$date_bap.'.');
		}

		if ($no_sk_lama) {
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Keputusan Menteri Kesehatan RI No. '.$no_sk_lama.' tanggal '.
			$date_sk_lama.' tentang '.ucwords($perihal).' yang diberikan '.
			'kepada '.$nama_perusahaan.', '.$alamat_pendaftar.'.');
		}

//		$pdf->Cell(180,5,'','',1,'C');
		$pdf->ln(3);
		$xx = 0;
		$pdf->Cell(30,5,'MENIMBANG','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');$pdf->Cell(5,5,'','',0,'L');
		$pdf->MultiCell(140,5,'Bahwa permohonan '.$nama_pendaftar.', '.$alamat_pendaftar.
		' tersebut dapat di setujui, oleh karena itu perlu menerbitkan sertifikat '.$perihal.' untuk yang bersangkutan.');
//		$pdf->Cell(180,5,'','',1,'C');

/*
		$xx = 0;
		$pdf->Cell(30,5,'MENIMBANG','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
		$pdf->MultiCell(140,5,'Bahwa permohonan '.$nama_perusahaan.', '.$alamat_pendaftar.
		' telah memenuhi syarat.');
		$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
		$pdf->MultiCell(140,5,'Bahwa kepada yang bersangkutan dapat diberikan '.
		$perihal.'.');
		$pdf->Cell(180,5,'','',1,'C');
*/
		$xx = 0;
		$pdf->ln(3);
		$pdf->Cell(30,5,'MENGINGAT','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');

		list($sufa, $sufb, $sufc) = split(" ", strtolower($GLOBALS[my_title]));
//--------------
		if ($sufb == 'produksi') {
			$pdf->MultiCell(140,5,'Ordonansi Bahan Berbahaya(Stb.Tahun 1949, Nomor 377).');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Undang-undang No.5 tahun 1984 tentang Perindustrian (Lembaran Negara RI Tahun 1984 Nomor 22, Tambahan Lembaran Negara RI Nomor 3274).');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Undang-undang No 23 tahun 1992 tentang kesehatan (Lembaran Negara tahun 1992 No.100;Tambahan Lembaran Negara No 3495) Undang-undang No. tahun 1999 tentang Pelindungan Konsumen');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Undang-undang Nomor 8 Tahun 1999 tentang Perlindungan Konsumen (Lembaran Negara RI Tahun 1999 No.42; Tambahan lembaran  Negara RI Nomor 3839)');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Undang-undang Nomor 22 Tahun 1999  tentang Pemerintah daerah (Lembaran Negara RI Tahun 1999 Nomor 60, Tambahan lembaran Negara RI Nomor 3839)');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Peraturan Pemerintah Nomor 7 Tahun 1973 tentang Pengawasan atas Peredaran,Penyimpanan dan penggunaan Pestisida (Lembaran Negara RI Tahun 1973 Nomor 12)');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Peraturan Pemerintah RI Nomor 17 Tahun 1986 tentang Kewenangan Pengaturan Pembinaan Pengembangan Industri (Lembaran Negara RI Tahun 1986 Nomor 23, Tambahan Lembaran Negara RI Tahun 1986 Nomor 330)');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Peraturan Pemerintah RI Nomor 32 Tahun 1996 tentang Tenaga Kesehatan (Lembaran Negara RI Tahun 1996 Nomor 49, Tambahan Lembaran Negara RI Nomor 3637)');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Peraturan Pemerintah RI Nomor 72 Tahun 1998 tentang Pengamanan Sediaan Farmasi dan Alat Kesehatan (Lembaran Negara RI Tahun 1998 Nomor 138, Tambahan Lembaran Negara RI Tahun 1998 Nomor 3781)');
			$pdf->Cell(28,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(7,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Peraturan Pemerintah RI Nomor 25 Tahun 2000 tentang Kewenangan Pemerintah dan Kewenangan Propinsi sebagai Daerah Otonomi (Lembaran Negara RI Tahun 2000 Nomor 54, Tambahan Lembaran Negara RI Nomor 3952)');
			$pdf->Cell(28,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(7,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Keputusan Presiden RI Nomor 102 Tahun 2001 tentang Kedudukan, Tugas Fungsi, Susunan Organisasi dan Tata Kerja Departemen,');
			$pdf->Cell(28,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(7,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Peraturan Menteri Kesehatan RI No. 1184/Menkes/Per/X/2004/ tanggal 19 Oktober 2004 tentang Pengamanan Alat Kesehatan dan Perbekalan Kesehatan Rumah Tangga.');
/*
			if($suf3 == '0'){
				$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
				$pdf->MultiCell(140,5,'Keputusan Menteri Kesehatan RI No. 1277/Menkes/SK/XI/2001'.
				' tentang Organisasi dan Tata Kerja Departemen Kesehatan.');
			}
			*/
//------------------
		} else if ($sufb == 'penyalur') {
			$pdf->MultiCell(140,5,'Ordonansi Bahan Berbahaya(Stb.Tahun 1949, Nomor 377).');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Undang-undang No.5 tahun 1984 tentang Perindustrian (Lembaran Negara RI Tahun 1984 Nomor 22, Tambahan Lembaran Negara RI Nomor 3274).');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Undang-undang No 23 tahun 1992 tentang kesehatan (Lembaran Negara tahun 1992 No.100;Tambahan Lembaran Negara No 3495)');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Undang-undang Nomor 8 Tahun 1999 tentang Perlindungan Konsumen (Lembaran Negara RI Tahun 1999 No.42; Tambahan lembaran  Negara RI Nomor 3839)');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Undang-undang Nomor 22 Tahun 1999  tentang Pemerintah daerah (Lembaran Negara RI Tahun 1999 Nomor 60, Tambahan lembaran Negara RI Nomor 3839)');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Peraturan Pemerintah Nomor 7 Tahun 1973 tentang Pengawasan atas Peredaran,Penyimpanan dan penggunaan Pestisida (Lembaran Negara RI Tahun 1973 Nomor 12)');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Peraturan Pemerintah RI Nomor 17 Tahun 1986 tentang Kewenangan Pengaturan Pembinaan Pengembangan Industri (Lembaran Negara RI Tahun 1986 Nomor 23, Tambahan Lembaran Negara RI Tahun 1986 Nomor 330)');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Peraturan Pemerintah RI Nomor 32 Tahun 1996 tentang Tenaga Kesehatan (Lembaran Negara RI Tahun 1996 Nomor 49, Tambahan Lembaran Negara RI Nomor 3637)');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Peraturan Pemerintah RI Nomor 72 Tahun 1998 tentang Pengamanan Sediaan Farmasi dan Alat Kesehatan (Lembaran Negara RI Tahun 1998 Nomor 138, Tambahan Lembaran Negara RI Tahun 1998 Nomor 3781)');
			$pdf->Cell(28,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(7,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Peraturan Pemerintah RI Nomor 25 Tahun 2000 tentang Kewenangan Pemerintah dan Kewenangan Propinsi sebagai Daerah Otonomi (Lembaran Negara RI Tahun 2000 Nomor 54, Tambahan Lembaran Negara RI Nomor 3952)');
		// ini untuk izin penyalur baru .....
		  if($suf1=='registrasi')
				{
					$pdf->Cell(28,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(7,5,++$xx.'.','',0,'L');
					$pdf->MultiCell(140,5,'Keputusan Menteri Kesehatan RI Nomor 1277/MENKES/SK/XI/2001 Tentang Organisasi dan Tata Kerja Departemen Kesehatan');
					$pdf->Cell(28,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(7,5,++$xx.'.','',0,'L');
					$pdf->MultiCell(140,5,'Peraturan Menteri Kesehatan RI No. 1184/Menkes/Per/X/2004/ tanggal 19 Oktober 2004 tentang Pengamanan Alat Kesehatan dan Perbekalan Kesehatan Rumah Tangga');
				}
			else//if($suf1=='pemutihan')
				{
					$pdf->Cell(28,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(7,5,++$xx.'.','',0,'L');
					$pdf->MultiCell(140,5,'Keputusan Bersama Menteri Kesehatan dan Menteri Pendayagunaan Aparatur Negara Nomor 264A/MENKES/SKB/VII/2003, Nomor 02/SKB/M.PAN/7/2003 Tentang Tugas,Fungsi dan Kewenangan di bidang Pengawasan Obat dan Makanan.');
				}
		}
//		$pdf->Cell(180,5,'','',1,'C');
//		$pdf->Cell(180,5,'','',1,'C');
    $pdf->addpage();
		$pdf->ln(55);
		$pdf->Cell(180,5,'MEMUTUSKAN :','',1,'C');
		$pdf->ln(1);
		$pdf->Cell(30,5,'MENETAPKAN','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');$pdf->Cell(5,5,'','',0,'L');
		//$pdf->MultiCell(140,5,'');
		//$pdf->Cell(180,5,'','',1,'C');
		$pdf->ln(5);
		$pdf->Cell(30,5,'Pertama','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');$pdf->Cell(5,5,'','',0,'L');
		$pdf->MultiCell(140,5,'Memberikan '.$perihal.' Kepada :');

		$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');
		$pdf->Cell(65,5,'Nama Perusahaan','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');
		$pdf->SetFont('Arial','B','12');
		// ini aku(hambali) ganti jadi nama pendaftar, asalnya $nama_perusahaan,
		$pdf->MultiCell(70,5,''.$nama_pendaftar);
		$pdf->SetFont('Arial','','12');
		$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');
		$pdf->Cell(65,5,'NPWP','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');
		$pdf->MultiCell(70,5,''.$npwp);
		// ini aku(hambali) ganti jadi $alamat_pendaftar, asalnya $alamat_pabrik,penyalur bukan pabrik
		$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');
		$pdf->Cell(65,5,'Alamat Perusahaan','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');
		$pdf->MultiCell(70,5,''.$alamat_pendaftar);

		$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');
		$pdf->Cell(65,5,'Nama Direktur / Pimpinan','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->MultiCell(70,5,''.$nama_direktur);
		$pdf->SetFont('Arial', '', 12);

		$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');
		$pdf->Cell(65,5,'Nama Penanggung Jawab Teknis','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->MultiCell(70,5,''.$nama_penanggung);
		$pdf->SetFont('Arial', '', 12);

		if ($sufb == 'produksi') {
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');
			$pdf->Cell(65,5,'Alamat Pabrik','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');
			$pdf->MultiCell(70,5,''.$alamat_pabrik);
			/*
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');
			$pdf->Cell(65,5,'Nomor Izin Produksi','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');
			$pdf->MultiCell(70,5,''.$izin_produksi);*/
		} else if ($sufb == 'penyalur') {
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');
			$pdf->Cell(65,5,'Alamat Gudang','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');
			$pdf->MultiCell(70,5,''.$alamat_gudang);
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');
			$pdf->Cell(65,5,'Alamat Bengkel / Workshop','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');
			$pdf->MultiCell(70,5,''.$alamat_bengkel);
		}

		//$pdf->Cell(180,3,'','',1,'C');
//		$pdf->ln(3);
		if ($suf2=='produksi') {
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');
			$pdf->MultiCell(140,5,'untuk memproduksi '.
			ucwords(strtolower($map30[$suf3])).
			' menurut daftar tercantum pada Lampiran keputusan ini.');
		}

		// halaman 2
		//$pdf->AddPage();
		$pdf->Ln(2);
		if ($sufb == 'produksi') {
			$pdf->Cell(30,5,'Kedua','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');#$pdf->Cell(5,5,'','',0,'L');
			$pdf->MultiCell(145,5,$perihal.' yang dimaksud dalam diktum pertama termasuk golongan '.
			$golongan.' dengan ketentuan : ');

			$xx = 0;
			#switch ($golongan) {
			#	case 'A':

			if ($golongan == 'A' || $golongan == 'B') {
				$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
				$pdf->MultiCell(140,5,'Harus selalu dipimpin oleh seorang Penanggung Jawab Teknis yang'.
				' bekerja penuh, yang namanya tercantum pada surat keputusan ini.');
			} else if ($golongan == 'C') {
				$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
				$pdf->MultiCell(140,5,'Harus selalu dipimpin oleh seorang Penanggung Jawab Teknis yang'.
				' berpendidikan sekurang kurangnya Asisten Apoteker atau yang sederajat'.
				' sesuai dengan keahliannya, yang bekerja penuh dan namanya tercantum'.
				' pada surat keputusan ini.');
			}

			if ($golongan == 'A' || $golongan == 'B') {
				$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
				$pdf->MultiCell(140,5,'Harus mempunyai Laboratorium yang mampu melakukan pemeriksaan'.
				' mutu bahan sampai produk jadi.');
			} else if ($golongan == 'C') {
				$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
				$pdf->MultiCell(140,5,'Harus memeriksakan bahan dan produk jadinya pada'.
				' Laboratorium Pemerintah / Laboratorium yang ditunjuk Pemerintah.');
			}

			if ($suf3 == '1' && $suf2 == 'produksi') {
				$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
				$pdf->MultiCell(140,5,'Hanya dapat memproduksi Perbekalan Kesehatan Rumah Tangga sesuai dengan yang tercantum pada lampiran keputusan ini. (Apabila akan memproduksi Perbekalan Kesehatan Rumah Tangga lain diluar lampiran, harus mengajukan permohonan dengan melampirkan daftar peralatan produksi)');
			}
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,"Harus memberikan laporan hasil produksi setiap 1 (satu) tahun sekali kepada Direktur Jenderal Pelayanan Kefarmasian dan Alat Kesehatan dan tembusan kepada Kepala Dinas Kesehatan Propinsi dan kepala Dinas Kesehatan Kabupatan / Kota.");

/*
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,"Harus memberikan laporan tentang hasil produksi dan hasil pemeriksaan'.
			' Laboratorium setiap 3 (tiga) bulan sekali, kepada Menteri Kesehatan Republik Indonesia'.
			' cq. Direktorat Jenderal Pelayanan Kefarmasian dan Alat Kesehatan,'.
			' Jl. Rasuna Said Blok X5 Kav. No. 4-9, Jakarta 12950.");
*/
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Harus mematuhi peraturan perundang-undangan yang berlaku.');
			$pdf->Cell(180,3,'','',1,'C');


			$pdf->Cell(30,5,'Ketiga','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');#$pdf->Cell(5,5,'','',0,'L');
			$pdf->MultiCell(145,5,''.ucwords($perihal).' berlaku selama 4 (empat) tahun terhitung sejak tanggal'.
			' dikeluarkannya Surat Keputusan ini(setiap tahun akan dilakukan evaluasi pelaksanaannya).');
			$pdf->Cell(180,3,'','',1,'C');


			$yy = 4;
			$mapy[4] = 'Keempat';
			$mapy[5] = 'Kelima';


			if ($suf1 != 'registrasi') {
				$pdf->Cell(30,5,$mapy[$yy++],'',0,'L');$pdf->Cell(5,5,' : ','',0,'L');#$pdf->Cell(5,5,'','',0,'L');
				$pdf->MultiCell(145,5,'Dengan dikeluarkannya Keputusan ini, makan Keputusan Menteri'.
				' RI No. '.$no_sk_lama.' tanggal '.$date_sk_lama.' tentang'.
				' Izin Produksi Alat Kesehatan yang diberikan kepada '.$nama_perusahaan.
				', '.$alamat_pendaftar.' dinyatakan tidak berlaku lagi.');
				$pdf->Cell(180,5,'','',1,'C');
			}

			$pdf->Cell(30,5,$mapy[$yy++],'',0,'L');$pdf->Cell(5,5,' : ','',0,'L');#$pdf->Cell(5,5,'','',0,'L');
			$pdf->MultiCell(145,5,'Surat Keputusan ini mulai berlaku sejak tanggal di tetapkan dengan catataan bahwa akan di adakan peninjauan atau perubahan sebagaimana mestinya apabila terdapat kekurangan atau kekeliruan dalan penetapan ini.');
		}

//=============
		else if ($sufb == 'penyalur') {
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');#$pdf->Cell(5,5,'','',0,'L');
			$pdf->MultiCell(145,5,'dengan ketentuan sebagai berikut :');

			$xx = 0;
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Harus selalu diawasi oleh Penanggung Jawab Teknis yang namanya'.
			' tercantum pada surat keputusan ini.');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Harus mematuhi peraturan perundang-undangan yang berlaku.');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,'Melaksanakan dokumentasi pengadaan, penyimpanan dan penyaluran'.
			' '.ucwords(strtolower($map30[$suf3])).' dengan sebaik-baiknya sesuai ketentuan yang berlaku.');
			$pdf->Cell(30,5,'','',0,'L');$pdf->Cell(5,5,'','',0,'L');$pdf->Cell(5,5,++$xx.'.','',0,'L');
			$pdf->MultiCell(140,5,$perihal.' berlaku untuk seterusnya selama'.
			' perusahaan Penyalur '.ucwords(strtolower($map30[$suf3])).' yang bersangkutan masih aktif'.
			' melakukan kegiatan usahanya dan berlaku untuk seluruh Wilayah'.
			' Republik Indonesia.');
			$pdf->Cell(180,5,'','',1,'C');
//----
			if($suf1=='registrasi' || $suf1=='ubah')
				{
					$pdf->Cell(30,5,'Kedua','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');#$pdf->Cell(5,5,'','',0,'L');
					$pdf->MultiCell(145,5,'Surat Keputusan ini berlaku sejak tanggal ditetapkan dengan catatan bahwa akan diadakan peninjauan atau perubahan sebagaimana mestinya apabila terdapat kekurangan atau kekeliruan dalam penetapan ini.');
				}
			else
				{
					$pdf->Cell(30,5,'Kedua','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');#$pdf->Cell(5,5,'','',0,'L');
					$pdf->MultiCell(145,5,'Dengan dikeluarkan keputusan ini, maka keputusan Direktur Jenderal Pelayanan Kefarmasian dan ALat Kesehatan, Departemen Kesehatan RI. Nomor '.$no_sk_lama.' tanggal '.$date_sk_lama.' tentang izin Penyalur Alat Kesehatan yang di berikan kepada '.$nama_pendaftar.' tidak berlaku lagi.');
					$pdf->Cell(30,5,'Ketiga','',0,'L');$pdf->Cell(5,5,' : ','',0,'L');#$pdf->Cell(5,5,'','',0,'L');
					$pdf->MultiCell(145,5,'Surat Keputusan ini berlaku sejak tanggal ditetapkan dengan catatan bahwa akan diadakan peninjauan atau perubahan sebagaimana mestinya apabila terdapat kekurangan atau kekeliruan dalam penetapan ini.');
				}
		}
		$pdf->Cell(180,5,'','',1,'C');

		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(30,7,'Ditetapkan di','',0,'L');$pdf->Cell(60,7,' : J a k a r t a ','',0,'L');
		$pdf->Ln();
		$tg = date('d F Y');
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(30,7,'Pada tanggal','B',0,'L');$pdf->Cell(40,7,' : '.$tg.'','B',0,'L');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$date_bap = date('d M Y');
		$kode_subdit = $rsb->fields['kode_subdit'];

//		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'a.n MENTERI KESEHATAN REPUBLIK INDONESIA','',0,'C');
//		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'a.n DIREKTUR JENDERAL PELAYANAN','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'KEFARMASIAN DAN ALAT  KESEHATAN','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'DIREKTUR BINA PRODUKSI DAN DISTRIBUSI','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'ALAT KESEHATAN','',0,'C');
		$pdf->Ln(20);
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(10,7,'','',0,'L');$pdf->Cell(80,7,''.$nama.'','B',0,'C');$pdf->Cell(10,7,'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(10,7,'','',0,'L');$pdf->Cell(80,7,'NIP .'.$nip.'','',0,'C');$pdf->Cell(10,7,'','',1,'L');
		$pdf->Ln(1);

		$xx = 0;
		$pdf->SetFont('Arial','U',12);
		$pdf->Cell(180,7,'Salinan Keputusan ini disampaikan kepada Yth :','',1,'L');
		if ($suf3 == '0') $pdf->Cell(180,7,++$xx.'. Kepala Dinas Kesehatan Propinsi di seluruh Indonesia','',1,'L');
		$pdf->Cell(180,7,++$xx.'. Kepala Dinas Kesehatan '.$nama_propinsi_1.'','',1,'L');
		if ($sufb == 'penyalur') $pdf->Cell(180,7,++$xx.'. Direktur Jenderal Perdagangan dalam negeri di Jakarta','',1,'L');
		$pdf->Cell(180,7,++$xx.'. Direktur Jenderal Bea dan Cukai di Jakarta','',1,'L');
		if ($golongan == 'A' || $golongan == 'B' || $sufb == 'penyalur') $pdf->Cell(180,7,++$xx.'. Gakeslab di Jakarta','',1,'L');
		$pdf->Cell(180,7,++$xx.'. Arsip','',1,'L');

/*
		$pdf->SetFont('Arial','',12);
		if ($suf3 == '0') $pdf->Cell(180,7,++$xx.'. Bapak DirJen Yanfar dan Alkes ( sebagai laporan )','',1,'L');
		$pdf->Cell(180,7,++$xx.'. Kepala Dinas Kesehatan Propinsi '.$nama_propinsi_1.'','',1,'L');
		if ($sufb == 'penyalur') $pdf->Cell(180,7,++$xx.'. Dit. Jen. Bea dan Cukai Dep. Keuangan RI di Jakarta','',1,'L');
		$pdf->Cell(180,7,++$xx.'. Dep. Perindag RI di Jakarta','',1,'L');
		if ($golongan == 'A' || $golongan == 'B' || $sufb == 'penyalur') $pdf->Cell(180,7,++$xx.'. Gakeslab di Jakarta','',1,'L');
		$pdf->Cell(180,7,++$xx.'. Arsip','',1,'L');
*/

		$pdf->AddPage();
		$pdf->Ln(60);
		$pdf->Cell(180,7,'LAMPIRAN','',0,'R');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(180,7,'KEPUTUSAN DIREKTUR JENDERAL','',0,'C');
		$pdf->Ln();
		$pdf->Cell(180,7,'PELAYANAN KEFARMASIAN DAN ALAT KESEHATAN','',0,'C');
		$pdf->Ln();
		$pdf->Cell(180,7,'DEPARTEMEN KESEHATAN REPUBLIK INDONESIA','',0,'C');
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(90,7,'No. '.$no_sk.'','',0,'C');$pdf->Cell(90,7,'Tanggal '.$tg.'','',0,'C');
		$pdf->Ln();
		$pdf->Ln();
/*
		$pdf->Cell(180,7,'Tentang','',0,'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(180,7,strtoupper('Izin '.$suf2.' '.$map30[$suf3]),'',0,'C');
		$pdf->Ln(20);
		$pdf->SetFont('Arial','',12);
*/
		if ($sufb == 'produksi') {
			$pdf->Cell(180,7,'Jenis '.ucwords(strtolower($map30[$suf3])).' yang diizinkan diproduksi : ','',0,'L');
			$pdf->Ln(10);
			$piece = explode("\n", $nama_produk);
			foreach ($piece as $key => $val) {
				$pdf->Cell(180,7,$val.'','',1,'L');
			}
			$pdf->Ln(10);
		} else if ($sufb == 'penyalur') {
			$pdf->Cell(180,7,'DIIZINKAN UNTUK MENYALURKAN '.strtoupper($map30[$suf3]).' PRODUKSI DARI :','',0,'L');
			$pdf->Ln(10);


			if (($lisensi2 && $nama_produk2)
			|| ($lisensi3 && $nama_produk3)
			|| ($lisensi4 && $nama_produk4)
			|| ($lisensi5 && $nama_produk5)) {

				$xx = 0;
				$pdf->SetFont('Arial', 'BI', '12');
				$pdf->Cell(180,7,++$xx.". ".$lisensi,'',0,'L');
				$pdf->SetFont('Arial', '', '12');
				$pdf->Ln(10);
				$piece = explode("\n", $nama_produk);
				foreach ($piece as $key => $val) {
					$pdf->Cell(180,7,$val.'','',1,'L');
				}
				$pdf->Ln(5);

				if ($lisensi2 && $nama_produk2) {
					$pdf->SetFont('Arial', 'BI', '12');
					$pdf->Cell(180,7,++$xx.". ".$lisensi2,'',0,'L');
					$pdf->SetFont('Arial', '', '12');
					$pdf->Ln(10);
					$piece = explode("\n", $nama_produk2);
					foreach ($piece as $key => $val) {
						$pdf->Cell(180,7,$val.'','',1,'L');
					}
					$pdf->Ln(5);
				}

				if ($lisensi3 && $nama_produk3) {
					$pdf->SetFont('Arial', 'BI', '12');
					$pdf->Cell(180,7,++$xx.". ".$lisensi3,'',0,'L');
					$pdf->SetFont('Arial', '', '12');
					$pdf->Ln(10);
					$piece = explode("\n", $nama_produk3);
					foreach ($piece as $key => $val) {
						$pdf->Cell(180,7,$val.'','',1,'L');
					}
					$pdf->Ln(5);
				}
				if ($lisensi4 && $nama_produk4) {
					$pdf->SetFont('Arial', 'BI', '12');
					$pdf->Cell(180,7,++$xx.". ".$lisensi4,'',0,'L');
					$pdf->SetFont('Arial', '', '12');
					$pdf->Ln(10);
					$piece = explode("\n", $nama_produk4);
					foreach ($piece as $key => $val) {
						$pdf->Cell(180,7,$val.'','',1,'L');
					}
					$pdf->Ln(5);
				}
				if ($lisensi5 && $nama_produk5) {
					$pdf->SetFont('Arial', 'BI', '12');
					$pdf->Cell(180,7,++$xx.". ".$lisensi5,'',0,'L');
					$pdf->SetFont('Arial', '', '12');
					$pdf->Ln(10);
					$piece = explode("\n", $nama_produk5);
					foreach ($piece as $key => $val) {
						$pdf->Cell(180,7,$val.'','',1,'L');
					}
					$pdf->Ln(5);
				}

			} else {
				$pdf->SetFont('Arial', 'BI', '12');
				$pdf->Cell(180,7,$lisensi,'',0,'L');
				$pdf->SetFont('Arial', '', '12');
				$pdf->Ln(10);
				$piece = explode("\n", $nama_produk);
				foreach ($piece as $key => $val) {
					$pdf->Cell(180,7,$val.'','',1,'L');
				}
				$pdf->Ln(10);
			}
		}
		$pdf->MultiCell(180,7,'Dengan ketentuan bahwa '.ucwords(strtolower($map30[$suf3])).
		' tersebut harus mendapatkan persetujuan izin edar'.
		' sebelum diedarkan.');
		$pdf->Ln(20);
		$pdf->SetFont('Arial', 'B', '12');
//		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'a.n MENTERI KESEHATAN REPUBLIK INDONESIA','',0,'C');
//		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'a.n DIREKTUR JENDERAL PELAYANAN','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'KEFARMASIAN DAN ALAT  KESEHATAN','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'DIREKTUR BINA PRODUKSI DAN DISTRIBUSI','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'ALAT KESEHATAN','',0,'C');
		$pdf->Ln(30);
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(10,7,'','',0,'L');$pdf->Cell(80,7,''.$nama.'','B',0,'C');$pdf->Cell(10,7,'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(10,7,'','',0,'L');$pdf->Cell(80,7,'NIP .'.$nip.'','',0,'C');$pdf->Cell(10,7,'','',0,'L');
		$pdf->Ln();





		$pdf->Output();
		exit();
		#$_form = $lamp;
		#return $_form;