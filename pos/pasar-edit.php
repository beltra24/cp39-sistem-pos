<?php 
  include '_header.php';
  include '_nav.php';
  include '_sidebar.php'; 
?>
<?php  
  if ( $levelLogin === "kasir"  ) {
    echo "
      <script>
        document.location.href = 'bo';
      </script>
    ";
  }  
  
// ambil data di URL
$id = abs((int)$_GET['id']);


// query data mahasiswa berdasarkan id
$pasar = query("SELECT * FROM pasar WHERE kode_pasar = $id ")[0];

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ){
  // var_dump($_POST);

  // cek apakah data berhasil di tambahkan atau tidak
  if( editPasar($_POST) > 0 ) {
    echo "
      <script>
        document.location.href = 'pasar';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('data gagal ditambahkan');
      </script>
    ";
  }
  
}
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Data Pasar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="bo">Home</a></li>
              <li class="breadcrumb-item active">Data Pasar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Pasar</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group">
                          <input type="hidden" name="kode_pasar" value="<?= $pasar['kode_pasar']; ?>">
                          <label for="nama_pasar">Nama Pasar</label>
                          <input type="text" name="nama_pasar" class="form-control" id="nama_pasar" value="<?= $pasar['nama_pasar']; ?>" required>
                        </div>
                        <div class="form-group ">
                            <label for="alamat_pasar">alamat_pasar</label>
                            <div class="">
                             <textarea name="alamat_pasar" id="alamat_pasar" class="form-control" required="required" placeholder="Alamat Lengkap" style="height:123px;"><?= $pasar['alamat_pasar']; ?></textarea>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-right">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>


  </div>


<?php include '_footer.php'; ?>