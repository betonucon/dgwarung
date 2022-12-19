
<?php
use Illuminate\Support\Facades\Crypt;
function name(){
    return "Kedai PePE";
}
function telepon(){
    return "0254 233795";
}

function bulan($bulan)
{
   Switch ($bulan){
      case '01' : $bulan="Januari";
         Break;
      case '02' : $bulan="Februari";
         Break;
      case '03' : $bulan="Maret";
         Break;
      case '04' : $bulan="April";
         Break;
      case '05' : $bulan="Mei";
         Break;
      case '06' : $bulan="Juni";
         Break;
      case '07' : $bulan="Juli";
         Break;
      case '08' : $bulan="Agustus";
         Break;
      case '09' : $bulan="September";
         Break;
      case 10 : $bulan="Oktober";
         Break;
      case 11 : $bulan="November";
         Break;
      case 12 : $bulan="Desember";
         Break;
      }
   return $bulan;
}

function ubah_bulan($bul){
    if($bul>9){
        return $bul;
    }else{
        return '0'.$bul;
    }
}
function parsing_validator($url){
    $content=utf8_encode($url);
    $data = json_decode($content,true);
 
    return $data;
}
function kelurahan(){
    return "Deringo";
}
function nama_lurah(){
    return "DR Cecep";
}
function nip_lurah(){
    return "1101920001";
}
function kecamatan(){
    return "Citangkil";
}
function kota(){
    return "Cilegon";
}
function rekening(){
    return "163000000930300";
}
function phone(){
    return "62 21 5596 1456";
}
function whatsapp(){
    return "62 81 1800 9129";
}
function uang($uang){
    return number_format($uang,0);
}
function encoder($b) {
    $data=base64_encode(base64_encode($b));
    return $data;
 }
 function decoder($b) {
    $data=base64_decode(base64_decode($b));
    return $data;
 }
function hari_tagihan($tgl){
    $pinjam            = $tgl;
    $time        = mktime(0,0,0,date("n"),date("j")+7,date("Y"));
    $data        = date("Y-m-d", $time);
    return $data;
}
function masa_diskon($id){
    $tglmulai=date('Y-m-d');
    $tgl=date('Y-m-d');
    if($tglmulai<=date('Y-m-d') && $tgl>=date('Y-m-d')){
        $tgl1 = new DateTime(date('Y-m-d'));
        $tgl2 = new DateTime($tgl);
        $jarak = $tgl2->diff($tgl1);

        $data=($jarak->d+1);
    }else{
        $data=0;
    }
    return $data;
}



function cek_aktif($id){
    if($id==1){
        return'Aktif';
    }else{
        return'Non Aktif';
    }
}

function cek_sts($id){
    if($id==1){
        return'<span class="label label-info">Perencanaan</span>';
    }
    if($id==2){
        return'<span class="label label-warning">Permintaan</span>';
    }
    if($id==3){
        return'<span class="label label-success">Selesai</span>';
    }
}
function cek_tagihan($nilai1,$nilai2,$sts){
    if($sts==3){
        if($nilai1==$nilai2){
            return'<span class="label label-info">LUNAS</span>';
        }
        else{
            return'<span class="label label-red">HUTANG</span>';
        }
    }else{
        return'-';
    }
}
function cek_metode($id){
    if($id==1){
        return'CASH';
    }
    if($id==2){
        return'TEMPO';
    }
    if($id==3){
        return'-';
    }
}

function diskon($harga,$diskon){
    $data=($harga*$diskon)/100;
    $diskon=($harga-$data);
    return $diskon;

}

function diskon_harga($id,$harga,$diskon){
    if( masa_diskon($id)>0){
        $data=($harga*$diskon)/100;
        $diskon=($harga-$data);
    }else{
        $diskon=$harga;
    }
    
    return $diskon;

}
function tanggal_eng($date=null){
    if($date=="" || $date==null){
       return null;
    }else{
       return date('d M Y H:i:s',strtotime($date));
    }
    
 }
function tanggal_simple($date=null){
    if($date=="" || $date==null){
       return null;
    }else{
       return date('d/m/y H:i:s',strtotime($date));
    }
    
 }
function tahun_saja($date=null){
    if($date=="" || $date==null){
       return null;
    }else{
       return date('Y',strtotime($date));
    }
    
 }
