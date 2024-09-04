<section class="content-header">
  <h1>
    Master
    <small>Input Laboratorium</small>
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
              <label for="inputEmail3" class="col-sm-2 control-label">Kode Laboratorium </label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="kd_lab" placeholder="Kode Laboratorium">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama </label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nama" placeholder="Nama Laboratorium">
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('master/laboratorium'); ?>" type="submit" class="btn btn-danger">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
$(document).ready(function(){
  $('#id_kat_barang').select2();

  $('#save').click(
  function(e){
    e.preventDefault();

    if(!$('#kd_lab').val()){
      $.notify({
        title: "Erorr : ",
        message: "Kode Lab Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#kd_lab").focus();
      return false;
    }

    if(!$('#nama').val()){
      $.notify({
        title: "Erorr : ",
        message: "Kode Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#nama").focus();
      return false;
    }

    $.ajax({
      url: baseUrl+'master/laboratorium/form_act',
      type : "POST",  
      data: {
        kd_lab        : $('#kd_lab').val(),
        nama          : $('#nama').val()

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
            window.location.href = baseUrl+'laboratorium/'; //will redirect to google.
          }, 2000);
        }
      }
    });

  }
);
})
</script>

            