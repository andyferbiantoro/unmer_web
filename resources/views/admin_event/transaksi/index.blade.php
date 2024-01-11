@extends('layouts.app')

@section('title')
Transaksi Event dan Festival
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h2 class="primary">Event dan Festival</h2>
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
            <th>Judul Event</th>
            <th>Deskripsi</th>
            <th>lokasi</th>
            <th>Tanggal Event</th>
            <th>Jam Mulai</th>
            <th>jam Selesai</th>
            <th>Foto Event</th>
            <th>Opsi</th>
            <th style="display: none;">hidden</th>
          </tr>
        </thead>
        <tbody>
          @php $no=1 @endphp
          @foreach($event as $data)
          <tr>
            <td>{{$no++}}</td>
            <td>{{$data->judul_event}}</td>
            <td>{{$data->deskripsi}}</td>
            <td>{{$data->lokasi}}</td>
            <td>{{date("j F Y", strtotime($data->tanggal_event))}}</td>
            <td>{{ \Carbon\Carbon::parse($data->jam_mulai)->timezone('Asia/Jakarta')->format('H:i') }} WIB</td>
            <td>{{ \Carbon\Carbon::parse($data->jam_selesai)->timezone('Asia/Jakarta')->format('H:i') }} WIB</td>
            <td><img style="border-radius: 0%" height="70" src="{{asset('/public/uploads/event/'.$data->foto_event)}}"></img></td>

            <td>
                      
              <a href="{{route('admin_pembelian_tiket',$data->id)}}"><button class="btn btn-dark btn-sm"><i class="fas fa-ticket-alt"></i> Lihat Pembelian Tiket</button></a>

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


