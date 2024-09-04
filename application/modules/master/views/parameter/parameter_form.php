<section class="content-header">
  <h1>
    Master
    <small>Input Kategori Parameter</small>
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
                <input type="text" class="form-control" id="nama" placeholder="Nama Kategori Parameter">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Zorder </label>
              <div class="col-sm-1">
                <input type="number" class="form-control" id="zorder" placeholder="Zorder">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Laboratorium</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='kd_lab'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_lab as $key => $value) {
                    echo "<option value='".$value->kd_lab."'>".$value->lab."</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Sampel</label>
              <div class="col-sm-10">
                <select class="form-control select2" style="width: 100%;" id='kd_sampel' multiple="multiple">
                  <!-- <option value='0'> </option> -->
                  <?php 
                  foreach ($data_sampel as $key => $value) {
                    echo "<option value='".$value->kd_sampel."'>".$value->nm_sampel."</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('master/parameter'); ?>" type="submit" class="btn btn-danger">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
$(document).ready(function(){
  $('#kd_lab').select2();
  $('#kd_sampel').select2();

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

    // if(!$('#zorder').val()){
    //   $.notify({
    //     title: "Erorr : ",
    //     message: "Zorder Tidak Boleh Kosong",
    //     icon: 'fa fa-times' 
    //   },{
    //     type: "danger",
    //     delay: 1000
    //   });
    //   $("#zorder").focus();
    //   return false;
    // }

    if(!$('#kd_lab').val()){
      $.notify({
        title: "Erorr : ",
        message: "Laboratorium Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $('#kd_lab').select2('open');
      return false;
    }

    $.ajax({
      url: baseUrl+'master/parameter/form_act',
      type : "POST",  
      data: {
        nama          : $('#nama').val(),
        zorder        : $('#zorder').val(),
        kd_lab        : $('#kd_lab').val(),
        kd_sampel     : $('#kd_sampel').val()

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

          // setTimeout(function () {
          //   window.location.href = baseUrl+'parameter/'; //will redirect to google.
          // }, 2000);
        }
      }
    });

  }
);
})
</script>

            