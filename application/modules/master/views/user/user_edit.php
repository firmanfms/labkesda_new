<section class="content-header">
  <h1>
    Master
    <small>Edit User</small>
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
              <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nama" placeholder="Nama" value="<?= $data_detail->nama; ?>">
                <input type="hidden" class="form-control" id="id_username" placeholder="Nama" value="<?= $data_detail->id_username; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="username" placeholder="Username" value="<?= $data_detail->username; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-5">
                <input type="password" class="form-control" id="password" placeholder="Password" value="<?= $data_detail->password; ?>">
              </div>
            </div>
            <input type="hidden" name="level" value="0">
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Level</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='level'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_level as $key => $value) {
                    if($value->level==$data_detail->level){
                      echo "<option value='".$value->level."' selected>".$value->level."</option>";
                    }else{
                      echo "<option value='".$value->level."'>".$value->level."</option>";
                    }
                  }
                  ?>
                </select>
              </div>
            </div> -->
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Level</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='approve_level'>
                  <!-- <option disabled="">- Pilih -</option> -->
                  <option value="0" <?= ($data_detail->app_level==0)? 'selected=""' : ''; ?>>- Admin -</option>
                  <option value="4" <?= ($data_detail->app_level==4)? 'selected=""' : ''; ?>>- Pendaftaran -</option>
                  <option value="1" <?= ($data_detail->app_level==1)? 'selected=""' : ''; ?>>- Analis -</option>
                  <option value="6" <?= ($data_detail->app_level==6)? 'selected=""' : ''; ?>>- Analis Lab Makanan dan Minuman -</option>
                  <option value="7" <?= ($data_detail->app_level==7)? 'selected=""' : ''; ?>>- Analis Lab Lingkungan -</option>
                  <option value="8" <?= ($data_detail->app_level==8)? 'selected=""' : ''; ?>>- Analis Lab Klinik -</option>
                  <option value="2" <?= ($data_detail->app_level==2)? 'selected=""' : ''; ?>>- Koordinator -</option>
                  <option value="9" <?= ($data_detail->app_level==9)? 'selected=""' : ''; ?>>- Koordinator Lab Makanan dan Minuman -</option>
                  <option value="10" <?= ($data_detail->app_level==10)? 'selected=""' : ''; ?>>- Koordinator Lab Lingkungan -</option>
                  <option value="11" <?= ($data_detail->app_level==11)? 'selected=""' : ''; ?>>- Koordinator Lab Klinik -</option>
                  <option value="3" <?= ($data_detail->app_level==3)? 'selected=""' : ''; ?>>- Manager -</option>                  
                  <option value="5" <?= ($data_detail->app_level==5)? 'selected=""' : ''; ?>>- Kepala LAB -</option>                  
                </select>
              </div>
            </div>
            
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('master/user'); ?>" type="submit" class="btn btn-danger">Batal</a>
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
  
  $('#level').select2();
  $('#approve_level').select2();

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

    if(!$('#username').val()){
      $.notify({
        title: "Erorr : ",
        message: "Username Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#username").focus();
      return false;
    }

    if(!$('#password').val()){
      $.notify({
        title: "Erorr : ",
        message: "Password Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#password").focus();
      return false;
    }

    // if(!$('#level').val()){
    //   $.notify({
    //     title: "Erorr : ",
    //     message: "Level Tidak Boleh Kosong",
    //     icon: 'fa fa-times' 
    //   },{
    //     type: "danger",
    //     delay: 1000
    //   });
    //   $("#level").focus();
    //   return false;
    // }

    if(!$('#approve_level').val()){
      $.notify({
        title: "Erorr : ",
        message: "Approve Level Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#leveapprove_levell").focus();
      return false;
    }

    $.ajax({
      url: baseUrl+'master/user/edit_act',
      type : "POST",  
      data: {
        nama          : $('#nama').val(),
        id_username   : $('#id_username').val(),
        username      : $('#username').val(),
        password      : $('#password').val(),
        level         : $('#level').val(),
        approve_level : $('#approve_level').val()
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
            window.location.href = baseUrl+'user/'; //will redirect to google.
          }, 2000);
        }
      }
    });

  }
);
})
</script>

            