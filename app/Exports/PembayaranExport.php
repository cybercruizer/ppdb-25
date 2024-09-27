<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class PembayaranExport implements FromQuery, WithHeadings, WithMapping
{

    public function query()
    {
        return Siswa::with('tagihan')->select(
            'id',
            'no_pendaf',
            'nama',
            'asal_sekolah'
        );
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function map($siswa):array
    {
        return [
            $siswa->id,
            $siswa->no_pendaf,
            $siswa->nama,
            $siswa->asal_sekolah,
            $siswa->tagihan->nominal,
            $siswa->totalPembayaran,
            $siswa->kekurangan()
        ];
    }
    public function headings(): array
    {
        return ['id','No Pendaftaran','Nama','Asal Sekolah','Tagihan','Terbayar','Kekurangan'];
    }
}
