<!-- 主面板基礎架構,判斷是否需要轉頁 -->


<!-- Font Awesome Icons -->
<link href="<{$xoImgUrl}>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

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
<{/if}>

<{* 讀入頁尾(footer.tpl) *}>
<{include file="tpl/footer.tpl"}>

<!-- Custom scripts for this template -->
<script src="<{$xoImgUrl}>js/creative.min.js"></script>