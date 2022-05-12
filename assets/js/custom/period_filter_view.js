// This method runs when the fixed period filter is clicked 
function fixed_period_handler() {
    select_2()
    document.getElementById("periodExtType").selectedIndex = "7";
    let periovalue = 7;
    result = set_month_in_list()
    $(".sub_period_list").empty()
    for (var i = 0; i < result.length; i++) {
        dateData = result[i];
        let dateData_id = dateData.toString().replace(/\s/g, '--');
        dateData_id = dateData_id.replace(/[^a-zA-Z0-9_-]/g, '_');
        dateData_id = dateData_id + 'qqqqq' + periovalue;
        $(".sub_period_list").append(
            ' <li class="jsx-2016409548 unselected-list-item period_list_filter">' +
            '  <div data-test="dimension-item-THIS_MONTH"  onclick="select_period_type(\'' + dateData_id + '\')"  id="' + dateData_id + '" class="jsx-10974763  item unselected-item available_period_sub_list period_list_inner_elements" ondblclick="double_click_handler()">' +
            ' <div class="jsx-1404147756"></div>' +
            '  <span class="jsx-10974763 item-label" style="font-weight:700;font-family: Roboto, sans-serif;">' + dateData + '</span>' +
            '  </div>' +
            '   </li>');
    }
}



function relative_period_handler(url) {
    // console.log('am here')
    // console.log(selected_period)
    select_1()
    document.getElementById("periodType").selectedIndex = "3";
    let periodType = 4;
    $.ajax({
        method: "POST",
        url: url,
        cache: false,
        data: 'periodType=' + periodType,
        beforeSend: function() {
            $('.sub_period_list').empty();
            $('.loading-label').css('display', 'unset')
        },
        success: function(subType) {
            subType = JSON.parse(subType);
            $('.sub_period_list').empty();
            subType.forEach(function(subType) {
                let name = subType.name;
                name = name.replace(" - ", "__");
                name = name.replace("-", "___");
                name = name.replaceAll(" ", "_");
                name = name + 'qqqqqq';
                $(".sub_period_list").append(
                    ' <li class="jsx-2016409548 unselected-list-item period_list_filter">' +
                    '  <div data-test="dimension-item-THIS_MONTH"  onclick="select_period_type(\'' + name + '\')"  id="' + name + '" class="jsx-10974763  item unselected-item available_period_sub_list period_list_inner_elements" ondblclick="double_click_handler()">' +
                    ' <div class="jsx-1404147756"></div>' +
                    '  <span class="jsx-10974763 item-label">' + subType.name + '</span>' +
                    '  </div>' +
                    '   </li>');
            });
        },
        complete: function(data) {
            $('.loading-label').css('display', 'none')
        }
    });
}


function retrieve_previous_selected_period(selected_period) {
    if (selected_period != null) {
        selected_period = JSON.parse(selected_period)
        if (selected_period.length > 0) {
            for (var i = 0; i < selected_period.length; i++) {
                let real_name = selected_period[i]
                if (real_name) {
                    let name = selected_period[i]
                    name = get_readable_name(name);
                    real_name = name.replace(" - ", "__");
                    real_name = real_name.replace("-", "___");
                    real_name = real_name.replaceAll(" ", "_");
                    real_name = real_name + 'qqqqqq';

                    $(".selected_sub_period_list").append(
                        ' <li class="jsx-2016409548 unselected-list-item period_list_filter " id="div' + real_name + '">' +
                        ' <div data-test="dimension-item-THIS_MONTH" style="background: #2dbd365c;  onclick="select_period_type(\'' + real_name + '\')" id="' + real_name + '"   class="jsx-10974763  item unselected-item period_list_inner_elements checked_period">' +
                        ' <div class="jsx-1404147756"></div>' +
                        ' <span class="jsx-10974763 item-label" onclick="select_new_item(\'' + real_name + '\')">' + name + '</span><span onclick="remove_selected_item(\'' + real_name + '\')" style="font-size: initial;" class="jsx-10974763 item-label">x</span>' +
                        ' </div>' +
                        ' </li>');
                }
            }
        }
    }
}


