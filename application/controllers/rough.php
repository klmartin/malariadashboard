<?php

  if (isset($tabs)) { ?>
    <div class="tab">
      <?php foreach ($tabs as $tab) : ?>

        <button class="tablinks" onclick="openTab(event, '<?php echo $tab->id; ?>')">
          <a><?php echo $tab->name; ?></a>
        </button>

      <?php endforeach; ?>
    </div>
  <?php } ?>


  <?php if (isset($tabs)) {
    foreach ($tabs as $tab) :
  ?>
      <!--- tab repeat all -->
      <div id="<?php echo $tab->id; ?>" class="card tabcontent">



        <div class=" card col-md-12" style="background-color:#ffffff; ">
          <div class="row col-md-12">
          <a title="Dashboard home" href="<?php echo base_url("view/dashboard/" . base64_encode($tab->dash_id)) ?>"><i class='fa fa-home iconic'></i></a>
          <a title="Add new visualization" style="margin-left:20px" href="<?php echo base_url("add/visualizer/" . base64_encode($tab->id)) ?>"><i class='fa fa-plus iconic '></i></a>

          <a title="General Filter" data-toggle="modal" data-target="#exampleModalCenter" style="margin-left:20px"><i class='fa fa-filter iconic float-right'></i></a>
        </div>
        </div>

        <div id="applications<?php echo $tab->id ?>"></div>

      <div id=<?php echo "innerTab".$tab->id; ?>" class="card tabcontent">

        <div id="loader" class="center" >
        <i class="fa fa-spinner fa-spin" style="font-size:100px;color:#2c6675"></i>
        </div>
        </div>
        <!-- repeat for all visualizers in this dashboard     -->
        <div id="vis<?php echo $tab->id ?>"></div>
        <!-- end of repeat visualizer -->
      
    </div>

        <script>
 //  

function openTab(evt, id) {

console.log('start');
$('#filterLoader').hide();

 $("#filterbtn").click(function(){
  $('#filterLoader').show(); 
});


$('#loader').hide();
            $('#setting').hide();
            $('#vis'+id).empty();



            $('#applications'+id).empty();
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
            }



            // Show the current tab, and add an "active" class to the button that opened the tab

            document.getElementById(id).style.display = "block";
            evt.currentTarget.className += " active";

  

            //filter modal function to display new data
            //start of filtred AJAX from API.
            
            console.log(id);

            // disable loader for all tabs, inside the innertab there is loader;
            // $('#innerTab'.id).css('display', 'none');  
            


              $('#filter').submit(function(e){
              e.preventDefault();             


              $("#filterbtn").click(function(){
                $('#filterLoader').show(); 
             
                console.log('start');
              });
             

              let regions = $("#region").val();
              let districts = $("#district").val();
              let clinics = $("#clinic").val();
              let endday = $("#endday").val();
              let startday = $("#startday").val();


              $('#exampleModalCenter').modal('hide');
              $.ajax({ 
                url: "<?php echo base_url("filter/data") ?>",
                type: "POST",
                 data:{
                  id:id,
                  regions:regions,
                  districts:districts,
                  clinics:clinics,
                  endday:endday,
                  startday:startday
                },
                cache: false,
                success:function (data){
                   //console.log(data)
                  
    
                    var len = JSON.parse(data)['visualizers'].length;
                    var apps = JSON.parse(data)['applications'];
                    var dynamic = "";
                     for (var i = apps.length - 1; i >= 0; i--) {
                      const appname =  apps[i].name
                      const applink = apps[i].link
                      dynamic +=  '<a href="'+applink+'" target="blank" style="font-size:16px;width:100%;margin-left:5px" ><i style="padding:10px" class="fa fa-sharet iconic">'+appname+'</i></a>'

                      }

                    if(dynamic.length!=0){  
                    $('#applications'+id).append(
                      '<div class="row" style="margin-top: 40px;">'+
                      '<div  class=" card col-md-12" style="background-color:#ffffff;"> <h6>APPLLICATIONS</h6>'+
                      '<div style=" overflow-y: auto; max-height: 70px;">'+dynamic+
                      '</div>'+
                      '</div>'+
                      '</div>'
                      )
                    }


                      for(let i=0; i<len; i++){
                        let vis = JSON.parse(data)['visualizers'][i];

                        let obj = JSON.parse(data)['indicators'][vis.id];
              
                       
                        let element_names = [];
                        let element_values = [];
                        let element_ids = [];
                        let indicator_values = [];
                        let indicator_values1 = [];
                        let graphvalues = [];
                        var indi = JSON.parse(data)['indicator_data'][vis.id];
                        let x = [];
                        let x_per = [];
                        let y = [];

                        for(var a in indi){
                          y.push(a);
                          
                        }

                        //console.log(indi)
                           for(let key in indi){ 

                            let countred=0
                            let countyellow=0
                            let countgreen=0

                            let countredtotal = 0;
                            let countyellowtotal = 0;
                            let countgreentotal = 0;

                              if (!indi.hasOwnProperty(key)) continue;
                              var objj = indi[key];
                              for (let prop in objj) {
                                  // skip loop if the property is from prototype
                                  if (!objj.hasOwnProperty(prop)) continue;
                                  // your code
                                  var last_value = objj[prop][objj[prop].length - 1];
                                  //red,yellow,green
                                  if (last_value < 50) {
                                    countred= countred+1;
                                    
                                  }
                                  if (last_value > 49.9 && last_value < 75) {
                                    countyellow = countyellow+1
                                  }
                                  if (last_value > 74.9 && last_value < 101) {
                                    countgreen=countgreen+1
                                  }
                                  indicator_values1[0]=countred;
                                  indicator_values1[1]=countyellow;
                                  indicator_values1[2]=countgreen;

                                  indicator_values.push(last_value)
                                  
                              }

                                  if(countred > 0){
                                    x.push({
                                      data: [[y.indexOf(key) ,countred]],
                                      color:'red',
                                      linkedTo:'red'
                                    })

                                    //Math.round(((Object.keys(countred/objj) * 100 + Number.EPSILON) * 100)/100
                                    x_per.push({
                                      data: [[y.indexOf(key) ,Math.round(((countred/(countred+countyellow+countgreen) * 100 + Number.EPSILON) * 100)/100)]],
                                      color:'red',
                                      linkedTo:'red'
                                    })
                                    
                                  }

                                  if(countyellow > 0){
                                    x.push({
                                      data: [[y.indexOf(key) ,countyellow]],
                                      color:'yellow',
                                      linkedTo:'yellow'
                                    })

                                    x_per.push({
                                      data: [[y.indexOf(key) ,Math.round(((countyellow/(countred+countyellow+countgreen) * 100 + Number.EPSILON) * 100)/100)]],
                                      color:'yellow',
                                      linkedTo:'yellow'
                                    })

                                  }

                                  if(countgreen > 0){
                                    x.push({
                                      data: [[y.indexOf(key) ,countgreen]],
                                      color:'green',
                                      linkedTo:'green'
                                    })

                                    x_per.push({
                                      data: [[y.indexOf(key) ,Math.round(((countgreen/(countred+countyellow+countgreen) * 100 + Number.EPSILON) * 100)/100)]],
                                      color:'green',
                                      linkedTo:'green'
                                    })

                                  }

                              graphvalues[key] = indicator_values1;
                              //console.log(indicator_values1);
                            }
                            
                            x.push({
                              id:'red', 
                              name:"<= 50%",
                              color:'red'
                            },
                            {
                              id:'yellow', 
                              name:"50% - 75%",
                              color:'yellow'
                            },
                            {
                              id:'green', 
                              name:">= 75%",
                              color:'green'
                            });

                            x_per.push({
                              id:'red', 
                              name:"<= 50%",
                              color:'red'
                            },
                            {
                              id:'yellow', 
                              name:"50% - 75%",
                              color:'yellow'
                            },
                            {
                              id:'green', 
                              name:">= 75%",
                              color:'green'
                            });

                            //console.log(graphvalues);
                            //console.log(indicator_values1);
                           
                            //let result = indicator_values.map(Number) 
                            let result = x 
                            let result_per = x_per 
                            //console.log(result)

                        

                        for(var a in obj){
                          element_names.push(JSON.parse(data)['indicators'][vis.id][a].element_name);
                          element_values.push(JSON.parse(data)['indicators'][vis.id][a].id);

                        }
                        //let result = element_values.map(i=>Number(i));

                        // console.log(result)
                        // console.log(element_values)
                      
                      if(vis.chart_type==1){
                        $('#vis'+vis.tab_id).append(
                          '<div class="row " style="margin-top: 40px;">'+
                        '<div class=" card col-md-12" style="background-color:#ffffff; ">'+
                        '<p class="text-center" style="font-size:18px;color:#000000;width:100%" >'+vis.title+'</p>'+
                        '<div class="float-right">'+
                        '<a href="#"  data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-filter iconic float-right"></i></a> '+
                        '<a href="<?php echo base_url("edit/visualizer/") ?>'+vis.id+'"><i class="fa fa-cog iconic "></i></a> '+
                        '</div>'+
                        '</div>'+
                        '<div class="col-md-12" >'+
                        '<div id="numb'+vis.id+'" style="width:100%; height:400px;"></div>'+
                        
                        '<div class="row" style="margin-top:2%; margin-left: 2px;">'+
                                '<a  title="Bar chart" id="colnum'+vis.id+'"  ><i class="fa fa-barcode iconic"></i></a>'+
                                '<a  title="Area chart" id="areanum'+vis.id+'"  ><i class="fa fa-chart-area iconic"></i></a>'+
                                '<a  title="Histogram" id="barnum'+vis.id+'" ><i class="fa fa-chart-bar iconic"></i></a>'+
                                '<a  title="Piechart" id="pienum'+vis.id+'" ><i class="fa fa-chart-pie iconic"></i></a>'+
                              ' <a  title="Line chart" id="linenum'+vis.id+'" ><i class="fa fa-chart-line iconic"></i></a>'+
                                '</div>'+
                        '</div>'); 

                        (function(index){  
                        var num_options = {
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
                                title: {
                                    text: vis.chart_header
                                },
                                xAxis: {
                                    categories: element_names
                                },
                                yAxis: {
                                    min: 0,
                                    title: {
                                        text: 'Score'
                                    },
                                    stackLabels: {
                                        enabled: true,
                                        style: {
                                            fontWeight: 'bold',
                                            
                                        }
                                    }
                                },
                                
                                tooltip: {
                                    headerFormat: '<b>{point.x}</b><br/>',
                                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                                },
                                plotOptions: {
                                    column: {
                                        stacking: 'normal',
                                        dataLabels: {
                                            enabled: true
                                        }
                                    }
                                },
                                series: result
                          };

                        // Column chart
                        num_options.chart.renderTo = 'numb'+vis.id;
                        num_options.chart.type = 'column';
                        var chart1 = new Highcharts.Chart(num_options);
                        
                        var num_column = document.getElementById('colnum'+vis.id);
                        var num_bar = document.getElementById('barnum'+vis.id);
                        var num_pie = document.getElementById('pienum'+vis.id);
                        var num_line = document.getElementById('linenum'+vis.id);
                        var num_area = document.getElementById('areanum'+vis.id);

                                

                        num_column.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                                num_options.chart.type = 'column';
                                var chart1 = new Highcharts.Chart(num_options);
                        });
                        num_area.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                                num_options.chart.type = 'area';
                                var chart1 = new Highcharts.Chart(num_options);
                        });

                        num_bar.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                          num_options.chart.type = 'bar';
                                var chart1 = new Highcharts.Chart(num_options);
                        }); 
                        
                        num_pie.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                          num_options.chart.type = 'pie';
                                var chart1 = new Highcharts.Chart(num_options);
                        });

                        num_line.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                          num_options.chart.type = 'line';
                                var chart1 = new Highcharts.Chart(num_options);
                        });

                        })(i);


                        continue;

                      }
                      else if(vis.chart_type==2){



                        $('#vis'+vis.tab_id).append(
                          '<div class="row " style="margin-top: 40px;">'+
                        '<div class=" card col-md-12" style="background-color:#ffffff; ">'+
                        '<p class="text-center" style="font-size:18px;color:#000000;width:100%" >'+vis.title+'</p>'+
                        '<div class="float-right">'+
                        '<a href="#"  data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-filter iconic float-right"></i></a> '+
                        '<a href="<?php echo base_url("edit/visualizer/") ?>'+vis.id+'"><i class="fa fa-cog iconic "></i></a> '+
                        '</div>'+
                        '</div>'+

                        '<div class="card col-md-12" style="background-color:white" >'+
                        '<p class="text-center" style="font-size:18px;color:#000000;width:100%" >'+vis.pivot_header+'</p>'+
                        '<div id="table'+vis.id+'" style="width:100%; height:400px;">'+
                                '<table  class="table" lass="form-control">'+
                                  '<tr id="table_headers"></tr>'+
                                  '<tbody id="tablec'+vis.id+'"><tbody>'+
                                '</table>'+
                        '</div>'
                       
                        ); 

                        $('#table_headers').append('<th></th>');
                        for(var a in obj){
                        $('#table_headers').append('<th>'+JSON.parse(data)['indicators'][vis.id][a].element_name+'</th>');}

                        for(let i=0; i<3; i++){
                        $('#tablec'+vis.id).append('<tr>');
                        $('#tablec'+vis.id).append('<td>Orgunit</td>');
                        for(var a in obj){
                          $('#tablec'+vis.id).append('<td>'+JSON.parse(data)['indicators'][vis.id][a].element_id+'</td>');
                        }
                        $('#tablec'+vis.id).append('</tr>');
                        }
                        continue;
                      }
                        $('#vis'+vis.tab_id).append(
                        '<div class="row " style="margin-top: 40px;">'+
                        '<div class=" card col-md-12" style="background-color:#ffffff; ">'+
                        '<p class="text-center" style="font-size:18px;color:#000000;width:100%" >'+vis.title+'</p>'+
                        '<div class="float-right">'+
                       // '<a  data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-filter iconic float-right"></i></a> '+
                        '<a href="<?php echo base_url("edit/visualizer/") ?>'+vis.id+'"><i class="fa fa-cog iconic "></i></a> '+
                        '</div>'+
                        '</div>'+
                        '<div class="col-md-6" >'+
                        '<div id="numb'+vis.id+'" style="width:100%; height:400px;"></div>'+
                        
                        '<div class="row" style="margin-top:2%; margin-left: 2px;">'+
                                '<a  title="Bar chart" id="colnum'+vis.id+'"  ><i class="fa fa-barcode iconic"></i></a>'+
                                '<a  title="Area chart" id="areanum'+vis.id+'"  ><i class="fa fa-chart-area iconic"></i></a>'+
                                '<a  title="Histogram" id="barnum'+vis.id+'" ><i class="fa fa-chart-bar iconic"></i></a>'+
                                '<a  title="Piechart" id="pienum'+vis.id+'" ><i class="fa fa-chart-pie iconic"></i></a>'+
                              ' <a  title="Line chart" id="linenum'+vis.id+'" ><i class="fa fa-chart-line iconic"></i></a>'+
                                '</div>'+
                        '</div>'+

                        '<div class="col-md-6" >'+
                        '<div id="prop'+vis.id+'" style="width:100%; height:400px;"></div>'+
                          
                            '<div class="row" style="margin-top:2%; margin-left: 2px;">'+
                            '<a  title="Bar chart" id="colprop'+vis.id+'"  ><i class="fa fa-barcode iconic"></i></a>'+
                            '<a  title="Area chart" id="areaprop'+vis.id+'"  ><i  class="fa fa-chart-area iconic"></i></a></a>'+
                            '<a  title="Histogram" id="barprop'+vis.id+'"  ><i class="fa fa-chart-bar iconic"></i></a>'+
                            '<a  title="Pie chart" id="pieprop'+vis.id+'"  ><i class="fa fa-chart-pie iconic"></i></a>'+
                            '<a  title="Line chart" id="lineprop'+vis.id+'"  ><i class="fa fa-chart-line iconic"></i></a>'+
                            '</div>'+
                      '</div>'+
                    '</div>'
                    );
               
                  //let otr = JSON.parse(data)['indicator_data'][vis.id];
                        // Create the chart
                  (function(index){  
                        var num_options = {
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
                                title: {
                                    text: 'Number(#)'
                                },
                                xAxis: {
                                    categories: element_names
                                },
                                yAxis: {
                                    min: 0,
                                    title: {
                                        text: 'Score'
                                    },
                                    stackLabels: {
                                        enabled: true,
                                        style: {
                                            fontWeight: 'bold',
                                            
                                        }
                                    }
                                },
                                
                                tooltip: {
                                    headerFormat: '<b>{point.x}</b><br/>',
                                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                                },
                                plotOptions: {
                                    column: {
                                        stacking: 'normal',
                                        dataLabels: {
                                            enabled: true
                                        }
                                    }
                                },

                                series: result
                          };

     


                        // Column chart
                        num_options.chart.renderTo = 'numb'+vis.id;
                        num_options.chart.type = 'column';
                        var chart1 = new Highcharts.Chart(num_options);

                        
                        var num_column = document.getElementById('colnum'+vis.id);
                        var num_bar = document.getElementById('barnum'+vis.id);
                        var num_pie = document.getElementById('pienum'+vis.id);
                        var num_line = document.getElementById('linenum'+vis.id);
                        var num_area = document.getElementById('areanum'+vis.id);

                                

                        num_column.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                                num_options.chart.type = 'column';
                                var chart1 = new Highcharts.Chart(num_options);
                        });
                        num_area.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                                num_options.chart.type = 'area';
                                var chart1 = new Highcharts.Chart(num_options);
                        });

                        num_bar.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                          num_options.chart.type = 'bar';
                                var chart1 = new Highcharts.Chart(num_options);
                        }); 
                        
                        num_pie.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                          num_options.chart.type = 'pie';
                                var chart1 = new Highcharts.Chart(num_options);
                        });

                        num_line.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                          num_options.chart.type = 'line';
                                var chart1 = new Highcharts.Chart(num_options);
                        });

                        })(i);

                      


                        (function(index){  

                                var prop_options = {
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
                                  title: {
                                      text: 'Proportion(%)'
                                  },
                                  xAxis: {
                                      categories: element_names
                                  },
                                  yAxis: {
                                      min: 0,
                                      title: {
                                          text: 'Score'
                                      },
                                      stackLabels: {
                                          enabled: true,
                                          style: {
                                              fontWeight: 'bold',
                                              
                                          }
                                      }
                                  },
                                  
                                  tooltip: {
                                      headerFormat: '<b>{point.x}</b><br/>',
                                      pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                                  },
                                  plotOptions: {
                                      column: {
                                          stacking: 'normal',
                                          dataLabels: {
                                              enabled: true
                                          }
                                      }
                                  },
                                  series: result_per
                            };

                        // Column chart
                        prop_options.chart.renderTo = 'prop'+vis.id;
                        prop_options.chart.type = 'column';
                        var chart2 = new Highcharts.Chart(prop_options);

                      // prop_chartfunc = function(index)
                      //   {

                        var prop_column = document.getElementById('colprop'+vis.id);
                        var prop_bar = document.getElementById('barprop'+vis.id);
                        var prop_pie = document.getElementById('pieprop'+vis.id);
                        var prop_line = document.getElementById('lineprop'+vis.id);
                        var prop_area = document.getElementById('areaprop'+vis.id);


                        prop_column.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          prop_options.chart.renderTo = 'prop'+vis.id;
                          prop_options.chart.type = 'column';
                              var chart2 = new Highcharts.Chart(prop_options);
                        });       

                        prop_area.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          prop_options.chart.renderTo = 'prop'+vis.id;
                          prop_options.chart.type = 'area';
                                var chart2 = new Highcharts.Chart(prop_options);
                        });
                            
                        prop_bar.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          prop_options.chart.renderTo = 'prop'+vis.id;
                          prop_options.chart.type = 'bar';
                                var chart2= new Highcharts.Chart(prop_options);
                        }); 
                        
                        prop_pie.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          prop_options.chart.renderTo = 'prop'+vis.id;
                          prop_options.chart.type = 'pie';
                                var chart2 = new Highcharts.Chart(prop_options);
                        });
                        prop_line.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          prop_options.chart.renderTo = 'prop'+vis.id;
                          prop_options.chart.type = 'line';
                                var chart2 = new Highcharts.Chart(prop_options);
                        });
                     
                      })(i);
                 //end charts     
            }//end loop

                },complete:function (data){
                console.log('stop');
                $('#filterLoader').hide();
                }

              });
            });


            

            
           // end of filtered data from the  API.


           //start of default AJAX from selected Tab
            $.ajax({
                  url:"<?php echo base_url()?>view/visualizers/",
                  method: 'post',
                  data: {id: id},
                  cache: false,
                  success:function (data) { 
                    var len = JSON.parse(data)['visualizers'].length;

                    if(len>0){
                      // console.log("idd"+id)
            $('#innerTab26').css('display', 'block');  

            // document.getElementById('innerTab'+id).style.display = "block";

//                       $('#innerTab'.id).css('display', 'block');  
// $('#loader').show();
                     
                      console.log("hi")
                    }
                    

                    var apps = JSON.parse(data)['applications'];
                    var dynamic = "";
                     for (var i = apps.length - 1; i >= 0; i--) {
                      const appname =  apps[i].name
                      const applink = apps[i].link
                      dynamic +=  '<a href="'+applink+'" target="blank" style="font-size:16px;width:100%;margin-left:5px" ><i style="padding:10px" class="fa fa-sharet iconic">'+appname+'</i></a>'

                      }

                    if(dynamic.length!=0){  
                    $('#applications'+id).append(
                      '<div class="row" style="margin-top: 40px;">'+
                      '<div  class=" card col-md-12" style="background-color:#ffffff;"> <h6>APPLLICATIONS</h6>'+
                      '<div style=" overflow-y: auto; max-height: 70px;">'+dynamic+
                      '</div>'+
                      '</div>'+
                      '</div>'
                      )
                    }


                      for(let i=0; i<len; i++){
                        let vis = JSON.parse(data)['visualizers'][i];

                        let obj = JSON.parse(data)['indicators'][vis.id];
              
                       
                        let element_names = [];
                        let element_values = [];
                        let element_ids = [];
                        let indicator_values = [];
                        let indicator_values1 = [];
                        let graphvalues = [];
                        var indi = JSON.parse(data)['indicator_data'][vis.id];
                        let x = [];
                        let x_per = [];
                        let y = [];

                        for(var a in indi){
                          y.push(a);
                          
                        }

                        //console.log(indi)
                           for(let key in indi){ 

                            let countred=0
                            let countyellow=0
                            let countgreen=0

                            let countredtotal = 0;
                            let countyellowtotal = 0;
                            let countgreentotal = 0;

                              if (!indi.hasOwnProperty(key)) continue;
                              var objj = indi[key];
                              for (let prop in objj) {
                                  // skip loop if the property is from prototype
                                  if (!objj.hasOwnProperty(prop)) continue;
                                  // your code
                                  var last_value = objj[prop][objj[prop].length - 1];
                                  //red,yellow,green
                                  if (last_value < 50) {
                                    countred= countred+1;
                                    
                                  }
                                  if (last_value > 49.9 && last_value < 75) {
                                    countyellow = countyellow+1
                                  }
                                  if (last_value > 74.9 && last_value < 101) {
                                    countgreen=countgreen+1
                                  }
                                  indicator_values1[0]=countred;
                                  indicator_values1[1]=countyellow;
                                  indicator_values1[2]=countgreen;

                                  indicator_values.push(last_value)
                                  
                              }

                                  if(countred > 0){
                                    x.push({
                                      data: [[y.indexOf(key) ,countred]],
                                      color:'red',
                                      linkedTo:'red'
                                    })

                                    //Math.round(((Object.keys(countred/objj) * 100 + Number.EPSILON) * 100)/100
                                    x_per.push({
                                      data: [[y.indexOf(key) ,Math.round(((countred/(countred+countyellow+countgreen) * 100 + Number.EPSILON) * 100)/100)]],
                                      color:'red',
                                      linkedTo:'red'
                                    })
                                    
                                  }

                                  if(countyellow > 0){
                                    x.push({
                                      data: [[y.indexOf(key) ,countyellow]],
                                      color:'yellow',
                                      linkedTo:'yellow'
                                    })

                                    x_per.push({
                                      data: [[y.indexOf(key) ,Math.round(((countyellow/(countred+countyellow+countgreen) * 100 + Number.EPSILON) * 100)/100)]],
                                      color:'yellow',
                                      linkedTo:'yellow'
                                    })

                                  }

                                  if(countgreen > 0){
                                    x.push({
                                      data: [[y.indexOf(key) ,countgreen]],
                                      color:'green',
                                      linkedTo:'green'
                                    })

                                    x_per.push({
                                      data: [[y.indexOf(key) ,Math.round(((countgreen/(countred+countyellow+countgreen) * 100 + Number.EPSILON) * 100)/100)]],
                                      color:'green',
                                      linkedTo:'green'
                                    })

                                  }

                              graphvalues[key] = indicator_values1;
                              //console.log(indicator_values1);
                            }
                            
                            x.push({
                              id:'red', 
                              name:"<= 50%",
                              color:'red'
                            },
                            {
                              id:'yellow', 
                              name:"50% - 75%",
                              color:'yellow'
                            },
                            {
                              id:'green', 
                              name:">= 75%",
                              color:'green'
                            });

                            x_per.push({
                              id:'red', 
                              name:"<= 50%",
                              color:'red'
                            },
                            {
                              id:'yellow', 
                              name:"50% - 75%",
                              color:'yellow'
                            },
                            {
                              id:'green', 
                              name:">= 75%",
                              color:'green'
                            });

                            //console.log(graphvalues);
                            //console.log(indicator_values1);
                           
                            //let result = indicator_values.map(Number) 
                            let result = x 
                            let result_per = x_per 
                            //console.log(result)

                        

                        for(var a in obj){
                          element_names.push(JSON.parse(data)['indicators'][vis.id][a].element_name);
                          element_values.push(JSON.parse(data)['indicators'][vis.id][a].id);

                        }
                        //let result = element_values.map(i=>Number(i));

                        // console.log(result)
                        // console.log(element_values)
                      
                      if(vis.chart_type==1){
                        $('#vis'+vis.tab_id).append(
                          '<div class="row " style="margin-top: 40px;">'+
                        '<div class=" card col-md-12" style="background-color:#ffffff; ">'+
                        '<p class="text-center" style="font-size:18px;color:#000000;width:100%" >'+vis.title+'</p>'+
                        '<div class="float-right">'+
                        '<a href="#"  data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-filter iconic float-right"></i></a> '+
                        '<a href="<?php echo base_url("edit/visualizer/") ?>'+vis.id+'"><i class="fa fa-cog iconic "></i></a> '+
                        '</div>'+
                        '</div>'+
                        '<div class="col-md-12" >'+
                        '<div id="numb'+vis.id+'" style="width:100%; height:400px;"></div>'+
                        
                        '<div class="row" style="margin-top:2%; margin-left: 2px;">'+
                                '<a  title="Bar chart" id="colnum'+vis.id+'"  ><i class="fa fa-barcode iconic"></i></a>'+
                                '<a  title="Area chart" id="areanum'+vis.id+'"  ><i class="fa fa-chart-area iconic"></i></a>'+
                                '<a  title="Histogram" id="barnum'+vis.id+'" ><i class="fa fa-chart-bar iconic"></i></a>'+
                                '<a  title="Piechart" id="pienum'+vis.id+'" ><i class="fa fa-chart-pie iconic"></i></a>'+
                              ' <a  title="Line chart" id="linenum'+vis.id+'" ><i class="fa fa-chart-line iconic"></i></a>'+
                                '</div>'+
                        '</div>'); 

                        (function(index){  
                        var num_options = {
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
                                title: {
                                    text: vis.chart_header
                                },
                                xAxis: {
                                    categories: element_names
                                },
                                yAxis: {
                                    min: 0,
                                    title: {
                                        text: 'Score'
                                    },
                                    stackLabels: {
                                        enabled: true,
                                        style: {
                                            fontWeight: 'bold',
                                            
                                        }
                                    }
                                },
                                
                                tooltip: {
                                    headerFormat: '<b>{point.x}</b><br/>',
                                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                                },
                                plotOptions: {
                                    column: {
                                        stacking: 'normal',
                                        dataLabels: {
                                            enabled: true
                                        }
                                    }
                                },
                                series: result
                          };

                        // Column chart
                        num_options.chart.renderTo = 'numb'+vis.id;
                        num_options.chart.type = 'column';
                        var chart1 = new Highcharts.Chart(num_options);
                        
                        var num_column = document.getElementById('colnum'+vis.id);
                        var num_bar = document.getElementById('barnum'+vis.id);
                        var num_pie = document.getElementById('pienum'+vis.id);
                        var num_line = document.getElementById('linenum'+vis.id);
                        var num_area = document.getElementById('areanum'+vis.id);

                                

                        num_column.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                                num_options.chart.type = 'column';
                                var chart1 = new Highcharts.Chart(num_options);
                        });
                        num_area.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                                num_options.chart.type = 'area';
                                var chart1 = new Highcharts.Chart(num_options);
                        });

                        num_bar.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                          num_options.chart.type = 'bar';
                                var chart1 = new Highcharts.Chart(num_options);
                        }); 
                        
                        num_pie.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                          num_options.chart.type = 'pie';
                                var chart1 = new Highcharts.Chart(num_options);
                        });

                        num_line.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                          num_options.chart.type = 'line';
                                var chart1 = new Highcharts.Chart(num_options);
                        });

                        })(i);


                        continue;

                      }
                      else if(vis.chart_type==2){



                        $('#vis'+vis.tab_id).append(
                          '<div class="row " style="margin-top: 40px;">'+
                        '<div class=" card col-md-12" style="background-color:#ffffff; ">'+
                        '<p class="text-center" style="font-size:18px;color:#000000;width:100%" >'+vis.title+'</p>'+
                        '<div class="float-right">'+
                        '<a href="#"  data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-filter iconic float-right"></i></a> '+
                        '<a href="<?php echo base_url("edit/visualizer/") ?>'+vis.id+'"><i class="fa fa-cog iconic "></i></a> '+
                        '</div>'+
                        '</div>'+

                        '<div class="card col-md-12" style="background-color:white" >'+
                        '<p class="text-center" style="font-size:18px;color:#000000;width:100%" >'+vis.pivot_header+'</p>'+
                        '<div id="table'+vis.id+'" style="width:100%; height:400px;">'+
                                '<table  class="table" lass="form-control">'+
                                  '<tr id="table_headers"></tr>'+
                                  '<tbody id="tablec'+vis.id+'"><tbody>'+
                                '</table>'+
                        '</div>'
                       
                        ); 

                        $('#table_headers').append('<th></th>');
                        for(var a in obj){
                        $('#table_headers').append('<th>'+JSON.parse(data)['indicators'][vis.id][a].element_name+'</th>');}

                        for(let i=0; i<3; i++){
                        $('#tablec'+vis.id).append('<tr>');
                        $('#tablec'+vis.id).append('<td>Orgunit</td>');
                        for(var a in obj){
                          $('#tablec'+vis.id).append('<td>'+JSON.parse(data)['indicators'][vis.id][a].element_id+'</td>');
                        }
                        $('#tablec'+vis.id).append('</tr>');
                        }
                        continue;
                      }
                        $('#vis'+vis.tab_id).append(
                        '<div class="row " style="margin-top: 40px;">'+
                        '<div class=" card col-md-12" style="background-color:#ffffff; ">'+
                        '<p class="text-center" style="font-size:18px;color:#000000;width:100%" >'+vis.title+'</p>'+
                        '<div class="float-right">'+
                       // '<a  data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-filter iconic float-right"></i></a> '+
                        '<a href="<?php echo base_url("edit/visualizer/") ?>'+vis.id+'"><i class="fa fa-cog iconic "></i></a> '+
                        '</div>'+
                        '</div>'+
                        '<div class="col-md-6" >'+
                        '<div id="numb'+vis.id+'" style="width:100%; height:400px;"></div>'+
                        
                        '<div class="row" style="margin-top:2%; margin-left: 2px;">'+
                                '<a  title="Bar chart" id="colnum'+vis.id+'"  ><i class="fa fa-barcode iconic"></i></a>'+
                                '<a  title="Area chart" id="areanum'+vis.id+'"  ><i class="fa fa-chart-area iconic"></i></a>'+
                                '<a  title="Histogram" id="barnum'+vis.id+'" ><i class="fa fa-chart-bar iconic"></i></a>'+
                                '<a  title="Piechart" id="pienum'+vis.id+'" ><i class="fa fa-chart-pie iconic"></i></a>'+
                              ' <a  title="Line chart" id="linenum'+vis.id+'" ><i class="fa fa-chart-line iconic"></i></a>'+
                                '</div>'+
                        '</div>'+

                        '<div class="col-md-6" >'+
                        '<div id="prop'+vis.id+'" style="width:100%; height:400px;"></div>'+
                          
                            '<div class="row" style="margin-top:2%; margin-left: 2px;">'+
                            '<a  title="Bar chart" id="colprop'+vis.id+'"  ><i class="fa fa-barcode iconic"></i></a>'+
                            '<a  title="Area chart" id="areaprop'+vis.id+'"  ><i  class="fa fa-chart-area iconic"></i></a></a>'+
                            '<a  title="Histogram" id="barprop'+vis.id+'"  ><i class="fa fa-chart-bar iconic"></i></a>'+
                            '<a  title="Pie chart" id="pieprop'+vis.id+'"  ><i class="fa fa-chart-pie iconic"></i></a>'+
                            '<a  title="Line chart" id="lineprop'+vis.id+'"  ><i class="fa fa-chart-line iconic"></i></a>'+
                            '</div>'+
                      '</div>'+
                    '</div>'
                    );
               
                  //let otr = JSON.parse(data)['indicator_data'][vis.id];
                        // Create the chart
                  (function(index){  
                        var num_options = {
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
                                title: {
                                    text: 'Number(#)'
                                },
                                xAxis: {
                                    categories: element_names
                                },
                                yAxis: {
                                    min: 0,
                                    title: {
                                        text: 'Score'
                                    },
                                    stackLabels: {
                                        enabled: true,
                                        style: {
                                            fontWeight: 'bold',
                                            
                                        }
                                    }
                                },
                                
                                tooltip: {
                                    headerFormat: '<b>{point.x}</b><br/>',
                                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                                },
                                plotOptions: {
                                    column: {
                                        stacking: 'normal',
                                        dataLabels: {
                                            enabled: true
                                        }
                                    }
                                },

                                series: result
                          };

     


                        // Column chart
                        num_options.chart.renderTo = 'numb'+vis.id;
                        num_options.chart.type = 'column';
                        var chart1 = new Highcharts.Chart(num_options);

                        
                        var num_column = document.getElementById('colnum'+vis.id);
                        var num_bar = document.getElementById('barnum'+vis.id);
                        var num_pie = document.getElementById('pienum'+vis.id);
                        var num_line = document.getElementById('linenum'+vis.id);
                        var num_area = document.getElementById('areanum'+vis.id);

                                

                        num_column.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                                num_options.chart.type = 'column';
                                var chart1 = new Highcharts.Chart(num_options);
                        });
                        num_area.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                                num_options.chart.type = 'area';
                                var chart1 = new Highcharts.Chart(num_options);
                        });

                        num_bar.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                          num_options.chart.type = 'bar';
                                var chart1 = new Highcharts.Chart(num_options);
                        }); 
                        
                        num_pie.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                          num_options.chart.type = 'pie';
                                var chart1 = new Highcharts.Chart(num_options);
                        });

                        num_line.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          num_options.chart.renderTo = 'numb'+vis.id;
                          num_options.chart.type = 'line';
                                var chart1 = new Highcharts.Chart(num_options);
                        });

                        })(i);

                      


                        (function(index){  

                                var prop_options = {
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
                                  title: {
                                      text: 'Proportion(%)'
                                  },
                                  xAxis: {
                                      categories: element_names
                                  },
                                  yAxis: {
                                      min: 0,
                                      title: {
                                          text: 'Score'
                                      },
                                      stackLabels: {
                                          enabled: true,
                                          style: {
                                              fontWeight: 'bold',
                                              
                                          }
                                      }
                                  },
                                  
                                  tooltip: {
                                      headerFormat: '<b>{point.x}</b><br/>',
                                      pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                                  },
                                  plotOptions: {
                                      column: {
                                          stacking: 'normal',
                                          dataLabels: {
                                              enabled: true
                                          }
                                      }
                                  },
                                  series: result_per
                            };

                        // Column chart
                        prop_options.chart.renderTo = 'prop'+vis.id;
                        prop_options.chart.type = 'column';
                        var chart2 = new Highcharts.Chart(prop_options);

                      // prop_chartfunc = function(index)
                      //   {

                        var prop_column = document.getElementById('colprop'+vis.id);
                        var prop_bar = document.getElementById('barprop'+vis.id);
                        var prop_pie = document.getElementById('pieprop'+vis.id);
                        var prop_line = document.getElementById('lineprop'+vis.id);
                        var prop_area = document.getElementById('areaprop'+vis.id);


                        prop_column.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          prop_options.chart.renderTo = 'prop'+vis.id;
                          prop_options.chart.type = 'column';
                              var chart2 = new Highcharts.Chart(prop_options);
                        });       

                        prop_area.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          prop_options.chart.renderTo = 'prop'+vis.id;
                          prop_options.chart.type = 'area';
                                var chart2 = new Highcharts.Chart(prop_options);
                        });
                            
                        prop_bar.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          prop_options.chart.renderTo = 'prop'+vis.id;
                          prop_options.chart.type = 'bar';
                                var chart2= new Highcharts.Chart(prop_options);
                        }); 
                        
                        prop_pie.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          prop_options.chart.renderTo = 'prop'+vis.id;
                          prop_options.chart.type = 'pie';
                                var chart2 = new Highcharts.Chart(prop_options);
                        });
                        prop_line.addEventListener('click', function () {
                          // console.log('clicked'+i);
                          prop_options.chart.renderTo = 'prop'+vis.id;
                          prop_options.chart.type = 'line';
                                var chart2 = new Highcharts.Chart(prop_options);
                        });
                     
                      })(i);
                 //end charts     
            }//end loop


        },complete:function (data){
          console.log('stop');
          $('#loader').hide();
        }
    });
    console.log('am here onasis');


    //end Of default AJAX function from selected Tab

    }

