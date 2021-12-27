<div class="row clearfix">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="widget">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h6>Berita</h6>
                        <h2 class="load-berita">0</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-edit"></i>
                    </div>
                </div>
                <small class="text-small mt-10 d-block">Total berita</small>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="widget">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h6>Rubrik</h6>
                        <h2 class="load-rubrik">0</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-folder"></i>
                    </div>
                </div>
                <small class="text-small mt-10 d-block">Total Rubrik</small>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="widget">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h6>User</h6>
                        <h2 class="load-user">0</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-user"></i>
                    </div>
                </div>
                <small class="text-small mt-10 d-block">Total User</small>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="widget">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h6>Admin</h6>
                        <h2 class="load-admin">0</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-user"></i>
                    </div>
                </div>
                <small class="text-small mt-10 d-block">Total Admin</small>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
        </div>
    </div>
</div>

<script>
    
    loadcount('berita');
    loadcount('rubrik');
    loadcount('user');
    loadcount('admin');
    
    function loadcount(a){
        $.ajax({
            url: '/notif/notifadm',
            method: "POST",
            data: {key:a},
            cache: false,
            dataType:"json",
            success: function (data) {
                $('.load-'+a).html(data.count);
            }
        });
    }
    
</script>