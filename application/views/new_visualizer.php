
        <div class="card row " style="margin: -10px 5px;">


              <div class="col-md-12 col-sm124 col-xs-12 form-group">

              
              <fieldset class="form-group border p-3">  
              <legend class="w-auto px-2">Create</legend>

                <form id="normalForm" method="post">

                   <div class="form-row">
                    <div class="form-group col-md-6">
                      <h6>Title</h6>
                      <input autocomplete="off"  type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                       <h6>Select chart type</h6>
                    <select id="chart_type" class="select2 form-control" name="chart_type" style="width: 100%;" >
                      <option value="">2 Charts numbers and Percentage</option>
                      <option value="1">1 Chart</option>
                     
                    </select>
                                <!-- </select> -->
                                <!-- create goes here -->    
                    </div>
                  </div>

                   <div  class="form-row">
                    <div id="data-elements" class="form-group col-md-6">
                      
                       <select name="dataType" class="form-control selectpicker" style="width: 100%;">
                            <option value="0"> Select type  </option>
                            <option value="1">Indicators</option>
                            <option value="2">Data elements</option>
                            <option value="3">Data sets</option>
                            <option value="4">Program Indicators</option> 
                        </select>
                      
                    </div>
                    <div id="indi-groupss" class="form-group col-md-6">
                      
                       <select id="indi-groups" name="dataType" class="form-control selectpicker" data-live-search="true" style="width: 100%;">
                            <option value="0">  Select an Indicator Group  </option>
                           
                          </select>

                    </div>
                  </div>
                  <div  class="form-group">
                    
                      
                    </div>
                     <div class="row">
  <div class="form-group col-md-6">
     <h6>Available
         <input type="text" id="search" name="search" class="search-hover fas fa-search"  placeholder="&#xf002;"  onkeyup="StellaAnatakakuFilter() ">
     </h6>
    
    

    <select name="from" id="multiselect" class="form-control " size="8" multiple="multiple" style="width: 100%;">
     
    </select>
  </div>
  
  <div class="form-group col-md-6">
     <h6>Selected</h6>
    <select id="multiselect_to" name="to"  class="form-control multiselect_to" size="8" multiple="multiple" style="width: 100%;">

    </select>
  </div>

   <div  class="form-group col">              
  <button type="button" onclick="openLayoutModal()" style="border: 1px solid rgb(160, 173, 186);" class="btn btn-light">Layout</button>
  </div>

  <div  class="form-group col">  

    <button type="button" onclick="openorgunitModal()" style="border: 1px solid rgb(160, 173, 186);" class="btn btn-light">Organization Units</button>
    </div>

    <div  class="form-group col-md-6">
     
      <button onclick="period_filter()" style="border: 1px solid rgb(160, 173, 186);" type="button" class="btn btn-light">Period</button>
    </div>
