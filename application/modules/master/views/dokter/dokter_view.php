<?php
/**
  * Ringkasan dari View Dokter
  *
  * View untuk mengelola master Dokter
  * @author Firmansyah
  * @version 1.0
  * @package View Dokter
  *
  */
  ?>
<section class="content-header">
  <h1>
    Master
    <small>View Dokter</small>
  </h1>
  <ol class="breadcrumb">
    <li><a style="color: white" type="submit" class="btn btn-block btn-primary" href="<?php echo base_url('master/dokter/form'); ?>">Input</a></li>
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
              <th width="15%">ID Dokter</th>
              <th width="25%">Nama Dokter</th>
              <th>Alamat</th>
              <th width="10%">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            // test($data_sampel,1);
            foreach ($data_dokter as $key => $value) {
            ?>
            <tr>
              <td><?php echo $value->id_dokter; ?></td>
              <td><?php echo $value->nm_dokter; ?></td>
              <td><?php echo $value->alamat; ?></td>
              <td align="center"><button type="submit" class="btn btn-xs btn-danger" id="delete" data-id_dokter="<?php echo $value->id_dokter; ?>" data-name="<?php echo $value->nm_dokter; ?>">Hapus</button>
                  <a href="<?php echo base_url('master/dokter/edit/'.$value->id_dokter); ?>" type="submit" class="btn btn-xs btn-warning">Edit</a></td>
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
  $('#itemsTable').DataTable({
    "ordering": false
  });
  $('#itemsTable').on('click','#delete', function (e) {
  var id_dokter   = $(this).data('id_dokter');
  var name        = $(this).data('name');

  BootstrapDialog.show({
      title: 'Delete ',
      type : BootstrapDialog.TYPE_DANGER,
      message: 'Apakah Anda ingin menghapus '+name+' ?',
      closable: false,
      buttons: [
        {
          label: '<i class="fa fa-reply"></i> Batal', cssClass: 'btn',
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
                    id_dokter : id_dokter
                },
                type : "POST",
                url: baseUrl+'master/dokter/delete',
                success : function(resp){

                  if(resp.status == 'ERROR INSERT' || resp.status == false) {
                    alert('Data Tidak berhasil di Hapus');
                    return false;

                  } else {
                    $.notify({
                          icon: "glyphicon glyphicon-save",
                          message: 'Data berhasil dihapus'
                        },{
                          type: 'success',
                          onClosed: function(){ location.reload();}
                        });

                    setTimeout(function () {
                      window.location.href = baseUrl+'dokter'; //will redirect to google.
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