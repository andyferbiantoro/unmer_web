@extends('layouts.app')

@section('title')
Kelola Tambahan
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h2 class="primary">Kelola Status Menu</h2>
      <hr>
      <a href="{{ route('superadmin_kelola_tambahan') }}"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-bars"></i> Kelola Menu</button></a>
      <a href="{{ route('superadmin_kelola_kontak_bantuan') }}"><button type="button" class="btn btn-light btn-sm"><i class="fas fa-phone"></i> Kontak bantuan</button></a>
      <br><br>

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
              <th>Menu</th>
              <th>Status</th>
              <th>Opsi</th>

              <th style="display: none;">hidden</th>
            </tr>
          </thead>
          <tbody>
            @php $no=1 @endphp
            @foreach($status_menu as $data)
            <tr>
              <td>{{$no++}}</td>
              <td>{{$data->menu}}</td>
              <td>
                @if($data->status == 'aktif')
                <div class="badge badge-success">Aktif</div>
                @elseif($data->status == 'nonaktif')  
                <div class="badge badge-danger">Non-Aktif</div>
                @endif
              </td>
              <td>
                @if($data->status == 'aktif')
                <a href="#" data-toggle="modal" onclick="nonaktifkan({{$data->id}})" data-target="#NonAktifkanModal"><button class="btn btn-danger btn-sm"  title="Non Aktifkan Menu"><i class="fas fa-lock"></i> Non-Aktifkan</button>

                @elseif($data->status == 'nonaktif')
                <a href="#" data-toggle="modal" onclick="aktifkan({{$data->id}})" data-target="#AktifkanModal"><button class="btn btn-success btn-sm"  title="Aktifkan Kembali Menu"><i class="fas fa-lock-open"></i> Aktfkan</button>
                @endif
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






<!-- Modal Nonaktif-->
<div class="modal fade" id="NonAktifkanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Non-Aktifkan Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="non_aktifkanForm" method="post">

          {{ csrf_field() }}
          {{ method_field('POST') }}
          <p>Apakah anda yakin ingin menonaktifkan menu ini ?</p> <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
          <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Non-Aktifkan Menu</button>

        </form>
      </div>

    </div>
  </div>
</div>


<!-- Modal Nonaktif-->
<div class="modal fade" id="AktifkanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Aktifkan Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="aktifkanForm" method="post">

          {{ csrf_field() }}
          {{ method_field('POST') }}
          <p>Apakah anda yakin ingin mengaktifkan kembali menu ini ?</p> <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
          <button type="submit" name="" class="btn btn-success float-right mr-2" data-dismiss="modal" onclick="formSubmit_aktif()">Aktifkan Menu</button>

        </form>
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
        <img src="" id="img01" style="width: 450px; height: auto;" >
      </div>
    </div>
  </div>



  @endsection

  @section('scripts')
  <script type="text/javascript">
    function nonaktifkan(id) {
      var id = id;
      var url = '{{route("superadmin_non_aktifkan_menu", ":id") }}';
      url = url.replace(':id', id);
      $("#non_aktifkanForm").attr('action', url);
    }

    function formSubmit() {
      $("#non_aktifkanForm").submit();
    }
  </script>


  <script type="text/javascript">
    function aktifkan(id) {
      var id = id;
      var url = '{{route("superadmin_aktifkan_menu", ":id") }}';
      url = url.replace(':id', id);
      $("#aktifkanForm").attr('action', url);
    }

    function formSubmit_aktif() {
      $("#aktifkanForm").submit();
    }
  </script>



  @endsection




