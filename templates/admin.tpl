<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
<meta charset="utf-8" />
<meta
  name="viewport"
  content="width=device-width, initial-scale=1, shrink-to-fit=no"
/>  

<!-- bootstrap css -->
<link rel="stylesheet" href="<{$xoImgUrl}>bootstrap/bootstrap.min.css">

<title>會員管理</title>
<{* head_js.tpl *}>
<{include file = "tpl/head_js.tpl"}>
</head>
<body>
<{* 轉向 *}>
<{include file="tpl/redirect.tpl"}>

<h1 class = "text-center mt-2">管理員後台</h1>
<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <{if $WEB.file_name == "user.php"}>
                <{include file="tpl/user.tpl"}>
            <{/if}>
        </div>
        <div class="col-sm-3">
            <button type="button" class="btn btn-primary">
                管理員控制項目
                <span class="badge badge-light">!</span>
            </button>
            <div class="card" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    
                    <li class="list-group-item">
                        <a href="index.php">返回首頁</a>
                    </li>
                    <li class="list-group-item">
                        <a href="http://localhost/adminer/adminer.php" target="_blank">資料庫介面</a>
                    </li>
                    <li class="list-group-item">
                        <a href="index.php?op=logout" class="btn-block">登出</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>