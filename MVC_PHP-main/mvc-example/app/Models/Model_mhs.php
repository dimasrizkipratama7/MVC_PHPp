<?php

/**
 * Model mahasiswa berfungsi untuk menjalankan query
 * Sebelum menggunakan query, load dulu library database
 */

namespace Models;

use Libraries\Database;

class Model_mhs
{
    public function __construct()
    {
        $db = new Database();
        $this->dbh = $db->getInstance();
    }

    function simpanData($nim, $nama, $tgl1)
    {
        $rs = $this->dbh->prepare("INSERT INTO mahasiswa (nim,nama,created_at) VALUES (?,?,?)");
        $rs->execute([$nim, $nama, $tgl1]);
    }

    function lihatData()
    {

        $rs = $this->dbh->query("SELECT * FROM mahasiswa where flag_hapus=0");
        return $rs;
    }

    function lihatDataDetail($id)
    {

        $rs = $this->dbh->prepare("SELECT * FROM mahasiswa WHERE id=?");
        $rs->execute([$id]);
        return $rs->fetch(); // kalau hasil query hanya satu, gunakan method fetch() bawaan PDO
    }

    function deleteData($nim)
    {
        $flag_hapus = "1";
        $tgl_hps = date("Y-m-d h:i:sa");
        $rs = $this->dbh->prepare("UPDATE mahasiswa SET flag_hapus=?,deleted_at=? WHERE nim=?");
        $rs->execute([$flag_hapus, $tgl_hps, $nim]);
    }
}
