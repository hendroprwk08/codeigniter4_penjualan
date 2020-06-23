<?php namespace App\Controllers;
use CodeIgniter\Controller;

use App\Models\BarangModel; //import
use App\Models\SupplierModel ;

class Barang extends Controller
{
    
    public $session = null;
    
    public function __construct()
    {
        helper( [ 'url', 'form' ] );
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $model = new BarangModel();
        $pager = \Config\Services::pager();
        $pencarian = "";

        //tampung pada session
        if ( $this->request->getVar('cari') != "" ) 
            $this->session->set( 'cari_barang', $this->request->getVar('cari') );
        
        //jika ada pencarian
        if ( $this->session->get( 'cari_barang') != "" ):
            $pencarian = $this->session->get( 'cari_barang' );
            $pager->setPath('codeigniter4_penjualan/public/barang'); //modifikasi path link
            $tabledata = $model->cari( $this->session->get( 'cari_barang') )->paginate(5);
        else:
            $pager->setPath('codeigniter4_penjualan/public/barang'); //modifikasi path link
            $tabledata = $model->paginate(5);            
        endif;    
        
        $data = [
            'title' => 'Table Barang',
            'data'  => $tabledata,
            'pencarian'  => $pencarian,
            'pager' => $model->pager
        ];
        
        echo view( 'templates/header', $data );
        echo view( 'barang/barang_tabel', $data ); //lokasi fisik file
        echo view( 'templates/footer' );
    }
   
    public function reset(){
        $this->session->remove( 'cari_barang' );
        return redirect()->to( base_url().'barang' );
    }

    public function form()
    {
        $smodel = new SupplierModel();

        $data['title'] = 'Tambah Data Barang';
        $data['supplier'] = $smodel->tampil();

        echo view( 'templates/header', $data );
        echo view( 'barang/barang', $data ); //lokasi fisik file
        echo view( 'templates/footer' );
    }

    public function simpan()
    {
        $data = [
            'idbarang'   => $this->request->getVar('id'),
            'namabarang' => $this->request->getVar('nama'),
            'hargabeli'  => $this->request->getVar('beli'),
            'hargajual'  => $this->request->getVar('jual'),
            'stok'       => $this->request->getVar('stok'),
            'idsupplier' => $this->request->getVar('idsupplier'),
            'expired'    => $this->request->getVar('expired')
        ];
        
        $model = new BarangModel();
        $model->simpan( $data );

        $p[ 'pesan' ] = '<p>Data '. $this->request->getVar('nama') .' berhasil disimpan.</p>'. anchor( '../barang', 'Lanjut' );

        echo view('templates/pesan', $p); //lokasi fisik file
    }

    public function ubah( $id )
    {
        $model = new BarangModel();

        $data['title'] = 'Pembaruan Data Supplier';
        $data['data'] = $model->pilih( $id );

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

        $data['pesan'] = '<p>ID: '. $this->request->getVar('id') .' berhasil diperbarui.</p>'.anchor('../barang', 'Lanjut');

        echo view( 'templates/pesan', $data ); //lokasi fisik file*/
    }

    public function hapus( $id )
    {
        $model = new BarangModel();

        $model->hapus( $id );

        $p['pesan'] = '<p>Data dihapus.</p>'.anchor( '../barang', 'Lanjut' );

        echo view( 'templates/pesan', $p );
    }
}