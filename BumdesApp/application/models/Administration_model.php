<?php

class Administration_model extends CI_Model{
    function __construct(){
        parent:: __construct();
        $this->load->database('default');
        $this->load->library('Num_splitter');
    }
    
    function get_satuan($type='html'){
      $this->db->select('id, satuan AS st, ket_satuan AS ket, IFNULL(sat_barang,sat) AS del');
      $this->db->from('satuan');
      $this->db->join('komoditas','sat=id','LEFT');
      $this->db->join('stok_item','sat_barang=id','LEFT');
      $this->db->group_by('id');
      $result = $this->db->get()->result();
      $result1=null;
      if ($type=='html') {
        foreach ($result as $key => $v) {
          $btn = $v->del==null?'<button type="button" class="btn btn-xs btn-danger hapus" value="'.$v->id.'">Hapus</button>':null;
          $result1 .= '
                      <tr data-nam="'.$v->st.'">
                        <td>'.($key+1).'</td>
                        <td>'.$v->st.'</td>
                        <td>'.$v->ket.'</td>
                        <td>
                          <button type="button" class="btn btn-xs btn-warning ubah-sat" value="'.$v->id.'">Ubah</button>
                         '.$btn.' 
                        </td>
                      </tr>';
        }
        return $result1;
      }else{
        return $result;
      }
    }

    function get_aset_umum($type='html'){
        $this->db->select('id_aset AS id, nama AS nm, nomor_aset AS num, lokasi AS lok, tanggal_masuk AS thn, harga_sewa AS hs, tanggal_selesai AS ts');
        $this->db->from('aset AS as');
        $this->db->join('aset_disewakan AS ad', 'as.id_aset = ad.aset_sw','LEFT');
        $this->db->join('bagi_hasil_aset ab','ab.aset_bh = as.id_aset','LEFT');
        $this->db->where('(tanggal_selesai < "'.date('Y-m-d').'" OR tanggal_selesai IS NULL OR status_bgh = "BATAL")');
        $this->db->where('harga_sewa IS NULL');
        // $this->db->where("`tanggal_selesai`<'".date('Y-m-d')."' OR `tanggal_selesai` IS NULL ");
        $result=$this->db->get()->result();
        $result1=null;
        if ($type=='html') {
          foreach ($result as $key => $v) {
            $result1 .= '<tr  data-nam="'.$v->nm.'">
                            <td>'.($key+1).'</td>
                            <td>'.$v->nm.'</td>
                            <td>'.$v->num.'</td>
                            <td>'.$v->lok.'</td>
                            <td>'.anchor('detail-aset/'.$v->id,'Detail').'</td>
                            <td>'.date('d/m/Y',strtotime($v->thn)).'</td>
                            <td>
                              '.anchor('edit-asset/'.$v->id,'Ubah','class="btn btn-xs btn-primary"').'
                              <button type="button" class="btn btn-xs btn-danger hapus" value="'.$v->id.'">Hapus</button>
                            </td>
                          </tr>';
          }
          return $result1;
        }else{
          return $result;
        }
    }

    function get_aset_disewakan($type='html'){
        $this->db->select('id_aset AS id, nama AS nm, nomor_aset AS num, lokasi AS lok, tanggal_masuk AS thn, FORMAT(harga_sewa,"#.00") AS hg');
        $this->db->from('aset_disewakan ad');
        $this->db->join('aset as','as.id_aset=ad.aset_sw');
        $result=$this->db->get()->result();
        $result1=null;
        if ($type=='html') {
          foreach ($result as $key => $v) {
            $result1 .= '<tr>
                            <td>'.($key+1).'</td>
                            <td>'.$v->nm.'</td>
                            <td>'.$v->num.'</td>
                            <td>'.$v->lok.'</td>
                            <td>'.anchor('detail-aset/'.$v->id,'Detail').'</td>
                            <td>'.date('d/m/Y',strtotime($v->thn)).'</td>
                            <td>
                              '.anchor('edit-asset/'.$v->id,'Ubah','class="btn btn-xs btn-primary"').'
                            </td>
                          </tr>';
          }
          return $result1;
        }else{
          return $result;
        }
    }

