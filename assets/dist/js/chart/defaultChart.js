
//차트 시작
	function pieChartCall(objectId,labelArr,dataArr) {
	console.log(labelArr)
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
				display: true
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
	var listAarr=[]
	var listBlabelsArr = [];
	var listBarr=[]
	var listClabelsArr = [];
	var listCarr=[]
	$.ajax({
		type: "POST",
		url: "main/mainAjaxCall",

		dataType: "json",
		success: function (data) {
			$.each(data.listA,function (key,value) {
				listAlabelsArr.push(value.code_name);
				listAarr.push(value.cnt);
			});
			$.each(data.listB,function (key,value) {
				listBlabelsArr.push(value.code_name);
				listBarr.push(value.cnt);
			})
			$.each(data.listC,function (key,value) {
				listClabelsArr.push(value.code_name);
				listCarr.push(value.cnt);
			})
			pieChartCall('pieChart',listAlabelsArr,listAarr);
			pieChartCall('pieChart2',listBlabelsArr,listBarr);
			pieChartCall('pieChart3',listClabelsArr,listCarr);
		}
	});