</script>
<?php endforeach; }?>

  <div  id="setting" class="row col-md-12 form-group">
                
                  <div class="col-md-6 form-control">

                  <form class="col-md-12" action="<?php echo base_url("edit/dashboard/".base64_encode($dashboard->id)) ?>" method="post" />
                        <div class="row">
                

                        <div class="col-md-12 col-sm124 col-xs-12 form-group">
                            <h6>Name</h6>
                            <input autocomplete="off" value="<?php echo $dashboard->name ?>" required type="text" name="name" class="form-control">
                            </div>
                            
                            <div class="col-md-12 col-sm124 col-xs-12  form-group">
                            <h6>Description</h6>
                            <textarea autocomplete="off" required type="text" name="description" class="form-control"><?php echo $dashboard->description; ?></textarea>
                            </div>

                        </div>

                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                  <form class="col-md-12" action="<?php echo base_url("delete/dashboard/".base64_encode($dashboard->id)) ?>" method="post" />
                      <div class="row">
              

                      <div class="col-md-12 col-sm124 col-xs-12 form-group">
                          <h6>Enter dashboard name </h6>
                          <small>with exact spelling</small>
                          <p style="color:red">Please note: deleting a dashboard will delete everything configured withing it</p>
                      
                          <input autocomplete="off" placeholder="<?php echo $dashboard->name ?>" required type="text" name="name" class="form-control">
                          </div>
                      </div>
                      
                      <div class="modal-footer">
                      <button type="submit" class="btn btn-danger">Delete</button>
                      </div>
                  </form>
      </div>

  <div class="col-md-6 form-control" style="background-color:#f4f6f8;">
    <h6>Categories/Checklists/Tabs</h6>
    <form action="<?php echo base_url('add/tab/') ?>" method="post">

      <input autocomplete="off" required type="text" name="name" class="form-control"></input>

      <input hidden required type="text" name="dash_id" value="<?php echo $dashboard->id ?>" class="form-control"></input>
      <button style="margin-top: 10px;" class="btn btn-primary ol-md-6 form-control">Add</button>

    </form>
    <hr>
    <h6> Tabs </h6>
    <table class="table">
      <tr>
        <th>Tab Name</th>
        <th>Action</th>
      </tr>
      <?php
      if (isset($tabs)) {
        foreach ($tabs as $tab) : ?>
          <tr>
            <td><?php echo $tab->name; ?></td>
            <td><a href="<?php echo base_url("delete/tab/" . base64_encode($tab->id)) ?>"><i class="fa fa-trash col-md-12" tyle="margin-left: 10px;"></i></a></td>
          </tr>
      <?php endforeach;
      } ?>
    </table>

  </div>

