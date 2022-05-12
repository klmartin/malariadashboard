
<div class="row"  style="padding:15px">

  <?php if (isset($dashboard)) { ?>
    <?php foreach ($dashboard as $dash) : ?>

     
      <div class="col-md-3" style="padding:15px;">
        <div class="card">
          <div>

      <?php if ($dash->status ==1) { ?> 

         <h3 class="dashboard-header" >  <a href="<?php echo base_url('malariabulletin') ?>"><?php echo $dash->name ?></a> </h3> 
      
        <?php } else {  ?>

        <h3 class="dashboard-header" >  <a href="<?php echo base_url('/main/open_dash/'.base64_encode($dash->id)).'/'.$session[0].'/'.$session[1].'/'.$session[2] ?>"><?php echo $dash->name ?></a> </h3> 

        <?php  }  ?>

           
<?php if (isset($_SESSION["admin"])){ if($_SESSION["admin"]){ ?>   
               <div class="float-right" style="margin-top: -40px;">
             <a href="<?php echo base_url('edit/dash/' . base64_encode($dash->id)) ?>"><i class="fa fa-edit"></i></a>
            </div>

<?php } }?>
        </div>
        <?php if ($dash->status ==1) { ?>

           <a class="dashboard-card-links" style="text-decoration:none;" href="<?php echo base_url('bulletin') ?>">

        <?php } else{ ?>

           <a class="dashboard-card-links" style="text-decoration:none;" href="<?php echo base_url('main/open_dash/'.base64_encode($dash->id)).'/'.$session[0].'/'.$session[1].'/'.$session[2] ?>">

        <?php } ?>
         
           
          <p><?php echo $dash->description; ?></p>

          </a> 
           
         
        </div>
       
      </div>
  <?php endforeach;
  }
  ?>

<?php if (isset($_SESSION["admin"])){ if($_SESSION["admin"]){ ?> 
  <div  class="col-md-3" style="padding:15px;">
     
    <a style="text-decoration:none;color:rgb(1,184,170)" href="<?php echo base_url('add') ?>">
      <p style="font-size:20px; text-align:center"> <b style="font-size:50px;">+</b><br> Add New</p>
    </a>


  </div>
<?php } }?>

</div>
</div>

<script>
  // header("Access-Control-Allow-Origin: *");
 

</script>