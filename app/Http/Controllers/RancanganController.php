<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kabupaten;
use App\Models\Rancangan;

class RancanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Rancangan::all();
        $data->map(function($data){
            $data['kabupaten_id'] = $data->getKabupatenById;
            unset($data->getKabupatenById);
        });
        // echo json_encode($data);
        return view('rancangan-data', ['data'=> $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $data = Kabupaten::all();
        $value = (object) array(
            'no_registrasi'=>"",
            'tgl_input'=>"",
            'tgl_rancangan'=>"",
            'no_surat'=>"",
            'kabupaten_id'=>"",
            'perihal'=>"",
            'status'=>"proses",
            'keterangan'=>"",
            'file_rancangan'=>""
        );
        $data['dataRancangan'] = $value;
        $data['dataKabupaten'] = Kabupaten::all();
        $data['dataAction'] = 'rancangan.store';
        $data['dataStatus'] = 'Tambah';

        return view('rancangan-form', ['data'=> $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'no_registrasi' => 'required',
			'tgl_input' => 'required',
			'tgl_rancangan' => 'required',
			'no_surat' => 'required',
			'kabupaten_id' => 'required',
			'perihal' => 'required',
			'keterangan' => 'required',
			'status' => 'required',
			'file_rancangan' => 'required|file|mimes:pdf|max:2048'
		]);

		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file_rancangan');

		$nama_file = time()."_".$file->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'file-upload';
        $request->file_rancangan = $nama_file;
		$file->move($tujuan_upload,$nama_file);
        $data = $request->all();
        $data['file_rancangan'] = $nama_file;
        Rancangan::create($data);
        return redirect()->route('rancangan')->with('message', \GeneralHelper::formatMessage('Berhasil menambahkan data !', 'success'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rancangan  $rancangan
     * @return \Illuminate\Http\Response
     */
    public function show(Rancangan $rancangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rancangan  $rancangan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['dataRancangan'] = Rancangan::findOrFail($id);
        $data['dataKabupaten'] = Kabupaten::all();
        $data['dataAction'] = 'rancangan.update';
        $data['dataStatus'] = 'Edit';
        $data['parameter'] = ',$data->id';

        return view("rancangan-form",[
            'data'  =>  $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rancangan  $rancangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
			'no_registrasi' => 'required',
			'tgl_input' => 'required',
			'tgl_rancangan' => 'required',
			'no_surat' => 'required',
			'kabupaten_id' => 'required',
			'perihal' => 'required',
			'keterangan' => 'required',
			'status' => 'required',
			'file_rancangan' => 'file|mimes:pdf|max:2048'
		]);
        unset($request['_token']);
        unset($request['_method']);
        // menyimpan data file yang diupload ke variabel $file

		$file = $request->file('file_rancangan');
        $data = $request->all();

        if(!empty($file)){
            $nama_file = time()."_".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'file-upload';
            $request->file_rancangan = $nama_file;
            $file->move($tujuan_upload,$nama_file);
            $data['file_rancangan'] = $nama_file;
        }

        Rancangan::whereId($id)->update($data);

        return redirect()->route('rancangan')->with('message', \GeneralHelper::formatMessage('Berhasil ubah data !', 'success'));
    }

    
    public function destroy($id)
    {
        try {
            $data = Rancangan::find($id);
            @unlink(public_path('file-upload/'.$data->file_rancangan));
            $data->delete();
            return redirect()->route('rancangan')->with('message', \GeneralHelper::formatMessage('Berhasil menghapus!', 'info'));

        } catch (\Illuminate\Database\QueryException $e) {
            // var_dump($e->errorInfo );
            return redirect()->route('rancangan')->with('message', \GeneralHelper::formatMessage('Data ini masih digunakan oleh data lain!', 'danger'));
        }
    }
}