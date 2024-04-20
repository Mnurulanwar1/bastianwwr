<?php 
	@ob_start();
	session_start();
	if(!empty($_SESSION['admin'])){ }else{
		echo '<script>window.location="login.php";</script>';
        exit;
	}
	require 'config.php';
	include $view;
	$lihat = new view($config);
	$toko = $lihat -> toko();
	$hsl = $lihat -> penjualan();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <style>
        @page {
            size: 90mm 160mm; /* Set the size of the printed page to a 9:16 aspect ratio */
            margin: 0; /* Reset margin for the printed page */
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .struk {
            width: 300px; /* You may need to adjust this width according to your content */
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        .detail {
            margin-bottom: 15px;
        }
        .footer {
            text-align: right;
            font-weight: bold;
            color: #555;
        }
        p {
            margin: 5px 0;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <script>window.print();</script>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <h3><?php echo $toko['nama_toko'];?></h3>
                <p><?php echo $toko['alamat_toko'];?></p>
                <p>Tanggal : <?php  echo date("j F Y, G:i");?></p>
                <p>Kasir : <?php  echo htmlentities($_GET['nm_member']);?></p>
                <table>
                    <tr>
                        <th>No.</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                    <?php $no=1; foreach($hsl as $isi){?>
                    <tr>
                        <td><?php echo $no;?></td>
                        <td><?php echo $isi['nama_barang'];?></td>
                        <td><?php echo $isi['jumlah'];?></td>
                        <td><?php echo $isi['total'];?></td>
                    </tr>
                    <?php $no++; }?>
                </table>
                <div class="pull-right">
                    <?php $hasil = $lihat -> jumlah(); ?>
                    <p>Total : Rp.<?php echo number_format($hasil['bayar']);?>,-</p>
                    <p>Bayar : Rp.<?php echo number_format(htmlentities($_GET['bayar']));?>,-</p>
                    <p>Kembali : Rp.<?php echo number_format(htmlentities($_GET['kembali']));?>,-</p>
                </div>
                <div class="clearfix"></div>
                <p>Terima Kasih Telah berbelanja di toko kami !</p>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</body>
</html>


