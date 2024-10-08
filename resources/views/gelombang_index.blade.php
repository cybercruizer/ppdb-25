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
<div class="table-responsive">
    <table class="table table-hover text-nowrap">
        <thead class="thead-dark">
            <tr>
                <th >No</th>
                <th >Nama</th>
                <th >Tanggal awal</th>
                <th >Tanggal akhir</th>
                <th>Aktif</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
                @forelse ($gelombang as $gel)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $gel->nama }}</td>
                    <td>{{ $gel->tanggal_awal }}</td>
                    <td>{{ $gel->tanggal_akhir }}</td>
                    <td>{{ $gel->is_active }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" role="button" href="/admin/gelombang/edit/{{$gel->id}}"><i class="fas fa-pencil-alt"></i></a>
                        <a href="/admin/gelombang/hapus/{{ $gel->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus {{$gel->nama}} ?')"><i class="far fa-trash-alt"></i></a>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Tidak ada data</td>
                </tr>
                @endforelse
                
        </tbody>
    </table>
</div>
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

