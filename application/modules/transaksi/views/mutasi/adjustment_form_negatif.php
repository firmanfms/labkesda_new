<section class="content-header">
  <h1>
    Transaksi
    <small>Input Adjustment Negatif</small>
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
                <!-- <select class="form-control select2" style="width: 100%;" id='id_barang'>
                </select> -->
                <input type="text" class="form-control" id="id_barang" name="id_barang" placeholder="Nama Barang" onclick="return browse_barang()"/>
                <input type="hidden" class="form-control" id="no_hasil" value="0">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Quantity</label>
              <div class="col-sm-2">
                <input type="number" class="form-control" id="quantity" placeholder="Quantity">
                <input type="hidden" class="form-control" id="type_adjustment" placeholder="Harga Perolehan" value="Negatif Adjustment">
                <input type="hidden" class="form-control" id="harga_perolehan" value="0">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">No Lot</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="no_lot" placeholder="No Lot" disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Kadaluarsa</label>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="kadaluarsa" disabled>
              </div>
            </div>
            <div class="col-md-12">
              <div class="table-responsive">
                <table id="detail" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Harga</th>
                    <th>type</th>
                    <th>Barang</th>
                    <th width="10%">Quantity</th>
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
            <a href="<?php echo base_url('transaksi/mutasi_keluar/reset'); ?>" type="submit" class="btn btn-danger">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php //test($new_mutasi_masuk,0); ?>

<script type="text/template" class="modal_item" id="content_browse_barang">
  <table class='table table-bordered table-hover' id='table-browse_barang' style="cursor:pointer">
    <thead>
      <tr>  
        <th>ID STOK</th>
        <th>ID BARANG</th>
        <th>harga</th>
        <th>Nama</th>
        <th width='10%'>Quantity</th>
        <th width='10%'>NO. Lot</th>
        <th width='10%'>Kadaluwarsa</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</script>

<script type="text/javascript">

  function browse_barang() {
    if(!$('#id_lokasi').val()){
      $.notify({
        title: "Erorr : ",
        message: "Lokasi Tidak Boleh Kosong",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $('#id_lokasi').select2('open');
      return false;
    }

    let dialogshown = function(){
      var tbl = $('#table-browse_barang');
      var id  = $('#id_lokasi').val();
      metode.select_items_table = tbl.DataTable({
        serverSide  : true,
        fixedHeader : true,
        ajax        : {
          method : "GET",
          data : {
            id: id
          },
          url: baseUrl + 'transaksi/adjustment/get_barang',
          
        },
        columns     : [
          {
            "data"   : "id_stok",
            "visible": false
          },
          {
            "data"   : "id_barang",
            "visible": false
          },
          {
            "data"   : "harga_perolehan",
            "visible": false
          },
          {"data"   : "nama"},
          {"data"   : "qty"},
          {"data"   : "lot_no"},
          {"data"   : "tgl_kadaluwarsa"}
        ],
        drawCallback: function( settings ) {
          var api = this.api();

          // Output the data for the visible rows to the browser's console
          api.$('td').click( function () {
            let item_data       = {};
            let id_stok         = api.row($(this).parents('tr')).data().id_stok;
            let id_barang       = api.row($(this).parents('tr')).data().id_barang;
            let harga_perolehan = api.row($(this).parents('tr')).data().harga_perolehan;
            let nama            = api.row($(this).parents('tr')).data().nama;
            let qty             = api.row($(this).parents('tr')).data().qty;
            let lot_no          = api.row($(this).parents('tr')).data().lot_no;
            let tgl_kadaluwarsa = api.row($(this).parents('tr')).data().tgl_kadaluwarsa;

            $('#id_barang').val(nama);
            $('#id_barang').attr('data-id_stok', id_stok);
            $('#id_barang').attr('data-id_barang', id_barang);
            $('#id_barang').attr('data-qty', qty);
            $('#harga_perolehan').val(harga_perolehan);
            $('#no_lot').val(lot_no);
            $('#kadaluarsa').val(tgl_kadaluwarsa);

            metode.view_barang.close();
            $("#item_price").focus();
          });
        },
        initComplete: function() {
          var $searchInput = $('div.dataTables_filter input');

          $searchInput.unbind();

          $searchInput.bind('keyup', function(e) {
            if(this.value.length > 3 || this.value.length == 0) {
                metode.select_items_table.search( this.value ).draw();
            }
          });
        }
      });
      $('div.dataTables_filter input').focus();
    }

    metode.view_barang = BootstrapDialog.show({
      title     : 'Pilih Barang',
      nl2br     : false,
      //cssClass: 'master_promo_dialog',
      size      : 'size-wide',
      message   : $('#content_browse_barang').html(),
      draggable : false,
      buttons   : [
        {
          label    : 'Tutup',
          cssClass : 'btn-info',
          action   : function(s){s.close(); }
        }
      ],
      onshown: dialogshown
    });
  };

$(document).ready(function(){
  $('#id_lokasi').select2();
  $('#id_sub_lokasi').select2();
  $('#alasan_adjustment').select2();
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
          { 
            bVisible  : false,
            data      : 'harga_perolehan' 
          },
          { 
            bVisible  : false,
            data      : 'type_adjustment' 
          }, 
          { data: 'nm_barang', className: "text-left" }, 
          { data: 'quantity', className: "text-left" }, 
          { data: 'no_lot', className: "text-left"}, 
          { data: 'kadaluarsa', className: "text-left"}, 
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

      var stok    =  parseInt($('#id_barang').attr('data-qty'));
      if($('#quantity').val()>stok){
        $.notify({
          title: "Erorr : ",
          message: "Quantity Lebih Besar Dari Stok",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#quantity").focus();
        return false;
      }
      // debugger
      let id_barang       = $('#id_barang').attr('data-id_barang');
      let nm_barang       = $('#id_barang').val();
      let quantity        = $('#quantity').val();
      let no_lot          = $('#no_lot').val();;
      let kadaluarsa      = $('#kadaluarsa').val();
      let type_adjustment = $('#type_adjustment').val();
      let harga_perolehan = $('#harga_perolehan').val();
      let id_stok         = $('#id_barang').attr('data-id_stok');
      let no_hasil        = parseInt($('#no_hasil').val())+1;

      if(id_barang){
        data = {
          id_barang     : id_barang,
          nm_barang     : nm_barang,
          quantity      : quantity,
          no_lot        : no_lot,
          kadaluarsa    : kadaluarsa,
          harga_perolehan: harga_perolehan,
          type_adjustment:type_adjustment,
          id_stok       : id_stok,
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
      let exist = metode.grids.row('#'+data.id_stok).index();
      //
      $('#id').val(data.id_stok);

      data.act = '<button item-id="'+data.id_stok+'" onclick="return metode._removefromgrid(this);">x</button>';
      data.DT_RowId = data.id_stok;
      //
      if(exist===undefined){
        grids.row.add(data).draw();
      }else{ 
        grids.row(exist).data(data).draw(false);
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
          id_stok       : data.id_stok,
          no_hasil      : data.no_hasil,
          harga_perolehan:data.harga_perolehan,
          type_adjustment:data.type_adjustment
        }
      });
    },

    _clearitem: function(no_hasil){
      $('#id_barang').val('');
      $('#quantity').val('');
      $('#no_lot').val('');
      $('#kadaluarsa').val('');
      $('#harga_perolehan').val('0');
      $('#no_hasil').val(no_hasil);

    },

    _focusadd: function(){
      $('#id_barang').val('');
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