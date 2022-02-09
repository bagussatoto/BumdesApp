

$(document).ready(function() {

    $('#komoditas').change(function(){
        // alert('Change')
        const sat = $('option:selected',this).attr('data-s')
        $('#satuan').val(sat)
    })

    //Tambah barang/stok masuk
    $('.jenis').change(function(){
        if ($(this).val()!='Beli') {
            $('#cut-saldo').attr('disabled',true)
            $('#harga').attr('disabled',true)
        }else{
            $('#cut-saldo').attr('disabled',false)
            $('#harga').attr('disabled',false)
        }
    })
    //Tambah/edit aset
    $('.jenis-ast').change(function(){
        if ($(this).val()!='Beli') {
            $('#harga-ast').attr('disabled',true)
        }else{
            $('#harga-ast').attr('disabled',false)
        }
    })

    $('#harga, #cut-saldo, .jenis').on('change keyup',function(){
        const harga = parseInt($('#harga').val())
        const saldo = parseInt($('#saldo').val().replace('Rp. ','').replace(',','').replace(',',''))
        const jenis = $('.jenis:checked').val()
        if (harga>saldo&&$('#cut-saldo').is(":checked")&&jenis=='Beli') {
            $('button[type=submit]').attr('disabled',true)
            $('#warning').show()
            // alert('show')
        }else{
            $('button[type=submit]').attr('disabled',false)
            $('#warning').hide()
            // alert('hide'+' '+jenis)
        }
    })

    // Barang keluar/distribusi
    $('#komoditas').change(function(){
        // alert('Change')
        const sat = $('option:selected',this).attr('data-sk')
        $('#stok').val(sat)
    })

    $('.tujuan').change(function(){
        if ($(this).val()!='Distribusi') {
            $('#mitra').attr('disabled',true)
        }else{
            $('#mitra').attr('disabled',false)
        }
    })

    
    $('#jumlah, #komoditas').on('change keyup',function(){
        const jumlah = parseFloat($('#jumlah').val())
        const stok = parseFloat($('#stok').val())
        if (jumlah>stok) {
            $('button[type=submit]').attr('disabled',true)
            // alert('lebih'+jumlah+' '+stok)
            $('#ov-val').show()
        }else{
            $('button[type=submit]').attr('disabled',false)
            // alert('kurang'+jumlah+' '+stok)
            $('#ov-val').hide()
        }
    })

    // Tambah jadwal sewa aset
    $('#aset, #jum_har').on('change keyup',function(){
        // alert('Change')
        const harga = $('option:selected','#aset').attr('data-hg')
        if (harga!=''||harga!='undefined') {
            $('#nominal').val('Rp. '+harga+' / hari')
            const jh = $('#jum_har').val()
            $('#harga').val(jh*harga.replace(',','').replace(',',''))
        }else{
            $('#nominal').val('')
            $('#harga').val('')
        }
    })

    
    $('#jum_har_edit').on('keyup',function(){
        // alert('Change')
        const harga = $('#harga').val()
        const jh = $('#jum_har_edit').val()
        $('#biaya').val(jh*harga.replace('Rp. ','').replace(',','').replace(',',''))
    })

    // Tambah aset disewakan
    $('#tambah-aset-sewa').change(function(){
        const nomor = $('option:selected',this).attr('data-na')
        $('#nomor-aset').val(nomor)
    })

    //Tambah kerjasama bagi hasil aset
    $('.s-aset').change(function(){
        const nm = $(this).val()
        if (nm=='Internal') {
            $('#external').css('display','none');
            $('#external > input').attr('disabled',true);
            $('#internal').css('display','block');
            $('#internal > select').attr('disabled',false);
        }else{
            $('#internal').css('display','none');
            $('#internal > select').attr('disabled',true);
            $('#external').css('display','block');
            $('#external > input').attr('disabled',false);
        }
    })

    $('#pers-bumdes').keyup(function(){
        const nil = 100-parseInt($(this).val())
        if (nil>=0) {
            $('#pers-mitra').val(nil)
        }else{
            $('#pers-mitra').val(0)
        }
    })

    // Tambah aset
    $('.sumber').change(function(){
        const val = $(this).val()
        if (val=='Beli') {
            $('#cut-saldo, #harga').attr('disabled',false)
        }else{
            $('#cut-saldo, #harga').attr('disabled',true)
        }
    })

    // Catatan keuangan
    $('#jumlah-kas, .kas').on('change keyup',function(){
        const harga = parseInt($('#jumlah-kas').val())
        const saldo = parseInt($('#saldo').val().replace('Rp. ','').replace(',','').replace(',',''))
        const jenis = $('.kas:checked').val()
        // alert(jenis)
        if (harga>saldo&&jenis=='OUT') {
            $('button[type=submit]').attr('disabled',true)
            $('#warning').show()
        }else{
            $('button[type=submit]').attr('disabled',false)
            $('#warning').hide()
        }
    })

    // Penerimaan bagi hasil
    $('#plh-kjs, #nominal').on('change keyup',function(){
        const b = $('option:selected','#plh-kjs').attr('data-b')
        const m = $('option:selected','#plh-kjs').attr('data-m')
        const n = $('#nominal').val()
        // alert(typeof n + typeof b)
        $('#pers-b').val(b+'%')
        $('#pers-m').val(m+'%')
        if (parseInt(n)>0) {
            $('#val-b').val(n*(b/100))
            $('#val-m').val(n*(m/100))
        }
    })

    $('#nominal-edit-pbgh').on('keyup',function(){//edit
        const b = $('#pers-b').val().replace('%','')
        const m = $('#pers-m').val().replace('%','')
        const n = $('#nominal-edit-pbgh').val()

        if (parseInt(n)>0) {
            $('#val-b').val(n*(b/100))
            $('#val-m').val(n*(m/100))
        }
    })

    $('.passwords2').keyup(function(){
        const p1 = $('.passwords').val()
        const p2 = $('.passwords2').val()

        if (p1!=p2) {
            $('.conf-pass').show()
            $('button[type=submit]').attr('disabled',true)
        }else{
            $('.conf-pass').hide()
            $('button[type=submit]').attr('disabled',false)
        }
    })

    //cek jadwal penyewaan
    $('#tanggal_sewa, #jum_har, #aset, #jum_har_edit').on('dp.change change keyup',function(){
        if ($('#aset').val()!=''&&$('#jum_har').val()!='') {
            $.ajax({
                url: $('form').attr('data-cek'),
                data: $('form').serialize(),
                type: 'POST',
                dataType: 'text',
                success:function(v){
                    if (v>0) {
                        $('button[type=submit]').attr('disabled',true)
                        $('#warning').show()
                    }else{
                        $('button[type=submit]').attr('disabled',false)
                        $('#warning').hide()
                    }
                }
            })
        }else{
            $('button[type=submit]').attr('disabled',false)
            $('#warning').hide()
        }
    })

    //cek jadwal bagi hasil
    $('#tanggal-bgh, #jum_bulan, #inter_aset, .s-aset').on('dp.change change keyup',function(){
        
        if ($('#aset').val()!=''&&$('#jum_bulan').val()!=''&&$('#primary').is(':checked')||$('form').attr('data-tp')=='edit') {
            $.ajax({
                url: $('form').attr('data-cek'),
                data: $('form').serialize(),
                type: 'POST',
                dataType: 'text',
                success:function(v){
                    if (v>0) {
                        $('button[type=submit]').attr('disabled',true)
                        $('#warning').show()
                    }else{
                        $('button[type=submit]').attr('disabled',false)
                        $('#warning').hide()
                    }
                }
            })
        }else{
            $('button[type=submit]').attr('disabled',false)
            $('#warning').hide()
        }
    })

    // $('#tanggal_sewa').on('#dp.change, change',function(){
    //     alert('Change')
    // })

    //Ubah data aset

    $('#del-fot').change(function(){
        if ($(this).is(":checked")) {
            $('#img-form').attr('disabled',true)
        }else{
            $('#img-form').attr('disabled',false)
        }
    })

    $('#img-form').change(function(){
        if ($(this).val()!='') {
            $('#del-fot').attr('disabled',true)
            // alert(this.files[0].size)
            // console.log(this.files)
        }else{
            $('#del-fot').attr('disabled',false)
        }

        if ($(this).val()!='') {
            const type = this.files[0].name.split('.')[1]//this.files[0].type
            if (this.files[0].size > (5*1048576)) {//cek ukuran file
                $('#warning-size').show()
            }else{
                $('#warning-size').hide()
            }
            // console.log(type)
            if (type == 'png'||type == 'jpg') {//cek tipe file
                $('#warning-type').hide()
                // alert(type)
            }else{
                $('#warning-type').show()
                // alert(type)
            }
        }else{
            $('#warning-size, #warning-type').hide()
        }
    })

    //Edit kuangan
    $('#jumlah-edit-fin').keyup(function(){
        const jenis = $('#jenis-edit-fin').val()
        const saldo = parseInt($('#saldo').val().replace('Rp. ','').replace(',','').replace(',',''))
        const nilai = $(this).val()
        if (jenis=='Kredit'&&nilai > saldo) {
            $('#warning').show()
            $('button[type=submit]').attr('disabled',true)
        }else{
            $('#warning').hide()
            $('button[type=submit]').attr('disabled',false)
        }
    })

    //Ubah kata sandi/password
    $('#sandi1, #sandi2').keyup(function(){
        const sandi1 = $('#sandi1').val()
        const sandi2 = $('#sandi2').val()
        
        // alert(sandi1.length)
        if (sandi1!=sandi2&&sandi2!='') {
            $('#warning2').show()
            $('button[type=submit]').attr('disabled',true)
        }else{
            $('#warning2').hide()
            $('button[type=submit]').attr('disabled',false)
        }

        if (sandi1.length<8&&sandi1!='') {
            $('#warning1').show()
            $('button[type=submit]').attr('disabled',true)
        }else{
            $('#warning1').hide()
            $('button[type=submit]').attr('disabled',false)
        }

        if ($('#warning1').is(':visible')||$('#warning2').is(':visible')) {
            $('button[type=submit]').attr('disabled',true)
        }else{
            $('button[type=submit]').attr('disabled',false)
        }
    })
})

//nilai float
$('.float-nums').on('keypress',function(){
    
    if (event.charCode !=8 && event.charCode ==0||event.charCode >= 48 && event.charCode <= 57||event.charCode==46&&!$(this).val().includes(".")) {
        return true
    }{
        return false
    }
})
