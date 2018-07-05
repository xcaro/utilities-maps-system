@extends('layouts.admin')
@section('content')


<div class="row">
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
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title"><script>document.write(new Date().getFullYear())</script></h4>
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
	var config = {
		type: 'line',
		data: {
			labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
			datasets: [{
				label: 'My First dataset',
				backgroundColor: window.chartColors.red,
				borderColor: window.chartColors.red,
				data: [
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor()
				],
				fill: false,
			}, {
				label: 'My Second dataset',
				fill: false,
				backgroundColor: window.chartColors.blue,
				borderColor: window.chartColors.blue,
				data: [
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor()
				],
			}]
		},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'Chart.js Line Chart'
			},
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
						labelString: 'Value'
					}
				}]
			}
		}
	};

	window.onload = function() {
		var ctx = document.getElementById('line-chart-area').getContext('2d');
		window.myLine = new Chart(ctx, config);
	};
</script>
@endsection