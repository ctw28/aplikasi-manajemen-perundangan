<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kabupaten;
use App\Models\Produk;

class LaporanController extends Controller
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
        $data['dataKabupaten'] = Kabupaten::all();
        $data['jenis_produk'] = $this->jenisProduk;
        return view('laporan', ['data'=> $data]);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(Request $request)
    {
        $where = array(
            'kabupaten_id' => $request->kabupaten_id,
            'jenis_produk' => $request->jenis_produk,
        );
        if(!empty($request->judul_peraturan)){
            $results = Produk::where($where)->where('judul_peraturan','LIKE',"%{$request->judul_peraturan}%")->get();
            
        }
        else{
            $results = Produk::where($where)->get();
        }
        $results->map(function($results){
            $results['kabupaten_id'] = $results->getKabupatenById;
            $jenisProdukTampil = array_search($results->jenis_produk, $this->jenisProduk);
            $results['jenis_produk'] = $jenisProdukTampil;
            unset($results->getKabupatenById);
            // echo json_encode($jenisProdukTampil);
        });
        return response()->json(['data'=>$results]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
    }

    
    public function destroy($id)
    {

    }
}