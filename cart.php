<?php
/* 引入檔頭，每支程都會引入 */
require_once 'head.php';

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'op_list', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');


/* 程式流程 */
switch ($op){
  default:
    $op = "op_list";
    break;  
}
/*---- 將變數送至樣版----*/
  $mainMenus = getMenus("cartMenu"); //取得選單項目

  $smarty->assign("mainMenus", $mainMenus); //取得選單項目變數
  $smarty->assign("WEB", $WEB);
  $smarty->assign("op", $op);

/*---- 程式結尾-----*/
$smarty->display('theme.tpl');

//----函數區
function getMenus($kind,$pic=false){
  global $db;

  // 取得資料庫資料,且enable值為1者
  $sql = "SELECT *
          FROM `kinds`
          WHERE `kind`='{$kind}' and `enable` = '1'
          ORDER BY `sort`";
  //die($sql);
  $result = $db->query($sql) or die($db->error() . $sql); //判斷資料庫查詢是否為true,若false則傳回error訊息
  $rows=[];
  
  while($row = $result->fetch_assoc()){  //fetch_assoc()將讀到的資料放入對應的key值
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