$(function () {

  'use strict'

  //---------------------------
  //- END MONTHLY SALES CHART -
  //---------------------------

  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.

	var pieChartCanvas2 = $('#pieChart2').get(0).getContext('2d')
	var pieData2        = {
		labels: [
			'Chrome',
			'IE',
			'FireFox',
			'Safari',
			'Opera',
			'Navigator',
		],
		datasets: [
			{
				data: [700,500,400,600,300,100],
				backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
			}
		]
	}
	var pieOptions2     = {
		legend: {
			display: false
		}
	}
	//Create pie or douhnut chart
	// You can switch between pie and douhnut using the method below.
	var pieChart2 = new Chart(pieChartCanvas2, {
		type: 'doughnut',
		data: pieData2,
		options: pieOptions2
	})
	var pieChartCanvas3 = $('#pieChart3').get(0).getContext('2d')
	var pieData3        = {
		labels: [
			'Chrome',
			'IE',
			'FireFox',
			'Safari',
			'Opera',
			'Navigator',
		],
		datasets: [
			{
				data: [700,500,400,600,300,100],
				backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
			}
		]
	}
	var pieOptions3     = {
		legend: {
			display: false
		}
	}
	//Create pie or douhnut chart
	// You can switch between pie and douhnut using the method below.
	var pieChart3 = new Chart(pieChartCanvas3, {
		type: 'doughnut',
		data: pieData3,
		options: pieOptions3
	})
  //-----------------
  //- END PIE CHART -
  //-----------------

})
