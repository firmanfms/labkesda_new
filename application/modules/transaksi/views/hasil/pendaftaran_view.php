<section class="content-header">
  <h1>
    Transaksi
    <small>View Pendaftaran</small>
  </h1>
  <ol class="breadcrumb">
    <li><a style="color: white" type="submit" class="btn btn-block btn-primary" href="<?php echo base_url('transaksi/pendaftaran/form'); ?>">Input</a></li>
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
              <th>No Pendaftaran</th>
              <th>Nama</th>
              <th>Laboratorium</th>
              <th>Sampel</th>
              <th>Tgl Terima</th>
              <th>Tgl Pengujian</th>
              <th>Tgl Selesai</th>
              <th>Metode</th>
              <th width="10%">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            foreach ($data_pendaftaran as $key => $value) {
              // if($value->approve_mutasi==0){
              //   $status     = 'On Process';
              // }elseif($value->approve_mutasi==1){
              //   $status     = 'Complate';
              // }elseif($value->approve_mutasi==2){
              //   $status     = 'Void';
              // }
            ?>
            <tr>
              <td><a href="#" id='detail' onclick="return show_detail(this)" data-no="<?php echo $value->no_Pendaftaran; ?>"><?php echo $value->no_Pendaftaran; ?></a></td>
              <td><?php echo $value->nama; ?></td>
              <td><?php echo $value->lab; ?></td>
              <td><?php echo $value->nm_sampel; ?></td>
              <td><?php echo $value->tgl_diterima; ?></td>
              <td><?php echo $value->tgl_pengujian; ?></td>
              <td><?php echo $value->tgl_selesai; ?></td>
              <td><?php echo $value->nm_parameter; ?></td>
              <td align="center">
                <?php 
                if($value->status!=0){
                  echo '<button type="submit" class="btn btn-xs btn-info disabled">Status</button>';
                  echo '<a type="submit" class="btn btn-xs btn-warning disabled">Edit</a></td>';
                }else{
                ?>
                  <button type="submit" class="btn btn-xs btn-info" id="delete" data-name="<?php echo $value->no_Pendaftaran; ?>">Status</button>
                  <a href="<?php echo base_url('transaksi/pendaftaran/edit/'.$value->no_Pendaftaran); ?>" type="submit" class="btn btn-xs btn-warning">Edit</a></td>
                <?php
                }
                ?>
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
function show_detail(e){
  let noId      = $(e).data('id');
  let noPr      = $(e).data('no');

  $.get({
    url: baseUrl + 'transaksi/pendaftaran/view_popup/'+noId,
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
    "ordering": false
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
                url: baseUrl+'transaksi/pendaftaran/approve',
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
                      window.location.href = baseUrl+'transaksi/pendaftaran'; //will redirect to google.
                    }, 2000);
                  }
                }
            });

          }
        },
        {
          label: '<i class="fa fa-close"></i> Void', cssClass: 'btn-danger', id: 'update_sales', //hotkey: 'alt'+'s',
          // icon: 'glyphicon glyphicon-check',
          action: function(dia){
            dia.close();
            $.ajax({
                data: {
                    id_mutasi       : id_mutasi,
                    approve_mutasi  : 2
                },
                type : "POST",
                url: baseUrl+'transaksi/pendaftaran/approve',
                success : function(resp){

                  if(resp.status == 'ERROR INSERT' || resp.status == false) {
                    alert('Data Tidak berhasil di Hapus');
                    return false;

                  } else {
                    $.notify({
                          icon: "glyphicon glyphicon-save",
                          message: 'Data berhasil di Void'
                        },{
                          type: 'success',
                          onClosed: function(){ location.reload();}
                        });

                    setTimeout(function () {
                      window.location.href = baseUrl+'transaksi/pendaftaran'; //will redirect to google.
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