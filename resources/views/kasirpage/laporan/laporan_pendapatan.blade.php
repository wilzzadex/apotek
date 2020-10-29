@extends('layout.master')
@section('title','Obat Keluar')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Laporan Pendapatan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Laporan Pendapatan</li>
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
            <h3 class="card-title">Data Obat Masuk</h3>
            {{-- <p><a href="" target="_blank" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#modalPDF">PDF Laporan Penjualan</a><button data-toggle="modal" data-target="#modalEXCEL" class="btn btn-success btn-sm float-right">Excel Laporan Penjualan</button></p> --}}

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            Filter
            <form action="" class="form-horizontal">
                <div class="row">
                    
                        <div class="col-md-5">
                            Tanggal Awal : <input type="date" name="awal" required class="form-control">
                        </div>
                        <div class="col-md-5">
                            Tanggal Akhir : <input type="date" name="akhir" required class="form-control">
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button class="btn btn-block btn-primary">Filter</button>
                        </div>
                    
                </div>
            </form>
            <br>
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Obat</th>
                        <th>No Faktur</th>
                        <th>Suplier</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                  @php
                  $no = 1;
                  $pengeluaran = 0;
                  @endphp
                  
                   @foreach ($obat_masuk as $item)
                   @php
                       $pengeluaran += $item->harga
                   @endphp
                       <tr>
                           <td>{{ $no++ }}</td>
                           <td>{{ $item->nama_obat }}</td>
                           <td>{{ $item->id_faktur }}</td>
                           <td>{{ $item->nama_suplier }}</td>
                           <td>{{ $item->jml_satuan }}</td>
                           <td>Rp. {{ number_format($item->harga,0,',','.') }}</td>
                           <td>{{ $item->tanggal_masuk }}</td>
                       </tr>
                   @endforeach
                </tbody>
              </table>
              {{-- <hr> --}}
              {{-- <span> Pengeluaran {{ isset($_GET['awal']) ? 'Tanggal ' . date('d M Y',strtotime($_GET['awal'])) . ' s/d ' . date('d M Y',strtotime($_GET['akhir'])) : 'Keseluruhan' }} : Rp. {{ number_format($pengeluaran,0) }} </span> --}}
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-12">
          
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Transaksi</h3>
              {{-- <p><a href="" target="_blank" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#modalPDF">PDF Laporan Penjualan</a><button data-toggle="modal" data-target="#modalEXCEL" class="btn btn-success btn-sm float-right">Excel Laporan Penjualan</button></p> --}}
  
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>No Invoice</th>
                        <th>Pelanggan</th>
                        <th>Kasir</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal Transaksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $no = 1;
                      $pendapatan = 0;
                      @endphp
                      @foreach ($transaksi as $t)
                      @php
                         $pendapatan += $t->total_bayar
                      @endphp
                          <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $t->no_invoice }}</td>
                              <td>{{ $t->nama_pelanggan }}</td>
                              <td>{{ $t->name }}</td>
                              <td>{{ $t->jumlah_item }}</td>
                              <td>Rp.{{ number_format($t->total_bayar,2,',','.') }}</td>
                              <td>{{ $t->created_at }}</td>
                          </tr>
                      @endforeach
                    </tbody>
                </table>
                <hr>
                <table>
                    @if (isset($_GET['awal']))
                        <tr>
                            <td>Periode</td>
                            <td style="padding-left: 10px;padding-right:10px">:</td>
                            <td>
                                {{ isset($_GET['awal']) ? date('d M Y',strtotime($_GET['awal'])) . ' s/d ' . date('d M Y',strtotime($_GET['akhir'])) : 'Keseluruhan' }}
                            </td>
                            <td></td>
                        </tr>
                    @endif
                    <tr>
                        <td>Pengeluaran </td>
                        <td style="padding-left: 10px;padding-right:10px">:</td>
                        <td> <b> Rp. {{ number_format($pengeluaran,0) }} </b> </td>
                    </tr>
                    <tr>
                        <td>Pendapatan </td>
                        <td style="padding-left: 10px;padding-right:10px">:</td>
                        <td> <b> Rp. {{ number_format($pendapatan,0) }} </b> </td>
                    </tr>
                    <tr>
                        @php
                            $hasil = $pendapatan - $pengeluaran;
                        @endphp
                        <td>Hasil </td>
                        <td style="padding-left: 10px;padding-right:10px">:</td>
                        <td> <b> Rp. {{ number_format($hasil,0) }} </b> </td>
                    </tr>
                </table>
                {{-- <span> Pengeluaran  : Rp. {{ number_format($pengeluaran,0) }} </span> <br>
                <span> Pengeluaran {{ isset($_GET['awal']) ? 'Tanggal ' . date('d M Y',strtotime($_GET['awal'])) . ' s/d ' . date('d M Y',strtotime($_GET['akhir'])) : 'Keseluruhan' }} : Rp. {{ number_format($pengeluaran,0) }} </span> --}}
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

@endsection
@section('jscustom')
    <script>
        $('#example2').dataTable()
    </script>
@endsection

