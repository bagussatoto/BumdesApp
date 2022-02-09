<?php

require_once APPPATH.'..\asset\fpdf\fpdf.php';
class Administrasi extends CI_Controller{
    function __construct(){
        parent:: __construct();
		date_default_timezone_set('Asia/Jakarta');
        if ($this->ses->tp=='MNG') {
            $this->page = 'MenuPage';
        }elseif ($this->ses->tp=='GOV') {
            $this->page = 'MenuPageGov';
        }else {
            $this->page = 'MenuPageSys';
        }
        $this->PDF = new FPDF();
        $this->bulan = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
        $this->waktu = date('Y-m-d H:i:s');
        if (!$this->ses->log_s) {
			redirect(base_url());
        }
    }

    function comp_asset(){//=================OK
        $dt['title'] = 'Aset Bumdes';
        $dt['v1'] = $this->am->get_aset_umum();
        $dt['v2'] = $this->am->get_aset_disewakan();
        $dt['v3'] = $this->am->get_aset_bagi_hasil();
        if ($this->ses->tp=='MNG') {
            $this->load->view('MenuPage/Main/comp_asset',$dt);
        }else {
			redirect(base_url());
        }
    }

    function form_tambah_aset(){//=================OK
        $dt['title'] = '';
        $dt['b']=$this->fm->get_saldo();
        if ($this->ses->tp=='MNG') {
            $this->load->view('MenuPage/Form/tambah_aset',$dt);
        }else {
			redirect(base_url());
        }
    }
    
    function business_partner(){//=================OK
        $dt['title'] = 'Rekanan bisnis';
        $dt['v'] = $this->am->get_rekanan();
        if ($this->ses->tp=='MNG') {
            $this->load->view('MenuPage/Main/mitra_usaha',$dt);
        }else {
			redirect(base_url());
        }
    }

    function tambah_rekanan(){//=============ada view
        $dt['title'] = 'Tambah rekanan usaha';
        if ($this->ses->tp=='MNG') {
            $this->load->view('MenuPage/Form/tambah_rekanan',$dt);
        }else {
			redirect(base_url());
        }
    }

    function detail_aset($id){//=============ada view
        $dt['page']=$this->page;
        $dt['title'] = '';
        $dt['id'] = $id;
        $dt['v'] = $this->am->get_detail_aset($id);
        $dt['v_sewa'] = $this->rm->get_histori_sewa_aset($id);
        $dt['v_bgh'] = $this->fm->get_histori_bgh_aset($id);
        $this->load->view('MenuPage/Detail_Print/detail_aset2',$dt);
        // echo json_encode($dt['v_bgh']);
        // echo APPPATH;
    }

    function admin_log(){//=============ada view
        $dt['page']=$this->page;
        $dt['bln'] = $this->bulan;
        $dt['title'] = '';
        $dt['m']=date('m');
        $dt['y']=date('Y');
        $dt['lim'] = 10;
        $offset = 0;
        $dt['form_lim'] = [10, 25, 50, 100];
        $ajax = $this->input->is_ajax_request();
        $no_pagin = $this->input->get('pagin',TRUE);
        if (isset($_GET['tahun'])) {
            $dt['y'] = $this->input->get('tahun',true);
            $dt['m'] = $this->input->get('bulan',true);
            $dt['lim'] = $this->input->get('limit',TRUE);
            $offset = $this->input->get('offset',TRUE);
        }
        $dt['value'] = $this->hr->get_log_user($dt['y'],$dt['m'], $dt['lim'], $offset, $ajax, $no_pagin);
        $dt['v_tahun'] = $this->hr->get_tahun_log();
        if (!$ajax&&($this->ses->tp=='MNG'||$this->ses->tp=='SYS')) {
            $this->load->view('MenuPage/Main/admin_log',$dt);
        }else if($ajax&&($this->ses->tp=='MNG'||$this->ses->tp=='SYS')){
            $val['ses']='Ok';
            $val['tabel']=$dt['value'];
            echo json_encode($val);
        }else{
			redirect(base_url());
        }
    }

