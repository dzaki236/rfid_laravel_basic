<?php

namespace App\Http\Controllers;

use App\Models\Rfid;
use Illuminate\Http\Request;

class RfidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->has('q')) {
            # code...
        return view('rfid', ['rfid' => Rfid::where('code','like','%'.$request->q.'%')->get()]);
        } else {
            # code...
        return view('rfid', ['rfid' => Rfid::latest()->get()]);
        }
        
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
        //
        $this->validate($request, ['code' => 'required|unique:rfid']);
        $data = new Rfid();
        $data->code = $request->code;
        $datas = $data->save();
        if ($datas) {
            # code...
            return redirect(route('rfid.index'))->with('success', 'Code Baru Berhasil Di Tambahkan!');
        } else {
            return redirect(route('rfid.index'))->with('error', 'Code Baru Gagal Di Tambahkan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rfid  $rfid
     * @return \Illuminate\Http\Response
     */
    public function show(Rfid $rfid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rfid  $rfid
     * @return \Illuminate\Http\Response
     */
    public function edit(Rfid $rfid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rfid  $rfid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rfid $rfid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rfid  $rfid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rfid $rfid)
    {
        //
        // dd($rfid->all());
        $datas = $rfid->delete();
        if ($datas) {
            # code...
            return redirect(route('rfid.index'))->with('success', 'Code Baru Berhasil Di Hapus!');
        } else {
            return redirect(route('rfid.index'))->with('error', 'Code Baru Gagal Di Hapus!');
        }
    }
}
