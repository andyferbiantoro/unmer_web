@extends('layouts.app')

@section('title')
Kelola Tambahan
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h2 class="primary">Kelola Kontak Bantuan</h2>
      <hr>
      <a href="{{ route('superadmin_kelola_tambahan') }}"><button type="button" class="btn btn-light btn-sm"><i class="fas fa-bars"></i> Kelola Menu</button></a>
      <a href="{{ route('superadmin_kelola_kontak_bantuan') }}"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-phone"></i> Kontak bantuan</button></a>
      <br><br>
      @if($cek_kontak <= 0)
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambah">
          <i class="fas fa-plus"></i> Tambah Kontak Bantuan
        </button>
        <br><br>
        @endif

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
              <th>No Telepon</th>
              <th>Opsi</th>

              <th style="display: none;">hidden</th>
            </tr>
          </thead>
          <tbody>
            @php $no=1 @endphp
            @foreach($kontak_bantuan as $data)
            <tr>
              <td>{{$no++}}</td>
              <td>{{$data->no_telp}}</td>
              <td>
                <button class="btn btn-warning btn-sm edit" title="Ubah Stok"><i class="fas fa-pen"></i> Ubah Nomor</button>

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
        <h5 class="modal-title" id="myLargeModalLabel">Tambah Kontak Bantuan</h5>
      </div>
      <div class="modal-body">
       <form method="post" action="{{route('superadmin_kelola_kontak_bantuan_add')}}" enctype="multipart/form-data">

        {{csrf_field()}}

        
        <div class="form-group">
          <label for="no_telp">No Telepon</label>
          <input type="text" class="form-control" id="no_telp" name="no_telp"  required=""></input>
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
              <h5 class="modal-title">Anda yakin ingin mengubah nomor ini ?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{ csrf_field() }}
              {{ method_field('POST') }}

              <div class="form-group">
                <label for="no_telp">No Telepon</label>
                <input type="text" class="form-control" id="no_telp_update" name="no_telp" required="" ></input>
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
        <h5 class="modal-title" id="exampleModalLabel">Hapus Kontak Bantuan Ini?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="deleteForm" method="post">

          {{ csrf_field() }}
          {{ method_field('POST') }}
          <p>Apakah anda yakin ingin menghapus nomor ini ?</p> <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
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
      var url = '{{route("superadmin_kelola_kontak_bantuan_delete", ":id") }}';
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
        $('#no_telp_update').val(data[1]);
        $('#updateInformasiform').attr('action','superadmin_kelola_kontak_bantuan_update/'+ data[3]);
        $('#updateInformasi').modal('show');
      });
    });
  </script>


  @endsection




