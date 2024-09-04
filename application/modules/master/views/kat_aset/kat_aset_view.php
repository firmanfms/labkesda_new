<section class="content-header">
  <h1>
    Master
    <small>View Kategori Aset</small>
  </h1>
  <ol class="breadcrumb">
    <li><a style="color: white" type="submit" class="btn btn-block btn-primary" href="<?php echo base_url('master/kat_aset/form'); ?>">Input</a></li>
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
              <th width="15%">No. </th>
              <th>Nama Kategori Aset</th>
              <th width="10%">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $no   = 0;
            foreach ($data_kat_barang as $key => $value) {
              $no   = $no+1;
            ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $value->kategori; ?></td>
              <td align="center"><button type="submit" class="btn btn-xs btn-danger" id="delete" data-id_kat_barang="<?php echo $value->id_kat_barang; ?>" data-name="<?php echo $value->kategori; ?>">Hapus</button>
                  <a href="<?php echo base_url('master/kat_aset/edit/'.$value->id_kat_barang); ?>" type="submit" class="btn btn-xs btn-warning">Edit</a></td>
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
  var id_kat_barang   = $(this).data('id_kat_barang');
  var name            = $(this).data('name');

  BootstrapDialog.show({
      title: 'Hapus ',
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
                    id_kat_barang : id_kat_barang
                },
                type : "POST",
                url: baseUrl+'master/kat_aset/delete',
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
                      window.location.href = baseUrl+'kat_barang'; //will redirect to google.
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