function bulan_saja($date=null){
    if($date=="" || $date==null){
       return null;
    }else{
       return date('m',strtotime($date));
    }
    
 }
function tanggal_tok($date=null){
    if($date=="" || $date==null){
       return null;
    }else{
       return date('d M Y',strtotime($date));
    }
    
 }
function email(){
    return "Tokosparepart@gmail.com";
}
function url_plug(){
    $data=url('public');
    return $data;
}
function selisih_waktu($waktu1,$waktu2){
    $waktu_awal        =strtotime($waktu1);
    $waktu_akhir        =strtotime($waktu2);
    $diff    =$waktu_akhir - $waktu_awal;
    $jam    =floor($diff / (60 * 60));
    $menit    =$diff - $jam * (60 * 60);
    $data= $jam .  ' Hrs ' . floor( $menit / 60 ) . ' min';
    return $data;
 }
function selisih_waktu_jam($waktu1,$waktu2){
    $waktu_awal        =strtotime($waktu1);
    $waktu_akhir        =strtotime($waktu2);
    $diff    =$waktu_akhir - $waktu_awal;
    $jam    =floor($diff / (60 * 60));
    $menit    =$diff - $jam * (60 * 60);
    $data= $jam;
    return $data;
 }
function gambar(){
    $data=url('public/dist/produk/');
    return $data;
}
function ubah_uang($uang){
    $patr='/([^0-9]+)/';
    $ug=explode('.',$uang);
    $data=preg_replace($patr,'',$ug[0]);
    return $data;
 }
