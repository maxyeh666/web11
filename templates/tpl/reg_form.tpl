<!-- 註冊表單介面 -->


<div class="container" style="margin-top: 70px;">
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
        <!-- 按下送出時,送出op的值 -->
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
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
    <!-- 調用函式 -->
    <script>
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
    </script>
</div>
