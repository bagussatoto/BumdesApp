<?php

require_once APPPATH.'..\asset\fpdf\fpdf.php';
class Finance extends CI_controller{
    function __construct(){
        parent:: __construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->PDF = new FPDF();
        $this->bulan = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
        $this->waktu = date('Y-m-d H:i:s');
        if (!$this->ses->log_s||$this->ses->tp!='MNG') {
			redirect(base_url());
        }
    }

    function weekly_report(){//=============ada view
        $dt['title'] = 'Laporan mingguan';
        $dt['mg'] = [1,2,3,4];
        if (date('d')>=1&&date('d')<=7) {
            $dt['minggu']=1;
        }elseif (date('d')>=8&&date('d')<=14) {
            $dt['minggu']=2;
        }elseif (date('d')>=15&&date('d')<=21) {
            $dt['minggu']=3;
        }else {
            $dt['minggu']=4;
        }
        
        $dt['bln'] = $this->bulan;
        $dt['tahun'] = date('Y');
        $dt['bulan'] = date('m');
        $dt['lim'] = 10;
        $offset = 0;
        $dt['form_lim'] = [10, 25, 50, 100];
        $ajax = $this->input->is_ajax_request();
        $no_pagin = $this->input->get('pagin',TRUE);
        if (isset($_GET['tahun'])) {
            $dt['tahun'] = $this->input->get('tahun',TRUE);
            $dt['bulan'] = $this->input->get('bulan',TRUE);
            $dt['minggu'] = $this->input->get('minggu',TRUE);
            $dt['lim'] = $this->input->get('limit',TRUE);
            $offset = $this->input->get('offset',TRUE);
        }
        $dt['nb']= $this->bulan[$dt['bulan']];
        $dt['thn'] = $this->fm->get_tahun_fin();
        $dt['value']=$this->fm->get_keuangan_mingguan($dt['tahun'],$dt['bulan'],$dt['minggu'], $dt['lim'], $offset, $ajax, $no_pagin);
        $dt['kd']=$this->fm->get_kredit_debit_mingguan($dt['tahun'],$dt['bulan'],$dt['minggu']);
        $dt['s']=$this->fm->get_saldo();
        $dt['v_grafik']=$this->fm->get_grafik_keuangan_mingguan($dt['tahun'],$dt['bulan']);
        // echo $dt['v_grafik'];
        if (!$this->input->is_ajax_request()) {
            $this->load->view('MenuPage/Main/weekly_report',$dt);
            // echo json_encode($dt['s']);
        }else{
            $val['ses']='Ok';
            $val['tabel']=$dt['value'];
            $val['debit']=isset($dt['kd'][0]->dbt)? $dt['kd'][0]->dbt:0;
            $val['kredit']=isset($dt['kd'][0]->kdt)? $dt['kd'][0]->kdt:0;
            $val['grafik'] = json_decode($dt['v_grafik']);
            $val['nb'] = $dt['nb'];
            $val['thn'] = $dt['tahun'];
            echo json_encode($val);
        }
    }

    function monthly_report(){//=============ada view
        $dt['title'] = 'Laporan bulanan';
        //echo $this->input->get('tipe');
        $dt['bln'] = $this->bulan;
        $dt['tahun'] = date('Y');
        $dt['bulan'] = date('m');
        $dt['lim'] = 10;
        $offset = 0;
        $dt['form_lim'] = [10, 25, 50, 100];
        $ajax = $this->input->is_ajax_request();
        $no_pagin = $this->input->get('pagin',TRUE);
        if (isset($_GET['tahun'])) {
            $dt['tahun'] = $this->input->get('tahun',TRUE);
            $dt['bulan'] = $this->input->get('bulan',TRUE);
            $dt['lim'] = $this->input->get('limit',TRUE);
            $offset = $this->input->get('offset',TRUE);
        }
        $dt['thn'] = $this->fm->get_tahun_fin();
        $dt['value']=$this->fm->get_keuangan_bulanan($dt['tahun'],$dt['bulan'], $dt['lim'], $offset, $ajax, $no_pagin);
        $dt['kd']=$this->fm->get_kredit_debit_bulanan($dt['tahun'],$dt['bulan']);
        $dt['s']=$this->fm->get_saldo();
        $dt['v_grafik']=$this->fm->get_grafik_keuangan_bulanan($dt['tahun']);
        // echo $dt['v_grafik'];
        if (!$ajax) {
            $this->load->view('MenuPage/Main/monthly_report',$dt);
        }else{
            $val['ses']='Ok';
            $val['tabel']=$dt['value'];
            $val['debit']=isset($dt['kd'][0]->dbt)? $dt['kd'][0]->dbt:0;
            $val['kredit']=isset($dt['kd'][0]->kdt)? $dt['kd'][0]->kdt:0;
            $val['grafik'] = json_decode($dt['v_grafik']);
            echo json_encode($val);
        }
    }

    function annual_report(){//=============ada view
        $dt['title'] = 'Laporan tahunan';
        //echo $this->input->get('tipe');
        $dt['tahun'] = date('Y');
        $dt['lim'] = 10;
        $offset = 0;
        $dt['form_lim'] = [10, 25, 50, 100];
        $ajax = $this->input->is_ajax_request();
        $no_pagin = $this->input->get('pagin',TRUE);
        // echo $no_pagin;
        if (isset($_GET['tahun'])) {
            $dt['tahun'] = $this->input->get('tahun',TRUE);
            $dt['lim'] = $this->input->get('limit',TRUE);
            $offset = $this->input->get('offset',TRUE);
        }
        $dt['thn'] = $this->fm->get_tahun_fin();
        $dt['value']=$this->fm->get_keuangan_tahunan($dt['tahun'], $dt['lim'], $offset, $ajax,$no_pagin);
        $dt['kd']=$this->fm->get_kredit_debit_tahunan($dt['tahun']);
        $dt['s']=$this->fm->get_saldo();
        $dt['v_grafik']=$this->fm->get_grafik_keuangan_tahunan();
        if (!$ajax) {
            $this->load->view('MenuPage/Main/annual_report',$dt);
        }else{
            $val['ses']='Ok';
            $val['tabel']=$dt['value'];
            $val['debit']=isset($dt['kd'][0]->dbt)? $dt['kd'][0]->dbt:0;
            $val['kredit']=isset($dt['kd'][0]->kdt)? $dt['kd'][0]->kdt:0;
            $val['grafik'] = json_decode($dt['v_grafik']);
            echo json_encode($val);
        }
    }

