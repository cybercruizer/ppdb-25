<?php

namespace App\Http\Controllers\Bendahara;

use App\Models\Siswa;
use App\Models\Tahun;
use Illuminate\Http\Request;
use App\Models\Bendahara\Payment;
use App\Models\Bendahara\Tagihan;
use App\Http\Controllers\Controller;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('bendahara.access');
    }

    public function index()
    {
        // Ambil data pembayaran dari database dan tampilkan pada halaman view
        $pembayaran = Payment::all();
        return view('pembayaran.index', compact('pembayaran'));
    }

    public function create(Request $request)
    {
        // Ambil data siswa, tagihan, dan tahun dari model untuk ditampilkan di form
        $searchQuery = $request->query('search');

        // Get all students with pagination (20 data per page) and apply search if provided
        $siswaList = Siswa::with('tagihan','payments')->where(function ($query) use ($searchQuery) {
            if ($searchQuery) {
                $query->where('nama', 'like', '%' . $searchQuery . '%');
            }
        })->paginate(20);

        // Get all tagihans for the dropdown
        //$tagihanList = Tagihan::all();

        // Get all tahuns for the dropdown
        //$tahunList = Tahun::all();

        return view('pembayaran.create', compact('siswaList', 'searchQuery'));
    }

    public function store(Request $request)
    {
        // Validasi input data pembayaran (optional)

        $bayar = str_replace('.', '', $request->nominal);
        $validatedData = $request->validate([
            'siswa_id' => 'required',
            'tagihan_id' => 'required',
            //'tahun_id' => 'required',
            //'nominal' => 'required|numeric',
        ]);
        $payment = new Payment;
        $payment->siswa_id = $request->siswa_id;
        $payment->tagihan_id = $request->tagihan_id;
        $payment->nominal = $bayar;
        // Simpan data pembayaran ke database
        $payment->save();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('pembayaran.history')->with('success', 'Data pembayaran berhasil disimpan.');
    }

    public function history(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        // Get historical payments with pagination and apply filter if provided
        $historiPembayaran = Payment::where(function ($query) use ($startDate, $endDate) {
            if ($startDate && $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
        })->paginate(20);

        return view('pembayaran.history', compact('historiPembayaran', 'startDate', 'endDate'));
    }

    public function destroy($id)
    {

        $pembayaran=Payment::findOrFail($id);
        $pembayaran->delete();
        alert()->success('Sukses!','Data berhasil dihapus');
        return redirect()->route('pembayaran.history');
    }


}
