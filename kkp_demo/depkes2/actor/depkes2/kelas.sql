DROP TABLE kelas_produksi;
CREATE TABLE kelas_produksi (
    id_golongan serial NOT NULL,
    golongan character varying(50) DEFAULT ''::character varying NOT NULL,
    keterangan text DEFAULT ''::text NOT NULL,
    insert_by character varying(64) DEFAULT ''::character varying NOT NULL,
    date_insert bigint DEFAULT 0 NOT NULL
);
--COPY kelas_produksi (id_golongan, golongan, keterangan, insert_by, date_insert) FROM stdin;
--3	III	High Risk, mengandung pestisida.	admin	1095740483
--1	I	Low Risk, tidak mengandung bahan antiseptik, oksidatif, iritatif, korosif, insektisida dan produk berbentuk aerosol.	admin	1093841558
--2	II	Moderate Risk, mengandung bahan antiseptic, oksidatif, iritatif, koresif dan produk berbentuk aerosol tidak mengandung pestisida.	admin	1095740312
--\.
SELECT pg_catalog.setval('kelas_produksi_id_golongan_seq', 1, true);
