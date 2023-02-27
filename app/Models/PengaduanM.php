<?php 
namespace App\Models;

use CodeIgniter\Model;

class PengaduanM extends Model{
    protected $table      = 'tbpengaduan';
    protected $primaryKey = 'id_pengaduan';
    protected $allowedFields = ['nik','tgl','isi','foto','status'];
    protected $deleted = 'deleted_at';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
}