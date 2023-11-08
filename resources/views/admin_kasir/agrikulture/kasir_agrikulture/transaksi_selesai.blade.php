@extends('layouts.app')

@section('title')
Detail Transaksi Offline
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body" id="invoice" >
     <div class="text-center" >
      <h1>Transaksi </h1><br>

      <h5>Tanggal Transaksi : {{date("j F Y", strtotime($transaksi_offline->created_at))}}</h5><br>
      <div class="table-responsive">
        <table  class="table table-striped" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Produk</th>
              <th>Harga Satuan</th>
              <th>Jumlah Produk</th>
              <th>Total Harga</th>
            </tr>
          </thead>
          <tbody>
            @php $no=1 @endphp
            @foreach($detail_transaksi as $data)
            <tr>
              <td>{{$no++}}</td>
              <td>{{$data->nama_produk}}</td>
              <td>Rp. <?=number_format($data->harga_produk, 0, ".", ".")?>,00</td>
              <td>{{$data->kuantitas}}</td>
              <td>Rp. <?=number_format($data->total_harga, 0, ".", ".")?>,00</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
    <hr>
    <div class="row">
      <div class="col-lg-6"></div>
      <div class="col-lg-6">

        <table class="table table-hover">
         <tr>
          <th>Total Belanjaan</th>
          <th>:</th>
          <td>Rp. <?=number_format($transaksi_offline->nominal_barang, 0, ".", ".")?>,00</td>
        </tr>   

        <tr>
          <th>Nominal Bayar</th>
          <th>:</th>
          <td>Rp. <?=number_format($transaksi_offline->nominal_bayar, 0, ".", ".")?>,00</td>
        </tr> 

        <tr>
          <th>Kembalian</th>
          <th>:</th>
          <td>Rp. <?=number_format($transaksi_offline->nominal_kembalian, 0, ".", ".")?>,00</td>
        </tr>  
      </table>
      <div class="text-right">

        <!-- <button id="printButton" type="button" class="btn btn-warning "><i class="fas fa-print"></i> Cetak Invoicedd</button> -->
        <button id="printButton">Cetak PDF</button>

      </div>

    </div>

  </div>

</div>
</div>
</div>
</div>


@endsection
@section('scripts')
<script>
  document.getElementById('printButton').addEventListener('click', function () {
    var doc = new jsPDF();

    // Mengambil seluruh konten halaman invoice dengan ID 'invoice'
    var invoiceContent = document.getElementById('invoice').innerHTML;

    doc.fromHTML(invoiceContent, 15, 15);

    // Simpan PDF dengan nama tertentu atau sesuaikan sesuai kebutuhan Anda.
    doc.save('invoice.pdf');
  });
</script>
@endsection





