<?php
/* 引入檔頭，每支程都會引入 */
require_once 'head.php';

#權限檢查
if($_SESSION['user']['kind'] !== 1)redirect_header("index.php", '您沒有權限', 3000);

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'op_list', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');
// die($op);

/* 程式流程 */
switch ($op){
    case "op_form" :
        $msg = op_form($sn);
        break;

    case "op_insert" :
        $msg = op_insert();
        redirect_header("prod.php", $msg, 3000);
        exit;

    case "op_update" :
        $msg = op_insert($sn);
        redirect_header("prod.php", $msg, 3000);
        exit;

    case "op_delete" :
        $msg = op_delete($sn);
        redirect_header("prod.php", $msg, 3000);
        exit;

    default:
        $op = "op_list";
        op_list();
        break;  
}

/*---- 將變數送至樣版----*/
$smarty->assign("WEB", $WEB);
$smarty->assign("op", $op);

/*---- 程式結尾-----*/
$smarty->display('admin.tpl');

/*---- 函數區-----*/
function op_insert($sn=""){
    global $db; 

    //資料過濾
    $_POST['sn'] = db_filter($_POST['sn'], '');//流水號
    $_POST['kind_sn'] = db_filter($_POST['kind_sn'], '');//分類
    $_POST['title'] = db_filter($_POST['title'], '標題');//標題(必填)
    $_POST['price'] = db_filter($_POST['price'], '價格');//價格(必填)
    $_POST['enable'] = db_filter($_POST['enable'], '');//狀態
    $_POST['content'] = db_filter($_POST['content'], '');//內容

    $_POST['date'] = db_filter($_POST['date'], '');//建立日期
    $_POST['date'] = strtotime($_POST['date']);//建立日期(轉換格式)

    $_POST['sort'] = db_filter($_POST['sort'], '');//排序
    $_POST['counter'] = db_filter($_POST['counter'], '');//計數

    if($sn){    
        $sql="UPDATE  `prods` SET
                      `kind_sn` = '{$_POST['kind_sn']}',
                      `title` = '{$_POST['title']}',
                      `content` = '{$_POST['content']}',
                      `price` = '{$_POST['price']}',
                      `enable` = '{$_POST['enable']}',
                      `date` = '{$_POST['date']}',
                      `sort` = '{$_POST['sort']}',
                      `counter` = '{$_POST['counter']}'
              WHERE `sn` = '{$_POST['sn']}'";
        $db->query($sql) or die($db->error() . $sql);  //判斷資料庫查詢是否為true,若false則傳回error訊息
        $msg = "商品資料更新成功";
    }
    else{
        $sql="INSERT INTO `prods` 
                          (`kind_sn`, `title`, `content`, `price`, `enable`, `date`, `sort`, `counter`)
                     VALUES 
                          ('{$_POST['kind_sn']}', '{$_POST['title']}', '{$_POST['content']}', '{$_POST['price']}', '{$_POST['enable']}', '{$_POST['date']}', '{$_POST['sort']}', '{$_POST['counter']}')"; 
        //die($sql);
        $db->query($sql) or die($db->error() . $sql);  //判斷資料庫查詢是否為true,若false則傳回error訊息
        $sn = $db->insert_id;  //將資料放入資料表對應的ID(這邊是指sn),若沒有則返回0(因為AUTO_INCREMENT會成為第1筆)
        $msg = "商品資料新增成功!"; 
    }

    if ($_FILES['prod']['name']){
        $kind = "prod";
        #刪除舊圖
        # 1.刪除實體檔案
        # 2.刪除files資料表
        delFilesByKindColsnSort($kind,$sn,1);
        
        if ($_FILES['prod']['error'] === UPLOAD_ERR_OK){
            
            $kind = "prod";  //將值圖片的類型(kind)固定設定為prod
            $sub_dir = "/".$kind;  //取得檔案路徑
            $sort = 1; //設定sort為1

            #過濾變數
            $_FILES['prod']['name'] = db_filter($_FILES['prod']['name'], '');
            $_FILES['prod']['type'] = db_filter($_FILES['prod']['type'], '');
            $_FILES['prod']['size'] = db_filter($_FILES['prod']['size'], '');

            #檢查資料目錄
            mk_dir(_WEB_PATH . "/uploads");
            mk_dir(_WEB_PATH . "/uploads" . $sub_dir);
            $path = _WEB_PATH . "/uploads" . $sub_dir . "/";

            # 將圖片進行亂數命名
            $rand = substr(md5(uniqid(mt_rand(), 1)), 0, 5);//取得一個5碼亂數

            # 取得上傳檔案的副檔名
            $ext = pathinfo($_FILES["prod"]["name"], PATHINFO_EXTENSION); 
            $ext = strtolower($ext);//轉小寫

            # 判斷檔案種類
            if ($ext == "jpg" or $ext == "jpeg" or $ext == "png" or $ext == "gif") {
                $file_kind = "img";
            } else {
                $file_kind = "file";
            }  

            # 圖片目錄
            $file_name = $rand ."_". $sn .".".$ext; 

            # 將檔案移至指定位置
            if(move_uploaded_file($_FILES['prod']['tmp_name'], $path . $file_name)){
                $sql="INSERT INTO `files` 
                                  (`kind`, `col_sn`, `sort`, `file_kind`, `file_name`, `file_type`, `file_size`, `description`, `counter`, `name`, `download_name`, `sub_dir`) 
                             VALUES 
                                  ('{$kind}', '{$sn}', '{$sort}', '{$file_kind}', '{$_FILES['prod']['name']}', '{$_FILES['prod']['type']}', '{$_FILES['prod']['size']}', NULL, '0', '{$file_name}', '', '{$sub_dir}')";
                $db->query($sql) or die($db->error() . $sql);  //判斷資料庫查詢是否為true,若false則傳回error訊息
            }
            } 
            else {
                die("檔案上傳失敗!");
            }
        }
    return $msg;
}

