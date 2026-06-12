<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="bo" class="brand-link">
    <img src="dist/img/ut-mart.png"
         alt="UT POS"
         class="brand-image img-circle elevation-3">

    <span class="brand-text">
        POS System
    </span>
</a>
<?php
function active($currect_page){
    $url = str_replace(".php", "", basename($_SERVER['PHP_SELF'])); // If filename is just "name" or "name.php"
    // Also checks which directory the file is in, to avoid highlighting multiple menu items with same name
    // $currect_page == $url :: parentFolder/fileName == parentFolder/fileName (without .php here)
    if($currect_page == $url || $currect_page == basename(getcwd())."/".basename($_SERVER['PHP_SELF'])){
        echo 'active'; // class name in css
        
        
    }
}

?>

<?php
function open($menu){
    $url = str_replace(".php", "", basename($_SERVER['PHP_SELF'])); // If filename is just "name" or "name.php"
    // Also checks which directory the file is in, to avoid highlighting multiple menu items with same name
    // $currect_page == $url :: parentFolder/fileName == parentFolder/fileName (without .php here)
    if($currect_page == $url || $currect_page == basename(getcwd())."/".basename($_SERVER['PHP_SELF'])){
        echo 'active'; // class name in css
       
    }
}
$submenu = str_replace(".php", "", basename($_SERVER['PHP_SELF']));
 if($submenu == "kasir" || $submenu == "pembeli" || $submenu == "beli-langsung" || $submenu == "customer" || $submenu == "pasar" || $submenu == "penjualan" || $submenu == "piutang" ||$submenu =="piutang-menunggak" ||$submenu =="piutang-lunas" ){
        $penjualan = "menu-open";
        if($submenu =="piutang" ||$submenu =="piutang-menunggak" ||$submenu =="piutang-lunas" ){
            $piutang = "menu-open";
            
        }    
    
        }
        
        
if($submenu == "transaksi-pembelian"  || $submenu == "supplier" || $submenu == "pembelian" || $submenu == "hutang" || $submenu =="hutang-menunggak" ||$submenu =="hutang-lunas"){
    $pembelian = "menu-open";
    if($submenu =="hutang" ||$submenu =="hutang-menunggak" ||$submenu =="hutang-lunas" ){
            $hutang = "menu-open";
            
}

}

if($submenu == "kategori"  || $submenu == "satuan" || $submenu == "barang"){
    $gudangbarang = "menu-open";

}

if($submenu == "stock-opname-per-produk"  || $submenu == "stock-opname-keseluruhan" || $submenu == "stock-opname-data-produk"){
    $stockopname = "menu-open";

}

if($submenu == "laba-bersih-data"  || $submenu == "laba-bersih-laporan"){
    $lababersih = "menu-open";
   
}

if($submenu == "laporan-kasir"  || $submenu == "laporan-kurir" || $submenu == "laporan-customer" || $submenu == "periode" || $submenu =="laporan-produk" ||$submenu =="edit-transaksi" ||$submenu =="laporan-supplier" ||$submenu =="periode-pembelian" ||$submenu =="laporan-produk-pembelian" ||$submenu =="edit-transaksi-pembelian" ||$submenu =="terlaris" ||$submenu =="stok"){
    $laporan = "menu-open";
    if($submenu =="periode" ||$submenu =="laporan-produk" ||$submenu =="edit-transaksi" ){
            $laporanpenjualan = "menu-open";
            
}

if($submenu =="periode-pembelian" ||$submenu =="laporan-produk-pembelian" ||$submenu =="edit-transaksi-pembelian" ){
            $laporanpembelian = "menu-open";
            
}

}
        
?>


