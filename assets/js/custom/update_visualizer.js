var map_array = [];

function update_visulizer(id, data, filtervisid, link, auth) {

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

    // console.log("The data ",JSON.parse(data));

    var len = JSON.parse(data)['visualizers'].length;

    if (len == 0) {
        $('#waitingText' + id).css('display', 'unset');
    }

    //Begining of filter loop


    for (let i = 0; i < len; i++) {

        let vis = JSON.parse(data)['visualizers'][i];

        // console.log("Chart type",JSON.parse(data)['rows_count']);

        // if (JSON.parse(data)['rows_count'] > 0) {


            $('#numb' + vis.id).empty();

            // let result = element_values.map(i=>Number(i));
            if (vis.chart_type == 4) {

                $('#vis_id' + vis.id).empty();

                var single_data = JSON.parse(data)['items'][vis.id]['y_data'];


                let sum = 0;

                for (let i = 0; i < single_data.length; i++) {
                    for (let j = 0; j < single_data[i]['data'].length; j++) {

                        sum += single_data[i]['data'][j];

                    }
                }

                var title = vis.title

                $('#vis_id' + vis.id).append('<div class="col-md-12" style="display: inline-flex; padding:6px">' +
                    ' <div class="col-md-8" style="padding:0px">' +
                    '<strong style="float: left;">' + vis.title + '</strong>' +
                    '</div>' +

                    ' <div class="col-md-4" style="padding:0px">' +

                    '<div class="dropdown"  style="float:right">' +
                    //                    '<button  style="box-shadow: 0 12px 39px -8px rgba(9, 9, 16, .2);" class="chart-dropdown dropbtn btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" style="color:#888888" aria-hidden="true"></i>'+
                    // '</button>'+

                    '<button   style="float:right" data-toggle="dropdown" class="chart-dropdown btn btn-link "><i class="fa fa-filter" style="color:#00796b" aria-hidden="true"></i></button> ' +

                    '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">' +
                    '<a class="dropdown-item" onclick="general_period_filter(' + vis.id + ', ' + vis.tab_id + ', ' + vis.chart_type + ')">Period</a>' +
                    '<a class="dropdown-item" onclick="local_organization_filter(' + vis.id + ', ' + vis.tab_id + ', ' + vis.chart_type + ')">Organization Unit</a>' +
                     '<a class="dropdown-item" onclick=" comment(' + vis.id + ') ">Comment</a>' +
                    '<a class="dropdown-item" id="edit'+vis.id+'" style="display: inline flow-root list-item;" href="'+link+vis.id+'">Edit</i></a><br>'+
                   
                    '</div>' +
                    ' </div>' +


                    '</div>' +
                    '</div>' +

                    '<div style="overflow:hidden;height:80%">' +
                    '<div class="col-md-12">' +
                    '<div class="col-md-12" style="margin: 5px;text-align: center;height: 20px">' +

                    ' <p>' + JSON.parse(data)['items'][vis.id]['y_data'][0]['name'] + '</p>' +

                    '</div>' +

                    ' </div>' +


                    '<div class="col-md-12">' +
                    '<div class="col-md-12" style="margin: 8px;height: 20px;text-align: center;">' +

                    ' <p >' + JSON.parse(data)['items'][vis.id]['filter'] + '</p>' +

                    '</div>' +



                    ' </div>' +


                    '<div class="col-md-12">' +
                    ' <div class="col-md-8" style="margin: auto;text-align: center;font-size:7vmax ">' +

                    ' <p style="font-size: 20px; font-size: 1.5vw;">' + sum + '</p>' +
                    ' </div>' +
                    ' </div>' +


                    ' </div>');

                    if(!auth){

                    $('#edit'+vis.id).hide();

                     
                   }

            } else if (vis.chart_type == 1) {

                let sort_status = 'false';

                (function(index) {

                    var normal_options = {
                        chart: {
                            events: {
                                drilldown: function(e) {
                                    if (!e.seriesOptions) {

                                        var chart = this;

                                        // Show the loading label
                                        chart.showLoading('Loading ...');

                                        setTimeout(function() {
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
                            text: JSON.parse(data)['items'][vis.id]['title']
                        },
                        subtitle: {
                            text: JSON.parse(data)['items'][vis.id]['filter'],
                        },
                        xAxis: {
                            categories: JSON.parse(data)['items'][vis.id]['x_data'],
                            crosshair: true,
                        },
                        yAxis: {
                            min: 0,
                            endOnTick: false,
                            title: {
                                text: 'Number of supervised HFs',
                            },
                            stackLabels: {
                                enabled: false,
                                style: {
                                    fontWeight: 'bold',
                                }
                            }
                        },

                        tooltip: {
                            headerFormat: '<b>{point.x}</b><br/>',
                            pointFormat: '{series.name}: {point.y}'
                        },
                        plotOptions: {
                            column: {
                                // stacking: 'normal',
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },
                        exporting: {
                            buttons: {
                                contextButton: {
                                    symbol: 'download'
                                }
                            },
                            
                            chartOptions: {
                                plotOptions: {
                                    series: {
                                        dataLabels: {
                                            enabled: true,
                                            
                                            style: {
                                                textOutline: 'none',
                                                
                                            }
                                        }
                                    }
                                }
                            }

                        },


                        series: JSON.parse(data)['items'][vis.id]['y_data']
                    };

                    var stacked_options = {
                        chart: {
                            events: {
                                drilldown: function(e) {
                                    if (!e.seriesOptions) {

                                        var chart = this;

                                        // Show the loading label
                                        chart.showLoading('Loading ...');

                                        setTimeout(function() {
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
                            text: JSON.parse(data)['items'][vis.id]['title'],
                        },

                        subtitle: {
                            text: JSON.parse(data)['items'][vis.id]['filter'],
                        },
                        xAxis: {
                            categories: JSON.parse(data)['items'][vis.id]['x_data'],
                            crosshair: true,

                        },
                        yAxis: {
                            min: 0,
                            endOnTick: false,
                            title: {
                                text: ''
                            },
                            stackLabels: {
                                enabled: false,
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
                            series: {
                                stacking: 'normal',
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },
                        exporting: {
                            buttons: {
                                contextButton: {
                                    symbol: 'download'
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
                            text: JSON.parse(data)['items'][vis.id]['title']
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
                        exporting: {
                            buttons: {
                                contextButton: {
                                    symbol: 'download'
                                }
                            }

                        },
                        series: [{
                            name: 'Data',
                            colorByPoint: true,
                            data: JSON.parse(data)['items'][vis.id]['y_data']

                        }]
                    };

                    stacked_options.chart.renderTo = 'numb' + vis.id;
                    stacked_options.chart.type = 'column';
                    var chart1 = new Highcharts.Chart(stacked_options);

                    //Display default charts as imported or last set 

                    if (JSON.parse(data)['items'][vis.id]['chart_options'] == 1) {

                        normal_options.chart.renderTo = 'numb' + vis.id;
                        normal_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
                        var chart1 = new Highcharts.Chart(normal_options);

                    } else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 2) {

                        stacked_options.chart.renderTo = 'numb' + vis.id;
                        stacked_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
                        var chart1 = new Highcharts.Chart(stacked_options);


                    } else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 'pie') { //3 for pie chart

                        num_pie_options.chart.renderTo = 'numb' + vis.id;
                        num_pie_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
                        var chart1 = new Highcharts.Chart(num_pie_options);
                    } else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 'table') { //3 for pie chart

                        var table = new Tabulator("#numb" + vis.id, {
                            layout: "fitDataFill",
                            maxHeight: "100%",
                            columns: JSON.parse(data)['items'][vis.id]['headers'],
                            data: JSON.parse(data)['items'][vis.id]['table_data'],
                            headerBackgroundColor: '#dae6f8'

                        });

                        $('#drop_id' + vis.id).show();


                        //trigger download of data.csv file
                        document.getElementById("download-csv" + vis.id).addEventListener("click", function() {
                            table.download("csv", vis.title+".csv");
                        });


                        //trigger download of data.xlsx file
                        document.getElementById("download-xlsx" + vis.id).addEventListener("click", function() {
                            table.download("xlsx", vis.title+".xlsx", { sheetName: vis.title });
                        });

                        //trigger download of data.pdf file
                        document.getElementById("download-pdf" + vis.id).addEventListener("click", function() {
                            table.download("pdf", vis.title+".pdf", {
                                orientation: "portrait", //set page orientation to portrait
                                title: vis.title, //add title to report
                            });
                        });

                    }


                    var num_bar = document.getElementById('bar' + vis.id);
                    var num_barstack = document.getElementById('barstack' + vis.id);
                    var num_horizontal = document.getElementById('horizontal' + vis.id);
                    var num_horizontal_stack = document.getElementById('horizontal_stack' + vis.id);
                    var num_pie = document.getElementById('pieprop' + vis.id);
                    var num_line = document.getElementById('lineprop' + vis.id);
                    var num_area = document.getElementById('areaprop' + vis.id);
                    var table_prop = document.getElementById('tableprop' + vis.id);
                    var sort = document.getElementById('sort' + vis.id);


                    table_prop.addEventListener('click', function() {

                        var table = new Tabulator("#numb" + vis.id, {
                            layout: "fitColumns",
                            maxHeight: "100%",
                            columns: [{ title: JSON.parse(data)['items'][vis.id]['filter'], columns: [{ title: "Element /Score", field: "element" }, { title: "<=50%", field: "<=50%" }, { title: "50% - 75% ", field: "50% - 75%" }, { title: ">= 75%", field: ">=75%" }] }],

                            data: JSON.parse(data)['items'][vis.id]['table_data'],

                        });

                        $('#drop_id' + vis.id).show();


                        //trigger download of data.csv file
                        document.getElementById("download-csv" + vis.id).addEventListener("click", function() {
                            table.download("csv", vis.title+".csv");
                        });


                        //trigger download of data.xlsx file
                        document.getElementById("download-xlsx" + vis.id).addEventListener("click", function() {
                            table.download("xlsx", vis.title+".xlsx", { sheetName: vis.title });
                        });

                        //trigger download of data.pdf file
                        document.getElementById("download-pdf" + vis.id).addEventListener("click", function() {
                            table.download("pdf", vis.title+".pdf", {
                                orientation: "portrait", //set page orientation to portrait
                                title: vis.title, //add title to report
                            });
                        });




                    });

                    sort.addEventListener('click', function() {

                        sort_status = !(sort_status);

                    });



                    num_bar.addEventListener('click', function() {

                        $('#drop_id' + vis.id).hide();
                        document.getElementById('numb' + vis.id).style.display = "block";

                        // consolee.log('clicked'+i);
                        normal_options.chart.renderTo = 'numb' + vis.id;
                        normal_options.chart.type = 'column';
                        var chart1 = new Highcharts.Chart(normal_options);
                    });

                    num_barstack.addEventListener('click', function() {

                        $('#drop_id' + vis.id).hide();
                        document.getElementById('numb' + vis.id).style.display = "block";

                        // consolee.log('clicked'+i);
                        stacked_options.chart.renderTo = 'numb' + vis.id;
                        stacked_options.chart.type = 'column';

                        stacked_options.legend = 'reversed :true';

                        var chart1 = new Highcharts.Chart(stacked_options);
                    });


                    num_horizontal.addEventListener('click', function() {

                        $('#drop_id' + vis.id).hide();
                        document.getElementById('numb' + vis.id).style.display = "block";
                        // consolee.log('clicked'+i);
                        normal_options.chart.renderTo = 'numb' + vis.id;
                        normal_options.chart.type = 'bar';
                        var chart1 = new Highcharts.Chart(normal_options);
                    });


                    num_horizontal_stack.addEventListener('click', function() {

                        $('#drop_id' + vis.id).hide();
                        document.getElementById('numb' + vis.id).style.display = "block";
                        // consolee.log('clicked'+i);
                        stacked_options.chart.renderTo = 'numb' + vis.id;
                        stacked_options.chart.type = 'bar';
                        var chart1 = new Highcharts.Chart(stacked_options);
                    });



                    num_pie.addEventListener('click', function() {

                        $('#drop_id' + vis.id).hide();
                        document.getElementById('numb' + vis.id).style.display = "block";
                        // consolee.log('clicked'+i);
                        num_pie_options.chart.renderTo = 'numb' + vis.id;
                        num_pie_options.chart.type = 'pie';
                        // normal_option\s.chart.plotBorderWidth = 'null';
                        //  normal_options.chart.plotShadow = 'false';
                        var chart1 = new Highcharts.Chart(num_pie_options);
                    });



                    num_line.addEventListener('click', function() {
                        $('#drop_id' + vis.id).hide();
                        document.getElementById('numb' + vis.id).style.display = "block";
                        // consolee.log('clicked'+i);
                        normal_options.chart.renderTo = 'numb' + vis.id;
                        normal_options.chart.type = 'line';
                        var chart1 = new Highcharts.Chart(normal_options);
                    });



                    num_area.addEventListener('click', function() {
                        $('#drop_id' + vis.id).hide();
                        document.getElementById('numb' + vis.id).style.display = "block";
                        // consolee.log('clicked'+i);
                        normal_options.chart.renderTo = 'numb' + vis.id;
                        normal_options.chart.type = 'area';
                        var chart1 = new Highcharts.Chart(normal_options);
                    });



                })(i);

                continue;


            } else if (vis.chart_type == 3) {



                let sort_status = 'false';



                let max = JSON.parse(data)['items'][vis.id]['maximum'];


                (function(index) {
                    var chart1;
                    

                    var normal_options = {
                        chart: {
                            events: {
                                // drilldown: function(e) {
                                //     if (!e.seriesOptions) {

                                //         var chart = this;

                                //         // Show the loading label
                                //         chart.showLoading('Loading ...');

                                //         setTimeout(function() {
                                //             chart.hideLoading();
                                //             chart.addSeriesAsDrilldown(e.point, series);
                                //         }, 1000);
                                //     }

                                // }
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
                            categories: JSON.parse(data)['items'][vis.id]['x_data'],
                            crosshair: true,
                        },
                        yAxis: {
                            min: 0,
                            endOnTick: true,
                            title: {
                                text: JSON.parse(data)['items'][vis.id]['axis_label']
                            },
                            stackLabels: {
                                enabled: false,
                                style: {
                                    fontWeight: 'bold',
                                }
                            }
                        },
                        exporting: {
                            buttons: {
                                contextButton: {
                                    symbol: 'download'
                                }
                            }

                        },

                        tooltip: {
                            headerFormat: '<b>{point.x}</b><br/>',
                            pointFormat: '{series.name}: {point.y}'
                        },
                        plotOptions: {
                            column: {
                                // stacking: 'normal',
                                dataLabels: {
                                    enabled: JSON.parse(data)['items'][vis.id]['data_labels']
                                }
                            },
                            series: {
                                // stacking: 'normal',
                                dataLabels: {
                                    enabled: JSON.parse(data)['items'][vis.id]['data_labels'],
                                }
                            }
                        },


                        series: JSON.parse(data)['items'][vis.id]['y_data']
                    };

                    newPoint = [];
                    var stacked_options = {
                        chart: {
                            events: {
                                // drilldown: function(e) {
                                //     if (!e.seriesOptions) {

                                //         var chart = this;

                                //         // Show the loading label
                                //         chart.showLoading('Loading ...');

                                //         setTimeout(function() {
                                //             chart.hideLoading();
                                //             chart.addSeriesAsDrilldown(e.point, series);
                                //         }, 1000);
                                //     }

                                // }
                            },
                            plotBorderWidth: 0
                        },

                        credits: {
                            text: 'Source: dhis2.org'
                        },
                        title: {
                            text: vis.title,
                        },

                        subtitle: {
                            text: JSON.parse(data)['items'][vis.id]['filter'],
                        },
                         xAxis: {
                            categories: JSON.parse(data)['items'][vis.id]['x_data'],
                        },
                        yAxis: {
                            reversedStacks: false,
                            min: 0,
                            endOnTick: true,
                            title: {
                                text: JSON.parse(data)['items'][vis.id]['axis_label']
                            },
                            stackLabels: {
                                enabled: JSON.parse(data)['items'][vis.id]['data_labels'],
                                style: {
                                    fontWeight: 'bold',
                                }
                            }
                        },
                        exporting: {
                            buttons: {
                                contextButton: {
                                    symbol: 'download'
                                }
                            }

                        },
                        tooltip: {
                            headerFormat: '<b>{point.x}</b><br/>',
                            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                        },
                        plotOptions: {
                            series: {
                                stacking: 'normal',
                                dataLabels: {
                                    enabled: false
                                }
                            },
                            //  column: {
                            //     stacking: 'normal',
                            //     dataLabels: {
                            //         enabled: false
                            //     }
                            // },
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
                        exporting: {
                            buttons: {
                                contextButton: {
                                    symbol: 'download'
                                }
                            }

                        },
                        series: [{
                            name: 'Data',
                            colorByPoint: true,
                            data: JSON.parse(data)['items'][vis.id]['y_data']

                        }]
                    };



                    if (JSON.parse(data)['items'][vis.id]['maximum'] > 0) {

                        stacked_options.yAxis.max = JSON.parse(data)['items'][vis.id]['maximum'];
                        normal_options.yAxis.max = JSON.parse(data)['items'][vis.id]['maximum'];


                    }


                    //Display default charts as imported or last set 
                    var legendSet = JSON.parse(data)['items'][vis.id]['legendSet'];


                    if (JSON.parse(data)['items'][vis.id]['chart_options'] == 1) {

                        normal_options.chart.renderTo = 'numb' + vis.id;
                        normal_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
                        chart1 = new Highcharts.Chart(normal_options);

                    } else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 2) {

                        stacked_options.chart.renderTo = 'numb' + vis.id;
                        stacked_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
                        chart1 = new Highcharts.Chart(stacked_options);
                    } else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 'pie') { //3 for pie chart

                        num_pie_options.chart.renderTo = 'numb' + vis.id;
                        num_pie_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
                        chart1 = new Highcharts.Chart(num_pie_options);
                    } else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 'map') { //3 for pie chart

                        $('#a_z_sort' + vis.id).hide();
                        $('#descending' + vis.id).hide();
                        $('#ascending' + vis.id).hide();
                        $('#numb' + vis.id).empty();


                        drawmap(JSON.parse(data)['indicator_data'][vis.id], vis.id, JSON.parse(data)['items'][vis.id]['level'], JSON.parse(data)['items'][vis.id]['map_legend'], vis.subtitle, JSON.parse(data)['items'][vis.id]['filter'], i);
                    } else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 'table') { //3 for pie chart

                         $('#a_z_sort' + vis.id).hide();
                        $('#descending' + vis.id).hide();
                        $('#ascending' + vis.id).hide();
                        if (legendSet) {

                            var table = new Tabulator("#numb" + vis.id, {
                                layout: "fitDataFill",
                                maxHeight: "100%",
                                columns: JSON.parse(data)['items'][vis.id]['headers'],
                                data: JSON.parse(data)['items'][vis.id]['table_data'],
                                headerBackgroundColor: '#dae6f8',


                                rowFormatter: function(row) {

                                    var cells = row.getCells();
                                    cells.forEach(myFunction);
                                },






                            });
                        } else {


                            var table = new Tabulator("#numb" + vis.id, {
                                layout: "fitDataFill",
                                maxHeight: "100%",
                                columns: JSON.parse(data)['items'][vis.id]['headers'],
                                data: JSON.parse(data)['items'][vis.id]['table_data'],
                                headerBackgroundColor: '#dae6f8'


                            });
                        }

                        $('#drop_id' + vis.id).show();

                        //trigger download of data.csv file
                        document.getElementById("download-csv" + vis.id).addEventListener("click", function() {
                            table.download("csv", vis.title+".csv");
                        });


                        //trigger download of data.xlsx file
                        document.getElementById("download-xlsx" + vis.id).addEventListener("click", function() {
                            table.download("xlsx", vis.title+".xlsx", { sheetName: vis.title });
                        });

                        //trigger download of data.pdf file
                        document.getElementById("download-pdf" + vis.id).addEventListener("click", function() {
                            table.download("pdf", vis.title+".pdf", {
                                orientation: "portrait", //set page orientation to portrait
                                title: vis.title, //add title to report
                            });
                        });



                    }

                    function myFunction(cell) {
                        var value = cell.getValue();

                        if (value) {


                            if (value.indexOf('$') > 0) {

                                var value = value.split('$');
                                cell.getElement().style.backgroundColor = value[1];
                                cell.setValue(value[0]);
                            } else if (value.indexOf('$') > 4) {
                                var value = value.split('$');
                                cell.setValue(value[1]);
                            } else {
                                var value = value.split('$');
                                cell.getElement().style.backgroundColor = value[0];
                                // cell.setValue('');
                            }
                        }
                    }



                    var num_bar = document.getElementById('bar' + vis.id);
                    var num_barstack = document.getElementById('barstack' + vis.id);
                    var num_horizontal = document.getElementById('horizontal' + vis.id);
                    var num_horizontal_stack = document.getElementById('horizontal_stack' + vis.id);
                    var num_pie = document.getElementById('pieprop' + vis.id);
                    var num_line = document.getElementById('lineprop' + vis.id);
                    var num_area = document.getElementById('areaprop' + vis.id);
                    var table_prop = document.getElementById('tableprop' + vis.id);
                    var sort = document.getElementById('sort' + vis.id);
                    var map_btn = document.getElementById('map' + vis.id);
                    var a_z_sort = document.getElementById('a_z_sort' + vis.id);
                    var ascending = document.getElementById('ascending' + vis.id);
                    var descending = document.getElementById('descending' + vis.id);

                 // console.log('chart data', JSON.parse(data)['items'][vis.id]['y_data'])
                 // console.log('categories', JSON.parse(data)['items'][vis.id]['x_data'])


                  // Event Listener to sort data from maximum to minimum
                  ascending.addEventListener('click', function() {
                     sortData(chart1,'max')
                  })
                  // Event Listener to sort data from minimum to maximum
                  descending.addEventListener('click', function() {
                     sortData(chart1,'min')
                  })
                  // Event Listener to sort data in alphabetical order

                   a_z_sort.addEventListener('click', function() {
                      sortData(chart1,'A-Z')
                   })
                  
                      var sortData = function(chartSource,type) {

                        var series = chartSource.series;
                        var axis = chartSource.xAxis[0];
                        var categories = [];

                        if ($.isArray(series)) {

                          var ser = $.grep(series, function(ser, seriesIndex) {

                            return ser.visible;
                          }) [0];

                          $.each(ser.data, function(dataIndex, datum) {
                            //console.log(datum.category + ": " + datum.stackTotal);
                            if ( chartSource.options.plotOptions.series.stacking == 'normal' ) {
                              var obj = {
                                  name: datum.category,
                                  index: dataIndex,
                                  stackTotal: datum.stackTotal
                                }
                            }
                            else{
                                var obj = {
                                  name: datum.category,
                                  index: dataIndex,
                                  stackTotal: datum.options.y
                                }
                            }

                            categories.push(obj);
                          });
                        }

                        categories.sort(function(a, b) {
                          var aName = a.name.toLowerCase();
                          var bName = b.name.toLowerCase();
                          var aTotal = a.stackTotal;
                          var bTotal = b.stackTotal;

                          if (type=='max') {
                            if (aTotal === bTotal) {
                              return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
                            } else {
                              return ((aTotal > bTotal) ? -1 : ((aTotal < bTotal) ? 1 : 0));
                            }

                          }
                          if (type=='min') {
                            if (aTotal === bTotal) {
                              return ((aName > bName) ? -1 : ((aName < bName) ? 1 : 0));
                            } else {
                              return ((aTotal < bTotal) ? -1 : ((aTotal > bTotal) ? 1 : 0));
                            }

                          }
                           if (type=='A-Z') {
                             if (aName < bName) return -1;
                             if (aName > bName) return 1;
                             return 0;
                          }

                        });

                        var mappedIndex = $.map(categories, function(category, index) {

                          return category.index;
                        });

                        categories = $.map(categories, function(category, index) {

                          return category.name;
                        });

                        axis.setCategories(categories);

                        $.each(series, function(seriesIndex, ser) {

                          var data = $.map(mappedIndex, function(mappedIndex, origIndex) {

                            return ser.data[mappedIndex].y;
                          });

                          ser.setData(data, false);
                        });

                        chartSource.redraw();

                      };

                      if(JSON.parse(data)['items'][vis.id]['sort']){

                        sortData(chart1,'max')
                      }

                    table_prop.addEventListener('click', function() {

                        $('#a_z_sort' + vis.id).hide();
                        $('#descending' + vis.id).hide();
                        $('#ascending' + vis.id).hide();
                        $('#drop_id' + vis.id).show();

                        if (legendSet) {

                            var table = new Tabulator("#numb" + vis.id, {
                                layout: "fitDataFill",
                                maxHeight: "100%",
                                columns: JSON.parse(data)['items'][vis.id]['headers'],
                                data: JSON.parse(data)['items'][vis.id]['table_data'],
                                headerBackgroundColor: '#dae6f8',


                                rowFormatter: function(row) {

                                    var cells = row.getCells();
                                    cells.forEach(myFunction);
                                },

                            });
                        } else {

                            var table = new Tabulator("#numb" + vis.id, {
                                layout: "fitDataFill",
                                maxHeight: "100%",
                                columns: JSON.parse(data)['items'][vis.id]['headers'],
                                data: JSON.parse(data)['items'][vis.id]['table_data'],
                                headerBackgroundColor: '#dae6f8'

                            });
                        }
                        $('#drop_id' + vis.id).show();
                        //trigger download of data.csv file
                        document.getElementById("download-csv" + vis.id).addEventListener("click", function() {
                            table.download("csv", vis.title+".csv");
                        });

                        //trigger download of data.json file


                        //trigger download of data.xlsx file
                        document.getElementById("download-xlsx" + vis.id).addEventListener("click", function() {
                            table.download("xlsx", vis.title+".xlsx", { sheetName: vis.title });
                        });

                        //trigger download of data.pdf file
                        document.getElementById("download-pdf" + vis.id).addEventListener("click", function() {
                            table.download("pdf", vis.title+".pdf", {
                                orientation: "portrait", //set page orientation to portrait
                                title: vis.title, //add title to report
                            });
                        });

                    });

                    
                    map_btn.addEventListener('click', function() {



                        $('#a_z_sort' + vis.id).hide();
                        $('#descending' + vis.id).hide();
                        $('#ascending' + vis.id).hide();

                        $('#drop_id' + vis.id).hide();

                        $('#numb' + vis.id).empty();


                        drawmap(JSON.parse(data)['indicator_data'][vis.id], vis.id, JSON.parse(data)['items'][vis.id]['level'], JSON.parse(data)['items'][vis.id]['map_legend'], vis.subtitle, JSON.parse(data)['items'][vis.id]['filter'], i);

                    });


                    num_bar.addEventListener('click', function() {

                          $('#a_z_sort' + vis.id).show();
                        $('#descending' + vis.id).show();
                        $('#ascending' + vis.id).show();

                         $('#a_z_sort' + vis.id).show();
                        $('#descending' + vis.id).show();
                        $('#ascending' + vis.id).show();
                        document.getElementById('numb' + vis.id).style.display = "block";
                        $('#drop_id' + vis.id).hide();

                        // consolee.log('clicked'+i);
                        normal_options.chart.renderTo = 'numb' + vis.id;
                        normal_options.chart.type = 'column';
                        chart1 = new Highcharts.Chart(normal_options);
                    });

                    num_barstack.addEventListener('click', function() {

                          $('#a_z_sort' + vis.id).show();
                        $('#descending' + vis.id).show();
                        $('#ascending' + vis.id).show();
                        document.getElementById('numb' + vis.id).style.display = "block";
                        $('#drop_id' + vis.id).hide();

                        // consolee.log('clicked'+i);
                        stacked_options.chart.renderTo = 'numb' + vis.id;
                        stacked_options.chart.type = 'column';

                        // stacked_options.legend= 'reversed :true';

                        chart1 = new Highcharts.Chart(stacked_options);
                    });



                    num_horizontal.addEventListener('click', function() {

                          $('#a_z_sort' + vis.id).show();
                        $('#descending' + vis.id).show();
                        $('#ascending' + vis.id).show();
                        document.getElementById('numb' + vis.id).style.display = "block";
                        $('#drop_id' + vis.id).hide();
                        // consolee.log('clicked'+i);
                        normal_options.chart.renderTo = 'numb' + vis.id;
                        normal_options.chart.type = 'bar';
                        normal_options.chart.plotOptions = ' {column: {stacking: "normal",dataLabels: {enabled: true}}';
                        chart1 = new Highcharts.Chart(normal_options);
                    });


                    num_horizontal_stack.addEventListener('click', function() {

                          $('#a_z_sort' + vis.id).show();
                        $('#descending' + vis.id).show();
                        $('#ascending' + vis.id).show();
                        document.getElementById('numb' + vis.id).style.display = "block";
                        $('#drop_id' + vis.id).hide();
                        // consolee.log('clicked'+i);
                        stacked_options.chart.renderTo = 'numb' + vis.id;
                        stacked_options.chart.type = 'bar';
                        chart1 = new Highcharts.Chart(stacked_options);
                    });



                    num_pie.addEventListener('click', function() {

                          $('#a_z_sort' + vis.id).show();
                        $('#descending' + vis.id).show();
                        $('#ascending' + vis.id).show();
                        document.getElementById('numb' + vis.id).style.display = "block";
                        $('#drop_id' + vis.id).hide();
                        // consolee.log('clicked'+i);
                        num_pie_options.chart.renderTo = 'numb' + vis.id;
                        num_pie_options.chart.type = 'pie';
                        // normal_option\s.chart.plotBorderWidth = 'null';
                        //  normal_options.chart.plotShadow = 'false';
                        chart1 = new Highcharts.Chart(num_pie_options);
                    });



                    num_line.addEventListener('click', function() {

                          $('#a_z_sort' + vis.id).show();
                        $('#descending' + vis.id).show();
                        $('#ascending' + vis.id).show();
                        $('#drop_id' + vis.id).hide();
                        document.getElementById('numb' + vis.id).style.display = "block";
                        // consolee.log('clicked'+i);
                        normal_options.chart.renderTo = 'numb' + vis.id;
                        normal_options.chart.type = 'line';
                        chart1 = new Highcharts.Chart(normal_options);
                    });



                    num_area.addEventListener('click', function() {

                          $('#a_z_sort' + vis.id).show();
                        $('#descending' + vis.id).show();
                        $('#ascending' + vis.id).show();
                        $('#drop_id' + vis.id).hide();
                        document.getElementById('numb' + vis.id).style.display = "block";
                        // consolee.log('clicked'+i);
                        normal_options.chart.renderTo = 'numb' + vis.id;
                        normal_options.chart.type = 'area';
                        chart1 = new Highcharts.Chart(normal_options);


                    });

                    
                    var map;

                    var client;
                    var source;
                    var level;
                    var legend_array;

                    var vis_ids;

                    var count = [0, 0, 0, 0, 0, 0];



                    function drawmap(data, vis_id, levels, legend_arrays, subtitle, filter, i) {

                        // console.log('vis id',vis.id)

                        // console.log("The legend_array",legend_arrays);


                        count = [];
                        count = [0, 0, 0, 0, 0, 0];

                        // console.log("The map array", map_array);


                        if (map_array[vis.id] != undefined) map_array[vis.id].remove();

                        document.getElementById('numb' + vis_id).innerHTML = "";

                        //      map.setView([-5.665243545101811, 39.47045283836419], 8.5);



                        map = L.map('numb' + vis_id).setView([-5.665243545101811, 39.47045283836419], 8);
                        map.scrollWheelZoom.disable();




                        vis_ids = vis_id;
                        map_array[vis.id] = map



                        map.zoomControl.setPosition('topright');


                        // map.setView([-5.665243545101811, 39.47045283836419], 8.5);

                        //   const wellBounds = new L.latLngBounds([-4.8562613604186655, 39.68225183059107],[-6.516486, 39.506349]);
                        // map.fitBounds(wellBounds);

                        level = levels;
                        legend_array = legend_arrays


                        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/light_all/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            zoomControl: false


                        }).addTo(map);

                        if (level > 0) {

                            client = new carto.Client({
                                apiKey: 'f99a497f0aef7a920d66551001a98875180421ae',
                                username: 'citsappstz'
                            });

                            var source = new carto.source.Dataset('level' + level);
                            var style = new carto.style.CartoCSS(`
							        #layer {
							            polygon-fill: #ffffff;
							            polygon-opacity: 0.9;
							          }
							          #layer::outline {
							            line-width: 1;
							            line-color: #000000;
							            line-opacity: 0.56;
							          }

							        `);



                            var layer = new carto.layer.Layer(source, style);

                            client.addLayer(layer);


                            data.forEach(data_extract);

                            var colors = ['#ffffd4', '#fed98e', '#fe9929', '#d95f0e', '#993404'];


                            L.CustomControl = L.Control.extend({
                                options: {
                                    position: 'topright'
                                        //control position - allowed: 'topleft', 'topright', 'bottomleft', 'bottomright'

                                },

                                onAdd: function(map) {

                                    var container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
                                    container.title = "Plain Text Title";
                                    var button = L.DomUtil.create('a', '', container);
                                    button.style.display = "block";
                                    button.innerHTML = '<i class="fa fa-list"></i>';
                                    L.DomEvent.disableClickPropagation(button);
                                    L.DomEvent.on(button, 'click', this._click, this);
                                    L.DomEvent.on(button, 'mouseover', this._mouseover, this);
                                    L.DomEvent.on(button, 'mouseout', this._mouseout, this);



                                    var hiddenContainer = L.DomUtil.create('div', ' legend', container);
                                    hiddenContainer.style.display = "none";

                                    L.DomEvent.on(hiddenContainer, 'mouseover', this._mouseover, this);
                                    L.DomEvent.on(hiddenContainer, 'mouseout', this._mouseout, this);
                                    L.DomEvent.disableClickPropagation(hiddenContainer);

                                    this.hiddenContainer = hiddenContainer;
                                    this.button = button;

                                    return container;
                                },
                                _click: function() {},
                                _mouseover: function() {
                                    this.hiddenContainer.style.display = "block";
                                    this.button.style.display = "none";
                                },
                                _mouseout: function() {
                                    this.hiddenContainer.style.display = "none";
                                    this.button.style.display = "block";
                                },
                                setContent: function(text) {
                                    this.hiddenContainer.innerHTML = text;
                                }
                            });

                            if (level > 0) {
                                var control = new L.CustomControl().addTo(map)
                                control.setContent('<h7><b>' + subtitle + '</b></h7><br><h7>' + filter + '</h7> <table class="legend-table" >' +
                                    '<tr><td><i style="background-color:' + colors[0] + ';"></i></td><td> ' + legend_array[0] + '-' + legend_array[1] + '  (' + count[0] + ')' + '</td></tr>' +
                                    '<tr><td><i style="background-color:' + colors[1] + ';"></i></td></td><td> ' + legend_array[1] + '-' + legend_array[2] + '  (' + count[1] + ')' + '</td></tr>' +
                                    '<tr><td><i style="background-color:' + colors[2] + ';"></i></td></td><td> ' + legend_array[2] + '-' + legend_array[3] + '  (' + count[2] + ')' + '</td></tr>' +
                                    '<tr><td><i style="background-color:' + colors[3] + ';"></i></td></td><td> ' + legend_array[3] + '-' + legend_array[4] + '  (' + count[3] + ')' + '</td></tr>' +
                                    '<tr><td><i style="background-color:' + colors[4] + ';"></i></td></td><td> ' + legend_array[4] + '-' + legend_array[5] + '  (' + count[4] + ')' + '</td></tr></table>')

                            } else {

                                var control = new L.CustomControl().addTo(map)
                                control.setContent('<h7><b>' + subtitle + '</b></h7><br><h7>' + filter)

                            }
                        }



                    }



                    function data_extract(item, index, arr) {


                        // dimension_object=dimension_object+'"'+index+'":"'+item+'",';


                        var populatedPlacesSource = new carto.source.SQL(`
									  SELECT *
									    FROM level` + level + `
									    WHERE id = '` + item[1] + `'
									`);



                        var color;


                        var colors = ['#ffffd4', '#fed98e', '#fe9929', '#d95f0e', '#993404'];


                        if (item[3] >= legend_array[0] && item[3] <= legend_array[1]) {

                            color = colors[0];
                            count[0] = count[0] + 1
                        } else if (item[3] > legend_array[1] && item[3] <= legend_array[2]) {

                            color = colors[1];
                            count[1] = count[1] + 1
                        } else if (item[3] > legend_array[2] && item[3] <= legend_array[3]) {

                            color = colors[2];
                            count[2] = count[2] + 1
                        } else if (item[3] > legend_array[3] && item[3] <= legend_array[4]) {

                            color = colors[3];
                            count[3] = count[3] + 1
                        } else if (item[3] > legend_array[4] && item[3] <= legend_array[5]) {

                            color = colors[4];
                            count[4] = count[4] + 1

                        } 


                        var populatedPlacesStyle = new carto.style.CartoCSS(`
									  #layer {
									            polygon-fill: ` + color + `;
									            polygon-opacity: 0.9;
									          }
									`);


                        var placeBoundaries = new carto.style.CartoCSS(`

							       #layer {
							                weight: 5,
							                color: '#666',
							                dashArray: '',
							                fillOpacity: 0.7
							              }
							    `);



                        var populatedPlaces = new carto.layer.Layer(populatedPlacesSource, populatedPlacesStyle, {
                            featureOverColumns: ['name']
                        });

                        var popup = L.popup({ closeButton: false });
                        populatedPlaces.on(carto.layer.events.FEATURE_OVER, featureEvent => {

                            popup.setLatLng(featureEvent.latLng);
                            if (!popup.isOpen()) {
                                popup.setContent(featureEvent.data.name + '(' + item[3] + ')');
                                popup.openOn(map);
                            }
                        });


                        populatedPlaces.on(carto.layer.events.FEATURE_OUT, featureEvent => {
                            popup.removeFrom(map);
                        });


                        // populatedPlaces.on('featureOver', function(e, latlng, pos, data, subLayerIndex) {
                        // popup.setLatLng(e.latLng);
                        // if (!popup.isOpen()) {
                        //     popup.setContent(e.data.name+'('+item[3]+')');
                        //     popup.openOn(maps[vis_ids]);
                        //   }

                        // console.log('e',e)
                        // // console.log('lat',e.latLng)
                        // // console.log('pos',e.position)
                        // // console.log('data',e.data)

                        // // console.log("the vis ids",vis_ids)


                        // });


                        // populatedPlaces.on('featureOut', function(e, latlng, pos, data, layer) {
                        //   popup.removeFrom(maps[vis_ids]);
                        // });




                        client.addLayer(populatedPlaces);

                        client.getLeafletLayer().addTo(map);

                    
                }







                })(i);

                continue;


            } else { //elsefilter 



                // let sort_status='false';

                (function(index) {

                    var normal_options = {
                        chart: {
                            events: {
                                drilldown: function(e) {
                                    if (!e.seriesOptions) {

                                        var chart = this;

                                        // Show the loading label
                                        chart.showLoading('Loading ...');

                                        setTimeout(function() {
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
                            text: JSON.parse(data)['items'][vis.id]['title']
                        },
                        subtitle: {
                            text: JSON.parse(data)['items'][vis.id]['filter']
                        },
                        xAxis: {
                            categories: JSON.parse(data)['items'][vis.id]['x_data'],
                            crosshair: true,
                        },
                        yAxis: {
                            min: 0,
                            endOnTick: true,
                            title: {
                                text: 'Number of supervised HFs'
                            },
                            stackLabels: {
                                enabled: false,
                                style: {
                                    fontWeight: 'bold',
                                }
                            }
                        },
                        exporting: {
                            buttons: {
                                contextButton: {
                                    symbol: 'download'
                                }
                            }

                        },
                        tooltip: {
                            headerFormat: '<b>{point.x}</b><br/>',
                            pointFormat: '{series.name}: {point.y}'
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
                                drilldown: function(e) {
                                    if (!e.seriesOptions) {

                                        var chart = this;

                                        // Show the loading label
                                        chart.showLoading('Loading ...');

                                        setTimeout(function() {
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
                            text: JSON.parse(data)['items'][vis.id]['title'],
                        },

                        subtitle: {
                            text: JSON.parse(data)['items'][vis.id]['filter'],
                        },
                        xAxis: {
                            categories: JSON.parse(data)['items'][vis.id]['x_data'],
                            crosshair: true,
                        },
                        yAxis: {
                            min: 0,
                            endOnTick: true,
                            title: {
                                text: 'Number of supervised HFs'
                            },
                            stackLabels: {
                                enabled: false,
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
                            series: {
                                stacking: 'normal',
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },
                        exporting: {
                            buttons: {
                                contextButton: {
                                    symbol: 'download'
                                }
                            },
                            
                            chartOptions: {
                                plotOptions: {
                                    series: {
                                        dataLabels: {
                                            enabled: true,
                                            
                                            style: {
                                                textOutline: 'none',
                                                
                                            }
                                        }
                                    }
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
                        title: {
                            text: ''
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
                        exporting: {
                            buttons: {
                                contextButton: {
                                    symbol: 'download'
                                }
                            }
                        },
                        series: [{
                            name: 'Data',
                            colorByPoint: true,
                            data: JSON.parse(data)['items'][vis.id]['y_data']

                        }]
                    };

                    // consolee.log('The changed data --',JSON.parse(data)['items'][vis.id]['y_data']);


                    stacked_options.chart.renderTo = 'numb' + vis.id;
                    stacked_options.chart.type = 'column';
                    var chart1 = new Highcharts.Chart(stacked_options);
                    //Display default charts as imported or last set 

                    if (JSON.parse(data)['items'][vis.id]['chart_options'] == 1) {

                        normal_options.chart.renderTo = 'numb' + vis.id;
                        normal_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
                        var chart1 = new Highcharts.Chart(normal_options);

                    } else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 2) {
                        stacked_options.chart.renderTo = 'numb' + vis.id;
                        stacked_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
                        var chart1 = new Highcharts.Chart(stacked_options);

                    } else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 'pie') { //3 for pie chart

                        num_pie_options.chart.renderTo = 'numb' + vis.id;
                        num_pie_options.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
                        var chart1 = new Highcharts.Chart(num_pie_options);
                    } else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 'table') { //3 for pie chart

                        var table = new Tabulator("#numb" + vis.id, {
                            layout: "fitDataFill",
                            maxHeight: "100%",
                            columns: JSON.parse(data)['items'][vis.id]['headers'],
                            data: JSON.parse(data)['items'][vis.id]['table_data'],
                            headerBackgroundColor: '#dae6f8'

                        });

                        $('#drop_id' + vis.id).show();

                        document.getElementById("download-csv" + vis.id).addEventListener("click", function() {
                            table.download("csv", vis.title+".csv");
                        });


                        //trigger download of data.xlsx file
                        document.getElementById("download-xlsx" + vis.id).addEventListener("click", function() {
                            table.download("xlsx", vis.title+".xlsx", { sheetName: vis.title });
                        });

                        //trigger download of data.pdf file
                        document.getElementById("download-pdf" + vis.id).addEventListener("click", function() {
                            table.download("pdf", vis.title+".pdf", {
                                orientation: "portrait", //set page orientation to portrait
                                title: vis.title, //add title to report
                            });
                        });
                    }





                    var num_bar = document.getElementById('bar' + vis.id);
                    var num_barstack = document.getElementById('barstack' + vis.id);
                    var num_horizontal = document.getElementById('horizontal' + vis.id);
                    var num_horizontal_stack = document.getElementById('horizontal_stack' + vis.id);
                    var num_pie = document.getElementById('pieprop' + vis.id);
                    var num_line = document.getElementById('lineprop' + vis.id);
                    var num_area = document.getElementById('areaprop' + vis.id);
                    var table_prop = document.getElementById('tableprop' + vis.id);
                    var sort = document.getElementById('sort' + vis.id);


                    table_prop.addEventListener('click', function() {

                        var table = new Tabulator("#numb" + vis.id, {
                            layout: "fitColumns",
                            maxHeight: "100%",
                            columns: [{ title: JSON.parse(data)['items'][vis.id]['filter'], columns: [{ title: "Element /Score", field: "element" }, { title: "<=50%", field: "<=50%" }, { title: "50% - 75% ", field: "50% - 75%" }, { title: ">= 75%", field: ">=75%" }] }],

                            data: JSON.parse(data)['items'][vis.id]['table_data'],

                        });

                        $('#drop_id' + vis.id).show();


                        document.getElementById("download-csv" + vis.id).addEventListener("click", function() {
                            table.download("csv", vis.title+".csv");
                        });


                        //trigger download of data.xlsx file
                        document.getElementById("download-xlsx" + vis.id).addEventListener("click", function() {
                            table.download("xlsx", vis.title+".xlsx", { sheetName: vis.title });
                        });

                        //trigger download of data.pdf file
                        document.getElementById("download-pdf" + vis.id).addEventListener("click", function() {
                            table.download("pdf", vis.title+".pdf", {
                                orientation: "portrait", //set page orientation to portrait
                                title: vis.title, //add title to report
                            });
                        });



                    });

                    sort.addEventListener('click', function() {

                        sort_status = !(sort_status);

                    });



                    num_bar.addEventListener('click', function() {
                        document.getElementById('numb' + vis.id).style.display = "block";
                        $('#drop_id' + vis.id).hide();

                        // consolee.log('clicked'+i);
                        normal_options.chart.renderTo = 'numb' + vis.id;
                        normal_options.chart.type = 'column';
                        var chart1 = new Highcharts.Chart(normal_options);
                    });

                    num_barstack.addEventListener('click', function() {
                        document.getElementById('numb' + vis.id).style.display = "block";
                        $('#drop_id' + vis.id).hide();

                        // consolee.log('clicked'+i);
                        stacked_options.chart.renderTo = 'numb' + vis.id;
                        stacked_options.chart.type = 'column';

                        stacked_options.legend = 'reversed :true';

                        var chart1 = new Highcharts.Chart(stacked_options);
                    });



                    num_horizontal.addEventListener('click', function() {
                        document.getElementById('numb' + vis.id).style.display = "block";
                        $('#drop_id' + vis.id).hide();
                        // consolee.log('clicked'+i);
                        normal_options.chart.renderTo = 'numb' + vis.id;
                        normal_options.chart.type = 'bar';
                        normal_options.chart.plotOptions = ' {column: {stacking: "normal",dataLabels: {enabled: true}}';
                        var chart1 = new Highcharts.Chart(normal_options);
                    });


                    num_horizontal_stack.addEventListener('click', function() {
                        document.getElementById('numb' + vis.id).style.display = "block";
                        $('#drop_id' + vis.id).hide();
                        // consolee.log('clicked'+i);
                        stacked_options.chart.renderTo = 'numb' + vis.id;
                        stacked_options.chart.type = 'bar';
                        var chart1 = new Highcharts.Chart(stacked_options);
                    });



                    num_pie.addEventListener('click', function() {
                        document.getElementById('numb' + vis.id).style.display = "block";
                        $('#drop_id' + vis.id).hide();
                        // consolee.log('clicked'+i);
                        num_pie_options.chart.renderTo = 'numb' + vis.id;
                        num_pie_options.chart.type = 'pie';
                        // normal_option\s.chart.plotBorderWidth = 'null';
                        //  normal_options.chart.plotShadow = 'false';
                        var chart1 = new Highcharts.Chart(num_pie_options);
                    });



                    num_line.addEventListener('click', function() {
                        document.getElementById('numb' + vis.id).style.display = "block";
                        $('#drop_id' + vis.id).hide();
                        // consolee.log('clicked'+i);
                        normal_options.chart.renderTo = 'numb' + vis.id;
                        normal_options.chart.type = 'line';
                        var chart1 = new Highcharts.Chart(normal_options);
                    });



                    num_area.addEventListener('click', function() {
                        $('#drop_id' + vis.id).hide();
                        document.getElementById('numb' + vis.id).style.display = "block";
                        // consolee.log('clicked'+i);
                        normal_options.chart.renderTo = 'numb' + vis.id;
                        normal_options.chart.type = 'area';
                        var chart1 = new Highcharts.Chart(normal_options);
                    });

                    //Proportinal table start here  
                    var normal_options2 = {
                        chart: {
                            events: {
                                drilldown: function(e) {
                                    if (!e.seriesOptions) {

                                        var chart = this;

                                        // Show the loading label
                                        chart.showLoading('Loading ...');

                                        setTimeout(function() {
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
                            text: JSON.parse(data)['items'][vis.id]['title']
                        },
                        subtitle: {
                            text: JSON.parse(data)['items'][vis.id]['filter']
                        },
                        xAxis: {
                            categories: JSON.parse(data)['items'][vis.id]['x_data'],
                            crosshair: true,
                        },
                        yAxis: {
                            min: 0,
                            max: 100,
                            title: {
                                text: 'Proportion of supervised HFs'
                            },
                            stackLabels: {
                                enabled: false,
                                style: {
                                    fontWeight: 'bold',
                                }
                            }
                        },
                        exporting: {
                            buttons: {
                                contextButton: {
                                    symbol: 'download'
                                }
                            }
                        },

                        tooltip: {
                            headerFormat: '<b>{point.x}</b><br/>',
                            pointFormat: '{series.name}: {point.y}'
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
                                drilldown: function(e) {
                                    if (!e.seriesOptions) {

                                        var chart = this;

                                        // Show the loading label
                                        chart.showLoading('Loading ...');

                                        setTimeout(function() {
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
                            text:  JSON.parse(data)['items'][vis.id]['title'],
                        },

                        subtitle: {
                            text: JSON.parse(data)['items'][vis.id]['filter'],
                        },
                        xAxis: {
                            categories: JSON.parse(data)['items'][vis.id]['x_data'],
                            crosshair: true,
                        },
                        yAxis: {
                            min: 0,
                            endOnTick: false,
                            title: {
                                text: 'Proportion of supervised HFs'
                            },
                            stackLabels: {
                                enabled: false,
                                style: {
                                    fontWeight: 'bold',
                                }
                            }
                        },
                        exporting: {
                            buttons: {
                                contextButton: {
                                    symbol: 'download'
                                }
                            }

                        },

                        tooltip: {
                            headerFormat: '<b>{point.x}</b><br/>',
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

                        title: {
                            text:  JSON.parse(data)['items'][vis.id]['title']
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
                            name: 'Data',
                            colorByPoint: true,
                            data: JSON.parse(data)['items'][vis.id]['y_proportional']

                        }]
                    };

                    // consolee.log('The changed data --',JSON.parse(data)['items'][vis.id]['y_data']);


                    stacked_options2.chart.renderTo = 'numb_p' + vis.id;
                    stacked_options2.chart.type = 'column';
                    var chart1 = new Highcharts.Chart(stacked_options2);
                    //Display default charts as imported or last set 

                    if (JSON.parse(data)['items'][vis.id]['chart_options'] == 1) {

                        normal_options2.chart.renderTo = 'numb_p' + vis.id;
                        normal_options2.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
                        var chart1 = new Highcharts.Chart(normal_options2);

                    } else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 2) {
                        stacked_options2.chart.renderTo = 'numb_p' + vis.id;
                        stacked_options2.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
                        var chart1 = new Highcharts.Chart(stacked_options2);

                    } else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 'pie') { //3 for pie chart

                        num_pie_options2.chart.renderTo = 'numb_p' + vis.id;
                        num_pie_options2.chart.type = JSON.parse(data)['items'][vis.id]['chart_type'];
                        var chart1 = new Highcharts.Chart(num_pie_options2);
                    } else if (JSON.parse(data)['items'][vis.id]['chart_options'] == 'table') { //3 for pie chart

                        var table = new Tabulator("#numb_p" + vis.id, {
                            layout: "fitDataFill",
                            maxHeight: "100%",
                            columns: JSON.parse(data)['items'][vis.id]['headers'],
                            data: JSON.parse(data)['items'][vis.id]['table_data'],
                            headerBackgroundColor: '#dae6f8'

                        });
                        $('#drop_id_p' + vis.id).show();

                        document.getElementById("download-csv" + vis.id).addEventListener("click", function() {
                            table.download("csv", vis.title+".csv");
                        });


                        //trigger download of data.xlsx file
                        document.getElementById("download-xlsx" + vis.id).addEventListener("click", function() {
                            table.download("xlsx", vis.title+".xlsx", { sheetName: vis.title });
                        });

                        //trigger download of data.pdf file
                        document.getElementById("download-pdf" + vis.id).addEventListener("click", function() {
                            table.download("pdf", vis.title+".pdf", {
                                orientation: "portrait", //set page orientation to portrait
                                title: vis.title, //add title to report
                            });
                        });
                    }




                    var num_bar2 = document.getElementById('bar_p' + vis.id);
                    var num_barstack2 = document.getElementById('barstack_p' + vis.id);
                    var num_horizontal2 = document.getElementById('horizontal_p' + vis.id);
                    var num_horizontal_stack2 = document.getElementById('horizontal_stack_p' + vis.id);
                    var num_pie2 = document.getElementById('pieprop_p' + vis.id);
                    var num_line2 = document.getElementById('lineprop_p' + vis.id);
                    var num_area2 = document.getElementById('areaprop_p' + vis.id);
                    var table_prop2 = document.getElementById('tableprop_p' + vis.id);
                    var sort2 = document.getElementById('sort_p' + vis.id);

                    table_prop2.addEventListener('click', function() {

                        console.log("the data table", JSON.parse(data)['items'][vis.id]['table_data_p'])


                        var table = new Tabulator("#numb_p" + vis.id, {
                            layout: "fitColumns",
                            maxHeight: "100%",
                            columns: [{ title: JSON.parse(data)['items'][vis.id]['filter'], columns: [{ title: "Element /Score", field: "element" }, { title: "<=50%", field: "<=50%" }, { title: "50% - 75% ", field: "50% - 75%" }, { title: ">= 75%", field: ">=75%" }] }],

                            data: JSON.parse(data)['items'][vis.id]['table_data_p'],

                        });

                        $('#drop_id_p' + vis.id).show();


                        document.getElementById("download-csvp" + vis.id).addEventListener("click", function() {
                            table.download("csv", vis.title+".csv");
                        });


                        //trigger download of data.xlsx file
                        document.getElementById("download-xlsxp" + vis.id).addEventListener("click", function() {
                            table.download("xlsx", vis.title+".xlsx", { sheetName: vis.title });
                        });

                        //trigger download of data.pdf file
                        document.getElementById("download-pdfp" + vis.id).addEventListener("click", function() {
                            table.download("pdf", vis.title+".pdf", {
                                orientation: "portrait", //set page orientation to portrait
                                title: vis.title, //add title to report
                            });
                        });



                    });

                    num_bar2.addEventListener('click', function() {
                        document.getElementById('numb_p' + vis.id).style.display = "block";
                        $('#drop_id_p' + vis.id).hide();

                        // consolee.log('clicked'+i);
                        normal_options2.chart.renderTo = 'numb_p' + vis.id;
                        normal_options2.chart.type = 'column';
                        var chart1 = new Highcharts.Chart(normal_options2);
                    });

                    num_barstack2.addEventListener('click', function() {
                        document.getElementById('numb_p' + vis.id).style.display = "block";
                        $('#drop_id_p' + vis.id).hide();

                        // consolee.log('clicked'+i);
                        stacked_options2.chart.renderTo = 'numb_p' + vis.id;
                        stacked_options2.chart.type = 'column';

                        stacked_options.legend = 'reversed :true';

                        var chart1 = new Highcharts.Chart(stacked_options2);
                    });



                    num_horizontal2.addEventListener('click', function() {
                        document.getElementById('numb_p' + vis.id).style.display = "block";
                        $('#drop_id_p' + vis.id).hide();
                        // consolee.log('clicked'+i);
                        normal_options2.chart.renderTo = 'numb_p' + vis.id;
                        normal_options2.chart.type = 'bar';
                        normal_options.chart.plotOptions = ' {column: {stacking: "normal",dataLabels: {enabled: true}}';
                        var chart1 = new Highcharts.Chart(normal_options2);
                    });


                    num_horizontal_stack2.addEventListener('click', function() {
                        document.getElementById('numb_p' + vis.id).style.display = "block";
                        $('#drop_id_p' + vis.id).hide();
                        // consolee.log('clicked'+i);
                        stacked_options2.chart.renderTo = 'numb_p' + vis.id;
                        stacked_options2.chart.type = 'bar';
                        var chart1 = new Highcharts.Chart(stacked_options2);
                    });



                    num_pie2.addEventListener('click', function() {
                        document.getElementById('numb_p' + vis.id).style.display = "block";
                        $('#drop_id_p' + vis.id).hide();
                        // consolee.log('clicked'+i);
                        num_pie_options2.chart.renderTo = 'numb_p' + vis.id;
                        num_pie_options2.chart.type = 'pie';
                        // normal_option\s.chart.plotBorderWidth = 'null';
                        //  normal_options.chart.plotShadow = 'false';
                        var chart1 = new Highcharts.Chart(num_pie_options2);
                    });



                    num_line2.addEventListener('click', function() {
                        $('#drop_id_p' + vis.id).hide();
                        document.getElementById('numb_p' + vis.id).style.display = "block";
                        // consolee.log('clicked'+i);
                        normal_options2.chart.renderTo = 'numb_p' + vis.id;
                        normal_options2.chart.type = 'line';
                        var chart1 = new Highcharts.Chart(normal_options2);
                    });



                    num_area2.addEventListener('click', function() {
                        $('#drop_id_p' + vis.id).hide();
                        document.getElementById('numb_p' + vis.id).style.display = "block";
                        // consolee.log('clicked'+i);
                        normal_options2.chart.renderTo = 'numb_p' + vis.id;
                        normal_options2.chart.type = 'area';
                        var chart1 = new Highcharts.Chart(normal_options2);
                    });


                })(i);

                continue;


            }


            //end charts     


        // } //end if
        // else {
        //     map_array.concat(update_empty_visulizer(id, data, vis, link, i, map_array));



        // } //end loop

    }





    //end loop

    // hide the loader
    $('#innerTab' + id).css('display', 'none');
    ////consolee.log('this is data',data)

}
