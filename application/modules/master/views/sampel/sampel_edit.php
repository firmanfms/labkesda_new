<section class="content-header">
  <h1>
    Master
    <small>Edit Sampel</small>
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
              <label for="inputEmail3" class="col-sm-2 control-label">Nama </label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nama" placeholder="Nama Sampel" value="<?php echo $detail->nm_sampel; ?>">
                <input type="hidden" class="form-control" id="kd_sampel" placeholder="Nama Sampel" value="<?php echo $detail->kd_sampel; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Laboratorium</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='kd_lab'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_lab as $key => $value) {
                    if($value->kd_lab==$detail->kd_lab){
                      echo "<option value='".$value->kd_lab."' selected>".$value->lab."</option>";
                    }else{
                      echo "<option value='".$value->kd_lab."'>".$value->lab."</option>";
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Keterangan </label>
              <div class="col-sm-9">
                <textarea name="content" id="ckeditor1"><?= $detail->keterangan; ?></textarea>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('master/sampel'); ?>" type="submit" class="btn btn-danger">Batal</a>
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

  $('#id_kat_barang').select2();

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
      url: baseUrl+'master/sampel/edit_act',
      type : "POST",  
      data: {
        nama          : $('#nama').val(),
        kd_sampel     : $('#kd_sampel').val(),
        kd_lab        : $('#kd_lab').val(),
        keterangan    : CKEDITOR.instances['ckeditor1'].getData()

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
            window.location.href = baseUrl+'sampel/'; //will redirect to google.
          }, 2000);
        }
      }
    });

  }
);
})
</script>

            