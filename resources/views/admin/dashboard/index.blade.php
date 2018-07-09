@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-warning text-center">
                            <i class="ti-comments"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p>Báo cáo</p>
                            {{ $total_report_today }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <hr />
                <div class="stats">
                   <i class="ti-reload"></i> Hôm nay
               </div>
           </div>
       </div>
   </div>
   <div class="col-lg-3 col-sm-6">
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col-xs-5">
                    <div class="icon-big icon-success text-center">
                        <i class="ti-wheelchair"></i>
                    </div>
                </div>
                <div class="col-xs-7">
                    <div class="numbers">
                        <p>Phòng khám</p>
                        {{ $total_clinic_today }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <hr />
            <div class="stats">
               <i class="ti-calendar"></i> Hôm nay
           </div>
       </div>
   </div>
</div>
<div class="col-lg-3 col-sm-6">
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col-xs-5">
                    <div class="icon-big icon-danger text-center">
                        <i class="ti-support"></i>
                    </div>
                </div>
                <div class="col-xs-7">
                    <div class="numbers">
                        <p>Lịch hẹn</p>
                        {{ $total_shifts_today }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <hr />
            <div class="stats">
               <i class="ti-timer"></i> Hôm nay
           </div>
       </div>
   </div>
</div>
<div class="col-lg-3 col-sm-6">
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col-xs-5">
                    <div class="icon-big icon-info text-center">
                        <i class="ti-user"></i>
                    </div>
                </div>
                <div class="col-xs-7">
                    <div class="numbers">
                        <p>Người dùng</p>
                        {{ $total_user }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <hr />
            <div class="stats">
               <i class="ti-reload"></i> Hệ thống
           </div>
       </div>
   </div>
</div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Thống kê báo cáo năm <script>document.write(new Date().getFullYear())</script></h4>
            </div>
            <div class="card-content">
                <canvas id="pie-chart-area"></canvas>
            </div>
            <div class="card-footer">
                <!--<div class="chart-legend">
                    <i class="fa fa-circle text-info"></i> Tesla Model S
                    <i class="fa fa-circle text-warning"></i> BMW 5 Series
                </div>-->
                <hr>
                <div class="stats">
                    <!--<i class="ti-check"></i> Data information certified-->
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Báo cáo theo tháng trong <script>document.write(new Date().getFullYear())</script></h4>
                <!--<p class="category">All products including Taxes</p>-->
            </div>
            <div class="card-content">
                <canvas id="line-chart-area"></canvas>
            </div>
            <div class="card-footer">
                <hr>
                <div class="stats">
                    <!--<i class="ti-check"></i> Data information certified-->
                </div>
            </div>
        </div>
    </div>


    
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script>
    var MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    var colorNames = Object.keys(window.chartColors);
    var listType = {!!$list_type!!};
    var resData = {!! $report_every_month !!};
    var dataLine = [];
    listType.forEach(rel => {
        let type = [];
        resData.forEach(item => {
            if (rel.id === item.type_id) {
                type.push(item.total);
            }
        });
        dataLine.push(type);
        // console.log(dataLine[0]);
    });
    var configLine = {
        type: 'line',
        data: {
            labels: MONTHS.splice(0, (new Date().getMonth() + 1))
        },
        options: {
            responsive: true,
            // title: {
            //     display: true,
            //     text: 'Biểu đồ báo cáo trong năm'
            // },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Số lượng'
                    }
                }]
            }
        }
    };
    window.myLine = new Chart(document.getElementById('line-chart-area').getContext('2d'), configLine);
    var addDataset = (label, data) => {
        var colorName = colorNames[configLine.data.datasets.length % colorNames.length];
        var newColor = window.chartColors[colorName];
        var newDataset = {
            label: label,
            backgroundColor: newColor,
            borderColor: newColor,
            data: data,
            fill: false
        };
        configLine.data.datasets.push(newDataset);
        window.myLine.update();
    }

listType.forEach(item => {
    addDataset(item.name, dataLine[item.id - 1])
});

	$(function(){
        var dataPie = [];
        var labelPie = [];
        {!! $report_current_year !!}.forEach(function(rel){
            dataPie.push(rel.reports_count);
            labelPie.push(rel.name);
        });
        var myPie = new Chart(document.getElementById('pie-chart-area').getContext('2d'), {
            type: 'pie',
            data: { datasets: [{
                data: dataPie,
                backgroundColor: [ window.chartColors.red, window.chartColors.orange,window.chartColors.yellow,window.chartColors.green,window.chartColors.blue,],
                label: 'Dataset 1'
            }],
            labels: labelPie
            },
            options: {responsive: true}
        });

        

    });




		// var data = {
  //         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  //         series: [
  //           [542, 543, 520, 680, 653, 753, 326, 434, 568, 610, 756, 895],
  //           [230, 293, 380, 480, 503, 553, 600, 664, 698, 710, 736, 795]
  //         ]
  //       };

  //       var options = {
  //           seriesBarDistance: 10,
  //           axisX: {
  //               showGrid: true
  //           },
  //           height: "245px"
  //       };

  //       var responsiveOptions = [
  //         ['screen and (max-width: 640px)', {
  //           seriesBarDistance: 5,
  //           axisX: {
  //             labelInterpolationFnc: function (value) {
  //               return value[0];
  //             }
  //           }
  //         }]
  //       ];

  //       Chartist.Line('#chartActivity', 
  //       	data, 
  //       	options, 
  //       	responsiveOptions);
</script>
@endsection