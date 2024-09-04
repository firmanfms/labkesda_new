<section class="content-header">
  <h1>
    Report
    <small>View Aset</small>
  </h1>
  <ol class="breadcrumb">
    <li><a style="color: white" type="submit" class="btn btn-block btn-primary" href="<?php echo base_url('master/aset/rekap'); ?>">Rekap</a></li>
    <li><a style="color: white" type="submit" class="btn btn-block btn-primary" href="<?php echo base_url('master/aset/excell'); ?>">Cetak</a></li>
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
              <th width="15%" style="text-align: center;">Nama</th>
              <th width="8%" style="text-align: center;">Kode Aset</th>
              <th style="text-align: center;">Kategory</th>
              <th width="8%" style="text-align: center;">Tanggal Perolehan</th>
              <th style="text-align: center;">Sumber</th>
              <th style="text-align: center;">Kondisi</th>
              <th style="text-align: center;">Lokasi</th>
              <th style="text-align: center;">Harga</th>
              <!-- <th width="10%" style="text-align: center;">Action</th> -->
            </tr>
            </thead>
            <tbody>
            <?php 
            foreach ($data_aset as $key => $value) {
            ?>
            <tr>
              <td><?php echo $value->nama; ?></td>
              <td><?php echo $value->kd_assets; ?></td>
              <td><?php echo $value->kategori; ?></td>
              <td><?php echo tgl_singkat($value->tgl_perolehan); ?></td>
              <td><?php echo $value->sumber; ?></td>
              <td><?php echo $value->kondisi; ?></td>
              <td><?php echo $value->lokasi; ?></td>
              <td align="right"><?php echo number_format($value->harga_perolehan); ?></td>
              <!-- <td align="center"><button type="submit" class="btn btn-xs btn-danger" id="delete" data-id_aset="<?php echo $value->id_assets; ?>" data-name="<?php echo $value->nama; ?>">Hapus</button>
                  <a href="<?php echo base_url('master/aset/edit/'.$value->id_assets); ?>" type="submit" class="btn btn-xs btn-warning">Edit</a></td> -->
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
    "ordering": false,
    "bPaginate": false
  });

  $('#itemsTable').on('click','#delete', function (e) {
  var id_aset   = $(this).data('id_aset');
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
                    id_assets : id_aset
                },
                type : "POST",
                url: baseUrl+'master/aset/delete',
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
                      window.location.href = baseUrl+'aset'; //will redirect to google.
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