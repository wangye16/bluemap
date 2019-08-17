//回调函数


if (getQueryVariable('xmbh')) { //如果域名中带有xmbh参数，则证明蓝图正在被审批系统iframe方式嵌入。则此时添加审批系统需要的监听事件。
  window.addEventListener('message',funCallback,false);
}

function funCallback(e){
  if (!e.data) {
    alert('传递信息有误');
  }
  var xmdm = e.data.value.xmdm;
  var layers_selected = ['城市增长边界','基本农田保护红线','生态保护红线','城市蓝线','城市紫线','城市绿线'];
  var i_global = createProjectDetailsAndPositioning('panel_'+xmdm,xmdm,xmdm,'');
  var result_obj = complaince_postMessage(xmdm,layers_selected,i_global);
  console.log(result_obj);

  //jsonP跨域取出下载地址
  var download_script = document.createElement('script');
  download_script.src = '../downloadResults.php?result_obj='+result_obj;
  document.body.appendChild(download_script);
}
function get_downloadUrl(data){
  console.log(data);
}
