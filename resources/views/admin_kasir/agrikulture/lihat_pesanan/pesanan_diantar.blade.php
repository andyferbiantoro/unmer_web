@extends('layouts.app')

@section('title')
Lihat Pesanan Agrikultur
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">

  <!-- Pesanan Diantar -->
  <div class="card">
    <div class="card-body">
      <h2 class="primary">Pesanan Diantar </h2>
      <hr>

    <a href="{{ route('admin_kasir_lihat_pesanan_agrikulture_diantar') }}"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-motorcycle"></i> Pesanan Diantar</button></a>
    <a href="{{ route('admin_kasir_lihat_pesanan_agrikulture_diambil') }}"><button type="button" class="btn btn-light btn-sm"><i class="fas fa-shopping-bag"></i> Pesanan Diambil</button></a>
    <a href="{{ route('admin_kasir_lihat_pesanan_agrikulture_offline') }}"><button type="button" class="btn btn-light btn-sm"><i class="fas fa-store"></i> Pesanan Offline</button></a>
   
    <hr>
      @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
      @endif
      <div class="text-center" >
       <div class="table-responsive">
        <table id="dataTable" class="table table-striped" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Pemesan</th>
              <th>Nominal</th>
              <th>Catatan</th>
              <th>Status Pemesanan</th>
              
              <th>Opsi</th>
              <th style="display: none;">hidden</th>
            </tr>
          </thead>
          <tbody>
            @php $no=1 @endphp
            @foreach($pesanan_diantar as $data)
            <tr>
              <td>{{$no++}}</td>
              <td>{{$data->nama}}</td>
              <td>Rp. <?=number_format($data->nominal, 0, ".", ".")?>,00</td>
              <td>{{$data->catatan}}</td>
              @if($data->status_pemesanan == 'dikemas')
              <td><div class="badge badge-warning">Sedang Dikemas</div></td>
              @elseif($data->status_pemesanan == 'diantar')
              <td><div class="badge badge-info">Sedang Diantar</div></td>
              @elseif($data->status_pemesanan == 'selesai')
              <td><div class="badge badge-success">Pesanan Sampai</div></td>
              @endif
              <td>
                <!-- <button class="btn btn-warning btn-sm icon-file menu-icon edit" title="Edit">Edit</button> -->

                <a href="{{route('admin_detail_pesanan_agrikulture',$data->id)}}"><button class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i> Detail</button></a>
                <a href="{{route('admin_lokasi_pembeli',$data->id)}}"><button class="btn btn-dark btn-sm"><i class="fas fa-map-marker"></i> Lokasi Pembeli</button></a>

                <td style="display: none;">{{$data->id}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!--  <button class="btn btn-success fas fa-plus fa-2a"></button> -->
    </div>
  </div>




</div>
</div>





@endsection



