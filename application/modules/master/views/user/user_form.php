<section class="content-header">
  <h1>
    Master
    <small>Input User</small>
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
                <input type="text" class="form-control" id="nama" placeholder="Nama">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="username" placeholder="Username">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-5">
                <input type="password" class="form-control" id="password" placeholder="Password">
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
                    echo "<option value='".$value->level."'>".$value->level."</option>";
                  }
                  ?>
                </select>
              </div>
            </div> -->
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Level</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='approve_level'>
                  <option disabled="" >- Pilih -</option>
                  <option value="0">- Admin -</option>
                  <option value="4">- Pendaftaran -</option>
                  <option value="1">- Analis -</option>
                  <option value="6">- Analis Lab Makanan dan Minuman -</option>
                  <option value="7">- Analis Lab Lingkungan -</option>
                  <option value="8">- Analis Lab Klinik -</option>
                  <option value="2">- Koordinator -</option>
                  <option value="9">- Koordinator Lab Makanan dan Minuman -</option>
                  <option value="10">- Koordinator Lab Lingkungan -</option>
                  <option value="11">- Koordinator Klinik -</option>
                  <option value="3">- Manager -</option>                  
                  <option value="5">- Kepala LAB -</option>                  
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
  $("#username").autocomplete({
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
      url: baseUrl+'master/user/form_act',
      type : "POST",  
      data: {
        nama          : $('#nama').val(),
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

            