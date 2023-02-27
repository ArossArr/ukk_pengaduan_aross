<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PetugasM;
class PetugasC extends BaseController{
    protected $ptgs;
    function __construct()
    {
        $this->ptgs = new PetugasM();
    }
    public function view()
    {
        $data['petugas']=$this->ptgs->findAll();
        return view ('view/petugasv',$data);
    }
    public function sv()
    {
        $this->ptgs->insert([
            'nama'=>$this->request->getPost('nama'),
            'username'=>$this->request->getPost('username'),
            'password'=>password_hash($this->request->getPost('password')."",PASSWORD_DEFAULT),
            'tlp'=>$this->request->getPost('tlp'),
            'level'=>$this->request->getPost('level'),
        ]);
        return redirect('petugas');
    }
    public function deleted($id)
    {
        $this->ptgs->delete($id);
        session()->setFlashdata("message","Data Berhasil di hapus");
        return redirect('petugas');
    }
    public function edit($id)
    {
        if($this->request->getPost('rename')== null){
            $data = array(
            'nama'=>$this->request->getPost('nama'),
            'username'=>$this->request->getPost('username'),
            'password'=>password_hash($this->request->getPost('password')."", PASSWORD_DEFAULT),
            'tlp'=>$this->request->getPost('tlp'),
            'level'=>$this->request->getPost('level'),
            );
            $this->ptgs->update($id,$data);
        } else {
            $data = array(
            'nama'=>$this->request->getPost('nama'),
            'username'=>$this->request->getPost('username'),
            'password'=>password_hash($this->request->getPost('password')."", PASSWORD_DEFAULT),
            'tlp'=>$this->request->getPost('tlp'),
            'level'=>$this->request->getPost('level'),
            );
            $this->ptgs->update($id,$data);
        }
        session()->setFlashdata("message","Data berhasil Diubah");
        return $this->response->redirect('/petugas');
    }

}