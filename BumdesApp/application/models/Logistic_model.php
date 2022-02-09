<?php

class Logistic_model extends CI_Model{
    function __construct(){
        parent:: __construct();
        $this->load->database('default');
    }

    function get_info_belanja_log($tahun, $bulan, $limit, $offset, $ajax, $no_pagin, $type='html'){
        $this->db->select(' id_prb as idp, id_kom AS idk, nama_komoditas AS nkom,tanggal, jumlah, FORMAT(nilai, "#.00") AS nilai, stok, DATEDIFF( "'.date('Y-m-d').'",tanggal) AS selisih, satuan AS stn');
        $this->db->from('stok_masuk');
        $this->db->join('stok_item','stok_item.id_stok=stok_masuk.id_prb');
        $this->db->join('komoditas','komoditas.id_kom=stok_item.komoditas');
        $this->db->join('satuan','id=sat_barang');
        $this->db->like('tanggal',$tahun.'-'.$bulan);
        if ($no_pagin!='no'&&$ajax) {
            $this->db->limit($limit, $offset);
        }
        $result = $this->db->get();
        $nr=$result->num_rows();
        $result=$result->result();
        $result1=null;
        if ($type=='html') {
            foreach ($result as $key => $val) {
                $akt=null;
                if (waktu_data($val->idp)) {
                    $akt = '<button type="button" class="btn btn-xs btn-danger hapus-bmsk" value="'.$val->idp.'">Hapus</button>'.anchor('edit-ig/'.$val->idp,'Ubah','class="btn btn-xs btn-warning"');
                }
                $result1 .='<tr data-nam="'.$val->nkom.'">
                                <td>'.($offset+1).'</td>
                                <td>'.$val->nkom.'</td>
                                <td>'.date('d/m/Y',strtotime($val->tanggal)).'</td>
                                <td>'.$val->jumlah.' '.$val->stn.'</td>
                                <td>Rp. '.$val->nilai.'</td>
                                <td class="text-center">
                                    '.anchor('detail-lin/'.$val->idp,'Detail','  title="'.$val->idp.'"').'
                                '.$akt.'
                                </td>
                            </tr>';
                $offset++;
                if (!($no_pagin!='no'&&$ajax)&&$offset==$limit) {
                    break;
                }
            }
            return ['val'=>$result1,'paginasi'=>paginasi_gen($limit,$nr)];
        }else{
            return $result;
        }
        //No	Komoditas	Tanggal	Jumlah	Harga	Stok	Aksi
    }

    function get_info_barang_keluar($tahun, $bulan, $limit, $offset, $ajax, $no_pagin, $type='html'){
        $this->db->select('id_prb AS id, id_kom AS idk, nama_komoditas AS kom, tanggal AS tgl, jumlah AS jlh, tujuan AS tjn, stok AS stk, satuan AS stn');
        $this->db->from('stok_keluar');
        $this->db->join('stok_item','stok_item.id_stok=stok_keluar.id_prb');
        $this->db->join('komoditas','komoditas.id_kom=stok_item.komoditas');
        $this->db->join('mitra','mitra.id_mitra=stok_keluar.mitra','LEFT');
        $this->db->join('satuan','id=sat_barang');
        $this->db->like('tanggal',$tahun.'-'.$bulan,'after');
        if ($no_pagin!='no'&&$ajax) {
            $this->db->limit($limit, $offset);
        }
        $result = $this->db->get();
        $nr=$result->num_rows();
        $result=$result->result();
        $result1=null;
        if ($type=='html') {
            foreach ($result as $key => $val) {
                $btn=null;
                if (waktu_data($val->id)) {
                    $btn = '<button type="button" class="btn btn-xs btn-danger hapus-bklr" value="'.$val->id.'">Hapus</button>'.anchor('edit-ei/'.$val->id,'Ubah','class="btn btn-xs btn-warning"');
                }
                $result1 .='<tr data-nam="'.$val->kom.'">
                                <td>'.($offset+1).'</td>
                                <td>'.$val->kom.'</td>
                                <td>'.date('d/m/Y',strtotime($val->tgl)).'</td>
                                <td>'.$val->jlh.' '.$val->stn.'</td>
                                <td>'.$val->tjn.'</td>
                                <td class="text-center">
                                    '.anchor('detail-lout/'.$val->id,'Detail','  title="'.$val->id.'"').'<br>
                                
                                '.$btn.'
                                </td>
                            </tr>';
                $offset++;
                if (!($no_pagin!='no'&&$ajax)&&$offset==$limit) {
                    break;
                }
            }
            return ['val'=>$result1,'paginasi'=>paginasi_gen($limit,$nr)];
        }else{
            return $result;
        }

        // No	Komoditas	Tanggal	Jumlah	Keperluan	Stok	Aksi
    }

