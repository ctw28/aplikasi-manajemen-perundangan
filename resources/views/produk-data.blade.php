@extends('template')

@section('css')
<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<h1>Daftar Produk Hukum</h1>
<a href="{{route('produk.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp Tambah Produk Hukum</a>
@if(session('message')) {!!session('message')!!} @endif
<table id="datatable" class="table table-striped table-bordered jambo_table" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>No. Perda</th>
            <th>Tanggal Input</th>
            <th>Tanggal Produk</th>
            <th>Tahun</th>
            <th>Kabupaten</th>
            <th>Jenis Produk</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>


    <tbody>
        @foreach ($data as $key=>$item)
        <tr>
            <td>1</td>
            <td>{{$item->no_perda}}</td>
            <td>{{$item->tgl_input}}</td>
            <td>{{$item->tgl_produk}}</td>
            <td>{{$item->tahun}}</td>
            <td>{{$item->kabupaten_id->kabupaten_nama}}</td>
            <td>{{$item->jenis_produk}}</td>
            <td>{{$item->status}}</td>
            <td>
                <a href="http://127.0.0.1:8000/file-upload/{{$item->file_produk}}" target="_blank"
                    class="btn btn-primary btn-xs">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="{{route('produk.destroy',['id' => $item->id])}}" class="btn btn-danger btn-xs">
                    <i class="fa fa-trash-o"></i>
                </a>
            </td>
        </tr>
        @endforeach


    </tbody>
</table>
@endsection

@section('js')
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

<script>
const base_url = 'http://127.0.0.1:8000/';

function seeFile(id) {
    alert('aaa');
    window.open(base_url + 'file-upload/' + id, 'Buka Berkas', "width=500,height=500");
}
</script>
@endsection