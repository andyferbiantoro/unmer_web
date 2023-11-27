@extends('layouts.app')

@section('title')
Detail Partner
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
       <a href="{{ route('superadmin_kelola_partner') }}"><button type="button" class="btn btn-danger btn-sm">Kembali</button></a><br><br>
      <h2 class="primary">Partner {{$nama_partner->nama}}</h2>
      <h3 class="primary">Saldo Partner : Rp. <?=number_format($nama_partner->saldo, 0, ".", ".")?>,00</h3><hr>

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
              <th>kategori Produk</th>
              <th>Harga</th>
              <th>Deskripsi Produk</th>
              <th>stok</th>
              <th>Terjual</th>
              <th>Foto</th>
              <th style="display: none;">hidden</th>
            </tr>
          </thead>
          <tbody>
            @php $no=1 @endphp
            @foreach($detail_partner as $data)
            <tr>
              <td>{{$no++}}</td>

              <td>{{$data->nama_produk}}</td>
              <td>{{$data->kode_produk}}</td>
              <td>{{$data->kategori_produk}}</td>
              <td>Rp. <?=number_format($data->harga, 0, ".", ".")?>,00</td>
              <td>{{$data->deskripsi_produk}}</td>
              <td>{{$data->stok}} pcs</td>
              <td>{{$data->sold}} pcs</td>
              <td><img style="border-radius: 0%" height="70" id="ImageTampil" src="{{asset('public/uploads/produk_koperasi/'.$data->foto)}}"  data-toggle="modal" data-target="#myModal"></img></td>

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




<!-- Modal -->
<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Jadikan Partner ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="deleteForm" method="post">

          {{ csrf_field() }}
          {{ method_field('POST') }}
          <p>Apakah anda yakin ingin menjadikan partner user ini ?</p> <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
          <button type="submit" name="" class="btn btn-primary float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Konfirmasi</button>

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
    var url = '{{route("superadmin_jadikan_partner", ":id") }}';
    url = url.replace(':id', id);
    $("#deleteForm").attr('action', url);
  }

  function formSubmit() {
    $("#deleteForm").submit();
  }
</script>



@endsection


