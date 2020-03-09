<!-- 主面板基礎架構,判斷是否需要轉頁 -->

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

<!-- Plugin CSS -->
<link href="<{$xoImgUrl}>vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

<!-- Theme CSS - Includes Bootstrap -->
<link href="<{$xoImgUrl}>css/creative.min.css" rel="stylesheet">



<{* 引入外部程式、css *}>
<{* head_js.tpl *}>
<{include file="tpl/head_js.tpl"}>

<{* 面板轉向顯示控制(redirect.tpl) *}>
<{include file="tpl/redirect.tpl"}>

<{* 引入標頭導覽列(head.tpl)*}>
<{* head.tpl *}>
<{include file="tpl/head.tpl"}>

<{if $WEB.file_name == "index.php"}>
  <{include file="tpl/index.tpl"}>
<{elseif  $WEB.file_name == "cart.php"}>
  <{include file="tpl/cart.tpl"}>
<{elseif  $WEB.file_name == "order.php"}>
  <{include file="tpl/order.tpl"}>
<{/if}>

<{* 讀入頁尾(footer.tpl) *}>
<{include file="tpl/footer.tpl"}>

<{* 購物車圖示是否出現 *}>
<{if $smarty.session.cartAmount and $op != "op_form"}>
<!-- 購物車圖示樣式 -->
<style>
  .fab-fixed-wrap .fab {
    display: block;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    color: white;
    background-color: #0c9;
    text-align: center;
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.16);
    text-decoration: none;
    display: flex;
    line-height: 1.2;
    align-items: center;
    justify-content: center;
  }
  .fab-fixed-wrap .fab.fab-facebook {
    background-color: darkcyan;
  }
  .fab-fixed-wrap .fab.fab-line {
    background-color: #0b0;
  }
  .count {
    width: 30px;
    height: 30px;
    position: absolute;
    border-radius: 50%;
    transform: scale(.7);
    transform-origin: top right;
    top: 0;
    right: 0;
    color: white;
    background:red;
  }
</style>

<!-- 購物車html -->
<div class="fab-fixed-wrap with-navbar-bottom" style="bottom: 4.6875rem;position: fixed;z-index: 1035;right: .9375rem;bottom: .9375rem;">
    <a href="cart.php?op=order_form" class="fab fab-facebook mp-click" data-toggle="tooltip" title="您選了<{$smarty.session.cartAmount}>個商品" >
      <i class="fas fa-shopping-cart"></i>
      <span class="count"><{$smarty.session.cartAmount}></span> 
    </a>
</div>
<{/if}>

<!-- 小提示呼叫函式 -->
<script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<!-- Custom scripts for this template -->
<script src="<{$xoImgUrl}>js/creative.min.js"></script>