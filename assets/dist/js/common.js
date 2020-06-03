//분석타입 선택
$('input[name=anal_type]').on('change',function(){
	var anal_type_value = $(this).val();
	console.log(anal_type_value)
	if(anal_type_value=='B'){
		$('.select_mode_s').addClass('hidden');
		$('.kgpbtLocale').addClass('hidden');

		$('input:radio[name="select_mode"]').eq(0).click();
	}else{
		$('.select_mode_s').removeClass('hidden');
		$('.kgpbtLocale').removeClass('hidden');
		$('input:radio[name="select_mode"]').eq(0).click();
	}
})
//모드 선택
$('input[name=select_mode]').on('change',function () {
	console.log($(this).val());
	var select_mode = $(this).val();
	$('.anal_flag').attr('disabled','disabled');
	//고장모드
	if(select_mode == 'fmode'){
		//고장모드
		$('.fmodeOverlay').addClass('hidden')
		//검정모드
		$('.smodeOverlay').removeClass('hidden')
		$('.smode').prop("checked",false).trigger('change');
	//검정모드
	}else if(select_mode == 'smode'){
		//고장모드
		$('.fmodeOverlay').removeClass('hidden')
		//검정모드
		$('.smodeOverlay').addClass('hidden');
		$('.fmode').prop("checked",false).trigger('change');

	//선택안함
	}else{
		//고장모드
		$('.fmodeOverlay').removeClass('hidden')
		//검정모드
		$('.smodeOverlay').removeClass('hidden')
		$('.fmode').prop("checked",false).trigger('change');
		$('.smode').prop("checked",false).trigger('change');
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
// 전체 선택
$('input[name=checkAll]').on("change",function () {
	var target = $(this).val();
	//값을 변경후 트리거 해준다
	if($(this).is(":checked")){
		$('.'+target).prop("checked",true).trigger('change');;
	}else{
		$('.'+target).prop("checked",false).trigger('change');
		$('.'+target+'_view').html()
	}

})
//플랜트 선택 위치 표시
$('.key1_cd').on('change',function () {

	var html='';
	//화면에 플랜트 위치 오브젝트 가 존재하면 위치정보를 출력
	var key1_cd=[];

	$('.smode').prop("checked",false).trigger('change');

	//다중셀렉트 체크된 결과값 반환
	$.each($('.key1_cd'),function () {
		if($(this).is(":checked")){
			key1_cd.push($(this).val());
			// 검정모드자동선택전
			$('.smode').filter('[value="'+$(this).val()+'"]').prop("checked",true).trigger('change');
		}
	})
	var url='';
	var type=$(this).attr("data-id");
	if(type=="kgsbt"){
		url = base_url+"kgsbt/ajaxMultiSelect";
	}else{
		url = base_url+"kgpbt/ajaxMultiSelect";
	}
	if($('.kgpbtLocale').length > 0 ){
		$.ajax({
			type: "POST",
			url: url,
			data:{"key1arr":key1_cd},
			dataType: "json",
			success: function (data) {
				$.each(data.localeList,function (key,value) {
					html+='' +
						'<div class="form-group clearfix">\n' +
							'<div class="icheck-primary d-inline text-truncate">' +
								'<input type="checkbox" class="key2_cd" name="key2_cd[]" id="key2_cd_'+key+'" value="'+value.key2_cd+'">\n' +
								'<label for="key2_cd_'+key+'">'+value.key2_nm+'</label>\n' +
							'</div>' +
						'</div>';
				})
				$('.key2_cd_view').html(html);
			}
		});
	}
})
// 1차 분류 선택 1-1차 표시
$('.key3_cd').on('change',function () {
	var html='';
	//화면에 플랜트 위치 오브젝트 가 존재하면 위치정보를 출력
	var key3_cd=[];
	//단일선택처리
	var oneSelect = $('.key3_cd').not(this).prop("checked", false);
	// oneSelect.change();
	//다중셀렉트 체크된 결과값 반환
	$.each($('.key3_cd'),function () {
		if($(this).is(":checked")){
			key3_cd.push($(this).val());
		}
	});

	$.ajax({
		type: "POST",
		url: base_url+"kgpbt/ajaxMultiSelectKgpbtFirstB",
		data:{"key3_cd":key3_cd},
		dataType: "json",
		success: function (data) {
			console.log(data)
			$.each(data.list,function (key,value) {
				html+='' +
					'<div class="form-group clearfix">\n' +
					'<div class="icheck-primary d-inline text-truncate">' +
					'<input type="checkbox" class="key3_1_cd" name="key3_1_cd[]" id="key3_1_cd_'+key+'" value="'+value.key3_1_cd+'">\n' +
					'<label for="key3_1_cd_'+key+'">'+value.key3_1_nm+'</label>\n' +
					'</div>' +
					'</div>';
			})
			$('.key3_1_cd_view').html(html);
		}
	});
})
// 1차 분류 선택 2차 표시
$('.key3_cd').on('change',function () {
	var html='';
	//화면에 플랜트 위치 오브젝트 가 존재하면 위치정보를 출력
	var key3_cd=[];
	//단일선택처리
	var oneSelect = $('.key3_cd').not(this).prop("checked", false);
	// oneSelect.change();
	//다중셀렉트 체크된 결과값 반환
	$.each($('.key3_cd'),function () {
		if($(this).is(":checked")){
			key3_cd.push($(this).val());
		}
	})
	var url='';
	var type=$(this).attr("data-id");
	if(type=="kgsbt"){
		url = base_url+"kgsbt/ajaxMultiSelectKgsbtFirst";
	}else{
		url = base_url+"kgpbt/ajaxMultiSelectKgpbtFirst";
	}
	$.ajax({
		type: "POST",
		url: url,
		data:{"key3_cd":key3_cd},
		dataType: "json",
		success: function (data) {
			console.log(data)
			$.each(data.list,function (key,value) {
				html+='' +
					'<div class="form-group clearfix">\n' +
					'<div class="icheck-primary d-inline text-truncate">' +
					'<input type="checkbox" class="key4_cd" name="key4_cd[]" id="key4_cd_'+key+'" value="'+value.key4_cd+'" data-id="'+type+'">\n' +
					'<label for="key4_cd_'+key+'">'+value.key4_nm+'</label>\n' +
					'</div>' +
					'</div>';
			})
			$('.key4_cd_view').html(html);
		}
	});
})
//2차 분류 선택 3차 표시
$(document).on('change','.key4_cd',function () {
	var html='';
	//화면에 플랜트 위치 오브젝트 가 존재하면 위치정보를 출력
	var key3_cd=[];
	var key4_cd=[];
	//다중셀렉트 체크된 결과값 반환
	$.each($('.key3_cd'),function () {
		if($(this).is(":checked")){
			key3_cd.push($(this).val());
		}
	})
	$.each($('.key4_cd'),function () {
		if($(this).is(":checked")){
			key4_cd.push($(this).val());
		}
	})
	var url='';
	var type=$(this).attr("data-id");
	if(type=="kgsbt"){
		url = base_url+"kgsbt/ajaxMultiSelectKgsbtSecond";
	}else{
		url = base_url+"kgpbt/ajaxMultiSelectKgpbtSecond";
	}
	$.ajax({
		type: "POST",
		url: url,
		data:{
			"key3_cd":key3_cd,
			"key4_cd":key4_cd,
		},
		dataType: "json",
		success: function (data) {
			console.log(data)
			$.each(data.list,function (key,value) {
				html+='' +
					'<div class="form-group clearfix">\n' +
					'<div class="icheck-primary d-inline text-truncate">' +
					'<input type="checkbox" class="key5_cd" name="key5_cd[]" id="key5_cd_'+key+'" value="'+value.key5_cd+'" data-id="'+type+'">\n' +
					'<label for="key5_cd_'+key+'">'+value.key5_nm+'</label>\n' +
					'</div>' +
					'</div>';
			})
			$('.key5_cd_view').html(html);
		}
	});

});
//3차분류 선택 4차 표시

$(document).on('change','.key5_cd',function () {
	var html='';
	//화면에 플랜트 위치 오브젝트 가 존재하면 위치정보를 출력
	var key3_cd=[];
	var key4_cd=[];
	var key5_cd=[];
	//다중셀렉트 체크된 결과값 반환
	$.each($('.key3_cd'),function () {
		if($(this).is(":checked")){
			key3_cd.push($(this).val());
		}
	})
	$.each($('.key4_cd'),function () {
		if($(this).is(":checked")){
			key4_cd.push($(this).val());
		}
	})
	$.each($('.key5_cd'),function () {
		if($(this).is(":checked")){
			key5_cd.push($(this).val());
		}
	})

	$.ajax({
		type: "POST",
		url: base_url+"kgpbt/ajaxMultiSelectKgpbtThird",
		data:{
			"key3_cd":key3_cd,
			"key4_cd":key4_cd,
			"key5_cd":key5_cd,
		},
		dataType: "json",
		success: function (data) {
			console.log(data)
			$.each(data.list,function (key,value) {
				html+='' +
					'<div class="form-group clearfix">\n' +
					'<div class="icheck-primary d-inline text-truncate">' +
					'<input type="checkbox" class="key6_cd" name="key6_cd[]" id="key6_cd_'+key+'" value="'+value.key6_cd+'">\n' +
					'<label for="key6_cd_'+key+'">'+value.key6_nm+'</label>\n' +
					'</div>' +
					'</div>';
			})
			$('.key6_cd_view').html(html);
		}
	});
});
$('.submitKgArt').on("click",function () {
	$('.loading-bar-wrap').removeClass("hidden");
	// var insertToast =$.toast({
	// 	heading: "Info",
	// 	text: "분석요청 데이터 생성중입니다.",
	// 	icon: "info",
	// 	position: 'top-center',
	// 	hideAfter: 8000,
	// 	loaderBg: '#ffffff',  // Background color of the toast loader
	// });
	$.ajax({
		type: "POST",
		url: base_url+"kgpbt/insertKgArt",
		data:$('#defaultForm').serialize(),
		dataType: "json",
		success: function (data) {
			console.log(data)
			if(data.alerts_title){
				// $.each(data.alerts_title,function (key,value) {
				// 	$.toast({
				// 		heading: data.alerts_icon,
				// 		text: value,
				// 		icon: data.alerts_icon,
				// 		// hideAfter: false
				// 		loaderBg: '#ffffff',  // Background color of the toast loader
				// 	});
				// })

			}

		},
		beforeSend: function(data){
			//진행중
			// insertToast;

		},
		complete: function(data){
			// insertToast.update({
			// 	heading: "Info",
			// 	text: "분석요청 완료.",
			// 	icon: "info",
			// 	hideAfter: 2000,
			// });
			// TODO
			$('.loading-bar-wrap').addClass("hidden");
		},
		error: function (xhr, status, error) {
			console.log(error,xhr,status );
		}
	});
});
//모달 뷰어
$('#modal-default').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var recipient = button.data('whatever') // Extract info from data-* attributes
	var inHtml ='';
	var inContent = '';
	console.log(recipient);
	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	var modal = $(this)
	$.ajax({
		type: "POST",
		url: base_url+"kgpbt/htmlViewer",
		dataType:"json",
		data:{"arcd":recipient},
		// async: false
	}).done(function(data){
		inHtml ='';
		inContent = '조회된 데이터가 없습니다.';
		console.log(data)
		if(data.content) {
			inContent = data.content;
			inHtml += '' +
				'<div class="modal-body">' +
				'<table class="table table-striped">' +

				'	<tbody>' +
				'	<tr>' +
				'		<tr>' +
				'			<th rowspan="2" class="table-valign-middle">고장률</th><th>하안</th><th>고장률</th><th>상한</th>' +
				'		</tr>' +
				'		<td>' + data.viewRctDetail.value11 + '</td>' +
				'		<td>' + data.viewRctDetail.value12 + '</td>' +
				'		<td>' + data.viewRctDetail.value13 + '</td>' +
				'	</tr>' +
				'	</tbody' +
				'</table>' +
				'</div> ';
		}
		modal.find('.modal-body .inHtml').html(inHtml)
		modal.find('.modal-body .inContent').html(inContent)
	});

});
//모달을 닫을떼
// $('#modal-default').on('hidden.bs.modal', function (event) {
//
// });
//모달 뷰어
$('#modal-default2').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var recipient = button.data('whatever') // Extract info from data-* attributes

	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	var modal = $(this)

	var html='';
	html='<div class="col-3">\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left" onclick="callChart(\''+recipient+'\',\'htm5\')"><i class="fas fa-chart-pie""></i> 고장모드</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left" onclick="callChart(\''+recipient+'\',\'htm6\')"><i class="fas fa-chart-pie" ></i> 고장원인</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left" onclick="callChart(\''+recipient+'\',\'htm7\')"><i class="fas fa-chart-pie" ></i> 고장조치사항 별 파</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left" onclick="callChart(\''+recipient+'\',\'htm8\')"><i class="fas fa-chart-pie" ></i> 플랜트 구분 고장모드</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left" onclick="callChart(\''+recipient+'\',\'htm9\')"><i class="fas fa-chart-pie" ></i> 플랜트 구분 고장원인</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left" onclick="callChart(\''+recipient+'\',\'htm10\')"><i class="fas fa-chart-pie" ></i> 플랜트 구분 고장조치사항</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left" onclick="callChart(\''+recipient+'\',\'htm11\')"><i class="fas fa-chart-line "></i> 고장모드 별 고장시간</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left" onclick="callChart(\''+recipient+'\',\'htm12\')"><i class="fas fa-chart-line "></i> 고장원인 별 고장시간</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left" onclick="callChart(\''+recipient+'\',\'htm13\')"><i class="fas fa-chart-line "></i> 고장조치사항 별 고장시간</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left" onclick="callChart(\''+recipient+'\',\'htm14\')"><i class="fas fa-chart-line"></i> 설비 별 고장시간</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left" onclick="callChart(\''+recipient+'\',\'htm15\')"><i class="fas fa-chart-line"></i> 설비 구분 고장모드별 고장시간</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left" onclick="callChart(\''+recipient+'\',\'htm16\')"><i class="fas fa-chart-line"></i> 설비 구분 고장원일별 고장시간</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left" onclick="callChart(\''+recipient+'\',\'htm17\')"><i class="fas fa-chart-line"></i> 구분 고장조치사항별 고장시간</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left" onclick="callChart(\''+recipient+'\',\'htm18\')"><i class="fas fa-chart-line"></i> 고장모드 별 보수시간</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left" onclick="callChart(\''+recipient+'\',\'htm19\')"><i class="fas fa-chart-line"></i> 고장원인 별 보수시간</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left" onclick="callChart(\''+recipient+'\',\'htm20\')"><i class="fas fa-chart-line"></i> 고장조치사항 별 보수시간</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left" onclick="callChart(\''+recipient+'\',\'htm21\')"><i class="fas fa-chart-line"></i> 설비 별 보수시간</button>\n' +
		'\t\t\t\t</div>\n' +
		'\t\t\t\t<div class="col-9 chartViewer">\n' +

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
		$('.modal-body.row .chartViewer').html(data)
	});

}
