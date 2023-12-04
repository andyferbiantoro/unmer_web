@extends('layouts.app')

@section('title')
Kasir Koperasi
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h2 class="primary">Kasir Koperasi </h2>
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
          <form action="{{route('admin_kasir_koperasi')}}" method="GET">
            <div class="row">
              <div class="col-lg-3">
                <div class="form-row">
                  <input type="text" class="form-control" id="kode_produk_form" name="kode_produk" placeholder="Kode Barang .." value="{{ old('kode_produk') }}">
                </div>
              </div>

              <div class="col-lg-2">

                <button class="btn btn-info" type="Submit"><i class="fas fa-search"></i> Cari Barang</button><br><br>
              </div>
            </div> 
          </form><br>
        </div>
        <div class="table-responsive">
          @foreach($cari_produk as $data_add)
         <form method="post" action="{{route('kasir_keranjang_koperasi_add',$data_add->id)}}" enctype="multipart/form-data">
          @endforeach

          {{csrf_field()}}
          <div class="row">
           @foreach($cari_produk as $data)
           <div class="col-lg-6">

            <div class="form-group row">
              <label for="email" class="col-sm-4 col-form-label">Nama Produk</label>
              <div class="col-sm-8">
               <input type="text" class="form-control" id="nama_produk" name="nama_produk" readonly="" value="{{$data->nama_produk}}"  required=""></input>
             </div>
           </div> 

           <div class="form-group row">
            <label for="email" class="col-sm-4 col-form-label">Kategori Produk</label>
            <div class="col-sm-8">
             <input type="text" class="form-control" id="kategori_produk" name="kategori_produk" readonly="" value="{{$data->kategori_produk}}"  required=""></input>
           </div>
         </div>

         <div class="form-group row">
          <label for="total_harga" class="col-sm-4 col-form-label">Harga Produk</label>
          <div class="col-sm-8">
           <input type="text" class="form-control" id="total_harga" name="total_harga" readonly="" value="{{$data->harga}}"  required=""></input>
         </div>
       </div>

       <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">Kode Produk</label>
        <div class="col-sm-8">
         <input type="text" class="form-control" id="kode_produk" name="kode_produk" readonly="" value="{{$data->kode_produk}}"  required=""></input>
       </div>
     </div>

     @if($data->kategori_produk == 'Pakaian')
     <div class="form-group row">
        <label for="size" class="col-sm-4 col-form-label">Size Produk</label>
        <div class="col-sm-8">
         <select  name="size" class="form-control"  required="">
         <option selected disabled> -- Pilih Size -- </option>
         @foreach($size_produk as $size)
         <option value="{{$size->size}}" >{{$size->size}}</option>
         @endforeach
       </select>
       </div>
     </div>

     <div class="form-group row">
        <label for="size" class="col-sm-4 col-form-label">Warna Produk</label>
        <div class="col-sm-8">
         <select  name="warna" class="form-control"  required="">
         <option selected disabled> -- Pilih Warna -- </option>
         @foreach($warna_produk as $warna)
         <option value="{{$warna->warna}}" >{{$warna->warna}}</option>
         @endforeach
       </select>
       </div>
     </div>
     @endif
    


     <button class="btn btn-primary" style="width: 100%" type="Submit"><i class="fas fa-plus"></i> Tambahkan Barang</button><br><br>
   </div>
   @endforeach

 </div>

</form>
</div>
</div>

<!--  <button class="btn btn-success fas fa-plus fa-2a"></button> -->
</div>
</div>


<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="text-center" >
          <div class="table-responsive">
            <table id="dataTable" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Produk</th>
                  <th>Jumlah Produk</th>
                  <th>Kategori Produk</th>                 
                  <th>Size</th>
                  <th>Warna</th>
                  <th>Total Harga</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                @php $no=1 @endphp
                @foreach($keranjang_koperasi_offline as $data)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$data->nama_produk}}</td>
                  <td>{{$data->kuantitas}}</td>
                  <td>{{$data->kategori_produk}}</td>
                  @if($data->kategori_produk == 'Pakaian')
                  <td>{{$data->size}}</td>
                  <td>{{$data->warna}}</td>
                  @else
                  <td>-</td>
                  <td>-</td>
                  @endif
                  <td>Rp. <?=number_format($data->total_harga, 0, ".", ".")?>,00</td>
                  <td>
                    <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                      <button class="btn btn-danger btn-sm"  title="Hapus">Batal</button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div><hr>
          <div class="table-responsive">

            <form method="post" action="{{route('kasir_transaksi_offline_koperasi_add')}}" enctype="multipart/form-data">

              {{csrf_field()}}
              <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Total Belanja</label>
                    <div class="col-sm-8">
                     <input type="number" class="form-control" id="nominal_barang" name="nominal_barang" readonly="" required="" value="{{$total_belanja}}"></input>
                   </div>
                 </div> 

                 <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nominal Bayar</label>
                  <div class="col-sm-8">
                   <input type="number" class="form-control" id="nominal_bayar" name="nominal_bayar"  required=""></input>
                 </div>
               </div>   

               <button class="btn btn-dark" id="hitung" style="width: 100%" type="button" onclick="hitungKembalian()"><i class="fas fa-calculator"></i> Hitung Kambalian</button><br><br>

               <div class="form-group row">
                <label class="col-sm-4 col-form-label">Kembalian</label>
                <div class="col-sm-8">
                 <input type="number" class="form-control" id="nominal_kembalian" name="nominal_kembalian"  required=""></input>
               </div>
             </div> 


             <button  class="btn btn-primary" id="proses_pembelian" style="width: 100%; display: none" type="Submit"><i class="fas fa-check"></i> Proses Pembelian</button><br><br>
           </div>
         </div>
       </form>

         <!-- <div class="row">
          <div class="col-lg-6"></div>
          <div class="col-lg-6">
           <button class="btn btn-warning" style="width: 100%" type="Submit"><i class="fas fa-print"></i> Cetak Invoice</button><br><br>
         </div>
       </div> -->

     </div>
   </div>
 </div>
</div>  
</div>

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
    var url = '{{route("kasir_batalkan_produk_koperasi", ":id") }}';
    url = url.replace(':id', id);
    $("#deleteForm").attr('action', url);
  }

  function formSubmit() {
    $("#deleteForm").submit();
  }
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



