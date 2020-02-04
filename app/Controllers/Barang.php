<?php namespace App\Controllers;
use CodeIgniter\Controller;

use App\Models\BarangModel; //import
use App\Models\SupplierModel ; //import

class Barang extends Controller
{

	public function index()
	{
	    helper('url'); //load url helper
	    
	    $model = new BarangModel();
	    
	    $data['title'] = 'Tabel Barang';
	    
	    /*ambil data supplier, karena memerlukan informasi 
	     * supplier yang akan ditampilkan pada barang
	     */ 
	    $data['barang'] = $model->tampil();
	    
	    echo view( 'templates/header', $data );
	    echo view( 'barang/barang_tabel', $data ); //lokasi fisik file
	    echo view( 'templates/footer' );
	}
	
	public function form()
	{
		helper('form'); //load form helper
		
		$smodel = new SupplierModel();
		
		$data['title'] = 'Tambah Data Barang';
		$data['supplier'] = $smodel->tampil();
		
		echo view( 'templates/header', $data );
	    echo view( 'barang/barang', $data ); //lokasi fisik file
		echo view( 'templates/footer' );
	}

	public function simpan()
	{
	    helper('url');

		$model = new BarangModel();
		
		$data = [
		    'idbarang'   => $this->request->getVar('id'),
		    'namabarang' => $this->request->getVar('nama'),
		    'hargabeli'  => $this->request->getVar('beli'),
		    'hargajual'  => $this->request->getVar('jual'),
		    'stok'      => $this->request->getVar('stok'),
		    'idsupplier' => $this->request->getVar('idsupplier'),
		    'expired'    => $this->request->getVar('expired')
		];
		
		$model->simpan( $data );

		$p['pesan'] = '<p>Data '. $this->request->getVar('nama') .' berhasil disimpan.</p>'. anchor( 'barang', 'Lanjut' );
		
		echo view('templates/pesan', $p); //lokasi fisik file
	}
	
	public function ubah( $id )
	{   
	    helper('form'); //load form helper
	    
	    $model = new BarangModel();
	    
	    $data['title'] = 'Pembaruan Data Supplier';
	    $data['barang'] = $model->pilih( $id );
	    
	    $smodel = new SupplierModel();
	    $data['supplier'] = $smodel->tampil();
	    
	    echo view( 'templates/header', $data );
	    echo view( 'barang/barang_ubah', $data ); //lokasi fisik file
	    echo view( 'templates/footer' );
	}
	
	public function perbarui()
	{
	    $data = [
	        'namabarang' => $this->request->getVar('nama'),
	        'hargabeli'  => $this->request->getVar('beli'),
	        'hargajual'  => $this->request->getVar('jual'),
	        'stok'      => $this->request->getVar('stok'),
	        'idsupplier' => $this->request->getVar('idsupplier'),
	        'expired'    => $this->request->getVar('expired')
	    ];
	    
	    $model = new BarangModel();
	    
	    $model->perbarui( $this->request->getVar('id'), $data );
	    
	    $data['pesan'] = '<p>ID: '. $this->request->getVar('id') .' berhasil diperbarui.</p>'.anchor('barang', 'Lanjut');
	    
	    echo view( 'templates/pesan', $data ); //lokasi fisik file*/
	}
	
	public function hapus( $id )
	{
	    $model = new BarangModel();
	    
	    $model->hapus( $id );
	    
	    $data['pesan'] = '<p>Data dihapus.</p>'.anchor( 'barang', 'Lanjut' );
	    
	    echo view( 'templates/pesan', $data ); 
	}
}