function link_artikel($nama){
    $patr='/\s+/';
    $link=preg_replace($patr,'_',$nama);
    return $link;
}
function setting_provit(){
    $data=App\Setting::where('id',1)->first();
    return $data->setting_int;
}
function setting_harga_jual(){
    $data=App\Setting::where('id',6)->first();
    return $data->setting_int;
}
function setting_page_print(){
    $data=App\Setting::where('id',5)->first();
    return $data->setting_int;
}
function sum_gaji(){
    $data=App\Employe::where('status',1)->sum('gaji');
    return $data;
}
function get_employe(){
    $data=App\Employe::where('status',1)->get();
    return $data;
}
function get_kategoriopname(){
    $data=App\Kategoriopname::orderBy('id','Asc')->get();
    return $data;
}
function encp($id){
    $data = Crypt::encryptString($id);
    return $data;
}
function decp($id){
    $data = Crypt::encryptString($id);
    return $data;
}
function aktive_transaksi(){
    $data=App\Setting::where('id',4)->first();
    return $data->setting_int;
}
function get_katkeuangan(){
    if(Auth::user()->role_id==1){
        $data=App\Kategorikeuangan::whereIn('id',array('1','2'))->orderBy('id','Asc')->get();
    }else{
        $data=App\Kategorikeuangan::whereIn('id',array('1','2'))->orderBy('id','Asc')->get();
    }
   
    return $data;
}
function get_setkeuangan(){
    $data=App\Statuskeuangan::get();
    return $data;
}
function setting_provit_value(){
    $data=App\Setting::where('id',1)->first();
    return $data->setting_int_value;
}
function total_item_stok($nomor_stok){
    $data=App\Stok::where('nomor_stok',$nomor_stok)->whereIn('status',array(1,2))->count();
    return $data;
}
function total_item_jual($nomor_transaksi){
    $data=App\Stok::where('nomor_transaksi',$nomor_transaksi)->count();
    return $data;
}
function cetak_item($nomor_stok,$x){
    if($x==1){
        $data=App\Viewstokorder::where('nomor_stok',$nomor_stok)->where('status',2)->whereBetween('urut',[1,18])->orderBy('urut','Asc')->get();
    }
    if($x==2){
        $data=App\Viewstokorder::where('nomor_stok',$nomor_stok)->where('status',2)->whereBetween('urut',[19,37])->orderBy('urut','Asc')->get();
    }
    if($x==3){
        $data=App\Viewstokorder::where('nomor_stok',$nomor_stok)->where('status',2)->whereBetween('urut',[37,56])->orderBy('urut','Asc')->get();
    }
    if($x==4){
        $data=App\Viewstokorder::where('nomor_stok',$nomor_stok)->where('status',2)->whereBetween('urut',[56,75])->orderBy('urut','Asc')->get();
    }
    if($x==5){
        $data=App\Viewstokorder::where('nomor_stok',$nomor_stok)->where('status',2)->whereBetween('urut',[75,94])->orderBy('urut','Asc')->get();
    }
    
    return $data;
}
function cetak_item_kasir($nomor_transaksi,$x){
    if($x==1){
        $data=App\Viewstokkasir::where('nomor_transaksi',$nomor_transaksi)->whereBetween('urut',[1,18])->orderBy('urut','Asc')->get();
    }
    if($x==2){
        $data=App\Viewstokkasir::where('nomor_transaksi',$nomor_transaksi)->whereBetween('urut',[19,37])->orderBy('urut','Asc')->get();
    }
    if($x==3){
        $data=App\Viewstokkasir::where('nomor_transaksi',$nomor_transaksi)->whereBetween('urut',[37,56])->orderBy('urut','Asc')->get();
    }
    if($x==4){
        $data=App\Viewstokkasir::where('nomor_transaksi',$nomor_transaksi)->whereBetween('urut',[56,75])->orderBy('urut','Asc')->get();
    }
    if($x==5){
        $data=App\Viewstokkasir::where('nomor_transaksi',$nomor_transaksi)->whereBetween('urut',[75,94])->orderBy('urut','Asc')->get();
    }
    
    return $data;
}
function total_harga_stok($nomor_stok){
    $data=App\Stok::where('nomor_stok',$nomor_stok)->whereIn('status',array(1,2))->sum('total_beli');
    return $data;
}
function jumlah_item_order($nomor_stok){
    $data=App\Stok::where('nomor_stok',$nomor_stok)->count();
    return $data;
}
function sum_item_order($nomor_stok){
    $data=App\Stok::where('nomor_stok',$nomor_stok)->whereIn('status',array(1,2))->sum('total_beli');
    return $data;
}
function jumlah_item_order_kasir($nomor_transaksi){
    $data=App\Stok::where('nomor_transaksi',$nomor_transaksi)->count();
    return $data;
}
function sum_item_order_kasir($nomor_transaksi){
    $data=App\Stok::where('nomor_transaksi',$nomor_transaksi)->whereIn('status',array(3,6))->sum('total_jual');
    return $data;
}
function harga_jual($kode){
    $data=App\Barang::where('kode',$kode)->first();
    return $data->harga_jual;
}
function harga_discon($kode){
    $data=App\Barang::where('kode',$kode)->first();
    return $data->harga_discon;
}
function discon_barang($kode){
    $data=App\Barang::where('kode',$kode)->first();
    return $data->discon;
}
function harga_beli($kode){
    $data=App\Barang::where('kode',$kode)->first();
    return $data->harga_beli;
}
function total_harga_jual($nomor_transaksi){
    $data=App\Stok::where('nomor_transaksi',$nomor_transaksi)->sum('total_jual');
    return $data;
}
function total_harga_provite($nomor_transaksi){
    $data=App\Stok::where('nomor_transaksi',$nomor_transaksi)->sum('provite');
    return $data;
}
function total_harga_beli($nomor_transaksi){
    $data=App\Stok::where('nomor_transaksi',$nomor_transaksi)->sum('total_beli');
    return $data;
}
function sisa($kode){
    $masuk=App\Stok::where('kode',$kode)->where('status',2)->sum('qty');
    $keluar=App\Stok::where('kode',$kode)->whereIn('status',array(3,4,5))->sum('qty');
    return ($masuk-$keluar);
}
function even_stok($kode,$status){
    $masuk=App\Stok::where('kode',$kode)->where('status',$status)->sum('qty');
    return $masuk;
}
function setting_aktive_stok(){
    $data=App\Setting::where('id',2)->first();
    return $data->setting_int;
}
function setting_font_print(){
    $data=App\Setting::where('id',3)->first();
    return $data->setting_int;
}
function setting_aktive_stok_value(){
    $data=App\Setting::where('id',2)->first();
    return $data->setting_int_value;
}
function get_satuan(){
    $data=App\Satuan::whereIn('id',array(1,2))->orderBy('id','Asc')->get();
    return $data;
}
function get_statuskeuangan(){
    if(Auth::user()->role_id==1){
        $data=App\Statuskeuangan::orderBy('id','Asc')->get();
    }else{
        $data=App\Statuskeuangan::whereIn('id',array('1','2','3'))->orderBy('id','Asc')->get();
    }
    
    return $data;
}
function first_setting($id){
    $data=App\Setting::where('id',$id)->first();
    return $data;
}

