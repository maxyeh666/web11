<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-03 14:09:41
  from 'D:\maxyeh\PHP\xampp\htdocs\web11\templates\tpl\head_js.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e5df4a5b20e18_51394300',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '53ee31aa899987115840e49f3fdcb1d93ca65eb4' => 
    array (
      0 => 'D:\\maxyeh\\PHP\\xampp\\htdocs\\web11\\templates\\tpl\\head_js.tpl',
      1 => 1583215102,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e5df4a5b20e18_51394300 (Smarty_Internal_Template $_smarty_tpl) {
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
