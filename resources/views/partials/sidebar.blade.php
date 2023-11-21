<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <div class="login-brand">
      <img src="public/assets/img/Unmer_Branding_Biru.png" alt="logo" width="100" >
    </div>
  </div><br>
   <!--  <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">LKPS Auditor</a>
      </div> -->
      <ul class="sidebar-menu">
        @if(Auth::user()->role == 'superadmin') 
        <li class="{{(request()->is('superadmin_dashboard')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_dashboard') }}"><i class="fas fa-home"></i><span>Beranda</span></a></li>


        @if((request()->is('superadmin_agrikulture')))
        <li class="nav-item dropdown {{(request()->is('superadmin_agrikulture')) ? 'active' : ''}}">
        @elseif((request()->is('superadmin_biaya_layanan_agrikulture')))
        <li class="nav-item dropdown {{(request()->is('superadmin_biaya_layanan_agrikulture')) ? 'active' : ''}}">
        @else
        <li class="nav-item dropdown">
        @endif
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-leaf"></i>
            <span>Agrikulture</span></a>
            <ul class="dropdown-menu">
              <li class="{{(request()->is('superadmin_agrikulture')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_agrikulture') }}"><i class="fas fa-leaf"></i></i><span>Kelola Agrikulture</span></a></li>

              <li class="{{(request()->is('superadmin_biaya_layanan_agrikulture')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_biaya_layanan_agrikulture') }}"><i class="fas fa-money-bill-wave"></i></i><span>Biaya Layanan</span></a></li>
            </ul>
          </li>


        @if((request()->is('superadmin_koperasi')))
        <li class="nav-item dropdown {{(request()->is('superadmin_koperasi')) ? 'active' : ''}}">
        @elseif((request()->is('superadmin_biaya_layanan_koperasi')))
        <li class="nav-item dropdown {{(request()->is('superadmin_biaya_layanan_koperasi')) ? 'active' : ''}}">
        @else
        <li class="nav-item dropdown">
        @endif
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-shopping-bag"></i>
            <span>Koperasi</span></a>
            <ul class="dropdown-menu">
              <li class="{{(request()->is('superadmin_koperasi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_koperasi') }}"><i class="fas fa-shopping-bag"></i></i><span>Kelola Koperasi</span></a></li>

              <li class="{{(request()->is('superadmin_biaya_layanan_koperasi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_biaya_layanan_koperasi') }}"><i class="fas fa-money-bill-wave"></i></i><span>Biaya Layanan</span></a></li>
            </ul>
          </li>


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

            <li class="{{(request()->is('superadmin_kelola_broadcast')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_kelola_broadcast') }}"><i class="fas fa-bullhorn"></i><span>Kelola Broadcast</span></a></li>

            <li class="{{(request()->is('superadmin_kelola_admin')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_kelola_admin') }}"><i class="fas fa-users"></i><span>Kelola Admin</span></a></li>

            <li class="{{(request()->is('superadmin_koperasi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_koperasi') }}"><i class="fas fa-user"></i></i><span>Kelola User</span></a></li>

            <li class="{{(request()->is('superadmin_koperasi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_koperasi') }}"><i class="fas fa-map-marker"></i></i><span>Lokasi User</span></a></li>

            <li class="{{(request()->is('superadmin_kelola_topup')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('superadmin_kelola_topup') }}"><i class="fas fa-money-bill"></i><span>Kelola Top Up</span></a></li>
            @endif 









            @if(Auth::user()->role == 'Admin Kasir')
            <br>

            <li class="{{(request()->is('admin_kasir_dashboard')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_kasir_dashboard') }}"><i class="fas fa-home"></i><span>Beranda</span></a></li>

            @if((request()->is('admin_kasir_agrikulture')))
            <li class="nav-item dropdown {{(request()->is('admin_kasir_agrikulture')) ? 'active' : ''}}">
            @elseif((request()->is('admin_kelola_agrikulture')))
            <li class="nav-item dropdown {{(request()->is('admin_kelola_agrikulture')) ? 'active' : ''}}">
             @elseif((request()->is('admin_kasir_lihat_pesanan_agrikulture')))
            <li class="nav-item dropdown {{(request()->is('admin_kasir_lihat_pesanan_agrikulture')) ? 'active' : ''}}">
            @elseif((request()->is('admin_kasir_lihat_pesanan_agrikulture_diantar')))
            <li class="nav-item dropdown {{(request()->is('admin_kasir_lihat_pesanan_agrikulture_diantar')) ? 'active' : ''}}">
            @elseif((request()->is('admin_kasir_lihat_pesanan_agrikulture_diambil')))
            <li class="nav-item dropdown {{(request()->is('admin_kasir_lihat_pesanan_agrikulture_diantar')) ? 'active' : ''}}">
            @elseif((request()->is('admin_kasir_lihat_pesanan_agrikulture_offline')))
            <li class="nav-item dropdown {{(request()->is('admin_kasir_lihat_pesanan_agrikulture_diantar')) ? 'active' : ''}}">
            @else
            <li class="nav-item dropdown">
            @endif
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-mountain"></i>
              <span>Agrikulture</span></a>
              <ul class="dropdown-menu">
                <li class="{{(request()->is('admin_kelola_agrikulture')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_kelola_agrikulture') }}"><i class="fas fa-shopping-basket"></i></i><span>Produk</span></a></li>

                <li class="{{(request()->is('admin_kasir_agrikulture')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_kasir_agrikulture') }}"><i class="fas fa-cart-plus"></i></i><span>Kasir</span></a></li>

                <li class="{{(request()->is('admin_kasir_lihat_pesanan_agrikulture_diantar')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_kasir_lihat_pesanan_agrikulture_diantar') }}"><i class="fas fa-shopping-cart"></i></i><span>Lihat Pesanan</span></a></li> 
              </ul>
            </li>


            @if((request()->is('admin_kasir_koperasi')))
            <li class="nav-item dropdown {{(request()->is('admin_kasir_koperasi')) ? 'active' : ''}}">
            @elseif((request()->is('admin_kelola_koperasi')))
            <li class="nav-item dropdown {{(request()->is('admin_kelola_koperasi')) ? 'active' : ''}}">
             @elseif((request()->is('admin_kasir_lihat_pesanan_agrikulture')))
            <li class="nav-item dropdown {{(request()->is('admin_kasir_lihat_pesanan_agrikulture')) ? 'active' : ''}}">
            @elseif((request()->is('admin_kasir_lihat_pesanan_koperasi_diantar')))
            <li class="nav-item dropdown {{(request()->is('admin_kasir_lihat_pesanan_koperasi_diantar')) ? 'active' : ''}}">
            @elseif((request()->is('admin_kasir_lihat_pesanan_koperasi_diambil')))
            <li class="nav-item dropdown {{(request()->is('admin_kasir_lihat_pesanan_koperasi_diantar')) ? 'active' : ''}}">
            @elseif((request()->is('admin_kasir_lihat_pesanan_koperasi_offline')))
            <li class="nav-item dropdown {{(request()->is('admin_kasir_lihat_pesanan_koperasi_diantar')) ? 'active' : ''}}">
            @else
            <li class="nav-item dropdown">
            @endif
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-shopping-bag"></i>
              <span>Koperasi</span></a>
              <ul class="dropdown-menu">
                <li class="{{(request()->is('admin_kelola_koperasi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_kelola_koperasi') }}"><i class="fas fa-shopping-basket"></i></i><span>Produk</span></a></li>

                <li class="{{(request()->is('admin_kasir_koperasi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_kasir_koperasi') }}"><i class="fas fa-cart-plus"></i></i><span>Kasir</span></a></li>

                <li class="{{(request()->is('admin_kasir_lihat_pesanan_koperasi_diantar')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_kasir_lihat_pesanan_koperasi_diantar') }}"><i class="fas fa-shopping-cart"></i></i><span>Lihat Pesanan</span></a></li> 
              </ul>
            </li>

            <li class="{{(request()->is('admin_kelola_koperasi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_kelola_koperasi') }}"><i class="fas fa-shopping-bag"></i></i><span>Koperasi</span></a></li>
            @endif 
          </ul>