function pembulatan($uang)
{
    $ratusan = substr($uang, -3);
    if($ratusan<500)
    $akhir = $uang - $ratusan;
    else
    $akhir = $uang + (1000-$ratusan);
    return $akhir;
}
function get_supplier(){
    $data=App\Supplier::orderBy('supplier','Asc')->get();
    return $data;
}
function get_barang(){
    $data=App\Barang::where('aktive',1)->orderBy('nama_barang','Asc')->get();
    return $data;
}
function get_stokready(){
    if(setting_aktive_stok()==1){
        $data=App\Stokup::select('kode','nama_barang')->where('sisa','>',0)->groupBy('kode','nama_barang')->orderBy('nama_barang','Asc')->get();
    }else{
        $data=App\Stokup::where('aktif','>',1)->orderBy('nama_barang','Asc')->get();
    }
    
    return $data;
}
function stok_ready($kode){
    if(setting_aktive_stok()==1){
        $cek=App\Stokup::where('kode',$kode)->where('status',2)->where('sisa','>',0)->count();
        if($cek>0){
            $data=App\Stokup::where('kode',$kode)->where('status',2)->where('sisa','>',0)->orderBy('id','Asc')->firstOrfail();
            return $data['sisa'];
        }else{
            return 0;
        }
    }else{
        $cek=App\Stokup::where('kode',$kode)->where('status',2)->where('aktif',1)->count();
        if($cek>0){
            $data=App\Stokup::where('kode',$kode)->where('status',2)->where('aktif',1)->first();
            return $data['sisa'];
        }else{
            return 0;
        }
    }
    
}
function nomor_stok_ready($kode){
    if(setting_aktive_stok()==1){
        $cek=App\Stokup::where('kode',$kode)->where('status',2)->where('sisa','>',0)->count();
        if($cek>0){
            $data=App\Stokup::where('kode',$kode)->where('status',2)->where('sisa','>',0)->orderBy('id','Asc')->firstOrfail();
            return $data['nomor_stok'];
        }else{
            return 0;
        }
    }else{
        $cek=App\Stokup::where('kode',$kode)->where('status',2)->where('aktif',1)->count();
        if($cek>0){
            $data=App\Stokup::where('kode',$kode)->where('status',2)->where('aktif',1)->first();
            return $data['nomor_stok'];
        }else{
            return 0;
        }
    }
}
function supplier_stok_ready($kode){
    if(setting_aktive_stok()==1){
        $cek=App\Stokup::where('kode',$kode)->where('status',2)->where('sisa','>',0)->count();
        if($cek>0){
            $data=App\Stokup::where('kode',$kode)->where('status',2)->where('sisa','>',0)->orderBy('id','Asc')->firstOrfail();
            return $data->mstokorder->msupplier['supplier'];
        }else{
            return 0;
        }
    }else{
        $cek=App\Stokup::where('kode',$kode)->where('status',2)->where('aktif',1)->count();
        if($cek>0){
            $data=App\Stokup::where('kode',$kode)->where('status',2)->where('aktif',1)->first();
            return $data['nomor_stok'];
        }else{
            return 0;
        }
    }
}
function jual_stok_ready($kode){
    if(setting_aktive_stok()==1){
        $cek=App\Stokup::where('kode',$kode)->where('status',2)->where('sisa','>',0)->count();
        if($cek>0){
            $data=App\Stokup::where('kode',$kode)->where('status',2)->where('sisa','>',0)->orderBy('id','Asc')->firstOrfail();
            return $data['harga_jual'];
        }else{
            return 0;
        }
    }else{
        $cek=App\Stokup::where('kode',$kode)->where('status',2)->where('aktif',1)->count();
        if($cek>0){
            $data=App\Stokup::where('kode',$kode)->where('status',2)->where('aktif',1)->first();
            return $data['harga_jual'];
        }else{
            return 0;
        }
    }
}
function beli_stok_ready($kode){
    if(setting_aktive_stok()==1){
        $cek=App\Stokup::where('kode',$kode)->where('status',2)->where('sisa','>',0)->count();
        if($cek>0){
            $data=App\Stokup::where('kode',$kode)->where('status',2)->where('sisa','>',0)->orderBy('id','Asc')->firstOrfail();
            return $data['harga_beli'];
        }else{
            return 0;
        }
    }else{
        $cek=App\Stokup::where('kode',$kode)->where('status',2)->where('aktif',1)->count();
        if($cek>0){
            $data=App\Stokup::where('kode',$kode)->where('status',2)->where('aktif',1)->first();
            return $data['harga_beli'];
        }else{
            return 0;
        }
    }
}
function get_join_kode(){
    $data=App\Barang::select('nama_barang','join_kode','kode')->where('aktive',1)->groupBy('nama_barang','join_kode','kode')->orderBy('nama_barang','Asc')->get();
    return $data;
}
function first_join_kode($join_kode){
    $data=App\Barang::where('join_kode',$join_kode)->orderBy('id','Asc')->firstOrfail();
    return $data['nama_barang'];
}
function bulan_gaji($nomor){
    $data=App\Gaji::where('nomor',$nomor)->orderBy('id','Desc')->firstOrfail();
    return $data['bulan'];
}
function tahun_gaji($nomor){
    $data=App\Gaji::where('nomor',$nomor)->orderBy('id','Desc')->firstOrfail();
    return $data['tahun'];
}
function keuangan_total($status_keuangan){
    $data=App\Keuangan::where('status_keuangan_id',$status_keuangan)->sum('nilai');
    return $data;
}
function total_keluar($id){
    $saldo=App\Keuangan::whereIn('status_keuangan_id',array(2))->where('tahun',$id)->where('kategori_keuangan_id',1)->sum('nilai');
    return $saldo;
}
function total_piutang($id){
    $saldo=App\Keuangan::whereIn('status_keuangan_id',array(3))->where('tahun',$id)->where('kategori_keuangan_id',1)->sum('nilai');
    return $saldo;
}
function total_tempo($id){
    $saldo=App\Keuangan::whereIn('status_keuangan_id',array(4))->where('tahun',$id)->where('kategori_keuangan_id',2)->sum('nilai');
    return $saldo;
}
function total_keluar_bulan($bulan,$tahun,$tanggal){
    $saldo=App\Keuangan::whereIn('status_keuangan_id',array(2))->where('bulan',$bulan)->where('tahun',$tahun)->where('kategori_keuangan_id',1)->sum('nilai');
    return $saldo;
}
function total_keluar_tanggal($tanggal){
    $saldo=App\Keuangan::whereIn('status_keuangan_id',array(2))->where('tanggal',$tanggal)->where('kategori_keuangan_id',1)->sum('nilai');
    return $saldo;
}
function total_piutang_bulan($bulan,$tahun,$tanggal){
    $saldo=App\Keuangan::whereIn('status_keuangan_id',array(3))->where('bulan',$bulan)->where('tahun',$tahun)->where('kategori_keuangan_id',1)->sum('nilai');
    return $saldo;
}
function total_tempo_bulan($bulan,$tahun,$tanggal){
    $saldo=App\Keuangan::whereIn('status_keuangan_id',array(4))->where('bulan',$bulan)->where('tahun',$tahun)->where('kategori_keuangan_id',2)->sum('nilai');
    return $saldo;
}
function total_piutang_tanggal($tanggal){
    $saldo=App\Keuangan::whereIn('status_keuangan_id',array(3))->where('tanggal',$tanggal)->where('kategori_keuangan_id',1)->sum('nilai');
    return $saldo;
}
function total_tempo_tanggal($tanggal){
    $saldo=App\Keuangan::whereIn('status_keuangan_id',array(4))->where('tanggal',$tanggal)->where('kategori_keuangan_id',2)->sum('nilai');
    return $saldo;
}
function cetak_get_keuangan($tanggal,$tahun){
    if($tanggal=='all'){
        $saldo=App\Viewkeuangan::where('tahun',$tahun)->orderBy('tanggal','Asc')->get();
    }else{
        $saldo=App\Viewkeuangan::where('tanggal',$tanggal)->orderBy('id','Asc')->get();
    }
    
    return $saldo;
}

