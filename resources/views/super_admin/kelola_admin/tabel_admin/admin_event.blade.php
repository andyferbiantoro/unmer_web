@extends('layouts.app')

@section('title')
Kelola Admin
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">
              
                <div class="card-body">
                  <h2 class="primary">Admin Event </h2><hr>
                  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambah">
                    Tambah Admin 
                  </button><br><br>

                  <a href="{{ route('superadmin_kelola_admin') }}"><button type="button" class="btn btn-light btn-sm">Tabel Admin Penginapan</button></a>
                  <a href="{{ route('superadmin_admin_kasir') }}"><button type="button" class="btn btn-light btn-sm">Tabel Admin Kasir</button></a>
                  <a href="{{ route('superadmin_admin_pendidikan') }}"><button type="button" class="btn btn-light btn-sm">Tabel Admin Pendidikan</button></a>
                  <a href="{{ route('superadmin_admin_event') }}"><button type="button" class="btn btn-primary btn-sm">Tabel Admin Event</button><br><br></a>


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
                          <th>Tempat Lahir</th>
                          <th>Tanggal Lahir</th>
                          <th>Status</th>
                          <th>Jabatan Admin</th>

                          <th>Opsi</th>
                          <th style="display: none;">hidden</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $no=1 @endphp
                        @foreach($admin as $data)
                        <tr>
                          <td>{{$no++}}</td>
                          <td>{{$data->nama}}</td>
                          <td>{{$data->nik}}</td>
                          <td>{{$data->tempat_lahir}}</td>
                          <td>{{$data->tanggal_lahir}}</td>
                          <td>{{$data->status}}</td>
                          <td>{{$data->role_admin}}</td>
                          <td>
                            <button class="btn btn-warning btn-sm icon-file menu-icon edit" title="Edit">Edit</button>

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
                  <h5 class="modal-title" id="myLargeModalLabel">Tambah Data Admin</h5>
                </div>
                <div class="modal-body">
                 <form method="post" action="{{route('admin_add')}}" enctype="multipart/form-data">

                  {{csrf_field()}}

                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama"  required=""></input>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"  required=""></input>
                  </div>

                   <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" name="password"  required=""></input>
                  </div>
                  
                  <div class="form-group">
                    <label for="nid_unmer">Nid Unmer</label>
                    <input type="number" class="form-control" id="nid_unmer" name="nid_unmer"  required=""></input>
                  </div>

                  <div class="form-group">
                    <label for="no_telp">Nomor Telp</label>
                    <input type="number" class="form-control" id="no_telp" name="no_telp"  required=""></input>
                  </div>

                  <div class="form-group">
                    <label for="number">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik"  required=""></input>
                  </div>

                  <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"  required=""></input>
                  </div>

                  <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"  required=""></input>
                  </div>

                   <div class="form-group">
                    <input type="hidden" class="form-control" id="role_admin" name="role_admin"  required="" value="Admin Event"></input>
                  </div>

                  <div class="form-group">
                    <input type="hidden" class="form-control" id="role" name="role"  required="" value="Admin Event"></input>
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


              <label>Role Admin</label>
              <select type="text" class="form-control" id="id_prodi" name="id_prodi_tujuan" required="">
                @foreach($admin as $data_admin)
                <option value="{{$data_admin->role_admin}}" {{$data_admin->role_admin == $data_admin->role_admin ? "selected" : "" }}>{{$data_admin->role_admin}}</option>
                @endforeach
              </select><br>

              <!--  -->

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
            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Admin ?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" id="deleteForm" method="post">

              {{ csrf_field() }}
              {{ method_field('POST') }}
              <p>Apakah anda yakin ingin menghapus data Admin ini ?</p> <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
              <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Hapus</button>

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
        var url = '{{route("admin_delete", ":id") }}';
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


