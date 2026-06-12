<?php 
  include '_header.php';
  include '_nav.php';
  include '_sidebar.php'; 
?>
<?php  
  if ( $levelLogin === "kurir") {
    echo "
      <script>
        document.location.href = 'kurir-data';
      </script>
    ";
  }  
?>
  <?php  
    $invoice_date_year_month = date("Y-m");
    $penjualan = query("SELECT * FROM penjualan WHERE penjualan_cabang = $sessionCabang && penjualan_date_year_month = '".$invoice_date_year_month."' ");
  ?>

  <?php $jmlPenjualan = 0; ?>
  <?php foreach ( $penjualan as $row ) : ?>
    <?php $jmlPenjualan += $row['barang_qty']; ?>
  <?php endforeach; ?>

  <?php  
    $totalPenjualanHariIni = 0;
    $tanggalHariIni = date("Y-m-d");
      $queryInvoice = $conn->query("SELECT invoice.invoice_id, invoice.invoice_date, invoice.invoice_cabang, invoice.invoice_sub_total, invoice.penjualan_invoice
        FROM invoice 
         WHERE invoice_cabang = '".$sessionCabang."' && invoice_piutang = 0 && invoice_piutang_lunas = 0 && invoice_date = '".$tanggalHariIni."' ORDER BY invoice_id DESC
      ");
    while ($rowProduct = mysqli_fetch_array($queryInvoice)) {
    $totalPenjualanHariIni += $rowProduct['invoice_sub_total'];
  ?>
  <?php } ?>
  <?php  
    // Barang
    $barang = mysqli_query($conn,"select * from barang where barang_cabang = ".$sessionCabang."");
    $jmlBarang = mysqli_num_rows($barang);

    // Invoice
    $invoice = mysqli_query($conn,"select * from invoice where invoice_cabang = '".$sessionCabang."' && invoice_piutang < 1 && invoice_date_year_month = '".$invoice_date_year_month."' ");
    $jmlInvoice = mysqli_num_rows($invoice);
  ?>

  <?php  
    $invoiceHariIni = mysqli_query($conn,"select * from invoice where invoice_cabang = '".$sessionCabang."' && invoice_date = '".$tanggalHariIni."' && invoice_piutang = 0 && invoice_piutang_lunas = 0 ");
    $jmlInvoiceHariIni = mysqli_num_rows($invoiceHariIni);
  ?>
  <style>
    .dashboard-card-stat {
      border: none;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      color: #fff;
      overflow: hidden;
      position: relative;
      margin-bottom: 1.5rem;
    }
    .dashboard-card-stat:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }
    .dashboard-card-stat .inner {
      padding: 1.5rem;
      z-index: 2;
      position: relative;
    }
    .dashboard-card-stat h3 {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 5px;
    }
    .dashboard-card-stat p {
      font-size: 0.95rem;
      opacity: 0.9;
      margin-bottom: 0;
    }
    .dashboard-card-stat .icon {
      position: absolute;
      right: 15px;
      bottom: 10px;
      font-size: 4rem;
      opacity: 0.15;
      transition: all 0.3s linear;
      z-index: 1;
    }
    .bg-grad-primary { background: linear-gradient(135deg, #007bff, #0056b3); }
    .bg-grad-warning { background: linear-gradient(135deg, #ffc107, #d39e00); color: #1f2d3d !important; }
    .bg-white-stat { background: #ffffff; color: #495057; border: 1px solid #e9ecef; }
    .bg-white-stat h3 { color: #212529; }
    
    .card-modern {
      border: none;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.04);
      margin-bottom: 1.5rem;
    }
    .card-modern .card-header {
      background-color: #ffffff;
      border-bottom: 1px solid #f1f3f5;
      padding: 1.2rem;
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
    }
    .table-modern th {
      background-color: #f8f9fa;
      color: #495057;
      font-weight: 600;
      border-bottom: 2px solid #dee2e6;
    }
    .btn-action-sm {
      padding: 5px 10px;
      border-radius: 6px;
      margin-right: 2px;
    }
    .kasir-float-btn {
      position: fixed;
      bottom: 25px;
      right: 25px;
      z-index: 999;
      background: #ffffff;
      border-radius: 50%;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      transition: transform 0.2s;
    }
    .kasir-float-btn:hover {
      transform: scale(1.1);
    }
    .kasir-float-btn img {
      width: 60px;
      height: 60px;
    }
  </style>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-3 align-items-center">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark fw-bold" style="letter-spacing: -0.5px;">Dashboard <span class="text-primary">UT POS</span> <small class="text-muted fs-5 fw-normal"><?= $tipeToko; ?> <?= $dataTokoLogin['toko_kota']; ?></small></h1>
          </div><div class="col-sm-6">
            <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
              <li class="breadcrumb-item"><a href="bo" class="text-decoration-none">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div></div></div></div>
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <div class="card dashboard-card-stat bg-grad-primary">
              <div class="inner">
                <h3>Rp <?= number_format($totalPenjualanHariIni, 0, ',', '.'); ?></h3>
                <p>Penjualan <b>Hari Ini</b></p>
              </div>
              <div class="icon">
                <i class="fas fa-wallet"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-md-6">
            <div class="card dashboard-card-stat bg-grad-warning">
              <div class="inner">
                <h3><?= singkat_angka($jmlInvoiceHariIni); ?></h3>
                <p>Invoice Penjualan Cash <b>Hari Ini</b></p>
              </div>
              <div class="icon">
                <i class="fas fa-file-invoice-dollar"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="card dashboard-card-stat bg-white-stat">
              <div class="inner">
                <h3><?= $jmlPenjualan; ?></h3>
                <p class="text-muted"><b class="text-primary">Total</b> Barang Terjual Bulan Ini</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart" style="color: #007bff;"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card dashboard-card-stat bg-white-stat">
              <div class="inner">
                <h3><?= $jmlBarang; ?></h3>
                <p class="text-muted">Jumlah Master Barang</p>
              </div>
              <div class="icon">
                <i class="fas fa-box-open" style="color: #28a745;"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card dashboard-card-stat bg-white-stat">
              <div class="inner">
                <h3><?= $jmlInvoice; ?></h3>
                <p class="text-muted"><b class="text-danger">Total</b> Invoice Penjualan Bulan Ini</p>
              </div>
              <div class="icon">
                <i class="fas fa-receipt" style="color: #dc3545;"></i>
              </div>
            </div>
          </div>
        </div>
        </div></section>
    <section class="table-informasi mt-2">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-lg-6">
             <div class="card card-modern">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h5 class="card-title m-0 fw-bold text-dark"><i class="fas fa-fire text-danger me-2"></i><b>Data Barang</b> Terlaris</h5>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-modern table-hover align-middle m-0">
                      <thead>
                        <tr>
                          <th class="ps-3" style="width: 60px;">No.</th>
                          <th>Kode Barang</th>
                          <th>Nama Produk</th>
                          <th class="text-end pe-3">Terjual</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $i = 1; 
                        $queryProduct = $conn->query("SELECT barang.barang_id, barang.barang_kode, barang.barang_nama, barang.barang_harga, barang.barang_terjual, barang.barang_cabang
                                   FROM barang 
                                   WHERE barang_cabang = '".$sessionCabang."' && barang_terjual > 0  ORDER BY barang_terjual DESC LIMIT 5
                                   ");
                        while ($rowProduct = mysqli_fetch_array($queryProduct)) {
                      ?>
                      <tr>
                          <td class="ps-3 text-secondary"><?= $i; ?></td>
                          <td><span class="badge bg-light text-dark border font-monospace"><?= $rowProduct['barang_kode']; ?></span></td>
                          <td class="fw-semibold text-dark"><?= $rowProduct['barang_nama']; ?></td>
                          <td class="text-end pe-3">
                            <span class="badge bg-success-subtle text-success px-2 py-1 fs-6 rounded"><?= $rowProduct['barang_terjual']; ?></span>
                          </td>
                      </tr>
                      <?php $i++; ?>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>

          <div class="col-lg-6">
            <div class="card card-modern">
              <div class="card-header">
                <h5 class="card-title m-0 fw-bold text-dark"><i class="fas fa-exclamation-triangle text-warning me-2"></i><b>Data Stok</b> Terkecil</h5>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-modern table-hover align-middle m-0">
                    <thead>
                      <tr>
                        <th class="ps-3" style="width: 60px;">No.</th>
                        <th>Kode Barang</th>
                        <th>Nama Produk</th>
                        <th class="text-end pe-3">Sisa Stok</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $i = 1; 
                      $queryProduct = $conn->query("SELECT barang.barang_id, barang.barang_kode, barang.barang_nama, barang.barang_harga, barang.barang_stock, barang.barang_cabang
                                   FROM barang 
                                   WHERE barang_cabang = '".$sessionCabang."' && barang_stock < 10 ORDER BY barang_stock ASC LIMIT 5
                                   ");
                      while ($rowProduct = mysqli_fetch_array($queryProduct)) {
                    ?>
                    <tr>
                        <td class="ps-3 text-secondary"><?= $i; ?></td>
                        <td><span class="badge bg-light text-dark border font-monospace"><?= $rowProduct['barang_kode']; ?></span></td>
                        <td class="fw-semibold text-dark"><?= $rowProduct['barang_nama']; ?></td>
                        <td class="text-end pe-3">
                          <span class="badge bg-danger-subtle text-danger px-2 py-1 fs-6 rounded"><?= $rowProduct['barang_stock']; ?></span>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card card-modern">
              <div class="card-header">
                <h5 class="card-title m-0 fw-bold text-dark"><i class="fas fa-clock text-info me-2"></i><b>Data Piutang</b> Jatuh Tempo < 30 Hari</h5>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table id="example1" class="table table-modern table-hover align-middle m-0">
                    <thead>
                      <tr>
                        <th class="ps-3">No.</th>
                        <th>Invoice</th>
                        <th>Transaksi</th>
                        <th>Pelanggan</th>
                        <th>Jatuh Tempo</th>
                        <th>Sub Total</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $i = 1; 
                      $date_max  = date('Y-m-d', strtotime('30 days'));
                      $queryProduct = $conn->query("SELECT invoice.invoice_id, invoice.penjualan_invoice, invoice.invoice_date, invoice.invoice_sub_total, invoice.invoice_cabang, invoice.invoice_customer, invoice.invoice_piutang_jatuh_tempo, invoice.invoice_piutang_dp, invoice.invoice_bayar, invoice.invoice_kembali, customer.customer_id, customer.customer_nama, customer.customer_tlpn
                                   FROM invoice 
                                   JOIN customer ON invoice.invoice_customer = customer.customer_id
                                   WHERE invoice_cabang = '".$sessionCabang."' && invoice_piutang > 0 && invoice_piutang_jatuh_tempo <= '".$date_max."' ORDER BY invoice_id DESC
                                   ");
                      while ($rowProduct = mysqli_fetch_array($queryProduct)) {
                    ?>
                    <tr>
                        <td class="ps-3"><?= $i; ?></td>
                        <td><span class="fw-bold text-primary"><?= $rowProduct['penjualan_invoice']; ?></span></td>
                        <td><?= tanggal_indo($rowProduct['invoice_date']); ?></td>
                        <td class="fw-semibold"><?= $rowProduct['customer_nama']; ?></td>
                        <td>
                            <?php
                                // Jatuh Tempo
                                $piutangJatuhTempo = tanggal_indo($rowProduct['invoice_piutang_jatuh_tempo']);

                                // Durasi Hari
                                $tgl1 = new DateTime($tanggalHariIni);
                                $tgl2 = new DateTime($rowProduct['invoice_piutang_jatuh_tempo']);
                                $d = $tgl2->diff($tgl1)->days;

                                if ( $tanggalHariIni > $rowProduct['invoice_piutang_jatuh_tempo']) {
                                  $nh = "<span class='badge bg-danger text-white ms-1'>Lewat ".$d." Hari</span>";
                                  $dWA = "Lewat ".$d." Hari";
                                  echo "<span class='text-decoration-line-through text-muted'>".$piutangJatuhTempo."</span> ".$nh;
                                } else {
                                  if ( $d > 20 ) {
                                     $nh = "<span class='badge bg-warning text-dark ms-1'>".$d." Hari Lagi</span>";
                                  } else {
                                      $nh = "<span class='badge bg-danger text-white ms-1'>".$d." Hari Lagi</span>";
                                  }
                                  $dWA = $d." Hari Lagi";
                                  echo "<span>".$piutangJatuhTempo."</span> ".$nh;  
                                }
                            ?>
                        </td>
                        <td class="fw-bold text-dark">
                          Rp <?= number_format($rowProduct['invoice_sub_total'], 0, ',', '.'); ?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                              <a href="penjualan-zoom?no=<?= base64_encode($rowProduct['invoice_id']); ?>" target="_blank" class="btn btn-outline-info btn-sm btn-action-sm" title='Lihat Data'>
                                <i class='fas fa-eye'></i>
                              </a>

                              <a href="piutang-cicilan?no=<?= base64_encode($rowProduct['invoice_id']); ?>" class="btn btn-outline-primary btn-sm btn-action-sm" title='Cicilan'>
                                <i class='fas fa-money-bill-wave'></i>
                              </a>

                              <?php  
                                $no_wa = substr_replace($rowProduct['customer_tlpn'],'62',0,1)
                              ?>
                              <a href="https://api.whatsapp.com/send?phone=<?= $no_wa; ?>&text=Halo <?= $rowProduct['customer_nama'];?>, Kami dari *<?= $dataTokoLogin['toko_nama']; ?> <?= $dataTokoLogin['toko_kota']; ?>* memberikan informasi bahwa transaksi *No Invoice <?= $rowProduct['penjualan_invoice'];?> dengan jumlah transaksi Rp <?= number_format($rowProduct['invoice_sub_total'], 0, ',', '.'); ?>* sudah mendekati jatuh tempo pada <?= $piutangJatuhTempo; ?> (<?= $dWA; ?> dimulai dari tanggal sekarang).%0A%0ASub Total: Rp <?= number_format($rowProduct['invoice_sub_total'], 0, ',', '.'); ?>%2C%0ADP: Rp <?= number_format($rowProduct['invoice_piutang_dp'], 0, ',', '.'); ?>%2C%0ADP ditambah Total Cicilan: Rp <?= number_format($rowProduct['invoice_bayar'], 0, ',', '.'); ?> %2C%0A*Sisa Piutang: Rp <?= number_format($rowProduct['invoice_kembali'], 0, ',', '.'); ?>*%2C%0A%0A%0AMohon Segera Dilunasi" target="_blank" class="btn btn-outline-success btn-sm btn-action-sm" title='Kirim WA'>
                                <i class='fab fa-whatsapp'></i>
                              </a>

                              <a href="nota-cetak?no=<?= $rowProduct['invoice_id']; ?>" target="_blank" class="btn btn-outline-secondary btn-sm btn-action-sm" title="Cetak Nota">
                                <i class='fas fa-print'></i>
                              </a>
                            </div>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>
  <div class="kasir-bo">
    <a href="beli-langsung?customer=<?= base64_encode(0); ?>" class="kasir-float-btn d-block">
      <img src="dist/img/kasir.png" alt="UT POS System" class="img-fluid"> 
    </a>   
  </div>

<?php include '_footer.php'; ?>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $("#example2").DataTable();
  });
</script>