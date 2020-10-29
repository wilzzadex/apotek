@extends('kasirpage.master')
@section('content')
<div class="container">
    <div class="container-fluid">
        <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Kode Obat</th>
                <th>No Bet</th>
                
                <th>Harga Suplier</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Kadaluarsa</th>
                
              </tr>
            </thead>
            <tbody>
              @php
              $no = 1;
              @endphp
              @foreach ($obat as $obat)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $obat->nama_obat }}</td>
                    <td>{{ $obat->kode_obat }}</td>
                    <td>{{ $obat->no_bet }}</td>
                    
                    <td>Rp.{{ number_format($obat->harga_suplier,2,',','.') }}</td>
                    <td>Rp.{{ number_format($obat->harga_jual,2,',','.') }}</td>
                    <td>{{ $obat->stok }}</td>
                    <td>{{ date('d M Y',strtotime($obat->expired)) }}</td>
                  </tr>
              @endforeach

          </table>
    </div><!-- /.container-fluid -->
</div>
@endsection
