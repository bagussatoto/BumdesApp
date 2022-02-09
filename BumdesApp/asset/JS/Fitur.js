
function reset_form(){
  let tanggal = new Date()
  let bulan = (parseInt(tanggal.getMonth())+1)
  if (bulan>=1 && bulan <=9) {
    bulan='0'+bulan
  }
  tanggal = tanggal.getDate()+'-'+bulan+'-'+tanggal.getFullYear()

  $('.date > input').val(tanggal)
  $('select').val('')
  $('#primary, .primary').prop('checked',true).change()
  
  $('.empty-form').val('')
  $('input[type=text]:not(.date > input, #pers-mitra), textarea').val('')
  $('#table-master tr:not(#table-master tr:first-child)').remove()
  $('input[name=bulan]').val(12)
  $('#pers-mitra').val(0)
}
function total_persentase(){
  const total_kol = $('#table-master tr').length
  let persentase=0;
  let nilai=0;
  for (let i = 1; i <= total_kol; i++) {
    nilai = $('#table-master tr:nth-child('+i+') .jumlah-div').val()
    if (nilai=='') {
      nilai=0;
    }else{
      nilai = parseInt(nilai)
    }
    persentase += nilai
  }
  if (persentase>100) {
    $('button[type=submit]').attr('disabled',true)
    persentase = 'Nilai lebih dari 100';
  }else{
    $('button[type=submit]').attr('disabled',false)
  }
  $('#total-pers').val(persentase)
}


$(document).ready(function(){

  // $('#datatable, #datatable1, #datatable2, .datatable').dataTable();

  $('#table-master').on('keyup','.jumlah-div',function(){
    total_persentase()
  })

    //$('#datatable, #datatable2').dataTable();
    /*======================================================Tambah form================================================ */
    $("#tambah-form").click(function(){
      var clone = $('#table-master tr:first-child').clone()
      $(clone).find("[type=text]").each(function(){
        $(this).val(null)
      })
      $(clone).find('.last-child').after('<td class="col-md-1 col-sm-1 col-xs-1"><button type="button" class="btn btn-xs btn-danger kill-but">X</button></td>')
      $('#table-master').append(clone)
    });
    /*======================================================Remove form================================================ */
    $('#table-master').on('click','.kill-but',function(){
      $(this).closest('tr').remove()
      total_persentase()
    })
    
    /*======================================================Pergantian form================================================ */
    $('#table-master').on('change','.form-ganti',function(){
      if ($(this).val()==1) {
        $(this).closest('tr').find('.ket').hide()
        $(this).closest('tr').find('.form').show()
      }else{
        $(this).closest('tr').find('.ket').show()
        $(this).closest('tr').find('.form').hide()
      }
    })
    /*===================================tambah_barang_masuk_gudang.php================================ */
    $('#table-master').on('change','tr .sumber-logistik',function(){
      var o =$(this)
      o.closest('tr').find('.form-harga').attr('data-s',o.val())
    })

    $('#table-master').on('focusout, change','tr .form-harga',function(){
      var v = $(this)
      var s = $('#saldo').html().replace('Rp. ','').replace(',','')
      var nilai=null;
      if (v.val()=='') {
            nilai =0;
            // alert('nilai = 0')
      }
      if (v.attr('data-s')=='BUY') {
        // nilai = parseInt(v.attr('data-nilai'))-parseInt(v.val())
        if (parseInt(v.attr('data-nilai'))<=parseInt(v.val())&&nilai!=0) {
          s = parseInt(s)-v.val()
          v = v.val()
          //data nilai lebih kecil
        }else{
          nilai = parseInt(v.attr('data-nilai'))-v.val()
          v = v.val()
          s = parseInt(s)+nilai
          //data nilai lebih besar
        }
        if (v=='') {
          v=0
        }
        if (s<0) {
          s=$('#saldo').html().replace('Rp. ','').replace(',','')
          v = parseInt($(this).attr('data-nilai'))
        }
        s = s.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        $('#saldo').html('Rp. '+s)
        $(this).attr('data-nilai',v)
      }
    })

    /*======================tambah_barang_keluar.php======================*/
    $('#table-master').on('change','tr .opt-barang', function(){
      var o = $('option:selected',this)
      o.closest('tr').find('.stok').val(o.attr('data-stok'))
    })

    $('#tambah-satuan').click(function(){
      $('#form-edit-sat').hide()
      $('#form-tambah-sat').show()
    })

    $('#satuan').on('click','.ubah-sat',function(){

      const id = $(this).val()
      const sat = $(this).closest('tr').find('td:nth-child(2)').html()
      const ket = $(this).closest('tr').find('td:nth-child(3)').html()
      // alert(sat)
      $('#id_sat').val(id)
      $('#edit_sat').val(sat)
      $('#edit_ket').val(ket)
      $('#form-tambah-sat').hide()
      $('#form-edit-sat').show()
    })
    /*==============================Edit aset===============================*/
    $('#gan-fot').change(function(){
      if ($(this).is(":checked")) {
        $('#img-form').attr('disabled',true)
      }else{
        $('#img-form').attr('disabled',false)
      }
    })

    //Edit pembayaran bagi hasil
    $('#nominal-edit-pbgh').change(function(){
      let psb = $('#pers-b').val().replace('%','')
      psb = (psb/100)*$(this).val()
      let psm = $('#pers-m').val().replace('%','')
      psm = (psm/100)*$(this).val()

      $('#val-m').val(psb)
      $('#val-b').val(psm)
    })
})

$('#cek-email').on('focusout',function(){
  // alert($(this).attr('data-old'))
  const old =  $(this).attr('data-old');
  const val =  $(this).val();
  $.ajax({
    url: 'cek-mail',
    type: 'GET',
    data: 'mail='+val,
    dataType: 'text',
    success: function(v){
      if (v==1&&old!=val) {
        alert('Ganti')
        // alert($(this).attr('data-old'))
      }else{
        alert('Ok')
      }
    }
  })
})