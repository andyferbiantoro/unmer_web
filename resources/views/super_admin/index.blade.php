@extends('layouts.app')

@section('title')
Dashboard Super Admin
@endsection


@section('content')
@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
  {{ session('error') }}
</div>
@endif
<div class="row">
  
  <div class="col-lg-6 col-md-6 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-stats">
        <div class="card-stats-title">Data Pengguna
        </div>
        <div class="card-stats-items">
          <div class="card-stats-item">
            <div class="card-stats-item-count">{{$belum_ver}}</div>
            <div class="card-stats-item-label">Belum Verifikasi</div>
          </div>
          <div class="card-stats-item">
            <div class="card-stats-item-count">{{$belum_ver}}</div>
            <div class="card-stats-item-label">Menunggu Verifikasi</div>
          </div>
          <div class="card-stats-item">
            <div class="card-stats-item-count">{{$sudah_ver}}</div>
            <div class="card-stats-item-label">Sudah Verifikasi</div>
          </div>
        </div>
      </div>
      <div class="card-icon shadow-primary bg-primary">
        <i class="fas fa-users"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Pengguna</h4>
        </div>
        <div class="card-body">
          {{$total_pengguna}} Pengguna
        </div>
      </div>
    </div>
  </div>


  <div class="col-lg-6 col-md-6 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-stats">
        <div class="card-stats-title">Data Partner
        </div>
        <div class="card-stats-items">
          <div class="card-stats-item">
            <div class="card-stats-item-count">{{$total_partner}}</div>
            <div class="card-stats-item-label">Total Partner</div>
          </div>
          <div class="card-stats-item">
            <div class="card-stats-item-count">{{$total_partner_laki}}</div>
            <div class="card-stats-item-label">Laki-Laki</div>
          </div>
          <div class="card-stats-item">
            <div class="card-stats-item-count">{{$total_partner_perempuan}}</div>
            <div class="card-stats-item-label">Perempuan</div>
          </div>
        </div>
      </div>
      <div class="card-icon shadow-primary bg-primary">
        <i class="fas fa-user"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Partner</h4>
        </div>
        <div class="card-body">
          {{$total_partner}} Partner
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ================================================================================================================= -->

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-stats">
        <div class="card-stats-title">Data Mitra
        </div>
        <div class="card-stats-items">
          <div class="card-stats-item">
            <div class="card-stats-item-count">24</div>
            <div class="card-stats-item-label">Belum Verifikasi</div>
          </div>
          <div class="card-stats-item">
            <div class="card-stats-item-count">12</div>
            <div class="card-stats-item-label">Menunggu Verifikasi</div>
          </div>
          <div class="card-stats-item">
            <div class="card-stats-item-count">23</div>
            <div class="card-stats-item-label">Sudah Verifikasi</div>
          </div>
        </div>
      </div>
      <div class="card-icon shadow-primary bg-primary">
        <i class="fas fa-handshake"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Mitra</h4>
        </div>
        <div class="card-body">
          {{$total_pengguna}} Mitra
        </div>
      </div>
    </div>
  </div>


  <div class="col-lg-6 col-md-6 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-stats">
        <div class="card-stats-title">Data Pesanan
        </div>
        <div class="card-stats-items">
          <div class="card-stats-item">
            <div class="card-stats-item-count">24</div>
            <div class="card-stats-item-label">Belum Verifikasi</div>
          </div>
          <div class="card-stats-item">
            <div class="card-stats-item-count">12</div>
            <div class="card-stats-item-label">Shipping</div>
          </div>
          <div class="card-stats-item">
            <div class="card-stats-item-count">23</div>
            <div class="card-stats-item-label">Completed</div>
          </div>
        </div>
      </div>
      <div class="card-icon shadow-primary bg-primary">
        <i class="fas fa-shopping-cart"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Pesanan</h4>
        </div>
        <div class="card-body">
          {{$total_transkasi}} Pesanan
        </div>
      </div>
    </div>
  </div>
</div>


@endsection


