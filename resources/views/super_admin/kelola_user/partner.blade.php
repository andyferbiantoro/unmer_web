@extends('layouts.app')

@section('title')
Kelola Partner
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">
              
                <div class="card-body">
                  <h2 class="primary">Partner</h2><hr>

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
                          <th>Nama</th>
                          <th>NIK</th>
                          <th>Jenis Kelamin</th>
                          <th>Alamat</th>
                          <th>Status Partner</th>
                          <th>Saldo</th>

                          <th>Opsi</th>
                          <th style="display: none;">hidden</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $no=1 @endphp
                        @foreach($data_partner as $data)
                        <tr>
                          <td>{{$no++}}</td>
                          <td>{{$data->nama}}</td>
                          <td>{{$data->nik}}</td>
                          @if($data->jenis_kelamin == 'L')
                          <td>Laki-Laki</td>
                          @else
                          <td>Perempuan</td>
                          @endif
                          <td>{{$data->alamat}}</td>
                          @if($data->status_partner == 'non_partner')
                          <td><div class="badge badge-light">Non-Partner</div></td>
                          @else
                          <td><div class="badge badge-primary">Partner</div></td>
                          @endif
                          <td>Rp. <?=number_format($data->saldo, 0, ".", ".")?>,00</td>
                          <td>
                            <a href="{{route('superadmin_detail_partner',$data->id)}}"><button class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i> Detail</button></a>
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


