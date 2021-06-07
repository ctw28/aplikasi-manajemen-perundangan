<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Kabupaten;

class ProdukController extends Controller
{
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
            unset($data->getKabupatenById);
        });
        // echo json_encode($data);
        return view('produk-data', ['data'=> $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Kabupaten::all();
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
    public function edit(Produk $Produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $Produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $Produk)
    {
        //
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