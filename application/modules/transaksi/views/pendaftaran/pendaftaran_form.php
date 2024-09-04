<section class="content-header">
  <h1>
    Transaksi
    <small>Input Pendaftaran</small>
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
              <div class="col-sm-2">
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
              <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-2">
                <input type="text" class="form-control pull-right" id="nama">
                <input type="hidden" name="items" id="sup_items" value='<?php echo json_encode($new_mutasi_masuk["items"]); ?>'/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-2">
                <textarea class="form-control pull-right" id="alamat"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Telp</label>
              <div class="col-sm-2">
                <input type="text" class="form-control pull-right" id="telp">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="tanggal">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Uraian Sampel</label>
              <div class="col-sm-2">
                <input type="text" class="form-control pull-right" id="uraian_sampel">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Sampel</label>
              <div class="col-sm-2">
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
              <label for="inputEmail3" class="col-sm-2 control-label">Uraian Sampel</label>
              <div class="col-sm-2">
                <input type="text" class="form-control pull-right" id="uraian_sampel">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Keterangan Sampel</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="ket_sampel" placeholder="banyak">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Kondisi</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="kondisi" placeholder="Kondisi">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Banyak</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="banyak" placeholder="banyak">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Terima</label>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="tgl_diterima">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Pengujian</label>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="tgl_pengujian">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Selesai</label>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="tgl_selesai">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Jenis Analisa</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="banyak" placeholder="banyak">
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
                <label><input type="radio" name="jns_kelamin" id="jns_kelamin" value="Pria" checked> Pria</label>
                <label><input type="radio" name="jns_kelamin" id="jns_kelamin" value="Wanita"> Wanita</label>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tgl Lahir</label>
              <div class="col-sm-5">
                <input type="text" class="tanggal form-control pull-right" id="tgl_lahir" placeholder="Tanggal Lahir">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tgl Spesimen</label>
              <div class="col-sm-5">
                <input type="text" class="tanggal form-control pull-right" id="tgl_spesimen" placeholder="Tanggal Spesimen">
              </div>
            </div>
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
<?php //test($new_mutasi_masuk,0); ?>
<script>
$(document).ready(function(){
  var availableTags = <?= json_encode($data_array); ?>;
  
  $("#nama").autocomplete({
    source: availableTags
  });


  $('#kd_lab').select2();
  $('#kd_sampel').select2();

  $('#id_barang').select2();
  $('.tanggal').datepicker({
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
            data      : 'no_hasil' 
          },
          { 
            bVisible  : false,
            data      : 'id_barang' 
          },
          { data: 'nm_barang', className: "text-left" }, 
          { data: 'quantity', className: "text-left" }, 
          { data: 'no_lot', className: "text-left" }, 
          { data: 'kadaluarsa', className: "text-left" }, 
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
          id_barang     : i.id_barang,
          nm_barang     : i.nm_barang,
          quantity      : i.quantity,
          no_lot        : i.no_lot,
          kadaluarsa    : i.kadaluarsa,
          no_hasil      : i.no_hasil
        };
        metode._addtogrid(data);
        metode._clearitem();
        metode._focusadd();
      });
      this.no_ajax = false;
    },
    
    add_items: function(e){
      e.preventDefault();

      if(!$('#id_barang').val()){
        $.notify({
          title: "Erorr : ",
          message: "Barang Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $('#id_barang').select2('open');
        return false;
      }

      if(!$('#quantity').val()){
        $.notify({
          title: "Erorr : ",
          message: "Quantity Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#quantity").focus();
        return false;
      }

      let id_barang = $('#id_barang').val();
      let nm_barang = $('#id_barang option:selected').attr('data-name');
      let quantity  = $('#quantity').val();
      let no_lot    = $('#no_lot').val();
      let kadaluarsa= $('#kadaluarsa').val();
      let no_hasil  = parseInt($('#no_hasil').val())+1;

      if(id_barang){
        data = {
          id_barang     : id_barang,
          nm_barang     : nm_barang,
          quantity      : quantity,
          no_lot        : no_lot,
          kadaluarsa    : kadaluarsa,
          no_hasil      : no_hasil
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
        url: baseUrl+'transaksi/mutasi_masuk/add_item',
        data: {
          id_barang     : data.id_barang,
          nm_barang     : data.nm_barang,
          quantity      : data.quantity,
          no_lot        : data.no_lot,
          kadaluarsa    : data.kadaluarsa,
          no_hasil      : data.no_hasil
        }
      });
    },

    _clearitem: function(no_hasil){
      $('#id_barang').val('').trigger('change');
      $('#quantity').val('');
      $('#no_lot').val('');
      $('#kadaluarsa').val('');
      $('#no_hasil').val(no_hasil);

    },

    _focusadd: function(){
      $('#id_barang').select2('open');
    },

    _removefromgrid: function(el){

      let id = $(el).attr('item-id');
      metode.grids.row("#"+id).remove().draw();
      $.get({
        url: baseUrl+'transaksi/mutasi_masuk/remove_item',
        data: {
          index_id: id
        }
      });
      return false;
    },

    save: function(e){
      e.preventDefault();
      $('#save').prop("disabled",true);

      if(!$('#tanggal').val()){
        $.notify({
          title: "Erorr : ",
          message: "Tanggal Mutasi Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#tanggal").focus();
        return false;
      }

      if(!$('#keterangan').val()){
        $.notify({
          title: "Erorr : ",
          message: "Keterangan Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#keterangan").focus();
        return false;
      }

      if(!$('#id_lokasi').val()){
        $.notify({
          title: "Erorr : ",
          message: "Laboratorium Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $('#id_lokasi').select2('open');
        return false;
      }

      $.ajax({
        url: baseUrl+'transaksi/mutasi_masuk/form_act',
        type : "POST",  
        data: {
          tanggal         : $('#tanggal').val(),
          keterangan      : $('#keterangan').val(),
          id_lokasi       : $('#id_lokasi').val(),

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
              window.location.href = baseUrl+'transaksi/mutasi_masuk/'; //will redirect to google.
            }, 2000);
          }
        }
      });

    }

  };
  metode.init();
});
</script>