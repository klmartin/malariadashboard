
<?php if (isset($tabs)) {
	foreach ($tabs as $tab) :
	?>
<!--- tab repeat all -->
<div id="<?php echo 'tabc_'.$tab->id; ?>" class="tabcontent" style="display: none;">
	<div class="col-md-12  title-bar" style="margin-bottom: 10px;" >
		<div class="row col-md-12 "  style="margin: 0px -18px; height:36px;">
			<a onclick="expandFunction()" style="font-size: 18px; font-weight: 500; min-width: 50px; cursor: default; user-select: text; top: 7px;padding: 3px; padding-right: 11px;text-decoration:none;"><?php 
				if (isset($head)) {
				      echo $head;
				    } else echo ''; ?></a>

			 
			<div class="dropdown">
			  <button  style="box-shadow: 0 12px 39px -8px rgba(9, 9, 16, .2);" class="dropbtn btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Add Filter
			  </button>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			    <a class="dropdown-item" onclick="general_period_filter('general', '<?php echo $tab->id ?>', 'general')">Period</a>
				<a class="dropdown-item" onclick="local_organization_filter('general', '<?php echo $tab->id ?>', 'general')">Organization Unit</a>
			  </div>
			</div>
			<a title="Dashboard home" class="iconic-links" href="<?php echo base_url("dashboard/home/" . base64_encode($tab->dash_id)) ?>"><i class='fa fa-home iconic'></i></a>
			<?php if (isset($_SESSION["admin"])){ if($_SESSION["admin"]){ ?>   
			<a title="Add new visualization" class="iconic-links" style="margin-left:0px" href="<?php echo base_url("add/visualizer/" . base64_encode($tab->id)) ?>"><i class='fa fa-plus iconic '></i></a>
			<a title="Import Visualiser" class="iconic-links" href="<?php echo base_url("import/visualizer/" . base64_encode($tab->id)) ?>"><i class='fa fa-arrow-down iconic'></i></a>
			<a title="Edit Tab" class="iconic-links" href="<?php echo base_url("edit/tab/" . base64_encode($tab->dash_id)) ?>"><i class='fa fa-edit iconic'></i></a>
			<?php } }?>
			<a href="#" title="Comment" class="iconic-links" onclick="comment(<?php echo $tab->id ?>, 0)"  style="margin-left:0px"><i class='fa fa-comment iconic'></i></a>
		</div>
	</div>
	
	<div id="applications<?php echo $tab->id ?>"></div>
	<div id=<?php echo "innerTab".$tab->id; ?>>

		<div  id="loader" style="top:140px" aria-label="Content is loading..." aria-live="polite" role="progressbar" id="preview-loader" class="dhis2loader"></div>
<!-- 		<div class="center" >
			<i  id="loader" class="fa fa-spinner fa-spin" style="font-size:100px;color:#2c6675"></i>
		</div> -->
	</div>
	<div id='<?php echo "waitingText".$tab->id; ?>' style="display:none">
		<strong>
			<h6 style="font-weight:700;margin-top:20px;margin-bottom:20px;color:red"> Sorry!, no visualization for this Tab.</h6>
		</strong>
	</div>
	<!-- this is the div to append all cards with single values -->
	      
        </div>
  <script>


  function select_1_sub() {
    relative_period_handler("<?=base_url()?>view/sub_period_type")
  }
  function select_2_sub() {
    fixed_period_handler()
  }
	
	function period_filter(){
	$('#period-modal').modal('toggle');
	}

	function expandFunction(){
		//console.log('hi')
		$('#collapseExample').collapse('show')

	}
	
  function cancel_modal(){
	 $('#period-modal').modal('hide');

  }

   function cancel_PeriodmodalWithSave(event){

	// empty data when click update
	  select_1_sub()
	  empty_Selected_items()

  	  event.preventDefault(); 
	  global__filter()
	 $('#period-modal').modal('hide');
  }
  
	function close_organization_modalwithsave(event){
	
	   event.preventDefault(); 
	
	global__filter()
	 $('#exampleModalCenter').modal('hide');
	} 
	
	function close_organization_modal(event){
	 event.preventDefault(); 
	
	global__filter()
	 $('#exampleModalCenter').modal('hide');
	} 
	
	
	function local_filter(local_visualization_id,local_chart_type_id,local_tab_id)
	{
		
	document.getElementById("localDropdown"+local_visualization_id).classList.toggle("show");

	}
	
	
	function general_period_filter(vis_id, tab_id){
	
	var ids = $('.checked_period').map(function(index) {
	let id = this.id
	var object = document.getElementById(id);
	object.remove();

	var div = document.getElementById("div" + id);
    	div.remove();
	})
	retrieve_previous_selected_period()
	relative_period_handler("<?=base_url()?>view/sub_period_type")

	}	

		
	function general_period_filter(vis_id, tab_id, passedType){

	passedChartType = passedType
	filtervisid = vis_id
	filtertabid = tab_id
	retrieve_previous_selected_period()
    relative_period_handler("<?=base_url()?>view/sub_period_type")
	
	$('#period-modal').modal('toggle');
	
	
	}


	function local_organization_filter(vis_id, tab_id, passedType){
	
	passedChartType = passedType
	filtervisid = vis_id
	filtertabid = tab_id
	
	$('#exampleModalCenter').modal('toggle');
	}

	function bulletinImage(vis_id){


		html2canvas(document.getElementById("numb"+vis_id)).then(function (canvas) {

			var png64encodedstring = canvas.toDataURL();
			$.ajax({

				url:"<?php echo base_url()?>malariabulletin/image/",
		                method: 'post',
		                data: {png64encodedstring:png64encodedstring, vis_id:vis_id} , 
		                cache: false,
		                success:function (data) { }

				})

		});
	}
	
	
	function local_ou_filter(){
	$('#lou-modal').modal('toggle');
	}
	
	function close_comment(){
	 $('#comment-modal').modal('hide');
	}
	function save_comments(){
	
	let visualization_id =  $('#visualization_id').val();
	let comment_tab_id =  $('#comment_tab_id').val();

	let displayName =  $('#displayName').val();
	let userName =  $('#userName').val();
	let user_id =  $('#user_id').val();

	let body =  $('#body').val();
	if(body){}else{
		alert('Please Leave a comment.')
		return false;
	}

	$('#body').empty();
                   $('#body').val(null);


				   $('.show_comments').append("<p class='loader-comments' style='padding-top:10px;padding-left:30px;color:green;font-weight:700;'>Saving comment...</p>")
          //start of default AJAX from selected Tab
          $.ajax({
                 url:"<?php echo base_url()?>save_comment_asy/",
                 method: 'post',
				 data: {comment_tab_id:comment_tab_id, user_id:user_id, body:body, visualization_id:visualization_id, displayName:displayName, userName:userName, user_id:user_id}, 
                 cache: false,
                 success:function (data) { 
					$('.loader-comments').css('display', 'none');

                   // alert(data)
                   var id = JSON.parse(data);
                   // data
                   var dynamic = "";                   
                   $('.show_comments').append('<div class="col-md-12" id='+id+' style=""><hr>'+
               '<p class="comment_p"><span class="comment_avatar"><?php echo $_SESSION['displayName']; ?></span> '+body+' <span onclick="delete_comment_confirm('+id+', '+comment_tab_id+')"><i style="color: red;float: right;background: #f3f3ff;padding: 7px;border-radius: 12%;color:red;float: right;" class="fa fa-trash"></i></span></p>'+
                ''+
               '</div>');


                   }
                 });

                
	                 
	}
	
	
	function delete_comment_confirm(id, comment_field_id){ 
	
	     if(confirm("Are you sure you want to delete this comment.")){
	     $.ajax({   
	               url: '<?php echo base_url()?>delete/comment/'+id,
	               method: 'delete',
	               cache: false,
	               success:function (data){ 
	
	               $('#comment-modal').modal({backdrop: 'static', keyboard: false});  
	               $('#'+id).css('display', 'none');
	
	
	
	               }
	                 }
	   );
	               
	 }else{
	   // alert('fail')
	
	 }
	
	}
	
	function comment(comment_field_id, visualization_id){
						   
	 $('#comment-modal').modal('toggle');
	 $('#comment_tab_id').val(comment_field_id);
	 $('#visualization_id').val(visualization_id);

	 $.ajax({ 
	               url: "<?php echo base_url("show_tab_data") ?>",
	               method: 'post',
	                data:{
	                tab_id:comment_field_id, visualization_id:visualization_id                  
	               },
	               cache: false,
	               success:function (data){

	                 var data = JSON.parse(data);
	                 $('.show_comments').empty();
	
	
	                 var dynamic = "";
	
	                    for (var i = data.length - 1; i >= 0; i--) {
	                     const body =  data[i].body;
	                     const displayName =  data[i].displayName;
	                     // alert(id)
	                     const id =  data[i].id;
	                 
	                     dynamic += '<div class="col-md-12"  id="'+id+'" style=""><hr> '+
											 '<p class="comment_p"><span class="comment_avatar">'+displayName+'</span> '+body+' <span onclick="delete_comment_confirm('+id+', '+comment_tab_id+')"><i  style="color: red;float: right;background: #f3f3ff;padding: 7px;border-radius: 12%;color:red;float: right;cursor: pointer;"  class="fa fa-trash"></i></span></p>'+
						                     '</div>'; 
	                   }
	                   $('.show_comments').append(dynamic);

	
	               }
	              });
	
	
	}



	
	function openTab(evt, id) {
	  $('.btn_').css('background-color', 'rgb(243, 245, 247)')
	  $('.btn_').css('color', 'black')
	 $('#btn'+id).css('background-color', 'rgb(0, 121, 107)')
	 $('#btn'+id).css('color', 'white')


	  $('#dashcontent').empty()



	 $('#dashcontent').append('<div   class="grid-stack" style="height:100%;width:100%">'+
    					'</div>');
	
	 
	
	let passedChartType;
	let filtervisid;
	let filtertabid;
	
	
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
	
	           // Show the current tab, and add an "active" class to the button that opened the tab
	
	           document.getElementById('tabc_'+id).style.display = "block";

	            let gridstack = GridStack.init({
					      cellHeight: '5vh',
                          // cellHeight: 'initial', // start square but will set to % of window width later
                          animate: true, // show immediate (animate: true is nice for user dragging though)
                          // disableOneColumnMode: true, // will manually do 1 column
                          float: true,

                           disableResize: true ,
                          minRow: 1, });

	            	                        // grid.addWidget({x:0, y:0, w:4, content:   ' <div class="single_values  chart-container " id="vis_id" style="height:100%;width:100%;">Helllo</div>'});
						

			// gridster = $("<?php echo "#vis".$tab->id; ?>").gridster({
			// widget_base_dimensions: ['auto', 140],
   //          autogenerate_stylesheet: true,
   //          min_cols: 1,
   //          max_cols: 6,
   //          widget_margins: [5, 5],
   //          resize: {
   //              enabled: false
			// },

			// draggable: {
   //              enabled: false
			// }

			// }).data('gridster').disable();
			// $("<?php echo "#vis".$tab->id; ?>").css({'padding': '0'});

			// // gridster.remove_all_widgets();
			// // gridster.destroy();
			// // $('<?php echo "#vis".$tab->id; ?>').empty();\

			var auth=false;

<?php if (isset($_SESSION["admin"])){ if($_SESSION["admin"]){ ?>  auth=true;  <?php } }?>
		

	           $.ajax({
	
	                 url:"<?php echo base_url()?>view/visualizers/",
	                 method: 'post',
	                 data: {id: id},
	                 cache: false,
	                 success:function (data) { 
	                 	var link='<?php echo base_url("edit/visualizer/") ?>';
	                 	var base_url='<?php echo base_url("assets/icons/") ?>';


	                 	vs_id_array =containers(data,id,link,base_url,gridstack,auth);
	                 	
	
			},complete:function (data){
				         
				         $('#loader').hide();


				    var len = vs_id_array.length;




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

					     // 
					
					 },
				  
				   success: function(data) {

				   	// //console.log('The data',JSON.parse(data));
				
			var link='<?php echo base_url("edit/visualizer/") ?>';
			var base_url='<?php echo base_url("assets/icons/") ?>';


				update_visulizer(id,data,vs_id_array[i],link,auth);


					}
				
				})



       }

	       }
	   });
	   //end Of default AJAX function from selected Tab	
	   
	   }
	   	<?php if (isset($_SESSION["last_tab"])){ if(!$_SESSION["last_tab"]==""){ ?> 
			
					window.onload = function(){
					  openTab(event, '<?php echo $_SESSION["last_tab"]; ?>')
					}
	
				<?php } }?>

	     
	function global__filter() {	
	select_1_sub()		
	 relative_period = [];
	 fixed_period = [];
      //  this function retrieves the selected period 
	  get_currently_selected_period_filter()

	   event.preventDefault(); 
	   var id = $('#tab_id').val();
	   selected_regions  =[]
	   selected_districs =[]
	   selected_clinics = []
	   selected_regionsNames = []
	   selected_districsNames = []
	   selected_clinicsNames = []	 

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
	    // retrieve allselected relativeperiod values	
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

	   
	  
if (filtervisid == 'general' ) {

	   var len = vs_id_array.length;

	      for (var i = 0; i < len; i++) {

	      




	$.ajax({	
	   url: "<?php echo base_url()?>filter/global_period_filter/",
	   method: "POST",
	   cache: false,
	   data: {
	       filtertabid:filtertabid,
	       relative_period: relative_period,
		   	 fixed_period: fixed_period,
	       selected_clinics:selected_clinics,
	       selected_regions:selected_regions,
	       selected_districs:selected_districs,
	       filtervisid:	vs_id_array[i],
	       orggroups:orggroups,
	       orglevels:orglevels,
	       selected_regionsNames:selected_regionsNames,
	       selected_districsNames:selected_districsNames,
	       selected_clinicsNames:selected_clinicsNames
	
	   },
	
	    beforeSend: function(data){ 

            if(($('#numb'+vs_id_array[i]).empty()).length > 0){
		         var myChart={
		         chart: {
		           events: {
		             load() {
		               const chart = this;
		               chart.showLoading('<div aria-label="Content is loading..." aria-live="polite" role="progressbar" id="preview-loader" class="dhis2loader"></div>');
		             
		             }
		           }
		         },
		          title: {
	                  text: '',
	               },
	              yAxis: {
                   min: 0,
                   endOnTick:false,
                   title: {
                       text: '',
                   },	                               
               },
		         series: [{
		         	name:"",
		           data: []
		         }]
		       };
		
		       myChart.chart.renderTo='numb'+vs_id_array[i];
		       var chart1=new Highcharts.Chart(myChart);

			
}

 if(($('#numb_p'+vs_id_array[i]).empty()).length > 0){
 	 myChart.chart.renderTo='numb_p'+vs_id_array[i];
		       var chart1=new Highcharts.Chart(myChart);
 }
	
					 },
					  
					success: function(data) {
							var auth=false;

<?php if (isset($_SESSION["admin"])){ if($_SESSION["admin"]){ ?>  auth=true;  <?php } }?>
					
					var link='<?php echo base_url("edit/visualizer/") ?>';
					var base_url='<?php echo base_url("assets/icons/") ?>';
					update_visulizer(id,data,vs_id_array[i],link,auth);


				// clear checked list
				var ids = $('.checked_period').map(function(index) {
				let id = this.id
				var object = document.getElementById(id);
				object.remove();

				var div = document.getElementById("div" + id);
				div.remove();
				})

				$('.selected_sub_period_list').empty();

					}
					
					})

 }
}


else{


	$.ajax({	
	   url: "<?php echo base_url()?>filter/global_period_filter/",
	   method: "POST",
	   cache: false,
	   data: {
	       filtertabid:filtertabid,
	       relative_period: relative_period,
		   fixed_period: fixed_period,
	       selected_clinics:selected_clinics,
	       selected_regions:selected_regions,
	       selected_districs:selected_districs,
	       filtervisid:	filtervisid,
	       orggroups:orggroups,
	       orglevels:orglevels,
	       selected_regionsNames:selected_regionsNames,
	       selected_districsNames:selected_districsNames,
	       selected_clinicsNames:selected_clinicsNames
	
	   },
	
	    beforeSend: function(data){ 
	    	// //console.log("the chart type", passedChartType);

	    	if (filtervisid != 'general' && passedChartType != 4) {

               $('#numb'+filtervisid).empty();
		         var myChart={
		         chart: {
		           events: {
		             load() {
		               const chart = this;
		               chart.showLoading('<h2><div aria-label="Content is loading..." aria-live="polite" role="progressbar" id="preview-loader" class="dhis2loader"></div></h2>');
		             
		             }
		           }
		         },
		         title: {
	                  text: '',
	               },
	            yAxis: {
                   min: 0,
                   endOnTick:false,
                   title: {
                       text: '',
                   },	                               
               },

		         series: [{
		         	name:"",
		           data: []
		         }]
		       };
		
		       myChart.chart.renderTo='numb'+filtervisid;
		       var chart1=new Highcharts.Chart(myChart);

		        if(($('#numb_p'+filtervisid).empty()).length > 0){
 				 myChart.chart.renderTo='numb_p'+filtervisid;
		       var chart1=new Highcharts.Chart(myChart);
 		}
	

			
				}
	
					 },
					  
					success: function(data) {
					
					var link='<?php echo base_url("edit/visualizer/") ?>';
					var base_url='<?php echo base_url("assets/icons/") ?>';
						var auth=false;

<?php if (isset($_SESSION["admin"])){ if($_SESSION["admin"]){ ?>  auth=true;  <?php } }?>


					update_visulizer(id,data,filtervisid,link,auth);


					}
					
					})

					 }

					}

	
