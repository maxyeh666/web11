<?php
/* 引入檔頭，每支程都會引入 */
require_once 'head.php';

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');
 
/* 程式流程 */

 
/*---- 將變數送至樣版----*/
$smarty->assign("WEB", $WEB);
$smarty->assign("op", $op);
 
/*---- 程式結尾-----*/
$smarty->display('ok.tpl');
 
/*---- 函數區-----*/
function xxx(){
  global $smarty;
 
}
function yyy(){
  global $smarty;
}
 
function op_list(){
  global $smarty;
}