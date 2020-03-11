<?php namespace App\Controllers;
use CodeIgniter\Controller;

use App\Models\CustomerModel; //import

class Customer extends Controller
{
    //kode yang dijalankan pertama kali saat Customer digunakan
    public function __construct() 
    {
        helper( [ 'url', 'form' ] ); //load url dan form helper
    }

    public function index()
    {
        //panggil model
        $model = new CustomerModel();
        
        $pager = \Config\Services::pager();
        $pager->setPath('ci4_penjualan/public/customer'); //modifikasi path link

        $data = [
            'title' => 'Table Customer',
            'data'  => $model->paginate(5),
            'pager' => $model->pager
        ];

        echo view( 'templates/header', $data );
        echo view( 'customer/customer_tabel', $data ); //lokasi fisik file
        echo view( 'templates/footer' );
    }

    public function form()
    {
        helper('form'); //load form helper

        $data['title'] = 'Tambah Data Barang';

        echo view( 'templates/header', $data );
        echo view( 'customer/customer' ); //lokasi fisik file
        echo view( 'templates/footer' );
    }

    public function simpan()
    {
        helper('url');

            $model = new CustomerModel();

            $data = [
                'idcustomer'   => $this->request->getVar('id'),
                'namacustomer' => $this->request->getVar('nama'),
                'telpcustomer'  => $this->request->getVar('telp')
            ];

            $model->simpan( $data );

            $p['pesan'] = '<p>Data '. $this->request->getVar('nama') .' berhasil disimpan.</p>'. anchor( '../customer', 'Lanjut' );

            echo view('templates/pesan', $p); //lokasi fisik file
    }

    public function ubah( $id )
    {
        helper('form'); //load form helper

        $model = new CustomerModel();

        $data['title'] = 'Pembaruan Data Supplier';
        $data['data'] = $model->pilih( $id );

        echo view( 'templates/header', $data );
        echo view( 'customer/customer_ubah', $data ); //lokasi fisik file
        echo view( 'templates/footer' );
    }

    public function perbarui()
    {
        $data = [
            'namacustomer' => $this->request->getVar('nama'),
            'telpcustomer' => $this->request->getVar('telp')
        ];

        $model = new CustomerModel();

        $model->perbarui( $this->request->getVar('id'), $data );

        $data['pesan'] = '<p>ID: '. $this->request->getVar('id') .' - '. $this->request->getVar('nama') .' berhasil diperbarui.</p>'.anchor('../customer', 'Lanjut');

        echo view( 'templates/pesan', $data ); //lokasi fisik file*/
    }

    public function hapus( $id )
    {
        $model = new CustomerModel();

        $model->hapus( $id );

        $data['pesan'] = '<p>Data dihapus.</p>'.anchor( '../customer', 'Lanjut' );

        echo view( 'templates/pesan', $data );
    }
}