function total_provit_keluar($id){
    $saldo=App\Keuangan::where('status_keuangan_id',2)->where('tahun',$id)->whereNotIn('kategori_keuangan_id',array(1,2))->sum('nilai');
    return $saldo;
}
function total_provit_keluar_bulan($bulan,$tahun,$tanggal){
    $saldo=App\Keuangan::where('status_keuangan_id',2)->where('bulan',$bulan)->where('tahun',$tahun)->whereNotIn('kategori_keuangan_id',array(1,2))->sum('nilai');
    return $saldo;
}
function total_provit_keluar_tanggal($tanggal){
    $saldo=App\Keuangan::where('status_keuangan_id',2)->where('tanggal',$tanggal)->whereNotIn('kategori_keuangan_id',array(1,2))->sum('nilai');
    return $saldo;
}


function total_saldo($id){
    $saldo=App\Keuangan::where('status_keuangan_id',1)->where('tahun',$id)->where('kategori_keuangan_id',2)->sum('nilai');
    return ($saldo-total_keluar($id));
}
function total_saldo_bulan($bulan,$tahun,$tanggal){
    $saldo=App\Keuangan::where('status_keuangan_id',1)->where('kategori_keuangan_id',2)->where('bulan',$bulan)->where('tahun',$tahun)->sum('nilai');
    return ($saldo);
}
function total_saldo_tanggal_sebelumnya($tanggal){
    $saldo=App\Keuangan::where('status_keuangan_id',1)->where('kategori_keuangan_id',2)->where('tanggal','<=',$tanggal)->sum('nilai');
    return ($saldo-total_keluar_tanggal($tanggal));
    
}
function total_saldo_tanggal($tanggal){
    $saldo=App\Keuangan::where('status_keuangan_id',1)->where('kategori_keuangan_id',2)->where('tanggal',$tanggal)->sum('nilai');
    return $saldo;
    
}
function total_provit($id){
    $saldo=App\Keuangan::where('status_keuangan_id',1)->where('tahun',$id)->where('kategori_keuangan_id',6)->sum('nilai');
    return ($saldo-total_provit_keluar($id));
}
function total_provit_bulan($bulan,$tahun,$tanggal){
    
    $saldo=App\Keuangan::where('status_keuangan_id',1)->where('kategori_keuangan_id',6)->where('bulan',$bulan)->where('tahun',$tahun)->sum('nilai');
    return ($saldo-total_provit_keluar_bulan($bulan,$tahun,$tanggal));
}
function total_provit_tanggal($tanggal){
    $saldo=App\Keuangan::where('status_keuangan_id',1)->where('kategori_keuangan_id',6)->where('tanggal',$tanggal)->sum('nilai');
    return ($saldo-total_provit_keluar_tanggal($tanggal));
}
function keuangan_estimasi($status_keuangan){
    if($status_keuangan==1){
        $data=App\Stok::where('status',2)->where('tukar_id',null)->sum('total_beli');
        return $data;
    }
    if($status_keuangan==2){
        $data=App\Stok::where('status',2)->where('tukar_id',null)->sum('total_jual');
        return $data;
    }
    if($status_keuangan==3){
        $beli=App\Stok::where('status',2)->where('tukar_id',null)->sum('total_beli');
        $jual=App\Stok::where('status',2)->where('tukar_id',null)->sum('total_jual');
        return ($jual-$beli);
    }
    
}
function status($id){
    if($id==0){
        return '<font color="green">Proses</font>';
    }
    if($id==1){
        return '<font color="blue">Selesai</font>';
    }
    
    
}
function keuangan_aktual($status_keuangan){
    if($status_keuangan==1){
        $data=App\Stok::where('status',2)->where('tukar_id',null)->sum('total_beli');
        return $data;
    }
    if($status_keuangan==2){
        $data=App\Stok::where('status',3)->where('tukar_id',null)->sum('total_jual');
        return $data;
    }
    if($status_keuangan==3){
        $beli=App\Stok::where('status',3)->where('tukar_id',null)->sum('provite');
        return ($jual-$beli);
    }
    
}
function id_supplier($supplier){
    $data=App\Supplier::where('supplier',$supplier)->first();
    return $data['id'];
}
function satuan($kd_satuan){
    $data=App\Satuan::where('kd_satuan',$kd_satuan)->first();
    return $data['satuan'];
}
function status_provit($id){
    if($id==1){
        return 'Berdasarkan Persentase';
    }else{
        return 'Manual';
    }
}
function status_aktive_stok($id){
    if($id==1){
        return 'Otomatis FIFO';
    }else{
        return 'Pilih Manual';
    }
}
function kdk($id){
    $data=App\Kategorikeuangan::where('id',$id)->first();
    return $data->kdk;
}
function join_kode(){
    
    $cek=App\Barang::count();
    if($cek>0){
        $mst=App\Barang::orderBy('join_kode','Desc')->firstOrfail();
        $urutan = (int) substr($mst['join_kode'], 0, 5);
        $urutan++;
        $nomor=sprintf("%05s",  $urutan);
    }else{
        $nomor=sprintf("%05s",  1);
    }
    return $nomor;
}
function penomoran($kd_satuan,$join_kode){
    
    $cek=App\Barang::where('tahun',date('y'))->count();
    if($cek>0){
        $mst=App\Barang::where('tahun',date('y'))->orderBy('join_kode','Desc')->firstOrfail();
        $urutan = (int) substr($mst['join_kode'], 0, 5);
        $urutan++;
        $nomor=sprintf("%05s",  $urutan);
    }else{
        $nomor=sprintf("%05s",  1);
    }
    return $nomor;
}
function penomoran_keuangan($kategori_keuangan_id,$ide){
    
    $cek=App\Keuangan::where('kategori_keuangan_id',$kategori_keuangan_id)->where('kat',$ide)->count();
    if($cek>0){
        $mst=App\Keuangan::where('kategori_keuangan_id',$kategori_keuangan_id)->where('kat',$ide)->orderBy('nomor','Desc')->firstOrfail();
        $urutan = (int) substr($mst['nomor'], 6, 7);
        $urutan++;
        $nomor=kdk($kategori_keuangan_id).$ide.date('ym').sprintf("%07s",  $urutan);
    }else{
        $nomor=kdk($kategori_keuangan_id).$ide.date('ym').sprintf("%07s",  1);
    }
    return $nomor;
}
function penomoran_masuk(){
    
    $cek=App\Stokorder::where('bulan',date('m'))->where('tahun',date('Y'))->count();
    if($cek>0){
        $mst=App\Stokorder::where('bulan',date('m'))->where('tahun',date('Y'))->orderBy('nomor_stok','Desc')->firstOrfail();
        $urutan = (int) substr($mst['nomor_stok'], 4, 7);
        $urutan++;
        $nomor=date('ym').sprintf("%07s",  $urutan);
    }else{
        $nomor=date('ym').sprintf("%07s",  1);
    }
    return $nomor;
}
function penomoran_kasir(){
    
    $cek=App\Kasir::where('bulan',date('m'))->where('tahun',date('Y'))->count();
    if($cek>0){
        $mst=App\Kasir::where('bulan',date('m'))->where('tahun',date('Y'))->orderBy('nomor_transaksi','Desc')->firstOrfail();
        $urutan = (int) substr($mst['nomor_transaksi'], 4, 7);
        $urutan++;
        $nomor=date('ym').sprintf("%07s",  $urutan);
    }else{
        $nomor=date('ym').sprintf("%07s",  1);
    }
    return $nomor;
}
// function penomoran($kd_satuan){
    
//     $cek=App\Barang::where('kd_satuan',$kd_satuan)->count();
//     if($cek>0){
//         $mst=App\Barang::where('kd_satuan',$kd_satuan)->orderBy('kode','Desc')->firstOrfail();
//         $urutan = (int) substr($mst['kode'], 3, 5);
//         $urutan++;
//         $nomor='BR'.$kd_satuan.sprintf("%05s",  $urutan);
//     }else{
//         $nomor='BR'.$kd_satuan.sprintf("%05s",  1);
//     }
//     return $nomor;
// }




?>