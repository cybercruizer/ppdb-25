<html>
    <head>
        <title>Laporan Pembayaran</title>
    </head>
    <body>
        <h2>Laporan Pembayaran Daftar Ulang</h2>
        <h2>PPDB 2025/ 2026</h2>
        <table>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>No Pendaftaran</td>
                <td>Jurusan</td>
                <td>Tagihan</td>
                <td>Total Bayar</td>
            </tr>
            @foreach($pembayarans as $key=>$p)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ strtoupper($p->siswa->nama) }}</td>
                    <td>{{ $p->siswa->no_pendaf }}</td>
                    <td>{{ $p->siswa->jurusan }}</td>
                    <td>{{ $p->siswa->tagihan->nominal }}</td>
                    <td>{{ $p->total_nominal }}</td>

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
