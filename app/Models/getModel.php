<?php

namespace App\Models;

use CodeIgniter\Model;

class getModel extends Model
{
    public function getUserLogin($username)
    {
        $builder = $this->db->table('user');
        $builder->where(['username' => $username]);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getSession()
    {
        $builder = $this->db->table('user');
        $builder->where(['username' => session()->get('username')]);
        $query = $builder->get()->getRow();
        return $query;
    }

    function getKaryawan()
    {
        $db = db_connect();
        $query = "SELECT a.id_karyawan,a.nama,b.jabatan,c.jenis_kelamin,d.status 
        FROM tbl_karyawan AS a 
        LEFT JOIN ref_jabatan AS b ON b.id_jabatan=a.id_jabatan 
        LEFT JOIN ref_jenis_kelamin AS c ON c.id_jenis_kelamin=a.id_jenis_kelamin 
        LEFT JOIN ref_status_karyawan AS d ON d.id_status=a.id_status";
        $builder = $db->query($query);
        $result = $builder->getResult();
        return $result;
    }

    function getKaryawanDetil($id_karyawan)
    {
        $db = db_connect();
        $query = "SELECT a.*,b.jabatan,c.jenis_kelamin,d.status 
        FROM tbl_karyawan AS a 
        LEFT JOIN ref_jabatan AS b ON b.id_jabatan=a.id_jabatan 
        LEFT JOIN ref_jenis_kelamin AS c ON c.id_jenis_kelamin=a.id_jenis_kelamin 
        LEFT JOIN ref_status_karyawan AS d ON d.id_status=a.id_status
        WHERE a.id_karyawan = $id_karyawan";
        $builder = $db->query($query);
        $result = $builder->getRow();
        return $result;
    }

    function getJenisKelamin()
    {
        $db = db_connect();
        $query = "SELECT * FROM ref_jenis_kelamin";
        $builder = $db->query($query);
        $result = $builder->getResult();
        return $result;
    }

    function getJabatan()
    {
        $db = db_connect();
        $query = "SELECT * FROM ref_jabatan";
        $builder = $db->query($query);
        $result = $builder->getResult();
        return $result;
    }

    function getJabatanDetil($id_jabatan)
    {
        $db = db_connect();
        $query = "SELECT * FROM ref_jabatan WHERE id_jabatan = $id_jabatan";
        $builder = $db->query($query);
        $result = $builder->getRow();
        return $result;
    }

    function getStatus()
    {
        $db = db_connect();
        $query = "SELECT * FROM ref_status_karyawan";
        $builder = $db->query($query);
        $result = $builder->getResult();
        return $result;
    }

    function getStatusDetil($id_status)
    {
        $db = db_connect();
        $query = "SELECT * FROM ref_status_karyawan WHERE id_status = $id_status";
        $builder = $db->query($query);
        $result = $builder->getRow();
        return $result;
    }

    function getLembur()
    {
        $db = db_connect();
        $query = "SELECT * FROM tbl_lembur";
        $builder = $db->query($query);
        $result = $builder->getResult();
        return $result;
    }

    function getLemburanDetil($id_lembur)
    {
        $db = db_connect();
        $query = "SELECT a.*,b.status 
        FROM tbl_lembur AS a 
        LEFT JOIN ref_status_karyawan AS b ON b.id_status=a.id_status
        WHERE a.id_lembur = $id_lembur";
        $builder = $db->query($query);
        $result = $builder->getRow();
        return $result;
    }

    function getNwnp()
    {
        $db = db_connect();
        $query = "SELECT * FROM tbl_nwnp";
        $builder = $db->query($query);
        $result = $builder->getResult();
        return $result;
    }

    function getNwnpDetil($id_nwnp)
    {
        $db = db_connect();
        $query = "SELECT * FROM tbl_nwnp WHERE id_nwnp = $id_nwnp";
        $builder = $db->query($query);
        $result = $builder->getRow();
        return $result;
    }

    function getCuti()
    {
        $db = db_connect();
        $query = "SELECT * FROM tbl_cuti";
        $builder = $db->query($query);
        $result = $builder->getResult();
        return $result;
    }

    function getCutiDetil($id_cuti)
    {
        $db = db_connect();
        $query = "SELECT * FROM tbl_cuti WHERE id_cuti = $id_cuti";
        $builder = $db->query($query);
        $result = $builder->getRow();
        return $result;
    }

    function getGaji()
    {
        $db = db_connect();
        $query = "SELECT a.*, b.nama FROM tbl_gaji AS a
        LEFT JOIN tbl_karyawan AS b on b.id_karyawan=a.id_karyawan";
        $builder = $db->query($query);
        $result = $builder->getResult();
        return $result;
    }

    function getDataLembur($id_karyawan, $periode_awal, $periode_akhir)
    {
        $db = db_connect();
        $query = "SELECT * FROM tbl_lembur WHERE id_karyawan = $id_karyawan AND jam_masuk BETWEEN CAST('$periode_awal' AS DATE) AND CAST('$periode_akhir' AS DATE)";
        $builder = $db->query($query);
        $result = $builder->getResult();
        return $result;
    }

    function getTotalLembur($id_karyawan, $periode_awal, $periode_akhir)
    {
        $db = db_connect();
        $query = "SELECT SUM(uang_lembur) AS total_lembur FROM tbl_lembur WHERE id_karyawan = $id_karyawan AND jam_masuk BETWEEN CAST('$periode_awal' AS DATE) AND CAST('$periode_akhir' AS DATE)";
        $builder = $db->query($query);
        $result = $builder->getRow();
        return $result;
    }

    function getDataNwnp($id_karyawan, $periode_awal, $periode_akhir)
    {
        $db = db_connect();
        $query = "SELECT * FROM tbl_nwnp WHERE id_karyawan = $id_karyawan AND tanggal_absen BETWEEN CAST('$periode_awal' AS DATE) AND CAST('$periode_akhir' AS DATE)";
        $builder = $db->query($query);
        $result = $builder->getResult();
        return $result;
    }

    function getTotalNwnp($id_karyawan, $periode_awal, $periode_akhir)
    {
        $db = db_connect();
        $query = "SELECT COUNT(id_nwnp) AS total_nwnp FROM tbl_nwnp WHERE id_karyawan = $id_karyawan AND tanggal_absen BETWEEN CAST('$periode_awal' AS DATE) AND CAST('$periode_akhir' AS DATE)";
        $builder = $db->query($query);
        $result = $builder->getRow();
        return $result;
    }

    function getGajiDetil($id_gaji)
    {
        $db = db_connect();
        $query = "SELECT a.*, b.nama, c.jabatan, d.status FROM tbl_gaji AS a 
        LEFT JOIN tbl_karyawan AS b ON b.id_karyawan=a.id_karyawan
        LEFT JOIN ref_jabatan AS c ON c.id_jabatan=b.id_jabatan
        LEFT JOIN ref_status_karyawan AS d ON d.id_status=b.id_status
        WHERE a.id_gaji = $id_gaji";
        $builder = $db->query($query);
        $result = $builder->getRow();
        return $result;
    }

    function getVerifikasiGaji()
    {
        $db = db_connect();
        $query = "SELECT a.*, b.nama FROM tbl_gaji AS a
        LEFT JOIN tbl_karyawan AS b on b.id_karyawan=a.id_karyawan
        WHERE a.status_gaji = '0'";
        $builder = $db->query($query);
        $result = $builder->getResult();
        return $result;
    }

    public function getCountUser()
    {
        $builder = $this->db->table('user');
        $builder->selectCount('id');
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getUser()
    {
        $builder = $this->db->table('user_role');
        $builder->join('user', 'user.role_id=user_role.id');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getRole()
    {
        $builder = $this->db->table('user_role');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getUserById($id)
    {
        $db = db_connect();
        $builder = $db->query("SELECT a.*, b.role FROM user AS a INNER JOIN user_role AS b ON b.id=a.role_id WHERE a.id = '$id'");
        $query = $builder->getRow();
        return $query;
    }

    public function getRoleById($id)
    {
        $builder = $this->db->table('user_role');
        $builder->where(['id' => $id]);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getRoleAccess($id)
    {
        $builder = $this->db->table('user_role');
        $builder->where(['id' => $id]);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getMenu()
    {
        $builder = $this->db->table('user_menu');
        $query = $builder->get()->getResult();
        return $query;
    }
}
