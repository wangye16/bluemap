<?php
    $result_obj = json_decode($_GET['result_obj']);
    $XMDM = $result_obj->xiangmudaima;
    $threeLines = $result_obj->threeLines;
    $zonghejielun = $result_obj->zonghejielun;
    $area_kfbj = isset($result_obj->area_kfbj) ? $result_obj->area_kfbj : 0;
    $area_ntbhhx = isset($result_obj->area_ntbhhx) ? $result_obj->area_ntbhhx : 0;
    $area_stbhhx = isset($result_obj->area_stbhhx) ? $result_obj->area_stbhhx : 0;
    include 'layers_init/connect.php';
    $sql= "select xmmc,ydmj,jsxz from ydhx where xmdm ='$XMDM'";
    $resultSet = pg_query($conn,$sql);
    $data=array();
    while ($row = pg_fetch_object($resultSet)){
    $xmmc = $row->xmmc;
    $ydmj = $row->ydmj;
    $jsxz = $row->jsxz;
  }
 pg_close($conn);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>分析报告</title>

    <script language="JavaScript" type="text/javascript">

          get_downloadUrl({name:12333});

        var downloadUrl;
        var tableToExcel = (function() {
            var uri = 'data:application/vnd.ms-excel;base64,'
                      , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]-->'+
                      ' <style type="text/css">'+
                      '.excelTable  {'+
                      'border-collapse:collapse;'+
                      ' border:thin solid #999; '+
                      '}'+
                      '   .excelTable  th {'+
                      '   border: thin solid #999;'+
                      '  padding:20px;'+
                      '  text-align: center;'+
                      '  border-top: thin solid #999;'+
                      ' '+
                      '  }'+
                      ' .excelTable  td{'+
                      ' border:thin solid #999;'+
                      '  padding:2px 5px;'+
                      '  text-align: center;'+
                      ' }</style>'+'</head><body><table border="1">{table}</table></body></html>'
                      , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
                      , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
            return function(table) {
                if (!table.nodeType) table = document.getElementById(table)
                var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML};
                var downloadLink = document.createElement("a");
                downloadLink.href = uri + base64(format(template, ctx));
                downloadLink.download = '<?=$xmmc?>'+'合规性分析报告'+".xls";
                document.body.appendChild(downloadLink);
                downloadLink.click();
                downloadUrl = downloadLink.href;
                console.log(downloadUrl);
                get_downloadUrl('123')

                // document.body.removeChild(downloadLink);
            }
        })();
    </script>


  </head>
  <body>
    <table  border="1" cellspacing="0" cellpadding="0"  align="center"  id="backViewTable" class="table table-hover table-sm table2excel" >
      <caption>合规性分析报告(<?=$XMDM?>)</caption>
      <tr align="center">
        <td>项目名称</td>
        <td id="xmmc"><?=$xmmc?></td>
        <td>项目单位</td>
        <td id="xmdw"></td>
      </tr>
      <tr align="center">
        <td>用地面积(m<sup>2</sup>)</td>
        <td id="ydmj"><?=$ydmj?></td>
        <td>申请用地性质</td>
        <td id="sqydxz"><?=$jsxz?></td>
      </tr>
      <tr>
        <td style="background:#89cff0" colspan="4"  align="center">“三线”检查情况</td>
      </tr>
      <tr   align="center">
       <td rowspan="2"  ><br>“三线”</br><br>检查情况</br></td>
       <td ><br>城镇增长边界(m<sup>2</sup>)</br><br>（界内面积）</br><br></td>
       <td ><br>永久基本农田(m<sup>2</sup>)</br><br>（占地面积）</br><br></td>
       <td ><br>生态控制线(m<sup>2</sup>)</br><br>（占地面积）</br><br></td>
      </tr>
      <tr style="height:25px" >
        <td id="czkfbj" ><?=$area_kfbj?></td>
        <td id="yjjbnt"><?=$area_ntbhhx?></td>
        <td id="stkzx"><?=$area_stbhhx?></td>
      </tr>
      <tr align="center">
        <td rowspan="2"><br>其他控制线</br><br>检测情况</br></td>
        <td><br>城市蓝线(m<sup>2</sup>)</br><br>（界面面积）</br><br></td>
        <td><br>城市红线(m<sup>2</sup>)</br> <br>（界面面积）</br><br></td>
        <td><br>城市紫线(m<sup>2</sup>)</br><br>（界面面积）</br><br></td>
      </tr>
      <tr id="sanxian"   style="height:25px" >
        <td id="cslx"></td>
        <td id="cshx"></td>
        <td id="cszx"></td>
      </tr>
      <tr>
        <td colspan="4" style="background:#89cff0" align='center'>其他专项检测</td>
      </tr>
      <tr align="center">
        <td colspan="2">是否符合其他专项规划</td>
        <td colspan="2"  id="sffhqtzxgh"> </td>
      </tr>
      <tr>
        <td colspan="4" style="background:#89cff0" align='center'>合规性检查结论</td>
      </tr>
      <tr>
        <td  align="center">“三线”检查结论</td>
        <td  align="center">其他控制线检查结论</td>
        <td  align="center">其他专项规划检查结论</td>
        <td  align="center">综合结论</td>
      </tr>
      <tr id="jelun" style="height:25px"  >
        <td id="sxjcjl"  align="center"><?=$threeLines?></td>
        <td id="qtkzxjcjl"  align="center"></td>
        <td id="qtzxghjcjl"  align="center"></td>
        <td id="zhjl"  align="center"><?=$zonghejielun?></td>
      </tr>
    </table>
    <br>
    <div class="" style="height:25px;width:100px;margin:0 0 0 75%;border:3px solid #01599d;padding:0;">
      <button type="button" name="button" id="dayin" value="下载" style="height:25px;width:100px;margin:0" onclick="tableToExcel(backViewTable)">下载</button>
    </div>
  </body>
</html>
