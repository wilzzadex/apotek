<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Obat Keluar</title>
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
                <th>Nama Obat</th>
                <th>Kode Obat</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
            </tr>
            <?php $no = 1; ?>
            @foreach ($detail_order as $do)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $do->nama_obat }}</td>
                <td>{{ $do->kode_obat }}</td>
                <td>Rp.{{ number_format($do->harga_jual,2,',','.') }}</td>
                <td>{{ $do->qty }}</td>
                <td>Rp.{{ number_format($do->total_harga,2,',','.') }}</td>
            </tr>
            @endforeach
            
          </table>
          <?php 
                      $uangMasuk = 0;
           ?>
          @foreach ($total_uang as $uang)
          <h5>Total Uang Masuk : Rp.{{ number_format($uang->total,2,',','.') }}</h5>
          <?php 

          $uangMasuk = $uang->total;

           ?>
          @endforeach
          <h5>Total Pengeluaran : Rp.{{ number_format($total_pengeluaran->harga_suplier,2,',','.') }}</h5>
          <?php 
             $uangKeluar = $total_pengeluaran->harga_suplier;
             $totalnya = $uangMasuk - $uangKeluar;
           ?>
         

          <h5>Total : Rp.{{ number_format($totalnya,2,',','.') }}</h5>

    </div>
</body>
</html>