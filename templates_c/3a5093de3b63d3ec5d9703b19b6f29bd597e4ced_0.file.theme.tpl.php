<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-04 16:36:55
  from 'D:\maxyeh\PHP\xampp\htdocs\web11\templates\theme.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e5f68a74534f8_19755556',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3a5093de3b63d3ec5d9703b19b6f29bd597e4ced' => 
    array (
      0 => 'D:\\maxyeh\\PHP\\xampp\\htdocs\\web11\\templates\\theme.tpl',
      1 => 1583311011,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:tpl/head_js.tpl' => 1,
    'file:tpl/redirect.tpl' => 1,
    'file:tpl/head.tpl' => 1,
    'file:tpl/index.tpl' => 1,
    'file:tpl/cart.tpl' => 1,
    'file:tpl/footer.tpl' => 1,
  ),
),false)) {
function content_5e5f68a74534f8_19755556 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- 主面板基礎架構,判斷是否需要轉頁 -->


<!-- Font Awesome Icons -->
<link href="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

<!-- Plugin CSS -->
<link href="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

<!-- Theme CSS - Includes Bootstrap -->
<link href="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
css/creative.min.css" rel="stylesheet">



<?php $_smarty_tpl->_subTemplateRender("file:tpl/head_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->_subTemplateRender("file:tpl/redirect.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->_subTemplateRender("file:tpl/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php if ($_smarty_tpl->tpl_vars['WEB']->value['file_name'] == "index.php") {?>
  <?php $_smarty_tpl->_subTemplateRender("file:tpl/index.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} elseif ($_smarty_tpl->tpl_vars['WEB']->value['file_name'] == "cart.php") {?>
  <?php $_smarty_tpl->_subTemplateRender("file:tpl/cart.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>

<?php $_smarty_tpl->_subTemplateRender("file:tpl/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php if ($_SESSION['cartAmount']) {?>
<!-- 購物車圖示樣式 -->
<style>
  .fab-fixed-wrap .fab {
    display: block;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    color: white;
    background-color: #0c9;
    text-align: center;
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.16);
    text-decoration: none;
    display: flex;
    line-height: 1.2;
    align-items: center;
    justify-content: center;
  }
  .fab-fixed-wrap .fab.fab-facebook {
    background-color: darkcyan;
  }
  .fab-fixed-wrap .fab.fab-line {
    background-color: #0b0;
  }
  .count {
    width: 30px;
    height: 30px;
    position: absolute;
    border-radius: 50%;
    transform: scale(.7);
    transform-origin: top right;
    top: 0;
    right: 0;
    color: white;
    background:red;
  }
</style>

<!-- 購物車html -->
<div class="fab-fixed-wrap with-navbar-bottom" style="bottom: 4.6875rem;position: fixed;z-index: 1035;right: .9375rem;bottom: .9375rem;">
    <a href="cart.php?op=order_form" class="fab fab-facebook mp-click" data-toggle="tooltip" title="您選了<?php echo $_SESSION['cartAmount'];?>
個商品" >
      <i class="fas fa-shopping-cart"></i>
      <span class="count"><?php echo $_SESSION['cartAmount'];?>
</span> 
    </a>
</div>
<?php }?>

<!-- 小提示呼叫函式 -->
<?php echo '<script'; ?>
>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
<?php echo '</script'; ?>
>

<!-- Custom scripts for this template -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
js/creative.min.js"><?php echo '</script'; ?>
><?php }
}
