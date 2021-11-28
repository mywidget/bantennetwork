<div class="row clearfix">
    <div class="col-lg-4 col-md-6 col-sm-12">
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
    <div class="col-lg-4 col-md-6 col-sm-12">
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
    <div class="col-lg-4 col-md-6 col-sm-12">
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
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div id="canvas-holder" style="width:100%!important">
            <canvas id="myAreaChart"></canvas>
        </div>
        
    </div>
</div>

<script>
    
    loadcount('owner');
    loadcount('marketing');
    loadcount('demo');
    function loadcount(a){
        $.ajax({
            url: '/notif/billing',
            method: "POST",
            data: {key:a},
            cache: false,
            dataType:"json",
            success: function (data) {
                $('.load-'+a).html(data.count);
            }
        });
    }
    
    $.ajax({
        url: '/notif/chart',
        method: "GET",
        dataType: "json",
        success: function(data) {
            var tag = [];
            var count = [];
            var tanggal = [];
            for(var i in data) {
                // console.log(data);
                tag.push(data[i].tag);
                count.push(data[i].count);
                tanggal.push(data[i].tanggal);
            }
            
            var lineChartData  = {
                datasets: [{
                    label: "Klik",
                    data: count,
                    backgroundColor: [
                    "#FF6384",
                    "#36A2EB",
                    "#ff8000",
                    "#2db300",
                    "#66004d",
                    "#00008c",
                    "#00b3b2",
                    "#FFCE56"
                    ]
                }],
                labels: tag
            };
            
            var ctx = $("#myAreaChart");
            var myLineChart = new Chart(ctx, {
                type: 'bar',
                data: lineChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Grafik hitung'
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
                
            });
            
        },//end
        error: function(data) {
            console.log(data);
        }
    });	
</script>