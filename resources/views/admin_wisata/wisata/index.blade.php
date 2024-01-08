@extends('layouts.app')

@section('title')
Kelola Wisata
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h2 class="primary">Wisata</h2>
      <hr>
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambah">
        <i class="fas fa-plus"></i> Tambah Wisata
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
              <th>Nama Wisata</th>
              <th>Deskripsi</th>
              <th>Hari Buka</th>
              <th>Jam Buka</th>
              <th>Alamat</th>
              <th>Opsi</th>
              <th style="display: none;">hidden</th>
            </tr>
          </thead>
          <tbody>
            @php $no=1 @endphp
            @foreach($wisata as $data)
            <tr>
              <td>{{$no++}}</td>
              <td>{{$data->nama_tempat_wisata}}</td>
              <td>{{$data->deskripsi}}</td>
              <td>{{$data->hari_operasional_awal}} s/d {{$data->hari_operasional_akhir}}</td>
              <td>
                {{ \Carbon\Carbon::parse($data->jam_buka)->timezone('Asia/Jakarta')->format('H:i') }} - 
                {{ \Carbon\Carbon::parse($data->jam_tutup)->timezone('Asia/Jakarta')->format('H:i') }} WIB

              </td>
              <td>{{$data->alamat}}</td>

              <td>

                <a href="{{route('admin_lihat_detail_wisata',$data->id)}}"><button class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i> Detail Wisata</button></a>

                <a href="{{route('admin_lihat_tiket_wisata',$data->id)}}"><button class="btn btn-dark btn-sm"><i class="fas fa-ticket-alt"></i> Lihat Tiket</button></a>

                <a href="{{route('admin_wisata_delete',$data->id)}}"><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button></a>





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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Tambah Event</h5>
      </div>
      <div class="modal-body">
       <form method="post" action="{{route('admin_wisata_add')}}" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group form-success">



         <div class="form-group">
          <label for="nama_tempat_wisata">Nama Tempat Wisata</label>
          <input type="text" class="form-control" id="nama_tempat_wisata" name="nama_tempat_wisata"  required=""></input>
        </div>

        <div class="form-group">
          <label for="deskripsi">Deskripsi</label>
          <textarea type="text" class="form-control" id="deskripsi" name="deskripsi"  required=""></textarea>
        </div>




        <div class="form-group">
          <label>Hari Operasional</label>
          <div class="row">
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group form-success">
                <label>Hari Awal</label>
                <select  name="hari_operasional_awal" class="form-control"  required="">
                 <option selected disabled> -- Pilih Hari -- </option>
                 <option value="Senin">Senin</option>
                 <option value="Selasa">Selasa</option>
                 <option value="Rabu">Rabu</option>
                 <option value="Kamis">Kamis</option>
                 <option value="Jumat">Jum'at</option>
                 <option value="Sabtu">Sabtu</option>
                 <option value="Minggu">Minggu</option>
               </select>
               <span class="form-bar"></span>
             </div>
           </div>
           <div class="col-lg-6 col-sm-12 col-12">
            <div class="form-group form-success">
              <label>Hari Akhir</label>
              <select  name="hari_operasional_akhir" class="form-control"  required="">
               <option selected disabled> -- Pilih Hari -- </option>
               <option value="Senin">Senin</option>
               <option value="Selasa">Selasa</option>
               <option value="Rabu">Rabu</option>
               <option value="Kamis">Kamis</option>
               <option value="Jumat">Jum'at</option>
               <option value="Sabtu">Sabtu</option>
               <option value="Minggu">Minggu</option>
             </select>
             <span class="form-bar"></span>
           </div>
         </div>
       </div>
     </div>



     <div class="form-group">
      <label>Jam Operasional</label>
      <div class="row">
        <div class="col-lg-6 col-sm-12 col-12">
         <div class="form-group">
          <label for="jam_buka">Jam Buka</label>
          <input type="time" class="form-control" id="jam_buka" name="jam_buka"  required=""></input>
        </div>
      </div>
      <div class="col-lg-6 col-sm-12 col-12">
        <div class="form-group">
          <label for="jam_tutup">Jam Tutup</label>
          <input type="time" class="form-control" id="jam_tutup" name="jam_tutup"  required=""></input>
        </div>
      </div>
    </div>
  </div>


  <div class="form-group">
    <label for="alamat">Alamat</label>
    <input type="text" class="form-control" id="alamat" name="alamat"  required=""></input>
  </div>

  <div class="form-group">
    <label for="foto_wisata">Foto Wisata</label>
    <input type="file" class="form-control" id="foto_wisata" name="foto_wisata" required=""></input>
  </div>


  <div class="form-group">
    <label>Lokasi Wisata</label>
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
  <script type="text/javascript">
    function deleteData(id) {
      var id = id;
      var url = '{{route("admin_event_delete", ":id") }}';
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
        $('#stok_update').val(data[5]);
        $('#updateInformasiform').attr('action','admin_kasir_ubah_stok_agrikulture/'+ data[9]);
        $('#updateInformasi').modal('show');
      });
    });
  </script>


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


