<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SiswaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Siswa::select('no_pendaf','nama','tempat_lahir','tgl_lahir','jenis_kelamin','alamat','asal_sekolah','no_telp','jurusan','kategori')->get();
    }
    public function headings(): array
    {
        return ['No Pendaftaran','Nama Pendaftar','Tempat Lahir','Tgl Lahir','JK','Alamat','Asal SMP','No Telp','Jurusan','Kategori'];
    }
}
