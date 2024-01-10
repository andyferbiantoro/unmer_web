@extends('layouts.app')

@section('title')
Edit Wisata
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">

      
       @foreach($wisata as $wis)
       <a href="{{route('admin_lihat_detail_wisata',$wis->id)}}"><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-long-arrow-alt-left"></i> Kembali</button></a>
       @endforeach
      <br><br>
      <h2 class="primary">Edit Wisata</h2><br>

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
              <form method="post" action="{{route('admin_wisata_update',$data->id)}}" enctype="multipart/form-data">

                {{csrf_field()}}

                <div class="form-group">
                  <label for="nama_tempat_wisata">Nama Tempat Wisata</label>
                  <input type="text" class="form-control" id="nama_tempat_wisata" name="nama_tempat_wisata" value="{{$data->nama_tempat_wisata}}"  required=""></input>
                </div>

                <div class="form-group">
                  <label for="deskripsi">Deskripsi</label>
                  <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{$data->deskripsi}}"  required=""></input>
                </div>

               <div class="form-group">
                <label for="hari_operasional_awal">Hari Operasional Awal</label>
                <input type="text" class="form-control" id="hari_operasional_awal" name="hari_operasional_awal" value="{{$data->hari_operasional_awal}}"  required=""></input>
              </div>

              <div class="form-group">
                <label for="hari_operasional_akhir">Hari Operasional Akhir</label>
                <input type="text" class="form-control" id="hari_operasional_akhir" name="hari_operasional_akhir" value="{{$data->hari_operasional_akhir}}"  required=""></input>
              </div>

              <div class="form-group">
                <label for="jam_buka">Jam Buka</label>
                <input type="time" class="form-control" id="jam_buka" name="jam_buka" value="{{$data->jam_buka}}"  required=""></input>
              </div>


              <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{$data->alamat}}"  required=""></input>
              </div>


              <div class="form-group">
                <label for="jam_tutup">Jam Tutup</label>
                <input type="time" class="form-control" id="jam_tutup" name="jam_tutup" value="{{$data->jam_tutup}}"  required=""></input>
              </div>

              <div class="form-group">
                <label for="foto_wisata">Foto Wisata</label>
                <div class="input-group">
                  <input type="file" name="foto_wisata" class="form-control"
                  value="{{$data->foto_wisata}}" >
                </div>
              </div> 


              <div class="form-group">
                    <label>Posisi event</label>
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
                <button class="btn btn-primary" type="Submit">Update Wisata</button>


              </div>

            </form>
            <hr>

            @endforeach
              
              

          </div>

          <div class="col-lg-6 col-sm-12 col-12">


            <form method="post" action="{{route('admin_wisata_update',$data->id)}}" enctype="multipart/form-data">

              <div class="form-group">
                <label for="latitude_lap">Foto Tempat Wisata</label>
                <div></div><span ><img  style="width: 100%; height: 400px; border-radius: 3px;" 
                  src="{{asset('public/uploads/wisata/'.$data->foto_wisata)}}"></span>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
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
          @foreach($wisata as $wis)
                new google.maps.Marker({
                    position: { lat: {{ $wis->latitude }}, lng: {{ $wis->longitude }} },
                    map: peta,
                    title: '{{ $wis->nama_tempat_wisata }}',
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

  