    function get_aset_bagi_hasil($type='html'){
        $this->db->select('id_aset AS id, nama AS nm, nomor_aset AS num, lokasi AS lok, tanggal_masuk AS thn');
        $this->db->from('bagi_hasil_aset ab');
        $this->db->join('aset as','as.id_aset=ab.aset_bh');
        $this->db->where('tanggal_selesai >',date('Y-m-d'));
        $this->db->where('status_bgh IS NULL');
        $result = $this->db->get()->result();
        $result1=null;
        if ($type=='html') {
          foreach ($result as $key => $v) {
            $result1 .= '<tr>
                            <td>'.($key+1).'</td>
                            <td>'.$v->nm.'</td>
                            <td>'.$v->num.'</td>
                            <td>'.$v->lok.'</td>
                            <td>'.anchor('detail-aset/'.$v->id,'Detail').'</td>
                            <td>'.date('d/m/Y',strtotime($v->thn)).'</td>
                            <td>
                              '.anchor('edit-asset/'.$v->id,'Ubah','class="btn btn-xs btn-primary"').'
                            </td>
                          </tr>';
          }
          return $result1;
        }else {
          return $result;
        }
    }

    function get_rekanan($type='html'){
        $this->db->select('id_mitra AS id, nama_mitra AS nr, penanggung_jawab AS rp, kontak_1 AS ks, alamat AS ad, IFNULL(id_bgh,id_temp) AS link');
        $this->db->from('mitra');
        $this->db->join('bagi_hasil_aset bgh','bgh.mitra=id_mitra','LEFT');
        $this->db->join('stok_keluar sk','sk.mitra=id_mitra','LEFT');
        $this->db->group_by('id_mitra');
        // $this->db->where('status','Aktif');
        $result = $this->db->get()->result();
        $result1=null;
        if ($type=='html') {
          foreach ($result as $key => $v) {
            $del = $v->link?null:'<button type="button" class="btn btn-xs btn-danger hapus" value="'.$v->id.'">Hapus</button>';
            $result1 .= '<tr data-nam="'.$v->nr.'">
                            <td>'.($key+1).'</td>
                            <td>'.$v->nr.'</td>
                            <td>'.$v->rp.'</td>
                            <td>'.$v->ks.'</td>
                            <td>'.$v->ad.'</td>
                            <td>'.anchor('detail-mit/'.$v->id,'Detail').'</td>
                            <td>
                              '.anchor('edit-rekn/'.$v->id,'Ubah',' class="btn btn-xs btn-warning"').''.$del.'
                            </td>
                        </tr>';
          }
          return $result1;
        }else{
          return $result;
        }
    }

    function get_detail_aset($id){
      $this->db->select('id_aset AS id, nomor_aset AS na, nama AS nm, sumber AS sb, lokasi AS lk, kondisi AS kd, tanggal_masuk AS tg, keadaan AS kn, ket_aset AS kt, gambar AS img, FORMAT(harga_aset, "#.00") AS prc');
      $this->db->from('aset');
      $this->db->where('id_aset',$id);
      $result = $this->db->get()->result();

      return $result;
    }

    function set_komoditas_baru($nama, $sat, $hgj, $hgb){
        
      $id='007'.time();
      $isi = ['id_kom'=>$id,'nama_komoditas'=>$nama,'harga_jual'=>$hgj,'harga_beli'=>$hgb,'sat'=>$sat];
      $this->db->insert('komoditas',$isi);

      $ret['id'] = $id;
      $ret['resp'] = $this->db->affected_rows();
      return $ret;
    }

    function set_aset_baru($nama,$nomor,$sumber,$harga,$lokasi,$kondisi,$tglmasuk,$keadaan,$cat, $file_name){
        
      $id='005'.time();
      $isi = ['id_aset'=>$id,'nomor_aset'=>$nomor,'nama'=>$nama,'sumber'=>$sumber,'harga_aset'=>$harga,'lokasi'=>$lokasi,'kondisi'=>$kondisi,'keadaan'=>$keadaan,'tanggal_masuk'=>$tglmasuk,'ket_aset'=>$cat];
      if ($file_name) {
        $isi['gambar'] = $file_name;
      }
      $this->db->insert('aset',$isi);

      $v['resp'] = $this->db->affected_rows();
      $v['id'] = $id;
      return $v; 
    }

