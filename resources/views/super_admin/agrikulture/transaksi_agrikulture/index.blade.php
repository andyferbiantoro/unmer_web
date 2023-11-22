@extends('layouts.app')

@section('title')
Kelola Transaksi Agrikultur
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h2 class="primary">Transaksi Agrikulture </h2>
      <hr>
     
      <a href="{{ route('superadmin_agrikulture') }}"><button type="button" class="btn btn-light btn-sm"><i class="fas fa-shopping-bag"></i> Produk Agrikulture</button></a>
      <a href="{{ route('superadmin_market_agrikulture') }}"><button type="button" class="btn btn-light btn-sm"><i class="fas fa-store"></i> Market Agrikulture</button></a>
      <a href="{{ route('superadmin_transaksi_agrikulture') }}"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-money-bill"></i> Transaksi Agrikulture</button></a>

      
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
              <th>Metode Pengiriman</th>
              <th>Opsi</th>
              <th style="display: none;">hidden</th>
            </tr>
          </thead>
          <tbody>
            @php $no=1 @endphp
            @foreach($transaksi_agrikulture as $data)
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
    
              @if($data->metode_pengiriman == 'diantar')
              <td><div class="badge badge-light"><i class="fas fa-motorcycle"></i> Diantar</div> </td>
              @else
              <td><div class="badge badge-dark"><i class="fas fa-shopping-bag"></i> Diambil</div> </td>
              @endif
              <td>
                <a href="{{route('superadmin_transaksi_agrikulture_detail',$data->id)}}"><button class="btn btn-info btn-sm">Detail</button></a>
              </td>
                <!-- <button class="btn btn-warning btn-sm icon-file menu-icon edit" title="Edit">Edit</button> -->


                <!-- <a href="{{route('superadmin_produk_agrikulture_edit',$data->id)}}"><button class="btn btn-primary btn-sm">Edit</button></a> -->

              <!-- <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                <button class="btn btn-danger btn-sm"  title="Hapus">Hapus</button>

              </td> -->



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



