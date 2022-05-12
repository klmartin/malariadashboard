//display Modal
$('#EditModal').modal('show');

$("<div class='text-center dt-loader'><i class='fas fa-spinner fa-3x fa-spin'></i></div>").appendTo('div.loading');

$.extend( true, $.fn.dataTable.defaults, {
  stateSave: true,
  "initComplete": function( settings, json ) {
    $('.datatable').toggle();
    $('.dt-loader').remove();
  }
});

$(document).ready(function() {

     $('.datatable').DataTable({ "order": [[ 0, "desc" ]] });
     $('#datatable').DataTable();
     $('#datatable1').DataTable();
     $('#datatable2').DataTable();

    $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();

        // Get the column API object
        var column = $('.datatable').DataTable().column( $(this).attr('data-column') );

        // Toggle the visibility
        column.visible( ! column.visible() );

        //add toggle-vis-active

    } );
} );

$('.datatable2').DataTable({responsive: true});

$('.datatable3').DataTable();

$('.datatable-scroll-y').DataTable( {  scrollY: '60vh',  scrollCollapse: true,  paging: false , info: false, "searching": false } );

$('.toClone').metalClone({
    btnClone 	: '.btn_clone',
    copyValue 	: false
});

$('#currency1').maskMoney();
$(".currency").maskMoney({prefix:'TZS ', allowNegative: false, thousands:',', decimal:'.', affixesStay: true})

  $(document).ready(function() {
      $('.ui-pnotify').remove();

     // select2
     $('.select2').select2();

     // datepickers
     $('#datepicker').datepicker({   uiLibrary: 'bootstrap4', format: 'dd-mm-yyyy' });
     $('#datepicker2').datepicker({ uiLibrary: 'bootstrap4',   format: 'dd-mm-yyyy'  });

     $('#dob_input').datepicker({
       uiLibrary: 'bootstrap4', format: 'dd-mm-yyyy',
       maxDate: function() {
         var date = new Date();
         // above 18 years
         date.setDate(date.getDate()-6570);
         return new Date(date.getFullYear(), date.getMonth(), date.getDate());
       },
     });

     $('#max_today_input').datepicker({
       uiLibrary: 'bootstrap4', format: 'dd-mm-yyyy',
       maxDate: function() {
         var date = new Date();
         date.setDate(date.getDate());
         return new Date(date.getFullYear(), date.getMonth(), date.getDate());
       }
     });

     $('#min_today_input').datepicker({
       uiLibrary: 'bootstrap4',
       format: 'dd-mm-yyyy',
       minDate: new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate())
     });


     // amount format
      var amount = $(".amountformat").val();
      // $('.amountformat').on('change', function() {
      //       this.value = parseFloat(this.value).toFixed(5);
      //   });
      $(".amountformat").val(function(index, value) {

          var x = value.replace(/[^0-9\.]/g, '');
          var parts = x.toString().split(".");
          parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          // if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
          //     event.preventDefault();
          // }
          return  parts.join(".");
      });
      //
      // $(".amountformat").on("keypress keyup blur", function(event) {
      //     //this.value = this.value.replace(/[^0-9\.]/g,'');
      //
      //
      //     var x = $(this).val().replace(/[^0-9\.]/g, '');
      //     var parts = x.toString().split(".");
      //     parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      //
      //     $(this).val(parts.join("."));
      //
      //     if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
      //         event.preventDefault();
      //     }
      // });


      /* $('.amountformat').keyup(function(event) {

       // skip for arrow keys
       if(event.which >= 37 && event.which <= 40){
       event.preventDefault();
       }

       $(this).val(function(index, value) {
       return value
       .replace(/\D/g, '')
       .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
       ;
       });
       });*/

       $("#chequenumber").hide();

       var payment_method = '<?php echo set_value("payment_method"); ?>';
       if(payment_method == 'CHEQUE'){
               $("#chequenumber").show();
           }else{
               $("#chequenumber").hide();
           }

       $("#payment_method").change(function(){
           var val = $(this).val();
           if(val == 'CHEQUE'){
               $("#chequenumber").show();
           }else{
               $("#chequenumber").hide();
           }
       });
       
  });
