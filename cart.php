<?php
/* 引入檔頭，每支程都會引入 */
require_once 'head.php';

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'op_list', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');


/* 程式流程 */
switch ($op){
  case "add_cart":
    $msg = add_cart($sn);
    redirect_header("cart.php", $msg, 3000);
    exit;

  case "order_form":
    $msg = order_form();
    break;

  default:
    $op = "op_list";
    op_list();
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
function op_list(){
  global $smarty,$db;

  $sql = "SELECT  a.sn,a.title,price,b.title as kinds_title /* 這裡是設定交集資料庫的取得的資料欄位 */
          FROM `prods` as a /* 將資料庫prods設為a,然後將資料庫kinds設為b,在這裡合成交集資料表*/   
          LEFT JOIN `kinds` as b on a.kind_sn=b.sn/* LEFT JOIN kinds為取得prods與kinds的交集,所以最終呈現會有prod的資料+kinds與prods焦急的資料*/
          WHERE a.`enable`='1' /* 當enable的值為1時才取得值 */
          ORDER BY a.date desc";  /* 按照上架時間進行排序 */
  // print_r($sql);die();
  $result = $db->query($sql) or die($db->error() . $sql);  //判斷資料庫查詢是否為true,若false則傳回error訊息
  $rows = [];

  #---分頁套件(原始$sql 不要設 limit)
  include_once _WEB_PATH."/class/PageBar/PageBar.php";

  $pageCount = 10;  //這裡設定每頁數量,超過就分頁
  $PageBar = getPageBar($db, $sql, $pageCount, 10);  //getPageBar(資料庫, 表單, 每頁數量, 其他連結參數)
  $sql     = $PageBar['sql'];
  $total   = $PageBar['total'];
  $bar     = ($total > $pageCount) ? $PageBar['bar'] : "";  //三元運算,計算total(總頁數)是否大於pagecount(現有頁數),依此製作將分頁按鈕製作出來
  $smarty->assign("bar",$bar);  
  #---分頁套件(end)

  while($row=$result->fetch_assoc()){  //fetch_assoc()將讀到的資料放入對應的key值
    #驗證程序
    $row['sn'] = (int)$row['sn'];//價格
    $row['title'] = htmlspecialchars($row['title']);//標題
    $row['price'] = (int)$row['price'];//價格
    $row['prod'] = getFilesByKindColsnSort("prod",$row['sn']); 
    $rows[] = $row;
  }
  // print_r($rows);die();
  $smarty -> assign("rows",$rows);
}

function add_cart($sn){
  global $db;

  $row = getProdsBySn($sn);
  if($row['enable']){
    #驗證程序
    $row['sn'] = (int)$row['sn'];//分類
    $row['title'] = htmlspecialchars($row['title']);//標題
    $row['price'] = (int)$row['price'];//價格
    $row['prod'] = getFilesByKindColsnSort("prod",$row['sn']); //圖片
    $row['amount'] = isset($SESSON['cart']['$sn']['amount']) ? $SESSON['cart']['$sn']['amount']++ : 1;//驗證數量,若session有則增加,若沒有則設為1

    $_SESSION['cart'][$sn] = $row;
    $_SESSION['cartAmount'] = count($_SESSION['cart']);
  }
  return "加入購物車成功!";
}

function order_form(){
  global $db,$smarty;

  $row['uid'] = isset($_SESSION['user']['uid']) ? $_SESSION['user']['uid'] : "" ;
  $row['name'] = isset($_SESSION['user']['name'])? $_SESSION['user']['name'] : "";
  $row['tel'] = isset($_SESSION['user']['tel'])? $_SESSION['user']['tel'] : "";
  $row['email'] = isset($_SESSION['user']['email'])? $_SESSION['user']['email'] : "";

  $row['kind_sn'] = "";//類別值
  $row['kind_sn_options'] = getProdsOptions("orderKind");
  // print_r($row);die();
  $smarty->assign("row", $row);
}