    function security(){//=============ada view
        $dt['page']=$this->page;
        $dt['bln'] = $this->bulan;
        $dt['v_tahun'] = $this->hr->get_tahun_log();
        $dt['title'] = 'Akun admin';//0081578813144
        $dt['y'] = date('Y');
        $dt['m'] = date('m');
        $dt['lim'] = 10;
        $offset = 0;
        $dt['form_lim'] = [10, 25, 50, 100];
        $ajax = $this->input->is_ajax_request();
        $no_pagin = $this->input->get('pagin',TRUE);
        if (isset($_GET['tahun'])) {
            $dt['y'] = $this->input->get('tahun',true);
            $dt['m'] = $this->input->get('bulan',true);
            $dt['lim'] = $this->input->get('limit',TRUE);
            $offset = $this->input->get('offset',TRUE);
        }
        $dt['value'] = $this->hr->get_user_log_id($this->ses->nu, $dt['y'],$dt['m'], $dt['lim'], $offset, $ajax, $no_pagin);
        $dt['p'] = $this->hr->get_profil($this->ses->nu);
        $kat = ['MNG'=>'Pengurus BUMDes Indrakila Jaya','GOV'=>'Pemerintah Desa Pujotirto','SYS'=>'Sistem Admin Web BUMDes'];
        if (!$ajax) {
            $dt['kt'] = $dt['p']?$kat[$dt['p']->kt]:null;
            $this->load->view('MenuPage/Main/security',$dt);
        }else {
            $val['ses']='Ok';
            $val['tabel']=$dt['value'];
            echo json_encode($val);
        }
    }

    function detail_user($id){
        $kat =['MNG'=>'Pengurus BUMDes', 'GOV'=>'Pemerintahan Desa Pujotirto'];
        $dt['title'] = 'Detail admin';
        $dt['page']=$this->page;
        $dt['bln'] = $this->bulan;
        $dt['id']=$id;
        $dt['v_tahun'] = $this->hr->get_tahun_log();
        $dt['u']=$this->hr->get_detail_user($id);
        $dt['y'] = date('Y');
        $dt['m'] = date('m');
        $dt['lim'] = 10;
        $offset = 0;
        $dt['form_lim'] = [10, 25, 50, 100];
        $ajax = $this->input->is_ajax_request();
        $no_pagin = $this->input->get('pagin',TRUE);
        if (isset($_GET['tahun'])) {
            $dt['y'] = $this->db->get('tahun',true);
            $dt['m'] = $this->db->get('bulan',true);
            $dt['lim'] = $this->input->get('limit',TRUE);
            $offset = $this->input->get('offset',TRUE);
        }
        $dt['value'] = $this->hr->get_log_user($dt['y'], $dt['m'], $dt['lim'], $offset, $ajax, $no_pagin, $id);
        $dt['k'] = isset($dt['u']->kt)?$kat[$dt['u']->kt]:'-';
        if (!$ajax&&$this->ses->tp=='MNG'||$this->ses->tp=='SYS') {
            $this->load->view('MenuPage/Detail_Print/detail_user',$dt);
        }else if($ajax&&$this->ses->tp=='MNG'||$this->ses->tp=='SYS'){
            $val['ses']='Ok';
            $val['tabel']=$dt['value'];
            echo json_encode($val);
        }else{
			redirect(base_url());
        }
    }
    function detail_mitra($id){
        $dt['bln'] = $this->bulan;
        $dt['y'] = date('Y');
        $dt['m'] = date('m');
        $dt['lim'] = 10;
        $offset = 0;
        $dt['form_lim'] = [10, 25, 50, 100];
        $ajax = $this->input->is_ajax_request();
        $no_pagin = $this->input->get('pagin',TRUE);
        if (isset($_GET['tahun'])) {
            $dt['y'] = $this->input->get('tahun',true);
            $dt['m'] = $this->input->get('bulan',true);
            $dt['lim'] = $this->input->get('limit',TRUE);
            $offset = $this->input->get('offset',TRUE);
        }
        $dt['title'] = 'Detail Rekanan';
        $dt['thn'] = $this->tm->get_tahun();
        $dt['v'] = $this->am->get_detail_mitra($id);
        $dt['value'] = $this->tm->get_distribusi_mitra($id, $dt['m'], $dt['y'], $dt['lim'], $offset, $ajax, $no_pagin);
        $dt['vbgh'] = $this->am->get_info_bagi_hasil_mitra($id);
        if (!$ajax&&$this->ses->tp=='MNG') {
            $this->load->view('MenuPage/Detail_print/detail_mitra',$dt);
        }else if($ajax&&$this->ses->tp=='MNG'){
            $val['ses']='Ok';
            $val['tabel']=$dt['value'];
            echo json_encode($val);
        }else {
			redirect(base_url());
        }
    }

