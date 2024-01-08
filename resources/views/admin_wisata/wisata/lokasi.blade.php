@extends('layouts.app')

@section('title')
Lokasi Wisata
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
        <h2 class="primary">Lokasi Wisata </h2><br>

        @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif
        <div class="text-left">

          <div class="form-group">

            <div class="row">
              <div class="col-lg-12 col-sm-12 col-12">
                <div id="map" style="height: 400px;"></div>
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
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: -8.241350866473171, lng: 114.08902679785155 }, // Koordinat tengah peta
                zoom: 10
            });

            // Tampilkan marker untuk setiap toko
            @foreach($wisata as $wisata)
                new google.maps.Marker({
                    position: { lat: {{ $wisata->latitude }}, lng: {{ $wisata->longitude }} },
                    map: map,
                    title: '{{ $wisata->nama_tempat_wisata }}'
                });
            @endforeach
        }
    </script>
     <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv-h2II7DbFQkpL9pDxNRq3GWXqS5Epts&callback=initialize&callback=initMap" type="text/javascript"></script>
    @endsection