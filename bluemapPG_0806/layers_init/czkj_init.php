<?php
	include 'connect.php';
	$str = "SELECT row_to_json(fc)
					 FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
					 FROM (SELECT 'Feature' As type
					--  , row_to_json((SELECT l FROM (SELECT xmdm, xmmc) As l)
                    --  ) As properties
					    , ST_AsGeoJSON(ST_GeometryN(lg.geom,1))::json As geometry
					   FROM nykj As lg   ) As f )  As fc;";
	$resultSet = pg_query($conn,$str);
	$data=array();
  while ($row = pg_fetch_object($resultSet)){
		$data[] = $row;
  }
	// var_dump($data);
	//echo 'hi';
	$data = json_encode($data);
	pg_close($conn);
?>

<script type="text/javascript">
// console.log(123);
	var myStyle = {
		"color": "#fff",
		"weight": 0,
		"opacity": 0
	};
	var czkj_data = <?=$data?>[0]['row_to_json'];
	czkj_data = JSON.parse(czkj_data);
	layer_czkj = L.geoJSON(czkj_data, {
		style:myStyle,
	});

	var layer_czkj_wms= L.tileLayer.wms("http://2oj0572928.imwork.net:32236/geoserver/SQSX/wms?", {
	    layers: 'SQSX:czkj',//需要加载的图层
	    format: 'image/png',//返回的数据格式
	    transparent: true,
	});
</script>
