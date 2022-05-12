function edit_containers(data,id,link,gridstack){

	Highcharts.SVGRenderer.prototype.symbols.download = function(x, y, w, h) {
	  var path = [
	    // Arrow stem
	    'M', x + w * 0.5, y,
	    'L', x + w * 0.5, y + h * 0.7,
	    // Arrow head
	    'M', x + w * 0.3, y + h * 0.5,
	    'L', x + w * 0.5, y + h * 0.7,
	    'L', x + w * 0.7, y + h * 0.5,
	    // Box
	    'M', x, y + h * 0.9,
	    'L', x, y + h,
	    'L', x + w, y + h,
	    'L', x + w, y + h * 0.9
	  ];
	  return path;
	};



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

	                        var style=JSON.parse(vis.style)['style']


	                      
	                      //consolee.log('The length',JSON.parse(data)['items'][vis.id].length);
	
	                  // try {
	                       // JSON.parse(data)['items'][vis.id];
	                    
	
	                       // let result = element_values.map(i=>Number(i));
	                     if (vis.chart_type==4) {	 
	                     // console.log("The sequence", style['size_x'], style['size_y'],style['col'],style['row'])                    	
	    
	                         gridstack.addWidget({x:style['col'], y:style['row'], w:style['size_x'],h:style['size_y'],id:'lis'+vis.id, content:'<div class="single_values  chart-container " id="vis_id'+vis.id+'" style="height:100%;width:100%;">'+
						        '<div class="col-md-12" style="display: inline-flex; padding:6px">'+
				           ' <div class="col-md-8" style="padding:0px">'+
				                '<strong style="float: left;">'+vis.title+'</strong>'+  
				            '</div>'+

				           ' <div class="col-md-4" style="padding:0px">'+

				                 '<div class="dropdown"  style="float:right">'+
         //                    '<button  style="box-shadow: 0 12px 39px -8px rgba(9, 9, 16, .2);" class="chart-dropdown dropbtn btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-filter" style="color:#00796b;width: 100%;height: 100%;" aria-hidden="true"></i>'+
			  				// '</button>'+

			  				'<button   style="float:right" data-toggle="dropdown" class="chart-dropdown btn btn-link "><i class="fa fa-filter" style="color:#00796b;width: 100%;height: 100%;" aria-hidden="true"></i></button> '+

			  				'<div class="dropdown-menu dropdown-menu-right" style="z-index: 1001;" aria-labelledby="dropdownMenuButton">'+
						 //    '<a class="dropdown-item" style="display: inline flow-root list-item;" onclick="general_period_filter('+vis.id+', '+vis.tab_id+','+vis.chart_type+')">Period</a> <br>'+
							// '<a class="dropdown-item" style="display: inline flow-root list-item;" onclick="local_organization_filter('+vis.id+', '+vis.tab_id+','+vis.chart_type+')">Organization Unit</a><br>'+
							'<a class="dropdown-item" style="display: inline flow-root list-item;" href="'+link+vis.id+'">Edit</i></a><br>'+
							// '<a class="dropdown-item" style="display: inline flow-root list-item;" onclick=" comment('+vis.id+') ">Comment</a>'+
							'</div>'+
                      ' </div>'+


				            '</div>'+
				        '</div>'+		
				      												      
				           '<div style="overflow:hidden;height:65%">'+	
				         '<div class="col-md-12" >'+
				            '<div class="col-md-12" style="margin: 5px;text-align: center;height: 20px">'+

				                  ' <p style="font-size: 1.1vw;"><div aria-label="Content is loading..." aria-live="polite" role="progressbar" id="preview-loader" class="dhis2loader"></div></p>'+

				            '</div>'+

				       ' </div>'+


				         '<div class="col-md-12" >'+
				            '<div class="col-md-12" style="margin: 5px;height: 20px;text-align: center;">'+

				             

				            '</div>'+



				       ' </div>'+


				         '<div class="col-md-12" >'+
				           ' <div class="col-md-8" style="margin: auto;text-align: center;font-size:7vmax ">'+

				                
				           ' </div>'+


				       ' </div>'+

				       '</div>'+

						
						   

						     '</div>'});

								}
										
	
	                 else if(vis.chart_type==1){

	
	                        gridstack.addWidget({x:style['col'], y:style['row'], w:style['size_x'],h:style['size_y'],id:'lis'+vis.id,content:'<div class=" chart-container " id="vis_id'+vis.id+'" style="height:100%;width:100%;">'+
	                       '<div class=" col-md-12 chartheader">'+
                          
                           '<div class="float-left " style="font-size: 14px;width:80%;margin-left: 4px;"> <strong style="float: left;">'+vis.title+'</strong></div>'+
                            '<div class="float-right">'+

                            '<div class="dropdown" style="float:right" >'+
         //                    '<button  style="box-shadow: 0 12px 39px -8px rgba(9, 9, 16, .2);" class="chart-dropdown dropbtn btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-filter" style="color:#00796b;width: 100%;height: 100%;" aria-hidden="true"></i>'+
			  				// '</button>'+

			  				'<button   style="float:right" data-toggle="dropdown" class="chart-dropdown btn btn-link "><i class="fa fa-filter" style="color:#00796b;width: 100%;height: 100%;" aria-hidden="true"></i></button> '+

			  				'<div class="dropdown-menu dropdown-menu-right" style="z-index: 1001;" aria-labelledby="dropdownMenuButton">'+
						 //    '<a class="dropdown-item" style="display: inline flow-root list-item;" onclick="general_period_filter('+vis.id+', '+vis.tab_id+','+vis.chart_type+')">Period</a> <br>'+
							// '<a class="dropdown-item" style="display: inline flow-root list-item;" onclick="local_organization_filter('+vis.id+', '+vis.tab_id+','+vis.chart_type+')">Organization Unit</a><br>'+
							'<a class="dropdown-item" style="display: inline flow-root list-item;" href="'+link+vis.id+'">Edit</i></a><br>'+
							// '<a class="dropdown-item" style="display: inline flow-root list-item;" onclick=" comment('+vis.id+') ">Comment</a>'+
							'</div>'+
							'</div>'+

						 '<div class="dropdown">'+
						 '<button class="btn   chart-dropdown" type="button" id="drop_id'+vis.id+'" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false"><i class="fa fa-arrow-down "></i>'+
							  // '<button   style="float:right" data-toggle="dropdown" class="chart-dropdown btn btn-link "><i class="fa fa-filter" style="color:#00796b;width: 100%;height: 100%;" aria-hidden="true"></i></button> '+

							 '</button>'+
						  '<div class="dropdown-menu dropdown-menu-right" style="z-index: 1001;" aria-labelledby="drop_id'+vis.id+'">'+
						    '<a class="dropdown-item" style="display: inline flow-root list-item;"  id="download-csv'+vis.id+'"> Download CSV </a>'+
						   '<a class="dropdown-item" style="display: inline flow-root list-item;" id="download-xlsx'+vis.id+'"> Download XLSX </a>'+
						   ' <a class="dropdown-item" style="display: inline flow-root list-item;" id="download-pdf'+vis.id+'"> Download pdf </a>'+
						  '</div>'+
						  '</div>'+
							
	                       '</div>'+
	                       '</div>'+
	                       '<div class="col-md-12" style="overflow:hidden;height:100%">'+
	                        // '<div  style="background-color:black;padding:0px;">'+
	                       '<div id="numb'+vis.id+'" class=" numb'+vis.id+'" style="height:85%;background:gradient(to top right,transparent 50%,#608A32 0) top right/40px 40px no-repeat,black;"></div>'+
	                        '</div>'+
	                        '<div class="col-md-12" style="overflow:hidden;position:absolute; bottom:0;">'+
	                       '<div class="row chart-menu">'+
	                               '<a  title="Histogram" id="bar'+vis.id+'"  ><i class="fa fa-chart-bar iconic_chart"></i></a>'+
	                               '<a  title="Histogram" id="barstack'+vis.id+'" ><i class="fa fa-chart-bar iconic_chart"></i></a>'+
	                               '<a  title="Histogram" id="horizontal'+vis.id+'" ><i class="fa fa-align-left  iconic_chart"></i></a>'+
	                               '<a  title="Histogram" id="horizontal_stack'+vis.id+'" ><i class="fa fa-align-left  iconic_chart"></i></a>'+
	                               '<a  title="Area" id="areaprop'+vis.id+'" ><i class="fa fa-chart-area iconic_chart"></i></a>'+
	                               '<a  title="Pie chart" id="pieprop'+vis.id+'"  ><i class="fa fa-chart-pie iconic_chart"></i></a>'+
	                               '<a  title="Line chart" id="lineprop'+vis.id+'"  ><i class="fa fa-chart-line iconic_chart"></i></a>'+
	                               '<a  title="Table" id="tableprop'+vis.id+'"  ><i class="fa fa-table iconic_chart"></i></a>'+
	                               '<a hidden  title="Sort" id="sort'+vis.id+'"  ><i class="fa fa-sort iconic_chart"></i></a>'+
	                               '<a hidden title="Map" id="map'+vis.id+'"  ><i class="fa fa-map-marker iconic_chart"></i></a>'+
	
	                               '</div>'+
	                                '</div>'+
	                       '</div>'});
	                     $('#drop_id'+vis.id).hide();
	                       let sort_status='false';
	
	                       (function(index){


	                       $('#numb'+vis.id).empty();
									         var myChart={
									         chart: {
									           events: {
									             load() {
									               const chart = this;
									               chart.showLoading('<div aria-label="Content is loading..." aria-live="polite" role="progressbar" id="preview-loader" class="dhis2loader"></div>');
									             
									             }
									           }
									         },
									           credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	                               title: {
	                                   text:  vis.title
	                               },
	                               exporting: {
	                               	buttons: {
								      contextButton: {
								        symbol: 'download'
								      }
								    }
							      
							    	},
	                               series: [{
									 			name:"",
									           data: []
									         }]
									       };
									
									       myChart.chart.renderTo='numb'+vis.id;
									       var chart1=new Highcharts.Chart(myChart);

	                      
	
	
	
	                     })(i);
	
	                     continue;
	
	                   
	                   }
	
	                else if(vis.chart_type==3){    //Unfiltered table

							
	                        gridstack.addWidget({x:style['col'], y:style['row'], w:style['size_x'],h:style['size_y'],id:'lis'+vis.id, content:'<div class=" chart-container " id="vis_id'+vis.id+'" style="height:100%;width:100%;">'+
	                       '<div class=" col-md-12 chartheader">'+
                          
                           '<div class="float-left " style="font-size: 14px;width:80%;margin-left: 4px;"> <strong style="float: left;">'+vis.title+'</strong></div>'+
                            '<div class="float-right">'+

                            '<div class="dropdown" style="float:right" >'+
         //                    '<button  style="box-shadow: 0 12px 39px -8px rgba(9, 9, 16, .2);" class="chart-dropdown dropbtn btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-filter" style="color:#00796b;width: 100%;height: 100%;" aria-hidden="true"></i>'+
			  				// '</button>'+

			  				'<button   style="float:right" data-toggle="dropdown" class="chart-dropdown btn btn-link "><i class="fa fa-filter" style="color:#00796b;width: 100%;height: 100%;" aria-hidden="true"></i></button> '+

			  				'<div class="dropdown-menu dropdown-menu-right" style="z-index: 1001;" aria-labelledby="dropdownMenuButton">'+
						 //    '<a class="dropdown-item" style="display: inline flow-root list-item;" onclick="general_period_filter('+vis.id+', '+vis.tab_id+', '+vis.chart_type+')">Period</a>'+
							// '<a class="dropdown-item" style="display: inline flow-root list-item;" onclick="local_organization_filter('+vis.id+', '+vis.tab_id+', '+vis.chart_type+')">Organization Unit</a>'+
							'<a class="dropdown-item" style="display: inline flow-root list-item;" href="'+link+vis.id+'">Edit</i></a>'+
							// '<a class="dropdown-item" style="display: inline flow-root list-item;" onclick=" comment('+vis.id+') ">Comment</a>'+
							'</div>'+
							'</div>'+

						 '<div class="dropdown">'+
						 '<button class="btn   chart-dropdown" type="button" id="drop_id'+vis.id+'" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false"><i class="fa fa-arrow-down "></i>'+
							  // '<button   style="float:right" data-toggle="dropdown" class="chart-dropdown btn btn-link "><i class="fa fa-filter" style="color:#00796b;width: 100%;height: 100%;" aria-hidden="true"></i></button> '+

							 '</button>'+
						  '<div class="dropdown-menu dropdown-menu-right" style="z-index: 1001;" aria-labelledby="drop_id'+vis.id+'">'+
						    '<a class="dropdown-item" style="display: inline flow-root list-item;"  id="download-csv'+vis.id+'"> Download CSV </a>'+
						   '<a class="dropdown-item" style="display: inline flow-root list-item;" id="download-xlsx'+vis.id+'"> Download XLSX </a>'+
						   ' <a class="dropdown-item" style="display: inline flow-root list-item;" id="download-pdf'+vis.id+'"> Download pdf </a>'+
						  '</div>'+
						  '</div>'+
							
	                       '</div>'+
	                       '</div>'+
	                       '<div class="col-md-12" style="overflow:hidden;height:96%;">'+
	                        // '<div  style="background-color:black;padding:0px;">'+
	                       '<div id="numb'+vis.id+'" class=" numb'+vis.id+'" style="height:85%;background:gradient(to top right,transparent 50%,#608A32 0) top right/40px 40px no-repeat,black;"></div>'+
	                        '</div>'+
	                        '<div class="col-md-12" style="overflow:hidden;position:absolute; bottom:0;">'+
	                       '<div class="row chart-menu">'+
	                               '<a  title="Histogram" id="bar'+vis.id+'"  ><i class="fa fa-chart-bar iconic_chart"></i></a>'+
	                               '<a  title="Histogram" id="barstack'+vis.id+'" ><i class="fa fa-chart-bar iconic_chart"></i></a>'+
	                               '<a  title="Histogram" id="horizontal'+vis.id+'" ><i class="fa fa-align-left  iconic_chart"></i></a>'+
	                               '<a  title="Histogram" id="horizontal_stack'+vis.id+'" ><i class="fa fa-align-left  iconic_chart"></i></a>'+
	                               '<a  title="Area" id="areaprop'+vis.id+'" ><i class="fa fa-chart-area iconic_chart"></i></a>'+
	                               '<a  title="Pie chart" id="pieprop'+vis.id+'"  ><i class="fa fa-chart-pie iconic_chart"></i></a>'+
	                               '<a  title="Line chart" id="lineprop'+vis.id+'"  ><i class="fa fa-chart-line iconic_chart"></i></a>'+
	                               '<a  title="Table" id="tableprop'+vis.id+'"  ><i class="fa fa-table iconic_chart"></i></a>'+
	                               '<a hidden  title="Sort" id="sort'+vis.id+'"  ><i class="fa fa-sort iconic_chart"></i></a>'+
	                               '<a title="Map" id="map'+vis.id+'"  ><i class="fa fa-map-marker iconic_chart"></i></a>'+
	                                '<a   title="Normal" id="a_z_sort' + vis.id + '"  ><i class="fa fa-sort-alpha-asc fa-rotate-270 iconic_chart "></i></a>' +
				                    '<a   title="Descending" id="descending'+ vis.id + '"  ><i class="fa fa-sort-amount-asc fa-rotate-270 iconic_chart"></i></a>' +
				                    '<a   title="Ascending" id="ascending'+ vis.id + '"  ><i class="fa fa-sort-amount-desc fa-rotate-270 iconic_chart"></i></a>' +
	
	                               '</div>'+
	                                '</div>'+
	                       '</div>'});

	                     $('#drop_id'+vis.id).hide();
	                       let sort_status='false';
	
	                       (function(index){


	                       $('#numb'+vis.id).empty();
									         var myChart={
									         chart: {
									           events: {
									             load() {
									               const chart = this;
									               chart.showLoading('<div aria-label="Content is loading..." aria-live="polite" role="progressbar" id="preview-loader" class="dhis2loader"></div>');
									             
									             }
									           }
									         },
									           credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	                               exporting: {
	                               	buttons: {
								      contextButton: {
								        symbol: 'download'
								      }
								    }
							      
							    	},

	                               title: {
	                                   text: vis.title
	                               },									         series: [{
									         	name:"",
									           data: []
									         }]
									       };
									
									       myChart.chart.renderTo='numb'+vis.id;
									       var chart1=new Highcharts.Chart(myChart);
	                   
	
	
	                     })(i);
	
	                     continue;
	
	                   
	                      }
	
	
	
	                       else {  //elseunfilter 
	
	                        gridstack.addWidget({x:style['col'], y:style['row'], w:style['size_x'],h:style['size_y'],id:'lis'+vis.id,content:'<div class="row  two-charts-container" style="display:inline-flex;padding:1px;width:100%;height:100%;margin:0px" id="vis_id'+vis.id+'">'+
	                      ' <div class=" chart-container " id="vis_id'+vis.id+'" style="height:100%;width:49.5%;margin-right:0.5%">'+
	                       '<div class=" col-md-12 chartheader">'+
                          
                           '<div class="float-left " style="font-size: 14px;width:80%;margin-left: 4px;"> <strong style="float: left;">'+vis.title+'</strong></div>'+
                            '<div class="float-right">'+

                            '<div class="dropdown" style="float:right" >'+
         //                    '<button  style="box-shadow: 0 12px 39px -8px rgba(9, 9, 16, .2);" class="chart-dropdown dropbtn btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-filter" style="color:#00796b;width: 100%;height: 100%;" aria-hidden="true"></i>'+
			  				// '</button>'+

			  		// 		'<button   style="float:right" data-toggle="dropdown" class="chart-dropdown btn btn-link "><i class="fa fa-filter" style="color:#00796b;width: 100%;height: 100%;" aria-hidden="true"></i></button> '+

			  		// 		'<div class="dropdown-menu dropdown-menu-right" style="z-index: 1001;" aria-labelledby="dropdownMenuButton">'+
						 // //    '<a class="dropdown-item" style="display: inline flow-root list-item;" onclick="general_period_filter('+vis.id+', '+vis.tab_id+', '+vis.chart_type+')">Period</a>'+
							// // '<a class="dropdown-item" style="display: inline flow-root list-item;" onclick="local_organization_filter('+vis.id+', '+vis.tab_id+', '+vis.chart_type+')">Organization Unit</a>'+
							// '<a class="dropdown-item" style="display: inline flow-root list-item;" href="'+link+vis.id+'">Edit</i></a>'+
							// // '<a class="dropdown-item" style="display: inline flow-root list-item;" onclick=" comment('+vis.id+') ">Comment</a>'+
							// '</div>'+
							'</div>'+

						 '<div class="dropdown">'+
						 '<button class="btn   chart-dropdown" type="button" id="drop_id'+vis.id+'" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false"><i class="fa fa-arrow-down "></i>'+
							  // '<button   style="float:right" data-toggle="dropdown" class="chart-dropdown btn btn-link "><i class="fa fa-filter" style="color:#00796b;width: 100%;height: 100%;" aria-hidden="true"></i></button> '+

							 '</button>'+
						  '<div class="dropdown-menu dropdown-menu-right" style="z-index: 1001;" aria-labelledby="drop_id'+vis.id+'">'+
						    '<a class="dropdown-item" style="display: inline flow-root list-item;"  id="download-csv'+vis.id+'"> Download CSV </a>'+
						   '<a class="dropdown-item" style="display: inline flow-root list-item;" id="download-xlsx'+vis.id+'"> Download XLSX </a>'+
						   ' <a class="dropdown-item" style="display: inline flow-root list-item;" id="download-pdf'+vis.id+'"> Download pdf </a>'+
						  '</div>'+
						  '</div>'+
							
	                       '</div>'+
	                       '</div>'+
	                       '<div class="col-md-12" style="overflow:hidden;height:96%;">'+
	                        // '<div  style="background-color:black;padding:0px;">'+
	                       '<div id="numb'+vis.id+'" class=" numb'+vis.id+'" style="height:85%;background:gradient(to top right,transparent 50%,#608A32 0) top right/40px 40px no-repeat,black;"></div>'+
	                        '</div>'+
	                        '<div class="col-md-12" style="overflow:hidden;position:absolute; bottom:0;width:50%">'+
	                       '<div class="row chart-menu">'+
	                               '<a  title="Histogram" id="bar'+vis.id+'"  ><i class="fa fa-chart-bar iconic_chart"></i></a>'+
	                               '<a  title="Histogram" id="barstack'+vis.id+'" ><i class="fa fa-chart-bar iconic_chart"></i></a>'+
	                               '<a  title="Histogram" id="horizontal'+vis.id+'" ><i class="fa fa-align-left  iconic_chart"></i></a>'+
	                               '<a  title="Histogram" id="horizontal_stack'+vis.id+'" ><i class="fa fa-align-left  iconic_chart"></i></a>'+
	                               '<a  title="Area" id="areaprop'+vis.id+'" ><i class="fa fa-chart-area iconic_chart"></i></a>'+
	                               '<a  title="Pie chart" id="pieprop'+vis.id+'"  ><i class="fa fa-chart-pie iconic_chart"></i></a>'+
	                               '<a  title="Line chart" id="lineprop'+vis.id+'"  ><i class="fa fa-chart-line iconic_chart"></i></a>'+
	                               '<a  title="Table" id="tableprop'+vis.id+'"  ><i class="fa fa-table iconic_chart"></i></a>'+
	                               '<a hidden title="Sort" id="sort'+vis.id+'"  ><i class="fa fa-sort iconic_chart"></i></a>'+
	                               '<a hidden title="Map" id="map'+vis.id+'"  ><i class="fa fa-map-marker iconic_chart"></i></a>'+
	
	                               '</div>'+
	                                '</div>'+
	                       '</div>'+
	                       '<div class=" chart-container " id="vis_id'+vis.id+'" style="height:100%;width:50%;">'+
	                       '<div class=" col-md-12 chartheader">'+
                          
                           '<div class="float-left " style="font-size: 14px;width:80%;margin-left: 4px;"> <strong style="float: left;">'+vis.title+'</strong></div>'+
                            '<div class="float-right">'+

                            '<div class="dropdown" style="float:right" >'+
         //                    '<button  style="box-shadow: 0 12px 39px -8px rgba(9, 9, 16, .2);" class="chart-dropdown dropbtn btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-filter" style="color:#00796b;width: 100%;height: 100%;" aria-hidden="true"></i>'+
			  				// '</button>'+

			  				'<button   style="float:right" data-toggle="dropdown" class="chart-dropdown btn btn-link "><i class="fa fa-filter" style="color:#00796b;width: 100%;height: 100%;" aria-hidden="true"></i></button> '+

			  				'<div class="dropdown-menu dropdown-menu-right" style="z-index: 1001;" aria-labelledby="dropdownMenuButton">'+
						 //    '<a class="dropdown-item" style="display: inline flow-root list-item;" onclick="general_period_filter('+vis.id+', '+vis.tab_id+', '+vis.chart_type+')">Period</a>'+
							// '<a class="dropdown-item" style="display: inline flow-root list-item;" onclick="local_organization_filter('+vis.id+', '+vis.tab_id+', '+vis.chart_type+')">Organization Unit</a>'+
							'<a class="dropdown-item" style="display: inline flow-root list-item;" href="'+link+vis.id+'">Edit</i></a>'+
							// '<a class="dropdown-item" style="display: inline flow-root list-item;" onclick=" comment('+vis.id+') ">Comment</a>'+
							'</div>'+
							'</div>'+

						 '<div class="dropdown">'+
						 '<button class="btn   chart-dropdown" type="button" id="drop_id_p'+vis.id+'" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false"><i class="fa fa-arrow-down "></i>'+
							  // '<button   style="float:right" data-toggle="dropdown" class="chart-dropdown btn btn-link "><i class="fa fa-filter" style="color:#00796b;width: 100%;height: 100%;" aria-hidden="true"></i></button> '+

							 '</button>'+
						  '<div class="dropdown-menu dropdown-menu-right" style="z-index: 1001;" aria-labelledby="drop_id'+vis.id+'">'+
						    '<a class="dropdown-item" style="display: inline flow-root list-item;"  id="download-csv'+vis.id+'"> Download CSV </a>'+
						   '<a class="dropdown-item" style="display: inline flow-root list-item;" id="download-xlsx'+vis.id+'"> Download XLSX </a>'+
						   ' <a class="dropdown-item" style="display: inline flow-root list-item;" id="download-pdf'+vis.id+'"> Download pdf </a>'+
						  '</div>'+
						  '</div>'+
							
	                       '</div>'+
	                       '</div>'+
	                       '<div class="col-md-12" style="overflow:hidden;height:96%;">'+
	                        // '<div  style="background-color:black;padding:0px;">'+
	                       '<div id="numb_p'+vis.id+'" class="numb_p'+vis.id+'" style="height:85%;background:gradient(to top right,transparent 50%,#608A32 0) top right/40px 40px no-repeat,black;"></div>'+
	                        '</div>'+
	                        '<div class="col-md-12" style="overflow:hidden;position:absolute; bottom:0;width:50%">'+
	                       '<div class="row chart-menu">'+
	                               '<a  title="Histogram" id="bar_p'+vis.id+'"  ><i class="fa fa-chart-bar iconic_chart"></i></a>'+
	                               '<a  title="Histogram" id="barstack_p'+vis.id+'" ><i class="fa fa-chart-bar iconic_chart"></i></a>'+
	                               '<a  title="Histogram" id="horizontal_p'+vis.id+'" ><i class="fa fa-align-left  iconic_chart"></i></a>'+
	                               '<a  title="Histogram" id="horizontal_stack_p'+vis.id+'" ><i class="fa fa-align-left  iconic_chart"></i></a>'+
	                               '<a  title="Area" id="areaprop_p'+vis.id+'" ><i class="fa fa-chart-area iconic_chart"></i></a>'+
	                               '<a  title="Pie chart" id="pieprop_p'+vis.id+'"  ><i class="fa fa-chart-pie iconic_chart"></i></a>'+
	                               '<a  title="Line chart" id="lineprop_p'+vis.id+'"  ><i class="fa fa-chart-line iconic_chart"></i></a>'+
	                               '<a  title="Table" id="tableprop_p'+vis.id+'"  ><i class="fa fa-table iconic_chart"></i></a>'+
	                               '<a hidden  title="Sort" id="sort_p'+vis.id+'"  ><i class="fa fa-sort iconic_chart"></i></a>'+
	                               '<a hidden title="Map" id="map_p'+vis.id+'"  ><i class="fa fa-map-marker iconic_chart"></i></a>'+
	
	                               '</div>'+
	                                '</div>'+
	                       '</div>'});

	                       //Normal Chart

	                       		$('#drop_id_p'+vis.id).hide();
	                       		$('#drop_id'+vis.id).hide();
	                       // let sort_status='false';
	
	                       (function(index){
	                          
	                     
												 $('#numb'+vis.id).empty();
									         var myChart={
									         chart: {
									           events: {
									             load() {
									               const chart = this;
									               chart.showLoading('<div aria-label="Content is loading..." aria-live="polite" role="progressbar" id="preview-loader" class="dhis2loader"></div>');
									             
									             }
									           }
									         },
									           credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	                                 title: {
	                                   text:  ''
	                               },
	                               exporting: {
	                               	buttons: {
								      contextButton: {
								        symbol: 'download'
								      }
								    }
							      
							    	},
	                                 yAxis: {
	                                   min: 0,
	                                   endOnTick:false,
	                                   title: {
	                                       text: 'Number of supervised HFs',
	                                   },	                               
	                               },
									         series: [{
									         	name:"",
									           data: []
									         }]
									       };
									
									       myChart.chart.renderTo='numb'+vis.id;
									       var chart1=new Highcharts.Chart(myChart);


	                     
	     				$('#drop_id'+vis.id).hide();
	
	                       // let sort_status='false';
	
	                      //Proportinal Chart
	                       $('#numb_p'+vis.id).empty();
									         var myChart2={
									         chart: {
									           events: {
									             load() {
									               const chart = this;
									               chart.showLoading('<div aria-label="Content is loading..." aria-live="polite" role="progressbar" id="preview-loader" class="dhis2loader"></div>');
									             
									             }
									           }
									         },

									         title: {
	                                   text:  ''
	                               },	                               yAxis: {
	                                   min: 0,
	                                   endOnTick:false,
	                                   title: {
	                                       text: 'Proportion of supervised HFs',
	                                   },	                               
	                               },

							           credits: {
                                 text: 'Source: dhis2.org'
                             },
                             exporting: {
	                               	buttons: {
								      contextButton: {
								        symbol: 'download'
								      }
								    }
							      
							    	},
					         series: [{
					         	name:"",
					           data: []
					         }]
					       };
					
					       myChart2.chart.renderTo='numb_p'+vis.id;
					       var chart1=new Highcharts.Chart(myChart2);
	
	                    
	
	                  })(i);
	                 
	                     continue;
	
	                   
	                      }

	    
	       
	
	                //end charts     
	            // }
	
	              //        catch(err) {
	
	              // $('#numb'+vis.id).empty();
	              //      var myChart={
	              //      chart: {
	              //        events: {
	              //          load() {
	              //            const chart = this;
	              //            chart.showLoading('<div aria-label="Content is loading..." aria-live="polite" role="progressbar" id="preview-loader" class="dhis2loader"></div>');
	                       
	              //          }
	              //        }
	              //      },
	              //        credits: {
	              //                      text: 'Source: dhis2.org'
	              //                  },
	
	              //      title: {
	              //             text:  vis.title,
	              //  },
	              //      series: [{
	              //      	name:"",
	              //        data: []
	              //      }]
	              //    };
	
	              //    myChart.chart.renderTo='numb'+vis.id;
	              //    var chart1=new Highcharts.Chart(myChart);
	                     
	              //        }


	                     


	                     }//end loop
	
	               // hide the loader
	               $('#innerTab'+id).css('display', 'none'); 
	
	return vis_id_array;
	       
}
