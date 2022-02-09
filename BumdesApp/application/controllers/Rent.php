<?php

require_once APPPATH.'..\asset\fpdf\fpdf.php';
class Rent extends CI_Controller{

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

    function rentalling($type='html'){//=================OK
        $dt['title'] = 'Laporan penyewaan';
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
        $dt['thn'] = $this->rm->get_tahun();
        $dt['v'] = $this->rm->get_jumlah_penyewaan($dt['tahun'], $dt['bulan']);
        $dt['v2'] = $this->rm->get_pendapatan_sewa($dt['tahun'], $dt['bulan']);
        $dt['value']=$this->rm->get_penyewaan($dt['tahun'],$dt['bulan'], $dt['lim'], $offset, $ajax, $no_pagin);
        $dt['v_grafik']=$this->fm->get_grafik_penyewaan($dt['tahun']);
        if (!$ajax) {
            $this->load->view('MenuPage/Main/penyewaan',$dt);
        }else{
            $val['ses']='Ok';
            $val['tabel']=$dt['value'];
            $val['grafik'] = json_decode($dt['v_grafik']);
            $val['tahun']=$dt['tahun'];
            $val['jpn'] = isset($dt['v'])?$dt['v']->tp:0;
            $val['tps'] = isset($dt['v2'])?$dt['v2']->tps:0;
            echo json_encode($val);
        }
    }

    function rent_price(){//=================OK
        $dt['title']='Daftar harga sewa';
        $dt['tanggal']=date('d/m/Y');
        $dt['value']=$this->rm->get_list_harga_sewa();
        $this->load->view('MenuPage/Main/rent_price',$dt);
        // echo json_encode($dt['value']);
    }

    function form_tambah_jadwal(){//=============ada view
        $dt['title']='Daftar harga sewa';
        $dt['v']=$this->am->get_aset_disewakan('json');
        $this->load->view('MenuPage/Form/tambah_jadwal',$dt);
    }

    function form_tambah_aset_sewa(){//=============ada view
        $dt['title']='Daftar harga sewa';
        $dt['v']=$this->am->get_aset_umum('json');
        $this->load->view('MenuPage/Form/tambah_aset_sewa',$dt);
        // echo json_encode($dt['v']);
    }

    function form_edit_penyewaan($id){//=============ada view
        $dt['title']='Daftar harga sewa';
        $dt['v'] = $this->rm->get_edit_penyewaan($id);
        $this->load->view('MenuPage/Form/edit_penyewaan',$dt);
        // echo json_encode($dt['v']);
    }

    function form_edit_aset_sewa($id){//=============ada view
        $dt['title']='Edit aset disewakan';
        $dt['id'] = $id;
        $dt['v'] = $this->rm->get_edit_aset_sewa($id);
        $this->load->view('MenuPage/Form/edit_aset_sewa',$dt);
        // echo json_encode($dt['v']);
    }

    function detail_aset_sewa($id){//=============ada view
        $dt['title'] = '';
        $dt['id'] = $id;
        $dt['v'] = $this->rm->get_detail_aset_sewa($id);
        $dt['v_histori_sewa'] = $this->rm->get_detail_histori_sewa($id);
        $dt['v_histori_harga_sewa'] = $this->rm->get_perubahan_harga_sewa($id);
        $this->load->view('MenuPage/Detail_Print/detail_aset_sewa',$dt);
        // echo json_encode($dt['v_histori_harga_sewa']);
    }

