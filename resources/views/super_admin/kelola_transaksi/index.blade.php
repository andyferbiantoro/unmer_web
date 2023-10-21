@extends('layouts.app')

@section('title')
Kelola Transaksi
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">
              
                <div class="card-body">
                  <!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambah">
                    Tambah Admin 
                  </button><br><hr> -->

                  <a href="{{ route('superadmin_kelola_admin') }}"><button type="button" class="btn btn-warning btn-sm">Tabel Transaksi Koperasi</button></a>
                  <a href="{{ route('superadmin_admin_kasir') }}"><button type="button" class="btn btn-primary btn-sm">Tabel Transaksi Agrikultur</button></a>
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
                          <th>Produk</th>
                          <th>Nominal</th>
                          <th>Jenis Pembayaran</th>
                          <th>Status Pemesanan</th>
                          <th>Status Pembayaran</th>
                          <th>Catatan</th>

                         
                          <th style="display: none;">hidden</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $no=1 @endphp
                        @foreach($transaksi_koperasi as $data)
                        <tr>
                          <td>{{$no++}}</td>
                          <td>{{$data->nama}}</td>
                          <td>{{$data->nama_produk}}</td>
                          <td>{{$data->nominal}}</td>
                          <td>{{$data->jenis_pembayaran}}</td>
                          <td>{{$data->status_pembayaran}}</td>
                          <td>{{$data->status_pemesanan}}</td>
                          <td>{{$data->catatan}}</td>
                         

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

    


