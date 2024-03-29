<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Stokready;
use App\Viewdetailstok;
use App\Viewdetailorder;
use App\Stokorder;
use App\Vieworder;
use App\Stokup;
use App\Stok;
use App\Viewstokorder;
use App\Stoktersedia;
use App\Viewstokaktive;
use App\Barang;
use App\Keuangan;
use App\User;
use PDF;

class StokorderController extends Controller
{
    
    public function index(request $request)
    {
        error_reporting(0);
        $template='top';
        
        return view('stokorder.index',compact('template'));
    }
    public function index_stok(request $request)
    {
        error_reporting(0);
        $template='top';
        
        return view('stokorder.index_stok',compact('template'));
    }
    public function index_retur(request $request)
    {
        error_reporting(0);
        $template='top';
        
        return view('stokorder.index_retur',compact('template'));
    }
    public function index_tukar(request $request)
    {
        error_reporting(0);
        $template='top';
        
        return view('stokorder.index_tukar',compact('template'));
    }
    public function create(request $request)
    {
        error_reporting(0);
        $template='top';
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        $data=Stokorder::where('nomor_stok',$request->id)->first();
        return view('stokorder.create',compact('template','disabled','id','data'));
    }
    public function view_stok(request $request)
    {
        error_reporting(0);
        $template='top';
        $kode=$request->kode;
        $data=Barang::where('kode',$request->kode)->first();
        if($request->act==""){
            $act=0;
        }else{
            $act=$request->act;
        }
        if($request->kode==""){
            
        }else{
            return view('stokorder.view_stok',compact('template','disabled','kode','data','act'));
        }
        
    }

    public function modal(request $request)
    {
        error_reporting(0);
        $template='top';
        $id=$request->id;
        $ide=$request->ide;
        $act=$request->act;
        $data=Viewstokorder::find($request->ide);
        $order=Stokorder::where('nomor_stok',$request->id)->first();
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('stokorder.modal',compact('template','disabled','id','order','act','ide','data'));
    }
    
    public function modal_terima(request $request)
    {
        error_reporting(0);
        $template='top';
        $id=$request->id;
        $data=Stokorder::where('nomor_stok',$request->id)->first();
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('stokorder.modal_terima',compact('template','disabled','id','data'));
    }
    public function modal_ubah(request $request)
    {
        error_reporting(0);
        $template='top';
        $id=$request->id;
        $data=Stokup::where('id',$request->id)->first();
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('stokorder.modal_ubah',compact('template','disabled','id','data'));
    }
    public function modal_retur(request $request)
    {
        error_reporting(0);
        $template='top';
        $kode=$request->kode;
        $data=Stokup::where('kode',$request->kode)->where('sisa','>',0)->distinct()->orderBy('id','Asc')->get();
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('stokorder.modal_retur',compact('template','disabled','kode','data'));
    }
    public function modal_tukar(request $request)
    {
        error_reporting(0);
        $template='top';
        $kode=$request->kode;
        $data=Stokup::where('kode',$request->kode)->where('sisa','>',0)->distinct()->orderBy('id','Asc')->get();
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('stokorder.modal_tukar',compact('template','disabled','kode','data'));
    }
    public function cari_stok(request $request)
    {
        error_reporting(0);
        $data=Stokup::where('nomor_stok',$request->nomor_stok)->where('kode',$request->kode)->where('sisa','>',0)->first();
        return '@'.$data->satuan.'@'.($data->sisa).'@'.$data->supplier;
    }
    public function cari_stok_tukar(request $request)
    {
        error_reporting(0);
        $data=Stokup::where('nomor_stok',$request->nomor_stok)->where('kode',$request->kode)->where('sisa','>',0)->first();
        
        
        $barang=Barang::where('join_kode',$data->join_kode)->where('kd_satuan','!=',$data->kd_satuan)->get();
        $option='<option value="">Pilih Satuan</option>';
        foreach($barang as $o){
            $option.='<option value="'.$o->kode.'">'.$o->satuan.'</option>';
        }
        return '@'.$data->satuan.'@'.($data->sisa).'@'.$data->msupplier['supplier'].'@'.$option;
    }

