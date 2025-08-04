<!DOCTYPE html>
<html>

<head>
    <title>Data Pendataan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

    </style>
    <center>
        <h5>Data Pendataan</h4>
    </center>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Bayi</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
                <th>Tanggal Lahir Bayi</th>
                <th>Umur Bayi</th>
                <th>Tanggal Pengecekan</th>
                <th>Tinggi Badan</th>
                <th>Berat Badan</th>
                <th>Jenis Kelamin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_bayi }}</td>
                <td>{{ $item->nama_ayah }}</td>
                <td>{{ $item->nama_ibu }}</td>
                <td>{{ $item->tgl_lahir_bayi }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tgl_lahir_bayi)->diffInMonths(\Carbon\Carbon::now()) }} Bulan</td>
                <td>{{ $item->tgl_pengecekan }}</td>
                <td>{{ $item->tb }}</td>
                <td>{{ $item->bb }}</td>
                <td>{{ $item->jkel }}</td>
            </tr>
            @endforeach
            @if(count($data) == 0)
                <tr>
                    <td colspan="10" style="text-align: center">No data available in table</td>
                </tr>
            @endif
        </tbody>
    </table>

</body>

</html>
