<?php namespace App\Controllers;
use CodeIgniter\Controller;

use App\Models\SupplierModel; //import

class Supplier extends Controller
{

	public function index()
	{
	    helper( [ 'url', 'form'] ); //load url helper

	    $model = new SupplierModel();

		$pager = \Config\Services::pager();
		$pager->setPath('codeigniter4_penjualan/public/supplier'); //modifikasi path link

		$data = [
			'title' => 'Table Supplier',
			'data'  => $model->paginate(5),
			'pager' => $model->pager
		];

	    echo view( 'templates/header', $data );
	    echo view( 'supplier/supplier_tabel', $data ); //lokasi fisik file
	    echo view( 'templates/footer' );
	}

	public function form()
	{
            helper('form'); //load form helper

            $data['title'] = 'Tambah Data Supplier';

            echo view( 'templates/header', $data );
            echo view( 'supplier/supplier' ); //lokasi fisik file
            echo view( 'templates/footer' );
	}

	public function simpan()
	{
            helper('url');

            $model = new SupplierModel();

            //->request = post atau get
            //->getVar = mengambil variable
            //idsupplier, namaidsupplier dst harus sama dengan ditable karen
            $data = [
                    'idsupplier'  => $this->request->getVar('id'),
                    'namasupplier'  => $this->request->getVar('nama'),
                    'alamatsupplier'  => $this->request->getVar('alamat'),
                    'telpsupplier'  => $this->request->getVar('telepon'),
                    'emailsupplier'  => $this->request->getVar('email'),
                    'picsupplier'  => $this->request->getVar('pic')
            ];

            $model->simpan( $data );

            //jika berhsil tampilkan pada view success
            //wajib tampilkan pada VIEW, jangan diletak pada controller
            $data['pesan'] = '<p>Data '.$this->request->getVar('nama'). ' berhasil disimpan.</p>'.anchor( '../supplier', 'Lanjut' );

            echo view('templates/pesan', $data); //lokasi fisik file
	}

	public function ubah( $id )
	{
	    $model = new SupplierModel();

	    helper('form'); //load form helper

	    $data['title'] = 'Pembaruan Data Supplier';
	    $data['supplier'] = $model->pilih( $id );

	    echo view( 'templates/header', $data );
	    echo view( 'supplier/supplier_ubah' ); //lokasi fisik file
	    echo view( 'templates/footer' );
	}

	public function perbarui()
	{
	    $data = [
	        'namasupplier'  => $this->request->getVar('nama'),
	        'alamatsupplier'  => $this->request->getVar('alamat'),
	        'telpsupplier'  => $this->request->getVar('telepon'),
	        'emailsupplier'  => $this->request->getVar('email'),
	        'picsupplier'  => $this->request->getVar('pic')
	    ];

	    $model = new SupplierModel();

	    $model->perbarui( $this->request->getVar('id'), $data );

	    $data['pesan'] = '<p>ID: '. $this->request->getVar('id') .' berhasil diperbarui.</p>'.anchor('../supplier', 'Lanjut');

	    echo view( 'templates/pesan', $data ); //lokasi fisik file*/
	}

	public function hapus( $id )
	{
	    $model = new SupplierModel();

	    $model->hapus( $id );

	    $data['pesan'] = '<p>Data dihapus.</p>'.anchor( '../supplier', 'Lanjut' );

	    echo view( 'templates/pesan', $data );
	}
}