function get_readable_name(name) {
    // check relative filter
    name = name.replaceAll("_", " ")
    name = name.toLowerCase()
        // capitalize first leter
    name = name.charAt(0).toUpperCase() + name.slice(1);
    // check fixed filters
    // check weeks
    return name;



}

function autoload_relative_filters() {
    // extended period type
    let selectedYear = $('#year_period').val();
    // alert('am here')
    // $('#periodExtType').val(new Date().getFullYear());
    $("#periodExtType").change(function() {
        let result = [];
        let periovalue = $("#periodExtType").val();
        var periodType = $("#periodExtType").val();
        var current_year = $('#year_period').val();
        // alert(periovalue)
        // let fixed_unique_class_holder = 'null'
        $(".sub_period_list").empty()
        if (periovalue == 1) {
            result = daily_ext(result, current_year);
        }
        if (periovalue == 2) {
            all_dates = daily_ext(result, current_year);
            result = weekly_ext(all_dates, result, current_year);
        }
        if (periovalue == 3) {
            all_dates = daily_ext(result, current_year);
            result = bi_weeks_ext(all_dates, result, current_year);
        }
        if (periovalue == 4) {
            all_dates = daily_ext(result, current_year);
            result = weekly_wed_ext(all_dates, result, current_year);
        }
        if (periovalue == 5) {
            all_dates = daily_ext(result, current_year);
            result = weekly_thu_ext(all_dates, result, current_year);
        }
        if (periovalue == 6) {
            all_dates = daily_ext(result, current_year);
            result = weekly_sat_ext(all_dates, result, current_year);
        }
        if (periovalue == 7) {
            all_dates = daily_ext(result, current_year);
            result = weekly_sun_ext(all_dates, result, current_year);
        }
        if (periovalue == 8) {
            result = monthly_ext(result, current_year);
        }
        if (periovalue == 9) {
            result = bi_monthly_ext(result, current_year);
        }
        if (periovalue == 10) {
            result = quarterly_ext(result, current_year);
        }
        if (periovalue == 11) {
            result = six_monthly_ext(result, current_year);
        }
        if (periovalue == 12) {
            result = six_monthly_april_ext(result, current_year);
        }
        if (periovalue == 13) {
            result = yearly_ext(result, current_year);
        }
        if (periovalue == 14) {
            result = financial_year_start_november_ext(result, current_year);
        }
        if (periovalue == 15) {
            result = financial_year_start_october_ext(result, current_year);
        }
        if (periovalue == 16) {
            result = financial_year_start_july_ext(result, current_year);
        }
        if (periovalue == 17) {
            result = financial_year_start_april_ext(result, current_year);
        }
        let j = 1;
        let k = 1;
        for (var i = 0; i < result.length; i++) {
            dateData = result[i];
            //   let dateData_id = dateData.toString().replace(/\s/g, '--');
            //   dateData_id = dateData_id.replaceAll(/[^a-zA-Z0-9_-]/g,'_');
            let dateData_id = dateData.toString();
            //   replace places " " with  underscores"_"
            dateData_id = dateData_id.replaceAll("__", "_")
            dateData_id = dateData_id.replaceAll(" ", "_")
            dateData_id = dateData_id + 'qqqqq' + periovalue;
            if (periovalue == 2 || periovalue == 4 || periovalue == 5 || periovalue == 6 || periovalue == 7) {
                //   bind week no for special cases;
                dateData_id = dateData_id + '_' + j;
                $('.period_list_inner_elements').css('font-family', 'initial')
                $(".sub_period_list").append(
                    ' <li class="jsx-2016409548 unselected-list-item period_list_filter">' +
                    '  <div data-test="dimension-item-THIS_MONTH"  onclick="select_period_type(\'' + dateData_id + '\')"  id="' + dateData_id + '" class="jsx-10974763  item unselected-item available_period_sub_list period_list_inner_elements"  ondblclick="double_click_handler()">' +
                    ' <div class="jsx-1404147756"></div>' +
                    '  <span class="jsx-10974763 item-label" style="font-weight:700;font-family: Roboto, sans-serif;"> Week ' + j + ' - ' + dateData + '<span>' +
                    '  </div>' +
                    '   </li>');
            } else if (periovalue == 3) {
                // handle by bi-weeks
                if (j % 2 == 0) {} else {
                    dateData_id = dateData_id + '_' + j;
                    $('.period_list_inner_elements').css('font-family', 'initial')
                    $(".sub_period_list").append(
                        ' <li class="jsx-2016409548 unselected-list-item period_list_filter">' +
                        '  <div data-test="dimension-item-THIS_MONTH"  onclick="select_period_type(\'' + dateData_id + '\')"  id="' + dateData_id + '" class="jsx-10974763  item unselected-item available_period_sub_list period_list_inner_elements" ondblclick="double_click_handler()">' +
                        ' <div class="jsx-1404147756"></div>' +
                        '  <span class="jsx-10974763 item-label" style="font-weight:700;font-family: Roboto, sans-serif;"> Bi-Week ' + k + ' ' + dateData + '</span>' +
                        '  </div>' +
                        '   </li>');
                    k++;
                }
            } else {
                $(".sub_period_list").append(
                    ' <li class="jsx-2016409548 unselected-list-item period_list_filter">' +
                    '  <div data-test="dimension-item-THIS_MONTH"  onclick="select_period_type(\'' + dateData_id + '\')"  id="' + dateData_id + '" class="jsx-10974763  item unselected-item available_period_sub_list period_list_inner_elements" ondblclick="double_click_handler()">' +
                    ' <div class="jsx-1404147756"></div>' +
                    '  <span class="jsx-10974763 item-label" style="font-weight:700;font-family: Roboto, sans-serif;">' + dateData + '</span>' +
                    '  </div>' +
                    '   </li>');
            }

            j++;
        }


    });
}
// oninput year handker	
function Auto_change_fixed_period_type() {

    let result = [];
    let periovalue = $("#periodExtType").val();
    var periodType = $("#periodExtType").val();
    var current_year = $('#year_period').val();
    // alert(periovalue)
    // let fixed_unique_class_holder = 'null'
    $(".sub_period_list").empty()
    if (periovalue == 1) {
        result = daily_ext(result, current_year);
    }
    if (periovalue == 2) {
        all_dates = daily_ext(result, current_year);
        result = weekly_ext(all_dates, result, current_year);
    }
    if (periovalue == 3) {
        all_dates = daily_ext(result, current_year);
        result = bi_weeks_ext(all_dates, result, current_year);

    }

    if (periovalue == 4) {
        all_dates = daily_ext(result, current_year);
        result = weekly_wed_ext(all_dates, result, current_year);

    }
    if (periovalue == 5) {
        all_dates = daily_ext(result, current_year);
        result = weekly_thu_ext(all_dates, result, current_year);

    }
    if (periovalue == 6) {
        all_dates = daily_ext(result, current_year);
        result = weekly_sat_ext(all_dates, result, current_year);

    }
    if (periovalue == 7) {
        all_dates = daily_ext(result, current_year);
        result = weekly_sun_ext(all_dates, result, current_year);

    }

    if (periovalue == 8) {
        result = monthly_ext(result, current_year);
    }
    if (periovalue == 9) {
        result = bi_monthly_ext(result, current_year);
    }

    if (periovalue == 10) {
        result = quarterly_ext(result, current_year);
    }

    if (periovalue == 11) {
        result = six_monthly_ext(result, current_year);
    }

    if (periovalue == 12) {
        result = six_monthly_april_ext(result, current_year);
    }
    if (periovalue == 13) {
        result = yearly_ext(result, current_year);
    }
    if (periovalue == 14) {
        result = financial_year_start_november_ext(result, current_year);
    }
    if (periovalue == 15) {
        result = financial_year_start_october_ext(result, current_year);
    }
    if (periovalue == 16) {
        result = financial_year_start_july_ext(result, current_year);
    }
    if (periovalue == 17) {
        result = financial_year_start_april_ext(result, current_year);
    }

    let j = 1;
    let k = 1;
    for (var i = 0; i < result.length; i++) {
        dateData = result[i];

        Data = result[i];

        //   let dateData_id = dateData.toString().replace(/\s/g, '--');
        //   dateData_id = dateData_id.replaceAll(/[^a-zA-Z0-9_-]/g,'_');
        let dateData_id = dateData.toString();
        //   replace places " " with  underscores"_"
        dateData_id = dateData_id.replaceAll("__", "_")
        dateData_id = dateData_id.replaceAll(" ", "_")
        dateData_id = dateData_id + 'qqqqq' + periovalue;

        if (periovalue == 2 || periovalue == 4 || periovalue == 5 || periovalue == 6 || periovalue == 7) {
            //   bind week no for special cases;
            dateData_id = dateData_id + '_' + j;
            $('.period_list_inner_elements').css('font-family', 'initial')
            $(".sub_period_list").append(
                ' <li class="jsx-2016409548 unselected-list-item period_list_filter">' +
                '  <div data-test="dimension-item-THIS_MONTH"  onclick="select_period_type(\'' + dateData_id + '\')"  id="' + dateData_id + '" class="jsx-10974763  item unselected-item available_period_sub_list period_list_inner_elements"  ondblclick="double_click_handler()">' +
                ' <div class="jsx-1404147756"></div>' +
                '  <span class="jsx-10974763 item-label" style="font-weight:700;font-family: Roboto, sans-serif;"> Week ' + j + ' - ' + dateData + '<span>' +
                '  </div>' +
                '   </li>');
        } else if (periovalue == 3) {
            // handle by bi-weeks
            if (j % 2 == 0) {} else {
                dateData_id = dateData_id + '_' + j;
                $('.period_list_inner_elements').css('font-family', 'initial')
                $(".sub_period_list").append(
                    ' <li class="jsx-2016409548 unselected-list-item period_list_filter">' +
                    '  <div data-test="dimension-item-THIS_MONTH"  onclick="select_period_type(\'' + dateData_id + '\')"  id="' + dateData_id + '" class="jsx-10974763  item unselected-item available_period_sub_list period_list_inner_elements" ondblclick="double_click_handler()">' +
                    ' <div class="jsx-1404147756"></div>' +
                    '  <span class="jsx-10974763 item-label" style="font-weight:700;font-family: Roboto, sans-serif;"> Bi-Week ' + k + ' ' + dateData + '</span>' +
                    '  </div>' +
                    '   </li>');
                k++;

            }
        } else {
            $(".sub_period_list").append(
                ' <li class="jsx-2016409548 unselected-list-item period_list_filter">' +
                '  <div data-test="dimension-item-THIS_MONTH"  onclick="select_period_type(\'' + dateData_id + '\')"  id="' + dateData_id + '" class="jsx-10974763  item unselected-item available_period_sub_list period_list_inner_elements" ondblclick="double_click_handler()">' +
                ' <div class="jsx-1404147756"></div>' +
                '  <span class="jsx-10974763 item-label" style="font-weight:700;font-family: Roboto, sans-serif;">' + dateData + '</span>' +
                '  </div>' +
                '   </li>');
        }

        j++;
    }

}

