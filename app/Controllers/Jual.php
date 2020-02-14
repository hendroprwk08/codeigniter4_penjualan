<?php namespace App\Controllers;
use CodeIgniter\Controller;

use App\Models\JualModel; //import
use App\Models\BarangModel; //import
use App\Models\CustomerModel; //import

class Jual extends Controller
{
    public $cart = null;
    public $session = null;
    
    public function __construct()
    {
        helper( [ 'url', 'form' ] ); //load url helper
        $this->session = \Config\Services::session();
        $this->cart = \Config\Services::cart();
    }

    public function index()
    {   
        $this->session->remove([ 'faktur', 'tanggal', 'idcustomer', 'barang' ]); //clear session
        
        $model = new JualModel();

        $data['title'] = 'Tabel Supplier';
        $data['data'] = $model->tampil();

        echo view( 'templates/header', $data );
        echo view( 'jual/jual_tabel', $data ); //lokasi fisik file
        echo view( 'templates/footer' );
    }

    public function generate_faktur()
    {
        $model = new JualModel();
        $model->create_no_faktur();
    }

    public function form()
    {
        $this->session->set( 'edit', 'false' );
        
        $data['title'] = 'Tambah Data Penjualan';

        $cModel = new CustomerModel();
        $model = new JualModel();

        $data['customer'] = $cModel->tampil();
        $data['faktur'] = $model->create_no_faktur();
        $data['session'] = $this->session->get();
        $data['cart'] = $this->cart->contents();

        echo view( 'templates/header', $data );
        echo view( 'jual/jual', $data ); //lokasi fisik file
        echo view( 'templates/footer' );
    }

    public function tabel_barang()
    {
        $data['title'] = 'Pilih Barang Penjualan';

        $bModel = new BarangModel();

        $data['data'] = $bModel->tampil();

        echo view( 'jual/jual_pilih_barang_tabel', $data ); //lokasi fisik file	    
    }

    
    public function set_header()
    {
        $data = [ 'faktur' => $this->request->getVar('faktur'),
                     'tanggal' => $this->request->getVar('tanggal'),
                     'idcustomer' => $this->request->getVar('idcustomer') ];

        $this->session->set( $data );
       
        
        if ( $this->session->get( 'edit' ) == 'true' ) :
            $this->form_ubah();
        else:
            $this->form();
        endif;
    }
    
    public function pilih_barang()
    {
        $data = array(
                    'id'      => $this->request->getVar('id'),
                    'qty'     => $this->request->getVar('qty'),
                    'price'   => $this->request->getVar('harga'),
                    'name'    => $this->request->getVar('nama'),
                    'options' => array('diskon' => $this->request->getVar('diskon') )
                );

        $this->cart->insert( $data );

        if ( $this->session->get( 'edit' ) == 'true' ) :
            $this->form_ubah();
        else:
            $this->form();
        endif;
    }
    
    public function ubah( $id )
    {
        //-------------- hanya mempersiapkan session saja
         
        //hapus session lama 
        $this->session->remove([ 'faktur', 'tanggal', 'idcustomer' ]);
        $this->cart->destroy();
        
        $model = new JualModel();
        $result = $model->pilih( $id );
        
        //persiapan session
        $session[ 'edit' ] = 'true';
        $session[ 'faktur' ] = $result[ 0 ][ 'faktur' ];
        $session[ 'tanggal' ] = $result[ 0 ][ 'tanggal' ];
        $session[ 'idcustomer' ] = $result[ 0 ][ 'idcustomer' ];
        
        $this->session->set( $session ); 
        
        for ($i = 0; $i < count ( $result ); $i++ ):
            
            $data = array(
                    'id'      => $result [ $i ] [ 'idbarang' ],
                    'qty'     => $result [ $i ] [ 'qty' ],
                    'price'   => $result [ $i ] [ 'harga' ],
                    'name'    => $result [ $i ] [ 'namabarang' ],
                    'options' => array('diskon' => $result [ $i ] [ 'diskon' ] )
                );

             $this->cart->insert( $data );
        
        endfor;
        
        $this->form_ubah(); //buka form ubah
    }
    
     public function form_ubah()
     {
        $cModel = new CustomerModel();
        $model = new JualModel();
        
        $data['customer'] = $cModel->tampil();
        $data['session'] = $this->session->get();
        $data['cart'] = $this->cart->contents();

        echo view( 'templates/header', $data );
        echo view( 'jual/jual_ubah', $data ); //lokasi fisik file
        echo view( 'templates/footer' );
    }
    
    public function perbarui( $id )
    {
        $model = new JualModel();
        $model->hapus( $id );
        
        $this->simpan();
    }
    
    public function ubah_barang()
    {  
        
        $rowid = $this->request->getVar('rowid');
        $id = $this->request->getVar( 'id' );
        $nama = $this->request->getVar( 'namabarang' );
        $harga = $this->request->getVar( 'hargabarang' );
        $qty = $this->request->getVar( 'qtybarang' );
        $diskon = $this->request->getVar( 'diskonbarang' );
       
        if ( $qty  == '0' ):

          $this->cart->remove( $rowid );

        else:
        
            $data = array(
                        'rowid'   => $rowid,
                        'id'      => $id,
                        'qty'     => $qty,
                        'price'   => $harga,
                        'name'    => $nama,
                        'options' => array( 'diskon' => $diskon ) 
                    );
                
            $this->cart->update( $data );

        endif;

        if ( $this->session->get( 'edit' ) == 'true' ) :
            $this->form_ubah();
        else:
            $this->form();
        endif;
    }

    public function simpan()
    {
        $model = new JualModel();
        
        if ( ! $this->session->has('faktur') ) :
            $p['pesan'] = '<p>Ups!, Anda belum memiliki nomer faktur.</p>'. anchor( 'jual/form', 'Lanjut' );
            echo view('templates/pesan', $p); //lokasi fisik file
            die();    
        endif;
        
         if ( ! $this->session->has('cart_contents') ) :
            $p['pesan'] = '<p>Wah, sepertinya anda belum memilih barang.</p>'. anchor( 'jual/form', 'Lanjut' );
            echo view('templates/pesan', $p); //lokasi fisik file
            die();
        endif;

        //simpan jual
        $query = "insert into jual values ( '". $this->session->get( 'faktur' ) ."', '". 
                                                $this->session->get( 'tanggal' ) ."', '". 
                                                $this->session->get( 'idcustomer' ) ."' ); ";

        $model->simpan( $query );

        //simpan detjual
        $cart_detail = $this->cart->contents() ;
        
        foreach( $cart_detail as $row ):
            $query = "insert into detjual values ( '". $this->session->get( 'faktur' ) ."', '". 
                                                   $row[ 'id' ] ."', ". 
                                                   $row[ 'qty' ] .", ". 
                                                   $row[ 'price' ] .", ". 
                                                   $row[ 'options' ][ 'diskon' ] ." ); "; 
        
            $model->simpan( $query );
        endforeach;
        
        $this->cart->destroy();    
        $this->session->set( 'edit', 'false' );
        $this->session->remove([ 'faktur', 'tanggal', 'idcustomer']);

        $data['pesan'] = '<p>Data tersimpan.</p>'.anchor( '../jual', 'Lanjut' );
        echo view( 'templates/pesan', $data );
    }
    
    public function hapus($id)
    {
        $this->session->set( 'edit', 'false' );
         
        $model = new JualModel();
        $model->hapus( $id );
        
        $this->index();
    }
}
