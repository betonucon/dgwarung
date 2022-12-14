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
use App\Viewkasir;
use App\Kasir;
use App\Stok;
use App\Viewstokorder;
use App\Barang;
use App\Keuangan;
use App\Viewstokkasir;
use App\Viewtransaksikasir;
use App\User;
use PDF;

class KasirController extends Controller
{
    
    public function index(request $request)
    {
        error_reporting(0);
        $template='top';
        
        return view('kasir.index',compact('template'));
    }
    
    public function create(request $request)
    {
        error_reporting(0);
        $template='top';
        $id=$request->id;
        $data=Kasir::where('nomor_transaksi',$request->id)->first();
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        if(Auth::user()->role_id==1){
            return view('kasir.create_admin',compact('template','disabled','id','data'));
        }else{
            return view('kasir.create',compact('template','disabled','id','data'));
        }
        
    }
    public function totalnya(request $request)
    {
        echo total_item_jual($request->nomor_transaksi).'@'.uang(total_harga_jual($request->nomor_transaksi));
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
            return view('kasir.view_stok',compact('template','disabled','kode','data','act'));
        }
        
    }

    public function modal(request $request)
    {
        error_reporting(0);
        $template='top';
        $id=$request->id;
        $ide=$request->ide;
        $act=$request->act;
        $order=Kasir::where('nomor_transaksi',$request->id)->first();
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('kasir.modal',compact('template','disabled','id','order','act','ide','data'));
    }
    
    public function modal_terima(request $request)
    {
        error_reporting(0);
        $template='top';
        $id=$request->id;
        $data=Kasir::where('nomor_transaksi',$request->id)->first();
        $get=Viewstokkasir::where('nomor_transaksi',$request->id)->get();
        $count=Viewstokkasir::where('nomor_transaksi',$request->id)->count();
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('kasir.modal_terima',compact('template','disabled','id','data','get','count'));
    }
    public function modal_retur(request $request)
    {
        error_reporting(0);
        $template='top';
        $kode=$request->kode;
        $data=Viewstokorder::where('kode',$request->kode)->where('status',2)->distinct()->orderBy('id','Asc')->get();
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('kasir.modal_retur',compact('template','disabled','kode','data'));
    }
    public function modal_tukar(request $request)
    {
        error_reporting(0);
        $template='top';
        $kode=$request->kode;
        $data=Viewstokorder::where('kode',$request->kode)->where('status',2)->distinct()->orderBy('id','Asc')->get();
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('kasir.modal_tukar',compact('template','disabled','kode','data'));
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
        $data=Kasir::where('nomor_transaksi',$request->id)->first();
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('kasir.modal_cetak',compact('template','disabled','id','data'));
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
        $query = Viewtransaksikasir::query();
        
        $data = $query->where('nomor_transaksi',$request->nomor_stok);
        $data = $query->distinct()->orderBy('id','Asc')->get();

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
            ->addColumn('uang_discon_jual', function ($row) {
                $btn=uang($row->discon_jual);
                return $btn;
            })
            ->addColumn('uang_total_jual', function ($row) {
                $btn=uang($row->total_jual);
                return $btn;
            })
            ->addColumn('action', function ($row) {
                $btn='
                    <div class="btn-group">
                        <span class="btn btn-danger btn-xs" onclick="delete_data('.$row->id.')"><i class="fas fa-window-close text-white"></i></span>
                    </div>
                ';
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }

    public function get_order(request $request)
    {
        error_reporting(0);
        $query = Viewkasir::query();
        
        $data = $query->orderBy('nomor_transaksi','Desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            
            ->addColumn('nama_status', function ($row) {
                $btn=status($row->status);
                return $btn;
            })
            ->addColumn('uang_nilai', function ($row) {
                $btn=uang($row->nilai);
                return $btn;
            })
            ->addColumn('opname', function ($row) {
                if($row->kategori_opname_id==1){
                    return '<font style="color:blue">Non</font>';
                }else{
                    return '<font style="color:red">Opn</font>';
                }
                
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
                    if($row->tanggal>'2022-12-16'){
                        $btn='
                        <div class="btn-group">
                            <span class="btn btn-primary btn-xs" onclick="location.assign(`'.url('kasir/create?id='.$row->nomor_transaksi).'`)"><i class="fas fa-pencil-alt text-white"></i> View</span>
                            <span class="btn btn-success btn-xs" onclick="ulangi_data('.$row->id.')"><i class="fas fa-sync text-white"></i></span>
                        </div>
                        ';
                    }else{
                        $btn='
                        <div class="btn-group">
                            <span class="btn btn-primary btn-xs" onclick="location.assign(`'.url('kasir/create?id='.$row->nomor_transaksi).'`)"><i class="fas fa-pencil-alt text-white"></i> View</span>
                        </div>
                        ';
                    }
                }else{
                    $btn='
                    <div class="btn-group">
                        <span class="btn btn-primary btn-xs" onclick="location.assign(`'.url('kasir/create?id='.$row->nomor_transaksi).'`)"><i class="fas fa-pencil-alt text-white"></i></span>
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
    
    public function get_data_even(request $request)
    {
        error_reporting(0);
        $query = Viewstokorder::query();
        if($request->even==0){

        }else{
            $data=$query->where('status',$request->even);
        }
        $data = $query->where('kode',$request->kode)->where('status','!=',1)->distinct()->orderBy('update','Desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
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
        
        $data = $query->where('status',4)->distinct()->orderBy('update','Desc')->get();

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
        
        $data = $query->where('status',5)->distinct()->orderBy('update','Desc')->get();

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
        $data = Kasir::where('id',$request->id)->first();
        if($data->status==0){
            $stok = Stok::where('nomor_transaksi',$data->nomor_transaksi)->where('status',6)->delete();
            $datahapus = Kasir::where('id',$request->id)->delete();
        }
    }
    public function ulangi_data(request $request){
        $data = Kasir::where('id',$request->id)->update([
            'status'=>0
        ]);
        
    }
    public function delete_data_stok(request $request){
        $data = Stok::where('id',$request->id)->delete();
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
        
        $rules['konsumen']= 'required';
        $messages['konsumen.required']= 'Masukan Nama Konsumen';
        
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
                    $nomor=penomoran_kasir();
                    if($request->kategori_opname_id==1){
                        if($request->tanggal==date('Y-m-d')){
                            $kategori=1;
                        }else{
                            $kategori=2;
                        }
                    }else{
                        $kategori=$request->kategori_opname_id;
                    }
                    $data=Kasir::create([
                        
                        'nomor_transaksi'=>$nomor,
                        'konsumen'=>$request->konsumen,
                        'kategori_opname_id'=>$kategori,
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
            $odr=Kasir::where('nomor_transaksi',$request->nomor_transaksi)->first();
            if($request->status_keuangan_id==3){
                $tanggal=$odr->tanggal;
                $dibayarkan=null;
                $bulan=date('m',strtotime($tanggal));
                $tahun=date('Y',strtotime($tanggal));
            }else{
                $tanggal=$odr->tanggal;
                $dibayarkan=date('Y-m-d');
                $bulan=date('m',strtotime($tanggal));
                $tahun=date('Y',strtotime($tanggal));
            }
            if($request->ready==$request->count){
                    
                    $get=Viewtransaksikasir::where('nomor_transaksi',$request->nomor_transaksi)->get();
                    $data=Kasir::where('nomor_transaksi',$request->nomor_transaksi)->update([
                        
                        'status'=>1,
                        'nilai'=>$request->nilai,
                        'waktu'=>date('Y-m-d H:i:s'),
                    ]);
                    foreach($get as $no=>$gt){
                        $data=Stok::where('id',$gt->id)->update([
                            
                            'urut'=>($no+1),
                            'status'=>3,
                            'proses'=>1,
                            'kategori_opname_id'=>$odr->kategori_opname_id,
                            'users_id'=>Auth::user()->id,
                            'nama_user'=>Auth::user()->name,
                            'update'=>date('Y-m-d H:i:s'),
                        ]);
                    }
                    if($odr->kategori_opname_id==1){
                        $keuangan=Keuangan::UpdateOrcreate([
                            
                            'nomor'=>kdk($request->kategori_keuangan_id).'2'.$request->nomor_transaksi,
                            'nomor_transaksi'=>$request->nomor_transaksi,
                        ],[
                            'nilai'=>$request->nilai,
                            'status_keuangan_id'=>$request->status_keuangan_id,
                            'kategori_keuangan_id'=>$request->kategori_keuangan_id,
                            'keterangan'=>'Pembayaran penjualan dari '.$odr->konsumen,
                            'tanggal'=>$tanggal,
                            'bulan'=>$bulan,
                            'tahun'=>$tahun,
                            'kat'=>2,
                            'waktu'=>date('Y-m-d H:i:s'),
                        ]);
                        if($request->status_keuangan_id==1){
                            $provit=Keuangan::UpdateOrcreate([
                                'nomor_transaksi'=>$request->nomor_transaksi,
                                'nomor'=>kdk(6).'2'.$request->nomor_transaksi,
                            ],[
                                'nilai'=>$request->provite,
                                'status_keuangan_id'=>$request->status_keuangan_id,
                                'kategori_keuangan_id'=>6,
                                'keterangan'=>'Pembayaran pennjualan dari '.$odr->konsumen,
                                'tanggal'=>$tanggal,
                                'bulan'=>$bulan,
                                'tahun'=>$tahun,
                                'kat'=>2,
                                'waktu'=>date('Y-m-d H:i:s'),
                            ]);
                        }
                    }

                    echo'@ok@'.$nomor;
                
            }else{
                echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
                echo'Sebagian barang qty melebihi stok';
                echo'</div></div>';
            }
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

        $rules['harga_jual']= 'required|min:0|not_in:0';
        $messages['harga_jual.required']= 'Lengkapi harga jual';
        $messages['harga_jual.not_in']= 'Lengkapi harga jual';

        $rules['qty']= 'required|min:0|not_in:0';
        $messages['qty.required']= 'Lengkapi Qty';
        $messages['qty.not_in']= 'Lengkapi Qty';
        $rules['stok']= 'required|min:0|not_in:0';
        $messages['stok.required']= 'Lengkapi stok';
        $messages['stok.not_in']= 'Lengkapi stok';

       
       
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
                $odr=Stok::where('nomor_stok',$request->nomor_stok)->where('kode',$request->kode)->where('status',2)->first();
                if($request->stok>=$request->qty){  
                    if(ubah_uang($request->discon_jual)>0){
                        $dicon=ubah_uang($request->discon_jual);
                    }else{
                        $dicon=0;
                    }
                    $jualh=ubah_uang($request->harga_jual)-$dicon; 
                    $totaljual=($jualh*ubah_uang($request->qty));
                    $totalbeli=(ubah_uang($odr->harga_beli)*ubah_uang($request->qty));
                    $data=Stok::UpdateOrcreate([
                        
                        'nomor_transaksi'=>$request->nomor_transaksi,
                        'nomor_stok'=>$request->nomor_stok,
                        'kode'=>$request->kode,
                    ],[
                        'harga_beli'=>ubah_uang($odr->harga_beli),
                        'discon_jual'=>$dicon,
                        'harga_jual'=>$jualh,
                        'qty'=>ubah_uang($request->qty),
                        'total_jual'=>$totaljual,
                        'total_beli'=>$totalbeli,
                        'provite'=>($totaljual-$totalbeli),
                        'expired'=>$odr->expired,
                        'status'=>6,
                        'bulan'=>date('m'),
                        'tahun'=>date('Y'),
                        'waktu'=>date('Y-m-d H:i:s'),
                    ]);

                    echo'@ok@'.total_item_jual($request->nomor_transaksi).'@'.uang(total_harga_jual($request->nomor_transaksi));
                }else{
                    echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
                    echo'Stok tidak mencukupi';
                    echo'</div></div>';
                }
                
            
        }
    }


    public function cetak(Request $request)
    {
        error_reporting(0);
        $order=Kasir::where('nomor_transaksi',$request->id)->first();
        $count=jumlah_item_order_kasir($request->id);
        $ford=ceil(jumlah_item_order_kasir($request->id)/18);
        // $ford=3;
        $pdf = PDF::loadView('kasir.cetak', compact('data','order','ford','count'));
        // $custom=array(0,0,500,400);
        $pdf->setPaper('A4','portrait');
        $pdf->stream($request->id.'.pdf');
        return $pdf->stream();
    }
    public function print(Request $request)
    {
        error_reporting(0);
        $order=Kasir::where('nomor_transaksi',$request->id)->first();
        $count=jumlah_item_order_kasir($request->id);
        $ford=ceil(jumlah_item_order_kasir($request->id)/18);
        // $ford=3;
        return view('kasir.print', compact('data','order','ford','count'));
        
    }
}