</div>
                   
  
      <input hidden type="text" name="dash_id" value="<?php echo $tab->dash_id ?>" class="form-control">
      <input hidden type="text" name="tab_id" value="<?php echo $tab->id ?>" class="form-control">

         <div class="float-right form-group" style="margin-top: 17px;">
          <button id="normal_btn" type="submit" style="background-color: #2c6693;" class="btn btn-primary">Create</button>
          <i class="fa fa-spinner fa-spin" id="spinnormal" style="font-size:50px;color:#2c6675"></i>
      </div>     
      
      <!-- organization units modal -->

         <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class=" modal-header jss222 " > <h6>Organization units</h6> </div>
            
              <div class="modal-body">
                <div class="jss259"   style="width: 550px; min-height: 48px;">
                  <div class style="border: 1px solid rgb(222, 222, 222); position: relative;" ></div> 



                  <!-- small section goes here -->

                          <div style="border: 1px solid rgb(222, 222, 222); position: relative;">
                             <div style="height: 400px; overflow-y: auto; padding-bottom: 40px;">
                                <div style="padding-left: 18px; background: rgb(244, 245, 248); margin: 0px 0px 10px; user-select: none;">
                                   <div class="jss260 jss268">
                                      
                                    <!-- table heading for user selected organization unit -->
                                     
                                   </div>
                                </div>
                                <div style="position: relative; padding-left: 20px; user-select: none;">
                                 
                                  <div id="treeview_container" class="hummingbird-treeview">

                                  <ul id="treeview" class="hummingbird-base" >

                                  <li  style="list-style-type:none;"> 
                                    <i class="fa fa-folder bluefoldericon"></i>
                                    <label>
                                    <input name="region" value="UNSNiNqkzEM" data-id="UNSNiNqkzEM" type="checkbox" class="hummingbird-end-node" /> Zanzibar
                                    </label>
                           
                                    <ul>

                                      <li>
                                        <i class="fa fa-folder bluefoldericon" onclick="dis_1('lHwuEQcm5Nc')"></i>
                                        <label>
                                        <input name="region" value="lHwuEQcm5Nc" data-id="lHwuEQcm5Nc" type="checkbox" class="hummingbird-end-node" /> Pemba
                                        </label>

                                        <ul class="districtsdrop">
                                        </ul>

                                      </li>

                                      <li>

                                        <i class="fa fa-folder bluefoldericon" onclick="dis_2('l9kxy7vLv6t')" ></i>
                                        <label>
                                        <input name="region" value="l9kxy7vLv6t" data-id="l9kxy7vLv6t" type="checkbox" class="hummingbird-end-node" /> Unguja
                                        </label>
                                        <ul class="districtsdrop2" >
                                        </ul>
                                      </li>
                                    </ul>
                                          </li>

                                        </ul>

                                   </div>
                                
                                </div>
                             </div>
                             <div style="text-align: center; position: absolute; bottom: 10px; left: calc(50% - 85px);"></div>
                          </div>
                  <!-- small section ends here -->
                  <!-- next section after the small section -->
                  <div class="form-row">
                    <div class="col">
                      <label for="orglevels">Level</label>
                      <select id="orglevels" class="form-control selectpicker" multiple data-live-search="true">
                     
                      </select>
                    </div>
                    <div class="col">
                      <label for="orggroups1">Group</label>
                      <select id="orggroups1" class="form-control selectpicker" multiple data-live-search="true">
                      
                      </select>
                    </div>
                  </div>
                  <!-- that section ends here -->
               
              </div>
              <div class="modal-footer">
             
                <button onclick="close_organization_modal(event)" style="border: 1px solid rgb(160, 173, 186);" class="btn btn-light">Update</button>
              </div> 
          
            </div>
          </div>
        </div>
      </div>
      <!-- end of organization units modal -->

      <!-- layout modal Starts here -->
       <div class="modal fade" id="layout_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class=" modal-header jss222 " > <h6>Chart Layout</h6> </div>
            
              <div class="modal-body">
                <div class="jss259"   style="width: 550px; min-height: 48px;">
                  <div class="style="border: 1px solid rgb(222, 222, 222); position: relative;" ></div> 


                  <div class="form-row">
                  

                  <div class="col">
                    <div style="height: 215px;" class="w-100">
                       <div style="border: 1px solid rgb(222, 222, 222); position: relative;">
                   <div class="containment" id="droppable" style="height: 200px; overflow-y: auto; padding-bottom: 40px;">
                      <div style="padding-left: 18px; background: rgb(244, 245, 248); margin: 0px 0px 10px; user-select: none;">
                         <div class="jss260 jss268">
                          Filters
                          <!-- table heading for user selected organization unit -->
                         </div>
                      </div>
                      <div style="position: relative; padding-left: 20px; user-select: none;">
                      
                     <div id="draggable" class="layout-item">
                      <img class="content-image" src="<?php echo base_url('/assets/images/tree.png')?>">

                       <div class="content" style="color:black;" >

                        OU
                        
                       </div>
                     </div>

                      <div id="draggable2" class="layout-item">
                      <img class="content-image" src="<?php echo base_url('/assets/images/period.png')?>">

                       <div class="content" style="color:black;" >
                         Period
                       </div>
                     </div>
                      
                      </div>
                   </div>
                   <div style="text-align: center; position: absolute; bottom: 10px; left: calc(50% - 85px);"></div>
                  </div>
                    </div>

                    <div  class="w-100">
                       <div style="border: 1px solid rgb(222, 222, 222); position: relative;">
                   <div id="droppable2" style="height: 185px; overflow-y: auto; padding-bottom: 40px;">
                      <div style="padding-left: 18px; background: rgb(244, 245, 248); margin: 0px 0px 10px; user-select: none;">
                         <div  class="jss260 jss268">
                          Rows
                          <!-- table heading for user selected organization unit -->
                           
                         </div>
                      </div>
                      <div style="position: relative; padding-left: 20px; user-select: none;">
                      
                      <div id="draggable3" class="layout-item">
                        <img class="content-image" src="<?php echo base_url('/assets/images/data.png')?>">
                       <div class="content" style="color:black;" >
                         Data
                       </div>
                     </div>
                      
                      </div>
                   </div>
                   <div style="text-align: center; position: absolute; bottom: 10px; left: calc(50% - 85px);"></div>
                  </div>
                    </div>
                 

                  </div>

                  <div class="col">
                                      <div style="border: 1px solid rgb(222, 222, 222); position: relative;">
                   <div id="droppable3" style="height: 400px; overflow-y: auto; padding-bottom: 40px;">
                      <div style="padding-left: 18px; background: rgb(244, 245, 248); margin: 0px 0px 10px; user-select: none;">
                         <div class="jss260 jss268">
                            Columns/Series
                          <!-- table heading for user selected organization unit -->
                           
                         </div>
                      </div>
                      <div style="position: relative; padding-left: 20px; user-select: none;">
                      
                     
                      
                      </div>
                   </div>
                   <div style="text-align: center; position: absolute; bottom: 10px; left: calc(50% - 85px);"></div>
                  </div>
                  </div>
                   </div>
                  <!-- small section goes here -->

                         
                  <!-- small section ends here -->
                
               
              </div>
              <div class="modal-footer">
             
                <button onclick="close_layout_modal(event)" style="border: 1px solid rgb(160, 173, 186);" class="btn btn-light">Update</button>
              </div> 
          
            </div>
          </div>
        </div>
      <!-- layout modal ends here -->
   

      <!-- modAL ENDS HERE -->

      </div>

                      <div class="modal fade" id="period-modal" class="modal_data" style="display: none;">
  <div class="modal-dialog" style="display: table;">
    <div class="modal-content">
      <!-- <input type="hidden" > -->
      <div class="modal-header" style="margin-left: 15px;border-bottom: 1px solid #e9ecef00;  border-top-left-radius: .3rem; border-top-right-radius: .3rem; margin-bottom: -34px;   font-weight: bold;"> 
      </div>
      <div class="modal-body">
        <!-- comments -->
        <div><button id="relative_updated_vis_btn" type="button" style="cursor: pointer;" class="jsx-2633868236 nav-button active relative-btn">Relative periods</button>
          <button id="fixed_updated_vis_btn" type="button" style="cursor: pointer;" class="jsx-2633868236 nav-button fixed-btn" >Fixed periods</button>
        </div>
        <div style="display: flex; margin-top: 18px;">
          <!-- filter goes here -->
          <div class="jsx-3712983878 item-selector-container">
            <!-- simple filter goes here-->
            <div class="jsx-3712983878 section unselected">
              <!-- simple time goes here -->
              <div   class="jsx-1845473585 options-area">
                <!-- simple -->
                <div class="jss201" id="simple_period_type">
                  <label class="jss260 jss264 jss249 jss254 jss257 jss256 jss248" data-shrink="true" for="period-type"></label>
                  <div class="jss16 jss3 jss17 jss4">
                    <div class="col sub_simple_period_type" style="padding-left: 7px;padding-bottom: 10px;font-size: x-small;">
                      <label for="title" style="color: #595959;">Period type</label>
                      <select name="periodType" id="periodType" class="form-control" style="border: 1px solid #ced4da47;font-size: 1rem;padding-left: 0px;color: black;">
                        <?php
                          echo getPeriodType();
                          foreach (getPeriodType() as $key => $value) { ?>
                        <option value="<?= $value['id'] ?>"> <?= $value['name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- simple ends -->
                <!-- complex starts -->
                <div class="jss201" id="complex_period_type" style="display: table-cell;display: block ruby;">
                  <label class="jss260 jss264 jss249 jss254 jss257 jss256 jss248" data-shrink="true" for="period-type"></label>
                  <div class="jss16 jss3 jss17 jss4">
                    <div class="col sub_complex_period_type" style="display:none;padding-left: 7px;padding-bottom: 10px;font-size: x-small;">
                      <label for="title" style="color: #595959;">Period type</label>
                      <select name="periodExtType" id="periodExtType" class="form-control" style="border: 1px solid #ced4da47;font-size: 1rem;padding-left: 0px;color: black;">
                        <?php
                          echo getExtendedPeriodType();
                          foreach (getExtendedPeriodType() as $key => $value) { ?>
                        <option value="<?= $value['id'] ?>"> <?= $value['name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <!-- case 2 -->
                  <label class="jss260 jss264 jss249 jss254 jss257 jss256 jss248" data-shrink="true" for="period-type"></label>
                  <div class="jss16 jss3 jss17 jss4">
                    <div class="col sub_complex_period_type" style="display:none;padding-left: 7px;padding-bottom: 10px;font-size: x-small;">
                      <label for="title" style="color: #595959;">Year</label>
											<input type="number"  min="1900" max="3000" oninput="Auto_change_fixed_period_type()"  value="" id="year_period" class="form-control" style="border: 1px solid #ced4da47;max-width: 88px;
                        padding-left: 10px;font-size: 1rem;padding-left: 0px;color: black;"> 
                    </div>
                  </div>
                </div>
                <!-- complex ends -->
              </div>
              <div class="jsx-2016409548 unselected-list-container">
                <label class="label loading-label label-primary" style="display:none;margin-left: 13px;margin-top: 17px;font-size: small;color: rgba(161, 76, 25, 0.92);">Loading...</label>
                <ul class="jsx-2016409548 unselected-list sub_period_list">                 
                  <!-- SUB PERIO DENDS HERE -->
                </ul>
              </div>
              <div class="jsx-2016409548 select-all-button"><button style="cursor: pointer;" class="jss301 jss275 jss277 jss280 select_all_btn" onclick="Selected__all_items()" tabindex="0" type="button"><span  class="jss276">Select all</span><span class="jss306"></span></button></div>
              <div class="jsx-2016409548 select-highlighted-button">
                <button class="jsx-2259338575 arrow-button" onclick="filter_adder()">
                  <span class="jsx-2259338575 arrow-icon" >
                    <svg class="jss38" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
                      <path fill="none" d="M0 0h24v24H0z"></path>
                      <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"></path>
                    </svg>
                  </span>
                </button>
              </div>
            </div>
            <div class="jsx-3712983878 section unselected" style="display:none">
              <div class="jsx-1845473585 options-area">
                <div class="jss201"  id="simple_period_type">
                  <label class="jss260 jss264 jss249 jss254 jss257 jss256 jss248" data-shrink="true" for="period-type"></label>
                  <!-- simple -->
                  <div class="jss16 jss3 jss17 jss4"   >
                    <div class="col" style="padding-left: 7px;padding-bottom: 10px;font-size: x-small;">
                      <label for="title" style="color: #595959;">Period type</label>
                      <select name="periodType" id="periodType" class="form-control" style="border: 1px solid #ced4da47;font-size: 1rem;padding-left: 0px;color: black;">
                        <?php
                          echo getPeriodType();
                          foreach (getPeriodType() as $key => $value) { ?>
                        <option value="<?= $value['id'] ?>"> <?= $value['name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="jsx-2016409548 unselected-list-container">
                <label class="label loading-label label-primary" style="display:none;margin-left: 13px;margin-top: 17px;font-size: small;color: rgba(161, 76, 25, 0.92);">Loading...</label>
                <ul class="jsx-2016409548 unselected-list sub_period_list">
                  <!-- SUB PERIOD GOES HERE -->
                  <!-- SUB PERIO DENDS HERE -->
                </ul>
              </div>
              <div class="jsx-2016409548 select-all-button"><button style="cursor: pointer;" class="jss301 jss275 jss277 jss280 select_all_btn" onclick="Selected__all_items()" tabindex="0" type="button"><span  class="jss276">Select all</span><span class="jss306"></span></button></div>
              <div class="jsx-2016409548 select-highlighted-button">
                <button class="jsx-2259338575 arrow-button" onclick="filter_adder()">
                  <span class="jsx-2259338575 arrow-icon" >
                    <svg class="jss38" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
                      <path fill="none" d="M0 0h24v24H0z"></path>
                      <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"></path>
                    </svg>
                  </span>
                </button>
              </div>
            </div>
            <div class="jsx-3712983878 section selected">
              <div class="jsx-1406043597 subtitle-container"><span class="jsx-1406043597 subtitle-text">Selected Data</span></div>
              <ul class="jsx-1406043597 selected-list  selected_sub_period_list">
              </ul>
              <div class="jsx-1406043597 deselect-all-button"><button style="cursor: pointer;" class="jss301 jss275 jss277 jss280 empty_selected" onclick="empty_Selected_items()" tabindex="0" type="button"><span class="jss276">Deselect All</span><span class="jss306"></span></button></div>
              <div class="jsx-1406043597 deselect-highlighted-button">
                <button class="jsx-2259338575 arrow-button"  onclick="remove_item_from_filter()">
                  <span class="jsx-2259338575 arrow-icon" >
                    <svg class="jss38" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
                      <path fill="none" d="M0 0h24v24H0z"></path>
                      <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"></path>
                    </svg>
                  </span>
                </button>
              </div>
            </div>
          </div>
         
        </div>
      </div>
      <div class="row">
        <div class="col-md-12  form-group">
          <div class="float-right">
            <button type="button" class="btn btn-light pull-left" style="border: 1px solid rgb(160, 173, 186);" onclick="cancel_PeriodmodalWithSave(event)">Update</button>
            <!-- <button  onclick="global__filter()"  type="button" class="btn btn-success"  >Save</button> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
                        
          </div>
          </form>
        </fieldset>

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
    </div>

    <div class="row float-right" style="margin-right:20px">
  <a class="iconic"  href="<?php echo base_url('home')?>" style="margin-left:20px; margin-top:20px; border-style" >Back to Home</a>
<div> 





<script>

  // disables text selection on sortable, draggable items 
$( ".multiselect_to" ).sortable();
$( ".multiselect_to" ).disableSelection();

$( function() {
    $( "#draggable, #draggable2, #draggable3" ).draggable({zIndex: 223232,containment: $('document'),helper: 'clone'});
   
   
    $( "#droppable2, #droppable, #droppable3" ).droppable({
  
      drop: function( event, ui ) {

        var text = ui.draggable.text().trim();
        var id = ui.draggable.attr('id');
        var image = ui.helper.children()[0].outerHTML
        $("#" + id).remove()
       
         $('#'+this.id).append('<div id="'+ id +'" class="layout-item"> '+image+' <div class="content" style="color:black;" > '+ text +' </div></div>');
         $("#" + id).draggable({ revert: 'invalid' });
      }
     
     
    });

  } );


  function StellaAnatakakuFilter(){
    console.log('hello');
    // Declare variables
       
        var keyword = document.getElementById("search").value;
        var filteredInput = keyword.toUpperCase();
       
        var select = document.getElementById("multiselect");
        for (var i = 0; i < select.length; i++) {
            var txt = select.options[i].text;
           
            // if (!txt.match(keyword)) {
              if (txt.toUpperCase().indexOf(filteredInput) > -1) {
                $(select.options[i]).removeAttr('disabled').show();
            } else {
              $(select.options[i]).attr('disabled', 'disabled').hide();
               
            }

        }
  }

 $("#treeview").hummingbird();
  var ListGroup = {"id" : [], "dataid" : [], "text" : []};
  var ListGroupOld = {};
  var List = {"id" : [], "dataid" : [], "text" : []};
  $("#treeview").on("CheckUncheckDone", function(event, args){
      
    $("#treeview").hummingbird("getChecked",{list:ListGroup,onlyEndNodes:true,onlyParents:false,fromThis:false});
     console.log(ListGroup)
     ListGroupOld = ListGroup;

    });

  function openorgunitModal(){
    $('#exampleModalCenter').modal('toggle');
  }

  function cancel_PeriodmodalWithSave(event){
      event.preventDefault(); 
  
   $('#period-modal').modal('hide');

  }

  function openLayoutModal(){
    $('#layout_modal').modal('toggle');
  }

  function close_organization_modal(event){
    event.preventDefault();
    $("#exampleModalCenter").modal('hide');
  }

  function dis_1(id){

        $('.districtsdrop').empty()
        var region = id;
   
      $.ajax({
        url:"<?=base_url()?>view/districts",
        method: "POST",
        cache: false,
        data: 'region=' + region
      }).done(function(district) {
       // //console.log(district);
        district = JSON.parse(district);
        // result = district.id
        district.forEach(function(district) {
          $(".districtsdrop").append(' <li><i class="fa fa-folder bluefoldericon" onclick="cc(\''+district.id+'\')" ></i><label><input name="district" value="'+district.id+'" data-id="custom-1-1" data-i="" type="checkbox" class="hummingbird-end-node" /> '+district.name+'</label>  <ul class="clinicssdrop'+district.id+'"</ul> </li> ')
        })
       
      })

  }

  function dis_2(id){
  $('.districtsdrop2').empty()
          var region = id;

  $.ajax({
  url:"<?=base_url()?>view/districts",
  method: "POST",
  cache: false,
  data: 'region=' + region
  }).done(function(district) {

  district = JSON.parse(district);
    
    
      district.forEach(function(district) {
        $(".districtsdrop2").append('<li><i class="fa fa-folder bluefoldericon" onclick="cc(\''+district.id+'\')" ></i><label><input name="district" value="'+district.id+'" data-id="" type="checkbox" class="hummingbird-end-node" /> '+district.name+'</label>  <ul class="clinicssdrop'+district.id+'"</ul> </li> ')
  })

  })

  }


 function cc(id){
   
    $('#clinicssdrop'+id+'').empty();

    var district = id;

     $.ajax({
      url:"<?=base_url()?>view/clinics",
      method: "POST",
      data: 'district=' + district,
      beforeSend: function() {

        },
      success: function(clinic) {
     
          clinic = JSON.parse(clinic);
          
          clinic.forEach(function(clinic) {
            $('.clinicssdrop'+district).append(' <li style="list-style-type:none;" id="'+clinic.id+'" > <i class="fas "></i><label><input name="clinics" value="'+clinic.id+'"  data-id="custom-1-1" data-id="" type="checkbox" class="hummingbird-end-node" /> '+clinic.name+'</label> </li>')
          })

        },
      complete: function(data) {  

          // alert('am done.')    

        }
    
    })

 
 }



$(document).ready(function() {


   $.ajax({
        url:"<?=base_url()?>view/organizationGroups",
        method: "POST",
        cache: false
        // data: 'region=' + region
      }).done(function(orgGroups) {
        
        var orgGroups = JSON.parse(orgGroups)['organisationUnitGroups'];
       
        for (var i = orgGroups.length - 1; i >= 0; i--) {
          var obj = orgGroups[i];
          $("#orggroups1").append(' <option value=" '+obj.id+' "> '+obj.displayName+' </option>')
             $("#orggroups1").selectpicker('refresh');
        }
        
    })
  
     $.ajax({
        url:"<?=base_url()?>view/organizationLevels",
        method: "POST",
        cache: false
        // data: 'region=' + region
      }).done(function(orgLevels) {
        
        var orgLevels = JSON.parse(orgLevels)['organisationUnitLevels'];
       
        for (var i = orgLevels.length - 1; i >= 0; i--) {
          var obj = orgLevels[i];
          $('#orglevels').append(' <option value=" '+obj.id+' "> '+obj.displayName+' </option>')
             $('#orglevels').selectpicker('refresh');
        }
        
    })


  $('.fa-spin').hide();
  $('#spinnormal').hide();
  $('#single').hide();
      $('#leftb').hide();
      $('#rightb').hide();
      $('#pvot').hide();

var val =$(this).find(':selected').val();   
    
});

</script>

<script>

  $("#data-elements").on('change', function(){
    $('#indi-groups').empty();
    var val =$(this).find(':selected').val();

    if (val ==1) {
       $.ajax({
          url:"<?php echo base_url()?>get/indicatorsGroups",
          method: 'POST',
          cache: false,
          success:function (data) 
          { 
            

            $('#loader').hide();
            var len = JSON.parse(data)["indicatorGroups"].length
           
              for(let i=0; i<len; i++)
              {
              let obj = JSON.parse(data)['indicatorGroups'][i];
               
                 $('#indi-groups').append(
                   '<option value="'+obj.id+'">'+obj.displayName+'</option>'
                 );

                 $('#indi-groups').selectpicker('refresh');
                 $('#ind').show();
              }
            } 
            });

   $("#indi-groupss").on('change', function(){
        $('#multiselect').empty()


       var val =$(this).find(':selected').val();
       
       $.ajax({
            url:"<?php echo base_url()?>get/indicators",
            method: 'POST',
            cache: false,
            data: {val:val},

            success:function (data) 
            { 
              $('#loader').hide();
              var len = JSON.parse(data)["indicators"].length
             
                for(let i=0; i<len; i++)
                {
                let obj = JSON.parse(data)['indicators'][i];
                 
                   $('#multiselect').append(
                     '<option value="'+obj.id+'">'+obj.displayName+'</option>'
                   );

                   $('#data-elementss').selectpicker('refresh');
                   $('#ind').show();
                }
              } 
              });



   })


    }



    if (val ==2) {
    $.ajax({
      url:"<?php echo base_url()?>get/dataElementsGroups",
      method: 'POST',
      cache: false,
      success:function (data) 
      {



        $('#loader').hide();
        var len = JSON.parse(data)["dataElementGroups"].length
       
          for(let i=0; i<len; i++)
          {
          let obj = JSON.parse(data)['dataElementGroups'][i];
           
             $('#indi-groups').append(
               '<option value="'+obj.id+'">'+obj.displayName+'</option>'
             );

             $('#indi-groups').selectpicker('refresh');
             $('#ind').show();
          }
        } 
        });

   $("#indi-groupss").on('change', function(){
        $('#multiselect').empty()

       var val =$(this).find(':selected').val();
       
       $.ajax({
            url:"<?php echo base_url()?>get/dataElements",
            method: 'POST',
            cache: false,
            data: {val:val},

            success:function (data) 
            { 
              
              console.log(JSON.parse(data)["dataElements"])

              $('#loader').hide();
              var len = JSON.parse(data)["dataElements"].length
             
                for(let i=0; i<len; i++)
                {
                let obj = JSON.parse(data)['dataElements'][i];
                 
                   $('#multiselect').append(
                     '<option value="'+obj.id+'">'+obj.displayName+'</option>'
                   );

                   $('#data-elementss').selectpicker('refresh');
                   $('#ind').show();
                }
              } 
              });



   })

    }

    if (val ==3) {


    }

    if (val ==4) {
      $.ajax({
      url:"<?php echo base_url()?>get/programIndicatorsGroups",
      method: 'POST',
      cache: false,
      success:function (data) 
      {


        $('#loader').hide();
        var len = JSON.parse(data)["programs"].length
       
          for(let i=0; i<len; i++)
          {
          let obj = JSON.parse(data)['programs'][i];
           
             $('#indi-groups').append(
               '<option value="'+obj.id+'">'+obj.displayName+'</option>'
             );

             $('#indi-groups').selectpicker('refresh');
             $('#ind').show();
          }
        } 
        });

   $("#indi-groupss").on('change', function(){
        $('#multiselect').empty()

       var val =$(this).find(':selected').val();
       
       $.ajax({
            url:"<?php echo base_url()?>get/programIndicators",
            method: 'POST',
            cache: false,
            data: {val:val},

            success:function (data) 
            { 
              

              $('#loader').hide();
              var len = JSON.parse(data)["programIndicators"].length
             
                for(let i=0; i<len; i++)
                {
                let obj = JSON.parse(data)['programIndicators'][i];
                 
                   $('#multiselect').append(
                     '<option value="'+obj.id+'">'+obj.displayName+'</option>'
                   );

                   $('#data-elementss').selectpicker('refresh');
                   $('#ind').show();
                }
              } 
              });



   })

    }

   

})

// end of onchange function

    
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




    $('#normalForm').submit(function(e){

    selected_regions  =[]
    selected_districs =[]
    selected_clinics = []
    selected_regionsNames = []
    selected_districsNames = []
    selected_clinicsNames = []
    $("input:checkbox[name=region]:checked").each(function(){

    selected_regions.push($(this).val());
    });

    $("input:checkbox[name=district]:checked").each(function(){

    selected_districs.push($(this).val());
    });
    $("input:checkbox[name=clinics]:checked").each(function(){

    selected_clinics.push($(this).val());
    });
    var orggroups = $('#orggroups1').val();
    var orglevels = $('#orglevels').val();

     // retrieve allselected organization unit names  
     $("input:checkbox[name=region]:checked").each(function(){
     selected_regionsNames.push($(this).parent().text());
     });
     $("input:checkbox[name=district]:checked").each(function(){
     selected_districsNames.push($(this).parent().text());
     });
     $("input:checkbox[name=clinics]:checked").each(function(){
     selected_clinicsNames.push($(this).parent().text());
     });

    var title = $("input[name=title]").val();
    var chart_type = $("#chart_type").val();
    var dash_id = $("input[name=dash_id]").val();
    var tab_id = $("input[name=tab_id]").val();
    var groupid = $("#indi-groups").val();
   
    var elementid = new Array();

    $('#multiselect_to option').each(function(){

        elementid.push(this.value);
    });

    var column = new Array();
    var layout_column = $("#droppable3 .layout-item").each(function(e){
      var txt = $("#"+this.id+" .content" ).text().trim();
      column.push(txt)
    });

    var filter = new Array();
    var layout_filter = $("#droppable .layout-item").each(function(e){
    var txt = $("#"+this.id+" .content" ).text().trim();
    filter.push(txt)
    });

    var data = new Array();
    var layout_data = $("#droppable2 .layout-item").each(function(e){
    var txt = $("#"+this.id+" .content" ).text().trim();
    data.push(txt)
    });



   relative_period = [];
	 fixed_period = [];
    //  this function retrieves the selected period 
    get_currently_selected_period_filter()
      
	   event.preventDefault(); 
	   var id = $('#tab_id').val();
	  
     // console.log('relative_period:')
     // console.log(relative_period)
     // console.log('Indicators:',elementid)
     // console.log('Periods:',relative_period,fixed_period)
     // console.log('Location:',selected_regions,selected_districs,selected_clinics)
     // console.log(fixed_period)


var check=1;

     if(!elementid.length){

      display_message("You must select at least one Indicator")
      check=0;
     }

     if(!relative_period.length && !fixed_period.length){

      display_message("You must select at least one Fixed or Relative period")
      check=0;
     }

    if(!selected_regions.length && !selected_districs.length && !selected_clinics.length){

      display_message("You must select at least one Organization Unit")
      check=0;
     }

      if(!title){

      display_message("You must enter the Title")
      check=0;
     }




if(check){

      $("#normal_btn").hide();
      $('#spinnormal').show(); 
    $.ajax({
      url:"<?php echo base_url("create/normalvisualizer") ?>",
      type:"POST",
      data:{
        title:title,
        chart_type:chart_type,
        dash_id:dash_id,
        tab_id:tab_id,
        selected_regions:selected_regions,
        selected_districs:selected_districs,
        selected_clinics:selected_clinics,
        groupid:groupid,
        elementid:elementid,
        relative_period:relative_period,
        fixed_period:fixed_period,
        orggroups:orggroups,
        orglevels:orglevels,
        selected_regionsNames:selected_regionsNames,
        selected_districsNames:selected_districsNames,
        selected_clinicsNames:selected_clinicsNames,
        column:column,
        filter:filter,
        data:data
      },
      success:function(response){
        location.href = "<?php echo base_url('view/dashboard/' . base64_encode($tab->dash_id)) ?>"
      }
      
    })
  }

  })








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

$('#multiselect').multiselect({

  moveToRight: function(Multiselect, options, event, silent, skipStack){
    $("#multiselect_to").append(options[0])

     options.addClass= 'sortablee';

  }
});


$(document).ready(function() {
  $('.fa-spin').hide();
  $('#spinnormal').hide();
  $('#single').hide();
      $('#leftb').hide();
      $('#rightb').hide();
      $('#pvot').hide();

var val =$(this).find(':selected').val();   
  
    
});

 $( function() {
    $( "#draggable, #draggable2, #draggable3" ).draggable({zIndex: 223232,containment: $('document'),helper: 'clone'});
   
   
    $( "#droppable2, #droppable, #droppable3" ).droppable({
  
      drop: function( event, ui ) {

        var text = ui.draggable.text().trim();
        var id = ui.draggable.attr('id');
        var image = ui.helper.children()[0].outerHTML
        $("#" + id).remove()
       
         $('#'+this.id).append('<div id="'+ id +'" class="layout-item"> '+image+' <div class="content" style="color:black;" > '+ text +' </div></div>');
         $("#" + id).draggable({ revert: 'invalid' });
      }
     
     
    });

  } );

  function close_layout_modal(event){
   event.preventDefault(); 

   $('#layout_modal').modal('hide');
  }

function period_filter(){

	var ids = $('.checked_period').map(function(index) {
	let id = this.id
	var object = document.getElementById(id);
	// object.remove();

	var div = document.getElementById("div" + id);
    // div.remove();
	})

  $('#period-modal').modal('toggle');
	relative_period_handler("<?=base_url()?>view/sub_period_type")
  }

	document.getElementById("relative_updated_vis_btn").addEventListener("click", function(event){
  event.preventDefault()
  relative_period_handler("<?=base_url()?>view/sub_period_type")
});

  document.getElementById("fixed_updated_vis_btn").addEventListener("click", function(event){
  event.preventDefault()
  fixed_period_handler()
});
// set the current selected year in the fixed filter in the fixed period unselected field
auto_load_relative_time("<?=base_url()?>view/sub_period_type")	  
// autoload the relative filters
autoload_relative_filters()	
	// oninput year handler	
// done handle year input
</script>

</script>
