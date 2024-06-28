<?php
namespace App\Controllers;
use App\Models\KecamatanModel;
use App\Models\SekolahModel;
class Sekolah extends BaseController{
public function index(){
$this->tampil(); // memanggil method tampil
}
public function tampil(){
$sekolah = new SekolahModel();
// mengambil semua data di tabel sekolah dan kecamatan menggunakan JOIN
$data['query'] = $sekolah->join('kecamatan','kecamatan.kode_kecamatan =
sekolah.kode_kecamatan')->findAll();
//mengambil nilai variabel msg pada session flashdata
$data['msg'] = session()->getFlashdata('msg');
//memanggil file view tampil
echo view('sekolah/tampil',$data);
}
public function tambah(){
$kecamatan = new KecamatanModel();
$kecamatan = $kecamatan->findAll();
$kecamatanOptions = array();
//mempersiapkan variabel array
$kecamatanOptions[''] = 'belum dipilih';
// perulangan untuk menghasilkan option value di dropdown kecamatan
foreach($kecamatan as $row){
$kecamatanOptions[$row->kode_kecamatan] = strtoupper($row->nama_kecamatan);
}
// variabel untuk list dropdown kecamatan
$data['kecamatanOptions'] = $kecamatanOptions;
$data['statusOptions'] = [''=>'Belum Dipilih','NEGERI'=>'NEGERI','SWASTA'=>'SWASTA'];
$data['jenjangOptions'] = [
''=>'Belum Dipilih',
'SD'=>'SD',
'SMP'=>'SMP',
'SMA'=>'SMA',
'SMK'=>'SMK',
];
// memanggil view form tambah
return view('sekolah/tambah',$data);
}
public function edit($npsn){
$kecamatan = new KecamatanModel();
$kecamatan = $kecamatan->findAll();
$kecamatanOptions = array();
$kecamatanOptions[''] = 'belum dipilih';
foreach($kecamatan as $row){
$kecamatanOptions[$row->kode_kecamatan] = strtoupper($row->nama_kecamatan);
}
$data['kecamatanOptions'] = $kecamatanOptions;
$data['statusOptions'] = [''=>'Belum Dipilih','NEGERI'=>'NEGERI','SWASTA'=>'SWASTA'];
$data['jenjangOptions'] = [
''=>'Belum Dipilih',
'SD'=>'SD',
'SMP'=>'SMP',
'SMA'=>'SMA',
'SMK'=>'SMK',
];
$sekolah = new SekolahModel();
// mengambil data sekolah sesuai nilai pada $npsn
$data['query'] = $sekolah->find($npsn);
// mengirimkan id yang berisi nilai $npsn
// sebagai acuan untuk update data di method update()
$data['id'] = $npsn;
return view('sekolah/edit',$data);
}
public function simpan(){
$sekolah = new SekolahModel();
// mengambil data dari masing-masing input pada form tambah
// dan disimpan pada array untuk disimpan ke tabel sekolah
$data_sekolah = [
'npsn'=>$this->request->getVar('npsn'),
'kode_kecamatan'=>$this->request->getVar('kode_kecamatan'),
'nama_sekolah'=>$this->request->getVar('nama_sekolah'),
'alamat_sekolah'=>$this->request->getVar('alamat_sekolah'),
'status'=>$this->request->getVar('status'),
'jenjang_pendidikan'=>$this->request->getVar('jenjang_pendidikan'),
'koordinat'=>$this->request->getVar('koordinat')
];
// menggunakan query builder insert
// untuk menyimpan ke tabel sekolah
$sekolah->insert($data_sekolah);
// method affectedRows() mengembalikan nilai 1
// jika insert berhasil, nilai 0 jika gagal
if($sekolah->affectedRows() > 0){
// persiapkan pesan jika insert berhasil
$msg='<div class="alert alert-primary" role="alert">Data berhasil disimpan !
</div>';
}else{
// persiapkan pesan jika insert gagal
$msg='<div class="alert alert-danger" role="alert">Data gagal disimpan
!</div>';
}
// mengirimkan nilai msg melalui flashdata
// flashdata adalah session sekali pakai
session()->setFlashdata('msg', $msg);
// memanggil index pada controller sekolah
// tujuannya agar setelah simpan, tampilan kembali ke tabel crud
return redirect()->to('sekolah');
}
public function update(){
$sekolah = new SekolahModel();
//mengambil input hidden id dari form edit
$id = $this->request->getVar('id');
$data_sekolah = [
'npsn'=>$this->request->getVar('npsn'),
'kode_kecamatan'=>$this->request->getVar('kode_kecamatan'),
'nama_sekolah'=>$this->request->getVar('nama_sekolah'),
'alamat_sekolah'=>$this->request->getVar('alamat_sekolah'),
'status'=>$this->request->getVar('status'),
'jenjang_pendidikan'=>$this->request->getVar('jenjang_pendidikan'),
'koordinat'=>$this->request->getVar('koordinat')
];
// menggunakan query builder update
// untuk mengubah data di tabel kecamatan
// berdasarkan id (kode kecamatan)
$sekolah->update($id,$data_sekolah);
if($sekolah->affectedRows() > 0){
$msg='<div class="alert alert-primary" role="alert">Data berhasil disimpan !
</div>';
}else{
$msg='<div class="alert alert-danger" role="alert">Data gagal disimpan
!</div>';
}
session()->setFlashdata('msg', $msg);
return redirect()->to('sekolah');
}
public function hapus($npsn){
$sekolah = new SekolahModel();
// menggunakan query builder delete
// untuk menghapus data di tabel sekolah
// sesuai npsn
$sekolah->delete(['npsn' => $npsn]);
if($sekolah->affectedRows() > 0){
$msg='<div class="alert alert-primary" role="alert">Data berhasil dihapus
!</div>';
}else{
$msg='<div class="alert alert-danger" role="alert">Data gagal dihapus
!</div>';
}
session()->setFlashdata('msg', $msg);
return redirect()->to('sekolah');
}
}
?>