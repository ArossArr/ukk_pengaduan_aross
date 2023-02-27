<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MasyarakatM;
use App\Models\PetugasM;

class LoginC extends BaseController{
    protected $ptgs,$masy;
    function __construct()
    {
        $this->ptgs = new PetugasM();
        $this->masy = new MasyarakatM();
    }
    public function loginview()
    {
        return view('view/loginv');
    }
    public function plogin()
    {
        $ptgs = new PetugasM();
        $masy = new MasyarakatM();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $cekptgs = $ptgs->where(['username'=>$username])->first();
        $cekmasy = $masy->where(['username'=>$username])->first();
        if(!($cekmasy)&&!($cekptgs))
        {
            return redirect('login')->with('error',lang('Username dan Password Salah'));
        } 
        else 
        {
            if ($cekmasy)
            {
                // dd($cekmasy);
                if(password_verify($password,$cekmasy['password'])){
                    session()->set([
                        'nik'=>$cekmasy['nik'],
                        'nama'=>$cekmasy['nama'],
                        'level'=>'masyarakat',
                        'logged_in'=>true
                    ]);
                    return redirect('dashboard');
                }
                else
                {
                    return redirect('login')->with('error',lang('password salah'));
                }
            }
            if($cekptgs)
            {
                if(password_verify($password,$cekptgs['password'])){
                    session()->set([
                        'id_petugas'=>$cekptgs['id_petugas'],
                        'username'=>$cekptgs['username'],
                        'level'=>$cekptgs['level'],
                        'logged_in'=>true
                    ]);
                    return redirect('dashboard');
                }
                else
                {
                    return redirect('login')->with('error',lang('password salah'));
                }
            }
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect('login');
    }
    // Register
    public function registerview()
    {
        return view('view/registerv');
    }
    public function svreg()
    {
        $this->masy->insert([
            'nik'=>$this->request->getPost('nik'),
            'nama'=>$this->request->getPost('nama'),
            'username'=>$this->request->getPost('username'),
            'password'=>password_hash($this->request->getPost('password')."",PASSWORD_DEFAULT),
            'tlp'=>$this->request->getPost('tlp')
        ]);
        return redirect('login');
    }
}