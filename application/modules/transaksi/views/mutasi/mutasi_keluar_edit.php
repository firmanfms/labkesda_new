<?php 
$bulan          = substr($header->tgl,5,2);
$hari           = substr($header->tgl,8,2);
$tahun          = substr($header->tgl,0,4);
$tanggal        = $bulan.'/'.$hari.'/'.$tahun;
?>
<section class="content-header">
  <h1>
    Transaksi
    <small>Edit Persediaan Keluar</small>
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
                <input type="text" class="tanggal form-control pull-right" id="tanggal" value="<?php echo $tanggal; ?>">
                <input type="hidden" name="id_mutasi" value="<?php echo $header->id_mutasi; ?>" id='id_mutasi'>
                <input type="hidden" name="items" id="sup_items" value='<?php echo json_encode($new_mutasi_keluar["items"]); ?>'/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="keterangan" placeholder="Keterangan" value="<?php echo $header->keterangan; ?>">
              </div>
            </div>
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
              <div class="col-sm-5">
                <div class="radio">
                  <label><input type="radio" name="status" id="status" value="1">keluar</label>
                  <label>&nbsp;&nbsp;&nbsp;</label>
                  <label><input type="radio" name="status" id="status" value="2">Keluar</label>
                </div>
              </div>
            </div> -->
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">No. Referensi</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="no_referensi" placeholder="No. Referensi" value="<?= $header->no_referensi ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Lokasi</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='id_lokasi'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_lokasi as $key => $value) {
                    if($value->id_lokasi==$header->id_lokasi){
                      echo "<option value='".$value->id_lokasi."' selected>".$value->lokasi."</option>";
                    }else{
                      echo "<option value='".$value->id_lokasi."'>".$value->lokasi."</option>";
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <hr>  
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Barang</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="id_barang" name="id_barang" placeholder="Nama Barang" onclick="return browse_barang()"/>
                <!-- <select class="form-control select2" style="width: 100%;" id='id_barang'>
                </select> -->
                <input type="hidden" class="form-control" id="no_hasil" value="0">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Quantity</label>
              <div class="col-sm-2">
                <input type="number" class="form-control" id="quantity" placeholder="Quantity">
              </div>
            </div>
            <div class="form-group">
              <!-- <label for="inputEmail3" class="col-sm-2 control-label">No Lot</label> -->
              <div class="col-sm-3">
                <input type="hidden" class="form-control" id="no_lot" placeholder="No Lot" value="0">
              </div>
            </div>
            <div class="form-group">
              <!-- <label for="inputEmail3" class="col-sm-2 control-label">Kadaluarsa</label> -->
              <div class="col-sm-2">
                <input type="hidden" class="tanggal form-control pull-right" id="kadaluarsa" value="00/00/0000">
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
<?php //test($new_mutasi_keluar,0); ?>

<script type="text/template" class="modal_item" id="content_browse_barang">
  <table class='table table-bordered table-hover' id='table-browse_barang' style="cursor:pointer">
    <thead>
      <tr>  
        <th>ID STOK</th>
        <th>ID BARANG</th>
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

<script>

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
          url: baseUrl + 'transaksi/mutasi_keluar/get_barang',
          
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
          {"data"   : "nama"},
          {"data"   : "qty"},
          {"data"   : "lot_no","visible": false},
          {"data"   : "tgl_kadaluwarsa","visible": false}
        ],
        drawCallback: function( settings ) {
          var api = this.api();

          // Output the data for the visible rows to the browser's console
          api.$('td').click( function () {
            let item_data       = {};
            let id_stok         = api.row($(this).parents('tr')).data().id_stok;
            let id_barang       = api.row($(this).parents('tr')).data().id_barang;
            let nama            = api.row($(this).parents('tr')).data().nama;
            let qty             = api.row($(this).parents('tr')).data().qty;
            let lot_no          = api.row($(this).parents('tr')).data().lot_no;
            let tgl_kadaluwarsa  = api.row($(this).parents('tr')).data().tgl_kadaluwarsa;

            $('#id_barang').val(nama);
            $('#id_barang').attr('data-id_stok', id_stok);
            $('#id_barang').attr('data-id_barang', id_barang);
            $('#id_barang').attr('data-qty', qty);
            $('#id_barang').attr('data-lot_no', lot_no);
            $('#id_barang').attr('data-tgl_kadaluwarsa', tgl_kadaluwarsa);

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
  // $('#id_barang').select2().on('change', function(e) {
  //   var id = $('#id_lokasi').val();
  //   $.ajax({
  //     url : baseUrl+'transaksi/mutasi_masuk/stok_barang',
  //     method : "POST",
  //     data : {id: id},
  //     async : false,
  //     dataType : 'json',
  //     success: function(data){
  //       var html = '';
  //       var i;
  //       html += '<option value="0" > - </option>';
  //       for(i=0; i<data.length; i++){
  //         html += '<option value="'+data[i].id_barang+'" data-name="'+data[i].nama+'" data-qty="'+data[i].qty+'" >'+data[i].nama+' - '+data[i].qty+'</option>';
  //       }
  //       $('#id_barang').html(html);
  //     }
  //   })
  // });

  // $("#id_lokasi").select2().on('select2:select',function(e){
  //   var id = $('#id_lokasi').val();
  //   $.ajax({
  //     url : baseUrl+'transaksi/mutasi_masuk/stok_barang',
  //     method : "POST",
  //     data : {id: id},
  //     async : false,
  //     dataType : 'json',
  //     success: function(data){
  //       var html = '';
  //       var i;
  //       html += '<option value="0" > - </option>';
  //       for(i=0; i<data.length; i++){
  //         html += '<option value="'+data[i].id_barang+'" data-name="'+data[i].nama+'" data-qty="'+data[i].qty+'" >'+data[i].nama+' - '+data[i].qty+'</option>';
  //       }
  //       $('#id_barang').html(html);
  //     }
  //   })
  // });

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
          { data: 'no_lot', className: "text-left", bVisible  : false }, 
          { data: 'kadaluarsa', className: "text-left", bVisible  : false }, 
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
        // $('#id_barang').select2('open');
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

      var stok    =  parseInt($('#id_barang option:selected').attr('data-qty'));
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

      let id_barang = $('#id_barang').attr('data-id_barang');
      let nm_barang = $('#id_barang').val();
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
        url: baseUrl+'transaksi/mutasi_keluar/add_item',
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
      $('#no_lot').val('0');
      $('#kadaluarsa').val('00/00/0000');
      $('#no_hasil').val(no_hasil);

    },

    _focusadd: function(){
      // $('#id_barang').select2('open');
    },

    _removefromgrid: function(el){

      let id = $(el).attr('item-id');
      metode.grids.row("#"+id).remove().draw();
      $.get({
        url: baseUrl+'transaksi/mutasi_keluar/remove_item',
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
      $('#save').prop("disabled",true);

      $.ajax({
        url: baseUrl+'transaksi/mutasi_keluar/edit_act',
        type : "POST",  
        data: {
          tanggal         : $('#tanggal').val(),
          keterangan      : $('#keterangan').val(),
          no_referensi    : $('#no_referensi').val(),
          id_lokasi       : $('#id_lokasi').val(),
          id_mutasi       : $('#id_mutasi').val()

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
              window.location.href = baseUrl+'transaksi/mutasi_keluar/'; //will redirect to google.
            }, 2000);
          }
        }
      });

    }

  };
  metode.init();
});
</script>