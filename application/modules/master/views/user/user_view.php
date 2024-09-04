<section class="content-header">
  <h1>
    Master
    <small>View User</small>
  </h1>
  <ol class="breadcrumb">
    <li><a style="color: white" type="submit" class="btn btn-block btn-primary" href="<?php echo base_url('master/user/form'); ?>">Input</a></li>
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
              <th>Nama</th>
              <th>Username</th>
              <th>Level</th>
              <th width="10%">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            // test($data_sampel,1);
            foreach ($data_user as $key => $value) {
              if($value->app_level==0){
                $level_app    = "Administrator";
              }else if($value->app_level==1){
                $level_app    = "Analis";
              }else if($value->app_level==2){
                $level_app    = "Koordinator";
              }else if($value->app_level==3){
                $level_app    = "Manager";
              }else if($value->app_level==4){
                $level_app    = "Pendaftaran";
              }else if($value->app_level==5){
                $level_app    = "Kepala LAB";
              }else if($value->app_level==6){
                $level_app    = "nalis Lab Makanan dan Minuman";
              }else if($value->app_level==7){
                $level_app    = "Analis Lab Lingkungan";
              }else if($value->app_level==8){
                $level_app    = "Analis Lab Klinik";
              }else {
                $level_app    = "";
              }
            ?>
            <tr>
              <td><?php echo $value->nama; ?></td>
              <td><?php echo $value->username; ?></td>
              <td><?php echo $level_app; ?></td>
              <td align="center"><button type="submit" class="btn btn-xs btn-danger" id="delete" data-id_username="<?php echo $value->id_username; ?>" data-name="<?php echo $value->username; ?>">Hapus</button>
                  <a href="<?php echo base_url('master/user/edit/'.$value->id_username); ?>" type="submit" class="btn btn-xs btn-warning">Edit</a></td>
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
  var id_username   = $(this).data('id_username');
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
                    id_username : id_username
                },
                type : "POST",
                url: baseUrl+'master/user/delete',
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
                      window.location.href = baseUrl+'user'; //will redirect to google.
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