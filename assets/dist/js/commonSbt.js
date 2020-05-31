//분석타입 선택
$('input[name=anal_type]').on('change',function(){
	var anal_type_value = $(this).val();
	console.log(anal_type_value)
	if(anal_type_value=='B'){
		$('.select_mode_s').addClass('hidden');
		$('.kgpbtLocale').addClass('hidden');//생산 위치 리스트
		$('.kgsbtLocale').addClass('hidden');//공급 위치 리스트
	}else{
		$('.select_mode_s').removeClass('hidden');
		$('.kgpbtLocale').removeClass('hidden');//생산 위치 리스트
		$('.kgsbtLocale').removeClass('hidden');//공급 위치 리스트
	}
})

//모드 선택
$('input[name=select_mode]').on('change',function () {
	console.log($(this).val());
	var select_mode = $(this).val();
	$('.anal_flag').attr('disabled','disabled');
	if(select_mode == 'fmode'){
		//고장모드
		$('select[name=fmode]').removeAttr('disabled');
		//검정모드
		$('select[name=smode]').attr('disabled','disabled');
		//고장모드 input
		$('input[name=wvalue]').removeAttr('disabled');
	}else if(select_mode == 'smode'){
		$('select[name=smode]').removeAttr('disabled');
		$('input[name=wvalue]').attr('disabled','disabled');
		$('select[name=fmode]').attr('disabled','disabled');
	}else{
		$('select[name=fmode]').attr('disabled','disabled');
		$('select[name=smode]').attr('disabled','disabled');
		$('input[name=wvalue]').attr('disabled','disabled');
	}
})
// $('.sdate').datetimepicker({"format":"YYYY-MM-DD","locale":"ko"});
$('.startDate').daterangepicker({

	singleDatePicker: true,
	startDate: '2009-01-01',
	locale:"ko",
	locale: {
		format: 'YYYY-MM-DD',
	}
});
$('.endDate').daterangepicker({
	singleDatePicker: true,
	startDate: moment().subtract(0, 'days'),
	locale:"ko",
	locale: {
		format: 'YYYY-MM-DD',
	}
});
//플랜트 선택(생산)
$('select[name=key1_cd]').on('change',function () {
	var html='';
	//화면에 플랜트 위치 오브젝트 가 존재하면 위치정보를 출력
	if($('.kgsbtLocale').length > 0 ){
		$.ajax({
			type: "POST",
			url: base_url+"kgsbt/ajaxMultiSelect",
			data:{"key1arr":$(this).val()},
			dataType: "json",
			success: function (data) {
				$.each(data.localeList,function (key,value) {
					html+='<option value="'+value.key2_cd+'">'+value.key2_nm+'</option>\n';
				})
				$('select[name=key2_cd_sbt]').html(html);
			}
		});
	}
})

// 1차 분류 선택 2차 표시 (공급)
$('select[name=key3_cd_sbt]').on('change',function () {
	var html ='';
	$.ajax({
		type: "POST",
		url: base_url+"kgsbt/ajaxMultiSelectKgsbtFirst",
		data:{"key3_cd":$(this).val()},
		dataType: "json",
		success: function (data) {
			console.log(data)
			if(!data.alerts_title){
				$.each(data.list,function (key,value) {
					html+='<option value="'+value.key4_cd+'">'+value.key4_nm+'</option>\n';
				})
				$('select[name=key4_cd_sbt]').html(html);
			}else{
				Toast.fire({
					icon: data.alerts_icon,
					title: data.alerts_title,
				})
			}
		}
	});
});

//2차 분류 선택 3차 표시 (공급)
$('select[name=key4_cd_sbt]').on('change',function () {
	var html ='';
	$.ajax({
		type: "POST",
		url: base_url+"kgsbt/ajaxMultiSelectKgsbtSecond",
		data:{
			"key3_cd":$('select[name=key3_cd_sbt]').val(),
			"key4_cd":$(this).val(),
		},
		dataType: "json",
		success: function (data) {
			$.each(data.list,function (key,value) {
				html+='<option value="'+value.key5_cd+'">'+value.key5_nm+'</option>\n';
			})
			$('select[name=key5_cd_sbt]').html(html);
		}
	});
});

