<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-edit bg-blue"></i>
                <div class="d-inline">
                    <h5>Sosmed</h5>
                    <span>Kelola data sosmed</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 d-sm-none d-md-block">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data sosmed</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <div class="card">
            <?=card_header(['title'=>'Kelola Sosmed','nama_app'=>'showBanner','info'=>'info','toltip'=>'Tambah data']);?>
            <div class="card-body">
                <div id="posts_content">
                    <?php if(!empty($posts)){ ?>
                        <div class="posts_list">
                            <table class="wp-list-table widefat fixed striped posts" id="table-banner"> 
                                <thead>  
                                    <tr>
                                        <th style="width:2%;">No.</th>
                                        <th style="width:10%;">Judul</th>
                                        <th>Url</th>
                                        <th style="width:2%;text-align:center">Tag</th>
                                        <th style="width:2%;text-align:center">Urutan</th>
                                        <th style="width:2%;text-align:center">Status</th>
                                        <th style="width:12%;text-align:right">Aksi</th>
                                    </tr>
                                </thead>  
                                <tbody> 
                                    <?php
                                        $no =1;
                                        foreach($posts as $aRow){
                                            $kode = encrypt_url($aRow['id']);
                                            if($aRow['publish']=='Y'){
                                            $aktif = '<span class="badge badge-pill badge-success mb-1">Aktif</span>';
                                            }else{
                                            $aktif = '<span class="badge badge-pill badge-danger mb-1">Tidak</span>';
                                            }
                                        ?>
                                        <tr>  
                                            <td><?=$no++;?></td>  
                                            <td><a href="javascript:showBanner('<?=$kode;?>');"  class="openPopup"><?=$aRow['judul'];?></a></td>
                                            <td><?=$aRow['link']; ?></td>
                                            <td align="center"><?=$aRow['tag']; ?></td>
                                            <td align="center"><?=$aRow['urutan']; ?></td>
                                            <td align="center"><?=$aktif; ?></td>
                                            <td align='right'>
                                                <a href="javascript:showBanner('<?=$kode;?>');" class="text-green hint--left" aria-label="Edit data"><i class='ik ik-edit'></i> Edit</a> | 
                                                <a href="javascript:deleteBanner('<?=$kode;?>','<?=$aRow['gambar'];?>');" class="text-red hint--left" aria-label="Hapus"><i class='ik ik-trash'> Hapus</i></a>
                                            </td>
                                        </tr> 
                                    <?php }  ?>
                                </tbody>  
                                <tfoot>
                                    <tr>
                                        <th style="width:2%;">No.</th>
                                        <th>Judul</th>
                                        <th style="width:15%;text-align:left">Tanggal</th>
                                        <th style="width:2%;text-align:center">Status</th>
                                        <th style="width:12%;text-align:right">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <?php }else{ ?>
                        <table class='table table-bordered'>
                            <tr>
                                <td>Belum ada data</td>
                            </tr>
                        </table>
                    <?php } ?>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div>
    </div>
    <!-- Modal -->
    <div id="bannerModal" class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form class="form-horizontal" id="submit">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add Data</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert" id="removeWarning">
                            Anda yakin ingin menghapus data ini
                        </div>
                        <input type="hidden" class="form-control" id="id" name="id">
                        <input type="hidden" class="form-control" id="type" name="type">
                      
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul">
                                </div>
                                <div class="form-group">
                                    <label>Url</label>
                                    <input type="text" name="url" id="url"  class="form-control" placeholder="https://" >
                                </div>
                                <div class="form-group">
                                    <label>Tag</label>
                                    <input type="text" name="tag" id="tag" class="form-control" placeholder="" >
                                </div>
                                <div class="form-group">
                                    <label>Urutan</label>
                                    <input type="text" name="urutan" id="urutan" class="form-control" placeholder="" >
                                </div>
                                <div class="form-group">
                                    <label>Publish</label>
                                    <select name="publish" id="publish" class="form-control">
                                        <option value="">-- Pilih ---</option>
                                        <option value="Y">Aktif</option>
                                        <option value="N">Tidak</option>
                                    </select>
                                </div>    
                      
                    </div>
                    <div class="modal-footer">
                        <button type="submit"  class="btn btn-success" id="simpan">Simpan</button>
                        <button type="button" class="btn bg-red" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        
        //Tampilkan Modal 
        function showBanner(id)
        {
            clearModalsBanner();
            
            // Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
            if(id)
            {
                $.ajax({
                    type: "POST",
                    url: "sosmed/edit",
                    dataType: 'json',
                    data: {id:id,type:"get"},
                    beforeSend: function (xhr) {
                        $(".se-pre-con").fadeIn();
                    },
                    success: function(res) {
                        $(".se-pre-con").fadeOut();
                        setModalBanner( res );
                    }
                });
            }
            // Untuk Tambahkan Data
            else
            {
                $("#bannerModal").modal("show");
                $("#myModalLabel").html("Tambah Banner");
                $("#type").val("new"); 
                
            }
        }
        
        //Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
        function setModalBanner( data )
        {
            $("#simpan").html("Update");
            $("#myModalLabel").html("EDIT Data");
            $("#id").val(data.id);
            $("#type").val("edit");
            $("#judul").val(data.judul);
            $("#url").val(data.url);
            $("#tag").val(data.tag);
            $("#publish").val(data.publish);
            $("#urutan").val(data.urutan);
            $("#bannerModal").modal("show");
            
        }
        
        //Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
        $(document).ready(function(){
            
            $('#submit').submit(function(e){
            $(".se-pre-con").fadeIn();
                e.preventDefault(); 
                $.ajax({
                    url: "/sosmed/update",
                    type:"POST",
                    data:new FormData(this),
                    processData:false,
                    contentType:false,
                    beforeSend: function (xhr) {
                        $(".se-pre-con").fadeIn();
                    },
                    success: function(data){
                        if(data.status=200){
                            showNotif('top-center','Input Data',data.msg,'success');
                            $("#table-banner").load(location.href + " #table-banner");
                            }else{
                            showNotif('top-center','Input Data',data.msg,'warning');
                        }
                        $(".se-pre-con").fadeOut('slow');
                        $('#bannerModal').modal('hide');
                        clearModalsBanner();
                        } ,error: function(xhr, status, error) {
                        showNotif('bottom-right','Update',error,'error');
                        $(".se-pre-con").fadeOut('slow');
                    }
                });
            });
        });
        
        
        //Hapus Data
        function deleteBanner(id,file)
        {
            clearModalsBanner();
            $.ajax({
                type: "POST",
                url: "/sosmed/delete",
                dataType: 'json',
                data: {id:id,file:file},
                success: function(data) {
                    showNotif('bottom-right','Hapus Data',data.msg,'success');
                    $("#table-banner").load(location.href + " #table-banner");
                }
            });
        }
        
        //Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
        function clearModalsBanner()
        {
            $("#removeWarning").hide();
            $("#id").val("").removeAttr( "disabled" );
            $("#judul").val("").removeAttr( "disabled" );
            $("#url").val("#").removeAttr( "disabled" );
            $("#urutan").val("").removeAttr( "disabled" );
            $("#publish").val("").removeAttr( "disabled" );
            $("#tag").val("").removeAttr( "disabled" );
            $("#type").val("");
        }
    </script>                                                                