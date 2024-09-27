@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>{{$title}}</h1>
    @include('sweetalert::alert')
@stop

@section('content')

<div class="card">
    <div class="card-header"> 
        <a href="{{ route('pendaftar.exportExcel') }}" class="btn btn-labeled btn-success my-3" target="_blank"><span class="btn-label"><i class="fa fa-arrow-down"></i></span> EXPORT KE EXCEL</a>
        <div class="card-tools my-3">
            <form action="{{ route('caripendaftar') }}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari nama .." name="cari">
                {{ csrf_field() }}
                <div class="input-group-append">
                  <button class="btn btn-secondary" type="submit">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
            </form>
        </div>
    </div>
<div class="card-body">
    <p>* Data teratas = data pendaftar terakhir</p>
<div class="table-responsive">
    <table class="table table-hover text-nowrap">
        <thead class="thead-dark">
            <tr>
                <th style="width: 30px">No</th>
                <th style="width: 80px">No Pendaft</th>
                <th style="width: 50px">Jurusan</th>
                <th class="col-sm-2">Nama</th>
                <th class="col-sm-1">JK</th>
                <th class="col-sm-1">No Telp</th>
                <th class="col-sm-1">Rekomendator</th>
                <th class="col-sm-1">Tgl Input</th>
                <th class="col-sm-1">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($siswa) && $siswa->count())
                @foreach ($siswa as $key => $s)
                <tr>
                    <td>{{ $siswa->firstItem() + $key }}</td>
                    <td>{{$s->no_pendaf}}</td>
                    <td>{{$s->jurusan}}</td>
                    <td>{{strtoupper($s->nama)}}</td>
                    <td>{{ $s->jenis_kelamin }}</td>
                    <td>{{$s->no_telp}}</td>
                    <td><b>Siswa:</b><br>- {{$s->rekomendator ?? '-'}}<br><b>GuKar:</b><br>- {{ $s->guru->nama ?? '-' }}</td>
                    <td>{{\Carbon\Carbon::parse($s->created_at)->format('d/m/Y')}}</td>

                    <td><a class="btn btn-info btn-sm" role="button" href="/pendaftar/cetak/{{$s->id}}"><i class="fas fa-print"></i></a>
                        <a class="btn btn-primary btn-sm" role="button" href="/admin/pendaftar/edit/{{$s->id}}"><i class="fas fa-pencil-alt"></i></a><br>
                        <a href="/admin/pendaftar/hapus/{{ $s->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data atas nama {{$s->nama}} ?')"><i class="far fa-trash-alt"></i></a>
                        <a class="btn btn-success btn-sm" role="button" href="https://wa.me/+62{{$s->no_telp}}" target="_blank">WA</a>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">Tidak ada data</td>
                </tr>

            @endif
        </tbody>
    </table>
</div>
</div>
<div class="card-footer clearfix">
    <ul class="pagination pagination m-0 float-right">
        {!! $siswa->links() !!}
    </ul>
</div>
</div>
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
@stop

@section('css')
<style>
    .btn-label {
	position: relative;
	left: -12px;
	display: inline-block;
	padding: 6px 12px;
	background: rgba(0, 0, 0, 0.15);
	border-radius: 3px 0 0 3px;
}

.btn-labeled {
	padding-top: 0;
	padding-bottom: 0;
}

.btn {
	margin-bottom: 10px;
}
</style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
