// const { transpose } = require("mathjs");
function double_click_handler() {
    filter_adder()
}

function select_period_type(button_name) {
    // alert($('#' + button_name).val())
    // alert(button_name)
    // alert(button_name)
    $('#' + button_name).css('background', '#00796b');
    $('#' + button_name).css('color', 'white');
    $('#' + button_name).addClass('selected_period');
}

function select_new_item(button_name) {
    // alert(button_name)
    $('.' + button_name).css('background', '#00796b');
    $('.' + button_name).css('color', 'white');
    $('.' + button_name).removeClass('selected_period');
    $('.' + button_name).addClass('selected_period_new');
}

function filter_adder() {
    selected_period = [];
    var ids = $('.selected_period').map(function(index) {
        selected_period.push(this.id);
        var element = document.getElementById(this.id);
        $("#" + this.id).parent().remove();
        element.remove();
    });
    selected_period = unique(selected_period);
    for (var i = 0; i < selected_period.length; i++) {
        var name = selected_period[i];
        var real_name = selected_period[i];
        // this callback function will be called once for each matching element
        $('.selected_period').empty();
        name = name.replaceAll("_", " ");
        if (name.indexOf('qqqqq') > 0) {
            name = name.substring(0, name.indexOf('qqqqq'))
        }
        $('#' + real_name).removeClass('selected_period');
        $(".selected_sub_period_list").append(
            ' <li class="jsx-2016409548 unselected-list-item period_list_filter " id="div' + real_name + '">' +
            ' <div data-test="dimension-item-THIS_MONTH" style="background: #2dbd365c;  onclick="select_period_type(\'' + real_name + '\')" id="' + real_name + '"   class="jsx-10974763  item unselected-item period_list_inner_elements checked_period">' +
            ' <div class="jsx-1404147756"></div>' +
            ' <span class="jsx-10974763 item-label" onclick="select_new_item(\'' + real_name + '\')">' + name + '</span><span onclick="remove_selected_item(\'' + real_name + '\')" style="font-size: initial;" class="jsx-10974763 item-label">x</span>' +
            ' </div>' +
            ' </li>');
    }

}


function empty_Selected_items() {
    // selected_period

    var ids = $('.checked_period').map(function(index) {
        // this callback function will be called once for each matching element
        let real_name = this.id;
        $('#' + real_name).css('background', '#00796b');
        $('#' + real_name).css('color', 'white');
        $('#' + real_name).removeClass('selected_period');
        $('#' + real_name).addClass('selected_period_new');

    });
}


function Selected__all_items() {

    $('.available_period_sub_list').addClass('selected_period');

    var ids = $('.available_period_sub_list').map(function(index) {
        // this callback function will be called once for each matching element
        let real_name = this.id;
        // alert(real_name)
        $('#' + real_name).css('background', '#00796b');
        $('#' + real_name).css('color', 'white');
        $('#' + real_name).addClass('selected_period');
        // $('#' + real_name).removeClass('selected_period_new');

    });



}

function remove_selected_item(button_name) {
    let real_name = button_name;
    let name = button_name;
    $('#' + real_name).removeClass('selected_period_new');
    $('#' + real_name).remove();
    var element = document.getElementById(real_name);
    element.parentNode.removeChild(element);
    $('#' + real_name).addClass('selected_period');
    $('#' + real_name).removeClass('checked_period');
    name = name.replaceAll("_", " ");
    if (name.indexOf('qqqqq') > 0) {
        name = name.substring(0, name.indexOf('qqqqq'))
    }
    var element = document.getElementById("div" + button_name);
    element.remove();
    var element1 = document.getElementById("div" + real_name);
    if (element1) {
        if (element1 != null) {

            element1.parentNode.removeChild(element1);

        }


    }
    $(".sub_period_list").append(
        ' <li class="jsx-2016409548 unselected-list-item period_list_filter">' +
        '  <div data-test="dimension-item-THIS_MONTH"  onclick="select_period_type(\'' + real_name + '\')"  id="' + real_name + '" class="jsx-10974763  item unselected-item available_period_sub_list period_list_inner_elements"  ondblclick="double_click_handler()">' +
        ' <div class="jsx-1404147756"></div>' +
        '  <span class="jsx-10974763 item-label">' + name + '</span>' +
        '  </div>' +
        '   </li>');


}

