<?php
	include 'connect.php';
	$str = "SELECT row_to_json(fc)
					 FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
					 FROM (SELECT 'Feature' As type
					--  , row_to_json((SELECT l FROM (SELECT xmdm, xmmc) As l)
                    --  ) As properties
					    , ST_AsGeoJSON(ST_GeometryN(lg.geom,1))::json As geometry
					   FROM stbhhx As lg   ) As f )  As fc;";
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
			"color": "#087400",
			"weight": 3,
			"opacity": 0.5,
			"fillOpacity": 1,
	};
	var stbhhx_data = <?=$data?>[0]['row_to_json'];
	stbhhx_data = JSON.parse(stbhhx_data);
	layer_stbhhx = L.geoJSON(stbhhx_data, {
		style:myStyle,
	});
</script>
