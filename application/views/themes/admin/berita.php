<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-edit bg-blue"></i>
                <div class="d-inline">
                    <h5>Berita</h5>
                    <span>Kelola data berita</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 d-sm-none d-md-block">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data berita</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <div class="card">
            <?=card_header(['title'=>'List data berita','nama_app'=>'berita','type'=>'','url'=>'/artikel/tambah','info'=>'info','toltip'=>'Tambah berita']);?>
            <div class="card-body">
                <div class="row mb-10">
                    <div class="col-md-2">
                        <select id="sortBy" class="form-control" onchange="searchFilter()">
                            <option value="">Sort By</option>
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="keywords" placeholder="cari data" onkeyup="searchFilter()"/>
                    </div>
                    
                </div>
                <div class="loading-overlay" style="display:none"><div class="overlay-content">Loading.....</div></div>
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
                                        $no =1;
                                        foreach($posts as $aRow){
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
        </div><!-- /.card-body -->
    </div><!-- /.card -->
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
				<button type="button" onClick="submitMember()" id="btn-bahan" class="btn btn-success">Submit</button>
				<button type="button" class="btn bg-red" data-dismiss="modal">Close</button>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="Modalmember" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h4 class="modal-title" id="myModalLabel">Add Data</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
			<div class="modal-body">
				<div class="alert alert-danger" role="alert" id="removeWarning">
					Anda yakin ingin menghapus data ini
                </div>
				<form id="formbahan">
					<input type="hidden" class="form-control" id="id" name="id">
					
					<div class="row">
                        <div class="col-md-6">
                            <div class="card-block">
                                <div class="form-group">
                                    <label for="mail">Email</label>
                                    <input type="email" name="mail" value="" class="form-control" id="mail" placeholder="Email" required="">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Password Pengguna" value="" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Nama Lengkap</label>
                                    <input type="text" name="title" value="" class="form-control" id="title" placeholder="Nama Lengkap" required="">
                                </div>
                                <div class="form-group">
                                    <label for="daftar">TGL. Daftar </label>
                                    <input type="date" name="daftar" class="form-control dpd1"  id="daftar">
                                </div>
                                <div class="form-group">
                                    <label for="phone">No. Handphone</label>
                                    <input type="text" name="phone" value="" class="form-control" id="phone" placeholder="No. Handphone">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" value="Serang Banten" class="form-control" id="alamat" placeholder="Alamat">
                                </div>
                                
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-block">
                                <div class="over-user" style="max-height:300px;overflow:auto">
                                    <div class="form-group">
                                        <label for="profit">Menu Akses</label>
                                    </div>
                                    <input id="selectAll" type="checkbox" checked> <label for='selectAll'> Select All</label>
                                    <!-- text input -->
                                    <?php
                                        
                                        if($this->session->g_level=="admin") {
                                            $resultz = $this->db->query("SELECT * FROM menuadmin where aktif='Y' order by urutan");
                                        }
                                        
                                        foreach($resultz->result_array() AS $rowz) {
                                            $dataTz[$rowz['idparent']][] = $rowz;
                                        }
                                        echo checkcard($dataTz,0,$rowz['idparent'],0);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label>Level Akses</label>
                                    <select name="id_level" class="form-control custom-select">
                                    <option value="1" selected="">Administrator</option><option value="2">Owner</option><option value="3">Marketing</option><option value="4">Demo</option> </select>
                                </div>
                                <div class="form-group">
                                    <label>Aktif</label>
                                    <div class="">
                                        <label>
                                            <input type="radio" class="minimal" name="aktif" id="optionsRadios1" value="N" checked="">
                                            Tidak
                                            <input type="radio" class="minimal" name="aktif" id="optionsRadios2" value="Y">
                                            Ya
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
			<div class="modal-footer">
				<button type="button" onClick="submitMember()" id="btn-bahan" class="btn btn-success">Submit</button>
				<button type="button" class="btn bg-red" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url('assets/backend/');?>addon/artikel.js"></script>
<script>
    $(document).ready(function(){
    $('.openPopup').on('click',function(){
    var dataURL = $(this).attr('data-href');
    $('.modal-body').load(dataURL,function(){
        $('#myModal').modal({show:true});
    });
}); 
});   
</script>    