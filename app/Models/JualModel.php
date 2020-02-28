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
    //nama table, pada kasus ini mengambil dari view
    protected $table = 'vjual'; //wajib table [baku]

    public function tampil()
    {
        try {
            $db = \Config\Database::connect(); //sambungkan database
            $builder = $this->db->table('vjual');
            $query = $builder->orderBy('faktur', 'desc')->get(); //ambil data
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
            $db = \Config\Database::connect(); //sambungkan database
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
            $db = \Config\Database::connect(); //sambungkan database
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
            $db = \Config\Database::connect(); //sambungkan database
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
            $db = \Config\Database::connect(); //sambungkan database
            
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