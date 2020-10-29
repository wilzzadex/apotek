<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan</title>
    <style>
        body{
            font-family: arial, sans-serif;
            font-size: 13px;
        }
        .center {
            text-align: center;
            
            }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

            td, th {
            border: 1px solid;
            text-align: left;
            padding: 8px;
            }
/* 
tr:nth-child(even) {
  background-color: #dddddd;
} */
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center">
            <h4 class="center">Apotek Bakti Abadi Farma</h4>
            <h5 class="center">Laporan Penjualan</h5>
        </div>
        Petugas : {{ auth()->user()->name }}
        <table>
            <tr>
              <th>No</th>
              <th>No Invoice</th>
              <th>Pelanggan</th>
              <th>Jumlah</th>
              <th>Total Harga</th>
              <th>Tanggal Transaksi</th>
            </tr>
            <?php $no=1 ?>
            @foreach ($transaksi as $transaksi)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $transaksi->no_invoice }}</td>
                <td>{{ $transaksi->nama_pelanggan }}</td>
                <td>{{ $transaksi->jumlah_item }}</td>
                <td>Rp.{{ number_format($transaksi->total_bayar,2,',','.') }}</td>
                <td>{{ $transaksi->created_at }}</td>
            </tr>
            @endforeach
            
          </table>
          @foreach ($total_uang as $uang)
          <h5>Total Uang Masuk : Rp.{{ number_format($uang->total,2,',','.') }}</h5>
          @endforeach
    </div>
</body>
</html>