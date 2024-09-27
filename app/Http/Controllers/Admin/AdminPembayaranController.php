<?php

namespace App\Http\Controllers\Admin;

use App\Models\Siswa;
use App\Models\Tahun;
use Illuminate\Http\Request;
use App\Models\Bendahara\Payment;
use App\Models\Bendahara\Tagihan;
use App\Http\Controllers\Controller;

class AdminPembayaranController extends Controller
{
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

        return view('pembayaran.admin_list', compact('siswaList', 'searchQuery'));
    }

    public function createtkj(Request $request)
    {
        // Ambil data siswa, tagihan, dan tahun dari model untuk ditampilkan di form
        $searchQuery = $request->query('search');

        // Get all students with pagination (20 data per page) and apply search if provided
        $siswaList = Siswa::with('tagihan','payments')->where('jurusan','TKJ')->where(function ($query) use ($searchQuery) {
            if ($searchQuery) {
                $query->where('nama', 'like', '%' . $searchQuery . '%');
            }
        })->paginate(20);

        // Get all tagihans for the dropdown
        //$tagihanList = Tagihan::all();

        // Get all tahuns for the dropdown
        //$tahunList = Tahun::all();

        return view('pembayaran.admin_list', compact('siswaList', 'searchQuery'));
    }
    public function cek() {
        $siswas = Siswa::all();
        return view('pembayaran.cek',compact('siswas'));
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
    public function laporan()
    {
        $pembayarans = Payment::with('siswa','tagihan')->get();
        return view('pembayaran.laporan', compact('pembayarans'));
    }
}
