<?php
	include 'connect.php';
	$str = "SELECT row_to_json(fc)
					 FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
					 FROM (SELECT 'Feature' As type
					 , row_to_json((SELECT l FROM (SELECT xmdm, xmmc) As l)) As properties
					 , ST_AsGeoJSON(ST_GeometryN(lg.geom,1))::json As geometry
					 FROM ydhx As lg   ) As f )  As fc;";
	$resultSet = pg_query($conn,$str);
	$data=array();
  while ($row = pg_fetch_object($resultSet)){
		$data[] = $row;
  }
	$data = json_encode($data);
	pg_close($conn);
?>

<script type="text/javascript">
	var myStyle = {
			"color": "#e68296",
			"weight": 2,
			"opacity": 1,
			"fillOpacity": 0,
	};
	var ydhx_data = <?=$data?>[0]['row_to_json'];
	ydhx_data = JSON.parse(ydhx_data);
	layer_ydhx = L.geoJSON(ydhx_data, {
		style:myStyle,
		pane:'labels'
	}).addTo(_map);
	var marker_ydhx;
	// ydhx_click('layer_ydhx');
	function ydhx_click(layer){
		window[layer].on('click',function(e){
			marker_ydhx = true;
			var XMDM_clicked = e.layer.feature.properties.xmdm;
			var XMMC_clicked = e.layer.feature.properties.xmmc;
			var id = 'panel_' + XMDM_clicked;
			var headerTitle = XMMC_clicked + "(" + XMDM_clicked + ")";
			//改变图层颜色
			if (typeof(line_round) == "object") {
				 _map.removeLayer(line_round);
			}
			var obj_projects = window['ydhx_data'].features;
			for (var i = 0; i < obj_projects.length; i++) {
				if(obj_projects[i].properties.xmdm == XMDM_clicked){
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
				//新建项目信息面板
				jsPanel.create({
					// panelSize: panelSize,
					contentSize: {
							width:  $(window).width() * 0.45,
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
	             complianceCheck(XMDM_clicked);
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
					// 	disable: true
					// },
					headerControls: {
						maximize: 'remove',
						smallify: 'remove'
					},
					theme: 'primary',
					borderRadius: 0,
					content: '<iframe src="panel_projectDetails.php?XMDM=' + XMDM_clicked + '" style="width: 100%; height: 98%;border:0"></iframe>'
				})
		})
	}
</script>
