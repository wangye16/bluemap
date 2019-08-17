
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
		<style type="text/css">
			*{
				margin: 0;
				padding:0
				}
			html,body{
				margin: 0;
				padding: 0;
				width: 100%;
				height:100%;
			}
			div{
				/* border: 1px solid red */
			}
			.left,.right{

				/* margin-top: 2px; */
				width: 48%;
				height: 86%;
				overflow: auto;
				border: 2px solid gray;
				/* display: inline-block; */
			}
			.left{
				float: left;
				padding:5px 3px;
			}
			.right{
				float: right;
				padding-bottom:10px;
			}
			.bottom{
				margin:0;
				/* padding-top: 3px; */
				width: 98%;
				height:8%;
				position:absolute;
  			bottom:0px;
				/* border-top:  2px solid gray; */
			}
			.text-div{
				background-color: #e1e1e178;
				border: 1px solid gray;
			}
			.right-title{
				background-color: #e1e1e1;
				border-bottom: 1px solid gray;
				height: 30px;
				line-height: 30px;
			}
		</style>
		<script src="../js/turf.js"></script>
		<!-- <script type="text/javascript" src="js/functions.js"></script> -->
	</head>
	<body>
		 <!-- <div class="total"> -->
			  <div class="left" id="left">

				</div>
				<div class="right" id="right">
					<div class="right-title">
						合规审查报告结果：
					</div>
					<table rules="all" style="width:100%;border:1px solid gray;text-align:center">
						<tr>
							<td style="width:75%">"三线"符合性审查建议</td><td style="width:25%" id="threeLines"></td>
						</tr>
						<tr>
							<td>其他控制线符合性审查建议</td><td id="otherLines"></td>
						</tr>
						<tr>
							<td>是否符合其他专项规划</td><td id="otherPlans"></td>
						</tr>
						<tr>
							<td>综合结论</td><td id="zonghejielun"></td>
						</tr>
					</table>
				</div>
				<div class="bottom" id="bottom">
					&nbsp;&nbsp;
					<img src="../images/bluebox.png" height="70%" alt="">&nbsp;正常占用&nbsp;&nbsp;
					<img src="../images/circle_green.png"  height="70%" alt="">&nbsp;无占用&nbsp;&nbsp;
					<img src="../images/cross.png"  height="70%" alt="">&nbsp;违规占用&nbsp;&nbsp;
					<button type="button" name="button" onclick="downloadResults()" class="btn" style="float:right;">下载分析报告</button>
					<script type="text/javascript">
			      function downloadResults() {
			        window.open('downloadResults.php?result_obj='+encodeURI(JSON.stringify(result_obj)), '_blank','height=900,width=600,top=0,left=0,toolbar=no,menubar=no,resizable=no,location=no,status=no')
			      }
			    </script>
				</div>
		 <!-- </div> -->

		 <script type="text/javascript">
		 		 //传给下载分析报告页面的信息
				 var result_obj = {};
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
					var xiangmudaima = decodeURI(<?=$_GET['xiangmudaima']?>);
					result_obj.xiangmudaima = xiangmudaima;
					var tucengxuanze = decodeURI(<?='"'.$_GET['tucengxuanze'].'"'?>);

					tucengxuanze = tucengxuanze.split(',');

					var src_istrue;
					var count_threeLines = 0;//"三线审查结果：0为全过 不是0为有一个没过"
					var count_otherLines = 0;//其他控制线符合性审查建议：0为全过 不是0为有一个没过"
					var count_otherPlans = 0;//是否符合其他专项规划：0为全过 不是0为有一个没过"
					var zonghejielun;

		      for (var i = 0; i < window.parent['ydhx_data'].features.length; i++) {
		        if(window.parent['ydhx_data'].features[i].properties.xmdm == xiangmudaima){
		          var i_global = i;
						}
					}

					for (var i = 0; i < tucengxuanze.length; i++) {
						//合规性检查图层逻辑判断
						// var i_global = window.parent.i_global;
						console.log(i_global);
						switch (tucengxuanze[i]) {
							case '城市增长边界':
								for(var k = 0 ; k < window.parent.kfbj_data.features.length ; k++){
									var fea_kfbj = turf.intersect(window.parent.kfbj_data.features[k].geometry,  window.parent.ydhx_data.features[i_global].geometry)
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
									if(fea_1){
										src_istrue = "../images/circle_green.png";
									}else{
											src_istrue = "../images/cross.png";
											count_threeLines++;
									}
									break;

							case '基本农田保护红线':
							for(var k = 0 ; k < window.parent.ntbhhx_data.features.length ; k++){
								var fea_ = turf.intersect(window.parent.ntbhhx_data.features[k].geometry,  window.parent.ydhx_data.features[i_global].geometry)
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
									if(fea_1){
										src_istrue = "../images/circle_green.png";
									}else{
											src_istrue = "../images/cross.png";
											count_threeLines++;
									}
								break;

							case '生态保护红线':
								for(var j = 0 ; j < window.parent.stbhhx_data.features.length ; j++){
								var fea = turf.intersect(window.parent.stbhhx_data.features[j].geometry,  window.parent.ydhx_data.features[i_global].geometry)
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
									if(fea1){
										src_istrue = "../images/circle_green.png";
									}else{
											src_istrue = "../images/cross.png";
											count_threeLines++;
									}
									break;

							default:
								src_istrue = "../images/circle_green.png";
						}


						var div = document.createElement("div");
						div.className = "text-div";
						div.style.height = "25px";
						div.style.textAlign="center";
						div.style.lineHeight="25px";
						var content = document.createTextNode(tucengxuanze[i]);
						var layer_img = document.createElement("img");
						layer_img.src = "../images/layer.png";
						layer_img.style.cssFloat="left";
						layer_img.style.height="100%";

						var circle_img = document.createElement("img");
						circle_img.src = src_istrue;
						circle_img.style.cssFloat="right";
						circle_img.style.height="100%";

						div.appendChild(content);
						div.appendChild(layer_img);
						div.appendChild(circle_img);

						var arrow = document.createElement("div");
						arrow.className = "arrow-div";
						arrow.style.height = "22px";
						var arrow_img = document.createElement("img");
						arrow_img.src = "../images/arrows_down.png";
						arrow_img.style.height = "22px";
						arrow_img.style.width = "10%";
						arrow_img.style.margin = "0 45%";
						arrow.appendChild(arrow_img);

						document.getElementById('left').appendChild(div);
						document.getElementById('left').appendChild(arrow);
					}

					//判断右侧栏里的“通过”或“不通过”
					if (count_threeLines == 0&&count_otherLines == 0&&count_otherPlans == 0) {
						src_bottom = "../images/circle_green.png";

						document.getElementById('zonghejielun').innerHTML = '通过';
						result_obj.zonghejielun = '通过';
							var zonghejielun = document.getElementById('zonghejielun').innerHTML
					}else {
						src_bottom = "../images/cross.png";
						document.getElementById('zonghejielun').innerHTML = '不通过';
						result_obj.zonghejielun = '不通过';
							var zonghejielun = document.getElementById('zonghejielun').innerHTML
					}


					if (count_threeLines == 0) {
						document.getElementById('threeLines').innerHTML = '通过';
						result_obj.threeLines = '通过';
							var threeLines = document.getElementById('threeLines').innerHTML
					}else {
						document.getElementById('threeLines').innerHTML = '不通过';
						result_obj.threeLines = '不通过';
							var threeLines = document.getElementById('threeLines').innerHTML
					}


					var div_bottom = document.createElement("div");
					div_bottom.className = "text-div";
					div_bottom.style.height = "25px";

					var content_bottom = document.createTextNode('合规审查报告');
					div_bottom.appendChild(content_bottom);
					div_bottom.style.textAlign="center";
					document.getElementById('left').appendChild(div_bottom);

					var report_img = document.createElement("img");
					report_img.src = "../images/report.png";
					report_img.style.cssFloat="left";
					report_img.style.height="100%";

					var yes_img = document.createElement("img");
					yes_img.src = src_bottom;
					yes_img.style.cssFloat="right";
					yes_img.style.height="100%";
					div_bottom.appendChild(report_img);
					div_bottom.appendChild(yes_img);
		 </script>
	</body>
</html>