    function user_management(){//=============ada view
        $dt['title'] = 'Manajemen admin';
        $dt['page']=$this->page;
        $dt['v']=$this->hr->get_admin($this->ses->nu);
        if ($this->ses->tp=='MNG'||$this->ses->tp=='SYS') {
            $this->load->view('MenuPage/Main/user_manag',$dt);
        }else {
			redirect(base_url());
        }
    }

    function tambah_admin(){//=============ada view
        $dt['page']=$this->page;
        $dt['title'] = 'Tambah admin sistem';
        if ($this->ses->tp=='MNG'||$this->ses->tp=='SYS') {
            $this->load->view('MenuPage/Form/tambah_admin',$dt);
        }else {
			redirect(base_url());
        }
    }

    function form_edit_aset($id){//=============ada view
        $dt['title'] = 'Edit gudang '.$id;
        $dt['id']=$id;
        $dt['v'] = $this->am->get_edit_aset($id);
        $dt['b']=$this->fm->get_saldo();
        $dt['edit'] = waktu_data($id)&&$dt['v'];
        if ($this->ses->tp=='MNG') {
            $this->load->view('MenuPage/Form/edit_aset',$dt);
        }else {
			redirect(base_url());
        }
    }

    function set_aset_baru(){

        $nama = $this->input->post('nama_aset',true);
        $nomor = $this->input->post('nomor_aset',true);
        $sumber = $this->input->post('sumber',true);
        $harga = $this->input->post('harga',true);
        $harga = $harga?$harga:null;
        $lokasi = $this->input->post('lokasi',true);
        $kondisi = $this->input->post('kondisi',true);
        $tglmasuk = $this->input->post('tanggal_masuk',true);
        $tglmasuk = date('Y-m-d',strtotime($tglmasuk));
        $keadaan = $this->input->post('keadaan',true);
        $cat = $this->input->post('cat',true);
        $cat=$cat?$cat:null;
        
        $file_name = false;
        if (!empty($_FILES['gambar']['name'])&&$_FILES['gambar']['size']<(5*1048576)) {
            $fmt = explode('.',$_FILES['gambar']['name']);
            $file_name = '003'.time().'.'.end($fmt);
        }
        
        $v = $this->am->set_aset_baru($nama,$nomor,$sumber,$harga,$lokasi,$kondisi,$tglmasuk,$keadaan,$cat, $file_name);
        /*
        if (isset($_POST['potong_saldo'])&&$v['resp']) {
            $pesan = 'Pembelian aset '.$nama.' dengan kondisi '.$kondisi.', keadaan '.$keadaan;
            $v2=$this->fm->set_arus_kas('OUT', $pesan, $harga, date('Y-m-d',strtotime($tglmasuk)), 'System', $v['id']);
            if ($v2['res']) {
                $log_mesg = '[TAMBAH][KEUANGAN][BELI ASET]['.$v2['id'].']['.$v['id'].'] Pembelian aset '.$nama.' dengan kondisi '.$kondisi.', dan keadaan '.$keadaan;
                $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            }
        }*/
        if ($v['resp']) {
            $log_mesg = '[TAMBAH][ASET]['.$v['id'].'] Penambahan aset '.$nama.' dengan kondisi '.$kondisi.' dalam keadaan '.$keadaan.' melalui proses '.$sumber;
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
        }
        
        

        if ($v['resp']) {
            if ($file_name) {
                $file_name = explode('.',$file_name);
                $file_name = $file_name[0];
            }
            $config = [
                'upload_path'=> 'media/aset/',
                'allowed_types'=> 'jpg|png',
                'max_size'=> 5*1048576,//in KB, 0 = unlimit
                'max_width'=>0,
                'min_width'=>0,
                'file_name'=> $file_name
            ];
            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');/*
            if ($this->upload->do_upload('gambar')){
                $resp = $this->upload->data();
                $resp = 'Ok | '.$resp['file_size'];
            }else{
                $resp= $this->upload->display_errors();
            }*/
        }
        
        if ($v['resp']) {
            $s=$this->fm->get_saldo();
            $s = isset($s[0]->ac)?$s[0]->ac:0;
            echo '200|'.$s;
        }else{
            echo ' | ';
        }
    }

