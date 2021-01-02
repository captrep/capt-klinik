@section('sidebar')
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{route('dashboard')}}">Klinik</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="dropdown">
          <a href="{{route('dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>
        <li class="menu-header">Master Data</li>
        @if (auth()->user()->role == 'admin')
        <li class="dropdown {{ request()->is('dokter') || request()->is('dokter/create') ? 'active' : ''}}">
            <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i><span>Data Dokter</span></a>
              <ul class="dropdown-menu">
                <li class="{{ request()->is('dokter') ? 'active' : ''}}"><a class="nav-link" href="{{route('dokter')}}">Lihat Data Dokter</a></li>
                <li class="{{ request()->is('dokter/create') ? 'active' : ''}}"><a class="nav-link" href="{{route('create.dokter')}}">Tambah Data Dokter</a></li>
              </ul>
        </li>
        <li class="dropdown {{ request()->is('staff') || request()->is('staff/create') ? 'active' : ''}}">
          <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i><span>Data Staff</span></a>
            <ul class="dropdown-menu">
              <li class="{{ request()->is('staff') ? 'active' : ''}}"><a class="nav-link" href="{{route('staff')}}">Lihat Data Staff</a></li>
              <li class="{{ request()->is('staff/create') ? 'active' : ''}}"><a class="nav-link" href="{{route('create.staff')}}">Tambah Data Staff</a></li>
            </ul>
        </li>    
        @endif
        <li class="dropdown {{ request()->is('pasien') || request()->is('pasien/create') ? 'active' : ''}}">
          <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i><span>Data Pasien</span></a>
            <ul class="dropdown-menu">
              <li class="{{ request()->is('pasien') ? 'active' : ''}}"><a class="nav-link" href="{{route('pasien')}}">Lihat Data Pasien</a></li>
              <li class="{{ request()->is('pasien/create') ? 'active' : ''}}"><a class="nav-link" href="{{route('create.pasien')}}">Tambah Data Pasien</a></li>
            </ul>
        </li>
        @if (auth()->user()->role == 'admin')
        <li class="menu-header">Export Excel</li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-file-alt"></i> <span>Download Laporan</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('export.dokter')}}">Dokter</a></li>
            <li><a class="nav-link" href="{{route('export.staff')}}">Staff</a></li>
            <li><a class="nav-link" href="{{route('export.pasien')}}">Pasien</a></li>
          </ul>
        </li>
        @endif
        


  </div>
@endsection