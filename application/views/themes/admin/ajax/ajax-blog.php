<div id="posts_content">
    <?php if(!empty($posts)){ ?>
        <div class="posts_list">
            <table class="wp-list-table widefat fixed striped posts" id="table-api"> 
                <thead>  
                    <tr>
                        <th style="width:2%;">No.</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th style="text-align:center">Viewer</th>
                        <th style="width:2%;text-align:center">Status</th>
                        <th style="width:12%;text-align:right">Aksi</th>
                    </tr>
                </thead>  
                <tbody> 
                    <?php
                        $no =1;
                        foreach($posts as $aRow){
                            $kode = encrypt_url($aRow['id_post']);
                            $tgl_posting=dtimes($aRow['tanggal'], false,false);
                        ?>
                        <tr>  
                            <td><?=$no++;?></td>  
                            <td><a href="javascript:editpost('<?=$kode;?>');" data-href="<?=base_url();?>artikel/post/editpost<?=$kode;?>" class="openPopup"><?=$aRow['judul'];?></a></td>
                            <td><?=$aRow['nama_kategori']; ?></td>
                            <td align="left"><?=$tgl_posting; ?></td>  
                            <td align="center"><?=$aRow['dibaca']; ?></td>  
                            <td align="center"><?=$aRow['publish']; ?></td>  
                            <td align='right'>
                                <a href="javascript:editpost('<?=$kode;?>');" class="text-green hint--left" aria-label="Edit data"><i class='ik ik-edit'></i> Edit</a> | 
                                <a href="javascript:deletepost('<?=$kode;?>');" class="text-red hint--left" aria-label="Hapus"><i class='ik ik-trash'> Hapus</i></a>
                            </td>
                        </tr> 
                    <?php }  ?>
                </tbody>  
                <tfoot>
                    <tr>
                        <th style="width:2%;">No.</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th style="text-align:center">Viewer</th>
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