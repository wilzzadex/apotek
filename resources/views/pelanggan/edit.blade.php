<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Pelanggan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('pelanggan.update',$pelanggan->id)}}" method="POST" data-parsley-validate>
          {{ csrf_field() }}
          @method('PUT')
          <div class="form-group">
            <label for="Kode">Nama</label>
            <input type="text" name="nama_pelanggan" value="{{$pelanggan->nama_pelanggan}}" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="Kode">Alamat</label>
            <textarea name="alamat" class="form-control" id="" cols="30" rows="3">{{$pelanggan->alamat}}</textarea>
          </div>
          <div class="form-group">
            <label for="Kode">No Telpon</label>
            <input type="text" name="no_telp" value="{{$pelanggan->no_telp}}" class="form-control">
          </div>
          <div class="form-group">
            <label for="Kode">Info Tambahan</label>
            <textarea name="info_tambahan" class="form-control" id="" cols="30" rows="3">{{$pelanggan->info_tambahan}}</textarea>
          </div>
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Simpan</button> 
        </form>
      </div>
  </div>
    <!-- /.modal-content -->
</div>