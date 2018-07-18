<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="{{ asset('image/a.jpg') }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p style="font-size:13px;">Sistem Informasi Strategis</p>
      <a href="#"><!--<i class="fa fa-circle text-success">--></i> Pengembangan SDM</a>
    </div>
  </div>

  <!-- search form -->
  {{-- <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
      <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
    </div>
  </form> --}}

  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>


    <li class="<?php if (Route::getCurrentRoute()->uri == 'dashboard') {
      echo "active";
    } ?>">
      <a href="{{ route('dashboard') }}">
        <i class="fa fa-home"></i> <span>Dashboard</span>
      </a>
    </li>


    <li class="treeview">
      <a href="#">
        <i class="fa fa-table"></i> <span>Data Master</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('agama.index') }}"><i class="fa fa-circle-o"></i> List Agama</a></li>
        <li><a href="{{ route('jeniskelamin.index') }}"><i class="fa fa-circle-o"></i> List Jenis Kelamin</a></li>
        <li><a href="{{ route('statusperkawinan.index') }}"><i class="fa fa-circle-o"></i> List Status Perkawinan</a></li>
        <li><a href="{{ route('statuspegawai.index') }}"><i class="fa fa-circle-o"></i> List Status Pegawai</a></li>
        <li><a href="{{ route('statushukum.index') }}"><i class="fa fa-circle-o"></i> List Status Hukum</a></li>
        <li><a href="{{ route('unit.index') }}"><i class="fa fa-circle-o"></i> List Unit</a></li>
        {{-- <li><a href="{{ route('jabatan.index') }}"><i class="fa fa-circle-o"></i> List Jabatan</a></li> --}}
        <li><a href="{{ route('jenisjabatan.index') }}"><i class="fa fa-circle-o"></i> List Jenis Jabatan</a></li>
        <li><a href="{{ route('pangkat.index') }}"><i class="fa fa-circle-o"></i> List Pangkat</a></li>
        {{-- <li><a href="{{ route('eselon.index') }}"><i class="fa fa-circle-o"></i> List Eselon</a></li> --}}
        <li><a href="{{ route('jenjang.index') }}"><i class="fa fa-circle-o"></i> List Jenjang</a></li>
      </ul>
    </li>

    <li class="<?php if (Route::getCurrentRoute()->uri == 'pegawai.index') {
      echo "active";
    } ?>">
      <a href="{{ route('pegawai.index') }}">
        <i class="fa fa-users"></i> <span>List Pegawai</span>
      </a>
    </li>

    {{-- <li>
      <a href="{{ route('riwayatpendidikan.index') }}">
        <i class="fa fa-graduation-cap"></i> <span>List Riwayat Pendidikan</span>
      </a>
    </li> --}}

    {{-- <li>
      <a href="{{ route('riwayatpangkat.index') }}">
        <i class="fa fa-certificate"></i> <span>List Riwayat Pangkat</span>
      </a>
    </li> --}}

    {{-- <li>
      <a href="{{ route('riwayatjabatan.index') }}">
        <i class="fa fa-sitemap"></i> <span>List Riwayat Jabatan</span>
      </a>
    </li> --}}

    {{-- <li>
      <a href="{{ route('riwayatdiklat.index') }}">
        <i class="fa fa-book"></i> <span>List Riwayat Diklat</span>
      </a>
    </li> --}}

    <li class="<?php if (Route::getCurrentRoute()->uri == 'filterpegawai') {
      echo "active";
    } ?>">
      <a href="{{ route('filterpegawai') }}">
        <i class="fa fa-search"></i> <span>Filter Pegawai</span>
      </a>
    </li>

    {{-- <li>
      <a href="#">
        <i class="fa fa-id-badge"></i> <span>Usulan Diklat Pegawai</span>
      </a>
    </li> --}}

    <li class="treeview">
      <a href="#">
        <i class="fa fa-id-badge"></i> <span>Usulan Diklat</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="#"><i class="fa fa-circle-o"></i> Diklat PIM II</a></li>
        <li><a href="#"><i class="fa fa-circle-o"></i> Diklat PIM III</a></li>
        <li><a href="{{ route('usulandiklatpim4') }}"><i class="fa fa-circle-o"></i> Diklat PIM IV</a></li>
      </ul>
    </li>

  </ul>
</section>
