DROP TABLE st_registrasi_produksi;
CREATE TABLE st_registrasi_produksi (
    id_st serial NOT NULL,
    nomor_surat character varying(255),
    lampiran_surat character varying(255),
    date_surat bigint,
    kepada_surat character varying(255),
    isi_1 text,
    isi_2 text,
    isi_3 text,
    isi_4 text,
    isi_5 text,
    nama character varying(255),
    nip character varying(50),
    date_insert bigint,
    insert_by character varying(64),
    alat character varying(255)
);
SELECT pg_catalog.setval('st_registrasi_produksi_id_st_seq', 1, true);
