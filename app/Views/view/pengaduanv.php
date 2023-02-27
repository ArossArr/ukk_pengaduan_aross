<?=$this->extend('layouts/admin')?>
<?=$this->section('title')?>
<?=$this->endSection()?>
<?=$this->section('content')?>
<div class="row">
    <div class="col">
        <?php if(session('level')=='masyarakat'){
            ?>
            <a href="#" data-pengaduan="" data-toggle="modal" data-target="#mPengaduan" class="btn btn-primary mb-3">Tambah Pengaduan</a>
            <?php
        }?>
        
        <div class="card shadow">
            <div class="card-header bg-gradient-primary">
                <h5 class="fort-weight-bold text-white">Data Pengaduan</h5>
            </div>
            <div class="card-body">
                <table class="table shadow">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nik</th>
                            <th>Tanggal Pengaduan</th>
                            <th>Isi</th>
                            <th>Foto</th>
                            <th> <?php if(session('level')!='masyarakat'){
                                    ?>
                                    Status
                                    <?php
                                }?></th>
                            <th>Opsi</th>
                        </tr>
                        <?php
                        $no=0;
                        foreach($pengaduan as $row)
                        {
                            $data = $row['nik'].",".$row['tgl'].",".$row['isi'].",".$row['foto'].",".$row['status'];
                            $no++;
                            ?>
                            <tr class="text-center">
                                <td><?=$no?></td>
                                <td><?=$row['nik']?></td>
                                <td><?=$row['tgl']?></td>
                                <td><?=$row['isi']?></td>
                                <td><?=$row['foto']?></td>
                                <td> <?php if(session('level')!='masyarakat'){
                                    ?>
                                    <?=$row['status']?>
                                    <?php
                                }?></td>
                                <td>
                                <?php if(session('level')=='masyarakat'){
                                    if($row['status']=='0'){
                                        ?>
                                        <a href="<?=base_url('/pengaduan/delete/'.$row['id_pengaduan'])?>" class="btn btn-danger" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
                                        <?php
                                    }
                                } else {
                                
                                }
                                if(!empty(session('level'))&& session('level') != 'masyarakat'){
                                    if($row['status']==0){
                                        ?>
                                        <a href="#" data-pengaduan="<?=$data?>" data-toggle="modal" data-target="#mTanggapan" class="btn btn-primary">Tanggapi</a>
                                        <?php
                                    }
                                } else {

                                }
                                ?>
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
<div class="modal fade" id="mPengaduan" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/spengaduan" method="post" id="fpengaduan" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5>Pengaduan Masyarakat</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Isi Laporan : </label>
                        <textarea name="isi" id="isi" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Foto : </label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Tanggapan -->
<div class="modal fade" id="mTanggapan" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/stanggapan" method="post" id="fTanggapan" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5>Tanggapi Pengaduan</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tanggapi : </label>
                        <textarea name="tanggapan" id="tanggapan" cols="30" rows="10" class="form-control"></textarea>
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