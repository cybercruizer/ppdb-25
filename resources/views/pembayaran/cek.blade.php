<table>
<tr>
    <td>ID</td>
    <td>Nama</td>
    <td>Tagihan</td>
    <td>Nm Tagihan</td>
</tr>
@foreach ($siswas as $siswa)
<tr>
    <td> {{ $siswa->id }}</td>
    <td>{{ $siswa->nama }}</td>
    <td>{{ $siswa->tagihan->id ?? 'kosong' }}</td>
    <td>{{ $siswa->tagihan->nama_tagihan ?? 'kosong' }}</td>
</tr>
@endforeach
</table>
