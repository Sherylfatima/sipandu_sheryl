<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Pengaduan; // Perbaiki namespace model

class GenerateReportController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::all();
        return view('pages.admin.generatereport.index', compact('pengaduans'));
    }

    public function formulir($id)
    {
        $pengaduans = Pengaduan::where('id', $id);
        $petugas = User::all();

        return view('pages.admin.generatereport.formulir_laporan', compact('pengaduans', 'petugas'));
    }
    public function periode()
    {
        return view('pages.admin.generatereport.generateperiode', [
            'title'         => 'APM | Generate Report',
            'header'        => 'Generate Report',
            'breadcrumb1'   => 'Generate Report',
            'breadcrumb2'   => 'Periode'
        ]);
    }

    public function rekap()
    {
        return view('pages.admin.generatereport.generaterekap', [
            'title'         => 'APM | Generate Report',
            'header'        => 'Generate Report',
            'breadcrumb1'   => 'Generate Report',
            'breadcrumb2'   => 'Rekap'
        ]);
    }
}
