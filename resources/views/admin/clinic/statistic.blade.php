@extends('layouts.admin')
@section('content')


<div class="row">
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Số lượng đặt lịch khám trong <script>document.write(new Date().getFullYear())</script></h4>
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
	let month = new Date().getMonth() + 1;
	let list_type = {!!$list_type!!};
	let shift_every_month = {!!$shift_every_month!!};
	let data = {};
	

	// for (var i = 0; i < month; i++) {
	// 	let dataOfMonth = [];
	// 	for(let item of list_type) {

	// 	}
	// }

    

	var MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
	var colorNames = Object.keys(window.chartColors);
	var config = {
		type: 'line',
		data: {
			labels: MONTHS.splice(0, (new Date().getMonth() + 1)),
		},
		options: {
			responsive: true,
			// title: {
			// 	display: true,
			// 	text: 'Thống kê lượng đặt lịch khám theo loại'
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
				// xAxes: [{
				// 	display: true,
				// 	scaleLabel: {
				// 		display: true,
				// 		labelString: 'Tháng'
				// 	}
				// }],
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

	window.myLine = new Chart(document.getElementById('line-chart-area').getContext('2d'), config);
	var addDataset = (label, data) => {
        var colorName = colorNames[config.data.datasets.length % colorNames.length];
        var newColor = window.chartColors[colorName];
        var newDataset = {
            label: label,
            backgroundColor: newColor,
            borderColor: newColor,
            data: data,
            fill: false
        };
        config.data.datasets.push(newDataset);
		window.myLine.update();
    }

	for (let type of list_type) {
		let dataOfMonth = [];
		for (let item of shift_every_month) {
			for (let i = 0; i < month; i++) {
				if (type.id === item.id) {
					if ((i+1) === item.month) {
						//console.log(i+1, item)
						dataOfMonth[i] = item.total;
						//console.log(dataOfMonth)
					}
					else if (!dataOfMonth[i]) {
						dataOfMonth[i] = 0;
					}
				}
			}
		}
		console.log(dataOfMonth)
		data[type.id] = dataOfMonth;
		if (data[type.id].length !== 0) {
			addDataset(type.name, data[type.id]);
		}	

	}
	// for (let type of list_type) {
	// }
</script>
@endsection