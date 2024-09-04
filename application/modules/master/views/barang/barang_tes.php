<section class="content-header">
  <h1>
    Master
    <small>Tes</small>
  </h1>
  <!-- <ol class="breadcrumb">
    <li><button type="submit" class="btn btn-primary">Submit</button></li>
  </ol> -->
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border"></div>
        <form class="form-horizontal" action="<?php echo base_url(); ?>master/barang/tes_act" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Text </label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nama" placeholder="Nama Barang" name="text">
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">No Telp </label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nama" placeholder="Nama Barang" name="no_telp">
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('master/barang'); ?>" type="submit" class="btn btn-danger">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
$(document).ready(function(){
  $('#id_kat_barang').select2();
  $('#id_satuan').select2();


})
</script>

            