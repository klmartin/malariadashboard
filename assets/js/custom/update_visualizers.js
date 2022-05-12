function update_visulizers(id,data,filtervisid,link){

		console.log("The data ",link);
	
	                   var len = JSON.parse(data)['visualizers'].length;

	                   // check if the retrieve data has any visual details, if has no any
	                   // ..visual details then do not show loader.
	
	                   if(filtervisid == 'general'){                     
	               
	                   //emptying all div before appending new divs
	                   for (var i = 0; i < len; i++) {
	                    let vis = JSON.parse(data)['visualizers'][i];
	                    $('#vis_id'+vis.id).empty()
	                   }
	
	                   }
	
	                   else{
	
	                     $('#vis_id'+filtervisid).empty();
	
	                     }
	
	                   if(len==0){
	                   $('#waitingText'+id).css('display', 'unset'); 
	                   }
	
	                  //Begining of filter loop
	   
	          
	                      for(let i=0; i<len; i++){  
	
	                       let vis = JSON.parse(data)['visualizers'][i];
	                      
	
	                       // let result = element_values.map(i=>Number(i));
	                     if (vis.chart_type==4) {
	
	
	                       var single_data = JSON.parse(data)['items'][vis.id]['y_data'];
	
	                     
	                       let sum = 0;
	
	                       for (let i = 0; i < single_data.length; i++) {
	                            for (let j = 0; j < single_data[i]['data'].length; j++) {
	                          
	                           sum += single_data[i]['data'][j];
	                           
	                       }
	                   }
	                        var title = JSON.parse(data)['items'][vis.id]['title']
	                     
	                       $('#vis_id'+vis.id).append( '<div class=" col-md-12 chartheader">'+
                          
                           '<div class="float-left" style="font-size: 14px;"> <strong>'+vis.title+'</strong></div></div>'+

                        '<div class="col-md-12" >'+
                        '<div id="numb'+vis.id+'" class="resizable_single" style="'+JSON.parse(vis.style)['style']+'">'+
                       
                        ' <div class="small-box bg-aqua" style="text-align: center;>'+
                       '  <div class="inner">'+
                           ' <p>'+JSON.parse(data)['items'][vis.id]['filter']+'</p>'+
                           '  <h3><strong>'+sum+'</strong></h3>'+
                         '</div>'+
                         ' <div class="icon">'+
                         '   <i class="ion ion-bag"></i>'+
                        '  </div>'+
                       '</div>'+
                        
                        '</div>'+      
                        '</div>'); 
	
	                     }
	
	
	                 else if(vis.chart_type==1){
	
	                       $('#vis_id'+vis.id).append(
	                       
	                       '<div class=" col-md-12 chartheader">'+
	                      
	                       '<div class="float-left" style="font-size: 14px;" style="font-size: 14px;"> <strong>'+vis.title+'</strong></div><div class="float-right">'+
	                       // '<a href="#"  data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-filter iconic float-right"></i></a> '+
	
	                       '<a href="<?php echo base_url("edit/visualizer/") ?>'+vis.id+'"><i class="fa fa-edit iconic "></i></a><button  onclick="local_filter(' + vis.id + ',' + vis.chart_type + ',' + vis.tab_id + ')"  style="padding-bottom: 5px;border-radius: 4px;border: 1px solid rgb(160, 173, 186);margin-left: 10px;text-decoration:none;padding-top: 6px;background-color: #FFF;color: #1a1a1a;" class="dropbtn btn btn-link">Add filter <svg style="margin-bottom: -7px;" class="jss38" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation"><path d="M7 10l5 5 5-5z"></path><path fill="none" d="M0 0h24v24H0z"></path></svg></button> '+
	                        '<div id="localDropdown'+vis.id+'" class="dropdown-content" style="box-shadow: 0 12px 39px -8px rgba(9, 9, 16, .2);">'+
	                        
	                        
	                         '<a onclick="general_period_filter('+vis.id+', '+vis.tab_id+', '+vis.chart_type+')">Period</a>'+
	                        ' <a onclick="local_organization_filter('+vis.id+', '+vis.tab_id+','+vis.chart_type+')" >Organization Unit</a>'+
	                      ' </div>'+
	                       '</div>'+
	                       '</div>'+
	                       '<div class="col-md-12" >'+
	                       '<div id="numb'+vis.id+'" style="'+JSON.parse(vis.style)['style']+'"></div>'+
	                       
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
	                     
	     
	
	                       let sort_status='false';
	
	                       (function(index){
	                          
	                       var normal_options = {
	                                 chart: {
	                                   events: {
	                                   drilldown: function (e) {
	                                       if (!e.seriesOptions) {
	
	                                           var chart = this;
	                                               
	                                           // Show the loading label
	                                           chart.showLoading('Loading ...');
	
	                                           setTimeout(function () {
	                                               chart.hideLoading();
	                                               chart.addSeriesAsDrilldown(e.point, series);
	                                           }, 1000); 
	                                       }
	
	                                         }
	                                     },
	                                     plotBorderWidth: 0
	                                 },
	
	                                   credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	                               title: {
	                                   text: vis.title
	                               },
	                               subtitle: {
	                                     text: JSON.parse(data)['items'][vis.id]['filter'],
	                                 },
	                               xAxis: {
	                                   categories:JSON.parse(data)['items'][vis.id]['x_data'],
	                                   crosshair:true,
	                               },
	                               yAxis: {
	                                   min: 0,
	                                   endOnTick:false,
	                                   title: {
	                                       text: ''
	                                   },
	                                   stackLabels: {
	                                       enabled: true,
	                                       style: {
	                                           fontWeight: 'bold',
	                                       }
	                                   }
	                               },
	                               
	                               tooltip: {
	                                   headerFormat: '<b></b><br/>',
	                                   pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
	                               },
	                               plotOptions: {
	                                   column: {
	                                       // stacking: 'normal',
	                                       dataLabels: {
	                                           enabled: true
	                                       }
	                                   }
	                               },
	
	
	                             series: JSON.parse(data)['items'][vis.id]['y_data']
	                                                     };
	
	                           var stacked_options = {
	                                 chart: {
	                                   events: {
	                                   drilldown: function (e) {
	                                       if (!e.seriesOptions) {
	
	                                           var chart = this;
	                                               
	                                           // Show the loading label
	                                           chart.showLoading('Loading ...');
	
	                                           setTimeout(function () {
	                                               chart.hideLoading();
	                                               chart.addSeriesAsDrilldown(e.point, series);
	                                           }, 1000); 
	                                       }
	
	                                         }
	                                     },
	                                     plotBorderWidth: 0
	                                 },
	
	                                   credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	                               title: {
	                                   text:  vis.title,
	                               },
	
	                               subtitle: {
	                                     text: JSON.parse(data)['items'][vis.id]['filter'],
	                                 },
	                               xAxis: {
	                                   categories:JSON.parse(data)['items'][vis.id]['x_data'],
	                                   crosshair:true,
	                               },
	                               yAxis: {
	                                   min: 0,
	                                   endOnTick:false,
	                                   title: {
	                                       text: ''
	                                   },
	                                   // stackLabels: {
	                                   //     enabled: true,
	                                   //     style: {
	                                   //         fontWeight: 'bold',
	                                   //     }
	                                   // }
	                               },
	                               
	                               tooltip: {
	                                   headerFormat: '<b></b><br/>',
	                                   pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
	                               },
	                               plotOptions: {
	                                   series: {
	                                       stacking: 'normal',
	                                       dataLabels: {
	                                           enabled: true
	                                       }
	                                   }
	                               },
	
	
	                                   series: JSON.parse(data)['items'][vis.id]['y_data']
	
	                                      };
	
	
	
	                                  var num_pie_options = {
	
	                                       chart: {
	                                       plotBackgroundColor: null,
	                                       plotBorderWidth: null,
	                                       plotShadow: false,
	                                       type: 'pie'
	                                       },
	                                         credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	
	                                   credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	                                       title: {
	                                           text: vis.title
	                                       },
	
	                                  subtitle: {
	                                     text: JSON.parse(data)['items'][vis.id]['filter'],
	                                 },
	                                       tooltip: {
	                                           pointFormat: '{series.name} <br><br><b>{point.y}</b> ( {point.percentage:.1f} %)'
	                                       },
	                                       accessibility: {
	                                           point: {
	                                               valueSuffix: '%'
	                                           }
	                                       },
	                                       plotOptions: {
	                                           pie: {
	                                               allowPointSelect: true,
	                                               cursor: 'pointer',
	                                               dataLabels: {
	                                                   enabled: true,
	                                                   format: '<b>{point.name}</b><br><b>{point.y}</b> ( {point.percentage:.1f} %) '
	                                               }
	                                           }
	                                       },
	                                       series: [{
	                                       name: 'Brands',
	                                       colorByPoint: true,
	                                       data : JSON.parse(data)['items'][vis.id]['y_data']
	
	                                   }]
	                                   };
	
	                         stacked_options.chart.renderTo = 'numb'+vis.id;
	                       stacked_options.chart.type = 'column';
	                       var chart1 = new Highcharts.Chart(stacked_options);
	
	                       //Display default charts as imported or last set 
	
	                        if( JSON.parse(data)['items'][vis.id]['chart_options'] == 1){
	
	                       normal_options.chart.renderTo = 'numb'+vis.id;
	                       normal_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
	                       var chart1 = new Highcharts.Chart(normal_options);
	
	                        }
	
	
	
	                        else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 2){
	
	                          stacked_options.chart.renderTo = 'numb'+vis.id;
	                       stacked_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
	                       var chart1 = new Highcharts.Chart(stacked_options);
	
	                          
	                        }
	
	
	                        else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 'pie'){      //3 for pie chart
	
	                          num_pie_options.chart.renderTo = 'numb'+vis.id;
	                       num_pie_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
	                       var chart1 = new Highcharts.Chart(num_pie_options);
	                        }
	
	
	                        else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 'table'){      //3 for pie chart
	
	                         var table = new Tabulator("#numb"+vis.id, {
	                         layout:"fitDataFill",
	                         maxHeight:"100%",
	                         columns: JSON.parse(data)['items'][vis.id]['headers'],
	                         data:JSON.parse(data)['items'][vis.id]['table_data'],
	                         headerBackgroundColor:'#dae6f8'
	                     
	                         });
	                        }
	
	
	                       
	                       
	                       var num_bar = document.getElementById('bar'+vis.id);
	                       var num_barstack=document.getElementById('barstack'+vis.id);
	                       var num_horizontal = document.getElementById('horizontal'+vis.id);
	                       var num_horizontal_stack = document.getElementById('horizontal_stack'+vis.id);
	                       var num_pie=document.getElementById('pieprop'+vis.id);
	                       var num_line=document.getElementById('lineprop'+vis.id);
	                       var num_area=document.getElementById('areaprop'+vis.id);
	                       var table_prop=document.getElementById('tableprop'+vis.id);
	                        var sort=document.getElementById('sort'+vis.id);
	                       
	                 
	                         table_prop.addEventListener('click', function () {
	
	                         var table = new Tabulator("#numb"+vis.id, {
	                         layout:"fitDataTable",
	                         maxHeight:"100%",
	                         columns: [{title:"Element /Score", field:"element"},{title:"red(<= 50%) ", field:"<= 50%"},{title:"yellow(50% - 75%) ", field:"50% - 75%"},{title:"green(>= 75%) ", field:">= 75%"}],
	
	                         data:JSON.parse(data)['items'][vis.id]['table_data'],
	                     
	                         });
	
	                           
	                               
	                       });
	
	                         sort.addEventListener('click', function () {
	
	                           sort_status=!(sort_status);
	                       
	                       });
	
	
	
	                        num_bar.addEventListener('click', function () {
	                       document.getElementById('numb'+vis.id).style.display = "block";                                
	
	                         // ////consolee.log('clicked'+i);
	                         normal_options.chart.renderTo = 'numb'+vis.id;
	                               normal_options.chart.type = 'column';
	                               var chart1 = new Highcharts.Chart(normal_options);
	                       });
	
	                       num_barstack.addEventListener('click', function () {
	                       document.getElementById('numb'+vis.id).style.display = "block";                                
	
	                         // ////consolee.log('clicked'+i);
	                         stacked_options.chart.renderTo = 'numb'+vis.id;
	                         stacked_options.chart.type = 'column';
	
	                         stacked_options.legend= 'reversed :true';
	
	                               var chart1 = new Highcharts.Chart(stacked_options);
	                       });
	
	
	
	                        num_horizontal.addEventListener('click', function () {
	                         document.getElementById('numb'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         normal_options.chart.renderTo = 'numb'+vis.id;
	                         normal_options.chart.type = 'bar';
	                         normal_options.chart.plotOptions= ' {column: {stacking: "normal",dataLabels: {enabled: true}}';
	                               var chart1 = new Highcharts.Chart(normal_options);
	                       });  
	
	
	                         num_horizontal_stack.addEventListener('click', function () {
	                           document.getElementById('numb'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         stacked_options.chart.renderTo = 'numb'+vis.id;
	                         stacked_options.chart.type = 'bar';
	                               var chart1 = new Highcharts.Chart(stacked_options);
	                       });  
	
	
	
	                        num_pie.addEventListener('click', function () {
	                         document.getElementById('numb'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         num_pie_options.chart.renderTo = 'numb'+vis.id;
	                         num_pie_options.chart.type = 'pie';
	                         // normal_option\s.chart.plotBorderWidth = 'null';
	                         //  normal_options.chart.plotShadow = 'false';
	                               var chart1 = new Highcharts.Chart(num_pie_options);
	                       }); 
	
	
	
	                        num_line.addEventListener('click', function () {
	                         document.getElementById('numb'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         normal_options.chart.renderTo = 'numb'+vis.id;
	                         normal_options.chart.type = 'line';
	                               var chart1 = new Highcharts.Chart(normal_options);
	                       });  
	
	
	
	                         num_area.addEventListener('click', function () {
	                           document.getElementById('numb'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         normal_options.chart.renderTo = 'numb'+vis.id;
	                         normal_options.chart.type = 'area';
	                               var chart1 = new Highcharts.Chart(normal_options);
	                       });  
	
	
	
	                     })(i);
	
	                     continue;
	
	                   
	                   }
	
	                else if(vis.chart_type==3){    //For Global filter 
	
	                       $('#vis_id'+vis.id).append(
	                      
	                       '<div class=" col-md-12 chartheader">'+
	                      
	                       '<div class="float-left" style="font-size: 14px;"> <strong>'+vis.title+'</strong></div>'+
	                       '<div class="float-right">'+
	                       // '<a href="#"  data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-filter iconic float-right"></i></a> '+
	
	                       '<a href="<?php echo base_url("edit/visualizer/") ?>'+vis.id+'"><i class="fa fa-edit iconic "></i></a><button  onclick="local_filter(' + vis.id + ',' + vis.chart_type + ',' + vis.tab_id + ')"  style="padding-bottom: 5px;border-radius: 4px;border: 1px solid rgb(160, 173, 186);margin-left: 10px;text-decoration:none;padding-top: 6px;background-color: #FFF;color: #1a1a1a;" class="dropbtn btn btn-link">Add filter <svg style="margin-bottom: -7px;" class="jss38" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation"><path d="M7 10l5 5 5-5z"></path><path fill="none" d="M0 0h24v24H0z"></path></svg></button> '+
	                        '<div id="localDropdown'+vis.id+'" class="dropdown-content" style="box-shadow: 0 12px 39px -8px rgba(9, 9, 16, .2);">'+
	                         
	                         '<a onclick="general_period_filter('+vis.id+', '+vis.tab_id+','+vis.chart_type+')">Period</a>'+
	                        
	                        ' <a onclick="local_organization_filter('+vis.id+', '+vis.tab_id+','+vis.chart_type+')" >Organization Unit</a>'+
	                      ' </div>'+
	                       '</div>'+
	                       '</div>'+
	                       '<div class="col-md-12" >'+
	                       '<div id="numb'+vis.id+'" style="'+JSON.parse(vis.style)['style']+'"></div>'+
	                       
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
	                     
	                       let sort_status='false';
	
	                       (function(index){
	                          
	                       var normal_options = {
	                                 chart: {
	                                   events: {
	                                   drilldown: function (e) {
	                                       if (!e.seriesOptions) {
	
	                                           var chart = this;
	                                               
	                                           // Show the loading label
	                                           chart.showLoading('Loading ...');
	
	                                           setTimeout(function () {
	                                               chart.hideLoading();
	                                               chart.addSeriesAsDrilldown(e.point, series);
	                                           }, 1000); 
	                                       }
	
	                                         }
	                                     },
	                                     plotBorderWidth: 0
	                                 },
	
	                                   credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	                               title: {
	                                   text:  vis.title
	                               },

	                               subtitle: {
	                                     text: JSON.parse(data)['items'][vis.id]['filter'],
	                                 },
	                               xAxis: {
	                                   categories:JSON.parse(data)['items'][vis.id]['x_data'],
	                                   crosshair:true,
	                               },
	                               yAxis: {
	                                   min: 0,
	                                   endOnTick:false,
	                                   title: {
	                                       text: ''
	                                   },
	                                   stackLabels: {
	                                       enabled: true,
	                                       style: {
	                                           fontWeight: 'bold',
	                                       }
	                                   }
	                               },
	                               
	                               tooltip: {
	                                   headerFormat: '<b></b><br/>',
	                                   pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
	                               },
	                               plotOptions: {
	                                   column: {
	                                       // stacking: 'normal',
	                                       dataLabels: {
	                                           enabled: true
	                                       }
	                                   }

	                                   series: {
	                                       stacking: 'normal',
	                                       dataLabels: {
	                                           enabled: JSON.parse(data)['items'][vis.id]['data_labels']
	                                       }
	                                   }
	                               },
	
	
	                             series:JSON.parse(data)['items'][vis.id]['y_data']
	                                                     };
	
	                           var stacked_options = {
	                                 chart: {
	                                   events: {
	                                   drilldown: function (e) {
	                                       if (!e.seriesOptions) {
	
	                                           var chart = this;
	                                               
	                                           // Show the loading label
	                                           chart.showLoading('Loading ...');
	
	                                           setTimeout(function () {
	                                               chart.hideLoading();
	                                               chart.addSeriesAsDrilldown(e.point, series);
	                                           }, 1000); 
	                                       }
	
	                                         }
	                                     },
	                                     plotBorderWidth: 0
	                                 },
	
	                                   credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	                               title: {
	                                   text:  vis.title,
	                               },
	
	                               subtitle: {
	                                     text: JSON.parse(data)['items'][vis.id]['filter'],
	                                 },
	                               xAxis: {
	                                   categories:JSON.parse(data)['items'][vis.id]['x_data'],
	                                   crosshair:true,
	                               },
	                               yAxis: {
	                                   min: 0,
	                                   endOnTick:false,
	                                   title: {
	                                       text: ''
	                                   },
	                                   // stackLabels: {
	                                   //     enabled: true,
	                                   //     style: {
	                                   //         fontWeight: 'bold',
	                                   //     }
	                                   // }
	                               },
	                               
	                               tooltip: {
	                                   headerFormat: '<b></b><br/>',
	                                   pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
	                               },
	                               plotOptions: {
	                                   series: {
	                                       stacking: 'normal',
	                                       dataLabels: {
	                                           enabled: JSON.parse(data)['items'][vis.id]['data_labels']
	                                       }
	                                   }
	                               },
	
	
	                                   series: JSON.parse(data)['items'][vis.id]['y_data']
	
	                                      };
	
	
	
	                                  var num_pie_options = {
	
	                                       chart: {
	                                       plotBackgroundColor: null,
	                                       plotBorderWidth: null,
	                                       plotShadow: false,
	                                       type: 'pie'
	                                       },
	                                         credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	
	                                   credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	                                       title: {
	                                           text: vis.title
	                                       },
	                                       
	
	                                       subtitle: {
	                                     text: JSON.parse(data)['items'][vis.id]['filter']
	                                 },
	                                       tooltip: {
	                                           pointFormat: '{series.name} <br><br><b>{point.y}</b> ( {point.percentage:.1f} %)'
	                                       },
	                                       accessibility: {
	                                           point: {
	                                               valueSuffix: '%'
	                                           }
	                                       },
	                                       plotOptions: {
	                                           pie: {
	                                               allowPointSelect: true,
	                                               cursor: 'pointer',
	                                               dataLabels: {
	                                                   enabled: true,
	                                                   format: '<b>{point.name}</b><br><b>{point.y}</b> ( {point.percentage:.1f} %) '
	                                               }
	                                           }
	                                       },
	                                       series: [{
	                                       name: 'Brands',
	                                       colorByPoint: true,
	                                       data:JSON.parse(data)['items'][vis.id]['y_data']
	
	                                   }]
	                                   };
	                                  
	
	                       //Display default charts as imported or last set 
	                        var legendSet= JSON.parse(data)['items'][vis.id]['legendSet'] ; 
	
	
	                        if( JSON.parse(data)['items'][vis.id]['chart_options'] == 1){
	
	                       normal_options.chart.renderTo = 'numb'+vis.id;
	                       normal_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
	                       var chart1 = new Highcharts.Chart(normal_options);
	
	                        }
	
	
	
	                        else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 2){
	
	                          stacked_options.chart.renderTo = 'numb'+vis.id;
	                       stacked_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
	                       var chart1 = new Highcharts.Chart(stacked_options);
	                        }
	
	
	                        else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 'pie'){      //3 for pie chart
	
	                          num_pie_options.chart.renderTo = 'numb'+vis.id;
	                       num_pie_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
	                       var chart1 = new Highcharts.Chart(num_pie_options);
	                        }
	
	
	                        else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 'table'){      //3 for pie chart
	
	
	                       if(legendSet){
	
	                         var table = new Tabulator("#numb"+vis.id, {
	                         layout:"fitDataFill",
	                         maxHeight:"100%",
	                         columns: JSON.parse(data)['items'][vis.id]['headers'],
	                         data:JSON.parse(data)['items'][vis.id]['table_data'],
	                         headerBackgroundColor:'#dae6f8',
	
	
	                         rowFormatter:function(row){
	
	                               var cells = row.getCells();
	                               cells.forEach(myFunction);
	                           },
	
	                         
	                     
	                         });
	                        }
	
	
	                        else{
	            
	
	                          var table = new Tabulator("#numb"+vis.id, {
	                         layout:"fitDataFill",
	                         maxHeight:"100%",
	                         columns: JSON.parse(data)['items'][vis.id]['headers'],
	                         data:JSON.parse(data)['items'][vis.id]['table_data'],
	                         headerBackgroundColor:'#dae6f8'
	
	                     
	                         });
	                        }
	
	
	                        }
	
	                         function myFunction(cell){
	                              var value=cell.getValue();
	
	                             if (value) {
	  
	                            
	                             if(value.indexOf('$')>0){
	                             
	                             var value=value.split('$');
	                             cell.getElement().style.backgroundColor = value[1];
	                             cell.setValue(value[0]);
	                           }
	
	                           else if(value.indexOf('$')>4){
	                                   var value=value.split('$'); 
	                                   cell.setValue(value[1]);
	                           }
	
	
	                           else{
	                                   var value=value.split('$'); 
	                                   cell.getElement().style.backgroundColor = value[0];
	                           }
	                         }
	                       }
	
	
	                       
	                       
	                       var num_bar = document.getElementById('bar'+vis.id);
	                       var num_barstack=document.getElementById('barstack'+vis.id);
	                       var num_horizontal = document.getElementById('horizontal'+vis.id);
	                       var num_horizontal_stack = document.getElementById('horizontal_stack'+vis.id);
	                       var num_pie=document.getElementById('pieprop'+vis.id);
	                       var num_line=document.getElementById('lineprop'+vis.id);
	                       var num_area=document.getElementById('areaprop'+vis.id);
	                       var table_prop=document.getElementById('tableprop'+vis.id);
	                        var sort=document.getElementById('sort'+vis.id);
	
	
	                         table_prop.addEventListener('click', function () {
	
	                           if(legendSet){
	
	                         var table = new Tabulator("#numb"+vis.id, {
	                         layout:"fitDataFill",
	                         maxHeight:"100%",
	                         columns: JSON.parse(data)['items'][vis.id]['headers'],
	                         data:JSON.parse(data)['items'][vis.id]['table_data'],
	                         headerBackgroundColor:'#dae6f8',
	
	
	                         rowFormatter:function(row){
	
	                               var cells = row.getCells();
	                               cells.forEach(myFunction);
	                           },
	
	                         
	                     
	                         });
	                        }
	
	
	                        else{
	            
	
	                          var table = new Tabulator("#numb"+vis.id, {
	                         layout:"fitDataFill",
	                         maxHeight:"100%",
	                         columns: JSON.parse(data)['items'][vis.id]['headers'],
	                         data:JSON.parse(data)['items'][vis.id]['table_data'],
	                         headerBackgroundColor:'#dae6f8'
	
	                     
	                         });
	                        }
	
	                               
	                       });
	
	                         sort.addEventListener('click', function () {
	
	                           sort_status=!(sort_status);
	                       
	                       });
	
	
	
	                        num_bar.addEventListener('click', function () {
	                       document.getElementById('numb'+vis.id).style.display = "block";                                
	
	                         // ////consolee.log('clicked'+i);
	                         normal_options.chart.renderTo = 'numb'+vis.id;
	                               normal_options.chart.type = 'column';
	                               var chart1 = new Highcharts.Chart(normal_options);
	                       });
	
	                       num_barstack.addEventListener('click', function () {
	                       document.getElementById('numb'+vis.id).style.display = "block";                                
	
	                         // ////consolee.log('clicked'+i);
	                         stacked_options.chart.renderTo = 'numb'+vis.id;
	                         stacked_options.chart.type = 'column';
	
	                         stacked_options.legend= 'reversed :true';
	
	                               var chart1 = new Highcharts.Chart(stacked_options);
	                       });
	
	
	
	                        num_horizontal.addEventListener('click', function () {
	                         document.getElementById('numb'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         normal_options.chart.renderTo = 'numb'+vis.id;
	                         normal_options.chart.type = 'bar';
	                         normal_options.chart.plotOptions= ' {column: {stacking: "normal",dataLabels: {enabled: true}}';
	                               var chart1 = new Highcharts.Chart(normal_options);
	                       });  
	
	
	                         num_horizontal_stack.addEventListener('click', function () {
	                           document.getElementById('numb'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         stacked_options.chart.renderTo = 'numb'+vis.id;
	                         stacked_options.chart.type = 'bar';
	                               var chart1 = new Highcharts.Chart(stacked_options);
	                       });  
	
	
	
	                        num_pie.addEventListener('click', function () {
	                         document.getElementById('numb'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         num_pie_options.chart.renderTo = 'numb'+vis.id;
	                         num_pie_options.chart.type = 'pie';
	                         // normal_option\s.chart.plotBorderWidth = 'null';
	                         //  normal_options.chart.plotShadow = 'false';
	                               var chart1 = new Highcharts.Chart(num_pie_options);
	                       }); 
	
	
	
	                        num_line.addEventListener('click', function () {
	                         document.getElementById('numb'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         normal_options.chart.renderTo = 'numb'+vis.id;
	                         normal_options.chart.type = 'line';
	                               var chart1 = new Highcharts.Chart(normal_options);
	                       });  
	
	
	
	                         num_area.addEventListener('click', function () {
	                           document.getElementById('numb'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         normal_options.chart.renderTo = 'numb'+vis.id;
	                         normal_options.chart.type = 'area';
	                               var chart1 = new Highcharts.Chart(normal_options);
	                       });  
	
	
	
	                     })(i);
	
	                     continue;
	
	                   
	                      }
	
	
	
	                       else {   //elsefilter 
	
	                       $('#vis_id'+vis.id).append(
	
	                       '<div class=" col-md-6" style="padding-left: 3px;padding-right: 1px;">'+
	                       '<div class="row chart-container draggable" id="visid'+vis.id+'" style="margin-top: 5px;">'+
	                       '<div class=" col-md-12 chartheader">'+
	                      
	                       '<div class="float-left" style="font-size: 14px;" style="font-size: 14px;"> <strong>'+vis.title+'</strong></div>'+
	                      //  '<div class="float-right">'+
	                      //  // '<a href="#"  data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-filter iconic float-right"></i></a> '+
	
	                      //  '<a href="<?php echo base_url("edit/visualizer/") ?>'+vis.id+'"><i class="fa fa-edit iconic "></i></a><button  onclick="local_filter(' + vis.id + ',' + vis.chart_type + ',' + vis.tab_id + ')"  style="padding-bottom: 5px;border-radius: 4px;border: 1px solid rgb(160, 173, 186);margin-left: 10px;text-decoration:none;padding-top: 6px;background-color: #FFF;color: #1a1a1a;" class="dropbtn btn btn-link">Add filter <svg style="margin-bottom: -7px;" class="jss38" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation"><path d="M7 10l5 5 5-5z"></path><path fill="none" d="M0 0h24v24H0z"></path></svg></button> '+
	                      //   '<div id="localDropdown'+vis.id+'" class="dropdown-content" style="box-shadow: 0 12px 39px -8px rgba(9, 9, 16, .2);">'+
	                        
	                        
	                      //    '<a onclick="general_period_filter('+vis.id+', '+vis.tab_id+')">Period</a>'+
	                      //   ' <a onclick="local_organization_filter('+vis.id+', '+vis.tab_id+')" >Organization Unit</a>'+
	                      // ' </div>'+
	                      //  '</div>'+
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
	                     
	     
	
	                       // let sort_status='false';
	
	                       (function(index){
	                          
	                       var normal_options = {
	                                 chart: {
	                                   events: {
	                                   drilldown: function (e) {
	                                       if (!e.seriesOptions) {
	
	                                           var chart = this;
	                                               
	                                           // Show the loading label
	                                           chart.showLoading('Loading ...');
	
	                                           setTimeout(function () {
	                                               chart.hideLoading();
	                                               chart.addSeriesAsDrilldown(e.point, series);
	                                           }, 1000); 
	                                       }
	
	                                         }
	                                     },
	                                     plotBorderWidth: 0
	                                 },
	
	                                   credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	                               title: {
	                                   text: vis.title
	                               },
	                               xAxis: {
	                                   categories:JSON.parse(data)['items'][vis.id]['x_data'],
	                                   crosshair:true,
	                               },
	                               yAxis: {
	                                   min: 0,
	                                   endOnTick:false,
	                                   title: {
	                                       text: ''
	                                   },
	                                   stackLabels: {
	                                       enabled: true,
	                                       style: {
	                                           fontWeight: 'bold',
	                                       }
	                                   }
	                               },
	                               
	                               tooltip: {
	                                   headerFormat: '<b></b><br/>',
	                                   pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
	                               },
	                               plotOptions: {
	                                   column: {
	                                       // stacking: 'normal',
	                                       dataLabels: {
	                                           enabled: true
	                                       }
	                                   }
	                               },
	
	
	                             series: JSON.parse(data)['items'][vis.id]['y_data']
	                                                     };
	
	                           var stacked_options = {
	                                 chart: {
	                                   events: {
	                                   drilldown: function (e) {
	                                       if (!e.seriesOptions) {
	
	                                           var chart = this;
	                                               
	                                           // Show the loading label
	                                           chart.showLoading('Loading ...');
	
	                                           setTimeout(function () {
	                                               chart.hideLoading();
	                                               chart.addSeriesAsDrilldown(e.point, series);
	                                           }, 1000); 
	                                       }
	
	                                         }
	                                     },
	                                     plotBorderWidth: 0
	                                 },
	
	                                   credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	                               title: {
	                                   text:  vis.title,
	                               },
	
	                               // subtitle: {
	                               //       text: "JSON.parse(data)['items'][vis.id]['filter']",
	                               //   },
	                               xAxis: {
	                                   categories:JSON.parse(data)['items'][vis.id]['x_data'],
	                                   crosshair:true,
	                               },
	                               yAxis: {
	                                   min: 0,
	                                   endOnTick:false,
	                                   title: {
	                                       text: ''
	                                   },
	                                   // stackLabels: {
	                                   //     enabled: true,
	                                   //     style: {
	                                   //         fontWeight: 'bold',
	                                   //     }
	                                   // }
	                               },
	                               
	                               tooltip: {
	                                   headerFormat: '<b></b><br/>',
	                                   pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
	                               },
	                               plotOptions: {
	                                   series: {
	                                       stacking: 'normal',
	                                       dataLabels: {
	                                           enabled: true
	                                       }
	                                   }
	                               },
	
	
	                                   series: JSON.parse(data)['items'][vis.id]['y_data']
	
	                                      };
	
	
	
	                                  var num_pie_options = {
	
	                                       chart: {
	                                       plotBackgroundColor: null,
	                                       plotBorderWidth: null,
	                                       plotShadow: false,
	                                       type: 'pie'
	                                       },
	                                         credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	
	                                   credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	                                       title: {
	                                           text: vis.title
	                                       },
	
	                                 //       subtitle: {
	                                 //     text: "JSON.parse(data)['items'][vis.id]['filter']"
	                                 // },
	                                       tooltip: {
	                                           pointFormat: '{series.name} <br><br><b>{point.y}</b> ( {point.percentage:.1f} %)'
	                                       },
	                                       accessibility: {
	                                           point: {
	                                               valueSuffix: '%'
	                                           }
	                                       },
	                                       plotOptions: {
	                                           pie: {
	                                               allowPointSelect: true,
	                                               cursor: 'pointer',
	                                               dataLabels: {
	                                                   enabled: true,
	                                                   format: '<b>{point.name}</b><br><b>{point.y}</b> ( {point.percentage:.1f} %) '
	                                               }
	                                           }
	                                       },
	                                       series: [{
	                                       name: 'Brands',
	                                       colorByPoint: true,
	                                       data : JSON.parse(data)['items'][vis.id]['y_data']
	
	                                   }]
	                                   };
	                                   // ////consolee.log('The changed data --',JSON.parse(data)['items'][vis.id]['y_data']);
	
	                     
	                        stacked_options.chart.renderTo = 'numb'+vis.id;
	                       stacked_options.chart.type = 'column';
	                       var chart1 = new Highcharts.Chart(stacked_options);
	                       //Display default charts as imported or last set 
	
	                        if( JSON.parse(data)['items'][vis.id]['chart_options'] == 1){
	
	                       normal_options.chart.renderTo = 'numb'+vis.id;
	                       normal_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
	                       var chart1 = new Highcharts.Chart(normal_options);
	
	                        }
	
	
	
	                        else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 2){
	                           stacked_options.chart.renderTo = 'numb'+vis.id;
	                       stacked_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
	                       var chart1 = new Highcharts.Chart(stacked_options);
	                          
	                        }
	
	
	                        else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 'pie'){      //3 for pie chart
	
	                          num_pie_options.chart.renderTo = 'numb'+vis.id;
	                       num_pie_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
	                       var chart1 = new Highcharts.Chart(num_pie_options);
	                        }
	
	
	                        else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 'table'){      //3 for pie chart
	
	                         var table = new Tabulator("#numb"+vis.id, {
	                         layout:"fitDataFill",
	                         maxHeight:"100%",
	                         columns: JSON.parse(data)['items'][vis.id]['headers'],
	                         data:JSON.parse(data)['items'][vis.id]['table_data'],
	                         headerBackgroundColor:'#dae6f8'
	                     
	                         });
	                        }
	
	
	                       
	                       
	                       var num_bar = document.getElementById('bar'+vis.id);
	                       var num_barstack=document.getElementById('barstack'+vis.id);
	                       var num_horizontal = document.getElementById('horizontal'+vis.id);
	                       var num_horizontal_stack = document.getElementById('horizontal_stack'+vis.id);
	                       var num_pie=document.getElementById('pieprop'+vis.id);
	                       var num_line=document.getElementById('lineprop'+vis.id);
	                       var num_area=document.getElementById('areaprop'+vis.id);
	                       var table_prop=document.getElementById('tableprop'+vis.id);
	                        var sort=document.getElementById('sort'+vis.id);
	                       
	
	                         table_prop.addEventListener('click', function () {
	
	                         var table = new Tabulator("#numb"+vis.id, {
	                         layout:"fitDataTable",
	                         maxHeight:"100%",
	                         columns: [{title:"Element /Score", field:"element"},{title:"red(<= 50%) ", field:"<= 50%"},{title:"yellow(50% - 75%) ", field:"50% - 75%"},{title:"green(>= 75%) ", field:">= 75%"}],
	
	                         data:JSON.parse(data)['items'][vis.id]['table_data'],
	                     
	                         });
	
	                           
	                               
	                       });
	
	                         sort.addEventListener('click', function () {
	
	                           sort_status=!(sort_status);
	                       
	                       });
	
	
	
	                        num_bar.addEventListener('click', function () {
	                       document.getElementById('numb'+vis.id).style.display = "block";                                
	
	                         // ////consolee.log('clicked'+i);
	                         normal_options.chart.renderTo = 'numb'+vis.id;
	                               normal_options.chart.type = 'column';
	                               var chart1 = new Highcharts.Chart(normal_options);
	                       });
	
	                       num_barstack.addEventListener('click', function () {
	                       document.getElementById('numb'+vis.id).style.display = "block";                                
	
	                         // ////consolee.log('clicked'+i);
	                         stacked_options.chart.renderTo = 'numb'+vis.id;
	                         stacked_options.chart.type = 'column';
	
	                         stacked_options.legend= 'reversed :true';
	
	                               var chart1 = new Highcharts.Chart(stacked_options);
	                       });
	
	
	
	                        num_horizontal.addEventListener('click', function () {
	                         document.getElementById('numb'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         normal_options.chart.renderTo = 'numb'+vis.id;
	                         normal_options.chart.type = 'bar';
	                         normal_options.chart.plotOptions= ' {column: {stacking: "normal",dataLabels: {enabled: true}}';
	                               var chart1 = new Highcharts.Chart(normal_options);
	                       });  
	
	
	                         num_horizontal_stack.addEventListener('click', function () {
	                           document.getElementById('numb'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         stacked_options.chart.renderTo = 'numb'+vis.id;
	                         stacked_options.chart.type = 'bar';
	                               var chart1 = new Highcharts.Chart(stacked_options);
	                       });  
	
	
	
	                        num_pie.addEventListener('click', function () {
	                         document.getElementById('numb'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         num_pie_options.chart.renderTo = 'numb'+vis.id;
	                         num_pie_options.chart.type = 'pie';
	                         // normal_option\s.chart.plotBorderWidth = 'null';
	                         //  normal_options.chart.plotShadow = 'false';
	                               var chart1 = new Highcharts.Chart(num_pie_options);
	                       }); 
	
	
	
	                        num_line.addEventListener('click', function () {
	                         document.getElementById('numb'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         normal_options.chart.renderTo = 'numb'+vis.id;
	                         normal_options.chart.type = 'line';
	                               var chart1 = new Highcharts.Chart(normal_options);
	                       });  
	
	
	
	                         num_area.addEventListener('click', function () {
	                           document.getElementById('numb'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         normal_options.chart.renderTo = 'numb'+vis.id;
	                         normal_options.chart.type = 'area';
	                               var chart1 = new Highcharts.Chart(normal_options);
	                       });  
	
	
	
	                     // });
	
	                 
	
	
	                 //This is proportinal table 
	                       $('#vis_id'+vis.id).append(
	                       '<div class=" col-md-6" style="padding-right: 3px;">'+
	                       '<div class="row chart-container draggable" style="margin-top: 5px;">'+
	                       '<div class=" col-md-12 chartheader">'+
	                      
	                       '<div class="float-left" style="font-size: 14px;" style="font-size: 14px;"> <strong>'+vis.title+':Proportional</strong></div><div class="float-right">'+
	                       // '<a href="#"  data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-filter iconic float-right"></i></a> '+
	
	                       '<a href="<?php echo base_url("edit/visualizer/") ?>'+vis.id+'"><i class="fa fa-edit iconic "></i></a><button  onclick="local_filter(' + vis.id + ',' + vis.chart_type + ',' + vis.tab_id + ')"  style="padding-bottom: 5px;border-radius: 4px;border: 1px solid rgb(160, 173, 186);margin-left: 10px;text-decoration:none;padding-top: 6px;background-color: #FFF;color: #1a1a1a;" class="dropbtn btn btn-link">Add filter <svg style="margin-bottom: -7px;" class="jss38" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation"><path d="M7 10l5 5 5-5z"></path><path fill="none" d="M0 0h24v24H0z"></path></svg></button> '+
	                        '<div id="localDropdown'+vis.id+'" class="dropdown-content" style="box-shadow: 0 12px 39px -8px rgba(9, 9, 16, .2);">'+
	                        
	                        
	                         '<a onclick="general_period_filter('+vis.id+', '+vis.tab_id+','+vis.chart_type+')">Period</a>'+
	                        ' <a onclick="local_organization_filter('+vis.id+', '+vis.tab_id+','+vis.chart_type+')" >Organization Unit</a>'+
	                      ' </div>'+
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
	                     
	     
	
	                       // let sort_status='false';
	
	                      
	                          
	                       var normal_options2 = {
	                                 chart: {
	                                   events: {
	                                   drilldown: function (e) {
	                                       if (!e.seriesOptions) {
	
	                                           var chart = this;
	                                               
	                                           // Show the loading label
	                                           chart.showLoading('Loading ...');
	
	                                           setTimeout(function () {
	                                               chart.hideLoading();
	                                               chart.addSeriesAsDrilldown(e.point, series);
	                                           }, 1000); 
	                                       }
	
	                                         }
	                                     },
	                                     plotBorderWidth: 0
	                                 },
	
	                                   credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	                               title: {
	                                   text: vis.title
	                               },
	                               xAxis: {
	                                   categories:JSON.parse(data)['items'][vis.id]['x_data'],
	                                   crosshair:true,
	                               },
	                               yAxis: {
	                                   min: 0,
	                                   max:100,
	                                   title: {
	                                       text: ''
	                                   },
	                                   stackLabels: {
	                                       enabled: true,
	                                       style: {
	                                           fontWeight: 'bold',
	                                       }
	                                   }
	                               },
	                               
	                               tooltip: {
	                                   headerFormat: '<b></b><br/>',
	                                   pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
	                               },
	                               plotOptions: {
	                                   column: {
	                                       // stacking: 'normal',
	                                       dataLabels: {
	                                           enabled: true
	                                       }
	                                   }
	                               },
	
	
	                             series: JSON.parse(data)['items'][vis.id]['y_proportional']
	                                                     };
	
	
	
	
	                           var stacked_options2 = {
	                                 chart: {
	                                   events: {
	                                   drilldown: function (e) {
	                                       if (!e.seriesOptions) {
	
	                                           var chart = this;
	                                               
	                                           // Show the loading label
	                                           chart.showLoading('Loading ...');
	
	                                           setTimeout(function () {
	                                               chart.hideLoading();
	                                               chart.addSeriesAsDrilldown(e.point, series);
	                                           }, 1000); 
	                                       }
	
	                                         }
	                                     },
	                                     plotBorderWidth: 0
	                                 },
	
	                                   credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	                               title: {
	                                   text:  vis.title,
	                               },
	
	                               // subtitle: {
	                               //       text: "JSON.parse(data)['items'][vis.id]['filter']",
	                               //   },
	                               xAxis: {
	                                   categories:JSON.parse(data)['items'][vis.id]['x_data'],
	                                   crosshair:true,
	                               },
	                               yAxis: {
	                                   min: 0,
	                                   endOnTick:false,
	                                   title: {
	                                       text: ''
	                                   },
	                                   // stackLabels: {
	                                   //     enabled: true,
	                                   //     style: {
	                                   //         fontWeight: 'bold',
	                                   //     }
	                                   // }
	                               },
	                               
	                               tooltip: {
	                                   headerFormat: '<b></b><br/>',
	                                   pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
	                               },
	                               plotOptions: {
	                                   series: {
	                                       stacking: 'normal',
	                                       dataLabels: {
	                                           enabled: true
	                                       }
	                                   }
	                               },
	
	
	                                   series: JSON.parse(data)['items'][vis.id]['y_proportional']
	
	                                      };
	
	
	
	                                  var num_pie_options2 = {
	
	                                       chart: {
	                                       plotBackgroundColor: null,
	                                       plotBorderWidth: null,
	                                       plotShadow: false,
	                                       type: 'pie'
	                                       },
	                                         credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	
	                                   credits: {
	                                   text: 'Source: dhis2.org'
	                               },
	                                       title: {
	                                           text: vis.title
	                                       },
	
	                                 //       subtitle: {
	                                 //     text: "JSON.parse(data)['items'][vis.id]['filter']"
	                                 // },
	                                       tooltip: {
	                                           pointFormat: '{series.name} <br><br><b>{point.y}</b> ( {point.percentage:.1f} %)'
	                                       },
	                                       accessibility: {
	                                           point: {
	                                               valueSuffix: '%'
	                                           }
	                                       },
	                                       plotOptions: {
	                                           pie: {
	                                               allowPointSelect: true,
	                                               cursor: 'pointer',
	                                               dataLabels: {
	                                                   enabled: true,
	                                                   format: '<b>{point.name}</b><br><b>{point.y}</b> ( {point.percentage:.1f} %) '
	                                               }
	                                           }
	                                       },
	                                       series: [{
	                                       name: 'Brands',
	                                       colorByPoint: true,
	                                       data : JSON.parse(data)['items'][vis.id]['y_proportional']
	
	                                   }]
	                                   };
	
	                                   // ////consolee.log('The changed data --',JSON.parse(data)['items'][vis.id]['y_data']);
	
	                     
	                        stacked_options2.chart.renderTo = 'numb_p'+vis.id;
	                       stacked_options2.chart.type = 'column';
	                       var chart1 = new Highcharts.Chart(stacked_options2);
	                       //Display default charts as imported or last set 
	
	                        if( JSON.parse(data)['items'][vis.id]['chart_options'] == 1){
	
	                       normal_options2.chart.renderTo = 'numb_p'+vis.id;
	                       normal_options2.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
	                       var chart1 = new Highcharts.Chart(normal_options2);
	
	                        }
	
	
	
	                        else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 2){
	                           stacked_options2.chart.renderTo = 'numb_p'+vis.id;
	                       stacked_options2.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
	                       var chart1 = new Highcharts.Chart(stacked_options2);
	                          
	                        }
	
	
	                        else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 'pie'){      //3 for pie chart
	
	                          num_pie_options2.chart.renderTo = 'numb_p'+vis.id;
	                       num_pie_options2.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
	                       var chart1 = new Highcharts.Chart(num_pie_options2);
	                        }
	
	
	                        else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 'table'){      //3 for pie chart
	
	                         var table = new Tabulator("#numb"+vis.id, {
	                         layout:"fitDataFill",
	                         maxHeight:"100%",
	                         columns: JSON.parse(data)['items'][vis.id]['headers'],
	                         data:JSON.parse(data)['items'][vis.id]['table_data'],
	                         headerBackgroundColor:'#dae6f8'
	                     
	                         });
	                        }
	
	
	                       
	                       
	                       var num_bar = document.getElementById('bar_p'+vis.id);
	                       var num_barstack=document.getElementById('barstack_p'+vis.id);
	                       var num_horizontal = document.getElementById('horizontal_p'+vis.id);
	                       var num_horizontal_stack = document.getElementById('horizontal_stack_p'+vis.id);
	                       var num_pie=document.getElementById('pieprop_p'+vis.id);
	                       var num_line=document.getElementById('lineprop_p'+vis.id);
	                       var num_area=document.getElementById('areaprop_p'+vis.id);
	                       var table_prop=document.getElementById('tableprop_p'+vis.id);
	                        var sort=document.getElementById('sort_p'+vis.id);
	
	                         table_prop.addEventListener('click', function () {
	
	
	                         var table = new Tabulator("#numb"+vis.id, {
	                         layout:"fitDataTable",
	                         maxHeight:"100%",
	                         columns: [{title:"Element /Score", field:"element"},{title:"red(<= 50%) ", field:"<= 50%"},{title:"yellow(50% - 75%) ", field:"50% - 75%"},{title:"green(>= 75%) ", field:">= 75%"}],
	
	                         data:JSON.parse(data)['items'][vis.id]['table_data'],
	                     
	                         });
	
	                           
	                               
	                       });
	
	                         sort.addEventListener('click', function () {
	
	                           sort_status=!(sort_status);
	                       
	                       });
	
	
	
	                        num_bar.addEventListener('click', function () {
	                       document.getElementById('numb_p'+vis.id).style.display = "block";                                
	
	                         // ////consolee.log('clicked'+i);
	                         normal_options.chart.renderTo = 'numb_p'+vis.id;
	                               normal_options.chart.type = 'column';
	                               var chart1 = new Highcharts.Chart(normal_options);
	                       });
	
	                       num_barstack.addEventListener('click', function () {
	                       document.getElementById('numb_p'+vis.id).style.display = "block";                                
	
	                         // ////consolee.log('clicked'+i);
	                         stacked_options.chart.renderTo = 'numb_p'+vis.id;
	                         stacked_options.chart.type = 'column';
	
	                         stacked_options.legend= 'reversed :true';
	
	                               var chart1 = new Highcharts.Chart(stacked_options);
	                       });
	
	
	
	                        num_horizontal.addEventListener('click', function () {
	                         document.getElementById('numb_p'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         normal_options.chart.renderTo = 'numb_p'+vis.id;
	                         normal_options.chart.type = 'bar';
	                         normal_options.chart.plotOptions= ' {column: {stacking: "normal",dataLabels: {enabled: true}}';
	                               var chart1 = new Highcharts.Chart(normal_options);
	                       });  
	
	
	                         num_horizontal_stack.addEventListener('click', function () {
	                           document.getElementById('numb_p'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         stacked_options.chart.renderTo = 'numb_p'+vis.id;
	                         stacked_options.chart.type = 'bar';
	                               var chart1 = new Highcharts.Chart(stacked_options);
	                       });  
	
	
	
	                        num_pie.addEventListener('click', function () {
	                         document.getElementById('numb_p'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         num_pie_options.chart.renderTo = 'numb_p'+vis.id;
	                         num_pie_options.chart.type = 'pie';
	                         // normal_option\s.chart.plotBorderWidth = 'null';
	                         //  normal_options.chart.plotShadow = 'false';
	                               var chart1 = new Highcharts.Chart(num_pie_options);
	                       }); 
	
	
	
	                        num_line.addEventListener('click', function () {
	                         document.getElementById('numb_p'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         normal_options.chart.renderTo = 'numb_p'+vis.id;
	                         normal_options.chart.type = 'line';
	                               var chart1 = new Highcharts.Chart(normal_options);
	                       });  
	
	
	
	                         num_area.addEventListener('click', function () {
	                           document.getElementById('numb_p'+vis.id).style.display = "block"; 
	                         // ////consolee.log('clicked'+i);
	                         normal_options.chart.renderTo = 'numb_p'+vis.id;
	                         normal_options.chart.type = 'area';
	                               var chart1 = new Highcharts.Chart(normal_options);
	                       });  
	
	
	                  })(i);
	                 
	                     continue;
	
	                   
	                      }
	       
	
	                //end charts     
	           }//end loop
	
	
	
	           //end loop
	
	               // hide the loader
	               $('#innerTab'+id).css('display', 'none'); 
	
	
	      
	       ////consolee.log('this is data',data)
	   }