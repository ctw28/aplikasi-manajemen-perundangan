<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Kabupaten;

class ProdukController extends Controller
{

    private $jenisProduk = array(
        'Peraturan Daerah' => 'daerah',
        'Peraturan Gubernur / Walikota' => 'gubernur'
    );
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Produk::all();
        $data->map(function($data){
            $data['kabupaten_id'] = $data->getKabupatenById;
            $jenisProdukTampil = array_search($data->jenis_produk, $this->jenisProduk);
            $data['jenis_produk'] = $jenisProdukTampil;
            unset($data->getKabupatenById);
            // echo json_encode($jenisProdukTampil);
        });
        return view('produk-data', ['data'=> $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $value = (object) array(
            'no_perda'=>'',
            'judul_peraturan'=>'',
            'tahun'=>'',
            'kabupaten_id'=>'',
            'jenis_produk'=>'',
            'status'=>'',
        );
        $data['jenis_produk'] = $this->jenisProduk;
        $data['dataProduk'] = $value;
        $data['dataKabupaten'] = Kabupaten::all();
        $data['dataAction'] = 'produk.store';
        $data['dataStatus'] = 'Tambah';
        return view('produk-form', ['data'=> $data]);
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
            'no_perda'=>'required',
            'judul_peraturan'=>'required',
            'tahun'=>'required',
            'kabupaten_id'=>'required',
            'jenis_produk'=>'required',
            'status'=>'required',
			'file_produk' => 'required|file|mimes:pdf|max:2048'
		]);

		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file_produk');

		$nama_file = time()."_".$file->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'file-upload';
        $request->file_Produk = $nama_file;
		$file->move($tujuan_upload,$nama_file);
        $data = $request->all();
        $data['file_produk'] = $nama_file;
        Produk::create($data);
        return redirect()->route('produk')->with('message', \GeneralHelper::formatMessage('Berhasil menambahkan data !', 'success'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $Produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $Produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $Produk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $value = Produk::findOrFail($id);
        $data['jenis_produk'] = $this->jenisProduk;
        $data['dataProduk'] = $value;
        $data['dataKabupaten'] = Kabupaten::all();
        $data['dataAction'] = 'produk.update';
        $data['dataStatus'] = 'Edit';
        // echo array_search($value->jenis_produk, $this->jenisProduk);
        return view('produk-form', ['data'=> $data]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $Produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'no_perda'=>'required',
            'judul_peraturan'=>'required',
            'tahun'=>'required',
            'kabupaten_id'=>'required',
            'jenis_produk'=>'required',
            'status'=>'required',
			'file_produk' => 'file|mimes:pdf|max:2048'
		]);
        unset($request['_token']);
        unset($request['_method']);
        $file = $request->file('file_produk');
        $data = $request->all();
        if(!empty($file)){
            // menyimpan data file yang diupload ke variabel $file
    
            $nama_file = time()."_".$file->getClientOriginalName();
    
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'file-upload';
            $request->file_Produk = $nama_file;
            $file->move($tujuan_upload,$nama_file);
            $data['file_produk'] = $nama_file;
        }
        Produk::whereId($id)->update($data);
        return redirect()->route('produk')->with('message', \GeneralHelper::formatMessage('Berhasil Ubah data !', 'success'));

    }

    
    public function destroy($id)
    {
        try {
            $data = Produk::find($id);
            @unlink(public_path('file-upload/'.$data->file_produk));
            $data->delete();
            return redirect()->route('produk')->with('message', \GeneralHelper::formatMessage('Berhasil menghapus!', 'info'));

        } catch (\Illuminate\Database\QueryException $e) {
            // var_dump($e->errorInfo );
            return redirect()->route('produk')->with('message', \GeneralHelper::formatMessage('Data ini masih digunakan oleh data lain!', 'danger'));
        }
    }
}