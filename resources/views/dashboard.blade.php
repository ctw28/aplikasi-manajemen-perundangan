@extends('template')

@section('css')
<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<h1>Selamat Datang di Aplikasi SIPEUMDA</h1>
<div class="top_tiles">
    <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 ">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
            <div class="count">{{$data['totalRancangan']}}</div>
            <h3>Total Rancangan</h3>
        </div>
    </div>
    <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 ">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-comments-o"></i></div>
            <div class="count">{{$data['totalProduk']}}</div>
            <h3>Total Produk Hukum</h3>
        </div>
    </div>
</div>
<div class="col-md-6 col-sm-6  ">
    <div class="x_panel">
        <div class="x_title" style="text-align:center !important">
            <h2>Grafik Rancangan</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <canvas id="rancangan"></canvas>
        </div>
    </div>
</div>
<div class="col-md-6 col-sm-6  ">
    <div class="x_panel">
        <div class="x_title" style="text-align:center !important">
            <h2>Grafik Produk Hukum</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <canvas id="produk_hukum"></canvas>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="../vendors/Chart.js/dist/Chart.min.js"></script>
<script>
var ctx = document.getElementById("rancangan");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Proses", "Selesai"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19],
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1
        }]
    }
});
var ctx2 = document.getElementById("produk_hukum");
var myChart = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: ["Berlaku", "Dicabut"],
        datasets: [{
            label: '# of Votes',
            data: [100, 19],
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1
        }]
    }
});
</script>
@endsection