DROP TABLE sp_registrasi_produksi;
CREATE TABLE sp_registrasi_produksi (
    id_sp serial NOT NULL,
    nomor_surat character varying(255),
    lampiran_surat character varying(255),
    date_surat bigint,
    id_cek_1 integer,
    nama character varying(255),
    nip character varying(50),
    date_insert bigint,
    insert_by character varying(64)
);
SELECT pg_catalog.setval('sp_registrasi_produksi_id_sp_seq', 1, true);
