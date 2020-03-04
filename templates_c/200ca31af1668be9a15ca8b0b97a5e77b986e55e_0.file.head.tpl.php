<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-04 16:38:25
  from 'E:\xampp\htdocs\web11\templates\tpl\head.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e5fcb7115fbd0_45575837',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '200ca31af1668be9a15ca8b0b97a5e77b986e55e' => 
    array (
      0 => 'E:\\xampp\\htdocs\\web11\\templates\\tpl\\head.tpl',
      1 => 1583335059,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e5fcb7115fbd0_45575837 (Smarty_Internal_Template $_smarty_tpl) {
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
