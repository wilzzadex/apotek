@extends('layout.master')
@section('title','Produk')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Satuan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Satuan</li>
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
                  <th>Nama Satuan</th>
                  <th>Jumlah Satuan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
               @foreach ($satuan as $key => $item)
                   <tr>
                       <td>{{ $key+1 }}</td>
                       <td>{{ $item->nama }}</td>
                       <td>{{ $item->jumlah }}</td>
                       <td>
                        <a href="#" type="button" class="btn btn-outline-primary btn-xs editsuplier" data-toggle="modal" id="{{$item->id}}"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('satuan.destroy',$item->id) }}" onclick="return confirm('Yakin akan Menghapus Data Ini ?')" class="btn btn-outline-danger btn-xs"><i class="fas fa-trash"></i></a>

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
        <h4 class="modal-title">Tambah Satuan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('satuan.store')}}" method="POST" data-parsley-validate enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="Kode">Nama Satuan</label>
            <input type="text" name="nama" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="Kode">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required id="">
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
  

  $(document).ready(function (){
    /*$(".mapeledit").click(function (e){*/
      $("#example1").on("click",".editsuplier",function(){
        var m = $(this).attr("id");
        $.ajax({
          url: "{{ route('satuan.edit') }}",
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