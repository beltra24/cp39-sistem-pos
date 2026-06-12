<?php 
  include '_header-artibut.php';
?>
<?php  
  $status = $_SESSION['user_status'];
  if ( $status === '0') {
    echo"
      <script>
        alert('Akun Tidak Aktif');
        window.location='./';
      </script>";
  }
?>

<html>
<head>
<title>Nota Pembayaran</title>
<style>
body {
  font-family: Tahoma, sans-serif;
  font-size: 8pt;
}
.receipt {
  width: <?= $toko_print; ?>cm;
  max-width: <?= $toko_print; ?>cm;
  margin: 0 auto;
  padding: 10px;
  border: 1px solid #000;
}
.receipt-header, .receipt-footer {
  text-align: center;
}
.receipt-header h1 {
  margin: 0;
  font-size: 10pt;
}
.receipt-header p {
  margin: 0;
  font-size: 8pt;
}
.receipt-body {
  margin-top: 10px;
}
.receipt-body p {
  margin: 5px 0;
}
.receipt-body table {
  width: 100%;
  border-collapse: collapse;
}
.receipt-body table th, .receipt-body table td {
  border: 1px solid #000;
  padding: 5px;
  text-align: left;
  font-size: 8pt;
}
.receipt-footer p {
  margin: 5px 0;
  font-size: 8pt;
}
</style>
</head>
<body onload="window.print()">

<?php  
  // ambil data di URL
  $id = abs((int)$_GET['no']);

  // query data 
  $invoice = query("SELECT * FROM invoice WHERE invoice_id = $id && invoice_cabang = $sessionCabang ")[0];
  $tipeTransaksi = $invoice['invoice_piutang'];
?>

<!-- Nama Kasir -->
<?php  
  $kasir = $invoice['invoice_kasir'];
  $dataKasir = query("SELECT * FROM user WHERE user_id = $kasir");
?>
<?php foreach ( $dataKasir as $ksr ) : ?>
  <?php $ksrDetail = $ksr['user_nama']; ?>
<?php endforeach; ?>

<!-- Nama Customer -->
<?php  
  $customer = $invoice['invoice_customer'];
  $dataCustomer = query("SELECT * FROM customer WHERE customer_id = $customer");
?>
<?php foreach ( $dataCustomer as $ctr ) : ?>
  <?php 
    $ctrId = $ctr['customer_id']; 
    $ctrNama = $ctr['customer_nama']; 
    $ctrAlamat = $ctr['customer_alamat']; 
  ?>
<?php endforeach; ?>

<?php  
  $toko = query("SELECT * FROM toko WHERE toko_cabang = $sessionCabang");
?>
<?php foreach ( $toko as $row ) : ?>
  <?php 
    $toko_nama = $row['toko_nama'];
    $toko_kota = $row['toko_kota'];
    $toko_tlpn = $row['toko_tlpn'];
    $toko_wa = $row['toko_wa'];
    $toko_print = $row['toko_print']; 
  ?>
<?php endforeach; ?>

<?php 
  // Jalankan query dan ambil hasilnya
  $result = query("SELECT * FROM pasar,relasi_pasarcustomer WHERE pasar.kode_pasar=relasi_pasarcustomer.kode_pasar AND relasi_pasarcustomer.customer_id='$ctrId'");

  // Periksa apakah hasil query tidak kosong
  if (!empty($result)) {
    $alamatpasar = $result[0];
  } else {
    // Tangani kasus ketika hasil query kosong
    $alamatpasar = null; // atau nilai default lainnya
  }

  // Definisikan lebar print
  $lebarPrint = $toko_print . "cm";
?>

<div class="receipt">
  <div class="receipt-header">
    <h1><?= $toko_nama; ?></h1>
    <p><?= $toko_kota; ?></p>
    <p>No. Tlpn: <?= $toko_tlpn; ?> | WA: <?= $toko_wa; ?></p>
    <hr>
  </div>
  <div class="receipt-body">
    <p>Tanggal: <?= isset($invoice['invoice_tgl']) ? date("d M Y H:i:s", strtotime($invoice['invoice_tgl'])) : 'Unknown'; ?></p>
    <p>Invoice: <?= $invoice['penjualan_invoice'] ?? 'Unknown'; ?></p>
    <p>Kasir: <?= $ksrDetail; ?></p>
    <p>Pembeli: <?= $ctrNama; ?></p>
    <p>Alamat: <?= $alamatpasar['nama_pasar'] ?? $ctrAlamat; ?></p>
    <table>
      <thead>
        <tr>
          <th>Barang</th>
          <th>Qty</th>
          <th>Harga</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $invoice1 = $invoice['penjualan_invoice'];
        $queryProduct = $conn->query("SELECT barang.barang_kode, penjualan.penjualan_id, penjualan.barang_qty, penjualan.penjualan_invoice, penjualan.barang_option_sn, penjualan.barang_sn_desc, penjualan.keranjang_harga,  penjualan.keranjang_satuan, penjualan.penjualan_cabang, barang.barang_id, barang.barang_nama, satuan.satuan_id, satuan.satuan_nama
          FROM penjualan 
          JOIN barang ON penjualan.barang_id = barang.barang_id
          JOIN satuan ON penjualan.keranjang_satuan = satuan.satuan_id
          WHERE penjualan_invoice = $invoice1 && penjualan_cabang = '".$sessionCabang."'
          ORDER BY penjualan_id DESC");
        while ($rowProduct = mysqli_fetch_array($queryProduct)): ?>
          <tr>
            <td><?= $rowProduct['barang_nama']; ?></td>
            <td><?= $rowProduct['barang_qty']; ?> <?= $rowProduct['satuan_nama']; ?></td>
            <td><?= number_format($rowProduct['keranjang_harga'], 0, ',', '.'); ?></td>
            <td style='text-align:right'><?php  
              $subTotal = $rowProduct['barang_qty'] * $rowProduct['keranjang_harga'];
              echo(number_format($subTotal, 0, ',', '.'));
              ?></td>
          </tr>
        <?php endwhile; ?>
        <tr>
          <td colspan='3'><div style='text-align:right'>Sub Total:</div></td>
          <td style='text-align:right'>Rp. <span class="right-nota"><?= number_format($invoice['invoice_total'], 0, ',', '.'); ?></span></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="receipt-footer">
    <hr>
    <p>Powered By Capstone Project 39 Kelompok C</p>
  </div>
</div>
</body>
</html>
<script>
  window.print();
</script>
