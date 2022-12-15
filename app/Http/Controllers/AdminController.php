<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
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

    public function ubahstatus($id){
        $data = Absen::where('id', $id)->first();
        $kondisi_sekarang = $data->kondisi_mesin;
        if($kondisi_sekarang == 'Menunggu Tindakan'){
            Absen::where('id',$id)->update([
                'kondisi_mesin' => 'Selesai'
            ]);
        }
        else{
            Absen::where('id',$id)->update([
                'kondisi_mesin' => 'Menunggu Tindakan'
            ]);
        }
        return redirect(URL::previous())->with('success','Kondisi mesin berhasil di update');
    }

    public function showProgress(Request $request){
        if($request->has('created_at')){
            $tanggal = Carbon::parse($request->created_at)->isoFormat('dddd, D MMM Y');
            $iyan = Absen::where('user_id','=',1)->whereDate('created_at', 'LIKE', $request->created_at)->orderBy('created_at', 'desc')->count();
            $lukman = Absen::where('user_id','=',2)->whereDate('created_at', 'LIKE', $request->created_at)->orderBy('created_at', 'desc')->count();
            $kholik = Absen::where('user_id','=',3)->whereDate('created_at', 'LIKE', $request->created_at)->orderBy('created_at', 'desc')->count();
            $masum = Absen::where('user_id','=',4)->whereDate('created_at', 'LIKE', $request->created_at)->orderBy('created_at', 'desc')->count();
        }else{
            $tanggal = Carbon::parse($request->created_at)->isoFormat('dddd, D MMM Y');
            $iyan = Absen::where('user_id','=',1)->whereDate('created_at', '=', Carbon::today()->toDateString())->orderBy('created_at', 'desc')->count();
            $lukman = Absen::where('user_id','=',2)->whereDate('created_at', '=', Carbon::today()->toDateString())->orderBy('created_at', 'desc')->count();
            $kholik = Absen::where('user_id','=',3)->whereDate('created_at', '=', Carbon::today()->toDateString())->orderBy('created_at', 'desc')->count();
            $masum = Absen::where('user_id','=',4)->whereDate('created_at', '=', Carbon::today()->toDateString())->orderBy('created_at', 'desc')->count();
        }
        return view('admin.progress',compact('iyan','lukman','kholik','masum','tanggal'));
    }

    public function findProgres(Request $request){
        $progres = $request->created_at;
        $iyan = Absen::where('user_id','=',1)->whereDate('created_at', 'LIKE', '%'.$progres.'%')->orderBy('created_at', 'desc')->count();
        $lukman = Absen::where('user_id','=',2)->whereDate('created_at', 'LIKE', '%'.$progres.'%')->orderBy('created_at', 'desc')->count();
        $kholik = Absen::where('user_id','=',3)->whereDate('created_at', 'LIKE', '%'.$progres.'%')->orderBy('created_at', 'desc')->count();
        $masum = Absen::where('user_id','=',4)->whereDate('created_at', 'LIKE', '%'.$progres.'%')->orderBy('created_at', 'desc')->count();
        return redirect()->route('admin.findprogres',['iyan'=>$iyan,'lukman'=>$lukman,'kholik'=>$kholik,'masum'=>$masum]);
    }

    // public function updatestatus(Request $request, $id){

    //     // $data = Absen::find($id);
    //     // $data->kondisi_mesin = $request->kondisi_mesin;
    //     $validasi = Validator::make($request->all(), [
    //         'kondisi_mesin' => 'required',
    //     ]);

    //     if ($validasi->fails()) {
    //         return response()->json(['errors' => $validasi->errors()]);
    //     } else {

    //         $kondisi1 = [
    //             'kondisi_mesin' => 'Selesai',
    //         ];

    //         $kondisi2 = [
    //             'kondisi_mesin' => 'Menunggu Tindakan',
    //         ];

    //         $data = $request->input('kondisi_mesin');

    //         if($data == 'Menunggu Tindakan') {
    //             Absen::where('id', $id)->update($kondisi1);
    //             return response()->json(['success' => "success melakukan update data"]);
    //         }else if($data == 'Selesai'){
    //             Absen::where('id', $id)->update($kondisi2);
    //             return response()->json(['success' => "success melakukan update data"]);
    //         }else{
    //             return redirect('admin.index');
    //         }
    //     }
    // }
}