</script>
<?php endforeach; }?>




<?php if (isset($_SESSION["last_tab"])){ if($_SESSION["last_tab"]==""){ ?> 
			

				
<div  id="setting" class="row col-md-12 form-group" style=" margin-top: 25px;">
	

</div>

<?php } }?>
<style>
	.jss259 {
	flex: 1 1 auto;
	margin: 24px;
	padding: 0;
	overflow-y: auto;
	-webkit-overflow-scrolling: touch;
	}
</style>

<!-- the dash content -->
</div>
<div id="dashcontent" style="width:100%;height:100%"></div>	
<!-- <div  class="gridster"  style="height:100%;width:100%">
<ul id="<?php echo "vis".$tab->id; ?>" style="height:100%;width:100%">
</ul></div> -->

<!-- modal for period filter ends here -->
<div class="modal fade" id="period-modal" class="modal_data" style="display: none;">
	<div class="modal-dialog" style="display: table;">
		<div class="modal-content">
			<!-- <input type="hidden" > -->
			<div class="modal-header" style="margin-left: 15px;border-bottom: 1px solid #e9ecef00;  border-top-left-radius: .3rem; border-top-right-radius: .3rem; margin-bottom: -34px;   font-weight: bold;"> 
			</div>
			<div class="modal-body">
				<!-- comments -->
				<div><button style="cursor: pointer;" class="jsx-2633868236 nav-button active relative-btn" type="button" onclick="select_1_sub()">Relative periods</button>
					<button style="cursor: pointer;" class="jsx-2633868236 nav-button fixed-btn" type="button"  onclick="select_2_sub()">Fixed periods</button>
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
					<!-- simple time ends here -->
					<!-- complex time goes here -->
					<!-- complex time ends here -->
					<!-- simple filter ends here -->
					<!-- filter ends here -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-12  form-group">
					<div class="float-right">
						<button type="button" style="border: 1px solid rgb(160, 173, 186);" class="btn btn-light" onclick="cancel_modal()">Cancel</button>
						<button  onclick="cancel_PeriodmodalWithSave(event)" style="border: 1px solid rgb(160, 173, 186);"  type="button" class="btn btn-light">Update</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="comment-modal" class="modal_data" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="margin-left: 15px;border-bottom: 1px solid #e9ecef00;  border-top-left-radius: .3rem;   border-top-right-radius: .3rem;      margin-bottom: -34px;  font-weight: bold;margin-bottom: -18px;">
				<h4 class="modal-title">Interpretation:</h4>
			</div>
			<!-- comments -->
			<form  class="co" style="" action="<?php echo base_url('save_comment') ?>" method="post">
				<!-- comments shows from here -->
				<div class="show_comments">
				</div>
				<!-- comments ends here -->
				<div class="row" >
					<div class="col-md-12  form-group" style="">
						<!-- <h5 style="color: #5f5a5a;"><strong>Description</strong></h5> -->
						<input type="hidden" name="comment_tab_id" id="comment_tab_id" value="">
						<input type="hidden" name="visualization_id" id="visualization_id" value="">
						<!-- <input type="hidden" name="user_id" id="user_id" value=0> -->
						
						<input type="hidden" name="user_id" id="user_id" value=<?php echo $_SESSION['userId'];  ?>>
						<input type="hidden" name="displayName" id="displayName" value=<?php echo $_SESSION['displayName'];  ?>>
						<input type="hidden" name="userName" id="userName" value=<?php echo $_SESSION['userName'];  ?>>
						
						<div class="Dscds" style="display: flex;">
							<span class="comment_avatar_2" ><?php echo $_SESSION['displayName']; ?></span>
							<textarea autocomplete="off" style="margin-top:16px;" required="" placeholder="Write new interpretation" type="text" minlength="2" maxlength="100" name="body"  id="body"  class="form-control"></textarea>
						</div>
					
					
					</div>
				</div>
				<div class="row">
					<div class="col-md-12  form-group">
						<div class="float-right">
							<button type="button" class="btn btn-default pull-left" onclick="close_comment()" >Close</button>
							<button type="button" class="btn btn-success" onclick="save_comments()" >Save</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>



