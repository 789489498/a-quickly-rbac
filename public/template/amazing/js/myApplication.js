
//abstract event binding
var bindEvent = function (element, event, ajax){
	$(document).on(event, element, function(){
		var that = $(this);
		toastr["success"]("正在响应..").css("background-color","#4CB6CB");
		if (ajax != "") {
			ajax(that);
		}
	})
}


toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-center",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "500",
  "timeOut": "300",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut",
}


var setInputEmpty = function(elements) {
	var elms = elements.split(',');
	for (k in elms) {
		$("input[name="+elms[k]+"]").val('');
	}
}