    function set_mitra_baru(){
        $nama = $this->input->post('nama',true);
        $pj = $this->input->post('pj',true);
        $k_1 = $this->input->post('kontak_1',true);
        $k_2 = $this->input->post('kontak_2',true);
        $k_2 = $k_2!=''?$k_2:null;
        $alamat = $this->input->post('alamat',true);

        $v=$this->am->set_rekan_usaha($nama, $pj, $k_1, $k_2, $alamat);
        $log_mesg = '[TAMBAH][REKANAN]['.$v['id'].'] Penambahan rekanan baru, dengan nama rekanan '.$nama;

        if ($v['resp']) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo '200';
        }

    }

    function set_admin_baru(){
        $nama = $this->input->post('nama',true);
        $kat = $this->input->post('kategori',true);
        $kat2 = $kat=='MNG'?'Manajemen BUMDes':'Pemerintah desa';
        $email = $this->input->post('email',true);
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        
        $v=$this->hr->set_url_confirm($nama.'|'.$email.'|'.$kat2.'|'.$kat);
        $log_mesg = '[TAMBAH][ADMIN] Registrasi admin baru bernama '.$nama.' dari '.$kat2;

        if ($v['res']) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));

            $subject = 'Registrasi admin baru sistem manajemen BUMDes Indrakila Jaya '.date('d-m-Y');
            $message = 'Silahkan klik <a href="'.site_url('registrasi-admin/'.$v['id']).'" target="_blank">tautan</a> ini untuk melanjutkan proses registrasi admin bernama '.$nama;
    
            $this->email->set_newline("\r\n");
            $this->email->from($from, 'Sistem Web BUMDes');
            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
            // show_error($this->email->print_debugger());
            echo 200;
        }
    }

    function form_edit_mitra($id){
        $dt['title'] = 'Ubah data mitra';
        $dt['v'] = $this->am->get_edit_mitra($id);
        if ($this->ses->tp=='MNG') {
            $this->load->view('MenuPage/Form/edit_rekanan',$dt);
        }else {
			redirect(base_url());
        }
    }

    function edit_aset(){
        $id = $this->input->post('id',true);
        $nama = $this->input->post('nama_aset',true);
        $nomor = $this->input->post('nomor_aset',true);
        $sumber = $this->input->post('sumber',true);
        $harga = $this->input->post('harga',true);
        $lokasi = $this->input->post('lokasi',true);
        $del_fot = $this->input->post('del_fot',true);
        $img_val = $this->input->post('img_val',true);
        $kondisi = $this->input->post('kondisi',true);
        $tglmasuk = $this->input->post('tanggal_masuk',true);
        $tglmasuk = date('Y-m-d',strtotime($tglmasuk));
        $keadaan = $this->input->post('keadaan',true);
        $cat = $this->input->post('catatan',true);
        $cat = $cat?$cat:null;
        //jpeg, png, jpg, 5*1048576
        $size= isset($_FILES['foto'])?$_FILES['foto']['size']:0;
        $size = $size <= (5*1048576)?true:false;//5 Mb
        $type = isset($_FILES['foto'])?$_FILES['foto']['type']:false;
        $type = $type?explode('/',$type):false;
        $type = $type?$type[1]:false;
        $type = $type=='jpeg'?'jpg':$type;
        $nam_file = in_array($type,['png','jpg'])&&$size?'300'.time().'.'.$type:false;

        $resp = false;
        $v = $this->am->edit_aset($id, $nama, $nomor, $sumber, $harga, $lokasi, $kondisi, $tglmasuk, $keadaan, $cat, $nam_file, $del_fot);

        if ($v) {
            $log_mesg = '[EDIT][ASET]['.$id.'] Perubahan data aset '. $nama.' dengan nomor aset  '.$nomor;
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            $resp=true;
        }
        /*
        if (isset($_POST['potong_saldo'])&&waktu_data($id)) {
            $ket_kas ='Pembelian aset '.$nama.' dengan nomor aset  '.$nomor;
            $v1 = $this->fm->set_arus_kas('OUT', $ket_kas, $harga, $tglmasuk, 'System', $id);
            if ($v1['res']) {
                $log_mesg='[TAMBAH][KEUANGAN][BELI ASET]['.$v1['id'].']['.$id.'] Pembelian aset '.$nama.' dengan nomor aset  '.$nomor;
                $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
                $resp = true;
            }else{
                $v1=$this->fm->edit_arus_kas($id, $harga, 'Kredit', $tglmasuk, $ket_kas);
                if ($v1['resp']) {
                    $log_mesg='[EDIT][KEUANGAN][BELI ASET]['.$v1['id'].']['.$id.'] Pembelian aset '.$nama.' dengan nomor aset  '.$nomor;
                    $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
                    $resp = true;
                }
            }
        }else if(waktu_data($id)){
            $v1 = $this->fm->del_keuangan($id);
            $log_mesg='[HAPUS][KEUANGAN][BELI ASET]['.$v1['id'].']['.$id.'] Menghapus data keuangan dari pembelian '.$nama.' dengan nomor aset  '.$nomor;
            if ($v1['res']) {//log delete kas
                $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
                $resp=true;
            }
        }*/

        $mesg=null;
        $stat='IDLE';
        $foto=base_url('media/aset/unnamed.png');
        $file_name2 =null;
        if ($del_fot&&$v) {
            if (file_exists('media/aset/'.$del_fot)) {
                unlink('media/aset/'.$del_fot);
            }
            $stat='Del';
        }elseif ($nam_file&&$v) {
            $file_name = explode('.',$nam_file);
            $config = [
                'upload_path'=> 'media/aset/',
                'allowed_types'=> 'jpg|png|jpeg',
                'max_size'=> 5*1048576,//5 Mb
                'max_width'=>0,
                'min_width'=>0,
                'file_name'=> $file_name[0]
            ];
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('foto')){
                $mesg = $this->upload->display_errors();
            }else{
                $mesg = $this->upload->data();
                if ($img_val) {
                    if (file_exists('media/aset/'.$img_val)) {
                        unlink('media/aset/'.$img_val);
                    }
                }
                $stat='Change';
                $foto = base_url('media/aset/').$mesg['orig_name'];
                $file_name2 = $mesg['orig_name'];
            }
        }

        if ($resp) {
            $s=$this->fm->get_saldo();
            $s = isset($s[0]->ac)?$s[0]->ac:0;
            $ar = [200, $s, $stat, $foto, $file_name2];
            $ar = implode('|',$ar);
            echo $ar;
        }else{
            echo '100| | | ';
        }
    }

    function edit_rekanan(){
        $telp2 = null;
        $id = $this->input->post('id',true);
        $nama = $this->input->post('nama',true);
        $pj = $this->input->post('pj',true);
        $alamat = $this->input->post('alamat',true);
        $status = $this->input->post('status',true);
        $telp1 = $this->input->post('telp_1',true);
        $telp2 = $this->input->post('telp_2',true);
        if ($telp2=='') {
            $telp2=null;
        }

        $v = $this->am->edit_rekanan($id, $nama, $pj, $alamat, $status, $telp1, $telp2);
        $log_mesg = '[EDIT][REKANAN] ['.$id.'] Perubahan data rekanan '.$nama;
        if ($v) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
        }
    }

    function hapus_komoditas(){
        $id = $this->input->post('id',true);
        
        $v = $this->am->del_komoditas($id);
        
        $log_mesg = '[HAPUS][KOMODITAS]['.$id.'] Menghapus komoditas dagang';
        if ($v) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo 200;
        }else{
            echo 100;
        }
    } //$value 

    //=============ada view
    function pdf_aset($id){
        // membuat halaman baru
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        // mencetak string 
        $this->PDF->Cell(190,7,'SEKOLAH MENENGAH KEJURUSAN NEEGRI 2 LANGSA',0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(190,7,'DAFTAR SISWA KELAS IX JURUSAN REKAYASA PERANGKAT LUNAK',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','B',10);
        $this->PDF->Cell(20,6,'NIM',1,0);
        $this->PDF->Cell(110,6,'NAMA MAHASISWA',1,0);
        $this->PDF->Cell(30,6,'NO HP',1,0);
        $this->PDF->Cell(30,6,'TANGGAL LHR',1,0);
        $this->PDF->SetFont('Arial','',10);/*
        $mahasiswa = $this->db->get('mahasiswa')->result();
        foreach ($mahasiswa as $row){
            $this->PDF->Cell(20,6,$row->nim,1,0);
            $this->PDF->Cell(85,6,$row->nama_lengkap,1,0);
            $this->PDF->Cell(27,6,$row->no_hp,1,0);
            $this->PDF->Cell(25,6,$row->tanggal_lahir,1,1); 
        }*/
        $this->PDF->Output();
    }

    //=============ada view
    function pdf_daftar_aset(){
        
        $r = $this->am->get_aset_umum('JSON');
        $r1 = $this->am->get_aset_disewakan('JSON');
        $r2 = $this->am->get_aset_bagi_hasil('JSON');
        // membuat halaman baru
        $this->PDF->AddPage();
        // setting jenis font yang akan digunakan
        $this->PDF->SetFont('Arial','B',16);
        $logo = base_url().'logo.jpeg';
        $this->PDF->Cell(30,30,$this->PDF->Image($logo, ($this->PDF->GetX()-1), $this->PDF->GetY()-12, 33.58),0);
        // mencetak string 
        $this->PDF->Cell(120,7,'DAFTAR ASET DIMILIKI',0,1,'C');
        $this->PDF->SetFont('Arial','B',12);
        $this->PDF->Cell(180,8,'BUMDES Indrakila Jaya',0,1,'C');
        $this->PDF->Cell(190,0,'',1,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->PDF->Cell(10,7,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(190,7,date('d ').$this->bulan[date('m')].date(' Y'),0,1,'R');
        

        /*=======================ASET UMUM===========================*/
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Daftar aset umum',0,1);

        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(10,6,'No',1,0);
        $this->PDF->Cell(50,6,'Nama aset',1,0);
        $this->PDF->Cell(50,6,'Nomor aset',1,0);
        $this->PDF->Cell(50,6,'Lokasi aset',1,0);
        $this->PDF->Cell(30,6,'Tahun terdaftar',1,1);

        $this->PDF->SetFont('Arial','',9);     
        foreach ($r as $key => $v) {
            $this->PDF->Cell(10,6,($key+1),1,0);
            $this->PDF->Cell(50,6,$v->nm,1,0);
            $this->PDF->Cell(50,6,$v->num,1,0);
            $this->PDF->Cell(50,6,$v->lok,1,0);
            $this->PDF->Cell(30,6,date('d/m/Y',strtotime($v->thn)),1,1);
        }
        /*=======================ASET Disewakan===========================*/
        $this->PDF->Cell(190,10,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Daftar aset disewakan',0,1);

        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(10,6,'No',1,0);
        $this->PDF->Cell(50,6,'Nama aset',1,0);
        $this->PDF->Cell(50,6,'Nomor aset',1,0);
        $this->PDF->Cell(50,6,'Lokasi aset',1,0);
        $this->PDF->Cell(30,6,'Tahun terdaftar',1,1);

        $this->PDF->SetFont('Arial','',9);     
        foreach ($r1 as $key => $v) {
            $this->PDF->Cell(10,6,($key+1),1,0);
            $this->PDF->Cell(50,6,$v->nm,1,0);
            $this->PDF->Cell(50,6,$v->num,1,0);
            $this->PDF->Cell(50,6,$v->lok,1,0);
            $this->PDF->Cell(30,6,date('d/m/Y',strtotime($v->thn)),1,1);
        }

        /*=======================ASET Bagi Hasil===========================*/
        $this->PDF->Cell(190,10,'',0,1);
        $this->PDF->SetFont('Arial','',15);
        $this->PDF->Cell(10,10,'Daftar aset bagi hasil',0,1);

        $this->PDF->SetFont('Arial','B',11);
        $this->PDF->Cell(10,6,'No',1,0);
        $this->PDF->Cell(50,6,'Nama aset',1,0);
        $this->PDF->Cell(50,6,'Nomor aset',1,0);
        $this->PDF->Cell(50,6,'Lokasi aset',1,0);
        $this->PDF->Cell(30,6,'Tahun terdaftar',1,1);

        $this->PDF->SetFont('Arial','',9);     
        foreach ($r2 as $key => $v) {
            $this->PDF->Cell(10,6,($key+1),1,0);
            $this->PDF->Cell(50,6,$v->nm,1,0);
            $this->PDF->Cell(50,6,$v->num,1,0);
            $this->PDF->Cell(50,6,$v->lok,1,0);
            $this->PDF->Cell(30,6,date('d/m/Y',strtotime($v->thn)),1,1);
        }

        $this->PDF->Output('I','Daftar_aset_'.date('d_').$this->bulan[date('m')].'_'.date('Y').'.pdf');
    }

    function hapus_satuan(){
        $id = $this->input->post('id',true);
        $nm = $this->input->post('nm',true);
        $log_mesg = '[HAPUS][SATUAN] Menghapus satuan '.$nm;
        $v = $this->am->del_satuan($id);
        if ($v) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo 200;
        }
    }

    function hapus_aset(){
        $id = $this->input->post('id',true);
        $nm = $this->input->post('nm',true);
        $log_mesg = '[HAPUS][ASET]['.$id.'] Menghapus '.$nm.' dari daftar aset';
        $v = $this->am->del_aset($id);
        if ($v) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));/*
            if (waktu_data($id, 5)) {
                $v=$this->fm->del_keuangan($id);
                if ($v['res']) {
                    $log_mesg = '[HAPUS][KEUANGAN][BELI ASET]['.$v['id'].']['.$id.'] Menghapus kas keluar (Kredit) untuk pembelian aset';
                    $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
                }
            }*/
            echo 200;
        }
    }

    function hapus_mitra(){
        $id = $this->input->post('id',true);
        $nm = $this->input->post('nm',true);
        $log_mesg = '[HAPUS][REKANAN]['.$id.'] Menghapus '.$nm.' dari daftar rekanan usaha BUMDes';
        $v = $this->am->del_rekanan($id);
        if ($v) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo 200;
        }
    }

    function hapus_user(){
        $id = $this->input->post('id',true);
        $nm = $this->input->post('nm',true);
        $log_mesg = '[HAPUS][USER]['.$id.'] Menghapus '.$nm.' dari daftar pengguna sistem';
        $v = $this->hr->del_user($id);
        if ($v) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            echo 200;
        }
    }

    function tambah_satuan(){
        $sat = $this->input->post('sat',true);
        $ket_sat = $this->input->post('ket_sat',true);

        $v = $this->am->set_satuan($sat, $ket_sat);
        $log_mesg = '[TAMBAH][SATUAN] Menambah '.$sat.' ke daam daftar satuan produk dagang';
        if ($v) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            $v = $this->am->get_satuan();
            echo json_encode(['res'=>200,'v'=>$v]);
        }
    }

    function edit_satuan(){
        $id = $this->input->post('id',true);
        $sat = $this->input->post('sat',true);
        $ket_sat = $this->input->post('ket',true);

        $v = $this->am->edit_satuan($id, $sat, $ket_sat);
        $log_mesg = '[UBAH][SATUAN] Mengubah '.$sat.' di dalam daftar satuan produk dagang';
        if ($v) {
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
            $v = $this->am->get_satuan();
            echo json_encode(['res'=>200,'v'=>$v]);
        }
    }

    function form_ubah_profil(){//=============ada view
        $dt['page']=$this->page;
        $dt['title'] = 'Ubah informasi admin ';
        $dt['v']=$this->hr->get_edit_profil($this->ses->nu);
        $this->load->view('MenuPage/Form/edit_profil',$dt);
        // echo json_encode($dt['v']);
    }

    function form_ganti_password(){//=============ada view
        $dt['page']=$this->page;
        $dt['title'] = 'Ganti password';
        // $dt['b']=$this->hr->get_saldo('0081578813144);
        $this->load->view('MenuPage/Form/edit_ganti_pass',$dt);
        // echo json_encode($dt['v']);
    }

    function edit_profil1(){
        $nama = $this->input->post('nama',true);
        $username = $this->input->post('username',true);
        $kontak = $this->input->post('kontak',true);
        $password = $this->input->post('password',true);
        $img_val =  $this->input->post('img_val',true);
        
        $size= isset($_FILES['foto'])?$_FILES['foto']['size']:0;
        $size = $size <= (5*1048576)?true:false;//5 Mb
        $type = isset($_FILES['foto'])?$_FILES['foto']['type']:false;
        $type = $type?explode('/',$type):false;
        $type = $type?$type[1]:false;
        $type = $type=='jpeg'?'jpg':$type;
        $nam_file = in_array($type,['png','jpg'])&&$size?'300'.time().'.'.$type:false;

        $foto=false;
        if (isset($_FILES['foto'])) {
            $foto = $_FILES['foto']['name']?explode('.',$_FILES['foto']['name'])[1]:false;
            $foto = $foto?'400'.time().'.'.$foto:false;
            $foto = $_FILES['foto']['size']<=5*1048576?$foto:false; //cek ukuran
        }

        $del_fot = isset($_POST['del_fot']);
        $stat = 'None';
        $v= $this->hr->edit_profil($this->ses->nu,$nama, $username, $kontak, $password, $foto, $del_fot);
        if ($v) {
            $log_mesg = '[EDIT][PROFIL]['.$this->ses->nu.'] Admin {NAMA} mengubah informasi di profilnya';
            $this->hr->log_admin($this->ses->nu, $log_mesg, date('Y-m-d'), date('H:i:s'));
        }

        if ($v&&$foto) {
            $foto = explode('.',$foto);
            $config = [
                'upload_path'=> 'asset/gambar/admin/',
                'allowed_types'=> 'jpg|png',
                'max_size'=> 5*1048576,
                'max_width'=>0,
                'min_width'=>0,
                'file_name'=> $foto[0]
            ];
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('foto')){
                $mesg ['mesg'] = $this->upload->display_errors();
            }else{
                $mesg ['mesg'] = $this->upload->data();
                if ($img_val) {
                    if (file_exists('asset/gambar/admin/'.$img_val)) {
                        unlink('asset/gambar/admin/'.$img_val);
                    }
                }
                $stat='Change';
                $foto = base_url('asset/gambar/admin/').$mesg['mesg']['orig_name'];
            }
        }elseif ($del_fot) {
            if ($img_val) {
                if (file_exists('asset/gambar/admin/'.$img_val)) {
                    unlink('asset/gambar/admin/'.$img_val);
                }
            }
            $stat='Del';
            $foto = base_url('asset/gambar/unnamed.png');
        }

        if ($v) {
            echo '200|'.$stat.'|'.$foto;
        }
    }

    function cek_username(){
        $usn = $this->input->get('usn',true);

        $v = $this->hr->cek_username($usn);

        echo $v;
    }

    function edit_profil(){

        $id = $this->ses->nu;
        $nama = $this->input->post('nama',true);
        $del_foto = $this->input->post('del_fot',true);
        $img_val = $this->input->post('img_val',true);
        $email = $this->input->post('email',true);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $kontak = $this->input->post('kontak',true);
        $password = $this->input->post('password',true);
        
        $size= isset($_FILES['foto'])?$_FILES['foto']['size']:0;
        $size = $size <= (5*1048576)?true:false;//5 Mb
        $type = isset($_FILES['foto'])?$_FILES['foto']['type']:false;
        $type = $type?explode('/',$type):false;
        $type = $type?$type[1]:false;
        $type = $type=='jpeg'?'jpg':$type;
        $nam_file = in_array($type,['png','jpg'])&&$size?'800'.time().'.'.$type:false;

        $v=$this->hr->edit_profil($id,$nama, $kontak, $password, $nam_file, $del_foto);

        
        $mesg=null;
        $stat='IDLE';
        $foto=base_url('media/admin/unnamed.png');
        $file_name2 =null;
        if ($del_foto&&$v) {
            if (file_exists('media/admin/'.$del_foto)) {
                unlink('media/admin/'.$del_foto);
            }
            $stat='Del';
        }elseif ($nam_file&&$v) {
            $file_name = explode('.',$nam_file);
            $config = [
                'upload_path'=> 'media/admin/',
                'allowed_types'=> 'jpg|png|jpeg',
                'max_size'=> 5*1048576,//5 Mb
                'max_width'=>0,
                'min_width'=>0,
                'file_name'=> $file_name[0]
            ];
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('foto')){
                $mesg = $this->upload->display_errors();
            }else{
                $mesg = $this->upload->data();
                if ($img_val) {
                    if (file_exists('media/admin/'.$img_val)) {
                        unlink('media/admin/'.$img_val);
                    }
                }
                $stat='Change';
                $foto = base_url('media/admin/').$mesg['orig_name'];
                $file_name2 = $mesg['orig_name'];
            }
        }
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->load->library('email');
            $from = $this->config->item('smtp_user');
            
            $v1=$this->hr->set_url_confirm($id.'|'.$email);
    
            if ($v1['res']) {
    
                $subject = 'Konfirmasi perubahan email admin sistem manajemen BUMDes Indrakila '.date('d-m-Y');
                $message = 'Silahkan klik <a href="'.site_url('konfirmasi-ganti-email/'.$v1['id']).'" target="_blank">tautan</a> ini untuk konfirmasi perubahan email ';
        
                $this->email->set_newline("\r\n");
                $this->email->from($from, 'Sistem Web BUMDes');
                $this->email->to($email);
                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->send();
            }
        }

        if ($v) {
            $log_mesg = '[PRIVATE] Perubahan informasi admin';
            $this->hr->log_admin($id, $log_mesg, date('Y-m-d'), date('H:i:s'));
            $ar = [200, $stat, $foto, $file_name2];
            $ar = implode('|',$ar);
            echo $ar;
        }else{
            echo '100| | | ';
        }
    }

    function ganti_password(){
        
        $id = $this->ses->nu;
        $password = $this->input->post('password',true);
        $password2 = $this->input->post('password2',true);

        $v = $this->hr->ganti_password($id, $password, $password2);
        echo $v?200:100;
        // echo $password.' - '.$password2;
    }

    function cek_mail(){
        $val = $this->input->get('mail',true);

        $v = $this->hr->cek_mail($val);
        echo $v;    
    }

}
