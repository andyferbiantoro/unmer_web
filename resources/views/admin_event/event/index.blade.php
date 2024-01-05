@extends('layouts.app')

@section('title')
Kelola Event
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h2 class="primary">Event</h2>
     <hr>
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambah">
    Tambah Event
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
            <td>{{$data->deskripsi}}</td>
            <td>{{$data->lokasi}}</td>
            <td>{{date("j F Y", strtotime($data->tanggal_event))}}</td>
            <td>{{ \Carbon\Carbon::parse($data->jam_mulai)->timezone('Asia/Jakarta')->format('H:i') }} WIB</td>
            <td>{{ \Carbon\Carbon::parse($data->jam_selesai)->timezone('Asia/Jakarta')->format('H:i') }} WIB</td>
            <td><img style="border-radius: 0%" height="70" src="{{asset('/public/uploads/event/'.$data->foto_event)}}"></img></td>

            <td>
             
              <a href="{{route('admin_lihat_detail_event',$data->id)}}"><button class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i> Detail Event</button></a>

              <a href="{{route('admin_lihat_tiket_event',$data->id)}}"><button class="btn btn-dark btn-sm"><i class="fas fa-ticket-alt"></i> Lihat Tiket</button></a>

              <a href="{{route('admin_event_delete',$data->id)}}"><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button></a>

               

             
              
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
       <form method="post" action="{{route('admin_event_add')}}" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group form-success">
         


       <div class="form-group">
        <label for="judul_event">Judul Event</label>
        <input type="text" class="form-control" id="judul_event" name="judul_event"  required=""></input>
      </div>

      

      <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea type="text" class="form-control" id="deskripsi" name="deskripsi"  required=""></textarea>
      </div>

      <div class="form-group">
        <label for="lokasi">Lokasi</label>
        <input type="text" class="form-control" id="lokasi" name="lokasi"  required=""></input>
      </div>

      <div class="form-group">
        <label for="tanggal_event">Tanggal Event</label>
        <input type="date" class="form-control" id="tanggal_event" name="tanggal_event"  required=""></input>
      </div>

      <div class="form-group">
        <label for="jam_mulai">Jam Mulai</label>
        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai"  required=""></input>
      </div>

      <div class="form-group">
        <label for="jam_selesai">Jam Selesai</label>
        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai"  required=""></input>
      </div>

      


      
    
    <div class="form-group">
      <label for="foto_event">Foto Event</label>
      <input type="file" class="form-control" id="foto_event" name="foto_event" required=""></input>
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

  @endsection


