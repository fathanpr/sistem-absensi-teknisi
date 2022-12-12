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

        $nama = User::all();
        $this->authorize('admin');
        $data = Absen::orderBy('created_at', 'desc')->with(['user', 'atm'])->get();
        $nama_lengkap = $request->nama_lengkap;
        $created_at = $request->created_at;
        
        if($request->ajax()){
            if($request->has($nama_lengkap,$created_at)){
                $data = Absen::where('nama_lengkap', '=',$nama_lengkap)->whereDate('created_at', 'like', '%'.$created_at.'%')->with(['user', 'atm'])->get();
                $data = Absen::where('nama_lengkap', '=',$nama_lengkap)->whereDate('created_at', 'like', '%'.$created_at.'%')->with(['user', 'atm'])->get();
            }
            else{
                // $data = Absen::where('nama_lengkap', '=',$nama_lengkap)->whereDate('created_at', 'like', '%'.$created_at.'%')->with(['user', 'atm'])->get();
                $data = Absen::orderBy('created_at', 'desc')->with(['user', 'atm'])->get();
            }
            return response()->json($data);
        // }else if($request->has(['nama_lengkap','created_at'])){
        //     $data = Absen::where('id', '=',$request->nama_lengkap)
        // ->whereDate('created_at', '=', '%'.$request->created_at.'%')->with(['user', 'atm'])->get();
    }else{
        $data = Absen::orderBy('created_at', 'desc')->with(['user', 'atm'])->get();
    }
    return view('admin.index', ['datas' => $data,'nama'=> $nama]);
        // return response()->json($data);
        

        // return DataTables::of($data)->addIndexColumn()->addColumn('aksi', function($data){
        //     return view('admin.index')->with('data', $data);
        // })->make(true);
    }

    // public function filter(Request $request){
    //     $this->authorize('admin');
    //     $data = Absen::orderBy('created_at', 'desc')->with(['user', 'atm'])->get();
    //     $data_filter = Absen::where('nama_lengkap', '=','%'.$request->nama_lengkap.'%')
    //     ->whereDate('created_at', '=', $request->created_at)->with(['user', 'atm'])->get();

    //     if($request->has(['nama_lengkap','created_at'])){
    //         $data_filter = Absen::where('nama_lengkap', '=','%'.$request->nama_lengkap.'%')->whereDate('created_at', '=', $request->created_at)->with(['user', 'atm'])->get();
    //     }else{
    //         $data = Absen::orderBy('created_at', 'desc')->with(['user', 'atm'])->get();
    //     }

    //     return view('admin.index', ['datas' => $data,'nama'=> $nama]);
    // }

     public function showimage($id = 0){
        $foto = Absen::find($id);

        $html = "";
        if(!empty($foto)){
            $html = "<img src='/storage/uploads/" .$foto->foto."' class='rounded' alt='' style='width: 400px; height: 400px' />";
        }

        $response['html'] = $html;

        return response()->json($response);
        // return view('admin.detail',['fotos' => $foto]);
    }

    public function ubahstatus($id){
        $data = Absen::where('id', $id)->first();
        return response()->json([
            'result' => $data
        ]);
    }

    public function showProgress(Request $request){
        if($request->has('created_at')){
            $darmawan = Absen::where('user_id','=',3)->whereDate('created_at', 'LIKE', $request->created_at)->orderBy('created_at', 'desc')->count();
            $ilhan = Absen::where('user_id','=',4)->whereDate('created_at', 'LIKE', $request->created_at)->orderBy('created_at', 'desc')->count();
        }else{
            $darmawan = Absen::where('user_id','=',3)->whereDate('created_at', '=', Carbon::today()->toDateString())->orderBy('created_at', 'desc')->count();
            $ilhan = Absen::where('user_id','=',4)->whereDate('created_at', '=', Carbon::today()->toDateString())->orderBy('created_at', 'desc')->count();
        }
        return view('admin.progress',compact('darmawan','ilhan'));
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
