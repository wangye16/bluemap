_map.doubleClickZoom.disable();
var MyCustomAction = L.Toolbar2.Action.extend({

    options: {
        toolbarIcon: {
            // html: '<i class="fa fa-globe" aria-hidden="true"></i>',
            html: '<div><img src="./images/earth.png" style="width:100%;height:100%"/></div>',
            tooltip: '全景'
        }
    },

    addHooks: function () {
        _map.setView([41.997136, 121.653156], 13);

    }
});

var MyCustomAction1 = L.Toolbar2.Action.extend({
    options: {
        toolbarIcon: {
            html: '<div><img src="./images/distance2.png" style="width:100%;height:100%"/></div>',
            tooltip: '距离'
        }
    },

    addHooks: function () {
        measure();
    }
});

var MyCustomAction2 = L.Toolbar2.Action.extend({
    options: {
        toolbarIcon: {
            html: '<div><img src="./images/area.png" style="width:100%;height:100%"/></div>',
            tooltip: '面积'
        }
    },

    addHooks:  function () {
        // _map.doubleClickZoom.disable();
        measureArea();
    }
});

var MyCustomAction3 = L.Toolbar2.Action.extend({
    options: {
        toolbarIcon: {
            html: '<div><img src="./images/brush.png" style="width:100%;height:100%"/></div>',
            tooltip: '清除'
        }
    },

    addHooks: function () {
        clearMap()
    }
});
//8.1改

var lealet_toolbar_a;
var MyCustomAction4 = L.Toolbar2.Action.extend({
    options: {
        toolbarIcon: {
            html: '<div id = "attribute"><img src="./images/message3.png" style="width:100%;height:100%"/></div>',
            tooltip: '属性查询，点击一次开启，再次关闭'
        }
    },

    addHooks: function () {
//  8.1改
// 点击属性查询工具后，如果点击的不是用地红线图层则弹出popup弹窗

        if(lealet_toolbar_a == true){
            $("#attribute").css("background-color","");
            $(".leaflet-interactive").css("cursor","");
            window['layer_ydhx'].off('click');
            // window['layer_ydhx'].off('mousemove');
            _map.off('click');

            if (typeof(line_round) == "object") {
                _map.removeLayer(line_round);
            };
            lealet_toolbar_a = false;

        }
        else{
            // _map.getContainer().style.cursor = 'pointer';
            $("#attribute").css("background-color","#e68296");
            $(".leaflet-interactive").css("cursor","pointer");
            ydhx_click('layer_ydhx');
            _map.on('click',  function(e) {
                if(marker_ydhx){
                    marker_ydhx = false;
                }
                else{
                    var popup = L.popup();
                    popup
                    .setLatLng(e.latlng)
                    // .setContent("You clicked the map at " + e.latlng.toString())
                    .setContent("您点击的区域为无效区域，请重新选择")
                    .openOn(_map);
                }
            });
            lealet_toolbar_a = true;
        }
    }
});



new L.Toolbar2.Control({
    position: 'topleft',
    actions: [MyCustomAction,MyCustomAction1,MyCustomAction2,MyCustomAction3,MyCustomAction4]
}).addTo(_map);
