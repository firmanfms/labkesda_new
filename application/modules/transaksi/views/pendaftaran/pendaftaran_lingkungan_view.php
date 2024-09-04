<section class="content-header">
  <h1>
    Transaksi
    <small>View Pendaftaran Lingkungan</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <!-- <a style="color: white" type="submit" class="btn btn-block btn-primary" href="<?php echo base_url('transaksi/pendaftaran_lingkungan/form'); ?>">Input</a> -->
      <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#exModal">Input</button>  
    </li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <!-- <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Table With Full Features</h3>
        </div>
      </div> -->
      <div class="box">
        <div class="box-body">
          <table id="itemsTable" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="11%">No Pendaftaran</th>
              <th width="19%">Nama</th>
              <th>Laboratorium</th>
              <th>Sampel</th>
              <th>Tgl Terima</th>
              <th>Tgl Pengujian</th>
              <th>Tgl Selesai</th>
              <!-- <th>Metode</th> -->
              <th width="9%">Action</th>
              <th width="20%">Print</th>
              <th width="10%">Status Bayar</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            foreach ($data_pendaftaran as $key => $value) {
              // test($value,1);
              // if($value->approve_mutasi==0){
              //   $status     = 'On Process';
              // }elseif($value->approve_mutasi==1){
              //   $status     = 'Complate';
              // }elseif($value->approve_mutasi==2){
              //   $status     = 'Void';
              // }
            ?>
            <tr>
              <td><!-- <a href="#" id='detail' onclick="return show_detail(this)" data-no="<?php echo $value->no_pendaftaran; ?>"> --><?php echo $value->no_pendaftaran; ?><!-- </a> --></td>
              <td><?php echo $value->nama; ?></td>
              <td><?php echo $value->lab; ?></td>
              <td><?php echo $value->nm_sampel; ?></td>
              <td><?php echo tgl_singkat($value->tgl_diterima); ?></td>
              <td><?php echo tgl_singkat($value->tgl_pengujian); ?></td>
              <td><?php echo tgl_singkat($value->tgl_selesai); ?></td>
              <!-- <td><?php echo $value->nm_parameter; ?></td> -->
              <td align="center">
                <?php 
                if($value->status==0){
                  echo '<button type="submit" class="btn btn-xs btn-info disabled">Status</button>';
                  echo '<a type="submit" class="btn btn-xs btn-warning disabled">Edit</a>';
                  echo '<a type="submit" class="btn btn-xs btn-warning disabled">Cetak</a>';
                }else{
                  if($value->jmlh>0){
                    echo '<button type="submit" class="btn btn-xs btn-danger disabled">Hapus</button>';
                    echo '<button type="submit" class="btn btn-xs btn-warning disabled">Edit</button>';
                  }else{
                  ?>
                    <button type="submit" class="btn btn-xs btn-danger" id="delete" data-nomor="<?php echo $value->nopendaftar; ?>">Hapus</button>
                    <button type="button" class="btn btn-xs btn-warning" onclick="return edit(this)" data-nopendaftar="<?= $value->no_pendaftaran; ?>" data-kd_sampel="<?= $value->kd_sampel ?>" data-toggle="modal" data-target="#exEdit">Edit</button> 
                  <?php
                  }
                ?>                  
                  <!-- <a href="<?php echo base_url('transaksi/pendaftaran_lingkungan/edit/'.$value->nopendaftar); ?>" type="submit" class="btn btn-xs btn-warning">Edit</a> -->
                  <a href="<?php echo base_url('transaksi/pendaftaran_lingkungan/cetak/'.$value->nopendaftar); ?>" type="submit" class="btn btn-xs btn-info" target="_blank">Cetak</a>
                <?php
                }
                ?>
              </td>
              <td align="center">
                <a href="<?php echo base_url('transaksi/pendaftaran_lingkungan/cetak/'.$value->nopendaftar); ?>" type="submit" class="btn btn-xs btn-info" target="_blank">Cetak Pendaftaran</a>
                <a href="<?php echo base_url('transaksi/pendaftaran_lingkungan/cetak_permintaan/'.$value->nopendaftar); ?>" type="submit" class="btn btn-xs btn-success" target="_blank">Cetak Permintaan</a>
              </td>
              <td><?php if($value->status_bayar=='yes'){ echo '<span class="btn btn-warning" onclick="batal_bayar(this)" data-id="'.$value->nopendaftar.'">Batal Bayar</span>'; }else{ echo '<span class="btn btn-success" onclick="bayar(this)" data-id="'.$value->nopendaftar.'">Bayar</span>'; } ?></td>
            </tr>
            <?php 
            }
            ?>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<div class="modal fade" id="exModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Pendaftaran Lingkungan</h5>
      </div>
      <form action="<?= base_url("transaksi/pendaftaran_lingkungan/form") ?>" method="post">
        <div class="modal-body">
          <div class="row">
            <label class="col-sm-3 control-label">Sampel</label>
            <label class="radio-inline col-sm-5">
              <select class="form-control select2" style="width: 100%;" id='kd_sampel' name="kd_sampel">
                <?php 
                foreach ($data_sampel as $key => $value) {
                  echo "<option value='".$value->kd_sampel."'>".$value->nm_sampel."</option>";
                }
                ?>
              </select>
            </label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Next</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="exEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Pendaftaran Lingkungan</h5>
      </div>
      <form action="<?= base_url("transaksi/pendaftaran_lingkungan/edit_new") ?>" method="post">
        <div class="modal-body">
          <div class="row">
            <label class="col-sm-3 control-label">Sampel</label>
            <label class="radio-inline col-sm-5">
              <input type="hidden" class="form-control pull-right" id="no_pendaftaran" name="no_pendaftaran">
              <input type="hidden" class="form-control pull-right" id="kd_sampel_old" name="kd_sampel_old">
              <select class="form-control select2 edit_sampel" style="width: 100%;" id='kd_sampel_edit' name="kd_sampel_edit">
                <?php 
                foreach ($data_sampel as $key => $value) {
                  echo "<option value='".$value->kd_sampel."'>".$value->nm_sampel."</option>";
                }
                ?>
              </select>
            </label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Next</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
