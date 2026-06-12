<?php 
  include '_header-artibut.php';
?>
<?php  
  $levelLogin = $_SESSION['user_level'];
  $status = $_SESSION['user_status'];
    if ( $status === '0') {
    echo"
          <script>
            alert('Akun Tidak Aktif');
            window.location='./';
          </script>";
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>POS - System Kasir</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <!-- Favicon -->
  <link rel="icon" type="img/png" sizes="32x32" href="dist/img/seniman-koding.png">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="dist/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Sweetalert -->
  <link rel="stylesheet" type="text/css" href="dist/node_modules/sweetalert2/dist/sweetalert2.css">

  <link rel="stylesheet" type="text/css" href="dist/css/style.css">
  <!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
/* ==========================
   MODERN USER PANEL
========================== */

.modern-user-panel{
    display:flex;
    align-items:center;
    margin:15px 10px 20px;
    padding:15px;

    border-radius:18px;

    background:linear-gradient(
        135deg,
        #1e293b,
        #0f172a
    );

    box-shadow:
        0 10px 25px rgba(0,0,0,.15);

    transition:.3s ease;
}

.modern-user-panel:hover{
    transform:translateY(-2px);
}

.user-avatar{
    flex-shrink:0;
}

.user-avatar img{
    width:60px;
    height:60px;
    object-fit:cover;

    border-radius:50%;

    border:3px solid rgba(255,255,255,.15);
}

.user-detail{
    margin-left:12px;
    overflow:hidden;
}

.user-name{
    color:#fff;
    font-size:15px;
    font-weight:700;

    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.user-role{
    display:inline-block;

    margin-top:6px;
    padding:4px 10px;

    background:#2563eb;
    color:#fff;

    border-radius:30px;

    font-size:11px;
    font-weight:600;
}

.user-role i{
    margin-right:4px;
}

.user-status{
    margin-top:8px;

    color:#cbd5e1;
    font-size:12px;
}

.status-dot{
    width:8px;
    height:8px;

    display:inline-block;

    background:#22c55e;
    border-radius:50%;

    margin-right:5px;

    box-shadow:0 0 8px #22c55e;
}
/* ==========================
   GLOBAL
========================== */

body{
    font-family:'Inter',sans-serif;
    background:#f8fafc;
}

.content-wrapper{
    background:#f8fafc;
}

/* ==========================
   SIDEBAR MODERN
========================== */

.main-sidebar{
    background:linear-gradient(
        180deg,
        #0f172a 0%,
        #1e293b 100%
    ) !important;

    box-shadow:
        4px 0 25px rgba(0,0,0,.15);
}

/* ==========================
   BRAND
========================== */

.brand-link{
    border-bottom:1px solid rgba(255,255,255,.08);
    text-align:center;
    padding:18px 10px;
}

.brand-link .brand-image{
    float:none;
    margin:0;
    width:40px;
    height:40px;
}

.brand-text{
    color:#fff !important;
    font-weight:800 !important;
    letter-spacing:.5px;
    margin-left:8px;
}

/* ==========================
   USER PANEL
========================== */

.user-panel{
    border-bottom:1px solid rgba(255,255,255,.08);
    padding-bottom:15px !important;
}

.user-panel .image img{
    width:45px;
    height:45px;
}

.user-panel .info a{
    color:#fff !important;
    font-weight:600;
}

.user-panel .info small{
    color:#94a3b8;
}

/* ==========================
   HEADER MENU
========================== */

.nav-header{
    color:#94a3b8 !important;
    font-size:11px;
    letter-spacing:2px;
    text-transform:uppercase;
    padding-left:20px !important;
    margin-top:10px;
}

/* ==========================
   MENU ITEM
========================== */

.nav-sidebar .nav-item{
    margin-bottom:3px;
}

.nav-sidebar .nav-link{
    margin:0 10px;
    border-radius:12px;
    transition:.3s ease;
    color:#cbd5e1 !important;
}

.nav-sidebar .nav-link p{
    font-weight:500;
}

.nav-sidebar .nav-link:hover{
    background:#334155;
    color:#fff !important;
    transform:translateX(4px);
}

/* ==========================
   ACTIVE MENU
========================== */

.nav-sidebar .nav-link.active{
    background:linear-gradient(
        135deg,
        #2563eb,
        #3b82f6
    ) !important;

    color:#fff !important;

    box-shadow:
        0 8px 20px rgba(37,99,235,.35);
}

.nav-sidebar .menu-open > .nav-link{
    background:#1e293b;
    color:#fff !important;
}

/* ==========================
   SUB MENU
========================== */

.nav-treeview{
    padding-left:8px;
}

.nav-treeview .nav-link{
    font-size:14px;
}

.nav-treeview .nav-link.active{
    background:#2563eb !important;
}

/* ==========================
   ICON
========================== */

.nav-icon{
    width:24px !important;
    text-align:center;
}

/* ==========================
   SCROLLBAR
========================== */

.sidebar::-webkit-scrollbar{
    width:6px;
}

.sidebar::-webkit-scrollbar-thumb{
    background:#475569;
    border-radius:20px;
}

/* ==========================
   CARD DASHBOARD
========================== */

.card{
    border:none;
    border-radius:16px;
    box-shadow:
        0 4px 20px rgba(0,0,0,.05);
}

.card-header{
    background:#fff;
    border-bottom:1px solid #eef2f7;
}

/* ==========================
   TABLE
========================== */

.table thead th{
    border-top:none;
    background:#f8fafc;
    font-weight:600;
}

/* ==========================
   BUTTON
========================== */

.btn{
    border-radius:10px;
}

.btn-sm{
    border-radius:8px;
}

/* ==========================
   TOP NAVBAR
========================== */

.main-header{
    border:none;
    box-shadow:
        0 2px 15px rgba(0,0,0,.05);
}

/* ==========================
   FOOTER
========================== */

.main-footer{
    border-top:none;
    background:#fff;
}

</style>

  <!-- Export Excel -->
  <link rel="stylesheet" type="text/css" href="dist/css/tableexport.min.css">
  <style>
    caption.tableexport-caption {
      caption-side: top !important;
    }
    .button-default.xlsx {
      display: none !important;
    }
  </style>


  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Sweetalert -->
  <script src="dist/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">
