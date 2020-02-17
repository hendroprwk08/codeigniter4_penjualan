<?php namespace App\Models;
use CodeIgniter\Model;

/*
mengintrepretasikan table kode query sudah otomatis diubah
oleh Codeigniter 4
baca:
https://codeigniter4.github.io/userguide/models/model.html
https://codeigniter4.github.io/userguide/tutorial/news_section.html
*/

class CustomerModel extends Model
{
    //nama table
    protected $table = 'customer'; //wajib table [baku]

    //mempresentasikan kolom pada tabel [ harus sama ]
    protected $allowedFields = [ 'idcustomer',
                                 'namacustomer',
                                 'telpcustomer' ];

    public function tampil()
    {
        try {
            return  $this->orderBy( 'idcustomer', 'desc' )->findAll();
        }
        catch (\Exception $e)
        {
            die( 'Error: '. $e->getMessage() );
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
          return $this->asArray()->where( 'idcustomer', $id )->findAll();
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

            $this->where( 'idcustomer', $id)
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
            $this->where( 'idcustomer', $id )->delete();
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }
}
