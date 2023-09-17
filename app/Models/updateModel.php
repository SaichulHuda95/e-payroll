<?php

namespace App\Models;

use CodeIgniter\Model;

class updateModel extends Model
{
    public function updateKaryawan($id_karyawan, $data)
    {
        $builder = $this->db->table('tbl_karyawan');
        $builder->where(['id_karyawan' => $id_karyawan]);
        $query = $builder->update($data);
        return $query;
    }

    public function updateLemburan($id_lembur, $data)
    {
        $builder = $this->db->table('tbl_lembur');
        $builder->where(['id_lembur' => $id_lembur]);
        $query = $builder->update($data);
        return $query;
    }

    public function updateNwnp($id_nwnp, $data)
    {
        $builder = $this->db->table('tbl_nwnp');
        $builder->where(['id_nwnp' => $id_nwnp]);
        $query = $builder->update($data);
        return $query;
    }

    public function updateCuti($id_cuti, $data)
    {
        $builder = $this->db->table('tbl_cuti');
        $builder->where(['id_cuti' => $id_cuti]);
        $query = $builder->update($data);
        return $query;
    }

    public function updateStatusGaji($id_gaji, $data)
    {
        $builder = $this->db->table('tbl_gaji');
        $builder->where(['id_gaji' => $id_gaji]);
        $query = $builder->update($data);
        return $query;
    }

    public function updateJabatan($id_jabatan, $data)
    {
        $builder = $this->db->table('ref_jabatan');
        $builder->where(['id_jabatan' => $id_jabatan]);
        $query = $builder->update($data);
        return $query;
    }

    public function updateStatus($id_status, $data)
    {
        $builder = $this->db->table('ref_status_karyawan');
        $builder->where(['id_status' => $id_status]);
        $query = $builder->update($data);
        return $query;
    }

    public function updatePassword($id, $data)
    {
        $builder = $this->db->table('user');
        $builder->where(['id' => $id]);
        $query = $builder->update($data);
        return $query;
    }

    public function updateUser($id, $data)
    {
        $builder = $this->db->table('user');
        $builder->where(['id' => $id]);
        $query = $builder->update($data);
        return $query;
    }

    public function updateRole($id, $data)
    {
        $builder = $this->db->table('user_role');
        $builder->where(['id' => $id]);
        $query = $builder->update($data);
        return $query;
    }

    public function updateFoto($id, $data)
    {
        $builder = $this->db->table('user');
        $builder->where(['id' => $id]);
        $query = $builder->update($data);
        return $query;
    }
}
