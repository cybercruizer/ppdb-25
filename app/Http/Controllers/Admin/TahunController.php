<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tahun;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TahunController extends Controller
{
    public function index()
    {
        $data['title'] = 'Tahun Ajaran';
        $data['tahuns'] = Tahun::all();
        //dd($data);
        return view('tahun_index', $data);
    }
}
