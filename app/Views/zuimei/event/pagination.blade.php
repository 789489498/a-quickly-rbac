<script>

//pagination init and query pagee event binding
var getOptions = function() {
    return {
    	currentPage: $("#currentPage").val(),
        rowsPerPage: $("#rowsPerPage").val(),
        totalPages: $("#totalPages").val(),
        totalRows: $("#totalRows").val(),
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

var queryPage = function(data) {
    toastr["success"]("正在加载..").css("background-color","#4CB6CB");
    params  = getParams();
    params.push({"name":"page","value":data.currentPage});
    params.push({"name":"pageSize","value":data.rowsPerPage});
    $.ajax({
        "url": $("#requestUrl").val(),
        "type": "post",
        "data" : params,
        "dataType" : "html",
        "error" : function (jqXHR, 
                textStatus, errorThrown) {
            console.log(jqXHR);
        },
        "success" : function (data) {
            $("#query_result").html(data);
            updateCount(".records_cnt", getOptions().totalRows);
            toastr.clear();
        }
    });
}
var bindPagination = function(){
    $("#id_pagination").bs_pagination(
  	  $.extend ({
        onChangePage: function(event, data) {
        	queryPage(data);
        }
    }, getOptions()));
}
bindPagination();

</script>