<?php namespace App\Models;
use CodeIgniter\Model;

/*
mengintrepretasikan table kode query sudah otomatis diubah
oleh Codeigniter 4
baca:
https://codeigniter4.github.io/userguide/models/model.html
https://codeigniter4.github.io/userguide/tutorial/news_section.html
*/

class JualModel extends Model
{
    //nama table
    protected $table = 'customer'; //wajib table [baku]

    //mempresentasikan kolom pada tabel [ harus sama ]
    protected $allowedFields = ['idcustomer',
                                'namacustomer',
                                'telpcustomer'];

    public $db = null;
    
    public function __construct() {
        $this->db = \Config\Database::connect(); //sambungkan database
    }
    
    public function tampil()
    {
        try {
            
            $builder = $this->db->table('vjual');
            $query = $builder->get(); //ambil data
            $result =  $query->getResultArray(); //uraikan / tampilkan data dalam bentuk array
            
            return $result; 
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }

    public function simpan( $query )
    {
        try {
            $this->db->query($query);
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }

    public function pilih($id)
    {
        try {
            $builder = $this->db->table('vcompletejual')
                                ->where( 'faktur', $id);
            
            $query = $builder->get(); //ambil data
            $result =  $query->getResultArray(); //uraikan / tampilkan data dalam bentuk array
            
            return $result; 
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }

    public function hapus($id)
    {
        try {
            $this->db->query('call spDelJual("'. $id .'")'); //store procedure
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }
    
    public function create_no_faktur()
    {
        try {
            //mengambil ID
            $query = $this->db->query('SELECT faktur FROM jual WHERE year(tanggal) = "'. date('Y') .'" AND month(tanggal) = "'. date('m') .'" order by faktur desc limit 1');
            $result = $query->getResultArray();
            
            $id = $result[0]['faktur'];
            
            if ( empty($id) )
            {
                $newid = 'FJ'. date('y') .''. date( 'm' ) .'001';
            }
            else
            {
                $id = ((int)substr($id, -3) + 1 );
                $newid = 'FJ'. date('y') .''. date( 'm' ) . sprintf( '%03d', $id );
                
            }
            
            //die ( print_r( $newid ) );
            return $newid;
        }
        catch (\Exception $e)
        {
            die('Error: '. $e->getMessage());
        }
    }    
}