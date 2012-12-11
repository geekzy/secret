DROP TABLE cekdetail_adendum_penyalur;
CREATE TABLE cekdetail_adendum_penyalur (
    id_cek_1 integer,
    id_kelengkapan integer,
    status_penilai character varying(64),
    alasan_penilai text,
    alasan_kaseksi text,
    alasan_kasubdit text,
    alasan_direktur text,
    status_kaseksi character varying(64),
    status_kasubdit character varying(64),
    status_direktur character varying(64)
);
