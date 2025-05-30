<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fisik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TesfisikController extends Controller
{
    protected $perhalaman;
    public function __construct()
    {
        $this->middleware('auth');
        $this->perhalaman=30; //Data yang ditampilkan per halaman
    }
    public function index()
    {
        $siswa = Fisik::with('siswa')->orderBy('id','DESC')->paginate(20);
        //dd($siswa);
        $title = "Hasil tes fisik";
        return view('tesfisik_index', compact(['siswa','title']));
    }
    public function edit($id)
{
    $tesFisik = Fisik::findOrFail($id);
    $tesFisik->load('siswa');

    return response()->json($tesFisik);
}
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:fisik,id',
            'tinggi' => 'sometimes|numeric',
            'berat' => 'sometimes|numeric',
            'mata' => 'sometimes|string',
            'telinga'=> 'sometimes|string',
            'penyakit' => 'sometimes|string',
            'obat' => 'sometimes|boolean',
            'tato' => 'sometimes|string',
            'tindik' => 'sometimes|string',
            'disabilitas' => 'sometimes|string',
            'ibadah' => 'sometimes|string',
            'alquran' => 'sometimes|string',
            'ukuran_baju' => 'sometimes|in:S,M,L,XL,XXL',
            'akademik' => 'sometimes|string',
            'non_akademik'=> 'sometimes|string',
            // Add more validation rules for the form fields
        ]);
        //dd($validatedData);
        // Find the record to update
        $record = Fisik::findOrFail($validatedData['id']);
    
        // Update the record with the new data
        $record->update($validatedData);
    
        // Return a success response
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $data = Fisik::find($id);
        $data->delete();
        return redirect()->route('admin.tesfisik')->with('success', 'Data tes fisik berhasil dihapus');
    }
}
