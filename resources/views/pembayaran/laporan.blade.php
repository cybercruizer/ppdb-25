<html>
    <head>
        <title>Laporan Pembayaran</title>
    </head>
    <body>
        <h2>Laporan Pembayaran Daftar Ulang</h2>
        <h2>PPDB 2024/ 2025</h2>
        <table>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>No Pendaftaran</td>
                <td>Jurusan</td>
                <td>Nominal Bayar</td>
                <td>Tgl Bayar</td>
            </tr>
            @foreach($pembayarans as $pembayaran=>$p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ strtoupper($p->siswa->nama) }}</td>
                    <td>{{ $p->siswa->no_pendaf }}</td>
                    <td>{{ $p->siswa->jurusan }}</td>
                    <td><p class="rupiah">{{ $p->nominal }}</p></td>
                    <td>{{\Carbon\Carbon::parse($p->created_at)->format('d/m/Y')}}</td>

                </tr>
            @endforeach
        </table>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script>
            $(document).ready(function() {
                    $('.rupiah').mask('#.##0', {
                        reverse: true
                    });
                });
        </script>
    </body>


</html>
