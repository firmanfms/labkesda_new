<section class="content-header">
  <h1>
    Master
    <small>Input Parameter</small>
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
                <input type="text" class="form-control" id="nama" placeholder="Nama Metode">
                <input type="hidden" name="items" id="sup_items" value='<?php echo json_encode($new_metode["items"]); ?>'/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Satuan</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="satuan" placeholder="Satuan">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Metode Uji 1</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="metode_analisa1" placeholder="metode Uji 1">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Metode Uji 2</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="metode_analisa2" placeholder="metode Uji 2">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Metode Uji 3</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="metode_analisa3" placeholder="metode Uji 3">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Metode Uji 4</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="metode_analisa4" placeholder="metode Uji 4">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Metode Uji 5</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="metode_analisa5" placeholder="metode Uji 5">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Alias</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="alias" placeholder="Alias">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Akreditas</label>
              <div class="col-sm-5">
                <label><input type="radio" name="akreditas" id="akreditas" value="Y" checked> Ya</label>
                <label><input type="radio" name="akreditas" id="akreditas" value="N"> Tidak</label>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Harga</label>
              <div class="col-sm-5">
                <input type="number" class="form-control" id="harga" placeholder="Harga">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Pengecekan</label>
              <div class="col-sm-5">
                <input type="number" class="form-control" id="jumlah" placeholder="Jumlah Pengecekan">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Zoder</label>
              <div class="col-sm-5">
                <input type="number" class="form-control" id="zoder" placeholder="Zoder">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Kategori Parameter</label>
              <div class="col-sm-5">
                  <select class="form-control select2" style="width: 100%;" id='kd_kategori_parameter'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_parameter as $key => $value) {
                    echo "<option value='".$value->kd_kategori_parameter."'>".$value->nm_kategori_parameter."</option>";
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
                    echo "<option value='".$value->kd_lab."'>".$value->lab."</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group kadar_non_lk">
              <label for="inputEmail3" class="col-sm-2 control-label">Kadar</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="kadar" placeholder="Kadar">
                <button type="button" class="btn btn-sm" onclick="document.getElementById('kadar').value += '&lt;';">&lt;</button>
                <button type="button" class="btn btn-sm" onclick="document.getElementById('kadar').value += '&le;';">&le;</button>
                <button type="button" class="btn btn-sm" onclick="document.getElementById('kadar').value += '&gt;';">&gt;</button>
                <button type="button" class="btn btn-sm" onclick="document.getElementById('kadar').value += '&ge;';">&ge;</button>
              </div>
            </div>
            <div class="form-group kadar_non_lk">
              <label for="inputEmail3" class="col-sm-2 control-label">Nilai Minimum</label>
              <div class="col-sm-2">
                <input type="number" class="form-control" id="nilai_min" placeholder="Minimum">
              </div>
            </div>
            <div class="form-group kadar_non_lk">
              <label for="inputEmail3" class="col-sm-2 control-label">Nilai Maksimum</label>
              <div class="col-sm-2">
                <input type="number" class="form-control" id="nilai_max" placeholder="Maksimum">
              </div>
            </div>
            <hr>  
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Detail Metode</label>
              <div class="col-sm-5">
              </div>
            </div> -->
            <div class="kadar_lk"><div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="deskripsi_kadar" placeholder="Deskripsi Kadar">
                  <input type="hidden" class="form-control" id="no_hasil" value="0">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nilai Minimum Kadar</label>
                <div class="col-sm-2">
                  <input type="number" class="form-control" id="min_kadar" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nilai Maksimum Kadar</label>
                <div class="col-sm-2">
                  <input type="number" class="form-control" id="max_kadar" required>
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
<?php //test($new_metode,0); ?>
<script>
$(document).ready(function(){
  $("#kd_lab").select2().on('select2:select',function(e){
    var kd_lab = $('#kd_lab option:selected').val();
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
          hasil_lab  : i.hasil_lab
        };
        metode._addtogrid(data);
        metode._clearitem();
        metode._focusadd();
      });
      this.no_ajax = false;
    },
    add_items: function(e){
      e.preventDefault();
      if(!$('#deskripsi_kadar').val()){
        $.notify({
          title: "Erorr : ",
          message: "Deskripsi Kadar Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#deskripsi_kadar").focus();
        return false;
      }
      if(!$('#min_kadar').val()){
        $.notify({
          title: "Erorr : ",
          message: "Minimal Kadar Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#min_kadar").focus();
        return false;
      }
      if(!$('#max_kadar').val()){
        $.notify({
          title: "Erorr : ",
          message: "Maksimal Kadar Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#max_kadar").focus();
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
      if(!$('#nama').val()){
        $.notify({
          title: "Erorr : ",
          message: "Nama Metode Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#nama").focus();
        return false;
      }
      if(!$('#satuan').val()){
        $.notify({
          title: "Erorr : ",
          message: "Satuan Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#satuan").focus();
        return false;
      }
      // if(!$('#kadar').val()){
      //   $.notify({
      //     title: "Erorr : ",
      //     message: "KadarTidak Boleh Kosong",
      //     icon: 'fa fa-times' 
      //   },{
      //     type: "danger",
      //     delay: 1000
      //   });
      //   $("#kadar").focus();
      //   return false;
      // }
      if(!$('#metode_analisa1').val()){
        $.notify({
          title: "Erorr : ",
          message: "metode_analisa 1 Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#metode_analisa1").focus();
        return false;
      }
      if(!$('#metode_analisa2').val()){
        $.notify({
          title: "Erorr : ",
          message: "metode_analisa 2 Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#metode_analisa2").focus();
        return false;
      }
      if(!$('#metode_analisa3').val()){
        $.notify({
          title: "Erorr : ",
          message: "metode_analisa 3 Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#metode_analisa3").focus();
        return false;
      }
      if(!$('#metode_analisa4').val()){
        $.notify({
          title: "Erorr : ",
          message: "metode_analisa 4 Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#metode_analisa4").focus();
        return false;
      }
      if(!$('#metode_analisa5').val()){
        $.notify({
          title: "Erorr : ",
          message: "metode_analisa 5 Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#metode_analisa5").focus();
        return false;
      }
      if(!$('#alias').val()){
        $.notify({
          title: "Erorr : ",
          message: "Alias Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#alias").focus();
        return false;
      }
      if(!$('#akreditas').val()){
        $.notify({
          title: "Erorr : ",
          message: "Akreditas Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#akreditas").focus();
        return false;
      }
      if(!$('#harga').val()){
        $.notify({
          title: "Erorr : ",
          message: "Harga Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#harga").focus();
        return false;
      }
      if(!$('#jumlah').val()){
        $.notify({
          title: "Erorr : ",
          message: "Jumlah Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#jumlah").focus();
        return false;
      }
      if(!$('#zoder').val()){
        $.notify({
          title: "Erorr : ",
          message: "Zoder Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#zoder").focus();
        return false;
      }
      if(!$('#kd_kategori_parameter').val()){
        $.notify({
          title: "Erorr : ",
          message: "Parameter Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $('#kd_kategori_parameter').select2('open');
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
      $('#save').prop("disabled",true);
      $.ajax({
        url: baseUrl+'master/metode/form_act',
        type : "POST",  
        data: {
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