$('input[name=anal_type]').on('change',function(){
	var anal_type_value = $(this).val();
	console.log(anal_type_value)
	if(anal_type_value=='E'){
		$('.anal_flag_c').addClass('hidden');
	}else{
		$('.anal_flag_c').removeClass('hidden');
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
	console.log($(this).val());
	$.ajax({
		type: "POST",
		url: "kgpbt/ajaxMultiSelect",
		// data:{"key1arr":1},
		dataType: "json",
		success: function (data) {
			console.log(data)
		}
	});
})

