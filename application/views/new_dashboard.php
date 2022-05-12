<div class="card row "  style="
    margin-top: 23px;
">
  <form class="col-md-6" class="add-new-dashboard" style="margin:auto; " action="<?php echo base_url("add/new_dashboard") ?>" method="post" />
  <div class="row">


    <div class="col-md-12 col-sm124 col-xs-12 form-group">
      <h5 style="color: #5f5a5a;"><strong>Name</strong></h5>
      <input autocomplete="off" required type="text" minlength="2" maxlength="70" name="name" class="form-control">
    </div>


</div>

<div class="row">


    <div class="col-md-12  form-group" style="">
      <h5 style="color: #5f5a5a;"><strong>Description</strong></h5>
      <textarea autocomplete="off"  type="text"  minlength="2" maxlength="100" name="description" class="form-control"></textarea>
    </div>



</div>


<div class="row">
    <div class="col-md-12  form-group">
      
      <div class="float-right">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
      <button type="submit" class="btn btn-primary"  onclick="myAlertTop()">Save</button>
    </div>

  </div>

  </div>


  

  </form>
</div>
</div>


  <div>