</div>

<div class="row float-right" style="margin-right:20px">
  <a class="iconic " href="<?php echo base_url('home') ?>" style="margin-left:20px; margin-top:20px; border-style">Back to Home</a>
  <div>
  
   <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form method="post" id="filter">
        <div class="modal-body">

            <div class="row">
              <div class="col">
                <label for="title">Regions</label>
                <select name="regions" id="region" class="form-control">
                  <option> Select </option>
                  <option value="UNSNiNqkzEM"> All of Zanzibar</option>
                  <?php
                  foreach (getRegion() as $key => $value) { ?>
                    <option value="<?= $value['id'] ?>"> <?= $value['displayName'] ?></option>

                  <?php } ?>
                </select> 
              </div>

              <div class="col">
                <label for="title"> Select Districts</label>
                <select name="districts" id="district" class="form-control selectpicker" data-live-search="true">
                  <!-- append here -->
                </select>
              </div>

              <div class="col">
                <label for="title"> Select Clinics</label>
                <select name="clinics" id="clinic" class="form-control selectpicker" data-live-search="true">
                  <!-- append here -->
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col">
              <label for="title"> Period</label>
              <input name="periods" id="period"  class="form-control selectpicker daterangepicker-field"></input>
              <input type="hidden" id="startday">
              <input type="hidden" id="endday">
              </div>
            </div>
         
        </div>
        <div class="modal-footer">
        <div id="filterLoader" style="width: 34%;padding: -2px;" >
        <img src="<?php echo base_url('assets/loading.svg') ?>" height="50px" width="50px" >
        </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="filterbtn" class="btn btn-light">Filter</button>
        </div> 
      </form>
      </div>
    </div>
  </div>
 
<script>
  $(document).ready(function() {
    $("#region").change(function() {
      var region = $("#region").val();

      $.ajax({
        url:"<?=base_url()?>view/districts",
        method: "POST",
        cache: false,
        data: 'region=' + region
      }).done(function(district) {
        //console.log(district);
        district = JSON.parse(district);
        $('#district').empty();
        $("#district").append('<option value="UNSNiNqkzEM" > All clinics </option>')
        district.forEach(function(district) {
          $("#district").append('<option value="' + district.id + '" >' + district.name + '</option>')
        })
        $('#district').selectpicker('refresh');
      })

    })
    $("#district").change(function() {
      var district = $("#district").val();

      $.ajax({
        url:"<?=base_url()?>view/clinics",
        method: "POST",
        cache: false,
        data: 'district=' + district
      }).done(function(clinic) {
        //console.log(clinic);
        clinic = JSON.parse(clinic);
        $('#clinic').empty();
        clinic.forEach(function(clinic) {
          $("#clinic").append('<option value="' + clinic.id + '" >' + clinic.name + '</option>')
        })
        $('#clinic').selectpicker('refresh');

      })

    })

  })


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
  $('select').selectpicker();
  
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


