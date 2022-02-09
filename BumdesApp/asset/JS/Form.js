

$(document).ready(function(){
    $('#set-tambah-logistik').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan pengiriman data ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                const n_kom = '&n_kom='+$('option:selected','#komoditas').html();
                const sat = '&sat='+$('option:selected','#komoditas').attr('data-s2');
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize()+n_kom+sat,
                    dataType: 'json',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        if (v['resp']==200) {
                            reset_form()
                            $('#saldo').val('Rp. '+v['sld'])
                            swal({text:"Data terkirim",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Data gagal terkirim",buttons: false,timer:3000,icon:"error"})
                        }
                        $('button[type=submit]').attr('disabled',false)
                    }
                })
            }
        })
    })

    $('#set-barang-keluar').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan pengiriman data ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                const n_kom = '&n_kom='+$('option:selected','#komoditas').html();
                const n_mitra = '&n_mit='+$('option:selected','#mitra').html();
                const sat = '&sat='+$('option:selected','#komoditas').attr('data-s2');
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize()+n_kom+sat+n_mitra,
                    dataType: 'json',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        if (v['resp']==200) {
                            let html = '<option value="">Pilih komoditas</option>'
                            for (let i = 0; i < v['data'].length; i++) {
                                html += '<option data-s2="'+v['data'][i].st2+'" data-sk="'+v['data'][i].stk+'" data-s="'+v['data'][i].st+'" value="'+v['data'][i].id+'">'+v['data'][i].kom+'</option>'
                                
                            }
                            $('#komoditas').html(html)
                            reset_form()
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

    $('#set-tambah-komoditas').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan pengiriman data ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
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
                            reset_form()
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

    $('#set-tambah-satuan').submit(function(e){
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
                            reset_form()
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

    $('#set-tambah-penyewaan').submit(function(e){
        e.preventDefault()
        const n_aset = '&n_aset='+$('option:selected','#aset').html();
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize()+n_aset,
                    dataType: 'json',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        if (v==200) {
                            reset_form()
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

    $('#set-aset-sewaan').submit(function(e){
        e.preventDefault()
        const n_aset = '&n_aset='+$('option:selected','#tambah-aset-sewa').html();
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize()+n_aset,
                    dataType: 'json',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        if (v['res']==200) {
                            let html = '<option value="">Pilih aset</option>'
                            for (let i = 0; i < v['data'].length; i++) {
                                html += '<option data-na="'+v['data'][i].num+'"  value="'+v['data'][i].id+'">'+v['data'][i].nm+'</option>'
                                
                            }
                            $('#tambah-aset-sewa').html(html)
                            reset_form()
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

    $('#set-bagi-hasil').submit(function(e){
        e.preventDefault()
        const n_mitra = '&n_mitra='+$('option:selected','#mitra').html();
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
                        if (v['res']==200) {
                            let html = '<option value="">Pilih aset</option>'
                            for (let i = 0; i < v['data'].length; i++) {
                                html += '<option value="'+v['data'][i].id+'">'+v['data'][i].nm+'</option>'
                                
                            }
                            $('#inter_aset').html(html)
                            reset_form()
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

    $('#set-pemb-bgh').submit(function(e){
        e.preventDefault()
        const info = $('option:selected','#plh-kjs').html()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize()+'&info='+info,
                    dataType: 'json',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        if (v==200) {
                            reset_form()
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

    $('#set-aset-baru').submit(function(e){
        e.preventDefault()
        const data = new FormData(this);
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
                            reset_form()
                            $('#gam_file').val(null)
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

    $('#set-arus-kas').submit(function(e){
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
                            reset_form()
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

    $('#set-mitra-baru').submit(function(e){
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
                            reset_form()
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

    $('#set-user-baru').submit(function(e){
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
                            reset_form()
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

    $('#registrasi-admin').submit(function(e){
        const data = new FormData(this);
        data.append('sub','Ok')
        e.preventDefault()
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
                            swal({text:"Registrasi berhasil",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Registrasi gagal",buttons: false,timer:3000,icon:"error"})
                        }
                        $('button[type=submit]').attr('disabled',false)
                    }
                })
            }
        })
    })

    $('#ganti-password').submit(function(e){
        const data = new FormData(this);
        data.append('sub','Ok')
        e.preventDefault()
        swal({title:"Lanjutkan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'text',
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled',true)
                    },
                    success: function(v){
                        if (v==200) {
                            swal({text:"Ganti password berhasil",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Ganti password gagal",buttons: false,timer:3000,icon:"error"})
                        }
                        $('button[type=submit]').attr('disabled',false)
                    }
                })
            }
        })
    })
    $('#set-bagi-dividen').submit(function(e){
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
                            reset_form()
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

    /*========================================Edit form========================================= */

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
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
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
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
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
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
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
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    $('#edit-comp-asset').submit(function(e){
        e.preventDefault()
        const data = new FormData(this);
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(v){
                        v = v.split('|')
                        if (v[0]==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                            if (v[2]=='Change') {
                                $('#image-asset').attr('src',v[3])
                                $('#gan-fot').attr('disabled',false)
                            }else if(v[2]=='Del'){
                                $('#image-asset').attr('src',v[3])
                                $('#hid-img').val('')
                                $('#gan-fot').attr('checked',false)
                                $('#gan-fot').attr('disabled',true)
                            }
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
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
                    success: function(v){
                        if (v['resp']==200) {
                            $('#saldo').val('Rp. '+v['b'])
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
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
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
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
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
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
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
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
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })
    /*==================HAPUS==================================*/
    
    
    //Untuk menghapus
    $('tbody').on('click','.hapus',function(){
        const act = $(this).closest('tbody')
        const rem = $(this).closest('tr')
        const hb = $(this)
        swal({title:"Lanjutkan menghapus ?",dangerMode: true,button:'Lanjut'}).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: act.attr('data-act'),
                    type: act.attr('data-meth'),
                    data: 'id='+$(this).val()+'&nm='+rem.attr('data-nam'),
                    dataType: 'text',
                    success: function(v){
                        if (v==200) {
                            rem.remove()
                            swal({text:"Berhasil menghapus",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menghapus",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    
    $('tbody').on('click','.hapus-bgh',function(){
        const act = $(this).closest('tbody')
        const rem = $(this).closest('tr')
        const hb = $(this)
        let text=null
        if (hb.html()=='Batalkan') {
          text = 'membatalkan'  
        }else{
          text = 'menghapus'
        }
        swal({title:"Lanjutkan "+text+" ?",dangerMode: true,button:'Lanjut'}).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: act.attr('data-act'),
                    type: act.attr('data-meth'),
                    data: 'id='+$(this).val()+'&nm='+rem.attr('data-nam'),
                    dataType: 'json',
                    success: function(v){
                        if (v['res']==200) {
                            if (v['stat']=='BATAL') {
                                rem.find('td:nth-child(6)').html('Batal')
                                rem.find('td:nth-child(7)').find('.btn').remove()
                            }else{
                                rem.remove()
                            }
                            swal({text:"Berhasil "+text,buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal "+text,buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
        
    })
    // Untuk pembatalan pembayaran bagi hasil usaha
    $('tbody').on('click','.batal',function(){
        const act = $(this).closest('tbody')
        const rem = $(this).closest('tr')
        const html = $(this).closest('tr').find(' td:nth-child(2)').html()
        // alert(html)
        // return false
        const hb = $(this)
        let bt = 'membatalkan';
        swal({title:"Lanjutkan ?",dangerMode: true,button:'Lanjut'}).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: act.attr('data-act'),
                    type: act.attr('data-meth'),
                    data: 'id='+$(this).val()+'&nm='+rem.attr('data-nam')+'&ent='+html,
                    dataType: 'text',
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil membatalkan",buttons: false,timer:3000,icon:"success"}).then(()=>{
                                window.location.reload()
                            })
                        }else{
                            
                            swal({text:"Gagal membatalkan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
        
    })

    //Untuk pembatalan kerjasama bagi hasil 
    $('tbody').on('click','.batal2',function(){
        const act = $(this).closest('tbody')
        const rem = $(this).closest('tr')
        const html = $(this).closest('tr').find(' td:nth-child(2)').html()
        const hb = $(this)
        let bt = 'membatalkan';
        swal({title:"Lanjutkan ?",dangerMode: true,button:'Lanjut'}).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: act.attr('data-act'),
                    type: act.attr('data-meth'),
                    data: 'id='+$(this).val()+'&nm='+rem.attr('data-nam')+'&ent='+html,
                    dataType: 'text',
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil membatalkan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal membatalkan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
        
    })

    $('#username').change(function(){
        $.ajax({
            url: 'Administrasi/cek_username',
            type: 'GET',
            data: 'usn='+$(this).val(),
            success: function(v){
                if (v>0) {
                    $('#warning').show()
                    $('button[type=submit]').attr('disabled',true)
                }else{
                    $('#warning').hide()
                    $('button[type=submit]').attr('disabled',false)
                }
            }
        })
    })

})