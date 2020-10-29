@extends('layout.master')
@section('title','Pelanggan')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Pegawai</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Pegawai</li>
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
            <h3 class="card-title">Data Pegawai</h3>
            <button type="button" data-toggle="modal" data-target="#modal-default"
              class="btn btn-primary fas fa fa-plus-square float-right"></button>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Foto</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($pegawai as $row)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $row->name }}</td>
                  <td>{{ $row->username }}</td>
                  @if ($row->role == 'Admin')
                  <td><span class="badge badge-success">Admin</span></td>
                  @endif
                  @if ($row->role == 'Kasir')
                  <td><span class="badge badge-info">Kasir</span></td>
                  @endif
                  @if ($row->role == 'Apoteker')
                  <td><span class="badge badge-warning">Apoteker</span></td>
                  @endif
                  <td align="center"><img src="{{asset('images/image_profile/'.$row->foto)}}" style="width:100px;height:100px;" alt=""></td>
                  <td>
                    @if($row->role != 'Admin')
                    <a href="{{url('pegawai/'.$row->id.'/reset')}}" onclick="return confirm('Yakin akan reset Password (Default : pegawai2019)')" class="btn btn-block btn-outline-warning btn-xs"><i class="fas fa-history"></i></a>
                    <a href="#" type="button" class="btn btn-block btn-outline-primary btn-xs editpegawai" data-toggle="modal" id="{{$row->id}}"><i class="fas fa-edit"></i></a>
                    <a href="{{url('pegawai/'.$row->id.'/delete')}}" onclick="return confirm('Yakin akan Menghapus Data Ini ?')" class="btn btn-block btn-outline-danger btn-xs"><i class="fas fa-trash"></i></a>
                    @endif
                    @if($row->role == 'Admin')
                    <button type="button" disabled class="btn btn-block btn-outline-primary btn-xs"><i class="fas fa-edit"></i></button>
                    <button type="button" disabled class="btn btn-block btn-outline-danger btn-xs"><i class="fas fa-trash"></i></button>
                    @endif
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
        <h4 class="modal-title">Tambah Pegawai</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('pegawai.store')}}" method="POST" data-parsley-validate enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="Kode">Nama</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="Kode">Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="Kode">Password (Default)</label>
            <input type="text" name="password" value="pegawai2019" class="form-control" readonly required>
          </div>
          <div class="form-group">
            <label for="Kode">Role</label>
            <select name="role" class="form-control" required>
              <option value="">--</option>
              <option value="Apoteker">Apoteker</option>
              <option value="Kasir">Kasir</option>
            </select>
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
<div class="modal fade" id="EditPegawai">
	
</div>
@endsection
@section('javaScript')
<script type="text/javascript">
  function getUpdate(id){
    var id = id;
    $.ajax({
      url: "pegawai/"+id+"/edit",
      type: "GET",
      data : {id: id,},
      success: function (ajaxData){
        $("#EditPegawai").html(ajaxData);
        $("#EditPegawai").modal('show',{backdrop: 'true'});
      }
    });
  }

  $(document).ready(function (){
    /*$(".mapeledit").click(function (e){*/
      $("#example1").on("click",".editpegawai",function(){
        var m = $(this).attr("id");
        $.ajax({
          url: "pegawai/"+m+"/edit",
          type: "GET",
          data : {id: m,},
          success: function (ajaxData){
            $("#EditPegawai").html(ajaxData);
            $("#EditPegawai").modal('show',{backdrop: 'true'});
          }
        });
      });
    });
  </script>
@endsection