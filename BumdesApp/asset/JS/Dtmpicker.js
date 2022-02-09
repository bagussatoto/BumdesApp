
$(document).ready(function(){
    const minDate = moment().subtract(7, 'days').millisecond(0).second(0).minute(0).hour(0)
    const maxDate = moment().add(0, 'days').millisecond(0).second(0).minute(0).hour(0)
    $('.tanggal_new').datetimepicker({
      ignoreReadonly: true,
      format: 'DD-MM-YYYY',
      maxDate: maxDate,
      minDate: minDate
      //allowInputToggle: true
    });
    
    const tanggal = $('#tanggal_edit').val()
    const date_limit = $('#tanggal_edit').attr('data-tl')
    // alert()
    if (typeof(tanggal)!='undefined') {/*
        tanggal = tanggal.split('-')
        tanggal = tanggal[2]+'-'+tanggal[1]+'-'+tanggal[0]*/
        // alert(tanggal)
        const minDate2 = moment(date_limit).subtract(7, 'days').millisecond(0).second(0).minute(0).hour(0)
        const maxDate2 = moment(date_limit).add(0, 'days').millisecond(0).second(0).minute(0).hour(0)

        $('.tanggal_edit').datetimepicker({
          ignoreReadonly: true,
          format: 'DD-MM-YYYY',
          maxDate: maxDate2,
          minDate: minDate2
          //allowInputToggle: true
        });
        //tanggal = tanggal.split('-')
        $('#tanggal_edit').val(tanggal/*[2]+'-'+tanggal[1]+'-'+tanggal[0]*/)
        // alert(tanggal)
    }
  })