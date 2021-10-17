<?php

namespace App\Http\Controllers;

use App\Asisten;
use App\Kelas;
use App\Configuration;
use App\History_Jaga;
use App\Laporan_Praktikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AsistenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'nama'      => 'required|unique:asistens|unique:praktikans|string',
            'kode'      => 'required|unique:asistens|size:3|string',
            'password'  => 'required|min:6|string',
            'role_id'   => 'required|integer',
            'deskripsi' => 'required|min:10|string',
        ]);

        if(!Configuration::find(1)->registrationAsisten_activation)
            return '{"message": "Registrasi untuk asisten telah ditutup"}';

        Asisten::create([
            'nama'      => $request->nama,
            'kode'      => strtoupper($request->kode),
            'password'  => Hash::make($request->password),
            'role_id'   => $request->role_id,
            'deskripsi' => $request->deskripsi,
        ]);

        return '{"message": "success"}';
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($asisten_id)
    {
        $allAsistenData = Laporan_Praktikan::where('asisten_id', $asisten_id)->get();
        $allAsistenHistory = History_Jaga::where('asisten_id', $asisten_id)->get();
        
        $ratingAsisten = 0;
        $gajiAsisten = 0;
        foreach ($allAsistenData as $key => $value) {
            $ratingAsisten += $value->rating_asisten;    
        }
        $taxRate=0.1;
        $intHistoryCount = 0;
        $regHistoryCount = 0;
        foreach ($allAsistenHistory as $history => $value)
            if(substr(Kelas::where('hari', $value->hari)->where('shift', $value->shift)->first()->kelas,6) === 'INT')
                $intHistoryCount++;

        $regHistoryCount = count($allAsistenHistory) - $intHistoryCount;

        if(count($allAsistenData) !== 0){

            $ratingAsisten /= count($allAsistenData);
            $gajiAsisten = $regHistoryCount * 25000;
            $gajiAsisten += $intHistoryCount * 62500;
            $gajiAsisten -= ($gajiAsisten * $taxRate);
        }

        return response()->json([
            'message'=> 'success',
            'ratingAsisten' => $ratingAsisten,
            'gajiAsisten' => $gajiAsisten,
            'taxRate' => $taxRate,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asisten  $asisten
     * @return \Illuminate\Http\Response
     */
    public function edit(Asisten $asisten)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asisten  $asisten
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asisten $asisten)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asisten  $asisten
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asisten $asisten)
    {
        //
    }
}
