<?php

namespace App\Controllers;

use App\Models\deleteModel;
use App\Models\getModel;
use App\Models\insertModel;
use App\Models\updateModel;

class Cuti extends BaseController
{
    public function __construct()
    {
        $this->delete = new deleteModel();
        $this->get = new getModel();
        $this->insert = new insertModel();
        $this->update = new updateModel();
    }
    public function index()
    {
        if (session()->get('logged_in') == FALSE) {
            return redirect()->to('/');
        }
        $session = $this->get->getSession();
        $cuti = $this->get->getCuti();
        $data = [
            'title' => 'Cuti',
            'session' => $session,
            'cuti' => $cuti
        ];
        return view('cuti/index', $data);
    }

    function tambah_cuti()
    {
        $karyawan = $this->get->getKaryawan();
        $data = [
            'karyawan' => $karyawan
        ];
        $msg = [
            'data' => view('cuti/modaltambahcuti', $data)
        ];

        echo json_encode($msg);
    }

    function simpan_cuti()
    {
        $session = $this->get->getSession();
        $data_karyawan = explode("_", $this->request->getVar('data_karyawan'));
        $id_karyawan = intval($data_karyawan[0]);
        $nama = $data_karyawan[1];
        $tanggal_cuti = $this->request->getVar('tanggal_cuti');
        $ket = $this->request->getVar('ket');
        $created_by = $session->username;
        $created_date = date('Y-m-d');
        $data = [
            'id_karyawan' => $id_karyawan,
            'nama' => $nama,
            'tanggal_cuti' => $tanggal_cuti,
            'ket' => $ket,
            'created_by' => $created_by,
            'created_date' => $created_date,
        ];
        $this->insert->insertCuti($data);

        session()->setFlashdata('success', 'Penambahan data cuti berhasil.');
        return redirect()->to('/cuti');
    }

    function edit_cuti()
    {
        $id_cuti = $this->request->getVar('id_cuti');
        $cuti_detil = $this->get->getCutiDetil($id_cuti);
        $data = [
            'id_cuti' => $id_cuti,
            'id_karyawan' => $cuti_detil->id_karyawan,
            'nama' => $cuti_detil->nama,
            'tanggal_cuti' => $cuti_detil->tanggal_cuti,
            'ket' => $cuti_detil->ket
        ];
        $msg = [
            'data' => view('cuti/modaleditcuti', $data)
        ];
        echo json_encode($msg);
    }

    public function update_cuti($id_cuti)
    {
        $session = $this->get->getSession();
        $id_karyawan = $this->request->getVar('id_karyawan');
        $nama = $this->request->getVar('nama');
        $tanggal_cuti = $this->request->getVar('tanggal_cuti');
        $ket = $this->request->getVar('ket');
        $created_by = $session->username;
        $created_date = date('Y-m-d');
        $data = [
            'id_karyawan' => $id_karyawan,
            'nama' => $nama,
            'tanggal_cuti' => $tanggal_cuti,
            'ket' => $ket,
            'created_by' => $created_by,
            'created_date' => $created_date
        ];
        $this->update->updateCuti($id_cuti, $data);

        session()->setFlashdata('success', 'Perubahan data cuti berhasil.');
        return redirect()->to('/cuti');
    }

    function hapus_cuti()
    {
        $id_cuti = $this->request->getVar('id_cuti');

        $this->delete->deleteCuti($id_cuti);

        $msg = [
            'sukses' => 'Data berhasil dihapus'
        ];
        echo json_encode($msg);
    }
}
