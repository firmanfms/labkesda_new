<section class="content-header">
  <h1>
    Master
    <small>Input Aset</small>
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
        <form class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama </label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nama" placeholder="Nama Aset">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Merk / Type </label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="merk" placeholder="Merk / Type">
              </div>
            </div>  
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Serial Number </label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="serial_number" placeholder="Serial Number">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tgl Perolehan </label>
              <div class="col-sm-2">
                <input type="date" class="form-control" id="tgl_perolehan" placeholder="Tanggal Perolhan">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Harga Perolehan </label>
              <div class="col-sm-3">
                <input type="number" class="form-control" id="harga_perolehan" placeholder="Harga Perolehan">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tipe Aset </label>
              <div class="col-sm-3">
                <select class="form-control select2" style="width: 100%;" id='tipe_aset'>
                  <option value="Aset Tetap">Aset Tetap</option>
                  <option value="Inventaris">Inventaris</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Sumber Anggaran </label>
              <div class="col-sm-3">
                <select class="form-control select2" style="width: 100%;" id='id_sumber'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_sumber as $key => $value) {
                    echo "<option value='".$value->id_sumber."'>".$value->sumber."</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Kondisi </label>
              <div class="col-sm-2">
                <select class="form-control select2" style="width: 100%;" id='id_kondisi'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_kondisi as $key => $value) {
                    echo "<option value='".$value->id_kondisi."'>".$value->kondisi."</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Lokasi Penyimpanan Aset </label>
              <div class="col-sm-2">
                <select class="form-control select2" style="width: 100%;" id='id_lokasi'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_assets as $key => $value) {
                    echo "<option value='".$value->id_lokasi."'>".$value->lokasi."</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Kategori Aset </label>
              <div class="col-sm-2">
                <select class="form-control select2" style="width: 100%;" id='id_kat_barang'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_kategory as $key => $value) {
                    echo "<option value='".$value->id_kat_barang."'>".$value->kategori."</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Jumlah </label>
              <div class="col-sm-1">
                <input type="number" class="form-control" id="jumlah" placeholder="Jumlah">
              </div>
            </div>
            <!-- <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Kategori aset</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='id_kat_aset'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_kataset as $key => $value) {
                    echo "<option value='".$value->id_kat_aset."'>".$value->kategori."</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Satuan</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='id_satuan'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_satuan as $key => $value) {
                    echo "<option value='".$value->id_satuan."'>".$value->satuan."</option>";
                  }
                  ?>
                </select>
              </div>
            </div> -->
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('master/aset'); ?>" type="submit" class="btn btn-danger">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
$(document).ready(function(){
  var availableTags = <?= json_encode($data_array); ?>;
  $("#nama").autocomplete({
    source: availableTags
  });
  
  $('#id_kat_barang').select2();
  $('#id_lokasi').select2();
  $('#id_sumber').select2();
  $('#id_kondisi').select2();
  $('#tipe_aset').select2();

  $('#save').click(
  function(e){
    e.preventDefault();

    if(!$('#nama').val()){
      $.notify({
        title: "Erorr : ",
        message: "Nama Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#nama").focus();
      return false;
    }

    if(!$('#serial_number').val()){
      $.notify({
        title: "Erorr : ",
        message: "Serial Number Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#serial_number").focus();
      return false;
    }

    if(!$('#tgl_perolehan').val()){
      $.notify({
        title: "Erorr : ",
        message: "Tanggal Perolehan Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#tgl_perolehan").focus();
      return false;
    }

    if(!$('#harga_perolehan').val()){
      $.notify({
        title: "Erorr : ",
        message: "Harga Perolehan Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#harga_perolehan").focus();
      return false;
    }

    if(!$('#id_sumber').val()){
      $.notify({
        title: "Erorr : ",
        message: "Sumber Anggaran Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $('#id_sumber').select2('open');
      return false;
    }

    if(!$('#jumlah').val()){
      $.notify({
        title: "Erorr : ",
        message: "Jumlah Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#jumlah").focus();
      return false;
    }

    $.ajax({
      url: baseUrl+'master/aset/form_act',
      type : "POST",  
      data: {
        nama            : $('#nama').val(),
        merk            : $('#merk').val(),
        tipe_aset       : $('#tipe_aset').val(),
        serial_number   : $('#serial_number').val(),
        tgl_perolehan   : $('#tgl_perolehan').val(),
        harga_perolehan : $('#harga_perolehan').val(),
        id_sumber       : $('#id_sumber').val(),
        id_kondisi      : $('#id_kondisi').val(),
        id_lokasi       : $('#id_lokasi').val(),
        id_kat_barang   : $('#id_kat_barang').val(),
        jumlah          : $('#jumlah').val()

      },
      success : function(resp){
        if(resp.status == 'ERROR INSERT' || resp.status == false) {
          $.notify({
            message: 'Data Gagal disimpan'
          },{
            type: 'danger'
          });
          return false;

        } else {
          $.notify({
            message: 'Data Berhasil Disimpan'
          },{
            type: 'info'
          });

          setTimeout(function () {
            window.location.href = baseUrl+'aset/'; //will redirect to google.
          }, 2000);
        }
      }
    });

  }
);
})
</script>

            