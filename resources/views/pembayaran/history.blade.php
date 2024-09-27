@extends('adminlte::page')

@section('title', 'History Pembayaran')

@section('content_header')
<h1>Histori Pembayaran</h1>
@include('sweetalert::alert')
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('pembayaran.history') }}" method="GET">
            <div class="row align-items-center">
                <div class="form-group col-lg-4">
                    <label for="start_date">Tgl Awal:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate }}">
                </div>
                <div class="form-group col-lg-4">
                    <label for="end_date">Tgl Akhir:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate }}">
                </div>
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i> Cari Per Tanggal</button>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <a href="{{ route('admin.history.laporan') }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-success">Eksport Laporan</a>

                </div>
            </div>

        </form>
    </div>
<div class="card-body">
<div class="table-responsive">
    <table class="table table-hover text-nowrap">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Siswa</th>
                <th>Tagihan</th>
                <th>Nominal</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($historiPembayaran as $pembayaran=>$p)
            <tr>
                <td>{{ $historiPembayaran->firstItem() + $pembayaran }}</td>
                <td>{{ strtoupper($p->siswa->nama) }}</td>
                <td>{{ $p->tagihan->nama_tagihan ?? 'kosong'}}</td>
                <td><p class="rupiah">{{ $p->nominal }}</p></td>
                <td>{{\Carbon\Carbon::parse($p->created_at)->format('d/m/Y')}}</td>
                <td><a href="hapus/{{ $p->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data pembayaran untuk nama {{$p->siswa->nama}} ?')"><i class="fas fa-trash-alt"></i></a></td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
<div class="card-footer clearfix">
    <ul class="pagination pagination m-0 float-right">
        {!! $historiPembayaran->links() !!}
    </ul>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script type="text/javascript">
    window.deleteConfirm = function (e) {
    e.preventDefault();
    var form = e.target.form;
    swal({
        title: "Yakin akan menghapus data ini?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
      });
    }
</script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function() {
            $('.rupiah').mask('#.##0', {
                reverse: true
            });
        });
</script>
<script> console.log('halaman profil'); </script>
@stop
