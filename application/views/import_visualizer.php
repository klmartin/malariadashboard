
        <div class="card row ">
          <form class="col-md-12" id="visForm" method="post" />
            <div class="row">
       
            <div class="col-md-6" style="margin:auto;">

            <fieldset class="form-group border p-3">

                <div class="form-group">
                      <h6> Title</h6>
                      <input autocomplete="off"  type="text" name="title" class="form-control">
                    </div>
            <legend class="w-auto px-2">Import</legend>
                            
                <h6>Type</h6>
                      <select id="type" class="form-control selectpicker">
                     <option value="visualizations">Visualizations</option>
                     <option value="PIVOT_TABLE">Pivot Tables</option>
                     <option value="Maps">Maps</option>
                  </select>

                     <h6> Select  </h6>
                      <select id="visualization" class="form-control selectpicker" data-live-search="true">
                     
                  </select>
  
                  <input hidden type="text" name="dash_id" value="<?php echo $tab->dash_id ?>" class="form-control">
                  <input hidden type="text" name="tab_id" value="<?php echo $tab->id ?>" class="form-control">
                  <div class="float-right form-group" style="margin-top: 17px;">
                  <button id="vis_Btn" type="submit" style="background-color: #2c6693;" class="btn btn-primary">Save</button>
                 
                  <i class="fa fa-spinner fa-spin" id="spinnvis" style="font-size:50px;color:#2c6675"></i>
                  
                </div> 


              </fieldset>



              </div>

           
          </form>

    
          </form>
        </fieldset>
<div aria-label="Content is loading..." aria-live="polite" role="progressbar" id="spinselect" class="dhis2loader"></div> 
              </div>


        </div>
<br> <br>
          <div class="card row ">
          <form class="col-md-12" id="appForm" method="post" />
            <h5 class="card-title"> New Application</h5>
            <div class="row">
        
                  <div class="col-md-6 col-sm124 col-xs-12 form-group">
                    <h6>Name</h6>
                    <input autocomplete="off" required type="text" name="name"  id="name" class="form-control">
                  </div>
                  
                  <div class="col-md-6 col-sm124 col-xs-12  form-group">
                  <h6>Link</h6>
                  <input autocomplete="off" required type="text" name="link" class="form-control">
                  </div>

                  <input hidden type="text" name="dash_id" value="<?php echo $tab->dash_id ?>" class="form-control">
                  <input hidden type="text" name="tab_id" value="<?php echo $tab->id ?>" class="form-control">
                   <div class="col-md-6 col-sm124 col-xs-12 form-group">
                    <table id="apptTable" class="table">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Link</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            if (isset($apps)) {
                          foreach ($apps as $app) : ?>
                          <tr id="<?php echo $app->id; ?>">
                            <td><?php echo $app->name; ?></td>
                            <td><?php echo $app->link; ?></td>
                            <td><a><i class="fa fa-trash col-md-12" onclick="delete_app(<?php echo $app->id; ?>)" tyle="margin-left: 10px;"></i></a></td>
                          </tr>
                           <?php endforeach;
                             }
                          ?>
                        </tbody>
       
                      </table>
                      </div>
                    </div>
              <div class="float-right">
              <a class='iconic' title="" href="<?php echo base_url("view/dashboard/" . base64_encode($tab->dash_id)) ?>">Back to Dashboard</a>

              <button type="submit" style="background-color: #2c6693;" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>

<div class="modal fade" id="period-modal" class="modal_data" style="display: none;">
  <div class="modal-dialog" style="display: table;">
    
<!--     <div class="modal-content">
      <input type="hidden" >
     
      <div class="modal-body">


 
    </div>
     </div> --> 
   </div> 
 </div>
</div>

<script>




$(document).ready(function() {
  $('.fa-spin').hide();
  $('#spinnormal').hide();
  $('#single').hide();
      $('#leftb').hide();
      $('#rightb').hide();
      $('#pvot').hide();
$('#period-modal').modal('toggle');

var val =$(this).find(':selected').val();   
      $('#spinselect').show();

        $('#period-modal').modal('toggle');
    $.ajax({
      url:"<?=base_url()?>view/visualizations",
      method: "POST",
      cache: false
    }).done(function(data) {

         
         let dataa = JSON.parse(data);
         var len = dataa['visualizations'].length;
          $('#visualization').append(
               '<option >Choose visualiser</option>'
             );
          for(let i=0; i<len; i++)
          {
          let obj = JSON.parse(data)['visualizations'][i];
           
           let text = obj.displayName
           if(text.length>50){
            text = text.substring(0, 50) + '....'
           }
             $('#visualization').append(
               '<option value="'+obj.id+'">'+text+'</option>'
             );

             $('#visualization').selectpicker('refresh');
             $('#spinselect').hide();
              $('#period-modal').modal('hide');

          }
    })
    
});

</script>

