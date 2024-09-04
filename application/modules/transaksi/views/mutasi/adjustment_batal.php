<?php 
$bulan          = substr($header->tgl,5,2);
$hari           = substr($header->tgl,8,2);
$tahun          = substr($header->tgl,0,4);
$tanggal        = $bulan.'/'.$hari.'/'.$tahun;
?>
<section class="content-header">
  <h1>
    Transaksi
    <small>Batal Adjustment</small>
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border"></div>
        <div class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="tanggal" value="<?php echo $tanggal; ?>" disabled>
                <input type="hidden" name="id_mutasi" value="<?php echo $header->id_mutasi; ?>" id='id_mutasi'>
                <input type="hidden" name="items" id="sup_items" value='<?php echo json_encode($new_mutasi_keluar["items"]); ?>'/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="keterangan" placeholder="Keterangan" value="<?php echo $header->keterangan; ?>" disabled>
              </div>
            </div>
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
              <div class="col-sm-5">
                <div class="radio">
                  <label><input type="radio" name="status" id="status" value="1">keluar</label>
                  <label>&nbsp;&nbsp;&nbsp;</label>
                  <label><input type="radio" name="status" id="status" value="2">Keluar</label>
                </div>
              </div>
            </div> -->
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">No. Referensi</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="no_referensi" placeholder="No. Referensi" value="<?= $header->no_referensi ?>" disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Lokasi</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='id_lokasi' disabled>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_lokasi as $key => $value) {
                    if($value->id_lokasi==$header->id_lokasi){
                      echo "<option value='".$value->id_lokasi."' selected>".$value->lokasi."</option>";
                    }else{
                      echo "<option value='".$value->id_lokasi."'>".$value->lokasi."</option>";
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <hr>  
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Barang</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="id_barang" name="id_barang" placeholder="Nama Barang" onclick="return browse_barang()"/>
                <input type="hidden" class="form-control" id="no_hasil" value="0">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Quantity</label>
              <div class="col-sm-2">
                <input type="number" class="form-control" id="quantity" placeholder="Quantity">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-3">
                <input type="hidden" class="form-control" id="no_lot" placeholder="No Lot" value="0">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-2">
                <input type="hidden" class="tanggal form-control pull-right" id="kadaluarsa" value="00/00/0000">
              </div>
            </div> -->
            <div class="col-md-12">
              <div class="table-responsive">
                <table id="detail" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Barang</th>
                    <th width="10%">Quantity</th>
                    <th width="18%">Harga Perolehan</th>
                    <th width="18%">No Lot</th>
                    <th width="10%">Kadaluarsa</th>
                    <th >Keterangan</th>
                    <th width="10%">Action</th>
                  </tr>
                  </thead>
                  <?php 
                  foreach ($detail as $key => $value) {
                    // test($value,1);
                    $bulan          = substr($value->tgl_kadaluwarsa,5,2);
                    $hari           = substr($value->tgl_kadaluwarsa,8,2);
                    $tahun          = substr($value->tgl_kadaluwarsa,0,4);
                    $tanggal        = $bulan.'/'.$hari.'/'.$tahun;

                    if($tanggal=='01/01/1700'){
                      $tanggal        = '';
                    }

                  ?>
                  <tr>
                    <td><?= $value->nama; ?> <?= ($value->type_adjustment=='Delete')? ' - '.$value->type_adjustment : ''; ?></td>
                    <td align="right"><?= money($value->qty); ?></td>
                    <td align="right"><?= money($value->harga_perolehan); ?></td>
                    <td><?= $value->lot_no; ?></td>
                    <td><?= $tanggal; ?></td>
                    <td><?= $value->type_adjustment; ?></td>
                    <td align="center">
                      <button type="submit" class="btn btn-xs btn-info" id="delete" data-id_mutasi_detail="<?php echo $value->id_mutasi_detail; ?>" data-name="<?php echo $value->nama; ?>" <?= ($value->type_adjustment=='Delete')? 'disabled' : ''; ?> >Batalkan</button>
                    </td>
                  </tr>
                  <?php
                  }
                  ?>
                </table>
              </div>
            </div>          

            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
              <div class="col-sm-5">
                <button type="submit" class="btn btn-warning" id="add-items">Tambah Detail</button>
              </div>
            </div> -->
          </div>
          <!-- <div class="box-footer">
            <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('transaksi/mutasi_keluar/reset'); ?>" type="submit" class="btn btn-danger">Batal</a>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</section>
<?php //test($new_mutasi_keluar,0); ?>

<script type="text/template" class="modal_item" id="content_browse_barang">
  <table class='table table-bordered table-hover' id='table-browse_barang' style="cursor:pointer">
    <thead>
      <tr>  
        <th>ID STOK</th>
        <th>ID BARANG</th>
        <th>Nama</th>
        <th width='10%'>Quantity</th>
        <th width='10%'>NO. Lot</th>
        <th width='10%'>Kadaluwarsa</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</script>

<script>
$(document).ready(function(){
  $('#detail').on('click','#delete', function (e) {
    // debugger
    var id_mutasi_detail= $(this).data('id_mutasi_detail');
    var name            = $(this).data('name');
    var lot             = $(this).data('lot');
    var qty             = $(this).data('qty');

    BootstrapDialog.show({
      title: 'Approve Mutasi ',
      type : BootstrapDialog.TYPE_DANGER,
      message: 'Apakah Anda ingin Menghapus Detail Barang '+name+' ?',
      closable: false,
      buttons: [
        {
          label: '<i class="fa fa-reply"></i> Tidak', cssClass: 'btn',
          action: function(dia){
            dia.close();
          }
        },
        {
          label: '<i class="fa fa-check-circle-o"></i> Ya', cssClass: 'btn-warning', id: 'update_sales', //hotkey: 'alt'+'s',
          // icon: 'glyphicon glyphicon-check',
          action: function(dia){
            dia.close();
            $.ajax({
                data: {
                    id_mutasi_detail    : id_mutasi_detail,
                    lot                 : lot
                },
                type : "POST",
                url: baseUrl+'transaksi/adjustment/batal_detail',
                success : function(resp){
                  if(resp.status=='No'){
                    $.notify({
                      icon: "glyphicon glyphicon-save",
                      message: 'Quantity stok kurang dari Quantity yang akan di batalkan. Cek Stok Terlebih Dahulu.'
                    },{
                      type: 'danger',
                      // onClosed: function(){ location.reload();}
                    });
                  }else{
                    $.notify({
                      icon: "glyphicon glyphicon-save",
                      message: 'Detail Mutasi berhasil Di Batalkan.'
                    },{
                      type: 'success',
                      onClosed: setTimeout(function(){ 
                                  location.reload();
                                },2000),
                    });
                  }
                  // debugger
                  // if(resp.status == 'ERROR INSERT' || resp.status == false) {
                  //   alert('Data Tidak berhasil di Hapus');
                  //   return false;

                  // } else {
                  //   $.notify({
                  //         icon: "glyphicon glyphicon-save",
                  //         message: 'Data berhasil di Approve'
                  //       },{
                  //         type: 'success',
                  //         // onClosed: function(){ location.reload();}
                  //       });

                  //   // setTimeout(function () {
                  //   //   window.location.href = baseUrl+'transaksi/mutasi_masuk'; //will redirect to google.
                  //   // }, 2000);
                  // }
                }
            });

          }
        }
      ],
    });
  });
});
</script>