    public function modal_cetak(request $request)
    {
        error_reporting(0);
        $template='top';
        $id=$request->id;
        $data=Stokorder::where('nomor_stok',$request->id)->first();
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('stokorder.modal_cetak',compact('template','disabled','id','data'));
    }

    public function tentukan_provit(request $request)
    {
        error_reporting(0);
        $nilai=(ubah_uang($request->nilai)*setting_provit_value())/100;
        return '@'.(ubah_uang($request->nilai)+$nilai);
    }

    

    public function get_data(request $request)
    {
        error_reporting(0);
        $query = Viewdetailorder::query();
        
        $data = $query->where('nomor_stok',$request->nomor_stok)->whereIn('status',array(1,2));
        $data = $query->where('tukar_id',null)->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('uang_harga_beli', function ($row) {
                $btn=uang($row->harga_beli);
                return $btn;
            })
            ->addColumn('uang_harga_jual', function ($row) {
                $btn=uang($row->harga_jual);
                return $btn;
            })
            ->addColumn('uang_total_beli', function ($row) {
                $btn=uang($row->total_beli);
                return $btn;
            })
            ->addColumn('action', function ($row) {
                if($row->status_order==0){
                    $btn='
                        <div class="btn-group">
                            <span class="btn btn-danger btn-sm" onclick="delete_data('.$row->id.')"><i class="fas fa-window-close text-white"></i></span>
                        </div>
                    ';
                }else{
                    $btn='
                        <div class="btn-group">
                            <span class="btn btn-white btn-sm"><i class="fas fa-window-close text-aqua"></i></span>
                        </div>
                    ';
                }
                
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }
    public function get_order(request $request)
    {
        error_reporting(0);
        $query = Vieworder::query();
        
        $data = $query->whereIn('status',array(0,1))->where('kat',null)->orderBy('tanggal','Desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            
            ->addColumn('nama_status', function ($row) {
                $btn=status($row->status);
                return $btn;
            })
            ->addColumn('pembayaran', function ($row) {
                if($row->status==0){
                    return 'Null';
                }else{
                    $btn=$row->status_transaksi;
                    return $btn;
                }
                
            })
            ->addColumn('opname', function ($row) {
                if($row->kategori_opname_id==1){
                    return '<font style="color:blue">Non</font>';
                }else{
                    return '<font style="color:red">Opn</font>';
                }
                
            })
            ->addColumn('action', function ($row) {
                if($row->status==1){
                    $btn='
                    <div class="btn-group">
                        <span class="btn btn-primary btn-xs" onclick="location.assign(`'.url('stokorder/create?id='.$row->nomor_stok).'`)"><i class="fas fa-pencil-alt text-white"></i> View</span>
                    </div>
                    ';
                }else{
                    $btn='
                    <div class="btn-group">
                        <span class="btn btn-primary btn-xs" onclick="location.assign(`'.url('stokorder/create?id='.$row->nomor_stok).'`)"><i class="fas fa-pencil-alt text-white"></i></span>
                        <span class="btn btn-danger btn-xs" onclick="delete_data('.$row->id.')"><i class="fas fa-window-close text-white"></i></span>
                    </div>
                    ';
                }
                
                return $btn;
            })
            
            ->rawColumns(['action','nama_status','opname'])
            ->make(true);
    }

    public function get_data_stok(request $request)
    {
        error_reporting(0);
        $query = Stoktersedia::query();
        
        $data = $query->orderBy('abnormal','Desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('u_harga_jual', function ($row) {
                if($row->abnormal>0){
                    $btn='<b><font color="red">'.uang($row->harga_jual).'</font></b>';
                }else{
                    $btn=uang($row->harga_jual);
                }
                
                return $btn;
            })
            ->addColumn('u_harga_beli', function ($row) {
                if($row->abnormal>0){
                    $btn='<b><font color="red">'.uang($row->harga_beli).'</font></b>';
                }else{
                    $btn=uang($row->harga_beli);
                }
                return $btn;
            })
            ->addColumn('tanggal_simple', function ($row) {
                $btn=tanggal_simple($row->update);
                return $btn;
            })
            ->addColumn('action', function ($row) {
                $btn='
                    <div class="btn-group">
                        <span class="btn btn-primary btn-xs" onclick="location.assign(`'.url('stok/view?kode='.$row->kode).'`)"><i class="fas fa-pencil-alt text-white"></i></span>
                    </div>
                ';
                return $btn;
            })
            
            ->rawColumns(['action','u_harga_jual','u_harga_beli'])
            ->make(true);
    }
    
    public function get_data_tersedia(request $request)
    {
        error_reporting(0);
        
        
        $query = Viewdetailstok::query();
        $data = $query->where('kode',$request->kode)->orderBy('sts','Desc')->get();
        
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('supplier', function ($row) {
                return $row->supplier;
                
            })
            ->addColumn('updatenya', function ($row) {
                return tanggal_tok($row->update);
                
            })
            ->addColumn('nama_barang_lengkap', function ($row) {
                return $row->nama_barang;
                
            })
            ->addColumn('qty_awal', function ($row) {
                return $row->qty.' '.$row->kd_satuan;
                
            })
            ->addColumn('sisanya', function ($row) {
                return $row->sisa.' '.$row->kd_satuan;
                
            })
            ->addColumn('u_harga_beli', function ($row) {
                return uang($row->harga_beli);
                
            })
            ->addColumn('u_harga_awal', function ($row) {
                return uang($row->harga_awal);
                
            })
            ->addColumn('u_harga_jual', function ($row) {
                return uang($row->harga_jual);
                
            })
            ->addColumn('status_data', function ($row) {
                
                if($row->sts==1){
                    return '<font color="blue">Aktive</font>';
                }else{
                    return '<font color="red">Proses</font>';
                }
               
                
            })
            ->addColumn('action', function ($row) {
                
                $btn='
                    <div class="btn-group">
                        <span class="btn btn-primary btn-xs" onclick="ubah_data('.$row->id.')"><i class="fas fa-pencil-alt text-white"></i></span>
                    </div>
                ';
                
                return $btn;
            })
            ->rawColumns(['action','status_data'])
            ->make(true);
    }

    public function get_data_even(request $request)
    {
        error_reporting(0);
        $query = Viewstokorder::query();
        if($request->even==0){

        }else{
            $data=$query->where('status',$request->even);
        }
        $data = $query->where('kode',$request->kode)->where('status','!=',1)->orderBy('update','Desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('supplier', function ($row) {
                return $row->msupplier['supplier'];
            })
            ->addColumn('updatenya', function ($row) {
                return tanggal_tok($row->update);
                
            })
            ->addColumn('status_data', function ($row) {
                if($row->tukar_id>0){
                    $btn='Masuk/tukar';
                }else{
                    $btn=$row->status_stok;
                }
                
                return $btn;
            })
            ->make(true);
    }
    public function get_data_retur(request $request)
    {
        error_reporting(0);
        $query = Viewstokorder::query();
        
        $data = $query->where('status',4)->orderBy('update','Desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('supplier', function ($row) {
                $btn=$row->msupplier['supplier'];
                return $btn;
            })
            ->addColumn('action', function ($row) {
                if($row->proses==1){
                    $btn='
                        <div class="btn-group">
                            <span class="btn btn-green btn-xs" onclick="cetak_data('.$row->id.')"><i class="fas fa-print text-white"></i></span>
                        </div>
                    ';
                }else{
                    $btn='
                        <div class="btn-group">
                            <span class="btn btn-blue btn-xs text-with" onclick="proses_retur('.$row->id.')"><i class="fas fa-check-square text-white"></i></span>
                            <span class="btn btn-danger btn-xs text-with" onclick="delete_data('.$row->id.')"><i class="fas fa-window-close text-white"></i></span>
                        </div>
                    ';
                }
                
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }
    public function get_data_tukar(request $request)
    {
        error_reporting(0);
        $query = Viewstokorder::query();
        
        $data = $query->where('status',5)->orderBy('update','Desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('supplier', function ($row) {
                $btn=$row->msupplier['supplier'];
                return $btn;
            })
            ->addColumn('action', function ($row) {
                if($row->proses==4){
                    $btn='
                        <div class="btn-group">
                            <span class="btn btn-green btn-xs" onclick="cetak_data('.$row->id.')"><i class="fas fa-print text-white"></i></span>
                        </div>
                    ';
                }
                if($row->proses==3){
                    $btn='
                        <div class="btn-group">
                            <span class="btn btn-blue btn-xs text-with" onclick="proses_tukar('.$row->id.')"><i class="fas fa-check-square text-white"></i></span>
                            <span class="btn btn-danger btn-xs text-with" onclick="delete_data('.$row->id.')"><i class="fas fa-window-close text-white"></i></span>
                        </div>
                    ';
                }
                
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }
    

    public function delete_data(request $request){
        $data = Stokorder::where('id',$request->id)->first();
        if($data->status==0){
            $del = Stok::where('nomor_stok',$data->nomor_stok)->where('status',1)->delete();
            $del2 = Stokorder::where('id',$request->id)->where('status',0)->delete();
        }
        
    }
    public function delete_data_barang(request $request){
        $data = Stok::where('id',$request->id)->delete();
    }
    public function delete_tukar(request $request){
        $data = Stok::where('id',$request->id)->delete();
        $data2 = Stok::where('tukar_id',$request->id)->delete();
    }
    public function proses_retur(request $request){
        $data = Stok::where('id',$request->id)->update([
            'proses'=>1
        ]);
    }
    public function proses_tukar(request $request){
        $data = Stok::where('id',$request->id)->update([
            'proses'=>4
        ]);
    }

    
   
    public function store(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['supplier_id']= 'required';
        $messages['supplier_id.required']= 'Pilih Supplier';
        
        $rules['tanggal']= 'required';
        $messages['tanggal.required']= 'Lengkapi tanggal';
        
       
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
                
                    $opname=$request->kategori_opname_id;
               
                    $nomor=penomoran_masuk();
                    $data=Stokorder::create([
                        
                        'nomor_stok'=>$nomor,
                        'supplier_id'=>$request->supplier_id,
                        'kategori_opname_id'=>$opname,
                        'tanggal'=>$request->tanggal,
                        'users_id'=>Auth::user()->id,
                        'nama_user'=>Auth::user()->name,
                        'bulan'=>date('m'),
                        'tahun'=>date('Y'),
                        'status'=>0,
                        'waktu'=>date('Y-m-d H:i:s'),
                    ]);

                    echo'@ok@'.$nomor;
                
            }else{
                
            }
        }
    }

    public function store_ubah(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['harga_beli']= 'required|min:0|not_in:0';
        $messages['harga_beli.required']= 'Lengkapi harga beli';
        $messages['harga_beli.not_in']= 'Lengkapi harga beli';

        $rules['harga_jual']= 'required|min:0|not_in:0';
        $messages['harga_jual.required']= 'Lengkapi harga jual';
        $messages['harga_jual.not_in']= 'Lengkapi harga jual';
        $rules['qty']= 'required|min:0|not_in:0';
        $messages['qty.required']= 'Lengkapi Qty';
        $messages['qty.not_in']= 'Lengkapi Qty';
        
       
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
            
                    $gt=Stok::where('id',$request->id)->first();
                    $data=Stok::where('id',$request->id)->update([
                        
                        'harga_beli'=>ubah_uang($request->harga_beli),
                        'harga_jual'=>ubah_uang($request->harga_jual),
                        'total_jual'=>(ubah_uang($request->harga_jual)*ubah_uang($request->qty)),
                        'total_beli'=>(ubah_uang($request->harga_beli)*ubah_uang($request->qty)),
                        'qty'=>ubah_uang($request->qty),
                        'update'=>date('Y-m-d H:i:s'),
                    ]);
                    // if($gt->harga_jual>harga_jual($gt->kode)){
                    //     $harga_jual=$request->harga_jual;
                    // }else{
                    //     $harga_jual=harga_jual($gt->kode);
                    // }
                    $harga_jual=ubah_uang($request->harga_jual);
                    $hdiscon=$harga_jual-(($harga_jual*discon_barang($gt->kode))/100);
                    $bar=Barang::where('kode',$gt->kode)->update([ 
                        'harga_jual'=>ubah_uang($request->harga_jual),
                        'harga_discon'=>$hdiscon,
                        'update'=>date('Y-m-d H:i:s'),
                    ]);
                    echo'@ok@';
                
            
        }
    }

