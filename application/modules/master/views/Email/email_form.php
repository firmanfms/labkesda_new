    <section class="content-header">
  <h1>
    KIRIM EMAIL
    <small>SEBAGAI PEMBERITAHUAN KEPADA CUSTOMER</small>
  </h1>
</section> 
<section class="content" >
  <div class="row">
    <div class="col-xs-8">
<div class="container">
    <?php echo validation_errors(); ?>
    <?php echo form_open('emailkirim', 'class="form-horizontal"'); ?>
    <div class="form-group">
        <label for="email" class="control-label col-sm-2">Email</label>
        <div class="col-sm-4">
            <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            <input type="submit" value="Submit" class="btn btn-primary">
        </div>
    </div>
    </form>
</div>
</DIV>
</div>
</section>