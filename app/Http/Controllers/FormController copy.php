<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Ortu;

class FormController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required',
            'no_pendaf' => 'required',
            'jurusan' => 'required',
            'alasan' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'anak_ke' => 'required',
            'alamat' => 'required',
            'asal_sekolah' => 'required',
            'no_telp' => 'required',
            'nama_ayah'  => 'required',
            'nama_ibu' => 'required',
            'telp_ortu' => 'required',
            'alamat_ortu' => 'required',
            'kerja_ayah' => 'required',
            'kerja_ibu' => 'required'
        ]);
        $createSiswa=Siswa::create([
            'nama' => $request->nama,
            'no_pendaf' => $request->no_pendaf,
            'jurusan' => $request->jurusan,
            'alasan' => $request->alasan,
            'nisn' => $request->nisn,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'anak_ke' => $request->anak_ke,
            'dari' =>$request->dari,
            'alamat' => $request->alamat,
            'asal_sekolah' => $request->asal_sekolah,
            'alamat_sekolah' => $request->alamat_sekolah,
            'no_telp' => $request->no_telp,
            'hobi' => $request->hobi,
            'jarak' => $request->jarak,
            'transport' => $request->transportasi,
            'informasi' => $request->info,
            //'siswa_id' => $request->id,
        ]);
        $createSiswa->Ortu::create([
            //'siswa_id'=>$request->$createSiswa['id'],
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'telp' => $request->telp_ortu,
            'alamat_ortu' => $request->alamat_ortu,
            'kerjaayah_id' => $request->kerja_ayah,
            'kerjaibu_id' => $request->kerja_ibu,
            'gajiayah_id' => $request->gaji_ayah,
            'gajiibu_id' => $request->gaji_ibu,
        ]);
        return redirect()->back();
    }
}
