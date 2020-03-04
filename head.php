<?php
/*
1. head.php為前台每個程式都會引入的檔案
2. 所有檔案都必須執行的流程，請放到這裡
3. smarty_01
 */
session_start(); //啟用 $_SESSION,前面不可以有輸出
error_reporting(E_ALL);@ini_set('display_errors', true); //設定所有錯誤都顯示
$http = 'http://';
if (!empty($_SERVER['HTTPS'])) {
  $http = ($_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
}
 
#網站實體路徑(不含 /)
define('_WEB_PATH', str_replace("\\", "/", dirname(__FILE__)));
 
#網站URL(不含 /)
define('_WEB_URL', $http . $_SERVER["HTTP_HOST"] . str_replace($_SERVER["DOCUMENT_ROOT"], "", _WEB_PATH));
 
#--------- WEB -----
#程式檔名(含副檔名)
$WEB['file_name'] = basename($_SERVER['PHP_SELF']); //index.php
//basename(__FILE__)head.php
#--------- WEB END -----
 
#
/*---- 必須引入----*/
#引入樣板引擎
require_once _WEB_PATH.'/smarty.php';
#引入資料庫設定
require_once _WEB_PATH.'/sqlConfig.php';
#引入設定檔
require_once _WEB_PATH . '/function.php';

$SESSION['admin']=""; 

$_SESSION['user']['kind'] = isset($_SESSION['user']['kind']) ? $_SESSION['user']['kind'] : ""; //使用三元運算式來判斷session的值,若有則帶入值,若無則預設為空值

# 為了cookie使用
if($_SESSION['user']['kind'] === ""){ //若session值為空
  $_COOKIE['token'] = isset($_COOKIE['token']) ? $_COOKIE['token'] : ""; //取得token值,若沒有值則為空
  $_COOKIE['uname'] = isset($_COOKIE['uname']) ? $_COOKIE['uname'] : ""; //取得uname值,若沒有值則為空
  
  #過濾
  $_COOKIE['uname'] = db_filter($_COOKIE['uname'], '');
  $_COOKIE['token'] = db_filter($_COOKIE['token'], '');
  
  if($_COOKIE['uname'] &&  $_COOKIE['token']){ //若uname且token有值
    $sql="SELECT *
          FROM `users`
          WHERE `uname` = '{$_COOKIE['uname']}'";
    $result = $db->query($sql);  //判斷資料庫查詢是否為true,若false則傳回error訊息
    $row = $result->fetch_assoc(); //fetch_assoc()將讀到的資料放入對應的key值
  
    if($_COOKIE['token'] === $row['token']){
      
      $row['uname'] = htmlspecialchars($row['uname']);//字串
      $row['uid'] = (int)$row['uid'];//整數
      $row['kind'] = (int)$row['kind'];//整數
      $row['name'] = htmlspecialchars($row['name']);//字串
      $row['tel'] = htmlspecialchars($row['tel']);//字串
      $row['email'] = htmlspecialchars($row['email']);//字串 
      $row['pass'] = htmlspecialchars($row['pass']);//字串 
      $row['token'] = htmlspecialchars($row['token']);//字串
      
      $_SESSION['user']['uid'] = $row['uid'];
      $_SESSION['user']['uname'] = $row['uname'];
      $_SESSION['user']['name'] = $row['name'];
      $_SESSION['user']['tel'] = $row['tel'];
      $_SESSION['user']['email'] = $row['email'];
      $_SESSION['user']['kind'] = $row['kind'];
    }
  }
}

#轉向使用

//判斷是否有接收到轉向的訊息
$_SESSION['redirect'] = isset($_SESSION['redirect']) ? $_SESSION['redirect'] : "";
$_SESSION['message'] = isset($_SESSION['message']) ? $_SESSION['message'] : "";
$_SESSION['time'] = isset($_SESSION['time']) ? $_SESSION['time'] : "";

//將轉向的值放入session
$smarty->assign("redirect",$_SESSION['redirect']); 
$smarty->assign("message",$_SESSION['message']);
$smarty->assign("time", $_SESSION['time']);

//將轉向後的session資料清除
$_SESSION['redirect'] = "";
$_SESSION['message'] = "";
$_SESSION['time'] = "";

#購物車圖示判斷

//接收購物裡面是否有物件(session)
$_SESSION['cartAmount'] = isset($_SESSION['cartAmount']) ? $_SESSION['cartAmount'] : 0;