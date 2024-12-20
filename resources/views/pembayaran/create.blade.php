@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
<h1>Input Pembayaran</h1>
@stop

@section('content')
<div class="container-fluid">
    <!-- Form untuk pencarian siswa -->
    <form action="{{ route('pembayaran.create') }}" method="GET">
        <div class="input-group mb-3 col-lg-5">
            <input type="text" name="search" class="form-control" placeholder="Pencarian siswa" aria-label="Pencarian siswa" aria-describedby="basic-addon2" value="{{ request()->query('search') }}">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit">Cari</button>
            </div>
          </div>
    </form>

    <!-- Tabel untuk menampilkan daftar siswa -->
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>No Pendaft</th>
                <th>Jurusan</th>
                <th>Ket.</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswaList as $siswa=>$s)
            <tr>
                <td>{{ $siswaList->firstItem() + $siswa }}</td>
                <td>{{ strToUpper($s->nama) }}</td>
                <td>{{$s->no_pendaf}}</td>
                <td>{{$s->jurusan}}</td>
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
                    <!-- Tombol modal untuk input pembayaran -->
                    <button type="button" class="btn btn-primary btn-sm open-modal" data-toggle="modal" data-target="#inputPembayaranModal" data-siswa-id="{{ $s->id }}" data-tagihan-id="{{ $s->tagihan->id }}" data-tagihan-nominal="{{ $s->tagihan->nominal }}" data-total-pembayaran="{{ $s->total_pembayaran }}">
                        <i class="fas fa-coins"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tampilkan pagination links -->
    <div class="card-footer clearfix">
        <ul class="pagination pagination m-0 float-right">
            {!! $siswaList->links() !!}
        </ul>
    </div>

    <!-- Modal untuk input pembayaran -->
    <div class="modal fade" id="inputPembayaranModal" tabindex="-1" role="dialog" aria-labelledby="inputPembayaranModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputPembayaranModalLabel">Input Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk input pembayaran -->
                    <form action="{{ route('pembayaran.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="siswa_id" id="siswa-id">
                        <input type="hidden" name="tagihan_id" id="tagihan-id">
                        <label for="tagihan">Jumlah Tagihan:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp </span>
                            </div>
                            <input id="tagihan" name="tagihan" type="text" class="form-control rupiah" aria-label="Nominal" aria-describedby="basic-addon1" value="" disabled>
                        </div>
                        <label for="kekurangan">Kekurangan:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp </span>
                            </div>
                            <input id="kekurangan" name="kekurangan" type="text" class="form-control rupiah" aria-label="Nominal" aria-describedby="basic-addon1" value="" disabled>
                        </div>
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

        // Open the modal when the button is clicked
        $('.open-modal').click(function() {
            var siswaId = $(this).data('siswa-id');
            var tagihanId = $(this).data('tagihan-id');
            var tagihanNominal = $(this).data('tagihan-nominal');
            var totalPembayaran = $(this).data('total-pembayaran');

            $('#siswa-id').val(siswaId);
            $('#tagihan-id').val(tagihanId);
            $('#tagihan').val(tagihanNominal);
            $('#kekurangan').val(tagihanNominal - totalPembayaran);
            $('#inputPembayaranModal').modal('show');
        });
    });
</script>
<script> console.log('halaman pembayaran'); </script>
@stop