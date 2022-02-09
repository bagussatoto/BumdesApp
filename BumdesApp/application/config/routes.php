<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Homepage';

// routing perdagangan **
$route['item-sold'] = 'Trade/sales_report';
$route['tambah-barang-keluar'] = 'Trade/form_barang_keluar';//=============ada view
$route['set-barang-keluar'] = 'Trade/set_barang_keluar';//=========ada view
$route['unduh-barang-keluar'] = 'Trade/pdf_barang_keluar';//==========ada view
$route['detail-lout/(:num)'] = 'Logistic/detail_logistik_keluar/$1';//===ada view
$route['unduh-daftar-distribusi'] = 'Trade/pdf_distribusi_barang';//==ada view
$route['distribution'] = 'Trade/distribution';//=========ada
$route['exit-item'] = 'Trade/barang_keluar';//=========ada
$route['pdf-detail-komoditas-out/(:num)'] = 'Trade/pdf_detail_komoditas_keluar/$1';//
$route['edit-barang-keluar'] = 'Trade/edit_barang_keluar';//=========ada view
// $route['barang-keluar'] = 'Logistic/exit_item/json';//=========ada view
$route['dis-barang'] = 'Trade/distribution/json';//=========ada view
$route['edit-ei/(:num)'] = 'Trade/form_edit_barang_keluar_gudang/$1';//====ada view
$route['detail-penjualan/(:num)'] = 'Logistic/detail_logistik_keluar/$1/json';//=========ada view


//routing penyewaan **
$route['rentalling'] = 'Rent/rentalling';//=========ada
$route['rent-price'] = 'Rent/rent_price';//=========ada
$route['add-schedule']='Rent/form_tambah_jadwal';//=========ada view
$route['tambah-aset-sewa']='Rent/form_tambah_aset_sewa';//==================ada view
$route['edit-ar/(:num)']='Rent/form_edit_penyewaan/$1';//===================ada view
$route['edit-rp/(:num)'] = 'Rent/form_edit_aset_sewa/$1';//=================ada view
$route['detail-rp/(:num)'] = 'Rent/detail_aset_sewa/$1';//=============ada view
$route['unduh-daftar-sewa'] = 'Rent/pdf_sewa';//=======================ada view
$route['unduh-harga-sewa'] = 'Rent/pdf_harga_sewa';//================= ada view
$route['set-tambah-penyewaan'] = 'Rent/set_tambah_penyewaan';//================= ada view
$route['set-aset-sewaan'] = 'Rent/set_tambah_aset_sewaan';//================= ada view
$route['edit-aset-sewa'] = 'Rent/edit_aset_disewakan';//================= ada view
$route['sewa-aset'] = 'Rent/rentalling/json';//=========ada view
$route['hapus-penyewaan'] = 'Rent/hapus_penyewaan';//=========ada view
$route['hapus-aset-sewa'] = 'Rent/hapus_aset_sewa';//=========ada view
$route['edit-penyewaan'] = 'Rent/edit_penyewaan';//=========ada view
$route['cek-jadwal'] = 'Rent/cek_penyewaan';//=========ada view
$route['cek-edit-sewa'] = 'Rent/cek_edit_penyewaan';//=========ada view

