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
                            <th style="width: 50px">Jurusan</th>
                            <th class="col-sm-2">Nama</th>
                            <th class="col-sm-1">JK</th>
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
                                    <td>{{ $s->no_pendaf }}</td>
                                    <td>{{ $s->jurusan }}</td>
                                    <td>{{ strtoupper($s->nama) }}
                                        <br>
                                        <small>Tlp: {{ $s->no_telp }}</small>
                                    </td>
                                    <td>{{ $s->jenis_kelamin }}</td>
                                    <td>
                                        @if ($s->rekomendator != null)
                                            <b>Siswa:</b><br>- {{ $s->rekomendator ?? '-' }}<br>
                                            <b>GuKar:</b><br>- {{ $s->guru->nama ?? '-' }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($s->created_at)->format('d/m/Y') }}</td>

                                    <td><a class="btn btn-info btn-sm" role="button"
                                            href="/pendaftar/cetak/{{ $s->id }}"><i class="fas fa-print"></i></a>
                                        <a class="btn btn-primary btn-sm" role="button"
                                            href="/admin/pendaftar/edit/{{ $s->id }}"><i
                                                class="fas fa-pencil-alt"></i></a><br>
                                        <button type="submit" class="btn btn-danger btn-sm delete-button"
                                            data-toggle="tooltip" title="Delete" data-id="{{ $s->id }}" data-text="{{ $s->nama}}"><i
                                                class="far fa-trash-alt"></i></button>
                                        {{-- <a href="{{ route('pendaftar.destroy', $s->id) }}" class="btn btn-danger btn-sm"
                                            data-confirm-delete="true"><i class="far fa-trash-alt"></i></a> --}}
                                        <a class="btn btn-success btn-sm" role="button"
                                            href="https://wa.me/+62{{ $s->no_telp }}" target="_blank">WA</a>
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
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.delete-button').click(function() {
                var id = $(this).data('id');
                var text = $(this).data('text');
                var button = $(this);
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                // Tampilkan konfirmasi delete 
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Anda akan menghapus " + text + ". Data yang sudah dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Lakukan request delete ke server 
                        $.ajax({
                            url: '/admin/pendaftar/destroy/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                // Tampilkan toast sukses 
                                Toast.fire({
                                    icon: 'success',
                                    title: text + ' berhasil dihapus'
                                });
                                // Optional: hapus baris tabel atau lainnya 
                                button.closest('tr').remove();
                            },
                            error: function(xhr) { // Tampilkan toast error 
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Ada kesalahan dalam penghapusan data'
                                });
                            }
                        });
                    }
                });
            });
        });
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
