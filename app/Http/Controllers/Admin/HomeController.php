<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Siswa;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $siswa= Siswa::get();
        $siswadu=Siswa::has('payments')->count();
        $tkj = $siswa->where('jurusan','TKJ')->count();
        $tsm = $siswa->where('jurusan','TSM')->count();
        $tkr = $siswa->where('jurusan','TKR')->count();
        $titl = $siswa->where('jurusan','TITL')->count();
        $tpm = $siswa->where('jurusan','TPM')->count();
        $kuliner = $siswa->where('jurusan','KUL')->count();
        $perhotelan = $siswa->where('jurusan','PHT')->count();
        $pondok = Siswa::where('no_pendaf','LIKE','%PDK%')->count();
        $ap = Siswa::where('no_pendaf','LIKE','%AP%')->count();

        $tkjdu = Siswa::where('jurusan','TKJ')->whereHas('payments')->count();
        $tsmdu = Siswa::where('jurusan','TSM')->whereHas('payments')->count();
        $tkrdu = Siswa::where('jurusan','TKR')->whereHas('payments')->count();
        $titldu = Siswa::where('jurusan','TITL')->whereHas('payments')->count();
        $tpmdu = Siswa::where('jurusan','TPM')->whereHas('payments')->count();
        $kulinerdu = Siswa::where('jurusan','KUL')->whereHas('payments')->count();
        $perhotelandu = Siswa::where('jurusan','PHT')->whereHas('payments')->count();

        $tkjL= Siswa::where('jenis_kelamin','L')->where('jurusan','TKJ')->whereHas('payments')->count();
        $tkjP= Siswa::where('jenis_kelamin','P')->where('jurusan','TKJ')->whereHas('payments')->count();
        $tsmL= Siswa::where('jenis_kelamin','L')->where('jurusan','TSM')->whereHas('payments')->count();
        $tsmP= Siswa::where('jenis_kelamin','P')->where('jurusan','TSM')->whereHas('payments')->count();
        $tkrL= Siswa::where('jenis_kelamin','L')->where('jurusan','TKR')->whereHas('payments')->count();
        $tkrP= Siswa::where('jenis_kelamin','P')->where('jurusan','TKR')->whereHas('payments')->count();
        $titlL= Siswa::where('jenis_kelamin','L')->where('jurusan','TITL')->whereHas('payments')->count();
        $titlP= Siswa::where('jenis_kelamin','P')->where('jurusan','TITL')->whereHas('payments')->count();
        $tpmL= Siswa::where('jenis_kelamin','L')->where('jurusan','TPM')->whereHas('payments')->count();
        $tpmP= Siswa::where('jenis_kelamin','P')->where('jurusan','TPM')->whereHas('payments')->count();
        $kulinerL= Siswa::where('jenis_kelamin','L')->where('jurusan','KUL')->whereHas('payments')->count();
        $kulinerP= Siswa::where('jenis_kelamin','P')->where('jurusan','KUL')->whereHas('payments')->count();
        $perhotelanL= Siswa::where('jenis_kelamin','L')->where('jurusan','PHT')->whereHas('payments')->count();
        $perhotelanP= Siswa::where('jenis_kelamin','P')->where('jurusan','PHT')->whereHas('payments')->count();

        $data = [
            ['label' => 'TKJ', 'value' => $tkj, 'sub_value' => $tkjdu,'tkjL'=>$tkjL, 'tkjP'=>$tkjP],
            ['label' => 'TPM', 'value' => $tpm, 'sub_value' => $tpmdu, 'tpmL'=>$tpmL, 'tpmP'=>$tpmP],
            ['label' => 'TKR', 'value' => $tkr, 'sub_value' => $tkrdu, 'tkrL'=>$tkrL, 'tkrP'=>$tkrP ],
            ['label' => 'TSM', 'value' => $tsm, 'sub_value' => $tsmdu, 'tsmL'=>$tsmL, 'tsmP'=>$tsmP],
            ['label' => 'TITL', 'value' => $titl, 'sub_value' => $titldu,'titlL'=>$titlL, 'titlP'=>$titlP],
            ['label' => 'KUL', 'value' => $kuliner, 'sub_value' => $kulinerdu, 'kulinerL'=>$kulinerL, 'kulinerP'=>$kulinerP],
            ['label' => 'PHT', 'value' => $perhotelan, 'sub_value' => $perhotelandu, 'perhotelanL'=> $perhotelanL, 'perhotelanP'=>$perhotelanP],
        ];
        //dd($data);
        return view('home', compact(['siswa','siswadu','data','pondok','ap']));
    }
}
