<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class StatusController extends Controller
{
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

        $data = [
            ['label' => 'TKJ', 'value' => $tkj, 'sub_value' => $tkjdu],
            ['label' => 'TPM', 'value' => $tpm, 'sub_value' => $tpmdu],
            ['label' => 'TKR', 'value' => $tkr, 'sub_value' => $tkrdu],
            ['label' => 'TSM', 'value' => $tsm, 'sub_value' => $tsmdu],
            ['label' => 'TITL', 'value' => $titl, 'sub_value' => $titldu],
            ['label' => 'KUL', 'value' => $kuliner, 'sub_value' => $kulinerdu],
            ['label' => 'PHT', 'value' => $perhotelan, 'sub_value' => $perhotelandu],
        ];
        //dd($data);
        return view('status', compact(['siswa','siswadu','data','pondok','ap']));
    }
}
