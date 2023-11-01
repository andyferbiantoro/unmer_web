@extends('layouts.app')

@section('title')
Kelola Transaksi Koperasi
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h2 class="primary">Transaksi Koperasi </h2>
      <hr>
      <br>
      <a href="{{ route('superadmin_koperasi') }}"><button type="button" class="btn btn-light btn-sm"> Produk Koperasi</button></a>
      <a href="{{ route('superadmin_transaksi_koperasi') }}"><button type="button" class="btn btn-primary btn-sm"> Transaksi Koperasi</button></a>
      <br><br>

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

                <a href="{{route('superadmin_transaksi_koperasi_detail',$data->id)}}"><button class="btn btn-info btn-sm">Detail</button></a>

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



