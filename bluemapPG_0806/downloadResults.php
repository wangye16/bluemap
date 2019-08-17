<?php
    header("content-type:text/html;charset=utf-8");  //设置编码
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

    $html = '
    <table border="1">
      <tr align="center">
        <td>项目名称</td>
        <td id="xmmc">'.$xmmc.'</td>
        <td>项目单位</td>
        <td id="xmdw"></td>
      </tr>
      <tr align="center">
        <td>用地面积</td>
        <td id="ydmj">'.$ydmj.'平方米</td>
        <td>申请用地性质</td>
        <td id="sqydxz">'.$jsxz.'</td>
      </tr>
      <tr>
        <td style="background:#89cff0" colspan="4"  align="center">“三线”检查情况</td>
      </tr>
      <tr align="center">
       <td rowspan="2"  ><br>“三线”</br><br>检查情况</br></td>
       <td ><br>城镇增长边界</br><br>（界内面积）</br><br></td>
       <td ><br>永久基本农田</br><br>（占地面积）</br><br></td>
       <td ><br>生态控制线</br><br>（占地面积）</br><br></td>
      </tr>
      <tr style="height:25px" >
        <td id="czkfbj" ></td>
        <td id="yjjbnt"></td>
        <td id="stkzx"></td>
      </tr>
      <tr align="center">
        <td rowspan="2"><br>其他控制线</br><br>检测情况</br></td>
        <td><br>城市蓝线</br><br>（界面面积）</br><br></td>
        <td><br>城市红线</br> <br>（界面面积）</br><br></td>
        <td><br>城市紫线</br><br>（界面面积）</br><br></td>
      </tr>
      <tr id="sanxian"   style="height:25px" >
        <td id="cslx"></td>
        <td id="cshx"></td>
        <td id="cszx"></td>
      </tr>
      <tr>
        <td colspan="4" style="background:#89cff0">其他专项检测</td>
      </tr>
      <tr align="center">
        <td colspan="2">是否符合其他专项规划</td>
        <td colspan="2"  id="sffhqtzxgh"> </td>
      </tr>
      <tr>
        <td colspan="4" style="background:#89cff0" >合规性检查结论</td>
      </tr>
      <tr>
        <td>11</td>
        <td>其他控制线检查结论</td>
        <td>其他专项规划检查结论</td>
        <td>综合结论</td>
      </tr >
      <tr id="jelun" style="height:25px"  >
        <td id="sxjcjl">'.$threeLines.'</td>
        <td id="qtkzxjcjl"></td>
        <td id="qtzxghjcjl"></td>
        <td id="zhjl">'.$zonghejielun.'</td>
      </tr>
    </table>
    ';
    $html1 = '<p>aaa</P>';
    //==============================================================
    //==============================================================
    //==============================================================
    include("MPDF60/mpdf.php");
    $mpdf=new mPDF('UTF-8','A4','','',32,25,27,25,16,13);

    $mpdf->SetDisplayMode('fullwidth');

    $mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

    // LOAD a stylesheet
    $stylesheet = file_get_contents('MPDF60/examples/mpdfstyletables.css');
    $mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

    $mpdf->WriteHTML($html,2);

    // $a = $mpdf->Output($XMDM.'.pdf','D');
    $a = $mpdf->Output($XMDM.'.pdf','I');
    exit;


?>
