<?php
/* 引入檔頭，每支程都會引入 */
require_once 'head.php';
 

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'login_form', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');
 
/* 程式流程 */
switch ($op){
  case "op_form" :
    $msg = op_form();
    break;
 
  case "login" :
    $msg = login();
    redirect_header("index.php", '登入成功!', 5000);
    exit;//轉向時使用exit跳出

  case "logout" :
    $msg = logout();
    redirect_header("index.php", '登出完成!', 5000);
    exit;

  case "reg_form" :
    $msg = reg_form();
    reg_form();
    break;//執行某項函式,執行結束使用break

  case "reg" :
    $msg = reg();
    header("location:index.php");
    exit;
 
  default:
    $op = "login_form";
    login_form();
    break;  
}
 
/*---- 將變數送至樣版----*/
$smarty->assign("WEB", $WEB);
$smarty->assign("op", $op);
 
/*---- 程式結尾-----*/
$smarty->display('user.tpl');
 
/*---- 函數區-----*/
function logout(){  //登出的函數設定
  $_SESSION['admin'] = "";  //登出時將admin變回空白值
  setcookie("name","",time() - 3600 * 24 * 365);  //將cookie裡面的name值與時間都清除
  setcookie("token","",time() - 3600 * 24 * 365); //將cookie裡面的token值與時間都清除
}

function op_form(){
  global $smarty;

}
function login(){
  global $smarty;
  $name="admin";
  $pass="666666";
  $token="xxxxxx";

  if($name == $_POST['name'] and $pass == $_POST['pass']){  //製作session來進行短暫記憶管理員的帳號密碼
    $_SESSION['admin'] = true;  //判斷是否為管理員
    $_POST['remember'] = isset($_POST['remember']) ? $_POST['remember'] : "";
    
    if($_POST['remember']){ //當判斷remember(記住我)方塊勾選時,進行下列動作
      setcookie("name", $name, time()+ 3600 * 24 * 365); //將name寫入cookie,有效時間60(秒)*60(分)*24(小時)*365(天)
      setcookie("token", $token, time()+ 3600 * 24 * 365); //將token寫入cookie,有效時間60(秒)*60(分)*24(小時)*365(天)
    }

    header("location:index.php");//注意前面不可以有輸出
    }else{      
    header("location:user.php");//注意前面不可以有輸出
    }
}

function login_form(){
  global $smarty;
}

function reg_form(){
  global $smarty;
}

function reg(){
  global $db;
  #過濾輸入的資料
  $_POST['uname'] = $db->real_escape_string($_POST['uname']);
  $_POST['pass'] = $db->real_escape_string($_POST['pass']);
  $_POST['chk_pass'] = $db->real_escape_string($_POST['chk_pass']);
  $_POST['name'] = $db->real_escape_string($_POST['name']);
  $_POST['tel'] = $db->real_escape_string($_POST['tel']);
  $_POST['email'] = $db->real_escape_string($_POST['email']);
  #加密處理
  $pass = $db->real_escape_string($_POST['pass']);
  if($_POST['pass'] != $_POST['chk_pass'])
  {
    die("密碼不一致!");
  }
  if (empty($pass)) {
    die("密碼為必填！");
  }
  $_POST['pass']  = password_hash($_POST['pass'], PASSWORD_DEFAULT);
  #寫入資料庫
  $sql = "INSERT INTO `user` (`uname`, `pass`, `name`, `tel`, `email`)
  VALUES ('{$_POST['uname']}', '{$_POST['pass']}', '{$_POST['name']}', '{$_POST['tel']}', '{$_POST['email']}');";
  $db -> query($sql) or die($db -> error . $sql);
  $uid = $db ->insert_id;
  return $uid;
}
/*############################################
  轉向函數
############################################*/
function redirect_header($url, $message , $time) { //redirect_header(回到網址,出現訊息,出現時間)
  $_SESSION['redirect'] = true;
  $_SESSION['message'] = $message;
  $_SESSION['time'] = $time;
  header("location:{$url}");
}