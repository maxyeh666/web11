<!-- 商品管理介面 -->


<link rel="stylesheet" href="<{$xoAppUrl}>class/sweetalert2/sweetalert2.css">
<script src="<{$xoAppUrl}>class/sweetalert2/sweetalert2.all.min.js"></script>
<!-- Font Awesome Icons -->
<link href="<{$xoImgUrl}>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


<{if $op == "op_list"}>
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th scope="col" class="text-center">圖片</th>
            <th scope="col">商品名稱</th>
            <th scope="col">分類</th>
            <th scope="col" class="text-right">價格</th>
            <th scope="col" class="text-center">數量</th>
            <th scope="col" class="text-right">小計</th>
    </thead>
    <tbody>
        <!-- 若有讀取到資料庫的資料,則利用迴圈將資料寫入對應欄位 -->
        <{foreach $smarty.session.cart as $sn => $row}> <!-- 把session資料寫入 -->
            <tr>
                <td><img src="<{$row.prod}>" alt="<{$row.title}>" style="width: 100px;"></td> 
                <td class="align-middle"><{$row.title}></td>
                <td class="text-right align-middle"><{$row.price}></td>
                <td class="text-center align-middle"><{$row.amount}></td>
                <td class="text-right align-middle"></td>
            </tr>
        <!-- 若沒有取得資料,則顯示"目前沒有資料" -->
        <{foreachelse}>
            <tr>
                <td colspan=6>目前沒有資料</td>
            </tr>
        <{/foreach}>
        <tr>
            <td colspan="4" class="text-right">合計</td> 
            <td class="text-right" id="Total"></td>
        </tr>
    </tbody>
</table>

<{/if}>

<{if $op=="op_form"}>
    <div class="container">
        <h1 class="text-center">商品管理表單</h1>
        
        <form action="prod.php" method="post" id="myForm" class="mb-2" enctype="multipart/form-data">
        
            <div class="row">         
                <!--商品標題-->              
                <div class="col-sm-4">
                    <div class="form-group">
                    <label>商品標題<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" id="title" value="<{$row.title}>">
                    </div>
                </div>         
                <!--商品分類-->              
                <div class="col-sm-4">
                    <div class="form-group">
                    <label>商品分類</label>
                        <select name="kind_sn" id="kind_sn" class="form-control">
                            <!-- 從資料庫取得資料,利用迴圈放入下拉式選單 -->
                            <{foreach $row.kind_sn_options as $option}>
                                <option value="<{$option.sn}>" <{if $option.sn == $row.kind_sn}>selected<{/if}>><{$option.title}></option>
                            <{/foreach}>
                        </select>
                    </div>
                </div>
                <!-- 商品狀態  -->
                <div class="col-sm-4">
                    <div class="form-group">
                        <label style="display:block;">商品狀態</label>
                        <!-- 取得資料庫中enable的值,若為1則選擇啟動,為0則選擇停用 -->
                        <input type="radio" name="enable" id="enable_1" value="1" <{if $row.enable=='1'}>checked<{/if}>>
                        <label for="enable_1" style="display:inline;">啟動</label>&nbsp;&nbsp;
                        <input type="radio" name="enable" id="enable_0" value="0" <{if $row.enable=='0'}>checked<{/if}>>
                        <label for="enable_0" style="display:inline;">停用</label>
                    </div>
                </div>  
                <!--價格-->              
                <div class="col-sm-3">
                    <div class="form-group">
                    <label>價格<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="price" id="price" value="<{$row.price}>">
                    </div>
                </div>         
                <!--建立日期-->              
                <div class="col-sm-3">
                    <div class="form-group">
                    <label>建立日期<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="date" id="date" value="<{$row.date}>" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"
                    >
                    </div>
                </div>             
                <!--排序-->              
                <div class="col-sm-3">
                    <div class="form-group">
                    <label>排序</label>
                    <input type="text" class="form-control" name="sort" id="sort" value="<{$row.sort}>">
                    </div>
                </div> 
                <!--計數-->              
                <div class="col-sm-3">
                    <div class="form-group">
                    <label>計數</label>
                    <input type="text" class="form-control" name="counter" id="counter" value="<{$row.counter}>">
                    </div>
                </div> 
                <!--圖片上傳-->              
                <div class="col-sm-6">
                    <label>圖片</label>
                    <input type="file" class="form-control" name="prod" id="prod">
                    <label class="mt-1">
                        <{if $row.prod}>
                            <img src="<{$row.prod}>" alt="<{$row.title}>" class="img-fluid">
                        <{/if}>
                    </label>
                </div> 
            </div>
            <div class="row">
                <div class="col-sm-12">  
                    <!-- 商品內容 -->
                    <div class="form-group">
                        <label class="control-label">商品內容</label>
                        <textarea class="form-control" rows="4" id="content" name="content"><{$row.content}></textarea>
                    </div>
                </div>
            </div>
            <div class="text-center pb-20">
                <!-- 按下送出時,送出op與sn的值 -->
                <input type="hidden" name="op" value="<{$row.op}>">
                <input type="hidden" name="sn" value="<{$row.sn}>">
                <button type="submit" class="btn btn-primary">送出</button>
            </div>
            
            <!-- ckeditor -->
            <script src="<{$xoAppUrl}>class/ckeditor/ckeditor.js"></script>
            <script>
                CKEDITOR.replace('content',{
                    height:500,//高度
                    contentsCss: ['<{$xoImgUrl}>css/creative.css'],//前台樣板css
                    removeDialogTabs: 'image:Link',//取消連結 //link:target;link:advanced;image:advanced
                    filebrowserBrowseUrl: '<{$xoAppUrl}>class/elfinder.php?type=image'//呼叫elfinder.php
                });
            </script>
        </form>
        <!-- 表單驗證 -->
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
        <!-- 調用方法 -->
        <style>
            .error{
            color:red;
            }
        </style>
        <script>
            $(function(){
            $("#myForm").validate({
                submitHandler: function(form) {
                    form.submit();
                },
                rules: {
                    'title' : {
                        required: true
                    },
                    'price' : {
                        required: true
                    }
                },
                messages: {
                    'title' : {
                        required: "必填"
                    },
                    'price' : {
                        required: "必填"
                    }
                }
            });
            });
        </script>
    </div>
<{/if}>

<!-- 小月曆 -->
<script type='text/javascript' src='<{$xoAppUrl}>class/My97DatePicker/WdatePicker.js'></script>

<!-- 刪除小視窗 -->
<script>        
    function op_delete(sn){
        Swal.fire({
            title: '你確定嗎？',
            text: "您將無法還原！",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '是的，刪除它！'
        }).then((result) => {
            if (result.value) {
                //確定要刪除的動作
                document.location.href="prod.php?op=op_delete&sn="+sn;
            }
        })
    }        
</script>