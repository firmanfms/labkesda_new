<?php if (isset($_SESSION['alert'])): ?>
  <script type="text/javascript">
    Command: toastr["info"]("<?php echo $_SESSION['alert']; ?>", "Update Hasil Laboratorium",{
      "closeButton": true,
    "newestOnTop": true,
    "progressBar": false,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "5000",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "5000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }).css("width","750px");
  </script>
<?php endif; ?>
<section class="content-header">
    <h1>
        Transaksi
        <small>View Pemantapan Mutu Internal</small>
    </h1>
    <ol class="breadcrumb">
        <li><a style="color: white" type="submit" class="btn btn-block btn-primary" href="<?php echo base_url('transaksi/pemantauan/form'); ?>">Input</a></li>
    </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <!-- <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Table With Full Features</h3>
        </div>
      </div> -->
      <div class="box">
        <div class="box-body">
          <table id="itemsTable" class="table table-bordered table-striped">
            <thead>
            <tr>
              <!-- <th>No Pendaftaran</th> -->
              <th>No Pendaftaran</th>
              <th>Parameter</th>
              <th>Sampel</th>
              <th>RPD</th>
              <th>P1</th>
              <th>P2</th>
              <th>Blanko</th>
              <th>Rec</th>
              <th>CRM</th>
              <th width="10%">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            foreach ($data_mutu as $key => $value) {
            ?>
            <tr>
              <td><?php echo $value->no_pendaftaran; ?></td>
              <td><?php echo $value->nm_parameter; ?></td>
              <td><?= ($value->nm_sampel!='0')? $value->nm_sampel : ''; ?></td>
              <td><?php echo $value->rpd; ?></td>
              <td><?php echo $value->p1; ?></td>
              <td><?php echo $value->p2; ?></td>
              <td><?php echo $value->blanko; ?></td>
              <td><?php echo $value->rec; ?></td>
              <td><?php echo $value->crm; ?></td>
              <!-- <td><?= $status; ?></td> -->
              <td align="center">
                <a href="<?php echo base_url('transaksi/pemantauan/update/'.$value->id_mutu_internal); ?>" type="submit" class="btn btn-xs btn-warning">Edit</a>
                <button type="button" id='delete' class="btn btn-xs btn-danger" data-toggle="modal" data-id_mutu_internal="<?= $value->id_mutu_internal; ?>">Hapus</button>
              </td>
            </tr>
            <?php 
            }
            ?>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

<!-- Modal -->
<div class="modal fade" id="exModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Print Klinik</h5>
      </div>
      <form action="<?= base_url("transaksi/hasil_klinik/print") ?>" method="post" target="_blank">
        <div class="modal-body">
          <div class="row">
            <label class="col-sm-5 control-label">Agreditasi</label>
            <label class="radio-inline col-sm-2">
              <input type="radio" name="agreditasi" id="agreditasi" value="kan"> KAN
              <input type="hidden" class="form-control" id="nomor" name="nomor">
              <input type="hidden" class="form-control" id="urut" name="urut">
            </label>
            <label class="radio-inline col-sm-2">
              <input type="radio" name="agreditasi" id="agreditasi" value="kalk"> KALK
            </label>
          </div>
          <div class="row">
            <label class="col-sm-5 control-label">Print</label>
            <label class="radio-inline col-sm-3">
              <input type="radio" name="print" id="print" value="print"> To Printer
            </label>
            <label class="radio-inline col-sm-3">
              <input type="radio" name="print" id="print" value="word"> Convert Word
            </label>
          </div>
          <div class="row">
            <label class="col-sm-5 control-label">Versi</label>
            <label class="radio-inline col-sm-3">
              <input type="radio" name="versi" id="versi" value="1"> Satu
            </label>
            <label class="radio-inline col-sm-3">
              <!-- <input type="radio" name="print" id="print" value="word"> Convert Word -->
            </label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Oke</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="<?php echo base_url('assets/ckeditor/ckeditor.js');?>"></script>

<script type="text/javascript">
$(document).ready(function(){

  $(function () {
    CKEDITOR.replace('ckeditor',{
      height: '400px'             
    });
  });

  $(".cetak").click(function(e){
    $("#nomor").val( $(this).data('nomor'))
    $("#urut").val( $(this).data('urut'))
  })

  $('#itemsTable').DataTable({
    "paging": true, 
    "bLengthChange": false, // disable show entries dan page
    "bFilter": true,
    "bInfo": true, // disable Showing 0 to 0 of 0 entries
    "bAutoWidth": false,
    "language": {
        "emptyTable": "No Data"
    },
    "aaSorting": [],
  });

  $('#itemsTable').on('click','#delete',function(e){
    var id_mutu_internal           = $(this).data('id_mutu_internal');

    BootstrapDialog.show({
      title: 'Hapus ',
      type : BootstrapDialog.TYPE_DANGER,
      message: 'Anda Ingin menghapus ?',
      closable: false,
      buttons: [
        {
          label: '<i class="fa fa-reply"></i> Cancel', cssClass: 'btn',
          action: function(dia){
            dia.close();
          }
        },
        {
          label: '<i class="fa fa-close"></i> Hapus', cssClass: 'btn-danger', id: 'update_sales', //hotkey: 'alt'+'s',
          // icon: 'glyphicon glyphicon-check',
          action: function(dia){
            dia.close();
            $.ajax({
                data: {
                    id_mutu_internal : id_mutu_internal
                },
                type : "POST",
                url: baseUrl+'transaksi/pemantauan/delete',
                success : function(resp){

                  if(resp.status == 'ERROR INSERT' || resp.status == false) {
                    alert('Data Tidak berhasil di Hapus');
                    return false;

                  } else {
                    $.notify({
                          icon: "glyphicon glyphicon-save",
                          message: 'Data Berhasil di Hapus'
                        },{
                          type: 'success',
                          onClosed: function(){ location.reload();}
                        });

                    setTimeout(function () {
                      window.location.href = baseUrl+'transaksi/pemantauan'; //will redirect to google.
                    }, 2000);
                  }
                }
            });
          }
        }
      ],
    });
  });

  $('#itemsTable').on('click','#approve',function(e){
    var nomor           = $(this).data('nomor').replace(/-/g, '/');
    var level           = $(this).data('level');

    BootstrapDialog.show({
      title: 'Approve Pendaftaraan ',
      type : BootstrapDialog.TYPE_DANGER,
      message: 'Ingin Approve '+nomor+' ?',
      closable: false,
      buttons: [
        {
          label: '<i class="fa fa-reply"></i> Batal', cssClass: 'btn',
          action: function(dia){
            dia.close();
          }
        },
        {
          label: 'Approve', cssClass: 'btn-warning', id: 'update_sales', //hotkey: 'alt'+'s',
          // icon: 'glyphicon glyphicon-check',
          action: function(dia){
            dia.close();
            $.ajax({
                data: {
                    nomor : nomor, level : level
                },
                type : "POST",
                url: baseUrl+'transaksi/pendaftaran_klinik/approve',
                success : function(resp){

                  if(resp.status == 'ERROR INSERT' || resp.status == false) {
                    alert('Data Tidak berhasil di Approve');
                    return false;

                  } else {
                    $.notify({
                          icon: "glyphicon glyphicon-save",
                          message: 'Data Berhasil di Approve'
                        },{
                          type: 'success',
                          onClosed: function(){ location.reload();}
                        });

                    setTimeout(function () {
                      window.location.href = baseUrl+'transaksi/hasil_klinik'; //will redirect to google.
                    }, 2000);
                  }
                }
            });
          }
        }
      ],
    });
  });

})
</script>