<?php

namespace App\Models;

use CodeIgniter\Model;

class insertModel extends Model
{
    public function insertKaryawan($data)
    {
        $builder = $this->db->table('tbl_karyawan');
        $query = $builder->insert($data);
        return $query;
    }

    public function insertLemburan($data)
    {
        $builder = $this->db->table('tbl_lembur');
        $query = $builder->insert($data);
        return $query;
    }

    public function insertNwnp($data)
    {
        $builder = $this->db->table('tbl_nwnp');
        $query = $builder->insert($data);
        return $query;
    }

    public function insertCuti($data)
    {
        $builder = $this->db->table('tbl_cuti');
        $query = $builder->insert($data);
        return $query;
    }

    public function insertGaji($data)
    {
        $builder = $this->db->table('tbl_gaji');
        $query = $builder->insert($data);
        return $query;
    }

    public function insertJabatan($data)
    {
        $builder = $this->db->table('ref_jabatan');
        $query = $builder->insert($data);
        return $query;
    }

    public function insertStatus($data)
    {
        $builder = $this->db->table('ref_status_karyawan');
        $query = $builder->insert($data);
        return $query;
    }

    public function insertUser($data)
    {
        $builder = $this->db->table('user');
        $query = $builder->insert($data);
        return $query;
    }


    public function insertRole($data)
    {
        $builder = $this->db->table('user_role');
        $query = $builder->insert($data);
        return $query;
    }
}
