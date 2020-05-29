$('input[name=anal_type]').on('change',function(){
	var anal_type_value = $(this).val();
	console.log(anal_type_value)
	if(anal_type_value=='E'){
		$('.anal_flag_c').addClass('hidden');
		$('.kgpbtLocale').addClass('hidden');
	}else{
		$('.anal_flag_c').removeClass('hidden');
		$('.kgpbtLocale').removeClass('hidden');
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
//플랜트 선택
$('select[name=key1_cd]').on('change',function () {
	var html='';
	//화면에 플랜트 위치 오브젝트 가 존재하면 위치정보를 출력
	if($('.kgpbtLocale').length > 0 ){
		$.ajax({
			type: "POST",
			url: base_url+"kgpbt/ajaxMultiSelect",
			data:{"key1arr":$(this).val()},
			dataType: "json",
			success: function (data) {
				$.each(data.localeList,function (key,value) {
					html+='<option value="'+value.key2_cd+'">'+value.key2_nm+'</option>\n';
				})
				$('select[name=key2_cd]').html(html);
			}
		});
	}
})
//검정모드 플랜트 선택
$('select[name=check_mode_key1_cd]').on('change',function () {
	var html='';
	//화면에 플랜트 위치 오브젝트 가 존재하면 위치정보를 출력
	if($('.kgpbtLocale').length > 0 ){
		$.ajax({
			type: "POST",
			url: base_url+"kgpbt/ajaxMultiSelect",
			data:{"key1arr":$(this).val()},
			dataType: "json",
			success: function (data) {
				$.each(data.localeList,function (key,value) {
					html+='<option value="'+value.key2_cd+'">'+value.key2_nm+'</option>\n';
				})
				$('select[name=check_mode_key2_cd]').html(html);
			}
		});
	}
})
// 1차 분류 선택 2차 표시
$('select[name=key3_cd]').on('change',function () {
	var html ='';
	$.ajax({
		type: "POST",
		url: base_url+"kgpbt/ajaxMultiSelectKgpbtFirst",
		data:{"key3_cd":$(this).val()},
		dataType: "json",
		success: function (data) {
			console.log(data)
			if(!data.alerts_title){
				$.each(data.list,function (key,value) {
					html+='<option value="'+value.key4_cd+'">'+value.key4_nm+'</option>\n';
				})
				$('select[name=key4_cd]').html(html);
			}else{
				Toast.fire({
					icon: data.alerts_icon,
					title: data.alerts_title,
				})
			}
		}
	});
});
//2차 분류 선택 3차 표시
$('select[name=key4_cd]').on('change',function () {
	var html ='';
	$.ajax({
		type: "POST",
		url: base_url+"kgpbt/ajaxMultiSelectKgpbtSecond",
		data:{
			"key3_cd":$('select[name=key3_cd]').val(),
			"key4_cd":$(this).val(),
		},
		dataType: "json",
		success: function (data) {
			$.each(data.list,function (key,value) {
				html+='<option value="'+value.key5_cd+'">'+value.key5_nm+'</option>\n';
			})
			$('select[name=key5_cd]').html(html);
		}
	});
});
//3차분류 선택 4차 표시
$('select[name=key5_cd]').on('change',function () {
	var html ='';
	$.ajax({
		type: "POST",
		url: base_url+"kgpbt/ajaxMultiSelectKgpbtThird",
		data:{
			"key3_cd":$('select[name=key3_cd]').val(),
			"key4_cd":$('select[name=key4_cd]').val(),
			"key5_cd":$(this).val(),
		},
		dataType: "json",
		success: function (data) {
			$.each(data.list,function (key,value) {
				html+='<option value="'+value.key6_cd+'">'+value.key6_nm+'</option>\n';
			})
			$('select[name=key6_cd]').html(html);
		}
	});
});
//고장모드 선택
$('input[name=anal_flag]').on('change',function () {
	console.log($(this).val());
	var anal_flag_value = $(this).val();
	$('.anal_flag').attr('disabled','disabled');
	if(anal_flag_value == 'B'){
		$('select[name=kgcod]').removeAttr('disabled');
		$('select[name=check_mode_key1_cd]').attr('disabled','disabled');
	}else if(anal_flag_value == 'C'){
		$('select[name=check_mode_key1_cd]').removeAttr('disabled');
		$('select[name=check_mode_key2_cd]').removeAttr('disabled');
		$('select[name=kgcod]').attr('disabled','disabled');
	}else{
		$('select[name=kgcod]').attr('disabled','disabled');
	}
})
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
