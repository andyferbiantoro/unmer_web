<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <div class="login-brand">
      <img src="assets/img/Unmer_Branding_Biru.png" alt="logo" width="100" >
    </div>
  </div><br>
   <!--  <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">LKPS Auditor</a>
      </div> -->
      <ul class="sidebar-menu">
        @if(Auth::user()->role == 'superadmin') 
        <li class="{{(request()->is('superadmin_dashboard')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_dashboard') }}"><i class="fas fa-home"></i><span>Beranda</span></a></li>


        <li class="{{(request()->is('superadmin_agrikulture')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_agrikulture') }}"><i class="fas fa-leaf"></i><span>Agrikulture</span></a></li>

        <li class="{{(request()->is('superadmin_koperasi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_koperasi') }}"><i class="fas fa-shopping-bag"></i></i><span>Koperasi</span></a></li>



        <li class="nav-item dropdown {{(request()->is('lapak')) ? 'active' : ''}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-hotel"></i>
            <span>Hotel & Kost</span></a>
            <ul class="dropdown-menu">
              <li class="{{(request()->is('superadmin_koperasi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_koperasi') }}"><i class="fas fa-hotel"></i></i><span>Hotel</span></a></li>

              <li class="{{(request()->is('superadmin_kost')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_kost') }}"><i class="fas fa-hotel"></i></i><span>Kost</span></a></li>
            </ul>
          </li>

           <li class="nav-item dropdown {{(request()->is('lapak')) ? 'active' : ''}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-mountain"></i>
            <span>Wisata & Event</span></a>
            <ul class="dropdown-menu">
              <li class="{{(request()->is('superadmin_koperasi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_koperasi') }}"><i class="fas fa-hotel"></i></i><span>Wisata</span></a></li>

              <li class="{{(request()->is('superadmin_koperasi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_koperasi') }}"><i class="fas fa-hotel"></i></i><span>Event</span></a></li>
            </ul>
          </li>

          <li class="{{(request()->is('superadmin_koperasi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_koperasi') }}"><i class="fas fa-graduation-cap"></i></i><span>Pendidikan</span></a></li>

          <li class="{{(request()->is('superadmin_kelola_transaksi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_kelola_transaksi') }}"><i class="fas fa-money-bill"></i><span>Kelola Transaksi</span></a></li>

          <li class="{{(request()->is('superadmin_kelola_broadcast')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_kelola_broadcast') }}"><i class="fas fa-bullhorn"></i><span>Kelola Broadcast</span></a></li>

          <li class="{{(request()->is('superadmin_kelola_admin')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_kelola_admin') }}"><i class="fas fa-users"></i><span>Kelola Admin</span></a></li>

          <li class="{{(request()->is('superadmin_koperasi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_koperasi') }}"><i class="fas fa-user"></i></i><span>Kelola User</span></a></li>


          <li class="{{(request()->is('superadmin_koperasi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_koperasi') }}"><i class="fas fa-map-marker"></i></i><span>Lokasi User</span></a></li>

          @endif 

          @if(Auth::user()->role == 'admin')
          <li class="{{(request()->is('auditor-hasil_penilaian_lkps')) ? 'active' : ''}}"><a class="nav-link" href=""><i class="fas fa-book"></i><span>Hasil Penilaian Laporan Kinerja Program Studi</span></a></li>

          @endif 
        </ul>




