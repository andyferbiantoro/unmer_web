@extends('layouts.app')

@section('title')
Kelola Market Agrikultur
@endsection


@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="card">

      <div class="card-body">
        <h2 class="primary">Market Agrikulture </h2>
        <hr>
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambah">
          Tambah Market Agrikulture
        </button><br><br>
        <a href="{{ route('superadmin_agrikulture') }}"><button type="button" class="btn btn-secondary btn-sm">Tabel Produk Agrikulture</button></a>
        <a href="{{ route('superadmin_market_agrikulture') }}"><button type="button" class="btn btn-primary btn-sm">Tabel Market Agrikulture</button></a>
        <br><br>

        @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif
        <div class="text-center">
          <div class="table-responsive">
            <table id="dataTable" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Toko</th>
                  <th>Nama Admin</th>
                  <th>Status Buka</th>


                  <th>Opsi</th>
                  <th style="display: none;">hidden</th>
                </tr>
              </thead>
              <tbody>
                @php $no=1 @endphp
                @foreach($market_agrikulture as $data)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$data->nama_toko}}</td>
                  <td>{{$data->nama}}</td>
                  <td>{{$data->status_buka}}</td>

                  <td>
                    <!-- <button class="btn btn-warning btn-sm icon-file menu-icon edit" title="Edit">Edit</button> -->
                    <a href="{{route('superadmin_tampil_peta_market',$data->id)}}"><button class="btn btn-dark btn-sm">Lihat Peta Market</button></a>
                    <a href="{{route('superadmin_market_agrikulture_edit',$data->id)}}"><button class="btn btn-primary btn-sm">Edit</button></a>

                    <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                      <button class="btn btn-danger btn-sm" title="Hapus">Hapus</button>

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






<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Tambah Data Market</h5>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('market_add')}}" enctype="multipart/form-data">

          {{csrf_field()}}

          <div class="form-group form-success">
            <label>Pilh Admin</label>
            <select name="id_admin" class="form-control" required="">
              <option selected disabled> -- Pilih Admin -- </option>
              @foreach($admin as $data)
              <option value="{{$data->id}}">{{$data->nama}}</option>
              @endforeach
            </select>
            <span class="form-bar"></span>
          </div>


          <div class="form-group">
            <label for="nama_toko">Nama Toko</label>
            <input type="text" class="form-control" id="nama_toko" name="nama_toko" required=""></input>
          </div>

          <div class="form-group">
            <label for="status_buka">Status Buka</label>
            <input type="text" class="form-control" id="status_buka" name="status_buka" required=""></input>
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
                    <input type="number" step="any" id="lat" name="latitude" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="longitude">Longitude</label>
                  <div class="input-group">
                    <input name="longitude" step="any" id="leng" type="number" class="form-control" required>
                  </div>
                </div>
              </div>
            </div>
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





<!-- Modal Update -->
<div id="updateInformasi" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!--Modal content-->
    <form action="" id="updateInformasiform" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Anda yakin ingin memperbarui data admin ini ?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{ csrf_field() }}
          {{ method_field('POST') }}

          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama_update" name="nama" required=""></input>
          </div>

          <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" id="nik_update" name="nik" required=""></input>
          </div>

          <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" class="form-control" id="tempat_lahir_update" name="tempat_lahir" required=""></input>
          </div>

          <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="text" class="form-control" id="tanggal_lahir_update" name="tanggal_lahir" required=""></input>
          </div>




          <div class="form-group">
            <label for="role_admin">Role Admin</label>
            <input type="text" class="form-control" id="role_admin_update" name="role_admin" required=""></input>
          </div>


        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary float-right mr-2">Perbarui</button>
          <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>






<!-- Modal -->
<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Admin ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="deleteForm" method="post">

          {{ csrf_field() }}
          {{ method_field('POST') }}
          <p>Apakah anda yakin ingin menghapus data Admin ini ?</p> <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
          <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Hapus</button>

        </form>
      </div>

    </div>
  </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
  function deleteData(id) {
    var id = id;
    var url = '{{route("admin_delete", ":id") }}';
    url = url.replace(':id', id);
    $("#deleteForm").attr('action', url);
  }

  function formSubmit() {
    $("#deleteForm").submit();
  }
</script>


<script>
  $(document).ready(function() {
    var table = $('#dataTable').DataTable();
    table.on('click', '.edit', function() {
      $tr = $(this).closest('tr');
      if ($($tr).hasClass('child')) {
        $tr = $tr.prev('.parent');
      }
      var data = table.row($tr).data();
      console.log(data);
      $('#nama_update').val(data[1]);
      $('#nik_update').val(data[2]);
      $('#tempat_lahir_update').val(data[3]);
      $('#tanggal_lahir_update').val(data[4]);
      $('#status_update').val(data[5]);
      $('#role_admin_update').val(data[6]);

      $('#updateInformasiform').attr('action', 'admin_update/' + data[8]);
      $('#updateInformasi').modal('show');
    });
  });
</script>


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