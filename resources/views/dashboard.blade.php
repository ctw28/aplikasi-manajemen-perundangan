@extends('template')

@section('css')
<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<h1>Selamat Datang di Aplikasi SIPEUMDA <br>Biro Hukum Provinsi Sulawesi Tenggara</h1>
<div class="top_tiles" style="margin-top:30px">
    <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 ">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-edit"></i></div>
            <div class="count">{{$data['totalRancangan']}}</div>
            <h3>Total Rancangan Produk Hukum</h3>
        </div>
    </div>
    <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 ">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-file-archive-o"></i></div>
            <div class="count">{{$data['totalProduk']}}</div>
            <h3>Total Produk Hukum</h3>
        </div>
    </div>
</div>
<!-- <div class="col-md-4 col-sm-4">
    <div class="x_panel">
        <div class="x_title" style="text-align:center !important">
            <h2>Grafik Rancangan Produk Hukum</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <canvas id="rancangan"></canvas>
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-4">
    <div class="x_panel">
        <div class="x_title" style="text-align:center !important">
            <h2>Grafik Produk Hukum</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <canvas id="produk_hukum"></canvas>
        </div>
    </div>
</div> -->
<!-- start project-detail sidebar -->
<div class="col-md-12 col-sm-12" style="margin-top:30px">

    <section class="panel">

        <div class="x_title">
            <h2>Informasi Aplikasi</h2>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <h3 class="green"><i class="fa fa-info-circle "></i> Sipeumda</h3>

            <p>Sipeumda (Sistem Pengarsipan Produk Hukum Daerah) Adalah Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Ullam est quos, voluptate amet hic voluptatum autem sequi dolore, a provident atque
                eligendi, tempora recusandae corporis dolorem optio! Accusantium, repellendus laboriosam.
            <p>
                <br />

            <div class="project_detail">

                <p class="title">Nama Kantor</p>
                <p>Biro Hukum Sekretariat Provinsi Sulawesi Tenggara</p>
                <p class="title">Alamat</p>
                <p>Komp. Bumi Praja Andonohu Kota Kendari Sultra, Andonohu, Poasia, Kota Kendari, Provinsi Sulawesi
                    Tenggara (93231)</p>
            </div>
            <br />
            <ul class="list-unstyled project_files">
                <li><a href=""><i class="fa fa-phone"></i> 0401 - 391617, 391609</a>
                </li>
                <li><a href=""><i class="fa fa-envelope"></i> support@sultraprov.go.id</a>
                </li>

            </ul>
        </div>

    </section>

</div>
<!-- end project-detail sidebar -->
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