<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/icheck-bootstrap.min.css">
    <style media="screen">
        html,body{
          margin: 0;
          padding: 0;
          width: 100%;
          height: 100%;
        }
        #heguixingjiancha_form{
          width: 96%;
          height: 96%;
          margin: 2% 2%;
        }
        .form-control{
          display: inline-block;
          width: 72%;
          height: 26px;
          padding: 0 6px;
          font-size: 14px;
          line-height: 1.42857143;
        }
        .titles{
          display: inline-block;
          width: 28%;
          height: 26px;
          font-size: 1em;
          text-align: center;

        }
        .checkbox{
          margin-top: 0;
          /* padding-left:8px; */
          border:2px solid #01599d;
        }
    </style>
  </head>
  <body>
    <?php
      $XMDM = $_GET['XMDM'];
      include './layers_init/connect.php';
      $str = "select * from ydhx where xmdm = '$XMDM'";
    	$resultSet = pg_query($conn,$str);
    	while ($row = pg_fetch_object($resultSet)) {
        // var_dump($row);
    		$data['XMMC'] = $row->xmmc;
    		$data['LXLX'] = $row->lxlx;
        $data['JSXZ'] = $row->jsxz;
        $data['YDMJ'] = $row->ydmj;
    		$data['JSDD'] = $row->jsdd;
    	}
    ?>
    <form id="heguixingjiancha_form" method="post" action="heguixingjiancha/jianchejieguo.php">
        <input type="text" name="xiangmudaima" value="<?=$XMDM?>" hidden>
        <div class="form-group">
            <div class="titles">
              项目列表:
            </div><select class="form-control" id="xiangmuliebiao" name="xiangmuliebiao">
              <option selected value="<?=$data['XMMC']?>"><?=$data['XMMC']?></option>
            </select>
        </div>
        <div class="form-group">
            <div class="titles">
              区域选择:
            </div>
            <div class="checkbox">
              <span class="radio icheck-primary" >
            		<input type="radio" checked id="fromOutside" name="quyuxuanze" />
            		<label for="fromOutside">从外部导入文件</label>
              </span><span class="radio icheck-primary" >
                <input type="radio" id="paint" name="quyuxuanze" />
                <label for="paint">手绘范围</label>
              </span>
            </div>
        </div>
        <div class="form-group">
            <div class="titles">
              项目类型:
            </div><select class="form-control" id="xiangmuleixing" name="xiangmuleixing" placeholder="">
              <option selected value="<?=$data['LXLX']?>"><?=$data['LXLX']?></option>
            </select>
        </div>
        <div class="form-group">
            <div class="titles">
              用地性质:
            </div><input type="text" class="form-control" value="<?=$data['JSXZ']?>" name="yongdixingzhi" id="yongdixingzhi" placeholder="">
        </div>
        <div class="form-group">
            <div class="titles">
              用地面积:
            </div><input type="text" class="form-control" value="<?=$data['YDMJ']?>" name="yongdimianji" id="yongdimianji" placeholder="">
        </div>
        <div class="form-group">
            <div class="titles">
              建设单位:
            </div><input type="text" class="form-control" name="jianshedanwei" id="jianshedanwei" placeholder="">
        </div>
        <div class="form-group">
            <div class="titles">
              建设地址:
            </div><input type="text" class="form-control" value="<?=$data['JSDD']?>" name="jianshedizhi" id="jianshedizhi" placeholder="">
        </div>
        <div class="titles" style="">
          图层选择:
        </div>
        <div class="checkbox">
            <!-- <div class="icheck-primary">
          		<input type="checkbox" checked id="tcmc" value="1"/>
          		<label for="tcmc">图层名称</label>
            </div> -->
            <div class="icheck-primary">
              <input type="checkbox" checked id="cszzbj" name="tucengxuanze"  value="城市增长边界"/>
          		<label for="cszzbj">城市增长边界</label>
            </div>
            <div class="icheck-primary">
              <input type="checkbox" checked id="jbntbhhx" name="tucengxuanze"  value="基本农田保护红线"/>
          		<label for="jbntbhhx">基本农田保护红线</label>
            </div>
            <div class="icheck-primary">
              <input type="checkbox" checked id="stbhhx" name="tucengxuanze"  value="生态保护红线"/>
          		<label for="stbhhx">生态保护红线</label>
            </div>
            <div class="icheck-primary">
              <input type="checkbox" checked id="cslx" name="tucengxuanze"  value="城市蓝线"/>
          		<label for="cslx">城市蓝线</label>
            </div>
            <div class="icheck-primary">
              <input type="checkbox" checked id="cszx" name="tucengxuanze"  value="城市紫线"/>
          		<label for="cszx">城市紫线</label>
            </div>
            <div class="icheck-primary">
              <input type="checkbox" checked id="cslvx" name="tucengxuanze"  value="城市绿线"/>
          		<label for="cslvx">城市绿线</label>
            </div>
        </div>
        <!-- <div class="" style="width: 100%;"> -->
          <button type="button" onclick="complianceCheck_result()" class="btn" style="border:2px solid #01599d;margin:0 auto;"><span class="glyphicon glyphicon-search"></span>开始分析</button>
          <button type="reset"  class="btn" style="border:2px solid #01599d;margin:0 auto;"><span class="glyphicon glyphicon-remove"></span>清除结果</button>
        <!-- </div> -->
    </form>
  </body>
</html>
