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
        try {
            //khusus bagian ini: menggunakan view yang telah dibuat pd database            
            $db = \Config\Database::connect();
            $builder = $this->db->table('vbarangsupplier');
            $query = $builder->orderBy('idbarang', 'desc')->get(); //ambil data
            $result =  $query->getResultArray(); //uraikan / tampilkan data dalam bentuk array
            $this->db->close();
            
            return $result; 
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }

    public function pilih( $id )
    {
        try {
            return $this->asArray()->where( 'idbarang', $id)->findAll(); //harus array
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }   
   
    public function simpan( $data )
    {
        try {
            $this->insert( $data );
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }
    
    public function total()
    {
        try {
            $db = \Config\Database::connect();
            $builder = $this->db->table('vbarangsupplier');
            $query = $builder->get(); //ambil data
            $result =  $query->getResultArray(); //uraikan / tampilkan data dalam bentuk array
            $hasil = count ( $result );
            $this->db->close();
            
            return $hasil;
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }   
    
    public function perbarui( $id, $data )
    {       
        try {
            
            /* 
             * jika kolom id-nya bernama "id" 
             * maka bisa langsung 
             * $this->update($id, $data);
             */
            
            $this->where( 'idbarang', $id)
                 ->set( $data )
                 ->update();
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }
    
    public function hapus( $id )
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
