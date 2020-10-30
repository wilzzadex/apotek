@extends('kasirpage.master')
@section('content')
<div class="container-fluid">
  <form action="{{url('transaksi/simpan')}}" method="POST" data-parsley-validate="">
    {{ csrf_field() }}
    <div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <!-- general form elements -->
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-file-alt"></i> Informasi Petugas</h3>
          </div>
          <div class="card-body">
              <div class="card-body">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label">No Invoice.</label>
                  <div class="col-sm-8">
                    <input type="hidden" name="kasir_id" value="{{auth()->user()->id}}">
                    <input class="form-control form-control-sm" name="no_invoice" value="{{$no_invoice}}" type="text" readonly>    
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal.</label>
                  <div class="col-sm-8">
                    <input class="form-control form-control-sm" readonly type="text" value="{{date('d - M - Y')}}">    
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label">Kasir.</label>
                  <div class="col-sm-8">
                    <input class="form-control form-control-sm" type="text" readonly value="{{auth()->user()->name}}">    
                  </div>
                </div>
              </div>
          </div>
         
        </div>
        <!-- /.card -->
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-user"></i> Informasi Pelanggan</h3>
          </div>
          <div class="card-body">
              <div class="card-body">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label">Pelanggan</label>
                  <div class="col-sm-8">
                    <select name="pelanggan_id" class="form-control">
                      @foreach ($pelanggan as $pelanggan)
                          <option value="{{$pelanggan->id}}">{{ $pelanggan->nama_pelanggan }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                {{-- <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label">No Nota.</label>
                  <div class="col-sm-8">
                    <input class="form-control form-control-sm" type="text">    
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label">Kasir.</label>
                  <div class="col-sm-8">
                    <input class="form-control form-control-sm" type="text">    
                  </div>
                </div> --}}
              </div>
          </div>
         
        </div>

      

      </div>
      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-9">
        <!-- general form elements disabled -->
        <h5>
          <i class="fas fa-shopping-cart"></i> Detail Transaksi 
          <a href="" class="float-right"><i class="fas fa-sync-alt"></i> Refresh Halaman</a>
          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal">
            Tambah
          </button>
        </h5>
        
        <table class="table table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col">No</th>
              <th>Kode Obat</th>
              <th>No Batch</th>
              <th>Nama Obat</th>
              <th>Harga</th>
              <th>Jumlah</th>
              <th>Pcs</th>
              <th>Total</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; ?>
            @foreach ($temp as $temp)           
            <tr>
              <th scope="row">{{ $no++ }}</th>
              <td>{{ $temp->kode_obat }}</td>
              <td>{{ $temp->no_bet }}</td>
              <td>{{ $temp->nama_obat }}</td>
              <td><a href="#" class="ubahHarga" data-toggle="modal" id="{{$temp->id}}">Rp.{{ number_format($temp->harga_jual,2,',','.') }}</a></td>
              <td>
                @php
                    $satuan = DB::table('master_type')->where('id',$temp->satuan_id)->first();
                @endphp
                {{ $temp->jml_satuan }} &nbsp; {{ $satuan->nama }}
              </td>
              <td>{{ $temp->qty }}</td>
              <td>Rp.{{ number_format($temp->total_harga,2,',','.') }}</td>
              <td><a href="{{url('temp/'.$temp->id.'/delete')}}" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="alert alert-success">
          @foreach ($grandTotal as $grandT)
         
          <h3 align="right"> Grand Total : Rp. {{ number_format($grandT->total,2,',','.') }}</h3>
               
          @endforeach
        </div>
        <!-- /.card -->
        <div class="row">
         
          <div class="col-6">
            <div class="form-group">
              <textarea class="form-control" name="catatan" id="" cols="5" rows="10" placeholder="Catatan jika ada"></textarea>
            </div>
          </div>
          <div class="col-2">
            
          </div>
          <div class="col-4">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-4 col-form-label">Total Bayar</label>
              <div class="col-sm-8">
                @foreach ($grandTotal as $gt)
                <input type="hidden" name="total_bayar" id="total_bayar" value="{{$gt->total}}">
                <input type="hidden" name="jumlah_item" value="{{$gt->qty}}">
                @endforeach
                <input type="text" id="uang_bayar" name="uang_bayar" onkeyup="hitung()" class="form-control form-control-sm" required >    
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-4 col-form-label" >Kembalian</label>
              <div class="col-sm-8">
                <input class="form-control form-control-sm" type="text" value="0" id="kembali" name="uang_kembali" readonly>    
              </div>
            </div>
            <button type="submit" id="btn_simpan" class="btn btn-success float-right"><i class="fas fa-save"></i> Simpan</button>
            {{-- <button type="submit" class="btn btn-info float-right"><i class="fas fa-print"></i> Cetak</button> --}}
          </div>
        </div>
       
        
       
      </div>
      <!--/.col (right) -->
    </div>
  </form>
    <!-- /.row -->
  </div>
  <div class="modal fade" id="ubahHarga">
      
  </div>
  <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{url('addTemp')}}" method="POST" data-parsley-validate="">
            {{ csrf_field() }}
            <div class="form-group">
              <input type="hidden" readonly name="no_invoice" value="{{$no_invoice}}">
              <label for="exampleInputEmail1">Obat</label><br>
              <select name="obat_id" id="obat" style="width: 100%;height:100%" class="form-control">
                <option value="">-- PILIH OBAT --</option>
                @foreach ($obat as $obat)
                    <option value="{{$obat->id}}">{{ $obat->nama_obat }} - {{ $obat->kode_obat }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group row">
              <div class="col-sm-6">
                <label>Jumlah</label>
                <input type="number" onkeyup="hitungJumlah(this)" name="jml_satuan" id="jml_satuan" class="form-control" required>
              </div>
              <div class="col-sm-6" style="display: none;" id="col_satuan">
                <label>Satuan</label><br>
                <select name="satuan_id" style="width: 100%" class="form-control" id="satuan" required>
                  <option value="">- Pilih Satuan -</option>
                  @foreach ($box as $satuan)
                      <option value="{{ $satuan->id }}" data-jumlah="{{ $satuan->jumlah }}">{{ $satuan->nama }} - isi {{ $satuan->jumlah }}</option>
                  @endforeach
                </select>
                <input type="hidden" name="qty" id="stok">
              </div>
              
            </div>
            <button type="submit" class="btn-sm btn btn-primary">Tambahkan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- <div class="form-group">
            
             
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah<br>
            
          </div> --}}
