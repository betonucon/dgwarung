<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Keuangan;
use App\Viewkeuangan;
use App\User;

class KeuanganController extends Controller
{
    
    public function index(request $request)
    {
        error_reporting(0);
        $template='top';
        if($request->act==""){
            $act=0;
        }else{
            $act=$request->act;
        }
        return view('keuangan.index',compact('template','act'));
    }
    public function create(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Supplier::find($request->id);
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('supplier.create',compact('template','data','disabled','id'));
    }
    public function modal(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Keuangan::find($request->id);
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('keuangan.modal',compact('template','data','disabled','id'));
    }

    

    public function get_data(request $request)
    {
        error_reporting(0);
        $query = Viewkeuangan::query();
        if($request->even==0){

        }else{
            $data=$query->where('status_keuangan_id',$request->even);
        }
        $data = $query->orderBy('id','Desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('uang_nilai', function ($row) {
                return uang($row->nilai);
            })
            ->addColumn('action', function ($row) {
                if(in_array($row->kategori_keuangan_id, array(3,4,5))){
                    $btn='
                        <div class="btn-group">
                            <span class="btn btn-primary btn-xs" onclick="tambah_data('.$row->id.')"><i class="fas fa-pencil-alt text-white"></i></span>
                            <span class="btn btn-danger btn-xs" onclick="delete_data('.$row->id.')"><i class="fas fa-window-close text-white"></i></span>
                        </div>
                    ';
                }else{
                    $btn='
                        <div class="btn-group">
                            <span class="btn btn-white btn-xs" ><i class="fas fa-pencil-alt text-white"></i></span>
                            <span class="btn btn-white btn-xs"><i class="fas fa-window-close text-white"></i></span>
                        </div>
                    ';
                }
                
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }
    

    public function delete_data(request $request){
        $data = Supplier::where('id',$request->id)->delete();
    }

    
   
    public function store(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['kategori_keuangan_id']= 'required';
        $messages['kategori_keuangan_id.required']= 'Pilih kategori pembayaran';

        $rules['status_keuangan_id']= 'required';
        $messages['status_keuangan_id.required']= 'Pilih status pembayaran';

        $rules['keterangan']= 'required';
        $messages['keterangan.required']= 'Masukan keterangan';

        $rules['nilai']= 'required|min:0|not_in:0';
        $messages['nilai.required']= 'Lengkapi Nilai';
        $messages['nilai.not_in']= 'Lengkapi Nilai';

        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
                foreach(parsing_validator($val) as $value){
                    
                    foreach($value as $isi){
                        echo'-&nbsp;'.$isi.'<br>';
                    }
                }
            echo'</div></div>';
        }else{
            $bulan=date('m',strtotime($request->tanggal));
            $tahun=date('Y',strtotime($request->tanggal));
            
            if($request->id==0){
                $nomor=penomoran_keuangan($request->kategori_keuangan_id);
                $keuangan=Keuangan::Updateorcreate([
                    
                    'nomor'=>$nomor,
                ],[
                    'nilai'=>ubah_uang($request->nilai),
                    'status_keuangan_id'=>$request->status_keuangan_id,
                    'kategori_keuangan_id'=>$request->kategori_keuangan_id,
                    'keterangan'=>$request->keterangan,
                    'tanggal'=>$request->tanggal,
                    'bulan'=>$bulan,
                    'tahun'=>$tahun,
                    'waktu'=>date('Y-m-d H:i:s'),
                ]);

                echo'@ok@';
            }else{
                $nomor=$request->nomor;
            
                $keuangan=Keuangan::where('id',$request->id)->update([
                   
                    'nilai'=>ubah_uang($request->nilai),
                    'status_keuangan_id'=>$request->status_keuangan_id,
                    'keterangan'=>$request->keterangan,
                    'tanggal'=>$request->tanggal,
                    'bulan'=>$bulan,
                    'tahun'=>$tahun,
                    'waktu'=>date('Y-m-d H:i:s'),
                ]);

                echo'@ok@';
            }
                
            
        }
    }
}
