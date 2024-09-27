
    <html>
        <head>
            <title>{{$title}}</title>
        </head>
    <table class="table table-hover text-nowrap">
        <thead class="thead-dark">
            <tr>
                <th style="width: 30px">No</th>
                <th style="width: 80px">No Pendaft</th>
                <th style="width: 50px">Jurusan</th>
                <th class="col-sm-3">Nama</th>
                <th class="col-sm-2">No Telp</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($siswa) && $siswa->count())
                @foreach ($siswa as $key => $s)
                <tr>
                    <td>{{$loop->iteration }}</td>
                    <td>{{$s->no_pendaf}}</td>
                    <td>{{$s->jurusan}}</td>
                    <td>{{$s->nama}}</td>
                    <td>{{$s->no_telp}}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">Tidak ada data</td>
                </tr>

            @endif
        </tbody>
    </table>
    </html>
