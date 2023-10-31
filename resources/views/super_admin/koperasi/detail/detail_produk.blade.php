@extends('layouts.app')

@section('title')
Detail Koperasi
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">

      <a href="{{ route('superadmin_koperasi') }}"><button type="button" class="btn btn-danger btn-sm">Kembali</button></a>
      @foreach($produk_koperasi_detail as $dat)
       <a href="{{route('produk_koperasi_edit',$dat->id)}}"><button type="button" class="btn btn-primary btn-sm">Edit Produk</button></a>
       @endforeach
      <br><br>
      <h2 class="primary">Detail Produk </h2><br>

      @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
      @endif
      <div class="text-left" >

        <div class="form-group">
          <div class="row">
            <div class="col-lg-6 col-sm-12 col-12">
          @foreach($produk_koperasi_detail as $data)
              <div class="table-responsive">
                <table id="dataTable"  class="table table-hover">

                  <tr>
                    <th>Nama Partner</th>
                    <th>:</th>
                    <td>{{$data->nama}}</td>
                  </tr>   

                  <tr>
                    <th>Nama Produk</th>
                    <th>:</th>
                    <td>{{$data->nama_produk}} </td>
                  </tr> 

                  <tr>
                    <th>Kode Produk</th>
                    <th>:</th>
                    <td>{{$data->kode_produk}}</td>
                  </tr>  

                  <tr>
                    <th>kategori Produk</th>
                    <th>:</th>
                    <td>{{$data->kategori_produk}}</td>
                  </tr>  


                  <tr>
                    <th>Harga Produk</th>
                    <th>:</th>
                    <td>Rp. <?=number_format($data->harga, 0, ".", ".")?>,00</td>
                  </tr> 

                  <tr>
                    <th>Stok Produk</th>
                    <th>:</th>
                    <td>{{$data->stok}} pcs</td>
                  </tr> 

                  <tr>
                    <th>Jumlah Terjual</th>
                    <th>:</th>
                    <td>{{$data->sold}} pcs</td>
                  </tr> 

                </table>
              </div>
              <hr>
               @endforeach
               @if($data->kategori_produk == 'Pakaian')
               <div class="row">
                  <div class="col-lg-4 col-sm-12 col-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                              
                              <th>Size</th>
                            </tr>

                            
                            @foreach($get_size as $size)
                            <tr>
                              
                              <td>{{$size->size}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                   

                  </div>


                  <div class="col-lg-4 col-sm-12 col-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                              <th>Warna</th>
                            </tr>

                            
                            @foreach($get_warna as $warna)
                            <tr>
                              <td>{{$warna->warna}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                  </div>
               </div>
               @endif
            </div>

            <div class="col-lg-6 col-sm-12 col-12">




              <div class="form-group">
                <label for="latitude_lap"><b>Foto produk</b></label>
                <div></div><span ><img  style="width: 100%; height: 400px; border-radius: 3px;" 
                  src="{{asset('uploads/produk_koperasi/'.$data->foto)}}"></span>
                </div>

              </div>
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




