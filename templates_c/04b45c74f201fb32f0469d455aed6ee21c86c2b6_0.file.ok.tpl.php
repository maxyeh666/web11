<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-14 04:33:42
  from 'D:\maxyeh\PHP\xampp\htdocs\web11\templates\ok.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e461516616013_65823740',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '04b45c74f201fb32f0469d455aed6ee21c86c2b6' => 
    array (
      0 => 'D:\\maxyeh\\PHP\\xampp\\htdocs\\web11\\templates\\ok.tpl',
      1 => 1581651219,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e461516616013_65823740 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
bootstrap/bootstrap.min.css">

    <title>點餐成功</title>
</head>
<body>
    <div class="container mt-3 ">
        <div class="jumbotron">
            <h1 class="display-4 text-center">點餐成功</h1>
            <p class="lead text-center">請耐心等待廚房製作</p>
            <hr class="my-4">
            <p class="text-center">連絡電話:334-5678</p>
            <a class="btn btn-success btn-block" href="user.php" role="button">繼續點餐</a>
            <botton class="btn btn-primary btn-block" onclick="window.close()" role="button">關閉視窗</botton>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
js/jquery-3.4.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
js/popper.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
bootstrap/bootstrap.min.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