//모달 뷰어
$('#modal-default').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var recipient = button.data('whatever') // Extract info from data-* attributes

	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	var modal = $(this)


	$.ajax({
		type: "POST",
		url: base_url+"kgpbt/htmlViewer",
		// dataType:"html",
		data:{"url":recipient},
		// async: false
	}).done(function(data){
		modal.find('.modal-body p').html(data)
	});

})
//모달 뷰어
$('#modal-default2').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var recipient = button.data('whatever') // Extract info from data-* attributes

	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	var modal = $(this)

	var html='';
	html='<div class="col-6">\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary" onclick="callChart(\''+recipient+'\',\'htm5\')"><i class="fas fa-chart-pie""></i> 고장모드 별 파이차트</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary" onclick="callChart(\''+recipient+'\',\'htm6\')"><i class="fas fa-chart-pie" ></i> 고장원인 별 파이차트</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary" onclick="callChart(\''+recipient+'\',\'htm7\')"><i class="fas fa-chart-pie" ></i> 고장조치사항 별 파이차트</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary" onclick="callChart(\''+recipient+'\',\'htm8\')"><i class="fas fa-chart-pie" ></i> 플랜트 구분 고장모드 별 파이차트</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary" onclick="callChart(\''+recipient+'\',\'htm9\')"><i class="fas fa-chart-pie" ></i> 플랜트 구분 고장원인 별 파이차트</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary" onclick="callChart(\''+recipient+'\',\'htm10\')"><i class="fas fa-chart-pie" ></i> 플랜트 구분 고장조치사항 별 파이차트</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary" onclick="callChart(\''+recipient+'\',\'htm11\')"><i class="fas fa-chart-line "></i> 고장모드 별 고장시간 히스토그램</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary" onclick="callChart(\''+recipient+'\',\'htm12\')"><i class="fas fa-chart-line "></i> 고장원인 별 고장시간 히스토그램\t</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary" onclick="callChart(\''+recipient+'\',\'htm13\')"><i class="fas fa-chart-line "></i> 고장조치사항 별 고장시간 히스토그램</button>\n' +
		'\t\t\t\t</div>\n' +
		'\t\t\t\t<div class="col-6">\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary" onclick="callChart(\''+recipient+'\',\'htm14\')"><i class="fas fa-chart-line"></i> 설비 별 고장시간 히스토그램\t</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary" onclick="callChart(\''+recipient+'\',\'htm15\')"><i class="fas fa-chart-line"></i> 설비 구분 고장모드별 고장시간 히스토그램</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary" onclick="callChart(\''+recipient+'\',\'htm16\')"><i class="fas fa-chart-line"></i> 설비 구분 고장원일별 고장시간 히스토그램</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary" onclick="callChart(\''+recipient+'\',\'htm17\')"><i class="fas fa-chart-line"></i> 구분 고장조치사항별 고장시간 히스토그램</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary" onclick="callChart(\''+recipient+'\',\'htm18\')"><i class="fas fa-chart-line"></i> 고장모드 별 보수시간 히스토그램</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary" onclick="callChart(\''+recipient+'\',\'htm19\')"><i class="fas fa-chart-line"></i> 고장원인 별 보수시간 히스토그램</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary" onclick="callChart(\''+recipient+'\',\'htm20\')"><i class="fas fa-chart-line"></i> 고장조치사항 별 보수시간 히스토그램</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary" onclick="callChart(\''+recipient+'\',\'htm21\')"><i class="fas fa-chart-line"></i> 설비 별 보수시간 히스토그램\t</button>\n' +
		'\t\t\t\t</div>';
	modal.find('.modal-body.row').html(html)
	console.log(html)
})
function callChart(arcd,htmlNum) {
	$.ajax({
		type: "POST",
		url: base_url+"kgpbt/htmlDefaultViewer",
		// dataType:"html",
		data:{"arcd":arcd,"htmlNum":htmlNum,},
		// async: false
	}).done(function(data){
		$('.modal-body.row').html(data)
	});

}
