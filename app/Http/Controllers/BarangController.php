<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Barang;
use App\User;

class BarangController extends Controller
{
    
    public function index(request $request)
    {
        error_reporting(0);
        $template='top';
        
        return view('barang.index',compact('template'));
    }
    public function create(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Barang::find($request->id);
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('barang.create',compact('template','data','disabled','id'));
    }
    public function modal(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Barang::find($request->id);
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('barang.modal',compact('template','data','disabled','id'));
    }

    

    public function cari_barang(request $request)
    {
        $dT=Barang::where('kode',$request->kode)->first();
        return '@'.$dT->satuan;
    }
    public function cari_barang_jual(request $request)
    {
        $dT=Barang::where('kode',$request->kode)->first();
        return '@'.$dT->satuan.'@'.stok_ready($request->kode).'@'.nomor_stok_ready($request->kode).'@'.jual_stok_ready($request->kode);
    }

    public function get_data(request $request)
    {
        error_reporting(0);
        $query = Barang::query();
        
        $data = $query->where('aktive',1)->orderBy('nama_barang','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn='
                    <div class="btn-group">
                        <span class="btn btn-primary btn-sm" onclick="edit_data('.$row->id.')"><i class="fas fa-pencil-alt text-white"></i></span>
                        <span class="btn btn-danger btn-sm" onclick="delete_data('.$row->id.')"><i class="fas fa-window-close  text-white"></i></span>
                    </div>
                ';
                return $btn;
            })
            ->addColumn('checkbox', function ($row) {
                $btn='<input type="checkbox" class="checkbox" name="id[]" value="'.$row->id.'">';
                return $btn;
            })
            ->addColumn('nama_barangnya', function ($row) {
                $btn=$row->nama_barang.' ('.$row->satuan.')';
                return $btn;
            })
            
            ->rawColumns(['action','checkbox'])
            ->make(true);
    }
    

    public function delete_data(request $request){
        $data = Barang::where('id',$request->id)->update([
            'aktive'=>0
        ]);
    }
    public function delete_data_all(request $request){
        error_reporting(0);
        if(count($request->id)>0){
            for($x=0;$x<count($request->id);$x++){
                $data = Barang::where('id',$request->id[$x])->update([
                    'aktive'=>0
                ]);
            }
            echo'@ok';
        }else{
            echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
            echo'Ceklis data yang akan dihapus';
            echo'</div></div>';
        }
        
    }
    public function get_barang(request $request){
        $data = Barang::get();
        foreach($data as $o){
           
                $bar=Barang::where('id',$o->id)->update([
                    'join_kode'=>substr($o->kode,3,7),
                ]);
            
        }
    }

    
   
    public function store(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        
        if($request->id==0){
            if($request->kategori==1){
                $rules['nama_barang']= 'required';
                $messages['nama_barang.required']= 'Lengkapi nama barang';
            }else{
                $rules['join_kode']= 'required';
                $messages['join_kode.required']= 'Pilih barang yang akan ditambahkan';
            }
            if(count($request->satuan)==0){
                $rules['satuan']= 'required';
                $messages['satuan.required']= 'Pilih satuan';
            }
        }else{
            $rules['nama_barang']= 'required';
            $messages['nama_barang.required']= 'Lengkapi nama barang';
            $rules['satuannya']= 'required';
            $messages['satuannya.required']= 'Pilih satuan';
        }
        
        
        
        if($request->file!=""){
            $rules['file']= 'mimes:jpg,jpeg,png,gif';
            $messages['file.mimes']= 'Format file (jpg,jpeg,png,gif)';
           
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
                if($request->kategori==1){

                    $kodebarang=penomoran();
                    for($x=0;$x<count($request->satuan);$x++){
                        $data       = New Barang;
                        $data->join_kode  = $kodebarang;
                        $data->kode  = 'BR'.$request->satuan[$x].$kodebarang;
                        $data->nama_barang  = $request->nama_barang;
                        $data->keterangan  = $request->keterangan;
                        $data->kd_satuan  = $request->satuan[$x];
                        $data->satuan  = satuan($request->satuan[$x]);
                        $data->save();
                    }
                    

                    
                }else{
                    $kodebarang=$request->join_kode;
                    for($x=0;$x<count($request->satuan);$x++){
                        $cek_data=Barang::where('kode','BR'.$request->satuan[$x].$kodebarang)->count();
                        if($cek==0){
                            $data=Barang::create([
                                'kode'=>'BR'.$request->satuan[$x].$kodebarang,
                                'join_kode'=>$kodebarang,
                                'nama_barang'=>first_join_kode($kodebarang),
                                'kd_satuan'=>$request->satuan[$x],
                                'keterangan'=>$request->keterangan,
                                'satuan'=>satuan($request->satuan[$x]),
                            ]);
                        }   
                            
                        
                    }
                }

                if($request->file!=""){
                    $thumbnail = $request->file;
                    $thumbnailFileName =$kodebarang.'.'.$thumbnail->getClientOriginalExtension();
                    $thumbnailPath =$thumbnailFileName;

                    $file =\Storage::disk('public_photo');
                    if($file->put($thumbnailPath, file_get_contents($thumbnail))){
                        $data=Barang::where('join_kode',$kodebarang)->update([
                            
                            'foto'=>$thumbnailPath,
                        ]);

                        
                    }
                }
                echo'@ok';
            }else{
                $data       = Barang::find($request->id);
                $data->keterangan  = $request->keterangan;
                $data->save();

                if($request->file!=""){
                    $thumbnail = $request->file;
                    $thumbnailFileName =$data->kode.'.'.$thumbnail->getClientOriginalExtension();
                    $thumbnailPath =$thumbnailFileName;

                    $file =\Storage::disk('public_photo');
                    if($file->put($thumbnailPath, file_get_contents($thumbnail))){
                        $data=Barang::where('id',$data->id)->update([
                            
                            'foto'=>$thumbnailPath,
                        ]);

                    }
                }
                echo'@ok';
            }
        }
    }
}