function remove_item_from_filter() {

    selected_period = [];

    var ids = $('.selected_period_new').map(function(index) {
        selected_period.push(this.id);
        // var element = document.getElementById(this.id);
        // element.remove();
    })

    selected_period = unique(selected_period)

    for (var i = 0; i < selected_period.length; i++) {
        var name = selected_period[i];
        var real_name = selected_period[i];
        $('#' + real_name).removeClass('selected_period_new');
        $('#' + real_name).remove();
        var element = document.getElementById(real_name);
        element.parentNode.removeChild(element);
        $('#' + real_name).removeClass('selected_period');
        $('#' + real_name).removeClass('checked_period');
        name = name.replace("_", " ");
        if (name.indexOf('qqqqq') > 0) {
            name = name.substring(0, name.indexOf('qqqqq'))
        }
        var element = document.getElementById("div" + real_name);
        element.remove();
        var element = document.getElementById("div" + real_name);
        element.parentNode.removeChild(element); // add new tems from the unselected option
        $(".sub_period_list").prepend(
            ' <li class="jsx-2016409548 unselected-list-item period_list_filter">' +
            '  <div data-test="dimension-item-THIS_MONTH"  onclick="select_period_type(\'' + real_name + '\')"  id="' + real_name + '" class="jsx-10974763  item unselected-item available_period_sub_list period_list_inner_elements"  ondblclick="double_click_handler()">' +
            ' <div class="jsx-1404147756"></div>' +
            '  <span class="jsx-10974763 item-label">' + name + '</span>' +
            '  </div>' +
            '   </li>');
    }


}




// rest functions

function select_1() {

    $('.unselected-list').empty();
    // $('.selected_sub_period_list').empty();
    // var ids = $('.checked_period').map(function(index) {
    //     var element = document.getElementById(this.id);
    //     element.remove();
    // });
    // $('.checked_period').empty();
    $('#current_selected_period_format').val(0);
    // $(".relative-btn").click(function() {
    $('.relative-btn').addClass('active');
    $('.fixed-btn').removeClass('active');
    $('#complex_period_type').css('display', 'none');
    $('#simple_period_type').css('display', 'unset');
    $('.sub_simple_period_type').css('display', 'unset');
    $('.sub_complex_period_type').css('display', 'none');
    // });//
}

function select_2() {
    $('#current_selected_period_format').val(1);
    $('.unselected-list').empty();
    // $(".fixed-btn").click(function() {
    // hizi display una nyingine zinakubalki kwenye browser moja jingine zinakataa ndo mana...
    // ..nimeweka zote nne and zinakubali kwa IE, mozzila na Chrome
    $('#complex_period_type').css('display', 'unset');
    $('#complex_period_type').css('display', 'table-cell');
    $('#complex_period_type').css('display', 'block');
    $('#complex_period_type').css('display', 'ruby');

    $('#simple_period_type').css('display', 'none');
    $('.sub_simple_period_type').css('display', 'none');
    $('.sub_complex_period_type').css('display', 'unset');

    $('.fixed-btn').addClass('active');
    $('.relative-btn').removeClass('active');

    // });
}

function daily_ext(result, current_year) {
    let next_year = $('#year_period').val() + 1;
    var startDate = new Date(current_year + "-01-15");
    var endDate = new Date(next_year + "-12-15");
    let year = current_year
        // print all dated belong to particular year.
    $(".sub_period_list").empty();

    for (var month = 1; month < 13; month++) {
        var monthIndex = month - 1; // 0..11 instead of 1..12
        var names = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
        var date = new Date(year, monthIndex, 1);
        while (date.getMonth() == monthIndex) {
            let real_date = date.getDate();
            if (real_date < 10) { real_date = '0' + real_date; }
            let month_ = month;
            if (month < 10) { month_ = '0' + month_; }
            // day => names[date.getDay()]
            result.push(current_year + '-' + month_ + '-' + real_date);
            date.setDate(date.getDate() + 1);
        }
    }
    return result;
}

function convert_to_yyy_mm_dd(date) {
    var dateObj = new Date(date);
    var month = dateObj.getUTCMonth() + 1; //months from 1-12
    var day = dateObj.getUTCDate();
    var year = dateObj.getUTCFullYear();
    return year + "-" + month + "-" + day;
}

function weekly_ext(dates, result, current_year) {
    res = [];
    for (var i = -1; i < result.length - 10; i++) {
        // var curr = new Date("08-Jul-2014"); // get current date
        var curr = new Date(result[i]); // get current date
        var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
        first = first + 1;
        var last = first + 6; // last day is the first day + 6

        if (first) {
            var firstday = new Date(curr.setDate(first)).toUTCString();
            var lastday = new Date(curr.setDate(last));
            if (lastday.toString().includes("Tue")) {} else if (lastday.toString().includes("Wed")) {} else if (lastday.toString().includes("Fri")) {} else if (lastday.toString().includes("Thu")) {} else if (lastday.toString().includes("Fri")) {} else {
                res.push(convert_to_yyy_mm_dd(firstday) + ' - ' + convert_to_yyy_mm_dd(lastday));
            }
        }
    }
    return unique(res);
}

