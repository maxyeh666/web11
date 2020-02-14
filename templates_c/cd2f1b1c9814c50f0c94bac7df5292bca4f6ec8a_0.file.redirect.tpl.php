<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-14 09:41:47
  from 'D:\maxyeh\PHP\xampp\htdocs\web11\templates\tpl\redirect.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e465d4bf0d134_41374300',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd2f1b1c9814c50f0c94bac7df5292bca4f6ec8a' => 
    array (
      0 => 'D:\\maxyeh\\PHP\\xampp\\htdocs\\web11\\templates\\tpl\\redirect.tpl',
      1 => 1581669687,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e465d4bf0d134_41374300 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['redirect']->value) {?>
<!-- sweetalert2 -->
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['xoAppUrl']->value;?>
class/sweetalert2/sweetalert2.min.css">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoAppUrl']->value;?>
class/sweetalert2/sweetalert2.min.js"><?php echo '</script'; ?>
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
