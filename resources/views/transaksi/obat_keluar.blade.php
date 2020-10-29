@extends('layout.master')
@section('title','Obat Keluar')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Obat Keluar</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Obat Keluar</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Obat Keluar</h3>
            <p><a href="" target="_blank" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#modalPDF">PDF Laporan Penjualan</a><button data-toggle="modal" data-target="#modalEXCEL" class="btn btn-success btn-sm float-right">Excel Laporan Penjualan</button></p>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Obat</th>
                        <th>Kode Obat</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal Keluar</th>
                    </tr>
                </thead>
                <tbody>
                  @php
                  $no = 1;
                  @endphp
                   @foreach ($detail_order as $do)
                   <tr>
                       <td>{{ $no++ }}</td>
                       <td>{{ $do->nama_obat }}</td>
                       <td>{{ $do->kode_obat }}</td>
                       <td>Rp.{{ number_format($do->harga_jual,2,',','.') }}</td>
                       <td>{{ $do->qty }}</td>
                       <td>Rp.{{ number_format($do->total_harga,2,',','.') }}</td>
                       <td>{{ $do->created_at }}</td>
                   </tr>
                   @endforeach
              </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Pelanggan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('pelanggan.store')}}" method="POST" data-parsley-validate enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="Kode">Nama</label>
            <input type="text" name="nama_pelanggan" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="Kode">Alamat</label>
            <textarea name="alamat" class="form-control" id="" cols="30" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="Kode">No Telpon</label>
            <input type="text" name="no_telp" class="form-control">
          </div>
          <div class="form-group">
            <label for="Kode">Info Tambahan</label>
            <textarea name="info_tambahan" class="form-control" id="" cols="30" rows="3"></textarea>
          </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm">Simpan</button> </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modalPDF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{url('pdfobatkeluar')}}" data-parsley-validate="" method="POST">
            {{ csrf_field() }}
          <div class="form-group">
              <label>Dari</label>
              <input type="date" name="dari" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Hingga</label>
            <input type="date" name="hingga" class="form-control" required>
          </div>
            <button type="submit" class="btn btn-info float-right" >Cetak</button>
          <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
        </form>
        </div>
      </div>
    </div>
  </div>
<div class="modal fade" id="modalEXCEL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Export Laporan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{url('obatkeluar/export')}}" data-parsley-validate="" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
              <label>Dari</label>
              <input type="date" name="dari" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Hingga</label>
            <input type="date" name="hingga" class="form-control" required>
          </div>
            <button type="submit" class="btn btn-info float-right" >Cetak</button>
          <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
        </form>
        </div>
      </div>
    </div>
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
