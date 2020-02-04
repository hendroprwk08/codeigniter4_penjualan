<?php namespace App\Models;
use CodeIgniter\Model;

/*
mengintrepretasikan table kode query sudah otomatis diubah
oleh Codeigniter 4
baca:
https://codeigniter4.github.io/userguide/models/model.html
https://codeigniter4.github.io/userguide/tutorial/news_section.html
*/



class BarangModel extends Model
{
    //nama table
    protected $table = 'barang'; //wajib table [baku]

    //mempresentasikan kolom pada tabel [ harus sama ]
    protected $allowedFields = ['idbarang',
                                'namabarang',
                                'hargabeli',
                                'hargajual',
                                'stok',
                                'idsupplier',
                                'expired'];

    public function tampil()
    {
        //die('masuk');
        try {
            //khusus bagian ini: menggunakan view yang telah dibuat pd database            
            $db = \Config\Database::connect(); //sambungkan database
            $builder = $db->table('vbarangsupplier');
            $query = $builder->get(); //ambil data
            $result =  $query->getResultArray(); //uraikan / tampilkan data dalam bentuk array
            
            return $result; 
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }
    
    public function simpan( $data )
    {
        //die( print_r( $data ) );
        try {
            $this->insert( $data );
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }
    
    public function pilih($id)
    {   
        try {
            //khusus bagian ini: menggunakan view yang telah dibuat pd database
            $db = \Config\Database::connect(); //sambungkan database
            $builder = $db->table('vbarangsupplier')->where('idbarang', $id);
            $query = $builder->get(); //ambil data
            $result =  $query->getResultArray(); //uraikan / tampilkan data dalam bentuk array
            
            //die ( print_r( $result ));
            
            return $result; 
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }
    
    public function perbarui( $idsupplier, $data )
    {       
        try {
            
            /* 
             * jika kolom id-nya bernama "id" 
             * maka bisa langsung 
             * $this->update($id, $data);
             */
            
            $this->where( 'idbarang', $idsupplier)
                 ->set( $data )
                 ->update();
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }
    
    public function hapus($id)
    {       
        try {
            $this->where( 'idbarang', $id )->delete();
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }
}
