<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-06 14:09:37
  from 'D:\maxyeh\PHP\xampp\htdocs\web11\templates\tpl\cart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e61e9213d95d1_93394961',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dd9eb690712391c047ba47bef7082f70331b6f7a' => 
    array (
      0 => 'D:\\maxyeh\\PHP\\xampp\\htdocs\\web11\\templates\\tpl\\cart.tpl',
      1 => 1583474744,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e61e9213d95d1_93394961 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- 購物車頁面 -->

<!-- sweetlaert2 -->
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['xoAppUrl']->value;?>
class/sweetalert2/sweetalert2.css">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoAppUrl']->value;?>
class/sweetalert2/sweetalert2.all.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
    function add_cart(sn){
        Swal.fire({
            title: '加入購物車？',
            // text: "您將無法還原！",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '是的',
            cancelButtonText: '取消'
            }).then((result) => {
            if (result.value) {
                document.location.href="cart.php?op=add_cart&sn="+sn;
            }
        })
    }
<?php echo '</script'; ?>
>

<?php if ($_smarty_tpl->tpl_vars['op']->value == "op_list") {?>
<!-- Page Content -->
<div class="container" style="margin-top: 100px;">

    <!-- Page Heading -->
    <h1 class="my-4">購物車
        <small>-試做型-</small>
    </h1>

    <div class="row">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rows']->value, 'row');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
?>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
            <a href="#"><img class="card-img-top" src="<?php echo $_smarty_tpl->tpl_vars['row']->value['prod'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
"></a>
                <div class="card-body">
                    <div class="card-title">
                        商品名稱:<?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>

                    </div>
                    <div class="card-title">
                            商品種類:<?php echo $_smarty_tpl->tpl_vars['row']->value['kinds_title'];?>

                    </div>
                    <div class="card-title">
                            <?php echo $_smarty_tpl->tpl_vars['row']->value['price'];?>
$
                    </div>
                    <div>
                        <a href="#" class="btn btn-primary btn-sm" onclick="add_cart(<?php echo $_smarty_tpl->tpl_vars['row']->value['sn'];?>
)">加入購物車</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
<?php echo $_smarty_tpl->tpl_vars['bar']->value;?>

</div>
<?php }?>



<?php if ($_smarty_tpl->tpl_vars['op']->value == "order_form") {?>
    <div class="container mt-5" style="margin-top: 100px!important;>
        <h1 class="text-center">商品訂單</h1>
        <form  role="form" action="cart.php?op=order_insert" method="post" id="myForm" >        
            <div class="row">
                <!--姓名-->              
                <div class="col-sm-3">
                    <div class="form-group">
                        <label><span class="title">姓名</span><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['name'];?>
">
                    </div>
                </div>
                <!--電話-->              
                <div class="col-sm-3">
                    <div class="form-group">
                        <label><span class="title">電話</span><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="tel" id="tel" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['tel'];?>
">
                    </div>
                </div>
                <!--email-->              
                <div class="col-sm-3">
                    <div class="form-group">
                        <label><span class="title">email</span><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" id="email" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['email'];?>
">
                    </div>
                </div>
                        
                <!--分類-->              
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>自取或配送</label>
                        <select name="kind_sn" id="kind_sn" class="form-control">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['row']->value['kind_sn_options'], 'option');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['option']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['option']->value['sn'];?>
" <?php if ($_smarty_tpl->tpl_vars['option']->value['sn'] == $_smarty_tpl->tpl_vars['row']->value['kind_sn']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['option']->value['title'];?>
</option>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                </div>
            </div>      

            <table class="table table-striped table-bordered table-hover table-sm">
                <thead>
                <tr> 
                    <th scope="col" style="width:85px;">圖片</th>
                    <th scope="col">商品名稱</th>
                    <th scope="col" class="text-right">價格</th>
                    <th scope="col" class="text-center">數量</th>
                    <th scope="col" class="text-center">小計</th>
                </tr>
                </thead>
                <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_SESSION['cart'], 'row', false, 'sn');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sn']->value => $_smarty_tpl->tpl_vars['row']->value) {
?>
                        <tr>
                            <td><img src="<?php echo $_smarty_tpl->tpl_vars['row']->value['prod'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
" width=80></td>
                            <td class="align-middle"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</td>
                            <td class="text-right align-middle price" name="price" style="width: 3rem;"><?php echo $_smarty_tpl->tpl_vars['row']->value['price'];?>