    function set_tambah_penyewaan(){
        $aset = $this->input->post('aset',true);
        $n_aset = $this->input->post('n_aset',TRUE);
        $penyewa = $this->input->post('penyewa',true);
        $kontak = $this->input->post('kontak',true);
        $tanggal_mul = $this->input->post('tanggal',true);
        $tanggal_mul = date('Y-m-d',strtotime($tanggal_mul));
        $hari = $this->input->post('jumlah_hari',true);
        $tanggal_sel = date('Y-m-d',strtotime($tanggal_mul.'+'.$hari.'days'));
        $harga = $this->input->post('harga',true);
        //'Penerimaan dari penyewaan aset '.$aset.' oleh '.$penyewa.' selama '.$hari.' hari, dimulai dari tanggal '.date('d-m-Y',strtotime($tanggal_mul));
        $fin_mesg = 'Penerimaan dari penyewaan aset '.$n_aset.' mulai dari '.date('d-m-Y',strtotime($tanggal_mul)).' selama '.$hari.' oleh '.$penyewa;
        
        $v = $this->rm->set_penyewaan($aset, $penyewa, $kontak, $tanggal_mul, $tanggal_sel, $harga);
        if ($v['stat']) {
            $log_mesg = '[TAMBAH][PENYEWAAN]['.$v['id'].'] Penyewaan aset '.$n_aset.' mulai dari '.date('d-m-Y',strtotime($tanggal_mul)).' selama '.$hari.' hari oleh '.$penyewa;
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo '200';
        }

        
        if ($v['stat']&&$harga!=null&&isset($_POST['tambah_trans'])) {
            $v2=$this->fm->set_arus_kas('IN', $fin_mesg, $harga, date('Y-m-d',strtotime($tanggal_mul)), 'System', $v['id']);
            if ($v2['res']) {
                $log_mesg = '[TAMBAH][KEUANGAN][PENYEWAAN]['.$v['id'].']['.$v2['id'].'] Pemasukan dari penyewaan '.$n_aset.' oleh '.$penyewa;
                $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            }
        }
    }

