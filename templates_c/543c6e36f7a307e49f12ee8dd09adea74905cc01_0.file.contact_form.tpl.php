<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-14 14:23:48
  from 'E:\xampp\htdocs\web11\templates\tpl\contact_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e469f64b8f837_88664222',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '543c6e36f7a307e49f12ee8dd09adea74905cc01' => 
    array (
      0 => 'E:\\xampp\\htdocs\\web11\\templates\\tpl\\contact_form.tpl',
      1 => 1581685951,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e469f64b8f837_88664222 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container" style = "margin-top: 70px;">
    <h1 class="text-center text-primary">聯絡我們</h1>
    <div class="container">
            <form role="form" action="https://docs.google.com/forms/u/0/d/e/1FAIpQLSe3kGZAbN_tHIfObGRYd0O_SdyzaQQrg9MtGYSIT-ld7YA16A/formResponse" method="post" id="myForm" target='returnWin'>
                <div class="row">
                    <!--姓名-->              
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>
                                <span class="title">姓名</span>
                                <span class="text-danger">(必填)</span>
                            </label>
                            <input type="text"" class="form-control counter" name="entry.555373541" id="name">
                        </div>
                    </div>          
                    <!--Email-->              
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>
                                <span class="title">Email</span>
                                <span class="text-danger">(必填)</span>
                            </label>
                            <input type="text" class="form-control counter" name="entry.285928257" id="email">
                        </div>
                    </div>          
                    <!--連絡電話-->              
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>
                                <span class="title">連絡電話</span>
                                <span class="text-danger">(必填)</span>
                            </label>
                            <input type="text" class="form-control counter" name="entry.490717089" id="tel">
                        </div>
                    </div>          
                    <!--聯絡內容-->              
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>
                                <span class="title">聯絡內容</span>
                                <span class="text-danger">(必填)</span>
                            </label>
                            <textarea class="form-control" rows="4" id="441469136" name="entry.441469136"></textarea>
                        </div>
                    </div> 
                </div> 
                <div class="text-center pb-3">
                    <button type="submit" class="btn btn-primary">送出</button>
                </div>
            </form>
        <iframe name="returnWin" style="display: none;" onload="this.onload=function(){window.location='index.php?op=ok'}">
        </iframe>
    </div>
<!-- 表單驗證 -->
<style>
.error{
    color: red;
}
</style>
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"><?php echo '</script'; ?>
>
<!-- 調用函式 -->
<?php echo '<script'; ?>
>
    $(function(){
    $("#myForm").validate({
        submitHandler: function(form) {
        form.submit();
        },
        rules: {
        "entry.555373541" : {
            required: true
        },        
        "entry.285928257" : {
            required: true,
            email : true
        },
        "entry.490717089" : {
            required: true
        },
        "entry.441469136" : {
            required: true
        }
        },

        messages: {
        "entry.555373541" : {
            required: "請輸入姓名"
        },
        "entry.285928257" : {
            required: "請輸入Email",
            email : "email格式不正確"
        },
        "entry.490717089" : {
            required : "請輸入電話"
        },
        "entry.441469136" : {
            required: "請輸入聯絡事項"
        }
        }
    });
    });
<?php echo '</script'; ?>
>
</div><?php }
}
