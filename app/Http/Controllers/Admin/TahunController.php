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
    public function edit($id) {
        $data = Tahun::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $data = Tahun::findOrFail($request->id);
        $request->validate([
            'tahun' => 'required',
            'tahun_ajaran' => 'required',
            'is_active' => 'required|boolean',
        ]);
        $data->tahun = $request->tahun;
        $data->tahun_ajaran = $request->tahun_ajaran;
        $data->is_active = $request->is_active;
        $data->save();
        return redirect()->back();
    }
    public function destroy(Tahun $tahun,Request $request, $id)
    {
        if ($request->ajax()) {
            $tahun = Tahun::findOrFail($id);
            if($tahun) {
                $tahun->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}
