<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-26 03:32:45
  from 'D:\maxyeh\PHP\xampp\htdocs\web11\templates\tpl\reg_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e55d8cd3e1ce3_90042823',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0be7b9d09288c2dda303b468f51d9ff6edcf33f6' => 
    array (
      0 => 'D:\\maxyeh\\PHP\\xampp\\htdocs\\web11\\templates\\tpl\\reg_form.tpl',
      1 => 1582095583,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e55d8cd3e1ce3_90042823 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container" style="margin-top: 70px;">
    <h1 class="text-center text-primary">註冊表單</h1>
    
    <form action="index.php" method="post" id="myForm" class="mb-2" enctype="multipart/form-data">
    
    <div class="row">
        <!--帳號-->              
        <div class="col-sm-4">
            <div class="form-group">
            <label>帳號<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="uname" id="uname" value="">
            </div>
        </div>         
    </div>         
    <div class="row">
        <!--密碼-->              
        <div class="col-sm-4">
            <div class="form-group">
            <label>密碼<span class="text-danger">*</span class="text-danger"></label>
            <input type="password" class="form-control" name="pass" id="pass" value="">
            </div>
        </div>         
        <!--確認密碼-->              
        <div class="col-sm-4">
            <div class="form-group">
            <label>確認密碼<span class="text-danger">*</span class="text-danger"></label>
            <input type="password" class="form-control" name="chk_pass" id="chk_pass" value="">
            </div>
        </div>
    </div>
    <div class="row">
        <!--姓名-->              
        <div class="col-sm-4">
            <div class="form-group">
            <label>姓名<span class="text-danger">*</span class="text-danger"></label>
            <input type="text" class="form-control" name="name" id="name" value="">
            </div>
        </div>         
        <!--電話-->              
        <div class="col-sm-4">
            <div class="form-group">
            <label>電話<span class="text-danger">*</span class="text-danger"></label>
            <input type="text" class="form-control" name="tel" id="tel" value="">
            </div>
        </div>             
        <!--信箱-->              
        <div class="col-sm-4">
            <div class="form-group">
            <label>信箱<span class="text-danger">*</span class="text-danger"></label>
            <input type="text" class="form-control" name="email" id="email" value="">
            </div>
        </div> 
    </div>
    <div class="text-center pb-20">
        <input type="hidden" name="op" value="reg">
        <button type="submit" class="btn btn-primary">送出</button>
    </div>
    </form>
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
            'uname' : {
                required: true
            },
            'pass' : {
                required: true
            },
            'chk_pass' : {
                equalTo:"#pass"
            },
            'name' : {
                required: true
            },
            'tel' : {
                required: true
            },
            'email' : {
                required: true,
                email : true
            }
            },
            messages: {
            'uname' : {
                required: "必填"
            },
            'pass' : {
                required: "必填"
            },
            'chk_pass' : {
                equalTo:"密碼不一致"
            },
            'name' : {
                required : "必填"
            },
            'tel' : {
                required: "必填"
            },
            'email' : {
                required: "必填",
                email : "email格式不正確"
            }
            }
        });
        });
    <?php echo '</script'; ?>
>
</div>
<?php }
}
