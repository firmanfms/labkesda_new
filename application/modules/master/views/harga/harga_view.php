
  <script>
      
  </script>
<?php 
// test($_SESSION['alert'],0);
?>
<section class="content-header">
  <h1>
    Master
    <small>View Harga</small>
  </h1>
  <ol class="breadcrumb">
    <li><a style="color: white" type="submit" class="btn btn-block btn-primary" href="<?php echo base_url('master/harga/form'); ?>">Input</a></li>
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
              <th>Tahun</th>
              <th width="15%">Sumber Angaran</th>
              <th width="10%">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            foreach ($data_harga as $key => $value) {
            ?>
            <tr>
              <td><?php echo $value->tahun; ?></td>
              <td><?php echo $value->sumber_anggaran; ?></td>
              <td align="center">
                  <!-- <button type="submit" class="btn btn-xs btn-danger" id="delete" data-tahun="<?php echo $value->tahun; ?>">Hapus</button> -->
                  <a href="<?php echo base_url('master/harga/view/'.$value->tahun); ?>" type="submit" class="btn btn-xs btn-info">View</a>
                  <a href="<?php echo base_url('master/harga/edit/'.$value->tahun); ?>" type="submit" class="btn btn-xs btn-warning">Edit</a>
              </td>
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
  <?php if (isset($_SESSION['alert'])): ?>
  $.notify({
    title: "Save : ",
    message: "Data Berhasil di Simpan",
    icon: 'fa fa-times' 
  },{
    type: "info"
  });
  <?php endif; ?>

  $('#itemsTable').DataTable({
    "ordering": false
  });
  $('#itemsTable').on('click','#delete', function (e) {
  var id_harga   = $(this).data('id_harga');
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
                    id_harga : id_harga
                },
                type : "POST",
                url: baseUrl+'master/harga/delete',
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
                      window.location.href = baseUrl+'harga'; //will redirect to google.
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