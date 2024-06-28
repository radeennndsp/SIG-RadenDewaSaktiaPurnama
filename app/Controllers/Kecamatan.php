<?php
namespace App\Controllers;
use App\Models\KabupatenModel;
use App\Models\KecamatanModel;
class kecamatan extends BaseController{
public function index(){
$this->tampil(); // memanggil method tampil
}
public function tampil(){
$kecamatan = new KecamatanModel();
// mengambil semua data di tabel kecamatan
$data['query'] = $kecamatan->findAll();
//mengambil nilai variabel msg pada session flashdata
$data['msg'] = session()->getFlashdata('msg');
//memanggil file view tampil
echo view('kecamatan/tampil',$data);
}
public function tambah(){
$kabupaten = new KabupatenModel();
$kabupaten = $kabupaten->findAll();
$kabupatenOptions = array();
//mempersiapkan variabel array
$kabupatenOptions[''] = 'belum dipilih';
// perulangan untuk menghasilkan option value di dropdown kabupaten
foreach($kabupaten as $row){
$kabupatenOptions[$row->id_kabupaten] = strtoupper($row->nama_kabupaten);
}
// varianel untuk list dropdown kabupaten
$data['kabupatenOptions'] = $kabupatenOptions;
// memanggil view form tambah
return view('kecamatan/tambah',$data);
}
public function edit($kode_kecamatan){
$kabupaten = new KabupatenModel();
$kabupaten = $kabupaten->findAll();
$kabupatenOptions = array();
$kabupatenOptions[''] = 'belum dipilih';
foreach($kabupaten as $row){
$kabupatenOptions[$row->id_kabupaten] = strtoupper($row->nama_kabupaten);
}
$data['kabupatenOptions'] = $kabupatenOptions;
$kecamatan = new KecamatanModel();
// mengambil data kecamatan sesuai nilai pada $kode_kecamatan
$data['query'] = $kecamatan->find($kode_kecamatan);
// mengirimkan id yang berisi nilai $kode_kecamatan
// sebagai acuan untuk update data di method update()
$data['id'] = $kode_kecamatan;
return view('kecamatan/edit',$data);
}
public function simpan(){
$kecamatan = new KecamatanModel();
// mengambil data dari masing-masing input pada form tambah
// dan disimpan pada array untuk disimpan ke tabel kecamatan
$data_kecamatan = [
'kode_kecamatan'=>$this->request->getVar('kode_kecamatan'),
'id_kabupaten'=>$this->request->getVar('id_kabupaten'),
'nama_kecamatan'=>$this->request->getVar('nama_kecamatan'),
'jumlah_penduduk'=>$this->request->getVar('jumlah_penduduk'),
'luas_wilayah'=>$this->request->getVar('luas_wilayah')
];
// menggunakan query builder insert
// untuk menyimpan ke tabel kecamatan
$kecamatan->insert($data_kecamatan);
// method affectedRows() mengembalikan nilai 1
// jika insert berhasil, nilai 0 jika gagal
if($kecamatan->affectedRows() > 0){
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
// memanggil index pada controller kecamatan
// tujuannya agar setelah simpan, tampilan kembali ke tabel crud
return redirect()->to('kecamatan');
}
public function update(){
    $kecamatan = new KecamatanModel();
//mengambil input hidden id dari form edit
$id = $this->request->getVar('id');
$data_kecamatan = [
'kode_kecamatan'=>$this->request->getVar('kode_kecamatan'),
'id_kabupaten'=>$this->request->getVar('id_kabupaten'),
'nama_kecamatan'=>$this->request->getVar('nama_kecamatan'),
'jumlah_penduduk'=>$this->request->getVar('jumlah_penduduk'),
'luas_wilayah'=>$this->request->getVar('luas_wilayah')
];
// menggunakan query builder update
// untuk mengubah data di tabel kecamatan
// berdasarkan id (kode kecamatan)
$kecamatan->update($id,$data_kecamatan);
if($kecamatan->affectedRows() > 0){
$msg='<div class="alert alert-primary" role="alert">Data berhasil disimpan !
</div>';
}else{
$msg='<div class="alert alert-danger" role="alert">Data gagal disimpan
!</div>';
}
session()->setFlashdata('msg', $msg);
return redirect()->to('kecamatan');
}
public function hapus($kode_kecamatan){
$kecamatan = new KecamatanModel();
// menggunakan query builder delete
// untuk menghapus data di tabel kecamatan
// sesuai kode kecamatan
$kecamatan->delete(['kode_kecamatan' => $kode_kecamatan]);
if($kecamatan->affectedRows() > 0){
$msg='<div class="alert alert-primary" role="alert">Data berhasil dihapus
!</div>';
}else{
$msg='<div class="alert alert-danger" role="alert">Data gagal dihapus
!</div>';
}
session()->setFlashdata('msg', $msg);
return redirect()->to('kecamatan');
}
}
?>
