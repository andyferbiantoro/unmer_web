@extends('layouts.app')

@section('title')
Lihat Tiket Wisata
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">

      <a href="{{ route('admin_kelola_wisata') }}"><button type="button" class="btn btn-danger btn-sm">Kembali</button></a>
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambah">
       Tambah Tiket
     </button>


     
     <br><br>
     <h2 class="primary">Tiket Wisata</h2>

     @if (session('success'))
     <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    
  </div>
</div>
</div>



      <div class="col-lg-12 col-sm-12 col-12">
        <div class="row sortable-card">
          @foreach($tiket_wisata as $tiket)
          <div class="col-12 col-md-6 col-lg-3">
            <div class="card card-primary">
              <div class="card-header">
               <h4>{{$tiket->judul}}</h4>
              </div>
              <div class="card-body">
                <h5>{{$tiket->deskripsi}}</h5>
                Rp. <?=number_format($tiket->harga, 0, ".", ".")?>,00 <br>
                <p>{{$tiket->keterangan}}</p><hr>
                Stok : {{$tiket->stok}} PCS <br>
                Terjual : {{$tiket->sold}} PCS <br><br>
                <a href="{{route('admin_tiket_wisata_delete',$tiket->id)}}"><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button></a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>


<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Tambah Tiket</h5>
      </div>
      <div class="modal-body">
       <form method="post" action="{{route('admin_tiket_wisata_add')}}" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group form-success">



         <div class="form-group">
          <label for="judul">Judul Tiket</label>
          <input type="text" class="form-control" id="judul" name="judul"  required=""></input>
        </div>

        <div class="form-group">
          <label for="deskripsi">Deskripsi</label>
          <input type="text" class="form-control" id="deskripsi" name="deskripsi"  required=""></input>
        </div>

        <div class="form-group">
          <label for="keterangan">Keterangan</label>
          <textarea type="text" class="form-control" id="keterangan" name="keterangan"  required=""></textarea>
        </div>
        
        <div class="form-group">
          <label for="harga">Harga Tiket</label>
          <input type="number" class="form-control" id="harga" name="harga"  required=""></input>
        </div>

        <div class="form-group">
        <label for="stok">Stok Tiket</label>
        <input type="number" class="form-control" id="stok" name="stok"  required=""></input>
      </div>

        @foreach($wisata as $id_wisata)
        <input type="hidden" class="form-control" id="id_wisata" name="id_wisata"  required="" value="{{$id_wisata->id}}"></input>
        @endforeach




      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="Submit">Tambahkan</button>
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




