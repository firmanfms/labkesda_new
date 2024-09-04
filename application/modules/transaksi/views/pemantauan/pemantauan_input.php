<section class="content-header">
  <h1>
    Transaksi
    <small>Input Pemantapan Mutu Internal</small>
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <div class="box-body">
            <form class="form-horizontal" method="post" action="<?php echo base_url().'transaksi/pemantauan/form'; ?>">
              <!-- <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label" style="text-align: left;">Tanggal </label>
                <div class="col-sm-2">
                  <input type="date" class="form-control" name="tanggal" placeholder="Tahun" value="<?= $tanggal_pilih; ?>">
                </div>
              </div> -->
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label" style="text-align: left;">Laboratorium </label>
                <div class="col-sm-2">
                  <select class="form-control select2" style="width: 100%;" id='kd_lab' name="kd_lab">
                    <option value=""   <?= ($kd_lab=='')  ? 'selected' : ''; ?>>Semua </option>
                    <option value="LK" <?= ($kd_lab=='LK')? 'selected' : ''; ?>>Lab Klinik</option>
                    <option value="LL" <?= ($kd_lab=='LL')? 'selected' : ''; ?>>Lab Lingkungan</option>
                    <option value="LM" <?= ($kd_lab=='LM')? 'selected' : ''; ?>>Lab Makanan & Minuman</option>
                  </select>
                </div>
              </div>
			  <div class="form-group">
                <label for="inputnomor" class="col-sm-2 control-label" style="text-align: left;">Nomor Pendaftaran </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="nomor" placeholder="Nomor Pendataran" value="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-2">
                  <button type="submit" class="btn btn-info" id="save" name="search" value="search">Cari</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <form class="form-horizontal" method="post" action="<?php echo base_url().'transaksi/pemantauan/next_act'; ?>">
          <div class="box-body">
            <?php 
            $data_array = array();
            $data_sub   = array();
            foreach($data_lab as $key => $value){      
              $data_array[$value->no_pendaftaran] = $value;
            }
            foreach($data_lab as $key => $value){      
              $data_sub[$value->no_pendaftaran][] = $value;
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
                <dt><?= $value1->no_pendaftaran; ?> <i class="plus-icon"></i></dt>
                <dd>
                  <div class="content_acc">
                    <div class="form-group">
                      <?php
                      foreach($data_sub[$value1->no_pendaftaran] as $key => $value2){   
                      ?>                      
                        <div class="border-bottom">
                          <div class="col-sm-3">                    
                            <?= $value2->nm_parameter ?>
                          </div>
                          <div class="col-sm-1">
                            <input type="checkbox" id="kd_parameter" name="kd_parameter[]" value="<?= $value2->no_pendaftaran.'-'.$value2->kd_parameter; ?>">
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
            <button type="submit" class="btn btn-info" id="save">Next</button>
            <a href="<?php echo base_url('transaksi/pemantauan'); ?>" type="submit" class="btn btn-danger">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php //test($new_klinik,0); ?>
<script>
$(document).ready(function() {
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
var kode_metode = []
function add_kode(e){
  let kode        = $(e).data('kode');
  let cek         = kode_metode.lastIndexOf(kode);
  if(cek<0){
    kode_metode.push(kode);
  }else{
    kode_metode.splice(cek, 1)
  }
  // alert(kode_metode);
}
$(document).ready(function(){
  // $(':checkbox').change(function() {
  //   debugger
  //   var data  = $('#kd_mdetode').val()
  //     alert(data)      
  // });
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
    // init: function(){
    //   $('#save').click(metode.save);
    // },
    // save: function(e){
    //   e.preventDefault();
    //   // alert(kode_metode)
    //   $('#save').prop("disabled",true);
    //   $.ajax({
    //     url: baseUrl+'transaksi/pemantauan/next_act',
    //     type : "POST",  
    //     data: {
    //       kode_metode     : kode_metode
    //     }
    //   });
    // }
  };
  metode.init();
});
</script>