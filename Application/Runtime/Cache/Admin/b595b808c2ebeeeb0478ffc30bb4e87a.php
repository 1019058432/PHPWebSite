<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页-电子商城</title>
    <script src="/tp/Public/static/js/jquery.js"></script>
    <style>
        body{margin: 0;border: 0;position: relative;}
        #header{float: left; position: absolute;}
        .second{float: right; width: 740px; position: absolute;margin-left: 300px}
        #content{height: 600px;width: 740px; margin-top: 10px;margin-left: 50px;}
        .item>img{margin-left: 120px;}
        div.meneame{padding:3px;font-size:80%;margin:3px;color:#ff6500;text-align:center;}
        div.meneame a{border:#ff9600 1px solid;padding:5px 7px;background-position:50% bottom;margin:0 3px 0 0;text-decoration:none;}
        div.meneame a:hover{border:#ff9600 1px solid;background-image:none;color:#ff6500;background-color:#ffc794;}
        div.meneame a:active{border:#ff9600 1px solid;background-image:none;color:#ff6500;background-color:#ffc794;}
        div.meneame span.current{border:#ff6500 1px solid;padding:5px 7px;font-weight:bold;color:#ff6500;margin:0 3px 0 0;background-color:#ffbe94;}
        div.meneame span.disabled{border:#ffe3c6 1px solid;padding:5px 7px;color:#ffe3c6;margin:0 3px 0 0;}

    </style>
</head>
<body>

<div id="content" >
    <header id="header">
        <!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <!-- Bootstrap -->
  <link href="/tp/Public/static/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{
        width: 100%;
    }
    .top-menu{
        padding-top: 10px;
        height: 20px;
        background: #579142;
    }
    .menu-content{
        background:#ffbe94;
    }
    #header_padding{
        width: 200px;
        /*设置文字不能被选中     以下为css样式*/
        -webkit-user-select:none;
        -moz-user-select:none;
        -ms-user-select:none;
        user-select:none;
    }
    #shellM,#u_menu{
      margin-right: 15px;
      top: 15px;
    }
    #m1,#m2{
      position: relative;
    }
    .btn-list-area,#uM_list{
      top: 15px;
      left: 0px;
    }
    .btn-list-area,.btn-list-area2,.btn-list-area3,#uM_list,#shell_c_list{
      background-color: #fff4e8;
      display: none;
      width: 300px;
    }
    .btn-list-area>a{
      margin: 3px 3px;
    }
    .btn-list-area2>a{
      margin: 3px 3px;
    }
    .btn-list-area3>a{
      margin: 3px 3px;
    }
    .li-css{
        height: 16px;
        padding: 0;
    }
    .find{
          width: 150px;
    }

  </style>
