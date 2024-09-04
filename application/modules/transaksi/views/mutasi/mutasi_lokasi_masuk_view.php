<section class="content-header">
  <h1>
    Transaksi
    <small>View Mutasi Gudang Masuk</small>
  </h1>
  <ol class="breadcrumb">
    <!-- <li><a style="color: white" type="submit" class="btn btn-block btn-primary" href="<?php echo base_url('transaksi/mutasi_lokasi/form'); ?>">Input</a></li> -->
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
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">View Mutasi Masuk</a></li>
            <li><a data-toggle="tab" href="#menu1">Data Mutasi Intransit</a></li>
          </ul>

          <div class="tab-content">
            <div id="home" class="tab-pane fade in active" style="padding-top: 13px;">
              <table id="itemsTable1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No Mutasi</th>
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Lokasi</th>
                  <th>Status</th>
                  <th width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                foreach ($data_mutasi_masuk as $key => $value) {
                  if($value->approve_mutasi==0){
                    $status     = 'On Process';
                  }elseif($value->approve_mutasi==1){
                    $status     = 'Complate';
                  }elseif($value->approve_mutasi==2){
                    $status     = 'Void';
                  }
                ?>
                <tr>
                  <td><a href="#" id='detail' onclick="return show_detail(this)" 
                  data-id="<?php echo $value->id_mutasi; ?>" 
                  data-no="<?php echo $value->no_mutasi; ?>"><?php echo $value->no_mutasi; ?></a></td>
                  <td><?php echo tgl_singkat($value->tgl); ?></td>
                  <td><?php echo $value->keterangan; ?></td>
                  <td><?php echo $value->lokasi; ?></td>
                  <td><?php echo $status; ?></td>
                  <td align="center">
                    <?php 
                    if($value->approve_mutasi!=0){
                      echo '<a type="submit" class="btn btn-xs btn-danger" target="_blank" href="'.base_url('transaksi/mutasi_masuk/cetak/'.$value->id_mutasi).'">Cetak</a>';
                    }else{
                    ?>
                    <button type="submit" class="btn btn-xs btn-info" id="delete" data-id_mutasi="<?php echo $value->id_mutasi; ?>" data-name="<?php echo $value->no_mutasi; ?>">Status</button>
                      <a href="<?php echo base_url('transaksi/mutasi_masuk/edit/'.$value->id_mutasi); ?>" type="submit" class="btn btn-xs btn-warning">Edit</a>
                      <a type="submit" class="btn btn-xs btn-danger disabled">Cetak</a>
                    <?php
                    }
                    ?>
                </tr>
                <?php 
                }
                ?>
              </table>
            </div>
            <div id="menu1" class="tab-pane fade" style="padding-top: 13px;">
              <table id="itemsTable2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No Mutasi</th>
                  <th>No Referensi</th>
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Lokasi</th>
                  <th>Status</th>
                  <th width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                foreach ($data_mutasi_keluar as $key => $value) {
                  if($value->approve_mutasi==0){
                    $status     = 'On Process';
                  }elseif($value->approve_mutasi==1){
                    $status     = 'Complate';
                  }elseif($value->approve_mutasi==2){
                    $status     = 'Void';
                  }
                ?>
                <tr>
                  <td><a href="#" id='detail' onclick="return show_detail(this)" 
                  data-id="<?php echo $value->id_mutasi; ?>" 
                  data-no="<?php echo $value->no_mutasi; ?>"><?php echo $value->no_mutasi; ?></a></td>
                  <td><?php echo $value->no_referensi; ?></td>
                  <td><?php echo tgl_singkat($value->tgl); ?></td>
                  <td><?php echo $value->keterangan; ?></td>
                  <td><?php echo $value->lokasi; ?></td>
                  <td><?php echo $status; ?></td>
                  <td align="center">
                    <?php 
                    if($value->no_referensi==''){
                    ?>
                      <button type="submit" class="btn btn-xs btn-info" id="approve" data-id_mutasi="<?php echo $value->id_mutasi; ?>" data-name="<?php echo $value->no_mutasi; ?>">Status</button>
                    <?php
                    }else{
                      echo '<button type="submit" class="btn btn-xs btn-info disabled">Status</button>';
                    }
                    ?>
                </tr>
                <?php 
                }
                ?>
              </table>
            </div>
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
function show_detail(e){
  let noId      = $(e).data('id');
  let noPr      = $(e).data('no');

  $.get({
    url: baseUrl + 'transaksi/mutasi_lokasi/view_popup/'+noId,
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
  $('#itemsTable2').DataTable({
    "ordering": false
  });

  $('#itemsTable2').on('click','#approve', function (e) {
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
                url: baseUrl+'transaksi/mutasi_lokasi_masuk/approve',
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
                          // onClosed: function(){ location.reload();}
                        });

                    setTimeout(function () {
                      window.location.href = baseUrl+'transaksi/mutasi_lokasi_masuk'; //will redirect to google.
                    }, 2000);
                  }
                }
            });

          }
        },
      ],
    });
  });

  $('#itemsTable1').DataTable({
    "ordering": false
  });

  $('#itemsTable1').on('click','#delete', function (e) {
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
                url: baseUrl+'transaksi/mutasi_lokasi_masuk/approve',
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
                      window.location.href = baseUrl+'transaksi/mutasi_lokasi_masuk'; //will redirect to google.
                    }, 2000);
                  }
                }
            });

          }
        },
      ],
    });
  });

})
</script>