<section class="content-header">
  <h1>
    Transaksi
    <small>Edit Pendaftaran Klinik</small>
  </h1>
</section>
<?php 
// test($header,1);
?>
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
                <input type="hidden" class="form-control pull-right" id="kd_lab" value="<?php echo $data_lab; ?>"> Lab Klinik
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Nomor Pendaftaran</label>
              <div class="col-sm-3" style="top: 7px;">: 
                <?php echo $header->no_pendaftaran; ?>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-3">
                <input type="text" class="form-control pull-right" id="nama" value="<?php echo $header->nama; ?>" onkeyup="myUp()">
                <input type="hidden" class="form-control pull-right" id="no_pendaftaran" value="<?php echo $header->no_pendaftaran; ?>">
                <input type="hidden" name="items" id="sup_items" value='<?php echo json_encode($new_klinik["items"]); ?>'/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-5">
                <textarea class="form-control pull-right" id="alamat"><?php echo $header->alamat ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Telp</label>
              <div class="col-sm-2">
                <input type="text" class="form-control pull-right" id="telp" value="<?php echo $header->telp; ?>">
              </div>
            </div>
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="tanggal" value="">
              </div>
            </div> -->
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Sampel</label>
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
            </div> -->
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Uraian Sampel</label>
              <div class="col-sm-5">
                <input type="text" class="form-control pull-right" id="uraian_sampel">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Keterangan Sampel</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="ket_sampel" placeholder="Keterangan Sampel">
              </div>
            </div> -->
            <!-- <div class="form-group">
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
            </div> -->
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Terima</label>
              <div class="col-sm-2">
                <input type="datetime-local" class="tanggal form-control pull-right" id="tgl_diterima" value="<?php echo $header->tgl_diterima; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Pengujian</label>
              <div class="col-sm-2">
                <input type="date" class="tanggal form-control pull-right" id="tgl_pengujian" value="<?php echo substr($header->tgl_pengujian,0,10); ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Selesai</label>
              <div class="col-sm-2">
                <input type="datetime-local" class="tanggal form-control pull-right" id="tgl_selesai" value="<?php echo $header->tgl_selesai; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Lahir</label>
              <div class="col-sm-2">
                <input type="date" class="tanggal form-control pull-right" id="tgl_lahir" value="<?php echo substr($header->tgl_lahir,0,10); ?>">
              </div>
            </div>
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Jenis Analisa</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="jns_analisa" placeholder="Jenis Analisa">
              </div>
            </div> -->
            <!-- <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Umur</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="umur" placeholder="Umur" value="<?php echo $header->umur; ?>">
              </div>
            </div> -->
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Titik/lokasi Pengambilan Sample</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="lokasi" placeholder="Lokasi" value="<?= $header->lokasi; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Dokter</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="dokter" placeholder="Dokter" value="<?php echo $header->dokter; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Diagnosa</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="diagnosa" placeholder="Diagnosa Klinik" value="<?php echo $header->diagnosa_klinik; ?>">
              </div>
            </div>            
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Volume Spesimen</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="volume" placeholder="Volume" value="<?php echo $header->volume; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Jenis Spesimen</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="jenis_spesimen" placeholder="Jenis Spesimen" value="<?php echo $header->jenis_spesimen; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Waktu Pengambilan Spesimen</label>
              <div class="col-sm-3">
                <input type="datetime-local" class="tanggal form-control pull-right" id="tgl_spesimen" value="<?php echo $header->tgl_spesimen; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-5">
                <label><input type="radio" name="jns_kelamin" id="jns_kelamin" value="P" <?php echo ($header->jns_kelamin=='P')? 'checked':''; ?>> Pria</label>
                <label><input type="radio" name="jns_kelamin" id="jns_kelamin" value="W" <?php echo ($header->jns_kelamin=='W')? 'checked':''; ?>> Wanita</label>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-5">
                <textarea class="form-control pull-right" id="keterangan" oninvalid="<?= $header->keterangan; ?>"></textarea>
              </div>
            </div>
            <hr>  
            <?php 
            $data_array = array();
            $data_sub   = array();
            foreach($data_metode as $key => $value){      
              $data_array[$value->nm_kategori_parameter] = $value;
            }

            foreach($data_metode as $key => $value){      
              if($value->no_pendaftaran!=''){
                $data_value[$value->nm_kategori_parameter][] = $value;
              }else{
                $data_value[$value->nm_kategori_parameter] = array();
              }
            }

            foreach($data_metode as $key => $value){      
              $data_sub[$value->nm_kategori_parameter][] = $value;
            }
            ?>
            <div class="accordion-panel">
              <div class="form-group">
                <div class="col-sm-2">Nama Parameter</div>
                <div class="col-sm-10">
                  <div class="buttons-wrapper">
                  <i class="plus-icon"></i>
                  <div class="open-btn">
                    Open all
                  </div>
                  <div class="close-btn hidden">
                    Close all
                  </div>
                </div>  
                </div>
              </div>              
              <dl class="accordion">
                <?php
                foreach($data_array as $key => $value1){       
                ?>
                <dt><?= $value1->nm_kategori_parameter; ?> <i class="plus-icon"></i></dt>
                <dd>
                  <div class="content_acc">
                    <div class="form-group">
                      <div class="border-bottom">
                        <div class="col-sm-2">                    
                          CHECK ALL
                        </div>
                        <div class="col-sm-10">
                          <input type="checkbox" id="checkAll" onclick="return myFunction(this)" data-kd_kategori_parameter="<?= $value1->kd_kategori_parameter; ?>" 
                            <?= (count($data_sub[$value1->nm_kategori_parameter])==count($data_value[$value1->nm_kategori_parameter]))? 'checked' : ''; ?>>
                        </div>
                      </div>
                  <?php
                  foreach($data_sub[$value1->nm_kategori_parameter] as $key => $value2){  
                  // test($value1->kd_kategori_parameter,1); 
                  ?>                      
                      <div class="border-bottom">
                        <div class="col-sm-2">                    
                          <?= $value2->nm_parameter ?>
                        </div>
                        <div class="col-sm-1">
                          <input type="checkbox" id="kd_parameter" name="kd_parameter" onclick="return add_kode(this)"  data-kode="<?= $value2->kd_parameter; ?>" <?= ($value2->no_pendaftaran!='')? 'checked' : ''; ?> class='<?= $value1->kd_kategori_parameter; ?>' value="<?= $value2->kd_parameter; ?>">
                        </div>
                      </div>
                  <?php 
                  }
                  ?>
                    </div>
                  </div>
                </dd>
                <?php 
                }
                ?>                
              </dl>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('transaksi/pendaftaran_klinik/reset'); ?>" type="submit" class="btn btn-danger">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php 
