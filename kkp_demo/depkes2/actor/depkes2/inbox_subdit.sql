DROP TABLE inbox_subdit_registrasi_produksi;
CREATE TABLE inbox_subdit_registrasi_produksi (
    id_inbox serial NOT NULL,
    no_tt integer NOT NULL,
    userid character varying(64),
    keterangan text,
    "read" integer DEFAULT 0 NOT NULL,
    insert_by character varying(64) NOT NULL,
    date_insert double precision DEFAULT 0 NOT NULL
);
SELECT pg_catalog.setval('inbox_subdit_registrasi_produksi_id_inbox_seq', 1, true);
