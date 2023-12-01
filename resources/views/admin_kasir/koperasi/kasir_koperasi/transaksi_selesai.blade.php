@extends('layouts.app')

@section('title')
Detail Transaksi Offline
@endsection


@section('content')

<div class="row">
 <div class="col-lg-12">
  <div class="card">

    <div class="card-body">
     <div class="text-center"  id="printPDF" >

      <h1>Transaksi </h1><br>
      <h5>Tanggal Transaksi : {{date("j F Y", strtotime($transaksi_offline->created_at))}}</h5><br>
      <div>
        <table  class="table table-striped" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Produk</th>
              <th>Size</th>
              <th>warna</th>
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
              @if($data->kategori_produk == 'Pakaian')
              <td>{{$data->size}}</td>
              <td>{{$data->warna}}</td>
              @else
              <td>-</td>
              <td>-</td>
              @endif
              <td>Rp. <?=number_format($data->harga, 0, ".", ".")?>,00</td>
              <td>{{$data->kuantitas}}</td>
              <td>Rp. <?=number_format($data->total_harga, 0, ".", ".")?>,00</td>
            </tr>
            @endforeach
          </tbody>
        </table><hr>
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
        </div>
      </div>
    </div>

  </div>
  <hr>
  <!-- button cetak pdf -->
  <div class="row">
    <div class="col-lg-6"></div>
    <div class="col-lg-6">
      <div class="text-right">
        <button class="btn btn-warning" onclick="print('printPDF')"><i class="fas fa-print"></i> Cetak Invoice</button>
      </div>
    </div>
  </div>

</div>
</div>
</div>
</div>


@endsection
@section('scripts')
<script type="text/javascript">
  function print(elem) {
    var mywindow = window.open('', 'PRINT', 'height=1000,width=1200');

    mywindow.document.write('<html><head><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1 class="text-center">' + 'Invoice Agrikulture' + '</h1>');
    mywindow.document.write('<br><br>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');
    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    // mywindow.close();

    return true;

  }
</script>


@endsection





