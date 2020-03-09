<?php
/* 引入檔頭，每支程都會引入 */
require_once 'head.php';
 
if($_SESSION['user']['kind'] !== 1)redirect_header("index.php", '您沒有權限', 3000);

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'op_list', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');
// echo $op;die();
 
/* 程式流程 */
switch ($op){
  case "order_delete" :
    $msg = order_delete($sn);
    redirect_header($_SESSION['returnUrl'], $msg, 3000);
    exit;

  case "op_form" :
    $msg = op_form($sn);
    break;
 
  default:
    $op = "op_list";
    $_SESSION['returnUrl'] = getCurrentUrl();
    op_list();
    break;  
}
/*---- 將變數送至樣版----*/
$smarty->assign("WEB", $WEB);
$smarty->assign("op", $op);
 
/*---- 程式結尾-----*/
$smarty->display('admin.tpl');
 
/*---- 函數區-----*/
function order_delete($sn){
  global $db; 
  #刪除舊圖
  # 1.刪除實體檔案
  # 2.刪除files資料表
  delFilesByKindColsnSort("prod",$sn,1);

  #刪除訂單主檔資料表
  $sql="DELETE FROM `orders_main`
        WHERE `sn` = '{$sn}'
  ";
  $db->query($sql) or die($db->error() . $sql);

  #刪除訂單資料表
  $sql="DELETE FROM `orders`
  WHERE `orders_main_sn` = '{$sn}'
  ";

  $db->query($sql) or die($db->error() . $sql);
  return "訂單資料刪除成功";
}

/*================================
  取得商品數量的最大值
================================*/
function getProdsMaxSort(){
  global $db;
  $sql = "SELECT count(*)+1 as count
          FROM `prods`
  ";//die($sql);

  $result = $db->query($sql) or die($db->error() . $sql);
  $row = $result->fetch_assoc();
  return $row['count'];
}

function op_form($sn=""){
  global $smarty,$db;

  if($sn){
    $row = getProdsBySn($sn);
    $row['op'] = "op_update";
  }else{
    $row['op'] = "op_insert";
  }

  $row['sn'] = isset($row['sn']) ? $row['sn'] : "";
  $row['kind_sn'] = isset($row['kind_sn']) ? $row['kind_sn'] : "1";//類別值
  $row['kind_sn_options'] = getProdsOptions("prod");

  $row['title'] = isset($row['title']) ? $row['title'] : "";
  $row['content'] = isset($row['content']) ? $row['content'] : "";
  $row['price'] = isset($row['price']) ? $row['price'] : "";
  $row['enable'] = isset($row['enable']) ? $row['enable'] : "1";

  $row['date'] = isset($row['date']) ? $row['date'] : strtotime("now");
  $row['date'] = date("Y-m-d H:i:s",$row['date']);

  $row['sort'] = isset($row['sort']) ? $row['sort'] : getProdsMaxSort();
  $row['counter'] = isset($row['counter']) ? $row['counter'] : "";
  
  $row['prod'] = isset($row['prod']) ? $row['prod'] : "";

  $smarty->assign("row",$row);
}

function op_list(){
  global $smarty,$db;
  
  $sql = "SELECT a.*,
                 b.title as kind_title
          FROM `orders_main` as a
          LEFT JOIN `kinds` as b on a.kind_sn=b.sn
          ORDER BY a.`date` desc
  ";//die($sql);

  #---分頁套件(原始$sql 不要設 limit)
  include_once _WEB_PATH."/class/PageBar/PageBar.php";
  $pageCount = 10;
  $PageBar = getPageBar($db, $sql, $pageCount, 10);
  $sql     = $PageBar['sql'];
  $total   = $PageBar['total'];
  $bar     = ($total > $pageCount) ? $PageBar['bar'] : "";
  $smarty->assign("bar",$bar);  
  #---分頁套件(end)

  $result = $db->query($sql) or die($db->error() . $sql);
  $rows=[];//array();
  while($row = $result->fetch_assoc()){
    $row['sn'] = (int)$row['sn'];//分類
    $row['name'] = htmlspecialchars($row['name']);//
    $row['tel'] = htmlspecialchars($row['tel']);//
    $row['name'] = htmlspecialchars($row['name']);//
    $row['date'] = (int)$row['date'];
    $row['date'] = date("Y-m-d H:i",$row['date']);
    $row['total'] = (int)$row['total'];//
    $row['kind_title'] = htmlspecialchars($row['kind_title']);//
    $rows[] = $row;
  }
  $smarty->assign("rows",$rows);
}