<!-- modal for period filter ends here -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
	<div class="modal-content">
		<div class=" modal-header jss222 " >
			<h6>Organization units</h6>
		</div>
		<form method="post" id="filterForm" >
			<!-- <div class="modal-body"> -->
			<div class="jss259"   style="width: 550px; min-height: 48px;">
				<!-- <div class="style="border: 1px solid rgb(222, 222, 222); position: relative;" ></div>  -->
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
										<input name="region" value="UNSNiNqkzEM" type="checkbox" class="hummingbird-end-node" /> Zanzibar
										</label>
										<ul>
											<li>
												<i class="fa fa-folder bluefoldericon" onclick="dis_1('lHwuEQcm5Nc')"></i>
												<label>
												<input name="region" value="lHwuEQcm5Nc"type="checkbox" class="hummingbird-end-node" />Pemba
												</label>
												<ul class="districtsdrop">
												</ul>
											</li>
											<li>
												<i class="fa fa-folder bluefoldericon" onclick="dis_2('l9kxy7vLv6t')" ></i>
												<label>
												<input name="region" value="l9kxy7vLv6t" type="checkbox" class="hummingbird-end-node" />Unguja
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
				<!-- </div> -->
				<div class="modal-footer">
					<div id="filterLoader" style="width: 34%;padding: -2px;" >
						<img src="<?php echo base_url('assets/loading.svg') ?>" height="50px" width="50px" >
					</div>
					<button style="border: 1px solid rgb(160, 173, 186);" onclick="close_organization_modal(event)" class="btn btn-light">Cancel</button>
					<button style="border: 1px solid rgb(160, 173, 186);" onclick="close_organization_modalwithsave(event)" class="btn btn-light">Update</button>
				</div>
		</form>
		</div>
	</div>
