<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Satuan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('satuan.store')}}" method="POST" data-parsley-validate enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="Kode">Nama Satuan</label>
            <input type="text" name="nama" value="{{ $satuan->nama }}" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="Kode">Jumlah</label>
            <input type="number" name="jumlah" value="{{ $satuan->jumlah }}" class="form-control" required id="">
        </div>

        </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm">Simpan</button> </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>