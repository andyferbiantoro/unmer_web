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
      <h2 class="primary">Pesanan Offline </h2>
      <hr>

    <a href="{{ route('admin_kasir_lihat_pesanan_agrikulture_diantar') }}"><button type="button" class="btn btn-light btn-sm"><i class="fas fa-motorcycle"></i> Pesanan Diantar</button></a>
    <a href="{{ route('admin_kasir_lihat_pesanan_agrikulture_diambil') }}"><button type="button" class="btn btn-light btn-sm"><i class="fas fa-shopping-bag"></i> Pesanan Diambil</button></a>
    <a href="{{ route('admin_kasir_lihat_pesanan_agrikulture_offline') }}"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-store"></i> Pesanan Offline</button></a>
   
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
              <th>Tanggal</th>
              <th>Nominal Barang</th>
              <th>Nominal Bayar</th>
              <th>Nominal Kembalian</th>
              <th>Opsi</th>
              <th style="display: none;">hidden</th>
            </tr>
          </thead>
          <tbody>
            @php $no=1 @endphp
            @foreach($pesanan_offline as $data_offline)
            <tr>
              <td>{{$no++}}</td>
              <td>{{date("j F Y", strtotime($data_offline->created_at))}}</td>
              <td>Rp. <?=number_format($data_offline->nominal_barang, 0, ".", ".")?>,00</td> 
              <td>Rp. <?=number_format($data_offline->nominal_bayar, 0, ".", ".")?>,00</td>            
              <td>Rp. <?=number_format($data_offline->nominal_kembalian, 0, ".", ".")?>,00</td> 
              <td>
                <!-- <button class="btn btn-warning btn-sm icon-file menu-icon edit" title="Edit">Edit</button> -->

                <a href="{{route('detail_pesanan_offline',$data_offline->id)}}"><button class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i> Detail</button></a>
               
                <td style="display: none;">{{$data_offline->id}}</td>
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