function bi_weeks_ext(dates, result, current_year) {
    res = [];
    for (var i = -2; i < result.length + 2; i += 2) {
        // var curr = new Date("08-Jul-2014"); // get current date
        var curr = new Date(result[i]); // get current date
        var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
        first = first + 1;
        // console.log(result[i])
        var last = first + 13; // last day is the first day + 6
        if (first) {
            var firstday = new Date(curr.setDate(first)).toUTCString();
            var lastday = new Date(curr.setDate(last));
            if (lastday.toString().includes("Tue")) {} else if (lastday.toString().includes("Wed")) {} else if (lastday.toString().includes("Fri")) {} else if (lastday.toString().includes("Thu")) {} else if (lastday.toString().includes("Fri")) {} else {
                res.push(convert_to_yyy_mm_dd(firstday) + ' - ' + convert_to_yyy_mm_dd(lastday));
            }
        }
    }

    return unique(res);


}

function weekly_wed_ext(dates, result, current_year) {

    res = [];
    for (var i = -1; i < result.length; i++) {
        // var curr = new Date("08-Jul-2014"); // get current date
        var curr = new Date(result[i]); // get current date
        var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
        var last = first + 9; // last day is the first day + 6
        var firstday = new Date(curr.toUTCString());
        var lastday = new Date(curr.setDate(last));
        if (firstday.toString().includes("Wed")) {
            res.push(convert_to_yyy_mm_dd(firstday) + ' - ' + convert_to_yyy_mm_dd(lastday));
        }
    }
    return unique(res);
}


function weekly_thu_ext(dates, result, current_year) {

    res = [];
    for (var i = -1; i < result.length; i++) {
        // var curr = new Date("08-Jul-2014"); // get current date
        var curr = new Date(result[i]); // get current date
        var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
        var last = first + 9; // last day is the first day + 6
        var firstday = new Date(curr.toUTCString());
        var lastday = new Date(curr.setDate(last));
        if (firstday.toString().includes("Thu")) {
            res.push(convert_to_yyy_mm_dd(firstday) + ' - ' + convert_to_yyy_mm_dd(lastday));
        }
    }
    return unique(res);

}


function weekly_sat_ext(dates, result, current_year) {

    res = [];
    for (var i = -1; i < result.length; i++) {
        // var curr = new Date("08-Jul-2014"); // get current date
        var curr = new Date(result[i]); // get current date
        var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
        var last = first + 9; // last day is the first day + 6
        var firstday = new Date(curr.toUTCString());
        var lastday = new Date(curr.setDate(last));
        if (firstday.toString().includes("Sat")) {
            res.push(convert_to_yyy_mm_dd(firstday) + ' - ' + convert_to_yyy_mm_dd(lastday));
        }
    }

    return unique(res);

}

function weekly_sun_ext(dates, result, current_year) {

    res = [];
    for (var i = -1; i < result.length; i++) {
        // var curr = new Date("08-Jul-2014"); // get current date
        var curr = new Date(result[i]); // get current date
        var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
        var last = first + 9; // last day is the first day + 6
        var firstday = new Date(curr.toUTCString());
        var lastday = new Date(curr.setDate(last));
        if (firstday.toString().includes("Sun")) {
            res.push(convert_to_yyy_mm_dd(firstday) + ' - ' + convert_to_yyy_mm_dd(lastday));
        }
    }

    return unique(res);

}




function unique(array) {
    return array.filter(function(el, index, arr) {
        return index == arr.indexOf(el);
    });
}

// 8
function monthly_ext(result, current_year) {
    var ten = 1;
    var final_year = parseInt(current_year) + parseInt(ten);
    // var next_year = parseInt(final_year) + parseInt(1);
    let start_month = 'January';
    let end_month = 'February';
    let start_year = '';
    let end_year = current_year;
    for (var n = 1; n < 13; n++) {
        if (n == 3) {
            result.push('February ' + current_year);
        } else if (n == 4) {
            result.push('March ' + current_year);
        } else if (n == 5) {
            result.push('April ' + current_year);
        } else if (n == 6) {
            result.push('June ' + current_year);
        } else if (n == 7) {
            result.push('July ' + current_year);
        } else if (n == 8) {
            result.push('July ' + current_year);
        } else if (n == 9) {
            result.push('September ' + current_year);
        } else if (n == 10) {
            result.push('October ' + current_year);
        } else if (n == 11) {
            result.push('November ' + current_year);
        } else if (n == 12) {
            result.push('December ' + current_year);
        } else {
            result.push('January ' + current_year);
        }
    }
    return unique(result);
}


