<section class="content-header">
  <h1>
    Master
    <small>Input keterangan</small>
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
              <label for="inputEmail3" class="col-sm-2 control-label">Versi </label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='versi'>
                  <option disabled="" selected="">- Pilih -</option>
                  <option value="1">- Satu -</option>
                  <option value="2">- Dua -</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Keterangan </label>
              <div class="col-sm-9">
                <textarea name="content" id="ckeditor1" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Catatan </label>
              <div class="col-sm-9">
                <textarea name="content" id="ckeditor2" required></textarea>
              </div>
            </div>
          </div>
              <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Keterangan 2</label>
              <div class="col-sm-7">
                <textarea name="content" rows="7" cols="100" id="keterangan2" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Catatan 2</label>
              <div class="col-sm-5">
                <textarea name="content" rows="7" cols="100" id="catatan2" required></textarea>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('master/keterangan'); ?>" type="submit" class="btn btn-danger">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<script src="<?php echo base_url('assets/ckeditor/ckeditor.js');?>"></script>
<script>
$(document).ready(function(){
  CKEDITOR.replace('ckeditor1',{
    filebrowserImageBrowseUrl : '<?php echo base_url('assets/kcfinder/browse.php');?>',
    height: '200px'             
  });
  CKEDITOR.replace('ckeditor2',{
    filebrowserImageBrowseUrl : '<?php echo base_url('assets/kcfinder/browse.php');?>',
    height: '200px'             
  });
  $('#save').click(
  function(e){
    e.preventDefault();
    if(!$('#kd_lab').val()){
      $.notify({
        title: "Erorr : ",
        message: "Laboratorium Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#kd_lab").focus();
      return false;
    }
    if(!$('#versi').val()){
      $.notify({
        title: "Erorr : ",
        message: "Versi Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#versi").focus();
      return false;
    }
    if(!CKEDITOR.instances['ckeditor1'].getData()){
      $.notify({
        title: "Erorr : ",
        message: "Keterangan Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#ckeditor1").focus();
      return false;
    }
    if(!CKEDITOR.instances['ckeditor2'].getData()){
      $.notify({
        title: "Erorr : ",
        message: "Catatan Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#ckeditor2").focus();
      return false;
    }
    $.ajax({
      url: baseUrl+'master/keterangan/form_act',
      type : "POST",  
      data: {
        kd_lab           : $('#kd_lab').val(),
        versi          : $('#versi').val(),
        keterangan       : CKEDITOR.instances['ckeditor1'].getData(),
        catatan       : CKEDITOR.instances['ckeditor2'].getData(),
        keterangan2 : $('#keterangan2').val(),
        catatan2 : $('#catatan2').val(),
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
            // window.location.href = baseUrl+'keterangan/'; //will redirect to google.
          }, 2000);
        }
      }
    });
  }
);
})
</script>
