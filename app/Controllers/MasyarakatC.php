<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MasyarakatM;
class MasyarakatC extends BaseController{
    protected $masy;
    function __construct()
    {
        $this->masy = new MasyarakatM();
    }
    public function view()
    {
        $data['masyarakat']=$this->masy->findAll();
        return view ('view/masyarakatv',$data);
    }
    public function edit($id)
    {
        if($this->request->getPost('rename')== null){
            $data = array(
            'nama'=>$this->request->getPost('nama'),
            'username'=>$this->request->getPost('username'),
            'password'=>password_hash($this->request->getPost('password')."", PASSWORD_DEFAULT),
            'tlp'=>$this->request->getPost('tlp'),
            );
            $this->masy->update($id,$data);
        } else {
            $data = array(
            'nama'=>$this->request->getPost('nama'),
            'username'=>$this->request->getPost('username'),
            'tlp'=>$this->request->getPost('tlp'),
            );
            $this->masy->update($id,$data);
        }
        session()->setFlashdata("message","Data berhasil Diubah");
        return $this->response->redirect('/masyarakat');
    }
    public function deleted($id)
    {
        $this->masy->delete($id);
        session()->setFlashdata("message","Data Berhasil di hapus");
        return $this->response->redirect('/masyarakat');
    }
}