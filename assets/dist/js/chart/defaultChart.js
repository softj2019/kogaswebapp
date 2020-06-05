//차트 시작
//차트 시작
function barChartCall(objectId,labelArr,dataArrSbt,dataArrPbt) {
	var barChartCanvas = $('#'+objectId).get(0).getContext('2d');

	var bardata = {
		labels : labelArr.reverse(),
		datasets : [
			{
				label : '생산 설비',
				backgroundColor: "#FFB1C1",
				borderColor: "#FF7B97",
				borderWidth: 1,
				data : dataArrPbt.reverse()
			},
			{
				label : '공급 설비',
				backgroundColor: "#87CDFD",
				borderColor: "#099CFD",
				borderWidth: 1,
				data : dataArrSbt.reverse()
			}
		]
	};

	var barOptions = {
		responsive: true,
		legend: {
			position: 'top',
		},
		title: {
			display: true,
		}
	};

	var myChart = new Chart(barChartCanvas, {
		type: 'bar',
		data: bardata,
		options: barOptions
	});
}

//차트 시작
	function pieChartCall(objectId,labelArr,dataArr) {
		var pieChartCanvas = $('#'+objectId).get(0).getContext('2d')
		var pieData = {
			labels: labelArr,
			datasets: [
				{
					data: dataArr,
					backgroundColor: chartRandomBackground(dataArr),
				}
			]
		}
		var pieOptions = {
			legend: {
				labels: {
					usePointStyle: true  //<-- set this
				}
			}
		}
		//Create pie or douhnut chart
		// You can switch between pie and douhnut using the method below.

		var pieChart = new Chart(pieChartCanvas, {
			type: 'doughnut',
			data: pieData,
			options: pieOptions,
		});
		return pieChart;
	}
//랜덤 색상변경
	function chartRandomBackground(data) {
		var ict_unit = [];
		var efficiency = [];
		var coloR = [];

		var dynamicColors = function() {
			var r = Math.floor(Math.random() * 255);
			var g = Math.floor(Math.random() * 255);
			var b = Math.floor(Math.random() * 255);
			return "rgb(" + r + "," + g + "," + b + ")";
		};

		for (var i in data) {
			ict_unit.push("ICT Unit " + data[i].ict_unit);
			efficiency.push(data[i].efficiency);
			coloR.push(dynamicColors());
		}
		return coloR;
	}

	var listAlabelsArr = [];
	var listAarr=[];
	var listBlabelsArr = [];
	var listBarr=[];
	var listClabelsArr = [];
	var listCarr=[];
	var listDlabelsArr = [];
	var listSbtArr=[];
	var listPbtArr=[];
	$.ajax({
		type: "POST",
		url: base_url+"main/mainAjaxCall",

		dataType: "json",
		success: function (data) {
			$.each(data.listA,function (key,value) {
				listAlabelsArr.push(value.code_name);
				listAarr.push(value.cnt);
			});
			$.each(data.listB,function (key,value) {
				listBlabelsArr.push(value.code_name);
				listBarr.push(value.cnt);
			});
			$.each(data.listC,function (key,value) {
				listClabelsArr.push(value.code_name);
				listCarr.push(value.cnt);
			});
			console.log(data.listD);
			$.each(data.listD,function (key,value) {
				listDlabelsArr.push(value.chartDate);
				listSbtArr.push(value.sbtCnt);
				listPbtArr.push(value.pbtCnt);
			});
			pieChartCall('pieChart',listAlabelsArr,listAarr);
			pieChartCall('pieChart2',listBlabelsArr,listBarr);
			pieChartCall('pieChart3',listClabelsArr,listCarr);
			barChartCall('barChart',listDlabelsArr,listSbtArr,listPbtArr);
		}
	});
