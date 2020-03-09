<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-09 13:18:01
  from 'D:\maxyeh\PHP\xampp\htdocs\web11\templates\tpl\head.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e65d1892f0f87_84629392',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd3a198afb22049caf54c23f0f92fe72213bed86f' => 
    array (
      0 => 'D:\\maxyeh\\PHP\\xampp\\htdocs\\web11\\templates\\tpl\\head.tpl',
      1 => 1583731045,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e65d1892f0f87_84629392 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- 標頭導覽列 -->


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" style="background-color: rgb(192, 103, 19);opacity: 70%;" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php#page-top">Start Bootstrap</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
            <!-- 利用迴圈將選單從選單資料庫找出並顯示出來 -->
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['mainMenus']->value, 'mainMenu');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['mainMenu']->value) {
?> 
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="<?php echo $_smarty_tpl->tpl_vars['mainMenu']->value['url'];?>
" <?php if ($_smarty_tpl->tpl_vars['mainMenu']->value['target'] == 1) {?> target="_blank" <?php }?>><?php echo $_smarty_tpl->tpl_vars['mainMenu']->value['title'];?>
</a>
                </li>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

            <?php if ($_SESSION['cartAmount'] && $_smarty_tpl->tpl_vars['op']->value != "op_form") {?>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="cart.php?op=order_form"><i class="fas fa-shopping-cart"></i></a>
                </li>
            <?php }?>

            <!-- 判斷是否為管理員,並顯示為管理員或一般會員 -->
            <?php if ($_SESSION['user']['kind'] === 1) {?>
                                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="user.php"">管理員</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="index.php?op=logout">登出</a>
                </li>
            <?php } elseif ($_SESSION['user']['kind'] === 0) {?>
                                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="index.php?op=logout">登出</a>
                </li>
            <?php } else { ?>
                                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="index.php?op=login_form">登入</a>
                </li>
            <?php }?>
        </ul>
        </div>
    </div>
</nav><?php }
}
