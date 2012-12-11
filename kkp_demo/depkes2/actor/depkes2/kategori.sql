--
-- PostgreSQL database dump
--

SET client_encoding = 'SQL_ASCII';
SET check_function_bodies = false;

SET SESSION AUTHORIZATION 'depkes2';

SET search_path = public, pg_catalog;

--
-- TOC entry 3 (OID 3593176)
-- Name: kategori_edar_pkrt; Type: TABLE; Schema: public; Owner: depkes2
--

CREATE TABLE kategori_edar_pkrt (
    id_kategori SERIAL NOT NULL,
    nama_kategori character varying(80),
    insert_by character varying(64),
    date_insert bigint
);


--
-- Data for TOC entry 4 (OID 3593176)
-- Name: kategori_edar_pkrt; Type: TABLE DATA; Schema: public; Owner: depkes2
--

COPY kategori_edar_pkrt (id_kategori, nama_kategori, insert_by, date_insert) FROM stdin;
1	PERALATAN KIMIA KLINIK DAN TOKSIKOLOGI KLINIK	admin	1096606364
2	PERALATAN HEMATOLOGI DAN PATOLOGI	admin	1096606401
3	PERALATAN IMUNOLOGI DAN MIKROBIOLOGI	admin	1096606420
4	PERALATAN ANESTESI	admin	1096606433
5	PERALATAN KARDIOLOGI	admin	1096606446
6	PERALATAN GIGI	admin	1096606455
7	PERALATAN TELINGA, HIDUNG DAN TENGGOROKAN (THT)	admin	1096606478
8	PERALATAN GASTROENTEROLOGI - UROLOGI (GU)	admin	1096606508
9	PERALATAN RUMAH SAKIT UMUM DAN PERORANGAN (RSU & P)	admin	1096606532
10	PERALATAN NEUROLOGI	admin	1096606543
11	PERALATAN OBSTETRIK DAN GINEKOLOGI (OG)	admin	1096606576
\.


SELECT pg_catalog.setval('kategori_edar_pkrt_id_kategori_seq', 12, true);


