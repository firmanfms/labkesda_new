<section class="content-header">
  <h1>
    Master
    <small>View Keterangan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a style="color: white" type="submit" class="btn btn-block btn-primary" href="<?php echo base_url('master/keterangan/form'); ?>">Input</a></li>
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
          <div class="col col-md-12" style="overflow: auto;">
          <table id="itemsTable" class="table table-bordered table-striped" style="width: 100%; overflow: auto;">
            <thead>
            <tr>
              <th width="10%">Action</th>
              <!-- <th width="5%">ID</th> -->
              <th width="5%">Versi</th>
              <th width="5%">Lab</th>
              <th>Keterangan</th>
              <th>Catatan</th>
              <th>Keterangan 2<br> </th>
              <th>Catatan 2</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            // test($data_sampel,1);
            foreach ($data_keterangan as $key => $value) {
            ?>
            <tr>
              <td align="center"><button type="submit" class="btn btn-xs btn-danger" id="delete" data-id_keterangan="<?php echo $value->id_keterangan; ?>">Hapus</button>
                  <a href="<?php echo base_url('master/keterangan/edit/'.$value->id_keterangan); ?>" type="submit" class="btn btn-xs btn-warning">Edit</a></td>
              <!-- <td><?php echo $value->id_keterangan; ?></td> -->
              <td><?php echo $value->versi; ?></td>
              <td><?php echo $value->kd_lab; ?></td>
              <td><?php echo $value->keterangan; ?></td>
              <td><?php echo $value->catatan; ?></td>
              <td><?php echo str_replace('#', '<br>', $value->keterangan2); ?></td>
              <td><?php echo str_replace('#', '<br>', $value->catatan2); ?></td>
            </tr>
            <?php 
            }
            ?>
          </table>
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
<script>
$(document).ready(function(){
  $('#itemsTable').DataTable({
    "ordering": false
  });
  $('#itemsTable').on('click','#delete', function (e) {
  var id_keterangan   = $(this).data('id_keterangan');
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
                    id_keterangan : id_keterangan
                },
                type : "POST",
                url: baseUrl+'master/keterangan/delete',
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
                      window.location.href = baseUrl+'keterangan'; //will redirect to google.
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