<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\KrsModel;
use App\Models\MahasiswaModel;
use App\Models\MataKuliahModel;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $krsModel = new KrsModel();

        return view('dashboard', [
            'title'           => 'Dashboard Akademik SIAKAD',
            'activeMenu'      => 'dashboard',
            'totalMahasiswa'  => (new MahasiswaModel())->countAllResults(),
            'totalDosen'      => (new DosenModel())->countAllResults(),
            'totalMk'         => (new MataKuliahModel())->countAllResults(),
            'totalKrs'        => $krsModel->countAllResults(),
            'ipkSummary'      => $krsModel->getIpkSummary(),
            'recentKrs'       => array_slice($krsModel->getWithDetails(), 0, 6),
        ]);
    }
}
