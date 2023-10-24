@extends('layouts.app')

@section('title')
Edit Produk Agrikultur
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">

      <a href="{{ route('superadmin_agrikulture') }}"><button type="button" class="btn btn-danger btn-sm">Kembali</button></a>

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
              @foreach($produk_agrikulture as $data)
              <form method="post" action="{{route('produk_agrikulture_update',$data->id)}}" enctype="multipart/form-data">

                {{csrf_field()}}

                <div class="form-group">
                  <label for="nama_produk">Nama Produk</label>
                  <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{$data->nama_produk}}"  required=""></input>
                </div>

                <div class="form-group form-success">
                  <label >Jenis Produk</label>
                  <select  name="jenis_produk" class="form-control"  required="">
                    @foreach($kat as $k)
                    <option value="{{$k->jenis_produk}}" {{$data->jenis_produk == $k->jenis_produk ? "selected" : "" }} >{{$k->jenis_produk}}</option>
                    @endforeach
                  </select>
                  <span class="form-bar"></span>
                </div>


               <div class="form-group">
                <label for="harga_produk">Harga Produk</label>
                <input type="number" class="form-control" id="harga_produk" name="harga_produk" value="{{$data->harga_produk}}"  required=""></input>
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
            @endforeach
          </div>

          <div class="col-lg-6 col-sm-12 col-12">

            
            <form method="post" action="{{route('produk_agrikulture_update',$data->id)}}" enctype="multipart/form-data">

              <div class="form-group">
                <label for="latitude_lap">Foto Produk</label>
                <div></div><span ><img  style="width: 100%; height: 300px; border-radius: 3px;" 
                  src="{{asset('uploads/produk_agrikulture/'.$data->foto)}}"></span>
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

  


