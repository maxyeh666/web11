<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-14 14:14:13
  from 'E:\xampp\htdocs\web11\templates\tpl\head.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e469d251932c8_38091968',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '200ca31af1668be9a15ca8b0b97a5e77b986e55e' => 
    array (
      0 => 'E:\\xampp\\htdocs\\web11\\templates\\tpl\\head.tpl',
      1 => 1581685951,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e469d251932c8_38091968 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" style="background-color: rgb(192, 103, 19);opacity: 70%;" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php#page-top">Start Bootstrap</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index.php#about">關於我們</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index.php#services">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index.php#portfolio">Portfolio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index.php#contact">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index.php?op=contact_form">聯絡我們</a>
            </li>

            <?php if ($_SESSION['admin']) {?>
                                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="user.php"">管理員</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="user.php?op=logout">登出</a>
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
