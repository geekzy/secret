DROP TABLE kelengkapan_registrasi_produksi;
CREATE TABLE kelengkapan_registrasi_produksi (
    id_kelengkapan serial NOT NULL,
    nama_kelengkapan text DEFAULT ''::text NOT NULL,
    insert_by character varying(64) DEFAULT ''::character varying NOT NULL,
    date_insert bigint DEFAULT 0 NOT NULL,
    sifat character varying(64) DEFAULT 'tidak perlu'::character varying NOT NULL
);

COPY kelengkapan_registrasi_produksi (id_kelengkapan, nama_kelengkapan, insert_by, date_insert, sifat) FROM stdin;
1	Memiliki pabrik yang memenuhi persyaratan sesuai kelas dan produk yang dihasilkan.	admin	1095838709	tidak perlu
2	Permohonan ke Departemen Kesehatan RI	admin	1095838726	tidak perlu
3	Rekomendasi Dinas Kesehatan Prop Setempat	admin	1095838745	tidak perlu
4	Berita Acara Pemeriksaan dari Dinas Kes Prop Setempat	admin	1095838768	tidak perlu
5	Memiliki Badan Usah atau Badan Hukum	admin	1095838785	tidak perlu
6	NPWP	admin	1095838794	tidak perlu
7	Ijin Usaha Industri / TDI	admin	1095838814	tidak perlu
8	SIUP / TDP / TDUP	admin	1095838832	tidak perlu
9	UUG / HO	admin	1095838841	tidak perlu
10	Peta Lokasi	admin	1095838852	tidak perlu
11	Denah Bangunan	admin	1095838861	tidak perlu
12	Mempunyai Laboratorium	admin	1095838882	tidak perlu
13	Kerja sama dengan Laboratorium terakreditasi	admin	1095838900	tidak perlu
14	Surat Pernyataan Full Time dari Penanggung Jawab Teknis dan Foto Copy Ijasah Dilegalisir	admin	1095839009	tidak perlu
15	Memiliki Penanggung Jawab Produksi S1 / Pendidikan yg sederajat (Apoteker, Sarjana Kimia, Sarjana Elektro, Atem (Utk Elektro))	admin	1095839075	tidak perlu
16	Memiliki Penanggung Jawab Produksi D3 / Pendidikan yg sederajat sesuai bidangnya	admin	1095839107	tidak perlu
17	Memiliki Penanggung Jawab Produksi Asisten Apoteker / Tenaga lain yg sederajat sesuai dengan bidangnya	admin	1095839170	tidak perlu
\.

ALTER TABLE ONLY kelengkapan_registrasi_produksi
    ADD CONSTRAINT kelengkapan_registrasi_produksi_pkey PRIMARY KEY (id_kelengkapan);
SELECT pg_catalog.setval('kelengkapan_registrasi_produksi_id_kelengkapan_seq', 18, true);
