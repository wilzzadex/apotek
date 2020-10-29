<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Suplier</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('suplier.update',$suplier->id)}}" method="POST" data-parsley-validate>
          {{ csrf_field() }}
          @method('PUT')
          <div class="form-group">
            <label for="Kode">Nama Suplier</label>
            <input type="text" name="nama_suplier" value="{{$suplier->nama_suplier}}" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="Kode">Penagnggung Jawab</label>
            <input type="text" name="penanggung_jawab" value="{{$suplier->penanggung_jawab}}" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="Kode">No Telpon</label>
            <input type="text" name="no_telp" class="form-control" value="{{$suplier->no_telp}}" required>
          </div>
          <div class="form-group">
            <label for="Kode">Keterangan</label>
            <textarea name="keterangan" class="form-control" id="" cols="30" rows="5">{{$suplier->keterangan}}</textarea>
          </div>
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm float-right">Simpan</button> 
        </form>
      </div>
  </div>
    <!-- /.modal-content -->
</div>