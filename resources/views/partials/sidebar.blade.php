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

        <li class="{{(request()->is('superadmin_kelola_admin')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_kelola_admin') }}"><i class="fas fa-users"></i><span>Kelola Admin</span></a></li>

        <li class="{{(request()->is('superadmin_kelola_produk')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_kelola_produk') }}"><i class="fas fa-shopping-bag"></i><span>Kelola Produk</span></a></li>

        <li class="{{(request()->is('superadmin_kelola_transaksi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_kelola_transaksi') }}"><i class="fas fa-money-bill"></i><span>Kelola Transaksi</span></a></li>

        <li class="{{(request()->is('auditor-profil')) ? 'active' : ''}}"><a class="nav-link" href=""><i class="fas fa-bullhorn"></i><span>Kelola Broadcast</span></a></li>

        <li class="{{(request()->is('auditor-profil')) ? 'active' : ''}}"><a class="nav-link" href=""><i class="fas fa-leaf"></i><span>Agrikulture</span></a></li>

        @endif 

        @if(Auth::user()->role == 'admin')
        <li class="{{(request()->is('auditor-hasil_penilaian_lkps')) ? 'active' : ''}}"><a class="nav-link" href=""><i class="fas fa-book"></i><span>Hasil Penilaian Laporan Kinerja Program Studi</span></a></li>

        @endif 
      </ul>




