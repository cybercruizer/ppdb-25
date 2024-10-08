<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Form Cek Fisik</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/Navbar-vmnt.css') }}">
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    
</head>

<body>
    @include('sweetalert::alert')
    <nav class="navbar navbar-dark navbar-expand-md sticky-top bg-info navigation-clean-search"
        style="padding: 5px;background: rgb(25,111,190);">
        <div class="container-fluid"><a class="navbar-brand" style="color:#eeeeee;" href="#">Form Cek Fisik PPDB 2025/
                2026</a><button class="navbar-toggler" data-toggle="collapse"><span class="sr-only">Toggle
                    navigation</span><span class="navbar-toggler-icon"></span></button></div>
    </nav>
    <form method="post" action="/pendaftar/store">
        {{ csrf_field() }}
        <div class="container">
            <div class="card" style="margin-top: 20px;">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
                @endif
                <div class="card-header bg-info">
                    <h5 class="text-white mb-0">DATA CALON SISWA</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nisn" class="col-4 col-form-label">Nama Calon Siswa</label>
                        <div class="col-8">
                            <select id="nama" name="nama" class="form-control">
                                <option value="">-Pilih Nama Siswa-</option>
                                @foreach ($data['siswa'] as $s )
                                    <option value="{{$s->id}}">{{$s->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_pendaf" class="col-4 col-form-label">Nomor Pendaftaran</label>
                        <div class="col-8">
                            <input value="{{old('no_pendaf')}}" id="no_pendaf" name="no_pendaf" type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jurusan" class="col-4 col-form-label">Jurusan Pilihan</label>
                        <div class="col-8">
                            <input type="text" name="jurusan" id="jurusan" class="form-control" disabled>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="tempat_lahir" class="col-4 col-form-label">Tempat Lahir</label>
                        <div class="col-8">
                            <input value="{{old('tempat_lahir')}}" class="form-control" type="text" name="tempat_lahir" placeholder="Kabupaten/ Kota" id="tempat_lahir" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_lahir" class="col-4 col-form-label">Tanggal Lahir</label>
                        <div class="col-8">
                            <input value="{{old('tgl_lahir')}}" class="form-control" type="date" name="tgl_lahir" id="tgl_lahir" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_kelamin" class="col-4 col-form-label">Jenis Kelamin</label>
                        <div class="col-6">
                            <input class="form-control" name="jenis_kelamin" id="jenis_kelamin" disabled>
                        </div>
                    </div>
                  <div class="form-group row">
                        <label for="tinggi" class="col-4 col-form-label">Tinggi badan</label>
                        <div class="col-md-3 col-8 input-group">
                            <input value="{{old('tinggi')}}" id="tinggi" name="tinggi" type="text" class="form-control" aria-describedby="cm">
                            <div class="input-group-append">
                                <span class="input-group-text" id="cm">cm</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="berat" class="col-4 col-form-label">Berat badan</label>
                        <div class="col-md-3 col-8 input-group">
                            <input value="{{old('berat')}}" id="berat" name="berat" type="text" class="form-control" aria-describedby="kg">
                            <div class="input-group-append">
                                <span class="input-group-text" id="kg">kg</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mata" class="col-4 col-form-label">Mata</label>
                        <div class="col-8">
                            <select name="mata" id="mata" class="form-control">
                                <option value="N" {{ old('mata') == "N" ? 'selected' : '' }} >Normal</option>
                                <option value="BW" {{ old('mata') == "BW" ? 'selected' : '' }} >Buta Warna</option>
                                <option value="RJ" {{ old('mata') == "RJ" ? 'selected' : '' }} >Rabun Jauh</option>
                                <option value="RD" {{ old('mata') == "RD" ? 'selected' : '' }} >Rabun Dekat</option>
                                <option value="P" {{ old('mata') == "P" ? 'selected' : '' }} >Plus</option>
                                <option value="M" {{ old('mata') == "M" ? 'selected' : '' }} >Minus</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mata" class="col-4 col-form-label">Telinga</label>
                        <div class="col-8">
                            <select name="mata" id="mata" class="form-control">
                                <option value="N" {{ old('mata') == "N" ? 'selected' : '' }} >Normal</option>
                                <option value="KNK" {{ old('mata') == "KNK" ? 'selected' : '' }} >Kanan Kurang</option>
                                <option value="KRK" {{ old('mata') == "KRK" ? 'selected' : '' }} >Kiri Kurang</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ibadah" class="col-4 col-form-label">Ibadah</label>
                        <div class="col-8">
                            <select name="ibadah" id="ibadah" class="form-control">
                                <option value="B" {{ old('ibadah') == "B" ? 'selected' : '' }} >Baik</option>
                                <option value="C" {{ old('ibadah') == "C" ? 'selected' : '' }} >Cukup</option>
                                <option value="K" {{ old('ibadah') == "K" ? 'selected' : '' }} >Kurang</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ukuran_baju" class="col-4 col-form-label">Ukuran Baju</label>
                        <div class="col-8">
                            <select name="ukuran_baju" id="ukuran_baju" class="form-control">
                                <option value="">--Pilih ukuran baju--</option>
                                <option value="S" {{ old('ukuran_baju') == "S" ? 'selected' : '' }} >S</option>
                                <option value="M" {{ old('ukuran_baju') == "M" ? 'selected' : '' }} >M</option>
                                <option value="L" {{ old('ukuran_baju') == "L" ? 'selected' : '' }} >L</option>
                                <option value="XL" {{ old('ukuran_baju') == "XL" ? 'selected' : '' }} >XL</option>
                                <option value="XXL" {{ old('ukuran_baju') == "XXL" ? 'selected' : '' }} >XXL</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="row m-3">
                    <div class="col-12 text-center">
                        <p style="margin-top: 20px;">Pastikan data sudah terisi dengan lengkap, kemudian klik tombol "KIRIM
                            FORM" di bawah ini :</p>
                    </div>
                </div>
                <div class="row m-3">
                    <div class="col-12 text-center">
                        <button class="btn btn-primary btn-lg font-weight-bold border rounded shadow-sm" type="submit"
                        style="margin-top: 1px;"><i class="fas fa-paper-plane"></i>&nbsp;KIRIM FORM</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </form>
    
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const jurusanSelect = document.getElementById("jurusan");
            const nomorPendaftaranInput = document.getElementById("no_pendaf");

            jurusanSelect.addEventListener("change", function () {
                const selectedOption = jurusanSelect.value;
                nomorPendaftaranInput.value = selectedOption + "-";
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const showFormCheckbox = document.getElementById("showForm");
            const formInputsContainer = document.getElementById("formInputs");

            showFormCheckbox.addEventListener("change", function () {
                formInputsContainer.style.display = this.checked ? "block" : "none";
            });
        });
    </script>
    <script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#nama').select2();

        $('#nama').on('change', function() {
            var siswaId = $(this).val();

            $.ajax({
                url: '/getSiswaById/' + siswaId,
                type: 'GET',
                success: function(data) {
                    $('#no_pendaf').val(data.no_pendaf);
                    $('#jurusan').val(data.jurusan);
                    $('#tempat_lahir').val(data.tempat_lahir);
                    $('#tgl_lahir').val(data.tgl_lahir);
                    $('#jenis_kelamin').val(data.jenis_kelamin);
                }
            });
        });
    });
</script>
</body>

</html>