function auto_load_relative_time(url) {

    $('#year_period').val(new Date().getFullYear());

    // set default relative time
    document.getElementById("periodType").selectedIndex = "3";

    $("#periodType").change(function() {

            var periodType = $("#periodType").val();
            $.ajax({
                method: "POST",
                url: url,
                cache: false,
                data: 'periodType=' + periodType,

                beforeSend: function() {
                    $('.sub_period_list').empty();
                    $('.loading-label').css('display', 'unset')
                },
                success: function(subType) {
                    ////////consolee.log(district);
                    subType = JSON.parse(subType);
                    // alert(subType);

                    // $("#sub_period_list").append('<option value="LEVEL-3" > All clinics </option>')
                    subType.forEach(function(subType) {
                        let name = subType.name;

                        name = name.replace(" - ", "__");
                        name = name.replace("-", "___");
                        name = name.replace(" ", "_");
                        name = name.replace(" ", "_");
                        name = name.replace(" ", "_");
                        name = name + 'qqqqqq';

                        $(".sub_period_list").append(
                            ' <li class="jsx-2016409548 unselected-list-item period_list_filter">' +
                            '  <div data-test="dimension-item-THIS_MONTH"  onclick="select_period_type(\'' + name + '\')"  id="' + name + '" class="jsx-10974763  item unselected-item available_period_sub_list period_list_inner_elements" ondblclick="double_click_handler()">' +
                            ' <div class="jsx-1404147756"></div>' +
                            '  <span class="jsx-10974763 item-label">' + subType.name + '</span>' +
                            '  </div>' +
                            '   </li>');
                    });
                    // $('#district').selectpicker('refresh');

                },
                complete: function(data) {
                    $('.loading-label').css('display', 'none')

                }


            });
        }

    );

}