</head>
<body>
  <div id="header_padding">
    <div class="menu-content">
        <div class="top-menu"></div>
        <ul>
            <?php if($admin_name == ''): ?><li><a href="<?php echo U('Admin/Index/login');?>" >登录</a></li>
                <li><a href="<?php echo U('Admin/Index/register');?>">注册</a></li>
            <?php else: ?>
                <li>
                    <nobr><a href="<?php echo U('Users/User/user');?>"><span style="font-size: 8px;text-overflow:ellipsis;width: 80px"><?php echo ($admin_name); ?>,你好!</span></a>
                        <a href="<?php echo U('Admin/Index/logout');?>" >注销</a>
                    </nobr>
                </li><?php endif; ?>
            <li>
                <a  href="<?php echo U('Admin/Index/index');?>">首页</a>
            </li>
        </ul>
        <?php if($admin == ''): ?><ul >
                <li class="[statu1]" >
                    <a href="<?php echo U('Admin/Wares/paid');?>">我的订单 <span class="sr-only">(current)</span></a>
                </li>
                <li class="[statu2]" id="shell_class_list">
                    <a href="<?php echo U('Admin/Wares/shell');?>">分类商城广场</a>
                    <br>
                    <span id="shell_c_list">
                        <?php if(is_array($s_class_list)): $i = 0; $__LIST__ = $s_class_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$manu): $mod = ($i % 2 );++$i; if($manu["class_id"] == 1 ): else: ?>
                                 <a  href="<?php echo U('Admin/Wares/shell?class_id='.$manu[class_id]);?>"><?php echo ($manu["class_name"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </span>
                </li>
                <li class="[statu3]">
                        <a href="<?php echo U('Admin/Wares/unpaid');?>">我的购物车</a>
                </li>
                <li class="[statu4]">
                        <a href="<?php echo U('Admin/Wares/top');?>">人气推荐</a>
                </li>
            </ul>
        <?php else: ?>
            <ul class="">
                <li class="[statu1]" >
                        <a href="<?php echo U('Admin/Crud/paidM');?>">订单管理 <span class="sr-only">(current)</span></a>
                </li>
                <li class="[statu2]" >
                    <span id="shellM">商品管理<br>
                        <span class="btn-list-area" >
                            <span id="m1">
                                   <a href="<?php echo U('Admin/Crud/shellM');?>">商品下架及修改</a>
                              <span class="btn-list-area2">
                                <?php if(is_array($class_list)): $i = 0; $__LIST__ = $class_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$manu): $mod = ($i % 2 );++$i;?><ul>
                                    <?php if($manu["class_id"] == 1 ): else: ?>
                                         <li class="li-css">
                                                <a  href="<?php echo U('Admin/Crud/shellM?class_id='.$manu[class_id]);?>"><?php echo ($manu["class_name"]); ?></a>
                                         </li><br><?php endif; ?>
                                    </ul><?php endforeach; endif; else: echo "" ;endif; ?>
                              </span>
                            </span><br>
                            <span id="m2">
                                   <a href="<?php echo U('Admin/Crud/shellUp');?>">上架回收商品</a><br>
                                <span class="btn-list-area3">
                                    <?php if(is_array($class_list)): $i = 0; $__LIST__ = $class_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$manu): $mod = ($i % 2 );++$i; if($manu["class_id"] == 1 ): else: ?>
                                                    <a  href="<?php echo U('Admin/Crud/shellUp?class_id='.$manu[class_id]);?>"><?php echo ($manu["class_name"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                </span>
                            </span><br>
                            <span >
                                   <a href="<?php echo U('Admin/Crud/addM');?>">添加商品</a>
                            </span>
                        </span>
                    </span>
                </li>
                <li id="u_menu"><span>用户管理</span><br>
                    <span id="uM_list">
                        <a href="<?php echo U('Admin/Crud/userM');?>">会员列表</a>
                    </span>
                </li>
                <li>
                    <a href="<?php echo U('Admin/Crud/Temp');?>">商品回收站</a>
                </li>
            </ul><?php endif; ?>
      <ul >
          <li>
              <form class="" method="get" action="<?php echo U('Admin/Wares/shell');?>" >
                  <div class="form-group">
                      <input type="text" name="like" class=" find" placeholder="Search">
                  </div>
                  <button type="submit" class="btn btn-default">搜索</button>
              </form>
          </li>
      </ul>
    </div>
  <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
  <script src="/tp/Public/static/js/jquery.js"></script>
  <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
  <script src="/tp/Public/static/js/bootstrap.min.js"></script>
    <script>
      $(function () {
        //商品管理列表
        // $("#shellM").hover(function () {
        //   $(".btn-list-area").show();
        // },function () {
        //   $(".btn-list-area").hide();
        // });
        $("#shellM").click(function (event) {
            $(".btn-list-area").toggle(null,null,false);
            $(this).css("height","16px")
        });
        // $("#m1").click(function (event) {
        //     $(".btn-list-area2").show()
        // })
        $("#m1").hover(function () {
            $(".btn-list-area3").hide();
          $(".btn-list-area2").show();
        },function () {
          // $(".btn-list-area2").hide();
        });
        $("#m2").hover(function () {
            $(".btn-list-area3").show();
        },function () {
          // $(".btn-list-area3").hide();
        });
        //用户管理菜单列表
        // $("#u_menu").hover(function () {
        //   $("#uM_list").show();
        // },function () {
        //   $("#uM_list").hide();
        // });
          $("#u_menu").click(function () {
              $("#uM_list").toggle()
          })
          //用户管理菜单列表
          $("#shell_class_list").hover(function () {
              $("#shell_c_list").show();
          },function () {
              $("#shell_c_list").hide();
          });
      })
    </script>
  </div>
</body>
</html>
    </header>
    <div class="second" id="carousel" >
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
                       照亮你的美！
                    </div>
                </div>
                <div class="item">
                    <img src="/tp/Public/static/img/c2.png" alt="...">
                    <div class="carousel-caption">
                        铁憨憨商店欢迎您!
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
</div>
<footer id="footer">
    <!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <!-- Bootstrap -->
  <link href="/tp/Public/static/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .foot2 {
      position: fixed;
      left: 0px;
      bottom: 0px;
      width: 100%;
      height: 50px;
      background-color: #eee;
      z-index: 9999;
      text-align: center;
      margin-top: 50px;
    }

  </style>
</head>
<div >
<div class="foot2 ">
  <div >
      <div class="links">
        <a rel="nofollow"  href="#">
          关于我们
        </a>
        |
        <a rel="nofollow"  href="#">
          联系我们
        </a>
        |
        <a rel="nofollow"  href="#">
          人才招聘
        </a>
        |
        <a rel="nofollow"  href="#">
          商家入驻
        </a>
        |
        <a rel="nofollow"  href="#">
          广告服务
        </a>
        |
        <a rel="nofollow"  href="#">
          手机商店
        </a>
        |
        <a  href="#">
          友情链接
        </a>
        |
        <a  href="#">
          销售联盟
        </a>
        |
        <a href="#" >
          社区
        </a>
        |
        <a href="#" >
          公益
        </a>
        |
        <a  href="#" clstag="pageclick|keycount|20150112ABD|9">English Site</a>
      </div>
      <div class="copyright">
        company&nbsp;©&nbsp;2020-2020&nbsp;&nbsp;憨憨&nbsp;版权所有
      </div>
  </div>

</div>
<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="/tp/Public/static/js/jquery.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="/tp/Public/static/js/bootstrap.min.js"></script>
</div>
</html>
</footer>
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