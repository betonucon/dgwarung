<html>
    <head>
        <title>CETAK</title>
        <style>
            html{
                color:#000;
                margin:2%;
            }
            
            table{
                border-collapse:collapse;
            }
            .tth{
                text-align:center;
                font-size:20px;
            }
            .tthl{
                text-align:left;
                font-size:15px;
            }
            .tthlb{
                text-align:left;
                font-size:15px;
            }
            .ttd{
                border-right:solid 1px #000;
                border-left:solid 1px #000;
                padding:2px 4px 2px 4px;
                font-size:15px;
               
            }
            .ttdr{
                padding:2px 4px 2px 4px;
                font-size:15px;
                text-align:right;
                border-left:solid 1px #000;
                border-right:solid 1px #000;
            }
            .ttdro{
                border-right:solid 1px #000;
                padding:0px 4px 0px 4px;
                font-size:15px;
                text-align:right;
            }
            .ttdc{
                border:solid 1px #000;
                padding:0px 4px 0px 4px;
                font-size:15px;
                text-align:center;
            }
            .ttdh{
                font-weight:bold;
                text-align:center;
                text-transform:uppercase;
                border:solid 2px #000;
                padding:4px 4px 4px 4px;
                font-size:15px;
               
            }
            .boody{
                width:97%;
                border:solid 1px #fff;
                height:500px;
                display:block;
                padding:2px 2px 2px 2px;
            }
        </style>
    </head>
    <body>
        
            <table width="100%">
                <tr>
                    <td width="100%" class="tth" style="text-align:center;font-size:17px" colspan="6">BINTANG PERMEN SUPPLIER</td>
                </tr>
                <tr>
                    <td class="tth" style="text-align:center;font-size:14px" colspan="6">JL. Cendrawasih No.05 Kota Serang - Banten</td>
                </tr>    
                <tr>    
                    <td class="tth" style="text-align:center;font-size:14px" colspan="6">Tlpn. 082118127033/087787234834<br><br></td>
                </tr>
                @if($tanggal=='all')
                <tr>
                    <td class="tthlb" width="10%">TAHUN</td>
                    <td class="tthlb">: {{$tahun}}</td>
                    <td class="tthlb" colspan="2"></td>
                    <td class="tthlb" colspan="2">TRANSAKSI {{$tahun}}</td>
                </tr>
                <tr>
                    <td class="tthlb" rowspan="3" valign="top">PERIHAL</td>
                    <td class="tthlb" >: LAPORAN KEUANGAN</td>
                    <td class="tthlb"></td>
                    <td class="tthlb"></td>
                    <td class="tthlb">Saldo</td>
                    <td class="tthlb">: {{uang(total_saldo($tahun))}}</td>
                </tr>
                <tr>
                    
                    
                    <td class="tthlb"></td>
                    <td class="tthlb" width="12%"></td>
                    <td class="tthlb" width="12%"></td>
                    <td class="tthlb" width="20%">Pembelian</td>
                    <td class="tthlb" width="12%">: {{uang(total_keluar($tahun))}}</td>
                    
                </tr>
                <tr>
                    
                    
                    <td class="tthlb"></td>
                    <td class="tthlb"></td>
                    <td class="tthlb"></td>
                    <td class="tthlb">Piutang</td>
                    <td class="tthlb">: {{uang(total_piutang($tahun))}}</td>
                    
                </tr>
                

                @else
                <tr>
                    <td class="tthlb" width="10%">TANGGAL</td>
                    <td class="tthlb">: {{$tanggal}}</td>
                    <td class="tthlb" colspan="2">TRANSAKSI {{tahun_saja($tanggal)}}</td>
                    <td class="tthlb" colspan="2">TRANSAKSI {{$tanggal}}</td>
                </tr>
                <tr>
                    <td class="tthlb" rowspan="5" valign="top">PERIHAL</td>
                    <td class="tthlb" >: LAPORAN KEUANGAN</td>
                    <td class="tthlb">Saldo</td>
                    <td class="tthlb">: {{uang(total_saldo(tahun_saja($tanggal)))}}</td>
                    <td class="tthlb">Provit</td>
                    <td class="tthlb">: {{uang(total_provit_tanggal($tanggal))}}</td>
                </tr>
                <tr>
                    
                    
                    <td class="tthlb"></td>
                    <td class="tthlb" width="12%">Pembelian</td>
                    <td class="tthlb" width="20%">: {{uang(total_keluar(tahun_saja($tanggal)))}}</td>
                    <td class="tthlb" width="12%">Pembelian</td>
                    <td class="tthlb" width="12%">: {{uang(total_keluar_tanggal($tanggal))}}</td>
                </tr>
                <tr>
                    
                    
                    <td class="tthlb"></td>
                    <td class="tthlb">Piutang</td>
                    <td class="tthlb">: {{uang(total_piutang(tahun_saja($tanggal)))}}</td>
                    <td class="tthlb">Penjualan</td>
                    <td class="tthlb">: {{uang(total_saldo_tanggal($tanggal))}}</td>
                </tr>
                <tr>
                    
                    <td class="tthlb"></td>
                    <td class="tthlb">Tempo</td>
                    <td class="tthlb">: {{uang(total_tempo(tahun_saja($tanggal)))}}</td>
                    <td class="tthlb"></td>
                    <td class="tthlb"></td>
                </tr>
                
                <tr>
                    
                    <td class="tthlb"></td>
                    <td class="tthlb">Provit</td>
                    <td class="tthlb">: {{uang(total_provit(tahun_saja($tanggal)))}}</td>
                    <td class="tthlb"></td>
                    <td class="tthlb"> </td>
                </tr>
                @endif
                
            </table>
            <table width="100%" >
                <tr>
                    <td class="ttdh" width="5%">No</td>
                    <td class="ttdh" width="9%">Nomor</td>
                    <td class="ttdh">Keterangan</td>
                    <td class="ttdh"  width="10%">Tanggal</td>
                    <td class="ttdh"  width="10%">Masuk</td>
                    <td class="ttdh"  width="10%">Keluar</td>
                    <td class="ttdh"  width="10%">Piutang</td>
                    <td class="ttdh"  width="10%">Tempo</td>
                    <td class="ttdh"  width="10%">Provite</td>
                </tr>
                <?php
                    $kater1=0;
                    $kater2=0;
                    $kater3=0;
                    $kater4=0;
                    $kater5=0;
                ?>
                @foreach(cetak_get_keuangan($tanggal,$tahun) as $no=>$o)
                    <?php
                        if($o->status_keuangan_id==1){
                            $kater1+=$o->nilai;
                        }
                        if($o->status_keuangan_id==2){
                            $kater2+=$o->nilai;
                        }
                        if($o->status_keuangan_id==3){
                            $kater3+=$o->nilai;
                        }
                        if($o->status_keuangan_id==4){
                            $kater4+=$o->nilai;
                        }
                        if($o->kategori_keuangan_id==6){
                            $kater5+=$o->nilai;
                        }

                    ?>
                <tr>
                    <td class="ttd">{{$no+1}}</td>
                    <td class="ttd">{{$o->nomor}}</td>
                    <td class="ttd">{{$o->keterangan}}</td>
                    <td class="ttd">{{date('d/m/Y',strtotime($o->tanggal))}}</td>
                    <td class="ttdr">@if($o->status_keuangan_id==1) {{uang($o->nilai)}} @else 0 @endif</td>
                    <td class="ttdr">@if($o->status_keuangan_id==2) {{uang($o->nilai)}} @else 0 @endif</td>
                    <td class="ttdr">@if($o->status_keuangan_id==3) {{uang($o->nilai)}} @else 0 @endif</td>
                    <td class="ttdr">@if($o->status_keuangan_id==4) {{uang($o->nilai)}} @else 0 @endif</td>
                    <td class="ttdr">@if($o->kategori_keuangan_id==6) {{uang($o->nilai)}} @else 0 @endif</td>
                </tr>
                @endforeach
                <tr>
                    <td class="ttdr" style="border:solid 1px #000;font-weight:bold" colspan="4">TOTAL</td>
                    <td class="ttdr" style="border:solid 1px #000;font-weight:bold">{{uang($kater1)}}</td>
                    <td class="ttdr" style="border:solid 1px #000;font-weight:bold">{{uang($kater2)}}</td>
                    <td class="ttdr" style="border:solid 1px #000;font-weight:bold">{{uang($kater3)}}</td>
                    <td class="ttdr" style="border:solid 1px #000;font-weight:bold">{{uang($kater4)}}</td>
                    <td class="ttdr" style="border:solid 1px #000;font-weight:bold">{{uang($kater5)}}</td>
                </tr>
            </table>
        
        
    </body>
</html>