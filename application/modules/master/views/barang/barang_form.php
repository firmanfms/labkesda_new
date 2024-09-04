<section class="content-header">
  <h1>
    Master
    <small>Input Barang</small>
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
                <input type="text" class="form-control" id="nama" placeholder="Nama Barang">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Vendor</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='id_vendor'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_vendor as $key => $value) {
                    echo "<option value='".$value->id_vendor."'>".$value->nm_vendor."</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Kemasan </label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="kemasan" placeholder="Kemasan Barang">
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
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Kategori Barang</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='id_kat_barang'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_katbarang as $key => $value) {
                    echo "<option value='".$value->id_kat_barang."' data-kd_barang='".$value->kd_kat_barang."'>".$value->kategori."</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Sub Kategori Barang</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='id_kat_barang_sub'>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Lot Number & Kadaluarsa</label>
              <div class="col-sm-5">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" id="lot_number" name="lot_number" value="Ya"> Ya
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Kode e-Katalog </label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="kd_ekatalog" placeholder="Kode e-Katalog">
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
  var availableTags = <?= json_encode($data_array); ?>;
  $("#nama").autocomplete({
    source: availableTags
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

    if(!$('#id_kat_barang').val()){
      $.notify({
        title: "Erorr : ",
        message: "Kategori Barang Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $('#id_kat_barang').select2('open');
      return false;
    }

    if(!$('#id_satuan').val()){
      $.notify({
        title: "Erorr : ",
        message: "Satuan Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $('#id_satuan').select2('open');
      return false;
    }

    $.ajax({
      url: baseUrl+'master/barang/form_act',
      type : "POST",  
      data: {
        nama              : $('#nama').val(),
        id_kat_barang     : $('#id_kat_barang').val(),
        kd_kat_barang     : $('#id_kat_barang option:selected').attr('data-kd_barang'),
        id_kat_barang_sub : $('#id_kat_barang_sub').val(),
        id_satuan         : $('#id_satuan').val(),
        id_vendor         : $('#id_vendor').val(),
        kemasan           : $('#kemasan').val(),
        lot_number        : $("#lot_number").is(":checked"),
        kd_ekatalog       : $('#kd_ekatalog').val()

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
            window.location.href = baseUrl+'barang/'; //will redirect to google.
          }, 2000);
        }
      }
    });

  }
);
})
</script>

            