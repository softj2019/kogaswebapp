//분석타입 선택
$('input[name=anal_type]').on('change',function(){
	var anal_type_value = $(this).val();
	//console.log(anal_type_value)
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
	//console.log($(this).val());
	var select_mode = $(this).val();
	$('.anal_flag').attr('disabled','disabled');
	//고장모드
	if(select_mode == 'fmode'){
		//고장모드
		$('.fmodeOverlay').addClass('hidden')
		//검정모드
		$('.smodeOverlay').removeClass('hidden')
		$('.smode').prop("checked",false).trigger('change');
		//검정모드 초기화
		$('.smode_key1_cd').html('');
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
		//검정모드 초기화
		$('.smode_key1_cd').html('');
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
//검정모드 2개이상 체크
$(document).on("change",'.smode',function () {
	if($('.smode:checked').length >2){
		callToast("검정모드는 2개이상 선택할 수 없습니다.","error","알림")
		$(this).prop("checked",false);
	}

});
//플랜트 선택 위치 표시
$('.key1_cd').on('change',function () {

	var html='';
	var smodeHtml='';
	//화면에 플랜트 위치 오브젝트 가 존재하면 위치정보를 출력
	var key1_cd=[];
	var key1_cd_name=[];
	$('.smode').prop("checked",false).trigger('change');

	var selectModeValue =$('input[name=select_mode]:checked').val();
	//console.log(selectModeValue);
	//다중셀렉트 체크된 결과값 반환
	$.each($('.key1_cd'),function () {
		if($(this).is(":checked")){
			key1_cd.push($(this).val());
			key1_cd_name.push($(this).next().text());
		}
	})
	// 검정모드 목록 출력
	if(selectModeValue=="smode"){
		$('.smode_key1_cd').html('')
		// $('.smode').filter('[value="'+$(this).val()+'"]').prop("checked",true).trigger('change');
		$.each(key1_cd,function (key,value) {
			smodeHtml+='' +
				'<div class="form-group clearfix">\n' +
				'\t<div class="icheck-primary d-inline text-truncate">\n' +
				'\t\t<input type="checkbox" id="smode_'+key+'" name="smode[]" value="'+value+'" class="smode">\n' +
				'\t\t<label for="smode_'+key+'">'+key1_cd_name[key]+'</label>\n' +
				'\t</div>\n' +
				'</div>';
		});
		$('.smode_key1_cd').html(smodeHtml)
	}

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
			//console.log(data)
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
	$('.key4_cd_view').prop("checked",false).trigger('change');
	$('.key5_cd_view').prop("checked",false).trigger('change');
	$('.key4_cd_view').html('');
	$('.key5_cd_view').html('');
	$('.key6_cd_view').html('');
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
			// console.log(data)
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
			// console.log(data)
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
			// console.log(data)
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

function callDebugToast(text) {
	$.toast({
		position: 'bottom-right',
		heading: "Debug",
		text: text,
		icon: "info",
		// hideAfter: false
		loaderBg: '#ffffff',  // Background color of the toast loader
		hideAfter: false,
	});
}
function callToast(text,icon,heading) {
	$.toast({
		position: 'bottom-right',
		heading:heading,
		text: text,
		icon: icon,
		loaderBg: '#ffffff',  // Background color of the toast loader
	});
}
function callToastHideAfter(text,icon,heading,data,bsmodal){
	if(data.alerts_status=="success"){
		$.toast({
			position: 'bottom-right',
			heading: heading,
			text: text,
			icon: icon,
			// hideAfter: false
			loaderBg: '#ffffff',  // Background color of the toast loader
			hideAfter: 2000,
			afterHidden: function () {
				if(bsmodal){
					bsmodal.modal('toggle');
				}
				location.reload();
			}
		});
	}else{
		$.toast({
			position: 'bottom-right',
			heading: "알림",
			text: "요청이 실패했습니다.",
			icon: "error",
			// hideAfter: false
			loaderBg: '#ffffff',  // Background color of the toast loader
			// hideAfter: 1300,
		});
	}

}
function callToastHideFalse(text,icon,heading) {
	$.toast({
		position: 'bottom-right',
		heading:heading,
		text: text,
		icon: icon,
		loaderBg: '#ffffff',  // Background color of the toast loader
		hideAfter: false,
	});
}
//분석 실행
$('.submitKgArt').on("click",function () {
	$('.loading-bar-wrap').removeClass("hidden");

	var url='';
	var type=$(this).attr("data-id");
	if(type=="kgsbt"){
		url = base_url+"kgsbt/insertKgArt";
	}else if(type=="kgbasicpbt"){
		url = base_url+"kgbasicpbt/insertKgArt";
	}else if(type=="kgbasicsbt"){
		url = base_url+"kgbasicsbt/insertKgArt";
	}else{
		url = base_url+"kgpbt/insertKgArt";
	}
	$.ajax({
		type: "POST",
		url: url,
		data:$('#defaultForm').serialize(),
		dataType: "json",
		success: function (data) {
			// console.log("심화분석 테이블 저장후 반환",data)

			if(data.anal_type=='C') {
				$('#modal-adview').modal({backdrop: true, keyboard: false, show: true});
				adviewCall(data);
			}else{
				if(data.alerts_status=="success") {
					$.toast({
						position: 'bottom-right',
						heading: "알림",
						text: "분석 실행 성공",
						icon: "success",
						// hideAfter: false
						loaderBg: '#ffffff',  // Background color of the toast loader
						hideAfter: 3000,
						afterHidden: function () {
								location.reload();
							// callDebugToast(data.debug);
						}
					});
				}else{
					$.each(data.alerts_title, function (key, value) {
						$.toast({
							position: 'bottom-right',
							heading: "알림",
							text: value,
							icon: data.alerts_icon,
							// hideAfter: false
							loaderBg: '#ffffff',  // Background color of the toast loader
							hideAfter: false,
						});
					});
				}
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
	var inFmode ='';//fmode 있을데
	var inSelectKeyHtml='';//선택 값 표시
	var inHtmlNoneFmode='';//fmode 없는 기본
	var inDistri='';
	// console.log(recipient);
	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	var modal = $(this)
	$.ajax({
		type: "POST",
		url: base_url+"kgview/htmlViewer",
		dataType:"json",
		data:{"arcd":recipient},
		// async: false
	}).done(function(data){
		// console.log("분석결과 뷰어",data)

		inHtml ='';
		inContent = '조회된 데이터가 없습니다.';

		if(data.alerts_status=="success"){
			//기본
			if(data.kgart.analysis_type=='B' && data.kgart.fmode==null && data.kgart.distri==null) {
				inHtml= getDefaultClases(data,inHtmlNoneFmode,inHtml)
				// console.log('debug ::::::::::::::: case1')
			}
			//case2 기본,심화 B,E 고장모드 있는경우 distri ==null || 3
			if(data.kgart.fmode!=null && (data.kgart.analysis_type=='B' || data.kgart.analysis_type=='E') && (data.kgart.distri=='3' || data.kgart.distri==null )){
				inHtml= getInFModeClass(data,inHtmlNoneFmode,inHtml,inFmode);
				// console.log('debug ::::::::::::::: case2')
			}
			//case3 심화 s/fmode null distri 1,2,3,4
			if(data.kgart.fmode==null && data.kgart.smode==null && data.kgart.analysis_type=='E' && (data.kgart.distri=='1' || data.kgart.distri=='2' || data.kgart.distri=='3' || data.kgart.distri=='4')){
				inHtml= getInSModeClass(data,inHtml,inDistri);
				// console.log('debug ::::::::::::::: case3')
			}
			//case4 심화 E smode == null and fmode not null  distri 1,2,4
			if(data.kgart.fmode!=null && data.kgart.smode==null  && data.kgart.analysis_type=='E' && (data.kgart.distri=='1' || data.kgart.distri=='2' || data.kgart.distri=='4')){
				inHtml= getInFModeNotSmodeClass(data,inHtmlNoneFmode,inHtml,inFmode);
				// console.log('debug ::::::::::::::: case4')
			}
			//case5 심화 smode yse distri 1,2,4
			if(data.kgart.smode!=null && data.kgart.fmode==null && data.kgart.analysis_type=='E' && (data.kgart.distri=='1' || data.kgart.distri=='2'  || data.kgart.distri=='4')){
				inHtml= getCase5(data,inHtml,inDistri);
				// console.log('debug ::::::::::::::: case5')
			}
			inContent = data.content;
			modal.find('.modal-body .inHtml').html(inHtml)
			modal.find('.modal-body .inContent').html(inContent)
		}else {
			callToast("분석된 데이터가 없습니다.","error","알림")
	}

	});
});
//case1 기본 B
function getDefaultClases(data,inHtmlNoneFmode,inHtml) {
	inHtmlNoneFmode += '' +
		'<h5 class="text-right">(95% CI)</h5>' +
		'<div class="row"> ' +

		'<table class="table table-striped">' +

		'	<tbody>' +
		'	<tr>' +
		'		<tr>' +
		'			<th rowspan="2" class="table-valign-middle text-bold">전체<br>고장률</th><th>하한</th><th>고장률 (per hour) </th><th>상한</th>' +
		'		</tr>' +
		'		<td>' + data.viewRctDetail.value11 + '</td>' +
		'		<td>' + data.viewRctDetail.value10 + '</td>' +
		'		<td>' + data.viewRctDetail.value12 + '</td>' +
		'	</tr>' +
		'	</tbody>' +
		'</table>\n' +
		'</div>';
	inHtml += inHtmlNoneFmode;
	return inHtml;
}
//case2 심화 E 고장모드에 값 있음 distri 1,2,3,4
function getInFModeClass(data,inHtmlNoneFmode,inHtml,inFmode,inDistri) {
	var wvalue = data.kgart.wvalue.split(",");//고장시간
	var fmode = data.kgart.fmode.split(",");//고장시간
	var value10 = data.viewRctDetail.value10.split(",");//
	var value11 = data.viewRctDetail.value11.split(",");//
	var value12 = data.viewRctDetail.value12.split(",");//
	if(value10.length <= 1){

		inHtmlNoneFmode += '' +
			'<h5 class="text-right">(95% CI)</h5>' +
			'<div class="row"> ' +

			'<table class="table table-striped">' +

			'	<tbody>' +
			'	<tr>' +
			'		<tr>' +
			'			<th rowspan="2" class="table-valign-middle">전체</br>고장률</th><th>하한</th><th>고장률 (per hour) </th><th>상한</th>' +
			'		</tr>' +
			'		<td>' + data.viewRctDetail.value11 + '</td>' +
			'		<td>' + data.viewRctDetail.value10 + '</td>' +
			'		<td>' + data.viewRctDetail.value12 + '</td>' +
			'	</tr>' +
			'	</tbody>' +
			'</table>\n' +
			'</div>';
		inHtml += inHtmlNoneFmode;
	}else{

		inDistri+='' +

			'<table class="table table-valign-middle table-sm">' +
			'	<tbody>' +
			'	<tr>' +
			'	<td rowspan="'+(wvalue.length+1)+'">전체</br>고장률</td><td>시간</td><td>하한</td><td>고장률 (per hour) </td><td>상한</td>' +
			'	</tr>' +
			'';
		$.each(wvalue,function (key,value) {
			inDistri+='' +
				'	<tr>' +
				'		<td>'+value+'</td><td>'+value11[key]+'</td><td>'+value10[key]+'</td><td>'+value12[key]+'</td>' +
				'	</tr>';
		})
		inDistri+='' +
			'	</tbody' +
			'</table>' +
			'';
		inHtml += inDistri;
	}


	var value13 = data.viewRctDetail.value13.split(",");//분류
	var value14 = data.viewRctDetail.value14.split(",");//고장률
	var value15 = data.viewRctDetail.value15.split(",");//하한
	var value16 = data.viewRctDetail.value16.split(",");//하한
	inFmode+='' +
		'<table class="table table-valign-middle">' +
		'	<tbody>' +
		'	<tr>' +
		'	<td rowspan="'+(value13.length+1)+'">고장모드별 고장률</td><td>모드</td><td>하한</td><td>고장률 (per hour) </td><td>상한</td>' +
		'	</tr>' +
		'';


	$.each(value13,function (key,value) {
		inFmode+='' +
			'	<tr>' +
			'		<td class="table-valign-middle">'+value+'</td><td>'+value15[key]+'</td><td>'+value14[key]+'</td><td>'+value16[key]+'</td>' +
			'	</tr>';
	})
	inFmode+='' +
		'	</tbody' +
		'</table>';
	inHtml += inFmode;
	return inHtml
}
//case3 심화 E fmode not null  distri 1,2,4
function getInFModeNotSmodeClass(data,inHtml,inDistri){
	var wvalue = data.kgart.wvalue.split(",");//고장시간
	var value1 = data.viewRctDetail.value1.split(",");//신뢰도
	var value2 = data.viewRctDetail.value2.split(",");//하한
	var value3 = data.viewRctDetail.value3.split(",");//상한
	var value4 = data.viewRctDetail.value4.split(",");//불신뢰도
	var value5 = data.viewRctDetail.value5.split(",");//상한
	var value6 = data.viewRctDetail.value6.split(",");//하한
	var value7 = data.viewRctDetail.value7.split(",");//하한
	var value8 = data.viewRctDetail.value8.split(",");//하한
	var value9 = data.viewRctDetail.value9.split(",");//하한
	var value10 = data.viewRctDetail.value10.split(",");//하한
	var value11 = data.viewRctDetail.value11.split(",");//하한
	var value12 = data.viewRctDetail.value12.split(",");//하한
	//신뢰도
	inDistri+='' +
		'<h5 class="text-right">(95% CI)</h5>' +
		'<table class="table table-valign-middle table-sm">' +
		'	<tbody>' +
		'	<tr>' +
		'	<td rowspan="'+(wvalue.length+1)+'">신뢰도</td><td>시간</td><td>하한</td><td>신뢰도</td><td>상한</td>' +
		'	</tr>' +
		'';
	$.each(wvalue,function (key,value) {
		inDistri+='' +
			'	<tr>' +
			'		<td class="table-valign-middle">'+value+'</td><td>'+value1[key]+'</td><td>'+value2[key]+'</td><td>'+value3[key]+'</td>' +
			'	</tr>';
	})
	inDistri+='' +
		'	</tbody>' +
		'</table>' +
		'';
	//불신뢰도
	inDistri+='' +

		'<table class="table table-valign-middle table-sm">' +
		'	<tbody>' +
		'	<tr>' +
		'	<td rowspan="'+(wvalue.length+1)+'">불신뢰도</t><td>시간</td><td>하한</td><td>불신뢰도</td><td>상한</td>' +
		'	</tr>' +
		'';
	$.each(wvalue,function (key,value) {
		inDistri+='' +
			'	<tr>' +
			'		<td class="table-valign-middle">'+value+'</td><td>'+value4[key]+'</td><td>'+value5[key]+'</td><td>'+value6[key]+'</td>' +
			'	</tr>';
	})
	inDistri+='' +
		'	</tbody>' +
		'</table>' +
		'';
	//고장률
	inDistri+='' +

		'<table class="table table-valign-middle table-sm">' +
		'	<tbody>' +
		'	<tr>' +
		'	<td rowspan="'+(wvalue.length+1)+'">전체</br>고장률</td><td>시간</td><td>하한</td><td>고장률 (per hour) </td><td>상한</td>' +
		'	</tr>' +
		'';
	$.each(wvalue,function (key,value) {
		inDistri+='' +
			'	<tr>' +
			'		<td>'+wvalue[key]+'</td><td>'+value11[key]+'</td><td>'+value10[key]+'</td><td>'+value12[key]+'</td>' +
			'	</tr>';
	});
	inDistri+='' +
		'	</tbody>' +
		'</table>' +
		'';
	inHtml += inDistri;
	return inHtml;
}
//case4 심화 E smode 있음 1,2,4
function getInSModeClass(data,inHtml,inDistri){
	var wvalue = data.kgart.wvalue.split(",");//고장시간
	var value1 = data.viewRctDetail.value1.split(",");//신뢰도
	var value2 = data.viewRctDetail.value2.split(",");//하한
	var value3 = data.viewRctDetail.value3.split(",");//상한
	var value4 = data.viewRctDetail.value4.split(",");//불신뢰도
	var value5 = data.viewRctDetail.value5.split(",");//상한
	var value6 = data.viewRctDetail.value6.split(",");//하한
	var value7 = data.viewRctDetail.value7.split(",");//하한
	var value8 = data.viewRctDetail.value8.split(",");//하한
	var value9 = data.viewRctDetail.value9.split(",");//하한
	var value10 = data.viewRctDetail.value10.split(",");//하한
	var value11 = data.viewRctDetail.value11.split(",");//하한
	var value12 = data.viewRctDetail.value12.split(",");//하한
	inDistri+='' +
		'<div class="row">' +
		'<table class="table table-valign-middle table-sm">' +
		'	<tbody>' +
		'	<tr>' +
		'		<td rowspan="'+(value7.length+1)+'">평균 (MTTF)</td><td>하한</td><td>평균</td><td>상한</td>' +
		'	</tr>';
	$.each(value7,function (key,value) {
		inDistri+='' +
			'	<tr>' +
			'		<td>'+value+'</td><td>'+value8[key]+'</td><td>'+value9[key]+'</td> '+
			'	</tr>';
	})
	inDistri+='' +
		'	</tbody>' +
		'</table>' +
		'</div>';
	//신뢰도
	inDistri+='' +

		'<table class="table table-valign-middle table-sm">' +
		'	<tbody>' +
		'	<tr>' +
		'	<td rowspan="'+(wvalue.length+1)+'">신뢰도</td><td>시간</td><td>하한</td><td>신뢰도</td><td>상한</td>' +
		'	</tr>' +
		'';
	$.each(wvalue,function (key,value) {
		inDistri+='' +
			'	<tr>' +
			'		<td class="table-valign-middle">'+value+'</td><td>'+value1[key]+'</td><td>'+value2[key]+'</td><td>'+value3[key]+'</td>' +
			'	</tr>';
	})
	inDistri+='' +
		'	</tbody>' +
		'</table>' +
		'';
	//불신뢰도
	inDistri+='' +

		'<table class="table table-valign-middle table-sm">' +
		'	<tbody>' +
		'	<tr>' +
		'	<td rowspan="'+(wvalue.length+1)+'">불신뢰도</t><td>시간</td><td>하한</td><td>불신뢰도</td><td>상한</td>' +
		'	</tr>' +
		'';
	$.each(wvalue,function (key,value) {
		inDistri+='' +
			'	<tr>' +
			'		<td class="table-valign-middle">'+value+'</td><td>'+value4[key]+'</td><td>'+value5[key]+'</td><td>'+value6[key]+'</td>' +
			'	</tr>';
	})
	inDistri+='' +
		'	</tbody>' +
		'</table>' +
		'';
	//고장률
	inDistri+='' +

		'<table class="table table-valign-middle table-sm">' +
		'	<tbody>' +
		'	<tr>' +
		'	<td rowspan="'+(wvalue.length+1)+'">전체</br>고장률</td><td>시간</td><td>고장률 (per hour) </td>' +
		'	</tr>' +
		'';
	$.each(wvalue,function (key,value) {
		inDistri+='' +
			'	<tr>' +
			'		<td>'+wvalue[key]+'</td><td>'+value10[key]+'</td>' +
			'	</tr>';
	});
	inDistri+='' +
		'	</tbody>' +
		'</table>' +
		'';
	inHtml += inDistri;
	return inHtml;
}
//case5 심화 E smode 있음 1,2,4
function getCase5(data,inHtml,inDistri){

	var wvalue = data.kgart.wvalue.split(",");//고장시간

	var value1 = data.viewRctDetail.value1.split(",");//신뢰도
	var value2 = data.viewRctDetail.value2.split(",");//하한
	var value3 = data.viewRctDetail.value3.split(",");//상한
	var value4 = data.viewRctDetail.value4.split(",");//불신뢰도
	var value5 = data.viewRctDetail.value5.split(",");//상한
	var value6 = data.viewRctDetail.value6.split(",");//하한
	var value7 = data.viewRctDetail.value7.split(",");//하한
	var value8 = data.viewRctDetail.value8.split(",");//하한
	var value9 = data.viewRctDetail.value9.split(",");//하한
	var value10 = data.viewRctDetail.value10.split(",");//하한
	var value11 = data.viewRctDetail.value11.split(",");//하한
	var value12 = data.viewRctDetail.value12.split(",");//하한

	//

	if(data.kgart.smode != null){
		var smode = data.kgartView.smode.split(",");//고장시간
		inDistri+='' +
			'<div class="row">' +
			'	<table class="table table-valign-middle table-sm">' +
			'		<thead>' +
			'		<tr>' +
			'			<th colspan="4" class="text-center">'+smode[0]+'</th><th colspan="4" class="text-center">'+smode[1]+'</th>' +
			'		</tr>'+
			'		</thead>'+
			'	</table>'+
			'</div>';
	}

	//신뢰도
	inDistri+='' +
		'<div class="clearfix row">';
	inDistri+='' +
		'<div class="col-6">'+
		'<table class="table-valign-middle w-100" style="border-right: 1px solid #eee">' +
		'	<tbody>' +
		'	<tr>' +
		'	<td rowspan="'+(wvalue.length+1)+'">신뢰도</td><td>시간</td><td>하한</td><td>신뢰도</td><td>상한</td>' +
		'	</tr>' +
		'';
	$.each(wvalue,function (key,value) {
		inDistri+='' +
			'	<tr>' +
			'		<td class="table-valign-middle">'+value+'</td><td>'+value1[key]+'</td><td>'+value2[key]+'</td><td>'+value3[key]+'</td>' +
			'	</tr>';
	})
	inDistri+='' +
		'	</tbody>' +
		'</table>' +
		'</div> ';
	inDistri+='' +
		'<div class="col-6">'+
		'<table class="table-valign-middle w-100" >' +
		'	<tbody>' +
		'	<tr>' +
		'	<td>시간</td><td>하한</td><td>신뢰도</td><td>상한</td>' +
		'	</tr>' +
		'';
	// $.each(wvalue,function (key,value) {

		inDistri+='' +
			'	<tr>' +
			'		<td>'+wvalue[0]+'</td><td>'+value1[5]+'</td><td>'+value2[5]+'</td><td>'+value3[5]+'</td>' +
			'	</tr>'+
			'		<td>'+wvalue[1]+'</td><td>'+value1[6]+'</td><td>'+value2[6]+'</td><td>'+value3[6]+'</td>' +
			'	<tr>' +
			'	</tr>'+
			'		<td>'+wvalue[2]+'</td><td>'+value1[7]+'</td><td>'+value2[7]+'</td><td>'+value3[7]+'</td>' +
			'	<tr>' +
			'	</tr>'+
			'		<td>'+wvalue[3]+'</td><td>'+value1[8]+'</td><td>'+value2[8]+'</td><td>'+value3[8]+'</td>' +
			'	<tr>' +
			'	</tr>'+
			'		<td>'+wvalue[4]+'</td><td>'+value1[9]+'</td><td>'+value2[9]+'</td><td>'+value3[9]+'</td>' +
			'	</tr>';
	// })
	inDistri+='' +
		'	</tbody>' +
		'</table>' +
		'</div> ';
	inDistri+='' +
		'</div> <p>&nbsp;</p>';
	//불신뢰도

	inDistri+='' +
		'<div class="clearfix row">';
	inDistri+='' +
		'<div class="col-6">'+
		'<table class="table-valign-middle w-100" style="border-right: 1px solid #eee">' +
		'	<tbody>' +
		'	<tr>' +
		'	<td rowspan="'+(wvalue.length+1)+'">불신뢰도</td><td>시간</td><td>하한</td><td>신뢰도</td><td>상한</td>' +
		'	</tr>' +
		'';
	$.each(wvalue,function (key,value) {
		inDistri+='' +
			'	<tr>' +
			'		<td class="table-valign-middle">'+value+'</td><td>'+value4[key]+'</td><td>'+value5[key]+'</td><td>'+value6[key]+'</td>' +
			'	</tr>';
	})
	inDistri+='' +
		'	</tbody>' +
		'</table>' +
		'</div> ';
	inDistri+='' +
		'<div class="col-6">'+
		'<table class="table-valign-middle w-100" >' +
		'	<tbody>' +
		'	<tr>' +
		'	<td>시간</td><td>하한</td><td>신뢰도</td><td>상한</td>' +
		'	</tr>' +
		'';
	// $.each(wvalue,function (key,value) {

	inDistri+='' +
		'	<tr>' +
		'		<td>'+wvalue[0]+'</td><td>'+value4[5]+'</td><td>'+value5[5]+'</td><td>'+value6[5]+'</td>' +
		'	</tr>'+
		'		<td>'+wvalue[1]+'</td><td>'+value4[6]+'</td><td>'+value5[6]+'</td><td>'+value6[6]+'</td>' +
		'	<tr>' +
		'	</tr>'+
		'		<td>'+wvalue[2]+'</td><td>'+value4[7]+'</td><td>'+value5[7]+'</td><td>'+value6[7]+'</td>' +
		'	<tr>' +
		'	</tr>'+
		'		<td>'+wvalue[3]+'</td><td>'+value4[8]+'</td><td>'+value5[8]+'</td><td>'+value6[8]+'</td>' +
		'	<tr>' +
		'	</tr>'+
		'		<td>'+wvalue[4]+'</td><td>'+value4[9]+'</td><td>'+value5[9]+'</td><td>'+value6[9]+'</td>' +
		'	</tr>';
	// })
	inDistri+='' +
		'	</tbody>' +
		'</table>' +
		'</div> ';
	inDistri+='' +
		'</div> <p>&nbsp;</p>';
	//고장률
	inDistri+='' +
		'<div class="clearfix row">'+
		'<div class="col-6">'+
		'<table class="w-100" style="border-right: 1px solid #eee">' +
		'	<tbody>' +
		'	<tr>' +
		'	<td rowspan="'+(wvalue.length+1)+'">전체</br>고장률</td><td>시간</td><td>고장률 (per hour) </td>' +
		'	</tr>' +
		'';
	$.each(wvalue,function (key,value) {
		inDistri+='' +
			'	<tr>' +
			'		<td>'+wvalue[key]+'</td><td>'+value10[key]+'</td>' +
			'	</tr>';
	});
	inDistri+='' +
		'	</tbody>' +
		'</table>' +
		'</div>';

	inDistri+='' +
		'<div class="col-6">'+
		'<table class="w-100">' +
		'	<tbody>' +
		'	<tr>' +
		'	<td rowspan="'+(wvalue.length+1)+'">전체</br>고장률</td><td>시간</td><td>고장률 (per hour) </td>' +
		'	</tr>' +
		'';
	$.each(wvalue,function (key,value) {
		inDistri+='' +
			'	<tr>' +
			'		<td>'+wvalue[key]+'</td><td>'+value10[key]+'</td>' +
			'	</tr>';
	});
	inDistri+='' +
		'	</tbody>' +
		'</table>' +
		'</div>' +
		'</div>';

	inHtml += inDistri;
	return inHtml;
}
//문자열 치환 배열 저장
function callSplit(StringArr) {
	return StringArr.split(",")
}
$('#modal-kgartRunView').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var recipient = button.data('whatever') // Extract info from data-* attributes
	var kgartTable='';
	var modal = $(this);
	$.ajax({
		type: "POST",
		url: base_url+"kgview/htmlViewer",
		dataType:"json",
		data:{"arcd":recipient},
		// async: false

	}).done(function(data){

	kgartTable+='' +
		'' +
		'<table class="table table-responsive table-sm">' +
		'<tbody>' +
		'<tr>' +
		'<th style="width: 5%">플랜트</th><td style="width: 95%">'+data.kgartView.key1_nm+'</td>' +
		'</tr>' +
		'<tr>' +
		'<th>위치</th><td>'+data.kgartView.key2_nm+'</td>' +
		'</tr>' +
		'<tr>' +
		'<th>1차</th><td>'+data.kgartView.key3_nm+'</td>' +
		'</tr>' +
		'<tr>' +
		'<th>1-1차</th><td>'+data.kgartView.key3_1_nm+'</td>' +
		'</tr>' +
		'<tr>' +
		'<th>2차</th><td>'+data.kgartView.key4_nm+'</td>' +
		'</tr>' +
		'<tr>' +
		'<th>3차</th><td>'+data.kgartView.key5_nm+'</td>' +
		'</tr>' +
		'<tr>' +
		'<th>4차</th><td>'+data.kgartView.key6_nm+'</td>' +
		'</tr>' +
		'</tbody>' +
		'</table>' +
		'';
		modal.find('.modal-body').html(kgartTable);
	});
});
//모달 뷰어
$('#modal-default2').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var recipient = button.data('whatever') // Extract info from data-* attributes

	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	var modal = $(this)

	var html='';
	html='<div class="col-3">\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left text-xs" onclick="callChart(\''+recipient+'\',\'htm5\')"> 고장모드 별 파이차트</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left text-xs" onclick="callChart(\''+recipient+'\',\'htm6\')"> 고장원인 별 파이차트</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left text-xs" onclick="callChart(\''+recipient+'\',\'htm7\')"> 고장조치사항 별 파이차트</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left text-xs" onclick="callChart(\''+recipient+'\',\'htm8\')"> 플랜트 구분 고장모드 별 파이차트</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left text-xs" onclick="callChart(\''+recipient+'\',\'htm9\')"> 플랜트 구분 고장원인 별 파이차트</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left text-xs" onclick="callChart(\''+recipient+'\',\'htm10\')"> 플랜트 구분 고장조치사항 별 파이차트</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left text-xs" onclick="callChart(\''+recipient+'\',\'htm11\')"> 고장모드 별 작동시간 히스토그램</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left text-xs" onclick="callChart(\''+recipient+'\',\'htm12\')"> 고장원인 별 작동시간 히스토그램</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left text-xs" onclick="callChart(\''+recipient+'\',\'htm13\')"> 고장조치사항 별 고장시간 히스토그램</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left text-xs" onclick="callChart(\''+recipient+'\',\'htm14\')"> 설비 별 작동시간 히스토그램</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left text-xs" onclick="callChart(\''+recipient+'\',\'htm15\')"> 설비 구분 고장모드 별<br> 작동시간 히스토그램</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left text-xs" onclick="callChart(\''+recipient+'\',\'htm16\')"> 설비 구분 고장원일 별<br> 작동시간 히스토그램</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left text-xs" onclick="callChart(\''+recipient+'\',\'htm17\')"> 설비 구분 고장조치사항 별<br> 작동시간 히스토그램</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left text-xs" onclick="callChart(\''+recipient+'\',\'htm18\')"> 고장모드 별 보수시간 히스토그램</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left text-xs" onclick="callChart(\''+recipient+'\',\'htm19\')"> 고장원인 별 보수시간 히스토그램</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left text-xs" onclick="callChart(\''+recipient+'\',\'htm20\')"> 고장조치사항 별 보수시간 히스토그램</button>\n' +
		'\t\t\t\t\t<button class="btn btn-block btn-outline-secondary text-left text-xs" onclick="callChart(\''+recipient+'\',\'htm21\')"> 설비 별 보수시간 히스토그램</button>\n' +
		'\t\t\t\t</div>\n' +
		'\t\t\t\t<div class="col-9 chartViewer">\n' +

		'\t\t\t\t</div>';
	modal.find('.modal-body.row').html(html)

})
//뷰어 차트 콜백
function callChart(arcd,htmlNum) {
	$.ajax({
		type: "POST",
		url: base_url+"kgview/htmlDefaultViewer",
		// dataType:"html",
		data:{"arcd":arcd,"htmlNum":htmlNum,},
		// async: false
	}).done(function(data){
		$('.modal-body.row .chartViewer').html(data)
	});

}
//비밀번호 초기화
$(document).on('click','.passwordChange',function () {
	$.ajax({
		type: "POST",
		url: base_url+"member/resetpasswordproc",
		// dataType:"html",
		data:$('#passwordChange').serialize(),
		// async: false
	}).done(function(data){
		// console.log(data);
		if(data.alerts_title){
			// $('#modal-user').modal('toggle');
			$.each(data.alerts_title,function (key,value) {
				$('.'+key).html(value);
			});
		}
		if(data.alerts_status=="success"){
			$('#modal-user').modal('toggle');
		}
	});
})
//사용자 승인
$(document).on("click",".joinApply",function () {
	if(!$('.list_chk').is(":checked")){
		callToast('변경 대상을 선택하세요','error','알림');
	}else{
		$.ajax({
			type: "POST",
			url: base_url+"console/joinapply",
			data:$('#defaultForm').serialize(),
		}).done(function(data){
			if(data.alerts_status=="success"){
				callToastHideAfter("요청이 정상적으로 처리되었습니다","success","알림",data);
			}
			else{
				callToastHideAfter("선택한 대상 중에 관리자가 포함되어있습니다.","success","알림",data);
			}
		});
	}
})
//사용자 삭제
$(document).on("click",".deleteUser",function () {
	if(!$('.list_chk').is(":checked")){
		callToast('변경 대상을 선택하세요','error','알림');
	}else{
		$.ajax({
			type: "POST",
			url: base_url+"console/deleteUser",
			data:$('#defaultForm').serialize(),
		}).done(function(data){
			if(data.alerts_status=="success"){
				callToastHideAfter("요청이 정상적으로 처리되었습니다","success","알림",data);
			}
			else{
				callToastHideAfter("선택한 대상 중에 관리자가 포함되어있습니다.","success","알림",data);
			}
		});
	}
})
//사용자 부여
$(document).on("click",".userAccessApply",function () {
	if(!$('.list_chk').is(":checked")){
		callToast('변경 대상을 선택하세요','error','알림');
	}else{
		$.ajax({
			type: "POST",
			url: base_url+"console/userAccessApply",
			data:$('#defaultForm').serialize(),
		}).done(function(data){
			if(data.alerts_status=="success"){
				callToastHideAfter("요청이 정상적으로 처리되었습니다","success","알림",data);
			}
			else{
				callToastHideAfter("선택한 대상 중에 관리자가 포함되어있습니다.","success","알림",data);
			}
		});
	}
})
//관리자권한 부여
$(document).on("click",".adminAccessApply",function () {
	if(!$('.list_chk').is(":checked")){
		callToast('변경 대상을 선택하세요','error','알림');
	}else{
		$.ajax({
			type: "POST",
			url: base_url+"console/adminAccessApply",
			data:$('#defaultForm').serialize(),
		}).done(function(data){
			if(data.alerts_status=="success"){
				callToastHideAfter("요청이 정상적으로 처리되었습니다","success","알림",data);
			}
			else{
				callToastHideAfter("관리자는 관리자 권한 부여를 할 수 없습니다\r\n시스템 관리자에게 문의 하세요.","success","알림",data);
			}
		});
	}
})
//썸모노트 이미지 업로드
function uploadSummernoteImageFile(file, editor) {
	data = new FormData();
	data.append("file", file);
	$.ajax({
		data : data,
		type : "POST",
		// enctype: 'multipart/form-data',
		url : "/fileupload/do_upload",
		contentType : false,
		processData : false,
		success : function(data) {
			// console.log(data)
			//항상 업로드된 파일의 url이 있어야 한다.
			$(editor).summernote('insertImage', base_url+'assets/editor/'+data.imgData.file_name);
		}
	});
}

//심화분석 모달
function adviewCall(data) {

	var ar_cd =data.ar_cd;
	var smode =data.smode;
	var inHtml ='';
	var inContent = '';
	var smodeActive ='';
	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	var modal = $(this)
	$.ajax({
		type: "POST",
		url: base_url+"kgview/htmlAdViewer",
		dataType:"json",
		data:{"arcd":ar_cd},
		// async: false
	}).done(function(data){
		inHtml ='';
		inContent = '조회된 데이터가 없습니다.';
		inContent2 = '조회된 데이터가 없습니다.';
		if(smode){
			smodeActive="disabled";
		}
		if(data.contentD) {
			$("#modal-adview").data('bs.modal')._config.backdrop = 'static';
			inContent = data.contentD;
			inContent2 = data.contentD2;
			inHtml += '' +
				'<div class="col-6 inContent"></div>' +
				'<div class="col-6">' +
				'\t<div class="form-group clearfix">\n' +
				'\t\t<div class="icheck-primary d-inline text-truncate">\n' +
				'\t\t\t<input type="radio" id="districhk1" name="distri" value="1" checked data-id="'+ar_cd+'">\n' +
				'\t\t\t<label for="districhk1" class="">Weibull 분포\n' +
				'\t\t\t</label>\n' +
				'\t\t</div>\n' +
				'\t</div>' +
				'\t<div class="form-group clearfix">\n' +
				'\t\t<div class="icheck-primary d-inline text-truncate">\n' +
				'\t\t\t<input type="radio" id="districhk2" name="distri" value="2" data-id="'+ar_cd+'">' +
				'\t\t\t<label for="districhk2" class="">로그 정규 분포\n' +
				'\t\t\t</label>\n' +
				'\t\t</div>\n' +
				'\t</div>' +
				'\t<div class="form-group clearfix">\n' +
				'\t\t<div class="icheck-primary d-inline text-truncate">\n' +
				'\t\t\t<input type="radio" id="districhk3" name="distri" '+smodeActive+' value="3" data-id="'+ar_cd+'">\n' +
				'\t\t\t<label for="districhk3" class="">지수\n' +
				'\t\t\t</label>\n' +
				'\t\t</div>\n' +
				'\t</div>' +
				'\t<div class="form-group clearfix">\n' +
				'\t\t<div class="icheck-primary d-inline text-truncate">\n' +
				'\t\t\t<input type="radio" id="districhk4" name="distri" value="4" data-id="'+ar_cd+'">\n' +
				'\t\t\t<label for="districhk4" class="">정규 분포\n' +
				'\t\t\t</label>\n' +
				'\t\t</div>\n' +
				'\t</div>' +
				'\t<div class="form-group clearfix">\n' +
				'\t\t<div class="icheck-primary d-inline text-truncate">\n' +
				'\t\t\t<input type="radio" id="districhk5" name="distri" '+smodeActive+' value="5" data-id="'+ar_cd+'">\n' +
				'\t\t\t<label for="districhk5" class="">비모수 분포\n' +
				'\t\t\t</label>\n' +
				'\t\t</div>\n' +
				'\t</div>' +
				'</div>' +
				'';
		}
		$('#modal-adview').find('.modal-body').eq(0).html(inHtml)
		$('#modal-adview').find('.inContent').html(inContent)
		$('#modal-adview').find('.card-body').html(inContent2)
	});

}
//심화 분석 요청
$(document).on('click','#requestAdRun',function () {
	$('.loading-bar-wrap').removeClass("hidden");
	var ar_cd = $('input[name=distri]:checked').attr("data-id");
	var distri = $('input[name=distri]:checked').val();
	$.ajax({
		type: "POST",
		url: base_url+"kgpbt/insertAdSelect",
		dataType:"json",
		data:{"ar_cd":ar_cd,"distri":distri},
		success : function(data) {
			callToastHideAfter(data.alerts_title,"success","Info",data,$('#modal-adview'));
		},
		// async: false
		complete: function(data){
			// TODO
			$('.loading-bar-wrap').addClass("hidden");
		},
		error: function (xhr, status, error) {
			console.log(error,xhr,status );
		}
	});

});
function submitBoardFormSave(){
	var title = $('input[name=title]').val();
	var content = $('textarea[name=content]').val();
	if(title!=null && content!=null){
		$.toast({
			position: 'bottom-right',
			heading: "알림",
			text: "요청이 정상적으로 처리되었습니다",
			icon: "success",
			// hideAfter: false
			loaderBg: '#ffffff',  // Background color of the toast loader
			hideAfter: 1700,
			afterHidden: function () {
				$('#defaultForm').submit();
			}
		});
	}else{
		if(title==null) callToast("제목은 필수 입력입니다.","error","알림")
		if(content==null) callToast("내용은 필수 입력입니다.","error","알림")
	}
}
function submitBoardDelete(br_cd){
	$.toast({
		position: 'bottom-right',
		heading: "알림",
		text: "요청이 정상적으로 처리되었습니다",
		icon: "success",
		// hideAfter: false
		loaderBg: '#ffffff',  // Background color of the toast loader
		hideAfter: 1700,
		afterHidden: function () {
			location.href='/console/boarddelete/'+br_cd;
		}
	});
}
