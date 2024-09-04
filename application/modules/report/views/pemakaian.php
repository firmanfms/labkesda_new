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
    <small>View Pemakaian Barang
    </small>
  </h1>
  <ol class="breadcrumb">
    <!-- <li><a style="color: white" type="submit" class="btn btn-block btn-primary" href="<?php echo base_url('transaksi/mutasi_keluar/form'); ?>">Input</a></li> -->
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <form class="form-horizontal" action="<?= base_url('report/stok/pemakaian'); ?>" method='POST'>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
              <div class="col-sm-3">
                <select class="form-control select2" style="width: 100%;" id='id_kat_barang' name="id_kat_barang">
                  <option value="">- Pilih -</option>
                  <?php 
                  foreach ($data_kategori as $key => $value) {
                    if($id_kat_barang==$value->id_kat_barang){
                      echo "<option value='".$value->id_kat_barang."' selected>".$value->kategori."</option>";
                    }else{
                      echo "<option value='".$value->id_kat_barang."'>".$value->kategori."</option>";
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Sumber</label>
              <div class="col-sm-3">
                <select class="form-control select2" style="width: 100%;" id='id_sumber' name="id_sumber">
                  <option value="">- Pilih -</option>
                  <?php 
                  foreach ($data_sumber as $key => $value) {
                    if($id_sumber_c==$value->id_sumber){
                      echo "<option value='".$value->id_sumber."' selected>".$value->sumber."</option>";
                    }else{
                      echo "<option value='".$value->id_sumber."'>".$value->sumber."</option>";
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label> 
              <div class="col-sm-2">
                <select class="form-control" id='month' name="month">
                  <option value=""> Bulan </option>
                  <?php 
                  foreach ($data_month as $key => $value) {
                    if($this->input->post('month')==$value['id']){
                      echo '<option value="'.$value['id'].'" selected>'.$value['nama_bulan'].'</option>';
                    }else{
                      echo '<option value="'.$value['id'].'">'.$value['nama_bulan'].'</option>';
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="col-sm-2">
                <select class="form-control" id='year' name="year">
                  <option value=""> Tahun </option>
                  <?php 
                  for($year=$year_old;$year<=$year_now;$year++){
                    if($this->input->post('year')==$year){
                      echo '<option value="'.$year.'" selected>'.$year.'</option>';
                    }else{
                      echo '<option value="'.$year.'">'.$year.'</option>';
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
              <div class="col-sm-5">
                <button type="submit" class="btn btn-warning" id="add-items">Cari</button>
                <?php 
                if($id_kat_barang!=''){
                ?>
                <a class="btn btn-info" target="_blank" href="<?= base_url('report/stok/pemakaian_cetak/'.$year_c.'/'.$month.'/'.$id_kat_barang.'/'.$id_sumber_c); ?>">Excell</a>
                <?php 
                }  
                ?>
              </div>
            </div>
          </form>
        </div>
      </div>
      <?php
      if($id_kat_barang!=''){

      $arr_kategori     = array();
      $arr_barang       = array();

      foreach ($data_stok as $key => $value1) {
        $arr_kategori[$value1->kategori_sub]     = $value1->kategori_sub;
      }
      foreach ($data_stok as $key => $value2) {
        $arr_barang[$value2->kategori_sub][]     = $value2;
      }
      ?>
      <div class="box">
        <div class="box-body tableFixHead">
          <table class="table table-bordered table-striped ">
            <thead>
              <tr>
                <th width="9%">Kode</th>
                <th>Nama</th>
                <th width="15%">Vendor</th>
                <th width="15%">Satuan</th>
                <th width="7%">Volume</th>
                <th width="7%">Harga</th>
                <th width="7%">Nilai</th>
              </tr>
            </thead>
            <?php
            foreach ($arr_kategori as $key => $value_kat) {
            ?>
            <thead>
              <tr>
                <td colspan="14"><?= $value_kat; ?></td>
              </tr>
            </thead>
            <tbody style="font-weight: 500 !important;">
              <?php
              foreach ($arr_barang[$value_kat] as $key => $value) {
                // test($value,0);
                $total    = 0;
                if($value->stok_akhir!='0' || $value->stok_akhir !='' || $value->harga_perolehan !='0' || $value->harga_perolehan !=''){
                  $total  = $value->stok_akhir * $value->harga_perolehan;
                }
              ?>
              <tr>
                <td><?= $value->barcode; ?></td>
                <td><?= $value->nama; ?></td>
                <td><?= $value->nm_vendor; ?></td>
                <td><?= $value->satuan; ?></td>
                <td align="right"><?= ($value->stok_akhir>0)? money($value->stok_akhir) : '0'; ?></td>
                <td align="right"><?= money($value->harga_perolehan); ?></td>
                <td align="right"><?= money($total); ?></td>
              </tr>
              <?php
              }
            }
            ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php 
      }
      ?>
    </div>
  </div>
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
  $('.tanggal').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy'
  });

  $('#id_kat_barang').select2();
  $('#id_sumber').select2();
  $('#month').select2();
  $('#year').select2();

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