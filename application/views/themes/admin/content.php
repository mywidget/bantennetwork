<div class="row clearfix">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="widget">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h6>Owner</h6>
                        <h2 class="load-owner">0</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-user"></i>
                    </div>
                </div>
                <small class="text-small mt-10 d-block">Total owner</small>
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
                        <h6>Marketing</h6>
                        <h2 class="load-marketing">0</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-user"></i>
                    </div>
                </div>
                <small class="text-small mt-10 d-block">Total Marketing</small>
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
                        <h6>Demo</h6>
                        <h2 class="load-demo">0</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-user"></i>
                    </div>
                </div>
                <small class="text-small mt-10 d-block">Total User Demo</small>
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
    
    // loadcount('admin');
    // loadcount('owner');
    // loadcount('marketing');
    // loadcount('demo');
    
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