// 9
function bi_monthly_ext(result, current_year) {
    var ten = 1;
    var final_year = parseInt(current_year) + parseInt(ten);
    // var next_year = parseInt(final_year) + parseInt(1);
    let start_month = 'January';
    let end_month = 'February';
    let start_year = '';
    let end_year = current_year;
    for (var n = 1; n < 8; n++) {
        if (n == 3) {
            let start_month = 'March';
            let end_month = 'April';
            let start_year = '';
            let end_year = current_year;
            result.push(start_month + ' ' + start_year + ' - ' + end_month + ' ' + end_year);
        } else if (n == 4) {
            let start_month = 'May';
            let end_month = 'June';
            let start_year = '';
            let end_year = current_year;
            result.push(start_month + ' ' + start_year + ' - ' + end_month + ' ' + end_year);
        } else if (n == 5) {
            let start_month = 'July';
            let end_month = 'August';
            let start_year = '';
            let end_year = current_year;
            result.push(start_month + ' ' + start_year + ' - ' + end_month + ' ' + end_year);
        } else if (n == 6) {
            let start_month = 'September';
            let end_month = 'October';
            let start_year = '';
            let end_year = current_year;
            result.push(start_month + ' ' + start_year + ' - ' + end_month + ' ' + end_year);
        } else if (n == 7) {
            let start_month = 'November';
            let end_month = 'December';
            let start_year = '';
            let end_year = current_year;
            result.push(start_month + ' ' + start_year + ' - ' + end_month + ' ' + end_year);
        } else {
            result.push(start_month + ' ' + start_year + ' - ' + end_month + ' ' + end_year);
        }
    }
    return unique(result);

}


// 10
function quarterly_ext(result, current_year) {
    var ten = 1;
    var final_year = parseInt(current_year) + parseInt(ten);
    // var next_year = parseInt(final_year) + parseInt(1);
    let start_month = 'January';
    let end_month = 'March';
    let start_year = '';
    let end_year = current_year;
    for (var n = 1; n < 6; n++) {
        if (n == 3) {
            let start_month = 'April';
            let end_month = 'June';
            let start_year = '';
            let end_year = current_year;
            result.push(start_month + ' ' + start_year + ' - ' + end_month + ' ' + end_year);
        } else if (n == 4) {
            let start_month = 'July';
            let end_month = 'September';
            let start_year = '';
            let end_year = current_year;
            result.push(start_month + ' ' + start_year + ' - ' + end_month + ' ' + end_year);
        } else if (n == 5) {
            let start_month = 'October';
            let end_month = 'December';
            let start_year = '';
            let end_year = current_year;
            result.push(start_month + ' ' + start_year + ' - ' + end_month + ' ' + end_year);
        } else {
            result.push(start_month + ' ' + start_year + ' - ' + end_month + ' ' + end_year);
        }
    }
    console.log("result: ")

    console.log(result)
    return unique(result);
}


// 11
function six_monthly_ext(result, current_year) {
    var ten = 1;
    var final_year = parseInt(current_year) + parseInt(ten);
    // var next_year = parseInt(final_year) + parseInt(1);
    let start_month = 'January';
    let end_month = 'June';
    let start_year = '';
    let end_year = current_year;
    for (var n = 1; n < 4; n++) {
        if (n == 3) {
            let start_month = 'July';
            let end_month = 'December';
            let start_year = '';
            let end_year = parseInt(current_year);
            result.push(start_month + ' ' + start_year + ' - ' + end_month + ' ' + end_year);
        } else {
            result.push(start_month + ' ' + start_year + ' - ' + end_month + ' ' + end_year);
        }
    }
    return unique(result);
}


// 12
function six_monthly_april_ext(result, current_year) {
    var ten = 1;
    var final_year = parseInt(current_year) + parseInt(ten);
    // var next_year = parseInt(final_year) + parseInt(1);
    let start_month = 'April';
    let end_month = 'September';
    let start_year = '';
    let end_year = parseInt(current_year) + parseInt(1);
    for (var n = 1; n < 4; n++) {
        if (n == 3) {
            let start_month = 'October';
            let end_month = 'March';
            let start_year = current_year;
            let end_year = parseInt(current_year) + parseInt(1);
            result.push(start_month + ' ' + start_year + ' - ' + end_month + ' ' + end_year);
        } else {
            result.push(start_month + ' ' + start_year + ' - ' + end_month + ' ' + (end_year - 1));
        }
    }
    return unique(result);
}


