<?php
/**
 * Get variables passed by GET or POST method
 *
 * Comment by Taiwen Jiang (a.k.a. phppp): THE METHOD IS NOT COMPLETE AND NOT SAFE. YOU ARE ENCOURAGED TO USE PHP'S NATIVE FILTER_VAR OR FILTER_INPUT FUNCTIONS DIRECTLY BEFORE WE MIGRATE TO XOOPS 3.
 */
function system_CleanVars(&$global, $key, $default = '', $type = 'int')
{
  switch ($type) {
    case 'array':
      $ret = (isset($global[$key]) && is_array($global[$key])) ? $global[$key] : $default;
      break;
    case 'date':
      $ret = (isset($global[$key])) ? strtotime($global[$key]) : $default;
      break;
    case 'string':
      $ret = (isset($global[$key])) ? filter_var($global[$key], FILTER_SANITIZE_ADD_SLASHES ) : $default;
      break;
    case 'int': default:
      $ret = (isset($global[$key])) ? filter_var($global[$key], FILTER_SANITIZE_NUMBER_INT) : $default;
      break;
  }
  if ($ret === false) {
    return $default;
  }
  return $ret;
}
 
 
/*############################################
  轉向函數
############################################*/
function redirect_header($url, $message , $time) { //redirect_header(回到網址,出現訊息,出現時間)
  //從session取得資料
  $_SESSION['redirect'] = true;
  $_SESSION['message'] = $message;
  $_SESSION['time'] = $time;
  header("location:{$url}");
  exit;
}
###############################################################################
#  取得目前網址
###############################################################################
if (!function_exists("getCurrentUrl")) {
  function getCurrentUrl() {
    global $_SERVER;
    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === FALSE ? 'http' : 'https';
    $host = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];
    $params = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : "";
  
    $currentUrl = $protocol . '://' . $host . $script . $params;
    return $currentUrl;
  }
}
  
###############################################################################
#  獲得填報者ip
###############################################################################
if (!function_exists("getVisitorsAddr")) {
  function getVisitorsAddr() {
    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
      $ip = $_SERVER["HTTP_CLIENT_IP"];
    } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
      $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else {
      $ip = $_SERVER["REMOTE_ADDR"];
    }
    return $ip;
  }
}
 
#####################################################################################
#  建立目錄
#####################################################################################
if (!function_exists("mk_dir")) {
  function mk_dir($dir = "") {
    #若無目錄名稱秀出警告訊息
    if (empty($dir)) {
      return;
    }
  
    #若目錄不存在的話建立目錄
    if (!is_dir($dir)) {
      umask(000);
      //若建立失敗秀出警告訊息
      mkdir($dir, 0777);
    }
  }
}


//檢查並傳回欲拿到資料使用的變數
//$title = '' 則非必填
function db_filter($var, $title = '', $filter = '',$url = _WEB_URL){
  global $db;
  #寫入資料庫過濾
  $var = $db->real_escape_string($var);

  if($title){
    if($var === ""){
      redirect_header($url, $title . '為必填！');
    }
  }

  if ($filter) {
    $var = filter_var($var, $filter);
    if (!$var) redirect_header($url, "不合法的{$title}", 3000);
  }
  return $var;
}


/*========================================
  用kind col_sn sort 取得圖片資料
========================================*/ 
function getFilesByKindColsnSort($kind,$col_sn,$sort=1,$url=true){
  global $db; 
  $sql="SELECT *
      FROM `files`
      WHERE `kind` = '{$kind}' AND `col_sn` = '{$col_sn}' AND `sort` = '{$sort}'
      ";     
  $result = $db->query($sql) or die($db->error() . $sql);
  $row = $result->fetch_assoc();
  $file_name = "";
  if($row){
    if($url){
        $file_name = _WEB_URL . "/uploads" . $row['sub_dir'] . "/" . $row['name'];
    }else{
        $file_name = _WEB_PATH . "/uploads" . $row['sub_dir'] . "/" . $row['name'];
    }
  }
  return $file_name;
}

/*========================================
  用kind col_sn sort 刪除圖片資料
========================================*/ 
function delFilesByKindColsnSort($kind,$col_sn,$sort){
  global $db;
  # 1.刪除實體檔案
  $file_name = getFilesByKindColsnSort($kind,$col_sn,$sort,false);
  if($file_name){
      unlink($file_name);
  }
  # 2.刪除files資料表	
  $sql="DELETE FROM `files`
      WHERE `kind` = '{$kind}' AND `col_sn` = '{$col_sn}' AND `sort` = '{$sort}'
  ";
  $db->query($sql) or die($db->error() . $sql);	
  return;
}