</td>
                            <td class="text-center align-middle">
                                <input type="number" class="amount" name="Amount[<?php echo $_smarty_tpl->tpl_vars['row']->value['sn'];?>
]" id="amount" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['amount'];?>
" min="0" onchange="calTotal()">
                            </td>
                            <td class="text-right align-middle total"></td>
                        </tr>
                    <?php
}
} else {
?>
                        <tr>
                            <td colspan=5>目前沒有商品</td>
                        </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <tr>
                        <td colspan=4 class="text-right">合計</td>
                        <td class="text-right" id="Total"></td>
                    </tr>
                </tbody>
            </table>

            <div class="row">
                <div class="col-sm-12">  
                    <!-- 備註 -->
                    <div class="form-group">
                        <label class="control-label">備註</label>
                        <textarea class="form-control" rows="2" id="ps" name="ps"></textarea>
                    </div>
                </div>
            </div>
            <div class="text-center pb-3">
                <input type="hidden" name="uid" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['uid'];?>
">
                <input type="hidden" name="op" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['op'];?>
">
                <button type="submit" class="btn btn-primary">送出</button>
            </div>
        </form>
    </div>
</div>

<!-- 表單驗證 -->
<style>
    .error{
        color: red;
    }
</style>

<!-- 表單驗證 -->
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"><?php echo '</script'; ?>
>

<!-- 調用方法 -->
<style>
.error{
color:red;
}
</style>

<?php echo '<script'; ?>
>
$(document).ready(function(){
    $("#myForm").validate({              
        submitHandler: function(form) {
        form.submit();
        },

        rules : {
            'entry.1752470597' : {
                required : true
            },
            'entry.995990190' : {
                digits : true,
                min : 0
            },
            'entry.145988367' : {
                digits : true,
                min : 0
            },
            'entry.1828496956' : {
                digits : true,
                min : 0
            },
            'entry.1925021179' : {
                digits : true,
                min : 0
            },
            'total-price' : {
                min : 1
            }
        },

        messages : {
            'entry.1752470597' : {
                required : "請輸入桌號"
            },
            'entry.995990190' : {
                digits : "請輸入整數",
                min : "不可輸入負數"
            },
            'entry.145988367' : {
                digits : "請輸入整數",
                min : "不可輸入負數"
            },
            'entry.1828496956' : {
                digits : "請輸入整數",
                min : "不可輸入負數"
            },
            'entry.1925021179' : {
                digits : "請輸入整數",
                min : "不可輸入負數"
            },
            'total-price' : {
                min : "請點餐,便當數量不可為0"
            }
        }
    });
    
});
<?php echo '</script'; ?>
>

<!-- 計算合計金額 -->
<?php echo '<script'; ?>
>
    calTotal();
    function calTotal(){
        var total = 0;
        //取得class為amount的值(數量)
        var amounts = document.getElementsByClassName("amount"); 
        //取得class為price的值(價格)
        var prices = document.getElementsByClassName("price");

        //偵測項目長度,設置成for迴圈來重複計算,並總合多少錢
        for (i = 0;i < amounts.length;i++){
            //取得便當數量
            var amount = amounts[i].value; 
            //取得便當項目
            var price = prices[i].innerText;
            //將price轉型成為整數
            var price = parseInt(price);
            //計算便當總價並放入total
            total += (amount * price);
            document.getElementsByClassName("total")[i].innerText = amount * price;
        }
        if(total === 0){
            document.getElementById("Total").innerText = "";
        }else{
            document.getElementById("Total").innerText = total;
        }
    }
<?php echo '</script'; ?>
>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['op']->value == "order_list") {?>
  <div class="container mt-5" style="margin-top: 100px!important;>
    <h1 class="text-center">點餐訂單查詢</h1>      
      <div class="row">
          <!--姓名-->              
          <div class="col-sm-3">
              <div class="form-group">
                  <label><span class="title">姓名</span>
                  </label>
                  <div class="form-control"><?php echo $_smarty_tpl->tpl_vars['order_main']->value['name'];?>
</div>
              </div>
          </div>
          <!--電話-->              
          <div class="col-sm-3">
              <div class="form-group">
                  <label><span class="title">電話</span>
                  </label>
                  <div class="form-control"><?php echo $_smarty_tpl->tpl_vars['order_main']->value['tel'];?>
</div>
              </div>
          </div>
          <!--email-->              
          <div class="col-sm-3">
              <div class="form-group">
                  <label><span class="title">email</span></label>
                  <div class="form-control"><?php echo $_smarty_tpl->tpl_vars['order_main']->value['email'];?>
</div>
              </div>
          </div>
                  
          <!--分類-->              
          <div class="col-sm-3">
            <div class="form-group">
                <label>桌號或外帶</label>
                <div class="form-control"><?php echo $_smarty_tpl->tpl_vars['order_main']->value['kind_title'];?>
</div>
            </div>
          </div>
      </div> 
      
      <div class="row">
          <div class="col-sm-12">  
              <!-- 聯絡事項 -->
              <div class="form-group">
                  <label class="control-label">備註</label>
                  <div class="form-control"><?php echo $_smarty_tpl->tpl_vars['order_main']->value['ps'];?>
</div>
              </div>
          </div>
      </div>
        
      <table class="table table-striped table-bordered table-hover table-sm">
        <thead>
        <tr> 
            <th scope="col" style="width:85px;">圖片</th>
            <th scope="col">餐點名稱</th>
            <th scope="col" class="text-right" style="width:120px;">價格</th>
            <th scope="col" class="text-center" style="width:120px;">數量</th>
            <th scope="col" class="text-center" style="width:120px;">小計</th>
        </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rows']->value, 'row');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
?>
                <tr>
                  <td><img src="<?php echo $_smarty_tpl->tpl_vars['row']->value['prod'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
" width=80></td>
                  <td class="align-middle"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</td>
                  <td class="text-right align-middle price"><?php echo $_smarty_tpl->tpl_vars['row']->value['price'];?>
</td>
                  <td class="align-middle text-right">
                    <?php echo $_smarty_tpl->tpl_vars['row']->value['amount'];?>

                  </td>
                  <td class="text-right align-middle total">
                    <?php echo $_smarty_tpl->tpl_vars['row']->value['total'];?>

                  </td>
                </tr>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <tr>
              <td colspan=4 class="text-right">合計</td>
              <td class="text-right" id="Total">
                <?php echo $_smarty_tpl->tpl_vars['order_main']->value['total'];?>

              </td>
            </tr>
        </tbody>
      </table>
  </div>
<?php }
}
}
