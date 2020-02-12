<?php namespace App\Models;
use CodeIgniter\Model;

/*
mengintrepretasikan table kode query sudah otomatis diubah
oleh Codeigniter 4
baca:
https://codeigniter4.github.io/userguide/models/model.html
https://codeigniter4.github.io/userguide/tutorial/news_section.html
*/

class SupplierModel extends Model
{
    //nama table
    protected $table = 'supplier'; //wajib table [baku]

    //mempresentasikan kolom pada tabel [ harus sama ]
    protected $allowedFields = ['idsupplier',
                              'namasupplier',
                              'alamatsupplier',
                              'telpsupplier',
                              'emailsupplier',
                              'picsupplier'];

    public function tampil()
    {
        try {
            return $this->orderBy('idsupplier', 'desc')->findAll();
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }
    
    public function simpan( $data )
    {
        try {
            $this->insert($data);
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }
    
    public function pilih($id)
    {   
        try {
            return $this->asArray()->where( 'idsupplier', $id )->findAll();
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
            
            $this->where( 'idsupplier', $idsupplier)
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
            $this->where( 'idsupplier', $id )->delete();
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }
}
