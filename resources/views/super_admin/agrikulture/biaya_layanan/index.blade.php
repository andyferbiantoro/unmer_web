@extends('layouts.app')

@section('title')
Kelola Biaya Layanan
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h2 class="primary">Biaya Layanan Agrikulture </h2>
      <hr>
      @if($cek_layanan_agrikulture <= 0)
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambah">
        Tambah Biaya Layanan
      </button><br><br>
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
              <th>Biaya Layanan</th>
              <th>Ongkir Per-Kilometer</th>
              <th>Opsi</th>
              <th style="display: none;">hidden</th>
              <th style="display: none;">hidden</th>
              <th style="display: none;">hidden</th>
            </tr>
          </thead>
          <tbody>
            @php $no=1 @endphp
            @foreach($layanan_agrikulture as $data)
            <tr>
              <td>{{$no++}}</td>
              <td>Rp. <?=number_format($data->biaya_layanan, 0, ".", ".")?>,00</td>
              <td>Rp. <?=number_format($data->ongkir, 0, ".", ".")?>,00</td>
              <td>
                <!-- <button class="btn btn-warning btn-sm icon-file menu-icon edit" title="Edit">Edit</button> -->

                <button class="btn btn-warning btn-sm edit" title="Ubah biaya"><i class="fas fa-pen"></i> Ubah Biaya</button>
                <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                  <button class="btn btn-danger btn-sm"  title="Hapus">Hapus</button>

                </td>


                <td style="display: none;">{{$data->biaya_layanan}}</td>
                <td style="display: none;">{{$data->ongkir}}</td>
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
        <h5 class="modal-title" id="myLargeModalLabel">Tambah Data Biaya</h5>
      </div>
      <div class="modal-body">
       <form method="post" action="{{route('biaya_layanan_agrikulture_add')}}" enctype="multipart/form-data">

        {{csrf_field()}}

        
        <div class="form-group">
          <label for="biaya_layanan">Biaya Layanan</label>
          <input type="number" class="form-control" id="biaya_layanan" name="biaya_layanan"  required=""></input>
        </div>

        <div class="form-group">
          <label for="ongkir">Ongkir</label>
          <input type="number" class="form-control" id="ongkir" name="ongkir"  required=""></input>
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
        <h5 class="modal-title">Anda yakin ingin mengubah biaya layanan ini ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ csrf_field() }}
        {{ method_field('POST') }}

        <div class="form-group">
          <label for="biaya_layanan">Biaya Layanan</label>
          <input type="number" class="form-control" id="biaya_layanan_update" name="biaya_layanan" required="" ></input>
        </div>

        <div class="form-group">
          <label for="ongkir">Ongkir</label>
          <input type="number" class="form-control" id="ongkir_update" name="ongkir" required="" ></input>
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
        <h5 class="modal-title" id="exampleModalLabel">Hapus Biaya Layanan Agrikulture?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="deleteForm" method="post">

          {{ csrf_field() }}
          {{ method_field('POST') }}
          <p>Apakah anda yakin ingin menghapus biaya layanan ini ?</p> <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
          <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Hapus</button>

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
    function deleteData(id) {
      var id = id;
      var url = '{{route("biaya_layanan_agrikulture_delete", ":id") }}';
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
        $('#biaya_layanan_update').val(data[4]);
        $('#ongkir_update').val(data[5]);        
        $('#updateInformasiform').attr('action','biaya_layanan_agrikulture_update/'+ data[6]);
        $('#updateInformasi').modal('show');
      });
    });
  </script>

  @endsection


