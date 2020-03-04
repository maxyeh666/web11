<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-04 16:38:25
  from 'E:\xampp\htdocs\web11\templates\tpl\redirect.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e5fcb71025e65_07090158',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'de4697807ac2aa1c9a3012759f60d006e23f5567' => 
    array (
      0 => 'E:\\xampp\\htdocs\\web11\\templates\\tpl\\redirect.tpl',
      1 => 1583335059,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e5fcb71025e65_07090158 (Smarty_Internal_Template $_smarty_tpl) {
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
