@extends('layouts.app')

@section('title')
Detail Broadcast
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">

      <a href="{{ route('superadmin_kelola_broadcast') }}"><button type="button" class="btn btn-danger btn-sm">Kembali</button></a>
      
      <br><br>
      <h2 class="primary">Detail Broadcast </h2><br>

      @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
      @endif
      <div class="text-left" >

        <div class="form-group">
          <div class="row">
            <div class="col-lg-12 col-sm-12 col-12">
              <div class="form-group">
                <label for="isi_pesan">Isi Pesan</label>
                <textarea type="text" class="form-control" id="isi_pesan" name="isi_pesan" readonly=""  required="" >{{ $pesan->isi_pesan }}</textarea>
              </div><hr>

              
              <div class="table-responsive">
                <table id="dataTable" class="table table-striped" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Penerima</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $no=1 @endphp
                    @foreach($penerima as $data)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$data->nama}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

            </div>

            
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>



@endsection




