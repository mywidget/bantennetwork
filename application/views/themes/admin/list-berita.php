<?=page_header(['title'=>'Berita']);?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <?=card_header(['title'=>'Kelola Berita','nama_app'=>'addpost','info'=>'info','toltip'=>'Tambah data']);?>
            <div class="card-body">
                <div class="row mb-10">
                    <div class="col-md-2">
                        <select id="sortBy" class="form-control" onchange="searchFilter()">
                            <option value="">Sort By</option>
                            <option value="desc">DESC</option>
                            <option value="asc">ASC</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select id="cat" class="form-control" onchange="searchFilter()">
                            <option value="">Semua rubrik</option>
                            <?php
                                foreach($kategori as $row){
                                    echo '<option value="'.$row->id_cat.'">'.$row->nama_kategori.'</option>';    
                                }
                            ?>
                            
                        </select>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="keywords" placeholder="cari data" onkeyup="searchFilter()"/>
                    </div>
                    
                </div>
                <div class="loading-overlay" style="display:none"><div class="overlay-content">Loading.....</div></div>
                <div id="posts_content">
                    <?php if(!empty($posts)){ ?>
                        <div class="posts_list table-responsive">
                            <table class="wp-list-table widefat fixed striped posts" id="table-api"> 
                                <thead>  
                                    <tr>
                                        <th style="width:2%;">No.</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th  style="width:15%;text-align:left">Tanggal</th>
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
                                            $tgl_posting=tgl_tiket($aRow['tanggal'], true);
                                            if($aRow['publish']=='Y'){
                                                $aktif = '<span class="badge badge-pill badge-success mb-1">Aktif</span>';
                                                }else{
                                                $aktif = '<span class="badge badge-pill badge-danger mb-1">Tidak</span>';
                                            }
                                        ?>
                                        <tr>  
                                            <td><?=$no++;?></td>  
                                            <td><a href="javascript:editpost('<?=$kode;?>');" data-href="<?=base_url();?>artikel/post/editpost<?=$kode;?>" class="openPopup" title="<?=$aRow['judul'];?>"><?=kata($aRow['judul'],70);?></a></td>
                                            <td><?=$aRow['nama_kategori']; ?></td>
                                            <td align="left"><?=$tgl_posting; ?></td>  
                                            <td align="center"><?=$aRow['dibaca']; ?></td>  
                                            <td align="center"><?=$aktif; ?></td>  
                                            <td align='right'>
                                                <a href="javascript:editpost('<?=$kode;?>');" class="text-green hint--left" aria-label="Edit data"><i class='ik ik-edit'></i> Edit</a> | 
                                                <a href="javascript:deletepost('<?=$kode;?>','<?=$aRow['gambar'];?>');" class="text-red hint--left" aria-label="Hapus"><i class='ik ik-trash'> Hapus</i></a>
                                            </td>
                                        </tr> 
                                    <?php }  ?>
                                </tbody>  
                                <tfoot>
                                    <tr>
                                        <th style="width:2%;">No.</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th  style="width:15%;text-align:left">Tanggal</th>
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
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div>
</div>
<?php
    $status = '';
    if(!empty($this->session->flashdata('message')))
    {
        if($this->session->flashdata('message')=='update'){
            $status = 'update';
            }elseif($this->session->flashdata('message')=='insert'){
            $status = 'insert';
        }
    }
?>
<script>
    $('document').ready(function () {
        var status = '<?=$status;?>';
        if(status=='update'){
            showNotif('bottom-right','Udate sukses','Berita berhasil di update','success');
            }else if(status=='insert'){
            showNotif('bottom-right','Input sukses','Berita berhasil di simpan','success');
            }
    });
    function searchFilter(page_num){
        page_num = page_num?page_num:0;
        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var cat = $('#cat').val();
        $.ajax({
            type: 'POST',
            url: base_url+'berita/ajaxBlog/'+page_num,
            data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&cat='+cat,
            beforeSend: function(){
                $('.loading').show();
            },
            success: function(html){
                $('#posts_content').html(html);
                $('.loading').fadeOut("slow");
            }
        });
    }
    function addpost()
    {
        window.location.href='/berita/post/addpost';
    }
    function editpost(a)
    {
        window.location.href='/berita/post/editpost/'+a;
    }
    function deletepost(id,file)
    {
        // console.log(a);
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/berita/deletepost/",
                    data: {'id' : id,'file':file},
                    cache : false,
                    dataType:'json',
                    beforeSend: function (xhr) {
                        // $("#load").show();
                    },
                    success: function(data){
                        if(data.status=='ok'){
                            swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Data berhasil dihapus.',
                            'success'
                            )
                            }else{
                            swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Data gagal dihapus.',
                            'error'
                            )
                        }
                        searchFilter();
                        } ,error: function(xhr, status, error) {
                        swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                        )
                    },
                });
                // swalWithBootstrapButtons.fire(
                // 'Deleted!',
                // 'Your file has been deleted.',
                // 'success'
                // )
            } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Data gagal dihapus',
                'error'
                )
            }
        })
        // window.location.href='/artikel/deletepost/'+a;
    }
</script>