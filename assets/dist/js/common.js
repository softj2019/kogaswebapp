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
$('.multipleSelect1').on('change',function () {
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
				$('.multipleSelect2').html(html);
			}
		});
	}
})
$('.multipleSelect3').on('change',function () {
	var multiSelectVal = $(this).val()
	$.ajax({
		// type: "POST",
		// url: base_url+"kgpbt/ajaxMultiSelect",
		// data:{"key1arr":$(this).val()},
		// dataType: "json",
		// success: function (data) {
		// 	$.each(data.localeList,function (key,value) {
		// 		html+='<option value="'+value.key2_cd+'">'+value.key2_nm+'</option>\n';
		// 	})
		// 	$('.multipleSelect2').html(html);
		// }
	});
});
