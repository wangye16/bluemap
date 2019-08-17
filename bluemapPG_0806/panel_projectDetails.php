<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<link rel="stylesheet" href="css/jquery.horizontalmenu.css">
	<link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.css">
  <script src="easyui/jquery.min.js"></script>
  <script src="bootstrap-3.3.7/js/bootstrap.js"></script>
  <style type="text/css">
			html,body{
			margin: 0;
			padding: 0;
			width: 100%;
			height: 100%;
			}
			.content{
			font-size:16px;
			height: 100%;
			width: 100%;
			border: 0
			}
			.ah-tab-item{
			height: 10%;
			width:25%
			}
				.ah-tab-content-wrapper{
			padding: 0px;
			height: 89%;
			overflow:scroll;
			overflow-x: hidden;
			overflow-y: auto;
				}
			.ah-tab-content-wrapper table{
			width:98%;
			height:100%;
			margin:0 auto 0;
			border-left: 2px solid #01599d;
			border-right: 2px solid #01599d;
			}
			#tab2{
			width: 100%;
			height: 100%;
			padding: 3px;
			margin: 0;
			}
			.tab2_div{
			width: 100%;
			height: 36%;
			border: 3px solid #01599d;
			border-radius: 6px;
			margin: 0 0 5px 0;
			}
			.tab2_div h4{
			align:center;
			background: #ed6c37;
			margin: 0;
			height: 30px;
			line-height: 30px;
			text-align: center;
			color: white
			}
			.tab2_div_right{
			float: right;
			width: 50%;
			height: 100%;
			border-left: 4px solid #c5bfb4;
			overflow: auto;
			padding: 0 5px;
			font-size: 14px;
			}
			.tab2_div_left{
			float: left;
			width: 50%;
			height: 100%;
			/* border: 2px solid #c5bfb4; */

			}
			.suggestion{
			width: 100%;
			border: 2px solid #01599d;
			border-radius: 3px;
			margin: 2px 0;
			padding: 2px;

			}
  </style>
</head>
<body>
	<?php
		include 'layers_init/connect.php';
		$XMDM = $_GET['XMDM'];
 	 	$str_tab1 = "select * from ydhx where xmdm='$XMDM'";
 		$result_tab1 = pg_query($conn,$str_tab1);
		while ($row = pg_fetch_object($result_tab1)) {
		 $data['XMMC'] = $row->xmmc;// 项目名称
		 $data['LXLX'] = $row->lxlx;//立项类型
		 $data['JSXZ'] = $row->jsxz;// 建设性质
		 $data['YDMJ'] = $row->ydmj;// 用地面积
		 $data['JSDD'] = $row->jsdd;//建设地点
		 $data['JSGMJNR'] = $row->jsgmjnr;//建设规模及内容
		 $data['NKGSJ'] = $row->nkgsj;//开始年限
		 $data['XMWQBJSJ'] = $row->xmwqbjsj;//完成年限
		 $data['ZTZE'] = $row->ztze;//总投资额
		}
		$count = 0;
		$str_tab2 = "select * from spgl_xmqqyjxxb where xmdm='$XMDM'";
		$result_tab2=pg_query($conn,$str_tab2);
		while ($row = pg_fetch_object($result_tab2)) {
			 $data1[$count]['BLDWMC'] = $row->bldwmc;// 办理单位名称
			 $data1[$count]['QQYJ'] = $row->qqyj;//前期意见
			 $data1[$count]['FJID'] = $row->fjid;// 附件ID
			 $data1[$count]['FKSJ'] = $row->fksj;// 反馈时间
			 $count++;
		}
		pg_close($conn);
	 ?>
	<div class="content">
        <div class="ah-tab-wrapper">
            <div class="ah-tab">
                <a class="ah-tab-item" data-ah-tab-active="true" href="">项目基本信息</a>
                <a class="ah-tab-item" href="">前期意见</a>
            </div>
        </div>
        <div class="ah-tab-content-wrapper">
            <div class="ah-tab-content" data-ah-tab-active="true">
              <table class="table table-hover table-condensed"  rules="all" cellspacing="0" cellpadding="0">
              	<!-- <thead>
              		<td width="20%">属性名称</td><td>属性值</td>
              	</thead> -->
								<tr>
              		<td width="20%">项目编号</td><td><?=$XMDM?></td>
              	</tr>
								<tr>
              		<td>项目名称</td><td><?=$data['XMMC']?></td>
              	</tr>
								<tr>
              		<td>用地单位</td><td></td>
              	</tr>
								<tr>
              		<td>项目位置</td><td><?=$data['JSDD']?></td>
              	</tr>
								<tr>
              		<td>开始年限</td><td><?=$data['NKGSJ']?></td>
              	</tr>
								<tr>
              		<td>完成年限</td><td><?=$data['XMWQBJSJ']?></td>
              	</tr>
								<tr>
              		<td>用地面积(㎡)</td><td><?=$data['YDMJ']?></td>
              	</tr>
								<tr>
              		<td>总投资(万元)</td><td><?=$data['ZTZE']?></td>
              	</tr>
								<tr>
              		<td>建设规模及内容</td><td><?=$data['JSGMJNR']?></td>
              	</tr>
              </table>
            </div>
						<div class="ah-tab-content" id="tab2">
              <?php
						       for ($i=0; $i < count($data1) ; $i++) {
						         echo   '<div class="tab2_div">';
						         echo    '<div class="tab2_div_left">';
						         echo     '<h4>'.$data1[$i]["BLDWMC"].'</h4>';
						         echo     '<div style="text-align:center">'.$data1[$i]["FKSJ"].'</div>';
						         echo    '</div>';
						         echo    '<div class="tab2_div_right">';
						         echo     '<span style="color:#ed6c37">启动协调</span>';
						         echo     '<div class="suggestion">';
						         echo      '意见: <br>';
						         echo      $data1[$i]["QQYJ"];
						         echo     '</div>';
						         echo     '附件下载：<a href="'.$data1[$i]["FJID"].'">附件</a>';
						         echo    '</div>';
						         echo   '</div>';
						       }
			        ?>
            </div>
        </div>
    </div>
	<script src="js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="js/jquery.horizontalmenu.js"></script>
	<script>
        $(function () {
            $('.ah-tab-wrapper').horizontalmenu({
                itemClick : function(item) {
                    $('.ah-tab-content-wrapper .ah-tab-content').removeAttr('data-ah-tab-active');
                    $('.ah-tab-content-wrapper .ah-tab-content:eq(' + $(item).index() + ')').attr('data-ah-tab-active', 'true');
                    return false; //if this finction return true then will be executed http request
                }
            });
        });
    </script>
</body>
</html>
