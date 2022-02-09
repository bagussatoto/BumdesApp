$(document).ready(function(){
    $('').submit(function(){
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                if (v['stat']==200) {
                    
                }else{
                    
                }
            }
        })
    })
})