@extends('layouts.app')

@section('title')
Kelola Transaksi Agrikultur
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h2 class="primary">Transaksi Agrikulture </h2>
     <hr>
    <br>
    <a href="{{ route('superadmin_agrikulture') }}"><button type="button" class="btn btn-light btn-sm">Tabel Produk Agrikulture</button></a>
    <a href="{{ route('superadmin_market_agrikulture') }}"><button type="button" class="btn btn-light btn-sm">Tabel Market Agrikulture</button></a>
    <a href="{{ route('superadmin_transaksi_agrikulture') }}"><button type="button" class="btn btn-primary btn-sm">Transaksi Agrikulture</button></a>
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
            <th>Nama Pemesan</th>
            <th>Nominal</th>
            <th>Catatan</th>
            <th>Status Pemesanan</th>
          
            <th>Opsi</th>
            <th style="display: none;">hidden</th>
          </tr>
        </thead>
        <tbody>
          @php $no=1 @endphp
          @foreach($transaksi_agrikulture as $data)
          <tr>
            <td>{{$no++}}</td>
            <td>{{$data->nama}}</td>
            <td>Rp. <?=number_format($data->nominal, 0, ".", ".")?>,00</td>
            <td>{{$data->catatan}}</td>
            @if($data->status_pemesanan == 'dikemas')
            <td><div class="badge badge-warning">Sedang Dikemas</div></td>
            @elseif($data->status_pemesanan == 'diantar')
            <td><div class="badge badge-info">Sedang Diantar</div></td>
            elseif($data->status_pemesanan == 'selesai')
            <td><div class="badge badge-success">Pesanan Sampai</div></td>
            @endif
            <td>
              <!-- <button class="btn btn-warning btn-sm icon-file menu-icon edit" title="Edit">Edit</button> -->

              <a href="{{route('superadmin_transaksi_agrikulture_detail',$data->id)}}"><button class="btn btn-info btn-sm">Detail</button></a>

              <!-- <a href="{{route('superadmin_produk_agrikulture_edit',$data->id)}}"><button class="btn btn-primary btn-sm">Edit</button></a> -->

              <!-- <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                <button class="btn btn-danger btn-sm"  title="Hapus">Hapus</button>

              </td> -->



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
        <h5 class="modal-title" id="myLargeModalLabel">Tambah Data Produk</h5>
      </div>
      <div class="modal-body">
       <form method="post" action="{{route('produk_agrikulture_add')}}" enctype="multipart/form-data">

        {{csrf_field()}}



       <div class="form-group">
        <label for="nama_produk">Nama Produk</label>
        <input type="text" class="form-control" id="nama_produk" name="nama_produk"  required=""></input>
      </div>

      

     <div class="form-group">
      <label for="harga_produk">Harga Produk</label>
      <input type="number" class="form-control" id="harga_produk" name="harga_produk"  required=""></input>
    </div>

    <div class="form-group">
      <label for="foto">Foto Produk</label>
      <input type="file" class="form-control" id="foto" name="foto"  required=""></input>
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
      var url = '{{route("produk_agrikulture_delete", ":id") }}';
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

