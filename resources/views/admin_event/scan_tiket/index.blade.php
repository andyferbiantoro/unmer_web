 @extends('layouts.app')

 @section('title')
 Scan Tiket
 @endsection


 @section('content')

 <div class="row">
   <div class="col-lg-12">
    <div class="card">

      <div class="card-body">
        <h2 class="primary">Scan Tiket Event</h2>
        <hr>
        <br>
        <div class="row">
          <div class="col-lg-6">
            <div id="reader" width="500px"></div>
          </div> 
        </div><br>

        @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
        @endif
        <div class="text-center" >

          <div class="col-lg-10">
            <form action="{{route('admin_scan_tiket_event')}}" method="GET">
              <div class="row">
                <div class="col-lg-3">
                  <div class="form-row">
                    <input type="text" class="form-control" id="kode_produk_form" name="kode_transaksi" placeholder="Kode Transaksi .." value="{{ old('kode_transaksi') }}">
                  </div>
                </div>

                <div class="col-lg-2">

                  <button class="btn btn-info" type="Submit"><i class="fas fa-search"></i> Cek Tiket</button><br><br>
                </div>


              </div> 

            </form><br>
          </div>
          <div class="table-responsive">
            @foreach($cari_tiket as $data)
            <form method="post" action="{{route('admin_update_status_tiket_event',$data->id)}}" enctype="multipart/form-data">

              {{csrf_field()}}
              <div class="row">
                <div class="col-lg-6">

                  <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label">Nama Event</label>
                    <div class="col-sm-8">
                     <input type="text" class="form-control" id="judul_event" name="judul_event" readonly="" value="{{$data->judul_event}}"  required=""></input>
                   </div>
                 </div> 

                 <div class="form-group row">
                  <label for="email" class="col-sm-4 col-form-label">Nama Customer</label>
                  <div class="col-sm-8">
                   <input type="text" class="form-control" id="nama" name="nama" readonly="" value="{{$data->nama}}"  required=""></input>
                 </div>
               </div>

               <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Tiket</label>
                <div class="col-sm-8">
                 <input type="text" class="form-control" id="judul" name="judul" readonly="" value="{{$data->judul}}"  required=""></input>
               </div>
             </div>

             <div class="form-group row">
              <label for="email" class="col-sm-4 col-form-label">Harga Tiket</label>
              <div class="col-sm-8">
               <input type="text" class="form-control" id="harga" name="harga" readonly="" value="{{$data->harga}}"  required=""></input>
             </div>
           </div>

           <div class="form-group row">
            <label for="email" class="col-sm-4 col-form-label">Kode Tiket</label>
            <div class="col-sm-8">
             <input type="text" class="form-control" id="kode_tiket" name="kode_tiket" readonly="" value="{{$data->kode_tiket}}"  required=""></input>
           </div>
         </div>

         <div class="form-group row">
          <label for="email" class="col-sm-4 col-form-label">Kode Transaksi</label>
          <div class="col-sm-8">
           <input type="text" class="form-control" id="kode_transaksi" name="kode_transaksi" readonly="" value="{{$data->kode_transaksi}}"  required=""></input>
         </div>
       </div>

       @if($data->status == 'valid')
       <div class="alert alert-success">
        Status Tiket <b>VALID </b> 
      </div>
      @else
      <div class="alert alert-danger">
        Status Tiket <b>PENDING </b>
      </div>
      @endif

      <button class="btn btn-primary" style="width: 100%" type="Submit"><i class="fas fa-check"></i> Konfirmasi Tiket Event</button><br><br>
    </div>
  </div>

</form>
@endforeach
</div>
</div>

<!--  <button class="btn btn-success fas fa-plus fa-2a"></button> -->
</div>
</div>





<!-- Modal Update -->
<div id="updateInformasi" class="modal fade" role="dialog">
  <div class="modal-dialog">
   <!--Modal content-->
   <form action="" id="updateInformasiform" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Anda yakin ingin mengubah pesanan ini ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ csrf_field() }}
        {{ method_field('POST') }}

        <div class="form-group">
          <label for="kuantitas">Jumlah Produk</label>
          <input type="number" class="form-control" id="kuantitas_update" name="kuantitas" required="" ></input>
        </div>

      </div> 
      <div class="modal-footer">
        <button type="submit"  class="btn btn-primary float-right mr-2" >Edit</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Batalkan Produk?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="deleteForm" method="post">

          {{ csrf_field() }}
          {{ method_field('POST') }}
          <p>Apakah anda yakin ingin batalkan produk ini ?</p> 
          <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Batalkan</button>

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
    var url = '{{route("kasir_batalkan_produk", ":id") }}';
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
      $('#kuantitas_update').val(data[2]);
      $('#updateInformasiform').attr('action','kasir_edit_produk/'+ data[5]);
      $('#updateInformasi').modal('show');
    });
  });
</script>


<script>
  function hitungKembalian() {
    var belanjaan = document.getElementById("nominal_barang").value;
    var bayar = document.getElementById("nominal_bayar").value;
    var kembalian = bayar - belanjaan;

            // Pastikan kembalian tidak negatif
            if (kembalian >= 0) {
              document.getElementById("nominal_kembalian").value = kembalian;
              document.getElementById("hitung").style.display = "none";
              document.getElementById("proses_pembelian").style.display = "block";
            } else {
              alert("Nominal bayar tidak mencukupi.");
              document.getElementById("bayar").value = "";
              document.getElementById("kembalian").value = "";
            }
          }
        </script>

        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
        <script type="text/javascript">

          function onScanSuccess(decodedText, decodedResult) {
          // handle the scanned code as you like, for example:
          document.getElementById('kode_produk_form').value = decodedText;
        }

        function onScanFailure(error) {
          // handle scan failure, usually better to ignore and keep scanning.
          // for example:
          // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
          "reader",
          { fps: 10, qrbox: {width: 250, height: 250} },
          /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
      </script>

      @endsection



