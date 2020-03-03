<!-- 聯絡表單 -->


<div class="container" style = "margin-top: 70px;">
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
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<!-- 調用函式 -->
<script>
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
</script>
</div>