/*

      $('.myDatepicker2').datetimepicker({
        format: 'DD-MM-YYYY'
    });
*/

$(document).ready(function(){

    //Belanja barang/barang masuk
    
    $('#belanja-barang').submit(function(e){
        e.preventDefault()
        let form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize()+'&pagin=no',
            dataType: 'json',
            success: function(v){
                if (v['ses']=='Ok') {
                    $('#val-body').html(v['tabel']['val'])
                    $('.pgn-cust').html(v['tabel']['paginasi'])
                    $('#info-belanja').html('Rp. '+v['row'])
                    let link = $('a[href|=unduh]').attr('href').split('?')
                    form=form.split('&')
                    $('a[href|=unduh]').attr('href',link[0]+'?'+form[0]+'&'+form[1])
                    pembelian_logistik(v['grafik'],'#grafik_pembelian_logistik', v['tahun'])
                }else if(v['ses']=='OUT'){

                }
                // alert(v['row'].hg)
                // window.location.href=document.referrer
            }
        })
    })

    //Barang keluar
    $('#barang-keluar').submit(function(e){
        e.preventDefault()
        let form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize()+'&pagin=no',
            dataType: 'json',
            success: function(v){
                if (v['ses']=='Ok') {
                    $('#val-body').html(v['tabel']['val'])
                    $('.pgn-cust').html(v['tabel']['paginasi'])
                    $('#info-distribusi').html('Rp. '+v['row'])
                    let link = $('a[href|=unduh]').attr('href').split('?')
                    form=form.split('&')
                    $('a[href|=unduh]').attr('href',link[0]+'?'+form[0]+'&'+form[1])
                }else{
                    
                }
            }
        })
    })

    //Distribusi barang
    $('#dis-barang').submit(function(e){
        e.preventDefault()
        let form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize()+'&pagin=no',
            dataType: 'json',
            success: function(v){
                if (v['ses']=='Ok') {
                    $('#val-body').html(v['tabel']['val'])
                    $('.pgn-cust').html(v['tabel']['paginasi'])
                    $('#nilai-dist').html('Rp. '+v['row'])
                    const link = $('a[href|=unduh]').attr('href').split('?')
                    form=form.split('&')
                    $('a[href|=unduh]').attr('href',link[0]+'?'+form[0]+'&'+form[1])
                    distribusi(v['grafik'],'#distribusi',v['tahun']);
                    non_distribusi(v['grafik2'],'#non-distribusi', v['tahun']);
                }
            }
        })
    })

    //Penyewaan aset
    $('#sewa-aset').submit(function(e){
        e.preventDefault()
        let form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize()+'&pagin=no',
            dataType: 'json',
            success: function(v){
                $('#val-body').html(v['tabel']['val'])
                $('.pgn-cust').html(v['tabel']['paginasi'])
                $('#jpn').html(v['jpn'])
                $('#tps').html('Rp. '+v['tps'])
                let link = $('a[href|=unduh]').attr('href').split('?')
                form=form.split('&')
                $('a[href|=unduh]').attr('href',link[0]+'?'+form[0]+'&'+form[1])
                penyewaan(v['grafik'],'#grafik_penyewaan',v['tahun'])
            }
        })
    })

    //Bagi hasil
    $('#bagi-has').submit(function(e){
        e.preventDefault()
        let form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize()+'&pagin=no',
            dataType: 'json',
            success: function(v){
                if (v['ses']=='Ok') {
                    $('#val-body').html(v['tabel']['val'])
                    $('.pgn-cust').html(v['tabel']['paginasi'])
                    let link = $('a[href|=unduh]').attr('href').split('?')
                    form=form.split('&')
                    $('a[href|=unduh]').attr('href',link[0]+'?'+form[0]+'&'+form[1])
                    $('#pbgh-m').html('Rp. '+v['pbgh-m'])
                    $('#pbgh-y').html('Rp. '+v['pbgh-y'])
                    $('#nbgh-m').html('Rp. '+v['nbgh-m'])
                    $('#nbgh-y').html('Rp. '+v['nbgh-y'])
                    $('#k-pbgh-m').html('Penerimaan BUMDes bagi hasil '+v['nb']+' '+v['y'])
                    $('#k-pbgh-y').html('Penerimaan BUMDes bagi hasil tahun '+v['y'])
                    $('#k-nbgh-m').html('Nilai bagi hasil '+v['nb']+' '+v['y'])
                    $('#k-nbgh-y').html('Nilai bagi hasil tahun '+v['y'])
                    $('#int-m').html(v['int-m'])
                    $('#ext-m').html(v['ext-m'])
                    $('#int-y').html(v['int-m'])
                    $('#ext-y').html(v['ext-y'])
                    $('#g-tahun').html('Tahun '+v['y'])
                    bagi_hasil(v['v_grafik'],'#grafik_bagi_hasil', v['y'])
                }
            }
        })
    })
    
    //Keuangan mingguan,bulanan, tahunan
    $('#laporan-keuangan').submit(function(e){
        e.preventDefault()
        let form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize()+'&pagin=no',
            dataType: 'json',
            success: function(v){
                $('#val-body').html(v['tabel']['val'])
                $('.pgn-cust').html(v['tabel']['paginasi'])
                $('#debit').html('Rp. '+v['debit'])
                $('#kredit').html('Rp. '+v['kredit'])
                let link = $('a[href|=unduh]').attr('href').split('?')
                form=form.split('&')
                form.pop()
                $('a[href|=unduh]').attr('href',link[0]+'?'+form.join('&'))
                keuangan_mingguan(v.grafik,'#grafik_keuangan_mingguan')
                keuangan_bulanan(v.grafik,'#grafik_keuangan_bulanan')
                keuangan_tahunan(v.grafik,'#grafik_keuangan_tahunan')
                
            }
        })
    })
    
    //Detail distribusi mitra
    $('#detail-dist-mitra').submit(function(e){
        e.preventDefault()
        let form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize()+'&pagin=no',
            dataType: 'json',
            success: function(v){
                if (v['ses']=='Ok') {
                    $('#val-body').html(v['tabel']['val'])
                    $('.pgn-cust').html(v['tabel']['paginasi'])
                }
            }
        })
    })

    // Get saldo dividen
    $('#tahun-dividen').change(function(){
        $.ajax({
            url:$(this).attr('data-link'),
            type:'GET',
            data:'tahun='+$(this).val(),
            dataType: 'text',
            success: function(v){
                v= v.replace(',','').replace(',','').replace(',','')
                $('#nilai-dividen').val(v)
                $('#datatable').dataTable()
            }
        })
    })
    
    $('#log-admin').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url:$(this).attr('action'),
            data: $(this).serialize()+'&pagin=no',
            type: $(this).attr('method'),
            dataType: 'json',
            success: function(v){
                if (v['ses']=='Ok') {
                    $('#val-body').html(v['tabel']['val'])
                    $('.pgn-cust').html(v['tabel']['paginasi'])
                }
            }
        })
    })

    $('#user-log').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url:$(this).attr('action'),
            data: $(this).serialize()+'&pagin=no',
            type: $(this).attr('method'),
            dataType: 'json',
            success: function(v){
                if (v['ses']=='Ok') {
                    $('#val-body').html(v['tabel']['val'])
                    $('.pgn-cust').html(v['tabel']['paginasi'])
                }
            }
        })
    })

    //request based on index/paginasi
    $('.pgn-cust').on('click','button',function(){
        // alert($(this).val())
        // return false;
        const aktif = $(this).closest('.pgn-cust').find('.active')//button yang berwarna
        let nomor_limit = $(this).closest('.pgn-cust').find('.limit-number').val() //nilai button angka yang terpilih
        nomor_limit = parseInt(nomor_limit)
        let aktif_page = $('#titik').attr('data-num')//nomor paginasi yang aktif
        aktif_page = parseInt(aktif_page)
        let val = $(this).val()//nilai button yang terpilih
        const form = $('.form-filter')//ambil nilai dari form
        let limit = $('#limit').val() //nilai limit dari form
        limit = parseInt(limit)
        let nomor_akhir = $('#last-number').val() //nilai button terakhir
        nomor_akhir = parseInt(nomor_akhir)
        if (val=='prev') {//tombol sebelumnya
            if (aktif_page!=0) {
                val = aktif_page-limit
            }else{
                return false
            }
        }else if (val=='next') {//tombol selanjutnya
            if (aktif_page!=nomor_akhir) {
                val = aktif_page+limit
            }else{
                return false
                // val = nomor_limit+limit
            }
        }else if (val=='...'||aktif==val&&(val!='next'||val!='prev')) {//tombol ...
            return false;
        }else{//tombol angkan
            if (val==nomor_limit) {
                return false
            }else{
                $(this).closest('.pgn-cust').find('button').removeClass('limit-number')
                $(this).addClass('limit-number')
                // console.log(val+' '+nomor_limit+' '+nomor_akhir)
            }
            
        }
        $.ajax({
            url: form.attr('action'),
            data: form.serialize()+'&offset='+val,
            type: form.attr('method'),
            dataType: 'json',
            success: function(v){
                if (v['ses']=='Ok') {
                    $('#val-body').html(v['tabel']['val'])
                }else if(v['ses']=='OUT'){

                }
            }
        })
        $('#titik').attr('data-num',val)
        $(this).closest('.pgn-cust').find('.active').removeClass('active')
        $(this).addClass('active')
    })
})