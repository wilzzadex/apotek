<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Order</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <div class="mt-2">
            @foreach ($transaksi as $transaksi)
            <table>
                <tr>
                    <td>No Invoice</td>
                    <td> : </td>
                    <td><b>{{ $transaksi->no_invoice }}</b></td>
                </tr>
                <tr>
                    <td>Pelanggan</td>
                    <td>:</td>
                    <td><b>{{ $transaksi->nama_pelanggan }}</b></td>
                </tr>
                <tr>
                    <td>Kasir</td>
                    <td>:</td>
                    <td><b>{{ $transaksi->name }}</b></td>
                </tr>
                <tr>
                    <td>Tanggal Transaksi</td>
                    <td>:</td>
                    <td><b>{{ $transaksi->created_at }}</b></td>
                </tr>
            </table>
            <?php $catatan = $transaksi->catatan ?>
            @endforeach
            
        </div>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Kode Obat</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                </tr>
                <?php $no = 1; ?>
                @foreach ($detail_order as $do)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $do->nama_obat }}</td>
                    <td>{{ $do->kode_obat }}</td>
                    <td>Rp.{{ number_format($do->harga_jual,2,',','.') }}</td>
                    <td>{{ $do->qty }}</td>
                    <td>Rp.{{ number_format($do->total_harga,2,',','.') }}</td>
                </tr>
                @endforeach
            </thead>
        </table>
        Catatan : {{ $catatan }}
        <a href="{{url('/transaksi/cetakstruk/'.$no_invoice)}}" target="_blank" class="btn btn-info float-right"><i class="fas fa-print"></i> Cetak</a>
      </div>
  </div>
    <!-- /.modal-content -->
</div>