<?php

namespace App\Controllers;

use App\Models\deleteModel;
use App\Models\getModel;
use App\Models\insertModel;
use App\Models\updateModel;

class NWNP extends BaseController
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
        $nwnp = $this->get->getNwnp();
        $data = [
            'title' => 'NWNP',
            'session' => $session,
            'nwnp' => $nwnp
        ];
        return view('nwnp/index', $data);
    }

    function tambah_nwnp()
    {
        $karyawan = $this->get->getKaryawan();
        $data = [
            'karyawan' => $karyawan
        ];
        $msg = [
            'data' => view('nwnp/modaltambahnwnp', $data)
        ];

        echo json_encode($msg);
    }

    function simpan_nwnp()
    {
        $session = $this->get->getSession();
        $data_karyawan = explode("_", $this->request->getVar('data_karyawan'));
        $id_karyawan = intval($data_karyawan[0]);
        $nama = $data_karyawan[1];
        $tanggal_absen = $this->request->getVar('tanggal_absen');
        $ket = $this->request->getVar('ket');
        $created_by = $session->username;
        $created_date = date('Y-m-d');
        $data = [
            'id_karyawan' => $id_karyawan,
            'nama' => $nama,
            'tanggal_absen' => $tanggal_absen,
            'ket' => $ket,
            'created_by' => $created_by,
            'created_date' => $created_date,
        ];
        $this->insert->insertNwnp($data);

        session()->setFlashdata('success', 'Penambahan data nwnp berhasil.');
        return redirect()->to('/nwnp');
    }

    function edit_nwnp()
    {
        $id_nwnp = $this->request->getVar('id_nwnp');
        $nwnp_detil = $this->get->getNwnpDetil($id_nwnp);
        $data = [
            'id_nwnp' => $id_nwnp,
            'id_karyawan' => $nwnp_detil->id_karyawan,
            'nama' => $nwnp_detil->nama,
            'tanggal_absen' => $nwnp_detil->tanggal_absen,
            'ket' => $nwnp_detil->ket
        ];
        $msg = [
            'data' => view('nwnp/modaleditnwnp', $data)
        ];
        echo json_encode($msg);
    }

    public function update_nwnp($id_nwnp)
    {
        $session = $this->get->getSession();
        $id_karyawan = $this->request->getVar('id_karyawan');
        $nama = $this->request->getVar('nama');
        $tanggal_absen = $this->request->getVar('tanggal_absen');
        $ket = $this->request->getVar('ket');
        $created_by = $session->username;
        $created_date = date('Y-m-d');
        $data = [
            'id_karyawan' => $id_karyawan,
            'nama' => $nama,
            'tanggal_absen' => $tanggal_absen,
            'ket' => $ket,
            'created_by' => $created_by,
            'created_date' => $created_date
        ];
        $this->update->updateNwnp($id_nwnp, $data);

        session()->setFlashdata('success', 'Perubahan data nwnp berhasil.');
        return redirect()->to('/nwnp');
    }

    function hapus_nwnp()
    {
        $id_nwnp = $this->request->getVar('id_nwnp');

        $this->delete->deleteNwnp($id_nwnp);

        $msg = [
            'sukses' => 'Data berhasil dihapus'
        ];
        echo json_encode($msg);
    }
}
