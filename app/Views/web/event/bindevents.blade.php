<script>

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

// click event: search
$(document).on('click', '.search_sbtn', function(){
	params  = [];
    params.push({"name":"page","value":1});
    params.push({"name":"pageSize","value":$("#rowsPerPage").val()});
    params.push({"name":"tableColumns","value":$.trim($('#tableColumns').val())});
    params.push({"name":"title","value":$.trim($('.search_input').val())});
    params.push({"name":"type","value":"search"});
    queryPage(params);
    return false;
})

// click event: categroy
$(document).on('click', '.category-c a', function(){
	if ($.trim($(this).data('categoryid')) == "") {
		return true;
	}
    params  = [];
    params.push({"name":"page","value":1});
    params.push({"name":"pageSize","value":$("#rowsPerPage").val()});
    params.push({"name":"tableColumns","value":$.trim($('#tableColumns').val())});
    params.push({"name":"category_id","value":$.trim($(this).data('categoryid'))});
    params.push({"name":"type","value":"category"});
    queryPage(params);
    return false;
})

// click event: tag
$(document).on('click', '.tag-c a', function(){
	if ($.trim($(this).data('tag')) == "") {
		return true;
	}
    params  = [];
    params.push({"name":"page","value":1});
    params.push({"name":"pageSize","value":$("#rowsPerPage").val()});
    params.push({"name":"tableColumns","value":$.trim($('#tableColumns').val())});
    params.push({"name":"tag","value":$.trim($(this).data('tag'))});
    params.push({"name":"type","value":"tag"});
    queryPage(params);
    return false;
})

// click event: recent article
$(document).on('click', '.recent-art-c .article-link', function(){
	if ($.trim($(this).data('articleid')) == "") {
		return true;
	}
    params  = [];
    params.push({"name":"page","value":1});
    params.push({"name":"pageSize","value":$("#rowsPerPage").val()});
    params.push({"name":"tableColumns","value":$.trim($('#tableColumns').val())});
    params.push({"name":"id","value":$.trim($(this).data('articleid'))});
    queryPage(params);
    return false;
})

// loading process bar
$('[data-bjax]').bjax();

</script>