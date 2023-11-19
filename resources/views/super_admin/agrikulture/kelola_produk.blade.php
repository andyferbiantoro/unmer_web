@extends('layouts.app')

@section('title')
Kelola Produk Agrikultur
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h2 class="primary">Produk Agrikulture </h2>
     <hr>
     
    <a href="{{ route('superadmin_agrikulture') }}"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-shopping-bag"></i> Produk Agrikulture</button></a>
    <a href="{{ route('superadmin_market_agrikulture') }}"><button type="button" class="btn btn-light btn-sm"><i class="fas fa-store"></i> Market Agrikulture</button></a>
    <a href="{{ route('superadmin_transaksi_agrikulture') }}"><button type="button" class="btn btn-light btn-sm"><i class="fas fa-money-bill"></i> Transaksi Agrikulture</button></a>
   
    <hr>
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambah">
      Tambah Produk Agrikulture
    </button><br><br>
    @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    <div class="text-center" >
      <div class="col-12">
          <form action="{{route('superadmin_agrikulture')}}" method="GET">
            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                  <div class="form-group form-success">
                    <select  name="kategori_produk" class="form-control"  required="">
                     <option selected disabled> -- Pilih Kategori Produk -- </option>
                     @foreach($kat as $k)
                     <option  value="{{$k->kategori_produk}}" >{{$k->kategori_produk}}</option>
                     @endforeach
                   </select>
                   <span class="form-bar"></span>
                 </div>
                 <!--  <input type="text" class="form-control" name="from" placeholder="Cari tanggal .." value="{{ old('from') }}"> -->
                </div>
              </div>

            <div class="col-lg-2">
              <div class="form-row">

                <input type="submit" class="btn btn-info" value="Filter Kategori">
              </div>
            </div>
          </div> 
        </form>

      </div>
     <div class="table-responsive">
      <table id="dataTable" class="table table-striped" style="width:100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Toko</th>
            <th>Kategori Produk</th>
            <th>Nama Produk</th>
            <th>Harga Produk</th>
            <th>Stok Produk</th>
            <th>Foto Produk</th>
            <th>Opsi</th>
            <th style="display: none;">hidden</th>
          </tr>
        </thead>
        <tbody>
          @php $no=1 @endphp
          @foreach($produk_agrikulture as $data)
          <tr>
            <td>{{$no++}}</td>
            <td>{{$data->nama_toko}}</td>
            <td>{{$data->kategori_produk}}</td>
            <td>{{$data->nama_produk}}</td>
            <td>Rp. <?=number_format($data->harga_produk, 0, ".", ".")?>,00</td>
            <td>{{$data->stok}}</td>
            <td><img style="border-radius: 0%" height="70" id="ImageTampil" src="{{asset('/public/uploads/produk_agrikulture/'.$data->foto)}}"  data-toggle="modal" data-target="#myModal"></img></td>

            <td>
              <!-- <button class="btn btn-warning btn-sm icon-file menu-icon edit" title="Edit">Edit</button> -->

              <a href="{{route('superadmin_produk_agrikulture_edit',$data->id)}}"><button class="btn btn-primary btn-sm">Edit</button></a>
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
        <h5 class="modal-title" id="myLargeModalLabel">Tambah Data Produk</h5>
      </div>
      <div class="modal-body">
       <form method="post" action="{{route('produk_agrikulture_add')}}" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group form-success">
          <label >Pilh Market</label>
          <select  name="id_market" class="form-control"  required="">
           <option selected disabled> -- Pilih Market -- </option>
           @foreach($market as $data)
           <option value="{{$data->id}}" >{{$data->nama_toko}}</option>
           @endforeach
         </select>
         <span class="form-bar"></span>
       </div>


       <div class="form-group">
        <label for="nama_produk">Nama Produk</label>
        <input type="text" class="form-control" id="nama_produk" name="nama_produk"  required=""></input>
      </div>

      <div class="form-group form-success">
        <label >Jenis Produk</label>
        <select  name="kategori_produk" class="form-control"  required="">
         <option selected disabled> -- Pilih Kategori Produk -- </option>
         @foreach($kat as $k)
         <option  value="{{$k->kategori_produk}}" >{{$k->kategori_produk}}</option>
          @endforeach
       </select>
       <span class="form-bar"></span>
     </div>


     <div class="form-group">
      <label for="harga_produk">Harga Produk</label>
      <input type="number" class="form-control" id="harga_produk" name="harga_produk"  required=""></input>
    </div>

    <div class="form-group">
      <label for="stok">Stok Produk</label>
      <input type="number" class="form-control" id="stok" name="stok"  required=""></input>
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