$metode 	= array();
foreach ($detail as $key => $value1) {
	array_push($metode,(int)$value1->kd_parameter);
}
?>
<script>
function myUp() {
    var x = document.getElementById("nama");
    x.value = x.value.toUpperCase();
}

var kode_metode = <?= json_encode($metode); ?>

function myFunction(e){
  debugger
  let kode    = $(e).data('kd_kategori_parameter');
  let data    = $('.'+kode);
  $('.'+kode).not(e).prop('checked', e.checked);
  // alert(data.length);
  if(kode_metode.count >=1 ){
    for (let i = 0; i < data.length; i++) {
      let detail      = parseInt(data[i].dataset.kode);
      let cek         = kode_metode.lastIndexOf(detail);
      kode_metode.splice(cek, 1);
    }
  }
  
  // alert(kode_metode);

  for (let i = 0; i < data.length; i++) {
    // debugger
    let detail      = parseInt(data[i].dataset.kode);
    let cek         = kode_metode.lastIndexOf(detail);

    if(cek<0){
      kode_metode.push(detail);
    }else{
      kode_metode.splice(cek, 1)
    }
    // alert(kode_metode);
  }
  // alert(kode_metode);
};

function add_kode(e){
  let kode        = parseInt($(e).data('kode'));
  let cek         = kode_metode.lastIndexOf(kode);

  if(cek<0){
    kode_metode.push(kode);
  }else{
    kode_metode.splice(cek, 1)
  }
  // alert(kode_metode);
}

