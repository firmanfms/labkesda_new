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
    <small>View Pemantapan Mutu Internal</small>
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
          <form class="form-horizontal" action="<?= base_url('pemantauan'); ?>" method='POST'>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Laboratorium</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='kd_lab' name="kd_lab">
                  <option >- Pilih -</option>
                  <?php 
                  foreach ($data_lab as $key => $value) {
                    $selected       = '';
                    if($value->kd_lab==$kd_lab){
                      $selected     = 'selected=""';
                    }
                    echo "<option value='".$value->kd_lab."' ".$selected.">".$value->lab."</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Parameter</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='kd_parameter' name="kd_parameter">
                  <option value="">- Semua -</option>
                  <?php 
                  // foreach ($data_parameter as $key => $value) {
                  //   if($kd_parameter==$value->kd_parameter){
                  //     echo "<option value='".$value->kd_parameter."' selected>".$value->nm_parameter."</option>";
                  //   }else{
                  //     echo "<option value='".$value->kd_parameter."'>".$value->nm_parameter."</option>";
                  //   }
                  // }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
              <div class="col-sm-5">
                <button type="submit" class="btn btn-warning" id="add-items">Cari</button>
                <a class="btn btn-info" target="_blank" href="<?= base_url('report/pemantauan/cetak/'.$kd_parameter.'/excell'); ?>">Excell</a>
                <a class="btn btn-success" target="_blank" href="<?= base_url('report/pemantauan/cetak/'.$kd_parameter.'/print'); ?>">Print</a>
              </div>
            </div>
          </form>
        </div>
      </div>
      <?php
      // test($nm_parameter,0);
      ?>
      <div class="box">
        <div class="box-body">
          <table id="itemsTable" class="table table-bordered table-striped">
            <thead>
              <tr>
              <th>Laboratorium</th>
              <th colspan="9"><?= $lab; ?></th>
            </tr>
            <tr>
              <th>Parameter</th>
              <th colspan="9"><?= $nm_parameter; ?></th>
            </tr>
            <tr>
			  <th>No Pendaftaran </th>
              <th>Kode Sampel </th>
              <th width="9%">Tanggal</th>
              <th width="15%">Metode Analisa</th>
              <th width="9%">RPD</th>
              <th width="9%">P1</th>
              <th width="9%">P2</th>
              <th width="9%">Blanko</th>
              <th width="9%">Rec</th>
              <!-- <th width="12%">Harga Perolehan</th> -->
              <th width="9%">CRM</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            // test($data_mutasi,1);
            foreach ($data_mutasi as $key => $value) {
              // test($value,1);
              // $bulan          = substr($value->tgl,5,2);
              // $hari           = substr($value->tgl,8,2);
              // $tahun          = substr($value->tgl,0,4);
              // $tanggal        = $bulan.'/'.$hari.'/'.$tahun;
              // if($tanggal=='//'){ $tanggal='';}
            ?>
            <tr>
			  <td><?= $value->no_pendaftaran; ?></td>
              <td><?= $value->nm_sampel; ?></td>
              <td><?= tgl_singkat($value->tgl_input); ?></td>
              <td><?= $value->metode_analisa; ?></td>
              <td><?= $value->rpd; ?></td>
              <td><?= $value->p1; ?></td>
              <td><?= $value->p2; ?></td>
              <td><?= $value->blanko; ?></td>
              <td><?= $value->rec; ?></td>
              <!-- <td align="right"><?= money($value->harga_perolehan); ?></td> -->
              <td><?= $value->crm; ?></td>
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

$(document).ready(function(){
$("#kd_lab").select2().on('select2:select',function(e){
  var id = $('#kd_lab').val();
    $.ajax({
      url : baseUrl+'report/pemantauan/get_parameter',
      method : "POST",
      data : {id: id},
      async : false,
      dataType : 'json',
      success: function(data){
        var html = '';
        var i;
        html += '<option value="" > - </option>';
        for(i=0; i<data.length; i++){
          html += '<option value="'+data[i].kd_parameter+'" >'+data[i].nm_parameter+'</option>';
        }
        $('#kd_parameter').html(html);
      }
    })
});

$('#kd_parameter').select2();
});

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