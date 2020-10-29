<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Penjualan-".date('d M Y',strtotime($dari))."s/d" .date('d M Y',strtotime($hingga)).".xls");
?>
<h3>Laporan Penjualan Periode {{ date('d M Y',strtotime($dari)) }} s/d {{ date('d M Y',strtotime($hingga)) }}  </h3>
<p>Petugas : {{auth()->user()->name}}</p>
<table cellpadding="10" cellspacing="0" border="1">
		<tr>
			<th style="width: 45px; border-style: solid;">No</th>
			<th style="width: 150px; border-style: solid;">No Invoice</th>
			<th style="width: 150px; border-style: solid;">Pelanggan</th>
			<th style="width: 150px; border-style: solid;">Kasir</th>
			<th style="width: 150px; border-style: solid;">Jumlah</th>
			<th style="width: 150px; border-style: solid;">Tanggal Transaksi</th>
            <th style="width: 150px; border-style: solid;">Total Harga</th>
            
        </tr>
       
        <?php $no=1 ?>
		@foreach ($transaksi as $transaksi)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $transaksi->no_invoice }}</td>
                <td>{{ $transaksi->nama_pelanggan }}</td>
                <td>{{ $transaksi->name }}</td>
                <td>{{ $transaksi->jumlah_item }}</td>
                <td>{{ $transaksi->created_at }}</td>
                <td>{{ $transaksi->total_bayar }}</td>
                
            </tr>
        @endforeach
        <tr>
            <th style="width: 150px; border-style: solid;" colspan="6">Total</th>
            <td>@foreach($total as $total) {{$total->total}} @endforeach</td>
        </tr>
</table>