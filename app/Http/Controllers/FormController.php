<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ortu;
use App\Models\Siswa;
use App\Models\Gelombang;
use Illuminate\Http\Request;
use App\Models\Bendahara\Tagihan;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class FormController extends Controller
{
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'nama' => 'required',
            'no_telp' => 'required',
            'nama_ayah' => 'required',
            'alamat' => 'required',
            'tgl_lahir'=> 'required',
            'captcha' => 'required|captcha',
            'jenis_kelamin' => 'required',
        ]);
        if ($validator->fails())
        {
            //$errors=$validator->errors()->getMessages();
            //dd($errors);
            alert()->error('Error','Ada kesalahan dalam input');
            return back()->withInput();
        }
        $tanggal_daftar = Carbon::now();
        $gelombang= Gelombang::whereDate('tanggal_awal','<=',$tanggal_daftar)->whereDate('tanggal_akhir','>=',$tanggal_daftar)->select('id','daftar_ulang')->first();
        //dd($gelombang->daftar_ulang);
        if($request->jenis_kelamin=="L"){
            $du=$gelombang->daftar_ulang;
        } else {
            $du=$gelombang->daftar_ulang+100000;
        }
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
        //ganti sesuai gelombang daftar
        $tagihan = new Tagihan;
        $tagihan -> siswa_id = $siswa->id;
        $tagihan -> nama_tagihan = "ppdb";
        $tagihan -> nominal = $du;
        $tagihan -> save();

        alert()->success('Sukses!','Data berhasil diinput');
        return redirect()->back();
    }
    public function tesfisik()
    {
        $data= [];
        $data ['siswa'] = Siswa::select('id','nama')->get();
        $data ['title'] = 'Form Cek Fisik';
        //dd($data);
        return view('form_cekfisik', compact('data'));
    }
    public function getSiswaById($id)
    {
        $siswa = Siswa::find($id);
        return response()->json($siswa);
    }
}
