

  <?php if (isset($tabs)) {
    foreach ($tabs as $tab) :
  ?>
      <!--- tab repeat all -->
      <!--- tab repeat all -->
      <div id="<?php echo 'tabc_'.$tab->id; ?>" class=" tabcontent" style="display: none;">

         <div class="col-md-12  title-bar"  style="margin-bottom: 10px;" >
            <div class="row ">
          <div class="col-md-3 "  style="margin: 0px -18px; height:36px;">

            <a style="font-size: 18px; font-weight: 500; min-width: 50px; cursor: default; user-select: text; top: 7px;padding: 3px; padding-right: 11px;"><?php 
    if (isset($head)) {
          echo $head;
        } else echo ''; ?></a>

          

         
<!--           <a title="Dashboard home" class="iconic-links" href="<?php echo base_url("view/dashboard/" . base64_encode($tab->dash_id)) ?>"><i class='fa fa-home iconic'></i></a>
          <a title="Add new visualization" class="iconic-links" style="margin-left:0px" href="<?php echo base_url("add/visualizer/" . base64_encode($tab->id)) ?>"><i class='fa fa-plus iconic '></i></a>

          <a href="#" title="Comment" class="iconic-links" onclick="comment(<?php echo $tab->id ?>)"  style="margin-left:0px"><i class='fa fa-comment iconic float-right'></i></a>

          <a title="Edit Tab" class="iconic-links" href="<?php echo base_url("edit/tab/" . base64_encode($tab->dash_id)) ?>"><i class='fa fa-edit iconic'></i></a> -->




        </div>

 <div class="col-md-5" style="float:left" >
      <input  required type="text" minlength="2" maxlength="70" name="name<?php echo $tab->id; ?>" id="name<?php echo $tab->id; ?>" class="form-control" value="<?php echo $tab->name;?>">
    </div>
    <div style="float:left" class="col-md-1">
        <button type="button" onclick="delete_tab()" style="width: 100%;background-color: red;color:white" class="btn btn-danger">Delete</button></div>
 <div style="float:left" class="col-md-1">
        <button style="width: 100%;color:white" class="btn btn-secondary"><a style="text-decoration:none;color:white" href="<?php echo base_url('view/dashboard/' . base64_encode($dash_id)) ?>">Discard</a></button></div>

    <div style="float:left" class="col-md-1"><button style="
    width: 100%;background-color: #2c6693;" onclick="update_tab(<?php echo $tab->id; ?>)"  class=" btn btn-primary">Update</button></div>


        </div>

           </div>

        <!-- ./col -->

        <!-- repeat for all visualizers in this dashboard     -->

      
        </div>


  <script>

var data_array=[];

var gridstack;
 //  



function openTab(evt, id) {
   $('.btn_').css('background-color', 'rgb(243, 245, 247)')
   $('.btn_').css('color', 'black')
  $('#btn'+id).css('background-color', 'rgb(0, 121, 107)')
  $('#btn'+id).css('color', 'white')

     $('#dashcontent').empty()


     $('#dashcontent').append('<div   class="grid-stack" style="height:100%;width:100%">'+
                        '</div>');
    

  
   

  $.ajax({
        url: "<?php echo base_url("last_tab") ?>",
        type: "post",
        data:  {id:id},
        success: function (response) {
         
        },
        error: function(jqXHR, textStatus, errorThrown) {
         
        }
    });

// show the loader for clicked visualize if no related data
$('#innerTab'+id).css('display', 'block'); 

          $('#filterLoader').hide();

           $("#filterbtn").click(function(){

            $('#filterLoader').show(); 
          });

            $('#loader').show();
            $('#setting').hide();
            // $('#vis'+id).empty();
            // $('.single_data_'+id).empty();

            $('#applications'+id).empty();
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {

              tablinks[i].className = tablinks[i].className.replace(" active ", " ");
              tablinks[i].className = tablinks[i].className.replace(" active", " ");
            }

            // Show the current tab, and add an "dsdsdsdsdsds" class to the button that opened the tab
             document.getElementById('tabc_'+id).style.display = "block";



    // gridster = $("<?php echo "#vis".$tab->id; ?>").gridster({
    //         widget_base_dimensions: ['auto', 140],
    //         autogenerate_stylesheet: true,
    //         min_cols: 1,
    //         max_cols: 6,
    //         widget_margins: [5, 5],
    //         resize: {
    //                 enabled: true,
    //              stop: function (e, ui, $widget) {
    //         var newDimensions = this.serialize($widget)[0];

    //         // alert("New width: " + newDimensions.id);

    //         // $('#numb'+ newDimensions.id).width("100%")
    //         //  $('#numb'+ newDimensions.id).height("87%")

    //          var link='<?php echo base_url("edit/visualizer/") ?>';

    //          // console.log("The data array",data_array);
               
    //             update_visulizer(newDimensions.id,data_array[newDimensions.id],newDimensions.id,link);


    //     }


    //         },
    //         serialize_params: function ($w, wgd) {              
              
    //           return {
    //               /* add element ID to data*/
    //               id: $w.attr('id').replace('lis',''),
    //               /* defaults */
    //               col: wgd.col,
    //               row: wgd.row,
    //               size_x: wgd.size_x,
    //               size_y: wgd.size_y
    //           }

    //       },
    //     }).data('gridster');
    //  $("<?php echo "#vis".$tab->id; ?>").css({'padding': '0'});



  gridstack = GridStack.init({
                         cellHeight: '5vh',
                          // cellHeight: 'initial', // start square but will set to % of window width later
                          animate: true, // show immediate (animate: true is nice for user dragging though)
                          // disableOneColumnMode: true, // will manually do 1 column
                          float: true,
                          minRow: 1, 
                      });

   gridstack.on('resizestop', function( Event,GridItemHTMLElement) {
                  let id = GridItemHTMLElement.getAttribute('gs-id').replace('lis','')
                  // // or all values...
                  // let node: GridStackNode = el.gridstackNode; // {x, y, width, height, id, ....}

                // $('#numb'+ id).width("100%")
                //  $('#numb'+ id).height("87%")

             var link='<?php echo base_url("edit/visualizer/") ?>';

             // console.log("The data array",data_array);
               
                update_visulizer(id,data_array[id],id,link);

                  // console.log("The resize stop",id);
                
                });




      // gridster.remove_all_widgets();
  // gridster.destroy();
  // $('.gridster ul').empty();


   //start of default AJAX from selected Tab
               $.ajax({
    
                     url:"<?php echo base_url()?>view/visualizers/",
                     method: 'post',
                     data: {id: id},
                     cache: false,
                     success:function (data) { 
                        var link='<?php echo base_url("edit/visualizer/") ?>';

                        vs_id_array =edit_containers(data,id,link,gridstack);
                        
    
            },complete:function (data){
                         
                         $('#loader').hide();


                    var len = vs_id_array.length;


                          var j=0;

                           for (var i = 0; i < len; i++) {


                    // let vis = JSON.parse(data)['visualizers'][i];

                   

                         $.ajax({   
                               url: "<?php echo base_url()?>load/visualizers/",
                               method: "POST",
                               cache: false,
                               data: {
                                   vis_id:vs_id_array[i],                                       
                               },
                            
                                beforeSend: function(data){

                                 
                            
                             },
                  
                   success: function(data) {

                     // console.log("The id here",i);

                    // console.log('The i down here',vs_id_array[j]);
                
                  var link='<?php echo base_url("edit/visualizer/") ?>';


                  update_visulizer(id,data,vs_id_array[i],link);

                 data_array[vs_id_array[j]]=data;

                 j=j+1;




                    }
                
                })



       }

           }
       });
       //end Of default AJAX function from selected Tab 


       
       console.log("The array here", data_array);


    }

    <?php if (isset($_SESSION["last_tab"])){ if(!$_SESSION["last_tab"]==""){ ?> 

    window.onload = function(){
      openTab(event, '<?php echo $_SESSION["last_tab"]; ?>')
    }

  <?php } }?>
        
    function dimension_extract_container(item, index, arr) {


        dimension_object_container=dimension_object_container+'"'+index+'":"'+item+'",';
        // body...
    }
      
      

    function dimension_extract(item, index, arr) {
 

        dimension_object=dimension_object+'"'+index+'":"'+item+'",';
        // body...
    }


     function dimension_extract_translate(item, index, arr) {
 

        dimension_object_translate=dimension_object_translate+'"'+index+'":"'+item+'",';
        // body...
    }

    function delete_tab() {

        var id = '<?php echo base64_encode($tab->id) ?>'
        Swal.fire({
          title: 'Are you sure?',
          text: "This tab and all visualizers will deleted !",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {

         $.ajax({
             url: '<?php echo base_url()?>delete/tabs/'+id,
             type: 'DELETE',
             error: function() {
          
             },
             success: function(data) {
                location.href = "<?php echo base_url('view/dashboard/' . base64_encode($tab->dash_id)) ?>"
          
             }
          });
        
         
        }
        })  
        // body...
    }
      
 function update_tab(tab_id){

    var name=$("#name"+tab_id).val();

    var serialized = [];

    $('.grid-stack-item').each(function () {
        var $this = $(this);
        serialized.push({
            col: $this.attr('gs-x'),
            row: $this.attr('gs-y'),
            size_x: $this.attr('gs-w'),
            size_y: $this.attr('gs-h'),
            id:$this.attr('gs-id').replace('lis','')
            
        });
    });

        serialized=JSON.stringify(serialized);

      $.ajax({
        url: "<?php echo base_url("update/style") ?>",
        type: "post",
        data:  {style:serialized,name:name,tab_id:tab_id},
        success: function (response) {

            location.href = "<?php echo base_url('view/dashboard/' . base64_encode($dash_id)) ?>"
         
        },
        error: function(jqXHR, textStatus, errorThrown) {
         
        }
    });



   

  }

  $(document).ready(function() {
        // add style to selected tab
        var selectedDash = "<?php echo $dashboard->id ?>";
        $('#'+selectedDash+'').css({'border': '1px solid #2c6693', 'border-radius': '25px','border-style': 'groove','background-color':'#2c6693'})

        $('#link'+selectedDash+'' ).css({'color':'white'})

    });


</script>




<?php endforeach; }?>


<!-- the dash content -->

<div id="dashcontent" style="width:100%;height:100%"></div>  
</div>