function bayar(e){
  let noId      = $(e).data('id');
  let update    = 'yes';
  // alert(noId + ' ' + update);
  if(confirm('Yakin ingin membayar pendaftaran ini ?')){
  $.post({
    url: baseUrl + 'transaksi/pendaftaran/update_status_bayar',
    data: { no_pendaftaran: noId, status_bayar: update },
    success: function(resp){
      alert(resp.message);
      if(resp.row_afected>0){
        location.reload();
      }
      }
    });
  }
}
function batal_bayar(e){
  let noId      = $(e).data('id');
  let update    = 'no';
  // alert(noId + ' ' + update);
  if(confirm('Yakin ingin membatalkan pembayaran pendaftaran ini ?')){
    $.post({
    url: baseUrl + 'transaksi/pendaftaran/update_status_bayar',
    data: { no_pendaftaran: noId, status_bayar: update },
    success: function(resp){
      alert(resp.message);
      if(resp.row_afected>0){
        location.reload();
      }
    }
  });
  }
}
function edit(e){
  debugger
  var kd_sample   = e.dataset.kd_sampel;
  var nopendaftar = e.dataset.nopendaftar;
  $('#kd_sampel_edit').val(kd_sample).trigger('change');
  $('#no_pendaftaran').val(nopendaftar);
  $('#kd_sampel_old').val(kd_sample);
  // $('#kd_sample').val(kd_sample);
  // alert(kd_sample);
}
$(document).ready(function(){
$('.edit').click(function(){
});
$('#kd_sampel').select2();
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
              url: baseUrl+'transaksi/pendaftaran_lingkungan/delete',
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
                    window.location.href = baseUrl+'transaksi/pendaftaran_lingkungan'; //will redirect to google.
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