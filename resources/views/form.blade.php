<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Form</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/Navbar-vmnt.css') }}">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-md sticky-top bg-info navigation-clean-search"
        style="padding: 5px;background: rgb(25,111,190);">
        <div class="container-fluid"><a class="navbar-brand" style="color:#eeeeee;" href="#">Form PPDB 2024/
                2025</a><button class="navbar-toggler" data-toggle="collapse"><span class="sr-only">Toggle
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
                        <label for="select" class="col-4 col-form-label">Jurusan Pilihan</label>
                        <div class="col-8">
                            <select id="jurusan" name="jurusan" class="custom-select" id="jurusan">
                                <option value="">-Pilih Jurusan-</option>
                                <option value="TKJ" {{ old('jurusan') == "TKJ" ? 'selected' : '' }}>Teknik Komputer dan Jaringan</option>
                                <option value="TPM" {{ old('jurusan') == "TPM" ? 'selected' : '' }}>Teknik Pemesainan</option>
                                <option value="TITL" {{ old('jurusan') == "TITL" ? 'selected' : '' }}>Teknik Instalasi Tenaga Listrik</option>
                                <option value="TKR" {{ old('jurusan') == "TKR" ? 'selected' : '' }}>Teknik Kendaraan Ringan</option>
                                <option value="TSM" {{ old('jurusan') == "TSM" ? 'selected' : '' }}>Teknik Sepeda Motor</option>
                                <option value="PHT" {{ old('jurusan') == "PHT" ? 'selected' : '' }}>Perhotelan</option>
                                <option value="KUL" {{ old('jurusan') == "KUL" ? 'selected' : '' }}>Kuliner</option>
                            </select>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="jurusan2" class="col-4 col-form-label">Jurusan Pilihan-2</label>
                        <div class="col-8">
                            <select id="jurusan2" name="jurusan2" class="custom-select">
                            <option value="">-Pilih Jurusan-</option>
                                <option value="TKJ" {{ old('jurusan2') == "TKJ" ? 'selected' : '' }}>Teknik Komputer dan Jaringan</option>
                                <option value="TPM" {{ old('jurusan2') == "TPM" ? 'selected' : '' }}>Teknik Pemesainan</option>
                                <option value="TITL" {{ old('jurusan2') == "TITL" ? 'selected' : '' }}>Teknik Instalasi Tenaga Listrik</option>
                                <option value="TKR" {{ old('jurusan2') == "TKR" ? 'selected' : '' }}>Teknik Kendaraan Ringan</option>
                                <option value="TSM" {{ old('jurusan2') == "TSM" ? 'selected' : '' }}>Teknik Sepeda Motor</option>
                                <option value="PHT" {{ old('jurusan2') == "PHT" ? 'selected' : '' }}>Perhotelan</option>
                                <option value="KUL" {{ old('jurusan2') == "KUL" ? 'selected' : '' }}>Kuliner</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label for="no_pendaf" class="col-4 col-form-label">Nomor Pendaftaran</label>
                        <div class="col-8">
                            <input value="{{old('no_pendaf')}}" id="no_pendaf" name="no_pendaf" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tempat_lahir" class="col-4 col-form-label">Tempat Lahir</label>
                        <div class="col-8">
                            <input value="{{old('tempat_lahir')}}" class="form-control" type="text" name="tempat_lahir" placeholder="Kabupaten/ Kota">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_lahir" class="col-4 col-form-label">Tanggal Lahir</label>
                        <div class="col-8">
                            <input value="{{old('tanggal_lahir')}}" class="form-control" type="date" name="tgl_lahir">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-4 col-form-label">Nama Lengkap</label>
                        <div class="col-8">
                            <input value="{{old('nama')}}" id="nama" name="nama" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_kelamin" class="col-4 col-form-label">Jenis Kelamin</label>
                        <div class="col-3">
                            <select class="custom-select" name="jenis_kelamin">
                                <option value="L" selected="">Laki- Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                  <div class="form-group row">
                        <label for="no_telp" class="col-4 col-form-label">No HP</label>
                        <div class="col-8">
                            <input value="{{old('no_telp')}}" id="no_telp" name="no_telp" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="asal_sekolah" class="col-4 col-form-label">Asal SMP</label>
                        <div class="col-8">
                            <input value="{{old('asal_sekolah')}}" id="asal_sekolah" name="asal_sekolah" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_ayah" class="col-4 col-form-label">Nama Ayah</label>
                        <div class="col-8">
                            <input value="{{old('nama_ayah')}}" id="nama_ayah" name="nama_ayah" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_ibu" class="col-4 col-form-label">Nama Ibu</label>
                        <div class="col-8">
                            <input value="{{old('nama_ibu')}}" id="nama_ibu" name="nama_ibu" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-4 col-form-label">Alamat Lengkap</label>
                        <div class="col-8">
                            <textarea value="{{old('alamat')}}" id="alamat" name="alamat" cols="40" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <div class="captcha mx-2">
                            <span>{!! captcha_img() !!}</span>
                            <button type="button" class="btn btn-danger btn-lg" class="reload" id="reload">
                            &#x21bb;
                            </button>
                        </div>
                        <div class="form-group col-12 mt-1">
                            <input id="captcha" type="text" class="form-control" placeholder="Masukkan huruf di atas" name="captcha">
                        </div>
            </div>
                    <p style="margin-top: 20px;">Pastikan data sudah terisi dengan lengkap, kemudian klik tombol "KIRIM
                        FORM" di bawah ini :</p>
                    <button class="btn btn-primary btn-lg font-weight-bold border rounded shadow-sm" type="submit"
                        style="margin-top: 1px;"><i class="fas fa-paper-plane"></i>&nbsp;KIRIM FORM</button>
                </div>
            </div>
        </div>
    </form>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
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
</body>

</html>
