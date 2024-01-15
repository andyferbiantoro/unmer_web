@extends('layouts.app')

@section('title')
Kelola Foto Event
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h2 class="primary">Foto Event</h2>
      <hr>
       
       <a href="{{route('superadmin_lihat_detail_event',$event->id)}}"><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-long-arrow-alt-left"></i> Kembali</button></a>
      
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambah">
        <i class="fas fa-plus"></i> Tambah Foto Event
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
              <th>Foto Event</th>
              <th>Opsi</th>
              <th style="display: none;">hidden</th>
            </tr>
          </thead>
          <tbody>
            @php $no=1 @endphp
            @foreach($foto_event as $data)
            <tr>
              <td>{{$no++}}</td>
              <td><img style="border-radius: 0%" height="70" id="ImageTampil" src="{{asset('/public/uploads/event/'.$data->foto_event)}}"  data-toggle="modal" data-target="#myModal"></img></td>

              <td>

                <a href="{{route('superadmin_event_delete',$data->id)}}"><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button></a>

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
       <form method="post" action="{{route('superadmin_foto_event_add')}}" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group form-success">


          <div class="form-group">
            <label for="foto_event">Foto Event</label>
            <input type="file" class="form-control" id="foto_event" name="foto_event" required="" ></input>
          </div>

          <div class="form-group">
            <input type="hidden" class="form-control" id="id_event" name="id_event" required="" value="{{$event->id}}" ></input>
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

