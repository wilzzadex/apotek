@extends('kasirpage.master')
@section('content')
<div class="container">
    <div class="container-fluid">
        <p><a href="{{url('kasir/laporanpdf')}}" target="_blank" class="btn btn-danger btn-sm">PDF Laporan Penjualan</a><a href="{{url('kasir/laporanexcel')}}" target="_blank" class="btn btn-success btn-sm">Excel Laporan Penjualan</a></p>
        <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>No Invoice</th>
                <th>Pelanggan</th>
                <th>Kasir</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Tanggal Transaksi</th>
              </tr>
            </thead>
            <tbody>
              @php
              $no = 1;
              @endphp
              @foreach ($transaksi as $t)
                  <tr>
                      <td>{{ $no++ }}</td>
                      <td> <a href="#" class="detailorder" data-toggle="modal" id="{{$t->no_invoice}}"><i class="fas fa-file-alt"></i> {{ $t->no_invoice }} </a> </td>
                      <td>{{ $t->nama_pelanggan }}</td>
                      <td>{{ $t->name }}</td>
                      <td>{{ $t->jumlah_item }}</td>
                      <td>Rp.{{ number_format($t->total_bayar,2,',','.') }}</td>
                      <td>{{ $t->created_at }}</td>
                  </tr>
              @endforeach

          </table>
    </div><!-- /.container-fluid -->
</div>
<div class="modal fade" id="DetailTransaksi">
      
</div>
@endsection
@section('javaScript')
<script type="text/javascript">
  function getUpdate(id){
    var id = id;
    $.ajax({
      url: "transaksi/"+id+"/detail",
      type: "GET",
      data : {id: id,},
      success: function (ajaxData){
        $("#DetailTransaksi").html(ajaxData);
        $("#DetailTransaksi").modal('show',{backdrop: 'true'});
      }
    });
  }

  $(document).ready(function (){
    /*$(".mapeledit").click(function (e){*/
      $("#example1").on("click",".detailorder",function(){
        var m = $(this).attr("id");
        $.ajax({
          url: "transaksi/"+m+"/detail",
          type: "GET",
          data : {id: m,},
          success: function (ajaxData){
            $("#DetailTransaksi").html(ajaxData);
            $("#DetailTransaksi").modal('show',{backdrop: 'true'});
          }
        });
      });
    });
  </script>
@endsection
