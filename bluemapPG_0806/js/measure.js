var _map;
var DRAWING = false; //是否正在绘制
var DRAWLAYERS = [];
var BarDRAWLAYERS = [];
var ISMEASURE = false;  //是否是量距
var MEASURETOOLTIP;  //量距提示
var MEASUREAREATOOLTIP;  //量面提示
var MEASURERESULT = 0;

var DRAWPOLYLINE; //绘制的折线
var DRAWMOVEPOLYLINE; //绘制过程中的折线
var DRAWPOLYLINEPOINTS = []; //绘制的折线的节点集

var DRAWPOLYGON; //绘制的面
var DRAWMOVEPOLYGON; //绘制过程中的面
var DRAWPOLYGONPOINTS = []; //绘制的面的节点集
//绘制折线
function startDrawLine(func) {

    MEASURERESULT = 0;

    _map.getContainer().style.cursor = 'crosshair';//getContainer返回地图容器对象  改变光标类型

    _map.on('mousedown', function (e) {
        DRAWING = true;

        DRAWPOLYLINEPOINTS.push(e.latlng);  //将单击的点坐标推入折线的节点集
        if (DRAWPOLYLINEPOINTS.length > 1 && ISMEASURE) {  //判断节点集长度是否大于1 且表示是否量距的变量ISMEASURE是否为真  &&两者均true反回true  ISMEASURE何时变为true的？？？
            MEASURERESULT += e.latlng.distanceTo(DRAWPOLYLINEPOINTS[DRAWPOLYLINEPOINTS.length - 2]);//将MEASURERESULT与鼠标的位置和点集中的前一个点之间的距离做和运算并赋值给MEASURERESULT  distanceTo方法测量两点间的距离单位是米
        }
        DRAWPOLYLINE.addLatLng(e.latlng);//向绘制的折线添加一个点
    });

    _map.on('mousemove', function (e) {   //给mousemove绑定一个事件监听
        if (DRAWING) { //DRAWING表示是否正在绘制
            if (DRAWMOVEPOLYLINE != undefined && DRAWMOVEPOLYLINE != null) { // != 不等于  判断语句 如果DRAWMOVEPOLYLINE绘制过程中的折线存在且不为空值
                _map.removeLayer(DRAWMOVEPOLYLINE); // removeLayer（事件） 将图层从地图上移除  将绘制过程中的折线图层从地图上移除
            }
            var prevPoint = DRAWPOLYLINEPOINTS[DRAWPOLYLINEPOINTS.length - 1];//定义一个变量prevPoint，并将上一个节点坐标赋值给它
            DRAWMOVEPOLYLINE = new L.Polyline([prevPoint, e.latlng], shapeOptions);//L.Polyline()：通过给定的地理点组成的数组和任意的选项对象实例化一个线段。函数构造器是什么意思？？shapeOptions是什么？？shapeOptions可能是设定线的类型
            _map.addLayer(DRAWMOVEPOLYLINE);// 将L.Polyline实例化的线段添加到地图上

            if (ISMEASURE) { //  ISMEASURE含义：是否量距。  ISMEASURE怎么变成true的？？
                var distance = MEASURERESULT + e.latlng.distanceTo(DRAWPOLYLINEPOINTS[DRAWPOLYLINEPOINTS.length - 1]); //求鼠标与前一个点之间的距离并与之前节点之间的距离求和并赋值给变量distance
                MEASURETOOLTIP.updatePosition(e.latlng); //updatePosition与updateContent是什么函数还是变量MEASURETOOLTIP的属性？？
                MEASURETOOLTIP.updateContent({
                    text: '单击确定点，双击结束！',
                    subtext: "总长：" + (distance / 1000).toFixed(2) + "公里"   //toFixed()  js方法可把 Number 四舍五入为指定小数位数的数字
                });
            }

        }
    });

    _map.on('dblclick', function (e) {  //绑定双击监听事件

        _map.getContainer().style.cursor = '';  //反回光标的默认样式 getContainer返回地图容器对象

        if (DRAWING) {

            if (DRAWMOVEPOLYLINE != undefined && DRAWMOVEPOLYLINE != null) {
                _map.removeLayer(DRAWMOVEPOLYLINE); //移除绘制中的折线图层
                DRAWMOVEPOLYLINE = null;
            }

            if (DRAWPOLYLINEPOINTS.length > 1 && ISMEASURE) { //节点数大于1 且正在绘制

                MEASURERESULT += e.latlng.distanceTo(DRAWPOLYLINEPOINTS[DRAWPOLYLINEPOINTS.length - 2]); //变量 MEASURERESULT的值为鼠标与之前节点的距离只和

                var distanceLabel = L.marker(DRAWPOLYLINEPOINTS[DRAWPOLYLINEPOINTS.length - 1], { //  L.Marker（）：通过给定一个地理点和一个具有选项的对象来实例化一个注记。
                    icon: new L.divIcon({  //L.DivIcon()：用给定的选项实例化图标。用div要素而非图片来轻量级地显示注记的图标。默认情况下，阴影会有一个小的白色的方形作为leaflet-div-icon类和样式。
                        className: 'DistanceLabelStyle',//className：用于对其图标的自定义的类名，默认为leaflet-div-icon。
                        iconAnchor: [-8, 15],//iconAnchor：图标提示的坐标（在左上角）。图标是对其的，所以这个点是注记的地理位置。如果大小是指定的则位于中心处，也可以在CSS中设置负边界。  ？？
                        html: "<span class='bubbleLabel'><span class='bubbleLabel-bot bubbleLabel-bot-left'></span><span class='bubbleLabel-top bubbleLabel-top-left'></span><span>总长：" + (MEASURERESULT / 1000).toFixed(2) + "公里" + "</span></span>" //html：在div要素中自定义的HTML代码，默认为空。
                    }),
                }).addTo(_map); // 设置双击后标注的样式等属性

                BarDRAWLAYERS.push(distanceLabel); //将注记推入一个数组  这步有什么意义？？
            }

            //移除提示框
            if (MEASURETOOLTIP) {
                MEASURETOOLTIP.dispose(); //提示框的dispose属性来自哪里？？
            }

            BarDRAWLAYERS.push(DRAWPOLYLINE); // 变量绘制中的折线DRAWPOLYLINE推入数组有什么意义

            if (func) { //这个形参是什么 这个判断语句是什么含义
                func(DRAWPOLYLINEPOINTS);
            }

            DRAWPOLYLINEPOINTS = [];  //将参数清空
            DRAWING = false;
            ISMEASURE = false;
            _map.off('mousedown');  //移除事件监听
            _map.off('mousemove');
            _map.off('dblclick');
        }
    });

    var shapeOptions = {  //对应40行
            color: '#F54124',
            weight: 3,
            opacity: 0.8,
            fill: false,
            clickable: true
        },

        DRAWPOLYLINE = new L.Polyline([], shapeOptions);  //新建绘制的折线
    _map.addLayer(DRAWPOLYLINE);  //添加图层

    if (ISMEASURE) { //条件判断 是否量距
        MEASURETOOLTIP = new L.Tooltip(_map); // L.Tooltip是什么函数 是否是其他leaflet插件里的函数
    }
}

