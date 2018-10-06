@extends('mylayouts')
@section('content')


<div class="card">


	<div class="card-header">
		Activity Chart
		&nbsp;
		<a href="{{ route('activity.index') }}" class="btn btn-primary btn-sm">Back To List</a>
	</div>


	<div class="card-body">
		<div class="row">
			<div class="col-md-4">
				<form id="filterForm">
					<div class="form-group">
						<select name="filter" class="form-control" id="filterSelect">
							<option value="type">Level </option>
							<option value="scope">Lingkup</option>
							<option value="category">Kategori</option>
						</select>
					</div>
				</form>
			</div>
			<div class="col-md-8"></div>
			<div class="col-md-12">
				<canvas id="canvas" height="100px"></canvas>
			</div>
		</div>
	</div>


</div>
@endsection

@section('script')
  <script>

  (function($){

	    	var dt = new Date();
	    	var forData = {
	    		filter : 'type',
	    		year : dt.getFullYear()

	    	}
	    	var ctx = document.getElementById("canvas").getContext('2d');
	    	var cfg = {
	     	  				type: 'bar',
	     	  				data:{
	     	  					labels:[],
			                      datasets: [{
			                          label: 'Biaya yang keluar',
			                          data: [],
			                          borderWidth: 1,
			                          backgroundColor: 'rgba(239, 107, 231, 1)'
			                      }]
			                  },
			                   options: {
				                      scales: {
				                      	xAxes: [{
							                // Change here
							            	barPercentage: 0.4
							            }],
				                          yAxes: [{
				                              ticks: {
				                                  beginAtZero:true
				                              }
				                          }]
				                      }
				                  }

	     	  			};

	    	var myChart = new Chart(ctx,cfg);

	    	ready(myChart);

  			$('#filterSelect').on('change',function(e){
  				e.preventDefault();
        		forData.filter = jQuery('#filterSelect').val();
        		ready(myChart);
        	});

        	function ready(chartObj){
        		var Cost = new Array();
	    		var Labels = new Array();

        		 $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
            	});

	     	  $.ajax({
	     	  	url: "{{route('activity.get.chart')}}",
	     	  	method: "POST",
	     	  	data : forData,
	     	  	success: function(response){
	     	  		response.forEach(function(data){
	     	  			Labels.push(data.label);
	     	  			Cost.push(data.cost);
	     	  		});
	     	  		// console.log(chartObj.data.datasets[0].data);
	     	  		chartObj.data.datasets[0].data = Cost;
	     	  		chartObj.data.labels = Labels;
	     	  		chartObj.update();
	     	  		// chhartObj.datasets.data = Cost;

	     	  	}

	     	  });

        }

  //       function addData(chart, label, data) {
		//     chart.data.labels.push(label);
		//     chart.data.datasets.forEach((dataset) => {
		//         dataset.data.push(data);
		//     });
		//     chart.update();
		// }

  //       function removeData(chart) {
		//     chart.data.labels.pop();
		//     chart.data.datasets.forEach((dataset) => {
		//         dataset.data.pop();
		//     });
		//     chart.update();
		// }
        	

  	})(jQuery);
       
       
        	

          // $.get(url, function(response){
          //   response.forEach(function(data){
          //       Labels.push(data.type);
          //       Cost.push(data.cost);
          //   });
          //   var ctx = document.getElementById("canvas").getContext('2d');
          //       var myChart = new Chart(ctx, {
          //         type: 'bar',
          //         data: {
          //             labels:Labels,
          //             datasets: [{
          //                 label: 'Biaya yang keluar',
          //                 data: Cost,
          //                 borderWidth: 1
          //             }]
          //         },
          //         options: {
          //             scales: {
          //                 yAxes: [{
          //                     ticks: {
          //                         beginAtZero:true
          //                     }
          //                 }]
          //             }
          //         }
          //     });
          // });
    
  
      


        </script>
@endsection