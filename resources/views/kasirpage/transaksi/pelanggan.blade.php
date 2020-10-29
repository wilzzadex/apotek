@extends('kasirpage.master')
@section('content')
<div class="container">
    <div class="container-fluid">
        <h5><button type="button" data-toggle="modal" data-target="#modal-default"
            class="btn btn-primary float-right"><i class="fas fa fa-plus-square"></i> Tambah Pelanggan</button></h5>
        <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Info Tambahan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php
              $no = 1;
              @endphp
              @foreach ($pelanggan as $pelanggan)
                  <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $pelanggan->nama_pelanggan }}</td>
                      <td>{{ $pelanggan->alamat }}</td>
                      <td>{{ $pelanggan->no_telp }}</td>
                      <td>{{ $pelanggan->info_tambahan }}</td>
                      <td>
                          <a href="#" type="button" class="btn btn-block btn-outline-primary btn-xs editpelanggankasir" data-toggle="modal" id="{{$pelanggan->id}}"><i class="fas fa-edit"></i></a>
                      </td>
                  </tr>
              @endforeach
          

          </table>
    </div><!-- /.container-fluid -->
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
              <textarea name="alamat" class="form-control" cols="30" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="Kode">No Telpon</label>
              <input type="text" name="no_telp" class="form-control">
            </div>
            <div class="form-group">
              <label for="Kode">Info Tambahan</label>
              <textarea name="info_tambahan" class="form-control" cols="30" rows="3"></textarea>
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
  <div class="modal fade" id="EditPelanggankasir">
      
  </div>
@endsection
@section('javaScript')
<script type="text/javascript">
  function getUpdate(id){
    var id = id;
    $.ajax({
      url: "pelanggan/"+id+"/edit",
      type: "GET",
      data : {id: id,},
      success: function (ajaxData){
        $("#EditPelanggankasir").html(ajaxData);
        $("#EditPelanggankasir").modal('show',{backdrop: 'true'});
      }
    });
  }

  $(document).ready(function (){
    /*$(".mapeledit").click(function (e){*/
      $("#example1").on("click",".editpelanggankasir",function(){
        var m = $(this).attr("id");
        $.ajax({
          url: "pelanggan/"+m+"/edit",
          type: "GET",
          data : {id: m,},
          success: function (ajaxData){
            $("#EditPelanggankasir").html(ajaxData);
            $("#EditPelanggankasir").modal('show',{backdrop: 'true'});
          }
        });
      });
    });
  </script>
@endsection