@extends('layouts.app')

@section('title')
Detail Pesanan Agrikultur
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">

      @foreach($transaksi_agrikulture as $metode)
      @if($metode->metode_pengiriman == 'diantar')
      <a href="{{ route('admin_kasir_lihat_pesanan_agrikulture_diantar') }}"><button type="button" class="btn btn-danger btn-sm">Kembali</button></a>
      @else
      <a href="{{ route('admin_kasir_lihat_pesanan_agrikulture_diambil') }}"><button type="button" class="btn btn-danger btn-sm">Kembali</button></a>
      @endif
      @endforeach

      <br><br>
      @foreach($transaksi_agrikulture as $kode)
      <h2 class="primary">Transaksi {{$kode->kode_transaksi}} </h2><br>
      {!! DNS1D::getBarcodeHTML($kode->kode_transaksi, 'C39') !!}<br><br>
      @endforeach
      @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
      @endif
      <div class="text-left" >

        <div class="form-group">
          <div class="row">
            <div class="col-lg-8 col-sm-12 col-12">
              @foreach($transaksi_agrikulture as $data)
              <div class="table-responsive">
                <table   class="table table-hover">

                  <tr>
                    <th>Nama Pemesan</th>
                    <th>:</th>
                    <td>{{$data->nama}}</td>
                  </tr>   

                  <tr>
                    <th>Nominal Pesanan</th>
                    <th>:</th>
                    <td>Rp. <?=number_format($data->nominal, 0, ".", ".")?>,00 </td>
                  </tr> 

                  <tr>
                    <th>Market</th>
                    <th>:</th>
                    <td>{{$data->nama_toko}}</td>
                  </tr>

                  <tr>
                    <th>Status Pemesanan</th>
                    <th>:</th>
                    @if($data->status_pemesanan == 'dikemas')
                    <td><div class="badge badge-warning">Sedang Dikemas</div></td>
                    @elseif($data->status_pemesanan == 'diantar')
                    <td><div class="badge badge-info">Sedang Diantar</div></td>
                    @elseif($data->status_pemesanan == 'selesai')
                    <td><div class="badge badge-success">Pesanan Sampai</div></td>
                    @endif
                  </tr>  

                  <tr>
                    <th>Catatan</th>
                    <th>:</th>
                    <td>{{$data->catatan}}</td>
                  </tr>  



                </table>
              </div>
              <hr>
              @endforeach
              
            </div>

            <div class="col-lg-4 col-sm-12 col-12">
              <div class="text-center">
                @foreach($transaksi_agrikulture as $qr)
                @if($qr->metode_pengiriman == 'diantar')
                @if($data->status_pemesanan == 'dikemas')
                <div class="visible-print text-center">
                  {!! QrCode::size(200)->color(0, 0, 150)->generate($qr->kode_transaksi); !!}
                  <br><br>
                  <div class="badge badge-primary">Scan untuk mengantarkan pesanan</div>
                </div>
                @elseif($data->status_pemesanan == 'diantar')
                <div class="badge badge-info">Pesanan Sedang Diantar</div>
                @elseif($data->status_pemesanan == 'selesai')
                <div class="badge badge-success">Pesanan Sudah Sampai</div>
                @endif
                @endif
                @endforeach
              </div>
            </div>   

            @foreach($transaksi_agrikulture as $data)
            <div class="table-responsive">
              <h4>Produk Dipesan</h4><br>
              <table id="dataTable" class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Kode Produk</th>
                    <th>Kategori Produk</th>
                    <th>Harga Produk</th>
                    <th>Jumlah Beli</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  @php $no=1 @endphp
                  @foreach($detail_produk as $detail)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$detail->nama_produk}}</td>
                    <td>{{$detail->kode_produk}}</td>
                    <td>{{$detail->kategori_produk}}</td>
                    <td>Rp. <?=number_format($detail->harga_produk, 0, ".", ".")?>,00</td>
                    <td>{{$detail->kuantitas}} </td>
                    <td>Rp. <?=number_format($detail->harga_produk * $detail->kuantitas, 0, ".", ".")?>,00</td>
                  </tr>
                  @endforeach
                  
                </tbody>


              </table>
            </div>
            <hr>
            @endforeach
          </div>
      
        </div>
      </div>
    </div>
  </div>
</div>





<!-- show Foto -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body text-center">
        <img src="" id="img01" style="width: 450px; height: auto;" >
      </div>
    </div>
  </div>

  @endsection




