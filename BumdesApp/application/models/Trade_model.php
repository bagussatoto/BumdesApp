<?php

class Trade_model extends CI_Model{
    function __construct(){
        parent:: __construct();
        $this->load->database('default');
    }

    function tambah_distribusi($nama, $jumlah, $tujuan, $mitra, $sat, $harga, $tanggal, $catatan){

        $id='001'.time();
        //catat ke tabel stok_item
        $isi = ['id_stok'=>$id, 'jenis'=>'OUT','komoditas'=>$nama, 'jumlah'=>$jumlah, 'tanggal'=>$tanggal,'sat_barang'=>$sat, 'last_change'=>date('Y-m-d H:i:s')];
        $this->db->insert('stok_item',$isi);

        //catat ke tabel stok_keluar
        $isi = ['id_prb'=>$id,'tujuan'=>$tujuan, 'nilai_transaksi'=>$harga,'mitra'=>$mitra,'catatan'=>$catatan];
        $this->db->insert('stok_keluar',$isi);
        $resp['id']=$id;
        $resp['stat']=$this->db->affected_rows();
        return $resp;
    }

    function get_info_distribusi($tahun, $bulan, $limit, $offset, $ajax, $no_pagin, $type='html'){
        $this->db->select('id_prb AS id, tanggal AS tgl, nama_mitra AS tjn, nama_komoditas AS kom, jumlah AS jlh, FORMAT(nilai_transaksi, "#.00") AS ntr, satuan AS stn');
        $this->db->from('stok_keluar');
        $this->db->join('stok_item','stok_item.id_stok=stok_keluar.id_prb');
        $this->db->join('komoditas','komoditas.id_kom=stok_item.komoditas');
        $this->db->join('mitra','mitra.id_mitra=stok_keluar.mitra');
        $this->db->join('satuan','id=sat_barang');
        $this->db->like('tanggal',$tahun.'-'.$bulan);
        $this->db->where('tujuan','Distribusi');
        if ($no_pagin!='no'&&$ajax) {
            $this->db->limit($limit, $offset);
        }
        $result = $this->db->get();
        $nr=$result->num_rows();
        $result=$result->result();
        $result1=null;
        if ($type=='html') {
            foreach ($result as $key => $val) {
                $result1 .='<tr>
                                <td>'.($offset+1).'</td>
                                <td>'.date('d/m/Y',strtotime($val->tgl)).'</td>
                                <td>'.$val->tjn.'</td>
                                <td>'.$val->kom.'</td>
                                <td>'.$val->jlh.' '.$val->stn.'</td>
                                <td>Rp. '.$val->ntr.'</td>
                                <td>'.anchor('detail-lout/'.$val->id,'Detail','  title="'.$val->id.'"').'</td>
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
        // 	Tanggal	Tujuan	Komoditas	Jumlah	Nilai
    }

    function get_edit_stok_keluar($id){
        $this->db->select('id_stok AS id, nama_komoditas AS kom, tujuan AS tj, tanggal AS dt, jumlah AS jl, id_mitra AS nm, nilai_transaksi AS hg, catatan AS ct, satuan AS st, id_fin AS idf, komoditas AS idk');
        $this->db->from('stok_item si');
        $this->db->join('stok_keluar sm','sm.id_prb=si.id_stok');
        $this->db->join('komoditas km','km.id_kom=si.komoditas');
        $this->db->join('satuan st','st.id=km.sat');
        $this->db->join('mitra mt','mt.id_mitra=sm.mitra','LEFT');
        $this->db->join('rekap_keuangan','foreg_id='.$id,'LEFT');
        $this->db->where('id_stok',$id);
        $result = $this->db->get()->result();
        $result = isset($result[0])&&waktu_data($id)?$result[0]:null;
        return $result;
    }

    function edit_stok_keluar($id,$jl, $tg, $jn, $ct, $mitra, $nilai_trans){
        $resp=false;
        if (waktu_data($id)) {
            $isi = ['jumlah'=>$jl,'tanggal'=>$tg];
            $this->db->where('id_stok',$id);
            $this->db->update('stok_item',$isi);
            $resp = $this->db->affected_rows();
            
            $isi = ['tujuan'=>$jn,'catatan'=>$ct, 'mitra'=>$mitra, 'nilai_transaksi'=>$nilai_trans];
            $this->db->where('id_prb',$id);
            $this->db->update('stok_keluar',$isi);
            $resp += $this->db->affected_rows();
        }
        return $resp;
    }

    function get_total_penjualan($tahun,$bulan,$type=FALSE){
        $this->db->select('FORMAT(SUM(nilai_transaksi), "#.00") AS hg');
        $this->db->from('stok_keluar sk');
        $this->db->join('stok_item si','si.id_stok=sk.id_prb');
        // $this->db->group_by('YEAR(tanggal)');
        $this->db->group_by('CONCAT(MONTH(tanggal), "/",MONTH(tanggal))');
        $this->db->like('tanggal',$tahun.'-'.$bulan,'after');
        if ($type) {
            $this->db->where('tujuan','Distribusi');
        }
        $result = $this->db->get()->result();
        isset($result[0])?$result[0]=$result[0]:$result[0]=null;
        return $result[0];
    }

    function get_jual_profits_tahun($tahun){
        $this->db->select('FORMAT(SUM(nilai_transaksi), "#.00") as jl, FORMAT(SUM(margin), "#.00") AS pf');
        $this->db->from('stok_keluar sk');
        // $this->db->group_by('YEAR(tanggal)');
        $this->db->join('stok_item si','si.id_stok=sk.id_prb');
        $this->db->like('tanggal',$tahun,'after');
        $result = $this->db->get()->result();
        isset($result[0])?$result[0]=$result[0]:$result[0]=null;
        return $result[0];
    }

    function get_jual_profits_bulan($tahun, $bulan){
        $this->db->select('FORMAT(SUM(nilai_transaksi), "#.00") as jl, FORMAT(SUM(margin), "#.00") AS pf');
        $this->db->from('stok_keluar sk');
        $this->db->join('stok_item si','si.id_stok=sk.id_prb');
        $this->db->like('tanggal',$tahun.'-'.$bulan,'after');
        $result = $this->db->get()->result();
        isset($result[0])?$result[0]=$result[0]:$result[0]=null;
        return $result[0];
    }

    function get_tahun(){
        $this->db->select('YEAR(tanggal) AS thn');
        $this->db->from('stok_item si');
        $this->db->join('stok_keluar sk','sk.id_prb=si.id_stok');
        $this->db->group_by('YEAR(tanggal)');
        $this->db->where('tujuan','Distribusi');
        $result = $this->db->get()->result();
        return $result;
    }

    function info_dagang_cepat($tahun, $bulan, $tjn){
        $this->db->select('FORMAT(COUNT(id_temp),"#.00") AS cnt, FORMAT(SUM(nilai_transaksi),"#.00") AS jlh');
        $this->db->from('stok_keluar');
        $this->db->join('stok_item','id_stok=id_prb');
        $this->db->where('tujuan',$tjn);
        $this->db->like('tanggal',$tahun.'-'.$bulan);
        $result = $this->db->get()->result();
        $result = isset($result[0])?$result[0]:false;
        return $result;
    }

    function get_distribusi_mitra($id, $bulan, $tahun, $limit, $offset, $ajax, $no_pagin){
        $this->db->select('id_stok AS id, nama_komoditas AS nk, jumlah AS jl, satuan AS st, nilai_transaksi AS nt, tanggal AS dt');
        $this->db->from('stok_item');
        $this->db->join('stok_keluar','id_prb=id_stok');
        $this->db->join('satuan','id=sat_barang');
        $this->db->join('komoditas','id_kom=komoditas');
        $this->db->where('mitra',$id);
        $this->db->like('tanggal',$tahun.'-'.$bulan);
        $this->db->order_by('tanggal','ASC');
        if ($no_pagin!='no'&&$ajax) {
            $this->db->limit($limit, $offset);
        }
        $result = $this->db->get();
        $nr=$result->num_rows();
        $result=$result->result();
        $result1=null;
        foreach ($result as $key => $v) {
            $result1 .= '<tr>
                            <td>'.($offset+1).'</td>
                            <td>'.$v->nk.'</td>
                            <td>'.$v->jl.' '.$v->st.'</td>
                            <td>Rp. '.$v->nt.'</td>
                            <td>'.date('d-m-Y',strtotime($v->dt)).'</td>
                            <td class="text-center"> <i class="fa fa-info-circle" title="'.$v->id.'"></i></td>
                        </tr>';
                $offset++;
                if (!($no_pagin!='no'&&$ajax)&&$offset==$limit) {
                    break;
                }
        }
        return ['val'=>$result1,'paginasi'=>paginasi_gen($limit,$nr)];
    }
}
