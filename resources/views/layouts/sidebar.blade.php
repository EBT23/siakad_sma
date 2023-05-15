<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
      <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
        <use xlink:href="assets/brand/coreui.svg#full"></use>
      </svg>
      <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
        <use xlink:href="assets/brand/coreui.svg#signet"></use>
      </svg>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
      <li class="nav-item"><a class="nav-link" href="index.html">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
          </svg> Dashboard<span class="badge badge-sm bg-info ms-auto">NEW</span></a></li>
      <li class="nav-title">Theme</li>
      <li class="nav-item"><a class="nav-link" href="{{ route('siswa') }}">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-notes"></use>
          </svg> Data Siswa</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('guru') }}">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-notes"></use>
          </svg> Data Guru</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('pelajaran') }}">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calculator"></use>
          </svg> Data Pelajaran</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('pelajaran') }}">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-star"></use>
          </svg> Data Kelas</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('kelas') }}">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart-pie"></use>
          </svg> Data Nilai</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('') }}">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-layers"></use>
          </svg> Jadwal Pelajaran</a></li>
      <li class="nav-item"><a class="nav-link" href="colors.html">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-layers"></use>
          </svg> Jadwal Ujian</a></li>
      <li class="nav-item"><a class="nav-link" href="typography.html">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
          </svg> Pengumuman</a></li>
      
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
  </div>