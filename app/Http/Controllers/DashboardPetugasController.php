<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPetugasController extends Controller
{
    public function index()
    {
        return view('pages.petugas.dashboard.index');
    }
}
