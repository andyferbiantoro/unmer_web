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
     <!--  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambah">
        Tambah Produk Koperasi
      </button><br><br> -->

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
              <th>Nama Produk</th>
              <th>Kode Produk</th>
              <th>Kategori Produk</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Terjual</th>
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
              <td>{{$data->nama_produk}}</td>
              <td>{{$data->kode_produk}}</td>
              <td>{{$data->kategori_produk}}</td>
              <td>Rp. <?=number_format($data->harga, 0, ".", ".")?>,00</td>
              <td>{{$data->stok}}</td>
              <td>{{$data->sold}}</td>
              <td><img style="border-radius: 0%" height="70" id="ImageTampil" src="{{asset('public/uploads/produk_koperasi/'.$data->foto)}}"  data-toggle="modal" data-target="#myModal"></img></td>
              <td>

                <a href="{{route('admin_kelola_detail_koperasi',$data->id)}}"><button class="btn btn-info btn-sm">Detail</button></a>
                <!-- <a href="{{route('produk_koperasi_edit',$data->id)}}"><button class="btn btn-primary btn-sm">Edit</button></a> -->
                <button class="btn btn-warning btn-sm edit" title="Ubah Stok"><i class="fas fa-pen"></i> Ubah Stok</button>

               <!--  <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                  <button class="btn btn-danger btn-sm"  title="Hapus">Hapus</button> -->

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






<!-- Modal Update -->
      <div id="updateInformasi" class="modal fade" role="dialog">
        <div class="modal-dialog">
         <!--Modal content-->
         <form action="" id="updateInformasiform" method="post" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Anda yakin ingin mengubah stok produk ini ?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{ csrf_field() }}
              {{ method_field('POST') }}

              <div class="form-group">
                <label for="stok">Stok produk</label>
                <input type="number" class="form-control" id="stok_update" name="stok" required="" ></input>
            </div>

            </div> 
            <div class="modal-footer">
              <button type="submit"  class="btn btn-primary float-right mr-2" >Ubah Stok</button>
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
        $('#stok_update').val(data[5]);
        $('#updateInformasiform').attr('action','admin_kasir_ubah_stok_koperasi/'+ data[9]);
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


