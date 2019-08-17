// 加载地图功能

var _map = L.map('map'
// ,{layers: [layerGeo_1,layerGeo_2,layerGeo_3,layerGeo,layerGeo_4]}
).setView([42.047094, 121.654401], 13);
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 30,
    id: 'mapbox.streets',
}).addTo(_map);

//新建高度650的pane容器存放用地红线图层，使其顶层显示
_map.createPane('labels');
_map.getPane('labels').style.zIndex = 650;

//添加点标记
var marker = L.marker([42.047094, 121.654401]).addTo(_map);
marker.bindPopup("<b>Hello world!</b><br>I am a popup.");
// var popup = L.popup();
// function onMapClick(e) {
//     popup
//         .setLatLng(e.latlng)
//         .setContent("You clicked the map at " + e.latlng.toString())
//         .openOn(_map);
// }
// _map.on('click', onMapClick);
// _map.doubleClickZoom.disable();
