<?php 
namespace App\Models;

use CodeIgniter\Model;

class TanggapanM extends Model{
    protected $table      = 'tbtanggapan';
    protected $primaryKey = 'id_tanggapan';
    protected $allowedFields = ['id_pengaduan','id_petugas','tgl','tanggapan'];
    protected $deleted = 'deleted_at';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
}