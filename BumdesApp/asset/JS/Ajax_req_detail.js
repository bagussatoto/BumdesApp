$(document).ready(function(){

    $('#detail-belanja').submit(function(e){
        e.preventDefault()
        $.ajax({
            url:$(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr('method'),
            dataType: 'json',
            success: function(v){
                $('#val-body').html(v['val'])
                $('.pgn-cust').html(v['paginasi'])
            }
        })
    })
    
    $('#detail-penjualan').submit(function(e){
        e.preventDefault()
        $.ajax({
            url:$(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr('method'),
            dataType: 'json',
            success: function(v){
                $('#val-body').html(v['val'])
                $('.pgn-cust').html(v['paginasi'])
            }
        })
    })
})