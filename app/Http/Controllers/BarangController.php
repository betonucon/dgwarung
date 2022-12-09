<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Barang;
use App\Viewstokorder;
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
        error_reporting(0);
        $cek=Viewstokorder::where('kode',$request->kode)->where('status',2)->where('supplier_id',$request->supplier_id)->count();
        if($cek>0){
            $data=Viewstokorder::where('kode',$request->kode)->where('status',2)->where('supplier_id',$request->supplier_id)->orderBy('id','Desc')->firstOrfail();
            $harga_jual=$data->harga_jual;
            $harga_beli=$data->harga_beli;
            $discon=$data->discon;
        }else{
            $harga_jual=0;
            $harga_beli=0;
            $discon=0;
        }
        $dT=Barang::where('kode',$request->kode)->first();
        return '@'.$dT->satuan.'@'.$harga_jual.'@'.$harga_beli.'@'.$discon;
    }
    public function cari_barang_jual(request $request)
    {
        $dT=Barang::where('kode',$request->kode)->first();
        if(setting_harga_jual()==1){
            $discon=(harga_jual($request->kode)-harga_discon($request->kode));
            return '@'.$dT->satuan.'@'.stok_ready($request->kode).'@'.nomor_stok_ready($request->kode).'@'.harga_jual($request->kode).'@'.supplier_stok_ready($request->kode).'@'.$discon;
        }else{
            $discon=0;
            return '@'.$dT->satuan.'@'.stok_ready($request->kode).'@'.nomor_stok_ready($request->kode).'@'.jual_stok_ready($request->kode).'@'.supplier_stok_ready($request->kode).'@'.$discon;
        }
        
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
            ->addColumn('uang_harga_jual', function ($row) {
                $btn=uang($row->harga_jual);
                return $btn;
            })
            ->addColumn('uang_harga_beli', function ($row) {
                $btn=uang($row->harga_beli);
                return $btn;
            })
            ->addColumn('diskonnya', function ($row) {
                $btn=$row->discon.' %';
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
        $data = Barang::where('kd_satuan','D')->get();
        foreach($data as $o){
           
                $bar=Barang::UpdateOrcreate([
                    'kode'=>'BRP'.$o->join_kode,
                ],[
                    'nama_barang'=>$o->nama_barang,
                    'satuan'=>'Pack',
                    'kd_satuan'=>'P',
                    'aktive'=>'1',
                    'join_kode'=>$o->join_kode,
                    'waktu'=>$o->waktu,
                    'harga_beli'=>0,
                    'harga_jual'=>0,
                    'harga_discon'=>0,
                    'discon'=>0,
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
            
            $rules['harga_jual']= 'required|min:0|not_in:0';
            $messages['harga_jual.required']= 'Lengkapi harga jual';
            $messages['harga_jual.not_in']= 'Lengkapi harga jual';
            
            $rules['harga_beli']= 'required|min:0|not_in:0';
            $messages['harga_beli.required']= 'Lengkapi harga jual';
            $messages['harga_beli.not_in']= 'Lengkapi harga jual';
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
                        $data->keterangan  = $request->keterangan[$x];
                        $data->kd_satuan  = $request->satuan[$x];
                        $data->aktive  = 1;
                        $data->discon  = 0;
                        $data->harga_jual  = 0;
                        $data->harga_beli  = 0;
                        $data->harga_discon  = 0;
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
                $data->harga_jual  = ubah_uang($request->harga_jual);
                $data->harga_beli  = ubah_uang($request->harga_beli);
                $data->discon  = ubah_uang($request->discon);
                $data->harga_discon  = ubah_uang($request->harga_jual)-pembulatan((ubah_uang($request->harga_jual)*ubah_uang($request->discon))/100);
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
