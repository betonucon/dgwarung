<html>
    <head>
        <title>CETAK</title>
        <style>
            html{
                color:#0f196a;
                margin:5px 5px 5px 5px;
            }
            
            table{
                border-collapse:collapse;
            }
            .tth{
                text-align:center;
                font-weight:bold;
                font-size:20px;
            }
            .tthl{
                text-align:left;
                font-weight:bold;
                font-size:{{setting_font_print()}}px;
            }
            .tthlb{
                text-align:left;
                font-weight:bold;
                border-bottom:solid 1px #0f196a;
                font-size:{{setting_font_print()}}px;
            }
            .ttd{
                border:solid 1px #0f196a;
                padding:4px 4px 4px 4px;
                font-size:{{setting_font_print()}}px;
               
            }
            .ttdr{
                border:solid 1px #0f196a;
                padding:4px 14px 4px 4px;
                font-size:{{setting_font_print()}}px;
                text-align:right;
            }
            .ttdc{
                border:solid 1px #0f196a;
                padding:4px 4px 4px 4px;
                font-size:{{setting_font_print()}}px;
                text-align:center;
            }
            .ttdh{
                font-weight:bold;
                text-align:center;
                text-transform:uppercase;
                border:solid 2px #0f196a;
                padding:4px 4px 4px 4px;
                font-size:{{setting_font_print()}}px;
               
            }
            .boody{
                width:97%;
                border:solid 1px #0f196a;
                height:700px;
                display:block;
                padding:15px 15px 15px 15px;
            }
        </style>
    </head>
    <body>
        <div class="boody">
            <table width="100%">
                <tr>
                    <td class="tthl" rowspan="4"><img src="{{url_plug()}}/img/logo.png" height="90px"  width="100%"></td>
                    <td class="tthl" width="10%"></td>
                    <td class="tthl" width="18%"></td>
                </tr>
                <tr>
                    <td class="tthl">NOMOR</td>
                    <td class="tthlb">: {{$order->nomor_stok}}</td>
                </tr>
                <tr>
                    <td class="tthl">SUPPLIER</td>
                    <td class="tthlb">: {{$order->msupplier['supplier']}}</td>
                </tr>
                <tr>
                    <td class="tthl">TANGGAL</td>
                    <td class="tthlb">: {{tanggal_tok($order->waktu)}}</td>
                </tr>
            </table><br>
            <table width="100%" >
                <tr>
                    <td class="ttdh" width="5%">No</td>
                    <td class="ttdh">Barang</td>
                    <td class="ttdh"  width="8%">Qty</td>
                    <td class="ttdh"  width="8%">Satuan</td>
                    <td class="ttdh"  width="14%">Harga</td>
                    <td class="ttdh"  width="14%">Total</td>
                </tr>
                @foreach($data as $no=>$o)
                <tr>
                    <td class="ttdc">{{$no+1}}</td>
                    <td class="ttd">{{$o->nama_barang}} {{$o->satuan}}</td>
                    <td class="ttdr">{{$o->qty}}</td>
                    <td class="ttd">{{$o->satuan}}</td>
                    <td class="ttdr">{{uang($o->harga_beli)}}</td>
                    <td class="ttdr">{{uang($o->total_beli)}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="boody">
            <table width="100%">
                <tr>
                    <td class="tthl" rowspan="4"><img src="{{url_plug()}}/img/logo.png" height="90px"  width="100%"></td>
                    <td class="tthl" width="10%"></td>
                    <td class="tthl" width="18%"></td>
                </tr>
                <tr>
                    <td class="tthl">NOMOR</td>
                    <td class="tthlb">: {{$order->nomor_stok}}</td>
                </tr>
                <tr>
                    <td class="tthl">SUPPLIER</td>
                    <td class="tthlb">: {{$order->msupplier['supplier']}}</td>
                </tr>
                <tr>
                    <td class="tthl">TANGGAL</td>
                    <td class="tthlb">: {{tanggal_tok($order->waktu)}}</td>
                </tr>
            </table><br>
            <table width="100%" >
                <tr>
                    <td class="ttdh" width="5%">No</td>
                    <td class="ttdh">Barang</td>
                    <td class="ttdh"  width="8%">Qty</td>
                    <td class="ttdh"  width="8%">Satuan</td>
                    <td class="ttdh"  width="14%">Harga</td>
                    <td class="ttdh"  width="14%">Total</td>
                </tr>
                @foreach($data as $no=>$o)
                <tr>
                    <td class="ttdc">{{$no+1}}</td>
                    <td class="ttd">{{$o->nama_barang}} {{$o->satuan}}</td>
                    <td class="ttdr">{{$o->qty}}</td>
                    <td class="ttd">{{$o->satuan}}</td>
                    <td class="ttdr">{{uang($o->harga_beli)}}</td>
                    <td class="ttdr">{{uang($o->total_beli)}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        
    </body>
</html>