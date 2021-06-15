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
            <button id="cetak_laporan" class="btn btn-info"><i class="fa fa-print"></i> &nbsp Cetak Laporan</button>
            <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                    <thead>
                        <tr class="headings">
                            <th class="column-title">No </th>
                            <th class="column-title">No. Peraturan</th>
                            <th class="column-title">Judul Peraturan </th>
                            <th class="column-title">Tahun </th>
                            <th class="column-title">Kabupaten / kota </th>
                            <th class="column-title">Produk Hukum </th>
                            <th class="column-title">Status</th>
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
<script>
const base_url = "{{url('/')}}";

async function lihat_laporan(value) {
    let dataSend = new FormData()
    dataSend.append('kabupaten_id', document.getElementById("kabupaten_id").value)
    dataSend.append('jenis_produk', document.getElementById("jenis_produk").value)
    if (document.getElementById("judul_peraturan").value != "")
        dataSend.append('judul_peraturan', document.getElementById("judul_peraturan").value)

    let response = await fetch("{{route('produk.show')}}", {
        method: "POST",
        body: dataSend
    });
    let responseMessage = await response.json()
    // console.log(responseMessage.data)
    let tableRow = document.getElementById("showData");
    tableRow.innerHTML = "";
    if (responseMessage.data.length !== 0) {
        responseMessage.data.forEach(row => {
            tableRow.insertRow().innerHTML = '<tr>' +
                '<td>1</td>' +
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