    function set_tambah_aset_sewaan(){
        $aset = $this->input->post('aset',true);
        $n_aset = $this->input->post('n_aset',true);
        $harga = $this->input->post('harga',true);
        $v = $this->rm->set_aset_sewa($aset, $harga);
        $log_mesg = '[TAMBAH][ASET SEWA]['.$v['id'].'] Menambah aset '.$n_aset.' untuk disewakan';

        if ($v['res']) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            $dt=$this->am->get_aset_umum('json');
            echo json_encode(['res'=>200,'data'=>$dt]);
        }
    }
    
    function edit_penyewaan(){
        $aset = $this->input->post('aset',true);
        $id = $this->input->post('id',true);
        $penyewa = $this->input->post('penyewa',true);
        $kontak = $this->input->post('kontak',true);
        $tanggal_mul = $this->input->post('tanggal',true);
        $tanggal_mul = date('Y-m-d',strtotime($tanggal_mul));
        $hari = $this->input->post('jumlah_hari',true);
        $tanggal_sel = date('Y-m-d',strtotime($tanggal_mul.'+'.$hari.'days'));
        $harga = $this->input->post('harga',true);
        $ps = $this->input->post('cat_keuangan',true);

        $log_mesg = '[EDIT][PENYEWAAN]['.$id.'] Mengubah data penyewaan aset '.$aset.' oleh '.$penyewa.' selama '.$hari.' hari, dimulai dari tanggal '.date('d-m-Y',strtotime($tanggal_mul));
        $resp=false;

        $v = $this->rm->edit_penyewaan($id, $penyewa, $kontak, $tanggal_mul, $tanggal_sel, $harga);
        if ($v) {//perubahan data stok
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            $resp =true;
        }

        if ($ps&&waktu_data($id)) {
            $ket_kas = 'Penerimaan dari penyewaan aset '.$aset.' mulai dari '.date('d-m-Y',strtotime($tanggal_mul)).' selama '.$hari.' oleh '.$penyewa;

            $v = $this->fm->set_arus_kas('IN', $ket_kas, $harga, $tanggal_mul, 'System', $id);
            if ($v['res']) {
                $log_mesg='[TAMBAH][KEUANGAN][PENYEWAAN]['.$v['id'].']['.$id.'] Menambah catatan keuangan dari penyewaan aset '.$aset.' oleh '.$penyewa.' selama '.$hari.' hari, dimulai dari tanggal '.date('d-m-Y',strtotime($tanggal_mul));
                $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
                $resp = true;
            }else{
                $v=$this->fm->edit_arus_kas($id, $harga, 'Debit', $tanggal_mul, $ket_kas);
                if ($v['resp']) {
                    $log_mesg='[EDIT][KEUANGAN][PENYEWAAN]['.$v['id'].']['.$id.'] Perubahan catatan keuangan dari penyewaan aset '.$aset.' oleh '.$penyewa.' selama '.$hari.' hari, dimulai dari tanggal '.date('d-m-Y',strtotime($tanggal_mul));
                    $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
                    $resp = true;
                }
            }
        }else if(waktu_data($id)&&!$ps&&$id){//perubahan data keuangan
            $v = $this->fm->del_keuangan($id);
            $log_mesg='[HAPUS][KEUANGAN][PENYEWAAN]['.$v['id'].']['.$id.'] Menghapus data keuangan dari penyewaan aset '.$aset.' oleh '.$penyewa.' selama '.$hari.' hari, dimulai dari tanggal '.date('d-m-Y',strtotime($tanggal_mul));
            if ($v['res']) {//log delete kas
                $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
                $resp=true;
            }
        }

        if ($resp) {
            echo 200;
        }
    }

    function edit_aset_disewakan(){
        $nama = $this->input->post('nama',true);
        $id = $this->input->post('id',true);
        $harga = $this->input->post('harga',true);
        $v = $this->rm->edit_aset_disewakan($id, $harga);
        $log_mesg = '[EDIT][ASET DISEWAKAN]['.$id.'] Perubahan harga sewa '.$nama.' menjadi Rp. '.$harga;
        if ($v) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo 200;
        }
    }

    //=============ada view
    function pdf_sewa(){
        $tahun = $this->input->get('tahun');
        $bulan = $this->input->get('bulan');
        $nb = isset($this->bulan[$bulan])?$this->bulan[$bulan]:'not-valid';
        $r = $this->rm->get_penyewaan($tahun,$bulan,0,0,0,0,'JSON');
        // membuat halaman baru
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        $logo = base_url().'logo.jpeg';
        $this->PDF->Cell(30,30,$this->PDF->Image($logo, ($this->PDF->GetX()-1), $this->PDF->GetY()-12, 33.58),0);
        // mencetak string 
        $this->PDF->Cell(130,7,'DAFTAR PENYEWAAN ASET',0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(180,8,'BUMDES Indrakila Jaya',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $nb = date('d').' '.$nb.' '.date('Y');
        $this->PDF->Cell(190,7,$nb,0,1,'R');
        
        $jumlah_sewa = $this->rm->get_jumlah_penyewaan($tahun, $bulan);
        $pemasukan_sewa = $this->rm->get_pendapatan_sewa($tahun, $bulan);

        $this->PDF->SetFont('Arial','B',10);
        $this->PDF->Cell(95,10,'Jumlah penyewaan',0,0);
        $this->PDF->Cell(95,10,'Total pendapatan sewa',0,1);
        $this->PDF->SetFont('Arial','',20);
        $this->PDF->Cell(95,10,$jumlah_sewa?$jumlah_sewa->tp:0,'R',0,'C');
        $this->PDF->Cell(95,10,$pemasukan_sewa?'Rp. '.$pemasukan_sewa->tps:'Rp. 0','L',1,'C');
        $this->PDF->Cell(10,10,'',0,1);
        
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Daftar jadwal sewa',0,1);
        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(10,6,'No',1,0);
        $this->PDF->Cell(50,6,'Aset',1,0);
        $this->PDF->Cell(30,6,'Waktu mulai',1,0);
        $this->PDF->Cell(30,6,'Waktu selesai',1,0);
        $this->PDF->Cell(35,6,'Penyewa',1,0);
        $this->PDF->Cell(35,6,'Harga',1,1);
        $this->PDF->SetFont('Arial','',9);
        
        foreach ($r as $key => $v) {
            $this->PDF->Cell(10,6,($key+1),1,0);
            $this->PDF->Cell(50,6,$v->ast,1,0);
            $this->PDF->Cell(30,6,date('d/m/Y',strtotime($v->wml)),1,0);
            $this->PDF->Cell(30,6,date('d/m/Y',strtotime($v->wsl)),1,0);
            $this->PDF->Cell(35,6,$v->pnw,1,0);
            $this->PDF->Cell(35,6,$v->nom,1,1);
        }
        $this->PDF->Output('I','Daftar_penyewaan_'.$this->bulan[$bulan].'_'.$tahun.'.pdf');
    }

    //=============ada view
    function pdf_harga_sewa(){
        $r = $this->rm->get_list_harga_sewa('JSON');
        // membuat halaman baru
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        // mencetak string 
        $this->PDF->Cell(190,7,'DAFTAR HARGA SEWA ASET',0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(190,7,'BUMDES Pujotirto',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(190,7,date('d/m/Y'),0,1,'R');/*
        $this->PDF->SetFont('Arial','',12);
        $this->PDF->Cell(80,10,'Total nilai barang keluar',0,1);
        $this->PDF->SetFont('Arial','B',20);
        $this->PDF->Cell(190,10,'Rp. 400,000',0,1,'C');
        $this->PDF->Cell(10,10,'',0,1);*/
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Daftar jadwal sewa',0,1);
        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(15,6,'No',1,0);
        $this->PDF->Cell(130,6,'Aset',1,0);
        $this->PDF->Cell(45,6,'Harga',1,1);
        $this->PDF->SetFont('Arial','',9);
        
        foreach ($r as $key => $v) {/*
            $this->PDF->Cell(50,6,$v->ast,1,0);
            $this->PDF->Cell(30,6,date('d/m/Y',strtotime($v->wml)),1,0);
            $this->PDF->Cell(30,6,date('d/m/Y',strtotime($v->wsl)),1,0);
            $this->PDF->Cell(35,6,$v->pnw,1,0);
            $this->PDF->Cell(35,6,$v->nom,1,1);*/
            $this->PDF->Cell(15,6,($key+1),1,0);
            $this->PDF->Cell(130,6,$v->nm,1,0);
            $this->PDF->Cell(45,6,$v->hs,1,1);
        }
        $this->PDF->Output('I','Daftar_barang_'.date('d_m_Y').'.pdf');
    }

    function hapus_penyewaan(){
        $id = $this->input->post('id',true);
        $log_mesg = '[HAPUS][PENYEWAAN]['.$id.'] Menghapus jadwal penyewaan aset';

        $v = $this->rm->del_penyewaan($id);
        if ($v) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            $v=$this->fm->del_keuangan($id);
            if ($v['res']) {
                $log_mesg = '[HAPUS][KEUANGAN]['.$v['id'].']['.$id.'] Menghapus transaksi dari penyewaan aset';
                $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            }
            $tahun = $this->input->post('tahun',true);
            $bulan = $this->input->post('bulan',true);
            $v1 = null;//$this->rm->get_total_pend_sewa($tahun, $bulan);
            $v1 = isset($v1->jl)?$v1->jl:0;
            $g = $this->fm->get_grafik_penyewaan($tahun);
            $g = json_decode($g);
            echo json_encode(['res'=>200,'val'=>$v1,'grafik'=>$g]);
            // echo $v;
        }else {
            # code...
        }
    }

    function hapus_aset_sewa(){
        $id = $this->input->post('id',true);
        $nm = $this->input->post('nm',true);
        $log_mesg = '[HAPUS][ASET DISEWAKAN]['.$id.'] Menghapus aset '.$nm.' dari daftar aset disewakan';
        $v = $this->rm->del_aset_sewa($id);
        if ($v) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo 200;
        }
    }


    function cek_penyewaan(){
        
        $id = $this->input->post('aset',true);
        $tm = $this->input->post('tanggal',true);
        $tm = date('Y-m-d',strtotime($tm));
        $ts = $this->input->post('jumlah_hari');
        $ts = date('Y-m-d',strtotime($tm.' + '.$ts.' days'));
        $dt = $this->rm->cek_penyewaan($id, $tm, $ts);
        echo $dt;
    }
    
    function cek_edit_penyewaan(){
        $id = $this->input->post('id',true);
        $ids = $this->input->post('ids',true);
        $tm = $this->input->post('tanggal',true);
        $tm = date('Y-m-d',strtotime($tm));
        $ts = $this->input->post('jumlah_hari');
        $ts = date('Y-m-d',strtotime($tm.' + '.$ts.' days'));
        $dt = $this->rm->cek_penyewaan($ids, $tm, $ts, $id);
        echo $dt;
    }

}
