function edit_containers(data,id,link){



		               var vis_id_array=[];
	                   var len = JSON.parse(data)['visualizers'].length;
	                   // check if the retrieve data has any visual details, if has no any
	                   // ..visual details then do not show loader.
	                   if(len==0){
	                   $('#waitingText'+id).css('display', 'unset'); 
	                   }
	
	                   var apps = JSON.parse(data)['applications'];
	                   var dynamic = "";
	                    for (var i = apps.length - 1; i >= 0; i--) {
	                
	                     const appname =  apps[i].name
	                     const applink = apps[i].link
	                     dynamic +=  '<a href="'+applink+'" target="blank" style="font-size:16px;width:100%;margin-left:5px" ><i style="padding:10px;border-radius: 5px;" class="fa fa-sharet tablinks">'+appname+'</i></a>'
	
	                     }
	
	                   if(dynamic.length!=0){
	                   $('#applications'+id).append(
	                     '<h6 style="padding-top: 10px;padding-left: 0px">APPLLICATIONS</h6><br><div class="row" style="margin-top: -12px;padding-left: 31px;padding-right: 31px;margin-left: -18px;">'+
	                     '<div  class=" col-md-12" style=" padding-top: 10px;padding-bottom: 10px;background-color:#fff;margin-top: -30px;margin-bottom: 11px;padding-top: 5px;padding-bottom: 5px;box-shadow: 2px 4px 25px -10px rgba(0, 0, 0, 0.12);height: max-content;overflow-x: auto;overflow-y: hidden;display: flex;flex-wrap: revert;margin: inherit;"> '+
	                     '<div style=" max-height: 70px;">'+dynamic+
	                     '</div>'+
	                     '</div>'+
	                     '</div>'
	                     )
	                   }
	
	
	                     for(let i=0; i<len; i++){  
	
	                       let vis = JSON.parse(data)['visualizers'][i];
	
	                       vis_id_array.push(vis.id);
	                      
	                      //consolee.log('The length',JSON.parse(data)['items'][vis.id].length);
	
	                  try {
	                       JSON.parse(data)['items'][vis.id];
	                    
	
	                       // let result = element_values.map(i=>Number(i));
	                    if (vis.chart_type==4) {
	
	
	                       
	                        var title = JSON.parse(data)['items'][vis.id]['title']
	                     


	                       $('#vis'+vis.tab_id).append(

						    '<div class="single_values resizable_single chart-container " id="vis_id'+vis.id+'" '+JSON.parse(vis.style)['container']+' style="vertical-align: top;'+JSON.parse(vis.style)['style']+';background-color:white;margin:5px;'+JSON.parse(vis.style)['translate']+'display:inline-block;">'+
						        '<div class="col-md-12" style="display: inline-flex; padding:6px">'+
				           ' <div class="col-md-8" style="padding:0px">'+
				                '<strong>'+vis.title+'</strong>'+  
				            '</div>'+

				           ' <div class="col-md-4" style="padding:0px">'+

				                 '<div class="dropdown"  style="float:right">'+
         //                    '<button  style="box-shadow: 0 12px 39px -8px rgba(9, 9, 16, .2);" class="chart-dropdown dropbtn btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" style="color:#888888" aria-hidden="true"></i>'+
			  				// '</button>'+

			  				'<button   style="float:right" data-toggle="dropdown" class="chart-dropdown btn btn-link "><i class="fa fa-ellipsis-h" style="color:#888888" aria-hidden="true"></i></button> '+

			  				'<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'+
						    '<a class="dropdown-item" onclick="general_period_filter('+vis.id+', '+vis.tab_id+','+vis.chart_type+')">Period</a>'+
							'<a class="dropdown-item" onclick="local_organization_filter('+vis.id+', '+vis.tab_id+','+vis.chart_type+')">Organization Unit</a>'+
							'<a class="dropdown-item" href="'+link+vis.id+'">Edit</i></a>'+
							'</div>'+
                      ' </div>'+


				            '</div>'+
				        '</div>'+		
				      												      

				         '<div class="col-md-12">'+
				            '<div class="col-md-12" style="margin: 5px;text-align: center;height: 20px">'+

				                  ' <p style="font-size: 1.1vw;">Loading ..</p>'+

				            '</div>'+

				       ' </div>'+


				         '<div class="col-md-12">'+
				            '<div class="col-md-12" style="margin: 5px;height: 20px;text-align: center;">'+

				             

				            '</div>'+



				       ' </div>'+


				         '<div class="col-md-12">'+
				           ' <div class="col-md-8" style="margin: auto;text-align: center;font-size:7vmax ">'+

				                
				           ' </div>'+


				       ' </div>'+

						
						   

						     '</div>');

								}
										
	
	                 else if(vis.chart_type==1){

	
	                       $('#vis'+vis.tab_id).append(
	                       '<div class=" chart-container draggable" id="vis_id'+vis.id+'" '+JSON.parse(vis.style)['container']+' style="margin :5px;display:inline-block;">'+
	                       '<div class=" col-md-12 chartheader">'+
                          
                           '<div class="float-left " style="font-size: 14px;width:80%;margin-left: 4px;"> <strong>'+vis.title+'</strong></div>'+
                            '<div class="float-right">'+

                            '<div class="dropdown" style="float:right" >'+
                            '<button   style="float:right" data-toggle="dropdown" class="chart-dropdown btn btn-link "><i class="fa fa-ellipsis-h" style="color:#888888" aria-hidden="true"></i></button> '+

			  				'<div class="dropdown-menu drp_menu" aria-labelledby="dropdownMenuButton">'+
						    '<a class="dropdown-item" onclick="general_period_filter('+vis.id+', '+vis.tab_id+','+vis.chart_type+')">Period</a>'+
							'<a class="dropdown-item" onclick="local_organization_filter('+vis.id+', '+vis.tab_id+','+vis.chart_type+')">Organization Unit</a>'+
							 '<a href="'+link+vis.id+'">Edit</i></a>'+
							'</div>'+
							'</div>'+

							'<div class="dropdown">'+
							 '<button class="btn  dropdown-toggle  chart-dropdown" hidden type="button" id="drop_id'+vis.id+'" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">'+

							 '</button>'+
								'<div class="dropdown-menu" aria-labelledby="drop_id'+vis.id+'">'+
							    '<a class="dropdown-item"  id="download-csv'+vis.id+'"> Download CSV </a>'+
							   '<a class="dropdown-item" id="download-xlsx'+vis.id+'"> Download XLSX </a>'+
							   ' <a class="dropdown-item" id="download-pdf'+vis.id+'"> Download pdf </a>'+
							  '</div>'+
							'</div>'+
	                      
	                       '</div>'+
	                       '</div>'+
	                       '<div class="col-md-12" >'+
	                       '<div id="numb'+vis.id+'" class="resizable" style="'+JSON.parse(vis.style)['style']+'"></div>'+
	                       
	                       '<div class="row chart-menu">'+
	                               '<a  title="Histogram" id="bar'+vis.id+'"  ><i class="fa fa-chart-bar iconic"></i></a>'+
	                               '<a  title="Histogram" id="barstack'+vis.id+'" ><i class="fa fa-chart-bar iconic"></i></a>'+
	                               '<a  title="Histogram" id="horizontal'+vis.id+'" ><i class="fa fa-align-left  iconic"></i></a>'+
	                               '<a  title="Histogram" id="horizontal_stack'+vis.id+'" ><i class="fa fa-align-left  iconic"></i></a>'+
	                               '<a  title="Area" id="areaprop'+vis.id+'" ><i class="fa fa-chart-area iconic"></i></a>'+
	                               '<a  title="Pie chart" id="pieprop'+vis.id+'"  ><i class="fa fa-chart-pie iconic"></i></a>'+
	                               '<a  title="Line chart" id="lineprop'+vis.id+'"  ><i class="fa fa-chart-line iconic"></i></a>'+
	                               '<a  title="Table" id="tableprop'+vis.id+'"  ><i class="fa fa-table iconic"></i></a>'+
	                                '<a  title="Sort" id="sort'+vis.id+'"  ><i class="fa fa-sort iconic"></i></a>'+
	
	                               '</div>'+
	                       '</div>'); 
	                     
	     
							$('#drop_id'+vis.id).hide();
	                       let sort_status='false';
	
	                       (function(index){


	                       $('#numb'+vis.id).empty();
									         var myChart={
									         chart: {
									           events: {
									             load() {
									               const chart = this;
									               chart.showLoading('<h2>Loading data...</h2>');
									             
									             }
									           }
									         },
									           credits: {
	                                   text: 'Source: dhis2.org'
	                               },
									         series: [{
									           data: []
									         }]
									       };
									
									       myChart.chart.renderTo='numb'+filtervisid;
									       var chart1=new Highcharts.Chart(myChart);

	                      
	
	
	
	                     })(i);
	
	                     continue;
	
	                   
	                   }
	
	                else if(vis.chart_type==3){    //Unfiltered table
							
	                       $('#vis'+vis.tab_id).append(
	                       '<div class=" chart-container draggable" id="vis_id'+vis.id+'" '+JSON.parse(vis.style)['container']+' style="vertical-align: top;margin :5px;display:inline-block;'+JSON.parse(vis.style)['translate']+'">'+
	                       '<div class=" col-md-12 chartheader">'+
                          
                           '<div class="float-left " style="font-size: 14px;width:80%;margin-left: 4px;"> <strong>'+vis.title+'</strong></div>'+
                            '<div class="float-right">'+

                            '<div class="dropdown" style="float:right" >'+
         //                    '<button  style="box-shadow: 0 12px 39px -8px rgba(9, 9, 16, .2);" class="chart-dropdown dropbtn btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" style="color:#888888" aria-hidden="true"></i>'+
			  				// '</button>'+

			  				'<button   style="float:right" data-toggle="dropdown" class="chart-dropdown btn btn-link "><i class="fa fa-ellipsis-h" style="color:#888888" aria-hidden="true"></i></button> '+

			  				'<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'+
						    '<a class="dropdown-item" onclick="general_period_filter('+vis.id+', '+vis.tab_id+','+vis.chart_type+')">Period</a>'+
							'<a class="dropdown-item" onclick="local_organization_filter('+vis.id+', '+vis.tab_id+','+vis.chart_type+')">Organization Unit</a>'+
							'<a class="dropdown-item" href="'+link+vis.id+'">Edit</i></a>'+
							'</div>'+
							'</div>'+

						 '<div class="dropdown">'+
						 '<button class="btn   chart-dropdown" type="button" id="drop_id'+vis.id+'" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false"><i class="fa fa-arrow-down "></i>'+
							  // '<button   style="float:right" data-toggle="dropdown" class="chart-dropdown btn btn-link "><i class="fa fa-ellipsis-h" style="color:#888888" aria-hidden="true"></i></button> '+

							 '</button>'+
						  '<div class="dropdown-menu" aria-labelledby="drop_id'+vis.id+'">'+
						    '<a class="dropdown-item"  id="download-csv'+vis.id+'"> Download CSV </a>'+
						   '<a class="dropdown-item" id="download-xlsx'+vis.id+'"> Download XLSX </a>'+
						   ' <a class="dropdown-item" id="download-pdf'+vis.id+'"> Download pdf </a>'+
						  '</div>'+
						  '</div>'+
							
	                       '</div>'+
	                       '</div>'+
	                       '<div class="col-md-12" >'+
	                        // '<div  style="background-color:black;padding:0px;">'+
	                       '<div id="numb'+vis.id+'" class="resizable numb'+vis.id+'" style="background:gradient(to top right,transparent 50%,#608A32 0) top right/40px 40px no-repeat,black; '+JSON.parse(vis.style)['style']+'"></div>'+
	                        // '</div>'+
	                       
	                       '<div class="row chart-menu">'+
	                               '<a  title="Histogram" id="bar'+vis.id+'"  ><i class="fa fa-chart-bar iconic"></i></a>'+
	                               '<a  title="Histogram" id="barstack'+vis.id+'" ><i class="fa fa-chart-bar iconic"></i></a>'+
	                               '<a  title="Histogram" id="horizontal'+vis.id+'" ><i class="fa fa-align-left  iconic"></i></a>'+
	                               '<a  title="Histogram" id="horizontal_stack'+vis.id+'" ><i class="fa fa-align-left  iconic"></i></a>'+
	                               '<a  title="Area" id="areaprop'+vis.id+'" ><i class="fa fa-chart-area iconic"></i></a>'+
	                               '<a  title="Pie chart" id="pieprop'+vis.id+'"  ><i class="fa fa-chart-pie iconic"></i></a>'+
	                               '<a  title="Line chart" id="lineprop'+vis.id+'"  ><i class="fa fa-chart-line iconic"></i></a>'+
	                               '<a  title="Table" id="tableprop'+vis.id+'"  ><i class="fa fa-table iconic"></i></a>'+
	                               '<a hidden  title="Sort" id="sort'+vis.id+'"  ><i class="fa fa-sort iconic"></i></a>'+
	                               '<a title="Map" id="map'+vis.id+'"  ><i class="fa fa-map-marker iconic"></i></a>'+
	
	                               '</div>'+
	                       '</div>'); 
	                     $('#drop_id'+vis.id).hide();
	                       let sort_status='false';
	
	                       (function(index){


	                       $('#numb'+vis.id).empty();
									         var myChart={
									         chart: {
									           events: {
									             load() {
									               const chart = this;
									               chart.showLoading('<h2>Loading data...</h2>');
									             
									             }
									           }
									         },
									           credits: {
	                                   text: 'Source: dhis2.org'
	                               },

	                               title: {
	                                   text: vis.title
	                               },
									         series: [{
									           data: []
									         }]
									       };
									
									       myChart.chart.renderTo='numb'+vis.id;
									       var chart1=new Highcharts.Chart(myChart);
	                   
	
	
	                     })(i);
	
	                     continue;
	
	                   
	                      }
	
	
	
	                       else {  //elseunfilter 
	
	                       $('#vis'+vis.tab_id).append(
	
	                       '<div class="row"  id="vis_id'+vis.id+'">'+
	                       '<div  style="padding-left: 15px;padding-right: 10px;width:50%">'+
	                       '<div class="chart-container row"  style="margin-top: 5px;">'+
	                      '<div class=" col-md-12 chartheader">'+
                          
                           '<div class="float-left " style="font-size: 14px;width:80%;margin-left: 4px;"> <strong>'+vis.title+'</strong></div>'+
                            '<div class="float-right">'+

                  

                             '<div class="dropdown">'+
												  '<button class="btn  dropdown-toggle style="display:none;" chart-dropdown"  type="button" id="drop_id'+vis.id+'" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">'+

												  '</button>'+
												  '<div class="dropdown-menu" aria-labelledby="drop_id'+vis.id+'">'+
												    '<a class="dropdown-item"  id="download-csv'+vis.id+'"> Download CSV </a>'+
												   '<a class="dropdown-item" id="download-xlsx'+vis.id+'"> Download XLSX </a>'+
												   ' <a class="dropdown-item" id="download-pdf'+vis.id+'"> Download pdf </a>'+
												  '</div>'+
												'</div>'+
	
	                      
	                       '</div>'+
	                       '</div>'+
	                       '<div class="col-md-12" >'+
	                       '<div id="numb'+vis.id+'" style="width:100%; height:350px;"></div>'+
	                       
	                       '<div class="row chart-menu">'+
	                               '<a  title="Histogram" id="bar'+vis.id+'"  ><i class="fa fa-chart-bar iconic"></i></a>'+
	                               '<a  title="Histogram" id="barstack'+vis.id+'" ><i class="fa fa-chart-bar iconic"></i></a>'+
	                               '<a  title="Histogram" id="horizontal'+vis.id+'" ><i class="fa fa-align-left  iconic"></i></a>'+
	                               '<a  title="Histogram" id="horizontal_stack'+vis.id+'" ><i class="fa fa-align-left  iconic"></i></a>'+
	                               '<a  title="Area" id="areaprop'+vis.id+'" ><i class="fa fa-chart-area iconic"></i></a>'+
	                               '<a  title="Pie chart" id="pieprop'+vis.id+'"  ><i class="fa fa-chart-pie iconic"></i></a>'+
	                               '<a  title="Line chart" id="lineprop'+vis.id+'"  ><i class="fa fa-chart-line iconic"></i></a>'+
	                               '<a  title="Table" id="tableprop'+vis.id+'"  ><i class="fa fa-table iconic"></i></a>'+
	                                '<a  title="Sort" id="sort'+vis.id+'"  ><i class="fa fa-sort iconic"></i></a>'+
	
	                               '</div>'+
	                       '</div>'); 
	                     
	     
						$('#drop_id'+vis.id).hide();
	                       // let sort_status='false';
	
	                       (function(index){
	                          
	                     
												 $('#numb'+vis.id).empty();
									         var myChart={
									         chart: {
									           events: {
									             load() {
									               const chart = this;
									               chart.showLoading('<h2>Loading data...</h2>');
									             
									             }
									           }
									         },
									           credits: {
	                                   text: 'Source: dhis2.org'
	                               },
									         series: [{
									           data: []
									         }]
									       };
									
									       myChart.chart.renderTo='numb'+vis.id;
									       var chart1=new Highcharts.Chart(myChart);
	
	
	                     // });
	
	                 
	
	
	                 //This is fproportinal table 
	                       $('#vis_id'+vis.id).append(
	                       '<div  style="padding-right: 15px;padding-left: 10px;width:50%">'+
	                       '<div class=" chart-container row" id="visid'+vis.id+'" style="margin-top: 5px;">'+
	                     '<div class=" col-md-12 chartheader">'+
                          
                           '<div class="float-left " style="font-size: 14px;width:80%;margin-left: 4px;"> <strong>'+vis.title+'</strong></div>'+
                            '<div class="float-right">'+

                           '<div class="dropdown">'+
                            '<button  style="box-shadow: 0 12px 39px -8px rgba(9, 9, 16, .2);" class="chart-dropdown dropbtn btn btn-link dropdown-toggle"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" style="color:#888888" aria-hidden="true"></i>'+
			  				'</button>'+


			  				'<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'+
						    '<a class="dropdown-item" onclick="general_period_filter('+vis.id+', '+vis.tab_id+','+vis.chart_type+')">Period</a>'+
							'<a class="dropdown-item" onclick="local_organization_filter('+vis.id+', '+vis.tab_id+','+vis.chart_type+')">Organization Unit</a>'+
							 '<a class="dropdown-item" href="'+link+vis.id+'">Edit</i></a>'+
							'</div>'+
							'</div>'+

							 '<div class="dropdown">'+
						  '<button class="btn style="display:none;" dropdown-toggle style="display:none;" chart-dropdown" type="button" id="drop_idp'+vis.id+'" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">'+

						  '</button>'+
						  '<div class="dropdown-menu" aria-labelledby="drop_id_p'+vis.id+'">'+
						    '<a class="dropdown-item"  id="download-csvp'+vis.id+'"> Download CSV </a>'+
						   '<a class="dropdown-item" id="download-xlsxp'+vis.id+'"> Download XLSX </a>'+
						   ' <a class="dropdown-item" id="download-pdfp'+vis.id+'"> Download pdf </a>'+
						  '</div>'+
						'</div>'+
	                      
	                       '</div>'+
	                       '</div>'+
	                       '<div class="col-md-12" >'+
	                       '<div id="numb_p'+vis.id+'" style="width:100%; height:350px;"></div>'+
	                       
	                       '<div class="row chart-menu">'+
	                               '<a  title="Histogram" id="bar_p'+vis.id+'"  ><i class="fa fa-chart-bar iconic"></i></a>'+
	                               '<a  title="Histogram" id="barstack_p'+vis.id+'" ><i class="fa fa-chart-bar iconic"></i></a>'+
	                               '<a  title="Histogram" id="horizontal_p'+vis.id+'" ><i class="fa fa-align-left  iconic"></i></a>'+
	                               '<a  title="Histogram" id="horizontal_stack_p'+vis.id+'" ><i class="fa fa-align-left  iconic"></i></a>'+
	                               '<a  title="Area" id="areaprop_p'+vis.id+'" ><i class="fa fa-chart-area iconic"></i></a>'+
	                               '<a  title="Pie chart" id="pieprop_p'+vis.id+'"  ><i class="fa fa-chart-pie iconic"></i></a>'+
	                               '<a  title="Line chart" id="lineprop_p'+vis.id+'"  ><i class="fa fa-chart-line iconic"></i></a>'+
	                               '<a  title="Table" id="tableprop_p'+vis.id+'"  ><i class="fa fa-table iconic"></i></a>'+
	                                '<a  title="Sort" id="sort_p'+vis.id+'"  ><i class="fa fa-sort iconic"></i></a>'+
	
	                               '</div>'+
	                       '</div>'); 


	                     
	     				$('#drop_id'+vis.id).hide();
	
	                       // let sort_status='false';
	
	                      
	                       $('#numb_p'+vis.id).empty();
									         var myChart2={
									         chart: {
									           events: {
									             load() {
									               const chart = this;
									               chart.showLoading('<h2>Loading data...</h2>');
									             
									             }
									           }
									         },

							           credits: {
                                 text: 'Source: dhis2.org'
                             },
									         series: [{
									           data: []
									         }]
									       };
									
									       myChart2.chart.renderTo='numb_p'+vis.id;
									       var chart1=new Highcharts.Chart(myChart2);
	
	                    
	
	                  })(i);
	                 
	                     continue;
	
	                   
	                      }

	    
	       
	
	                //end charts     
	            }
	
	                     catch(err) {
	
	              $('#numb'+vis.id).empty();
	                   var myChart={
	                   chart: {
	                     events: {
	                       load() {
	                         const chart = this;
	                         chart.showLoading('<h2>Loading data...</h2>');
	                       
	                       }
	                     }
	                   },
	                     credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	
	                   title: {
	                          text:  vis.title,
	               },
	                   series: [{
	                     data: []
	                   }]
	                 };
	
	                 myChart.chart.renderTo='numb'+vis.id;
	                 var chart1=new Highcharts.Chart(myChart);
	                     
	                     }


	                     


	                     }//end loop
	
	               // hide the loader
	               $('#innerTab'+id).css('display', 'none'); 
	
	return vis_id_array;
	       
}