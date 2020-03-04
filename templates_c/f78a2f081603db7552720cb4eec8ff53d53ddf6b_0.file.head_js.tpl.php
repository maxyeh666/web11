<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-04 16:38:24
  from 'E:\xampp\htdocs\web11\templates\tpl\head_js.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e5fcb70f09962_91605133',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f78a2f081603db7552720cb4eec8ff53d53ddf6b' => 
    array (
      0 => 'E:\\xampp\\htdocs\\web11\\templates\\tpl\\head_js.tpl',
      1 => 1583335059,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e5fcb70f09962_91605133 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- 引入外部的程式、CSS -->


<!-- Bootstrap core JavaScript -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
vendor/jquery/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
vendor/bootstrap/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>

<!-- Plugin JavaScript -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
vendor/jquery-easing/jquery.easing.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
vendor/magnific-popup/jquery.magnific-popup.min.js"><?php echo '</script'; ?>
><?php }
}
