<?php

class Finance_model extends CI_Model{
    function __construct(){
        parent:: __construct();
        $this->load->database('default');
		$this->load->library('Num_splitter');
    }

    function daftar_kerjasama_bgh($tahun, $limit, $offset, $ajax, $no_pagin, $type='html'){
        $this->db->select('id_bgh AS id, IFNULL(aset_luar,IFNULL(nama, deld_aset)) AS na, tanggal_mulai AS tm, tanggal_selesai AS ts, nama_mitra AS nm, pers_bumdes AS pb, pers_mitra AS pm, DATEDIFF("'.date('Y-m-d').'",tanggal_mulai) AS rh, status_bgh AS sgh, COUNT(id_pbgh) AS idt');
        $this->db->from('bagi_hasil_aset bg');
        $this->db->join('aset as','bg.aset_bh=as.id_aset','LEFT');
        $this->db->join('mitra mt','bg.mitra=mt.id_mitra');
        $this->db->join('pemb_bagi_hasil','id_bagi=id_bgh','LEFT');
        $this->db->group_by('id_bgh');
        if ($tahun!='All') {
            $this->db->where('YEAR(tanggal_mulai) <= "'.$tahun.'" AND YEAR(tanggal_selesai) >= "'.$tahun.'"');
        }
        if ($no_pagin!='no'&&$ajax) {
            $this->db->limit($limit, $offset);
        }
        $result = $this->db->get();
        $nr=$result->num_rows();
        $result=$result->result();
        $result1=null;
        if ($type=='html') {
            foreach ($result as $key => $v) {
                $btnk = (int)$v->rh<=30&&!$v->idt?'Hapus':'Batalkan';
                $btn =null;
                if ($v->sgh!='Batal') {
                    $btn = anchor('edit-sp/'.$v->id,'Ubah', 'class="btn btn-xs btn-warning"').
                        '<button type="button" class="btn btn-xs btn-danger hapus-bgh" value="'.$v->id.'">'.$btnk.'</button>';
                }
                $result1 .= '<tr data-nam="">
                                <td>'.($offset+1).'</td>
                                <td>'.$v->na.'</td>
                                <td>'.$v->nm.'</td>
                                <td>'.date('d-m-Y',strtotime($v->tm)).'</td>
                                <td>'.date('d-m-Y',strtotime($v->ts)).'</td>
                                <td>'.$v->sgh.'</td>
                                <td class="text-center">  <i class="fa fa-info-circle" title="'.$v->id.'"></i>
                                    '.anchor('detail-sp/'.$v->id,'Detail').'<br>
                                    '.$btn.'
                                </td>
                            </tr>';
                $offset++;
                if (!($no_pagin!='no'&&$ajax)&&$offset==$limit) {
                    break;
                }
            }
            return ['val'=>$result1,'paginasi'=>paginasi_gen($limit,$nr)];
        }else {
            return $result;
        }

    }

