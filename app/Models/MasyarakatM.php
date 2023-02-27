<?php 
namespace App\Models;

use CodeIgniter\Model;

class MasyarakatM extends Model{
    protected $table      = 'tbmasyarakat';
    protected $primaryKey = 'id_masyarakat';
    protected $allowedFields = ['nik','nama','username','password','tlp'];
    protected $deleted = 'deleted_at';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
}