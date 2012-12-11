DROP TABLE cekdetail_registrasi_produksi;
CREATE TABLE cekdetail_registrasi_produksi (
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
