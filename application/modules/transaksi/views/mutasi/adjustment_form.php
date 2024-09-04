<section class="content-header">
  <h1>
    Transaksi
    <small>Input Adjustment</small>
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
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="tanggal">
                <input type="hidden" name="items" id="sup_items" value='<?php echo json_encode($new_mutasi_masuk["items"]); ?>'/>
              </div>
            </div>
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="keterangan" placeholder="Keterangan">
              </div>
            </div> -->
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
              <div class="col-sm-5">
                <div class="radio">
                  <label><input type="radio" name="status" id="status" value="1">Masuk</label>
                  <label>&nbsp;&nbsp;&nbsp;</label>
                  <label><input type="radio" name="status" id="status" value="2">Keluar</label>
                </div>
              </div>
            </div> -->
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Alasan Adjustment</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='alasan_adjustment'>
                  <option disabled="" selected="" value="0">- Pilih -</option>
                  <option value="Saldo Awal">Saldo Awal</option>
                  <option value="Selisih stok opname">Selisih stok opname</option>
                  <option value="Lain-lain">Lain-lain</option>
                  <!-- <?php 
                  foreach ($data_lokasi as $key => $value) {
                    echo "<option value='".$value->id_lokasi."'>".$value->lokasi."</option>";
                  }
                  ?> -->
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Lokasi</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='id_lokasi'>
                  <option disabled="" selected="" value="0">- Pilih -</option>
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
                <select class="form-control select2" style="width: 100%;" id='id_sub_lokasi'>
                </select>
              </div>
            </div>
            <hr>  
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Barang</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='id_barang'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_barang as $key => $value) {
                    echo "<option value='".$value->id_barang."' data-lot='".$value->is_lot."' data-name='".$value->nama." (".$value->satuan.")' data-kat_barang='".$value->id_kat_barang."'>".$value->nama." (".$value->satuan.")</option>";
                  }
                  ?>
                </select>
                <input type="hidden" class="form-control" id="no_hasil" value="0">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tipe Adjustment</label>
              <div class="col-sm-2">
                <select class="form-control select2" style="width: 100%;" id='type_adjustment'>
                  <option disabled="" selected="">- Pilih -</option>
                  <option value="Positif Adjustment">Positif Adjustment</option>
                  <option value="Negatif Adjustment">Negatif Adjustment</option>                  
                </select>
                <input type="hidden" class="form-control" id="harga_perolehan" placeholder="Harga Perolehan" value="0">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">No Lot</label>
              <div class="col-sm-3">
                <input type="text" class="form-control input_form" id="no_lot" placeholder="No Lot">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Quantity</label>
              <div class="col-sm-2">
                <input type="number" class="form-control" id="quantity" placeholder="Quantity">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Kadaluarsa</label>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="kadaluarsa">
              </div>
            </div>
            <div class="col-md-12">
              <div class="table-responsive">
                <table id="detail" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Barang</th>
                    <th width="10%">Quantity</th>
                    <th width="13%">Type Adjustment</th>
                    <th width="18%">No Lot</th>
                    <th width="13%">Kadaluarsa</th>
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
          <div class="box-footer">
            <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('transaksi/adjustment/reset'); ?>" type="submit" class="btn btn-danger">Batal</a>
          </div>
        </form>
       </div>
    </div>
  </div>