//routing finansial
$route['weekly-freport'] = 'Finance/weekly_report';//=========ada
$route['monthly-freport'] = 'Finance/monthly_report';//=========ada
$route['annual-freport'] = 'Finance/annual_report';//=========ada
$route['corp-profits'] = 'Finance/corp_profits';//=========ada
$route['bagi-hasil'] = 'Finance/bagi_hasil';//=========ada
$route['detail-sp/(:num)'] = 'Finance/detail_bagi_hasil/$1';//==========ada view
$route['add-finr'] = 'Finance/form_cat_keuangan';//=================ada view
$route['edit-fin/(:num)'] = 'Finance/form_edit_finansial/$1';//============ada view**
$route['unduh-daftar-bagi-hasil'] = 'Finance/pdf_daftar_bagi_hasil';//==ada view
$route['unduh-keuangan-mingguan'] = 'Finance/pdf_keuangan/1';//=========ada view
$route['unduh-keuangan-bulanan'] = 'Finance/pdf_keuangan/2';//==========ada view
$route['unduh-keuangan-tahunan'] = 'Finance/pdf_keuangan/3';//==========ada view
$route['unduh-laporan-laba'] = 'Finance/pdf_laporan_laba';//============ada view
$route['tambah-bagi-hasil'] = 'Finance/form_tambah_aset_bagi_hasil';//============ada view
$route['set-bagi-hasil'] = 'Finance/set_tambah_bagi_hasil';//============ada view
$route['tambah-pemasukan-bgh'] = 'Finance/form_tambah_pemb_bgh';//============ada view
$route['set-pemb-bgh'] = 'Finance/set_tambah_pemb_bgh';//============ada view
$route['set-arus-kas'] = 'Finance/set_arus_kas';//============ada view
$route['edit-sp/(:num)'] = 'Finance/form_edit_aset_bagi_hasil/$1';//============ada view
$route['edit-bagi-hasil'] = 'Finance/edit_bagi_hasil';//============ada view
$route['edit-arus-kas'] = 'Finance/edit_arus_kas';//============ada view
$route['bagi-has'] = 'Finance/bagi_hasil/json';//=========ada view
// $route['sewa-aset'] = 'Finance/bagi_hasil/json';//=========ada view
$route['keuangan-mingguan'] = 'Finance/weekly_report/json';//=========ada view
$route['keuangan-bulanan'] = 'Finance/monthly_report/json';//=========ada view
$route['keuangan-tahunan'] = 'Finance/annual_report/json';//=========ada view
$route['dividen-bumdes'] = 'Finance/bagi_dividen';//=========ada view
$route['tambah-dividen'] = 'Finance/form_tabah_dividen';//=========ada view
$route['saldo-dividen'] = 'Finance/saldo_dividen';//=========ada view
$route['edit-bagi-dividen/(:num)'] = 'Finance/edit_bagi_dividen/$1';//=========ada view
$route['hapus-keuangan/mng'] = 'Finance/hapus_keuangan/mng';//=========ada view
$route['hapus-keuangan/bln'] = 'Finance/hapus_keuangan/bln';//=========ada view
$route['hapus-keuangan/thn'] = 'Finance/hapus_keuangan/thn';//=========ada view
$route['hapus-bagi-hasil'] = 'Finance/hapus_bagi_hasil';//=========ada view
$route['set-bagi-dividen'] = 'Finance/set_bagi_dividen';//=========ada view
$route['info-bagi-dividen/(:num)'] = 'Finance/detail_bagi_dividen/$1';//=========ada view
$route['hapus-bagi-dividen-g'] = 'Finance/hapus_bagi_dividen_g';//=========ada view
$route['hapus-pembayaran'] = 'Finance/hapus_pembayaran';//=========ada view
$route['set-pembayaran'] = 'Finance/set_pembayaran_ent_bhu';//=========ada view
$route['edit-bgu/(:num)'] = 'Finance/form_edit_bagi_dividen/$1';//=========ada view
$route['edit-bagi-dividen'] = 'Finance/edit_bagi_hasil_div';//=========ada view
$route['edit-pbgu/(:num)'] = 'Finance/form_edit_pemb_bagi_hasil/$1';//=========ada view
$route['edit-pemb-bgh'] = 'Finance/edit_pemb_bgh';//=========ada view
$route['hapus-pemb-bagi-hasil'] = 'Finance/del_pemb_bgh';//=========ada view
$route['cek-jadwal-bgh'] = 'Finance/cek_jadwal_bgh';//=========ada view
$route['cek-edit-bgh'] = 'Finance/cek_edit_jadwal_bgh';//=========ada view
$route['unduh-bagi-hasil-usaha'] = 'Finance/pdf_bagi_hasil_usaha';//=========ada view
// $route['cek-saldo'] = 'Finance/cek_saldo';



// routing logistik **
$route['stok-masuk'] = 'Logistic/stok_masuk';//=========ada
$route['tambah-stok'] = 'Logistic/form_tambah_barang_masuk_gudang';//=========ada view
$route['add-commodites'] = 'Logistic/form_tambah_komoditas';//================ada view
$route['commodity'] = 'Logistic/komoditas';//=========ada
$route['edit-ig/(:num)'] = 'Logistic/form_edit_barang_masuk_gudang/$1';//=====ada view
$route['edit-com/(:num)'] = 'Logistic/form_edit_komoditas_dagang/$1';//=======ada view
$route['detail-lg/(:num)'] = 'Logistic/detail_logistik_dagang/$1';//========ada view
$route['detail-lin/(:num)'] = 'Logistic/detail_logistik_masuk/$1';//=====ada view
$route['unduh-barang-masuk'] = 'Logistic/pdf_belanja_barang';//==========ada view
$route['unduh-daftar-komoditas'] = 'Logistic/pdf_komoditas';//===========ada view
$route['set-tambah-logistik'] = 'Logistic/set_barang_masuk';//=========ada view
$route['set-tambah-komoditas'] = 'Logistic/set_tambah_komoditas';//=========ada view
$route['hapus-stok-masuk'] = 'Logistic/hapus_stok_masuk';//=========ada view
$route['hapus-stok-keluar'] = 'Logistic/hapus_stok_keluar';//=========ada view
$route['edit-barang-masuk'] = 'Logistic/edit_barang_masuk';//=========ada view
$route['belanja-barang'] = 'Logistic/stok_masuk/json';//=========ada view
// $route['belanja-barang'] = 'Logistic/incoming_goods/json';//=========ada view
$route['edit-komoditas-dagang'] = 'Logistic/edit_komoditas_dagang';//=========ada view
$route['detail-belanja/(:num)'] = 'Logistic/detail_logistik_masuk/$1/json';//=========ada view

