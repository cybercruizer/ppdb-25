@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>{{ $title }}</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <a href="{{ route('pendaftar.exportExcel') }}" class="btn btn-labeled btn-success my-3" target="_blank"><span
                    class="btn-label"><i class="fa fa-arrow-down"></i></span> EXPORT KE EXCEL</a>
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
                            <th style="width: 30px">No Pendaft</th>
                            <th class="col-sm-4">Nama</th>
                            <th class="col-sm-4">Petugas</th>
                            <th class="col-sm-1">Tgl Input</th>
                            <th class="col-sm-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($siswa) && $siswa->count())
                            @foreach ($siswa as $key => $s)
                                <tr>
                                    <td>{{ $siswa->firstItem() + $key }}</td>
                                    <td>{{ $s->siswa->no_pendaf }}</td>
                                    <td>{{ strtoupper($s->siswa->nama) }}</td>
                                    <td>{{ $s->guru->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($s->created_at)->format('d/m/Y H:i:s') }}</td>
                                    <td><a class="btn btn-info btn-sm" role="button"
                                            href="/pendaftar/cetak/{{ $s->id }}"><i class="fas fa-print"></i></a>
                                        <a class="btn btn-primary btn-sm" role="button"
                                            href="/admin/pendaftar/edit/{{ $s->id }}"><i
                                                class="fas fa-pencil-alt"></i></a><br>
                                        <form action="{{ route('admin.tesfisik.destroy', $s->id) }}" method="POST"
                                            style="display: none;" id="delete-form-{{ $s->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $s->id }})"><i class="far fa-trash-alt"></i></button>
                                        {{-- <a href="{{ route('admin.tesfisik.destroy', $s->id) }}" class="btn btn-sm btn-danger" data-confirm-delete="true"><i class="far fa-trash-alt"></i></a> --}}
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
@push('js')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Konfirmasi Penghapusan',
                text: "Yakin akan menghapus data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

    <!-- Success Toast Notification -->
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session("success") }}',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true
                });
            });
        </script>
    @endif

@endpush
@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
