<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Obat Keluar-".date('d M Y',strtotime($dari))."s/d" .date('d M Y',strtotime($hingga)).".xls");
?>
<h3>Laporan Obat Keluar Periode {{ date('d M Y',strtotime($dari)) }} s/d {{ date('d M Y',strtotime($hingga)) }}  </h3>
<p>Petugas : {{auth()->user()->name}}</p>
<table cellpadding="10" cellspacing="0" border="1">
		<tr>
			<th style="width: 45px; border-style: solid;">No</th>
			<th style="width: 150px; border-style: solid;">Nama Obat</th>
			<th style="width: 150px; border-style: solid;">Kode Obat</th>
			<th style="width: 150px; border-style: solid;">Harga</th>
			<th style="width: 150px; border-style: solid;">Jumlah</th>
			<th style="width: 150px; border-style: solid;">Tanggal Keluar</th>
            <th style="width: 150px; border-style: solid;">Total Harga</th>
            
        </tr>
       
        <?php $no=1 ?>
		@foreach ($transaksi as $transaksi)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $transaksi->nama_obat }}</td>
                <td>{{ $transaksi->kode_obat }}</td>
                <td>{{ $transaksi->harga_jual }}</td>
                <td>{{ $transaksi->qty }}</td>
                <td>{{ $transaksi->created_at }}</td>
                <td>{{ $transaksi->total_harga }}</td>
                
            </tr>
        @endforeach
        <?php 

            $uangMasuk = 0;
         ?>
        <tr>
            <th style="width: 150px; border-style: solid;" colspan="6">Total</th>
            <td>@foreach($total as $total) <?php $uangMasuk = $total->total; ?> {{$total->total}} @endforeach</td>
        </tr>
        <tr>
            <th style="width: 150px; border-style: solid;" colspan="6">Pengeluaran</th>
            <td>{{ $total_pengeluaran->harga_suplier }}</td>
            <?php 

                $uangKeluar = $total_pengeluaran->harga_suplier; 
                $totalnya = $uangMasuk-$uangKeluar;

             ?>
        </tr>
         <tr>
            <th style="width: 150px; border-style: solid;" colspan="6">Hasil yang di dapat</th>
            <td> <b> {{ $totalnya }} </b></td>
        </tr>
</table>