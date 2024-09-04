<section class="content-header">
  <h1>
    Master
    <small>Edit Parameter</small>
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
              <label for="inputEmail3" class="col-sm-2 control-label">Nama Parameter</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nama" placeholder="Nama Metode" value="<?php echo $header->nm_parameter; ?>">
                <input type="hidden" name="items" id="sup_items" value='<?php echo json_encode($new_metode["items"]); ?>'/>
                <input type="hidden" id="kd_parameter" value="<?php echo $header->kd_parameter; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Satuan</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="satuan" placeholder="Satuan" value="<?php echo $header->satuan; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Metode Uji 1</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="metode_analisa1" placeholder="metode Uji 1" value="<?php echo $header->metode_analisa; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Metode Uji 2</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="metode_analisa2" placeholder="metode Uji 2" value="<?php echo $header->metode_analisa2; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Metode Uji 3</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="metode_analisa3" placeholder="metode Uji 3" value="<?php echo $header->metode_analisa3; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Metode Uji 4</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="metode_analisa4" placeholder="metode Uji 4" value="<?php echo $header->metode_analisa4; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Metode Uji 5</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="metode_analisa5" placeholder="metode Uji 5" value="<?php echo $header->metode_analisa5; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Alias</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="alias" placeholder="Alias" value="<?php echo $header->alias; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Akreditas</label>
              <div class="col-sm-5">
                <label><input type="radio" name="akreditas" id="akreditas" value="Y" <?php echo ($header->akreditasi=='Y')? 'checked' : '' ?>> Ya</label>
                <label><input type="radio" name="akreditas" id="akreditas" value="N" <?php echo ($header->akreditasi=='N')? 'checked' : '' ?>> Tidak</label>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Harga</label>
              <div class="col-sm-5">
                <input type="number" class="form-control" id="harga" placeholder="Harga" value="<?php echo $header->harga; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Pengecekan</label>
              <div class="col-sm-5">
                <input type="number" class="form-control" id="jumlah" placeholder="Jumlah Pengecekan" value="<?php echo $header->jml_pengecekan; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Zorder</label>
              <div class="col-sm-5">
                <input type="number" class="form-control" id="zoder" placeholder="Zoder" value="<?php echo $header->zorder; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Kategori Parameter</label>
              <div class="col-sm-5">
                  <select class="form-control select2" style="width: 100%;" id='kd_kategori_parameter'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_parameter as $key => $value) {
                    if($value->kd_kategori_parameter==$header->kd_kategori_parameter){
                      echo "<option value='".$value->kd_kategori_parameter."' selected>".$value->nm_kategori_parameter."</option>";
                    }else{
                      echo "<option value='".$value->kd_kategori_parameter."'>".$value->nm_kategori_parameter."</option>";
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Laboratorium</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='kd_lab'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_lab as $key => $value) {
                    if($value->kd_lab==$header->kd_lab){
                      echo "<option value='".$value->kd_lab."' selected>".$value->lab."</option>";
                    }else{
                      echo "<option value='".$value->kd_lab."'>".$value->lab."</option>";
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group kadar_non_lk" >
              <label for="inputEmail3" class="col-sm-2 control-label">Kadar</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="kadar" placeholder="Kadar" value="<?php echo $header->kadar; ?>">
                <button type="button" class="btn btn-sm" onclick="document.getElementById('kadar').value += '&lt;';">&lt;</button>
                <button type="button" class="btn btn-sm" onclick="document.getElementById('kadar').value += '&le;';">&le;</button>
                <button type="button" class="btn btn-sm" onclick="document.getElementById('kadar').value += '&gt;';">&gt;</button>
                <button type="button" class="btn btn-sm" onclick="document.getElementById('kadar').value += '&ge;';">&ge;</button>
                <button type="button" class="btn btn-sm" onclick="document.getElementById('kadar').value += '&plusmn;';">&plusmn;</button>
              </div>
            </div>
            <div class="form-group kadar_non_lk">
              <label for="inputEmail3" class="col-sm-2 control-label">Nilai Minimum</label>
              <div class="col-sm-2">
                <input type="number" class="form-control" required id="nilai_min" placeholder="Minimum" value="<?php echo $header->nilai_min; ?>">
              </div>
            </div>
            <div class="form-group kadar_non_lk">
              <label for="inputEmail3" class="col-sm-2 control-label">Nilai Maksimum</label>
              <div class="col-sm-2">
                <input type="number" class="form-control" required id="nilai_max" placeholder="Maksimum" value="<?php echo $header->nilai_max; ?>">
              </div>
            </div>
            <hr>  
            <div class="kadar_lk"><div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi Kadar</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="deskripsi_kadar" placeholder="Deskripsi Kadar">
                  <button type="button" class="btn btn-sm" onclick="document.getElementById('deskripsi_kadar').value += '&lt;';">&lt;</button>
                  <button type="button" class="btn btn-sm" onclick="document.getElementById('deskripsi_kadar').value += '&le;';">&le;</button>
                  <button type="button" class="btn btn-sm" onclick="document.getElementById('deskripsi_kadar').value += '&gt;';">&gt;</button>
                <button type="button" class="btn btn-sm" onclick="document.getElementById('deskripsi_kadar').value += '&ge;';">&ge;</button>
                <button type="button" class="btn btn-sm" onclick="document.getElementById('deskripsi_kadar').value += '&plusmn;';">&plusmn;</button>
                  <input type="hidden" class="form-control" id="no_hasil" value="50000">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nilai Minimum Kadar</label>
                <div class="col-sm-2">
                  <input type="number" class="form-control" id="min_kadar" >
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nilai Maksimum Kadar</label>
                <div class="col-sm-2">
                  <input type="number" class="form-control" id="max_kadar" >
                </div>
              </div>
              <div class="col-md-12">
                <div class="table-responsive">
                  <table id="detail" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Deskripsi Kadar</th>
                      <th width="15%">Min Kadar</th>
                      <th width="15%">Max Kadar</th>
                      <th width="10%">Action</th>
                    </tr>
                    </thead>
                  </table>
                </div>
              </div>        
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-5">
                  <button type="submit" class="btn btn-warning" id="add-items">Tambah Detail</button>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('master/metode/reset'); ?>" type="submit" class="btn btn-danger">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- <?php test($new_metode,0); ?> -->
<script>
$(document).ready(function(){
  let lab_kd  = $('#kd_lab').val();
  if(lab_kd=='LK'){
    // alert(kd_lab);
    $('.kadar_lk').show();
    $('#kadar').val('');
    $('.kadar_non_lk').hide()
  }else{
    // alert(kd_lab);
    $('.kadar_lk').hide();
    $('.kadar_non_lk').show()
  }
  $("#kd_lab").select2().on('select2:select',function(e){
    var kd_lab = $('#kd_lab option:selected').val();
    // if(kd_lab=='LK'){
    //   // alert(kd_lab);
    //   $('.kadar_lk').show();
    //   $('#kadar').val('');
    //   $('.kadar_non_lk').hide()
    // }else{
    //   // alert(kd_lab);
    //   $('.kadar_lk').hide();
    //   $('.kadar_non_lk').show()
    // }
     if(kd_lab=='LK'){
      // alert(kd_lab);
      $('.kadar_lk').show();
      $('#kadar').val('');
      $('.kadar_non_lk').hide()
      $('nilai_min').val('');
      $('nilai_max').val('');
      $('nilai_min').attr('required',false);
      $('nilai_max').attr('required',false);
      $('nilai_min').attr('readonly',true);
      $('nilai_max').attr('readonly',true);
    }else{
      // alert(kd_lab);
      $('.kadar_lk').hide();
      $('.kadar_non_lk').show()
    }
    // alert(kd_lab);
  });
  $('#kd_kategori_parameter').select2();
  metode = {
    data: {},
    processed: false,
    items: [],
    init: function(){
      this.grids = $('#detail').DataTable({
        "paging": false, 
        "bLengthChange": false, // disable show entries dan page
        "bFilter": false,
        "bInfo": false, // disable Showing 0 to 0 of 0 entries
        "bAutoWidth": false,
        "language": {
            "emptyTable": "Tidak Ada Data"
        },
        columns: [
          { 
            bVisible  : false,
            data      : 'no_hasil' 
          },
          { data: 'deskripsi_kadar', className: "text-left" }, 
          { data: 'min_kadar', className: "text-left" }, 
          { data: 'max_kadar', className: "text-left" }, 
          { data: 'act', className: "text-center" }
        ],
      });
      this._set_items($('#sup_items').val());
      $('#add-items').click(metode.add_items);
      $('#save').click(metode.save);
    },
    _set_items: function(items){
      this.no_ajax = true;
      //
      if(items) items = JSON.parse(items);
      // debugger
      this.items = items;
      items.map(function(i,e){
        var data = {
          no_hasil   : i.no_hasil,
          deskripsi_kadar  : i.deskripsi_kadar,
          min_kadar : i.min_kadar,
          max_kadar : i.max_kadar
        };
        metode._addtogrid(data);
        metode._focusadd();
      });
      this.no_ajax = false;
    },
    add_items: function(e){
      e.preventDefault();
      if(!$('#deskripsi_kadar').val() || !$('#min_kadar').val() || !$('#max_kadar').val()){
        $.notify({
          title: "Erorr : ",
          message: "Deskripsi Kadar, Minimal Kadar, dan Maksimal Kadar tidak boleh kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        return false;
      }
      let deskripsi_kadar = $('#deskripsi_kadar').val();
      let min_kadar       = $('#min_kadar').val();
      let max_kadar       = $('#max_kadar').val();
      let no_hasil        = parseInt($('#no_hasil').val())+1;
      if(deskripsi_kadar){
        data = {
          deskripsi_kadar : deskripsi_kadar,
          min_kadar       : min_kadar,
          max_kadar       : max_kadar,
          no_hasil        : no_hasil,
          aktif           : 'Y'
        };
        metode._addtogrid(data);
        metode._clearitem(no_hasil);
        metode._focusadd();
      }
    },
    _addtogrid: function(data){
      // debugger
      let grids = this.grids;
      let exist = metode.grids.row('#'+data.no_hasil).index();
      //
      $('#id').val(data.no_hasil);
      data.act = '<button item-id="'+data.no_hasil+'" onclick="return metode._removefromgrid(this);">x</button>';
      data.DT_RowId = data.no_hasil;
      //
      if(exist===undefined){
        grids.row.add(data).draw();
      }else{ 
        grids.row(exist).data(data).draw(false);
      }
      if(this.no_ajax) return false;
      $.post({
        url: baseUrl+'master/metode/add_item',
        data: {
          deskripsi_kadar     : data.deskripsi_kadar,
          min_kadar     : data.min_kadar,
          max_kadar     : data.max_kadar,
          no_hasil      : data.no_hasil,
          aktif         : data.aktif
        }
      });
    },
    _clearitem: function(no_hasil){
      $('#deskripsi_kadar').val('');
      $('#min_kadar').val('');
      $('#max_kadar').val('');
      $('#no_hasil').val(no_hasil);
    },
    _focusadd: function(){
      $('#hasil_lab').focus();
    },
    _removefromgrid: function(el){
      let id = $(el).attr('item-id');
      metode.grids.row("#"+id).remove().draw();
      $.get({
        url: baseUrl+'master/metode/remove_item',
        data: {
          index_id: id
        }
      });
      return false;
    },
    save: function(e){
      e.preventDefault();
      if(!$('#nama').val() || !$('#satuan').val() || !$('#metode_analisa1').val() || !$('#metode_analisa2').val() || !$('#metode_analisa3').val() || !$('#metode_analisa4').val() || !$('#metode_analisa5').val() || !$('#alias').val() || !$('#akreditas').val() || !$('#harga').val() || !$('#jumlah').val() || !$('#zoder').val() || !$('#kd_kategori_parameter').val() || !$('#kd_lab').val() || !$('#nilai_min').val() || !$('#nilai_max').val()){
        $.notify({
          title: "Erorr : ",
          message: "Semua inputan harus diisi",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        return false;
      }
      $('#save').prop("disabled",true);
      $.ajax({
        url: baseUrl+'master/metode/edit_act',
        type : "POST",  
        data: {
          kd_parameter       : $('#kd_parameter').val(),
          nama            : $('#nama').val(),
          satuan          : $('#satuan').val(),
          kadar           : $('#kadar').val(),
          metode_analisa1  : $('#metode_analisa1').val(),
          metode_analisa2  : $('#metode_analisa2').val(),
          metode_analisa3  : $('#metode_analisa3').val(),
          metode_analisa4  : $('#metode_analisa4').val(),
          metode_analisa5  : $('#metode_analisa5').val(),
          alias           : $('#alias').val(),
          akreditas       : $('#akreditas:checked').val(),
          harga           : $('#harga').val(),
          jumlah          : $('#jumlah').val(),
          zoder           : $('#zoder').val(),
          kd_kategori_parameter    : $('#kd_kategori_parameter').val(),
          kd_lab          : $('#kd_lab').val(),
          nilai_min       : $('#nilai_min').val(),
          nilai_max       : $('#nilai_max').val()
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
              window.location.href = baseUrl+'metode/'; //will redirect to google.
            }, 2000);
          }
        }
      });
    }
  };
  metode.init();
});
</script>
