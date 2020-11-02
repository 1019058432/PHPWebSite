<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        #new_pwd{
            margin: 15% auto ;
        }
        h1{
            text-align: center;
        }
        table{
            margin: 0 auto ;
            text-align: center;
            width: 150px;
        }
    </style>
</head>
<body>
<header>
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
    body{width: 100%;}
    .navbar { padding-top: 10px ;height: 85px }
    .topst{ height: 60px;padding-top: 5px}
    #shellM,#u_menu{
      margin-right: 15px;
      position: relative;
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
      position: absolute;
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

  </style>
</head>
<body>

  <div id="header_padding">
    <div >
        <nav class="navbar navbar-default topst">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php echo U('Index/index');?>">首页</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php if($admin == ''): ?><ul class="nav navbar-nav mean">
                    <li class="[statu1]" ><a href="<?php echo U('Wares/paid');?>">我的订单 <span class="sr-only">(current)</span></a></li>
                    <li class="[statu2]" id="shell_class_list">
                        <a href="<?php echo U('Wares/shell');?>">全品商城</a>
                        <span id="shell_c_list">
                            <?php if(is_array($s_class_list)): $i = 0; $__LIST__ = $s_class_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$manu): $mod = ($i % 2 );++$i; if($manu["class_id"] == 1 ): else: ?>
                                     <a  href="<?php echo U('Wares/shell?class_id='.$manu[class_id]);?>"><?php echo ($manu["class_name"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        </span>
                    </li>
                    <li class="[statu3]"><a href="<?php echo U('Wares/unpaid');?>">我的购物车</a></li>
                    <li class="[statu4]"><a href="<?php echo U('Wares/top');?>">精品推荐</a></li>
                  </ul>
                  <?php else: ?>
                  <ul class="nav navbar-nav mean">
                    <li class="[statu1]" ><a href="<?php echo U('Crud/paidM');?>">订单管理 <span class="sr-only">(current)</span></a></li>
                    <li class="[statu2]" >
                      <span id="shellM">商品管理
                        <span class="btn-list-area" >
                            <span id="m1"><a href="<?php echo U('Crud/shellM');?>">商品下架及修改</a>
                              <span class="btn-list-area2">
                                <?php if(is_array($class_list)): $i = 0; $__LIST__ = $class_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$manu): $mod = ($i % 2 );++$i; if($manu["class_id"] == 1 ): else: ?>
                                         <a  href="<?php echo U('Crud/shellM?class_id='.$manu[class_id]);?>"><?php echo ($manu["class_name"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                              </span>
                            </span><br>
                            <span id="m2"><a href="<?php echo U('Crud/shellUp');?>">上架回收商品</a>
                                <span class="btn-list-area3">
                                    <?php if(is_array($class_list)): $i = 0; $__LIST__ = $class_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$manu): $mod = ($i % 2 );++$i; if($manu["class_id"] == 1 ): else: ?>
                                             <a  href="<?php echo U('Crud/shellUp?class_id='.$manu[class_id]);?>"><?php echo ($manu["class_name"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                </span>
                            </span><br>
                            <span ><a href="<?php echo U('Crud/addM');?>">添加商品</a></span>
                        </span>
                      </span>
                    </li>
                    <li id="u_menu"><span>用户管理</span>
                        <span id="uM_list">
                          <a href="<?php echo U('Crud/userM');?>">会员列表</a>
                        </span>
                    </li>
                      <li><a href="<?php echo U('Crud/Temp');?>">商品回收站</a></li>
                  </ul><?php endif; ?>
              <form class="navbar-form navbar-left">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
              </form>
              <ul class="nav navbar-nav navbar-right">
                <?php if($admin_name == ''): ?><li><a href="<?php echo U('Index/login');?>" >登录</a></li>
                  <li><a href="<?php echo U('Index/register');?>">注册</a></li>
                  <?php else: ?>
                  <li><nobr><a href="<?php echo U('User/user');?>"><span style="font-size: 8px;text-overflow:ellipsis;width: 80px"><?php echo ($admin_name); ?>,你好!</span></a>
                    <a href="<?php echo U('Index/logout');?>" >注销</a></nobr>
                  </li><?php endif; ?>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </div>
  <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
  <script src="/tp/Public/static/js/jquery.js"></script>
  <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
  <script src="/tp/Public/static/js/bootstrap.min.js"></script>
    <script>
      $(function () {
        //商品管理列表
        $("#shellM").hover(function () {
          $(".btn-list-area").show();
        },function () {
          $(".btn-list-area").hide();
        });
        $("#m1").hover(function () {
          $(".btn-list-area2").show();
        },function () {
          $(".btn-list-area2").hide();
        });
        $("#m2").hover(function () {
          $(".btn-list-area3").show();
        },function () {
          $(".btn-list-area3").hide();
        });
        //用户管理菜单列表
        $("#u_menu").hover(function () {
          $("#uM_list").show();
        },function () {
          $("#uM_list").hide();
        });
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
<div id="new_pwd">
    <h1>找回密码</h1>
    <form method="post">
        <table>
            <tr><td><span><?php echo ((isset($log) && ($log !== ""))?($log):''); ?></span></td></tr>
            <tr><td style="align-content: center"><input name="USERNAME" type="text" placeholder="请输入账号"></td></tr>
            <tr><td style="align-content: center"><input name="Email" type="email" placeholder="请输入注册邮箱"></td></tr>
            <tr><td><input name="PASSWORD" type="text" placeholder="请输入新密码"></td></tr>
            <tr><td><input type="submit" ></td></tr>
        </table>
    </form>
</div>
<footer>
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
</body>
</html>