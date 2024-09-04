<section class="content-header">
  <h1>
    Master
    <small>View Kategori Parameter</small>
  </h1>
  <ol class="breadcrumb">
    <li><a style="color: white" type="submit" class="btn btn-block btn-primary" href="<?php echo base_url('master/parameter/form'); ?>">Input</a></li>
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
              <th>Kategory Parameter</th>
              <th>zorder</th>
              <th>Laboratorium</th>
              <th>Sampel</th>
              <th width="10%">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            foreach ($data_parameter as $key => $value) {
            ?>
            <tr>
              <td><?php echo $value->nm_kategori_parameter; ?></td>
              <td><?php echo $value->zorder; ?></td>
              <td><?php echo $value->lab; ?></td>
              <td>
                <?php 
                if(is_array(json_decode($value->kd_sampel))>=1){
                  foreach (json_decode($value->kd_sampel) as $key => $value1) {
                    $nm_sampel  = $this->db->query("SELECT nm_sampel FROM m_sampel WHERE kd_sampel='".$value1."'")->row()->nm_sampel;
                    echo $nm_sampel.'</br>';
                  }
                }
                ?>
              </td>
              <td align="center"><button type="submit" class="btn btn-xs btn-danger" id="delete" data-id_barang="<?php echo $value->kd_kategori_parameter; ?>" data-name="<?php echo $value->nm_kategori_parameter; ?>">Hapus</button>
                  <a href="<?php echo base_url('master/parameter/edit/'.$value->kd_kategori_parameter); ?>" type="submit" class="btn btn-xs btn-warning">Edit</a></td>
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
  var id_barang   = $(this).data('id_barang');
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
                    kd_kategori_parameter : id_barang
                },
                type : "POST",
                url: baseUrl+'master/parameter/delete',
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
                      window.location.href = baseUrl+'parameter'; //will redirect to google.
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