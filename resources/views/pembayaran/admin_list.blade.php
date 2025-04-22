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
                    <button class="btn btn-success editTagihanBtn" data-id="{{ $s->id }}" data-nominal="{{ $s->tagihan->nominal }}" data-toggle="modal" data-target="#editTagihanModal"><i class="fas fa-pencil-alt"></i></button>
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
    <div class="modal fade" id="editTagihanModal" tabindex="-1" role="dialog" aria-labelledby="editTagihanModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTagihanModalLabel">Edit Tagihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editTagihanForm">
                        @csrf
                        <input type="hidden" id="siswaId" name="siswa_id">
                        <div class="form-group">
                            <label for="editNominal">Nominal Tagihan:</label>
                            <input type="text" id="editNominal" name="nominal" class="form-control rupiah">
                        </div>
                        <div class="form-group">
                            <label for="pass">PIN EDIT:</label>
                            <input type="password" id="pass" name="pass" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
        });
</script>
<script>
    $(document).ready(function () {
        // Open modal and populate fields
        $('.editTagihanBtn').on('click', function () {
            const siswaId = $(this).data('id');
            const nominal = $(this).data('nominal');

            $('#siswaId').val(siswaId);
            $('#editNominal').val(nominal);
        });

        // Handle form submission via AJAX
        $('#editTagihanForm').on('submit', function (e) {
            e.preventDefault();

            const siswaId = $('#siswaId').val();
            const nominal = $('#editNominal').val();
            const pass = $('#pass').val();
            const url = "{{ route('tagihan.update') }}";

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    siswa_id: siswaId,
                    nominal: nominal,
                    pass:pass
                },
                success: function (response) {
                    alert(response.message); // Display the message sent by the controller
                    location.reload(); // Reload the page to reflect changes
                },
                error: function (xhr) {
                    alert(xhr.responseJSON.message || 'Ada kesalahan saat update tagihan.');
                }
            });
        });
    });
</script>
<script> console.log('halaman pembayaran'); </script>
@stop
