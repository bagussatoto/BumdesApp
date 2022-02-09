<?php

require_once APPPATH.'..\asset\fpdf\fpdf.php';
class Trade extends CI_Controller{
    function __construct(){
        parent:: __construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->bulan = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
        $this->PDF = new FPDF();
        $this->waktu = date('Y-m-d H:i:s');
        if (!$this->ses->log_s||$this->ses->tp!='MNG') {
			redirect(base_url());
        }
    }

    function barang_keluar(){//=================OK
        $dt['title'] = 'Barang keluar';
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
        $dt['thn'] = $this->lm->get_tahun('OUT');
        $dt['v'] = $this->tm->get_total_penjualan($dt['tahun'],$dt['bulan']);
        $dt['value']=$this->lm->get_info_barang_keluar($dt['tahun'],$dt['bulan'], $dt['lim'], $offset, $ajax, $no_pagin);
        
        if (!$ajax) {
            $this->load->view('MenuPage/Main/exit_item',$dt);
        }else{
            $val['ses']='Ok';
            $val['tabel']=$dt['value'];
            $val['row']=isset($dt['v']->hg)?$dt['v']->hg:0;
            echo json_encode($val);
        }
    }

    function distribution(){//=================OK
        $dt['title'] = 'Distribusi barang';
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
        $dt['thn'] = $this->tm->get_tahun();
        $dt['v'] = $this->tm->get_total_penjualan($dt['tahun'],$dt['bulan'],true);
        $dt['value']=$this->tm->get_info_distribusi($dt['tahun'],$dt['bulan'], $dt['lim'], $offset, $ajax, $no_pagin);
        $dt['v_grafik']=$this->fm->get_grafik_nilai_distribusi($dt['tahun']);
        $dt['v_grafik2']=$this->fm->get_grafik_nilai_non_distribusi($dt['tahun']);
        
        if (!$ajax) {
            $this->load->view('MenuPage/Main/distribution',$dt);
        }else{
            $val['ses']='Ok';
            $val['tabel']=$dt['value'];
            $val['row']=isset($dt['v']->hg)?$dt['v']->hg:0;
            $val['grafik']=json_decode($dt['v_grafik']);
            $val['grafik2']=json_decode($dt['v_grafik2']);
            $val['tahun'] = $dt['tahun'];
            echo json_encode($val);
        }
    }

    function form_barang_keluar(){//=============ada view
        $dt['title'] = '';
        $dt['tanggal'] = date('d/m/Y');
        $dt['v']=$this->lm->get_komoditas('JSON');
        $dt['v2'] = $this->am->get_rekanan('json');
        $this->load->view('MenuPage/Form/tambah_barang_keluar',$dt);
    }

    function set_barang_keluar(){
        $nama = $this->input->post('komoditas',TRUE);
        $n_kom = $this->input->post('n_kom',TRUE);
        $n_sat = $this->input->post('n_sat',TRUE);
        $n_mit = $this->input->post('n_mit',TRUE);
        $jumlah = $this->input->post('jumlah',TRUE);
        $tujuan = $this->input->post('tujuan',TRUE);
        $mitra = $this->input->post('mitra',TRUE);
        $harga = $this->input->post('nilai',TRUE);
        $harga = $harga?$harga:null;
        $sat = $this->input->post('sat',TRUE);
        $tanggal = $this->input->post('tanggal',TRUE);
        $tanggal = date('Y-m-d',strtotime($tanggal));
        $catatan = $this->input->post('cat',TRUE);
        $mesg =  $tujuan=='Distribusi'?' kepada '.$n_mit:null;
        $pesan = 'Penerimaan dari penjualan '.$n_kom.' sebanyak '.$jumlah.' '.$n_sat.' untuk tujuan '.$tujuan  .$mesg;

        
        $v = $this->tm->tambah_distribusi($nama, $jumlah, $tujuan, $mitra, $sat, $harga, $tanggal, $catatan);
        if ($v['stat']&&$harga&&isset($_POST['tambah_trans'])) {
            $v1=$this->fm->set_arus_kas('IN', $pesan, $harga, date('Y-m-d',strtotime($tanggal)), 'System', $v['id']);
            if ($v1['res']) {
                $log_mes = '[TAMBAH][KEUANGAN][STOK KELUAR]['.$v1['id'].']['.$v['id'].'] Menambah arus kas masuk (Debit) untuk penjualan '.$n_kom.' sebanyak '.$jumlah.' '.$n_sat;
                $this->hr->log_admin($this->ses->nu, $log_mes, date('Y-m-d'), date('H:i:s'));
            }
        }
        if ($v['stat']) {
            $log_mesg = '[TAMBAH][STOK KELUAR]['.$v['id'].'] Stok '.$n_kom.' keluar sebanyak '.$jumlah.' '.$n_sat.' untuk '.$tujuan.$mesg;
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            $dt = $this->lm->get_komoditas('JSON');
            echo json_encode(['resp'=>200,'data'=>$dt]);
        }else{
            echo json_encode(['resp'=>100]);
        }
        
        // echo json_encode($_POST);
    }

