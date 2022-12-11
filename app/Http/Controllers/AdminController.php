<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function index(Request $request){

        $this->authorize('admin');
        $data = Absen::orderBy('created_at', 'desc')->with(['user', 'atm'])->get();

        if($request->ajax()){
            return response()->json($data);
        }
        return view('admin.index', ['datas' => $data]);

        // return DataTables::of($data)->addIndexColumn()->addColumn('aksi', function($data){
        //     return view('admin.index')->with('data', $data);
        // })->make(true);
    }

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