//绘制多边形
function startDrawPolygon(func) {

    MEASURERESULT = 0;

    _map.getContainer().style.cursor = 'crosshair';

    _map.on('mousedown', function (e) {
        DRAWING = true;
        DRAWPOLYGONPOINTS.push(e.latlng);
        DRAWPOLYGON.addLatLng(e.latlng);  //   addLatLng()：L.Polyline的方法  向线段添加一个点。
    });

    _map.on('mousemove', function (e) {
        if (DRAWING) {  //DRAWMOVEPOLYGON 绘制过程中的面 这一步判断是什么意思 目的是什么？？
            if (DRAWMOVEPOLYGON != undefined && DRAWMOVEPOLYGON != null) {
                _map.removeLayer(DRAWMOVEPOLYGON);
            }
            var prevPoint = DRAWPOLYGONPOINTS[DRAWPOLYGONPOINTS.length - 1];
            var firstPoint = DRAWPOLYGONPOINTS[0];
            DRAWMOVEPOLYGON = new L.Polygon([firstPoint, prevPoint, e.latlng], shapeOptions);  //L.Polygon()：通过给定地理点组成的数组和选项对象来实例化一个多边形（同线段构造方法相同）。你也可以通过传递经纬度的二维数组来创建一个带有洞的多边形，第一个经纬度数组表示外环，剩下的表示里面的洞。
            _map.addLayer(DRAWMOVEPOLYGON);

            if (ISMEASURE && DRAWPOLYGONPOINTS.length > 1) {
                var tempPoints = [];
                for (var i = 0; i < DRAWPOLYGONPOINTS.length; i++) {
                    tempPoints.push(DRAWPOLYGONPOINTS[i]);
                }
                tempPoints.push(e.latlng);//通过for循环 将多边形的所有节点以及鼠标所在位置推给数组tempPoints
                var distance = CalArea(tempPoints); //CalArea   221行面积计算函数
                MEASUREAREATOOLTIP.updatePosition(e.latlng);
                MEASUREAREATOOLTIP.updateContent({
                    text: '单击确定点，双击结束！',
                    subtext: "总面积：" + (distance / 1000000).toFixed(3) + '平方公里'
                });
            }
        }
    });

    _map.on('dblclick', function (e) {

        _map.getContainer().style.cursor = ''; ////反回光标的默认样式 getContainer返回地图容器对象

        if (DRAWING) { //？

            if (DRAWMOVEPOLYGON != undefined && DRAWMOVEPOLYGON != null) {
                _map.removeLayer(DRAWMOVEPOLYGON);
                DRAWMOVEPOLYGON = null;
            }

            if (DRAWPOLYGONPOINTS.length > 2 && ISMEASURE) {

                MEASURERESULT = CalArea(DRAWPOLYGONPOINTS);

                var distanceLabel = L.marker(e.latlng, {
                    icon: new L.divIcon({
                        className: 'DistanceLabelStyle',
                        iconAnchor: [-8, 15],
                        html: "<span class='bubbleLabel'><span class='bubbleLabel-bot bubbleLabel-bot-left'></span><span class='bubbleLabel-top bubbleLabel-top-left'></span><span>总面积：" + (MEASURERESULT / 1000000).toFixed(3) + "平方公里" + "</span></span>"
                    }),
                }).addTo(_map);

                BarDRAWLAYERS.push(distanceLabel);
            }

            //移除提示框
            if (MEASUREAREATOOLTIP) {
                MEASUREAREATOOLTIP.dispose();
            }

            BarDRAWLAYERS.push(DRAWPOLYGON);

            if (func) {  //？
                func(DRAWPOLYGONPOINTS);
            }

            DRAWPOLYGONPOINTS = [];
            DRAWING = false;
            ISMEASURE = false;
            _map.off('mousedown');
            _map.off('mousemove');
            _map.off('dblclick');
        }
    });

    var shapeOptions = {
            color: '#F54124',
            weight: 3,
            opacity: 0.8,
            fill: true,
            fillColor: null,
            fillOpacity: 0.2,
            clickable: true
        },

        DRAWPOLYGON = new L.Polygon([], shapeOptions);
    _map.addLayer(DRAWPOLYGON);

    if (ISMEASURE) {
        MEASUREAREATOOLTIP = new L.Tooltip(_map);
    }
}

