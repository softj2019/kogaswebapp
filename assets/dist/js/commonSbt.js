$('.startDateCustom').daterangepicker({
	singleDatePicker: true,
	startDate: moment().subtract(30, 'days'),
	locale:"ko",
	locale: {
		format: 'YYYY-MM-DD',
	}
});
