<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TanggapanM;
use App\Models\PetugasM;
use App\Models\PengaduanM;
use App\Models\MasyarakatM;
use CodeIgniter\Session\Session;
class TanggapanC extends BaseController{
    protected $ptgs, $tgpn, $png, $db, $masy, $session;
    function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->ptgs = new PetugasM();
        $this->tgpn = new TanggapanM();
        $this->png = new PengaduanM();
        $this->masy = new MasyarakatM();
        $this->session = session();
    }
    public function view()
    {
        $data['tanggapan']= $this->tgpn->findAll();
    return view('view/tanggapanv',$data);
    }
    public function svt()
    {
        // $tb = $this->db->table('tbpengaduan a, tbpetugas b, tbtanggapan c,tbmasyarakat d')
        // $idp = "a.id_pengaduan = c.id_pengaduan and b.id_petugas = c.id_petugas and c.id_tanggapan='$id'";
        // $vtb = $tb->where($idp);
        $this->tgpn->insert([
            'tgl_tanggapan'=>date('Y-m-d H:i:s'),
            'tanggapan'=>$this->request->getPost('tanggapan'),
            'id_pengaduan'=>$this->session->get('id_pengaduan'),
            'id_petugas'=>$this->session->get('id_petugas')
        ]);
        return redirect('tanggapan');
    }
}