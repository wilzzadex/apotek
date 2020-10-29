<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">diskon Harga</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('kasir/ubahharga/'.$row->id) }}" method="POST" data-parsley-validate>
          {{ csrf_field() }}
          @method('PUT')
          <div class="form-group row">
            <div class="col-sm-5">
              <label>Harga Asal</label>
              <input type="number" id="harga_asal" value="{{ $row->harga_jual }}" name="harga_asal" class="form-control" required>
            </div>
            <div class="col-sm-5">
              <label>Diskon Harga (%)</label>
              <input type="number" id="persen" name="persen" class="form-control" required>
            </div>
            <div class="col-sm-2">
              <label>Action</label>
              <button type="button" onclick="updateHarga()" class="btn btn-warning ">Oke</button>
            </div>
          </div>
          <div class="form-group">
              <label for="">Harga Baru</label>
              <input type="number" name="harga_baru" readonly id="harga_baru" class="form-control" required>
          </div>
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Simpan</button> 
        </form>
      </div>
  </div>
    <!-- /.modal-content -->
</div>