//点击搜索结果某一行后执行的动作

var i_global;//全局变量 其他iframe调用并用来判断
$('#table_searchResults').datagrid({
  onDblClickRow: function (rowIndex, rowData) {
      //新建面板的id和headerTitle
      var id = 'panel_' + rowData.XMDM;
      var headerTitle = rowData.XMMC + "(" + rowData.XMDM + ")";
      //新建点击的项目的图层
      if (typeof(line_round) == "object") {
         _map.removeLayer(line_round);
      }
      var obj_projects = window['ydhx_data'].features;
      for (var i = 0; i < obj_projects.length; i++) {
        if(obj_projects[i].properties.xmdm == rowData.XMDM){
          i_global = i;
          let array = obj_projects[i].geometry.coordinates[0];
          line_round = L.polyline(sort_xy(array), {
        		style:{color: '#01ffff',weight:8},
        		pane:'labels'
        	});
          _map.addLayer(line_round);
          _map.fitBounds(line_round.getBounds());
        };
      }
      // window['ydhx_'+rowData.XMDM] = L.geoJSON(JSON.parse(rowData.geodata)).addTo(_map);

      //新建项目面板
      var id = 'panel_' + rowData.XMDM;
      var headerTitle = rowData.XMMC + "(" + rowData.XMDM + ")";
      jsPanel.create({
        contentSize: {
            width:  $(window).width() * 0.45,
            height: $(window).height() * 0.4
        },
        id: id,
        headerTitle: '<font style="font-size:16px">'+headerTitle+'</font>',
        position: {
          my: "center",
          at: "center",
          offsetX: 0,
          offsetY: 0
        },
        headerToolbar: '<button type="button" class="btn btn-default" name="button" id="btn_complianceCheck" style="float:right;width:110px">合规性检查</button>',
        callback: function (panel) {
           this.headertoolbar.querySelector('#btn_complianceCheck').addEventListener('click', function () {
             complianceCheck(rowData.XMDM);
           });
           Array.prototype.slice.call(panel.headertoolbar.querySelectorAll('button')).forEach(function (item) {
             item.style.cursor = 'pointer';
             item.style.height = '26px';
             item.style.width = '110px';
             item.style.margin = '0px 0px 0px 85%';
             item.style.padding = '0';
           });
         },
        syncMargins: true,// 边框限制
        // resizeit: {
        //   disable: true
        // },
        headerControls: {
          maximize: 'remove',
          smallify: 'remove'
        },
        theme: 'primary',
        borderRadius: 0,
        content: '<iframe src="panel_projectDetails.php?XMDM=' + rowData.XMDM + '" style="width: 100%; height: 98%;border:0"></iframe>'
      })
    }
        });