    public function store_selesai(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['status_keuangan_id']= 'required';
        $messages['status_keuangan_id.required']= 'Pilih status pembayaran';
        
        if($request->status_keuangan_id==3){
            $rules['tanggal']= 'required';
            $messages['tanggal.required']= 'Lengkapi tanggal pembayaran';
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
            $odr=Stokorder::where('nomor_stok',$request->nomor_stok)->first();
            $tanggal=$odr->tanggal;
            $bulan=date('m',strtotime($odr->tanggal));
            $tahun=date('Y',strtotime($odr->tanggal));
            if($request->status_keuangan_id==3){
                $dibayarkan=null;
            }else{
                $dibayarkan=date('Y-m-d');
            }
                $get=Viewstokorder::where('nomor_stok',$request->nomor_stok)->where('nomor_transaksi',null)->get();
                $odr=Stokorder::where('nomor_stok',$request->nomor_stok)->first();
                    $data=Stokorder::where('nomor_stok',$request->nomor_stok)->update([
                        
                        'status'=>1,
                        'status_keuangan_id'=>$request->status_keuangan_id,
                        'nilai'=>$request->nilai,
                        'waktu'=>date('Y-m-d H:i:s'),
                    ]);
                    foreach($get as $no=>$gt){
                        // if($gt->harga_jual>harga_jual($gt->kode)){
                        //     $harga_jual=$gt->harga_jual;
                        // }else{
                        //     $harga_jual=harga_jual($gt->kode);
                        // }
                        $harga_jual=$gt->harga_jual;
                        if($gt->harga_beli>harga_beli($gt->kode)){
                            $harga_beli=$gt->harga_beli;
                        }else{
                            $harga_beli=harga_beli($gt->kode);
                        }
                        $hdiscon=$harga_jual-(($harga_jual*discon_barang($gt->kode))/100);
                        $bar=Barang::where('kode',$gt->kode)->update([ 
                            'harga_jual'=>$harga_jual,
                            'harga_beli'=>$harga_beli,
                            'harga_discon'=>$hdiscon,
                            'update'=>date('Y-m-d H:i:s'),
                        ]);
                        $data=Stok::where('id',$gt->id)->update([     
                            'urut'=>($no+1),
                            'status'=>2,
                            'aktif'=>0,
                            'supplier_id'=>$odr->supplier_id,
                            'kategori_opname_id'=>$odr->kategori_opname_id,
                            'users_id'=>Auth::user()->id,
                            'nama_user'=>Auth::user()->name,
                            'proses'=>1,
                            'update'=>date('Y-m-d H:i:s'),
                        ]);
                    }
                    if($odr->kategori_opname_id==1){
                        $keuangan=Keuangan::UpdateOrcreate([
                            
                            'nomor'=>kdk($request->kategori_keuangan_id).'2'.$request->nomor_stok,
                            'nomor_transaksi'=>$request->nomor_stok,
                            'kat'=>2,
                        ],[
                            'nilai'=>$request->nilai,
                            'nomor_transaksi'=>$request->nomor_stok,
                            'status_keuangan_id'=>$request->status_keuangan_id,
                            'kategori_keuangan_id'=>1,
                            'keterangan'=>'Pembelian Stok kepada '.$odr->msupplier['supplier'].' ('.$tanggal.')',
                            'tanggal'=>$tanggal,
                            'bulan'=>$bulan,
                            'tahun'=>$tahun,
                            
                            'waktu'=>date('Y-m-d H:i:s'),
                        ]);
                    }

                    echo'@ok@'.$nomor;
                
            
        }
    }

