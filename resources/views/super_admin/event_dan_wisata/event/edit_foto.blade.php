@extends('layouts.app')

@section('title')
Kelola Event dan Festival
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h2 class="primary">Event dan Festival</h2>
      <hr>
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambah">
        <i class="fas fa-plus"></i> Tambah Event
      </button><br><br>
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
              <th>Admin Event</th>
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
              <td>{{$data->nama}}</td>
              <td>{{$data->deskripsi}}</td>
              <td>{{$data->lokasi}}</td>
              <td>{{date("j F Y", strtotime($data->tanggal_event))}}</td>
              <td>{{ \Carbon\Carbon::parse($data->jam_mulai)->timezone('Asia/Jakarta')->format('H:i') }} WIB</td>
              <td>{{ \Carbon\Carbon::parse($data->jam_selesai)->timezone('Asia/Jakarta')->format('H:i') }} WIB</td>
              <td>td>

              <td>
                <a href="{{route('superadmin_lihat_detail_event',$data->id)}}"><button class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i> Detail</button></a>

                <a href="{{route('superadmin_event_delete',$data->id)}}"><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button></a>

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







<!-- Modal -->
<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Produk Agrikulture?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="deleteForm" method="post">

          {{ csrf_field() }}
          {{ method_field('POST') }}
          <p>Apakah anda yakin ingin menghapus data produk ini ?</p> <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
          <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Hapus</button>

        </form>
      </div>

    </div>
  </div>
</div>







<!-- show Foto -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
 


  <script>
    function initialize() {
    //Cek Support Geolocation
    if (navigator.geolocation) {
      //Mengambil Fungsi golocation
      navigator.geolocation.getCurrentPosition(lokasi);
    } else {
      swal("Maaf Browser tidak Support HTML 5");
    }
    //Variabel Marker
    var marker;

    function taruhMarker(peta, posisiTitik) {

      if (marker) {
        // pindahkan marker
        marker.setPosition(posisiTitik);
      } else {
        // buat marker baru
        marker = new google.maps.Marker({
          position: posisiTitik,
          map: peta,
          icon: 'https://img.icons8.com/plasticine/40/000000/marker.png',
        });
      }

    }
    //Buat Peta
    var peta = new google.maps.Map(document.getElementById("mapInput"), {
      center: {
        lat: -8.408698,
        lng: 114.2339090
      },
      zoom: 9
    });
    //Fungsi untuk geolocation
    function lokasi(position) {
      //Mengirim data koordinat ke form input
      document.getElementById("lat").value = position.coords.latitude;
      document.getElementById("leng").value = position.coords.longitude;
      //Current Location
      var lat = position.coords.latitude;
      var long = position.coords.longitude;
      var latlong = new google.maps.LatLng(lat, long);
      //Current Marker 
      var currentMarker = new google.maps.Marker({
        position: latlong,
        icon: 'https://img.icons8.com/plasticine/40/000000/user-location.png',
        map: peta,
        title: "Anda Disini"
      });
      //Membuat Marker Map dengan Klik
      var latLng = new google.maps.LatLng(-8.408698, 114.2339090);

      var addMarkerClick = google.maps.event.addListener(peta, 'click', function(event) {


        taruhMarker(this, event.latLng);

        //Kirim data ke form input dari klik
        document.getElementById("lat").value = event.latLng.lat();
        document.getElementById("leng").value = event.latLng.lng();

      });
    }

  }
</script>
<!-- ====================== End Input Map ====================== -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv-h2II7DbFQkpL9pDxNRq3GWXqS5Epts&callback=initialize" type="text/javascript"></script>

@endsection


