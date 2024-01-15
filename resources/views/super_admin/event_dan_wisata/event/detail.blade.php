@extends('layouts.app')

@section('title')
Detail Event
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">

      <a href="{{ route('superadmin_kelola_event') }}"><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-long-arrow-alt-left"></i> Kembali</button></a>

      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambahFasilitas">
       <i class="fas fa-plus"></i> Tambah Fasilitas
     </button>

     @foreach($event as $ev)
     <a href="{{route('superadmin_event_edit',$ev->id)}}"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button></a>

     <a href="{{route('superadmin_event_lokasi_event',$ev->id)}}"><button type="button" class="btn btn-dark btn-sm"><i class="fas fa-map-pin"></i> Lihat Lokasi</button></a>

     <a href="{{route('superadmin_foto_event_edit',$ev->id)}}"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-images"></i> Lihat Foto</button></a>
     @endforeach


     <br><br>
     <h2 class="primary">Detail Event</h2><br>

     @if (session('success'))
     <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    <div class="text-left" >

      <div class="form-group">
        <div class="row">
          <div class="col-lg-6 col-sm-12 col-12">
            @foreach($event as $data)
            <div class="table-responsive">
              <table id="dataTable"  class="table table-hover">

                <tr>
                  <th>Judul Event</th>
                  <th>:</th>
                  <td>{{$data->judul_event}}</td>
                </tr>   

                <tr>
                  <th>Deskripsi</th>
                  <th>:</th>
                  <td>{{$data->deskripsi}} </td>
                </tr> 

                <tr>
                  <th>Lokasi Event</th>
                  <th>:</th>
                  <td>{{$data->lokasi}}</td>
                </tr>  

                <tr>
                  <th>Tanggal Event</th>
                  <th>:</th>
                  <td>{{date("j F Y", strtotime($data->tanggal_event))}}</td>
                </tr>  


                <tr>
                  <th>Jam Mulai</th>
                  <th>:</th>
                  <td>{{ \Carbon\Carbon::parse($data->jam_mulai)->timezone('Asia/Jakarta')->format('H:i') }} WIB</td>
                </tr> 

                <tr>
                  <th>Jam Selesai</th>
                  <th>:</th>
                  <td>{{ \Carbon\Carbon::parse($data->jam_selesai)->timezone('Asia/Jakarta')->format('H:i') }} WIB</td>
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
                  @foreach($detail_event as $detail)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$detail->fasilitas}}</td>
                    <td> <a href="{{route('superadmin_fasilitas_event_delete',$detail->id)}}"><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button></a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @endforeach
          </div>

          <div class="col-lg-6 col-sm-12 col-12">

           

             <div id="carouselExampleControls{{$data->id}}" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                        @foreach($foto_event as $image)
                        @if($image->indeks == 1)
                        <div class="carousel-item active">
                            @else    
                            <div class="carousel-item">
                                @endif    
                                <img class="d-block w-100" src="{{asset('public/uploads/event/'.$image->foto_event)}}" alt="First slide">
                            </div>
                            <br>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls{{$data->id}}" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls{{$data->id}}" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
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
       <form method="post" action="{{route('superadmin_fasilitas_event_add')}}" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group form-success">



         <div class="form-group">
          <label for="fasilitas">Fasilitas Event</label>
          <input type="text" class="form-control" id="fasilitas" name="fasilitas"  required=""></input>
        </div>


        @foreach($event as $id_event)
        <input type="hidden" class="form-control" id="id_event" name="id_event"  required="" value="{{$id_event->id}}"></input>
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






<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Tambah Tiket</h5>
      </div>
      <div class="modal-body">
       <form method="post" action="{{route('superadmin_tiket_event_add')}}" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group form-success">



         <div class="form-group">
          <label for="judul">Judul Tiket</label>
          <input type="text" class="form-control" id="judul" name="judul"  required=""></input>
        </div>



        <div class="form-group">
          <label for="keterangan">Keterangan</label>
          <textarea type="text" class="form-control" id="keterangan" name="keterangan"  required=""></textarea>
        </div>

        <div class="form-group">
          <label for="deskripsi">Deskripsi</label>
          <input type="text" class="form-control" id="deskripsi" name="deskripsi"  required=""></input>
        </div>

        <div class="form-group">
          <label for="harga">Harga Tiket</label>
          <input type="number" class="form-control" id="harga" name="harga"  required=""></input>
        </div>


        @foreach($detail_event as $id_event)
        <input type="hidden" class="form-control" id="id_event" name="id_event"  required="" value="{{$id_event->id}}"></input>
        @endforeach


        <div class="form-group">
          <label for="foto_tiket">Foto Tiket</label>
          <input type="file" class="form-control" id="foto_tiket" name="foto_tiket" required=""></input>
        </div>


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


  @section('scripts')



  <!-- ====================== Input Map ====================== -->

  <script>
    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: -8.241350866473171, lng: 114.08902679785155 }, // Koordinat tengah peta
                zoom: 10
              });

            // Tampilkan marker untuk setiap toko
            @foreach($event as $ev)
            new google.maps.Marker({
              position: { lat: {{ $ev->latitude }}, lng: {{ $ev->longitude }} },
              map: map,
              title: '{{ $ev->nama_toko }}'
            });
            @endforeach
          }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv-h2II7DbFQkpL9pDxNRq3GWXqS5Epts&callback=initialize&callback=initMap" type="text/javascript"></script>
        @endsection




