<?php 
// test($header,1);
if($header->approve_mutasi==0){
    $status     = 'On Process';
}elseif($header->approve_mutasi==1){
    $status     = 'Complate';
}elseif($header->approve_mutasi==2){
    $status     = 'Void';
}
?>
<!-- <section class="content"> -->
    <div class="row">
        <div class="col-md-12">
                <div class="box-body">
                    <div class="form-group">
                        <div class="col-6">
                            <div class="form-popup row">
                                <label class="control-label col-md-4">Nomor Mutasi</label>
                                <div class="col-md-7">: <?php echo $header->no_mutasi; ?></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-popup row">
                                <label class="control-label col-md-4">Tanggal </label>
                                <div class="col-md-7">: <?php echo tanggal($header->tgl); ?></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-popup row">
                                <label class="control-label col-md-4">Keterangan</label>
                                <div class="col-md-7">: <?php echo $header->keterangan; ?></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-popup row">
                                <label class="control-label col-md-4">Lokasi</label>
                                <div class="col-md-7">: <?php echo $header->lokasi; ?></div>
                            </div>
                        </div>
                         <div class="col-6">
                            <div class="form-popup row">
                                <label class="control-label col-md-4">Status</label>
                                <div class="col-md-7">: <?php echo $status; ?></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-popup row">
                                <label class="control-label col-md-4"></label>
                                <div class="col-md-7"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <table class="table table-hover table-bordered" id="detail">
                            <thead>
                                <tr>
                                    <td width="45%">Barang</td>
                                    <td width="20%">Qty</td>
                                    <td>No Lot</td>
                                    <td>kadaluarsa</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach ($detail as $key => $value) {
                            ?>
                                <tr>
                                    <td><?php echo $value->nama; ?></td>
                                    <td><?php echo $value->qty; ?></td>
                                    <td><?php echo $value->lot_no; ?></td>
                                    <td><?= ($value->tgl_kadaluwarsa!='1700-01-01')? tgl_singkat($value->tgl_kadaluwarsa) : ''; ?></td>
                                </tr>
                            <?php 
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
<!-- </section> -->