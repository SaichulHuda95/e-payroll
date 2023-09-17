<?php

namespace App\Controllers;

use App\Models\getModel;
use App\Models\updateModel;

class Verifikasi extends BaseController
{
    public function __construct()
    {
        $this->get = new getModel();
        $this->update = new updateModel();
    }
    public function index()
    {
        if (session()->get('logged_in') == FALSE) {
            return redirect()->to('/');
        }
        $session = $this->get->getSession();
        $verifikasi_gaji = $this->get->getVerifikasiGaji();
        $data = [
            'title' => 'Pengesahan Gaji',
            'session' => $session,
            'verifikasi_gaji' => $verifikasi_gaji
        ];
        return view('verifikasi/index', $data);
    }

    function detail_gaji()
    {
        $id_gaji = $this->request->getVar('id_gaji');
        $gaji_detil = $this->get->getGajiDetil($id_gaji);
        $data = [
            'id_gaji' => $id_gaji,
            'periode_awal' => $gaji_detil->periode_awal,
            'periode_akhir' => $gaji_detil->periode_akhir,
            'gaji_pokok' => $gaji_detil->gaji_pokok,
            'tunjangan' => $gaji_detil->tunjangan,
            'insentif' => $gaji_detil->insentif,
            'total_lembur' => $gaji_detil->total_lembur,
            'pot_nwnp' => $gaji_detil->pot_nwnp,
            'pot_bpjs' => $gaji_detil->pot_bpjs,
            'total_gaji' => $gaji_detil->total_gaji,
            'status_gaji' => $gaji_detil->status_gaji,
            'jabatan' => $gaji_detil->jabatan,
            'status' => $gaji_detil->status,
            'nama' => $gaji_detil->nama
        ];
        $msg = [
            'data' => view('verifikasi/modaldetailgaji', $data)
        ];
        echo json_encode($msg);
    }

    function pending_gaji()
    {
        $id_gaji = $this->request->getVar('id_gaji');
        $data = [
            'status_gaji' => '2'
        ];

        $this->update->updateStatusGaji($id_gaji, $data);

        $msg = [
            'sukses' => 'Sukses'
        ];
        echo json_encode($msg);
    }

    function verifikasi_gaji()
    {
        $id_gaji = $this->request->getVar('id_gaji');
        $data = [
            'status_gaji' => '1'
        ];

        $this->update->updateStatusGaji($id_gaji, $data);

        $msg = [
            'sukses' => 'Sukses'
        ];
        echo json_encode($msg);
    }
}
