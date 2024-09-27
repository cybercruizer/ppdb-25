@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Histori Pembayaran</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Siswa</th>
                    <th>Tagihan</th>
                    <th>Tahun</th>
                    <th>Nominal</th>
                    <th>Status Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historiPembayaran as $pembayaran)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pembayaran->siswa->nama }}</td>
                    <td>{{ $pembayaran->tagihan->nama_tagihan }}</td>
                    <td>{{ $pembayaran->tahun->tahun }}</td>
                    <td>{{ $pembayaran->nominal }}</td>
                    <td>
                        @if($pembayaran->nominal >= $pembayaran->tagihan->nominal)
                            Lunas
                        @else
                            Kekurangan: {{ $pembayaran->tagihan->nominal - $pembayaran->nominal }}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
