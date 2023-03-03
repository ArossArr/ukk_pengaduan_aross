<?=$this->extend('layouts/admin')?>
<?=$this->section('title')?>
<?=$this->endSection()?>
<?=$this->section('content')?>
<div class="row">
     <div class="col">
          <?php
          if(!empty(session()->getFlashdata('message'))) : ?>
               <div class="alert alert-danger">
                    <?=session()->getFlashdata('message')?>
               </div>
          <?php endif?>
          <div class="card">
               <div class="card-header">
                    <h3>Edit Profil</h3>
               </div>
               <form action="/editp" method="post">
               <div class="card-body">
                    <?php
                    if(session('level')=='masyarakat'){
                         $id = $user[0]['id_masyarakat'];
                         $nama = $user[0]['nama'];
                         $username = $user[0]['username'];
                         $tlp = $user[0]['tlp'];
                    } else {
                         $id = $user[0]['id_petugas'];
                         $nama = $user[0]['nama'];
                         $username = $user[0]['username'];
                         $tlp = $user[0]['tlp'];
                    }
                    ?>
                    <input type="hidden" name="id" value="<?=$id?>">
                    <div class="form-group">
                         <label for="">Nama</label>
                         <input type="text" name="nama" id="nama" class="form-control">
                    </div>
                    <div class="form-group">
                         <label for="">Username</label>
                         <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                         <label for="">No.Tlp</label>
                         <input type="text" name="tlp" id="tlp" class="form-control">
                    </div>
                    <div class="form-group">
                         <label for="">Password Lama <mark class="bg-danger">Kosongkan jika Tidak ingin ganti</mark></label>
                         <input type="password" name="password_old" id="password_old" class="form-control">
                    </div>
                    <div class="form-group">
                         <label for="">Password Baru <mark class="bg-danger">Kosongkan jika Tidak ingin ganti</mark></label>
                         <input type="password" name="password_new" id="password_new" class="form-control">
                    </div>
               </div>
               <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
               </div>
               </form>
          </div>
     </div>
</div>
<?=$this->endSection()?>