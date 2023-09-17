<?php

namespace App\Controllers;

use App\Models\deleteModel;
use App\Models\getModel;
use App\Models\insertModel;
use App\Models\updateModel;
use TCPDF;

class Gaji extends BaseController
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
        $gaji = $this->get->getGaji();
        $data = [
            'title' => 'Manajemen Gaji',
            'session' => $session,
            'gaji' => $gaji
        ];
        return view('gaji/index', $data);
    }

    function tambah_gaji()
    {
        $karyawan = $this->get->getKaryawan();
        $data = [
            'karyawan' => $karyawan
        ];
        $msg = [
            'data' => view('gaji/modaltambahgaji', $data)
        ];

        echo json_encode($msg);
    }

    function get_karyawan()
    {
        $id_karyawan = $this->request->getVar('id_karyawan');
        $karyawan_detil = $this->get->getKaryawanDetil($id_karyawan);
        $awal  = date_create($karyawan_detil->tanggal_masuk);
        $akhir = date_create(); // waktu sekarang
        $diff  = date_diff($awal, $akhir);
        $masa_kerja = $diff->y;
        $insentif = 0;
        if ($masa_kerja < 1 && $karyawan_detil->id_status == '1') {
            $insentif = 1000000;
        } elseif ($masa_kerja == 1 && $karyawan_detil->id_status == '1') {
            $insentif = 1100000;
        } elseif ($masa_kerja > 1 && $karyawan_detil->id_status == '1') {
            $bonus_insentif = $masa_kerja * 100000;
            $insentif = 1000000 + $bonus_insentif;
        }

        $response = [
            'status' => 'sukses',
            'id_karyawan' => $karyawan_detil->id_karyawan,
            'nama' => $karyawan_detil->nama,
            'status' => $karyawan_detil->status,
            'insentif' => $insentif,
            'masa_kerja' => $masa_kerja,
            'tanggal_masuk' => $karyawan_detil->tanggal_masuk,
            'gaji_pokok' => $karyawan_detil->gaji_pokok,
            'tunjangan' => $karyawan_detil->tunjangan,
        ];

        echo json_encode($response);
    }

    function hitung_gaji()
    {
        $id_karyawan = $this->request->getVar('id_karyawan');
        $periode_awal = $this->request->getVar('periode_awal');
        $periode_akhir = $this->request->getVar('periode_akhir');
        $gaji_pokok = $this->request->getVar('gaji_pokok');
        $data_lembur = $this->get->getDataLembur($id_karyawan, $periode_awal, $periode_akhir);
        $get_lembur = $this->get->getTotalLembur($id_karyawan, $periode_awal, $periode_akhir);
        if ($get_lembur->total_lembur == null) {
            $total_lembur = '0';
        } else {
            $total_lembur = $get_lembur->total_lembur;
        }
        $data_nwnp = $this->get->getDataNwnp($id_karyawan, $periode_awal, $periode_akhir);
        $get_nwnp = $this->get->getTotalNwnp($id_karyawan, $periode_awal, $periode_akhir);
        if ($get_nwnp->total_nwnp == null) {
            $pot_nwnp = '0';
        } else {
            $pot_nwnp = intval($get_nwnp->total_nwnp) * intval($gaji_pokok) / 30;
        }

        $response = [
            'status' => 'sukses',
            'data_lembur' => $data_lembur,
            'total_lembur' => $total_lembur,
            'data_nwnp' => $data_nwnp,
            'pot_nwnp' => $pot_nwnp
        ];

        echo json_encode($response);
    }

    function simpan_gaji()
    {
        $session = $this->get->getSession();
        $id_karyawan = $this->request->getVar('id_karyawan');
        $periode_awal = $this->request->getVar('periode_awal');
        $periode_akhir = $this->request->getVar('periode_akhir');
        $get_gaji_pokok = $this->request->getVar('gaji_pokok');
        $gaji_pokok = preg_replace("/[^0-9]/", "", $get_gaji_pokok);
        $get_tunjangan = $this->request->getVar('tunjangan');
        $tunjangan = preg_replace("/[^0-9]/", "", $get_tunjangan);
        $get_insentif = $this->request->getVar('insentif');
        $insentif = preg_replace("/[^0-9]/", "", $get_insentif);
        $get_total_lembur = $this->request->getVar('total_lembur');
        $total_lembur = preg_replace("/[^0-9]/", "", $get_total_lembur);
        $get_pot_nwnp = $this->request->getVar('pot_nwnp');
        $pot_nwnp = preg_replace("/[^0-9]/", "", $get_pot_nwnp);
        $get_pot_bpjs = $this->request->getVar('pot_bpjs');
        $pot_bpjs = preg_replace("/[^0-9]/", "", $get_pot_bpjs);
        $get_total_gaji = $this->request->getVar('total_gaji');
        $total_gaji = preg_replace("/[^0-9]/", "", $get_total_gaji);
        $status_gaji = '0';
        $created_by = $session->username;
        $created_date = date('Y-m-d');
        $data = [
            'id_karyawan' => $id_karyawan,
            'periode_awal' => $periode_awal,
            'periode_akhir' => $periode_akhir,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan' => $tunjangan,
            'insentif' => $insentif,
            'total_lembur' => $total_lembur,
            'pot_nwnp' => $pot_nwnp,
            'pot_bpjs' => $pot_bpjs,
            'total_gaji' => $total_gaji,
            'status_gaji' => $status_gaji,
            'created_by' => $created_by,
            'created_date' => $created_date
        ];
        $this->insert->insertGaji($data);

        session()->setFlashdata('success', 'Penambahan data gaji berhasil.');
        return redirect()->to('/gaji');
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
            'data' => view('gaji/modaldetailgaji', $data)
        ];
        echo json_encode($msg);
    }

    function cetak_gaji($id_gaji)
    {
        require_once(APPPATH . 'helpers/tcpdf/tcpdf.php');
        $gaji_detil = $this->get->getGajiDetil($id_gaji);
        $data = [
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
        $html = view('gaji/cetak_gaji', $data);
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->AddPage();
        $pdf->writeHTML($html);
        $this->response->setContentType('application/pdf');

        $pdf->Output('Slip-Gaji-' . $gaji_detil->nama . '.pdf', 'I');
    }

    function hapus_gaji()
    {
        $id_gaji = $this->request->getVar('id_gaji');

        $this->delete->deleteGaji($id_gaji);

        $msg = [
            'sukses' => 'Data berhasil dihapus'
        ];
        echo json_encode($msg);
    }
}
