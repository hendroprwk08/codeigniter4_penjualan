<?php namespace App\Controllers;
use CodeIgniter\Controller;

use App\Models\JualModel; //import
use App\Models\BarangModel; //import
use App\Models\CustomerModel; //import

class Jual extends Controller
{
    public $session = null;
    
    public function __construct()
    {
        helper( [ 'url', 'form' ] ); //load url helper
        $this->session = \Config\Services::session();
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

    public function pilih_barang()
    {
        //header session
        if ( ! $this->session->has('faktur') ) :
            $data[ 'faktur' ] = $this->request->getVar('faktur');
            $data[ 'tanggal' ] = $this->request->getVar('tanggal');
            $data[ 'idcustomer' ] = $this->request->getVar('idcustomer');
        
            $this->session->set( $data ); 
        else:
            $data = [ 'faktur' => $this->request->getVar('faktur'),
                        'tanggal' => $this->request->getVar('tanggal'),
                        'idcustomer' => $this->request->getVar('idcustomer') ];
            
            $this->session->set( $data );
        endif;
        
        $data = null;
        
        //detail session
        if ( ! $this->session->has('barang') ) 
        {
            $data[ 'barang' ][] = array (
                                        'id'      => $this->request->getVar('id'),
                                        'nama'    => $this->request->getVar('nama'),
                                        'harga'   => (int) $this->request->getVar('harga'),
                                        'qty'     => (int)$this->request->getVar('qty'),
                                        'diskon'  => (int)$this->request->getVar('diskon'),
                                        'jumlah'  => (int)$this->request->getVar('jumlah')
                                    );            

            $this->session->set( $data );
        }
        else
        {
             //append new array
            $data[] = array (
                            'id'      => $this->request->getVar('id'),
                            'nama'    => $this->request->getVar('nama'),
                            'harga'   => (int)$this->request->getVar('harga'),
                            'qty'     => (int)$this->request->getVar('qty'),
                            'diskon'  => (int)$this->request->getVar('diskon'),
                            'jumlah'  => (int)$this->request->getVar('jumlah')
                        );     
            
            $this->session->push( 'barang' , $data );
        }
        
        //die (print_r($_SESSION));
        
        if ( $this->session->get( 'edit' ) == 'true' ) :
            $this->form_ubah();
        else:
            $this->form();
        endif;
    }
    
    public function ubah( $id )
    {
        //persiapan session 
        $this->session->remove([ 'faktur', 'tanggal', 'idcustomer', 'barang' ]);
        $this->session->set( 'edit', 'true' ); //
        
        $model = new JualModel();
        $result = $model->pilih( $id );
        
        //prepare session
        $session[ 'faktur' ] = $result[ 0 ][ 'faktur' ];
        $session[ 'tanggal' ] = $result[ 0 ][ 'tanggal' ];
        $session[ 'idcustomer' ] = $result[ 0 ][ 'idcustomer' ];
        
        for ($i = 0; $i < count ( $result ); $i++ ):
            $session[ 'barang' ][] = array (
                                'id'      => $result [ $i ] [ 'idbarang' ],
                                'nama'    => $result [ $i ] [ 'namabarang' ],
                                'harga'   => $result [ $i ] [ 'harga' ],
                                'qty'     => $result [ $i ] [ 'qty' ],
                                'diskon'  => $result [ $i ] [ 'diskon' ],
                                'jumlah'  => ( (int)$result [ $i ] [ 'harga' ] - (int) $result [ $i ] [ 'diskon' ] ) * $result [ $i ] [ 'qty' ],
                            );       
        endfor;
        
        $this->session->set( $session ); //set session
        
        $this->form_ubah(); //buka form ubah
    }
    
     public function form_ubah()
     {
        $cModel = new CustomerModel();
        $model = new JualModel();
        
        $data['customer'] = $cModel->tampil();
        $data['session'] = $this->session->get();

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
        $barang = $this->session->get( 'barang' );
        $row = $this->request->getVar('row');
        $qty = $this->request->getVar('qtybarang');

        if ( $qty  == '0' ):

            //die('kosong');
            unset( $_SESSION[ 'barang' ][ $row ]);

            $barang = $this->session->get( 'barang' ); //ambil ulang array terbaru
            $barang = array_values($barang); //reindex, agar urtu dari 0 lagi

            $this->session->set( 'barang' , $barang );

        else:

            $harga = $this->request->getVar('hargabarang');
            $qty = $this->request->getVar('qtybarang');
            $diskon = $this->request->getVar('diskonbarang');
            $jumlah = ( $harga - $diskon ) * $qty;

            //update session
            $_SESSION[ 'barang' ][ $row ][ 'qty' ] = $qty;
            $_SESSION[ 'barang' ][ $row ][ 'diskon' ] = $diskon;
            $_SESSION[ 'barang' ][ $row ][ 'jumlah' ] = $jumlah;

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
        
        if ( ! $this->session->has('barang') ) :
            
            $p['pesan'] = '<p>Ups!, Anda belum melakukan transaksi apapun.</p>'. anchor( 'jual/form', 'Lanjut' );
            echo view('templates/pesan', $p); //lokasi fisik file

        else:

            //simpan jual
            $query = "insert into jual values ( '". $this->session->get( 'faktur' ) ."', '". 
                                                    $this->session->get( 'tanggal' ) ."', '". 
                                                    $this->session->get( 'idcustomer' ) ."' ); ";

            $model->simpan( $query );
            
            //simpan detjual
            $jumlah = count ( $this->session->get( 'barang' ) );
            $barang = $this->session->get( 'barang' ); //tampung session

            for ( $i = 0 ; $i < $jumlah ; $i++):
            
                $row = $barang[$i];
            
                $query = "insert into detjual values ( '". $this->session->get( 'faktur' ) ."', '". 
                                                       $row[ 'id' ] ."', ". 
                                                       $row[ 'qty' ] .", ". 
                                                       $row[ 'harga' ] .", ". 
                                                       $row[ 'diskon' ] ." ); "; 
                
                $model->simpan( $query );

            endfor;
            
            
            $this->session->set( 'edit', 'false' );
            $this->session->remove([ 'faktur', 'tanggal', 'idcustomer', 'barang' ]);
        
            $data['pesan'] = '<p>Data tersimpan.</p>'.anchor( 'jual', 'Lanjut' );
            echo view( 'templates/pesan', $data );

        endif;
    }
    
    public function hapus($id)
    {
        $this->session->set( 'edit', 'false' );
         
        $model = new JualModel();
        $model->hapus( $id );
        
        $this->index();
    }
}
