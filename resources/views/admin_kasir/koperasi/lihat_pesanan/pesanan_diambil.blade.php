@extends('layouts.app')

@section('title')
Pesanan Koperasi
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h2 class="primary">Transaksi Koperasi Diambil</h2>
      <hr>
      <a href="{{ route('admin_kasir_lihat_pesanan_koperasi_diantar') }}"><button type="button" class="btn btn-light btn-sm"><i class="fas fa-motorcycle"></i> Pesanan Diantar</button></a>
      <a href="{{ route('admin_kasir_lihat_pesanan_koperasi_diambil') }}"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-shopping-bag"></i> Pesanan Diambil</button></a>
      <a href="{{ route('admin_kasir_lihat_pesanan_koperasi_offline') }}"><button type="button" class="btn btn-light btn-sm"><i class="fas fa-store"></i> Pesanan Offline</button></a>
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
            @foreach($transaksi_koperasi as $data)
            <tr>
              <td>{{$no++}}</td>
              <td>{{$data->nama}}</td>
              <td>Rp. <?=number_format($data->nominal, 0, ".", ".")?>,00</td>
              <td>{{$data->catatan}}</td>
              @if($data->status_pemesanan == 'dikemas')
              <td><div class="badge badge-warning">Sedang Dikemas</div></td>
              @elseif($data->status_pemesanan == 'diantar')
              <td><div class="badge badge-info">Sedang Diantar</div></td>
              elseif($data->status_pemesanan == 'selesai')
              <td><div class="badge badge-success">Pesanan Sampai</div></td>
              @endif
              <td>
                <!-- <button class="btn btn-warning btn-sm icon-file menu-icon edit" title="Edit">Edit</button> -->

                <a href="{{route('admin_detail_pesanan_koperasi',$data->id)}}"><button class="btn btn-info btn-sm">Detail</button></a>

                


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



