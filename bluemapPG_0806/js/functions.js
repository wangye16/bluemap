//封装ajax
function ajax(method, url, callback, data, flag) {
    var xhr = null;
    if(window.XMLHttpRequest) {
        xhr =  new XMLHttpRequest();
    }else {
        xhr = new ActiveXObject('Microsoft.XMLHttp')
    }
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                console.log(xhr.responseText);
            }else {
                console.log('error');
            }
        }
    }
    method = method.toUpperCase();
    if(method == 'GET') {
        var date = new Date(),
            timer = date.getTime();
        xhr.open(method, url + '?' + data + '&timer=' + timer, flag);
        xhr.send();
    }else if(method == 'POST') {
        xhr.open(method, url, flag);
        xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        xhr.send(data);
    }
}



//获取url中的参数
function getQueryVariable(variable){
     var query = window.location.search.substring(1);
     var vars = query.split("&");
     for (var i=0;i<vars.length;i++) {
             var pair = vars[i].split("=");
             if(pair[0] == variable){return pair[1];}
     }
     return(false);
 }

//合规性检查开始分析按钮
 function complianceCheck_result(){
   var xiangmudaima = document.getElementsByName('xiangmudaima')[0].value;
   var xiangmuliebiao = document.getElementsByName('xiangmuliebiao')[0].value;
   var xiangmuleixing = document.getElementsByName('xiangmuleixing')[0].value;
   var yongdixingzhi = document.getElementsByName('yongdixingzhi')[0].value;
   var yongdimianji = document.getElementsByName('yongdimianji')[0].value;
   var jianshedanwei = document.getElementsByName('jianshedanwei')[0].value;
   var jianshedizhi = document.getElementsByName('jianshedizhi')[0].value;
   var tucengxuanze = new Array();
   var a = document.getElementsByName('tucengxuanze');
   for (var i = 0; i < a.length; i++) {
     if (a[i].checked) {
         tucengxuanze.push(a[i].value);
     }
   }
   var panel_complianceCheckResult = jsPanel.create({
     panelSize: {width: '600px',height:'330px'},
     id: "complianceCheck_result",
     resizeit: {
       disable: true
     },
     // contentOverflow: 'hidden',
     headerTitle: '<font style="font-size:16px">项目合规性检测结果</font>',
     content: '',
     position: {
       my: "center",
       at: "center",
       offsetX: 0,
       offsetY: 40
     },
     syncMargins: true,// 边框限制
     headerControls: {
       maximize: 'remove',
       minimize: 'remove',
       smallify: 'remove'
     },
     theme: 'primary',
     borderRadius: 6,
     content: '<iframe src="./panel_complianceCheckResult.php?xiangmudaima=' + xiangmudaima + '&tucengxuanze='+tucengxuanze+'" style="width:100%; height:290px;border:0"></iframe>',
     // contentAjax: {
     //   url: "heguixingjiancha/jianchajieguo.php?xiangmudaima=" + xiangmudaima + "&tucengxuanze="+tucengxuanze,
     //   evalscripttags: true
     // },
   });
 }

 //取多边形中间点
 function getCenterPoint(path) {
     var x = 0.0;
     var y = 0.0;
     for (var i = 0; i < path.length; i++) {
         x = x + parseFloat(path[i][0]);
         y = y + parseFloat(path[i][1]);
     }
     polygonCenterX = x / path.length;
     polygonCenterY = y / path.length;
 }


//点击选项卡页面合规性检查按钮
 function complianceCheck(XMDM){
   var xmdm = XMDM;
   var panelSize = '280px 85%';
   var id = 'complianceCheck_' + XMDM;
   var headerTitle = '合规性检查';
   var offsets = 40
   jsPanel.create({
     panelSize: panelSize,
     id: id,
     headerTitle: '<font style="font-size:16px">'+headerTitle+'</font>',
     content: headerTitle,
     position: {
       my: "left-center",
       at: "left-center",
       offsetX: offsets,
       offsetY: 0
     },
     syncMargins: true,// 边框限制
     resizeit: {
       disable: false
     },
     headerControls: {
       maximize: 'remove',
       smallify: 'remove'
     },
     theme: 'primary',
     borderRadius: 6,
     contentAjax: {
       url: './panel_complainceCheck.php?XMDM='+xmdm,
       evalscripttags: true
     },
   })
 }


