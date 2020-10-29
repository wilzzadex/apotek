@extends('layout.master')
@section('title','Produk')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Suplier</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Suplier</li>
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
            <h3 class="card-title">Data Suplier</h3>
            <button type="button" data-toggle="modal" data-target="#modal-default"
              class="btn btn-primary fas fa fa-plus-square float-right"></button>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Suplier</th>
                  <th>Penanggung Jawab</th>
                  <th>No Telp</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($suplier as $suplier)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $suplier->nama_suplier }}</td>
                        <td>{{ $suplier->penanggung_jawab }}</td>
                        <td>{{ $suplier->no_telp }}</td>
                        <td>{{ $suplier->keterangan }}</td>
                        <td>
                            <a href="#" type="button" class="btn btn-block btn-outline-primary btn-xs editsuplier" data-toggle="modal" id="{{$suplier->id}}"><i class="fas fa-edit"></i></a>
                            <a href="{{url('suplier/'.$suplier->id.'/delete')}}" onclick="return confirm('Yakin akan Menghapus Data Ini ?')" class="btn btn-block btn-outline-danger btn-xs"><i class="fas fa-trash"></i></a>
                        </td>
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
        <h4 class="modal-title">Tambah Suplier</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('suplier.store')}}" method="POST" data-parsley-validate enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="Kode">Nama Suplier</label>
            <input type="text" name="nama_suplier" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="Kode">Penagnggung Jawab</label>
            <input type="text" name="penanggung_jawab" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="Kode">No Telpon</label>
            <input type="text" name="no_telp" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="Kode">Keterangan</label>
            <textarea name="keterangan" class="form-control" id="" cols="30" rows="5"></textarea>
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
<div class="modal fade" id="EditSuplier">
	
</div>
@endsection
@section('javaScript')
<script type="text/javascript">
  function getUpdate(id){
    var id = id;
    $.ajax({
      url: "suplier/"+id+"/edit",
      type: "GET",
      data : {id: id,},
      success: function (ajaxData){
        $("#EditSuplier").html(ajaxData);
        $("#EditSuplier").modal('show',{backdrop: 'true'});
      }
    });
  }

  $(document).ready(function (){
    /*$(".mapeledit").click(function (e){*/
      $("#example1").on("click",".editsuplier",function(){
        var m = $(this).attr("id");
        $.ajax({
          url: "suplier/"+m+"/edit",
          type: "GET",
          data : {id: m,},
          success: function (ajaxData){
            $("#EditSuplier").html(ajaxData);
            $("#EditSuplier").modal('show',{backdrop: 'true'});
          }
        });
      });
    });
  </script>
@endsection