    function get_keuangan_mingguan($tahun, $bulan, $minggu, $limit, $offset, $ajax, $no_pagin, $type='html'){
        $this->db->select('id_fin AS id, tanggal_fin AS dt, keterangan AS nt, FORMAT(debit, "#.00") AS db, FORMAT(kredit, "#.00") AS kd,FORMAT(sld, "#.00") AS bc, actor AS at');
        $this->db->from('rekap_keuangan');
        if ($minggu=='1') {
            $this->db->where('tanggal_fin between "'.$tahun.'-'.$bulan.'-01" and "'.$tahun.'-'.$bulan.'-07"');
        }elseif ($minggu=='2') {
            $this->db->where('tanggal_fin between "'.$tahun.'-'.$bulan.'-08" and "'.$tahun.'-'.$bulan.'-14"');
        }elseif ($minggu=='3') {
            $this->db->where('tanggal_fin between "'.$tahun.'-'.$bulan.'-15" and "'.$tahun.'-'.$bulan.'-21"');
        }else {
            $this->db->where('tanggal_fin between "'.$tahun.'-'.$bulan.'-22" and "'.$tahun.'-'.$bulan.'-31"');
        }
        if ($no_pagin!='no'&&$ajax) {
            $this->db->limit($limit, $offset);
        }
        $result = $this->db->get();
        $nr=$result->num_rows();
        $result=$result->result();
        $result1=null;
        if ($type=='html') {
            foreach ($result as $key => $v) {
                $act = 'Di-input oleh sistem';
            if ($v->at=='User') {
                $act = '
                <button type="button" class="btn btn-xs btn-danger hapus-fin" value="'.$v->id.'">Hapus</button>
                <a href="edit-fin/'.$v->id.'" class="btn btn-xs btn-warning">Ubah</a>';
            }
            $result1 .= '<tr>
                            <td>'.($offset+1).'</td>
                            <td>'.date('d/m/Y',strtotime($v->dt)).'</td>
                            <td>'.$v->nt.'</td>
                            <td>Rp. '.$v->db.'</td>
                            <td>Rp. '.$v->kd.'</td>
                            <td>Rp. '.$v->bc.'</td>
                            <td>'.$act.'</td>
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
    }

    function get_keuangan_bulanan($tahun, $bulan, $limit, $offset, $ajax, $no_pagin, $type='html'){
        $this->db->select('id_fin AS id, tanggal_fin AS dt, keterangan AS nt, FORMAT(debit, "#.00") AS db, FORMAT(kredit, "#.00") AS kd,FORMAT(sld, "#.00") AS bc, actor AS at');
        $this->db->from('rekap_keuangan');
        $this->db->like('tanggal_fin',$tahun.'-'.$bulan,'after');
        if ($no_pagin!='no'&&$ajax) {
            $this->db->limit($limit, $offset);
        }
        $result = $this->db->get();
        $nr=$result->num_rows();
        $result=$result->result();
        $result1=null;
        if ($type=='html') {
            foreach ($result as $key => $v) {
                $act = 'Di-input oleh sistem';
            if ($v->at=='User') {
                $act = '
                <button type="button" class="btn btn-xs btn-danger hapus-fin" value="'.$v->id.'">Hapus</button>
                <a href="edit-fin/'.$v->id.'" class="btn btn-xs btn-warning">Ubah</a>';
            }
            $result1 .= '<tr>
                            <td>'.($offset+1).'</td>
                            <td>'.date('d/m/Y',strtotime($v->dt)).'</td>
                            <td>'.$v->nt.'</td>
                            <td>Rp. '.$v->db.'</td>
                            <td>Rp. '.$v->kd.'</td>
                            <td>Rp. '.$v->bc.'</td>
                            <td>'.$act.'</td>
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
    }

    function get_keuangan_tahunan($tahun, $limit, $offset, $ajax, $no_pagin, $type='html'){
        $this->db->select('id_fin AS id, tanggal_fin AS dt, keterangan AS nt, FORMAT(debit, "#.00") AS db, FORMAT(kredit, "#.00") AS kd,FORMAT(sld, "#.00") AS bc, actor AS at');
        $this->db->from('rekap_keuangan');
        $this->db->like('tanggal_fin',$tahun,'after');
        if ($no_pagin!='no'&&$ajax) {
            $this->db->limit($limit, $offset);
        }
        $result = $this->db->get();
        $nr=$result->num_rows();
        $result=$result->result();
        $result1=null;
        if ($type=='html') {
            foreach ($result as $key => $v) {
                    $act = 'Di-input oleh sistem';
                if ($v->at=='User') {
                    $act = '<button type="button" class="btn btn-xs btn-danger hapus-fin" value="'.$v->id.'">Hapus</button>
                    <a href="edit-fin/'.$v->id.'" class="btn btn-xs btn-warning">Ubah</a>';
                }
                $result1 .= '<tr>
                                <td>'.($offset+1).'</td>
                                <td>'.date('d/m/Y',strtotime($v->dt)).'</td>
                                <td>'.$v->nt.'</td>
                                <td>Rp. '.$v->db.'</td>
                                <td>Rp. '.$v->kd.'</td>
                                <td>Rp. '.$v->bc.'</td>
                                <td>'.$act.'</td>
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
    }

    function get_saldo($tahun=false){
        $this->db->select('FORMAT(sld, "#.00") AS ac');
        $this->db->from('rekap_keuangan');
        if ($tahun) {
        $this->db->LIKE('tanggal_fin',$tahun);
        }
        $this->db->order_by('last_change','DESC');
        $this->db->limit(1);
        return $this->db->get()->result();
    }

    function get_kredit_debit_mingguan($tahun, $bulan, $minggu){
        $this->db->select("FORMAT(SUM(debit), '#.00') AS dbt, FORMAT(SUM(kredit), '#.00') AS kdt");
        $this->db->from('rekap_keuangan');
        if ($minggu=='1') {
            $this->db->where('tanggal_fin between "'.$tahun.'-'.$bulan.'-01" and "'.$tahun.'-'.$bulan.'-07"');
        }elseif ($minggu=='2') {
            $this->db->where('tanggal_fin between "'.$tahun.'-'.$bulan.'-08" and "'.$tahun.'-'.$bulan.'-14"');
        }elseif ($minggu=='3') {
            $this->db->where('tanggal_fin between "'.$tahun.'-'.$bulan.'-15" and "'.$tahun.'-'.$bulan.'-21"');
        }else {
            $this->db->where('tanggal_fin between "'.$tahun.'-'.$bulan.'-22" and "'.$tahun.'-'.$bulan.'-31"');
        }
        $result=$this->db->get()->result();
        return $result;
    }

    function get_kredit_debit_bulanan($tahun, $bulan){
        $this->db->select("FORMAT(SUM(debit), '#.00') AS dbt, FORMAT(SUM(kredit), '#.00') AS kdt");
        $this->db->from('rekap_keuangan');
        $this->db->like('tanggal_fin',$tahun.'-'.$bulan,'after');
        $result=$this->db->get()->result();
        return $result;
    }

    function get_kredit_debit_tahunan($tahun){
        $this->db->select("FORMAT(SUM(debit), '#.00') AS dbt, FORMAT(SUM(kredit), '#.00') AS kdt");
        $this->db->from('rekap_keuangan');
        $this->db->like('tanggal_fin',$tahun,'after');
        $result=$this->db->get()->result();
        return $result;
    }

    function get_laba_usaha($tahun, $bulan, $limit, $offset, $ajax, $no_pagin, $type='html'){
        $this->db->select('id_kom AS id, nama_komoditas AS nk, FORMAT(harga_jual, "#.00") AS pl, FORMAT(SUM(jumlah),"#.00") AS ot, FORMAT(SUM(nilai_transaksi),"#.00") AS sl, FORMAT(SUM(margin),"#.00") AS pf, satuan AS sn');
        $this->db->from('komoditas km');
        $this->db->join('stok_item si', 'km.id_kom=si.komoditas','LEFT');
        $this->db->join('satuan stn','stn.id=si.sat_barang');
        $this->db->join('stok_keluar sk', 'si.id_stok=sk.id_prb');
        $this->db->like('tanggal',$tahun.'-'.$bulan,'after');
        $this->db->group_by('id_kom');
        $this->db->group_by('sat_barang');
        if ($no_pagin!='no'&&$ajax) {
            $this->db->limit($limit, $offset);
        }
        $result = $this->db->get();
        $nr=$result->num_rows();
        $result=$result->result();
        $result1=null;
        if ($type=='html') {
            foreach ($result as $key => $v) {
                $result1 .= '<tr>
                                <td>'.($offset+1).'</td>
                                <td>'.$v->nk.'</td>
                                <td>'.$v->ot.' '.$v->sn.'</td>
                                <td>Rp. '.$v->pl.'</td>
                                <td>Rp. '.$v->sl.'</td>
                                <td>Rp. '.$v->pf.'</td>
                                <td> '.anchor('#','Detail').' </td>
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
    }

    function get_daftar_dividen($type='html'){
        $this->db->select('id_gdiv AS id, FORMAT(jumlah_div, "#.00") AS jd, tahun_div AS td, COUNT(id_ent_div) AS je, COUNT(status_pemb_div) AS tb');
        $this->db->from('dividen_profit');
        $this->db->group_by('id_gdiv');
        // $join = 'select id_div from ';
        $this->db->join('penerima_dividen','id_div=id_gdiv');
        $this->db->order_by('tahun_div','DESC');
        $result = $this->db->get()->result();
        $result1=null;
        if ($type=='html') {
            foreach ($result as $key => $v) {
                $but=null;
                if (waktu_data($v->id)) {
                    $but = '<button class="btn btn-xs btn-danger hapus" value="'.$v->id.'" >Hapus</button> '.anchor('edit-bgu/'.$v->id, 'Ubah','class="btn btn-xs btn-warning"');
                }
                $result1 .= '<tr data-nam="'.$v->td.'">
                                <td>'.($key+1).'</td>
                                <td class="text-center">'.$v->je.'</td>
                                <td>'.$v->td.'</td>
                                <td>Rp. '.$v->jd.'</td>
                                <td class="text-center">
                                '.anchor('info-bagi-dividen/'.$v->id,'Detail').' '.$but.'
                                </td>
                            </tr>';
            }
            return $result1;
        }else{
            return $result;
        }
    }

    function get_grafik_belanja_barang($tahun){
        $bulan = ['Januari', 'Februari', 'Maret', 'April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $this->db->select('SUM(nilai)AS v, MONTH(tanggal) AS b');
        $this->db->from('stok_masuk sm');
        $this->db->join('stok_item si','si.id_stok=sm.id_prb');
        $this->db->where('asal','Beli');
        $this->db->like('tanggal',$tahun,'after');
        $this->db->group_by('CONCAT(year(tanggal), "/",MONTH(tanggal))');
        $result = $this->db->get()->result();
        $result1['value']=[];
        $result1['bulan']=[];
        foreach ($result as $key => $v) {
            $result1['value'][]=(int)$v->v;
            $result1['bulan'][]=$bulan[$v->b-1];
        }
        return json_encode($result1);

    }

    function get_grafik_nilai_distribusi($tahun){
        $bulan = ['Januari', 'Februari', 'Maret', 'April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $this->db->select('SUM(nilai_transaksi)AS v, MONTH(tanggal) AS b');
        $this->db->from('stok_keluar sk');
        $this->db->join('stok_item si','si.id_stok=sk.id_prb');
        $this->db->where('tujuan','Distribusi');
        $this->db->like('tanggal',$tahun,'after');
        $this->db->group_by('CONCAT(year(tanggal), "/",MONTH(tanggal))');
        $result=$this->db->get()->result();
        $result1['value']=[];
        $result1['bulan']=[];
        foreach ($result as $key => $v) {
            $result1['value'][]=(int)$v->v;
            $result1['bulan'][]=$bulan[$v->b-1];
        }
        return json_encode($result1);
    }
    
    function get_grafik_nilai_non_distribusi($tahun){
        $bulan = ['Januari', 'Februari', 'Maret', 'April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $this->db->select('SUM(nilai_transaksi)AS v, MONTH(tanggal) AS b');
        $this->db->from('stok_keluar sk');
        $this->db->join('stok_item si','si.id_stok=sk.id_prb');
        $this->db->where('tujuan','Non-distribusi');
        $this->db->like('tanggal',$tahun,'after');
        $this->db->group_by('CONCAT(year(tanggal), "/",MONTH(tanggal))');
        $result=$this->db->get()->result();
        $result1['value']=[];
        $result1['bulan']=[];
        foreach ($result as $key => $v) {
            $result1['value'][]=(int)$v->v;
            $result1['bulan'][]=$bulan[$v->b-1];
        }
        return json_encode($result1);
    }

    function get_grafik_penyewaan($tahun){
        $bulan = ['Januari', 'Februari', 'Maret', 'April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $this->db->select('SUM(harga)AS v, MONTH(tanggal_mulai) AS b');
        $this->db->from('penyewaan');
        $this->db->like('tanggal_mulai',$tahun,'after');
        $this->db->group_by('CONCAT(year(tanggal_mulai), "/",MONTH(tanggal_mulai))');
        $result=$this->db->get()->result();
        $result1['value']=[];
        $result1['bulan']=[];
        foreach ($result as $key => $v) {
            $result1['value'][]=(int)$v->v;
            $result1['bulan'][]=$bulan[$v->b-1];
        }
        return json_encode($result1);

    }

    function get_grafik_bagi_hasil($tahun){
        $bulan = ['Januari', 'Februari', 'Maret', 'April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $this->db->select('SUM(jumlah) AS nbgh, MONTH(tanggal_bayar) AS b, SUM(pen_bumdes) AS pbgh, SUM(pen_mitra) AS pbghm');
        $this->db->from('pemb_bagi_hasil');
        $this->db->like('tanggal_bayar',$tahun,'after');
        $this->db->group_by('MONTH(tanggal_bayar)');
        $result=$this->db->get()->result();
        $result1['nilai']=[];
        $result1['bumdes']=[];
        $result1['mitra']=[];
        $result1['bulan']=[];
        foreach ($result as $key => $v) {
            $result1['nilai'][]=(int)$v->nbgh;
            $result1['bumdes'][]=(int)$v->pbgh;
            $result1['mitra'][]=(int)$v->pbghm;
            $result1['bulan'][]=$bulan[$v->b-1];
        }
        return json_encode($result1);
    }

    function get_grafik_bagi_dividen(){
        $this->db->select('jumlah_div AS jd, tahun_div AS tdiv');
        $this->db->from('dividen_profit');
        $this->db->group_by('tahun_div');
        $result = $this->db->get()->result();
        $result1['val']=[];
        $result1['tahun']=[];
        foreach ($result as $key => $v) {
            $result1['val'][]=(int)$v->jd;
            $result1['tahun'][]=$v->tdiv;
        }
        return json_encode($result1);
    }

    function get_grafik_keuangan_mingguan($tahun, $bulan){
        $this->db->select('sld AS s, SUM(debit) AS d, SUM(kredit) AS k, day(tanggal_fin) AS dt');
        $this->db->from('rekap_keuangan');
        $this->db->like('tanggal_fin',$tahun.'-'.$bulan,'after');
        // $this->db->group_by('CONCAT(year(tanggal_fin), "/",WEEK(tanggal_fin))');
        $this->db->group_by('DAY(tanggal_fin)');
        $this->db->order_by('DAY(tanggal_fin)','ASC');
        $result=$this->db->get()->result();
        $key_m=[];
        $result1['debit']=[];
        $result1['kredit']=[];
        $result1['minggu']=[];
        $i=0;
        foreach ($result as $key => $v) {//mengelompokkan minggu
            if ((int)$v->dt>=1 &&(int)$v->dt<=7&&!in_array(1,$result1['minggu'])) {
                $result1['minggu'][]=1;
                $result1['debit'][] = 0;
                $result1['kredit'][] = 0;
                $key_m[1] = $i;
                $i++;
            }elseif ((int)$v->dt>=8 &&(int)$v->dt<=14&&!in_array(2,$result1['minggu'])) {
                $result1['minggu'][]=2;
                $result1['debit'][] = 0;
                $result1['kredit'][] = 0;
                $key_m[2] = $i;
                $i++;
            }elseif ((int)$v->dt>=15 &&(int)$v->dt<=21&&!in_array(3,$result1['minggu'])) {
                $result1['minggu'][]=3;
                $result1['debit'][] = 0;
                $result1['kredit'][] = 0;
                $key_m[3] = $i;
                $i++;
            }else if((int)$v->dt>=22&&!in_array(4,$result1['minggu'])){
                $result1['minggu'][]=4;
                $result1['debit'][] = 0;
                $result1['kredit'][] = 0;
                $key_m[4] = $i;
            }
        }
        foreach ($result as $key => $v) {
            if ((int)$v->dt>=1 &&(int)$v->dt<=7&&in_array(1,$result1['minggu'])) {
                $result1['debit'][$key_m[1]]+=(int)$v->d;
                $result1['kredit'][$key_m[1]]+=(int)$v->k;
            }elseif ((int)$v->dt>=8 &&(int)$v->dt<=14&&in_array(2,$result1['minggu'])) {
                $result1['debit'][$key_m[2]]+=(int)$v->d;
                $result1['kredit'][$key_m[2]]+=(int)$v->k;
            }elseif ((int)$v->dt>=15 &&(int)$v->dt<=21&&in_array(3,$result1['minggu'])) {
                $result1['debit'][$key_m[3]]+=(int)$v->d;
                $result1['kredit'][$key_m[3]]+=(int)$v->k;
            }else if((int)$v->dt>=22&&in_array(4,$result1['minggu'])){
                $result1['debit'][$key_m[4]]+=(int)$v->d;
                $result1['kredit'][$key_m[4]]+=(int)$v->k;
            }
        }
        return json_encode($result1);
    }

    function get_grafik_keuangan_bulanan($tahun){
        $bulan = ['Januari', 'Februari', 'Maret', 'April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $this->db->select('sld AS s, SUM(debit) AS d, SUM(kredit) AS k, MONTH(tanggal_fin) AS b');
        $this->db->from('rekap_keuangan');
        $this->db->like('tanggal_fin',$tahun,'after');
        $this->db->group_by('CONCAT(year(tanggal_fin), "/",MONTH(tanggal_fin))');
        $result=$this->db->get()->result();
        $result1['saldo']=[];
        $result1['debit']=[];
        $result1['kredit']=[];
        $result1['bulan']=[];
        foreach ($result as $key => $v) {
            $result1['saldo'][]=(int)$v->s;
            $result1['debit'][]=(int)$v->d;
            $result1['kredit'][]=(int)$v->k;
            $result1['bulan'][]=$bulan[(int)$v->b-1];
            
        }
        return json_encode($result1);
    }

    function get_grafik_keuangan_tahunan(){
        $this->db->select('sld AS s, SUM(debit) AS d, SUM(kredit) AS k, YEAR(tanggal_fin) AS t');
        $this->db->from('rekap_keuangan');
        $this->db->group_by('year(tanggal_fin)');
        $this->db->order_by('year(tanggal_fin)','ASC');
        $result=$this->db->get()->result();
        $result1['saldo']=[];
        $result1['debit']=[];
        $result1['kredit']=[];
        $result1['tahun']=[];
        foreach ($result as $key => $v) {
            $result1['saldo'][]=(int)$v->s;
            $result1['debit'][]=(int)$v->d;
            $result1['kredit'][]=(int)$v->k;
            $result1['tahun'][]=$v->t;
            
        }
        return json_encode($result1);
    }

    function get_grafik_laba_dagang($tahun){
        $bulan = ['Januari', 'Februari', 'Maret', 'April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

        $this->db->select('SUM(nilai_transaksi) AS nt, SUM(margin) AS mg, MONTH(tanggal) AS b');
        $this->db->from('stok_keluar sk');
        $this->db->join('stok_item si', 'si.id_stok=sk.id_prb');
        $this->db->group_by('CONCAT(year(tanggal), "/",MONTH(tanggal))');
        $this->db->like('tanggal',$tahun,'AFTER');
        $result = $this->db->get()->result();
        $result1['penjualan']=[];
        $result1['keuntungan']=[];
        $result1['bulan']=[];
        foreach ($result as $key => $v) {
            $result1['penjualan'][]=(int)$v->nt;
            $result1['keuntungan'][]=(int)$v->mg;
            $result1['bulan'][]=$bulan[$v->b-1];
        }
        return json_encode($result1);
    }

    function get_detail_bagi_hasil($id){
        $this->db->select('id_bgh AS id, IFNULL(aset_luar, IFNULL(nama, deld_aset)) AS na, nama_mitra AS nm, tanggal_mulai AS tm,tanggal_selesai AS ts, FORMAT(SUM(jumlah), "#.00") AS jl, CONCAT(kontak_1," / ",kontak_2) AS km, id_mitra AS idm, pers_bumdes AS pb, pers_mitra AS pm, FORMAT(SUM(pen_bumdes),"#.00") AS pnb, TIMESTAMPDIFF(MONTH,tanggal_mulai, tanggal_selesai) AS dur');
        $this->db->from('bagi_hasil_aset ba');
        $this->db->join('aset as','as.id_aset=ba.aset_bh','LEFT');
        $this->db->join('mitra mt','mt.id_mitra=ba.mitra');
        $this->db->join('pemb_bagi_hasil bg','bg.id_bagi=ba.id_bgh','LEFT');
        $this->db->where('id_bgh',$id);
        $result = $this->db->get()->result();
        $result = isset($result[0])?$result[0]:null;
        return $result;
    }

    function get_detail_histori_bagi_hasil($id, $type='html'){
        $this->db->select('id_pbgh AS id, FORMAT(jumlah,"#.00") AS jl, tanggal_bayar AS tb, FORMAT((pers_bumdes/100)*jumlah,"#.00") AS pb, FORMAT((pers_mitra/100)*jumlah,"#.00") AS pm, catatan AS cat');
        $this->db->from('pemb_bagi_hasil');
        $this->db->join('bagi_hasil_aset','id_bgh=id_bagi');
        $this->db->where('id_bagi',$id);
        $this->db->order_by('tanggal_bayar','ASC');
        $result = $this->db->get()->result();
        $result1 = null;
        if ($type=='html') {
            foreach ($result as $key => $v) {
                $but=null;
                if (waktu_data($v->id)) {
                    $but = '<a href="'.site_url('edit-pbgu/'.$v->id).'" class="btn btn-xs btn-primary">Ubah</a> <button type="button" class="btn btn-xs btn-danger hapus-pbgh" value="'.$v->id.'">Hapus</button>';
                }
                $result1 .= '<tr>
                                <td>'.($key+1).'</td>
                                <td>'.$v->cat.'</td>
                                <td>'.date('d-m-Y',strtotime($v->tb)).'</td>
                                <td>Rp. '.$v->pb.'</td>
                                <td>Rp. '.$v->pm.'</td>
                                <td>Rp. '.$v->jl.'</td>
                                <td>'.$but.'</td>
                            </tr>';
            }
            return $result1;
        }else {
            return $result;
        }
    }

    function del_pemb_bgh($id){
        if (waktu_data($id)) {
            $this->db->where('id_pbgh',$id);
            $this->db->delete('pemb_bagi_hasil');
            return $this->db->affected_rows();
        }else {
            return false;
        }
    }

    function set_pemb_bagi_hasil($idg, $jumlah, $pb, $pm, $cat, $tanggal){
        
        $res['id'] = '400'.time();
        $isi = ['id_pbgh'=>$res['id'],'id_bagi'=>$idg,'jumlah'=>$jumlah,'catatan'=>$cat,'tanggal_bayar'=>$tanggal, 'pen_bumdes'=>$pb, 'pen_mitra'=>$pm];
        $this->db->insert('pemb_bagi_hasil',$isi);

        $res['res'] = $this->db->affected_rows();

        return $res;
    }

    function get_edit_pemb_bgh($id){
        $this->db->select('id_pbgh AS id, IFNULL(aset_luar,IFNULL(nama, deld_aset)) AS ast, nama_mitra AS nm, catatan AS ct, tanggal_bayar AS tb, jumlah AS jl, pen_bumdes AS pnb, pen_mitra AS pnm, pers_bumdes AS pb, pers_mitra AS pm, id_fin AS idf, TIMESTAMPDIFF(MONTH, tanggal_mulai, tanggal_selesai) AS dur, tanggal_mulai AS tm');
        //FORMAT((pers_bumdes/100)*jumlah, "#.00")
        //FORMAT((pers_mitra/100)*jumlah,"#.00")
        $this->db->from('pemb_bagi_hasil');
        $this->db->join('bagi_hasil_aset bha','id_bgh=id_bagi');//bagi hasil aset
        $this->db->join('mitra','id_mitra=bha.mitra');//mitra
        $this->db->join('aset','id_aset=aset_bh','LEFT');//aset
        $this->db->join('rekap_keuangan','foreg_id=id_pbgh','LEFT');//catatan keuangan
        $this->db->where('id_pbgh',$id);
        $result = $this->db->get()->result();

        $result = isset($result[0])&&waktu_data($id)?$result[0]:null;
        return $result;
    }

    function edit_pemb_bgh($id, $cat, $tanggal, $pen_b, $pen_m, $jumlah){
        $isi = ['pen_bumdes'=>$pen_b,'pen_mitra'=>$pen_m,'jumlah'=>$jumlah,'catatan'=>$cat,'tanggal_bayar'=>$tanggal];

        if (waktu_data($id)) {
            $this->db->where('id_pbgh',$id);
            $this->db->update('pemb_bagi_hasil',$isi);
            return $this->db->affected_rows();
        }else{
            return false;
        }
    }

    function set_arus_kas($jenis, $ket, $jumlah, $tanggal, $actor, $for_id=null){
        $check=true;
        if ($for_id) {
            $this->db->where('foreg_id',$for_id);
            $check = $this->db->get('rekap_keuangan')->num_rows();
            $check = $check>0?false:true;
        }

        $id='006'.time();
        $isi = ['id_fin'=>$id,'jenis'=>$jenis,'keterangan'=>$ket,'tanggal_fin'=>$tanggal,'last_change'=>date('Y-m-d H:i:s'),'actor'=>$actor,'foreg_id'=>$for_id];
        if ($jenis=='IN') {
            $isi['debit']=$jumlah;
        }else{
            $isi['kredit']=$jumlah;
        }

        if ($check) {
            $this->db->insert('rekap_keuangan',$isi);
            $ret['res']=$this->db->affected_rows();
        }else {
            $ret['res']=false;
        }
        $ret['id']=$id;
        return $ret;
    }

    function set_bagi_hasil_usaha($tahun, $nilai, $ent, $jlh, $cat){
        $id = '009'.time();
        $isi = ['id_gdiv'=>$id, 'jumlah_div'=>$nilai, 'tahun_div'=>$tahun, 'cat_gdiv'=>$cat];
        $this->db->insert('dividen_profit',$isi);
        $v = $this->db->affected_rows();
        if ($v) {
            for ($i=0; $i < count($ent); $i++) { 
                if ($i<10) {
                    $idn = '10'.$i.time();
                }else{
                    $idn = '1'.$i.time();
                }
                
                $isi = ['id_ent_div'=>$idn, 'id_div'=>$id, 'entitas_div'=>$ent[$i], 'pers_jumlah_div'=>$jlh[$i]];
                $this->db->insert('penerima_dividen',$isi);
            }
        }
        $ret['id']=$id;
        $ret['resp']=$v;
        return $ret;
    }

    function detail_entitas_bagi_usaha($id, $type='html'){
        $this->db->select('id_ent_div AS id, pers_jumlah_div AS prs, FORMAT((pers_jumlah_div/100)*jumlah_div,"#.00") AS nil, entitas_div AS ent, status_pemb_div AS sp ,tanggal_pemb_div AS tp, tahun_div AS td, (pers_jumlah_div/100)*jumlah_div AS nil2');
        $this->db->from('dividen_profit');
        $this->db->join('penerima_dividen','id_div=id_gdiv');/*
        $join = '(SELECT `id_fin` FROM `rekap_keuangan` ORDER by `last_change` DESC limit 1)';
        $this->db->join('rekap_keuangan','id_fin='.$join,'LEFT');*/
        $this->db->where('id_gdiv',$id);
        $result = $this->db->get()->result();
        $result1 = null;
        if ($type=='html') {
            foreach ($result as $key => $v) {
                $result1 .= '<tr data-nam="'.$v->td.'">
                                <td>'.($key+1).'</td>
                                <td>'.$v->ent.'</td>
                                <td>'.$v->prs.' %</td>
                                <td>Rp. '.$v->nil.'</td>
                            </tr>';
            }
            return $result1;
        }else{
            return $result;
        }
    }

    function detail_bagi_hasil_usaha($id){
        $this->db->select('tahun_div AS thn, FORMAT(jumlah_div, "#.00") AS jlh, cat_gdiv AS cat');
        $this->db->from('dividen_profit');
        $this->db->where('id_gdiv',$id);
        $result = $this->db->get()->result();
        $result = isset($result[0])?$result[0]:null;
        return $result;
    }

    function get_grafik_dividen(){
        $this->db->select('tahun_div AS thn, SUM(jumlah_div) AS jd');
        $this->db->from('dividen_profit');
        $this->db->group_by('tahun_div');
        $result=$this->db->get()->result();
        $result1['tahun']=[];
        $result1['nilai']=[];
        foreach ($result as $key => $v) {
            $result1['tahun'][] = (int)$v->thn;
            $result1['nilai'][] = (int)$v->jd;
        }

        return json_encode($result1);
    }

    function edit_bagi_hasil($id, $pb, $pm, $tangsel){
        $isi = ['pers_bumdes'=>$pb,'pers_mitra'=>$pm,'tanggal_selesai'=>$tangsel];
        $this->db->where('id_bgh',$id);
        $this->db->update('bagi_hasil_aset',$isi);
        return $this->db->affected_rows();
    }

    function edit_arus_kas($id, $jumlah, $jenis, $tanggal, $ket=false, $fin=false){
        $isi = ['tanggal_fin'=>$tanggal];
        if ($jenis=='Kredit') {
            $isi['kredit'] = $jumlah;
        }elseif ($jenis=='Debit') {
            $isi['debit']=$jumlah;
        }

        if ($ket) {
            $isi['keterangan']=$ket;
        }

        $this->db->where('id_fin',$id);
        if ($fin) {
            $this->db->where('actor','User');
        }
        $this->db->or_where('foreg_id',$id);
        $this->db->update('rekap_keuangan',$isi);

        $ret['resp'] = $this->db->affected_rows();
        if ($ret['resp']) {
            $res=$this->db->select('id_fin')->from('rekap_keuangan')->where('foreg_id',$id)->get()->result();
            $res = isset($res[0]->id_fin)?$res[0]->id_fin:null;
            $ret['id']=$res;
        }
        return $ret;
    }

    function get_edit_bagi_hasil($id){
        $this->db->select('id_bgh AS id, aset_bh AS ids, IFNULL(nama,aset_luar) AS nm, nomor_aset AS na, tanggal_mulai AS tm, tanggal_selesai AS ts, nama_mitra AS mt, TIMESTAMPDIFF(MONTH, tanggal_mulai, tanggal_selesai) AS sb, pers_bumdes AS pb, pers_mitra AS pm');
        $this->db->from('bagi_hasil_aset bg');
        $this->db->join('aset as','as.id_aset=aset_bh','LEFT');
        $this->db->join('mitra mt','mt.id_mitra=mitra');
        $this->db->where('id_bgh',$id);
        $this->db->where('status IS NULL');
        $result = $this->db->get()->result();
        $result = isset($result[0])&&!waktu_data($id)?$result[0]:null;
        return $result;
    }

    function get_edit_keuangan($id){
        $this->db->select('id_fin AS id, keterangan AS kt, debit AS db, kredit AS kd, tanggal_fin AS tg');
        $this->db->from('rekap_keuangan');
        $this->db->where('id_fin',$id);
        $this->db->where('actor','User');
        $result = $this->db->get()->result();
        $result = isset($result[0])&&waktu_data($id)?$result[0]:null;
        return $result;
    }

    function get_edit_bagi_dividen($id){
        $this->db->select('id_gdiv AS id, jumlah_div AS jd, tahun_div AS td, cat_gdiv AS cd, id_fin AS idf');
        $this->db->from('dividen_profit');
        $this->db->join('rekap_keuangan','foreg_id=id_gdiv','LEFT');
        $this->db->where('id_gdiv',$id);
        $result = $this->db->get()->result();
        $result = isset($result[0])&&waktu_data($id)?$result[0]:null;
        return $result;
    }

    function del_edit_ent_dividen($id){
        $this->db->where('id_div',$id);
        $this->db->delete('penerima_dividen');
    }

    function edit_bagi_dividen($id, $tahun, $nilai, $cat){
        $isi = ['jumlah_div'=>$nilai, 'tahun_div'=>$tahun, 'cat_gdiv'=>$cat ];
        $this->db->where('id_gdiv',$id);
        $this->db->update('dividen_profit',$isi);
        return $this->db->affected_rows();
    }

    function edit_ent_dividen($id, $ent, $jlh){
        for ($i=0; $i < count($ent); $i++) { 
            if ($i<10) {
                $idn = '10'.$i.time();
            }else{
                $idn = '1'.$i.time();
            }
            
            $isi = ['id_ent_div'=>$idn, 'id_div'=>$id, 'entitas_div'=>$ent[$i], 'pers_jumlah_div'=>$jlh[$i]];
            $this->db->insert('penerima_dividen',$isi);
        }
    }

    function get_edit_ent_bagi_dividen($id){
        $this->db->select('id_ent_div AS id, entitas_div AS ent_d, pers_jumlah_div AS pers_d');
        $this->db->from('penerima_dividen');
        $this->db->where('id_div',$id);
        $result = $this->db->get()->result();
        return $result;
    }

    function get_total_bagi_hasil($tahun){
        $this->db->select('FORMAT(SUM(jumlah), "#.00") AS hg, FORMAT(SUM(pen_bumdes),"#.00") AS pnb');
        $this->db->from('pemb_bagi_hasil');
        if ($tahun!='All') {
            $this->db->like('tanggal_bayar',$tahun,'after');
        }
        $result = $this->db->get()->result();
        $result = isset($result[0])?$result[0]:false;
        return $result;
    }

    function get_pemb_bagi_hasil_bulan($tahun, $bulan){
        $this->db->select('FORMAT(SUM(jumlah), "#.00") AS hg, FORMAT(SUM(pen_bumdes),"#.00") AS pnb');
        $this->db->from('pemb_bagi_hasil');
        $this->db->like('tanggal_bayar',$tahun.'-'.$bulan,'after');
        $result = $this->db->get()->result();
        $result = isset($result[0])?$result[0]:false;
        return $result;
    }
    function get_tahun_bgh(){
        $this->db->select('YEAR(tanggal_mulai) AS thn');
        $this->db->from('bagi_hasil_aset');
        $this->db->group_by('YEAR(tanggal_mulai)');
        $result = $this->db->get()->result();
        return $result;
    }

    function del_keuangan($id){
        $result = $this->db->select('id_fin AS id, IFNULL(debit,kredit) AS nil, jenis AS jen')->from('rekap_keuangan')->where('id_fin',$id)->or_where('foreg_id',$id)->get()->result();
        
        $nilai = isset($result[0])?$result[0]->nil:0;
        $jenis = isset($result[0])?$result[0]->jen:0;
        $res_id = isset($result[0])?$result[0]->id:0;
        $last_saldo = 0;
        $result2 = $result = $this->db->select('id_fin AS id, sld')->from('rekap_keuangan')->order_by('last_change','DESC')->limit(2)->get()->result();

        $row1_id = isset($result2[0])?$result2[0]->id:0;
        $row2_id = isset($result2[1])?$result2[1]->id:0;
        $row1_saldo = isset($result2[0])?$result2[0]->sld:0;

        if (waktu_data($id)) {
            $this->db->where('id_fin',$id)->or_where('foreg_id',$id)->delete('rekap_keuangan');
            $res = $this->db->affected_rows();

            if ($res) {
                if ($id==$row1_id) {
                    if ($jenis=='IN') {
                        $last_saldo = (int)$row1_saldo - (int)$nilai;
                    }else{
                        $last_saldo = (int)$row1_saldo + (int)$nilai;
                    }
                    $isi=['sld'=>$last_saldo];
                    $this->db->where('id_fin', $row2_id);
                    $this->db->update('rekap_keuangan',$isi);
                }else{
                    if ($jenis=='IN') {
                        $last_saldo = (int)$row1_saldo - (int)$nilai;
                    }else{
                        $last_saldo = (int)$row1_saldo + (int)$nilai;
                    }
                    $isi=['sld'=>$last_saldo];
                    $this->db->where('id_fin', $row1_id);
                    $this->db->update('rekap_keuangan',$isi);
                }
            }
            $res2['res'] = $res;
            $res2['id'] = $res_id;
            return $res2;
        }else{
            return false;
        }

    }

    function get_tahun_fin(){
        $this->db->select('YEAR(tanggal_fin) AS thn');
        $this->db->from('rekap_keuangan');
        $this->db->group_by('YEAR(tanggal_fin)');
        $result = $this->db->get()->result();
        return $result;
    }

    function del_bagi_hasil($id){
        $this->db->select('DATEDIFF("'.date('Y-m-d').'",tanggal_mulai) AS jh, COUNT(id_pbgh) AS jb');
        $this->db->from('bagi_hasil_aset');
        $this->db->join('pemb_bagi_hasil','id_bagi=id_bgh','LEFT');
        $this->db->where('id_bgh',$id);
        $r = $this->db->get()->result();
        $jh = isset($r[0])?(int)$r[0]->jh:0;
        $jb = isset($r[0])?$r[0]->jb:null;

        $res['res']=false;
        if ($jh<=30 && !$jb ) {
            $isi = ['status_bgh'=>'Batal'];
            $this->db->where('id_bgh',$id);
            $this->db->delete('bagi_hasil_aset');
            $res['res'] = $this->db->affected_rows();
            $res['mesg'] = 'Menghapus';
            $res['log'] = 'HAPUS';
        }else{
            $isi = ['status_bgh'=>'Batal'];
            $this->db->where('id_bgh',$id);
            $this->db->update('bagi_hasil_aset',$isi);
            $res['res'] = $this->db->affected_rows();
            $res['mesg'] = 'Membatalkan';
            $res['log'] = 'BATAL';
        }

        return $res;
    }

    function del_bagi_dividen_g($id){
        if (waktu_data($id)) {
            $this->db->where('id_gdiv',$id);
            $this->db->delete('dividen_profit');
            $result=$this->db->affected_rows();
        }else{
            $result=false;
        }
        return $result;
    }

    function del_bayar_dividen($id){
        $this->db->where('id_ent_div',$id);
        $this->db->update('penerima_dividen',['status_pemb_div'=>null,'tanggal_pemb_div'=>null]);
        return $this->db->affected_rows();
    }

    function set_bayar_dividen($id){
        $this->db->where('id_ent_div',$id);
        $this->db->update('penerima_dividen',['status_pemb_div'=>'Ok','tanggal_pemb_div'=>date('Y-m-d')]);
        return $this->db->affected_rows();
    }

    function cek_jadwal_bgh($id, $tm, $ts, $edit=false){
        $this->db->from('bagi_hasil_aset');
        $this->db->where('aset_bh',$id);
        $this->db->where('status_bgh IS NULL');
        if ($edit) {
            $this->db->where('id_bgh <> ', $edit);
            $this->db->where('deld_aset IS NULL');
        }
        $this->db->where('((tanggal_selesai >= "'.$tm.'" AND tanggal_selesai <= "'.$ts.'" )');
        $this->db->or_where('(tanggal_mulai >= "'.$tm.'" AND tanggal_mulai <= "'.$ts.'")');
        $this->db->or_where('(tanggal_mulai <= "'.$tm.'" AND tanggal_selesai >= "'.$ts.'")');
        $this->db->or_where('(tanggal_mulai >= "'.$tm.'" AND tanggal_selesai <= "'.$ts.'"))');
        $this->db->where('status_bgh IS NULL');
        $result = $this->db->get()->num_rows();
        return $result;
    }
    
    function get_histori_bgh_aset($id){
        $this->db->select('nama_mitra AS mt, pers_bumdes AS pb, pers_mitra AS pm, tanggal_mulai AS tm, TIMESTAMPDIFF(MONTH, tanggal_mulai, tanggal_selesai) AS dur, FORMAT(SUM(jumlah),"#.00") AS tbh');
        $this->db->from('bagi_hasil_aset bgh');
        $this->db->join('mitra','id_mitra = bgh.mitra');
        $this->db->join('pemb_bagi_hasil','id_bagi = id_bgh','LEFT');
        $this->db->where('aset_bh',$id);
        $this->db->group_by('id_bgh');
        $result = $this->db->get()->result();
        $result1=null;
        foreach ($result as $key => $v) {
            $result1 .= '<tr>
                            <td>'.($key+1).'</td>
                            <td>'.$v->mt.'</td>
                            <td>'.date('d-m-Y',strtotime($v->tm)).'</td>
                            <td>'.$v->dur.' Bulan</td>
                            <Td>'.$v->pb.' %</Td>
                            <Td>'.$v->pm.' %</Td>
                            <Td>Rp. '.$v->tbh.'</Td>
                        </tr>';
        }
        return $result1;
    }//TIMESTAMPDIFF(MONTH,tanggal_mulai, tanggal_selesai) AS dur

    function get_info_aset_bgh($tahun=false, $bulan=false){
        $this->db->select('COUNT(aset_bh) AS ints, COUNT(aset_luar) AS exts, deld_aset AS deints, (COUNT(aset_bh)+COUNT(deld_aset)) AS jints');
        $this->db->from('bagi_hasil_aset');
        $this->db->where('status_bgh IS NULL');
        if ($tahun) {
            $this->db->where('tanggal_selesai  >= "'.$tahun.'-'.$bulan.'-'.date('d').'"');
        }
        $result = $this->db->get()->result();
        $result = isset($result[0])?$result[0]:false;
        return $result;
    }

    /*
    function get_tahun_div(){
        $this->db->select('tahun_div AS thn');
        $this->db->from('dividen_profit');
        $this->db->group_by('tahun_div');
        $result = $this->db->get()->result();
        return $result;
    }*/

}