// 13
function yearly_ext(result, current_year) {
    var ten = 1;
    var final_year = parseInt(current_year) + parseInt(ten);
    var starting_year = parseInt(final_year) + parseInt(-10);
    // for (var year = final_year - 10; year < final_year + 1; year++) {
    for (var year = starting_year; year < final_year; year++) {
        let n = parseInt(year) + parseInt(1);
        result.push(year)
    }
    // alert(result)
    return result;
} // 13
function financial_year_start_november_ext(result, current_year) {
    var ten = 1;
    var final_year = parseInt(current_year) + parseInt(ten);
    var starting_year = parseInt(final_year) + parseInt(-10);
    // for (var year = final_year - 10; year < final_year + 1; year++) {
    for (var year = starting_year; year < final_year; year++) {
        let n = parseInt(year) + parseInt(1);
        result.push('November ' + year + ' - ' + 'October ' + n)
    }
    // alert(result)
    return result;
}
// 15
function financial_year_start_october_ext(result, current_year) {
    var ten = 1;
    var final_year = parseInt(current_year) + parseInt(ten);
    var starting_year = parseInt(final_year) + parseInt(-10);
    // for (var year = final_year - 10; year < final_year + 1; year++) {
    for (var year = starting_year; year < final_year; year++) {
        let n = parseInt(year) + parseInt(1);
        result.push('October ' + year + ' - ' + 'September ' + n)
    }
    // alert(result)
    return result;
}


// 16
function financial_year_start_july_ext(result, current_year) {
    var ten = 1;
    var final_year = parseInt(current_year) + parseInt(ten);
    var starting_year = parseInt(final_year) + parseInt(-10);
    // for (var year = final_year - 10; year < final_year + 1; year++) {
    for (var year = starting_year; year < final_year; year++) {
        let n = parseInt(year) + parseInt(1);
        result.push('July ' + year + ' - ' + 'June ' + n)
    }
    // alert(result)
    return result;
}

// 17
function financial_year_start_april_ext(result, current_year) {
    var ten = 1;
    var final_year = parseInt(current_year) + parseInt(ten);
    var starting_year = parseInt(final_year) + parseInt(-10);
    // for (var year = final_year - 10; year < final_year + 1; year++) {
    for (var year = starting_year; year < final_year; year++) {
        let n = parseInt(year) + parseInt(1);
        result.push('April ' + year + ' - ' + 'March ' + n)
    }
    // alert(result)
    return result;
}

function cancel_modal() {

}

function cancel_modal() {

}

function required_month(month) {
    if (month == 'January') {
        return '01';
    }
    if (month == 'February') {
        return '02';
    }
    if (month == 'March') {
        return '03';
    }
    if (month == 'April') {
        return '04';
    }

    if (month == 'May') {
        return '05';
    }
    if (month == 'June') {
        return '06';
    }
    if (month == 'July') {
        return '07';
    }
    if (month == 'Agost') {
        return '08';
    }
    if (month == 'September') {
        return '09';
    }
    if (month == 'October') {
        return '10';
    }
    if (month == 'November') {
        return '11';
    }
    if (month == 'December') {
        return '12';
    }
    return month;

}

function set_month_in_list() {

    // document.getElementById("periodExtType").selectedIndex = "7";
    let result = [];
    var current_year = $('#year_period').val();
    // alert(periovalue)
    // let fixed_unique_class_holder = 'null'
    result = monthly_ext(result, current_year);
    return unique(monthly_ext(result, current_year));

}

function financial_year_format(financial_year) {
    financial_year = financial_year.replaceAll('January', 'Jan');
    financial_year = financial_year.replaceAll('February', 'Feb');
    financial_year = financial_year.replaceAll('March', 'Mar');
    financial_year = financial_year.replaceAll('April', 'Apri');
    financial_year = financial_year.replaceAll('May', 'May');
    financial_year = financial_year.replaceAll('June', 'Jun');
    financial_year = financial_year.replaceAll('July', 'Jul');
    financial_year = financial_year.replaceAll('Agost', 'Ago');
    financial_year = financial_year.replaceAll('September', 'Sep');
    financial_year = financial_year.replaceAll('October', 'Oct');
    financial_year = financial_year.replaceAll('November', 'Nov');
    financial_year = financial_year.replaceAll('December', 'Dec');
    return financial_year;
}