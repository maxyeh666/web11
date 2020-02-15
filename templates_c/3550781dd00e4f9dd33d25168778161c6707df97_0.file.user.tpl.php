<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-15 04:06:17
  from 'D:\maxyeh\PHP\xampp\htdocs\web11\templates\user.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e476029212fb1_00836218',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3550781dd00e4f9dd33d25168778161c6707df97' => 
    array (
      0 => 'D:\\maxyeh\\PHP\\xampp\\htdocs\\web11\\templates\\user.tpl',
      1 => 1581735969,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:tpl/head_js.tpl' => 1,
    'file:tpl/redirect.tpl' => 1,
  ),
),false)) {
function content_5e476029212fb1_00836218 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
<meta charset="utf-8" />
<meta
  name="viewport"
  content="width=device-width, initial-scale=1, shrink-to-fit=no"
/>  

<!-- bootstrap css -->
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
bootstrap/bootstrap.min.css">

<title>會員管理</title>
<?php $_smarty_tpl->_subTemplateRender("file:tpl/head_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</head>
<body>
    <?php $_smarty_tpl->_subTemplateRender("file:tpl/redirect.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>



  <h1 class = "text-center mt-2">管理員後台</h1>
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
  </div>
</body>
</html><?php }
}
