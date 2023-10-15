<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">UNMER WEB</a>
    </div>
   <!--  <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">LKPS Auditor</a>
    </div> -->
    <ul class="sidebar-menu">
         <li class=""><a class="nav-link" href=""><i class="fas fa-home"></i><span>Beranda</span></a></li>

       <li class=""><a class="nav-link" href=""><i class="fas fa-bullhorn"></i><span>Pengumuman</span></a></li>

        <li class="{{(request()->is('data_lkps')) ? 'active' : ''}}"><a class="nav-link" href=""><i class="fas fa-clipboard"></i><span>Laporan Kinerja Program Studi</span></a></li>

        <li class="{{(request()->is('auditor-profil')) ? 'active' : ''}}"><a class="nav-link" href=""><i class="fas fa-user"></i><span>Kelola Akun</span></a></li>

       <li class="{{(request()->is('auditor-hasil_penilaian_lkps')) ? 'active' : ''}}"><a class="nav-link" href=""><i class="fas fa-book"></i><span>Hasil Penilaian Laporan Kinerja Program Studi</span></a></li>
    </ul>
</aside>


