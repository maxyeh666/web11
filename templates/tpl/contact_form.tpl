<!-- 聯絡表單 -->


<div class="container" style = "margin-top: 70px;">
    <h1 class="text-center text-primary">聯絡我們</h1>
    <div class="container">
            <form role="form" action="caontact.php?op=contact_form" method="post" id="myForm">
                <div class="row">
                    <!--姓名-->              
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>
                                <span class="title">姓名</span>
                                <span class="text-danger">(必填)</span>
                            </label>
                            <input type="text"" class="form-control counter" name="name" id="name">
                        </div>
                    </div>          
                    <!--Email-->              
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>
                                <span class="title">Email</span>
                                <span class="text-danger">(必填)</span>
                            </label>
                            <input type="text" class="form-control counter" name="email" id="email">
                        </div>
                    </div>          
                    <!--連絡電話-->              
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>
                                <span class="title">連絡電話</span>
                                <span class="text-danger">(必填)</span>
                            </label>
                            <input type="text" class="form-control counter" name="tel" id="tel">
                        </div>
                    </div>          
                    <!--聯絡內容-->              
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>
                                <span class="title">聯絡內容</span>
                                <span class="text-danger">(必填)</span>
                            </label>
                            <textarea class="form-control" rows="4" name="content" id="content"></textarea>
                        </div>
                    </div> 
                </div> 
                <div class="text-center pb-3">
                    <input type="hidden" name="op" value="<{$row.op}>">
                    <button type="submit" class="btn btn-primary">送出</button>
                </div>
            </form>
    </div>
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
                'name' : {
                required: true
                },
                'tel' : {
                required: true
                },
                'email' : {
                required: true
                }
            },
            messages: {
                'name' : {
                required: "必填"
                },
                'tel' : {
                required: "必填"
                },
                'email' : {
                required: "必填"
                }
            }
        });
    });
</script>
</div>