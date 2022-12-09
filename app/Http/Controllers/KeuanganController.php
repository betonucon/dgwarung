<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Keuangan;
use App\Stokorder;
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
        $bulan=date('m');
        $tahun=date('Y');
        $tanggal=date('Y-m-d');
        return view('keuangan.index',compact('template','act','bulan','tahun','tanggal'));
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
    public function modal_bayar(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Keuangan::find($request->id);
        $riwayat=Keuangan::where('nomor_bayar',$data->nomor)->orderBy('id','Asc')->get();
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('keuangan.modal_bayar',compact('template','data','disabled','id','riwayat'));
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
                if($row->kat==1){
                    if($row->kategori_keuangan_id==1){
                        $btn='
                            <div class="btn-group">
                               <span class="btn btn-danger btn-xs" onclick="delete_data_bayar('.$row->id.')"><i class="fas fa-window-close text-white"></i></span>
                            </div>
                        ';
                    }else{
                        $btn='
                            <div class="btn-group">
                                <span class="btn btn-primary btn-xs" onclick="tambah_data('.$row->id.')"><i class="fas fa-pencil-alt text-white"></i></span>
                                <span class="btn btn-danger btn-xs" onclick="delete_data('.$row->id.')"><i class="fas fa-window-close text-white"></i></span>
                            </div>
                        ';
                    }
                }else{
                    if($row->status_keuangan_id==3){
                        $btn='
                            <div class="btn-group">
                                <span class="btn btn-primary btn-xs" onclick="pembayaran_data('.$row->id.')">Bayar</span>
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
                    
                }
                
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }
    

    public function delete_data(request $request){
        $data = Keuangan::where('id',$request->id)->delete();
    }
    public function delete_data_bayar(request $request){
        $find = Keuangan::where('id',$request->id)->first();
        $utg = Keuangan::where('nomor',$find->nomor_bayar)->where('status_keuangan_id',3)->first();
        $byrt=Keuangan::where('nomor',$find->nomor_bayar)->where('status_keuangan_id',3)->update([
        
            'nilai'=>($utg->nilai+$find->nilai),
            'nilai_dibayar'=>($utg->nilai_dibayar-$find->nilai),
            'waktu'=>date('Y-m-d H:i:s'),
        ]);
        $data = Keuangan::where('id',$request->id)->delete();
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
                    'nilai_dibayar'=>ubah_uang($request->nilai),
                    'status_keuangan_id'=>$request->status_keuangan_id,
                    'kategori_keuangan_id'=>$request->kategori_keuangan_id,
                    'keterangan'=>$request->keterangan,
                    'tanggal'=>$request->tanggal,
                    'bulan'=>$bulan,
                    'tahun'=>$tahun,
                    'kat'=>1,
                    'waktu'=>date('Y-m-d H:i:s'),
                ]);

                echo'@ok@';
            }else{
                $nomor=$request->nomor;
            
                $keuangan=Keuangan::where('id',$request->id)->update([
                   
                    'nilai'=>ubah_uang($request->nilai),
                    'nilai_dibayar'=>ubah_uang($request->nilai),
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

    public function store_bayar(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['nilai_dibayarkan']= 'required|min:0|not_in:0';
        $messages['nilai_dibayarkan.required']= 'Lengkapi nilai dibayarkan';
        $messages['nilai_dibayarkan.not_in']= 'Lengkapi Nilai dibayarkan';

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
            $tanggal=date('Y-m-d');
            $bulan=date('m');
            $tahun=date('Y');
            $odr=Stokorder::where('nomor_stok',$request->nomor_stok)->first();
            
                $nomor=penomoran_keuangan(1);
                $keuangan=Keuangan::UpdateOrcreate([
                        
                    'nomor'=>$nomor,
                ],[
                    'nilai'=>ubah_uang($request->nilai_dibayarkan),
                    'status_keuangan_id'=>2,
                    'kategori_keuangan_id'=>1,
                    'keterangan'=>'Pembayaran Nomor Order '.$request->nomor_stok.' '.$odr->msupplier['supplier'],
                    'tanggal'=>$tanggal,
                    'nomor_bayar'=>$request->nomor,
                    'bulan'=>$bulan,
                    'tahun'=>$tahun,
                    'nilai_dibayar'=>ubah_uang($request->nilai_dibayarkan),
                    'kat'=>1,
                    'waktu'=>date('Y-m-d H:i:s'),
                ]);

                $byrt=Keuangan::Updateorcreate([
                    
                    'id'=>$request->id,
                ],[
                    'nilai'=>(ubah_uang($request->nilai)-ubah_uang($request->nilai_dibayarkan)),
                    'nilai_dibayar'=>(ubah_uang($request->nilai_dibayarkan)+$request->uangmasuk),
                    'waktu'=>date('Y-m-d H:i:s'),
                ]);

                echo'@ok@';
           
        }
    }
}
