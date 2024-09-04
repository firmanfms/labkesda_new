<style type="text/css">
  .tableFixHead          { overflow: auto; height: 500px; }
  .tableFixHead thead th { position: sticky; top: 0; z-index: 1; }

  /* Just common table stuff. Really. */
  table  { border-collapse: collapse; width: 100%; }
  th, td { padding: 8px 16px; }
  th     { background:#eee; }
</style>

<section class="content-header">
  <h1>
    Report
    <small>View Stok</small>
  </h1>
  <ol class="breadcrumb">
    <!-- <li><a style="color: white" type="submit" class="btn btn-block btn-primary" href="<?php echo base_url('transaksi/mutasi_keluar/form'); ?>">Input</a></li> -->
  </ol>
</section>
<?php 
// test($this->session->userdata('ses_menu')['active_submenu'].' '.$this->session->userdata('ses_menu')['active_menu'],0);
?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <form class="form-horizontal" action="<?= base_url('report/stok'); ?>" method='POST'>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Lokasi</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='id_lokasi' name="id_lokasi">
                  <option value="">- Semua -</option>
                  <?php 
                  foreach ($data_lokasi as $key => $value) {
                    if($id_lokasi==$value->id_lokasi){
                      echo "<option value='".$value->id_lokasi."' selected>".$value->lokasi."</option>";
                    }else{
                      echo "<option value='".$value->id_lokasi."'>".$value->lokasi."</option>";
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Sampai Tanggal</label>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="tanggal" name="tgl_smp" value="<?= $tgl_smp_asli; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
              <div class="col-sm-5">
                <button type="submit" class="btn btn-warning" id="add-items">Cari</button>
                <a class="btn btn-info" target="_blank" href="<?= base_url('report/stok/stok_cetak/'.$id_lokasi.'/'.$tgl_smp); ?>">Excell</a>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="box">
        <div class="box-body tableFixHead">
          <table id="itemsTable" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="9%">Kode</th>
              <th>Nama</th>
              <th width="9%">Satuan</th>
              <th>Lokasi</th>
              <th>Sub Lokasi</th>
              <th width="7%">Qty</th>
              <!-- <th width="12%">Harga Perolehan</th> -->
              <th>Lot Number</th>
              <th width="9%">Tanggal Kadaluarsa</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            // test($data_mutasi,1);
            foreach ($data_mutasi as $key => $value) {
              $bulan          = substr($value->tgl,5,2);
              $hari           = substr($value->tgl,8,2);
              $tahun          = substr($value->tgl,0,4);
              $tanggal        = $bulan.'/'.$hari.'/'.$tahun;
              if($tanggal=='//'){ $tanggal='';}
            ?>
            <tr>
              <td><?= $value->barcode; ?></td>
              <td><?= $value->nama; ?></td>
              <td><?= $value->satuan; ?></td>
              <td><?= $value->lokasi; ?></td>
              <td><?= $value->tempat; ?></td>
              <td><?= $value->qty; ?></td>
              <!-- <td align="right"><?= money($value->harga_perolehan); ?></td> -->
              <td><?= $value->lot_no; ?></td>
              <td><?= $tanggal; ?></td>
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

<script>
function show_detail(e){
  let noId      = $(e).data('id');
  let noPr      = $(e).data('no');

  $.get({
    url: baseUrl + 'transaksi/mutasi_keluar/view_popup/'+noId,
    success: function(resp){
      BootstrapDialog.show({
        title: 'Nomor Mutasi # <strong> '+noPr+' </strong>', 
        nl2br: false, 
        message: resp,
        closable: true,
        size: 'size-full',
        buttons:[
          {
            label: 'Tutup',
            action: function(dia){ dia.close(); }
          }
        ]
      });
    },
    complete: function(){
      $('body').css('cursor','default');
    }
  });
  return false;
  
};

$(document).ready(function(){
  $('#itemsTable').DataTable({
    "ordering": false,
    "bPaginate": false
  });

  $('.tanggal').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy'
  });

  $('#itemsTable').on('click','#delete', function (e) {
  var id_mutasi   = $(this).data('id_mutasi');
  var name        = $(this).data('name');

  BootstrapDialog.show({
      title: 'Approve Mutasi ',
      type : BootstrapDialog.TYPE_DANGER,
      message: 'Apakah Anda ingin Update Mutasi '+name+' ?',
      closable: false,
      buttons: [
        {
          label: '<i class="fa fa-reply"></i> Batal', cssClass: 'btn',
          action: function(dia){
            dia.close();
          }
        },
        {
          label: '<i class="fa fa-check-circle-o"></i> Approve', cssClass: 'btn-warning', id: 'update_sales', //hotkey: 'alt'+'s',
          // icon: 'glyphicon glyphicon-check',
          action: function(dia){
            dia.close();
            $.ajax({
                data: {
                    id_mutasi       : id_mutasi,
                    approve_mutasi  : 1
                },
                type : "POST",
                url: baseUrl+'transaksi/mutasi_keluar/approve',
                success : function(resp){

                  if(resp.status == 'ERROR INSERT' || resp.status == false) {
                    alert('Data Tidak berhasil di Hapus');
                    return false;

                  } else {
                    $.notify({
                          icon: "glyphicon glyphicon-save",
                          message: 'Data berhasil di Approve'
                        },{
                          type: 'success',
                          onClosed: function(){ location.reload();}
                        });

                    setTimeout(function () {
                      window.location.href = baseUrl+'transaksi/mutasi_keluar'; //will redirect to google.
                    }, 2000);
                  }
                }
            });

          }
        },
        // {
        //   label: '<i class="fa fa-close"></i> Void', cssClass: 'btn-danger', id: 'update_sales', //hotkey: 'alt'+'s',
        //   // icon: 'glyphicon glyphicon-check',
        //   action: function(dia){
        //     dia.close();
        //     $.ajax({
        //         data: {
        //             id_mutasi       : id_mutasi,
        //             approve_mutasi  : 2
        //         },
        //         type : "POST",
        //         url: baseUrl+'transaksi/mutasi_keluar/approve',
        //         success : function(resp){

        //           if(resp.status == 'ERROR INSERT' || resp.status == false) {
        //             alert('Data Tidak berhasil di Hapus');
        //             return false;

        //           } else {
        //             $.notify({
        //                   icon: "glyphicon glyphicon-save",
        //                   message: 'Data berhasil di Void'
        //                 },{
        //                   type: 'success',
        //                   onClosed: function(){ location.reload();}
        //                 });

        //             setTimeout(function () {
        //               window.location.href = baseUrl+'transaksi/mutasi_keluar'; //will redirect to google.
        //             }, 2000);
        //           }
        //         }
        //     });

        //   }
        // }
      ],
    });
  });
})
</script>