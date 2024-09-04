<section class="content-header">
  <h1>
    Master
    <small>Input Dokter</small>
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border"></div>
        <form class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">ID Dokter </label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="id_dokter" placeholder="Id Dokter" value="<?php echo $detail->id_dokter; ?>">
                <input type="hidden" id="id_dokter_old" value="<?php echo $detail->id_dokter; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama </label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nama" placeholder="Nama Dokter" value="<?php echo $detail->nm_dokter; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Alamat </label>
              <div class="col-sm-5">
                <textarea class="form-control" id="alamat"><?php echo $detail->alamat; ?></textarea>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('master/dokter'); ?>" type="submit" class="btn btn-danger">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
$(document).ready(function(){
  $('#save').click(
  function(e){
    e.preventDefault();

    if(!$('#id_dokter').val()){
      $.notify({
        title: "Erorr : ",
        message: "ID Dokter Tidak Boleh Kosong",
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
      url: baseUrl+'master/dokter/edit_act',
      type : "POST",  
      data: {
        id_dokter     : $('#id_dokter').val(),
        nama          : $('#nama').val(),
        alamat        : $('#alamat').val(),
        id_dokter_old : $('#id_dokter_old').val()

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
            window.location.href = baseUrl+'dokter/'; //will redirect to google.
          }, 2000);
        }
      }
    });

  }
);
})
</script>

            