--
-- PostgreSQL database dump
--

SET client_encoding = 'SQL_ASCII';
SET check_function_bodies = false;

SET SESSION AUTHORIZATION 'depkes2';

SET search_path = public, pg_catalog;

--
-- TOC entry 3 (OID 3593214)
-- Name: subkategori_edar_pkrt; Type: TABLE; Schema: public; Owner: depkes2
--

CREATE TABLE subkategori_edar_pkrt (
    id_subkategori serial NOT NULL,
    id_kategori integer,
    nama_subkategori character varying(255),
    insert_by character varying(64),
    date_insert bigint
);


--
-- Data for TOC entry 5 (OID 3593214)
-- Name: subkategori_edar_pkrt; Type: TABLE DATA; Schema: public; Owner: depkes2
--

COPY subkategori_edar_pkrt (id_subkategori, id_kategori, nama_subkategori, insert_by, date_insert) FROM stdin;
2	1	Test Kimia Klinik	admin	1096612078
3	1	Peralatan Laboratorium Klinik	admin	1096612112
4	1	Tes Toksikologi klinik	admin	1096612129
5	2	Pewarna Biologikal	admin	1096612149
6	2	Produk Kultur Sel dan Jaringan	admin	1096612165
7	2	Peralatan dan asessori patologi	admin	1096612198
8	2	Pereaksi penyediaan specimen	admin	1096612225
9	2	Peralatan hematology otomatis dan semi otomatis	admin	1096612252
10	2	Peralatan hematologi manual	admin	1096612272
11	2	Paket hematologi	admin	1096612285
12	2	Pereaksi hematologi	admin	1096612298
\.


--
-- TOC entry 4 (OID 3593212)
-- Name: subkategori_edar_pkrt_id_subkategori_seq; Type: SEQUENCE SET; Schema: public; Owner: depkes2
--

SELECT pg_catalog.setval('subkategori_edar_pkrt_id_subkategori_seq', 12, true);


