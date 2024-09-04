<?php if (isset($_SESSION['alert'])): ?>
  <script type="text/javascript">
    //$.notify({ message: "<?= $_SESSION['alert']; ?>" },{ type: 'info' });
  </script>
<?php endif; ?>
<div id="grid">
<section class="content-header">
  <h1>
    Transaksi
    <small>View Hasil Pemeriksaan Klinik</small>
  </h1>
</section>
<section class="content" >
  <div class="row">
    <div class="col-xs-12">
      <!-- <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Table With Full Features</h3>
        </div>
      </div> -->
    <div class ="box">
      <div class="box-body">
      <div class="row">
        <div class="col-md-3">
              <select class="form-control" id="tahun"  onchange="refreshgrid()">
                <?php foreach ($data_tahun as $key => $value) { ?><option value="<?= $value['tahun']; ?>" <?= ($tahun==$value['tahun']) ? 'selected' : '' ?>>TAHUN : <?= $value['tahun']; ?>
                </option><?php } ?></select>
                <br>
          </div>
            <div class="col-md-3">
        <select class="form-control" id="status_cetak" onchange="refreshgrid()">
          <option value="0" <?= ($status_cetak == '0') ? 'selected' : '' ?>>BELUM DONE</option>
          <option value="1" <?= ($status_cetak == '1') ? 'selected' : '' ?>>DONE</option>
        </select>
      </div>
                </div>
      </div>
      <div class="row">
      </div>
    </div>
      <div class="box">
        <div class="box-body">
          <div class="row">
          </div>
          <div class="row">
          <table id="itemsTable" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No Pendaftaran</th>
              <th>Nama</th>
              <th>Laboratorium</th>
              <th>Sampel</th>
              <th>Tgl Terima</th>
              <th>Tgl Pengujian</th>
              <th>Tgl Selesai</th>
              <!-- <th>Status</th> -->
              <th>Approve</th>
              <th width="16%">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            foreach ($data_pendaftaran as $key => $value) {
              if($value->status_approve_query==3){
                $status     = "Approve PJT";
              }else if($value->status_approve==2){
                $status     = "Approve Koordinator";
              }else if($value->status_approve==4){
                $status     = "Reject PJT";
              }else{
                $status     = "Input Hasil";
              }
            ?>
            <tr>
              <td><a href="#" id='detail' onclick="return show_detail(this)" data-no="<?php echo $value->no_pendaftaran; ?>"><?php echo $value->no_pendaftaran; ?></a></td>
              <td><?php echo $value->nama; ?></td>
              <td><?php echo $value->lab; ?></td>
              <td><?php echo $value->nm_sampel; ?></td>
              <td><?php echo tgl_singkat($value->tgl_diterima); ?></td>
              <td><?php echo tgl_singkat($value->tgl_pengujian); ?></td>
              <td><?php echo tgl_singkat($value->tgl_selesai); ?></td>
              <!-- <td><?php echo $value->nm_parameter; ?></td> -->
              <td><?= $status; ?></td>
              <td align="center">
                <a href="<?php echo base_url('transaksi/hasil_klinik/detail/'.$value->nopendaftar.'/'.$value->max_urutan); ?>" type="submit" class="btn btn-xs btn-success">Detail</a>
                <?php 
                if($value->status_approve_query==3){
                ?>
                  <button class="btn btn-xs btn-warning" onclick="openModal('<?php echo base_url('transaksi/hasil_klinik/insert/'.$value->nopendaftar.'/'.$value->max_urutan); ?>')">Hasil </button>
                  <!-- <a href="<?php echo base_url('transaksi/hasil_klinik/insert/'.$value->nopendaftar.'/'.$value->max_urutan); ?>" type="submit" class="btn btn-xs btn-warning">Hasil</a> -->
                  <?php
                }else if($value->status_approve_query==1){
                ?>
                  <a href="<?php echo base_url('transaksi/hasil_klinik/update/'.$value->nopendaftar.'/'.$value->max_urutan); ?>" type="submit" class="btn btn-xs btn-warning">Hasil</a>
                <?php
                }
                ?>
                <?php
                if($value->jumlah_detail==$value->jumlah_nilai){
                ?>
                  <?php
                    if($this->current_user['app_level']=='2' OR $this->current_user['app_level']=='9' OR $this->current_user['app_level']=='10' OR $this->current_user['app_level']=='11'){
                      if($value->status_approve_query==1 OR $value->status_approve_query==4){
                      ?>
                        <button type="button" id='approve' class="btn btn-xs btn-danger" data-toggle="modal" data-nomor="<?= $value->nopendaftar; ?>" data-level="2" <?= ($value->status_approve==2)? 'disabled' : '' ?>>Approve</button>
                      <?php
                      }else{
                      ?>
                        <button disabled type="button" id='approve' class="btn btn-xs btn-danger" data-toggle="modal" data-nomor="<?= $value->nopendaftar; ?>" data-level="2" <?= ($value->status_approve==2)? 'disabled' : '' ?>>Approve</button>
                      <?php
                      }
                  ?>
                  <?php
                  }else if($this->current_user['app_level']=='3'){
                    if($value->status_approve_query==2){
                    ?>
                      <button type="button" id='approve' class="btn btn-xs btn-danger" data-toggle="modal" data-nomor="<?= $value->nopendaftar; ?>" data-level="3" <?= ($value->status_approve==3)? 'disabled' : '' ?> >Approve</button>
                      <button type="button" id='notApprove' class="btn btn-xs btn-primary" data-toggle="modal" data-nomor="<?= $value->nopendaftar; ?>" data-level="4">Reject</button>
                      <?php
                    }else{
                      ?>
                      <button disabled type="button" id='approve' class="btn btn-xs btn-danger" data-toggle="modal" data-nomor="<?= $value->nopendaftar; ?>" data-level="3" <?= ($value->status_approve==3)? 'disabled' : '' ?> >Approve</button>
                      <button disabled type="button" id='notApprove' class="btn btn-xs btn-primary" data-toggle="modal" data-nomor="<?= $value->nopendaftar; ?>" data-level="4">Reject</button>
                      <?php
                    }
                  }
                  ?>
                <?php 
                }
                ?>
                  <?php 
                  if($value->status_approve_query==3){
                  ?>
                  <button type="button" class="btn btn-xs btn-info cetak" data-toggle="modal" data-target="#exModal" data-nomor="<?= $value->no_pendaftaran; ?>" data-urut="<?= $value->max_urutan; ?>">Cetak</button>  
                  <?php 
                         if($value->status_cetak==0){
                          ?>
                          <button type="button" class="btn btn-xs btn-primary " onclick="selesai_proses('<?= $value->no_pendaftaran; ?>')" data-toggle="" data-target="#exModal" data-nomor="<?= $value->no_pendaftaran; ?>" data-urut="<?= $value->max_urutan; ?>">DONE</button>  
                          <?php
                          }else{
                            echo "SELESAI";
                          }
                  }
                  ?>
              </td>
            </tr>
            <?php 
            }
            ?>
          </table>
          <span> <?php echo $catatankaki1 ?></span>
          <span> <?php echo $catatankaki2 ?></span>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
          </div>
