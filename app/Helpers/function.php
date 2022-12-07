
<?php

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
function setting_provit_value(){
    $data=App\Setting::where('id',1)->first();
    return $data->setting_int_value;
}
function total_item_stok($nomor_stok){
    $data=App\Stok::where('nomor_stok',$nomor_stok)->count();
    return $data;
}
function total_item_jual($nomor_transaksi){
    $data=App\Stok::where('nomor_transaksi',$nomor_transaksi)->count();
    return $data;
}
function total_harga_stok($nomor_stok){
    $data=App\Stok::where('nomor_stok',$nomor_stok)->sum('total_beli');
    return $data;
}
function total_harga_jual($nomor_transaksi){
    $data=App\Stok::where('nomor_transaksi',$nomor_transaksi)->sum('total_jual');
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
    $data=App\Satuan::orderBy('id','Asc')->get();
    return $data;
}
function get_statuskeuangan(){
    $data=App\Statuskeuangan::orderBy('id','Asc')->get();
    return $data;
}
function first_setting($id){
    $data=App\Setting::where('id',$id)->first();
    return $data;
}
function get_supplier(){
    $data=App\Supplier::orderBy('supplier','Asc')->get();
    return $data;
}
function get_barang(){
    $data=App\Barang::orderBy('nama_barang','Asc')->get();
    return $data;
}
function get_stokready(){
    if(setting_aktive_stok()==1){
        $data=App\Stokup::where('sisa','>',0)->orderBy('nama_barang','Asc')->get();
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
    $data=App\Barang::select('nama_barang','join_kode')->groupBy('nama_barang','join_kode')->orderBy('nama_barang','Asc')->get();
    return $data;
}
function first_join_kode($join_kode){
    $data=App\Barang::where('join_kode',$join_kode)->orderBy('id','Asc')->firstOrfail();
    return $data['nama_barang'];
}
function keuangan_total($status_keuangan){
    $data=App\Keuangan::where('status_keuangan_id',$status_keuangan)->sum('nilai');
    return $data;
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
function penomoran(){
    
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
        $mst=App\Stokorder::where('bulan',date('m'))->where('tahun',date('Y'))->orderBy('nomor_transaksi','Desc')->firstOrfail();
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