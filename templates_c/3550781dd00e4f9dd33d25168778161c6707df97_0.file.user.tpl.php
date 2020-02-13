<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-13 08:42:28
  from 'D:\maxyeh\PHP\xampp\htdocs\web11\templates\user.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e44fde419ad54_80675723',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3550781dd00e4f9dd33d25168778161c6707df97' => 
    array (
      0 => 'D:\\maxyeh\\PHP\\xampp\\htdocs\\web11\\templates\\user.tpl',
      1 => 1581579730,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:tpl/admin.tpl' => 1,
    'file:tpl/login_form.tpl' => 1,
    'file:tpl/reg_form.tpl' => 1,
  ),
),false)) {
function content_5e44fde419ad54_80675723 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no"
  />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
bootstrap/bootstrap.min.css" />
  <title>會員管理</title>
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
</head>
<body>
        <?php if ($_smarty_tpl->tpl_vars['redirect']->value) {?>
      <!-- sweetalert2 css-->
      <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['xoAppUrl']->value;?>
class/sweetalert2/sweetalert2.css">

      <!-- sweetalert2 js-->
      <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoAppUrl']->value;?>
class/sweetalert2/sweetalert2.all.min.js"><?php echo '</script'; ?>
>
      <?php echo '<script'; ?>
>
      window.onload = function(){
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: "<?php echo $_smarty_tpl->tpl_vars['message']->value;?>
",
            showConfirmButton: false,
            timer: <?php echo $_smarty_tpl->tpl_vars['time']->value;?>

        })
      }
      <?php echo '</script'; ?>
>
    <?php }?>

    <?php if ($_SESSION['admin']) {?>
            <?php $_smarty_tpl->_subTemplateRender("file:tpl/admin.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php } else { ?>
            <?php if ($_smarty_tpl->tpl_vars['op']->value == "login_form") {?>
        <?php $_smarty_tpl->_subTemplateRender("file:tpl/login_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
      <?php } elseif ($_smarty_tpl->tpl_vars['op']->value == "reg_form") {?>
        <?php $_smarty_tpl->_subTemplateRender("file:tpl/reg_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
      <?php }?>
    <?php }?>
</body>
</html><?php }
}
