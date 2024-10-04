<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gelombang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GelombangController extends Controller
{
    public function index()
    {
        $gelombang=Gelombang::get();
        $title = "Gelombang Pendaftaran";
        return view('gelombang_index',compact(['title','gelombang']));
    }
}