/*================================
  取得商品數量的最大值
================================*/
function getProdsMaxSort(){
    global $db;
    $sql = "SELECT count(*)+1 as count
            FROM `prods`";
    //die($sql);
    $result = $db->query($sql) or die($db->error() . $sql);  //判斷資料庫查詢是否為true,若false則傳回error訊息
    $row = $result->fetch_assoc();  //fetch_assoc()將讀到的資料放入對應的key值

    return $row['count'];
  }

function op_form($sn=""){
    global $smarty,$db;

    if($sn){ //判定是否有sn(商品序號),若有則進行商品更新(op_upate),若無則(op_insert)
        $row = getProdsBySn($sn);
        $row['op'] = "op_update";
    }else{
        $row['op'] = "op_insert";
    }
        $row['sn'] = isset($row['sn']) ? $row['sn'] : "";
        $row['kind_sn'] = isset($row['kind_sn']) ? $row['kind_sn'] : "1";
        $row['kind_sn_options'] = getProdsOptions("prod"); //取得(select)商品的類別

        $row['title'] = isset($row['title']) ? $row['title'] : "";
        $row['content'] = isset($row['content']) ? $row['content'] : "";
        $row['price'] = isset($row['price']) ? $row['price'] : "";
        $row['enable'] = isset($row['enable']) ? $row['enable'] : "1";

        $row['date'] = isset($row['date']) ? $row['date'] : strtotime("now");   //取得row[date](=日期),若沒有則利用strtotiem()取得現在時間放入row[date]
        $row['date'] = date("Y-m-d H:i:ss",$row['date']);   //將時間格式轉換為 年/月/日 時/分/秒

        $row['sort'] = isset($row['sort']) ? $row['sort'] : "";
        $row['counter'] = isset($row['counter']) ? $row['counter'] : "";

        $row['prod'] = isset($row['prod']) ? $row['prod'] : ""; //判斷是否有圖片,若沒有圖片則為空值

        $smarty->assign("row",$row);
}

function op_list(){
    global $smarty,$db;

    $sql = "SELECT  a.*,b.title as kinds_title /* 這裡是設定交集資料庫的取得的資料欄位 */
            FROM `prods` as a  /* 將資料庫prods設為a,然後將資料庫kinds設為b,在這裡合成交集資料表*/               
            LEFT JOIN `kinds` as b on a.kind_sn=b.sn /* LEFT JOIN kinds為取得prods與kinds的交集,所以最終呈現會有prod的資料+kinds與prods焦急的資料*/
            ORDER BY a.`date` desc";  /* 按照上架時間進行排序 */
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
    $smarty->assign("bar",$bar);  //放入smarty變數,以便在html呼叫
    #---分頁套件(end)

    while($row=$result->fetch_assoc()){  //fetch_assoc()將讀到的資料放入對應的key值
        #驗證程序
        $row['title'] = htmlspecialchars($row['title']);//標題
        $row['kind_sn'] = (int)$row['kind_sn'];//分類
        $row['price'] = (int)$row['price'];//價格
        $row['enable'] = (int)$row['enable'];//狀態
        $row['counter'] = (int)$row['counter'];//計數
        $row['prod'] = getFilesByKindColsnSort("prod",$row['sn']); //圖片
        $rows[] = $row;
    }
    $smarty -> assign("rows",$rows);
}

/*=======================
刪除函式
=======================*/
function op_delete($sn){
    global $db;

    #刪除舊圖
    # 1.刪除實體檔案
    # 2.刪除files資料表
    delFilesByKindColsnSort("prod",$sn,1);

    # 商品資料表刪除
    $sql="DELETE FROM `prods`
          WHERE `sn` = '{$sn}';";
    $db->query($sql) or die($db->error() . $sql);   //判斷資料庫查詢是否為true,若false則傳回error訊息

    return "會員刪除成功";
}