<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Employe;
use App\User;

class EmployeController extends Controller
{
    
    public function index(request $request)
    {
        error_reporting(0);
        $template='top';
        
        return view('employe.index',compact('template'));
    }
    public function create(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Employe::find($request->id);
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('employe.create',compact('template','data','disabled','id'));
    }
    public function modal(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Employe::find($request->id);
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('employe.modal',compact('template','data','disabled','id'));
    }

    

    public function get_data(request $request)
    {
        error_reporting(0);
        $query = Employe::query();
        
        $data = $query->where('status',1)->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('uang_gaji', function ($row) {
                return uang($row->gaji);
            })
            ->addColumn('uang_uang_makan', function ($row) {
                return uang($row->uang_makan);
            })
            ->addColumn('action', function ($row) {
                $btn='
                    <div class="btn-group">
                        <span class="btn btn-primary btn-xs" onclick="tambah(`'.$row->id.'`)"><i class="fas fa-pencil-alt text-white"></i></span>
                        <span class="btn btn-danger btn-xs" onclick="delete_data('.$row->id.')"><i class="fas fa-window-close text-white"></i></span>
                    </div>
                ';
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }
    

    public function delete_data(request $request){
        $data = Employe::where('id',$request->id)->update(['status'=>0]);
    }

    
   
    public function store(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['nik']= 'required';
        $messages['nik.required']= 'Lengkapi kolom nik';
        
        $rules['nama']= 'required';
        $messages['nama.required']= 'Lengkapi kolom nama';
        $rules['alamat']= 'required';
        $messages['alamat.required']= 'Lengkapi kolom alamat';
        $rules['no_telepon']= 'required';
        $messages['no_telepon.required']= 'Lengkapi kolom no telepon';
        $rules['gaji']= 'required';
        $messages['gaji.required']= 'Lengkapi kolom uang harian';
        $rules['uang_makan']= 'required';
        $messages['uang_makan.required']= 'Lengkapi kolom uang makan';
        
       
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
            
                
            $data=Employe::UpdateOrcreate([
                
                'nik'=>$request->nik,
            ],[
                'nama'=>$request->nama,
                'alamat'=>$request->alamat,
                'no_telepon'=>$request->no_telepon,
                'gaji'=>ubah_uang($request->gaji),
                'uang_makan'=>ubah_uang($request->uang_makan),
                'status'=>1,
                'waktu'=>date('Y-m-d H:i:s'),
            ]);

            echo'@ok';
               
        }
    }
}
