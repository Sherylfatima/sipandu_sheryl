<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class DashboardMasyarakatController extends Controller
{
    //
    public function index(){
        return view('pages.users.index');
    }
}