    function get_komoditas($type='html'){
        $this->db->select('id_kom AS id, nama_komoditas AS kom, IFNULL(stok,0) AS stk, IFNULL(stok, "new") AS del, FORMAT(harga_jual, "#.00") AS hgj, FORMAT(harga_beli, "#.00") AS hgb, satuan AS st, sat AS st2');//,  FORMAT(SUM(nilai)/SUM(jumlah),"#.00") AS hs
        $this->db->from('komoditas as k');
        $join = '(SELECT `id_stok` FROM `stok_item` WHERE `komoditas`=`id_kom` ORDER by `last_change` DESC limit 1)';
        $this->db->join('stok_item as si','id_stok='.$join,'LEFT');
        // $this->db->join('stok_masuk','id_prb=id_stok','LEFT');
        $this->db->join('satuan st','st.id=k.sat');
        $this->db->group_by('komoditas');
        $result = $this->db->get()->result();
        $result1=null;
        if ($type=='html') {
            foreach ($result as $key => $val) {
                $del_but = $val->del=='new'?'<button type="button" value="'.$val->id.'" class="btn btn-xs btn-danger hapus">Hapus</button> ':null;
                $result1 .='<tr>
                                <td>'.($key+1).'</td>
                                <td>'.$val->kom.'</td>
                                <td>'.$val->stk.' '.$val->st.'</td>
                                <td>Rp. '.$val->hgj.'</td>
                                <td>Rp. '.$val->hgb.'</td>
                                <td class="text-center">
                                    '.anchor('detail-lg/'.$val->id,'Detail','  title="'.$val->id.'"').'
                                    '.$del_but.'
                                    '.anchor('edit-com/'.$val->id,'Ubah','class="btn btn-xs btn-warning"').'
                                </td>
                            </tr>';
            }
            return $result1;
        }else{
            return $result;
        }
    }

    function get_stok_komoditas($id){
        $this->db->select('stok AS stk');
        $this->db->from('stok_item');
        $this->db->where('komoditas',$id);
        $this->db->order_by('last_change');
        $this->db->limit(1);
        $result=$this->db->get()->result();
        $result = isset($result[0]->stk)?(int)$result[0]->stk:0;
        return $result;
    }
    function get_grafik_penjualan($tahun,$bulan){
        $this->db->select('SUM(nilai_transaksi) AS sl, SUM(margin) AS mg, DAY(tanggal) AS dt');
        $this->db->from('stok_item si');
        $this->db->join('stok_keluar sk','si.id_stok=sk.id_prb');
        $this->db->LIKE('tanggal',$tahun.'-'.$bulan,'after');
        $this->db->group_by('DAY(tanggal)');
        $this->db->order_by('DAY(tanggal)','ASC');
        $result=$this->db->get()->result();
        $key_m=[];
        $result1['penjualan']=[];
        $result1['margin']=[];
        $result1['minggu']=[];
        $i=0;
        foreach ($result as $key => $v) {//mengelompokkan minggu
            if ((int)$v->dt>=1 &&(int)$v->dt<=7&&!in_array(1,$result1['minggu'])) {
                $result1['minggu'][]=1;
                $result1['penjualan'][] = 0;
                $result1['margin'][] = 0;
                $key_m[1] = $i;
                $i++;
            }elseif ((int)$v->dt>=8 &&(int)$v->dt<=14&&!in_array(2,$result1['minggu'])) {
                $result1['minggu'][]=2;
                $result1['penjualan'][] = 0;
                $result1['margin'][] = 0;
                $key_m[2] = $i;
                $i++;
            }elseif ((int)$v->dt>=15 &&(int)$v->dt<=21&&!in_array(3,$result1['minggu'])) {
                $result1['minggu'][]=3;
                $result1['penjualan'][] = 0;
                $result1['margin'][] = 0;
                $key_m[3] = $i;
                $i++;
            }else if((int)$v->dt>=22&&!in_array(4,$result1['minggu'])){
                $result1['minggu'][]=4;
                $result1['penjualan'][] = 0;
                $result1['margin'][] = 0;
                $key_m[4] = $i;
            }
        }
        foreach ($result as $key => $v) {
            if ((int)$v->dt>=1 &&(int)$v->dt<=7&&in_array(1,$result1['minggu'])) {
                $result1['penjualan'][$key_m[1]]+=(int)$v->sl;
                $result1['margin'][$key_m[1]]+=(int)$v->mg;
            }elseif ((int)$v->dt>=8 &&(int)$v->dt<=14&&in_array(2,$result1['minggu'])) {
                $result1['penjualan'][$key_m[2]]+=(int)$v->sl;
                $result1['margin'][$key_m[2]]+=(int)$v->mg;
            }elseif ((int)$v->dt>=15 &&(int)$v->dt<=21&&in_array(3,$result1['minggu'])) {
                $result1['penjualan'][$key_m[3]]+=(int)$v->sl;
                $result1['margin'][$key_m[3]]+=(int)$v->mg;
            }else if((int)$v->dt>=22&&in_array(4,$result1['minggu'])){
                $result1['penjualan'][$key_m[4]]+=(int)$v->sl;
                $result1['margin'][$key_m[4]]+=(int)$v->mg;
            }
        }
        return json_encode($result1);
    }

