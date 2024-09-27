<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class sjn72Controller extends Controller
{
    public function sjn72xyz()
    {
        $siswa = Siswa::all();
        $title = 'Data Pendaftar';
        return view('pendaftar_all',['siswa'=>$siswa,'title'=>$title]);
    }
}
