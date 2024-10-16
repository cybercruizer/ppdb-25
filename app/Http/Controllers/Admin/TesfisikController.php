<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fisik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TesfisikController extends Controller
{
    public function index()
    {
        $siswa = Fisik::with('siswa')->orderBy('id','DESC')->paginate(20);
        //dd($siswa);
        $title = "Hasil tes fisik";
        confirmDelete("Konfirmasi Penghapusan", 'Yakin akan menghapus data ini?');
        return view('tesfisik_index', compact(['siswa','title']));
    }
    public function destroy($id)
    {
        $data = Fisik::find($id);
        $data->delete();
        alert()->success('Sukses!','Data berhasil dihapus');
        return back();
    }
}