</section>
<?php //test($new_mutasi_masuk,0); ?>
<script>
$(document).ready(function(){
  $('#id_sub_lokasi').select2();
  $('#alasan_adjustment').select2();

  
  $('#type_adjustment').select2().on('select2:select',function(e){
    if($('#type_adjustment').val()=='Negatif Adjustment'){
      var id_lokasi     = $('#id_lokasi').val();
      var id_barang     = $('#id_barang').val();

      $.ajax({
        url : baseUrl+'transaksi/adjustment/show_lot',
        method : "POST",
        data : {id_lokasi,id_barang},
        async : false,
        dataType : 'json',
        success: function(data){
          // debugger
          // var id_lokasi     = $('#id_lokasi').val();
          var availableTags = data;
          $("#no_lot").autocomplete({
            source: availableTags
          });
        }
      })
    }else{
      var availableTags = [];
      $("#no_lot").autocomplete({
        source: availableTags
      });
    }
  });

  $("#id_lokasi").select2().on('select2:select',function(e){
    var id = $('#id_lokasi').val();
      $.ajax({
        url : baseUrl+'master/lokasi_sub/sub_lokasi',
        method : "POST",
        data : {id: id},
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '';
          var i;
          html += '<option value="0" > - </option>';
          for(i=0; i<data.length; i++){
            html += '<option value="'+data[i].id_sub_lokasi+'">'+data[i].tempat+'</option>';
          }
          $('#id_sub_lokasi').html(html);
        }
      })
  });

  $("#id_barang").select2().on('select2:select',function(e){
    var lot = $('#id_barang option:selected').attr('data-lot');
    // alert(kat_barang);
    if(lot=="Y"){
      $("#no_lot").prop('disabled',false);
      $("#kadaluarsa").prop('disabled',false);
    }else{
      $("#no_lot").prop('disabled',true);
      $("#kadaluarsa").prop('disabled',true);
    }
  });

  $('.tanggal').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy'
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
          { data: 'type_adjustment', className: "text-right" }, 
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
          harga_perolehan: i.harga_perolehan,
          type_adjustment: i.type_adjustment,
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

      if(!$('#type_adjustment').val()){
        $.notify({
          title: "Erorr : ",
          message: "Tipe Adjustment Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $('#type_adjustment').select2('open');
        return false;
      }

      if($('#id_barang option:selected').attr('data-kat_barang')==1){

        if(!$('#no_lot').val()){
          $.notify({
            title: "Erorr : ",
            message: "No Lot Tidak Boleh Kosong",
            icon: 'fa fa-times' 
          },{
            type: "danger",
            delay: 1000
          });
          $("#no_lot").focus();
          return false;
        }

        if(!$('#kadaluarsa').val()){
          $.notify({
            title: "Erorr : ",
            message: "Kadaluarsa Tidak Boleh Kosong",
            icon: 'fa fa-times' 
          },{
            type: "danger",
            delay: 1000
          });
          $("#kadaluarsa").focus();
          return false;
        }

      }

      let id_barang = $('#id_barang').val();
      let nm_barang = $('#id_barang option:selected').attr('data-name');
      let quantity  = $('#quantity').val();
      let no_lot    = $('#no_lot').val();
      let kadaluarsa= $('#kadaluarsa').val();
      let harga_perolehan= $('#harga_perolehan').val();
      let type_adjustment= $('#type_adjustment').val();
      let no_hasil  = parseInt($('#no_hasil').val())+1;

      if(id_barang){
        data = {
          id_barang     : id_barang,
          nm_barang     : nm_barang,
          quantity      : quantity,
          no_lot        : no_lot,
          kadaluarsa    : kadaluarsa,
          harga_perolehan:harga_perolehan,
          type_adjustment:type_adjustment,
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
      let exist = metode.grids.row('#'+data.id_barang+'-'+data.no_lot).index();
      //
      $('#id').val(data.id_barang+'-'+data.no_lot);

      data.act = '<button item-id="'+data.id_barang+'-'+data.no_lot+'" onclick="return metode._removefromgrid(this);">x</button>';
      data.DT_RowId = data.id_barang+'-'+data.no_lot;
      //
      if(exist===undefined){
        grids.row.add(data).draw();
      }else{ 
        $.notify({
          title: "Erorr : ",
          message: data.nm_barang+" Dengan Lot Number"+data.no_lot+" Sudah ada." ,
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#kadaluarsa").focus();
        return false;
      }

      if(this.no_ajax) return false;

      $.post({
        url: baseUrl+'transaksi/adjustment/add_item',
        data: {
          id_barang     : data.id_barang,
          nm_barang     : data.nm_barang,
          quantity      : data.quantity,
          no_lot        : data.no_lot,
          kadaluarsa    : data.kadaluarsa,
          harga_perolehan:data.harga_perolehan,
          type_adjustment:data.type_adjustment,
          no_hasil      : data.no_hasil
        }
      });
    },

    _clearitem: function(no_hasil){
      $('#id_barang').val('').trigger('change');
      $('#type_adjustment').val('').trigger('change');
      $('#quantity').val('');
      $('#no_lot').val('');
      $('#kadaluarsa').val('');
      $('#harga_perolehan').val('0');
      $('#no_hasil').val(no_hasil);

    },

    _focusadd: function(){
      $('#id_barang').select2('open');
      $("#no_lot").prop('disabled',false);
      $("#kadaluarsa").prop('disabled',false);
    },

    _removefromgrid: function(el){

      let id = $(el).attr('item-id');
      metode.grids.row("#"+id).remove().draw();
      $.get({
        url: baseUrl+'transaksi/adjustment/remove_item',
        data: {
          index_id: id
        }
      });
      return false;
    },

    save: function(e){
      e.preventDefault();
      

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

      if(!$('#alasan_adjustment').val()){
        $.notify({
          title: "Erorr : ",
          message: "Alasan Adjustment Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $('#alasan_adjustment').select2('open');
        return false;
      }

      // if(!$('#keterangan').val()){
      //   $.notify({
      //     title: "Erorr : ",
      //     message: "Keterangan Tidak Boleh Kosong",
      //     icon: 'fa fa-times' 
      //   },{
      //     type: "danger",
      //     delay: 1000
      //   });
      //   $("#keterangan").focus();
      //   return false;
      // }

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

      $('#save').prop("disabled",true);

      $.ajax({
        url: baseUrl+'transaksi/adjustment/form_act',
        type : "POST",  
        data: {
          tanggal         : $('#tanggal').val(),
          keterangan      : $('#alasan_adjustment').val(),
          id_lokasi       : $('#id_lokasi').val(),
          id_sub_lokasi   : $('#id_sub_lokasi').val(),          

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
              window.location.href = baseUrl+'transaksi/adjustment/'; //will redirect to google.
            }, 2000);
          }
        }
      });

    }

  };
  metode.init();
});
</script>