<form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
        </li>
        @if(Auth::user()->role == "superadmin")
        <h3 style="color: white">Saldo Anda : Rp. <?=number_format($saldo_superadmin->saldo, 0, ".", ".")?>,00</h3><li><a class="nav-link" title="Kelola Saldo" href="{{ route('superadmin_kelola_tambahan') }}"><i class="fas fa-cog"></i></i><span></span></a></li>
        @elseif(Auth::user()->role == "Admin Kasir")
        <h3 style="color: white">Saldo Anda : Rp. <?=number_format($saldo_admin_kasir->saldo, 0, ".", ".")?>,00</h3>
        @elseif(Auth::user()->role == "Admin Penginapan")
        <h3 style="color: white">Saldo Anda : Rp. <?=number_format($saldo_admin_penginapan->saldo, 0, ".", ".")?>,00</h3>
        @elseif(Auth::user()->role == "Admin Event")
        <h3 style="color: white">Saldo Anda : Rp. <?=number_format($saldo_admin_event->saldo, 0, ".", ".")?>,00</h3>
        @elseif(Auth::user()->role == "Admin Pendidikan")
        <h3 style="color: white">Saldo Anda : Rp. <?=number_format($saldo_admin_pendidikan->saldo, 0, ".", ".")?>,00</h3>
        @endif
    </ul>
</form>
<ul class="navbar-nav navbar-right">

    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">

        <img alt="image" src="{{asset ('public/assets/img/avatar/avatar-5.png')}}" class="rounded-circle mr-1">
        

        @if(Auth::user()->role == "superadmin")
        <div class="d-sm-none d-lg-inline-block">Hi, {{$saldo_superadmin->nama}}</div></span></a></li>
          @if(Auth::user()->role == "superadmin")
            <a href="{{route('logout_superadmin')}}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            @endif
        @elseif(Auth::user()->role == "Admin Kasir")
        <div class="d-sm-none d-lg-inline-block">Hi, {{$saldo_admin_kasir->nama}}</div>
        @elseif(Auth::user()->role == "Admin Penginapan")
        <div class="d-sm-none d-lg-inline-block">Hi, {{$saldo_admin_penginapan->nama}}</div>
        @elseif(Auth::user()->role == "Admin Event")
        <div class="d-sm-none d-lg-inline-block">Hi, {{$saldo_admin_event->nama}}</div>
        @elseif(Auth::user()->role == "Admin Wisata")
        <div class="d-sm-none d-lg-inline-block">Hi, {{$saldo_admin_wisata->nama}}</div>
        @elseif(Auth::user()->role == "Admin Pendidikan")
        <div class="d-sm-none d-lg-inline-block">Hi, {{$saldo_admin_pendidikan->nama}}</div>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-right">

          <!--   <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
            </a>
            <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
            </a>
            <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
            </a> -->
            <div class="dropdown-divider"></div>
          

            @if(Auth::user()->role == "Admin Kasir")
            <a href="{{route('admin_kasir_logout')}}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            @endif

            @if(Auth::user()->role == "Admin Penginapan")
            <a href="{{route('admin_penginapan_logout')}}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            @endif

            @if(Auth::user()->role == "Admin Pendidikan")
            <a href="{{route('admin_pendidikan_logout')}}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            @endif

            @if(Auth::user()->role == "Admin Event")
            <a href="{{route('admin_event_logout')}}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            @endif

            @if(Auth::user()->role == "Admin Wisata")
            <a href="{{route('admin_wisata_logout')}}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            @endif
        </div>
    </li>
</ul>
