<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Supplier;
use App\User;

class SupplierController extends Controller
{
    
    public function index(request $request)
    {
        error_reporting(0);
        $template='top';
        
        return view('supplier.index',compact('template'));
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
        $data=Supplier::find($request->id);
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('supplier.modal',compact('template','data','disabled','id'));
    }

    

    public function get_data(request $request)
    {
        error_reporting(0);
        $query = Supplier::query();
        
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
        $data = Supplier::where('id',$request->id)->delete();
    }

    
   
    public function store(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['judul']= 'required';
        $messages['judul.required']= 'Lengkapi kolom judul';
        
        $rules['content']= 'required';
        $messages['content.required']= 'Lengkapi kolom deskripsi';
        if($request->id==0){
            $rules['file']= 'required|mimes:jpg,jpeg,png,gif';
            $messages['file.required']= 'Lengkapi kolom thumbnail';
            
            $rules['lampiran']= 'required|mimes:pdf,jpg,jpeg,png,gif';
            $messages['lampiran.required']= 'Lengkapi kolom lampiran';
        }else{
            if($request->file!=""){
                $rules['file']= 'required|mimes:jpg,jpeg,png,gif';
                $messages['file.required']= 'Lengkapi kolom thumbnail';
            }
            if($request->lampiran!=""){
                $rules['lampiran']= 'required|mimes:pdf,jpg,jpeg,png,gif';
                $messages['lampiran.required']= 'Lengkapi kolom lampiran';
            }
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
            if($request->id==0){
                $thumbnail = $request->file;
                $thumbnailFileName ='thumbnail'.date('ymdhis').'.'.$thumbnail->getClientOriginalExtension();
                $thumbnailPath =$thumbnailFileName;

                $lampiran = $request->lampiran;
                $lampiranFileName ='lampiran'.date('ymdhis').'.'.$lampiran->getClientOriginalExtension();
                $lampiranPath =$lampiranFileName;


                $file =\Storage::disk('public_photo');
                if($file->put($thumbnailPath, file_get_contents($thumbnail)) && $file->put($lampiranPath, file_get_contents($lampiran))){
                    $data=Pengumuman::create([
                        
                        'judul'=>$request->judul,
                        'deskripsi'=>$request->content,
                        'background'=>$thumbnailPath,
                        'lampiran'=>$lampiranPath,
                        'waktu'=>date('Y-m-d H:i:s'),
                    ]);

                    echo'@ok';
                }
                
            }else{
                $data=Pengumuman::UpdateOrcreate([
                    'id'=>$request->id,
                ],
                [
                    'judul'=>$request->judul,
                    'deskripsi'=>$request->content,
                    'waktu'=>date('Y-m-d H:i:s'),
                ]);

                if($request->file!=""){
                    $thumbnail = $request->file;
                    $thumbnailFileName ='thumbnail'.date('ymdhis').'.'.$thumbnail->getClientOriginalExtension();
                    $thumbnailPath =$thumbnailFileName;
                    $file =\Storage::disk('public_photo');
                    if($file->put($thumbnailPath, file_get_contents($thumbnail))){
                        $data=Pengumuman::UpdateOrcreate([
                            'id'=>$request->id,
                        ],
                        [
                            'background'=>$thumbnailPath,
                        ]);
                    }
                }

                if($request->lampiran!=""){
                    $lampiran = $request->lampiran;
                    $lampiranFileName ='lampiran'.date('ymdhis').'.'.$lampiran->getClientOriginalExtension();
                    $lampiranPath =$lampiranFileName;
                    $file =\Storage::disk('public_photo');
                    if($file->put($lampiranPath, file_get_contents($lampiran))){
                        $data=Pengumuman::UpdateOrcreate([
                            'id'=>$request->id,
                        ],
                        [
                            'lampiran'=>$lampiranPath,
                        ]);
                    }
                }
                echo'@ok';
            }
        }
    }
}
