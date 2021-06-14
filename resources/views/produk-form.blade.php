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
<div class="title_left">
    <h3>{{$data['dataStatus']}} Produk Hukum</h3>
</div>
<br />

<form @if ($data['dataStatus']=='Tambah' ) action="{{route($data['dataAction'])}}" @else
    action="{{route($data['dataAction'], $data['dataProduk']->id)}}" @endif method="POST" enctype="multipart/form-data" id="demo-form2"
    data-parsley-validate class="form-horizontal form-label-left">
    {{ csrf_field() }}
    @if ($data['dataStatus']=='Edit' )
    <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="item form-group">
        <label class="col-form-label col-md-2 col-sm-2 label-align" for="no_perda">No.
            Perda <span class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 ">
            <input type="text" name="no_perda" id="no_perda" required="required" class="form-control" value="{{$data['dataProduk']->no_perda}}">
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-2 col-sm-2 label-align" for="judul_peraturan">Judul Peraturan <span
                class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 ">
            <input type="text" name="judul_peraturan" id="judul_peraturan" required="required" class="form-control" value="{{$data['dataProduk']->judul_peraturan}}">
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-2 col-sm-2 label-align" for="tahun">Tahun
            <span class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 ">
            <input type="text" name="tahun" id="tahun" required="required" class="form-control" value="{{$data['dataProduk']->tahun}}">
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-2 col-sm-2 label-align" for="kabupaten">Kabupaten
            <span class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 ">
            <select name="kabupaten_id" id="kabupaten_id" class="form-control" required>
                <option value="">Pilih Kabupaten</option>
                @foreach ($data['dataKabupaten'] as $key=>$item)
                <option value="{{$item->id}}" {{ ($item->id == $data['dataProduk']->kabupaten_id)? 'selected': '' }}>{{$item->kabupaten_kode}} -
                    {{$item->kabupaten_nama}}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-2 col-sm-2 label-align" for="jenis_produk">Jenis Produk <span
                class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 ">
            <select name="jenis_produk" id="jenis_produk" class="form-control" required>
                <option value="">Pilih Jenis Produk</option>
                @foreach ($data['jenis_produk'] as $key=>$item)
                <option value="{{$item}}" {{ ($item == $data['dataProduk']->jenis_produk)? 'selected': '' }}>{{$key}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-2 col-sm-2 label-align" for="status">Status
            <span class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 ">
            <select name="status" id="status" class="form-control" required>
                <option value="">Pilih Status</option>
                <option value="berlaku" {{ ($data['dataProduk']->status == "berlaku")? 'selected': '' }}>Berlaku</option>
                <option value="dicabut" {{ ($data['dataProduk']->status == "dicabut")? 'selected': '' }}>Dicabut</option>
            </select>
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-2 col-sm-2 label-align" for="file_produk">File
            Produk (.pdf) <span class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 ">
            <input type="file" name="file_produk" id="file_produk" class="form-control" {{ ($data['dataStatus'] == 'Tambah')? 'required': '' }}>
        </div>
    </div>
    <div class="ln_solid"></div>
    <div class="item form-group">
        <div class="col-md-12 col-sm-12 offset-md-2">
            <input type="submit" class="btn btn-success" value="{{$data['dataStatus']}}">
        </div>
    </div>
</form>
@endsection

@section('js')
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-wysiwyg -->
<script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="../vendors/google-code-prettify/src/prettify.js"></script>
<!-- jQuery Tags Input -->
<script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Switchery -->
<script src="../vendors/switchery/dist/switchery.min.js"></script>
<!-- Select2 -->
<script src="../vendors/select2/dist/js/select2.full.min.js"></script>
<!-- Parsley -->
<script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
<!-- Autosize -->
<script src="../vendors/autosize/dist/autosize.min.js"></script>
<!-- jQuery autocomplete -->
<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<!-- starrr -->
<script src="../vendors/starrr/dist/starrr.js"></script>
@endsection