$(document).ready(function() {

var fakedata = <?= json_encode($data_nama); ?>;

$("#nama").autocomplete({
  minLength: 3,
  source: function (request, response) {
    response($.map(fakedata, function (value, key) {
      let nama_kecil  = value.nama;
      let data        = nama_kecil.search(request.term);
      if(data>=0){
        return {
          label: value.nama+' | '+value.alamat+' | '+value.telp+' | '+value.tgl_lahir,
          value: value.nama,
          alamat:value.alamat,
          telp:value.telp,
          tgl_lahir:value.tgl_lahir
        }
      }      
    }));
  },    
  select: function(event,ui){
    if(ui.item){
      $('#nama').val(ui.item.value);
      $('#alamat').val(ui.item.alamat);
      $('#telp').val(ui.item.telp);
      $('#tgl_lahir').val(ui.item.tgl_lahir);
    }
    // $('#search').submit();
  }
});

var bodyEl = $('body'),
  accordionDT = $('.accordion').find('dt'),
  accordionDD = accordionDT.next('dd'),
  parentHeight = accordionDD.height(),
  childHeight = accordionDD.children('.content_acc').outerHeight(true),
  newHeight = parentHeight > 0 ? 0 : childHeight,
  accordionPanel = $('.accordion-panel'),
  buttonsWrapper = accordionPanel.find('.buttons-wrapper'),
  openBtn = accordionPanel.find('.open-btn'),
  closeBtn = accordionPanel.find('.close-btn');

bodyEl.on('click', function(argument) {
  var totalItems = $('.accordion').children('dt').length;
  var totalItemsOpen = $('.accordion').children('dt.is-open').length;

  if (totalItems == totalItemsOpen) {
    openBtn.addClass('hidden');
    closeBtn.removeClass('hidden');
    buttonsWrapper.addClass('is-open');
  } else {
    openBtn.removeClass('hidden');
    closeBtn.addClass('hidden');
    buttonsWrapper.removeClass('is-open');
  }
});

function openAll() {

  openBtn.on('click', function(argument) {

    accordionDD.each(function(argument) {
      var eachNewHeight = $(this).children('.content_acc').outerHeight(true);
      $(this).css({
        height: eachNewHeight
      });
    });
    accordionDT.addClass('is-open');
  });
}

function closeAll() {

  closeBtn.on('click', function(argument) {
    accordionDD.css({
      height: 0
    });
    accordionDT.removeClass('is-open');
  });
}

function openCloseItem() {
  accordionDT.on('click', function() {
    // debugger
    var el = $(this),
      target = el.next('dd'),
      parentHeight = target.height(),
      childHeight = target.children('.content_acc').outerHeight(true),
      newHeight = parentHeight > 0 ? 0 : childHeight;

    // animate to new height
    target.css({
      height: newHeight
    });

    // remove existing classes & add class to clicked target
    if (!el.hasClass('is-open')) {
      el.addClass('is-open');
    }

    // if we are on clicked target then remove the class
    else {
      el.removeClass('is-open');
    }
  });
}

openAll();
closeAll();
openCloseItem();
});

