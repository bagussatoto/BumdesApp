$(document).ready(function(){

    $('#gov-stok-masuk').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url:$(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                if (v['ses']==200) {
                    $('#tbm').html(v['tbm'])
                    $('#tnb').html('Rp. '+v['tnb'])
                    $('.g-tahun').html('Tahun '+v['y'])
                    pembelian_logistik(v['v_grafik'],'#grafik_perdagangan',v['y'])
                }
            }
        })
    })
    
    $('#gov-penjualan').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url:$(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                // alert(v['jdb'])
                if (v['ses']==200) {
                    $('.g-time').html('Tahun '+v['y'])
                    $('#jdb').html(v['jdb'])
                    $('#ndb').html('Rp. '+v['ndb'])
                    $('#jndb').html(v['jndb'])
                    $('#nndb').html('Rp. '+v['nndb'])
                    pertumbuhan_perdagangan_bulan(v['v_grafik'],'#grafik-laba-dagang', v['y'])
                    distribusi(v['v_grafik2'],'#grafik-distribusi', v['y'])
                    non_distribusi(v['v_grafik3'],'#grafik-non-distribusi', v['y'])
                }
            }
        })
    })
    
    $('#gov-sewa').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url:$(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                if (v['ses']==200) {
                    $('#jpn').html(v['jpn'])
                    $('#tps').html('Rp. '+v['tps'])
                    $('.g-tahun').html('Tahun '+v['y'])
                    penyewaan(v['v_grafik'],'#grafik_penyewaan',v['y'])
                }
            }
        })
    })
    
    $('#gov-fin').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url:$(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                if (v['ses']==200) {
                    $('#dbw').html('Rp. '+v['dkw_d'])
                    $('#kdw').html('Rp. '+v['dkw_k'])
                    $('#dbm').html('Rp. '+v['dkm_d'])
                    $('#kdm').html('Rp. '+v['dkm_k'])
                    $('#dby').html('Rp. '+v['dky_d'])
                    $('#kdy').html('Rp. '+v['dky_k'])
                    $('#ig_w').html(v['nb']+' '+v['y'])
                    $('#ig_m').html('Tahun '+v['y'])
                    keuangan_mingguan(v['gf_w'],'#grafik_keuangan_mingguan', v['nb'], v['y'])
                    keuangan_bulanan(v['gf_m'],'#grafik_keuangan_bulanan', v['y'])
                    keuangan_tahunan(v['gf_y'],'#grafik_keuangan_tahunan')
                }
            }
        })
    })
    
    $('#gov-kbgh').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url:$(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                if (v['ses']==200) {
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
})