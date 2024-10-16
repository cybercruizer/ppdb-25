<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>Form Cek Fisik</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/Navbar-vmnt.css') }}">
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap4.css') }}">
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <style>
        #hiddenDiv {
            display: none;
        }
    </style>

</head>

<body>
    @include('sweetalert::alert')

    <nav class="navbar navbar-dark navbar-expand-md sticky-top bg-info navigation-clean-search"
        style="padding: 5px;background: rgb(25,111,190);">
        <div class="container-fluid"><a class="navbar-brand" style="color:#eeeeee;"
                href="#">{{ $data['title'] }}</a><button class="navbar-toggler" data-toggle="collapse"><span
                    class="sr-only">Toggle
                    navigation</span><span class="navbar-toggler-icon"></span></button></div>
    </nav>

    <div class="container" id="protected-content">
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
            <div class="card-header bg-info text-center">
                <h5 class="text-white mb-0">INPUT TES FISIK</h5>
            </div>
            <div class="row form-group m-2" id="pinInputDiv">
                <div class="col-3">
                    <input type="password" id="pinInput" placeholder="Masukkan PIN" class="form-control">
                </div>
                <div class="col-3">
                    <button id="submitBtn" class="btn btn-primary">Kirim</button>
                </div>
            </div>
            <form method="post" action="/tesfisik/store">
                @csrf
                <div class="card-body" id="hiddenDiv">
                    <div class="form-group row">
                        <label for="nama" class="col-4 col-form-label">Nama Calon Siswa</label>
                        <div class="col-8">
                            <select id="nama" name="nama" class="form-control">
                                
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="siswa_id" value="" id="siswa_id">
                    <div class="form-group row">
                        <label for="no_pendaf" class="col-4 col-form-label">Nomor Pendaftaran</label>
                        <div class="col-8">
                            <input value="{{ old('no_pendaf') }}" id="no_pendaf" name="no_pendaf" type="text"
                                class="form-control" disabled>
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
                            <input value="{{ old('tempat_lahir') }}" class="form-control" type="text"
                                name="tempat_lahir" placeholder="Kabupaten/ Kota" id="tempat_lahir" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_lahir" class="col-4 col-form-label">Tanggal Lahir</label>
                        <div class="col-8">
                            <input value="{{ old('tgl_lahir') }}" class="form-control" type="date" name="tgl_lahir"
                                id="tgl_lahir" disabled>
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
                            <input value="{{ old('tinggi') }}" id="tinggi" name="tinggi" type="number"
                                step="0.1" class="form-control" aria-describedby="cm">
                            <div class="input-group-append">
                                <span class="input-group-text" id="cm">cm</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="berat" class="col-4 col-form-label">Berat badan</label>
                        <div class="col-md-3 col-8 input-group">
                            <input value="{{ old('berat') }}" id="berat" name="berat" type="number"
                                step="0.1" class="form-control" aria-describedby="kg">
                            <div class="input-group-append">
                                <span class="input-group-text" id="kg">kg</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mata" class="col-4 col-form-label">Mata</label>
                        <div class="col-8">
                            <select name="mata" id="mata" class="form-control">
                                <option value="N" {{ old('mata') == 'N' ? 'selected' : '' }}>Normal</option>
                                <option value="BW" {{ old('mata') == 'BW' ? 'selected' : '' }}>Buta Warna
                                </option>
                                <option value="RJ" {{ old('mata') == 'RJ' ? 'selected' : '' }}>Rabun Jauh
                                </option>
                                <option value="RD" {{ old('mata') == 'RD' ? 'selected' : '' }}>Rabun Dekat
                                </option>
                                <option value="P" {{ old('mata') == 'P' ? 'selected' : '' }}>Plus</option>
                                <option value="M" {{ old('mata') == 'M' ? 'selected' : '' }}>Minus</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telinga" class="col-4 col-form-label">Telinga</label>
                        <div class="col-8">
                            <select name="telinga" id="telinga" class="form-control">
                                <option value="N" {{ old('telinga') == 'N' ? 'selected' : '' }}>Normal</option>
                                <option value="KNK" {{ old('telinga') == 'KNK' ? 'selected' : '' }}>Kanan Kurang
                                </option>
                                <option value="KRK" {{ old('telinga') == 'KRK' ? 'selected' : '' }}>Kiri Kurang
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="penyakit" class="col-4 col-form-label">Penyakit</label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="penyakit" value="{{ old('penyakit') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="obat" class="col-4 col-form-label">Ketergantungan obat</label>
                        <div class="col-8">
                            <select name="obat" id="obat" class="form-control">
                                <option value="0" {{ old('obat') == '0' ? 'selected' : '' }}>Tidak</option>
                                <option value="1" {{ old('obat') == '1' ? 'selected' : '' }}>Ya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tato" class="col-4 col-form-label">Tato / Tindik</label>
                        <div class="col-8">
                            <select name="tato" id="tato" class="form-control">
                                <option value="N" {{ old('tato') == 'N' ? 'selected' : '' }}>Tidak ada
                                    tato/tindik</option>
                                <option value="TA" {{ old('tato') == 'TA' ? 'selected' : '' }}>Ada tato
                                </option>
                                <option value="TI" {{ old('tato') == 'TI' ? 'selected' : '' }}>Ada tindik
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="disabilitas" class="col-4 col-form-label">Disabilitas</label>
                        <div class="col-8">
                            <select name="disabilitas" id="disabilitas" class="form-control">
                                <option value="N" {{ old('disabilitas') == 'N' ? 'selected' : '' }}>Tidak
                                </option>
                                <option value="TW" {{ old('disabilitas') == 'TW' ? 'selected' : '' }}>Tuna
                                    Wicara</option>
                                <option value="TR" {{ old('disabilitas') == 'TR' ? 'selected' : '' }}>Tuna
                                    Rungu</option>
                                <option value="TN" {{ old('disabilitas') == 'TN' ? 'selected' : '' }}>Tuna
                                    Netra</option>
                                <option value="TD" {{ old('disabilitas') == 'TD' ? 'selected' : '' }}>Tuna
                                    Daksa</option>
                                <option value="TG" {{ old('disabilitas') == 'TG' ? 'selected' : '' }}>Tuna
                                    Grahita</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ibadah" class="col-4 col-form-label">Ibadah</label>
                        <div class="col-8">
                            <select name="ibadah" id="ibadah" class="form-control">
                                <option value="B" {{ old('ibadah') == 'B' ? 'selected' : '' }}>Baik</option>
                                <option value="C" {{ old('ibadah') == 'C' ? 'selected' : '' }}>Cukup</option>
                                <option value="K" {{ old('ibadah') == 'K' ? 'selected' : '' }}>Kurang
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alquran" class="col-4 col-form-label">Al Quran</label>
                        <div class="col-8">
                            <select name="alquran" id="alquran" class="form-control">
                                <option value="S" {{ old('alquran') == 'S' ? 'selected' : '' }}>Sesuai tajwid
                                </option>
                                <option value="B" {{ old('alquran') == 'B' ? 'selected' : '' }}>Baik, lancar
                                </option>
                                <option value="T" {{ old('alquran') == 'T' ? 'selected' : '' }}>Terbata-bata
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ukuran_baju" class="col-4 col-form-label">Ukuran Baju</label>
                        <div class="col-8">
                            <select name="ukuran_baju" id="ukuran_baju" class="form-control">
                                <option value="">--Pilih ukuran baju--</option>
                                <option value="S" {{ old('ukuran_baju') == 'S' ? 'selected' : '' }}>S
                                </option>
                                <option value="M" {{ old('ukuran_baju') == 'M' ? 'selected' : '' }}>M
                                </option>
                                <option value="L" {{ old('ukuran_baju') == 'L' ? 'selected' : '' }}>L
                                </option>
                                <option value="XL" {{ old('ukuran_baju') == 'XL' ? 'selected' : '' }}>XL
                                </option>
                                <option value="XXL" {{ old('ukuran_baju') == 'XXL' ? 'selected' : '' }}>XXL
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 bg-info text-center">
                            <h5 class="text-white mb-1 mt-1">PRESTASI</h5>
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label for="akademik" class="col-4 col-form-label">Akademik</label>
                        <div class="col-8">
                            <textarea name="akademik" id="akademik" rows="3" class="form-control" placeholder="1.">{{ old('akademik') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="non_akademik" class="col-4 col-form-label">Non akademik</label>
                        <div class="col-8">
                            <textarea name="non_akademik" id="non_akademik" rows="3" class="form-control" placeholder="1.">{{ old('non_akademik') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="penguji" class="col-4 col-form-label">Petugas</label>
                        <div class="col-8">
                            <select name="penguji" id="penguji" class="form-control" searchable>
                                <option value="" selected>--Pilih Nama Penguji--</option>
                                @foreach ($data['penguji'] as $peng)
                                    <option value="{{ $peng->id }}">{{ $peng->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="pin" value="1972">
                    <div class="row m-3">
                        <div class="col-12 text-center">
                            <p style="margin-top: 20px;">Pastikan data sudah terisi dengan lengkap, kemudian klik
                                tombol
                                "KIRIM
                                FORM" di bawah ini :</p>
                        </div>
                    </div>
                    <div class="row m-3">
                        <div class="col-12 text-center">
                            <button class="btn btn-primary btn-lg font-weight-bold border rounded shadow-sm"
                                type="submit" style="margin-top: 1px;"><i class="fas fa-paper-plane"></i>&nbsp;KIRIM
                                FORM</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const jurusanSelect = document.getElementById("jurusan");
            const nomorPendaftaranInput = document.getElementById("no_pendaf");

            jurusanSelect.addEventListener("change", function() {
                const selectedOption = jurusanSelect.value;
                nomorPendaftaranInput.value = selectedOption + "-";
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const showFormCheckbox = document.getElementById("showForm");
            const formInputsContainer = document.getElementById("formInputs");

            showFormCheckbox.addEventListener("change", function() {
                formInputsContainer.style.display = this.checked ? "block" : "none";
            });
        });
    </script>
    <script type="text/javascript">
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
    <script>
        const correctPin = String(@json($data['pin']));  // Laravel Blade directive to pass PHP variable to JavaScript

        $(document).ready(function() {
            $('#submitBtn').click(function() {
                const enteredPin = $('#pinInput').val();

                if (enteredPin === correctPin) {
                    $('#hiddenDiv').show();
                    $('#pinInputDiv').hide();
                } else {
                    alert('PIN salah, coba lagi');
                }
            });
        });
    </script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //console.log(CSRF_TOKEN);
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#nama').select2({
                theme: 'bootstrap-4',
                minimumInputLength: 3,
                width: '100%',
                placeholder: 'Pilih Siswa',
                ajax: {
                    url: "{{ route('pendaftar.ajax') }}",
                    //headers: CSRF_TOKEN,
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            cari: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response,
                        };
                    },
                    cache: true
                }
            });

            var oldNama = '{{ old('nama') }}';
            if (oldNama) {
                // Perform an AJAX request to get the old value and select it
                $.ajax({
                    url: "{{ route('pendaftar.ajax') }}",
                    type: "get",
                    data: {
                        cari: oldNama
                    },
                    success: function(response) {
                        var selectedOption = response.find(function(option) {
                            return option.id == oldNama;
                        });

                        if (selectedOption) {
                            // Create a new option with the old value and select it
                            var newOption = new Option(selectedOption.text, selectedOption.id, true, true);
                            $('#nama').append(newOption).trigger('change');
                        }
                    }
                });
            }

            $('#nama').on('change', function() {
                var siswaId = $(this).val();

                $.ajax({
                    url: '/getSiswaById/' + siswaId,
                    type: 'GET',
                    success: function(data) {
                        $('#siswa_id').val(data.id);
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
