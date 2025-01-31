@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>EDIT SISWA : {{$siswa->nama}}</h1>
    @include('sweetalert::alert')
	<script>
		window.onload=passwordCheck;
		function passwordCheck()
		{
    		var password = prompt("Masukkan PIN pengaman");
    		if (password !== "4321") {
        		passwordCheck();
    		}
		}
	</script>
@stop

@section('content')
<form method="post" action="{{ route('pendaftar.update', $siswa->id) }}">
    {{ csrf_field() }}
    @method('PUT')
<div class="container">
    <div class="card" style="margin-top: 20px;">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="card-header bg-info">
            <h5 class="text-white mb-0">DATA CALON SISWA</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive border rounded">
                <table class="table table-striped table-borderless">
                    <tbody>
                        <tr>
                            <td>Nama lengkap</td>
                            <td><input class="border rounded-pill shadow-sm form-control-lg" type="text" name="nama" style="width: 100%;" value="{{$siswa->nama}}"></td>
                        </tr>
                        <tr>
                            <td>Nomor pendaftaran</td>
                            <td><input class="border rounded-pill shadow-sm form-control-lg" type="text" name="no_pendaf" style="width: 100%;" value="{{$siswa->no_pendaf}}"></td>
                        </tr>
                        <tr>
                            <td>Jurusan</td>
                            <td><select class="border rounded-pill shadow-sm form-control-lg" name="jurusan">
                                    <option value="TKJ" {{$siswa->jurusan == 'TKJ' ? 'selected' : '' }}>Teknik Komputer dan Jaringan</option>
                                    <option value="TPM"{{$siswa->jurusan == 'TPM' ? 'selected' : '' }}>Teknik Pemesainan</option>
                                    <option value="TITL" {{$siswa->jurusan == 'TITL' ? 'selected' : '' }}>Teknik Instalasi Tenaga Listrik</option>
                                    <option value="TKR" {{$siswa->jurusan == 'TKR' ? 'selected' : '' }}>Teknik Kendaraan Ringan</option>
                                    <option value="TSM" {{$siswa->jurusan == 'TSM' ? 'selected' : '' }}>Teknik Sepeda Motor</option>
                                    <option value="PHT" {{$siswa->jurusan == 'PHT' ? 'selected' : '' }}>Perhotelan</option>
                                    <option value="KUL" {{$siswa->jurusan == 'KUL' ? 'selected' : '' }}>Kuliner</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Pondok</td>
                            <td><select class="border rounded-pill shadow-sm form-control-lg" name="pondok">
                                    <option value="0" {{$siswa->pondok == '0' ? 'selected' : '' }}>Tidak</option>
                                    <option value="1" {{$siswa->pondok == '1' ? 'selected' : '' }}>Mondok</option>
                                </select>
                            </td>
                        </tr>
                        {{-- <tr>
                            <td>Alasan memilih jurusan</td>
                            <td><input value="{{$siswa->alasan}}" class="border rounded-pill shadow-sm form-control-lg" type="text" name="alasan" style="width: 100%;"></td>
                        </tr>
                        <tr>
                            <td>NISN</td>
                            <td><input value="{{$siswa->nisn}}" class="border rounded-pill shadow-sm form-control-lg" type="text" name="nisn" style="width: 100%;"></td>
                        </tr> --}}
                        <tr>
                            <td>Tempat &amp; tanggal lahir</td>
                            <td><input value="{{$siswa->tempat_lahir}}" class="border rounded-pill shadow-sm form-control-lg" type="text" name="tempat_lahir" style="width: 300px;" placeholder="Kabupaten/ Kota">&nbsp;&nbsp;
                                <input class="border rounded-pill form-control-lg" type="date" name="tgl_lahir" value="{{$siswa->tgl_lahir}}">
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis kelamin</td>
                            <td><select class="border rounded shadow-sm form-control-lg" name="jenis_kelamin">
                                    <option value="L" {{ $siswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki- Laki</option>
                                    <option value="P" {{ $siswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </td>
                        </tr>
                        {{--<tr>
                            <td>Agama</td>
                            <td><select class="border rounded shadow-sm form-control-lg d-xl-flex" name="agama">
                                    <option value="Islam" {{ $siswa->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ $siswa->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katholik" {{ $siswa->agama == 'Katholik' ? 'selected' : '' }}>Katholik</option>
                                    <option value="Hindu" {{ $siswa->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Budha" {{ $siswa->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                                    <option value="Konghucu" {{ $siswa->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td colspan="2">Anak ke&nbsp;<input class="border rounded-pill shadow-sm form-control-lg" type="text" name="anak_ke" style="width: 100px;" value="{{$siswa->anak_ke}}">&nbsp;dari&nbsp;<input class="border rounded-pill shadow-sm form-control-lg" type="text" name="dari" style="width: 100px;" value="{{$siswa->dari}}">&nbsp;bersaudara</td>
                        </tr> --}}
                        <tr style="height: 150px">
                            <td>Alamat lengkap</td>
                            <td><textarea class="shadow-sm form-control-lg h-100" style="width: 100%;" name="alamat" placeholder="Nama Jalan, RT, RW, Dusun, Desa, Kecamatan" rows="3">{{$siswa->alamat}}</textarea></td>
                        </tr>
                        <tr>
                            <td>Asal Sekolah (SMP)</td>
                            <td><input value="{{$siswa->asal_sekolah}}" class="border rounded-pill shadow-sm form-control-lg" type="text" name="asal_sekolah" style="width: 100%;"></td>
                        </tr>
                        {{--<tr style="height: 150px">
                            <td>Alamat Sekolah (SMP)</td>
                            <td><textarea class="shadow-sm form-control-lg h-100" style="width: 100%;" name="alamat_sekolah" placeholder="Nama Jalan, RT, RW, Dusun, Desa, Kecamatan" rows="3">{{$siswa->alamat_sekolah}}</textarea></td>
                        </tr>--}}
                        <tr>
                            <td>Nomor Telp / HP</td>
                            <td><input value="{{$siswa->no_telp}}" class="border rounded-pill shadow-sm form-control-lg" type="text" name="no_telp" style="width: 100%;"></td>
                        </tr>
                        <tr>
                            <td>Nama rekomendator (siswa)</td>
                            <td><input placeholder="Contoh: Yoga (X TSM 2)" value="{{$siswa->rekomendator}}" class="border rounded-pill shadow-sm form-control-lg" type="text" name="rekomendator" style="width: 100%;"></td>
                        </tr>
                        <tr>
                            <td>Nama rekomendator (GuKar)</td>
                            <td>
                                {{-- <input value="{{$siswa->guru->nama}}" class="border rounded-pill shadow-sm form-control-lg" type="text" name="rekomendator" style="width: 100%;">  --}}
                                {!! Form::select('guru_id', $guru, $siswa->guru_id, ['class'=>'form-control select2','placeholder'=>'Pilih nama guru']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td><input  value="{{$siswa->keterangan}}" class="border rounded-pill shadow-sm form-control-lg" type="text" name="keterangan" style="width: 100%;"></td>
                        </tr>

                        {{--<tr>
                            <td>Hobi</td>
                            <td>
                                <div class="border rounded shadow-sm btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-outline-primary active">
                                        Olahraga
                                        <input type="radio" id="btnradio-20" name="hobi" value="1" {{ $siswa->hobi == '1' ? 'checked' : '' }}>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        Kesenian
                                        <input type="radio" id="btnradio-21" name="hobi" value="2" {{ $siswa->hobi == '2' ? 'checked' : '' }}>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        Membaca
                                        <input type="radio" id="btnradio-22" name="hobi" value="3" {{ $siswa->hobi == '3' ? 'checked' : '' }}>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        Menulis
                                        <input type="radio" id="btnradio-23" name="hobi" value="4" {{ $siswa->hobi == '4' ? 'checked' : '' }}>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        Lainnya
                                        <input type="radio" id="btnradio-24" name="hobi" value="5" {{ $siswa->hobi == '5' ? 'checked' : '' }}>
                                    </label>
                                    </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Jarak ke sekolah</td>
                            <td>
                                <div class="border rounded shadow-sm btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-outline-primary active">
                                        0-1 km
                                        <input type="radio" id="btnradio-15" name="jarak"  value="1" {{ $siswa->jarak == '1' ? 'checked' : '' }}>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        1-3 km
                                        <input type="radio" id="btnradio-14" name="jarak" value="2" {{ $siswa->jarak == '2' ? 'checked' : '' }}>
                                    </label><label class="btn btn-outline-primary">
                                        3-5 km
                                        <input type="radio" id="btnradio-16" name="jarak" value="3" {{ $siswa->jarak == '3' ? 'checked' : '' }}>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        5-10 km
                                        <input type="radio" id="btnradio-17" name="jarak" value="4" {{ $siswa->jarak == '4' ? 'checked' : '' }}>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        lebih dari 10 km
                                        <input type="radio" id="btnradio-18" name="jarak" value="5" {{ $siswa->jarak == '5' ? 'checked' : '' }}>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Transportasi</td>
                            <td>
                                <div class="border rounded shadow-sm btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-outline-primary active">
                                        Jalan kaki
                                        <input type="radio" id="btnradio-2" name="transportasi" value="1" {{ $siswa->transport == '1' ? 'checked' : '' }}>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        Sepeda
                                        <input type="radio" id="btnradio-3" name="transportasi" value="2" {{ $siswa->transport == '2' ? 'checked' : '' }}>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        Motor
                                        <input type="radio" id="btnradio-4" name="transportasi" value="3" {{ $siswa->transport == '3' ? 'checked' : '' }}>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        Angkutan
                                        <input type="radio" id="btnradio-5" name="transportasi" value="4" {{ $siswa->transport == '4' ? 'checked' : '' }}>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        Lainnya
                                        <input type="radio" id="btnradio-6" name="transportasi" value="5" {{ $siswa->transport == '5' ? 'checked' : '' }}>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Sumber informasi SMK</td>
                            <td>
                                <div class="border rounded shadow-sm btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-outline-primary active">
                                        Teman
                                        <input type="radio" name="info" value="1" {{ $siswa->informasi == '1' ? 'checked' : '' }}>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        Internet
                                        <input type="radio" name="info" value="2" {{ $siswa->informasi == '2' ? 'checked' : '' }}>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        Baliho
                                        <input type="radio" name="info" value="3" {{ $siswa->informasi == '3' ? 'checked' : '' }}>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        Radio
                                        <input type="radio" name="info" value="4" {{ $siswa->informasi == '4' ? 'checked' : '' }}>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        Guru
                                        <input type="radio" name="info" value="5" {{ $siswa->informasi == '5' ? 'checked' : '' }}>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        Surat Kabar
                                        <input type="radio" name="info" value="6" {{ $siswa->informasi == '6' ? 'checked' : '' }}>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        Spanduk
                                        <input type="radio" name="info" value="7" {{ $siswa->informasi == '7' ? 'checked' : '' }}>
                                    </label>
                                </div>
                            </td>
                        </tr>--}}
                    </tbody>
                </table>
            </div>
            <br><br>
            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="mb-0 text-white">DATA ORANG TUA/ WALI</h5>
                </div>
                <div class="card-body" style="margin-bottom: 0;">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Nama ayah</td>
                                    <td><input value="{{$ortu->nama_ayah??''}}" class="border rounded-pill shadow-sm form-control-lg" type="text" name="nama_ayah" style="width: 100%;"></td>
                                </tr>
                                <tr>
                                    <td>Nama ibu</td>
                                    <td><input value="{{$ortu->nama_ibu??''}}"class="border rounded-pill shadow-sm form-control-lg" type="text" name="nama_ibu" style="width: 100%;"></td>
                                </tr>
                                {{--<tr>
                                    <td>No Telp/ HP</td>
                                    <td><input value="{{$ortu->telp}}" class="border rounded-pill shadow-sm form-control-lg" type="text" name="telp_ortu" style="width: 100%;"></td>
                                </tr>
                                <tr>
                                    <td>Alamat orang tua</td>
                                    <td><textarea value="{{$ortu->alamat_ortu}}" class="border shadow-sm form-control-lg" name="alamat_ortu" style="width: 100%;" rows=3>{{$ortu->alamat_ortu}}</textarea></td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan ayah</td>
                                    <td><select class="border rounded shadow-sm form-control-lg" name="kerja_ayah">
                                            <option value="1" {{ $ortu->kerjaayah_id == '1' ? 'selected' : '' }}>PNS</option>
                                            <option value="2" {{ $ortu->kerjaayah_id == '2' ? 'selected' : '' }}>TNI / POLRI</option>
                                            <option value="3" {{ $ortu->kerjaayah_id == '3' ? 'selected' : '' }}>Guru</option>
                                            <option value="4" {{ $ortu->kerjaayah_id == '4' ? 'selected' : '' }}>Wiraswasta</option>
                                            <option value="5" {{ $ortu->kerjaayah_id == '5' ? 'selected' : '' }}>Petani</option>
                                            <option value="6" {{ $ortu->kerjaayah_id == '6' ? 'selected' : '' }}>Buruh</option>
                                            <option value="7" {{ $ortu->kerjaayah_id == '7' ? 'selected' : '' }}>Pegawai Swasta</option>
                                            <option value="8" {{ $ortu->kerjaayah_id == '8' ? 'selected' : '' }}>Pedagang</option>
                                            <option value="9" {{ $ortu->kerjaayah_id == '9' ? 'selected' : '' }}>Lainnya</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan ibu</td>
                                    <td><select class="border rounded shadow-sm form-control-lg" name="kerja_ibu">
                                            <optgroup label="kerja_ibu">
                                                <option value="1" {{ $ortu->kerjaibu_id == '1' ? 'selected' : '' }}>PNS</option>
                                                <option value="2" {{ $ortu->kerjaibu_id == '2' ? 'selected' : '' }}>TNI / POLRI</option>
                                                <option value="3" {{ $ortu->kerjaibu_id == '3' ? 'selected' : '' }}>Guru</option>
                                                <option value="4" {{ $ortu->kerjaibu_id == '4' ? 'selected' : '' }}>Wiraswasta</option>
                                                <option value="5" {{ $ortu->kerjaibu_id == '5' ? 'selected' : '' }}>Petani</option>
                                                <option value="6" {{ $ortu->kerjaibu_id == '6' ? 'selected' : '' }}>Buruh</option>
                                                <option value="7" {{ $ortu->kerjaibu_id == '7' ? 'selected' : '' }}>Pegawai Swasta</option>
                                                <option value="8" {{ $ortu->kerjaibu_id == '8' ? 'selected' : '' }}>Pedagang</option>
                                                <option value="9" {{ $ortu->kerjaibu_id == '9' ? 'selected' : '' }}>Lainnya</option>
                                            </optgroup>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td>Gaji ayah</td>
                                    <td><select class="border rounded shadow-sm form-control-lg" name="gaji_ayah">
                                            <optgroup label="gaji_ayah">
                                                <option value="1" {{ $ortu->gajiayah_id == '1' ? 'selected' : '' }}>Kurang dari 500.000</option>
                                                <option value="2" {{ $ortu->gajiayah_id == '2' ? 'selected' : '' }}>500.000 - 1.000.000</option>
                                                <option value="3" {{ $ortu->gajiayah_id == '3' ? 'selected' : '' }}>1.000.000 - 3.000.000</option>
                                                <option value="4" {{ $ortu->gajiayah_id == '4' ? 'selected' : '' }}>3.000.000 - 5.000.000</option>
                                                <option value="5" {{ $ortu->gajiayah_id == '5' ? 'selected' : '' }}>Lebih dari 5.000.000</option>
                                            </optgroup>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td>Gaji ibu</td>
                                    <td><select class="border rounded shadow-sm form-control-lg" name="gaji_ibu">
                                            <optgroup label="gaji_ibu">
                                                <option value="1" {{ $ortu->gajiibu_id == '1' ? 'selected' : '' }}>Kurang dari 500.000</option>
                                                <option value="2" {{ $ortu->gajiibu_id == '2' ? 'selected' : '' }}>500.000 - 1.000.000</option>
                                                <option value="3" {{ $ortu->gajiibu_id == '3' ? 'selected' : '' }}>1.000.000 - 3.000.000</option>
                                                <option value="4" {{ $ortu->gajiibu_id == '4' ? 'selected' : '' }}>3.000.000 - 5.000.000</option>
                                                <option value="5" {{ $ortu->gajiibu_id == '5' ? 'selected' : '' }}>Lebih dari 5.000.000</option>
                                            </optgroup>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td>Nama wali</td>
                                    <td><input value="{{$ortu->nama_wali}}" class="border rounded-pill shadow-sm form-control-lg" type="text" name="nama_wali" style="width: 100%;"></td>
                                </tr>
                                <tr>
                                    <td>Alamat wali</td>
                                    <td><input value="{{$ortu->alamat_wali}}" class="border rounded-pill shadow-sm form-control-lg" type="text" name="alamat_wali" style="width: 100%;"></td>
                                </tr>
                                <tr>
                                    <td>No Telp wali</td>
                                    <td><input value="{{$ortu->telp_wali}}" class="border rounded-pill shadow-sm form-control-lg" type="text" name="telp_wali" style="width: 100%;"></td>
                                </tr>--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="mb-0 text-white">DATA KHUSUS BEASISWA</h5>
                </div>
                <div class="card-body" style="margin-bottom: 0;">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Kategori Pendaftar</td>
                                    <td>
                                        <select class="border rounded shadow-sm form-control-lg" name="kategori">
                                            <option value="REG" {{ $siswa->kategori == 'REG' ? 'selected' : '' }}>Reguler</option>
                                            <option value="AP50" {{ $siswa->kategori == 'AP50' ? 'selected' : '' }}>AP 50%</option>
                                            <option value="AP100" {{ $siswa->kategori == 'AP100' ? 'selected' : '' }}>AP 100%</option>
                                            <option value="KB" {{ $siswa->kategori == 'KB' ? 'selected' : '' }}>Kakak beradik beda tingkat</option>
                                            <option value="KB2" {{ $siswa->kategori == 'KB2' ? 'selected' : '' }}>Kakak beradik masuk berbarengan</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tagihan Daftar Ulang</td>
                                    <td>
                                        <select class="border rounded shadow-sm form-control-lg" name="tagihan_du">
                                            <option value="1250000" {{ old('tagihan_du', $siswa->tagihan->nominal) == 1250000 ? 'selected' : '' }}>1.250.000 (Indent-Putra)</option>
                                            <option value="1350000" {{ old('tagihan_du', $siswa->tagihan->nominal) == 1350000 ? 'selected' : '' }}>1.350.000 (Indent-Putri)</option>
                                            <option value="1500000" {{ old('tagihan_du', $siswa->tagihan->nominal) == 1500000 ? 'selected' : '' }}>1.500.000 (Gel-1-Putra)</option>
                                            <option value="1600000" {{ old('tagihan_du', $siswa->tagihan->nominal) == 1600000 ? 'selected' : '' }}>1.600.000 (Gel-1-Putri)</option>
                                            <option value="2000000" {{ old('tagihan_du', $siswa->tagihan->nominal) == 2000000 ? 'selected' : '' }}>2.000.000 (Gel-2-Putra)</option>
                                            <option value="2100000" {{ old('tagihan_du', $siswa->tagihan->nominal) == 2100000 ? 'selected' : '' }}>2.100.000 (Gel-2-Putri)</option>
                                            <option value="2500000" {{ old('tagihan_du', $siswa->tagihan->nominal) == 2500000 ? 'selected' : '' }}>2.500.000 (Gel-3-Putra)</option>
                                            <option value="2600000" {{ old('tagihan_du', $siswa->tagihan->nominal) == 2600000 ? 'selected' : '' }}>2.600.000 (Gel-3-Putri)</option>
                                            <option value="3000000" {{ old('tagihan_du', $siswa->tagihan->nominal) == 3000000 ? 'selected' : '' }}>3.000.000 (Gel-Khusus-Putra)</option>
                                            <option value="3100000" {{ old('tagihan_du', $siswa->tagihan->nominal) == 3100000 ? 'selected' : '' }}>3.100.000 (Gel-Khusus-Putri)</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <p style="margin-top: 20px;">Pastikan data sudah terisi dengan lengkap, kemudian klik tombol "KIRIM FORM" di bawah ini :</p>
            <button class="btn btn-primary btn-lg font-weight-bold border rounded shadow-sm" type="submit" style="margin-top: 1px;"><i class="fas fa-paper-plane"></i>&nbsp;KIRIM FORM</button>
        </div>
    </div>
</div>
</form>
@stop

@section('css')
    {{-- <linkrel="stylesheet"href="/css/admin_custom.css"> --}}
    <link href="/vendor/select2/select2.css" rel="stylesheet" />
    <link href="/vendor/select2/select2-bootstrap4.css" rel="stylesheet" />

@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="/vendor/select2/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@stop