    function get_detail_komoditas($id){
        $this->db->select('nama_komoditas AS nk, FORMAT(harga_jual, "#.00") AS hj, FORMAT(harga_beli, "#.00") AS hb, stok AS sk');
        $this->db->from('komoditas km');
        $this->db->join('stok_item si','si.komoditas=km.id_kom','LEFT');
        $this->db->order_by('last_change','DESC');
        $this->db->limit(1);
        $this->db->where('id_kom',$id);
        $result = $this->db->get()->result();
        return $result;
    }

    function get_detail_komoditas_masuk($id, $y, $m, $limit, $offset, $ajax, $no_pagin){
        $this->db->select('tanggal AS tg, jenis AS jn, asal AS ct, jumlah AS jl, FORMAT(nilai, "#.00") AS nl, stok AS stk, satuan AS st');
        $this->db->from('stok_masuk sm');
        $this->db->join('stok_item si','si.id_stok=sm.id_prb');
        $this->db->where('komoditas',$id);
        $this->db->like('tanggal',$y.'-'.$m);
        $this->db->join('satuan sn','sn.id=si.sat_barang');
        $this->db->order_by('tanggal','DESC');
        $result = $this->db->get();
        $nr=$result->num_rows();
        $result=$result->result();
        $result1=null;
        if ($no_pagin!='no'&&$ajax) {
            $this->db->limit($limit, $offset);
        }
        foreach ($result as $key => $v) {
            $result1 .= '
                        <tr>
                            <td>'.($offset+1).'</td>
                            <td>'.date('d/m/Y',strtotime($v->tg)).'</td>
                            <td>'.$v->ct.'</td>
                            <td>'.$v->jl.' '.$v->st.'</td>
                            <td>'.$v->stk.' '.$v->st.'</td>
                            <td>Rp. '.$v->nl.'</td>
                        </tr>';
                        $offset++;
                        if (!($no_pagin!='no'&&$ajax)&&$offset==$limit) {
                            break;
                        }
        }
        return ['val'=>$result1,'paginasi'=>paginasi_gen($limit,$nr)];
    }

    function get_detail_komoditas_keluar($id, $y, $m, $limit, $offset, $ajax, $no_pagin){
        $this->db->select('tanggal AS tg, tujuan AS ct, jumlah AS jl, FORMAT(nilai_transaksi, "#.00") AS nl, stok AS stk, FORMAT(margin, "#.00") AS kn');
        $this->db->from('stok_keluar sk');
        $this->db->join('stok_item si','si.id_stok=sk.id_prb');
        $this->db->where('komoditas',$id);
        $this->db->like('tanggal',$y.'-'.$m);
        $this->db->order_by('tanggal','DESC');
        $result = $this->db->get();
        $nr=$result->num_rows();
        $result=$result->result();
        $result1=null;
        if ($no_pagin!='no'&&$ajax) {
            $this->db->limit($limit, $offset);
        }
        foreach ($result as $key => $v) {
            $result1 .= '
                        <tr>
                            <td>'.($offset+1).'</td>
                            <td>'.date('d/m/Y',strtotime($v->tg)).'</td>
                            <td>'.$v->ct.'</td>
                            <td>'.$v->jl.'</td>
                            <td>Rp. '.$v->nl.'</td>
                            <td>Rp. '.$v->kn.'</td>
                            <td>'.$v->stk.'</td>
                        </tr>';
                        $offset++;
                        if (!($no_pagin!='no'&&$ajax)&&$offset==$limit) {
                            break;
                        }
        }
        return ['val'=>$result1,'paginasi'=>paginasi_gen($limit,$nr)];
    }

