<?php

namespace App\Controllers;

use App\Models\deleteModel;
use App\Models\getModel;
use App\Models\insertModel;
use App\Models\updateModel;

class Karyawan extends BaseController
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
        $karyawan = $this->get->getkaryawan();
        $data = [
            'title' => 'Data Karyawan',
            'session' => $session,
            'karyawan' => $karyawan
        ];
        return view('karyawan/index', $data);
    }

    function tambah_karyawan()
    {
        $jenis_kelamin = $this->get->getJenisKelamin();
        $jabatan = $this->get->getJabatan();
        $status = $this->get->getStatus();
        $data = [
            'jenis_kelamin' => $jenis_kelamin,
            'jabatan' => $jabatan,
            'status' => $status
        ];
        $msg = [
            'data' => view('karyawan/modaltambahkaryawan', $data)
        ];

        echo json_encode($msg);
    }

    function simpan_karyawan()
    {
        $session = $this->get->getSession();
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $tempat_lahir = $this->request->getVar('tempat_lahir');
        $tanggal_lahir = $this->request->getVar('tanggal_lahir');
        $jenis_kelamin = $this->request->getVar('jenis_kelamin');
        $jabatan = $this->request->getVar('jabatan');
        $status = $this->request->getVar('status');
        $get_gaji_pokok = $this->request->getVar('gaji_pokok');
        $gaji_pokok = preg_replace("/[^0-9]/", "", $get_gaji_pokok);
        $get_tunjangan = $this->request->getVar('tunjangan');
        $tunjangan = preg_replace("/[^0-9]/", "", $get_tunjangan);
        $tanggal_masuk = $this->request->getVar('tanggal_masuk');
        $created_by = $session->username;
        $created_date = date('Y-m-d');
        $data = [
            'nama' => $nama,
            'email' => $email,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'id_jenis_kelamin' => $jenis_kelamin,
            'id_jabatan' => $jabatan,
            'id_status' => $status,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan' => $tunjangan,
            'tanggal_masuk' => $tanggal_masuk,
            'created_by' => $created_by,
            'created_date' => $created_date
        ];
        $this->insert->insertKaryawan($data);

        session()->setFlashdata('success', 'Penambahan karyawan berhasil.');
        return redirect()->to('/karyawan');
    }

    public function detail_karyawan($id_karyawan)
    {
        $session = $this->get->getSession();
        $karyawan_detil = $this->get->getKaryawanDetil($id_karyawan);
        $data = [
            'title' => 'Data Karyawan',
            'session' => $session,
            'karyawan_detil' => $karyawan_detil
        ];
        return view('karyawan/karyawan_detil', $data);
    }

    function edit_karyawan()
    {
        $id_karyawan = $this->request->getVar('id_karyawan');
        $karyawan_detil = $this->get->getKaryawanDetil($id_karyawan);
        $jenis_kelamin = $this->get->getJenisKelamin();
        $jabatan = $this->get->getJabatan();
        $status = $this->get->getStatus();
        $data = [
            'id_karyawan' => $id_karyawan,
            'nama' => $karyawan_detil->nama,
            'email' => $karyawan_detil->email,
            'tempat_lahir' => $karyawan_detil->tempat_lahir,
            'tanggal_lahir' => $karyawan_detil->tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'jabatan' => $jabatan,
            'status' => $status,
            'gaji_pokok' => $karyawan_detil->gaji_pokok,
            'tunjangan' => $karyawan_detil->tunjangan,
            'tanggal_masuk' => $karyawan_detil->tanggal_masuk
        ];
        $msg = [
            'data' => view('karyawan/modaleditkaryawan', $data)
        ];
        echo json_encode($msg);
    }

    public function update_karyawan($id_karyawan)
    {
        $session = $this->get->getSession();
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $tempat_lahir = $this->request->getVar('tempat_lahir');
        $tanggal_lahir = $this->request->getVar('tanggal_lahir');
        $jenis_kelamin = $this->request->getVar('jenis_kelamin');
        $jabatan = $this->request->getVar('jabatan');
        $status = $this->request->getVar('status');
        $get_gaji_pokok = $this->request->getVar('gaji_pokok');
        $gaji_pokok = preg_replace("/[^0-9]/", "", $get_gaji_pokok);
        $get_tunjangan = $this->request->getVar('tunjangan');
        $tunjangan = preg_replace("/[^0-9]/", "", $get_tunjangan);
        $tanggal_masuk = $this->request->getVar('tanggal_masuk');
        $created_by = $session->username;
        $created_date = date('Y-m-d');
        $data = [
            'nama' => $nama,
            'email' => $email,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'jabatan' => $jabatan,
            'status' => $status,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan' => $tunjangan,
            'tanggal_masuk' => $tanggal_masuk,
            'created_by' => $created_by,
            'created_date' => $created_date
        ];
        $this->update->updateKaryawan($id_karyawan, $data);

        session()->setFlashdata('success', 'Perubahan data karyawan berhasil.');
        return redirect()->to('/karyawan');
    }

    function hapus_karyawan()
    {
        $id_karyawan = $this->request->getVar('id_karyawan');

        $this->delete->deleteKaryawan($id_karyawan);

        $msg = [
            'sukses' => 'Data berhasil dihapus'
        ];
        echo json_encode($msg);
    }
}
