<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-03 14:29:47
  from 'D:\maxyeh\PHP\xampp\htdocs\web11\templates\tpl\redirect.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e5df95ba4f778_19787545',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd2f1b1c9814c50f0c94bac7df5292bca4f6ec8a' => 
    array (
      0 => 'D:\\maxyeh\\PHP\\xampp\\htdocs\\web11\\templates\\tpl\\redirect.tpl',
      1 => 1583216037,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e5df95ba4f778_19787545 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- 轉向面板控制 -->


<?php if ($_smarty_tpl->tpl_vars['redirect']->value) {?>
<!-- sweetalert2 -->
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['xoAppUrl']->value;?>
class/sweetalert2/sweetalert2.css">
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
<?php }
}
}