function get_currently_selected_period_filter() {
    relative_period = [];
    fixed_period = [];

    var ids = $('.checked_period').map(function(index) {
        let real_id = this.id
        let id = real_id

        let readable_fixed_time = id.substring(id.indexOf('qqqqq') + 5, id.length)
        id = id.substring(0, id.indexOf('qqqqq'))
        id = id.replaceAll('__', '_');

        if (readable_fixed_time == 'q') {
            relative_period.push(id.toUpperCase());

        } else {

            id = id.replaceAll('---', '-')
            id = id.replaceAll('--', '-')
            id = id.replaceAll(' ', '-')
                // fetch all fixed periods;
            if (readable_fixed_time == 1) {
                id = id.replaceAll('-', '')
                fixed_period.push(id)
            }
            if (readable_fixed_time == 8) {
                // monthly
                first_month = id.substring(0, id.indexOf('_'))
                first_month = required_month(first_month)
                last_year = id.substring(id.length - 4, id.length)
                fixed_period.push(last_year + first_month)
            }
            if (readable_fixed_time == 9) {
                // bi month

                first_month = id.substring(0, id.indexOf('_'))
                    // first_month = required_month(first_month)
                last_year = id.substring(id.length - 4, id.length)
                let midValue = 0;
                if (id.includes("January")) {
                    midValue = "01"

                } else if (id.includes("March")) {
                    midValue = "02"

                } else if (id.includes("May")) {
                    midValue = "03"

                } else if (id.includes("July")) {
                    midValue = "04"

                } else if (id.includes("September")) {
                    midValue = "05"

                } else if (id.includes("November")) {
                    midValue = "06"

                }
                fixed_period.push(last_year + midValue + 'B')
            }
            if (readable_fixed_time == 10) {
                // quartely
                last_year = id.substring(id.length - 4, id.length)

                let Q_value = null;

                if (id.includes("January") > 0) {
                    Q_value = "Q1"
                }
                if (id.includes("June") > 0) {
                    Q_value = "Q2"
                }
                if (id.includes("July") > 0) {
                    Q_value = "Q3"
                }
                if (id.includes("October") > 0) {
                    Q_value = "Q4"
                }
                fixed_period.push(last_year + Q_value)
            }
            if (readable_fixed_time == 11) {
                // six month
                last_year = id.substring(id.length - 4, id.length)
                if (id.includes("January")) {
                    lastValue = "S1"
                } else if (id.includes("December")) {
                    lastValue = "S2"
                }
                fixed_period.push(last_year + lastValue)
            }
            if (readable_fixed_time == 12) {
                // six month - april
                first_month = id.substring(0, id.indexOf('_'))
                let lastValue = 0
                last_year = id.substring(id.length - 4, id.length)
                if (id.includes("April")) {
                    lastValue = "S1"
                } else if (id.includes("March")) {
                    lastValue = "S2"

                }
                fixed_period.push(last_year + "April" + lastValue)
            }
            if (readable_fixed_time == 13) {
                // yearly
                fixed_period.push(id)
            }
            if (readable_fixed_time == 14) {
                // financial_year_start_november
                year = id.substring(id.indexOf("_") + 1, id.indexOf("-") - 1)
                fixed_period.push(year + "Nov")
            }
            if (readable_fixed_time == 15) {
                // financial_year_start_october
                year = id.substring(id.indexOf("_") + 1, id.indexOf("-") - 1)
                fixed_period.push(year + "Oct")
            }
            if (readable_fixed_time == 16) {
                // financial_year_start_july
                year = id.substring(id.indexOf("_") + 1, id.indexOf("-") - 1)
                fixed_period.push(year + "July")
            }
            if (readable_fixed_time == 17) {
                // financial_year_start_april
                year = id.substring(id.indexOf("_") + 1, id.indexOf("-") - 1)
                fixed_period.push(year + "April")
            } else {
                // handle weekly selects
                let underscore_pos = real_id.lastIndexOf('_')
                let weekNo = real_id.substring(underscore_pos + 1, real_id.length)
                weekly_readable_fixed_time = readable_fixed_time.substring(0, readable_fixed_time.indexOf('_'))

                if (weekly_readable_fixed_time == 2) {
                    first_year = real_id.substring(0, 4)
                    fixed_period.push(first_year + 'W' + weekNo)
                }
                if (weekly_readable_fixed_time == 3) {
                    first_year = real_id.substring(0, 4)
                    fixed_period.push(first_year + 'Bi' + 'W' + weekNo)
                }
                if (weekly_readable_fixed_time == 4) {
                    first_year = real_id.substring(0, 4)
                    fixed_period.push(first_year + 'Wed' + weekNo)
                }
                if (weekly_readable_fixed_time == 5) {
                    first_year = real_id.substring(0, 4)
                    fixed_period.push(first_year + 'Thu' + weekNo)
                }
                if (weekly_readable_fixed_time == 6) {
                    first_year = real_id.substring(0, 4)
                    fixed_period.push(first_year + 'Sat' + weekNo)
                }
                if (weekly_readable_fixed_time == 7) {
                    first_year = real_id.substring(0, 4)
                    fixed_period.push(first_year + 'Sun' + weekNo)
                }
            }
        }
    })

    relative_period = unique(relative_period.map(name => name.toUpperCase()));
    fixed_period = unique(fixed_period);

}



