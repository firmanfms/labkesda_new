<?php 
$bulan          = substr($header->tgl,5,2);
$hari           = substr($header->tgl,8,2);
$tahun          = substr($header->tgl,0,4);
$tanggal        = $bulan.'/'.$hari.'/'.$tahun;
?>
<section class="content-header">
  <h1>
    Transaksi
    <small>Edit Persediaan Masuk</small>
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
                <input type="hidden" name="items" id="sup_items" value='<?php echo json_encode($new_mutasi_masuk["items"]); ?>'/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="keterangan" placeholder="Keterangan" value="<?php echo $header->keterangan; ?>">
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
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Sumber Anggaran </label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id='id_sumber'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_sumber as $key => $value) {
                    if($value->id_sumber==$header->id_sumber){
                      echo "<option value='".$value->id_sumber."' selected>".$value->sumber."</option>";
                    }else{
                      echo "<option value='".$value->id_sumber."'>".$value->sumber."</option>";
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
                <select class="form-control select2" style="width: 100%;" id='id_barang'>
                  <option disabled="" selected="">- Pilih -</option>
                  <?php 
                  foreach ($data_barang as $key => $value) {
                    echo "<option value='".$value->id_barang."' data-name='".$value->nama." (".$value->satuan.")' data-kat_barang='".$value->id_kat_barang."'>".$value->nama." (".$value->satuan.")</option>";
                  }
                  ?>
                </select>
                <input type="hidden" class="form-control" id="no_urut" value="<?php echo $no_urut; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Quantity</label>
              <div class="col-sm-2">
                <input type="number" class="form-control" id="quantity" placeholder="Quantity">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Harga Perolehan</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="harga_perolehan" placeholder="Harga Perolehan">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">No Lot</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="no_lot" placeholder="No Lot">
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
                    <th width="18%">Harga Perolehan</th>
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
  $("#harga_perolehan").inputmask({ 'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'});
  $('#id_lokasi').select2();
  $('#id_sumber').select2();
  $("#id_barang").select2().on('select2:select',function(e){
    var kat_barang = $('#id_barang option:selected').attr('data-kat_barang');
    // alert(kat_barang);
    if(kat_barang==1){
      $("#no_lot").prop('disabled',false);
      $("#kadaluarsa").prop('disabled',false);
    }else{
      $("#no_lot").prop('disabled',true);
      $("#kadaluarsa").prop('disabled',true);
    }
  });
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
          { data: 'harga_perolehan', className: "text-left" }, 
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
          harga_perolehan      : i.harga_perolehan,
          no_lot        : i.no_lot,
          kadaluarsa    : i.kadaluarsa,
          no_hasil      : i.no_hasil
        };
        metode._addtogrid(data);
        // metode._clearitem(no_hasil);
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
      let harga_perolehan= $('#harga_perolehan').val();
      let no_hasil  = parseInt($('#no_urut').val())+1;

      if(id_barang){
        data = {
          id_barang     : id_barang,
          nm_barang     : nm_barang,
          quantity      : quantity,
          no_lot        : no_lot,
          kadaluarsa    : kadaluarsa,
          harga_perolehan:harga_perolehan,
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
          harga_perolehan:data.harga_perolehan,
          no_hasil      : data.no_hasil
        }
      });
    },

    _clearitem: function(no_hasil){
      $('#id_barang').val('').trigger('change');
      $('#quantity').val('');
      $('#no_lot').val('');
      $('#kadaluarsa').val('');
      $('#harga_perolehan').val('');
      $('#no_urut').val(no_hasil);

    },

    _focusadd: function(){
      // $('#id_barang').select2('open');
      $("#no_lot").prop('disabled',false);
      $("#kadaluarsa").prop('disabled',false);
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
        url: baseUrl+'transaksi/mutasi_masuk/edit_act',
        type : "POST",  
        data: {
          tanggal         : $('#tanggal').val(),
          keterangan      : $('#keterangan').val(),
          id_lokasi       : $('#id_lokasi').val(),
          id_mutasi       : $('#id_mutasi').val(),
          id_sumber       : $('#id_sumber').val(),

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