@extends('layouts.app')

@section('title')
Kelola Broadcast
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h2 class="primary">Kelola Broadcast</h2><hr>
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambah">
        Tambah Broadcast 
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
              <th>Tanggal</th>
              <th>Isi Pesan</th>
              <th>Opsi</th>
              <th style="display: none;">hidden</th>
            </tr>
          </thead>
          <tbody>
            @php $no=1 @endphp
            @foreach($broadcast as $data)
            <tr>
              <td>{{$no++}}</td>
              <td>{{date("j F Y", strtotime($data->created_at))}}</td>
              <td>{{$data->isi_pesan}}</td>

              <td>
                <!-- <button class="btn btn-warning btn-sm icon-file menu-icon edit" title="Edit">Edit</button> -->
                <a href="{{route('superadmin_kelola_broadcast_detail',$data->id)}}"><button class="btn btn-info btn-sm">Detail</button></a>
                <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                  <button class="btn btn-danger btn-sm"  title="Hapus">Hapus</button>

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
        <h5 class="modal-title" id="myLargeModalLabel">Tambah Broadcast</h5>
      </div>
      <div class="modal-body">
       <form method="post" action="{{route('superadmin_kelola_broadcast_add')}}" enctype="multipart/form-data">

        {{csrf_field()}}


        

        <div class="form-group"> 
            <label><strong>Penerima</strong></label><br>
            @foreach($customer as $list)
            <label><input type="checkbox" name="id_user_penerima[]" value="{{$list->id_user}}"> {{$list->nama}}</label><br>
            @endforeach
        </div>
        
        <div class="form-group">
          <label for="isi_pesan">Isi Pesan</label>
          <textarea type="text" class="form-control" id="isi_pesan" name="isi_pesan"  required=""></textarea>
        </div>


        <div class="form-group">
          <input type="hidden" class="form-control" id="id_user_pengirim" name="id_user_pengirim"  value="{{Auth::user()->id}}"  required=""></input>
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
          <input type="text" class="form-control" id="nama_update" name="nama"  required=""></input>
        </div>

        <div class="form-group">
          <label for="nik">NIK</label>
          <input type="text" class="form-control" id="nik_update" name="nik"  required=""></input>
        </div>




      </div> 
      <div class="modal-footer">
        <button type="submit"  class="btn btn-primary float-right mr-2" >Perbarui</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Hapus Broadcast ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="deleteForm" method="post">

          {{ csrf_field() }}
          {{ method_field('POST') }}
          <p>Apakah anda yakin ingin menghapus pesan ini ?</p> <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
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
    var url = '{{route("superadmin_kelola_broadcast_delete", ":id") }}';
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

      $('#updateInformasiform').attr('action','admin_update/'+ data[8]);
      $('#updateInformasi').modal('show');
    });
  });
</script>

@endsection


