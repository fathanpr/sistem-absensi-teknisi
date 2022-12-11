<?php

namespace App\Http\Controllers;

use App\Models\Atm;
use App\Models\User;
use App\Models\Absen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = DB::table('absens')->orderBy('created_at', 'desc')->get();
        // $data = Absen::all();
        // return view('absen.index',[
        //     'absens' => $data
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view('absen.create', [
                'teknisis' => User::all(),
                'atms' => Atm::all(),
                'absens' => Absen::with('atm')->orderBy('created_at', 'desc')->get(),
                'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            ]);
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
            // 'nip_teknisi' => 'required|numeric',
            // 'nama_teknisi' => 'required|max:255',
            'user_id' => 'required',
            'atm_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            // 'nama_atm' => 'required',
            'kondisi_mesin' => 'required',
            'keterangan' => 'required',
            'foto' =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('foto')){
            $slug = Str::slug('teknisia' . '-' . $request->created_at);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $fileName = $slug . '-' . time() . '.' . $extension;
            $request->file('foto')->storeAs('public/uploads', $fileName);
        }

        $absen = new Absen;
        // $absen->nip_teknisi = $request->input('nip_teknisi');
        // $absen->nama_teknisi = $request->input('nama_teknisi');
        $absen->user_id = $request->input('user_id');
        $absen->atm_id = $request->input('atm_id');
        $absen->latitude = $request->input('latitude');
        $absen->longitude = $request->input('longitude');
        // $absen->nama_atm = $request->input('nama_atm');
        $absen->kondisi_mesin = $request->input('kondisi_mesin');
        $absen->keterangan = $request->input('keterangan');
        $absen->foto = $fileName;
        $absen->save();

        Alert::success('success',"Data {$request['nama_karyawan']} berhasil ditambahkan!");
        return redirect()->route('absen.create');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function show(Absen $absen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Absen::find($id);
        return view('absen.edit', [
            'absen' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $absen = Absen::find($id);
        $absen->nip_karyawan = $request->input('nip_karyawan');
        $absen->nama_karyawan = $request->input('nama_karyawan');
        $absen->latitude = $request->input('latitude');
        $absen->longitude = $request->input('longitude');
        $absen->kode_mesin = $request->input('kode_mesin');
        $absen->kondisi_mesin = $request->input('kondisi_mesin');
        

        if($request->hasFile('foto')){

            $destination = 'public/uploads/'. $request->gambar;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $slug = Str::slug($request['nama_karyawan']);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $fileName = $slug . '-' . time() . '.' . $extension;
            $request->file('foto')->storeAs('public/uploads', $fileName);
            $absen->foto = $fileName;
        }

        $absen->update();

        return redirect()->route('absen.index')->with('message', "Data {$request['nama_karyawan']} berhasil diubah!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $absen = Absen::find($id);
        if($absen->foto){
            Storage::delete($absen->foto);
        }
        $absen->delete();
        return redirect()->route('absen.index')->with('message', "Data $absen->nama_karyawan berhasil dihapus!");
    }
}
