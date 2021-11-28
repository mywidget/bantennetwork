
<div id="posts_content">
    <?php if(!empty($posts)){ ?>
        <div class="posts_list">
            <table class="wp-list-table widefat fixed striped posts" id="table-api"> 
                <thead>  
                    <tr>
                        <th style="width:2%;">No.</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th style="width:10%;">Publisher</th>
                        <th style="width:12%;">Tanggal</th>
                        <th style="width:5%;">Viewer</th>
                        <th style="width:10%;text-align:right">Aksi</th>
                    </tr>
                </thead>  
                <tbody> 
                    <?php
                        $no =$offset + 1;
                        foreach($posts as $aRow)
                        {
                            $kode = encrypt_url($aRow['id_post']);
                            $tgl_posting=dtimes($aRow['tanggal'], false,false);
                            if($aRow['status'] == 0){
                                $status = '<span class="badge badge-orange btn-flat">Terbaru</span>';
                                }elseif($aRow['status'] == 1){
                                $status = '<span class="badge btn-success btn-flat">Breaking</span>';
                                }elseif($aRow['status'] == 2){
                                $status = '<span class="badge bg-navy btn-flat">Headline</span>';
                                }elseif($aRow['status'] == 3){
                                $status = '<span class="badge btn-primary btn-flat">Utama</span>';
                                }else{
                                $status = '<span class="badge bg-purple btn-flat">Pilihan</span>';
                            }
                        ?>
                        <tr>  
                            <td><?=$no++;?></td>  
                            <td><a  href="<?=base_url();?>artikel/edit-post/<?=$kode;?>"><?=$aRow['judul'];?></a></td>
                            <td><?=$aRow['nama_kategori'];?></td>
                            <td><?=$status; ?></td>
                            <td><?=$aRow['nama_lengkap']; ?></td>
                            <td align="left"><?=$tgl_posting; ?></td>  
                            <td><?=$aRow['dibaca']; ?></td>
                            <td align='right'>
                            <a href="<?=base_url();?>artikel/edit-post/<?=$kode;?>"><i class='ik ik-edit'></i> Edit</a></a> | <a href="javascript:deleteberita('<?=$kode;?>');" class="text-red hint--left" aria-label="Hapus"><i class='ik ik-trash'> Hapus</i></a>
                        </td>
                    </tr> 
                <?php }  ?>
            </tbody>  
            <tfoot>
                <tr>
                    <th style="width:2%;">No.</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th style="width:10%;">Publisher</th>
                    <th style="width:12%;">Tanggal</th>
                    <th style="width:5%;">Viewer</th>
                    <th style="width:10%;text-align:right">Aksi</th>
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
