<script>
var csrf_token="<?php echo csrf_token(); ?>";
var getParams = function() {
    var params =$("#query_form").serializeArray();
    params.push({"name":"_token","value":csrf_token});
    return params;
}

$(".leftbar_switch").click(function(){
	var leftBarIsOpen = Cookies.get('leftBarOpen');
	if (leftBarIsOpen == "close" 
		|| leftBarIsOpen == undefined) {
		Cookies.set('leftBarOpen', 'open');
		return;
	}
	Cookies.set('leftBarOpen', 'close');
})

var ajaxErrorHandle = function(e){
	toastr.remove();
	toastr.options.timeOut = 5000;
	toastr["error"](e.responseText);
	console.log(e);
}

</script>