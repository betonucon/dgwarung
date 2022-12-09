<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Stokready;
use App\Stokorder;
use App\Vieworder;
use App\Stokup;
use App\Stok;
use App\Viewstokorder;
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
        $data=Viewstokorder::where('kode',$request->kode)->where('status',2)->orderBy('id','Asc')->get();
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
        $data=Viewstokorder::where('kode',$request->kode)->where('status',2)->orderBy('id','Asc')->get();
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
        $data=Viewstokorder::where('nomor_stok',$request->nomor_stok)->where('kode',$request->kode)->first();
        $sum=Viewstokorder::where('nomor_stok',$request->nomor_stok)->where('kode',$request->kode)->whereIn('status',array(4,5,3))->sum('qty');
        return '@'.$data->satuan.'@'.($data->qty-$sum).'@'.$data->msupplier['supplier'];
    }
    public function cari_stok_tukar(request $request)
    {
        error_reporting(0);
        $data=Viewstokorder::where('nomor_stok',$request->nomor_stok)->where('kode',$request->kode)->first();
        $sum=Viewstokorder::where('nomor_stok',$request->nomor_stok)->where('kode',$request->kode)->whereIn('status',array(4,5,3))->sum('qty');
        $barang=Barang::where('join_kode',$data->join_kode)->where('kd_satuan','!=',$data->kd_satuan)->get();
        $option='<option value="">Pilih Satuan</option>';
        foreach($barang as $o){
            $option.='<option value="'.$o->kode.'">'.$o->satuan.'</option>';
        }
        return '@'.$data->satuan.'@'.($data->qty-$sum).'@'.$data->msupplier['supplier'].'@'.$option;
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
        $query = Viewstokorder::query();
        
        $data = $query->where('nomor_stok',$request->nomor_stok)->where('nomor_transaksi',null);
        $data = $query->orderBy('id','Asc')->get();

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
                            <span class="btn btn-primary btn-sm" onclick="edit_data('.$row->id.')"><i class="fas fa-pencil-alt text-white"></i></span>
                            <span class="btn btn-danger btn-sm" onclick="delete_data('.$row->id.')"><i class="fas fa-window-close text-white"></i></span>
                        </div>
                    ';
                }else{
                    $btn='
                        <div class="btn-group">
                            <span class="btn btn-white btn-sm"><i class="fas fa-pencil-alt text-aqua"></i></span>
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
        
        $data = $query->orderBy('status','Asc')->get();

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
            
            ->rawColumns(['action','nama_status'])
            ->make(true);
    }

    public function get_data_stok(request $request)
    {
        error_reporting(0);
        $query = Stokready::query();
        
        $data = $query->orderBy('nama_barang','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('sisa', function ($row) {
                $btn=sisa($row->kode);
                return $btn;
            })
            ->addColumn('jual', function ($row) {
                $btn=even_stok($row->kode,3);
                return $btn;
            })
            ->addColumn('retur', function ($row) {
                $btn=even_stok($row->kode,4);
                return $btn;
            })
            ->addColumn('tukar', function ($row) {
                $btn=even_stok($row->kode,5);
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
            
            ->rawColumns(['action'])
            ->make(true);
    }
    
    public function get_data_tersedia(request $request)
    {
        error_reporting(0);
        
        
        $query = Stokup::query();
        $data = $query->where('kode',$request->kode)->where('status','!=',1)->orderBy('sisa','Desc')->get();
        
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('supplier', function ($row) {
                return $row->supplier;
                
            })
            ->addColumn('nama_barang_lengkap', function ($row) {
                return $row->nama_barang.' ('.$row->keterangan.')';
                
            })
            ->addColumn('sisanya', function ($row) {
                return $row->sisa.' '.$row->kd_satuan;
                
            })
            ->addColumn('u_harga_beli', function ($row) {
                return uang($row->harga_beli);
                
            })
            ->addColumn('u_harga_jual', function ($row) {
                return uang($row->harga_jual);
                
            })
            ->addColumn('status_data', function ($row) {
                if($row->sisa>0){
                    if(nomor_stok_ready($row->kode)==$row->nomor_stok){
                        return '<font color="blue">Aktive</font>';
                    }else{
                        return '<font color="red">Proses</font>';
                    }
                }else{
                    return '<font color="red">Habis</font>';
                }
                
            })
            ->addColumn('action', function ($row) {
                if($row->sisa>0){
                    $btn='
                        <div class="btn-group">
                            <span class="btn btn-primary btn-xs" onclick="ubah_data('.$row->id.')"><i class="fas fa-pencil-alt text-white"></i></span>
                        </div>
                    ';
                }else{
                    $btn='
                        <div class="btn-group">
                            <span class="btn btn-white btn-xs" ><i class="fas fa-pencil-alt text-white"></i></span>
                        </div>
                    '; 
                }
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
                            <span class="btn btn-green btn-xs text-with" onclick="cetak_data('.$row->id.')"><i class="fas fa-print text-white"></i></span>
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
                            <span class="btn btn-green btn-xs text-with" onclick="cetak_data('.$row->id.')"><i class="fas fa-print text-white"></i></span>
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
        $data = Supplier::where('id',$request->id)->delete();
    }
    public function delete_retur(request $request){
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
                    $nomor=penomoran_masuk();
                    $data=Stokorder::create([
                        
                        'nomor_stok'=>$nomor,
                        'supplier_id'=>$request->supplier_id,
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
        
        $rules['harga_jual']= 'required|min:0|not_in:0';
        $messages['harga_jual.required']= 'Lengkapi harga jual';
        $messages['harga_jual.not_in']= 'Lengkapi harga jual';
        
       
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
                        
                        'harga_jual'=>ubah_uang($request->harga_jual),
                        'update'=>date('Y-m-d H:i:s'),
                    ]);
                    if($gt->harga_jual>harga_jual($gt->kode)){
                        $harga_jual=$gt->harga_jual;
                    }else{
                        $harga_jual=harga_jual($gt->kode);
                    }
                    
                    $hdiscon=$harga_jual-(($harga_jual*discon_barang($gt->kode))/100);
                    $bar=Barang::where('kode',$gt->kode)->update([ 
                        'harga_jual'=>$harga_jual,
                        'harga_discon'=>$hdiscon,
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
            if($request->status_keuangan_id==3){
                $tanggal=$request->tanggal;
                $dibayarkan=null;
                $bulan=date('m',strtotime($request->tanggal));
                $tahun=date('Y',strtotime($request->tanggal));
            }else{
                $tanggal=date('Y-m-d');
                $dibayarkan=date('Y-m-d');
                $bulan=date('m');
                $tahun=date('Y');
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
                        if($gt->harga_jual>harga_jual($gt->kode)){
                            $harga_jual=$gt->harga_jual;
                        }else{
                            $harga_jual=harga_jual($gt->kode);
                        }
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
                        ]);
                        $data=Stok::where('id',$gt->id)->update([     
                            'urut'=>($no+1),
                            'status'=>2,
                            'aktif'=>0,
                            'users_id'=>Auth::user()->id,
                            'nama_user'=>Auth::user()->name,
                            'proses'=>1,
                            'update'=>date('Y-m-d H:i:s'),
                        ]);
                    }
                    $keuangan=Keuangan::UpdateOrcreate([
                        
                        'nomor'=>kdk($request->kategori_keuangan_id).$request->nomor_stok,
                    ],[
                        'nilai'=>$request->nilai,
                        'status_keuangan_id'=>$request->status_keuangan_id,
                        'kategori_keuangan_id'=>$request->kategori_keuangan_id,
                        'keterangan'=>'Pembelian Stok kepada '.$odr->msupplier['supplier'],
                        'tanggal'=>$tanggal,
                        'bulan'=>$bulan,
                        'tahun'=>$tahun,
                        'kat'=>2,
                        'waktu'=>date('Y-m-d H:i:s'),
                    ]);

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
            
                    $data=Stok::UpdateOrcreate([
                        
                        'nomor_stok'=>$request->nomor_stok,
                        'kode'=>$request->kode,
                    ],[
                        'harga_beli'=>ubah_uang($request->harga_beli),
                        'harga_jual'=>ubah_uang($request->harga_jual),
                        'qty'=>ubah_uang($request->qty),
                        'total_jual'=>(ubah_uang($request->harga_jual)*ubah_uang($request->qty)),
                        'total_beli'=>(ubah_uang($request->harga_beli)*ubah_uang($request->qty)),
                        'expired'=>$request->expired,
                        'discon'=>$request->discon,
                        'status'=>1,
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

                    echo'@ok@'.$nomor;
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
                if($order->qty>=$request->qty_keluar){   
                    $data=Stok::create([
                        
                        'nomor_stok'=>$request->nomor_stok,
                        'kode'=>$request->kode,
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

                    $tukar=Stok::create([
                        
                        'nomor_stok'=>$request->nomor_stok,
                        'kode'=>$request->kode_tukar,
                        'tukar_id'=>$data->id,
                        'harga_beli'=>ubah_uang($request->harga_beli),
                        'harga_jual'=>ubah_uang($request->harga_jual),
                        'qty'=>ubah_uang($request->qty_tukar),
                        'total_jual'=>(ubah_uang($request->harga_jual)*ubah_uang($request->qty_tukar)),
                        'total_beli'=>(ubah_uang($request->harga_beli)*ubah_uang($request->qty_tukar)),
                        'expired'=>$order->expired,
                        'status'=>2,
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
}
