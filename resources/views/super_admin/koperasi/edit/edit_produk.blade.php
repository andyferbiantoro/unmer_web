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
       @foreach($produk_koperasi as $dat)
       <a href="{{route('produk_koperasi_detail',$dat->id)}}"><button type="button" class="btn btn-info btn-sm">Detail Produk</button></a>
       @endforeach
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
                <button class="btn btn-primary" type="Submit">Update Produk</button>


              </div>

            </form>
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
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalEditSize">
                      Edit Size
                    </button><br><br>

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
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalEditWarna">
                      Edit Warna
                    </button><br><br>
                  </div>
               </div>
               @endif

          </div>

          <div class="col-lg-6 col-sm-12 col-12">


            <form method="post" action="{{route('produk_agrikulture_update',$data->id)}}" enctype="multipart/form-data">

              <div class="form-group">
                <label for="latitude_lap">Foto Produk</label>
                <div></div><span ><img  style="width: 100%; height: 400px; border-radius: 3px;" 
                  src="{{asset('public/uploads/produk_koperasi/'.$data->foto)}}"></span>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Modal Edit Size -->
<div class="modal fade" id="ModalEditSize" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Edit Size</h5>
      </div>
      <div class="modal-body">
       <form method="post" action="{{route('produk_koperasi_update_size',$data->id)}}" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group">
          <div class="row">
            <div id="size_id" class="col-lg-6 col-sm-12 col-12" >
              <label><strong>Size</strong></label><br>
              @foreach($list_size as $list)
              <label><input type="checkbox" name="size[]" value="{{$list->size}}"  > {{$list->size}}</label><br>
              @endforeach

            </div>
          </div>
        </div>  

      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="Submit">Update Size</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>

      </div>
    </form>
  </div>
</div>
</div>


<!-- Modal Edit warna -->
<div class="modal fade" id="ModalEditWarna" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Edit Warna</h5>
      </div>
      <div class="modal-body">
       <form method="post" action="{{route('produk_koperasi_update_warna',$data->id)}}" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group">
          <div class="row">
            <div id="size_id" class="col-lg-6 col-sm-12 col-12" >
              <label><strong>Size</strong></label><br>
              @foreach($list_warna as $list)
              <label><input type="checkbox" name="warna[]" value="{{$list->warna}}"  > {{$list->warna}}</label><br>
              @endforeach

            </div>
          </div>
        </div>  

      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="Submit">Update warna</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>

      </div>
    </form>
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

  