<!-- Sidebar -->
<div class="sidebar">

    <!-- User Panel -->
    <div class="modern-user-panel">

        <div class="user-avatar">
            <img src="dist/img/avatar04.png"
                 alt="Profile"
                 class="img-circle">
        </div>

        <div class="user-detail">

            <div class="user-name">
                <?= htmlspecialchars($_SESSION['user_nama']); ?>
            </div>


            <div class="user-status">
                <span class="status-dot"></span>
                Online
            </div>

        </div>

    </div>

    <!-- Sidebar Menu -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php if ( $levelLogin !== "kurir" ) { ?>
          <li class="nav-item">
            <a href="bo" class="nav-link <?php active('bo'); ?>">
              <i class="nav-icon fa fa-desktop"></i> 
              <p>
                 Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview <?php echo $penjualan; ?>">
            <a href="#" class="nav-link ">
              <i class="nav-icon fa fa-shopping-cart"></i>
              <p>
                Penjualan
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="beli-langsung?customer=<?= base64_encode(0); ?>" class="nav-link <?php active('beli-langsung'); ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Transaksi Kasir</p>
                    </a>
            
           
              </li>
              <li class="nav-item">
                <a href="customer" class="nav-link <?php active('customer'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembeli</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pasar" class="nav-link <?php active('pasar'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pasar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="penjualan" class="nav-link <?php active('penjualan'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nota Penjualan</p>
                </a>
              </li>
              <li class="nav-item has-treeview <?php echo $piutang; ?> ">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Piutang
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="piutang" class="nav-link <?php active('piutang'); ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Belum Lunas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="piutang-menunggak" class="nav-link <?php active('piutang-menunggak'); ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Piutang Menunggak</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="piutang-lunas" class="nav-link <?php active('piutang-lunas'); ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Lunas</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <?php } ?>

          <?php if ( $levelLogin !== "kasir" && $levelLogin !== "kurir" ) { ?>
          <li class="nav-item has-treeview <?php echo $pembelian; ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-shopping-bag"></i>
              <p>
                Pembelian
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="transaksi-pembelian" class="nav-link <?php active('transaksi-pembelian'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transaksi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="supplier" class="nav-link <?php active('supplier'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pembelian" class="nav-link <?php active('pembelian'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nota Pembelian</p>
                </a>
              </li>
              <li class="nav-item has-treeview <?php echo $hutang; ?>">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Hutang
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="hutang" class="nav-link <?php active('hutang'); ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Belum Lunas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="hutang-menunggak" class="nav-link <?php active('hutang-menunggak'); ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Hutang Menunggak</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="hutang-lunas" class="nav-link <?php active('hutang-lunas'); ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Lunas</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <?php } ?>

          <!-- <?php if ( $levelLogin !== "kasir" && $levelLogin !== "kurir" ) { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-exchange"></i>
              <p>
                Transfer Stock
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="transfer-stock-cabang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transaksi</p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Data Transfer Stock
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="transfer-stock-cabang-masuk" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Masuk</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="transfer-stock-cabang-keluar" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Keluar</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <?php } ?> -->

          <?php if ( $levelLogin !== "kasir" && $levelLogin !== "kurir" ) { ?>
          <li class="nav-item has-treeview  <?php echo $gudangbarang; ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-university"></i>
              <p>
                Gudang Barang
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="kategori" class="nav-link <?php active('kategori'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="satuan" class="nav-link <?php active('satuan'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Satuan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="barang" class="nav-link <?php active('barang'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="ekspedisi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ekspedisi</p>
                </a>
              </li> -->
            </ul>
          </li>
          <?php } ?>

          <?php if ( $levelLogin !== "kurir" ) { ?>
          <li class="nav-item has-treeview <?php echo $stockopname; ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-calculator"></i>
              <p>
                Stock Opname
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="stock-opname-per-produk" class="nav-link <?php active('stock-opname-per-produk'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Per Produk</p>
                </a>
              </li>

              <?php if ( $levelLogin !== "kasir" ) { ?>
              <li class="nav-item">
                <a href="stock-opname-keseluruhan" class="nav-link <?php active('stock-opname-keseluruhan'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Keseluruhan</p>
                </a>
              </li>
              <?php } ?>

              <li class="nav-item">
                <a href="stock-opname-data-produk" class="nav-link <?php active('stock-opname-data-produk'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Print Data Produk</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>

          <?php if ( $levelLogin !== "kasir" && $levelLogin !== "kurir" ) { ?>
          <li class="nav-item has-treeview <?php echo $lababersih; ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-line-chart"></i>
              <p>
                Laba Bersih
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="laba-bersih-data" class="nav-link <?php active('laba-bersih-data'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Operasional</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laba-bersih-laporan" class="nav-link <?php active('laba-bersih-laporan'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Laba Bersih</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>

          <?php if ( $levelLogin === "kurir" ) { ?>
          <li class="nav-item">
            <a href="kurir-data" class="nav-link <?php active('kurir-data'); ?>">
              <i class="nav-icon fa fa-table"></i> 
              <p>
                 Data Kurir
              </p>
            </a>
          </li>
          <?php } ?>
          
          <li class="nav-item has-treeview <?php echo $laporan; ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            
            <ul class="nav nav-treeview">
              <?php if ( $levelLogin !== "kasir" && $levelLogin !== "kurir" ) { ?>
              <li class="nav-item">
                <a href="laporan-kasir" class="nav-link <?php active('laporan-kasir'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kasir</p>
                </a>
              </li>
              <?php } ?>

              <?php if ( $levelLogin === "kasir" ) { ?>
              <li class="nav-item">
                <a href="laporan-kasir-pribadi" class="nav-link <?php active('laporan-kasir-pribadi'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kasir Pribadi</p>
                </a>
              </li>
              <?php } ?>

              <?php if ( $levelLogin === "kurir" ) { ?>
              <li class="nav-item">
                <a href="laporan-kurir-pribadi" class="nav-link <?php active('laporan-kurir-pribadi'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kurir Pribadi</p>
                </a>
              </li>
              <?php } ?>

              <?php if ( $levelLogin !== "kurir" ) { ?>
              <li class="nav-item">
                <a href="laporan-kurir" class="nav-link <?php active('laporan-kurir'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kurir</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporan-customer" class="nav-link <?php active('laporan-customer'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer</p>
                </a>
              </li>
              <?php } ?>

              <?php if ( $levelLogin !== "kasir" && $levelLogin !== "kurir" ) { ?>
              <li class="nav-item has-treeview <?php echo $laporanpenjualan; ?>">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Penjualan
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="periode" class="nav-link <?php active('periode'); ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Per Periode</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="laporan-produk" class="nav-link <?php active('laporan-produk'); ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Per Produk</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="edit-transaksi" class="nav-link <?php active('edit-transaksi'); ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Retur</p>
                    </a>
                  </li>
                </ul>
              </li>
              
              <li class="nav-item">
                <a href="laporan-supplier" class="nav-link <?php active('laporan-supplier'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier</p>
                </a>
              </li>

              <li class="nav-item has-treeview <?php echo $laporanpembelian; ?>">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Pembelian
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="periode-pembelian" class="nav-link <?php active('periode-pembelian'); ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Per Periode</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="laporan-produk-pembelian" class="nav-link <?php active('laporan-produk-pembelian'); ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Per Produk</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="edit-transaksi-pembelian" class="nav-link <?php active('edit-transaksi-pembelian'); ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Retur</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="terlaris" class="nav-link <?php active('terlaris'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Terlaris</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="stok" class="nav-link <?php active('stok'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stok</p>
                </a>
              </li>
            </ul>
            <?php } ?>
          </li>
          
          <!-- <?php if ( $levelLogin === "super admin" ) { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-database"></i>
              <p>
                Backup & Restore
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="backup" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Backup</p>
                </a>
              </li>
              <?php if ( $sessionCabang < 1 ) { ?>
              <li class="nav-item">
                <a href="restore" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Restore</p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?> -->

          <?php if ( $levelLogin === "super admin" ) { ?>
          <li class="nav-header">SETTINGS</li>
          <li class="nav-item">
            <a href="user-type" class="nav-link">
              <i class="nav-icon fa fa-users"></i> 
              <p>
                 Pengguna
              </p>
            </a>
          </li>
          <?php if ( $sessionCabang == 0 ) { ?>
          <li class="nav-item">
            <a href="toko" class="nav-link">
              <i class="nav-icon fa fa-id-card-o"></i> 
              <p>
                 Toko
              </p>
            </a>
          </li>
          <?php } ?>
        <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>