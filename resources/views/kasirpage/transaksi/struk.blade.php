@foreach ($transaksi as $trans)
<!-- Tes judul <br>
--------- <br>
tessssss <br>
sssss -->
<!DOCTYPE html>
<html>
<head>
    <title>Apotek Bakti Abadi Farma></title>
</head>
<body onload="window.print()">
    <p>
        <br>

<b>Apotek Bakti Abadi farma </b> <br>
Komplek Ruko Golden Square No.3 <br>
================================ <br>
No        : {{ $trans->no_invoice }}<br>
Pelanggan : {{ ucfirst($trans->nama_pelanggan) }} <br>
Tgl Tnsksi : {{ $trans->created_at }} <br>
-------------------------------- <br>
@foreach($detail_order as $do)
{{ ucfirst($do->nama_obat) }} <br> 
&nbsp; &nbsp; &nbsp; @/{{ number_format($do->harga_jual,0,',','.') }} x {{ $do->qty }} &nbsp; {{number_format($do->total_harga,0,',','.')}}<br>
@endforeach
-----------------------------(+) <br>
Sub Total : &nbsp;&nbsp;&nbsp; Rp. {{ number_format($trans->total_bayar,0,',','.') }} <br>
Bayar :   &nbsp; &nbsp; &nbsp; &nbsp; Rp. {{ number_format($trans->uang_bayar,0,',','.') }} <br>
-----------------------------(-) <br>
Kembali : &nbsp; &nbsp; &nbsp;  Rp. {{ number_format($trans->uang_kembali,0,',','.') }} <br>
=============================== <br>
Catatan : {{ $trans->catatan }} <br>
=============================== <br>
TERIMA KASIH TELAH BERKUNJUNG <br>
KE TOKO KAMI<br>
<br>
<br>
<br>
================================<br>
================================<br>
================================<br>
</body>
</html>


<!-- <html>
    <head>
        <title>Apotek Bakti Abadi Farma</title>
        <link rel="icon" type="image/png" href="../../assets/image/sam.png" />
    </head>
    <style type="text/css">
        body{
            font-style: 'Arial';
        }
        td {
            font-size: 17;
            color: black;/* Will override color (regardless of order) */
           
        }
    </style>
    <body onload="window.print()">
    <table border="1" style="margin-left: 10px;">
        <tr align="center">
            <td colspan="2">
                <b style="font-size: 20;">Apotek Bakti Abadi farma</b> <br>
                <i style="font-size: 17;">Komplek Ruko Golden Square No.3</i>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                ----------------------------------------
            </td>
        </tr>
        
       
       
        <tr>
            <td>
                No
            </td>
            <td>
                <b><i> : {{ $trans->no_invoice }} </i></b>
            </td>
        </tr>
        <tr>
            <td>
                Pelanggan
            </td>
            <td>
                <b><i> : {{ $trans->nama_pelanggan }} </i></b>
            </td>
        </tr>
        <tr>
            <td>
                Tanggal Transaksi
            </td>
            <td>
                <b><i> : {{ $trans->created_at }} </i></b>
            </td>
        </tr>
        <tr>
            <td>
                Kasir
            </td>
            <td>
                <b><i> : {{ auth()->user()->name . " - " . auth()->user()->id }} </i></b>
            </td>
        </tr>
        
        <tr>
            <td colspan="2">
                <p style="margin-top: -10px;">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ </p>
            </td>
        </tr>
        <tr style="margin-top: -10px;">
            <td width="">
                <b>Item</b>
            </td>
            <td style="float:right;">
                <b>Harga</b>
            </td>
        </tr>
        {{-- DAFTAR MENU --}}
        @foreach($detail_order as $do)
        <tr>
            <td>
                {{ $do->nama_obat }} @/{{ number_format($do->harga_jual,2,',','.') }}
            </td>
            <td style="float:right;">
                x {{ $do->qty }} &nbsp &nbsp &nbsp Rp.{{number_format($do->total_harga,2,',','.')}}
               
            </td>
        </tr>
        @endforeach
        {{-- HARGA --}}
        <tr>
            <td colspan="2">
                -----------------------------------
            </td>
        </tr>
        <tr>
            <td colspan="2">
                
                <b>Catatan :</b> {{ $trans->catatan }}
                
            </td>
        </tr>
        <tr>
            <td colspan="2">
                -----------------------------------
            </td>
        </tr>
        <tr>
            <td >
                <b>Total</b>
            </td>
            <td style="float:right;">
                
                <b> Rp. {{ number_format($trans->total_bayar,2,',','.') }}</b>
                
            </td>
        </tr>
        <tr>
            <td >
                <b>Uang Bayar</b>
            </td>
            <td style="float:right;">
                
               Rp. {{ number_format($trans->uang_bayar,2,',','.') }}
                
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                --------------
            </td>
        </tr>
        <tr>
            <td >
                <b>Kembalian</b>
            </td>
            <td style="float:right;">
                
               Rp. {{ number_format($trans->uang_kembali,2,',','.') }}
                
            </td>
        </tr>
        <tr>
            <td colspan="2">
                ===================
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center" style="font-size: 15;">
                <i>TERIMA KASIH <br>
                SUDAH BERKUNJUNG KE TEMPAT KAMI</i>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                ======================
            </td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    </body>
    </html> -->
    @endforeach