//反转json中xy坐标
 function sort_xy(array){
   var array1 = [];
   for (var j = 0; j < array.length; j++) {
      array1[j] = [];
      array1[j][1] = array[j][0];
      array1[j][0] = array[j][1];
   }
   return array1;
 }


 //点击用地红线
 function ydhx_click(layer){
   window[layer].on('click',function(e){
     var XMDM_clicked = e.layer.feature.properties.xmdm;
     var XMMC_clicked = e.layer.feature.properties.xmmc;
     var id = 'panel_' + XMDM_clicked;
     var headerTitle = XMMC_clicked + "(" + XMDM_clicked + ")";
     createXiangxixinxiAndBorder(id,headerTitle,XMDM_clicked,XMMC_clicked);
   })
 }


 //添加边框和新建面板
 function createProjectDetailsAndPositioning(id,headerTitle,xmdm,xmmc){
   //改变图层颜色
   if (typeof(line_round) == "object") {
      _map.removeLayer(line_round);
   }
   var obj_projects = window['ydhx_data'].features;
   for (var i = 0; i < obj_projects.length; i++) {
     if(obj_projects[i].properties.xmdm == xmdm){
       var i_global = i;
       let array = obj_projects[i].geometry.coordinates[0];
       line_round = L.polyline(sort_xy(array), {
         style:{color: '#01ffff',weight:8},
         pane:'labels'
       });
       _map.addLayer(line_round);//创建边框线
       _map.fitBounds(line_round.getBounds());//把当前项目放到屏幕中间
       };
     }
     //新建项目信息面板
     jsPanel.create({
       // panelSize: panelSize,
       contentSize: {
           width:  '530px',
           height: $(window).height() * 0.4
       },
       id: id,
       headerTitle: headerTitle,
       position: {
         my: "center",
         at: "center",
         offsetX: 0,
         offsetY: 0
       },
       headerToolbar: '<button type="button" class="btn btn-default" name="button" id="btn_complianceCheck" style="float:right;width:110px">合规性检查</button>',
       callback: function (panel) {
          this.headertoolbar.querySelector('#btn_complianceCheck').addEventListener('click', function () {
            complianceCheck(xmdm);
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
       resizeit: {
         disable: false
       },
       headerControls: {
         maximize: 'remove',
         smallify: 'remove'
       },
       theme: 'primary',
       borderRadius: 0,
       content: '<iframe src="panel_projectDetails.php?XMDM=' + xmdm + '" style="width: 100%; height: 98%;border:0"></iframe>'
     })
     return i_global;
 }


 //为跨域定制的合规性检查逻辑函数
 function complaince_postMessage(xmdm,tucengxuanze,i_global){
   var result_obj = {};
   result_obj.xiangmudaima = xmdm;
   // console.log(window.ydhx_data.features[i_global]);
   var count_threeLines = 0;//"三线审查结果：0为全过 不是0为有一个没过"
   var count_otherLines = 0;//其他控制线符合性审查建议：0为全过 不是0为有一个没过"
   var count_otherPlans = 0;//是否符合其他专项规划：0为全过 不是0为有一个没过"
   var zonghejielun;
   for (var i = 0; i < tucengxuanze.length; i++) {
       //合规性检查图层逻辑判断
       switch (tucengxuanze[i]) {
         case '城市增长边界':
           for(var k = 0 ; k < window.kfbj_data.features.length ; k++){
             var fea_kfbj = turf.intersect(window.kfbj_data.features[k].geometry,  window.ydhx_data.features[i_global].geometry)
               if(fea_kfbj == null){
                 fea_1 = true;
               }
               else if(fea_kfbj.geometry.type == "LineString" || fea_kfbj.geometry.type =="MultiLineString" || fea_kfbj.geometry.type =="Point" || fea_kfbj.geometry.type =="MultiPoint"){
                 fea_1 = true;
               }
               else{
                 fea_1 = false;
                 result_obj.area_kfbj = turf.area(fea_kfbj);
                 break;
               }
             }
             if(!fea_1){
               count_threeLines++;
             }
             break;
         case '基本农田保护红线':
             for(var k = 0 ; k < window.ntbhhx_data.features.length ; k++){
               var fea_ = turf.intersect(window.ntbhhx_data.features[k].geometry,  window.ydhx_data.features[i_global].geometry)
                 if(fea_ == null){
                   fea_1 = true;
                 }
                 else if(fea_.geometry.type == "LineString" || fea_.geometry.type =="MultiLineString" || fea_.geometry.type =="Point" || fea_.geometry.type =="MultiPoint"){
                   fea_1 = true;
                 }
                 else{
                   fea_1 = false;
                   result_obj.area_ntbhhx = turf.area(fea_);
                   break;
                 }
               }
               if(!fea_1){
                 count_threeLines++;
               }
               break;

         case '生态保护红线':
               for(var j = 0 ; j < window.stbhhx_data.features.length ; j++){
               var fea = turf.intersect(window.stbhhx_data.features[j].geometry,  window.ydhx_data.features[i_global].geometry)
               if(fea == null){
                   fea1 = true;
                 }
                 else if(fea.geometry.type == "LineString" || fea.geometry.type =="MultiLineString" || fea.geometry.type =="Point" || fea.geometry.type =="MultiPoint"){
                   fea1 = true;
                 }
                 else{
                   fea1 = false;
                   result_obj.area_stbhhx = turf.area(fea);
                   break;
                 }
               }
               if(!fea1){
                 count_threeLines++;
               }
               break;
       }
   }

   zonghejielun = (count_threeLines == 0&&count_otherLines == 0&&count_otherPlans == 0);
   result_obj.zonghejielun = zonghejielun ? '通过' : '不通过';
   result_obj.threeLines = count_threeLines==0 ? '通过' : '不通过';
   return encodeURI(JSON.stringify(result_obj));
   // window.open('../downloadResults.php?result_obj='+encodeURI(JSON.stringify(result_obj)), '_blank','height=900,width=600,top=0,left=0,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no')
}
