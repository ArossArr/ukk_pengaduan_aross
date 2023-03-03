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
    public function lihatprofil()
    {
        $petugas = new PetugasM();
        $masy = new MasyarakatM();
        if(session('level')=='masyarakat'){
            $data['user'] = $masy->where('nik',session('nik'))->findAll();
        } else {
            $data['user'] = $petugas->where('id_petugas',session('id_petugas'))->findAll();
        }
        return view('view/profilv',$data);
    }
    public function editp()
    {
        $masyy = new MasyarakatM();
        $ptgs = new PetugasM();
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $tlp = $this->request->getPost('tlp');
        $pass_old = $this->request->getPost('password_old');
        $pass_new = $this->request->getPost('password_new');
        if(session('level')=='masyarakat'){
            $datamasy = $masyy->where('id_masyarakat',$id)->first();
            if(empty($pass_old)){
                $data = [
                    'nama'=>$nama,
                    'username'=>$username,
                    'tlp'=>$tlp,
                ];
            } else {
                if(password_verify($pass_old,$datamasy['password'])){
                    $data = [
                        'nama'=>$nama,
                        'username'=>$username,
                        'tlp'=>$tlp,
                        'password'=>password_hash($pass_new,PASSWORD_DEFAULT)
                    ];
                }
            }
            $masyy->update($id,$data);
        } else {
            $dataptgs = $ptgs->where('id_petugas',$id)->first();
            if(empty($pass_old)){
                $data = [
                    'nama'=>$nama,
                    'username'=>$username,
                    'tlp'=>$tlp,
                ];
            } else {
                if(password_verify($pass_old,$dataptgs['password'])){
                    $data = [
                        'nama'=>$nama,
                        'username'=>$username,
                        'tlp'=>$tlp,
                        'password'=>password_hash($pass_new,PASSWORD_DEFAULT)
                    ];
                }
            }
            $ptgs->update($id,$data);
        }
        session()->setFlashdata('message','Update Profil Berhasil');
        return redirect('profil');
    }
}