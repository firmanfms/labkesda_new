<div class="app-title">
  <div>
    <h1>Input Items</h1>
    <p><ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>welcome">Home</a></li>
        <li class="breadcrumb-item">Master</li>
        <li class="breadcrumb-item">Items</li>
        <li class="breadcrumb-item active">Input Items</li>
  </ul></p>
  </div>
  <!-- <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a class="btn btn-secondary" href="<?php echo base_url(); ?>master/items">Back</a></li>
  </ul> -->
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
        <form class="form-horizontal">
          <div class="form-group row">
            <label class="control-label col-md-2">Group Code</label>
            <div class="col-md-2">
              <select class="form-control" id='items_kind'>
                <option value=""> - </option>
                <?php 
                foreach ($data_items_kind as $key => $value) {
                  echo '<option data-kind="'.$value->items_kind.'" value="'.$value->items_kind_name.'">'.$value->items_kind_name.'</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2">Name</label>
            <div class="col-md-8">
              <input class="form-control col-md-8" type="text" placeholder="Name Items" id="name">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2">Unit</label>
            <div class="col-md-2">
              <select class="form-control" id='unit'>
                <option value=""> - </option>
                <?php 
                foreach ($data_items_unit as $key => $value) {
                  echo '<option value="'.$value->items_unit_id.'">'.$value->items_unit_name.'</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2">Group Items</label>
            <div class="col-md-2">
              <select class="form-control" id='items_group'>
                <option value=""> - </option>
                <option value="consumable"> Consumable </option>
                <option value="inventory"> Inventory </option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2">Category Items</label>
            <div class="col-md-5">
              <select class="form-control" id='category'>
                <option value=""> - </option>
                <?php 
                foreach ($data_category as $key => $value) {
                  echo '<option value="'.$value->items_category_id.'">'.$value->items_category_name.'</option>';
                }
                ?>
              </select>
              <!-- <input class="form-control col-md-5" type="text" placeholder="Category Items" id="category"> ex : Besi, Kayu, Komputer dll -->
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2">Dept Authorized</label>
            <div class="col-md-5">
              <select class="form-control" id='dept_authorized'>
                <option value=""> - </option>
                <option value="0">NONE</option>
                <?php 
                foreach ($data_authorized as $key => $value) {
                  echo '<option value="'.$value->id_user_group.'">'.$value->name.'</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2">Info</label>
            <div class="col-md-8">
              <input class="form-control col-md-8" type="text" placeholder="Info Items" id="info">
            </div>
          </div>
        </form>
      </div>
      <div class="tile-footer">
        <div class="row">
          <div class="col-md-8 col-md-offset-3">
            <button class="btn btn-primary" type="button" id="save"><i class="fa fa-floppy-o"></i> Save</button>&nbsp;&nbsp;&nbsp;
            <a class="btn btn-secondary" href="<?php echo base_url(); ?>master/items"></i><i class="fa fa-reply"></i> Cancel</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$("#items_kind").select2({
  placeholder: 'Select a Group Code',
  allowClear: true});

$("#items_group").select2({
  placeholder: 'Select a Group Items',
  allowClear: true
});

$("#unit").select2({
  placeholder: 'Select a Unit',
  allowClear: true
});

$("#category").select2({
  placeholder: 'Select a Unit',
  allowClear: true
});

$("#dept_authorized").select2({
  placeholder: 'Select a Dept Authorized',
  allowClear: true
});

$('#save').click(
  function(e){
    e.preventDefault();

    if(!$('#items_kind').val()){
      $.notify({
        title: "Erorr : ",
        message: "Group Code Can't Be Empty",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $('#items_kind').select2('open');
      return false;
    }

    if(!$('#name').val()){
      $.notify({
        title: "Erorr : ",
        message: "Items Name Can't Be Empty",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $("#name").focus();
      return false;
    }

    if(!$('#unit').val()){
      $.notify({
        title: "Erorr : ",
        message: "Items Unit Can't Be Empty",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $('#unit').select2('open');
      return false;
    }

    if(!$('#items_group').val()){
      $.notify({
        title: "Erorr : ",
        message: "Items Group Can't Be Empty",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $('#items_group').select2('open');
      return false;
    }

    if(!$('#category').val()){
      $.notify({
        title: "Erorr : ",
        message: "Items Category Can't Be Empty",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $('#category').select2('open');
      return false;
    }

    if(!$('#dept_authorized').val()){
      $.notify({
        title: "Erorr : ",
        message: "Dept Authorized Can't Be Empty",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $('#dept_authorized').select2('open');
      return false;
    }

    if(!$('#info').val()){
      $.notify({
        title: "Erorr : ",
        message: "Items Info Can't Be Empty",
        icon: 'fa fa-times' 
      },{
        type: "danger",
        delay: 1000
      });
      $('#info').focus();
      return false;
    }

    
    
    $.ajax({
      url: baseUrl+'master/items/form_act',
      type : "POST",  
      data: {
        code    : $('#items_kind').val(),
        kind    : $('#items_kind option:selected').attr('data-kind'),
        name    : $('#name').val(),
        unit    : $('#unit').val(),
        group   : $('#items_group').val(),
        info    : $('#info').val(),
        category: $('#category').val(),
        dept_authorized: $('#dept_authorized').val()
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
            message: 'Data has been saved successfully'
          },{
            type: 'info'
          });

          setTimeout(function () {
            window.location.href = baseUrl+'items/'; //will redirect to google.
          }, 2000);
        }
      }
    });

  }
);
</script>