    public function store_stok(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['kode']= 'required';
        $messages['kode.required']= 'Pilih Barang';
        
        $rules['nomor_stok']= 'required|min:0|not_in:0';
        $messages['nomor_stok.required']= 'Buat Order';
        $messages['nomor_stok.not_in']= 'Buat Order';

        $rules['harga_beli']= 'required|min:0|not_in:0';
        $messages['harga_beli.required']= 'Lengkapi harga beli';
        $messages['harga_beli.not_in']= 'Lengkapi harga beli';

        $rules['harga_jual']= 'required|min:0|not_in:0';
        $messages['harga_jual.required']= 'Lengkapi harga jual';
        $messages['harga_jual.not_in']= 'Lengkapi harga jual';

        $rules['qty']= 'required|min:0|not_in:0';
        $messages['qty.required']= 'Lengkapi jumlah';
        $messages['qty.not_in']= 'Lengkapi jumlah';

        if($request->harga_dasar>$request->harga_beli){
           
                $rules['discon']= 'required';
                $messages['discon.required']= 'Lengkapi Kolom discon';
           
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
            if($request->harga_dasar>0){
                $harga_dasar=ubah_uang($request->harga_dasar);
            }else{
                $harga_dasar=ubah_uang($request->harga_beli);
            }
                    $data=Stok::UpdateOrcreate([
                        
                        'nomor_stok'=>$request->nomor_stok,
                        'kode'=>$request->kode,
                        'status'=>1,
                    ],[
                        'harga_beli'=>ubah_uang($request->harga_beli),
                        'harga_jual'=>ubah_uang($request->harga_jual),
                        'harga_dasar'=>$harga_dasar,
                        'qty'=>ubah_uang($request->qty),
                        'total_jual'=>(ubah_uang($request->harga_jual)*ubah_uang($request->qty)),
                        'total_beli'=>(ubah_uang($request->harga_beli)*ubah_uang($request->qty)),
                        'expired'=>$request->expired,
                        'discon'=>$request->discon,
                        'bulan'=>date('m'),
                        'tahun'=>date('Y'),
                        'waktu'=>date('Y-m-d H:i:s'),
                    ]);

                    echo'@ok@'.$nomor;
                
            
        }
    }

