<?=$this->extend('layouts/admin')?>
<?=$this->section('title')?>
<?=$this->endSection()?>
<?=$this->section('content')?>
<div class="row">
    <div class="col">
    <a href="#" data-petugas="" data-toggle="modal" data-target="#mPetugas" class="btn btn-primary mb-3">Tambah Petugas</a>
        <div class="card shadow">
            <div class="card-header bg-gradient-primary">
                <h5 class="fort-weight-bold text-white">Data Petugas</h5>
            </div>
            <div class="card-body">
                <table class="table shadow">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Tlp</th>
                            <th>Status</th>
                            <th>opsi</th>
                        </tr>
                        <?php
                        $no=0;
                        foreach($petugas as $row)
                        {
                            $data = $row['nama'].",".$row['username'].",".$row['password'].",".$row['tlp'].",".$row['level'].",".base_url('/petugas/edit/'.$row['id_petugas']);
                            $no++;
                            ?>
                            <tr class="text-center">
                                <td><?=$no?></td>
                                <td><?=$row['nama']?></td>
                                <td><?=$row['username']?></td>
                                <td><?=$row['tlp']?></td>
                                <td><?=$row['level']?></td>
                                <td>
                                    <a href="#" data-petugas="<?=$data?>" data-toggle="modal" data-target="#mPetugas" class="btn btn-success">Edit</a>
                                    <a href="<?=base_url('petugas/delete/'.$row['id_petugas'])?>" onclick="return confirm('yakin mau hapus')" class="btn btn-danger">Hapus</a>
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
<div class="modal fade" id="mPetugas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="">Tambah Petugas</h5>
            </div>
            <div class="modal-body">
            <form action="/spetugas" method="post" id="fPetugas" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" id="username" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">No.Tlp</label>
                    <input type="text" name="tlp" id="tlp" class="form-control">
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                    <label for="">Status</label>
                    <select name="level" id="level" class="form-control col-md-6">
                        <option value="">Pilihan</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                    </select>
                    </div>
                    <div class="col-sm-6 " id="rename">
                    <label for="" class="">Rename Password</label>
                    <input type="checkbox" name="rename" id="rename" class="form-control col-md-7">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button>
            </div>
            </form>
        </div>
    </div>
</div>
<?=$this->endSection()?>
<?=$this->section('script')?>
<script>
    $(document).ready(function(){
        $('#mPetugas').on('show.bs.modal',function(e){
            var button = $(e.relatedTarget);
            var data = button.data('petugas');
            if(data != ""){
                const barisdata = data.split(",");
                $('#nama').val(barisdata[0]),
                $('#username').val(barisdata[1]),
                $('#password').val(barisdata[2]),
                $('#tlp').val(barisdata[3]),
                $('#level').val(barisdata[4]),
                $('#fPetugas').attr('action',barisdata[5]),
                $('#rename').show();
            } else {
                $('#nama').val(""),
                $('#username').val(""),
                $('#password').val(""),
                $('#tlp').val(""),
                $('#level').val(""),
                $('#fPetugas').attr('action','/spetugas'),
                $('#rename').hide();
            }
        });
        $('#petugas').DataTable();
    })
</script>
<?=$this->endSection()?>