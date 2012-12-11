DROP TABLE sk_registrasi_produksi;
CREATE TABLE sk_registrasi_produksi (
    id_sk serial NOT NULL,
    no_sk character varying(255),
    id_cek_1 integer DEFAULT 0 NOT NULL,
    nama character varying(255),
    nip character varying(50),
    insert_by character varying(64),
    date_insert bigint,
    izin_produksi character varying(255)
);
SELECT pg_catalog.setval('sk_registrasi_produksi_id_sk_seq', 1, true);