    function set_rekan_usaha($nama, $pj, $kontak_1, $kontak_2, $alamat){
        $id = '007'.time();
        $isi = ['id_mitra'=>$id,'nama_mitra'=>$nama,'penanggung_jawab'=>$pj,'alamat'=>$alamat,'kontak_1'=>$kontak_1,'kontak_2'=>$kontak_2,'status'=>'Aktif'];
        $this->db->insert('mitra',$isi);
        $ret['id'] = $id;
        $ret['resp'] = $this->db->affected_rows();
        return $ret;
    }


    function set_bagi_hasil($aset,$mitra,$tangmul,$tangsel,$pers_bumdes, $pers_mitra, $sumber){
        $id='004'.time();
        $isi=['id_bgh'=>$id,'mitra'=>$mitra, 'pers_bumdes'=>$pers_bumdes, 'pers_mitra'=>$pers_mitra,'tanggal_mulai'=>$tangmul,'tanggal_selesai'=>$tangsel];
        if ($sumber=='Internal') {
          $isi['aset_bh'] = $aset;
        }else{
          $isi['aset_luar'] = $aset;
        }
        $this->db->insert('bagi_hasil_aset',$isi);
        $ret['id']=$id;
        $ret['resp']= $this->db->affected_rows();
        return $ret;
    }

    function get_edit_komoditas($id){
      $this->db->select('id_kom AS id, nama_komoditas AS kom, harga_jual AS hj, harga_beli AS hb, sat AS st,  IFNULL(FORMAT(SUM(nilai)/SUM(jumlah),"#.00"),0) AS hs');
      $this->db->from('komoditas');
      $this->db->join('stok_item as si','komoditas= id_kom','LEFT');
      $this->db->join('stok_masuk','id_prb=id_stok AND sat_barang=sat','LEFT');
      $this->db->where('id_kom',$id);
      $this->db->where('DATEDIFF("'.date('Y-m-d').'",tanggal) < 365');
      // $this->db->group_by('sat');
      $result = $this->db->get()->result();
      isset($result[0])?$result[0]=$result[0]:$result[0]=null;
      return $result[0];
    }

    function get_edit_harga_kom_per($id){
      $this->db->select('');
      $this->db->from();
      $this->db->join();
      $result = $this->db->get()->result();
      $result = isset($result[0]->kal)?$result[0]->kal:0;
    }

    function get_edit_aset($id){
      $this->db->select('id_aset AS id, nomor_aset AS na, nama AS nm, lokasi AS lk, kondisi kd, keadaan AS kn, tanggal_masuk AS tg, ket_aset AS kt, harga_aset AS ha, sumber AS sb, kredit AS kr, gambar AS img, id_fin AS idf');
      $this->db->from('aset as');
      // $this->db->join('rekap_keuangan rk','rk.foreg_id=as.id_aset','LEFT');
      $this->db->join('rekap_keuangan','foreg_id=id_aset','LEFT');
      $this->db->where('id_aset',$id);
      $result = $this->db->get()->result();
      $result = isset($result[0])?$result[0]:false;
      return $result;
    }

    function get_edit_mitra($id){
      $this->db->select('id_mitra AS id, nama_mitra AS nm, penanggung_jawab AS pj, alamat AS ad, kontak_1 AS t1, kontak_2 AS t2, status AS st');
      $this->db->from('mitra');
      $this->db->where('id_mitra',$id);
      $result = $this->db->get()->result();
      isset($result[0])?$result[0]=$result[0]:$result[0]=null;
      return $result[0];
    }

    function edit_aset($id, $nama, $nomor, $sumber, $harga, $lokasi, $kondisi, $tglmasuk, $keadaan, $cat, $file_name, $del_fot){
        
      if (waktu_data($id)) {
        $isi = ['nomor_aset'=>$nomor,'nama'=>$nama,'lokasi'=>$lokasi,'kondisi'=>$kondisi,'keadaan'=>$keadaan,'tanggal_masuk'=>$tglmasuk,'ket_aset'=>$cat,'sumber'=>$sumber,'harga_aset'=>$harga];
        if ($file_name) {
          $isi['gambar']=$file_name;
        }elseif ($del_fot) {
          $isi['gambar']=null;
        }
      }else{
        $isi = ['nama'=>$nama,'lokasi'=>$lokasi,'keadaan'=>$keadaan,'ket_aset'=>$cat];
        if ($file_name) {
          $isi['gambar']=$file_name;
        }elseif ($del_fot) {
          $isi['gambar']=null;
        }
      }
      $this->db->where('id_aset',$id);
      $this->db->update('aset',$isi);

      return $this->db->affected_rows();
    }

