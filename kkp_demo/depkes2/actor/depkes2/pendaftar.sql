DROP TABLE pendaftar_registrasi_produksi;
CREATE TABLE pendaftar_registrasi_produksi (
    kode_pendaftar character varying(64) NOT NULL,
    nama_pendaftar character varying(50),
    alamat_pendaftar text,
    notelp_1 character varying(64),
    nama_propinsi_1 character varying(50),
    nama_pabrik character varying(50),
    alamat_pabrik text,
    notelp_2 character varying(64),
    nama_propinsi_2 character varying(255),
    alamat_bengkel text,
    notelp_3 character varying(64),
    alamatgudang text,
    notelp_4 character varying(64),
    nama_direktur character varying(50),
    namapenanggungjwb character varying(50),
    insert_by character varying(64),
    date_insert bigint,
    userid character varying(64),
    passwd character varying(64),
    npwp character varying(255),
    tpwd character varying(255),
    alamat_pendaftar_2 text
);


--
-- Data for TOC entry 4 (OID 2473589)
-- Name: pendaftar; Type: TABLE DATA; Schema: public; Owner: depkes2
--

COPY pendaftar_registrasi_produksi (kode_pendaftar, nama_pendaftar, alamat_pendaftar, notelp_1, nama_propinsi_1, nama_pabrik, alamat_pabrik, notelp_2, nama_propinsi_2, alamat_bengkel, notelp_3, alamatgudang, notelp_4, nama_direktur, namapenanggungjwb, insert_by, date_insert, userid, passwd, npwp, tpwd, alamat_pendaftar_2) FROM stdin;
P0904/002	PT. FABINDO SEJAHTERA	Desa Pasir Jaya, Kec. Cikupa	-	Jawa Barat	PT. FABINDO SEJAHTERA	Desa Pasir Jaya, Kec. Cikupa, Tangerang	-	Jawa Barat	Desa Pasir Jaya, Kec. Cikupa, Tangerang	\N	Desa Pasir Jaya, Kec. Cikupa, Tangerang	-	DAVY LITYO, Msc	Dra. MINA LASMINDAR, Apt	operator	1095846489	P0904002	2529	01.539.856.3-036.000	2529	Tangerang
P0904/003	PT. Linuxindo Total Solusi	Taman Grisenda Blok F3/3	(021) 5884347-8	DKI Jakarta	PT. Linuxindo Total Solusi	Taman Grisenda Blok F3/3	(021) 5884347-8	DKI Jakarta	Taman Grisenda Blok F3/3	\N	Taman Grisenda Blok F3/3	(021) 5884347-8	Ir. Effendy Kho	Khadiyd Idris, Skom.	operator	1095913914	P0904003	5253		5253	
P0904/005	CV. PUTRA NASACO	Jl. Gang Buntu 80, Kedung Wuni	(0285) 785346	Jawa Tengah	CV. PUTRA NASACO	Jl. Gang Buntu 80 Kedung Wuni, Pekalongan	(0285) 785346	Jawa Tengah	Jl. Gang Buntu 80 Kedung Wuni, Pekalongan	\N	Jl. Gang Buntu 80 Kedung Wuni, Pekalongan	(0285) 785346	H. NASTONI H H ANAS	HASANUL HAQ (AA)	operator	1095913915	P0904005	6865	06.718.270.9-502.000	6865	Kedung Wuni, Pekalongan
P0904/006	CV. CEMERLANG PRATAMA PUTRA	Komp. Muara Asri No. 39 RT 001/001		Jawa Barat	CV. CEMERLANG PRATAMA PUTRA	Komp. Muara Asri No. 39 RT 001/001 Kel Pasir Kuda, Bogor		Jawa Barat	Komp. Muara Asri No. 39 RT 001/001 Kel Pasir Kuda, Bogor	\N	Komp. Muara Asri No. 39 RT 001/001 Kel Pasir Kuda, Bogor		ASRUL MAULANA	WIDIHARTONO (D3 Kimia Analis)	operator	1095913915	P0904006	3169	02.370.063.6-404.000	3169	Kel Pasir Kuda, Bogor
P0904/007	PT. HOGY INDONESIA	MM 2100 Industrial Town, EPZ Block M-3-1	(021) 8980165; 8980167	DKI Jakarta	PT. HOGY INDONESIA	MM 2100 Industrial Town, EPZ Block M-3-1 Cikarang Barat - Bekasi 17520	(021) 8980165; 8980167	DKI Jakarta	MM 2100 Industrial Town, EPZ Block M-3-1 Cikarang Barat - Bekasi 17520	\N	MM 2100 Industrial Town, EPZ Block M-3-1 Cikarang Barat - Bekasi 17520	(021) 8980165; 8980167	Mr. KAZUO HIROSE	TATIANA DEWI S.Si, Apt	operator	1095913915	P0904007	6410	01.804.734.1-407.000	6410	Cikarang Barat - Bekasi 17520
P0904/008	PT. KAMPERINDO PRIMA LESTARI	Jl. Kapuk Raya No.3A RT 003/05		DKI Jakarta	PT. KAMPERINDO PRIMA LESTARI	Jl. Kapuk Raya No.3A RT 003/05 Kel Kapuk Cengkareng, Jakarta Barat		DKI Jakarta	Jl. Kapuk Raya No.3A RT 003/05 Kel Kapuk Cengkareng, Jakarta Barat	\N	Jl. Kapuk Raya No.3A RT 003/05 Kel Kapuk Cengkareng, Jakarta Barat		RUDY CHANDRA	SATRIA WIDJAJA (Asisten Apoteker)	operator	1095913915	P0904008	3459	01.858.203.1-034.000	3459	Kel Kapuk Cengkareng, Jakarta Barat
P0904/009	PT. SINAR PLATACO	Jl. Raya Narogong Km15		Jawa Barat	PT. SINAR PLATACO	Jl. Raya Narogong Km15 Limusnunggal Pangkalan VIII, Cileungsi - Bogor		DKI Jakarta	Jl. Raya Narogong Km15 Limusnunggal Pangkalan VIII, Cileungsi - Bogor	\N	Jl. Raya Narogong Km15 Limusnunggal Pangkalan VIII, Cileungsi - Bogor		SETIAWAN	DRA. MASTERIA SITANGGANG (S1 Kimia)	operator	1095913915	P0904009	1745	01.397.866.3-011.000	1745	Limusnunggal Pangkalan VIII, Cileungsi - Bogor
\.


