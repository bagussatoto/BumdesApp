$(document).ready(function(){
    
    $('#login-conf-but').attr('disabled',false)

    $('#login-system').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                if (v['stat']==200) {
                    window.location.href=v['url']
                    $('#failed-login').hide()
                }else{
                    $('#failed-login').show()
                }
            }
        })
    })

    $('.keluar-sistem').click(function(e){
        e.preventDefault()
        swal({title:"Tetap keluar ?",buttons:['Batal','Keluar'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('href'),
                    type: 'POST',
                    dataType: 'text',
                    success: function(v){
                        window.location.href=v
                    }
                })
            }
        })
    })
})
    
// $val = ['tp'=>'MNG','nu'=>'0081585629042','log_s'=>'Ok'];
// $this->ses->set_userdata($val);
// $data2 = $this->ses->userdata();
// $this->ses->sess_destroy();
// echo json_encode($data2);
// echo $this->ses->__ci_last_regenerate;