    function get_histori_harga_komoditas($id){
        $this->db->select('FORMAT(harga_lama, "#.00") AS hl, tanggal AS tg, jenis AS jn');
        $this->db->from('histori_harga_komoditas');
        $this->db->where('komoditas',$id);
        $this->db->order_by('tanggal','ASC');
        $result = $this->db->get()->result();
        $result1=null;
        foreach ($result as $key => $v) {
            $result1 .= '<tr>
                            <td>'.($key+1).'</td>
                            <td>'.date('d/m/Y',strtotime($v->tg)).'</td>
                            <td>Rp. '.$v->hl.'</td>
                            <td>'.$v->jn.'</td>
                        </tr>';
        }
        return $result1;
    }

    function set_stok_masuk($barang,$jumlah, $tanggal, $asal, $nilai, $sat, $catatan){
        
        $id='001'.time();
        //catat ke tabel stok_item
        $isi = ['id_stok'=>$id, 'jenis'=>'IN','komoditas'=>$barang, 'jumlah'=>$jumlah, 'tanggal'=>$tanggal, 'sat_barang'=>$sat, 'last_change'=>date('Y-m-d H:i:s')];
        $this->db->insert('stok_item',$isi);

        //catat ke tabel stok_masuk
        $isi = ['id_prb'=>$id,'asal'=>$asal, 'nilai'=>$nilai ,'catatan'=>$catatan];
        $this->db->insert('stok_masuk',$isi);
        $resp['id']=$id;
        $resp['stat']=$this->db->affected_rows();
        return $resp;
    }

    function get_edit_stok_masuk($id){
        $this->db->select('id_stok AS id, nama_komoditas AS kom, asal AS bl, tanggal AS dt, jumlah AS jl, nilai AS hg, catatan AS ct, satuan AS st, id_fin AS idf');
        $this->db->from('stok_item si');
        $this->db->join('stok_masuk sm','sm.id_prb=si.id_stok');
        $this->db->join('komoditas km','km.id_kom=si.komoditas');
        $this->db->join('satuan st','st.id=km.sat');
        $this->db->join('rekap_keuangan','foreg_id='.$id,'LEFT');
        $this->db->where('id_stok',$id);
        $result = $this->db->get()->result();
        $result = isset($result[0])&&waktu_data($id)?$result[0]:null;
        return $result;
    }

    function get_detail_log_masuk($id){
        $this->db->select('id_kom AS id, nama_komoditas AS nk, tanggal AS tg, jumlah AS jl, asal AS al, FORMAT(nilai, "#.00") AS nl, sat_barang AS sb, satuan AS st, catatan AS ct');
        $this->db->from('stok_masuk sm');
        $this->db->join('stok_item si','si.id_stok=sm.id_prb');
        $this->db->join('komoditas ks','ks.id_kom=si.komoditas');
        $this->db->join('satuan sn','sn.id=si.sat_barang');
        $this->db->where('id_prb',$id);
        $this->db->where('jenis','IN');
        $result = $this->db->get()->result();
        
        isset($result[0])?$result[0]=$result[0]:$result[0]=null;

        return $result[0];
    }

    function get_detail_log_keluar($id){
        // id_kom AS id, nama_komoditas AS nk, tanggal AS tg, jumlah AS jl, tujuan AS tj, FORMAT(nilai_transaksi, "#.00") AS nl, sat_barang AS sb, satuan AS st, catatan AS ct, nama_mitra AS mr, FORMAT(margin, "#.oo") AS mg
        $this->db->select('id_kom AS id, nama_komoditas AS nk, tanggal AS tg, jumlah AS jl, tujuan AS tj, FORMAT(nilai_transaksi, "#.00") AS nl, sat_barang AS sb, satuan AS st, catatan AS ct, nama_mitra AS mr, FORMAT(margin, "#.oo") AS mg');
        $this->db->from('stok_keluar sk');
        $this->db->join('stok_item si','si.id_stok=sk.id_prb');
        $this->db->join('komoditas ks','ks.id_kom=si.komoditas');
        $this->db->join('satuan sn','sn.id=si.sat_barang');
        $this->db->join('mitra mt','mt.id_mitra=sk.mitra','LEFT');
        $this->db->where('id_prb',$id);
        // $this->db->where('jenis','OUT');
        $result = $this->db->get()->result();
        
        isset($result[0])?$result[0]=$result[0]:$result[0]=null;

        return $result[0]; 
    }

    function edit_stok_masuk($id, $jumlah, $harga, $tanggal, $jenis, $catatan){
        $ar=false;
        if (waktu_data($id)) {
            $isi = ['jumlah'=>$jumlah,'tanggal'=>$tanggal];
            $this->db->where('id_stok',$id);
            $this->db->update('stok_item',$isi);
            $ar = $this->db->affected_rows();
            
            $isi = ['asal'=>$jenis,'catatan'=>$catatan, 'nilai'=>$harga];
            $this->db->where('id_prb',$id);
            $this->db->update('stok_masuk',$isi);
            $ar += $this->db->affected_rows();
        }
        return $ar;
    }

