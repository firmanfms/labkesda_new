<section class="content-header">
  <h1>
    Master
    <small>Edit Manajemen</small>
  </h1>
</section>
<?php 
// test($detail,1);
?>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border"></div>
        <form class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">NIP </label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="nip" placeholder="NIP" value="<?php echo $detail->nip; ?>">
                <input type="hidden" class="form-control" id="id_manajemen" placeholder="NIP" value="<?php echo $detail->id_manajemen; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama </label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nama" placeholder="Nama" value="<?php echo $detail->nama; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Jabatan </label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="jabatan" placeholder="Jabatan" disabled value="<?php echo $detail->jabatan; ?>">
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('master/manajemen'); ?>" type="submit" class="btn btn-danger">Batal</a>
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

    if(!$('#nip').val()){
      $.notify({
        title: "Erorr : ",
        message: "ID manajemen Tidak Boleh Kosong",
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

    if(!$('#jabatan').val()){
      $.notify({
        title: "Erorr : ",
        message: "Jabatan Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#jabatan").focus();
      return false;
    }

    $.ajax({
      url: baseUrl+'master/manajemen/edit_act',
      type : "POST",  
      data: {
        id_manajemen  : $('#id_manajemen').val(),
        nip           : $('#nip').val(),
        nama          : $('#nama').val(),
        jabatan       : $('#jabatan').val()

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
            window.location.href = baseUrl+'manajemen/'; //will redirect to google.
          }, 2000);
        }
      }
    });

  }
);
})
</script>

            