    function corp_profits(){//================= OK
        $dt['nb'] = $this->bulan[date('m')];
        $dt['title'] = 'Laporan tahunan';
        //echo $this->input->get('tipe');
        $dt['bln'] = $this->bulan;
        $dt['tahun'] = date('Y');
        $dt['bulan'] = date('m');
        $dt['lim'] = 10;
        $offset = 0;
        $dt['form_lim'] = [10, 25, 50, 100];
        $ajax = $this->input->is_ajax_request();
        $no_pagin = $this->input->get('pagin',TRUE);
        if (isset($_GET['tahun'])) {
            $dt['tahun'] = $this->input->get('tahun',TRUE);
            $dt['bulan'] = $this->input->get('bulan',TRUE);
            $dt['nb'] = $this->bulan[$dt['bulan']];
            $dt['lim'] = $this->input->get('limit',TRUE);
            $offset = $this->input->get('offset',TRUE);
        }
        $dt['thn'] = $this->lm->get_tahun('OUT');
        $dt['value'] = $this->fm->get_laba_usaha($dt['tahun'], $dt['bulan'], $dt['lim'], $offset, $ajax, $no_pagin);
        $dt['v_grafik']=$this->fm->get_grafik_laba_dagang($dt['tahun']);
        $dt['v2']=$this->tm->get_jual_profits_tahun($dt['tahun']);
        $dt['v3']=$this->tm->get_jual_profits_bulan($dt['tahun'],$dt['bulan']);
        // echo $dt['v_grafik'];
        $this->load->view('MenuPage/Main/corp_profits',$dt);
    }

    function bagi_hasil(){//=================OK
        $dt['title'] = 'Aset bagi hasil';
        $dt['bln'] = $this->bulan;
        $dt['tahun'] = date('Y');
        $dt['y'] = date('Y');
        $dt['m'] = date('m');
        $dt['nb'] = $this->bulan[date('m')];
        $dt['lim'] = 10;
        $offset = 0;
        $dt['form_lim'] = [10, 25, 50, 100];
        $ajax = $this->input->is_ajax_request();
        $no_pagin = $this->input->get('pagin',TRUE);
        if (isset($_GET['tahun'])) {
            $dt['tahun'] = $this->input->get('tahun',TRUE);
            $dt['m'] = $this->input->get('bulan',TRUE);
            $dt['lim'] = $this->input->get('limit',TRUE);
            $dt['lim'] = in_array($dt['lim'],$dt['form_lim'])?$dt['lim']:10;
            $offset = $this->input->get('offset',TRUE);
            $dt['y'] = $dt['tahun']=='All'?date('Y'):$dt['tahun'];
            $dt['nb']=isset($this->bulan[$dt['m']])?$this->bulan[$dt['m']]:'not-valid';
        }
        $dt['pby'] = $this->fm->get_total_bagi_hasil($dt['y']);
        $dt['pbm'] = $this->fm->get_pemb_bagi_hasil_bulan($dt['y'],$dt['m']);
        $dt['vt'] = $this->fm->get_info_aset_bgh($dt['y'], $dt['m']);
        $dt['va'] = $this->fm->get_info_aset_bgh();
        $dt['thn'] = $this->fm->get_tahun_bgh();
        $dt['value'] = $this->fm->daftar_kerjasama_bgh($dt['tahun'], $dt['lim'], $offset, $ajax, $no_pagin);
        $dt['v_grafik']=$this->fm->get_grafik_bagi_hasil($dt['y']);
        if (!$ajax) {
            // echo json_encode($dt['value']);
            $this->load->view('MenuPage/Main/bagi_hasil',$dt);
            // echo $dt['tahun'];
        }else{
            $val['ses']='Ok';
            $val['v_grafik'] = json_decode($dt['v_grafik']);
            $val['pbgh-m'] = isset($dt['pbm']->pnb)?$dt['pbm']->pnb:0;
            $val['pbgh-y'] = isset($dt['pby']->pnb)?$dt['pby']->pnb:0;
            $val['nbgh-m'] = isset($dt['pbm']->hg)?$dt['pbm']->hg:0;
            $val['nbgh-y'] = isset($dt['pby']->hg)?$dt['pby']->hg:0;
            
            $val['int-m'] = isset($dt['vt']->jints)?$dt['vt']->jints:0;
            $val['ext-m'] = isset($dt['vt']->exts)?$dt['vt']->exts:0;
            $val['int-y'] = isset($dt['va']->jints)?$dt['va']->jints:0;
            $val['ext-y'] = isset($dt['va']->exts)?$dt['va']->exts:0;
            
            $val['nb'] = $dt['nb'];
            $val['y'] = $dt['y'];
            $val['tabel']=$dt['value'];
            echo json_encode($val);
        }
    }

    function bagi_dividen(){
        $dt['title'] = 'Pembagian dividen';
        $dt['v'] = $this->fm->get_daftar_dividen();
        $dt['v_grafik'] = $this->fm->get_grafik_dividen();
        $this->load->view('MenuPage/Main/Pembagian_dividen',$dt);
        // echo $dt['v_grafik'];
    }

    function form_tabah_dividen(){
        $dt['title'] = '';
        $dt['id'] = '';
        // $dt['tahun'] = $this->fm->get_tahun_keuangan();
        $this->load->view('MenuPage/Form/tambah_bagi_hasil_usaha',$dt);
        // echo json_encode($dt['tahun']);
        // echo json_encode($dt['s']);
    }

    function form_cat_keuangan(){//=============ada view
        $dt['title'] = '';
        $dt['tanggal'] = date('d/m/Y');
        $dt['b']=$this->fm->get_saldo();
        $this->load->view('MenuPage/Form/tambah_cat_keuangan',$dt);
    }

    function form_edit_finansial($id){//=============ada view
        $dt['var']=$id;
        $dt['title'] = '';
        $dt['id'] = '';
        $dt['tanggal'] = date('d/m/Y');
        $dt['v'] = $this->fm->get_edit_keuangan($id);
        $dt['s']=$this->fm->get_saldo();
        $this->load->view('MenuPage/Form/edit_finansial',$dt);
        // echo json_encode($dt['v']);
    }

