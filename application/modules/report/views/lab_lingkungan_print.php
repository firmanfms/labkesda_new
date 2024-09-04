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
    <small>View Lab Lingkungan</small>
  </h1>
  <ol class="breadcrumb">
    <!-- <li><a style="color: white" type="submit" class="btn btn-block btn-primary" href="<?php echo base_url('transaksi/mutasi_keluar/form'); ?>">Input</a></li> -->
  </ol>
</section>
<?php 
// test($id_lokasi.' '.$month.' '.$year,0);
?>
<!-- tambah Pencarian Lab -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <form class="form-horizontal" action="<?= base_url('report/lab_lingkungan'); ?>" method='POST'>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="tgl_dari_asli" name="tgl_dari" value="<?= $tgl_dari_asli; ?>" placeholder="Tanggal">
              </div>
              <div class="col-sm-1">
                s/d
              </div>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="tgl_smp_asli" name="tgl_smp" value="<?= $tgl_smp_asli; ?>" placeholder="Tanggal">
                
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
              <div class="col-sm-5">
                <button type="submit" class="btn btn-warning" id="add-items">Cari</button>
                <a class="btn btn-info" target="_blank" href="<?= base_url('report/stok/history_stok_cetak/'.$tgl_dari.'/'.$tgl_smp); ?>">Excell</a>
              </div>
            </div>
          </form>
        </div>
      </div>
      <?php 
      if($tgl_dari!=''){
      $arr_katpar   = array();
      $arr_par      = array();
      $arr_par2     = array();
      $arr_header   = array();

      foreach ($pendaftaran as $key => $value1) {
        $arr_katpar[$value1->kd_kategori_parameter]                       = $value1;
        $arr_par[$value1->kd_kategori_parameter][$value1->kd_parameter]   = $value1->nm_parameter;
        $arr_par2[$value1->kd_kategori_parameter][]                       = $value1;
        $arr_header[$value1->no_pendaftaran]                              = $value1;

      }
      test($arr_katpar,0);
      ?>
      <div class="box">
        <div class="box-body">
            <table>
              <thead>
                <tr>
                  <th rowspan="2" width="3%">No.</th>
                  <th rowspan="2" width="9%">Nama</th>
                  <?php 
                  foreach ($arr_katpar as $key => $value1a) {
                    $jumlah     = count($arr_par[$value1a->kd_kategori_parameter]);
                  ?>
                  <th colspan="<?= $jumlah; ?>"><?= $value1a->nm_kategori_parameter.' '.$jumlah; ?></th>
                  <?php
                  }
                  ?>                  
                  <th rowspan="2">alamat</th>
                </tr>
                <tr>
                  <?php 
                  foreach ($arr_katpar as $key => $value2a) {
                    foreach ($arr_par2[$value2a->kd_kategori_parameter] as $key => $value2b) {
                      ?>
                        <th><?= $value2b->nm_parameter; ?></th>
                      <?php
                    }
                  ?>
                  
                  <?php
                  }
                  ?>                  
                </tr>
              </thead>
              <tbody>
              <?php         
              
              // test($arr_par,0);
              // test($arr_katpar,1);
              // test($arr_header,1);

              $no     = 0;
              foreach ($arr_header as $key => $value) {
                $no     = $no+1;
              ?>
              <tr>
                <td><?= $no; ?></td>
                <td><?= $value->nama; ?><br/><?= $value->no_pendaftaran; ?></td>
                <!-- <td><?= $value->old_stock; ?></td> -->
                <td align="right"></td>
                <td><?= $value->alamat; ?></td>
              </tr>
              <?php 
              }
              ?>
            </table>
        <!-- /.box-body -->
      </div>
      <?php 
      }
      ?>
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

$(document).ready(function() {

var bodyEl = $('body'),
  accordionDT = $('.accordion').find('dt'),
  accordionDD = accordionDT.next('dd'),
  parentHeight = accordionDD.height(),
  childHeight = accordionDD.children('.content_acc').outerHeight(true),
  newHeight = parentHeight > 0 ? 0 : childHeight,
  accordionPanel = $('.accordion-panel'),
  buttonsWrapper = accordionPanel.find('.buttons-wrapper'),
  openBtn = accordionPanel.find('.open-btn'),
  closeBtn = accordionPanel.find('.close-btn');

bodyEl.on('click', function(argument) {
  var totalItems = $('.accordion').children('dt').length;
  var totalItemsOpen = $('.accordion').children('dt.is-open').length;

  if (totalItems == totalItemsOpen) {
    openBtn.addClass('hidden');
    closeBtn.removeClass('hidden');
    buttonsWrapper.addClass('is-open');
  } else {
    openBtn.removeClass('hidden');
    closeBtn.addClass('hidden');
    buttonsWrapper.removeClass('is-open');
  }
});

function openAll() {

  openBtn.on('click', function(argument) {

    accordionDD.each(function(argument) {
      var eachNewHeight = $(this).children('.content_acc').outerHeight(true);
      $(this).css({
        height: eachNewHeight
      });
    });
    accordionDT.addClass('is-open');
  });
}

function closeAll() {

  closeBtn.on('click', function(argument) {
    accordionDD.css({
      height: 0
    });
    accordionDT.removeClass('is-open');
  });
}

function openCloseItem() {
  accordionDT.on('click', function() {
    // debugger
    var el = $(this),
      target = el.next('dd'),
      parentHeight = target.height(),
      childHeight = "35px",
      newHeight = parentHeight > 0 ? 0 : childHeight;

    // animate to new height
    target.css({
      height: newHeight
    });

    // remove existing classes & add class to clicked target
    if (!el.hasClass('is-open')) {
      el.addClass('is-open');
    }

    // if we are on clicked target then remove the class
    else {
      el.removeClass('is-open');
    }
  });
}

openAll();
closeAll();
openCloseItem();
});

$(document).ready(function(){

  $('.tanggal').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy'
  });

  $('#id_lokasi').select2();
  $('#month').select2();
  $('#year').select2();
  $('#id_barang').select2();

  $('#itemsTable').DataTable({
    "ordering": false,
    "bPaginate": false
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