<!-- Modal -->
<div class="modal  fade" id="exModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Print Klinik</h5>
      </div>
      <form action="<?= base_url("transaksi/hasil_klinik/print") ?>" method="post" target="_blank">
        <div class="modal-body">
          <div class="row">
            <label class="col-sm-5 control-label">Cetak</label>
            <label class="radio-inline col-sm-3">
              <input type="checkbox" name="type_surat" id="type_cetak" value="surat"> Surat Hasil
            </label>
            <label class="radio-inline col-sm-3">
              <input type="checkbox" name="type_laporan" id="type_cetak" value="laporan"> Laporan Hasil
            </label>
          </div>
          <div class="row">
            <label class="col-sm-5 control-label">Kop Surat</label>
            <label class="radio-inline col-sm-3">
              <input type="radio" name="header_cetak" id="header_cetak" value="Ya"> Ya
            </label>
            <label class="radio-inline col-sm-3">
              <input type="radio" name="header_cetak" id="header_cetak" value="Tidak"> Tidak
            </label>
          </div>
          <div class="row">
            <label class="col-sm-5 control-label">Agreditasi</label>
            <label class="radio-inline col-sm-1">
              <input type="radio" name="agreditasi" id="agreditasi" value="kan"> KAN
              <input type="hidden" class="form-control" id="nomor" name="nomor">
              <!-- <input type="hidden" class="form-control" id="urut" name="urut"> -->
            </label>
            <label class="radio-inline col-sm-1">
              <input type="radio" name="agreditasi" id="agreditasi" value="kalk"> KALK
            </label>
            <label class="radio-inline col-sm-3">
              <input type="radio" name="agreditasi" id="agreditasi" value="kankalk"> KAN & KALK
            </label>
          </div>
          <div class="row">
            <label class="col-sm-5 control-label">Print</label>
            <label class="radio-inline col-sm-2">
              <input type="radio" name="print" id="print" value="print"> To Printer
            </label>
            <label class="radio-inline col-sm-2">
              <input type="radio" name="print" id="print" value="word"> Convert Word
            </label>
            <label class="radio-inline col-sm-2">
              <input type="radio" name="print" id="print" value="wordversi2"> Word Baru
            </label>
          </div>
          <div class="row">
            <label class="col-sm-5 control-label">Tanda Tangan Surat</label>
            <label class="radio-inline col-sm-3">
              <input type="radio" name="ttn" id="ttn" value="kalab"> Kepala Lab
            </label>
            <label class="radio-inline col-sm-3">
              <input type="radio" name="ttn" id="ttn" value="kalata"> Kepala Tata Usaha
            </label>
          </div>
          <div class="row">
            <label class="col-sm-5 control-label">NAPSA</label>
            <label class="radio-inline col-sm-3">
              <input type="radio" name="napsa" id="napsa" value="ya"> Ya
            </label>
            <label class="radio-inline col-sm-3">
              <input type="radio" name="napsa" id="napsa" value="tidak"> Tidak
            </label>
          </div>
          <div class="row">
            <label class="col-sm-5 control-label">Versi</label>
            <label class="radio-inline col-sm-3">
              <input type="radio" name="versi" id="versi" value="1"> Satu
            </label>
            <label class="radio-inline col-sm-3">
              <!-- <input type="radio" name="print" id="print" value="word"> Convert Word -->
            </label>
          </div>
          <div class="row">
            <label class="col-sm-5 control-label">Inputan</label>
            <label class="radio-inline col-sm-7" id="urut_pilih"></label>
          </div>
          <div class="row">
            <label class="col-sm-5 control-label">Tanda Tangan Laporan</label>
            <label class="radio-inline col-sm-3">
              <input type="radio" name="ttl" id="ttl" value="matek"> Penanggung Jawab Teknis
            </label>
            <label class="radio-inline col-sm-3">
              <input type="radio" name="ttl" id="ttl" value="koor"> Koordinator Klink
            </label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Oke</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- start div conten  -->
