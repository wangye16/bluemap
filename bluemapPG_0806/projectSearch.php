<?php
	include 'layers_init/connect.php';
	$message = $_POST["projectName"];
	if ($message == null) {
		$str_message = '';
	}else {
		$str_message = "where xmmc like '%$message%' or xmdm like '%$message%'";
	}
	$str = "select xmdm,xmmc,gcfw,ST_AsGeoJSON(ST_GeometryN(geom,1)) as geodata from ydhx $str_message";
	$resultSet = pg_query($conn,$str);

	$data=array();
	class Alteration{}

  while ($row = pg_fetch_object($resultSet)){
		// var_dump($row);
		$alter = new Alteration();
		$alter->XMDM = $row->xmdm;
		$alter->XMMC = $row->xmmc;
		$alter->GCFW = $row->gcfw;
		$alter->geodata = $row->geodata;
		$data[] = $alter;
  }

	echo json_encode($data);
	pg_close($conn);


?>
