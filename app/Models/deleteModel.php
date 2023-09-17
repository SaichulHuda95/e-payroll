<?php

namespace App\Models;

use CodeIgniter\Model;

class deleteModel extends Model
{
    public function deleteKaryawan($id_karyawan)
    {
        $builder = $this->db->table('tbl_karyawan');
        $builder->where(['id_karyawan' => $id_karyawan]);
        $query = $builder->delete();
        return $query;
    }

    public function deleteLemburan($id_lembur)
    {
        $builder = $this->db->table('tbl_lembur');
        $builder->where(['id_lembur' => $id_lembur]);
        $query = $builder->delete();
        return $query;
    }

    public function deleteNwnp($id_nwnp)
    {
        $builder = $this->db->table('tbl_nwnp');
        $builder->where(['id_nwnp' => $id_nwnp]);
        $query = $builder->delete();
        return $query;
    }

    public function deleteCuti($id_cuti)
    {
        $builder = $this->db->table('tbl_cuti');
        $builder->where(['id_cuti' => $id_cuti]);
        $query = $builder->delete();
        return $query;
    }

    public function deleteGaji($id_gaji)
    {
        $builder = $this->db->table('tbl_gaji');
        $builder->where(['id_gaji' => $id_gaji]);
        $query = $builder->delete();
        return $query;
    }

    public function deleteJabatan($id_jabatan)
    {
        $builder = $this->db->table('ref_jabatan');
        $builder->where(['id_jabatan' => $id_jabatan]);
        $query = $builder->delete();
        return $query;
    }

    public function deleteStatus($id_status)
    {
        $builder = $this->db->table('ref_status_karyawan');
        $builder->where(['id_status' => $id_status]);
        $query = $builder->delete();
        return $query;
    }

    public function deleteUser($id)
    {
        $builder = $this->db->table('user');
        $builder->where(['id' => $id]);
        $query = $builder->delete();
        return $query;
    }

    public function deleteRole($id)
    {
        $builder = $this->db->table('user_role');
        $builder->where(['id' => $id]);
        $query = $builder->delete();
        return $query;
    }
}
