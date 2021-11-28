<div id="posts_content">
    <?php if(!empty($posts)){ ?>
        <div class="posts_list">
            <table class="wp-list-table widefat fixed striped posts" id="table-api"> 
                <thead>  
                    <tr>
                        <th style="width:2%;">No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th style="width:5%;">Level</th>
                        <th style="width:2%;text-align:center">Status</th>
                        <th style="width:12%;text-align:right">Aksi</th>
                    </tr>
                </thead>  
                <tbody> 
                    <?php
                        $no =1;
                        foreach($posts as $aRow){
                            $kode = encrypt_url($aRow['id_user']);
                        ?>
                        <tr>  
                            <td><?=$no++;?></td>  
                            <td><a href="javascript:pengguna('<?=$kode;?>');" class="hint--right" aria-label="Edit data"><?=$aRow['nama_lengkap'];?></a></td>
                            <td><?=$aRow['email']; ?></td>
                            <td><?=$aRow['no_hp']; ?></td>
                            <td><?=$aRow['level']; ?></td>
                            <td align="center"><?=$aRow['aktif']; ?></td>  
                            <td align='right'>
                                <a href="javascript:pengguna('<?=$kode;?>');" class="text-green hint--left" aria-label="Edit data"><i class='ik ik-edit'></i> Edit</a> | 
                                <a href="javascript:deletepengguna('<?=$kode;?>');" class="text-red hint--left" aria-label="Hapus"><i class='ik ik-trash'> Hapus</i></a>
                            </td>
                        </tr> 
                    <?php } ?>
                </tbody>  
                <tfoot>
                    <tr>
                        <th style="width:2%;">No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th style="width:5%;">Level</th>
                        <th style="width:2%;text-align:center">Status</th>
                        <th style="width:12%;text-align:right">Aksi</th>
                    </tr>
                </tfoot>
            </table>  
        </div>
        <?php echo $this->ajax_pagination->create_links(); ?>
        <?php }else{ ?>
        <table class='table table-bordered'>
            <tr>
                <td>Belum ada data</td>
            </tr>
        </table>
    <?php } ?>
</div>