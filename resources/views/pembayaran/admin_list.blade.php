@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
<h1>Input Pembayaran</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-tools my-3 mr-3">
    <!-- Form untuk pencarian siswa -->
            <form action="{{ route('admin.pembayaran') }}" method="GET">
                <div class="input-group mb-3 mr-3">
                    <input type="text" name="search" class="form-control" placeholder="Pencarian siswa" aria-label="Pencarian siswa" aria-describedby="basic-addon2 value="{{ request()->query('search') }}">
                    <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    <a href="{{ route('pembayaran.exportExcel') }}" class="btn btn-labeled btn-success my-3" target="_blank"><span class="btn-label"><i class="fa fa-arrow-down"></i></span> EXPORT DATA KE EXCEL</a>
    </div>
    <div class="card-body">
    <!-- Tabel untuk menampilkan daftar siswa -->
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>No Pendaft</th>
                <th>Jurusan</th>
                <th>Tagihan</th>
                <th>Ket.</th>
                <th>WA</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswaList as $siswa=>$s)
            <tr>
                <td>{{ $siswaList->firstItem() + $siswa }}</td>
                <td>{{ strToUpper($s->nama) }}</td>
                <td>{{$s->no_pendaf}}</td>
                <td>{{$s->jurusan}}</td>
                <td><span class="rupiah">{{ $s->tagihan->nominal }}</span></td>
                <td>
                    @if (!empty($s))
                        @if ($s->total_pembayaran >= $s->tagihan->nominal)
                            <span class="badge badge-success">Lunas</span>
                        @else
                            <p class="text-danger">Kurang: <span class="rupiah">{{ $s->tagihan->nominal - $s->total_pembayaran }}</span></p>
                        @endif
                    @endif
                </td>
                <td>
                    <a href="https://wa.me/62{{ $s->no_telp }}" class="btn btn-success" target="_blank">WA</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Tampilkan pagination links -->
    <div class="card-footer clearfix">
        <ul class="pagination pagination m-0 float-right">
            {!! $siswaList->links() !!}
        </ul>
    </div>

    @foreach($siswaList as $siswa)
    <div class="modal fade" id="inputPembayaranModal{{ $siswa->id }}" tabindex="-1" role="dialog" aria-labelledby="inputPembayaranModalLabel{{ $siswa->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputPembayaranModalLabel{{ $siswa->id }}">Input Pembayaran untuk {{ $siswa->nama }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk input pembayaran -->
                    <form action="{{ route('pembayaran.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                        <input type="hidden" name="tagihan_id" value="{{ $siswa->tagihan->id }}">
                        {{-- <div class="form-group">
                            <label for="tagihan_id">Pilih Tagihan:</label>
                            <select name="tagihan_id" id="tagihan_id" class="form-control">
                                @foreach($tagihanList as $tagihan)
                                    <option value="{{ $tagihan->id }}">{{ $tagihan->nama_tagihan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tahun_id">Pilih Tahun:</label>
                            <select name="tahun_id" id="tahun_id" class="form-control">
                                @foreach($tahunList as $tahun)
                                    <option value="{{ $tahun->id }}">{{ $tahun->tahun }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <label for="tagihan">Jumlah Tagihan:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp </span>
                            </div>

                            <input id="tagihan" name="tagihan" type="text" class="form-control rupiah" aria-label="Nominal" aria-describedby="basic-addon1" value="{{ $siswa->tagihan->nominal ?? '0' }}" disabled>
                        </div>
                        <label for="kekurangan">Kekurangan:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp </span>
                            </div>

                            <input id="kekurangan" name="kekurangan" type="text" class="form-control rupiah" aria-label="Nominal" aria-describedby="basic-addon1" value="{{ $siswa->tagihan->nominal - $siswa->total_pembayaran }}" disabled>
                        </div>
                        {{-- <div class="form-group">
                            <label for="tagihan">Jumlah Tagihan:</label>
                            <input type="number" name="tagihan" id="tagihan" class="form-control rupiah" value="{{ $siswa->tagihan->nominal ?? '0' }}" disabled>
                        </div> --}}
                        <div class="form-group">
                            <label for="nominal">Nominal Pembayaran:</label>
                            <input type="text" name="nominal" id="nominal" class="form-control rupiah">
                        </div>
                        <button type="text" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function() {
            $('.rupiah').mask('#.##0', {
                reverse: true
            });
        });
</script>
<script> console.log('halaman pembayaran'); </script>
@stop
