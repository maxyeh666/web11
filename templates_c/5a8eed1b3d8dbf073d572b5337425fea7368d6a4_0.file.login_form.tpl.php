<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-13 09:57:51
  from 'D:\maxyeh\PHP\xampp\htdocs\web11\templates\tpl\login_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e450f8fb0dbf1_58960447',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5a8eed1b3d8dbf073d572b5337425fea7368d6a4' => 
    array (
      0 => 'D:\\maxyeh\\PHP\\xampp\\htdocs\\web11\\templates\\tpl\\login_form.tpl',
      1 => 1581584063,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e450f8fb0dbf1_58960447 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
    .form-signin {
      width: 100%;
      max-width: 400px;
      padding: 15px;
      margin: 0 auto;
    }
  </style>
<div class="container mt-5">
    <form class="form-signin" action="user.php" method="post">
        <h1 class="h3 mb-3 font-weight-normal">會員登入</h1>
        <div class="mb-3">
        <label for="name" class="sr-only">帳號</label>
        <input
            type="text"
            name="name"
            id="name"
            class="form-control"
            placeholder="請輸入帳號"
            required
        />
    </div>
    <div class="mb-3">
        <label for="pass" class="sr-only">密碼</label>
        <input
            type="password"
            name="pass"
            id="pass"
            class="form-control"
            placeholder="請輸入密碼"
            required
        />
    </div>

    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" name="remember" id="remember" /> 記住我
        </label>
    </div>
    <input type="hidden" name="op" id="op" value="login">
    <button class="btn btn-lg btn-primary btn-block" type="submit">
        會員登入
    </button>
    <div>您還沒還沒註冊嗎？請 <a href="user.php?op=reg_form">點選此處註冊您的新帳號</a>。</div>
    </form>
  </div> 
  <div class="container mt-5">
    <h1 class="text-center text-primary">聯絡我們</h1>
    <div class="container">
        <form role="form" action="https://docs.google.com/forms/u/0/d/e/1FAIpQLSe3kGZAbN_tHIfObGRYd0O_SdyzaQQrg9MtGYSIT-ld7YA16A/formResponse" method="post" id="myForm" target='returnWin'>
            <div class="row">         
            </div>
            <div class="row">
              <!--姓名-->              
              <div class="col-sm-4">
                <div class="form-group">
                  <label>
                    <span class="title">姓名</span>
                    <span class="text-danger">(必填)</span>
                  </label>
                  <input type="text"" class="form-control counter" name="entry.555373541" id="name" required>
                </div>
              </div>          
              <!--Email-->              
              <div class="col-sm-4">
                <div class="form-group">
                  <label>
                    <span class="title">Email</span>
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
                  <input type="text" class="form-control counter" name="entry.490717089" id="tel" required>
                </div>
              </div>          
              <!--聯絡內容-->              
              <div class="col-sm-12">
                <div class="form-group">
                  <label>
                    <span class="title">聯絡內容</span>
                    <span class="text-danger">必填</span>
                  </label>
                  <textarea class="form-control" rows="4" id="441469136" name="entry.441469136" required></textarea>
                </div>
              </div> 
            </div> 
            <div class="text-center pb-3">
              <button type="submit" class="btn btn-primary">送出</button>
            </div>
          </form>
            <iframe name="returnWin" style="display: none;" onload="this.onload=function(){window.location='<?php echo $_smarty_tpl->tpl_vars['xoAppUrl']->value;?>
ok.html'}">
            </iframe>
    </div>
  </div><?php }
}
