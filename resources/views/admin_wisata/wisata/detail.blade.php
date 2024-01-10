@extends('layouts.app')

@section('title')
Detail Wisata
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">

      <a href="{{ route('admin_kelola_wisata') }}"><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-long-arrow-alt-left"></i> Kembali</button></a>

     <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambahFasilitas">
       <i class="fas fa-plus"></i> Tambah Fasilitas
     </button>

      @foreach($wisata as $wis)
       <a href="{{route('admin_wisata_edit',$wis->id)}}"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button></a>

       <a href="{{route('admin_wisata_lokasi_wisata',$wis->id)}}"><button type="button" class="btn btn-dark btn-sm"><i class="fas fa-map-pin"></i> Lihat Lokasi</button></a>
       @endforeach
     
     <br><br>
     <h2 class="primary">Detail Wisata</h2><br>

     @if (session('success'))
     <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    <div class="text-left" >

      <div class="form-group">
        <div class="row">
          <div class="col-lg-6 col-sm-12 col-12">
            @foreach($wisata as $data)
            <div class="table-responsive">
              <table id="dataTable"  class="table table-hover">

                <tr>
                  <th>Nama Tempat Wisata</th>
                  <th>:</th>
                  <td>{{$data->nama_tempat_wisata}}</td>
                </tr>   

                <tr>
                  <th>Deskripsi</th>
                  <th>:</th>
                  <td>{{$data->deskripsi}} </td>
                </tr> 

                <tr>
                  <th>Hari Operasional</th>
                  <th>:</th>
                  <td>{{$data->hari_operasional_awal}} s/d {{$data->hari_operasional_akhir}}</td>
                </tr>  

                <tr>
                  <th>Jam Operasional</th>
                  <th>:</th>
                  <td>{{ \Carbon\Carbon::parse($data->jam_buka)->timezone('Asia/Jakarta')->format('H:i') }} - 
                    {{ \Carbon\Carbon::parse($data->jam_tutup)->timezone('Asia/Jakarta')->format('H:i') }} WIB</td>
                </tr>  


                <tr>
                  <th>Alamat</th>
                  <th>:</th>
                  <td>{{$data->alamat}}</td>
                </tr> 

              
                

              </table>
            </div>
            <hr>

            <h3>Fasilitas</h3>

            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Fasilitas</th>
                    <th>Opsi</th>
                  </tr>
                </thead>

                <tbody>
                  @php $no=1 @endphp
                  @foreach($detail_wisata as $detail)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$detail->fasilitas}}</td>
                    <td> <a href="{{route('admin_fasilitas_wisata_delete',$data->id)}}"><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button></a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @endforeach
          </div>

          <div class="col-lg-6 col-sm-12 col-12">

            <div class="form-group">
              <label for="latitude_lap"><b>Foto Tempat Wisata</b></label>
              <div></div><span ><img  style="width: 100%; height: 400px; border-radius: 3px;" 
                src="{{asset('public/uploads/wisata/'.$data->foto_wisata)}}"></span>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>





<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambahFasilitas" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Tambah Fasilitas</h5>
      </div>
      <div class="modal-body">
       <form method="post" action="{{route('admin_fasilitas_wisata_add')}}" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group form-success">



         <div class="form-group">
          <label for="fasilitas">Fasilitas Event</label>
          <input type="text" class="form-control" id="fasilitas" name="fasilitas"  required=""></input>
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




