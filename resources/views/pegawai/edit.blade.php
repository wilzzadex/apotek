<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Pegawai</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('pegawai.update',$pegawai->id)}}" method="POST" data-parsley-validate>
          {{ csrf_field() }}
          @method('PUT')
          <div class="form-group">
            <label for="Kode">Nama</label>
            <input type="text" name="name" value="{{$pegawai->name}}" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="Kode">Username</label>
            <input type="text" name="username" value="{{$pegawai->username}}" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="Kode">Role</label>
            <select name="role" class="form-control" required>
              <option value="">--</option>
              <option value="Apoteker" @if($pegawai->role == 'Apoteker') {{'selected'}} @endif>Apoteker</option>
              <option value="Kasir" @if($pegawai->role == 'Kasir') {{'selected'}} @endif>Kasir</option>
            </select>
          </div>
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Simpan</button> 
        </form>
      </div>
  </div>
    <!-- /.modal-content -->
</div>