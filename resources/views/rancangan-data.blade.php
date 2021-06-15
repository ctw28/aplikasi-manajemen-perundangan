@extends('template')

@section('css')
<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<h1>Daftar Rancangan</h1>
<a href="{{route('rancangan.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp Tambah
    Rancangan</a>
@if(session('message')) {!!session('message')!!} @endif
<table id="datatable" class="table table-striped table-bordered jambo_table" style="width:100%">
    <thead>
        <tr style="text-align:center">
            <th>No</th>
            <th>No. Surat</th>
            <th>Tanggal Penerimaan</th>
            <th>Tanggal Surat</th>
            <th>Kabupaten</th>
            <th>Perihal</th>
            <th>Keterangan</th>
            <th>No. Registasi</th>
            <th>Status</th>
            <th>File</th>
            <th>Aksi</th>
        </tr>
    </thead>


    <tbody>
        @foreach ($data as $key=>$item)
        <tr>
            <td>1</td>
            <td>{{$item->no_surat}}</td>
            <td>{{$item->tgl_penerimaan}}</td>
            <td>{{$item->tgl_surat}}</td>
            <td>{{$item->kabupaten_id->kabupaten_nama}}</td>
            <td>{{$item->perihal}}</td>
            <td>{{$item->keterangan}}</td>
            <td>{{$item->no_registrasi}}</td>
            <td>
                <h6>
                    <span class="badge {{($item->status=='selesai')?'badge-success':'badge-info'}}">
                        {{$item->status}}
                    </span>
                </h6>
            </td>
            <td style="text-align:center">
                @if (empty($item->file_rancangan))
                -
                @else
                <a href="http://127.0.0.1:8000/file-upload/{{$item->file_rancangan}}" target="_blank">
                    Lihat File
                </a>
                @endif
            </td>
            <td>
                <a href="{{route('rancangan.edit',['id' => $item->id])}}" class="btn btn-warning btn-xs">
                    <i class="fa fa-pencil"></i>
                </a>
                <a onclick="return confirm('Yakin hapus data?')" href="
                    {{route('rancangan.destroy',['id' => $item->id])}}" class="btn btn-danger btn-xs">
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

@endsection