<div id="content"></div>
  </div>
<script>
function selesai_proses(e){
  if(confirm("Apakah Anda yakin ingin melanjutkan proses ini?")){
    // Your code here
    console.log('Proses dilanjutkan');
    var nomor =  e;
    $.ajax({
      data: {
        nomor : nomor
      },
      type : "POST",
      url: baseUrl+'transaksi/hasil_klinik/update_sudah_cetak',
      success : function(resp){
        alert('done');
        location.reload();
      }
    });
  } else {
    console.log('Proses dibatalkan');
  }
}
  function refreshgrid(){
    var tahun = $('#tahun').val();
    var status_cetak = $('#status_cetak').val();
  var url = "<?php echo base_url('transaksi/hasil_klinik/'); ?>";
  url += "?tahun=" + tahun;
  url += "&status_cetak=" + status_cetak;
  window.location.href = url;
  }
   function loadPage(url) {
                $.ajax({
                    url: url,
                    success: function(response) {
                        $("#content").html(response);
                    }
                });
            }
// Fungsi untuk memanggil modal
function openModal(url) {
    // var modal = document.getElementById("myModalHasil");
    // modal.style.display = "block";
    loadPage(url);
    document.getElementById("grid").style.display = "none";
}
// Fungsi untuk menutup modal
function closeModal() {
    var modal = document.getElementById("myModalHasil");
    modal.style.display = "none";
}
// Tutup modal saat pengguna mengklik di luar modal
window.onclick = function(event) {
    var modal = document.getElementById("myModalHasil");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<script src="<?php echo base_url('assets/ckeditor/ckeditor.js');?>"></script>
<script type="text/javascript">
$(document).ready(function(){
  $(".cetak").click(function(e){
    $("#nomor").val( $(this).data('nomor'))
    $("#urut").val( $(this).data('urut'))
    $('#urut_pilih').text("");
    for (let i = 1; i <= $(this).data('urut'); i++) {
      var text = '<input type="radio" name="urut" id="urut" value="'+i+'">'+i+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
      $('#urut_pilih').append(text);
    }    
  })
  $('#itemsTable').DataTable({
    "paging": true, 
    "bLengthChange": true, // disable show entries dan page
    "bFilter": true,
    "bInfo": true, // disable Showing 0 to 0 of 0 entries
    "bAutoWidth": false,
    "language": {
        "emptyTable": "No Data"
    },
    "aaSorting": [],
    'stateSave': true, // Enable state saving
  });
  $('#itemsTable').on('click','#delete',function(e){
    var nomor           = $(this).data('nomor').replace(/-/g, '/');
    BootstrapDialog.show({
      title: 'Hapus Pendaftaraan ',
      type : BootstrapDialog.TYPE_DANGER,
      message: 'Ingin menghapus Pendaftaran '+nomor+' ?',
      closable: false,
      buttons: [
        {
          label: '<i class="fa fa-reply"></i> Cancel', cssClass: 'btn',
          action: function(dia){
            dia.close();
          }
        },
        {
          label: '<i class="fa fa-close"></i> Hapus', cssClass: 'btn-danger', id: 'update_sales', //hotkey: 'alt'+'s',
          // icon: 'glyphicon glyphicon-check',
          action: function(dia){
            dia.close();
            $.ajax({
                data: {
                    nomor : nomor
                },
                type : "POST",
                url: baseUrl+'transaksi/pendaftaran_klinik/delete',
                success : function(resp){
                  if(resp.status == 'ERROR INSERT' || resp.status == false) {
                    alert('Data Tidak berhasil di Hapus');
                    return false;
                  } else {
                    $.notify({
                          icon: "glyphicon glyphicon-save",
                          message: 'Data Berhasil di Hapus'
                        },{
                          type: 'success',
                          onClosed: function(){ location.reload();}
                        });
                    setTimeout(function () {
                      window.location.href = baseUrl+'transaksi/pendaftaran_klinik'; //will redirect to google.
                    }, 2000);
                  }
                }
            });
          }
        }
      ],
    });
  });
  $('#itemsTable').on('click','#approve',function(e){
    var nomor           = $(this).data('nomor').replace(/-/g, '/');
    var level           = $(this).data('level');
    BootstrapDialog.show({
      title: 'Approve Pendaftaraan ',
      type : BootstrapDialog.TYPE_DANGER,
      message: 'Ingin Approve '+nomor+' ?',
      closable: false,
      buttons: [
        {
          label: '<i class="fa fa-reply"></i> Batal', cssClass: 'btn',
          action: function(dia){
            dia.close();
          }
        },
        {
          label: 'Approve', cssClass: 'btn-warning', id: 'update_sales', //hotkey: 'alt'+'s',
          // icon: 'glyphicon glyphicon-check',
          action: function(dia){
            dia.close();
            $.ajax({
                data: {
                    nomor : nomor, level : level
                },
                type : "POST",
                url: baseUrl+'transaksi/pendaftaran_klinik/approve',
                success : function(resp){
                  if(resp.status == 'ERROR INSERT' || resp.status == false) {
                    alert('Data Tidak berhasil di Approve');
                    return false;
                  } else {
                    $.notify({
                          icon: "glyphicon glyphicon-save",
                          message: 'Data Berhasil di Approve'
                        },{
                          type: 'success',
                          onClosed: function(){ location.reload();}
                        });
                    setTimeout(function () {
                      window.location.href = baseUrl+'transaksi/hasil_klinik'; //will redirect to google.
                    }, 2000);
                  }
                }
            });
          }
        }
      ],
    });
  });
  $('#itemsTable').on('click','#notApprove',function(e){
    var nomor           = $(this).data('nomor').replace(/-/g, '/');
    var level           = $(this).data('level');
    BootstrapDialog.show({
      title: 'Reject Pendaftaraan ',
      type : BootstrapDialog.TYPE_WARNING,
      message: 'Ingin Reject '+nomor+' ?',
      closable: false,
      buttons: [
        {
          label: '<i class="fa fa-reply"></i> Batal', cssClass: 'btn',
          action: function(dia){
            dia.close();
          }
        },
        {
          label: 'Approve', cssClass: 'btn-warning', id: 'update_sales', //hotkey: 'alt'+'s',
          // icon: 'glyphicon glyphicon-check',
          action: function(dia){
            dia.close();
            $.ajax({
                data: {
                    nomor : nomor, level : level
                },
                type : "POST",
                url: baseUrl+'transaksi/pendaftaran_maknum/approve',
                success : function(resp){
                  if(resp.status == 'ERROR INSERT' || resp.status == false) {
                    alert('Data Tidak berhasil di Approve');
                    return false;
                  } else {
                    $.notify({
                          icon: "glyphicon glyphicon-save",
                          message: 'Data Berhasil Reject'
                        },{
                          type: 'warning',
                          onClosed: function(){ location.reload();}
                        });
                    setTimeout(function () {
                      window.location.href = baseUrl+'transaksi/hasil_maknum'; //will redirect to google.
                    }, 2000);
                  }
                }
            });
          }
        }
      ],
    });
  });
})
</script>