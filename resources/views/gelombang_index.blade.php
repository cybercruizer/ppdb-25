@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>{{ $title }}</h1>
@stop

@section('content')

    <div class="card">
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal awal</th>
                            <th>Tanggal akhir</th>
                            <th>Daftar Ulang</th>
                            <th>Aktif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gelombang as $gel)
                            <tr id="tr_{{ $gel->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $gel->nama }}</td>
                                <td>{{ date('d-m-Y', strtotime($gel->tanggal_awal)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($gel->tanggal_akhir)) }}</td>
                                <td>{{ $gel->formatRupiah('daftar_ulang') }}</td>
                                <td>{{ $gel->is_active==1 ? 'Ya' : 'Tidak' }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $gel->id }}"
                                        data-bs-toggle="modal" data-bs-target="#editModal"><i
                                            class="fas fa-pencil-alt"></i></button>
                                    {{-- <a class="btn btn-primary btn-sm" role="button" href="/admin/gelombang/edit/{{$gel->id}}"><i class="fas fa-pencil-alt"></i></a> --}}
                                    <button onclick="deleteItem(this)" data-id="{{ $gel->id }}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
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
            <form id="editForm" action="{{ route('gelombang.update') }}" method="POST">
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
                            <label for="nama">Name</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_awal">Tanggal Awal</label>
                            <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_akhir">Tanggal AKhir</label>
                            <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir">
                        </div>
                        <div class="form-group">
                            <label for="daftar_ulang">Biaya DU</label>
                            <input type="text" class="form-control" id="daftar_ulang" name="daftar_ulang">
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
                url: '/admin/gelombang/edit/' + dataId,
                type: 'GET',
                success: function(response) {
                    // Populate the modal fields
                    $('#nama').val(response.nama);
                    $('#tanggal_awal').val(response.tanggal_awal);
                    $('#tanggal_akhir').val(response.tanggal_akhir);
                    $('#daftar_ulang').val(response.daftar_ulang);
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
                            url:'{{url("/admin/gelombang/hapus")}}/' +id,
                            data:{
                                "_token": "{{ csrf_token() }}",
                            },
                            success:function(data) {
                                if (data.success){
                                    swalWithBootstrapButtons.fire(
                                        'Terhapus!',
                                        'Data gelombang telah dihapus.',
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
