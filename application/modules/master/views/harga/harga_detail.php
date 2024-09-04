<section class="content-header">
  <h1>
    Master
    <small>View Harga</small>
  </h1>
  <!-- <ol class="breadcrumb">
    <li><button type="submit" class="btn btn-primary">Submit</button></li>
  </ol> -->
</section>
<?php 
// test($detail,1);
?>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border"></div>
        <form class="form-horizontal" method="post" action="<?php echo base_url().'master/harga/edit_act'; ?>">
          <div class="box-body">            
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Sumber Angaran</label>
              <div class="col-sm-5">
                APBD
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tahun </label>
              <div class="col-sm-5">
                <!-- <input type="text" class="form-control" name="tahun" placeholder="Tahun" value="<?= $tahun; ?>"> -->
                <?= $tahun; ?>
              </div>
            </div>
            <table id="itemsTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="15%">Kode Barang</th>
                  <th>Nama Barang</th>
                  <th width="15%">Harga Barang</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                foreach ($detail as $key => $value) {
                  // test($value,1);
                ?>
                <tr>
                  <td><?= $value->kd_barang; ?></td>
                  <td><?= $value->nama; ?></td>
                  <td>
<!--                     <input type="text" class="form-control" name="harga_barang[]" placeholder="Harga" value="<?= $value->harga_barang; ?>">
                    <input type="hidden" class="form-control" name="id_barang[]" value="<?= $value->id_barang ?>"> -->
                    <?= $value->harga_barang; ?>
                  </td>
                </tr>
                <?php 
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
            <!-- <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('master/harga'); ?>" type="submit" class="btn btn-danger">Batal</a> -->
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
$(document).ready(function(){

  $('#itemsTable').DataTable({
    "ordering": false,
    "bInfo": false,
    "bPaginate": false
  });
  
  $("#id_kat_barang").select2().on('select2:select',function(e){
    var id = $('#id_kat_barang').val();

      $.ajax({
        url : baseUrl+'master/kat_barang_sub/sub_kategori',
        method : "POST",
        data : {id: id},
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '';
          var i;
          html += '<option value="0" > - </option>';
          for(i=0; i<data.length; i++){
            html += '<option value="'+data[i].id_kat_barang_sub+'">'+data[i].kategori_sub+'</option>';
          }
          $('#id_kat_barang_sub').html(html);
        }
      })
  });
  $('#id_satuan').select2();
  $('#id_vendor').select2();
  $('#id_kat_barang_sub').select2();

  // $('#save').click(
  //   function(e){
  //   e.preventDefault();

  //   $.ajax({
  //     url: baseUrl+'master/harga/form_act',
  //     type : "POST",  
  //     data: {
  //       harga_barang    : $("input[name='harga_barang[]']").val(),
  //       id_barang       : $("input[name='id_barang[]']").val(),
  //       sumber_anggaran : 'APBD'

  //     },
  //     success : function(resp){
  //       if(resp.status == 'ERROR INSERT' || resp.status == false) {
  //         $.notify({
  //           message: 'Data Gagal disimpan'
  //         },{
  //           type: 'danger'
  //         });
  //         return false;

  //       } else {
  //         $.notify({
  //           message: 'Data Berhasil Disimpan'
  //         },{
  //           type: 'info'
  //         });

  //         // setTimeout(function () {
  //         //   window.location.href = baseUrl+'harga/'; //will redirect to google.
  //         // }, 2000);
  //       }
  //     }
  //   });

  //   }
  // );
})
</script>

            