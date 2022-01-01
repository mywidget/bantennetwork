<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-edit bg-blue"></i>
                <div class="d-inline">
                    <h5>Widget</h5>
                    <span>Kelola data Widget</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 d-sm-none d-md-block">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Widget</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <div class="card">
            <?=card_header(['title'=>'Kelola Widget','nama_app'=>'showBanner','info'=>'info','toltip'=>'Tambah data']);?>
            <div class="card-body">
                <div id="posts_content">
                    <?php if(!empty($posts)){ ?>
                        <div class="posts_list">
                            <table class="wp-list-table widefat fixed striped posts" id="table-banner"> 
                                <thead>  
                                    <tr>
                                        <th style="width:2%;">No.</th>
                                        <th>Judul Widget</th>
                                        <th>Rubrik</th>
                                        <th style="width:2%;text-align:center">Posisi</th>
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
                                            if($aRow['pub']==0){
                                                $aktif = '<span class="badge badge-pill badge-success mb-1">Aktif</span>';
                                                }else{
                                                $aktif = '<span class="badge badge-pill badge-danger mb-1">Tidak</span>';
                                            }
                                            if($aRow['posisi']==1){
                                                $posisi = '<span class="badge badge-pill badge-success mb-1">Kiri</span>';
                                                }else{
                                                $posisi = '<span class="badge badge-pill badge-primary mb-1">Kanan</span>';
                                            }
                                        ?>
                                        <tr>  
                                            <td><?=$no++;?></td>  
                                            <td><a href="javascript:showBanner('<?=$kode;?>');"  class="openPopup"><?=$aRow['title'];?></a></td>
                                            <td><span class="badge badge-pill badge-primary mb-1"><?=data_cat($aRow['id_cat']); ?></span></td>
                                            <td align="center"><?=$posisi; ?></td>
                                            <td align="center"><?=$aRow['urutan']; ?></td>
                                            <td align="center"><?=$aktif; ?></td>
                                            <td align='right'>
                                                <a href="javascript:showBanner('<?=$kode;?>');" class="text-green hint--left" aria-label="Edit data"><i class='ik ik-edit'></i> Edit</a> | 
                                                <a href="javascript:deleteBanner('<?=$kode;?>');" class="text-red hint--left" aria-label="Hapus"><i class='ik ik-trash'> Hapus</i></a>
                                            </td>
                                        </tr> 
                                    <?php }  ?>
                                </tbody>  
                                <tfoot>
                                   <tr>
                                        <th style="width:2%;">No.</th>
                                        <th>Judul Widget</th>
                                        <th>Rubrik</th>
                                        <th style="width:2%;text-align:center">Posisi</th>
                                        <th style="width:2%;text-align:center">Urutan</th>
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
                            <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul" required>
                        </div>
                        <div class="form-group">
                            <label for="cat">Rubrik</label>
                                <select id="cat" name="cat" class="form-control" placeholder="pilih kategori" required>
                                <option value="">-- Pilih ---</option>
                                    <?php
                                        foreach($kategori as $row){
                                            echo '<option value="'.$row->id_cat.'">'.$row->nama_kategori.'</option>';    
                                        }
                                    ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Posisi</label>
                            <select name="posisi" id="posisi" class="form-control" required>
                                <option value="">-- Pilih ---</option>
                                <option value="1">Kiri</option>
                                <option value="2">Kanan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Urutan</label>
                            <input type="text" name="urutan" id="urutan" class="form-control" placeholder=""  required>
                        </div>
                        <div class="form-group">
                            <label>Publish</label>
                            <select name="publish" id="publish" class="form-control" required>
                                <option value="">-- Pilih ---</option>
                                <option value="0">Aktif</option>
                                <option value="1">Tidak</option>
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
                    url: "/setting/edit_widget",
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
            $("#cat").val(data.cat);
            $("#posisi").val(data.posisi);
            $("#urutan").val(data.urutan);
            $("#publish").val(data.publish);
            $("#bannerModal").modal("show");
            
        }
        
        //Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
        $(document).ready(function(){
            
            $('#submit').submit(function(e){
                $(".se-pre-con").fadeIn();
                e.preventDefault(); 
                var judul = $("#judul").val();
                var cat = $("#cat").val();
                if(judul == "") {
                    showNotif('top-center','Input Data','Judul masih kosong','warning');
                    $("#judul").focus()
                    return;
                }
                $.ajax({
                    url: "/setting/update_widget",
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
        function deleteBanner(id)
        {
            clearModalsBanner();
            $.ajax({
                type: "POST",
                url: "/setting/delete_widget",
                dataType: 'json',
                data: {id:id},
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