@extends('template')
@section('css')
<!-- bootstrap-wysiwyg -->
<link href="{{URL::asset('/vendors/google-code-prettify/bin/prettify.min.css')}}" rel="stylesheet">
<!-- Select2 -->
<link href="{{URL::asset('/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
<!-- Switchery -->
<link href="{{URL::asset('/vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
<!-- starrr -->
<link href="{{URL::asset('/vendors/starrr/dist/starrr.css')}}" rel="stylesheet">
<!-- bootstrap-daterangepicker -->
<link href="{{URL::asset('/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="title_left">
    <h3>{{$data['dataStatus']}} Rancangan</h3>
</div>
<br />

<form @if ($data['dataStatus']=='Tambah' ) action="{{route($data['dataAction'])}}" @else
    action="{{route($data['dataAction'], $data['dataRancangan']->id)}}" @endif method="POST"
    enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
    {{ csrf_field() }}
    @if ($data['dataStatus']=='Edit' )
    <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="item form-group">
        <label class="col-form-label col-md-2 col-sm-2 label-align" for="no_registrasi">No.
            registrasi <span class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 ">
            <input type="text" name="no_registrasi" id="no_registrasi" required="required" class="form-control "
                value="{{$data['dataRancangan']->no_registrasi}}">
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-2 col-sm-2 label-align" for="tgl_input">Tanggal
            Input <span class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 ">
            <input type="date" name="tgl_input" id="tgl_input" required="required" class="form-control "
                value="{{$data['dataRancangan']->tgl_input}}">
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-2 col-sm-2 label-align" for="tgl_rancangan">Tanggal
            Rancangan <span class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 ">
            <input type="date" name="tgl_rancangan" id="tgl_rancangan" required="required" class="form-control "
                value="{{$data['dataRancangan']->tgl_rancangan}}">
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-2 col-sm-2 label-align" for="no_surat">No. Surat
            <span class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 ">
            <input type="text" name="no_surat" id="no_surat" required="required" class="form-control "
                value="{{$data['dataRancangan']->no_surat}}">
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-2 col-sm-2 label-align" for="kabupaten">Kabupaten
            <span class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 ">
            <select name="kabupaten_id" id="kabupaten_id" class="form-control" required>
                <option>Pilih Kabupaten</option>
                @foreach ($data['dataKabupaten'] as $key=>$item)
                <option value="{{$item->id}}" {{ ($item->id == $data['dataRancangan']->kabupaten_id)? 'selected': '' }}>
                    {{$item->kabupaten_kode}} - {{$item->kabupaten_nama}}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-2 col-sm-2 label-align" for="perihal">Perihal <span
                class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 ">
            <input type="text" name="perihal" id="perihal" required="required" class="form-control "
                value="{{$data['dataRancangan']->perihal}}">
        </div>
    </div>
    <div class="item form-group" style="margin-top:15px !important">
        <label class="col-form-label col-md-2 col-sm-2 label-align" for="status">Status <span
                class="required">*</span></label>
        <div class="col-md-10 col-sm-10" style="margin-top:5px">
            <p>
                <label>
                    <input type="radio" class="flat" name="status" id="status" value="proses" required
                        {{ ($data['dataRancangan']->status == 'proses')? 'checked': '' }} />
                    Proses
                </label>
                <label>
                    &nbsp; &nbsp; &nbsp;
                    <input type="radio" class="flat" name="status" id="status2" value="selesai"
                        {{ ($data['dataRancangan']->status == 'selesai')? 'checked': '' }} /> Selesai
                </label>
            </p>
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-2 col-sm-2 label-align" for="keterangan">Keterangan
            <span class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 ">
            <textarea id="keterangan" class="form-control" name="keterangan" data-parsley-trigger="keyup"
                data-parsley-minlength="3" data-parsley-maxlength="100"
                data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                data-parsley-validation-threshold="10">{{$data['dataRancangan']->keterangan}}</textarea>
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-2 col-sm-2 label-align" for="file_rancangan">File
            Surat (.pdf) <span class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 ">
            <input type="file" name="file_rancangan" id="file_rancangan"
                {{ ($data['dataStatus']=='Tambah') ? 'required': '' }} class="form-control ">
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
<script src="{{URL::asset('/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
<!-- iCheck -->
<script src="{{URL::asset('/vendors/iCheck/icheck.min.js')}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{URL::asset('/vendors/moment/min/moment.min.js')}}"></script>
<script src="{{URL::asset('/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap-wysiwyg -->
<script src="{{URL::asset('/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')}}"></script>
<script src="{{URL::asset('/vendors/jquery.hotkeys/jquery.hotkeys.js')}}"></script>
<script src="{{URL::asset('/vendors/google-code-prettify/src/prettify.js')}}"></script>
<!-- jQuery Tags Input -->
<script src="{{URL::asset('/vendors/jquery.tagsinput/src/jquery.tagsinput.js')}}"></script>
<!-- Switchery -->
<script src="{{URL::asset('/vendors/switchery/dist/switchery.min.js')}}"></script>
<!-- Select2 -->
<script src="{{URL::asset('/vendors/select2/dist/js/select2.full.min.js')}}"></script>
<!-- Parsley -->
<script src="{{URL::asset('/vendors/parsleyjs/dist/parsley.min.js')}}"></script>
<!-- Autosize -->
<script src="{{URL::asset('/vendors/autosize/dist/autosize.min.js')}}"></script>
<!-- jQuery autocomplete -->
<script src="{{URL::asset('/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js')}}"></script>
<!-- starrr -->
<script src="{{URL::asset('/vendors/starrr/dist/starrr.js')}}"></script>
@endsection