//创建信息面板

var offsets = 10;// 元素距离浏览器边框的偏移值
var windowWidth = document.documentElement.clientWidth;
var windowheight = document.documentElement.clientHeight;
var width = "18%"; // 元素宽度（甲方要求）
var height = (parseInt(windowheight) - 40 - offsets*2)/2;
var height_layerTree = height; // 图层信息元素高度（甲方要求）
var height_legends = height; // 动态图例元素高度（甲方要求）
var panelSize_layerTree = '18% '+ height;// 面板整体尺寸
var panelSize_legends = '18% '+ height;// 面板整体尺寸
var top_legends = offsets + height + 40;
// console.log(windowheight);
//创建图层信息面板
var panel_layerTree = jsPanel.create({
  onsmallified: function(){
    var obj = document.getElementById('panel_layerTree');
    obj.style.width = "7.5%";
    obj.style.left=null;
    // obj.style.left = windowWidth - obj.offsetWidth - offsets + 'px';
    obj.style.right = offsets + 'px';
    obj.style.top = offsets + 'px';
  },
  onunsmallified: function(){
    var obj = document.getElementById('panel_layerTree');
    var right = windowWidth - parseInt(obj.style.left) - parseInt(windowWidth*0.075);
    obj.style.width = width;
    obj.style.height = height;
    obj.style.left = null;
    obj.style.right = right + 'px';
  },
  panelSize: panelSize_layerTree,
  id: "panel_layerTree",
  headerTitle: '<font style="font-size:16px">图层信息</font>',
  content: '<ul class="easyui-tree" id="layer_tree" checkbox="true" url="data/tree_data.json" data-options="lines:true"></ul>',
  position: {
    my: "right-top",
    at: "right-top",
    offsetX: -offsets,
    offsetY: offsets
  },
  syncMargins: true,// 边框限制
  headerControls: {
    maximize: 'remove',
    minimize: 'remove',
    close: 'remove'
  },
  theme: 'primary',
  borderRadius: 6
});

// 创建动态图例面板
var panel_legends = jsPanel.create({
  onsmallified: function(){
    var obj = document.getElementById('panel_legends');
    obj.style.width = "7.5%";
    obj.style.left=null;
    obj.style.top= top + 'px';
    // obj.style.left = windowWidth - obj.offsetWidth - offsets + 'px';
    obj.style.right = offsets + 'px';
    // obj.style.bottom = offsets+ 'px';
  },
  onunsmallified: function(){
    var obj = document.getElementById('panel_legends');
    var right = windowWidth - parseInt(obj.style.left) - parseInt(windowWidth*0.075);
    obj.style.width = width;
    obj.style.height = height;
    obj.style.left=null;
    obj.style.right = right + 'px';
  },
  panelSize: panelSize_legends,
  contentSize: '100% 100%',
  id: "panel_legends",
  headerTitle: '<font style="font-size:16px">动态图例</font>',
  // content: '<ul class="easyui-tree" checkbox="true" url="data/tree_data.json" data-options="lines:true"></ul>',
  content: '<div id="ul-container"><ul id="layer_ntbhhx">永久基本农田<li><img src="./images/legends/yongjiujibennongtian.png" alt=""></li></ul><ul id="layer_stbhhx">生态控制线<li><img src="./images/legends/shengtaikongzhixian.png" alt=""></li></ul><ul id="layer_kfbj" >城镇开发边界<li> <img src="./images/legends/chengzhenkaifabianjie.png" alt=""></li></ul><ul id="layer_stkj" >生态空间<li> <img src="./images/legends/shengtaikongjian.png" alt=""></li></ul><ul id="layer_ydhx" style="display:block">用地红线<li> <img src="./images/legends/yongdihongxian.png" alt=""></li></ul><ul id="layer_nykj">农业空间<li> <img src="./images/legends/nongyekongjian.png" alt=""></li></ul><ul id="layer_czkj">城镇空间<li> <img src="./images/legends/chengzhenkongjian.png" alt=""></li></ul></div>' ,

  position: {
    my: "right-bottom",
    at: "right-bottom",
    offsetX: -offsets,
    offsetY: -offsets
  },

  syncMargins: true,// 边框限制
  headerControls: {
    maximize: 'remove',
    minimize: 'remove',
    close: 'remove'
  },
  theme: 'primary',
  borderRadius: 6
});



//搜索结果面板
  var lineHeight = 20;
  var titleHeight = document.getElementsByClassName("jsPanel-headerbar")[0].offsetHeight;
  var paginationHeight = 35;
  var searchResults_height = lineHeight*21 + titleHeight + paginationHeight;
  var panel_searchResults = jsPanel.create({
    onsmallified: function(){
      var obj = document.getElementById('panel_searchResults');
      obj.style.width = "9%";
      obj.style.left = '50px';
      obj.style.top = '50px';
      // obj.theme = 'success';
      // obj.style.color = 'black';
    },
    resizeit: {
      disable: true,
      maxHeight: searchResults_height,
      maxWidth: '35%'
    },
    onunsmallified: function(){
      var obj = document.getElementById('panel_searchResults');
      obj.style.width = '35%';
      obj.style.left='50px';
    },
    panelSize: {width: '35%',height:searchResults_height},
    id: "panel_searchResults",
    dragit: {
      disable: true
    },
    // contentOverflow: 'hidden',
    headerTitle: '<font style="font-size:16px">搜索项目结果</font>',
    content: '<table id="table_searchResults" class="easyui-datagrid" striped=true fit=true overflow="hidden" pageSize=20 pageList=[20] rownumbers="true" singleSelect="true" autoRowHeight="true" pagination="true" fitColumns="true"><thead style="width:100%;height:"416px"><tr><th field="XMDM" style="width:30%">项目代码</th><th field="XMMC" style="width:40%">项目名称</th><th field="GCFW" style="width:33%">工程范围</th></tr></thead></table>',
    position: {
      my: "left-top",
      at: "left-top",
      offsetX: 50,
      offsetY: 50
    },
    syncMargins: true,// 边框限制
    headerControls: {
      maximize: 'remove',
      minimize: 'remove',
      close: 'remove'
    },
    theme: 'primary',
    borderRadius: 6
  });



