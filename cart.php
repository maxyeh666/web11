<?php
/* 引入檔頭，每支程都會引入 */
require_once 'head.php';

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'op_list', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');


/* 程式流程 */
switch ($op){
  case "order_list":
    $msg = order_list($sn);
    break;
    
  case "order_insert":
    $returnUrl = order_insert($sn="");
    redirect_header($returnUrl, "新增成功", 3000);    
    exit;
    
  case "order_update":
    $returnUrl = order_insert($sn="");
    redirect_header($returnUrl, "編輯成功", 3000);    
		exit;

  case "add_cart":
    $msg = add_cart($sn);
    redirect_header("cart.php", $msg, 3000);
    exit;


  case "order_form":
    $msg = order_form($sn="");
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
function order_list($sn){
  global $db,$smarty;	
  $date = system_CleanVars($_REQUEST, 'key', '', 'string');
  $sql="SELECT a.*,
               b.title as kind_title
        FROM `orders_main` as a
        LEFT JOIN `kinds`  as b on a.kind_sn = b.sn
        WHERE a.`sn` = '{$sn}' AND a.`date` = '{$date}'
  ";//die($sql);
  $result = $db->query($sql) or die($db->error() . $sql);
  $order_main = $result->fetch_assoc() or redirect_header(_WEB_URL, "無此筆資料", 3000);;

  #訂單主檔
  $order_main['name'] = htmlspecialchars($order_main['name']);//
  $order_main['tel'] = htmlspecialchars($order_main['tel']);//
  $order_main['email'] = htmlspecialchars($order_main['email']);//
  $order_main['ps'] = htmlspecialchars($order_main['ps']);//

  $order_main['date'] = (int)$order_main['date'];//
  $order_main['date'] = date("Y-m-d H:i",$order_main['date']);

  $order_main['total'] = (int)$order_main['total'];//
  $order_main['kind_title'] = htmlspecialchars($order_main['kind_title']);//

  $smarty->assign("order_main", $order_main);

  #訂單明細檔
  $sql="SELECT *
        FROM `orders`
        WHERE `orders_main_sn` = '{$sn}'
        ORDER BY `sort`
  ";
  $result = $db->query($sql) or die($db->error() . $sql);
  $rows = [];
  //sn	orders_main_sn	prod_sn	title	amount	price	sort  
  while($row = $result->fetch_assoc()){    
    $row['sn'] = (int)$row['sn'];//分類  
    $row['prod_sn'] = (int)$row['prod_sn'];//商品流水號
    $row['title'] = htmlspecialchars($row['title']);//標題
    $row['price'] = (int)$row['price'];//價格
    $row['amount'] = (int)$row['amount'];//
    $row['total'] = $row['price'] * $row['amount'] ? $row['price'] * $row['amount'] : "";//
    $row['prod'] = getFilesByKindColsnSort("prod",$row['prod_sn']);
    $rows[] = $row;
  }

  $smarty->assign("rows", $rows);
}

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
    $row['amount'] = isset($_SESSION['cart'][$sn]['amount']) ? $_SESSION['cart'][$sn]['amount']++ : 1;//驗證數量,若session有則增加,若沒有則設為1

    $_SESSION['cart'][$sn] = $row;
    $_SESSION['cartAmount'] = count($_SESSION['cart']);
    // print_r($row);die;
  }
  return "加入購物車成功!";
}

function order_insert(){
  global $db;			 
 
  $_POST['name'] = db_filter($_POST['name'], '');//類別
  $_POST['tel'] = db_filter($_POST['tel'], '');//標題
  $_POST['email'] = db_filter($_POST['email'], '');
  $_POST['kind_sn'] = db_filter($_POST['kind_sn'], '桌號');
  $_POST['ps'] = db_filter($_POST['ps'], '');
  $_POST['uid'] = db_filter($_POST['uid'], '');
  $_POST['date'] = strtotime("now");
  
  #訂單主檔
  $sql="INSERT INTO `orders_main` 
                    (`name`, `tel`, `email`, `ps`, `uid`, `date`, `kind_sn`)
                    VALUES 
                    ('{$_POST['name']}', '{$_POST['tel']}', '{$_POST['email']}', '{$_POST['ps']}', '{$_POST['uid']}', '{$_POST['date']}', '{$_POST['kind_sn']}')"; 
                    //die($sql);
  // print_r($_POST);die;
  $db->query($sql) or die($db->error() . $sql);
  $sn = $db->insert_id;  
  
  #訂單明細檔
  $sort = 1;
  $Total = 0;
  foreach($_POST['Amount'] as $prod_sn => $amount){ //取得html裡name=Amount的值,然後進行計算總價,資料庫將商品(prod_sn)指派數量(amount)
    $prod = getProdsBySn($prod_sn); //根據sn取得商品資料
    #過濾
    $prod['title'] = db_filter($prod['title'], '');
    #驗證
    $prod['price'] = (int)$prod['price'];

    $Total += $prod['price'] * $amount;//小計累計
    $sql="INSERT INTO `orders` 
                      (`orders_main_sn`, `prod_sn`, `title`, `amount`, `price`, `sort`)
                      VALUES 
                      ('{$sn}', '{$prod_sn}', '{$prod['title']}', '{$amount}', '{$prod['price']}', '{$sort}')";
    // print_r($sql);die();
    $db->query($sql) or die($db->error() . $sql);
    $sort++;
  }

  #更新訂單主檔
  $sql="UPDATE  `orders_main` SET
                `total` = '{$Total}'
                WHERE `sn` = '{$sn}'";
  $db->query($sql) or die($db->error() . $sql);
  unset($_SESSION['cart']);  //unset()為清除設置的變數,這裡為清除購物車
  unset($_SESSION['cartAmount']); //unset()為清除設置的變數,這裡為清除購物車計數

  return "cart.php?op=order_list&sn={$sn}&key={$_POST['date']}";
}