<script>

  

    
    $('#appForm').submit(function(e){
    e.preventDefault()
    var name = $("#name").val();
    var title = $("input[name=title]").val();
    var link = $("input[name=link]").val();
    var dash_id = $("input[name=dash_id]").val();
    var tab_id = $("input[name=tab_id]").val();

    $.ajax({
      url:"<?php echo base_url("create/applications") ?>",
      type:"POST",
      data:{
        name:name,
        link:link,
        dash_id:dash_id,
        tab_id:tab_id
      },
      success:function(response){

       
        if(response =='false'){
           console.log('response')
          Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Provide a full link',
        })

        }else
        {
           console.log(response)
        $('#apptTable tbody').prepend('<tr id="'+response+'"><td>'+name+'</td><td>'+link+'</td> <td><a><i class="fa fa-trash col-md-12" onclick="delete_app('+response+')" tyle="margin-left: 10px;"></i></a></td></tr>')
         
        }

      }
    })

  })
 // $("#vis_Btn").click(function(){
 //      $("#vis_Btn").hide();
 //      $('#spinnvis').show(); 

 //            });
 $("#normal_btn").click(function(){
      $("#normal_btn").hide();
      $('#spinnormal').show(); 

            });



    $('#visForm').submit(function(e){
    e.preventDefault() 
      var name = $("#name").val();
    var title = $("input[name=title]").val();
    var chart_type = $("#chart_type").val();
    var dash_id = $("input[name=dash_id]").val();
    var tab_id = $("input[name=tab_id]").val();
    var elementid = $("#visualization").val();
    var type = $("#type").val();


    var check=1;

     if(elementid==null || elementid=='Choose visualiser'){

      display_message("You must select visualizer map or pivot table")
      check=0;
     }



if(check){

        $("#vis_Btn").hide();
      $('#spinnvis').show(); 

    $.ajax({
      url:"<?php echo base_url("create/visualizer") ?>",
      type:"POST",
      data:{
        title:title,
        chart_type:chart_type,
        dash_id:dash_id,
        elementid:elementid,
        tab_id:tab_id,
        type:type
      },
      success:function(response){

       location.href = "<?php echo base_url('view/dashboard/' . base64_encode($tab->dash_id)) ?>"

      }
      // ,complete:function (response){
      //     $('.fa-spin').hide();
      //      $("#vis_Btn").show();
      //  Swal.fire({
      //   icon: 'success',
      //   title: 'Sucess...',
      //   text: 'Visualization imported succesfully!',
      //   showConfirmButton: false,
      //   timer: 1500
      //   }) 
      //       }
    })

  }

  })


function display_message(message){

  
  Swal.fire({
    title: 'Incomplete',
    text: message,
    icon: 'warning',
    // showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'OK!'
  }).then((result) => {
  if(result.isConfirmed) {
   // $.ajax({
   //     url: '<?php echo base_url()?>delete/applications/'+id,
   //     type: 'DELETE',
   //     error: function() {
   //        //alert('Something is wrong');
   //     },
   //     success: function(data) {

   //          $("#"+id).remove();
    
   //     }
   //  });

  }
  }) 
}

function delete_app(id){
  
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
  if(result.isConfirmed) {
   $.ajax({
       url: '<?php echo base_url()?>delete/applications/'+id,
       type: 'DELETE',
       error: function() {
          //alert('Something is wrong');
       },
       success: function(data) {

            $("#"+id).remove();
    
       }
    });

  }
  }) 
}

 $("#type").on('change', function(){
  var type =$("#type").val();
  $("#visualization").empty();

    $('#period-modal').modal('toggle');
$('#spinselect').show();
  if (type=="visualizations") {


        $.ajax({
      url:"<?=base_url()?>view/visualizations",
      method: "POST",
      cache: false
    }).done(function(data) {
     
         let dataa = JSON.parse(data);
         var len = dataa['visualizations'].length;
         
          $('#visualization').append(
               '<option value="0">Choose visualiser</option>'
             );
          for(let i=0; i<len; i++)
          {
          let obj = JSON.parse(data)['visualizations'][i];
           
             $('#visualization').append(
               '<option value="'+obj.id+'">'+obj.displayName+'</option>'
             );

             $('#visualization').selectpicker('refresh');

              $('#spinselect').hide();
               $('#period-modal').modal('hide');

          }

    })


  }
  if (type=="PIVOT_TABLE") {
        $.ajax({
      url:"<?=base_url()?>view/tables",
      method: "POST",
      cache: false
    }).done(function(data) {
         let dataa = JSON.parse(data);
         var len = dataa['reportTables'].length;
         
          $('#visualization').append(
               '<option >Choose visualiser</option>'
             );
          for(let i=0; i<len; i++)
          {
          let obj = JSON.parse(data)['reportTables'][i];
           
             $('#visualization').append(
               '<option value="'+obj.id+'">'+obj.displayName+'</option>'
             );

             $('#visualization').selectpicker('refresh');

              $('#spinselect').hide();
               $('#period-modal').modal('hide');

          }
    })

  }
  if (type=="Maps") {
        $.ajax({
      url:"<?=base_url()?>view/maps",
      method: "POST",
      cache: false
    }).done(function(data) {
      $('#spinselect').hide();
       $('#period-modal').modal('hide');
         let dataa = JSON.parse(data);
         console.log(dataa)
         var len = dataa['maps'].length;
         
          $('#visualization').append(
               '<option >Choose visualiser</option>'
             );
          for(let i=0; i<len; i++)
          {
          let obj = JSON.parse(data)['maps'][i];
           
             $('#visualization').append(
               '<option value="'+obj.id+'">'+obj.displayName+'</option>'
             );

             $('#visualization').selectpicker('refresh');

              $('#spinselect').hide();
               $('#period-modal').modal('hide');

          }
    })

  }

 })

  // $('#multiselect').multiselect();


$(document).ready(function() {
  $('.fa-spin').hide();
  $('#spinnormal').hide();
  $('#single').hide();
      $('#leftb').hide();
      $('#rightb').hide();
      $('#pvot').hide();

var val =$(this).find(':selected').val();   


    
});

</script>



</script>

<style>
   @media screen and (min-width: 676px) {
      .modal-dialog {
        max-width: 600px;
        /* New width for default modal */
      }
    }

    .scrollable{
  overflow-y: auto;
  max-height: 70px;
}
</style>
