<html>
    <head>
        <title>CETAK</title>
        <style>
            html{
                color:#000;
                margin:5px 5px 5px 5px;
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
                font-size:{{setting_font_print()}}px;
            }
            .tthlb{
                text-align:left;
                font-size:{{setting_font_print()}}px;
            }
            .ttd{
                border:solid 1px #000;
                padding:0px 4px 0px 4px;
                font-size:{{setting_font_print()}}px;
               
            }
            .ttdr{
                border:solid 1px #000;
                padding:0px 4px 0px 4px;
                font-size:{{setting_font_print()}}px;
                text-align:right;
            }
            .ttdro{
                border-right:solid 1px #000;
                padding:0px 4px 0px 4px;
                font-size:{{setting_font_print()}}px;
                text-align:right;
            }
            .ttdc{
                border:solid 1px #000;
                padding:0px 4px 0px 4px;
                font-size:{{setting_font_print()}}px;
                text-align:center;
            }
            .ttdh{
                font-weight:bold;
                text-align:center;
                text-transform:uppercase;
                border:solid 2px #000;
                padding:4px 4px 4px 4px;
                font-size:{{setting_font_print()}}px;
               
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
        @for($x=1;$x<=$ford;$x++)
        <div class="boody">
            <table width="100%">
                <tr>
                    <td width="100%" class="tth" style="text-align:center;font-size:17px" colspan="9">BP SUPPLIER</td>
                </tr>
                <tr>
                    <td class="tth" style="text-align:center;font-size:14px" colspan="9">JL. Cendrawasih No.05 Kota Serang - Banten</td>
                </tr>    
                <tr>    
                    <td class="tth" style="text-align:center;font-size:14px" colspan="9">Tlpn. 082118127033/087787234834<br><br></td>
                </tr>
                <tr>
                    <td class="tthl" width="10%">NOMOR {{$ford}}</td>
                    <td class="tthlb">: {{$order->nomor_stok}}</td>
                    <td class="tthl" width="10%">SUPPLIER</td>
                    <td class="tthlb">: {{$order->msupplier['supplier']}}</td>
                    <td class="tthl" width="10%">TANGGAL</td>
                    <td class="tthlb">: {{tanggal_tok($order->waktu)}}</td>
                    <td class="tthl" width="10%">BAYAR</td>
                    <td class="tthlb">: {{$order->mstatuskeuangan['status_keuangan']}}</td>
                </tr>
                
            </table>
            <table width="100%" >
                <tr>
                    <td class="ttdh" width="5%">No</td>
                    <td class="ttdh">Barang</td>
                    <td class="ttdh"  width="8%">Qty</td>
                    <td class="ttdh"  width="8%">Satuan</td>
                    <td class="ttdh"  width="14%">Harga</td>
                    <td class="ttdh"  width="14%">Total</td>
                </tr>
                <?php
                    $csum=0;
                ?>
                @foreach(cetak_item($order->nomor_stok,$x) as $no=>$o)
                <?php
                    $csum+=$o->total_beli;
                ?>
                <tr>
                    <td class="ttdc">{{$no+1}}</td>
                    <td class="ttd">{{$o->nama_barang}} {{$o->satuan}}</td>
                    <td class="ttdr">{{$o->qty}}</td>
                    <td class="ttd">{{$o->satuan}}</td>
                    <td class="ttdr">{{uang($o->harga_beli)}}</td>
                    <td class="ttdr">{{uang($o->total_beli)}}</td>
                </tr>
                @endforeach
                @if($ford==$x)
                <tr>
                    <td class="ttdro" colspan="5">TOTAL HALAMAN {{$x}}</td>
                    <td class="ttdr">{{uang($csum)}}</td>
                </tr>
                <tr>
                    <td class="ttdro" colspan="5">SUB TOTAL</td>
                    <td class="ttdr">{{uang(sum_item_order($order->nomor_stok))}}</td>
                </tr>
                
                @else
                <tr>
                    <td class="ttdro" colspan="5">TOTAL HALAMAN {{$x}}</td>
                    <td class="ttdr">{{uang($csum)}}</td>
                </tr>
                @endif
            </table>
        </div><br>
        @endfor
    </body>
</html>