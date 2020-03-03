<!-- 標頭導覽列 -->


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" style="background-color: rgb(192, 103, 19);opacity: 70%;" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php#page-top">Start Bootstrap</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
            <!-- 利用迴圈將選單從選單資料庫找出並顯示出來 -->
            <{foreach $mainMenus as $mainMenu}> 
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="<{$mainMenu.url}>" <{if $mainMenu.target == 1}> target="_blank" <{/if}>><{$mainMenu.title}></a>
                </li>
            <{/foreach}>

            <!-- 判斷是否為管理員,並顯示為管理員或一般會員 -->
            <{if $smarty.session.user.kind === 1}>
                <{*管理員登入顯示*}>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="user.php"">管理員</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="index.php?op=logout">登出</a>
                </li>
            <{else if $smarty.session.user.kind === 0}>
                <{*會員登入顯示*}>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="index.php?op=logout">登出</a>
                </li>
            <{else}>
                <{*未登入顯示*}>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="index.php?op=login_form">登入</a>
                </li>
            <{/if}>
        </ul>
        </div>
    </div>
</nav>