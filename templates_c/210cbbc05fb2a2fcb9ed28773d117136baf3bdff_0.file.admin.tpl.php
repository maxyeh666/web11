<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-14 15:20:16
  from 'E:\xampp\htdocs\web11\templates\tpl\admin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e46aca00c7ad5_92978472',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '210cbbc05fb2a2fcb9ed28773d117136baf3bdff' => 
    array (
      0 => 'E:\\xampp\\htdocs\\web11\\templates\\tpl\\admin.tpl',
      1 => 1581685844,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e46aca00c7ad5_92978472 (Smarty_Internal_Template $_smarty_tpl) {
?><h1 class = "text-center mt-2">管理員後台</h1>
<div class="container">
    <div class="row">
        <div class="col-sm-9">

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
                        <a href="user.php?op=logout" class="btn-block">登出</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div><?php }
}
