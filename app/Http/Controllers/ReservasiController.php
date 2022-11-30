<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservasi = Reservasi::all();
        return $reservasi;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = Reservasi::create([
            "username" => $request->username,
            "email" => $request->email,
            "telepon" => $request->telepon,
            "tipe" => $request->tipe,
            "jumlah_pesan" => $request->jumlah_pesan,
            "check_in" => $request->check_in,
            "check_out" => $request->check_out,
            "to_harga" => $request->to_harga,
        ]);

        return response()->json([
            'success' => 201,
            'message' => 'Pesanan Berhasil Ditambahkan!',
            'data' => $table
        ], 201);
    }

    public function show($id)
    {
        $reservasi = Reservasi::find($id);
        if ($reservasi) {
            return response()->json([
                'status' => 200,
                'data' => $reservasi
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'id ' . $id . ' tidak ditemukan'
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reservasi = Reservasi::find($id);
        if($reservasi){
            $reservasi->username = $request->username ? $request->username : $reservasi->username;
            $reservasi->email = $request->email ? $request->email : $reservasi->email;
            $reservasi->telepon = $request->telepon ? $request->telepon : $reservasi->telepon;
            $reservasi->tipe = $request->tipe ? $request->tipe : $reservasi->tipe;
            $reservasi->jumlah_pesan = $request->jumlah_pesan ? $request->jumlah_pesan : $reservasi->jumlah_pesan;
            $reservasi->check_in = $request->check_in ? $request->check_in : $reservasi->check_in;
            $reservasi->check_out = $request->check_out ? $request->check_out : $reservasi->check_out;
            $reservasi->to_harga = $request->to_harga ? $request->to_harga : $reservasi->to_harga;
            $reservasi->save();
            return response()->json([
                'status' => 200,
                'data' => $reservasi
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => $id . ' tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservasi = Reservasi::where('id', $id)->first();
        if($reservasi){
            $reservasi->delete();
            return response()->json([
                'status' => 200,
                'data' => $reservasi
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'id' . $id .' tidak ditemukan'
            ], 404);
        }
    }
}