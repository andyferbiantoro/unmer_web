@extends('layouts.app')

@section('title')
Edit Produk Agrikultur
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">

      <a href="{{ route('superadmin_koperasi') }}"><button type="button" class="btn btn-danger btn-sm">Kembali</button></a>

      <br><br>
      <h2 class="primary">Edit Produk </h2><br>

      @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
      @endif
      <div class="text-left" >

        <div class="form-group">

          <div class="row">
            <div class="col-lg-6 col-sm-12 col-12">
              @foreach($produk_koperasi as $data)
              <form method="post" action="{{route('produk_koperasi_update',$data->id)}}" enctype="multipart/form-data">

                {{csrf_field()}}

                <div class="form-group">
                  <label for="nama_produk">Nama Produk</label>
                  <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{$data->nama_produk}}"  required=""></input>
                </div>

                <div class="form-group">
                  <label for="kode_produk">Kode Produk</label>
                  <input type="text" class="form-control" id="kode_produk" name="kode_produk" value="{{$data->kode_produk}}"  required=""></input>
                </div>

                <div class="form-group form-success">
                  <label >Kategori Produk</label>
                  <select id="kategori_produk" name="kategori_produk" class="form-control"  required="" onchange="kategoriInputForm()" >
                    @foreach($kat as $k)
                    <option value="{{$k->kategori_produk}}" {{$data->kategori_produk == $k->kategori_produk ? "selected" : "" }} >{{$k->kategori_produk}}</option>
                    @endforeach
                 </select>
                 <span class="form-bar"></span>
               </div>

               <div class="form-group">
                <label for="harga">Harga Produk</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{$data->harga}}"  required=""></input>
              </div>

              <div class="form-group">
                <label for="stok">Stok Produk</label>
                <input type="number" class="form-control" id="stok" name="stok" value="{{$data->stok}}"  required=""></input>
              </div>

              <div class="form-group">
                <label for="latitude_lap">Foto Produk</label>
                <div class="input-group">
                  <input type="file" name="foto" class="form-control"
                  value="{{$data->foto}}" >
                </div>
              </div>




              <div>
                <button class="btn btn-primary" type="Submit">Update</button>


              </div>

            </form>
            <hr>
            @endforeach
          </div>

          <div class="col-lg-6 col-sm-12 col-12">


            <form method="post" action="{{route('produk_agrikulture_update',$data->id)}}" enctype="multipart/form-data">

              <div class="form-group">
                <label for="latitude_lap">Foto Produk</label>
                <div></div><span ><img  style="width: 100%; height: 400px; border-radius: 3px;" 
                  src="{{asset('uploads/produk_koperasi/'.$data->foto)}}"></span>
                </div>




              </form>

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

  