    function total_belanja_barang($tahun, $bulan){
        $this->db->select('FORMAT(SUM(nilai), "#.00") AS hg');
        $this->db->from('stok_masuk sk');
        $this->db->join('stok_item si','si.id_stok=sk.id_prb');
        // $this->db->group_by('YEAR(tanggal)');
        $this->db->group_by('CONCAT(year(tanggal), "/",MONTH(tanggal))');
        $this->db->like('tanggal',$tahun.'-'.$bulan,'after');
        $result = $this->db->get()->result();
        isset($result[0])?$result[0]=$result[0]:$result[0]=null;
        return $result[0];
    }
    
    function get_tahun($tipe, $mitra=false){
        $this->db->select('YEAR(tanggal) AS thn');
        $this->db->from('stok_item');
        if ($mitra) {
            $this->db->join('stok_keluar','id_temp=id_kom');
            $this->db->where('mitra',$mitra);
        }
        $this->db->group_by('YEAR(tanggal)');
        $this->db->where('jenis',$tipe);
        $result = $this->db->get()->result();
        return $result;
    }

    function hapus_rekap_stok($id){
        $result = $this->db->select('komoditas AS km, jumlah AS jl, jenis AS jn')->from('stok_item')->where('id_stok',$id)->get()->result();
        $result_km = isset($result[0])?$result[0]->km:null; //Komoditas dihapus
        $result_jl = isset($result[0])?$result[0]->jl:0; //Jumlah masuk/keluar
        $result_jn = isset($result[0])?$result[0]->jn:null; //Jenis (IN/OUT)
        $last_stok=0;

        $result2 = $this->db->select('stok, id_stok')->from('stok_item')->where('komoditas',$result_km)->order_by('last_change','DESC')->limit(2)->get()->result();
        $row1_stok = isset($result2[0])?$result2[0]->stok:0; //baris ke 1 stok
        $row1_id =  isset($result2[0])?$result2[0]->id_stok:null;//baris ke 1 id
        $row2_id =  isset($result2[1])?$result2[1]->id_stok:null;//baris ke 2 id
        // waktu_data($id)
        if (true) {
            $this->db->delete('stok_item', array('id_stok' => $id));
            $re_del = $this->db->affected_rows();
            if ($re_del) {
                if ($id==$row1_id) {
                    if ($result_jn=='IN') {
                        $last_stok = (int)$row1_stok - (int)$result_jl;
                    }else{
                        $last_stok = (int)$row1_stok + (int)$result_jl;
                    }
                    $isi=['stok'=>$last_stok];
                    $this->db->where('id_stok', $row2_id);
                    $this->db->update('stok_item',$isi);
                }else{
                    if ($result_jn=='IN') {
                        $last_stok = (int)$row1_stok - (int)$result_jl;
                    }else{
                        $last_stok = (int)$row1_stok + (int)$result_jl;
                    }
                    $isi=['stok'=>$last_stok];
                    $this->db->where('id_stok', $row1_id);
                    $this->db->update('stok_item',$isi);
                }
            }
            return $re_del;
        }else{
            return false;
        }
    }

    function get_tahun_his_log($id, $tipe){
        $this->db->select('YEAR(tanggal) AS thn');
        $this->db->from('stok_item');
        $this->db->group_by('YEAR(tanggal)');
        $this->db->where('komoditas',$id);
        $this->db->where('jenis',$tipe);
        $result = $this->db->get()->result();
        return $result;
    }

    function edit_kom_dagang($id, $nama, $harga_b, $harga_j, $sat){
        $isi = ['nama_komoditas'=>$nama,'harga_jual'=>$harga_j,'harga_beli'=>$harga_b,'sat'=>$sat];
        $this->db->where('id_kom',$id);
        $this->db->update('komoditas',$isi);
        return $this->db->affected_rows();
    }

    function get_sum_log_in($tahun, $bulan){
        $this->db->select('COUNT(id_prb) AS jl, FORMAT(SUM(nilai),"#.00") AS nl');
        $this->db->from('stok_item');
        $this->db->join('stok_masuk','id_prb=id_stok');
        $this->db->like('tanggal',$tahun.'-'.$bulan,'AFTER');
        $result = $this->db->get()->result();
        $result = isset($result[0])?$result[0]:false;

        return $result;
    }
}
