<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gelombang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GelombangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->perhalaman=30; //Data yang ditampilkan per halaman
    }
    public function index()
    {
        $gelombang=Gelombang::get();
        $title = "Gelombang Pendaftaran";
        return view('gelombang_index',compact(['title','gelombang']));
    }
    public function edit($id)
    {
        $data = Gelombang::findOrFail($id);
        return response()->json($data);
    }
    public function update(Request $request)
    {
        $data = Gelombang::findOrFail($request->id);
        $request->validate([
            'nama' => 'required',
            'daftar_ulang'=>'required|numeric',
            'tanggal_awal'=>'required',
            'tanggal_akhir'=>'required',
            'is_active' => 'required|boolean',
        ]);
        $data->daftar_ulang = $request->daftar_ulang;
        $data->tanggal_awal = $request->tanggal_awal;
        $data->tanggal_akhir = $request->tanggal_akhir;
        $data->is_active = $request->is_active;
        $data->save();
        return redirect()->back();
        
    }
    public function destroy(Gelombang $gelombang, Request $request,$id)
    {
        if ($request->ajax()) {
            $gelombang = Gelombang::findOrFail($id);
            if($gelombang) {
                $gelombang->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}
