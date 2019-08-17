<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>blueMap</title>
    <link rel="stylesheet" href="jspanel-4.7.0/jspanel.css"/>
    <link rel="stylesheet" type="text/css" href="easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="leaflet/leaflet.css"/>
    <link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="css/leaflet.toolbar.css">
    <link rel="stylesheet" href="css/map.css">
    <link rel="stylesheet" href="css/leaflet.draw.css">
    <style type="text/css">
        html,body{
          margin: 0;
          padding: 0;
          height: 100%;
          width: 100%;
          font-size: 1em
        }
        /* 删除datagrid表格中的刷新按钮 */
        .pagination-load{
          display: none;
        }
        .tool_{
          height: 33px;
          width: 33px;
          margin: 5px;
          margin-top: 0;
          background:#fff;
          border-top:none;
          border-radius:3px;
          -moz-box-shadow:0px 0px 3px #333333;
          -webkit-box-shadow:0px 0px 3px #333333;
          box-shadow:0px 0px 3px #333333;
          cursor:pointer
        }
        #tool1{
            border-top:1px solid;
        }
        #map{
            height:100%;
            width: 100%;
            position: absolute;
            top: 0;
            z-index: 0
        }
        #search{
          position: absolute;
          top: 8px;
          z-index: 2;
          left: 50px;
          /* opacity:0.5; */
          vertical-align:top;
          display:inline-block;
        }
        #panel_searchResults{
          visibility:hidden
        }
        .datagrid-row,.datagrid-header-row{height: 20px;}
        #tool{
          position: absolute;
          top: 8px;
          z-index: 2;
          left: 0;
          width: 40px;
          display:inline-block;
          padding-top: 0
        }
          /* #panel_legends{
            visibility:hidden
          } */
        #panel_legends div ul{
          display: none;
        }
        /* datagrid的padding设置为0（bootstrap easyUI冲突造成） */
        .panel-body {
          padding: 0px;
        }
        /* （bootstrap easyUI冲突造成） */
        .panel{
          margin: 0;
          border:0px
        }
        .tree-title{
          margin: 0;
        }
        #panel_legends img{
          height: 22px;
          /* width: 30px; */
          border: 1px solid;
        }
        #panel_legends ul{
          /* padding-left: auto;
          padding-top: auto; */
          margin: 15px 15px;
          margin-bottom: 0px;
          font-size: inherit;
          list-style: none;
        }
        #search_table{
            position: absolute;
            top:50px;
            z-index: 1;
            left: 50px;
            padding: 0;
            width:500px;
            /* height:400px; */
            margin-bottom: 0;
            /* display:none; */
        }
        /* .leaflet-interactive{
          cursor: grab;
        } */
    </style>
    <script src="easyui/jquery.min.js"></script>
    <script src="easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="leaflet/leaflet.js"></script>
    <script src="js/leaflet-src.js"></script>
    <script src="leaflet/leaflet-src.js"></script>
    <script src="js/leaflet.toolbar-src.js"></script>
    <script type="text/javascript" src="easyui/locale/easyui-lang-zh_CN.js" charset="utf-8"></script>
    <script src="bootstrap-3.3.7/js/bootstrap.js"></script>
    <script src="jspanel-4.7.0/jspanel.js"></script>
    <!-- <script src="js/L.Control.MousePosition.js"></script> -->
    <script src="js/leaflet.draw.js"></script>
    <script src="js/measure.js"></script>
    <script src="js/turf.js"></script>
</head>
<body>
    <div id="total">

        <!-- 搜索框 -->
        <div id="search" class="form-inline" name="moveable-div">
          <input id="searchBar" type="text" class="form-control" size="25" style="height:34px;border:2px solid #01599d" placeholder="请输入项目编码或名称">
          <!-- <button id="search2" class="btn btn-default" style="height:34px;width:44px;padding: 4px 6px;border:1px solid #01599d" type="button"  onclick="startSearch()">搜索</button> -->
        </div>

        <!-- 地图容器 -->
        <div id="map"></div>

    </div>
    <script type="text/javascript" src="js/panels.js"></script>
    <script type="text/javascript" src="js/searchResults.js"></script>
    <script type="text/javascript" src="js/map_leaflet.js"></script>
    <script type="text/javascript" src="js/searchResults_click.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
    <script type="text/javascript" src="js/leaflet_toolbar.js"></script>
    <script type="text/javascript" src="js/postMessage.js"></script>
    <?php include 'layers_init/ydhx_init.php' ?>
    <?php include 'layers_init/kfbj_init.php' ?>
    <?php include 'layers_init/ntbhhx_init.php' ?>
    <?php include 'layers_init/stbhhx_init.php' ?>
    <?php include 'layers_init/stkj_init.php' ?>
    <?php include 'layers_init/czkj_init.php' ?>
    <?php include 'layers_init/nykj_init.php' ?>
</body>
</html>
