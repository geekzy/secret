DROP TABLE tt_registrasi_produksi;
CREATE TABLE tt_registrasi_produksi (
    no_tt serial NOT NULL,
    urut_no_tt character varying(255),
    kode_subdit character varying(64),
    kode_pendaftar character varying(64),
    insert_by character varying(64),
    date_insert bigint,
    jenis_izin_produksi integer
);
SELECT pg_catalog.setval('tt_registrasi_produksi_no_tt_seq', 1, true);
