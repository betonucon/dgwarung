<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Setting;
use App\User;

class SettingController extends Controller
{
    
    public function index(request $request)
    {
        error_reporting(0);
        $template='top';
        
        return view('setting.index',compact('template'));
    }
    public function create(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Setting::find($request->id);
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('setting.create',compact('template','data','disabled','id'));
    }
    public function modal(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Setting::find($request->id);
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('setting.modal',compact('template','data','disabled','id'));
    }

    

    public function get_data(request $request)
    {
        error_reporting(0);
        $query = Setting::query();
        
        $data = $query->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn='
                    <div class="btn-group">
                        <span class="btn btn-primary btn-sm" onclick="onclick="tambah('.$row->id.')"><i class="fas fa-pencil-alt text-white"></i></span>
                        <span class="btn btn-danger btn-sm" onclick="delete_data('.$row->id.')"><i class="fas fa-window-close text-white"></i></span>
                    </div>
                ';
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }
    

    public function delete_data(request $request){
        $data = Setting::where('id',$request->id)->delete();
    }

    
   
    public function store(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        if($request->id==1 && $request->setting_int==1){
            $rules['setting_int_value']= 'required';
            $messages['setting_int_value.required']= 'Lengkapi value';
        }
        
       
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
            if($request->id==1){
                
                    $data=Setting::where('id',$request->id)->update([
                        
                        'setting_int'=>$request->setting_int,
                        'setting_int_value'=>$request->setting_int_value,
                        'update'=>date('Y-m-d H:i:s'),
                        'users_id'=>Auth::user()->id,
                    ]);

                    echo'@ok';
                
                
            }else{
                
                    $data=Setting::where('id',$request->id)->update([
                        
                        'setting_int'=>$request->setting_int,
                        'setting_int_value'=>null,
                        'update'=>date('Y-m-d H:i:s'),
                        'users_id'=>Auth::user()->id,
                    ]);

                    echo'@ok';
                
                
            }
        }
    }
}
