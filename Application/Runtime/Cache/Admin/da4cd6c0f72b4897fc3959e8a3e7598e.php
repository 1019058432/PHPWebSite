<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页-儿童商店</title>
    <script src="/tp/Public/static/js/jquery.js"></script>
    <script type="text/javascript" src="/tp/Public/static/js/headerandfooter.js"></script>
    <style>
        #content{height: 600px;width: 740px; margin-top: 200px;margin-left: 100px;}
        .item>img{margin-left: 120px}
        div.meneame{padding:3px;font-size:80%;margin:3px;color:#ff6500;text-align:center;}
        div.meneame a{border:#ff9600 1px solid;padding:5px 7px;background-position:50% bottom;margin:0 3px 0 0;text-decoration:none;}
        div.meneame a:hover{border:#ff9600 1px solid;background-image:none;color:#ff6500;background-color:#ffc794;}
        div.meneame a:active{border:#ff9600 1px solid;background-image:none;color:#ff6500;background-color:#ffc794;}
        div.meneame span.current{border:#ff6500 1px solid;padding:5px 7px;font-weight:bold;color:#ff6500;margin:0 3px 0 0;background-color:#ffbe94;}
        div.meneame span.disabled{border:#ffe3c6 1px solid;padding:5px 7px;color:#ffe3c6;margin:0 3px 0 0;}

    </style>
</head>
<body>
<header id="header"></header>
<h2><?php echo ($admin_name); ?>,你好！</h2>
<div id="content" >
    <div id="carousel" >
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                <li data-target="#carousel-example-generic" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="/tp/Public/static/img/c1.jpg" alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item">
                    <img src="/tp/Public/static/img/c2.png" alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item">
                    <img src="/tp/Public/static/img/c3.jpg" alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item">
                    <img src="/tp/Public/static/img/c4.jpg" alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                ...
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div id="content_page">
        <div class="meneame"><?php echo ($html); ?></div>
        <table >

            <?php if(is_array($users)): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <?php if(is_array($vo)): foreach($vo as $key=>$vo1): ?><td style="border: #3c3f41 1px solid"><?php echo ($key); ?>|<?php echo ($vo1); ?></td><?php endforeach; endif; ?>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </div>
</div>
<footer id="footer"></footer>
<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="/tp/Public/static/js/jquery.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="/tp/Public/static/js/bootstrap.min.js"></script>
<script>
    $(function () {
        $('.carousel').carousel("cycle")
    })

</script>
</body>
</html>