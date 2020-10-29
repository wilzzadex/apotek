<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Obat</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('obat.update',$obat->id)}}" method="POST" data-parsley-validate>
          {{ csrf_field() }}
          @method('PUT')
          @php
              $obat_satuan = DB::table('obat_satuan')->where('obat_id',$obat->id)->first();
          @endphp
          <div class="form-group row">
            <div class="col-sm-5">
              <label>Nama Obat</label>
              <input type="text" name="nama_obat" value="{{ $obat->nama_obat }}" class="form-control" required>
            </div>
            <div class="col-sm-3">
              <label>Jumlah</label>
              <input type="number" name="jml_satuan" value="{{ $obat_satuan->jml_satuan }}" id="jml_satuan_edit" class="form-control" required>
            </div>
            <div class="col-sm-4">
              <label>Satuan</label>
              <select name="satuan" class="form-control" id="satuan_edit" required>
                <option value="">- Pilih Satuan -</option>
                @foreach ($satuan as $satuan)
                    <option value="{{ $satuan->id }}" {{ $satuan->id == $obat_satuan->satuan_id ? 'selected' : '' }} data-jumlah="{{ $satuan->jumlah }}">{{ $satuan->nama }} - isi {{ $satuan->jumlah }}</option>
                @endforeach
              </select>
              <input type="hidden" name="stok" value="{{ $obat->stok }}" id="stok_edit">
            </div>
          </div>
          <div class="form-group">
            <label>Kode Obat</label>
            <input type="text" name="kode_obat" value="{{$obat->kode_obat}}" class="form-control" required>
          </div>
          <div class="form-group">
            <label>No Bet</label>
            <input type="text" name="no_bet" value="{{$obat->no_bet}}" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="Kode">Suplier</label>
            <select name="suplier_id" id="suplier" required class="form-control">
                <option value="">-- Pilih Suplier --</option>
                @foreach ($suplier as $suplier)
                    <option value="{{$suplier->id}}" {{ $suplier->id == $obat->suplier_id ? 'selected' : '' }}>{{$suplier->nama_suplier}}</option>
                @endforeach
                
            </select>
          </div>
          <div class="form-group row">
            <div class="col-sm-5">
              <label>Harga Suplier</label>
              <input type="number" id="harga_suplier_edit" value="{{ $obat->harga_suplier }}" name="harga_suplier" class="form-control" required>
            </div>
            <div class="col-sm-5">
              <label>Naikkan Harga (%)</label>
              <input type="number" id="persen_edit" name="persen" class="form-control">
            </div>
            <div class="col-sm-2">
              <label>Action</label>
              <button type="button" onclick="updateHargaedit()" class="btn btn-warning ">Cek</button>
            </div>
          </div>
          <div class="form-group">
            <label>Harga Jual</label>
            <input type="text" readonly name="harga_jual" id="harga_jual_edit" value="{{$obat->harga_jual}}" class="form-control" required>
          </div>
          {{-- <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{$obat->stok}}" required>
          </div> --}}
          
          <div class="form-group">
            <label for="Kode">Kadaluarsa</label>
            <input type="date" name="expired" class="form-control" value="{{$obat->expired}}" required>
          </div>
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Simpan</button> 
        </form>
      </div>
  </div>
    <!-- /.modal-content -->
</div>

