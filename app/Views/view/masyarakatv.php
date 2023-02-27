<?=$this->extend('layouts/admin')?>
<?=$this->section('title')?>
<?=$this->endSection()?>
<?=$this->section('content')?>
<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header bg-gradient-primary">
                <h5 class="fort-weight-bold text-white">Data Masyarakat</h5>
            </div>
            <div class="card-body">
                <table class="table shadow">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nik</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Tlp</th>
                            <th>opsi</th>
                        </tr>
                        <?php
                        $no=0;
                        foreach($masyarakat as $row)
                        {
                            $data = $row['nik'].",".$row['nama'].",".$row['username'].",".$row['password'].",".$row['tlp'].",".base_url('masyarakat/edit/'.$row['id_masyarakat']);
                            $no++;
                            ?>
                            <tr class="text-center">
                                <td><?=$no?></td>
                                <td><?=$row['nik']?></td>
                                <td><?=$row['nama']?></td>
                                <td><?=$row['username']?></td>
                                <td><?=$row['tlp']?></td>
                                <td>
                                    <a href="#" data-masyarakat="<?=$data?>" data-toggle="modal" data-target="#mMasy" class="btn btn-success">Edit</a>
                                    <a href="<?=base_url('/masyarakat/delete/'.$row['id_masyarakat'])?>" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mMasy" aria-hidden="true"  tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/smasyarakat" method="post" id="fMasy" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class=" font-arial">Edit Profil</h5>
                    </div>
                    <div class="modal-body">
                        <!-- <div class="form-group">
                            <label for="">Nik</label>
                            <input type="text" name="nik" id="nik" class="form-control">
                        </div> -->
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                     <input type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group" id="rename">
                                <label class="">Rename</label>
                                <input type="checkbox" name="rename" id="rename" class="form-control">
                               </div>
                            </div>
                        </div>
                        <div class="form-group">
                                     <label for="">No.Tlp</label>
                                     <input type="text" name="tlp" id="tlp" class="form-control">
                                </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?=$this->endSection()?>
<?=$this->section('script')?>
<script>
    $(document).ready(function(){
        $('#mMasy').on('show.bs.modal',function(e){
            var button = $(e.relatedTarget);
            var data = button.data('masyarakat');
            if(data != ""){
                const barisdata = data.split(",");
                $('#nik').val(barisdata[0]),
                $('#nama').val(barisdata[1]),
                $('#username').val(barisdata[2]),
                $('#password').val(barisdata[3]),
                $('#tlp').val(barisdata[4]),
                $('#fMasy').attr('action',barisdata[5]),
                $('#rename').show();
            } else {
                $('#nik').val(""),
                $('#nama').val(""),
                $('#username').val(""),
                $('#password').val(""),
                $('#tlp').val(""),
                $('#fMasy').attr('action','/smasyarakat'),
                $('#rename').hide();
            }
        });
        $('#masyarakat').DataTable();
    })
</script>
<?=$this->endSection()?>