// oninput year handker	
function Auto_change_fixed_period_type() {
    // done handle year 

    let result = [];
    let periovalue = $("#periodExtType").val();
    var periodType = $("#periodExtType").val();
    var current_year = $('#year_period').val();
    // alert(periovalue)
    // let fixed_unique_class_holder = 'null'
    $(".sub_period_list").empty()
    if (periovalue == 1) {
        result = daily_ext(result, current_year);
    }
    if (periovalue == 2) {
        all_dates = daily_ext(result, current_year);
        result = weekly_ext(all_dates, result, current_year);
    }
    if (periovalue == 3) {
        all_dates = daily_ext(result, current_year);
        result = bi_weeks_ext(all_dates, result, current_year);

    }

    if (periovalue == 4) {
        all_dates = daily_ext(result, current_year);
        result = weekly_wed_ext(all_dates, result, current_year);

    }
    if (periovalue == 5) {
        all_dates = daily_ext(result, current_year);
        result = weekly_thu_ext(all_dates, result, current_year);

    }
    if (periovalue == 6) {
        all_dates = daily_ext(result, current_year);
        result = weekly_sat_ext(all_dates, result, current_year);

    }
    if (periovalue == 7) {
        all_dates = daily_ext(result, current_year);
        result = weekly_sun_ext(all_dates, result, current_year);

    }

    if (periovalue == 8) {
        result = monthly_ext(result, current_year);
    }
    if (periovalue == 9) {
        result = bi_monthly_ext(result, current_year);
    }

    if (periovalue == 10) {
        result = quarterly_ext(result, current_year);
    }

    if (periovalue == 11) {
        result = six_monthly_ext(result, current_year);
    }

    if (periovalue == 12) {
        result = six_monthly_april_ext(result, current_year);
    }
    if (periovalue == 13) {
        result = yearly_ext(result, current_year);
    }
    if (periovalue == 14) {
        result = financial_year_start_november_ext(result, current_year);
    }
    if (periovalue == 15) {
        result = financial_year_start_october_ext(result, current_year);
    }
    if (periovalue == 16) {
        result = financial_year_start_july_ext(result, current_year);
    }
    if (periovalue == 17) {
        result = financial_year_start_april_ext(result, current_year);
    }

    let j = 1;
    let k = 1;
    for (var i = 0; i < result.length; i++) {
        dateData = result[i];

        Data = result[i];

        //   let dateData_id = dateData.toString().replace(/\s/g, '--');
        //   dateData_id = dateData_id.replaceAll(/[^a-zA-Z0-9_-]/g,'_');
        let dateData_id = dateData.toString();
        //   replace places " " with  underscores"_"
        dateData_id = dateData_id.replaceAll("__", "_")
        dateData_id = dateData_id.replaceAll(" ", "_")
        dateData_id = dateData_id + 'qqqqq' + periovalue;

        if (periovalue == 2 || periovalue == 4 || periovalue == 5 || periovalue == 6 || periovalue == 7) {
            //   bind week no for special cases;
            dateData_id = dateData_id + '_' + j;
            $('.period_list_inner_elements').css('font-family', 'initial')
            $(".sub_period_list").append(
                ' <li class="jsx-2016409548 unselected-list-item period_list_filter">' +
                '  <div data-test="dimension-item-THIS_MONTH"  onclick="select_period_type(\'' + dateData_id + '\')"  id="' + dateData_id + '" class="jsx-10974763  item unselected-item available_period_sub_list period_list_inner_elements"  ondblclick="double_click_handler()">' +
                ' <div class="jsx-1404147756"></div>' +
                '  <span class="jsx-10974763 item-label" style="font-weight:700;font-family: Roboto, sans-serif;"> Week ' + j + ' - ' + dateData + '<span>' +
                '  </div>' +
                '   </li>');
        } else if (periovalue == 3) {
            // handle by bi-weeks
            if (j % 2 == 0) {} else {
                dateData_id = dateData_id + '_' + j;
                $('.period_list_inner_elements').css('font-family', 'initial')
                $(".sub_period_list").append(
                    ' <li class="jsx-2016409548 unselected-list-item period_list_filter">' +
                    '  <div data-test="dimension-item-THIS_MONTH"  onclick="select_period_type(\'' + dateData_id + '\')"  id="' + dateData_id + '" class="jsx-10974763  item unselected-item available_period_sub_list period_list_inner_elements" ondblclick="double_click_handler()">' +
                    ' <div class="jsx-1404147756"></div>' +
                    '  <span class="jsx-10974763 item-label" style="font-weight:700;font-family: Roboto, sans-serif;"> Bi-Week ' + k + ' ' + dateData + '</span>' +
                    '  </div>' +
                    '   </li>');
                k++;

            }
        } else {
            $(".sub_period_list").append(
                ' <li class="jsx-2016409548 unselected-list-item period_list_filter">' +
                '  <div data-test="dimension-item-THIS_MONTH"  onclick="select_period_type(\'' + dateData_id + '\')"  id="' + dateData_id + '" class="jsx-10974763  item unselected-item available_period_sub_list period_list_inner_elements" ondblclick="double_click_handler()">' +
                ' <div class="jsx-1404147756"></div>' +
                '  <span class="jsx-10974763 item-label" style="font-weight:700;font-family: Roboto, sans-serif;">' + dateData + '</span>' +
                '  </div>' +
                '   </li>');
        }

        j++;
    }

}