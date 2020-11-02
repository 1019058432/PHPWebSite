<?php if (!defined('THINK_PATH')) exit();?><DOCTYPE html>
    <html>
    <head>
        <title>登录</title>
        <meta charset="UTF-8">
        <style>
            body{
                background:url("/tp/Public/static/img/tea.jpg") no-repeat;
            }
            .box{
                width:900px;
                height:500px;
                background-color:white;
                border: 5px solid #EEEEEE;
                margin:30px auto;
                margin-top: 100px;
            }
            .leftp{color:#FFCC00;}
            .leftp2{color:#A6A6A6;}
            .left{float:left ;
                margin:15px;
                font-size:20px;
            }
            .regibox{ margin:150px 0px 30px 100px;
                width: 500px;
                float:left;
            }
            table tr{
                height:45px;width:390px;
            }

            #username,#passwd,#checkcode{border:1px solid #A6A6A6;
                height:32px;
                width:200px;
                padding-left:5px;
                border-radius:5px;
            }
            #u_erro{
                color: #ff2d23;
            }
            #checkcode{
                width: 100px;
            }
            #regisbt{
                height:32px;
                width:90px;
                padding-left:5px;
                border-radius:5px;
                background-color:yellow;
            }
            .right{float:right;margin:15px;
                font-size:15px;}
            .right a{color:pink;}

        </style>
        <script>
            window.onload=function(){
                document.getElementById("form").onsubmit=function(){
                    return checkUserName()&&checkPasswd();
                }
                document.getElementById("username").onblur=checkUserName;
                document.getElementById("passwd").onblur=checkPasswd;
            }
            function checkUserName(){
                var username=document.getElementById("username").value;
                var reg_username=/^\w{6,12}$/;
                var flag=reg_username.test(username);
                var u_erro=document.getElementById("u_erro");
                if(flag){
                    u_erro.innerHTML="<img width='35px' height='32px' src='/tp/Public/static/img/r.png' align='center' />";

                }else{
                    u_erro.innerHTML="<img width='35px' height='32px' src='/tp/Public/static/img/w.png' align='center' /><span style='color: red'>格式有误</span>";
                }
                return flag;
            }
            function checkPasswd(){
                var passwd=document.getElementById("passwd").value;
                var reg_passwd=/^\w{6,12}$/;
                var flag=reg_passwd.test(passwd);
                var p_erro=document.getElementById("p_erro");
                if(flag){
                    p_erro.innerHTML="<img width='35px' height='32px' src='/tp/Public/static/img/r.png' align='center' />";

                }else{
                    p_erro.innerHTML="<img width='35px' height='32px' src='/tp/Public/static/img/w.png' align='center' /><span style='color: red'>格式有误</span>";
                }
                return flag;
            }
        </script>
        <script src="/tp/Public/static/js/jquery.js"></script>
    </head>

    <body>
    <div class="box">
        <div class="left">
            <p class=" leftp">用户登录</p>
            <p class=" leftp2">USER LOGIN</p>
        </div>
        <div class="regibox">
            <form action="" method="post" id="form" >
                <table>
                    <tr><td>用户名:</td><td><input name="USERNAME" type="text" placeholder="username" id="username"></td><td><span id="u_erro" class="erro"><?php echo ($error_in); ?></span></td></tr>

                    <tr><td>密码:</td><td><input type="password" name="PASSWORD" placeholder="passwd" id="passwd"></td><td><span id="p_erro" class="erro"></span><td></tr>
                    <tr><td>验证码:</td><td><input type="text"  name="checkcode" id="checkcode"><img id="codeimg" src="/tp/index.php/Admin/Index/vcode"></td><td><?php echo ($error_code); ?></td></tr>

                    <tr ><td colspan="2" align="center"><input type="submit" value="登录" id="regisbt"></td></tr>
                </table>
            </form>
        </div>
        <div class="right">
            <a href="../../Admin/Index/index">返回首页</a>
            <p>未注册账号？</p>
            <a href="register.html">立即注册</a><br>
            <a href="../../Users/User/npwd">忘记密码？</a>
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

    <script>
        $(function () {
            $("#codeimg").on('click',function(){
                this.src= "/tp/index.php/Admin/Index/vcode/t/"+new Date().getTime();
            });
        })

    </script>
    </body>
    </html>
</DOCTYPE>