    function form_edit_barang_keluar_gudang($id){//=============ada view
        $dt['title'] = '';
        $dt['tanggal'] = date('d/m/Y');
        $dt['v'] = $this->tm->get_edit_stok_keluar($id);
        $dt['sk'] = $this->lm->get_stok_komoditas(isset($dt['v']->idk)?$dt['v']->idk:0);
        $dt['v2'] = $this->am->get_rekanan('JSON');
        // echo json_encode($dt['sk']);
        $this->load->view('MenuPage/Form/edit_barang_keluar_gudang',$dt);
    }

    function edit_barang_keluar(){
        $n_kom = $this->input->post('nama',TRUE);
        $id = $this->input->post('id',TRUE);
        $jn = $this->input->post('tujuan',TRUE);
        $mt = $this->input->post('mitra',TRUE);
        $mt = $mt?$mt:null;
        $jl = $this->input->post('jumlah',TRUE);
        $st = $this->input->post('satuan',TRUE);
        $nl = $this->input->post('nilai',TRUE);
        $nl = $nl?$nl:null;
        $ck = $this->input->post('potong_saldo',TRUE);
        $tg = $this->input->post('tanggal',TRUE);
        $tg = date('Y-m-d',strtotime($tg));
        $ct = $this->input->post('catatan',TRUE);
        $n_mit = $this->input->post('n_mit',TRUE);

        //$mesg =  $tujuan=='Distribusi'?' kepada '.$n_mit:null;
        $ext = $jn=='Distribusi'?$jn.' kepada '.$n_mit:'Non-distribusi';
        $log_mesg = '[EDIT][STOK KELUAR]['.$id.'] Perubahan data '.$n_kom.' keluar/distribusi sebanyak '.$jl.' '.$st;

        $resp=false;

        $v = $this->tm->edit_stok_keluar($id,$jl, $tg, $jn, $ct, $mt, $nl);
        if ($v) {//perubahan data stok
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            $resp =true;
        }

        if ($ck) {//perubahan data keuangan
            $ket_kas = 'Penerimaan dari penjualan '.$n_kom.' sebanyak '.$jl.' '.$st.' untuk tujuan '.$ext;
            $v = $this->fm->set_arus_kas('IN', $ket_kas, $nl, $tg, 'System', $id);
            if ($v['res']) {
                $log_mesg='[TAMBAH][KEUANGAN][STOK KELUAR]['.$v['id'].']['.$id.'] Menambah catatan keuangan dari penjualan '.$n_kom.' sebanyak '.$jl.' '.$st.' untuk '.$ext;
                $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
                $resp = true;
            }else{
                $v=$this->fm->edit_arus_kas($id, $nl, 'Debit', $tg, $ket_kas);
                if ($v['resp']) {
                    $log_mesg='[EDIT][KEUANGAN][STOK KELUAR]['.$v['id'].']['.$id.'] Perubahan catatan keuangan dari penjualan '.$n_kom.' sebanyak '.$jl.' '.$st.' untuk '.$ext;
                    $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
                    $resp = true;
                }
            }
        }else {//perubahan data keuangan
            $v = $this->fm->del_keuangan($id);
            $log_mesg='[HAPUS][KEUANGAN][STOK KELUAR]['.$id.']['.$id.'] Menghapus data keuangan dari penjualan '.$n_kom.' sebanyak '.$jl.' '.$st;
            if ($v['res']) {//log delete kas
                $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
                $resp=true;
            }
        }

        if ($resp) {
            echo 200;
            // echo json_encode($_POST);
        }
    }

