<script>

//pagination init and query pagee event binding
var getOptions = function() {
    return {
    	currentPage: $("#currentPage").val(),
        rowsPerPage: $("#rowsPerPage").val(),
        totalPages:  $("#totalPages").val(),
        totalRows:   $("#totalRows").val(),
        maxRowsPerPage: 100,
        visiblePageLinks: 6,
        showGoToPage: false,
        showRowsPerPage: false,
        showRowsInfo: false,
        showRowsDefaultInfo: false,
        containerClass: "",
    }
}

var updateCount = function(element, cnt){
    $(element).text(cnt);
}

//public query function
var queryPage = function(params) {
    toastr["success"]("正在加载..").css("background-color","#4CB6CB");

    //construct form
    var formParams = [];
    for (k in params) {
    	formParams.push($('<input>', params[k]));
    }
    $('<form>', {  
        method: 'get',  
        action: $("#requestUrl").val(),  
    }).append(formParams).submit();

}

//pagination
var bindPagination = function(){
    $("#id_pagination").bs_pagination(
  	  $.extend ({
	    onChangePage: function(event, data) {
            //collect parameters
            var requestType = $.trim($('#type').val());
            params  = [];
            params.push({"name":"page","value":data.currentPage});
            params.push({"name":"pageSize","value":data.rowsPerPage});
            params.push({"name":"tableColumns","value":$.trim($('#tableColumns').val())});
            params.push({"name":"type","value":requestType});
			if (requestType == "tag") {
				params.push({"name":"tag","value":$.trim($('#tag').val())});
			}
			if (requestType == "search") {
            	params.push({"name":"title","value":$.trim($('.search_input').val())});
			}
			if (requestType == "category") {
				params.push({"name":"category_id","value":$.trim($('#categoryId').val())});
			}
        	queryPage(params);
        }
    }, getOptions()));
}
bindPagination();

</script>