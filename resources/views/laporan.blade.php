@extends('template')
@section('css')
<!-- bootstrap-wysiwyg -->
<link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
<!-- Select2 -->
<link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
<!-- Switchery -->
<link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
<!-- starrr -->
<link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
<!-- bootstrap-daterangepicker -->
<link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
@endsection

@section('content')
<div class="well" style="overflow: auto">
    <div class="col-md-3">
        Pilih Kabupaten / Kota
        <select name="kabupaten_id" id="kabupaten_id" class="form-control" required>
            <option value="">Pilih Kabupaten / Kota</option>
            @foreach ($data['dataKabupaten'] as $key=>$item)
            <option value="{{$item->id}}">
                {{$item->kabupaten_kode}} -
                {{$item->kabupaten_nama}}
            </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        Pilih Produk Hukum
        <select name="jenis_produk" id="jenis_produk" class="form-control" required>
            <option value="">Pilih Produk Hukum</option>
            @foreach ($data['jenis_produk'] as $key=>$item)
            <option value="{{$item}}">{{$key}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-5">
        Kata kunci judul
        <input type="text" name="judul_peraturan" id="judul_peraturan" class="form-control"
            placeholder="masukkan kata kunci judul (optional)">
    </div>

    <div class="col-md-12" style="margin-top: 10px">
        <button id="lihat_laporan" onclick="lihat_laporan()" class="btn btn-success"><i class="fa fa-search"></i>
            &nbsp Lihat Laporan</button>
    </div>

</div>

<div class="col-md-12 col-sm-12" id="laporan_table" style="display:none">
    <div class="x_panel">
        <div class="x_title">
            <h2>Daftar Produk Hukum</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <button id="cetak_laporan" onclick="cetak()" class="btn btn-info"><i class="fa fa-print"></i> &nbsp Cetak
                Laporan</button>
            <div id="data_laporan" style="color:#000">
                <h4 style="text-align:center">Daftar Produk Hukum</h4>
                <div>
                    <p>
                        Kabupaten : <span id="kab"></span>
                        <br>Produk Hukum : <span id="produk"></span>
                        <br>Kata Kunci : <span id="cari"></span>
                    </p>
                </div>
                <table class="table table-striped jambo_table">

                    <thead>
                        <tr>
                            <th>No </th>
                            <th>No. Peraturan</th>
                            <th>Judul Peraturan </th>
                            <th>Tahun </th>
                            <th>Kabupaten / kota </th>
                            <th>Produk Hukum </th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody id="showData">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('build/html2pdf.min.js')}}"></script>

<script>
const base_url = "{{url('/')}}";

function cetak() {
    // Choose the element that our invoice is rendered in.
    const element = document.getElementById("data_laporan");
    var opt = {
        margin: 0.5,
        filename: 'myfile.pdf',
        image: {
            type: 'png',
            quality: 1
        },
        html2canvas: {
            scale: 1
        },
        jsPDF: {
            unit: 'in',
            format: 'letter',
            orientation: 'portrait'
        }
    };
    // Choose the element and save the PDF for our user.
    html2pdf()
        .set(opt)
        .set({
            pagebreak: {
                mode: ['avoid-all', 'css', 'legacy']
            }
        })
        .from(element)
        .save();
}
async function lihat_laporan(value) {
    let dataSend = new FormData()
    let tableRow = document.getElementById("showData");
    let infoKab = document.getElementById("kab");
    let infoProduk = document.getElementById("produk");
    let infoCari = document.getElementById("cari");
    let selectKab = document.getElementById("kabupaten_id");
    let selectProduk = document.getElementById("jenis_produk");
    let selectJudul = document.getElementById("judul_peraturan");
    if (selectKab.value == "") {
        alert('Pilih Kabupaten')
        return
    }
    if (selectProduk.value == "") {
        alert('Pilih Produk Hukum')
        return
    }
    dataSend.append('kabupaten_id', selectKab.value)
    dataSend.append('jenis_produk', selectProduk.value)
    infoKab.innerHTML = selectKab.options[selectKab.selectedIndex].text;
    infoProduk.innerHTML = selectProduk.options[selectProduk.selectedIndex].text;

    if (selectJudul.value != "") {
        dataSend.append('judul_peraturan', selectJudul.value)
        infoCari.innerHTML = selectJudul.value;
    } else {
        infoCari.innerHTML = "-";
    }
    let response = await fetch("{{route('produk.show')}}", {
        method: "POST",
        body: dataSend
    });
    let responseMessage = await response.json()


    tableRow.innerHTML = "";
    if (responseMessage.data.length !== 0) {
        responseMessage.data.forEach(function callback(row, index) {
            let no = index + 1;
            tableRow.insertRow().innerHTML = '<tr>' +
                '<td>' + no + '</td>' +
                '<td>' + row.no_perda + '</td>' +
                '<td>' + row.judul_peraturan + '</td>' +
                '<td>' + row.tahun + '</td>' +
                '<td>' + row.kabupaten_id.kabupaten_nama + '</td>' +
                '<td>' + row.jenis_produk + '</td>' +
                '<td>' + row.status + '</td>' +
                '</tr>';
        });
    } else {
        tableRow.insertRow().innerHTML = '<tr>' +
            '<td colspan="7" style="text-align:center">Maaf, Data tidak ditemukan!</td></tr>';
    }
    document.getElementById("laporan_table").style.display = "block"

}
</script>
@endsection