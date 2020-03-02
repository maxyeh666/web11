<?php
/* 引入檔頭，每支程都會引入 */
require_once 'head.php';

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'op_list', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');


/* 程式流程 */
switch ($op){
  case "contact_form" :
    $msg = contact_form();
    break;

  case "ok" :
    $msg = ok();
    break;

  case "login" :
    $msg = login();
    redirect_header("index.php", $msg , 3000);
    exit;

  case "logout" :
    $msg = logout();
    redirect_header("index.php", "登出完成!", 5000);
    exit;

  case "login_form" :
    $msg = login_form();
    break;

  case "reg_form" :
    $msg = reg_form();
    break;

  case "reg" :
    $msg = reg();
    redirect_header("index.php", "註冊成功", 5000);
    exit;
  
  default:
    $op = "op_list";
    $mainSlides = getMenus("mainSlide",true);
    $smarty->assign("mainSlides", $mainSlides);
    
    break;  
}
/*---- 將變數送至樣版----*/
  $mainMenus = getMenus("mainMenu"); //取得選單項目

  $smarty->assign("mainMenus", $mainMenus); //取得選單項目變數
  $smarty->assign("WEB", $WEB);
  $smarty->assign("op", $op);

/*---- 程式結尾-----*/
$smarty->display('theme.tpl');

//----函數區
function contact_form(){

}

function ok(){

}

function getMenus($kind,$pic=false){
  global $db;

  $sql = "SELECT *
          FROM `kinds`
          WHERE `kind`='{$kind}' and `enable` = '1'
          ORDER BY `sort`";
          
  //die($sql);

  $result = $db->query($sql) or die($db->error() . $sql);
  $rows=[];
  while($row = $result->fetch_assoc()){ 
      #驗證
      $row['sn'] = (int)$row['sn'];//流水號
      $row['title'] = htmlspecialchars($row['title']);//標題
      $row['enable'] = (int)$row['enable'];//狀態 
      $row['url'] = htmlspecialchars($row['url']);//網址
      $row['target'] = (int)$row['target'];//外部連接
      $row['pic'] = ($pic == true) ? getFilesByKindColsnSort($kind,$row['sn']) :"";//圖片連結
      $rows[] = $row;
  }
  // print_r($rows);die();
  return $rows;
}

function login(){
  global $db;

  $_POST['uname'] = db_filter($_POST['uname'], '帳號');
  $_POST['pass'] = db_filter($_POST['pass'], '密碼');

  $sql="SELECT *
        FROM `users`
        WHERE `uname` = '{$_POST['uname']}'";

  $result = $db->query($sql) or die($db->error() . $sql);
  $row = $result->fetch_assoc() or redirect_header("index.php", "帳號輸入錯誤" , 3000);//先判斷帳號是否正確

  //資料過濾
  $row['uname'] = htmlspecialchars($row['uname']);//字串
  $row['uid'] = (int)$row['uid'];//整數
  $row['kind'] = (int)$row['kind'];//整數
  $row['name'] = htmlspecialchars($row['name']);//字串
  $row['tel'] = htmlspecialchars($row['tel']);//字串
  $row['email'] = htmlspecialchars($row['email']);//字串 
  $row['pass'] = htmlspecialchars($row['pass']);//字串 
  $row['token'] = htmlspecialchars($row['token']);//字串

  //登入成功則將資料放入session以便其他頁面驗證,若否則清空session
  if(password_verify($_POST['pass'], $row['pass'])){
    //登入成功
    $_SESSION['user']['uid'] = $row['uid'];
    $_SESSION['user']['uname'] = $row['uname'];
    $_SESSION['user']['name'] = $row['name'];
    $_SESSION['user']['tel'] = $row['tel'];
    $_SESSION['user']['email'] = $row['email'];
    $_SESSION['user']['kind'] = $row['kind'];
    
    $_POST['remember'] = isset($_POST['remember']) ? $_POST['remember'] : "";
    
    if($_POST['remember']){ //當判斷remember(記住我)方塊勾選時,進行下列動作
      //將資料寫入cookie
      setcookie("uname",$row['uname'], time()+ 3600 * 24 * 365); //將name寫入cookie,有效時間60(秒)*60(分)*24(小時)*365(天)
      setcookie("token",$row['token'], time()+ 3600 * 24 * 365); //將token寫入cookie,有效時間60(秒)*60(分)*24(小時)*365(天)
    }
    return "登入成功";
  }else{    
    $_SESSION['user']['uid'] = "";
    $_SESSION['user']['uname'] = "";
    $_SESSION['user']['name'] = "";
    $_SESSION['user']['tel'] = "";
    $_SESSION['user']['email'] = "";
    $_SESSION['user']['kind'] = "";
    return "登入失敗";
  }
}

function logout(){  //登出的函數設定
  //logout時將session的資料清空
  $_SESSION['user']['uid'] = "";
  $_SESSION['user']['uname'] = "";
  $_SESSION['user']['name'] = "";
  $_SESSION['user']['tel'] = "";
  $_SESSION['user']['email'] = "";
  $_SESSION['user']['kind'] = "";
  //清除cookie裡面的資料
  setcookie("uname","",time() - 3600 * 24 * 365);  //將cookie裡面的name值與時間都清除
  setcookie("token","",time() - 3600 * 24 * 365); //將cookie裡面的token值與時間都清除
}


function login_form(){

}

function reg_form(){

}

function reg(){
  global $db;
  
  $_POST['uname'] = db_filter($_POST['uname'], '帳號');
  $_POST['pass'] = db_filter($_POST['pass'], '密碼');
  $_POST['chk_pass'] = db_filter($_POST['chk_pass'], '確認密碼');
  $_POST['name'] = db_filter($_POST['name'], '姓名');
  $_POST['tel'] = db_filter($_POST['tel'], '電話');
  $_POST['email'] = db_filter($_POST['email'], 'email',FILTER_SANITIZE_EMAIL);
  #加密處理
  if($_POST['pass'] != $_POST['chk_pass']){
    redirect_header("index.php?op=reg_form","密碼不一致");
    exit;
  }

  $_POST['pass']  = password_hash($_POST['pass'], PASSWORD_DEFAULT);
  $_POST['token']  = password_hash($_POST['uname'], PASSWORD_DEFAULT);

  $sql="INSERT INTO `users` (`uname`, `pass`, `name`, `tel`, `email`, `token`)
  VALUES ('{$_POST['uname']}', '{$_POST['pass']}', '{$_POST['name']}', '{$_POST['tel']}', '{$_POST['email']}', '{$_POST['token']}');";

  $db->query($sql) or die($db->error() . $sql);
  $uid = $db->insert_id;
}