//面积计算
function CalArea(latLngs) { //tempPoints为实参 为多边形各点坐标的数组
    var pointsCount = latLngs.length,
        area = 0.0,
        d2r = Math.PI / 180,
        p1, p2;
    if (pointsCount > 2) {
        for (var i = 0; i < pointsCount; i++) {
            p1 = latLngs[i];
            p2 = latLngs[(i + 1) % pointsCount];
            area += ((p2.lng - p1.lng) * d2r) *
                (2 + Math.sin(p1.lat * d2r) + Math.sin(p2.lat * d2r));
        }
        area = area * 6378137.0 * 6378137.0 / 2.0;
    }
    return Math.abs(area);
}


function measure() {
    ISMEASURE = true;
    startDrawLine();
}

//量面
function measureArea() {
    ISMEASURE = true;
    startDrawPolygon();
}

//清除标绘图层
function clearMap() {
    if (MEASURETOOLTIP) {
        MEASURETOOLTIP.dispose();
    }
    if (MEASUREAREATOOLTIP) {
        MEASUREAREATOOLTIP.dispose();
    }
    for (var i = 0; i < BarDRAWLAYERS.length; i++) {
        _map.removeLayer(BarDRAWLAYERS[i]);
    }
    BarDRAWLAYERS = [];
}
//计算距离
function CalDistances(points) {
    var distance = 0;
    if (points != undefined) {
        for (var i = 0; i < points.length - 1; i++) {
            var point = points[i];
            var point1 = points[i + 1];
            distance += CalDistance(point, point1);
        }
    }
    return distance;
}

function ConverterCoordToGrauss(point) {
    var x = point.x * 20037508.34 / 180;
    var y = Math.log(Math.tan((90 + point.y) * Math.PI / 360)) / (Math.PI / 180);
    y = y * 20037508.34 / 180;
    var newPoint = { 'x': x, 'y': y };
    return newPoint;
}