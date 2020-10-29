@extends('layout.master')
@section('title','Obat')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Obat</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Obat</li>
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
            <h3 class="card-title">Data Obat</h3>
            <button type="button" data-toggle="modal" data-target="#modal-default"
              class="btn btn-primary fas fa fa-plus-square float-right"></button>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Obat</th>
                  <th>Kode Obat</th>
                  <th>No Bet</th>
                  <th>Suplier</th>
                  <th>Harga Suplier</th>
                  <th>Harga Jual</th>
                  <th>Stok</th>
                  <th>Kadaluarsa</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($obat as $obat)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $obat->nama_obat }}</td>
                      <td>{{ $obat->kode_obat }}</td>
                      <td>{{ $obat->no_bet }}</td>
                      <td>{{ $obat->suplier->nama_suplier }}</td>
                      <td>Rp.{{ number_format($obat->harga_suplier,2,',','.') }}</td>
                      <td>Rp.{{ number_format($obat->harga_jual,2,',','.') }}</td>
                      <td>{{ $obat->stok }}</td>
                      <td>{{ date('d M Y',strtotime($obat->expired)) }}</td>
                      <td>
                        <a href="#" type="button" class="btn btn-block btn-outline-primary btn-xs editobat" data-toggle="modal" id="{{$obat->id}}"><i class="fas fa-edit"></i></a>
                        <a href="{{url('obat/'.$obat->id.'/delete')}}" onclick="return confirm('Yakin akan Menghapus Data Ini ?')" class="btn btn-block btn-outline-danger btn-xs"><i class="fas fa-trash"></i></a></td>
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
        <h4 class="modal-title">Tambah Obat</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('obat.store')}}" method="POST" data-parsley-validate enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group row">
            <div class="col-sm-5">
              <label>Nama Obat</label>
              <input type="text" name="nama_obat" placeholder="Nama obat ..." class="form-control" required>
            </div>
            <div class="col-sm-3">
              <label>Jumlah</label>
              <input type="number" name="jml_satuan" id="jml_satuan" placeholder="Jumlah ..." class="form-control" required>
            </div>
            <div class="col-sm-4">
              <label>Satuan</label>
              <select name="satuan" class="form-control" id="satuan" required>
                <option value="">- Pilih Satuan -</option>
                @foreach ($box as $satuan)
                    <option value="{{ $satuan->id }}" data-jumlah="{{ $satuan->jumlah }}">{{ $satuan->nama }} - isi {{ $satuan->jumlah }}</option>
                @endforeach
              </select>
              <input type="hidden" name="stok" id="stok">
            </div>
          </div>
          <div class="form-group">
            <label for="">Harga</label>
            <input type="text" required name="harga_keseluruhan" id="harga_keseluruhan" class="form-control">
          </div>
          <div class="form-group row">
            <div class="col-sm-6">
              <label>Kode Obat</label>
              <input type="text" name="kode_obat" class="form-control" required>
            </div>
            <div class="col-sm-6">
              <label>No Bet</label>
              <input type="text" name="no_bet" class="form-control" required>
            </div>
            
          </div>
         
          <div class="form-group row">
            <div class="col-sm-6">
              <label for="Kode">Suplier</label>
                <select name="suplier_id" id="suplier" required class="form-control">
                    <option value="">-- Pilih Suplier --</option>
                    @foreach ($suplier as $suplier)
                        <option value="{{$suplier->id}}">{{$suplier->nama_suplier}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6">
              <label for="">No Faktur</label>
              <input type="text" name="no_faktur" class="form-control">
            </div>
            
          </div>
          <div class="form-group row">
            <div class="col-sm-5">
              <label>Harga Suplier</label>
              <input type="text" id="harga_suplier" name="harga_suplier" class="form-control" required>
            </div>
            <div class="col-sm-5">
              <label>Naikkan Harga (%)</label>
              <input type="number" id="persen" name="persen" class="form-control" required>
            </div>
            <div class="col-sm-2">
              <label>Action</label>
              <button type="button" onclick="updateHarga()" class="btn btn-warning ">Cek</button>
            </div>
          </div>
          <div class="form-group">
            <label>Harga Jual (Per tablet)</label>
            <input type="text" readonly id="harga_jual" name="harga_jual" class="form-control" required>
          </div>
          {{-- <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required>
          </div> --}}
          
          <div class="form-group">
            <label for="Kode">Kadaluarsa</label>
            <input type="date" name="expired" class="form-control" required>
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
<div class="modal fade" id="EditObat">
	
</div>
@endsection
@section('javaScript')

<script type="text/javascript">
  $('#satuan').select2()
  function updateHarga(){
    // alert('tes');
    // let opr = '+';
    var persen = 0;
    var harga_suplier = 0;
    var input1 = document.getElementById("harga_suplier").value;
    var input2 = input1.replace("Rp.", "");
    var harga_suplier = Number(input2.replace(".", ""));
    // console.log(harga_suplier)
    var persen = Number(document.getElementById("persen").value) / 100;
    var result = harga_suplier + (harga_suplier * persen)
    var harga_jual_result = document.getElementById("harga_jual").value = result;
  }
  function updateHargaedit(){
    // alert('tes')
    // let opr = '+';
    var persen = 0;
    var harga_suplier = 0;
    var harga_suplier = Number(document.getElementById("harga_suplier_edit").value);
    var persen = Number(document.getElementById("persen_edit").value) / 100;
    var result = harga_suplier + (harga_suplier * persen)
    document.getElementById("harga_jual_edit").value = result;
  }

  var jumlah,jumlah_sataun,result = 0
  $('#satuan').on('change',function(){

    jumlah = $(this).find(':selected').attr('data-jumlah');
    jumlah_sataun = $('#jml_satuan').val();

    result = (parseInt(jumlah) * parseInt(jumlah_sataun));
    $('#stok').val(result)
  })

  $('#EditObat').on('change','#satuan_edit',function(){
    jumlah = $(this).find(':selected').attr('data-jumlah');
    jumlah_sataun = $('#jml_satuan_edit').val();

    result = (parseInt(jumlah) * parseInt(jumlah_sataun));
    $('#stok_edit').val(result)
  });

    var harga_keseluruhan = document.getElementById('harga_keseluruhan');
		  harga_keseluruhan.addEventListener('keyup', function(e){
			harga_keseluruhan.value = formatRupiah(this.value, 'Rp.');
		});
 
    var harga_suplier = document.getElementById('harga_suplier');
		  harga_suplier.addEventListener('keyup', function(e){
			harga_suplier.value = formatRupiah(this.value, 'Rp.');
		});
   
    // var harga_jual = document.getElementById('harga_jual');
		//   harga_jual.addEventListener('change', function(e){
		// 	harga_jual.value = formatRupiah(this.value, 'Rp.');
		// });
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp.' + rupiah : '');
		}

  $(document).ready(function (){
    /*$(".mapeledit").click(function (e){*/
      $("#example1").on("click",".editobat",function(){
        var m = $(this).attr("id");
        $.ajax({
          url: "obat/"+m+"/edit",
          type: "GET",
          data : {id: m,},
          success: function (ajaxData){
            $("#EditObat").html(ajaxData);
            $("#EditObat").modal('show',{backdrop: 'true'});
          }
        });
      });
    });
  </script>
@endsection