    function edit_rekanan($id, $nama, $pj, $alamat, $status, $telp1, $telp2){
      $isi = ['nama_mitra'=>$nama,'penanggung_jawab'=>$pj,'alamat'=>$alamat,'kontak_1'=>$telp1,'kontak_2'=>$telp2,'status'=>$status];

      $this->db->where('id_mitra',$id);
      $this->db->update('mitra',$isi);
      
      return $this->db->affected_rows();
    }

    function del_komoditas($id){
      $this->db->delete('komoditas', array('id_kom' => $id));
      return $this->db->affected_rows();
    }

    function set_satuan($sat, $ks){
      $this->db->insert('satuan',['satuan'=>$sat,'ket_satuan'=>$ks]);
      return $this->db->affected_rows();
    }

    function edit_satuan($id, $sat, $ket){
      $isi = ['satuan'=>$sat,'ket_satuan'=>$ket];
      $this->db->where('id',$id);
      $this->db->update('satuan',$isi);
      return $this->db->affected_rows();
    }

    function del_satuan($id){
      $this->db->delete('satuan',array('id'=>$id));
      return $this->db->affected_rows();
    }

    function del_aset($id){
      $this->db->delete('aset',['id_aset'=>$id]);
      return $this->db->affected_rows();
    }

    function del_rekanan($id){
      $this->db->delete('mitra',['id_mitra'=>$id]);
      return $this->db->affected_rows();
    }
    
    function get_aset_gov(){
      $this->db->select('id_aset AS id, nama AS nm, nomor_aset AS na, lokasi AS lok');
      $this->db->from('aset');
      $result = $this->db->get()->result();
      $result1=null;
      foreach ($result as $key => $v) {
        $result1 .= '<tr>
                          <td>'.($key+1).'</td>
                          <td>'.$v->nm.'</td>
                          <td>'.$v->na.'</td>
                          <td>'.$v->lok.'</td>
                          <td>'.anchor('detail-aset/'.$v->id,'Detail').'</td>
                    </tr>';
      }
      return $result1;
    }

    function get_detail_mitra($id){
      $this->db->select('nama_mitra AS nm, penanggung_jawab AS pj, alamat AS addr, kontak_1 AS k1, kontak_2 AS k2');
      $this->db->from('mitra');
      $this->db->where('id_mitra',$id);
      $result=$this->db->get()->result();
      
      $result = isset($result[0])?$result[0]:false;
      return $result;
    }

    function get_info_bagi_hasil_mitra($id){
      $this->db->select('IFNULL(IFNULL(nama,deld_aset),aset_luar) AS ast, tanggal_mulai AS tm,tanggal_selesai AS ts, TIMESTAMPDIFF(MONTH,tanggal_mulai, tanggal_selesai) AS dur, pers_bumdes AS pb, pers_mitra AS pm, FORMAT(SUM(jumlah),"#.00") AS jl, status_bgh AS sts');
      $this->db->from('bagi_hasil_aset');
      $this->db->join('aset','id_aset=aset_bh');
      $this->db->join('pemb_bagi_hasil','id_bagi=id_bgh');
      $this->db->group_by('id_bagi');
      $this->db->where('mitra',$id);
      $result = $this->db->get()->result();
      $result1=null;
      foreach ($result as $key => $v) {
        $result1 .= '<tr>
                        <td>'.($key+1).'</td>
                        <td>'.$v->ast.'</td>
                        <td>'.date('d-m-Y',strtotime($v->tm)).' / '.date('d-m-Y',strtotime($v->ts)).' | '.$v->dur.' Bulan</td>
                        <td>'.$v->pb.'%</td>
                        <td>'.$v->pm.'%</td>
                        <td>Rp. '.$v->jl.'</td>
                        <td>'.$v->sts.'</td>
                    </tr>';
      }
      return $result1;
    }
}