$(document).ready(function(){

  // $('#kd_lab').select2();
  $('#kd_sampel').select2();
  $('#kd_kategori_parameter').select2();
  $('#tanggal').datepicker({
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
        url: baseUrl+'transaksi/pendaftaran_klinik/add_item',
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
        url: baseUrl+'transaksi/pendaftaran_klinik/remove_item',
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

      if(!$('#telp').val()){
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
      
      // if(!$('#kd_sampel').val()){
      //   $.notify({
      //     title: "Erorr : ",
      //     message: "Sampel Tidak Boleh Kosong",
      //     icon: 'fa fa-times' 
      //   },{
      //     type: "danger",
      //     delay: 1000
      //   });
      //   $('#kd_sampel').select2('open');
      //   return false;
      // }

      // if(!$('#uraian_sampel').val()){
      //   $.notify({
      //     title: "Erorr : ",
      //     message: "Uraian Sampel Tidak Boleh Kosong",
      //     icon: 'fa fa-times' 
      //   },{
      //     type: "danger",
      //     delay: 1000
      //   });
      //   $("#uraian_sampel").focus();
      //   return false;
      // }

      // if(!$('#ket_sampel').val()){
      //   $.notify({
      //     title: "Erorr : ",
      //     message: "Keterangan Sampel Tidak Boleh Kosong",
      //     icon: 'fa fa-times' 
      //   },{
      //     type: "danger",
      //     delay: 1000
      //   });
      //   $("#ket_sampel").focus();
      //   return false;
      // }

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

      // if(!$('#banyak').val()){
      //   $.notify({
      //     title: "Erorr : ",
      //     message: "Banyak Tidak Boleh Kosong",
      //     icon: 'fa fa-times' 
      //   },{
      //     type: "danger",
      //     delay: 1000
      //   });
      //   $("#banyak").focus();
      //   return false;
      // }

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

      if(!$('#dokter').val()){
        $.notify({
          title: "Erorr : ",
          message: "Dokter Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#dokter").focus();
        return false;
      }

      if(!$('#diagnosa').val()){
        $.notify({
          title: "Erorr : ",
          message: "Diagnosa Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#diagnosa").focus();
        return false;
      }

      if(!$('#jns_kelamin').val()){
        $.notify({
          title: "Erorr : ",
          message: "Jenis Kelamin Tidak Boleh Kosong",
          icon: 'fa fa-times' 
        },{
          type: "danger",
          delay: 1000
        });
        $("#jns_kelamin").focus();
        return false;
      }

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

      $('#save').prop("disabled",true);
      // debugger
      var lang = [];

      $("input[name='kd_parameter']:checked").each(function(){
        lang.push(this.value);
      });

      $.ajax({
        url: baseUrl+'transaksi/pendaftaran_klinik/edit_act',
        type : "POST",  
        data: {
          no_pendaftaran  : $('#no_pendaftaran').val(),
          kd_lab          : $('#kd_lab').val(),
          nama            : $('#nama').val(),
          alamat          : $('#alamat').val(),
          telp            : $('#telp').val(),
          tgl_diterima    : $('#tgl_diterima').val(),
          tgl_pengujian   : $('#tgl_pengujian').val(),
          tgl_selesai     : $('#tgl_selesai').val(),
          tgl_lahir       : $('#tgl_lahir').val(),
          tgl_spesimen    : $('#tgl_spesimen').val(),
          lokasi          : $('#lokasi').val(),
          kd_sampel       : 0,
          // uraian_sampel   : $('#uraian_sampel').val(),
          // ket_sampel      : $('#ket_sampel').val(),
          // kondisi         : $('#kondisi').val(),
          // banyak          : $('#banyak').val(),
          // jns_analisa     : $('#jns_analisa').val(),
          // umur            : $('#umur').val(),
          dokter          : $('#dokter').val(),
          diagnosa        : $('#diagnosa').val(),
          jns_kelamin     : $('#jns_kelamin:checked').val(),
          volume          : $('#volume').val(),
          jenis_spesimen  : $('#jenis_spesimen').val(),   
          keterangan      : $('#keterangan').val(),   
          kode_metode     : lang

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
              window.location.href = baseUrl+'transaksi/pendaftaran_klinik/'; //will redirect to google.
            }, 2000);
          }
        }
      });

    }

  };
  metode.init();
});
</script>