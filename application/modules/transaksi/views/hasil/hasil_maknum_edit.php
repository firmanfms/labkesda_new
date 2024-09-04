<section class="content-header">
  <h1>
    Transaksi
    <small>Input Pendaftaran Makanan Dan Minuman</small>
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
              <label for="inputEmail3" class="col-sm-2 control-label">Laboratorium</label>
              <div class="col-sm-3" style="top: 7px;">: 
                <input type="hidden" class="form-control pull-right" id="kd_lab" value="<?php echo $data_lab; ?>"> Lab Makanan dan Minuman
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Pemilik</label>
              <div class="col-sm-3">
                <input type="text" class="form-control pull-right" id="nama">
                <input type="hidden" name="items" id="sup_items" value='<?php echo json_encode($new_maknum["items"]); ?>'/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama Sampel</label>
              <div class="col-sm-5">
                <input type="text" class="form-control pull-right" id="uraian_sampel">
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Banyak</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="banyak" placeholder="banyak">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-5">
                <textarea class="form-control pull-right" id="alamat"></textarea>
              </div>
            </div>
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Telp</label>
              <div class="col-sm-2">
                <input type="text" class="form-control pull-right" id="telp">
              </div>
            </div> -->
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="tanggal" value="">
              </div>
            </div> -->
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Jenis Sampel</label>
              <div class="col-sm-3">
                <select class="form-control select2" style="width: 100%;" id='kd_sampel'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_sampel as $key => $value) {
                    echo "<option value='".$value->kd_sampel."'>".$value->nm_sampel."</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Keterangan Sampel</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="ket_sampel" placeholder="Keterangan Sampel">
              </div>
            </div>
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Kondisi</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="kondisi" placeholder="Kondisi">
              </div>
            </div> -->
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Terima</label>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="tgl_diterima">
              </div>
            </div>
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Pengujian</label>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="tgl_pengujian">
              </div>
            </div> -->
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Selesai</label>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="tgl_selesai">
              </div>
            </div> -->
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Jenis Analisa</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="jns_analisa" placeholder="Jenis Analisa">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Umur</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="umur" placeholder="Umur">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Dokter</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="dokter" placeholder="Dokter">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Diagnosa</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="diagnosa" placeholder="Diagnosa Klinik">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-5">
                <label><input type="radio" name="jns_kelamin" id="jns_kelamin" value="P" checked> Pria</label>
                <label><input type="radio" name="jns_kelamin" id="jns_kelamin" value="W"> Wanita</label>
              </div>
            </div> -->
            <hr>  
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama Parameter</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='kd_kategori_parameter'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_parameter as $key => $value) {
                    echo "<option value='".$value->kd_kategori_parameter."' data-name='".$value->nm_kategori_parameter."'>".$value->nm_kategori_parameter."</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="table-responsive">
                <table id="detail" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Parameter</th>
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
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tgl Lahir</label>
              <div class="col-sm-5">
                <input type="text" class="tanggal form-control pull-right" id="tgl_lahir" placeholder="Tanggal Lahir">
              </div>
            </div> -->
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tgl Spesimen</label>
              <div class="col-sm-5">
                <input type="text" class="tanggal form-control pull-right" id="tgl_spesimen" placeholder="Tanggal Spesimen">
              </div>
            </div> -->
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('transaksi/mutasi_masuk/reset'); ?>" type="submit" class="btn btn-danger">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php //test($new_maknum,0); ?>
<script>
$(document).ready(function(){
  // $('#kd_lab').select2();
  $('#kd_sampel').select2();
  $('#kd_kategori_parameter').select2();
  $('.tanggal').datepicker({
    setDate: new Date(),
    autoclose: true
  });

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
            data      : 'kd_kategori_parameter' 
          },
          { data: 'nm_kategori_parameter', className: "text-left" }, 
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
          kd_kategori_parameter     : i.kd_kategori_parameter,
          nm_kategori_parameter     : i.nm_kategori_parameter
        };
        metode._addtogrid(data);
        metode._clearitem();
        metode._focusadd();
      });
      this.no_ajax = false;
    },
    
    add_items: function(e){
      e.preventDefault();

      if(!$('#kd_kategori_parameter').val()){
        $.notify({
          title: "Erorr : ",
          message: "Kode Parameter Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $('#kd_kategori_parameter').select2('open');
        return false;
      }

      let kd_kategori_parameter = $('#kd_kategori_parameter').val();
      let nm_kategori_parameter = $('#kd_kategori_parameter option:selected').attr('data-name');

      if(kd_kategori_parameter){
        data = {
          kd_kategori_parameter     : kd_kategori_parameter,
          nm_kategori_parameter     : nm_kategori_parameter
        };

        metode._addtogrid(data);
        metode._clearitem();
        metode._focusadd();

      }
    },

    _addtogrid: function(data){
      // debugger
      let grids = this.grids;
      let exist = metode.grids.row('#'+data.kd_kategori_parameter).index();
      //
      $('#id').val(data.kd_kategori_parameter);

      data.act = '<button item-id="'+data.kd_kategori_parameter+'" onclick="return metode._removefromgrid(this);">x</button>';
      data.DT_RowId = data.kd_kategori_parameter;
      //
      if(exist===undefined){
        grids.row.add(data).draw();
      }else{ 
        grids.row(exist).data(data).draw(false);
      }

      if(this.no_ajax) return false;

      $.post({
        url: baseUrl+'transaksi/pendaftaran_maknum/add_item',
        data: {
          kd_kategori_parameter     : data.kd_kategori_parameter,
          nm_kategori_parameter     : data.nm_kategori_parameter
        }
      });
    },

    _clearitem: function(no_hasil){
      $('#kd_kategori_parameter').val('').trigger('change');

    },

    _focusadd: function(){
      $('#kd_kategori_parameter').select2('open');
    },

    _removefromgrid: function(el){

      let id = $(el).attr('item-id');
      metode.grids.row("#"+id).remove().draw();
      $.get({
        url: baseUrl+'transaksi/pendaftaran_maknum/remove_item',
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
          message: "Nama Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#nama").focus();
        return false;
      }

      if(!$('#alamat').val()){
        $.notify({
          title: "Erorr : ",
          message: "Alamat Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#alamat").focus();
        return false;
      }

      // if(!$('#telp').val()){
      //   $.notify({
      //     title: "Erorr : ",
      //     message: "Telp Tidak Boleh Kosong",
      //     icon: 'fa fa-times' 
      //   },{
      //     type: "danger",
      //     delay: 1000
      //   });
      //   $("#telp").focus();
      //   return false;
      // }
      
      if(!$('#kd_sampel').val()){
        $.notify({
          title: "Erorr : ",
          message: "Sampel Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $('#kd_sampel').select2('open');
        return false;
      }

      if(!$('#uraian_sampel').val()){
        $.notify({
          title: "Erorr : ",
          message: "Uraian Sampel Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#uraian_sampel").focus();
        return false;
      }

      if(!$('#ket_sampel').val()){
        $.notify({
          title: "Erorr : ",
          message: "Keterangan Sampel Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#ket_sampel").focus();
        return false;
      }

      // if(!$('#kondisi').val()){
      //   $.notify({
      //     title: "Erorr : ",
      //     message: "Kondisi Sampel Tidak Boleh Kosong",
      //     icon: 'fa fa-times' 
      //   },{
      //     type: "danger",
      //     delay: 1000
      //   });
      //   $("#kondisi").focus();
      //   return false;
      // }

      if(!$('#banyak').val()){
        $.notify({
          title: "Erorr : ",
          message: "Banyak Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#banyak").focus();
        return false;
      }

      // if(!$('#jns_analisa').val()){
      //   $.notify({
      //     title: "Erorr : ",
      //     message: "Jenis Analisa Tidak Boleh Kosong",
      //     icon: 'fa fa-times' 
      //   },{
      //     type: "danger",
      //     delay: 1000
      //   });
      //   $("#jns_analisa").focus();
      //   return false;
      // }

      // if(!$('#umur').val()){
      //   $.notify({
      //     title: "Erorr : ",
      //     message: "Umur Tidak Boleh Kosong",
      //     icon: 'fa fa-times' 
      //   },{
      //     type: "danger",
      //     delay: 1000
      //   });
      //   $("#umur").focus();
      //   return false;
      // }

      // if(!$('#dokter').val()){
      //   $.notify({
      //     title: "Erorr : ",
      //     message: "Dokter Tidak Boleh Kosong",
      //     icon: 'fa fa-times' 
      //   },{
      //     type: "danger",
      //     delay: 1000
      //   });
      //   $("#dokter").focus();
      //   return false;
      // }

      // if(!$('#diagnosa').val()){
      //   $.notify({
      //     title: "Erorr : ",
      //     message: "Diagnosa Tidak Boleh Kosong",
      //     icon: 'fa fa-times' 
      //   },{
      //     type: "danger",
      //     delay: 1000
      //   });
      //   $("#diagnosa").focus();
      //   return false;
      // }

      // if(!$('#jns_kelamin').val()){
      //   $.notify({
      //     title: "Erorr : ",
      //     message: "Jenis Kelamin Tidak Boleh Kosong",
      //     icon: 'fa fa-times' 
      //   },{
      //     type: "danger",
      //     delay: 1000
      //   });
      //   $("#jns_kelamin").focus();
      //   return false;
      // }

      // if(!$('#tanggal').val()){
      //   $.notify({
      //     title: "Erorr : ",
      //     message: "Telp Tidak Boleh Kosong",
      //     icon: 'fa fa-times' 
      //   },{
      //     type: "danger",
      //     delay: 1000
      //   });
      //   $("#telp").focus();
      //   return false;
      // }

      if(!$('#tgl_diterima').val()){
        $.notify({
          title: "Erorr : ",
          message: "Telp Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#telp").focus();
        return false;
      }

      $('#save').prop("disabled",true);

      $.ajax({
        url: baseUrl+'transaksi/pendaftaran_maknum/form_act',
        type : "POST",  
        data: {
          kd_lab          : $('#kd_lab').val(),
          nama            : $('#nama').val(),
          alamat          : $('#alamat').val(),
          // telp            : $('#telp').val(),
          kd_sampel       : $('#kd_sampel').val(),
          uraian_sampel   : $('#uraian_sampel').val(),
          ket_sampel      : $('#ket_sampel').val(),
          // kondisi         : $('#kondisi').val(),
          banyak          : $('#banyak').val(),
          // jns_analisa     : $('#jns_analisa').val(),
          // umur            : $('#umur').val(),
          // dokter          : $('#dokter').val(),
          // diagnosa        : $('#diagnosa').val(),
          // jns_kelamin     : $('#jns_kelamin:checked').val()
          tgl_diterima    : $('#tgl_diterima').val()

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
            //   window.location.href = baseUrl+'transaksi/pendaftaran_maknum/'; //will redirect to google.
            // }, 2000);
          }
        }
      });

    }

  };
  metode.init();
});
</script>