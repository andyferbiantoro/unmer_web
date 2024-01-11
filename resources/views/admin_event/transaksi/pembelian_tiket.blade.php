@extends('layouts.app')

@section('title')
Pembelian P@embelian Event dan Festival
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h2 class="primary">Pembelian Tiket Event dan Festival</h2>
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
            <th>Judul Tiket</th>
            <th>Harga Tiket</th>
            <th>Kode Tiket</th>
            <th>Kode Transaksi</th>
            <th>Status Transaksi</th>
           
            <th style="display: none;">hidden</th>
          </tr>
        </thead>
        <tbody>
          @php $no=1 @endphp
          @foreach($pembelian_tiket as $data)
          <tr>
            <td>{{$no++}}</td>
            <td>{{$data->nama}}</td>
            <td>{{$data->judul}}</td>
            <td>{{$data->harga}}</td>
            <td>{{$data->kode_tiket}}</td>
            <td>{{$data->kode_transaksi}}</td>
            <td>
                @if($data->status == 'valid')
                <div class="badge badge-success">Valid</div>
                @elseif($data->status == 'pending')  
                <div class="badge badge-danger">Pending</div>
                @endif
              </td>
          
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



  @section('scripts')
  
  @endsection


