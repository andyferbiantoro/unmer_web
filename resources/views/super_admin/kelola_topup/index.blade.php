@extends('layouts.app')

@section('title')
Kelola Transaksi
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h2 class="primary">Transaksi Top Up </h2>
     <hr>
     <br>


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
            <th>Nama Customer</th>
            <th>Metode Pembayaran</th>
            <th>Nominal</th>
            <th>Tanggal Top Up</th>
            <th>Bukti Transfer</th>
            <th>Opsi</th>

            <th style="display: none;">hidden</th>
          </tr>
        </thead>
        <tbody>
          @php $no=1 @endphp
          @foreach($transaksi_topup as $data)
          <tr>
            <td>{{$no++}}</td>
            <td>{{$data->nama}}</td>
            <td>{{$data->metode_pembayaran}}</td>
            <td>{{$data->nominal}}</td>
            <td>{{date("j F Y", strtotime($data->created_at))}}</td>
            <td><img style="border-radius: 0%" height="70" id="ImageTampil" src="{{asset('public/uploads/bukti_transfer_topup/'.$data->bukti_transfer)}}"  data-toggle="modal" data-target="#myModal"></img></td>
            <td>
              @if($data->status_topup == 'pending')
              <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal"><button class="btn btn-primary btn-sm"  title="Hapus">Konfirmasi</button>
                @elseif($data->status_topup == 'dikonfirmasi')  
                <div class="badge badge-success">Dikonfirmasi</div>
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






<!-- Modal -->
<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Top Up</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="deleteForm" method="post">

          {{ csrf_field() }}
          {{ method_field('POST') }}
          <p>Apakah anda yakin ingin mengkonfirmasi top up ini ?</p> <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
          <button type="submit" name="" class="btn btn-primary float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Konfirmasi</button>

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
      var url = '{{route("superadmin_konfirmasi_topup", ":id") }}';
      url = url.replace(':id', id);
      $("#deleteForm").attr('action', url);
    }

    function formSubmit() {
      $("#deleteForm").submit();
    }
  </script>



  @endsection




