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
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tahuns as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->tahun }}</td>
                                <td>{{ $d->tahun_ajaran }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $d->id }}"
                                        data-bs-toggle="modal" data-bs-target="#editModal"><i
                                            class="fas fa-pencil-alt"></i></button>
                                    {{-- <a class="btn btn-primary btn-sm" role="button" href="/admin/gelombang/edit/{{$gel->id}}"><i class="fas fa-pencil-alt"></i></a> --}}
                                    <button onclick="deleteItem(this)" data-id="{{ $d->id }}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                    {{--<a href="{{route('gelombang.destroy', $gel->id)}}" class="btn btn-danger btn-sm" data-confirm-delete="true"><i class="far fa-trash-alt"></i></a> --}}
                                </td>
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
        <!-- Modal Structure -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="editForm" action="{{ route('ta.update') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Tahun</label>
                            <input type="text" class="form-control" id="tahun" name="tahun">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_awal">Tahun Ajaran</label>
                            <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran">
                        </div>
                        <div class="form-group">
                            <label for="is_active">Aktif?</label>
                            <select class="form-control" id="is_active" name="is_active">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                        <input type="hidden" id="data_id" name="id">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveChanges">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).on('click', '.edit-btn', function() {
            var dataId = $(this).data('id');

            // Clear previous modal data
            $('#editForm')[0].reset();

            // Fetch data using AJAX
            $.ajax({
                url: '/admin/ta/edit/' + dataId,
                type: 'GET',
                success: function(response) {
                    // Populate the modal fields
                    $('#tahun').val(response.tahun);
                    $('#tahun_ajaran').val(response.tahun_ajaran);
                    $('#is_active').val(response.is_active === 1 ? 1 : 0);
                    $('#data_id').val(response.id);

                    // Show the modal
                    $('#editModal').modal('show');
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });

    </script>
    <script type="application/javascript">

        function deleteItem(e){

            let id = e.getAttribute('data-id');

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-success mr-2'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Konfirmasi penghapusan',
                text: "Yakin akan menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed){

                        $.ajax({
                            type:'DELETE',
                            url:'{{url("/admin/ta/hapus")}}/' +id,
                            data:{
                                "_token": "{{ csrf_token() }}",
                            },
                            success:function(data) {
                                if (data.success){
                                    swalWithBootstrapButtons.fire(
                                        'Terhapus!',
                                        'Data tahun ajaran telah dihapus.',
                                        "Sukses"
                                    );
                                    $("#tr_"+id).remove(); // you can add name div to remove
                                }

                            }
                        });

                    }

                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        'Data tidak jadi dihapus',
                        'error'
                    );
                }
            });

        }

    </script>
@endpush

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