$('#layer_tree').tree({
  onCheck: function(node){
    console.log(node);
    var dttlxs = document.getElementById(node.name);

      if (node.name != "sqsx") {
          // var dttlxs = document.getElementById(node.name);
          if (node.checkState == "checked") {
             if (node.name == "layer_sanlei") {
                var shengtaikongjian = document.getElementById("layer_stkj");
                shengtaikongjian.style.display="block";
                var nongyekongjian = document.getElementById("layer_nykj");
                nongyekongjian.style.display="block";
                var chengzhenkongjian= document.getElementById("layer_czkj");
                chengzhenkongjian.style.display="block";
                _map.addLayer(layer_stkj);
                _map.addLayer(layer_stkj_wms);
                _map.addLayer(layer_nykj);
                _map.addLayer(layer_nykj_wms);
                _map.addLayer(layer_czkj);
                _map.addLayer(layer_czkj_wms);
            }else if (node.name == "layer_ydhx") {
                if (window['line_round']) {
                  _map.addLayer(line_round);
                }
                dttlxs.style.display="block";
            }else {
                dttlxs.style.display="block";
            }
            if (window[node.name]!= null && window[node.name].tagName!="UL") {
              if (window[node.name+'_wms']) {
                _map.addLayer(window[node.name+'_wms']);
              }
              _map.addLayer(window[node.name]);
            }
          }else {
            if (node.name == "layer_sanlei") {
                var shengtaikongjian = document.getElementById("layer_stkj");
                shengtaikongjian.style.display="none";
                var nongyekongjian = document.getElementById("layer_nykj");
                nongyekongjian.style.display="none";
                var chengzhenkongjian= document.getElementById("layer_czkj");
                chengzhenkongjian.style.display="none";
                _map.removeLayer(layer_stkj);
                _map.removeLayer(layer_stkj_wms);
                _map.removeLayer(layer_nykj);
                _map.removeLayer(layer_nykj_wms);
                _map.removeLayer(layer_czkj);
                _map.removeLayer(layer_czkj_wms);
            }else if (node.name == "layer_ydhx") {
              if (window['line_round']) {
                _map.removeLayer(line_round);
              }
                dttlxs.style.display="none";
            }else {
                dttlxs.style.display="none";
            }
            if (window[node.name]!= null && window[node.name].tagName!="UL") {
              if (window[node.name+'_wms']) {
                _map.removeLayer(window[node.name+'_wms']);
              }
              _map.removeLayer(window[node.name]);
            }
          }
      }else if (node.name == "sqsx") {
        console.log(node);
          if (node.checkState == "checked") {
            // window['dttl'].style.visibility =  'visible';
              for (var i = 0; i < node.children.length; i++) {
                  var  name =node.children[i].name;
                  if (name == 'sqsx') {
                    continue;
                  }
                  if (name == "layer_sanlei") {
                      var shengtaikongjian = document.getElementById("layer_stkj");
                      shengtaikongjian.style.display="block";
                      var nongyekongjian = document.getElementById("layer_nykj");
                      nongyekongjian.style.display="block";
                      var chengzhenkongjian= document.getElementById("layer_czkj");
                      chengzhenkongjian.style.display="block";

                  }
                  // console.log(123);
                  var dttlxs = document.getElementById(name);
                  if (dttlxs) {
                    dttlxs.style.display="block";
                  }
                  _map.addLayer(layer_ntbhhx);
                  _map.addLayer(layer_kfbj);
                  _map.addLayer(layer_stbhhx);
                  _map.addLayer(layer_stkj);
                  _map.addLayer(layer_stkj_wms);
                  _map.addLayer(layer_nykj);
                  _map.addLayer(layer_nykj_wms);
                  _map.addLayer(layer_czkj);
                  _map.addLayer(layer_czkj_wms);
              }
          }else {
            // window['dttl'].style.visibility = 'hidden';
              for (var i = 0; i < node.children.length; i++) {
                  var  name =node.children[i].name;
                  if (name == 'sqsx') {
                    continue;
                  }
                    if (name == "layer_sanlei") {
                        var shengtaikongjian = document.getElementById("layer_stkj");
                        shengtaikongjian.style.display="none";
                        var nongyekongjian = document.getElementById("layer_nykj");
                        nongyekongjian.style.display="none";
                        var chengzhenkongjian= document.getElementById("layer_czkj");
                        chengzhenkongjian.style.display="none";
                    }
                  var dttlxs = document.getElementById(name);
                  if (dttlxs) {
                    dttlxs.style.display="none";
                  }
                  _map.removeLayer(layer_ntbhhx);
                  _map.removeLayer(layer_kfbj);
                  _map.removeLayer(layer_stbhhx);
                  _map.removeLayer(layer_stkj);
                  _map.removeLayer(layer_stkj_wms);
                  _map.removeLayer(layer_nykj);
                  _map.removeLayer(layer_nykj_wms);
                  _map.removeLayer(layer_czkj);
                  _map.removeLayer(layer_czkj_wms);
              }
          }
      }
  }
});
