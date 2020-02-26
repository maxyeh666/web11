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

  case "op_delete" :
    $msg = op_delete($sn);
    redirect_header("user.php", $msg, 3000);
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

    }
    else{
        $sql="INSERT INTO `prods` 
            (`kind_sn`, `title`, `content`, `price`, `enable`, `date`, `sort`, `counter`)
            VALUES 
            ('{$_POST['kind_sn']}', '{$_POST['title']}', '{$_POST['content']}', '{$_POST['price']}', '{$_POST['enable']}', '{$_POST['date']}', '{$_POST['sort']}', '{$_POST['counter']}')    
            "; //die($sql);
        $db->query($sql) or die($db->error() . $sql);
        $sn = $db->insert_id;
        $msg = "商品資料新增成功!"; 
    }

    if ($_FILES['prod']['name']){
        if ($_FILES['prod']['error'] === UPLOAD_ERR_OK){
            
            $kind = "prod";
            $sub_dir = "/".$kind;
            $sort = 1;

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
                $db->query($sql) or die($db->error() . $sql);
            }
            } 
            else {
                die("檔案上傳失敗!");
            }
        }
    return $msg;
}

function getFilesByKindColsnSort($kind,$col_sn,$sort=1,$url=true){
    global $db; 
    $sql="SELECT *
        FROM `files`
        WHERE `kind` = '{$kind}' AND `col_sn` = '{$col_sn}' AND `sort` = '{$sort}'
    ";     
    $result = $db->query($sql) or die($db->error() . $sql);
    $row = $result->fetch_assoc();
    if($url){
        $file_name = _WEB_URL . "/uploads" . $row['sub_dir'] . "/" . $row['name'];
    }else{
        $file_name = _WEB_PATH . "/uploads" . $row['sub_dir'] . "/" . $row['name'];
    }
    return $file_name;
}

function op_form($sn=""){
    global $smarty,$db;

    if($sn){
    $sql="SELECT *
          FROM `prods`
          WHERE `sn` = '{$sn}'
    ";//die($sql);
    
    $result = $db->query($sql) or die($db->error() . $sql);
    $row = $result->fetch_assoc(); 
    $row['op']="op_update";
    $row['prod'] = getFilesByKindColsnSort("prod",$sn);
    }
    else{
    $row['op']="op_insert";
    $row['prod'] = "";
    }
    $row['sn'] = isset($row['sn']) ? $row['sn'] : "";
    $row['kind_sn'] = isset($row['kind_sn']) ? $row['kind_sn'] : "1";
    $row['title'] = isset($row['title']) ? $row['title'] : "";
    $row['content'] = isset($row['content']) ? $row['content'] : "";
    $row['price'] = isset($row['price']) ? $row['price'] : "";
    $row['enable'] = isset($row['enable']) ? $row['enable'] : "1";
    $row['date'] = isset($row['date']) ? date("Y-m-d H:i:s",strtotime($row['date'])) : date("Y-m-d H:i:s",strtotime("now")); //strtotime()取得時間(秒數),用date重新更改格式
    $row['sort'] = isset($row['sort']) ? $row['sort'] : "";
    $row['counter'] = isset($row['counter']) ? $row['counter'] : "";

    $smarty->assign("row",$row);
}

function op_list(){
    global $smarty,$db;

  $sql = "SELECT * FROM `prods`";

    $result = $db->query($sql) or die($db->error() . $sql);
    $rows = [];
    while($row=$result->fetch_assoc()){

    #驗證程序
    $row['title'] = htmlspecialchars($row['title']);//標題
    $row['kind_sn'] = (int)$row['kind_sn'];//分類
    $row['price'] = (int)$row['price'];//價格
    $row['enable'] = (int)$row['enable'];//狀態
    $row['counter'] = (int)$row['counter'];//計數
    $rows[] = $row;
    }
    $smarty -> assign("rows",$rows);
}

/*=======================
刪除會員函式
=======================*/
function op_delete($sn){
    global $db;
    $sql="DELETE FROM `prods`
          WHERE `sn` = '{$sn}';
    ";
    $db->query($sql) or die($db->error() . $sql);
    return "會員刪除成功";
}