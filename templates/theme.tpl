<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Creative - Start Bootstrap Theme</title>

<!-- Font Awesome Icons -->
<link href="<{$xoImgUrl}>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

<!-- Plugin CSS -->
<link href="<{$xoImgUrl}>vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

<!-- Theme CSS - Includes Bootstrap -->
<link href="<{$xoImgUrl}>css/creative.min.css" rel="stylesheet">

<{* head_js.tpl *}>
<{include file="tpl/head_js.tpl"}>
</head>

<body id="page-top">

<{* 轉向 *}>
<{include file="tpl/redirect.tpl"}>

<{* head.tpl *}>
<{include file="tpl/head.tpl"}>

<{if $op == "contact_form"}>

  <{* contact_form.tpl *}>
  <{include file="tpl/contact_form.tpl"}>

  <{else if $op == "ok"}>

    <{* ok.tpl *}>
    <{include file="tpl/ok.tpl"}>

  <{else if $op == "login_form"}>

    <{* admin.tpl *}>
    <{include file="tpl/login_form.tpl"}>
    
  <{else if $op == "reg_form"}>

    <{* user.tpl *}>
    <{include file="tpl/reg_form.tpl"}>

  <{else}>

  <{* body.tpl *}>
  <{include file="tpl/body.tpl"}>

<{/if}>

<{* footer.tpl *}>
<{include file="tpl/footer.tpl"}>

<!-- Custom scripts for this template -->
<script src="<{$xoImgUrl}>js/creative.min.js"></script>
</body>
</html>