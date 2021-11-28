<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-edit bg-blue"></i>
                <div class="d-inline">
                    <h5>Blog</h5>
                    <span>Kelola data blog</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 d-sm-none d-md-block">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data blog</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <div class="card">
           <?=card_header(['title'=>'Kelola Halaman','nama_app'=>'addpost','info'=>'info','toltip'=>'Tambah data']);?>
            <div class="card-body">
                <div id="posts_content">
                 <?php if(!empty($posts)){ ?>
                    <div class="posts_list">
                       <table class="wp-list-table widefat fixed striped posts" id="table-api"> 
                                <thead>  
                                    <tr>
                                        <th style="width:2%;">No.</th>
                                        <th>Judul</th>
                                        <th style="width:2%;text-align:center">Status</th>
                                        <th style="width:12%;text-align:right">Aksi</th>
                                    </tr>
                                </thead>  
                                <tbody> 
                                    <?php
                                        $no =1;
                                        foreach($posts as $aRow){
                                            $kode = encrypt_url($aRow['id_page']);
                                            
                                        ?>
                                        <tr>  
                                            <td><?=$no++;?></td>  
                                            <td><a href="javascript:editpost('<?=$kode;?>');" data-href="<?=base_url();?>berita/page/editpost<?=$kode;?>" class="openPopup"><?=$aRow['judul'];?></a></td>
                                            <td><?=$aRow['status']; ?></td>
                                            <td align='right'>
                                                <a href="javascript:editpost('<?=$kode;?>');" class="text-green hint--left" aria-label="Edit data"><i class='ik ik-edit'></i> Edit</a> | 
                                                <a href="javascript:deletepost('<?=$kode;?>','<?=$aRow['photo'];?>');" class="text-red hint--left" aria-label="Hapus"><i class='ik ik-trash'> Hapus</i></a>
                                            </td>
                                        </tr> 
                                    <?php }  ?>
                                </tbody>  
                                <tfoot>
                                    <tr>
                                        <th style="width:2%;">No.</th>
                                        <th>Judul</th>
                                        <th style="width:2%;text-align:center">Status</th>
                                        <th style="width:12%;text-align:right">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>  
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
<div class="modal fade test" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="data"
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#table_page").on("click", "td", function() {
        var id = $(this).text();
        console.log(id);
        // $('#ganti').attr('data-myval', id);
        $(".test").attr('id', id)
        $("#myModalLabel").html("Title "+id);
        $('#'+id).modal('show');
        $("#data").val(id);
    });
    $('.button1').on('click', function() {
        var dataId = $(this).attr("data-myval");
        $(".test").attr('id', dataId)
        $("#myModalLabel").html("Title "+dataId);
        $('#'+dataId).modal('show');
    });
    function addpost()
    {
        window.location.href='/berita/page/addpost';
    }
    function editpost(a)
    {
        window.location.href='/berita/page/editpost/'+a;
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
                    url: "/berita/deletepage/",
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
                        window.location.href='/berita/page';
                        } ,error: function(xhr, status, error) {
                        swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                        )
                    },
                });
            
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
      
    }
</script>    