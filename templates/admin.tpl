
<!-- 後臺管理面板 -->


<!-- bootstrap css -->
<link rel="stylesheet" href="<{$xoImgUrl}>bootstrap/bootstrap.min.css">

<{* 引入外部程式、css *}>
<{* head_js.tpl *}>
<{include file = "tpl/head_js.tpl"}>

<{* 面板轉向顯示控制 *}>
<{include file="tpl/redirect.tpl"}>

<h1 class = "text-center mt-2">管理員後台</h1>
<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <!-- 主要管理頁面所要出現的面板 -->
            <{if $WEB.file_name == "user.php"}>
                <{include file="tpl/user.tpl"}>
            <{elseif $WEB.file_name == "prod.php"}>
                <{include file="tpl/prod.tpl"}>
            <{elseif  $WEB.file_name == "kind.php"}>
                <{include file="tpl/kind.tpl"}> 
            <{elseif  $WEB.file_name == "menu.php"}>
                <{include file="tpl/menu.tpl"}> 
            <{elseif  $WEB.file_name == "slide.php"}>
                <{include file="tpl/slide.tpl"}> 
            <{/if}>
        </div>
        <div class="col-sm-3">
            <button type="button" class="btn btn-primary">
                管理員控制項目
                <span class="badge badge-warning">!</span>
            </button>
            <div class="card" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    
                    <li class="list-group-item">
                        <a href="index.php">返回首頁</a>
                    </li>
                    <li class="list-group-item">
                        <a href="../../adminer/adminer.php" target="_blank">資料庫介面</a>
                    </li>
                    <li class="list-group-item">
                        <a href="prod.php" class="btn-block">商品管理</a>
                    </li>
                    <li class="list-group-item">
                        <a href="user.php" class="btn-block">會員管理</a>
                    </li>
                    <li class="list-group-item">
                        <a href="kind.php" class="btn-block">類別管理</a>
                    </li>
                    <li class="list-group-item">
                        <a href="menu.php" class="btn-block">選單管理</a>
                    </li>
                    <li class="list-group-item">
                        <a href="slide.php" class="btn-block">輪播圖管理</a>
                        </li>
                    <li class="list-group-item">
                        <a href="index.php?op=logout" class="btn-block">登出</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>