    function pdf_detail_komoditas_keluar($id){
        $v = $this->lm->get_detail_komoditas($id);
        $r= $this->lm->get_detail_komoditas_keluar($id,'json');($id);
        // $r = $this->lm->get_komoditas('JSON');
        // membuat halaman baru
        // echo '<title>Belanja barang</title>';
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        // mencetak string 
        $this->PDF->Cell(190,7,'INFORMASI KOMODITAS '.strtoupper(isset($v[0])?$v[0]->nk:'-'),0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(190,7,'BUMDES Pujotirto',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(190,7,date('d/m/Y'),0,1,'R');
        
        
        $this->PDF->Cell(190,10,'',0,1);

        $this->PDF->Cell(30,7,'Komoditas :',0,0);
        $this->PDF->Cell(50,7,isset($v[0])?$v[0]->nk:'-',0,0);
        $this->PDF->Cell(40,7,'',0,0);
        $this->PDF->Cell(30,7,'Harga jual :',0,0);
        $this->PDF->Cell(50,7,isset($v[0])?$v[0]->hj:'-',0,1);

        $this->PDF->Cell(190,5,'',0,1);

        $this->PDF->Cell(30,7,'Stok           :',0,0);
        $this->PDF->Cell(50,7,isset($v[0])?$v[0]->sk:'-',0,0);
        $this->PDF->Cell(40,7,'',0,0);
        $this->PDF->Cell(30,7,'Harga beli :',0,0);
        $this->PDF->Cell(50,7,isset($v[0])?$v[0]->hb:'-',0,1);

        
        $this->PDF->Cell(190,10,'',0,1);
        
        /*
        $this->PDF->SetFont('Arial','',12);
        $this->PDF->Cell(80,10,'Total nilai barang keluar',0,1);
        $this->PDF->SetFont('Arial','B',20);
        $this->PDF->Cell(190,10,'Rp. 400,000',0,1,'C');
        $this->PDF->Cell(10,10,'',0,1);*/
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Historis telur masuk',0,1);

        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(10,6,'No',1,0);
        $this->PDF->Cell(20,6,'Tanggal',1,0,'C');
        $this->PDF->Cell(81,6,'Jenis',1,0,'C');
        $this->PDF->Cell(18,6,'Jumlah',1,0,'C');
        $this->PDF->Cell(23,6,'Nilai',1,0,'C');
        $this->PDF->Cell(23,6,'Untung',1,0,'C');
        $this->PDF->Cell(15,6,'Stok',1,1,'C');
        $this->PDF->SetFont('Arial','',9);
        
        foreach ($r as $key => $v) {
            $this->PDF->Cell(10,6,($key+1),1,0,'C');
            $this->PDF->Cell(20,6,date('d/m/Y',strtotime($v->tg)),1,0);
            $this->PDF->Cell(81,6,$v->ct,1,0);
            $this->PDF->Cell(18,6,$v->jl,1,0);
            $this->PDF->Cell(23,6,'Rp. '.$v->nl,1,0);
            $this->PDF->Cell(23,6,'Rp. '.$v->kn,1,0);
            $this->PDF->Cell(15,6,$v->stk,1,1);
        }
        $this->PDF->Output('I','Daftar_barang_'.date('d_m_Y').'.pdf');
    }
        //=============ada view
    function pdf_barang_keluar(){
        $tahun = $this->input->get('tahun');
        $bulan = $this->input->get('bulan');
        $inf_dist=$this->tm->get_total_penjualan($tahun,$bulan);
        $inf_dist= isset($inf_dist->hg)?$inf_dist->hg:0;
        // tm->get_total_penjualan
        $r = $this->lm->get_info_barang_keluar($tahun,$bulan,0,0,0,0,'JSON');
        // membuat halaman baru
        // echo '<title>Belanja barang</title>';
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        $logo = base_url().'logo.jpeg';
        $this->PDF->Cell(30,30,$this->PDF->Image($logo, ($this->PDF->GetX()-1), $this->PDF->GetY()-12, 33.58),0);
        // mencetak string 
        $this->PDF->Cell(128,7,'LAPORAN BARANG KELUAR',0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(180,8,'BUMDES Indrakila Jaya',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(190,7,$this->bulan[$bulan].' | '.$tahun,0,1,'R');
        $this->PDF->SetFont('Arial','',12);
        $this->PDF->Cell(80,10,'Total nilai barang keluar',0,1);
        $this->PDF->SetFont('Arial','B',20);
        $this->PDF->Cell(190,10,'Rp. '.$inf_dist,0,1,'C');
        $this->PDF->Cell(10,10,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Daftar barang',0,1);
        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(20,6,'No',1,0);
        $this->PDF->Cell(50,6,'Komoditas',1,0);
        $this->PDF->Cell(30,6,'Tanggal',1,0);
        $this->PDF->Cell(30,6,'Jumlah',1,0);
        $this->PDF->Cell(30,6,'Keperluan',1,0);
        $this->PDF->Cell(30,6,'Sisa stok',1,1);
        $this->PDF->SetFont('Arial','',9);
        
        foreach ($r as $key => $v) {
            $this->PDF->Cell(20,6,($key+1),1,0);
            $this->PDF->Cell(50,6,$v->kom,1,0);
            $this->PDF->Cell(30,6,date('d/m/Y',strtotime($v->tgl)),1,0);
            $this->PDF->Cell(30,6,$v->jlh,1,0);
            $this->PDF->Cell(30,6,$v->tjn,1,0);
            $this->PDF->Cell(30,6,$v->stk,1,1);
        }
        $this->PDF->Output('I','Barang_keluar_'.$this->bulan[$bulan].'_'.$tahun.'.pdf');
    }

    //=============ada view
    function pdf_distribusi_barang(){
        $tahun = $this->input->get('tahun');
        $bulan = $this->input->get('bulan');
        $inf_dist=$this->tm->get_total_penjualan($tahun,$bulan,true);
        $inf_dist= isset($inf_dist->hg)?$inf_dist->hg:0;
        
        $r = $this->tm->get_info_distribusi($tahun,$bulan,0,0,0,0,'JSON');
        // membuat halaman baru
        // echo '<title>Belanja barang</title>';
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        $logo = base_url().'logo.jpeg';
        $this->PDF->Cell(30,30,$this->PDF->Image($logo, ($this->PDF->GetX()-1), $this->PDF->GetY()-12, 33.58),0);
        // mencetak string 
        $this->PDF->Cell(130,7,'LAPORAN DISTRIBUSI BARANG',0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(180,8,'BUMDES Indrakila Jaya',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(190,7,$this->bulan[$bulan].' | '.$tahun,0,1,'R');
        $this->PDF->SetFont('Arial','',12);
        $this->PDF->Cell(80,10,'Total nilai barang keluar',0,1);
        $this->PDF->SetFont('Arial','B',20);
        $this->PDF->Cell(190,10,'Rp. '.$inf_dist,0,1,'C');
        $this->PDF->Cell(10,10,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Daftar barang keluar',0,1);
        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(10,6,'No',1,0);
        $this->PDF->Cell(20,6,'Tanggal',1,0);
        $this->PDF->Cell(85,6,'Mitra',1,0);
        $this->PDF->Cell(25,6,'Komoditas',1,0);
        $this->PDF->Cell(20,6,'Jumlah',1,0);
        $this->PDF->Cell(30,6,'Nilai',1,1);
        $this->PDF->SetFont('Arial','',9);
        
        foreach ($r as $key => $v) {
            $this->PDF->Cell(10,6,($key+1),1,0);
            $this->PDF->Cell(20,6,date('d/m/Y',strtotime($v->tgl)),1,0);
            $this->PDF->Cell(85,6,$v->tjn,1,0);
            $this->PDF->Cell(25,6,$v->kom,1,0);
            $this->PDF->Cell(20,6,$v->jlh,1,0);
            $this->PDF->Cell(30,6,'Rp. '.$v->ntr,1,1);
        }
        $this->PDF->Output('I','Distribusi_barang_'.$this->bulan[$bulan].'_'.$tahun.'.pdf');
    }
    
}
