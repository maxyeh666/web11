<?php
/* 引入檔頭，每支程都會引入 */
require_once 'head.php';

#權限檢查
if($_SESSION['user']['kind'] !== 1)redirect_header("index.php", '您沒有權限', 3000);

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'op_list', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');
$kind = system_CleanVars($_REQUEST, 'kind', 'mainSlide', 'string');
$kind = "mainSlide";
// die($op);

/* 程式流程 */
switch ($op){
    case "op_form" :
        $msg = op_form($kind,$sn);
        break;

    case "op_insert" :
        $msg = op_insert($kind);
        redirect_header("slide.php?kind={$kind}", $msg, 3000);
        exit;

    case "op_update" :
        $msg = op_insert($kind,$sn);
        redirect_header("slide.php", $msg, 3000);
        exit;

    case "op_delete" :
        $msg = op_delete($kind,$sn);
        redirect_header("slide.php?kind={$kind}", $msg, 3000);
        exit;

    default:
        $op = "op_list";
        op_list($kind);
        break;  
}

/*---- 將變數送至樣版----*/
$smarty->assign("WEB", $WEB);
$smarty->assign("op", $op);

/*---- 程式結尾-----*/
$smarty->display('admin.tpl');

/*---- 函數區-----*/
function op_insert($kind,$sn=""){
    global $db; 

    //資料過濾
    $_POST['sn'] = db_filter($_POST['sn'], '');//流水號
    $_POST['title'] = db_filter($_POST['title'], '標題');//標題
    $_POST['kind'] = db_filter($_POST['kind'], '');//分類
    $_POST['enable'] = db_filter($_POST['enable'], '');//狀態
    $_POST['sort'] = db_filter($_POST['sort'], '');//排序
    $_POST['url'] = db_filter($_POST['url'], '');//網址
    $_POST['target'] = db_filter($_POST['target'], '');//外部連接

    if($sn){
        $sql="UPDATE  `kinds` SET
                      `title` = '{$_POST['title']}',
                      `enable` = '{$_POST['enable']}',
                      `sort` = '{$_POST['sort']}',
                      `kind` = '{$_POST['kind']}',
                      `url` = '{$_POST['url']}',
                      `target` = '{$_POST['target']}'
              WHERE `sn` = '{$_POST['sn']}'";
        $db->query($sql) or die($db->error() . $sql);  //判斷資料庫查詢是否為true,若false則傳回error訊息
        $msg = "輪播圖資料更新成功";
      }else{
        $sql="INSERT INTO `kinds` 
                          (`title`, `enable`, `sort`, `kind`, `url`, `target`)
                     VALUES 
                          ( '{$_POST['title']}', '{$_POST['enable']}', '{$_POST['sort']}', '{$_POST['kind']}', '{$_POST['url']}', '{$_POST['target']}')";
        //die($sql);
        $db->query($sql) or die($db->error() . $sql); //判斷資料庫查詢是否為true,若false則傳回error訊息
        $sn = $db->insert_id;  //將資料放入資料表對應的ID(這邊是指sn),若沒有則返回0(因為AUTO_INCREMENT會成為第1筆)
        $msg = "輪播圖資料新增成功"; 
    }

    if($_FILES['pic']['name']){
        #刪除舊圖
        # 1.刪除實體檔案
        # 2.刪除files資料表
        delFilesByKindColsnSort($kind,$sn,1);
        
        if ($_FILES['pic']['error'] === UPLOAD_ERR_OK){  //若圖片上傳成功(由UPLOAD_ERR_OK判定)
            
            $sub_dir = "/".$kind;
            $sort = 1;

            #過濾變數
            $_FILES['pic']['name'] = db_filter($_FILES['pic']['name'], '');
            $_FILES['pic']['type'] = db_filter($_FILES['pic']['type'], '');
            $_FILES['pic']['size'] = db_filter($_FILES['pic']['size'], '');
            #檢查資料目錄
            mk_dir(_WEB_PATH . "/uploads");
            mk_dir(_WEB_PATH . "/uploads" . $sub_dir);
            $path = _WEB_PATH . "/uploads" . $sub_dir . "/";  //設定圖片路徑
            #圖片名稱
            $rand = substr(md5(uniqid(mt_rand(), 1)), 0, 5);//取得一個5碼亂數
            
            #//取得上傳檔案的副檔名
            $ext = pathinfo($_FILES["pic"]["name"], PATHINFO_EXTENSION); 
            $ext = strtolower($ext);//轉小寫
            
            //判斷檔案種類
            if ($ext == "jpg" or $ext == "jpeg" or $ext == "png" or $ext == "gif") {
                $file_kind = "img";
            } else {
                $file_kind = "file";
            }     
    
            $file_name = $rand . "_" . $sn . "." . $ext; 
            #圖片目錄
    
            # 將檔案移至指定位置
            if(move_uploaded_file($_FILES['pic']['tmp_name'], $path . $file_name)){
                $sql="INSERT INTO `files` 
                                  (`kind`, `col_sn`, `sort`, `file_kind`, `file_name`, `file_type`, `file_size`, `description`, `counter`, `name`, `download_name`, `sub_dir`) 
                                  VALUES 
                                  ('{$kind}', '{$sn}', '{$sort}', '{$file_kind}', '{$_FILES['pic']['name']}', '{$_FILES['pic']['type']}', '{$_FILES['pic']['size']}', NULL, '0', '{$file_name}', '', '{$sub_dir}')";
                $db->query($sql) or die($db->error() . $sql); //判斷資料庫查詢是否為true,若false則傳回error訊息
            }
        } else {
            die("圖片上傳失敗");
        }
    }
    return $msg;
}

