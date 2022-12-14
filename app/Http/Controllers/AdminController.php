<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function index(Request $request){
        $nama = User::where('role_id', 2)->get();
        $this->authorize('admin');
        $tanggal = Carbon::parse($request->created_at)->isoFormat('dddd, D MMM Y');
        $data = Absen::orderBy('created_at', 'desc')->with(['user', 'atm'])->get();
        $nama_lengkap = $request->nama_lengkap;
        $created_at = $request->created_at;
        
        if($request->has('created_at','nama_lengkap')){
            $data = Absen::where('nama_lengkap', '=',$nama_lengkap)->whereDate('created_at', 'like', '%'.$created_at.'%')->with(['user', 'atm'])->get();
        }
        else{
            $data = Absen::orderBy('created_at', 'desc')->with(['user', 'atm'])->get();
        }
        return view('admin.index', ['datas' => $data,'nama'=> $nama,'tanggal'=> $tanggal]);
    }

     public function showimage($id){
        $foto = Absen::find($id);
        return view('admin.index', ['foto' => $foto]);
    }

    //MASIH ERROR
    public function ubahstatus($id){
        $data = Absen::where('id', $id);
        if($data->where('kondisi_mesin', '=' ,'Menunggu Tindakan')){
            $data->update([
                'kondisi_mesin' => 'Selesai'
            ]);
        }
        $data->update([
                'kondisi_mesin' => 'Menunggu Tindakan'
        ]);
        return redirect()->route('admin')->with('success','Kondisi mesin berhasil diubah');
    }

    public function showProgress(Request $request){
        if($request->has('created_at')){
            $tanggal = Carbon::parse($request->created_at)->isoFormat('dddd, D MMM Y');
            $ilhan = Absen::where('user_id','=',3)->whereDate('created_at', 'LIKE', $request->created_at)->orderBy('created_at', 'desc')->count();
            $darmawan = Absen::where('user_id','=',4)->whereDate('created_at', 'LIKE', $request->created_at)->orderBy('created_at', 'desc')->count();
        }else{
            $tanggal = Carbon::parse($request->created_at)->isoFormat('dddd, D MMM Y');
            $ilhan = Absen::where('user_id','=',3)->whereDate('created_at', '=', Carbon::today()->toDateString())->orderBy('created_at', 'desc')->count();
            $darmawan = Absen::where('user_id','=',4)->whereDate('created_at', '=', Carbon::today()->toDateString())->orderBy('created_at', 'desc')->count();
        }
        return view('admin.progress',compact('darmawan','ilhan','tanggal'));
    }

    public function findProgres(Request $request){
        $progres = $request->created_at;
        $darmawan = Absen::where('user_id','=',3)->whereDate('created_at', 'LIKE', '%'.$progres.'%')->orderBy('created_at', 'desc')->count();
        $ilhan = Absen::where('user_id','=',4)->whereDate('created_at', 'LIKE', '%'.$progres.'%')->orderBy('created_at', 'desc')->count();
        dd($ilhan, $darmawan);
        return redirect()->route('admin.findprogres',['darmawan'=>$darmawan,'ilhan'=>$ilhan]);
    }

    public function updatestatus(Request $request, $id){

        // $data = Absen::find($id);
        // $data->kondisi_mesin = $request->kondisi_mesin;
        $validasi = Validator::make($request->all(), [
            'kondisi_mesin' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {

            $kondisi1 = [
                'kondisi_mesin' => 'Selesai',
            ];

            $kondisi2 = [
                'kondisi_mesin' => 'Menunggu Tindakan',
            ];

            $data = $request->input('kondisi_mesin');

            if($data == 'Menunggu Tindakan') {
                Absen::where('id', $id)->update($kondisi1);
                return response()->json(['success' => "success melakukan update data"]);
            }else if($data == 'Selesai'){
                Absen::where('id', $id)->update($kondisi2);
                return response()->json(['success' => "success melakukan update data"]);
            }else{
                return redirect('admin.index');
            }
        }
    }
}
