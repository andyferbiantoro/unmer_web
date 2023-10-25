@extends('layouts.app')

@section('title')
Kelola Produk Koperasi
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">

      <h2 class="primary">Produk Koperasi </h2>
        <hr>
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambah">
          Tambah Produk Koperasi
        </button><br><br>

      <a href="{{ route('superadmin_koperasi') }}"><button type="button" class="btn btn-primary btn-sm">Tabel Produk Koperasi</button></a>

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
              <th>Nama Admin</th>
              <th>Nama Produk</th>
              <th>Kode Produk</th>
              <th>kategori Produk</th>
              <th>Harga</th>
              <th>Foto</th>
              <th>Opsi</th>
              <th style="display: none;">hidden</th>
            </tr>
          </thead>
          <tbody>
            @php $no=1 @endphp
            @foreach($produk_koperasi as $data)
            <tr>
              <td>{{$no++}}</td>
              <td>{{$data->nama}}</td>
              <td>{{$data->nama_produk}}</td>
              <td>{{$data->kode_produk}}</td>
              <td>{{$data->kategori_produk}}</td>
              <td>Rp. <?=number_format($data->harga, 0, ".", ".")?>,00</td>
              <td><img style="border-radius: 0%" height="70" id="ImageTampil" src="{{asset('uploads/produk_koperasi/'.$data->foto)}}"  data-toggle="modal" data-target="#myModal"></img></td>
              <td>

                <a href="{{route('produk_koperasi_detail',$data->id)}}"><button class="btn btn-info btn-sm">Detail</button></a>
                <a href="{{route('produk_koperasi_edit',$data->id)}}"><button class="btn btn-primary btn-sm">Edit</button></a>
                <!-- <button class="btn btn-warning btn-sm icon-file menu-icon edit" title="Edit">Edit</button> -->

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
       <form method="post" action="{{route('produk_koperasi_add')}}" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group form-success">
          <label >Pilh Admin</label>
          <select  name="id_admin" class="form-control"  required="">
           <option selected disabled> -- Pilih Admin -- </option>
           @foreach($admin as $data)
           <option value="{{$data->id}}" >{{$data->nama}}</option>
           @endforeach
         </select>
         <span class="form-bar"></span>
       </div>


        <div class="form-group">
          <label for="nama_produk">Nama Produk</label>
          <input type="text" class="form-control" id="nama_produk" name="nama_produk"  required=""></input>
        </div>

        <div class="form-group form-success">
          <label >Pilh Partner</label>
          <select  name="id_partner" class="form-control"  required="">
           <option selected disabled> -- Pilih Partner -- </option>
           @foreach($partner as $data)
           <option value="{{$data->id}}" >{{$data->nama}}</option>
           @endforeach
         </select>
         <span class="form-bar"></span>
       </div>


       <div class="form-group">
        <label for="kode_produk">Kode Produk</label>
        <input type="text" class="form-control" id="kode_produk" name="kode_produk"  required=""></input>
      </div>

      <div class="form-group form-success">
        <label >Kategori Produk</label>
        <select id="kategori_produk" name="kategori_produk" class="form-control"  required="" onchange="kategoriInputForm()" >
         <option selected disabled> -- Pilih Kategori Produk -- </option>
         @foreach($kat as $k)
         <option value="{{$k->kategori_produk}}" >{{$k->kategori_produk}}</option>
         @endforeach
       </select>
       <span class="form-bar"></span>
     </div>

    

      <div class="form-group">
        <div class="row">
          <div id="size_id" style="display: none" class="col-lg-6 col-sm-12 col-12" >
            <label><strong>Size</strong></label><br>
            @foreach($list_size as $list)
            <label><input type="checkbox" name="size[]" value="{{$list->size}}"> {{$list->size}}</label><br>
            @endforeach
            
          </div>

           <div id="warna_id" style="display: none" class="col-lg-6 col-sm-12 col-12">
            <label><strong>Warna</strong></label><br>
            @foreach($list_warna as $list)
            <label><input type="checkbox" name="warna[]" value="{{$list->warna}}"> {{$list->warna}}</label><br>
            @endforeach
            
          </div>
        </div>


      </div>  


      

      <div class="form-group">
        <label for="harga">Harga</label>
        <input type="number" class="form-control" id="harga" name="harga"  required=""></input>
      </div>

      <div class="form-group">
        <label for="stok">Stok</label>
        <input type="number" class="form-control" id="stok" name="stok"  required=""></input>
      </div>

      <div class="form-group">
        <label for="foto">Foto</label>
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

        <div class="form-group">
          <label for="tempat_lahir">Tempat Lahir</label>
          <input type="text" class="form-control" id="tempat_lahir_update" name="tempat_lahir"  required=""></input>
        </div>

        <div class="form-group">
          <label for="tanggal_lahir">Tanggal Lahir</label>
          <input type="text" class="form-control" id="tanggal_lahir_update" name="tanggal_lahir"  required=""></input>
        </div>




        <div class="form-group">
          <label for="role_admin">Role Admin</label>
          <input type="text" class="form-control" id="role_admin_update" name="role_admin"  required=""></input>
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
        <h5 class="modal-title" id="exampleModalLabel">Hapus Produk ?</h5>
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
    var url = '{{route("produk_koperasi_delete", ":id") }}';
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
  

  <script>
        // Menggunakan JavaScript untuk menampilkan/menyembunyikan size dan warna berdasarkan pilihan dropdown
        document.getElementById("kategori_produk").addEventListener("change", function () {
            var productType = this.value;
            var sizeOptions = document.getElementById("size_id");
            var warnaOptions = document.getElementById("warna_id");

            if (productType === "Pakaian") {
                sizeOptions.style.display = "block";
                warnaOptions.style.display = "block";
            } else {
                sizeOptions.style.display = "none";
                 warnaOptions.style.display = "none";
            }
        });
    </script>

@endsection


