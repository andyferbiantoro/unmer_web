@extends('layouts.app')

@section('title')
Edit Market Agrikultur
@endsection


@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="card">

      <div class="card-body">

        <a href="{{ route('superadmin_market_agrikulture') }}"><button type="button" class="btn btn-danger btn-sm">Kembali</button></a>

        <br><br>
        <h2 class="primary">Edit Market </h2><br>

        @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif
        <div class="text-left">

          <div class="form-group">

            <div class="row">
              <div class="col-lg-12 col-sm-12 col-12">
                @foreach($market_agrikulture as $data)
                <form method="post" action="{{route('market_update',$data->id)}}" enctype="multipart/form-data">

                  {{csrf_field()}}

                  <div class="form-group">
                    <label for="nama_toko">Nama Toko</label>
                    <input type="text" class="form-control" id="nama_toko" name="nama_toko" value="{{$data->nama_toko}}" required=""></input>
                  </div>


                  <div class="form-group">
                    <label>Posisi Market</label>
                    <div class="row">
                      <div class="col-lg-6 col-sm-12 col-12">
                        <div id="mapInput" style="width: 100%; height: 320px; border-radius: 3px;"></div>
                        <p>klik satu kali untuk menentukan posisi</p>
                      </div>
                      <div class="col-lg-6 col-sm-12 col-12">

                        <div class="form-group">
                          <label for="latitude_lap">Latitude</label>
                          <div class="input-group">
                            <input type="number" step="any" id="lat" name="latitude" class="form-control"   value="{{ old('longitude') }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="longitude">Longitude</label>
                          <div class="input-group">
                            <input name="longitude" step="any" id="leng" type="number" class="form-control"  value="{{ old('latitude') }}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div>
                    <button class="btn btn-primary" type="Submit">Update</button>
                  </div>

                </form>
                @endforeach
              </div>

              <div class="col-lg-12 col-sm-12 col-12">
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
          <img src="" id="img01" style="width: 450px; height: auto;">
        </div>
      </div>
    </div>

    @endsection

    @section('scripts')



    <!-- ====================== Input Map ====================== -->

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
         // //lokasi toko
         //   @foreach($market_agrikulture as $toko)
         //        new google.maps.Marker({
         //            position: { lat: {{ $toko->latitude }}, lng: {{ $toko->longitude }} },
         //            peta: map,
         //            title: '{{ $toko->nama_toko }}'
         //        });
         //    @endforeach

        //Fungsi untuk geolocation
        function lokasi(position) {
          //Mengirim data koordinat ke form input
          // document.getElementById("lat").value = position.coords.latitude;
          // document.getElementById("leng").value = position.coords.longitude;
          //Current Location
          var lat = position.coords.latitude;
          var long = position.coords.longitude;
          var latlong = new google.maps.LatLng(lat, long);
          //Current Marker 

          var currentMarker = [ 
          @foreach($market_agrikulture as $toko)
                new google.maps.Marker({
                    position: { lat: {{ $toko->latitude }}, lng: {{ $toko->longitude }} },
                    map: peta,
                    title: '{{ $toko->nama_toko }}',
                    // icon: 'https://img.icons8.com/plasticine/40/000000/user-location.png',
                }),
          @endforeach 
          ];        

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