    function form_tambah_pemb_bgh(){
        $dt['title'] = 'Penerimaan bagi hasil';
        $dt['v']= $this->fm->daftar_kerjasama_bgh(date('Y'), 0, 0, 0, 0,'json');
        $this->load->view('MenuPage/Form/tambah_pemb_bgh',$dt);
    }

    function form_edit_pemb_bagi_hasil($id){
        $dt['title'] = 'Ubah pembayaran bagi hasil';
        $dt['v']= $this->fm->get_edit_pemb_bgh($id);
        $this->load->view('MenuPage/Form/edit_pemb_bgh',$dt);
        // echo json_encode($dt['v']);
    }

    function form_tambah_aset_bagi_hasil(){//=============ada view
        $dt['title'] = '';
        $dt['id'] = '';
        $dt['tanggal'] = date('d/m/Y');
        $dt['v2'] = $this->am->get_rekanan('JSON');
        $dt['v3'] = $this->am->get_aset_umum('JSON');
        $this->load->view('MenuPage/Form/tambah_aset_bagi_hasil',$dt);

        // echo json_encode($dt['v3']);
    }

    function form_edit_aset_bagi_hasil($id){//=============ada view
        $dt['title'] = '';
        $dt['id'] = '';
        $dt['tanggal'] = date('d/m/Y');
        $dt['v'] = $this->fm->get_edit_bagi_hasil($id);
        $this->load->view('MenuPage/Form/edit_bagi_hasil',$dt);
        // echo json_encode($dt['v']);
    }

    function form_edit_bagi_dividen($id){
        $dt['title'] = 'Bagi hasil usaha';
        $dt['id'] = '';
        $dt['v'] = $this->fm->get_edit_bagi_dividen($id);
        $dt['v2'] = $this->fm->get_edit_ent_bagi_dividen($id);
        $this->load->view('MenuPage/Form/edit_bagi_dividen',$dt);
    }
    
    function detail_bagi_hasil($id){//=============ada view
        $dt['title'] = '';
        $dt['id'] = $id;
        $dt['v'] = $this->fm->get_detail_bagi_hasil($id);
        $dt['v_histori_bgh'] = $this->fm->get_detail_histori_bagi_hasil($id);
        $this->load->view('MenuPage/Detail_Print/detail_bagi_hasil',$dt);
        // echo json_encode($dt['v']);
    }

