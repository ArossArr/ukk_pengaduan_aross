<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PengaduanM;
use App\Models\MasyarakatM;
use DateTime;

class PengaduanC extends BaseController{
    protected $png,$masy;
    function __construct()
    {
        $this->png = new PengaduanM();
        $this->masy = new MasyarakatM();
    }
    public function view()
    {
        $data['pengaduan']=$this->png->findAll();
        return view('view/pengaduanv',$data);
    }
    public function svp()
    {
        $datafile = $this->request->getFile('foto');
        $filename = $datafile->getRandomName();
        $this->png->insert([
            'nik'=>session()->get('nik'),
            'tgl'=>date('Y-m-d H:i:s'),
            'isi'=>$this->request->getPost('isi'),
            'foto'=>$filename,
            'status'=>'0'
        ]);
        $datafile->move('uploads/berkas/',$filename);
        return redirect('pengaduan');
    }
    public function deleted($id)
    {
        $this->png->delete($id);
        session()->setFlashdata("message","Data Berhasil di hapus");
        return $this->response->redirect('/pengaduan');
    }
}