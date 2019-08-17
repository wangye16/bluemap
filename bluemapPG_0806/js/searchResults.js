// 搜索框搜索结果

function startSearch() {  //调用ajax来实现异步的加载数据
    var msg = document.getElementById("searchBar").value;
    $.ajax({
        type: "POST",
        async: true,
        url: "projectSearch.php",
        data:{
            projectName:msg
        },
        dataType: "json",
        success: function(result){
            function pagerFilter(data){
              if (typeof data.length == 'number' && typeof data.splice == 'function'){	// is array
                data = {
                  total: data.length,
                  rows: data
                }
              }
              var dg = $(this);
              var opts = dg.datagrid('options');
              var pager = dg.datagrid('getPager');
              pager.pagination({
                onSelectPage:function(pageNum, pageSize){
                  opts.pageNumber = pageNum;
                  opts.pageSize = pageSize;

                  pager.pagination('refresh',{
                    pageNumber:pageNum,
                    pageSize:pageSize
                  });
                  dg.datagrid('loadData',data);
                }
              });
              if (!data.originalRows){
                data.originalRows = (data.rows);
              }
              var start = (opts.pageNumber-1)*parseInt(opts.pageSize);
              var end = start + parseInt(opts.pageSize);
              data.rows = (data.originalRows.slice(start, end));
              return data;
            }
            $(function(){
              $('#table_searchResults').datagrid({loadFilter:pagerFilter}).datagrid('loadData', result);
            });
            document.getElementById('panel_searchResults').style.visibility = 'visible';
        },
        error: function(errmsg) {
            alert("搜索结果出错");
        }
    });
}
$('#searchBar').bind('keydown',function(e){
    if(e.keyCode == 13){
        startSearch();
    }
})
