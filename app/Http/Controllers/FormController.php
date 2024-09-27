<?php

namespace App\Http\Controllers;

use App\Models\Ortu;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\Bendahara\Tagihan;

class FormController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_telp' => 'required',
            'nama_ayah' => 'required',
            'alamat' => 'required',
            'tgl_lahir'=> 'required',
            'captcha' => 'required|captcha'
        ]);
        $data=$request->all();

        $siswa = new Siswa;
        $siswa -> nama = $data['nama'];
        $siswa -> no_pendaf = $data['no_pendaf'];
        $siswa -> jurusan = $data['jurusan'];
        //$siswa -> jurusan2 = $data['jurusan2'];
        #$siswa -> alasan = $data['alasan'];
        #$siswa -> nisn = $data['nisn'];
        $siswa -> tempat_lahir = $data['tempat_lahir'];
        $siswa -> tgl_lahir = $data['tgl_lahir'];
        $siswa -> jenis_kelamin = $data['jenis_kelamin'];
        #$siswa -> agama = $data['agama'];
        #$siswa -> anak_ke = $data['anak_ke'];
        #$siswa -> dari = $data['dari'];
        $siswa -> alamat = $data['alamat'];
        $siswa -> asal_sekolah = $data['asal_sekolah'];
        #$siswa -> alamat_sekolah = $data['alamat_sekolah'];
        $siswa -> no_telp = $data['no_telp'];
        #$siswa -> hobi = $data['hobi'];
        #$siswa -> jarak = $data['jarak'];
        #$siswa -> transport = $data['transportasi'];
        #$siswa -> informasi = $data['info'];
        $siswa -> kategori = 'REG';
        $siswa -> save();

        $ortu = new Ortu;
        $ortu -> siswa_id = $siswa->id;
        $ortu -> nama_ayah = $data['nama_ayah'];
        $ortu -> nama_ibu = $data['nama_ibu'];
        #$ortu -> telp = $data['telp_ortu'];
        #$ortu -> alamat_ortu = $data['alamat_ortu'];
        #$ortu -> kerjaayah_id = $data['kerja_ayah'];
        #$ortu -> kerjaibu_id = $data['kerja_ibu'];
        #$ortu -> gajiayah_id = $data['gaji_ayah'];
        #$ortu -> gajiibu_id = $data['gaji_ibu'];
        #$ortu -> nama_wali = $data['nama_wali'];
        #$ortu -> alamat_wali = $data['alamat_wali'];
        #$ortu -> telp_wali = $data['telp_wali'];
        $ortu -> save();

        $nominal_tagihan = 2000000; //ganti sesuai gelombang daftar
        $tagihan = new Tagihan;
        $tagihan -> siswa_id = $siswa->id;
        $tagihan -> nama_tagihan = "ppdb";
        $tagihan -> nominal = $nominal_tagihan;
        $tagihan -> save();

        return redirect()->back()->with('status','Data berhasil diinput');
    }
}
