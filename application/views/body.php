<?php
// test($this->current_user,1);
if($this->current_user['loginuser']==1){
  // test($this->current_user['app_level'],1);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Laboratorium Management System</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/_all-skins.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/morris.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/jquery-jvectormap.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/daterangepicker.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-dialog.min.css" type="text/css" />
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/accordion.css" type="text/css" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="<?= base_url('assets/css/autocomplete/style.css'); ?>">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <link rel="shortcut icon" href="<?= base_url(); ?>assets/image/Lambang.ico">
  <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/js/jquery-ui.min.js"></script>
  <script src="<?= base_url() ?>assets/js/jquery.inputmask.bundle.js" type="text/javascript"  charset="utf-8"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap-notify.min.js"></script>
  <script>
      var baseUrl = '<?= base_url(); ?>';
    </script>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Lab</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Laboratorium Management System</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <!-- <a href="#"> -->
              <span  style="color: white;font-size: 20px;position: relative;display: block;padding: 10px 15px;"><b>UPT LABKESDA KOTA TANGERANG</b></span>
            <!-- </a> -->
          </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?= $this->current_user['nama']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?= base_url('logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="<?= ($this->session->userdata('ses_menu')['active_menu']=='Dashboard')? "active menu-open" : ""; ?>"><a  href="<?= base_url('welcome'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <?php 
        if($this->current_user['app_level']=='0'){
        ?>
        <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='Master')? "active menu-open" : ""; ?>">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='user')? "class='active'" : ""; ?>><a href="<?= base_url('user'); ?>"><i class="fa fa-circle-o"></i> User</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='satuan')? "class='active'" : ""; ?>><a href="<?= base_url('satuan'); ?>"><i class="fa fa-circle-o"></i> Satuan</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='parameter')? "class='active'" : ""; ?>><a href="<?= base_url('parameter'); ?>"><i class="fa fa-circle-o"></i> Kategori Parameter</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='sampel')? "class='active'" : ""; ?>><a href="<?= base_url('sampel'); ?>"><i class="fa fa-circle-o"></i> Sampel</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='laboratorium')? "class='active'" : ""; ?>><a href="<?= base_url('laboratorium'); ?>"><i class="fa fa-circle-o"></i> Laboratorium</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='metode')? "class='active'" : ""; ?>><a href="<?= base_url('metode'); ?>"><i class="fa fa-circle-o"></i> Parameter</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='dokter')? "class='active'" : ""; ?>><a href="<?= base_url('dokter'); ?>"><i class="fa fa-circle-o"></i> Dokter</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='manajemen')? "class='active'" : ""; ?>><a href="<?= base_url('manajemen'); ?>"><i class="fa fa-circle-o"></i> Manajemen</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='keterangan')? "class='active'" : ""; ?>><a href="<?= base_url('keterangan'); ?>"><i class="fa fa-circle-o"></i> Keterangan</a></li>
            <!-- <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='kat_barang')? "class='active'" : ""; ?>><a href="<?= base_url('kat_barang'); ?>"><i class="fa fa-circle-o"></i> Kategori Barang</a></li> -->
            <!-- <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='kat_barang_sub')? "class='active'" : ""; ?>><a href="<?= base_url('kat_barang_sub'); ?>"><i class="fa fa-circle-o"></i> Sub Kategori Barang</a></li> -->
            <!-- <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='kat_aset')? "class='active'" : ""; ?>><a href="<?= base_url('kat_aset'); ?>"><i class="fa fa-circle-o"></i> Kategori Aset</a></li> -->
            <!-- <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='barang')? "class='active'" : ""; ?>><a href="<?= base_url('barang'); ?>"><i class="fa fa-circle-o"></i> Barang</a></li> -->
            <!-- <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='harga')? "class='active'" : ""; ?>><a href="<?= base_url('harga'); ?>"><i class="fa fa-circle-o"></i> Harga</a></li> -->
            <!-- <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='vendor')? "class='active'" : ""; ?>><a href="<?= base_url('vendor'); ?>"><i class="fa fa-circle-o"></i> Vendor</a></li> -->
            <!-- <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='lokasi')? "class='active'" : ""; ?>><a href="<?= base_url('lokasi'); ?>"><i class="fa fa-circle-o"></i> Lokasi</a></li> -->
            <!-- <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='lokasi_sub')? "class='active'" : ""; ?>><a href="<?= base_url('lokasi_sub'); ?>"><i class="fa fa-circle-o"></i> Sub Lokasi</a></li> -->
            <!-- <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='lokasi_assets')? "class='active'" : ""; ?>><a href="<?= base_url('lokasi_assets'); ?>"><i class="fa fa-circle-o"></i> Lokasi Aset</a></li> -->
            <!-- <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='aset')? "class='active'" : ""; ?>><a href="<?= base_url('aset'); ?>"><i class="fa fa-circle-o"></i> Aset</a></li> -->
          </ul>
        </li>
        <?php 
        }
        ?>
        <?php 
        if($this->current_user['app_level']=='0' OR $this->current_user['app_level']=='3' OR $this->current_user['app_level']=='5' 
          OR $this->current_user['app_level']=='2' OR $this->current_user['app_level']=='1' OR $this->current_user['app_level']=='4'){
        ?>
        <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='Transaksi')? 'active menu-open' : ''; ?>">
          <a href="#">
            <i class="fa fa-share"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php 
            if($this->current_user['app_level']=='0' OR $this->current_user['app_level']=='3' OR $this->current_user['app_level']=='4'){
            ?>
            <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='pendaftaran')? 'active' : ''; ?>">
              <a href="#"><i class="fa fa-laptop"></i> Pendaftaran <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
              <ul class="treeview-menu">
                <li <?= ($this->session->userdata('ses_menu')['active_submenu2']=='pendaftaran_klinik')? "class='active'" : ""; ?>><a href="<?= base_url('transaksi/pendaftaran_klinik'); ?>"><i class="fa fa-circle-o"></i> Klinik</a></li>
                <li <?= ($this->session->userdata('ses_menu')['active_submenu2']=='pendaftaran_lingkungan')? "class='active'" : ""; ?>><a href="<?= base_url('transaksi/pendaftaran_lingkungan'); ?>"><i class="fa fa-circle-o"></i> Lingkungan</a></li>
                <li <?= ($this->session->userdata('ses_menu')['active_submenu2']=='pendaftaran_maknum')? "class='active'" : ""; ?>><a href="<?= base_url('transaksi/pendaftaran_maknum'); ?>"><i class="fa fa-circle-o"></i> Makanan & Minuman</a></li>
              </ul>
            </li>
            <?php 
            }            
            if($this->current_user['app_level']=='0' OR $this->current_user['app_level']=='5' OR $this->current_user['app_level']=='2' 
              OR $this->current_user['app_level']=='1' OR $this->current_user['app_level']=='4' OR $this->current_user['app_level']=='3'){
            ?>
            <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='hasil')? "class='active'" : ""; ?>">
              <a href="#"><i class="fa fa-edit"></i> Hasil Pemeriksaan <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
              <ul class="treeview-menu">
                <li <?= ($this->session->userdata('ses_menu')['active_submenu2']=='hasil_klinik')? "class='active'" : ""; ?>><a href="<?= base_url('transaksi/hasil_klinik'); ?>"><i class="fa fa-circle-o"></i> Klinik</a></li>
                <li <?= ($this->session->userdata('ses_menu')['active_submenu2']=='hasil_lingkungan')? "class='active'" : ""; ?>><a href="<?= base_url('transaksi/hasil_lingkungan'); ?>"><i class="fa fa-circle-o"></i> Lingkungan</a></li>
                <li <?= ($this->session->userdata('ses_menu')['active_submenu2']=='hasil_maknum')? "class='active'" : ""; ?>><a href="<?= base_url('transaksi/hasil_maknum'); ?>"><i class="fa fa-circle-o"></i> Makanan & Minuman</a></li>
              </ul>
            </li>
            <?php 
            }
            ?>
          </ul>
        </li>
        <?php 
        }
        ?>
        <?php 
        if($this->current_user['app_level']=='0' OR $this->current_user['app_level']=='2'){
        ?>
        <li class="<?= ($this->session->userdata('ses_menu')['active_menu']=='Pemantauan')? "active menu-open" : ""; ?>"><a  href="<?= base_url('transaksi/pemantauan'); ?>"><i class="fa fa-dashboard"></i> <span>Pemantapan Mutu Internal</span></a></li>
        <?php
        }
        if($this->current_user['app_level']=='0' OR $this->current_user['app_level']=='3' OR $this->current_user['app_level']=='5'){
        ?>
        <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='Report')? "active menu-open" : ""; ?>">
          <a href="#">
            <i class="fa fa-archive"></i> <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='pemantauan')? "class='active'" : ""; ?>><a href="<?= base_url('pemantauan'); ?>"><i class="fa fa-circle-o"></i> Pemantapan Mutu Internal</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='lab_lingkungan')? "class='active'" : ""; ?>><a href="<?= base_url('lab_lingkungan'); ?>"><i class="fa fa-circle-o"></i> Rekap Hasil</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='report/parameter')? "class='active'" : ""; ?>><a href="<?= base_url('report/parameter'); ?>"><i class="fa fa-circle-o"></i> Rekap per Parameter</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='report/analis')? "class='active'" : ""; ?>><a href="<?= base_url('report/analis'); ?>"><i class="fa fa-circle-o"></i> Rekap Analis</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='report/laboratorium/outstanding')? "class='active'" : ""; ?>><a href="<?= base_url('report/laboratorium/outstanding'); ?>"><i class="fa fa-circle-o"></i> Outstanding Sample</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='report/laboratorium/tindakan_sample')? "class='active'" : ""; ?>><a href="<?= base_url('report/laboratorium/tindakan_sample'); ?>"><i class="fa fa-circle-o"></i> Outstanding Sample (All Status)</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='report/laboratorium/grafik_kunjungan')? "class='active'" : ""; ?>><a href="<?= base_url('report/laboratorium/grafik_kunjungan'); ?>"><i class="fa fa-circle-o"></i>Grafik Kunjungan dan Pemeriksaan</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='report/laboratorium/table_kunjungan')? "class='active'" : ""; ?>><a href="<?= base_url('report/laboratorium/table_kunjungan'); ?>"><i class="fa fa-circle-o"></i> Table Kunjungan dan Pemeriksaan</a></li>
            <!--<li <?= ($this->session->userdata('ses_menu')['active_submenu']=='report/laboratorium/rekap_pemeriksaan')? "class='active'" : ""; ?>><a href="<?= base_url('report/lab_lingkungan'); ?>"><i class="fa fa-circle-o"></i> Rekap Pemeriksaan</a></li> 
            <!-- <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='stok')? "class='active'" : ""; ?>><a href="<?= base_url('stok'); ?>"><i class="fa fa-circle-o"></i> Stok</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='history_stok')? "class='active'" : ""; ?>><a href="<?= base_url('history_stok'); ?>"><i class="fa fa-circle-o"></i> History Stok</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='kategori_stok')? "class='active'" : ""; ?>><a href="<?= base_url('kategori_stok'); ?>"><i class="fa fa-circle-o"></i> Stok Perkategori</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='pemakaian')? "class='active'" : ""; ?>><a href="<?= base_url('pemakaian'); ?>"><i class="fa fa-circle-o"></i> Pemakaian</a></li>
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='aset_report')? "class='active'" : ""; ?>><a href="<?= base_url('aset_report'); ?>"><i class="fa fa-circle-o"></i> Aset</a></li> -->
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='report/Invoices')? "class='active'" : ""; ?>><a href="<?= base_url('report/Invoices'); ?>"><i class="fa fa-circle-o"></i> Rekap Invoices</a></li>
          </ul>
        </li>
        <?php 
        }
        if($this->current_user['app_level']=='6'){
        ?>
        <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='Transaksi')? 'active menu-open' : ''; ?>">
          <a href="#">
            <i class="fa fa-share"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='pendaftaran')? 'active' : ''; ?>">
              <a href="#"><i class="fa fa-laptop"></i> Pendaftaran <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
              <ul class="treeview-menu">
                <li <?= ($this->session->userdata('ses_menu')['active_submenu2']=='pendaftaran_maknum')? "class='active'" : ""; ?>><a href="<?= base_url('transaksi/pendaftaran_maknum'); ?>"><i class="fa fa-circle-o"></i> Makanan & Minuman</a></li>
              </ul>
            </li>
            <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='hasil')? "class='active'" : ""; ?>">
              <a href="#"><i class="fa fa-edit"></i> Hasil Pemeriksaan <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
              <ul class="treeview-menu">
                <li <?= ($this->session->userdata('ses_menu')['active_submenu2']=='hasil_maknum')? "class='active'" : ""; ?>><a href="<?= base_url('transaksi/hasil_maknum'); ?>"><i class="fa fa-circle-o"></i> Makanan & Minuman</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="<?= ($this->session->userdata('ses_menu')['active_menu']=='Pemantauan')? "active menu-open" : ""; ?>"><a  href="<?= base_url('transaksi/pemantauan'); ?>"><i class="fa fa-dashboard"></i> <span>Pemantapan Mutu Internal</span></a></li>
        <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='Report')? "active menu-open" : ""; ?>">
          <a href="#">
            <i class="fa fa-archive"></i> <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='pemantauan')? "class='active'" : ""; ?>><a href="<?= base_url('pemantauan'); ?>"><i class="fa fa-circle-o"></i> Pemantapan Mutu Internal</a></li>
          </ul>
        </li>
        <?php
        }
        if($this->current_user['app_level']=='7'){
        ?>
        <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='Transaksi')? 'active menu-open' : ''; ?>">
          <a href="#">
            <i class="fa fa-share"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='pendaftaran')? 'active' : ''; ?>">
              <a href="#"><i class="fa fa-laptop"></i> Pendaftaran <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
              <ul class="treeview-menu">
                <li <?= ($this->session->userdata('ses_menu')['active_submenu2']=='pendaftaran_lingkungan')? "class='active'" : ""; ?>><a href="<?= base_url('transaksi/pendaftaran_lingkungan'); ?>"><i class="fa fa-circle-o"></i> Lingkungan</a></li>
              </ul>
            </li>
            <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='hasil')? "class='active'" : ""; ?>">
              <a href="#"><i class="fa fa-edit"></i> Hasil Pemeriksaan <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
              <ul class="treeview-menu">
                <li <?= ($this->session->userdata('ses_menu')['active_submenu2']=='hasil_lingkungan')? "class='active'" : ""; ?>><a href="<?= base_url('transaksi/hasil_lingkungan'); ?>"><i class="fa fa-circle-o"></i> Lingkungan</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="<?= ($this->session->userdata('ses_menu')['active_menu']=='Pemantauan')? "active menu-open" : ""; ?>"><a  href="<?= base_url('transaksi/pemantauan'); ?>"><i class="fa fa-dashboard"></i> <span>Pemantapan Mutu Internal</span></a></li>
        <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='Report')? "active menu-open" : ""; ?>">
          <a href="#">
            <i class="fa fa-archive"></i> <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='pemantauan')? "class='active'" : ""; ?>><a href="<?= base_url('pemantauan'); ?>"><i class="fa fa-circle-o"></i> Pemantapan Mutu Internal</a></li>
          </ul>
        </li>
        <?php
        }
        if($this->current_user['app_level']=='8'){
        ?>
        <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='Transaksi')? 'active menu-open' : ''; ?>">
          <a href="#">
            <i class="fa fa-share"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='pendaftaran')? 'active' : ''; ?>">
              <a href="#"><i class="fa fa-laptop"></i> Pendaftaran <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
              <ul class="treeview-menu">
                <li <?= ($this->session->userdata('ses_menu')['active_submenu2']=='pendaftaran_klinik')? "class='active'" : ""; ?>><a href="<?= base_url('transaksi/pendaftaran_klinik'); ?>"><i class="fa fa-circle-o"></i> Klinik</a></li>
              </ul>
            </li>
            <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='hasil')? "class='active'" : ""; ?>">
              <a href="#"><i class="fa fa-edit"></i> Hasil Pemeriksaan <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
              <ul class="treeview-menu">
                <li <?= ($this->session->userdata('ses_menu')['active_submenu2']=='hasil_klinik')? "class='active'" : ""; ?>><a href="<?= base_url('transaksi/hasil_klinik'); ?>"><i class="fa fa-circle-o"></i> Klinik</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="<?= ($this->session->userdata('ses_menu')['active_menu']=='Pemantauan')? "active menu-open" : ""; ?>"><a  href="<?= base_url('transaksi/pemantauan'); ?>"><i class="fa fa-dashboard"></i> <span>Pemantapan Mutu Internal</span></a></li>
        <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='Report')? "active menu-open" : ""; ?>">
          <a href="#">
            <i class="fa fa-archive"></i> <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?= ($this->session->userdata('ses_menu')['active_submenu']=='pemantauan')? "class='active'" : ""; ?>><a href="<?= base_url('pemantauan'); ?>"><i class="fa fa-circle-o"></i> Pemantapan Mutu Internal</a></li>
          </ul>
        </li>
        <?php
        }
        if($this->current_user['app_level']=='9'){
        ?>
        <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='Transaksi')? 'active menu-open' : ''; ?>">
          <a href="#">
            <i class="fa fa-share"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='hasil')? "class='active'" : ""; ?>">
              <a href="#"><i class="fa fa-edit"></i> Hasil Pemeriksaan <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
              <ul class="treeview-menu">
                <li <?= ($this->session->userdata('ses_menu')['active_submenu2']=='hasil_maknum')? "class='active'" : ""; ?>><a href="<?= base_url('transaksi/hasil_maknum'); ?>"><i class="fa fa-circle-o"></i> Makanan & Minuman</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="<?= ($this->session->userdata('ses_menu')['active_menu']=='Pemantauan')? "active menu-open" : ""; ?>"><a  href="<?= base_url('transaksi/pemantauan'); ?>"><i class="fa fa-dashboard"></i> <span>Pemantapan Mutu Internal</span></a></li>
        <?php
        }
        if($this->current_user['app_level']=='10'){
        ?>
        <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='Transaksi')? 'active menu-open' : ''; ?>">
          <a href="#">
            <i class="fa fa-share"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='hasil')? "class='active'" : ""; ?>">
              <a href="#"><i class="fa fa-edit"></i> Hasil Pemeriksaan <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
              <ul class="treeview-menu">
                <li <?= ($this->session->userdata('ses_menu')['active_submenu2']=='hasil_lingkungan')? "class='active'" : ""; ?>><a href="<?= base_url('transaksi/hasil_lingkungan'); ?>"><i class="fa fa-circle-o"></i> Lingkungan</a></li>\
              </ul>
            </li>
          </ul>
        </li>
        <li class="<?= ($this->session->userdata('ses_menu')['active_menu']=='Pemantauan')? "active menu-open" : ""; ?>"><a  href="<?= base_url('transaksi/pemantauan'); ?>"><i class="fa fa-dashboard"></i> <span>Pemantapan Mutu Internal</span></a></li>
        <?php
        }
        if($this->current_user['app_level']=='11'){
        ?>
        <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='Transaksi')? 'active menu-open' : ''; ?>">
          <a href="#">
            <i class="fa fa-share"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview <?= ($this->session->userdata('ses_menu')['active_menu']=='hasil')? "class='active'" : ""; ?>">
              <a href="#"><i class="fa fa-edit"></i> Hasil Pemeriksaan <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
              <ul class="treeview-menu">
                <li <?= ($this->session->userdata('ses_menu')['active_submenu2']=='hasil_klinik')? "class='active'" : ""; ?>><a href="<?= base_url('transaksi/hasil_klinik'); ?>"><i class="fa fa-circle-o"></i> Klinik</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="<?= ($this->session->userdata('ses_menu')['active_menu']=='Pemantauan')? "active menu-open" : ""; ?>"><a  href="<?= base_url('transaksi/pemantauan'); ?>"><i class="fa fa-dashboard"></i> <span>Pemantapan Mutu Internal</span></a></li>
        <?php 
        }
        ?>
      </ul> 
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <?= $contents; ?>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.18
    </div>
    <strong>Copyright &copy; 2022 <a href="https://adminlte.io">UPT LABKESDA KOTA TANGERANG <?= $this->current_user['app_level']; ?></a></strong>
  </footer>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/Chart.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/raphael.min.js"></script>
<script src="<?= base_url() ?>assets/js/morris.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.sparkline.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.knob.min.js"></script>
<script src="<?= base_url() ?>assets/js/moment.min.js"></script>
<script src="<?= base_url() ?>assets/js/daterangepicker.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.slimscroll.min.js"></script>
<script src="<?= base_url() ?>assets/js/fastclick.js"></script>
<script src="<?= base_url() ?>assets/js/adminlte.min.js"></script>
<script src="<?= base_url() ?>assets/js/dashboard.js"></script>
<script src="<?= base_url() ?>assets/js/demo.js"></script>
<script src="<?= base_url() ?>assets/js/select2.full.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap-dialog.js"></script>
</body>
</html>
<?php 
}else{
$this->session->set_flashdata('msg','<div class="alert alert-danger text-center"><font size="2">Harap Login Kembali.</font></div>');
redirect('login');
}
?>