@endsection
@section('javaScript')

<script type="text/javascript">
function hitung(){
       
      var uang_bayar  = document.getElementById('uang_bayar').value;
      var total_bayar = document.getElementById('total_bayar').value;
      var btn_simpan = document.getElementById('btn_simpan');
      
      var kembalian = uang_bayar - total_bayar;
      var kembali = document.getElementById('kembali').value = kembalian;

      
   
}

  function hitungJumlah(obj){
    document.getElementById('col_satuan').style.display = ''
    var isi = $(obj).val();
    if(isi == ''){
      document.getElementById('col_satuan').style.display = 'none'
      $('#satuan').val('').change()
    }

  }

function updateHarga(){
    // alert('tes');
    // let opr = '+';
    var persen = 0;
    var harga_suplier = 0;
    var harga_suplier = Number(document.getElementById("harga_asal").value);
    var persen = Number(document.getElementById("persen").value) / 100;
    var result = harga_suplier - (harga_suplier * persen)
    document.getElementById("harga_baru").value = result;
  }

  var jumlah,jumlah_sataun,result = 0
  $('#satuan').on('change',function(){

    jumlah = $(this).find(':selected').attr('data-jumlah');
    jumlah_sataun = $('#jml_satuan').val();

    result = (parseInt(jumlah) * parseInt(jumlah_sataun));
    $('#stok').val(result)
  })

$(document).ready(function(){
  $("#obat").select2({
    // dropdownParent: $('#exampleModal'),
    placeholder: 'Cari Obat / Kode Obat..'

  });
  $("#satuan").select2({
    // dropdownParent: $('#exampleModal'),
    placeholder: 'Satuan..'

  });

  $(".ubahHarga").on("click",function(){
        var m = $(this).attr("id");
        // alert(m);
        $.ajax({
          url: "kasir/"+m+"/viewUbahHarga",
          type: "GET",
          data : {id: m,},
          success: function (ajaxData){
            $("#ubahHarga").html(ajaxData);
            $("#ubahHarga").modal('show',{backdrop: 'true'});
          }
        });
      });
})




</script>
{{-- <script>

$('#itemName').select2({
    // placeholder: 'Cari...',
    ajax: {
      url: 'select2json',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              text: item.nama_obat,
              id: item.id
            }
          })
        };
      },
      cache: true
    }
  });
</script> --}}
@endsection