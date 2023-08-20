<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Produk Masuk</title>
</head>

<style>
    #table-data {
        border-collapse: collapse;
        padding: 3px;
    }

    #table-data td, #table-data th {
        border: 1px solid black;
    }
</style>

<body>
<div class="invoice-box">
    <!-- <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table> -->


    <table border="0" id="table-data" width="100%">
        <tr>
            <td width="70px"><b>Kode Barang</b></td>
            <td width="">: {{ $product_masuk->product->kode_barang }}</td>
            <td width="30px"><b>Tanggal</b></td>
            <td>: {{ $product_masuk->tanggal }}</td>
        </tr>

        <tr>
            <td><b>Product</b></td>
            <td >: {{ $product_masuk->product->nama }}</td>
            <td><b>Quantity</b></td>
            <td >: {{ $product_masuk->stok }}</td>
        </tr>

        <tr>
            <td><b>Ukuran</b></td>
            <td>: {{ $product_masuk->detail->ukuran->ukuran }}</td>
            <td><b>Warna</b></td>
            <td>: {{ $product_masuk->detail->warna->warna }}</td>
        </tr>

        <tr>
            <td><b>Supplier</b></td>
            <td>: -</td>
            <td><b>Email</b></td>
            <td>: -</td>
        </tr>

        

    </table>

    {{--<hr  size="2px" color="black" align="left" width="45%">--}}


    <table border="0" width="80%">
        <tr align="right">
            <td>Best Regard</td>
        </tr>
    </table>

    <!-- <table border="0" width="80%">
        <tr align="right">
            <td><img src="https://upload.wikimedia.org/wikipedia/en/f/f4/Timothy_Spall_Signature.png" width="100px" height="100px"></td>
        </tr>

    </table> -->
    <table border="0" width="80%">
        <tr align="right">
            <td>I M S</td>
        </tr>
    </table>
</div>