//routing Administrasi
$route['business-partner'] = 'Administrasi/business_partner';//=========ada
$route['assets'] = 'Administrasi/comp_asset';//=========ada
$route['add-asset'] = 'Administrasi/form_tambah_aset';//=================ada view
$route['add-busspartner'] = 'Administrasi/tambah_rekanan';//=============ada view
$route['edit-asset/(:num)'] = 'Administrasi/form_edit_aset/$1';//=================ada view
$route['detail-aset/(:num)'] = 'Administrasi/detail_aset/$1';//==========ada view
$route['unduh-daftar-aset'] = 'Administrasi/pdf_daftar_aset';//==========ada view
$route['user-management'] = 'Administrasi/user_management';//=========ada
$route['admin-log'] = 'Administrasi/admin_log';//=========ada
$route['account'] = 'Administrasi/security';//=================ada
$route['add-user'] = 'Administrasi/tambah_admin';//=================ada view
$route['tambah-komoditas'] = 'Administrasi/form_tambah_komoditas';//=================ada view
$route['set-aset-baru'] = 'Administrasi/set_aset_baru';//=================ada view
$route['set-mitra-baru'] = 'Administrasi/set_mitra_baru';//=================ada view
$route['set-user-baru'] = 'Administrasi/set_admin_baru';//=================ada view
$route['edit-rekn/(:num)'] = 'Administrasi/form_edit_mitra/$1';//=================ada view
$route['edit-comp-asset'] = 'Administrasi/edit_aset';//=================ada view
$route['edit-rekanan'] = 'Administrasi/edit_rekanan';//=================ada view
$route['hapus-komoditas'] = 'Administrasi/hapus_komoditas';//=================ada view
$route['hapus-satuan'] = 'Administrasi/hapus_satuan';//=================ada view
$route['hapus-aset'] = 'Administrasi/hapus_aset';//=================ada view
$route['hapus-mitra'] = 'Administrasi/hapus_mitra';//=================ada view
$route['hapus-user'] = 'Administrasi/hapus_user';//=================ada view
$route['tambah-satuan'] = 'Administrasi/tambah_satuan';//=================ada view
$route['ubah-profil'] = 'Administrasi/form_ubah_profil';//=================ada view
$route['ganti-password'] = 'Administrasi/form_ganti_password';//=================ada view
$route['detail-user/(:num)'] = 'Administrasi/detail_user/$1';//=================ada view
$route['edit-satuan'] = 'Administrasi/edit_satuan';//=================ada view
$route['edit-profil'] = 'Administrasi/edit_profil';//=================ada view
$route['ubah-password'] = 'Administrasi/ganti_password';//=================ada view
$route['log-admin'] = 'Administrasi/admin_log/json';//=================ada view
$route['detail-mit/(:num)'] = 'Administrasi/detail_mitra/$1';//=================ada view
//CONCAT(year(tanggal), "/",WEEK(tanggal))

//Rouing government
$route['gov-penjualan'] = 'Government/gov_penjualan';//=========ada view
$route['gov-penyewaan'] = 'Government/gov_penyewaan';//=========ada view
$route['gov-finansial'] = 'Government/gov_finansial';//=========ada view
$route['gov-stok-masuk'] = 'Government/gov_stok_masuk';//=========ada view
$route['gov-asset'] = 'Government/gov_asset';//=================ada view
$route['gov-kerjasama-bgh'] = 'Government/gov_kerjasama_bgh';//=================ada view
$route['gov-logistik'] = 'Government/gov_logistik';//=================ada view
$route['gov-dividen'] = 'Government/gov_dividen';//=================ada view
$route['gov-det-bghu/(:num)'] = 'Government/gov_det_bghu/$1';//=================ada view
$route['gsmj'] = 'Government/gov_stok_masuk/j';//delete
$route['gpjn'] = 'Government/gov_penjualan/j';//delete
$route['gpnw'] = 'Government/gov_penyewaan/j';//=================ada view
$route['gfin'] = 'Government/gov_finansial/j';//=================ada view
$route['gbgh'] = 'Government/gov_kerjasama_bgh/j';//=================ada view


//Routing homepage
$route['404_override'] = 'Homepage/not_found';
$route['link-not-valid'] = 'Homepage/not_found';
$route['home'] = 'Homepage/home';
$route['masuk'] = 'Homepage/login_process';//=================ada view
$route['translate_uri_dashes'] = TRUE;
$route['registrasi-admin/(:num)'] = 'Homepage/reg_admin/$1';//=================ada view
$route['ganti-password/(:num)'] = 'Homepage/forget_password/$1';//=================ada view
$route['lupa-password'] = 'Homepage/req_forget_pass';//=================ada view
$route['req-password'] = 'Homepage/req_forget_pass/submit';//=================ada view
$route['keluar-sistem'] = 'Homepage/keluar';//=================ada view
$route['konfirmasi-ganti-email/(:num)'] = 'Homepage/konfirmasi_ganti_email/$1';//=================ada view
$route['cek-mail'] = 'Administrasi/cek_mail';//=================ada view


