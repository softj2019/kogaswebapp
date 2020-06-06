$('#summernote').summernote({
	placeholder: '글 내용을 입력하세요',
	tabsize: 10,
	height: 420,
	lang: 'ko-KR', // default: 'en-US'
	callbacks: {	//여기 부분이 이미지를 첨부하는 부분
		onImageUpload : function(files) {
			uploadSummernoteImageFile(files[0],this);
		}
	}
});
$(document).ready(function () {
	bsCustomFileInput.init();
});