/*===========================
  用sn取得商品檔資料
===========================*/
function getKindsBySn($sn){
    global $db,$kind;

    $sql="SELECT *
          FROM `kinds`
          WHERE `sn` = '{$sn}'";
    //die($sql);
    $result = $db->query($sql) or die($db->error() . $sql); //判斷資料庫查詢是否為true,若false則傳回error訊息
    $row = $result->fetch_assoc();  //fetch_assoc()將讀到的資料放入對應的key值

    $row['pic'] = getFilesByKindColsnSort($kind,$sn);

    return $row;
}

/*================================
  用kind 取得數量的最大值
================================*/
function getKindMaxSortByKind($kind){
    global $db;

    $sql = "SELECT count(*)+1 as count
            FROM `kinds`
            WHERE `kind`='{$kind}'";
    //die($sql);
    $result = $db->query($sql) or die($db->error() . $sql); //判斷資料庫查詢是否為true,若false則傳回error訊息
    $row = $result->fetch_assoc();  //fetch_assoc()將讀到的資料放入對應的key值

    return $row['count'];
}

function op_form($kind,$sn=""){
    global $smarty,$db;

    if($sn){
        $row = getKindsBySn($sn);
        $row['op'] = "op_update";
    }else{
        $row['op'] = "op_insert";
    }
        $row['sn'] = isset($row['sn']) ? $row['sn'] : "";
        $row['kind'] = isset($row['kind']) ? $row['kind'] : $kind;
        $row['title'] = isset($row['title']) ? $row['title'] : "";
        $row['enable'] = isset($row['enable']) ? $row['enable'] : "1";
        $row['url'] = isset($row['url']) ? $row['url'] : "";
        $row['target'] = isset($row['target']) ? $row['target'] : "0";
        $row['sort'] = isset($row['sort']) ? $row['sort'] : getKindMaxSortByKind($kind);
        $row['pic'] = isset($row['pic']) ? $row['pic'] : "";

        $smarty->assign("row",$row);
}

function op_list($kind){
    global $smarty,$db;

    $sql = "SELECT *
            FROM `kinds`
            WHERE `kind`='{$kind}'
            ORDER BY `sort`";
    //die($sql);
    $result = $db->query($sql) or die($db->error() . $sql);  //判斷資料庫查詢是否為true,若false則傳回error訊息
    $rows=[];

    while($row = $result->fetch_assoc()){   //fetch_assoc()將讀到的資料放入對應的key值
        #驗證
        $row['sn'] = (int)$row['sn'];//流水號
        $row['title'] = htmlspecialchars($row['title']);//標題
        $row['enable'] = (int)$row['enable'];//狀態 
        $row['url'] = htmlspecialchars($row['url']);//網址
        $row['target'] = (int)$row['target'];//外部連接
        $row['pic'] = getFilesByKindColsnSort($kind,$row['sn']); //圖片
        $rows[] = $row;
    }
    $smarty->assign("rows",$rows);
    $smarty->assign("kind",$kind);
    // print_r($rows);die();
}

/*=======================
刪除函式
=======================*/
function op_delete($kind,$sn){
    global $db;

    delFilesByKindColsnSort($kind,$sn,1);

    $sql="DELETE FROM `kinds`
          WHERE `sn` = '{$sn}'";
    $db->query($sql) or die($db->error() . $sql); //判斷資料庫查詢是否為true,若false則傳回error訊息

    return "輪播圖刪除成功";
}