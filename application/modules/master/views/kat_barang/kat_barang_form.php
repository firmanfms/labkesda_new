<section class="content-header">
  <h1>
    Master
    <small>Input Kategori Barang</small>
  </h1>
  <!-- <ol class="breadcrumb">
    <li><button type="submit" class="btn btn-primary">Submit</button></li>
  </ol> -->
</section>
<?php 

// test($data_array,1);
?>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border"></div>
        <form class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Kode </label>
              <div class="col-sm-5">
                <input id="kd_kat_barang" class="form-control" placeholder="Kode" > <span style="color: red;font-size: 10px;">* Max & Min 3 Huruf</span>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama </label>
              <div class="col-sm-5">
                <input id="nama" class="form-control"  placeholder="Nama Kategori Barang">
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('master/kat_barang'); ?>" type="submit" class="btn btn-danger">Batal</a>
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
  $('#save').click(
  function(e){
    e.preventDefault();

    if($('#kd_kat_barang').val().length<3){
      $.notify({
        title: "Erorr : ",
        message: "Kode Harus 3 Karakter",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#kd_kat_barang").focus();
      return false;
    }

    if($('#kd_kat_barang').val().length>3){
      $.notify({
        title: "Erorr : ",
        message: "Kode Harus 3 Karakter",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#kd_kat_barang").focus();
      return false;
    }

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

    $.ajax({
      url: baseUrl+'master/kat_barang/form_act',
      type : "POST",  
      data: {
        kd_kat_barang : $('#kd_kat_barang').val(),
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
            window.location.href = baseUrl+'kat_barang/'; //will redirect to google.
          }, 2000);
        }
      }
    });

  }
);
})
</script>

            