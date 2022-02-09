$(document).ready(function(){
    $('#edit-barang-masuk').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        console.log(v)
                        if (v['resp']==200) {
                            $('#saldo').val('Rp. '+v['sld'])
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                        $('button[type=submit]').attr('disabled',false)
                    }
                })
            }
        })
    })

    $('#edit-barang-keluar').submit(function(e){
        e.preventDefault()
        const n_mitra = '&n_mit='+$('option:selected','#mitra').html();
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize()+n_mitra,
                    dataType: 'json',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                        $('button[type=submit]').attr('disabled',false)
                    }
                })
            }
        })
    })

    $('#edit-penyewaan').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                        $('button[type=submit]').attr('disabled',false)
                    }
                })
            }
        })
    })

    $('#edit_aset_sewa').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                        $('button[type=submit]').attr('disabled',false)
                    }
                })
            }
        })
    })

    $('#edit-bagi-hasil').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                        $('button[type=submit]').attr('disabled',false)
                    }
                })
            }
        })
    })

    $('#edit-comp-asset').submit(function(e){
        e.preventDefault()
        const data = new FormData(this);
        data.append('img_val',$('#image-asset').attr('data-iv'))
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        v = v.split('|')
                        if (v[0]==200) {
                            $('#saldo').val('Rp. '+v[1])
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                            if (v[2]=='Change') {
                                $('#image-asset').attr('src',v[3])
                                $('#del-fot').val(v[4])
                                $('#image-asset').attr('data-iv',v[4])
                                $('#del-fot').attr('disabled', false)
                            }else if(v[2]=='Del'){
                                $('#image-asset').attr('src',v[3])
                                $('#del-fot').val(null)
                                $('#del-fot').attr('checked', false)
                                $('#del-fot').attr('disabled', true)
                                $('#image-asset').attr('data-iv',null)
                            }
                            $('#img-form').val(null)
                        }else if(v.length != 5){
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                        $('button[type=submit]').attr('disabled',false)
                    }
                })
            }
        })
    })

    $('#edit-arus-kas').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        if (v['resp']==200) {
                            $('#saldo').val('Rp. '+v['b'])
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                        $('button[type=submit]').attr('disabled',false)
                    }
                })
            }
        })
    })

    $('#edit-rekanan').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                        $('button[type=submit]').attr('disabled',false)
                    }
                })
            }
        })
    })

    $('#edit-komoditas-dagang').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                        $('button[type=submit]').attr('disabled',false)
                    }
                })
            }
        })
    })

    $('#edit-bagi-dividen').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                        $('button[type=submit]').attr('disabled',false)
                    }
                })
            }
        })
    })

    $('#edit-pemb-bgh').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                        $('button[type=submit]').attr('disabled',false)
                    }
                })
            }
        })
    })

    $('#edit-satuan').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menambah ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        if (v['res']==200) {
                            $('#satuan').html(v['v'])
                            $('#form-edit-sat').hide()
                            swal({text:"Berhasil menambahkan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menambahkan",buttons: false,timer:3000,icon:"error"})
                        }
                        $('button[type=submit]').attr('disabled',false)
                    }
                })
            }
        })
    })

    $('#edit-profil').submit(function(e){
        e.preventDefault()
        const data = new FormData(this);
        data.append('img_val',$('#image-asset').attr('data-iv'))
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        v = v.split('|')
                        if (v[0]==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                            if (v[1]=='Change') {
                                $('#image-asset').attr('src',v[2])
                                $('#del-fot').val(v[3])
                                $('#image-asset').attr('data-iv',v[3])
                                $('#del-fot').attr('disabled', false)
                            }else if(v[1]=='Del'){
                                $('#image-asset').attr('src',v[2])
                                $('#del-fot').val(null)
                                $('#del-fot').attr('checked', false)
                                $('#del-fot').attr('disabled', true)
                                $('#image-asset').attr('data-iv',null)
                            }
                            $('#img-form').val(null)
                        }else if(v.length != 4){
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                        $('button[type=submit]').attr('disabled',false)
                    }
                })
            }
        })
    })
    
    $('#ubah-password').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menambah ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menambahkan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menambahkan",buttons: false,timer:3000,icon:"error"})
                        }
                        $('button[type=submit]').attr('disabled',false)
                    }
                })
            }
        })
    })
})