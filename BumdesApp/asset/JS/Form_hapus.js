$(document).ready(function(){

    //menghapus logistik masuk
    $('tbody').on('click','.hapus-bmsk',function(){
        const act = $(this).closest('tbody')
        const rem = $(this).closest('tr')
        swal({title:"Lanjutkan menghapus ?",dangerMode: true,button:'Lanjut'}).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: act.attr('data-act'),
                    type: act.attr('data-meth'),
                    data: $('#belanja-barang').serialize()+'&id='+$(this).val()+'&nm='+rem.attr('data-nam'),
                    dataType: 'json',
                    success: function(v){
                        if (v['res']==200) {
                            $('#info-belanja').html('Rp. '+v['val'])
                            pembelian_logistik(v['grafik'],'#grafik_pembelian_logistik')
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

    //menghapus barang keluar
    $('tbody').on('click','.hapus-bklr',function(){
        const act = $(this).closest('tbody')
        const rem = $(this).closest('tr')
        swal({title:"Lanjutkan menghapus ?",dangerMode: true,button:'Lanjut'}).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: act.attr('data-act'),
                    type: act.attr('data-meth'),
                    data: $('#barang-keluar').serialize()+'&id='+$(this).val()+'&nm='+rem.attr('data-nam'),
                    dataType: 'json',
                    success: function(v){
                        if (v['res']==200) {
                            $('#info-distribusi').html('Rp. '+v['val'])
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
    //menghapus penyewaan
    $('tbody').on('click','.hapus-sewa',function(){
        const act = $(this).closest('tbody')
        const rem = $(this).closest('tr')
        swal({title:"Lanjutkan menghapus ?",dangerMode: true,button:'Lanjut'}).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: act.attr('data-act'),
                    type: act.attr('data-meth'),
                    data: $('#sewa-aset').serialize()+'&id='+$(this).val()+'&nm='+rem.attr('data-nam'),
                    dataType: 'json',
                    success: function(v){
                        if (v['res']==200) {
                            $('#info-sewa').html('Rp. '+v['val'])
                            penyewaan(v['grafik'],'#grafik_penyewaan')
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

    //menghapus keuangan mingguan, bulanan, tahunan
    $('tbody').on('click','.hapus-fin',function(){
        const act = $(this).closest('tbody')
        const rem = $(this).closest('tr')
        swal({title:"Lanjutkan menghapus ?",dangerMode: true,button:'Lanjut'}).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: act.attr('data-act'),
                    type: act.attr('data-meth'),
                    data: $('#laporan-keuangan').serialize()+'&id='+$(this).val(),
                    dataType: 'json',
                    success: function(v){
                        if (v['res']==200) {
                            $('#info-distribusi').html('Rp. '+v['val'])
                            if (act.attr('data-act')=='hapus-keuangan/mng') {
                                keuangan_mingguan(v['grafik'],'#grafik_keuangan_mingguan')
                            }else if (act.attr('data-act')=='hapus-keuangan/bln') {
                                keuangan_bulanan(v['grafik'],'#grafik_keuangan_bulanan')
                            }else{
                                keuangan_tahunan(v['grafik'],'#grafik_keuangan_tahunan')
                            }
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

    //menghapus tanpa update
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

    //menghapus/membatalkan kerjasama bagi hasil
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
    
    //Menghapus daftar pembyaran bagi hasil
    $('.hapus-pbgh').click(function(){
        const act = $(this).closest('tbody')
        const rem = $(this).closest('tr')
        const mitra = $('#mitra').html()
        const aset = $('#aset').html()
        const id2 = act.attr('data-id')
        swal({title:"Lanjutkan menghapus ?",dangerMode: true,button:'Lanjut'}).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: act.attr('data-act'),
                    type: act.attr('data-meth'),
                    data: 'id='+$(this).val()+'&mitra='+mitra+'&aset='+aset+'&id2='+id2,
                    dataType: 'json',
                    success: function(v){
                        if (v['res']==200) {
                            $('#jum_bgh').html('Rp. '+v['jl'])
                            $('#pen_b').html('Rp. '+v['pnb'])
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
    
})