<?=$this->extend('layouts/admin')?>
<?=$this->section('title')?>
<?=$this->endSection()?>
<?=$this->section('content')?>
<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header bg-gradient-primary">
                <h5 class="fort-weight-bold text-white">Data Tanggapan</h5>
            </div>
            <div class="card-body">
                <table class="table shadow">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nik</th>
                            <th>Tgl Pengaduan</th>
                            <th>Isi Pengaduan</th>
                            <th>Foto</th>
                            <th>Nama Petugas</th>
                        </tr>
                        <?php
                        $no=0;
                        foreach($tanggapan as $row)
                        {
                            $data = $row['nik'].",".$row['nama'].",".$row['username'].",".$row['tlp'];
                            $no++;
                            ?>
                            <tr class="text-center">
                                <?php if(session('status')!= '0'){

                                }?>
                                <td><?=$no?></td>
                                <td><?=$row['nik']?></td>
                                <td><?=$row['nama']?></td>
                                <td><?=$row['username']?></td>
                                <td><?=$row['tlp']?></td>
                                <td>
                                    <a href="" class="btn btn-success">Edit</a>
                                    <a href="" class="btn btn-danger">Hapus</a>
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
<?=$this->endSection()?>