    public function store_retur(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['kode']= 'required';
        $messages['kode.required']= 'Pilih Barang';
        
        $rules['nomor_stok']= 'required|min:0|not_in:0';
        $messages['nomor_stok.required']= 'Pilih Stok ';
        $messages['nomor_stok.not_in']= 'Pilih Stok ';

        $rules['qty_retur']= 'required|min:0|not_in:0';
        $messages['qty_retur.required']= 'Lengkapi Jumlah Retur';
        $messages['qty_retur.not_in']= 'Lengkapi Jumlah Retur';

       
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
                $order=Stok::where('nomor_stok',$request->nomor_stok)->where('kode',$request->kode)->first();
                if($order->qty>=$request->qty_retur){ 
                    $countcek=Keuangan::where('nomor_transaksi',$request->nomor_stok)->where('status_keuangan_id',3)->where('nomor_transaksi',$request->nomor_stok)->count(); 
                    if($countcek>0){
                        $data=Stok::create([
                            
                            'nomor_stok'=>$request->nomor_stok,
                            'kode'=>$request->kode,
                            'harga_beli'=>ubah_uang($order->harga_beli),
                            'harga_jual'=>ubah_uang($order->harga_jual),
                            'qty'=>ubah_uang($request->qty_retur),
                            'total_jual'=>(ubah_uang($order->harga_jual)*ubah_uang($request->qty_retur)),
                            'total_beli'=>(ubah_uang($order->harga_beli)*ubah_uang($request->qty_retur)),
                            'expired'=>$order->expired,
                            'status'=>4,
                            'bulan'=>date('m'),
                            'tahun'=>date('Y'),
                            'waktu'=>date('Y-m-d H:i:s'),
                            'update'=>date('Y-m-d H:i:s'),
                        ]);
                        $keuanganready=Keuangan::where('nomor_transaksi',$request->nomor_stok)->where('status_keuangan_id',3)->where('nomor_transaksi',$request->nomor_stok)->first();
                        $keuangan=Keuangan::UpdateOrcreate([
                                
                            'nomor_transaksi'=>$request->nomor_stok,
                            'kat'=>2,
                        ],[
                            'nilai'=>($keuanganready->nilai-(ubah_uang($order->harga_beli)*ubah_uang($request->qty_retur))),
                            'waktu'=>date('Y-m-d H:i:s'),
                            'keterangan'=>$keuanganready->keterangan.' ( Retur '.$request->qty_retur.' Produk)',
                        ]);
                        echo'@ok@'.$nomor;
                    }else{
                        echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
                        echo'Status keungan tidak tersedia';
                        echo'</div></div>';
                    }
                }else{
                    echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
                    echo'Permintaan retur melebihi qty yang tersedia';
                    echo'</div></div>';
                }
                
            
        }
    }
    public function store_tukar(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['kode']= 'required';
        $messages['kode.required']= 'Pilih Barang';
        
        $rules['nomor_stok']= 'required|min:0|not_in:0';
        $messages['nomor_stok.required']= 'Pilih Stok ';
        $messages['nomor_stok.not_in']= 'Pilih Stok ';

        $rules['qty_keluar']= 'required|min:0|not_in:0';
        $messages['qty_keluar.required']= 'Lengkapi Jumlah keluar';
        $messages['qty_keluar.not_in']= 'Lengkapi Jumlah keluar';

        $rules['qty_tukar']= 'required|min:0|not_in:0';
        $messages['qty_tukar.required']= 'Lengkapi Jumlah tukar';
        $messages['qty_tukar.not_in']= 'Lengkapi Jumlah tukar';

        $rules['kode_tukar']= 'required|min:0|not_in:0';
        $messages['kode_tukar.required']= 'Pilih satuan';
        $messages['kode_tukar.not_in']= 'Pilih satuan';

        $rules['harga_beli']= 'required|min:0|not_in:0';
        $messages['harga_beli.required']= 'Lengkapi Harga Beli';
        $messages['harga_beli.not_in']= 'Lengkapi Harga Beli';

        $rules['harga_jual']= 'required|min:0|not_in:0';
        $messages['harga_jual.required']= 'Lengkapi Harga jual';
        $messages['harga_jual.not_in']= 'Lengkapi Harga jual';

       
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
                $order=Stok::where('nomor_stok',$request->nomor_stok)->where('kode',$request->kode)->first();
                $mst=Stokorder::where('nomor_stok',$request->nomor_stok)->first();
                if($order->qty>=$request->qty_keluar){   
                    $data=Stok::create([
                        
                        'nomor_stok'=>$request->nomor_stok,
                        'kode'=>$request->kode,
                        'supplier_id'=>$mst->supplier_id,
                        'harga_beli'=>ubah_uang($order->harga_beli),
                        'harga_jual'=>ubah_uang($order->harga_jual),
                        'qty'=>ubah_uang($request->qty_keluar),
                        'total_jual'=>(ubah_uang($order->harga_jual)*ubah_uang($request->qty_keluar)),
                        'total_beli'=>(ubah_uang($order->harga_beli)*ubah_uang($request->qty_keluar)),
                        'expired'=>$order->expired,
                        'status'=>5,
                        'proses'=>3,
                        'bulan'=>date('m'),
                        'tahun'=>date('Y'),
                        'waktu'=>date('Y-m-d H:i:s'),
                        'update'=>date('Y-m-d H:i:s'),
                    ]);

                    if(ubah_uang($request->harga_jual)>harga_jual($request->kode_tukar)){
                        $harga_jual=ubah_uang($request->harga_jual);
                    }else{
                        $harga_jual=harga_jual($request->kode_tukar);
                    }
                   
                    $hdiscon=$harga_jual-(($harga_jual*discon_barang($request->kode_tukar))/100);
                    $bar=Barang::where('kode',$request->kode_tukar)->update([ 
                        'harga_jual'=>$harga_jual,
                        'harga_beli'=>$harga_beli,
                        'harga_discon'=>$hdiscon,
                    ]);
                    $nomor=$request->nomor_stok;
                    $cekchange=Stok::where('nomor_stok',$request->nomor_stok)->where('kode',$request->kode_tukar)->where('status',2)->count();
                    if($cekchange>0){
                        $change=Stok::where('nomor_stok',$request->nomor_stok)->where('kode',$request->kode_tukar)->where('status',2)->first();
                        $qtytukar=($change->qty+ubah_uang($request->qty_tukar));
                        $hargabelitukar=(ubah_uang($request->harga_beli)*($change->qty+ubah_uang($request->qty_tukar)));
                        $hargajualtukar=(ubah_uang($request->harga_jual)*($change->qty+ubah_uang($request->qty_tukar)));
                    }else{
                        $qtytukar=ubah_uang($request->qty_tukar);
                        $hargabelitukar=(ubah_uang($request->harga_beli)*ubah_uang($request->qty_tukar));
                        $hargajualtukar=(ubah_uang($request->harga_jual)*ubah_uang($request->qty_tukar));
                    }
                    
                    $stopsp=Stokorder::UpdateOrcreate([
                        
                        'nomor_stok'=>$nomor,
                        'kat'=>1,
                        
                    ],[
                        'supplier_id'=>$mst->supplier_id,
                        'nomor_stok_utama'=>$mst->nomor_stok,
                        'nilai'=>$hargabelitukar,
                        'kategori_opname_id'=>2,
                        'tanggal'=>date('Y-m-d'),
                        'users_id'=>Auth::user()->id,
                        'nama_user'=>Auth::user()->name,
                        'bulan'=>date('m'),
                        'tahun'=>date('Y'),
                        'status'=>1,
                        'waktu'=>date('Y-m-d H:i:s'),

                    ]);
                    $tukar=Stok::UpdateOrcreate([
                        
                        'nomor_stok'=>$nomor,
                        'kode'=>$request->kode_tukar,
                        'status'=>2,
                        
                    ],[
                        'tukar_id'=>$data->id,
                        'supplier_id'=>$mst->supplier_id,
                        'harga_beli'=>ubah_uang($request->harga_beli),
                        'harga_jual'=>ubah_uang($request->harga_jual),
                        'qty'=>$qtytukar,
                        'total_jual'=>$hargajualtukar,
                        'total_beli'=>$hargabelitukar,
                        'expired'=>$order->expired,
                        'proses'=>3,
                        'bulan'=>date('m'),
                        'tahun'=>date('Y'),
                        'waktu'=>date('Y-m-d H:i:s'),
                        'update'=>date('Y-m-d H:i:s'),
                    ]);

                    echo'@ok@';
                }else{
                    echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
                    echo'Permintaan tukar melebihi qty yang tersedia';
                    echo'</div></div>';
                }
                
            
        }
    }

    public function cetak(Request $request)
    {
        error_reporting(0);
        $order=Stokorder::where('nomor_stok',$request->id)->first();
        $count=jumlah_item_order($request->id);
        $ford=ceil(jumlah_item_order($request->id)/18);
        $pdf = PDF::loadView('stokorder.cetak', compact('data','order','ford','count'));
        $pdf->setPaper('A4', 'Potrait');
        $pdf->stream($request->id.'.pdf');
        if($request->act==1){
            return $pdf->download();
        }else{
            return $pdf->stream();
        }
        
    }
    public function print(Request $request)
    {
        error_reporting(0);
        $order=Stokorder::where('nomor_stok',$request->id)->first();
        $count=jumlah_item_order($request->id);
        $ford=ceil(jumlah_item_order($request->id)/18);
        return view('stokorder.print', compact('data','order','ford','count'));
       
    }
}
