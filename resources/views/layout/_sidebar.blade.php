<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('images/image_profile/'.auth()->user()->foto)}}" style="width:50px;height:50px;" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        <span class="text-success">{{ auth()->user()->role }}</span>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
       @if (auth()->user()->role == 'Admin')
        <li class="nav-item">
            <a href="{{url('dashboard')}}" class="nav-link {{Request::is('dashboard*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link {{Request::is('pegawai*') || Request::is('suplier*') || Request::is('satuan*') || Request::is('pelanggan*') || Request::is('obat*') ? 'active' : ''}}">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Data Master
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">6</span>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: {{Request::is('pegawai*') || Request::is('suplier*') || Request::is('pelanggan*') || Request::is('obat*')  ? 'block' : ''}};">
            <li class="nav-item">
              <a href="{{url('pegawai')}}" class="nav-link {{Request::is('pegawai*') ? 'active' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Pegawai</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('satuan') }}" class="nav-link {{Request::is('satuan*') ? 'active' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Satuan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('suplier')}}" class="nav-link {{Request::is('suplier*') ? 'active' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Suplier</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('pelanggan')}}" class="nav-link {{Request::is('pelanggan*') ? 'active' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Pelanggan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('obat')}}" class="nav-link {{Request::is('obat') ? 'active' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Obat</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('obatmasuk') }}" class="nav-link {{Request::is('obatmasuk*') ? 'active' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Obat Masuk</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
            <a href="{{route('pendapatan')}}" class="nav-link {{Request::is('pendapatan*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Laporan Pendapatan</p>
            </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link {{Request::is('riwayat*') || Request::is('obt-keluar*') ? 'active' : ''}}">
            <i class="nav-icon fas fa-cart-arrow-down"></i>
            <p>
              Transaksi
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">2</span>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: {{Request::is('riwayat*') || Request::is('obt-keluar*') ? 'block' : ''}};">
            <li class="nav-item">
              <a href="{{url('riwayat-transaksi')}}" class="nav-link {{Request::is('riwayat*') ? 'active' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Riwayat Penjualan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('obt-keluar')}}" class="nav-link {{Request::is('obt-keluar*') ? 'active' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Obat Keluar</p>
              </a>
            </li>
          </ul>
        </li>
       @endif

       
       {{-- KASIR --}}
       @if (auth()->user()->role == 'cashier')
       <li class="nav-item">
        <a href="/dashboard" class="nav-link {{Request::is('dashboard*') ? 'active' : ''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
        </a>
      </li>
      @endif
       
     
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
