<!-- 購物車頁面 -->

<!-- sweetlaert2 -->
<link rel="stylesheet" href="<{$xoAppUrl}>class/sweetalert2/sweetalert2.css">
<script src="<{$xoAppUrl}>class/sweetalert2/sweetalert2.all.min.js"></script>

<script>
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
</script>

<{if $op == "op_list"}>
<!-- Page Content -->
<div class="container" style="margin-top: 100px;">

    <!-- Page Heading -->
    <h1 class="my-4">購物車
        <small>-試做型-</small>
    </h1>

    <div class="row">
        <{foreach $rows as $row}>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
            <a href="#"><img class="card-img-top" src="<{$row.prod}>" alt="<{$row.title}>"></a>
                <div class="card-body">
                    <div class="card-title">
                        商品名稱:<{$row.title}>
                    </div>
                    <div class="card-title">
                            商品種類:<{$row.kinds_title}>
                    </div>
                    <div class="card-title">
                            <{$row.price}>$
                    </div>
                    <div>
                        <a href="#" class="btn btn-primary btn-sm" onclick="add_cart(<{$row.sn}>)">加入購物車</a>
                    </div>
                </div>
            </div>
        </div>
        <{/foreach}>
    </div>
<{$bar}>
</div>
<{/if}>



<{if $op == "order_form"}>
    <div class="container mt-5" style="margin-top: 100px!important;>
        <h1 class="text-center">商品訂單</h1>
        <form  role="form" action="cart.php?op=order_insert" method="post" id="myForm" >        
            <div class="row">
                <!--姓名-->              
                <div class="col-sm-3">
                    <div class="form-group">
                        <label><span class="title">姓名</span><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" value="<{$row.name}>">
                    </div>
                </div>
                <!--電話-->              
                <div class="col-sm-3">
                    <div class="form-group">
                        <label><span class="title">電話</span><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="tel" id="tel" value="<{$row.tel}>">
                    </div>
                </div>
                <!--email-->              
                <div class="col-sm-3">
                    <div class="form-group">
                        <label><span class="title">email</span><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" id="email" value="<{$row.email}>">
                    </div>
                </div>
                        
                <!--分類-->              
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>自取或配送</label>
                        <select name="kind_sn" id="kind_sn" class="form-control">
                            <{foreach $row.kind_sn_options as $option}>
                                <option value="<{$option.sn}>" <{if $option.sn == $row.kind_sn}>selected<{/if}>><{$option.title}></option>
                            <{/foreach}>
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
                    <{foreach $smarty.session.cart as $sn => $row}>
                        <tr>
                            <td><img src="<{$row.prod}>" alt="<{$row.title}>" width=80></td>
                            <td class="align-middle"><{$row.title}></td>
                            <td class="text-right align-middle price" name="price" style="width: 3rem;"><{$row.price}></td>
                            <td class="text-center align-middle">
                                <input type="number" class="amount" name="Amount[<{$row.sn}>]" id="amount" value="<{$row.amount}>" min="0" onchange="calTotal()">
                            </td>
                            <td class="text-right align-middle total"></td>
                        </tr>
                    <{foreachelse}>
                        <tr>
                            <td colspan=5>目前沒有商品</td>
                        </tr>
                    <{/foreach}>
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
                <input type="hidden" name="uid" value="<{$row.uid}>">
                <input type="hidden" name="op" value="<{$row.op}>">
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
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>

<!-- 調用方法 -->
<style>
.error{
color:red;
}
</style>

<script>
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
</script>

<!-- 計算合計金額 -->
<script>
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
</script>
<{/if}>

<{if $op == "order_list"}>
  <div class="container mt-5" style="margin-top: 100px!important;>
    <h1 class="text-center">點餐訂單查詢</h1>      
      <div class="row">
          <!--姓名-->              
          <div class="col-sm-3">
              <div class="form-group">
                  <label><span class="title">姓名</span>
                  </label>
                  <div class="form-control"><{$order_main.name}></div>
              </div>
          </div>
          <!--電話-->              
          <div class="col-sm-3">
              <div class="form-group">
                  <label><span class="title">電話</span>
                  </label>
                  <div class="form-control"><{$order_main.tel}></div>
              </div>
          </div>
          <!--email-->              
          <div class="col-sm-3">
              <div class="form-group">
                  <label><span class="title">email</span></label>
                  <div class="form-control"><{$order_main.email}></div>
              </div>
          </div>
                  
          <!--分類-->              
          <div class="col-sm-3">
            <div class="form-group">
                <label>桌號或外帶</label>
                <div class="form-control"><{$order_main.kind_title}></div>
            </div>
          </div>
      </div> 
      
      <div class="row">
          <div class="col-sm-12">  
              <!-- 聯絡事項 -->
              <div class="form-group">
                  <label class="control-label">備註</label>
                  <div class="form-control"><{$order_main.ps}></div>
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
            <{foreach $rows as $row}>
                <tr>
                  <td><img src="<{$row.prod}>" alt="<{$row.title}>" width=80></td>
                  <td class="align-middle"><{$row.title}></td>
                  <td class="text-right align-middle price"><{$row.price}></td>
                  <td class="align-middle text-right">
                    <{$row.amount}>
                  </td>
                  <td class="text-right align-middle total">
                    <{$row.total}>
                  </td>
                </tr>
            <{/foreach}>
            <tr>
              <td colspan=4 class="text-right">合計</td>
              <td class="text-right" id="Total">
                <{$order_main.total}>
              </td>
            </tr>
        </tbody>
      </table>
  </div>
<{/if}>