</div>
<!-- modal for comments -->
<!-- comments ends -->
<!-- modal for perio filter -->
<!-- modal for period filter -->       

<!-- modal for period filter -->
<!-- modal for comments -->
<!-- comments ends -->
<!-- modal for period filter -->
<!-- modal for period filter -->
<div class="modal fade" id="period-modal" class="modal_data" style="display: none;">
	<div class="modal-dialog" style="display: table;">
		<div class="modal-content">
			<div class="modal-header" style="margin-left: 15px;border-bottom: 1px solid #e9ecef00;  border-top-left-radius: .3rem; border-top-right-radius: .3rem; margin-bottom: -34px;   font-weight: bold;"> 
			</div>
			<div class="modal-body">
				<!-- comments -->
				<div><button style="cursor: pointer;" class="jsx-2633868236 nav-button active relative-btn" type="button" onclick="select_1_sub()">Relative periods</button>
					<button style="cursor: pointer;" class="jsx-2633868236 nav-button fixed-btn"  type="button"  onclick="select_2_sub()">Fixed periods</button>
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
               
									<!-- case 2 -->
									<label class="jss260 jss264 jss249 jss254 jss257 jss256 jss248" data-shrink="true" for="period-type"></label>
									<div class="jss16 jss3 jss17 jss4">
										<div class="col sub_complex_period_type" style="display:none;padding-left: 7px;padding-bottom: 10px;font-size: x-small;">
											<label for="title" style="color: #595959;">Year</label>
											<input type="number"    value="" id="year_period" class="form-control" style="border: 1px solid #ced4da47;max-width: 88px;
												padding-left: 10px;font-size: 1rem;padding-left: 0px;color: black;"> 
										</div>
									</div>
                <!-- case 2 ends here -->
                 <!-- case 1 start here -->
                 <label class="jss260 jss264 jss249 jss254 jss257 jss256 jss248" data-shrink="true" for="period-type"></label>
									<div class="jss16 jss3 jss17 jss4">
										<div class="col sub_complex_period_type" style="display:none;padding-left: 7px;padding-bottom: 10px;font-size: x-small;">
											<label for="title" style="color: #595959;">Period type</label>
											<select name="periodType" id="periodType" class="form-control" style="border: 1px solid #ced4da47;font-size: 1rem;padding-left: 0px;color: black;">
												<?php
													echo getExtendedPeriodType();
													foreach (getExtendedPeriodType() as $key => $value) { ?>
												<option value="<?= $value['id'] ?>"> <?= $value['name'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
                  <!-- case 1 ends -->
								</div>
								<!-- complex ends -->
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
					<!-- simple time ends here -->
					<!-- complex time goes here -->
					<!-- complex time ends here -->
					<!-- simple filter ends here -->
					<!-- filter ends here -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-12  form-group">
					<div class="float-right">
						<button type="button" class="btn btn-default pull-left" >Cancel</button>
						<button type="button" class="btn btn-success"  >Save</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script>
	function dis_1(id){
	
	      $('.districtsdrop').empty()
	      var region = id;
	 
	    $.ajax({
	      url:"<?=base_url()?>view/districts",
	      method: "POST",
	      cache: false,
	      data: 'region=' + region
	    }).done(function(district) {
	      district = JSON.parse(district);
	      district.forEach(function(district) {
	        $(".districtsdrop").append(' <li><i class="fa fa-folder bluefoldericon" onclick="cc(\''+district.id+'\')" ></i><label><input name="district" value="'+district.id+'" data-id="custom-1-1" type="checkbox" class="hummingbird-end-node" /> '+district.name+'</label>  <ul class="clinicssdrop'+district.id+'"</ul> </li> ')
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
	    $(".districtsdrop2").append('<li><i class="fa fa-folder bluefoldericon" onclick="cc(\''+district.id+'\')" ></i><label><input name="district" value="'+district.id+'" type="checkbox" class="hummingbird-end-node" /> '+district.name+'</label>  <ul class="clinicssdrop'+district.id+'"</ul> </li> ')
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
	          $('.clinicssdrop'+district).append(' <li style="list-style-type:none;" id="'+clinic.id+'" > <i class="fas "></i><label><input name="clinics" value="'+clinic.id+'"  data-id="custom-1-1" type="checkbox" class="hummingbird-end-node" /> '+clinic.name+'</label> </li>')
	        })
	
	      },
	    complete: function(data) {  
		
	      }
	  
	  })
	
	
	}
	
	
	$("#period").daterangepicker({
	
	forceUpdate: true,
	startDate: '2019-01-01',
	callback: function(startDate, endDate, period){
	  let startday = startDate.format('L')
	  let endday = endDate.format('L')
	  var period = startday + ' – ' + endday;
	  $(this).val(period)
	  document.getElementById('startday').value= startday;
	  document.getElementById('endday').value= endday; 
	}
	
	});
	

	$(document).ready(function() {
		// add style to selected tab
		var selectedDash = "<?php echo $dashboard->id ?>";
		$('#'+selectedDash+'').css({'border-radius': '25px','background-color':'#2c6693'})

		$('#link'+selectedDash+'' ).css({'color':'white'})
	
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

	
// set the current selected year in the fixed filter in the fixed period unselected field
auto_load_relative_time("<?=base_url()?>view/sub_period_type")	  
// autoload the relative filters
	 autoload_relative_filters()		
	  
	  $("#treeview").hummingbird();

	  var ListGroup = {"id" : [], "dataid" : [], "text" : []};
	  var ListGroupOld = {};
	  var List = {"id" : [], "dataid" : [], "text" : []};
	  $("#treeview").on("CheckUncheckDone", function(event, args){
	      
	    $("#treeview").hummingbird("getChecked",{list:ListGroup,onlyEndNodes:true,onlyParents:false,fromThis:false});
	     console.log(ListGroup)
	     ListGroupOld = ListGroup;

	 });

	
	})


	// end handling period filter
	
</script>
<style>
	@media screen and (min-width: 676px) {
	.modal-dialog {
	max-width: 600px;
	/* New width for default modal */
	}
	}
	.daterangepicker{z-index:9999 !important}
	.scrollable{
	overflow-y: auto;
	max-height: 70px;
	}
</style>