    function set_tambah_bagi_hasil(){
        $aset = $this->input->post('aset',true);
        $sumber = $this->input->post('sumber',true);
        $mitra = $this->input->post('mitra',true);
        $pers_bumdes = $this->input->post('pers_bumdes',true);
        $pers_mitra = $this->input->post('pers_mitra',true);
        $n_mitra = $this->input->post('n_mitra',true);
        $n_aset = $this->input->post('n_aset',true);
        $n_aset = $sumber=='Internal'?$n_aset:$aset;
        $tangmul = $this->input->post('tanggal',true);
        $bulan = $this->input->post('bulan',true);
        // $tangsel = $this->input->post('tanggal_sel',true);
        $tangmul = date('Y-m-d',strtotime($tangmul));
        $tangsel = date('Y-m-d',strtotime($tangmul.' +'.$bulan.' months'));
        
        $v=$this->am->set_bagi_hasil($aset,$mitra,$tangmul,$tangsel, $pers_bumdes, $pers_mitra, $sumber);

        $log_mesg = '[TAMBAH][BAGI HASIL]['.$v['id'].'] Menambah kerja sama bagi hasil untuk aset '.$n_aset.' dari aset '.$sumber.' dengan '.$n_mitra.' mulai tanggal '.$tangmul.' selama '.$bulan.' bulan';

        if ($v['resp']) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            $dt=$this->am->get_aset_umum('json');
            echo json_encode(['res'=>200,'data'=>$dt]);
        }
    }

    function set_tambah_pemb_bgh(){
        $id = $this->input->post('id',true);
        $jumlah = $this->input->post('jumlah',true);
        $cat = $this->input->post('cat',true);
        $tanggal = $this->input->post('tanggal',true);
        $tanggal = date('Y-m-d',strtotime($tanggal));
        $pen_b = $this->input->post('pen_b',true);
        $pen_m = $this->input->post('pen_m',true);
        $info = $this->input->post('info',true);
        $info = explode('|', $info);
        
        $v = $this->fm->set_pemb_bagi_hasil($id, $jumlah, $pen_b, $pen_m, $cat, $tanggal);
        $log_mesg = '[TAMBAH][PEMBAYARAN][BAGI HASIL]['.$v['id'].']['.$id.'] Menambah pembayaran hasil dari kerjasama bagi hasil penggunaan aset';
        if ($v['res']) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            if (isset($_POST['tambah_trans'])) {
                $ket_kas ='Pembayaran bagi hasil usaha dengan '.$info[1]. ' dari aset '.$info[0];
                $v1 = $this->fm->set_arus_kas('IN', $ket_kas, $pen_b, $tanggal, 'System', $v['id']);
                $log_mesg = '[TAMBAH][KEUANGAN][BAGI HASIL] ['.$v1['id'].']['.$v['id'].'] Menambah pemasukan dari kerjasama bagi hasil dengan '.$info[1].' dari aset '.$info[0];
                if ($v1['res']) {
                    $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
                }
            }
            echo 200;
        }
    }

    function del_pemb_bgh(){
        $id = $this->input->post('id',true);
        $id2 = $this->input->post('id2',true);
        $mitra = $this->input->post('mitra',true);
        $aset = $this->input->post('aset',true);

        $log_mesg = '[HAPUS][PEMBAYARAN][BAGI HASIL]['.$id.'] Menghapus pembayaran hasil dari dari kerjasama bagi hasil penggunaan aset dengan '.$mitra.' dari aset '.$aset;
        $v= $this->fm->del_pemb_bgh($id);
        if ($v) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            $v = $this->fm->del_keuangan($id);
            $log_mesg='[HAPUS][KEUANGAN][BAGI HASIL]['.$v['id'].']['.$id.'] Menghapus data keuangan dari penerimaan bagi hasil dengan '.$mitra.' dari aset '.$aset;
            if ($v['res']) {//log delete kas
                $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            }
            $res = $this->fm->get_detail_bagi_hasil($id2);
            $ret['jl'] = $res->jl;
            $ret['pnb'] = $res->pnb;
            $ret['res'] = 200;
            echo json_encode($ret);
        }else{
            echo json_encode(['res'=>100]);
        }
    }

    function edit_pemb_bgh(){

        $id = $this->input->post('id',true);
        $mitra = $this->input->post('mitra',true);
        $aset = $this->input->post('aset',true);
        $cat = $this->input->post('cat',true);
        $tanggal = $this->input->post('tanggal',true);
        $tanggal = date('Y-m-d',strtotime($tanggal));
        $jumlah = $this->input->post('jumlah',true);
        $pen_b = $this->input->post('pen_b',true);
        $pen_m = $this->input->post('pen_m',true);
        $log_mesg ='[EDIT][PEMBAYARAN BAGI HASIL]['.$id.'] Mengubah data pembayaran bagi hasil dari kerjasama dengan '.$mitra.' dari aset '.$aset;
        $resp = false;
        $v1 = $this->fm->edit_pemb_bgh($id, $cat, $tanggal, $pen_b, $pen_m, $jumlah);
        
        if ($v1) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            $resp=true;
        }

        if (waktu_data($id)&&isset($_POST['tambah_trans'])) {
            $ket_kas ='Pembayaran bagi hasil usaha dengan '.$mitra. ' dari aset '.$aset;
            $v = $this->fm->set_arus_kas('IN', $ket_kas, $pen_b, $tanggal, 'System', $id);
            if ($v['res']) {
                $log_mesg = '[TAMBAH][KEUANGAN][BAGI HASIL] ['.$v['id'].']['.$id.'] Menambah pemasukan dari kerjasama bagi hasil dengan '.$mitra.' dari aset '.$aset;
                $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
                $resp=true;
            }else{
                $v=$this->fm->edit_arus_kas($id, $pen_b, 'Debit', $tanggal, $ket_kas);
                if ($v['resp']) {
                    $log_mesg = '[EDIT][KEUANGAN][BAGI HASIL] ['.$v['id'].']['.$id.'] Mengubah data pemasukan dari kerjasama bagi hasil dengan '.$mitra.' dari aset '.$aset;
                    $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
                    $resp=true;
                }
            }
        }else if(waktu_data($id)&&!isset($_POST['tambah_trans'])){
            $v = $this->fm->del_keuangan($id);
            $log_mesg='[HAPUS][KEUANGAN][BAGI HASIL]['.$v['id'].']['.$id.'] Menghapus data keuangan dari penerimaan bagi hasil dengan '.$mitra.' dari aset '.$aset;
            if ($v['res']) {//log delete kas
                $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
                $resp=true;
            }
        }

        if ($resp) {
            echo 200;
        }
    }

    function set_arus_kas(){
        $jenis = $this->input->post('jenis',true);
        $ket = $this->input->post('ket',true);
        $jumlah = $this->input->post('jumlah',true);
        $tanggal = $this->input->post('tanggal',true);
        $tanggal = date('Y-m-d',strtotime($tanggal));
        $jenis2 = $jenis=='IN'?'Debit':'Kredit';
        $jenis3 = $jenis=='IN'?'Masuk':'Keluar';

        $v = $this->fm->set_arus_kas($jenis, $ket, $jumlah, $tanggal, 'User');

        if ($v['res']) {
            $log_mesg = '[TAMBAH][KEUANGAN]['.$v['id'].'] Menambah transaksi kas '.$jenis3.' ('.$jenis2.') sebesar Rp. '.$jumlah;
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            $s=$this->fm->get_saldo();
            $s = isset($s[0]->ac)?$s[0]->ac:0;
            echo json_encode(['resp'=>200,'b'=>$s]);
        }
    }

    function edit_arus_kas(){
        $ket = $this->input->post('ket',true);
        $id = $this->input->post('id',true);
        $jumlah = $this->input->post('jumlah',true);
        $jenis = $this->input->post('jenis',true);
        $tanggal = $this->input->post('tanggal',true);
        $tanggal = date('Y-m-d',strtotime($tanggal));
        $log_mesg = '[EDIT][KEUANGAN]['.$id.'] Perubahan keuangan pada transaksi '.$jenis.' sebesar Rp. '.$jumlah;
        if (waktu_data($id)) {
            $v = $this->fm->edit_arus_kas($id, $jumlah, $jenis, $tanggal, $ket, true);
        }else {
            $v['resp'] = false;
        }
        if ($v['resp']) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            $s=$this->fm->get_saldo();
            $s = isset($s[0]->ac)?$s[0]->ac:0;
            echo json_encode(['resp'=>200,'b'=>$s]);
        }

        // echo json_encode($_POST);
    }

    function edit_bagi_hasil(){
        $aset = $this->input->post('aset',true);
        $id = $this->input->post('id',true);
        $mitra = $this->input->post('mitra',true);
        $pb = $this->input->post('pb',true);
        $pm = $this->input->post('pm',true);
        $tanggal = $this->input->post('tanggal',true);
        $bulan = $this->input->post('bulan',true);
        $tangsel = date('Y-m-d',strtotime($tanggal.' +'.$bulan.' months'));

        $v = $this->fm->edit_bagi_hasil($id, $pb, $pm, $tangsel);
        $log_mesg = '[EDIT][BAGI HASIL]['.$id.'] Perubahan kerjasama bagi hasil '.$aset.' dengan '.$mitra. ' dengan pembagian BUMDes '.$pb.'% dan Mitra '.$pm.'% mulai dari tanggal '.$tanggal.' selama '.$bulan. ' bulan';
        if ($v) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo 200;
        }
    }

    //=============ada view
    function pdf_daftar_bagi_hasil(){
        $tahun = $this->input->get('tahun',true);
        $bulan = $this->input->get('bulan',true);
        $nb = isset($this->bulan[$bulan])?$this->bulan[$bulan]:'not valid';
        $r = $this->fm->daftar_kerjasama_bgh($tahun,0,0,0,0,'json');
        $row = $this->fm->get_total_bagi_hasil($tahun);
        $row = isset($row->hg)?$row->hg:0;
        // membuat halaman baru
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        $logo = base_url().'logo.jpeg';
        $this->PDF->Cell(30,30,$this->PDF->Image($logo, ($this->PDF->GetX()-1), $this->PDF->GetY()-12, 33.58),0);
        // mencetak string 
        $this->PDF->Cell(130,7,'DAFTAR BAGI HASIL ASET',0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(190,8,'BUMDES Indrakila Jaya',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $tanggal = date('d').' '.$this->bulan[date('m')].' '.date('Y');
        $this->PDF->Cell(190,7,$tanggal,0,1,'R');
        //Ambil data dari db
        $pby = $this->fm->get_total_bagi_hasil($tahun);
        $pbm = $this->fm->get_pemb_bagi_hasil_bulan($tahun, $bulan);
        $vt = $this->fm->get_info_aset_bgh($tahun, $bulan);
        $va = $this->fm->get_info_aset_bgh();

        $this->PDF->SetFont('Arial','B',8);
        $this->PDF->Cell(95,10,'Penerimaan bagi hasil BUMDes '.$nb.' '.$tahun,0,0);
        $this->PDF->Cell(95,10,'Penerimaan bagi hasil BUMDes tahun '.$tahun,0,1);
        $this->PDF->SetFont('Arial','',20);
        $this->PDF->Cell(95,10,isset($pbm->pnb)?'Rp. '.$pbm->pnb:'Rp. 0','R',0,'C');
        $this->PDF->Cell(95,10,isset($pby->pnb)?'Rp. '.$pby->pnb:'Rp. 0','L',1,'C');
        $this->PDF->Cell(10,2,'',0,1);

        $this->PDF->SetFont('Arial','B',8);
        $this->PDF->Cell(95,10,'Nilai bagi hasil '.$nb.' '.$tahun,0,0);
        $this->PDF->Cell(95,10,'Nilai bagi hasil tahun '.$tahun,0,1);
        $this->PDF->SetFont('Arial','',20);
        $this->PDF->Cell(95,10,isset($pbm->hg)?'Rp. '.$pbm->hg:'Rp. 0','R',0,'C');
        $this->PDF->Cell(95,10,isset($pby->hg)?'Rp. '.$pby->hg:'Rp. 0','L',1,'C');
        $this->PDF->Cell(10,2,'',0,1);

        $this->PDF->SetFont('Arial','B',8);
        $this->PDF->Cell(45,10,'Aset internal '.$nb.' '.$tahun,0,0);
        $this->PDF->Cell(55,10,'Aset eksternal '.$nb.' '.$tahun,0,0);
        $this->PDF->Cell(45,10,'Aset internal tahun '.$tahun,0,0);
        $this->PDF->Cell(50,10,'Aset eksternal tahun '.$tahun,0,1);
        $this->PDF->SetFont('Arial','',20);
        $this->PDF->Cell(45,10,$vt?$vt->jints:0,null,0,'C');
        $this->PDF->Cell(55,10,$vt?$vt->exts:0,'L',0,'C');
        $this->PDF->Cell(45,10,$va?$va->jints:0,'L',0,'C');
        $this->PDF->Cell(45,10,$va?$va->exts:0,'L',1,'C');
        $this->PDF->Cell(10,6,'',0,1);
        /*
        $this->PDF->SetFont('Arial','',12);
        $this->PDF->Cell(80,10,'Total pemasukan bagi hasil',0,1);
        $this->PDF->SetFont('Arial','B',20);
        $this->PDF->Cell(190,10,'Rp. '.$row,0,1,'C');
        $this->PDF->Cell(10,10,'',0,1);*/

        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Daftar bagi hasil',0,1);

        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(8,6,'No',1,0);
        $this->PDF->Cell(55,6,'Aset',1,0);
        $this->PDF->Cell(67,6,'Mitra',1,0);
        $this->PDF->Cell(30,6,'Tanggal mulai',1,0);
        $this->PDF->Cell(30,6,'Tanggal selesai',1,1);

        $this->PDF->SetFont('Arial','',9);     
        foreach ($r as $key => $v) {/*
            $this->PDF->Cell(15,6,($key+1),1,0);
            $this->PDF->Cell(130,6,$v->nm,1,0);
            $this->PDF->Cell(45,6,$v->hs,1,1);*/
            $this->PDF->Cell(8,6,($key+1),1,0);
            $this->PDF->Cell(55,6,$v->na,1,0);
            $this->PDF->Cell(67,6,$v->nm,1,0);
            $this->PDF->Cell(30,6,date('d-m-Y',strtotime($v->tm)),1,0);
            $this->PDF->Cell(30,6,date('d-m-Y',strtotime($v->ts)),1,1);
        }
        $this->PDF->Output('I','Daftar_kerjasama_bagi_hasil_'.$this->bulan[date('m')].'_'.$tahun.'.pdf');
    }

    //=============ada view
    function pdf_keuangan($type){
        $r=[];
        if ($type==1) {
            $tahun = $this->input->get('tahun',true);
            $bulan = $this->input->get('bulan',true);
            $minggu = $this->input->get('minggu',true);
            $title = 'MINGGU-AN';
            $tanggal = 'Minggu ke-'.$minggu.' '.$this->bulan[$bulan].' '.$tahun;
            $r = $this->fm->get_keuangan_mingguan($tahun,$bulan,$minggu,0,0,0,0,'JSON');
            $dk=$this->fm->get_kredit_debit_mingguan($tahun,$bulan,$minggu);
            $s=$this->fm->get_saldo();
            $ket='minggu-an_';
            $nb = $this->bulan[$bulan];
        }elseif ($type==2) {
            $tahun = $this->input->get('tahun',true);
            $bulan = $this->input->get('bulan',true);
            $title = 'BULAN-AN';
            $tanggal = $this->bulan[$bulan].' '.$tahun;
            $r = $this->fm->get_keuangan_bulanan($tahun,$bulan,0,0,0,0,'JSON');
            $dk=$this->fm->get_kredit_debit_bulanan($tahun,$bulan);
            $s=$this->fm->get_saldo();
            $ket='bulan-an_';
            $nb = $this->bulan[$bulan];
        }else {
            $tahun = $this->input->get('tahun',true);
            $title = 'TAHUN-AN';
            $tanggal = $tahun;
            $r = $this->fm->get_keuangan_tahunan($tahun,0,0,0,0,'JSON');
            $dk=$this->fm->get_kredit_debit_tahunan($tahun);
            $s=$this->fm->get_saldo();
            $ket='tahun-an';
            $nb = null;
        }
        // membuat halaman baru
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        $logo = base_url().'logo.jpeg';
        $this->PDF->Cell(30,30,$this->PDF->Image($logo, ($this->PDF->GetX()-1), $this->PDF->GetY()-12, 33.58),0);
        // mencetak string 
        $this->PDF->Cell(130,7,'LAPORAN KEUANGAN '.$title,0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(180,8,'BUMDES Indrakila Jaya',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(190,7,$tanggal,0,1,'R');
        
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(80,10,'Saldo',0,1);
        $this->PDF->SetFont('Arial','',20);
        $this->PDF->Cell(190,10,isset($s[0])?'Rp. '.$s[0]->ac:0,0,1,'C');

        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(95,10,'Debit',0,0);
        $this->PDF->Cell(95,10,'Kredit',0,1);
        $this->PDF->SetFont('Arial','',20);
        $this->PDF->Cell(95,10,isset($dk[0])?'Rp. '.$dk[0]->dbt:0,'R',0,'C');
        $this->PDF->Cell(95,10,isset($dk[0])?'Rp. '.$dk[0]->kdt:0,'L',1,'C');
        $this->PDF->Cell(10,10,'',0,1);

        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Rincian keuangan',0,1);

        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(8,6,'No',1,0);
        $this->PDF->Cell(20,6,'Tanggal',1,0);
        $this->PDF->Cell(78,6,'Keterangan',1,0);
        $this->PDF->Cell(30,6,'Debit',1,0);
        $this->PDF->Cell(30,6,'Kredit',1,0);
        $this->PDF->Cell(30,6,'Saldo',1,1);

        $this->PDF->SetFont('Arial','',9);     
        foreach ($r as $key => $v) {
            $lebar_sel = 78;
            $tinggi_sel=6;
            if ($this->PDF->GetStringWidth($v->nt)<$lebar_sel) {
                $line=1;
            }else {
                $text_l = strlen($v->nt);
                $er_marg = 2;
                $startChar = 0;
                $max_char = 0;
                $text_arr=[];
                $tmp_string=null;
                while($startChar < $text_l){
                    while($this->PDF->GetStringWidth($tmp_string) < ($lebar_sel-$er_marg)&&($startChar+$max_char)<$text_l){
                        $max_char++;
                        $tmp_string=substr($v->nt, $startChar,$max_char);
                    }
                    $startChar=$startChar+$max_char;
                    array_push($text_arr,$tmp_string);
                    $max_char=0;
                    $tmp_string=null;
                }
                $line=count($text_arr);
            }
            $this->PDF->Cell(8,($line * $tinggi_sel),($key+1),1,0);
            $this->PDF->Cell(20,($line * $tinggi_sel),date('d/m/Y',strtotime($v->dt)),1,0);
            $xPos=$this->PDF->GetX();
            $yPos=$this->PDF->GetY();
            $this->PDF->MultiCell($lebar_sel,$tinggi_sel,$v->nt,1);
            $this->PDF->SetXY($xPos+$lebar_sel,$yPos);
            $this->PDF->Cell(30,($line * $tinggi_sel),isset($v->db)?'Rp. '.$v->db:null,1,0);
            $this->PDF->Cell(30,($line * $tinggi_sel),isset($v->kd)?'Rp. '.$v->kd:null,1,0);
            $this->PDF->Cell(30,($line * $tinggi_sel),'Rp. '.$v->bc,1,1);
        }
        
        $this->PDF->Output('I','Daftar_transaksi_'.$ket.$nb.'_'.$tahun.'.pdf');
    }

    //=============ada view
    function pdf_laporan_laba(){
        $tahun = $this->input->get('tahun',true);
        $bulan = $this->input->get('bulan',true);
        $nb = isset($this->bulan[$bulan])?$this->bulan[$bulan]:'bulan not-valid';
        $v2=$this->tm->get_jual_profits_tahun($tahun);
        $v3=$this->tm->get_jual_profits_bulan($tahun, $bulan);
        $r = $this->fm->get_laba_usaha($tahun,$bulan,0,0,0,0,'JSON');
        // membuat halaman baru
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        $logo = base_url().'logo.jpeg';
        $this->PDF->Cell(30,30,$this->PDF->Image($logo, ($this->PDF->GetX()-1), $this->PDF->GetY()-12, 33.58),0);
        // mencetak string 
        $this->PDF->Cell(130,7,'LAPORAN LABA DAGANG PERUSAHAAN',0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(180,8,'BUMDES Indrakila Jaya',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $tanggal = date('d').' '.$this->bulan[date('m')].' '.date('Y');
        $this->PDF->Cell(190,7,$tanggal,0,1,'R');

        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','B',10);
        $this->PDF->Cell(95,10,'Penjualan '.$nb.' '.$tahun,0,0);
        $this->PDF->Cell(95,10,'Keuntungan '.$nb.' '.$tahun,0,1);
        $this->PDF->SetFont('Arial','',20);
        $this->PDF->Cell(95,10,isset($v3->jl)?'Rp. '.$v3->jl:'Rp. 0','R',0,'C');
        $this->PDF->Cell(95,10,isset($v3->pf)?'Rp. '.$v3->pf:'Rp. 0','L',1,'C');
        $this->PDF->Cell(10,2,'',0,1);

        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','B',10);
        $this->PDF->Cell(95,10,'Penjualan tahun '.$tahun,0,0);
        $this->PDF->Cell(95,10,'Keuntungan tahun '.$tahun,0,1);
        $this->PDF->SetFont('Arial','',20);
        $this->PDF->Cell(95,10,isset($v2->jl)?'Rp. '.$v2->jl:'Rp. 0','R',0,'C');
        $this->PDF->Cell(95,10,isset($v2->pf)?'Rp. '.$v2->pf:'Rp. 0','L',1,'C');
        $this->PDF->Cell(10,10,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Rincian keuangan',0,1);

        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(10,6,'No',1,0);
        $this->PDF->Cell(60,6,'Komoditas',1,0);
        $this->PDF->Cell(30,6,'Penjualan',1,0);
        $this->PDF->Cell(30,6,'Harga',1,0);
        $this->PDF->Cell(30,6,'Terjual',1,0);
        $this->PDF->Cell(30,6,'Keuntungan',1,1);

        $this->PDF->SetFont('Arial','',9);     
        foreach ($r as $key => $v) {
            $this->PDF->Cell(10,6,($key+1),1,0);
            $this->PDF->Cell(60,6,$v->nk,1,0);
            $this->PDF->Cell(30,6,$v->ot,1,0);
            $this->PDF->Cell(30,6,'Rp. '.$v->pl,1,0);
            $this->PDF->Cell(30,6,'Rp. '.$v->sl,1,0);
            $this->PDF->Cell(30,6,'Rp. '.$v->pf,1,1);
        }
        
        $this->PDF->Output('I','Daftar_barang_'.date('d_m_Y').'.pdf');
    }

    function pdf_bagi_hasil_usaha(){
        $id = $this->input->get('id',true);
        $tahun = $this->input->get('tahun',true);
        $bulan = $this->input->get('bulan',true);
        $r = $this->fm->daftar_kerjasama_bgh($tahun,0,0,0,0,'json');
        $row = $this->fm->get_total_bagi_hasil($tahun);
        $row = isset($row->hg)?$row->hg:0;
        // membuat halaman baru
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        $logo = base_url().'logo.jpeg';
        $this->PDF->Cell(30,30,$this->PDF->Image($logo, ($this->PDF->GetX()-1), $this->PDF->GetY()-12, 33.58),0);
        // mencetak string 
        $this->PDF->Cell(130,7,'BAGI HASIL USAHA BUMDES',0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(190,8,'BUMDES Indrakila Jaya',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $tanggal = date('d').' '.$this->bulan[date('m')].' '.date('Y');
        $this->PDF->Cell(190,7,$tanggal,0,1,'R');
        //Ambil data dari db
        $v = $this->fm->detail_bagi_hasil_usaha($id);
        // echo json_encode($v);
        $this->PDF->SetFont('Arial','B',15);
        $this->PDF->Cell(95,10,'Tahun : ',0,0);
        $this->PDF->Cell(95,10,'Jumlah : ',0,1);
        $this->PDF->SetFont('Arial','',20);
        $this->PDF->Cell(95,10,isset($v->thn)?$v->thn:'not valid','R',0,'C');
        $this->PDF->Cell(95,10,isset($v->jlh)?'Rp. '.$v->jlh:'Rp. 0','L',1,'C');
        $this->PDF->Cell(10,2,'',0,1);
        
        $this->PDF->SetFont('Arial','B',15);
        $this->PDF->Cell(190,10,'Catatan : ',0,1);
        $this->PDF->SetFont('Arial','',10);
        $this->PDF->MultiCell(190,5,isset($v->cat)?$v->cat:null,0);
        $this->PDF->Cell(10,5,'',0,1);

        $r =$this->fm->detail_entitas_bagi_usaha($id,'json');
        // echo json_encode($r);
        $this->PDF->SetFont('Arial','B',15);
        $this->PDF->Cell(10,10,'Penerima bagi hasil',0,1);

        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(15,6,'No',1,0);
        $this->PDF->Cell(85,6,'Tujuan',1,0);
        $this->PDF->Cell(45,6,'Persentase',1,0);
        $this->PDF->Cell(45,6,'Nilai',1,1);

        $this->PDF->SetFont('Arial','',9);     
        foreach ($r as $key => $v) {
            $this->PDF->Cell(15,6,($key+1),1,0);
            $this->PDF->Cell(85,6,$v->ent,1,0);
            $this->PDF->Cell(45,6,$v->prs.'%',1,0);
            $this->PDF->Cell(45,6,'Rp. '.$v->nil,1,1);
        }
        $this->PDF->Output('I','Daftar_kerjasama_bagi_hasil_'.$this->bulan[date('m')].'_'.$tahun.'.pdf');
    }

    function hapus_keuangan($tp){
        $id = $this->input->post('id',true);

        $v = $id?$this->fm->del_keuangan($id):false;

        if ($v['res']) {
            $log_mesg = '[HAPUS][KEUANGAN]['.$v['id'].'] Menghapus transaksi keuangan';
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            if ($tp=='mng') {
                $minggu = $this->input->post('minggu',true);
                $bulan = $this->input->post('bulan',true);
                $tahun = $this->input->post('tahun',true);
                $d=$this->fm->get_kredit_debit_mingguan($tahun,$bulan,$minggu);
                $dk['d']= isset($d[0])? $d[0]->dbt:0;
                $dk['k']= isset($d[0])? $d[0]->kdt:0;
                $g=$this->fm->get_grafik_keuangan_mingguan($tahun,$bulan);
            }elseif ($tp='bln') {
                $bulan = $this->input->post('bulan',true);
                $tahun = $this->input->post('tahun',true);
                $d=$this->fm->get_kredit_debit_bulanan($tahun,$bulan);
                $dk['d']= isset($d[0])? $d[0]->dbt:0;
                $dk['k']= isset($d[0])? $d[0]->kdt:0;
                $g=$this->fm->get_grafik_keuangan_bulanan($tahun);
            }else {
                $tahun = $this->input->post('tahun',true);
                $d=$this->fm->get_kredit_debit_tahunan($tahun);
                $dk['d']= isset($d[0])? $d[0]->dbt:0;
                $dk['k']= isset($d[0])? $d[0]->kdt:0;
                $g=$this->fm->get_grafik_keuangan_tahunan();
            }
            $s=$this->fm->get_saldo();
            $s = isset($s[0])? $s[0]->ac:0;
            $g = json_decode($g);
            echo json_encode(['res'=>200,'saldo'=>$s,'dk'=>$dk,'grafik'=>$g]);
            // echo $v;
        }else{
            echo json_encode(['res'=>100]);
        }
    }
    
    function hapus_bagi_hasil(){
        $id = $this->input->post('id',true);

        $v = $this->fm->del_bagi_hasil($id);
        if ($v['res']) {
            $log_mesg = '['.$v['log'].'][BAGI HASIL]['.$id.'] '.$v['mesg'].' kerjasama bagi hasil';
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo json_encode(['res'=>200,'stat'=>$v['log']]);
        }else{
            echo json_encode(['res'=>100]);
        }
    }

    function set_bagi_dividen(){
        $tahun = $this->input->post('tahun',true);
        $nilai = $this->input->post('nilai',true);
        $entitas = $this->input->post('entitas',true);
        $jumlah = $this->input->post('jumlah',true);
        $cat = $this->input->post('cat',true);

        $v = $this->fm->set_bagi_hasil_usaha($tahun, $nilai, $entitas, $jumlah, $cat);
        /*
        if ($v['resp']&&isset($_POST['potong_saldo'])) {
            $pesan = 'Kas keluar untuk pembagian bagi hasil usaha tahun '.$tahun;
            $v1=$this->fm->set_arus_kas('OUT', $pesan, $nilai, date('Y-m-d'), 'System', $v['id']);
            if ($v1['res']) {
                $log_mesg = '[TAMBAH][KEUANGAN][BAGI HASIL USAHA]['.$v['id'].'] kas keluar untuk bagi hasil tahunan tahun '.$tahun;
                $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            }
        }
        */
        if ($v['resp']) {
            $log_mesg = '[TAMBAH][BAGI HASIL USAHA]['.$v['id'].'] Menambah bagi hasil usaha tahunan tahun '.$tahun.' untuk sebanyak '.count($entitas).' entitas';
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo 200;
        }

        // echo json_encode($entitas);
    }
    
    function detail_bagi_dividen($id){
        $dt['title'] = 'Detail bagi hasil usaha';
        $dt['tanggal'] = date('d/m/Y');
        $dt['v'] = $this->fm->detail_bagi_hasil_usaha($id);
        $dt['tahun_dividen'] = 2020;
        $dt['id']=$id;
        $dt['tabel_ent'] = $this->fm->detail_entitas_bagi_usaha($id);
        $this->load->view('MenuPage/Detail_Print/detail_bagi_dividen',$dt);
        // echo json_encode($dt['v']);
    }

    function edit_bagi_hasil_div(){
        $tahun = $this->input->post('tahun',true);
        $id = $this->input->post('id',true);
        $nilai = $this->input->post('nilai',true);
        $ent = $this->input->post('entitas',true);
        $juml = $this->input->post('jumlah',true);
        $cat = $this->input->post('cat',true);
        $cat = $cat?$cat:null;

        $this->fm->edit_bagi_dividen($id, $tahun, $nilai, $cat);
        $this->fm->del_edit_ent_dividen($id);
        $this->fm->edit_ent_dividen($id, $ent, $juml);

        $log_mesg = '[EDIT][BAGI HASIL USAHA]['.$id.'] Perubahan bagi hasil usaha tahun '.$tahun.' dengan '.count($ent).' penerima, dengan nilai Rp. '.$nilai;
        $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
        echo 200;

    }

    function hapus_bagi_dividen_g(){
        $id = $this->input->post('id',true);
        $tahun =  $this->input->post('nm',true);
        $log_mesg='[HAPUS][BAGI HASIL USAHA]['.$id.'] Menghapus pembagian hasil usaha tahun '.$tahun;
        $v = $this->fm->del_bagi_dividen_g($id);
        if ($v) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));/*
            $v=$this->fm->del_keuangan($id);
            if ($v['res']) {
                $log_mesg = '[HAPUS][KEUANGAN][BAGI HASIL USAHA]['.$v['id'].']['.$id.'] Menghapus pembayaran bagi hasil usaha tahun '.$tahun;
                $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            }*/
            echo 200;
        }
    }

    function hapus_pembayaran(){
        $id=$this->input->post('id',true);
        $ent = $this->input->post('ent',true);
        $thn = $this->input->post('nm',true);
        $log_mesg = '[BATAL][BAGI HASIL USAHA] Pembatalan pembayaran bagi hasil usaha tahun '.$thn.' untuk '.$ent;
        $v = $this->fm->del_bayar_dividen($id);
        if ($v) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            $v = $this->fm->del_keuangan($id);
            if ($v['res']) {
                $log_mesg = '[HAPUS][KEUANGAN]['.$v['id'].']['.$id.'] Menghapus pembayaran bagi hasil usaha';
                $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            }
            echo 200;
        }
        // echo $log_mesg;
    }

    function set_pembayaran_ent_bhu(){
        $id = $this->input->post('id',true);
        $idm = $this->input->post('idm',true);
        $ent =  $this->input->post('nm',true);
        $fin = $this->input->post('fin',true);
        $hg = $this->input->post('hg',true);
        $hg = str_replace(['Rp. ',','],null,$hg);
        $log_mesg = '[TAMBAH][PEMBAYARAN][BAGI HASIL USAHA]['.$id.'] Menambah pembayaran bagi hasil usaha untuk '.$ent;
        $pesan ='['.$id.'] Pembayaran bagi hasil usaha untuk '.$ent;
        $v = $this->fm->set_bayar_dividen($id);

        if ($v) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            if ($fin==1) {
                $v=$this->fm->set_arus_kas('OUT', $pesan, $hg, date('Y-m-d'), 'System', $id);
                $log_mesg = '[TAMBAH][KEUANGAN][KELUAR]['.$v['id'].'] Menambah pembayaran bagi hasil usaha untuk '.$ent;
                if ($v['res']) {
                    $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
                }
            }
            echo 200;
        }
    }

    function cek_jadwal_bgh(){
        $id = $this->input->post('aset',true);
        $tm = $this->input->post('tanggal',true);
        $tm = date('Y-m-d',strtotime($tm));
        $ts = $this->input->post('bulan');
        $ts = date('Y-m-d',strtotime($tm.' + '.$ts.' months'));

        $dt = $this->fm->cek_jadwal_bgh($id, $tm, $ts);
        echo $dt;
    }
    
    function cek_edit_jadwal_bgh(){
        $id = $this->input->post('id',true);
        $ids = $this->input->post('ids',true);
        $tm = $this->input->post('tanggal',true);
        $tm = date('Y-m-d',strtotime($tm));
        $ts = $this->input->post('bulan');
        $ts = date('Y-m-d',strtotime($tm.' + '.$ts.' months'));

        $dt = $this->fm->cek_jadwal_bgh($ids, $tm, $ts, $id);
        echo $dt;
        // echo json_encode($_POST);
    }
}
