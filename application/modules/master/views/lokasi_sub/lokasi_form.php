<section class="content-header">
  <h1>
    Master
    <small>Input Sub Lokasi</small>
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
              <label for="inputEmail3" class="col-sm-2 control-label">Lokasi</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='id_lokasi'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_lokasi as $key => $value) {
                    echo "<option value='".$value->id_lokasi."'>".$value->lokasi."</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Sub Lokasi</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nama" placeholder="Sub Lokasi">
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('master/lokasi_sub'); ?>" type="submit" class="btn btn-danger">Batal</a>
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
  
  $('#id_lokasi').select2();

  $('#save').click(
  function(e){
    e.preventDefault();

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
      url: baseUrl+'master/lokasi_sub/form_act',
      type : "POST",  
      data: {
        nama          : $('#nama').val(),
        id_lokasi     : $('#id_lokasi').val()
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
            window.location.href = baseUrl+'lokasi_sub/'; //will redirect to google.
          }, 2000);
        }
      }
    });

  }
);
})
</script>

            