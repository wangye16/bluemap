<?php
	include 'connect.php';
	$str = "SELECT row_to_json(fc)
					 FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
					 FROM (SELECT 'Feature' As type
					--  , row_to_json((SELECT l FROM (SELECT xmdm, xmmc) As l)
                    --  ) As properties
					    , ST_AsGeoJSON(ST_GeometryN(lg.geom,1))::json As geometry
					   FROM kfbj As lg   ) As f )  As fc;";
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
			"color": "#ffebb0",
			"weight": 3,
			"opacity": 0.5,
			"fillOpacity": 1,
	};
	var kfbj_data = <?=$data?>[0]['row_to_json'];
	kfbj_data = JSON.parse(kfbj_data);
	layer_kfbj = L.geoJSON(kfbj_data, {
		style:myStyle,
	});
</script>
