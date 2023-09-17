<?php

namespace App\Controllers;

use App\Models\deleteModel;
use App\Models\getModel;
use App\Models\insertModel;
use App\Models\updateModel;

class Lemburan extends BaseController
{
    public function __construct()
    {
        $this->delete = new deleteModel();
        $this->get = new getModel();
        $this->insert = new insertModel();
        $this->update = new updateModel();
        helper('form');
    }
    public function index()
    {
        if (session()->get('logged_in') == FALSE) {
            return redirect()->to('/');
        }
        $session = $this->get->getSession();
        $lembur = $this->get->getLembur();
        $data = [
            'title' => 'Lemburan',
            'session' => $session,
            'lembur' => $lembur
        ];
        return view('lemburan/index', $data);
    }

    function tambah_lemburan()
    {
        $karyawan = $this->get->getKaryawan();
        $data = [
            'karyawan' => $karyawan
        ];
        $msg = [
            'data' => view('lemburan/modaltambahlemburan', $data)
        ];

        echo json_encode($msg);
    }

    function get_karyawan()
    {
        $id_karyawan = $this->request->getVar('id_karyawan');
        $karyawan_detil = $this->get->getKaryawanDetil($id_karyawan);
        $response = [
            'status' => 'sukses',
            'id_karyawan' => $karyawan_detil->id_karyawan,
            'nama' => $karyawan_detil->nama,
            'id_status' => $karyawan_detil->id_status,
            'status' => $karyawan_detil->status,
            'gaji_pokok' => $karyawan_detil->gaji_pokok,
            'tunjangan' => $karyawan_detil->tunjangan,
        ];

        echo json_encode($response);
    }

    function simpan_lemburan()
    {
        $session = $this->get->getSession();
        $id_karyawan = $this->request->getVar('id_karyawan');
        $id_status = $this->request->getVar('id_status');
        $nama = $this->request->getVar('nama');
        $get_gaji_pokok = $this->request->getVar('gaji_pokok');
        $gaji_pokok = preg_replace("/[^0-9]/", "", $get_gaji_pokok);
        $get_tunjangan = $this->request->getVar('tunjangan');
        $tunjangan = preg_replace("/[^0-9]/", "", $get_tunjangan);
        $jam_masuk = $this->request->getVar('jam_masuk');
        $jam_keluar = $this->request->getVar('jam_keluar');
        $lama_lembur = $this->request->getVar('lama_lembur');
        $get_uang_lembur = $this->request->getVar('uang_lembur');
        $uang_lembur = preg_replace("/[^0-9]/", "", $get_uang_lembur);
        $created_by = $session->username;
        $created_date = date('Y-m-d');
        $data = [
            'id_karyawan' => $id_karyawan,
            'id_status' => $id_status,
            'nama' => $nama,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan' => $tunjangan,
            'jam_masuk' => $jam_masuk,
            'jam_keluar' => $jam_keluar,
            'lama_lembur' => $lama_lembur,
            'uang_lembur' => $uang_lembur,
            'created_by' => $created_by,
            'created_date' => $created_date,
        ];
        $this->insert->insertLemburan($data);

        session()->setFlashdata('success', 'Penambahan data lemburan berhasil.');
        return redirect()->to('/lemburan');
    }

    function edit_lemburan()
    {
        $id_lembur = $this->request->getVar('id_lembur');
        $lemburan_detil = $this->get->getLemburanDetil($id_lembur);
        $data = [
            'id_lembur' => $id_lembur,
            'id_karyawan' => $lemburan_detil->id_karyawan,
            'id_status' => $lemburan_detil->id_status,
            'nama' => $lemburan_detil->nama,
            'status' => $lemburan_detil->status,
            'gaji_pokok' => $lemburan_detil->gaji_pokok,
            'tunjangan' => $lemburan_detil->tunjangan,
            'jam_masuk' => $lemburan_detil->jam_masuk,
            'jam_keluar' => $lemburan_detil->jam_keluar,
            'lama_lembur' => $lemburan_detil->lama_lembur,
            'uang_lembur' => $lemburan_detil->uang_lembur
        ];
        $msg = [
            'data' => view('lemburan/modaleditlemburan', $data)
        ];
        echo json_encode($msg);
    }

    public function update_lemburan($id_lembur)
    {
        $session = $this->get->getSession();
        $id_karyawan = $this->request->getVar('id_karyawan');
        $id_status = $this->request->getVar('id_status');
        $nama = $this->request->getVar('nama');
        $get_gaji_pokok = $this->request->getVar('gaji_pokok');
        $gaji_pokok = preg_replace("/[^0-9]/", "", $get_gaji_pokok);
        $get_tunjangan = $this->request->getVar('tunjangan');
        $tunjangan = preg_replace("/[^0-9]/", "", $get_tunjangan);
        $jam_masuk = $this->request->getVar('jam_masuk');
        $jam_keluar = $this->request->getVar('jam_keluar');
        $lama_lembur = $this->request->getVar('lama_lembur');
        $get_uang_lembur = $this->request->getVar('uang_lembur');
        $uang_lembur = preg_replace("/[^0-9]/", "", $get_uang_lembur);
        $created_by = $session->username;
        $created_date = date('Y-m-d');
        $data = [
            'id_karyawan' => $id_karyawan,
            'id_status' => $id_status,
            'nama' => $nama,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan' => $tunjangan,
            'jam_masuk' => $jam_masuk,
            'jam_keluar' => $jam_keluar,
            'uang_lembur' => $uang_lembur,
            'lama_lembur' => $lama_lembur,
            'created_by' => $created_by,
            'created_date' => $created_date
        ];
        $this->update->updateLemburan($id_lembur, $data);

        session()->setFlashdata('success', 'Perubahan data lemburan berhasil.');
        return redirect()->to('/lemburan');
    }

    function hapus_lemburan()
    {
        $id_lembur = $this->request->getVar('id_lembur');

        $this->delete->deleteLemburan($id_lembur);

        $msg = [
            'sukses' => 'Data berhasil dihapus'
        ];
        echo json_encode($msg);
    }
}
