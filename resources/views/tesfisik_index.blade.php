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
                                    <td>{{ $s->siswa->no_pendaf ?? '-' }}</td>
                                    <td>{{ strtoupper($s->siswa->nama) ?? '-' }}</td>
                                    <td>{{ $s->guru->nama ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($s->created_at)->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm" role="button"
                                            href="/pendaftar/cetak/{{ $s->id }}"><i class="fas fa-print"></i></a>
                                        <button class="btn btn-primary btn-sm" role="button"
                                            onclick="editData({{ $s->id }})"><i
                                                class="fas fa-pencil-alt"></i></button>
                                        <form action="{{ route('admin.tesfisik.destroy', $s->id) }}" method="POST"
                                            style="display: none;" id="delete-form-{{ $s->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $s->id }})"><i class="far fa-trash-alt"></i></button>
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

    <!-- Modal for Editing Data -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editForm" action="{{ route('admin.tesfisik.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="data-id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="nama" class="col-4 col-form-label">Nama Calon Siswa</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="nama" name="nama" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_pendaf" class="col-4 col-form-label">Nomor Pendaftaran</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="no_pendaf" name="no_pendaf" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jurusan" class="col-4 col-form-label">Jurusan Pilihan</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="jurusan" name="jurusan" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tempat_lahir" class="col-4 col-form-label">Tempat Lahir</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_lahir" class="col-4 col-form-label">Tanggal Lahir</label>
                            <div class="col-8">
                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_kelamin" class="col-4 col-form-label">Jenis Kelamin</label>
                            <div class="col-6">
                                <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tinggi" class="col-4 col-form-label">Tinggi badan</label>
                            <div class="col-md-3 col-8 input-group">
                                <input type="number" step="0.1" class="form-control" id="tinggi" name="tinggi"
                                    aria-describedby="cm">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="cm">cm</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="berat" class="col-4 col-form-label">Berat badan</label>
                            <div class="col-md-3 col-8 input-group">
                                <input type="number" step="0.1" class="form-control" id="berat" name="berat"
                                    aria-describedby="kg">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="kg">kg</span>
                                </div>
                            </div>
                        </div>
                        <!-- Add other fields from the form_cekfisik.blade.php here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
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

        function editData(id) {
            // Fetch data for the selected ID and populate the modal form
            $.ajax({
                url: '/admin/tesfisik/' + id + '/edit',
                type: 'GET',
                success: function(data) {
                    // Populate the modal form with the fetched data
                    $('#data-id').val(data.id);
                    $('#nama').val(data.siswa.nama);
                    $('#no_pendaf').val(data.siswa.no_pendaf);
                    $('#jurusan').val(data.siswa.jurusan);
                    $('#tempat_lahir').val(data.siswa.tempat_lahir);
                    $('#tgl_lahir').val(data.siswa.tgl_lahir);
                    $('#jenis_kelamin').val(data.siswa.jenis_kelamin);
                    $('#tinggi').val(data.tinggi);
                    $('#berat').val(data.berat);
                    // Add more form fields as needed
                }
            });

            // Show the modal
            $('#editModal').modal('show');
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
                    title: '{{ session('success') }}',
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