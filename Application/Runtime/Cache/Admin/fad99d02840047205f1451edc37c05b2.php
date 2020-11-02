<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品管理</title>
    <style>
        .table-css,.header{
            float: left;
        }
        .table-css{
            width:75%;
        }
        .cart-thead{
            display: block;
            height: 32px;
            margin: 0 0 10px;
            padding: 5px 0;
            background: #f3f3f3;
            border: 1px solid #e9e9e9;
        }
        .list_one{
            background: #fff4e8;
        }
        table{
            margin-left: 10px;
            width: 100%;
        }
        tr{
            text-align: center;
        }
        td{
            border-bottom: white 2px solid;
        }
        .meneame{
            width: 100%;
            text-align: center;
            display: block;
            float: left;
            word-wrap: break-word;
            word-break: normal;
        }
        #foot_paid{
            border: #F3F3F3 1px solid;
            margin-top: 5px;
            height: 40px;
        }
        #mix_count{
            line-height: 40px;
            float: left;
            margin-left: 80%;
        }
        #mix_paid{
            line-height: 40px;
            height: 40px;
            width: 60px;
            text-align: center;
            background-color: red;
            float: right;
            margin-right: 30px;
            padding-bottom: 5px;
        }
        body{
            position: absolute;
            height: 100%;
            width: 100%;
        }
        #show_paid{
            z-index: 2;
            float: left;
            left: 30%;
            top: 30%;
            position: fixed;
            display: none;
            width: 400px;
            height: 300px;
        }
        #b_num{
            width: 60px;
        }
        #footer{
            width: 100%;
            display: block;
            float: left;
            word-wrap: break-word;
            word-break: normal;
            margin-bottom: 50px;
        }
        div.meneame{padding:3px;font-size:80%;margin:3px;color:#ff6500;text-align:center;}
        div.meneame a{border:#ff9600 1px solid;padding:5px 7px;background-position:50% bottom;margin:0 3px 0 0;text-decoration:none;}
        div.meneame a:hover{border:#ff9600 1px solid;background-image:none;color:#ff6500;background-color:#ffc794;}
        div.meneame a:active{border:#ff9600 1px solid;background-image:none;color:#ff6500;background-color:#ffc794;}
        div.meneame span.current{border:#ff6500 1px solid;padding:5px 7px;font-weight:bold;color:#ff6500;margin:0 3px 0 0;background-color:#ffbe94;}
        div.meneame span.disabled{border:#ffe3c6 1px solid;padding:5px 7px;color:#ffe3c6;margin:0 3px 0 0;}


    </style>
</head>
<body>
<header class="header">
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
                <li class="active">
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
<div id="conten_detail" class="table-css">
    <div >
        <div class="cart-thead">
        </div>
        <div class="list_one">
            <table>
                <tr>
                    <th style="text-align: center;"> <input id="select_all" type="checkbox" >全选</th>
                    <th style="text-align: center;">图片</th>
                    <th style="text-align: center;">店家</th>
                    <th style="width: 30%;text-align: center;">信息</th>
                    <th style="text-align: center;">单价</th>
                    <th style="text-align: center;">数量</th>
                    <th style="text-align: center;">操作</th>
                </tr>
                <?php if(is_array($unpaids)): $i = 0; $__LIST__ = $unpaids;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td style="text-align: center;" ><input  type="checkbox" data-wprice="<?php echo ($vo["w_price"]); ?>" data-upid="<?php echo ($vo["up_id"]); ?>" data-wid="<?php echo ($vo["w_id"]); ?>" data-pcount="<?php echo ($vo["p_count"]); ?>" data-stock="<?php echo ($vo["w_stock"]); ?>"  ></td>
                        <!--商品图片-->
                        <td  ><img style="width: 80px;height: 80px;" src="<?php echo ($vo["w_img"]); ?>"></td>
                        <td ><div style="height: 80px;"><?php echo ($vo["w_lead"]); ?></div></td>
                        <td ><div style="height: 80px;"><?php echo ($vo["w_name"]); ?></div></td>
                        <td >
                            <strong><?php echo ($vo["w_price"]); ?></strong>
                        </td>
                        <td >
                            <div >
                                <span style="width: 40px;text-align: center" >
                                    <?php echo ($vo["p_count"]); ?>
<!--                                    <input class="mix_increase" type="button" value="-">-->
<!--                                    <input class="mix_countinput" style="width: 50px" type="number" value="<?php echo ($vo["p_count"]); ?>">-->
<!--                                    <input class="mix_decrease" type="button" value="+">-->
                                </span>
                            </div>
                        </td>
                        <td>
                            <a href="#" id="to"   class=" btn " data-upid="<?php echo ($vo["up_id"]); ?>" data-scount="<?php echo ($vo["p_count"]); ?>" data-wstock="<?php echo ($vo["w_stock"]); ?>" data-wid="<?php echo ($vo["w_id"]); ?>" data-wname="<?php echo ($vo["w_name"]); ?>" data-wprice="<?php echo ($vo["w_price"]); ?>">下单</a>
                            <a href="/tp/index.php/Admin/Wares/delpaidhistory?up_id=<?php echo ($vo["up_id"]); ?>" class="cart-follow" id="follow" >删除商品</a>
                        </td>

                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
        </div>
    </div>
</div>
<div id="foot_paid" >
    <div style="display: none"></div>
    <div id="mix_count">总计<span id="mix_price" data-mixid="">0</span>元</div>
    <div><a id="mix_paid"  href="javascript:void(0)">结算</a></div>
</div>
<div class="meneame" ><?php echo ($html); ?></div>
<div style="display: none">
    <span id="u_id"><?php echo ($u_id); ?></span>
    <span id="up_id"></span>
    <span id="w_id"></span>
    <span id="w_stock"></span>
</div>
<div id="show_paid" class="alert alert-warning alert-dismissible" >
    <button type="button" class="close" ><span >&times;</span></button>
    <div><strong>下单确认:</strong><br>
        <div id="wname" ><?php echo ($list["w_name"]); ?></div>
        <div id="paid_content">
            <span>商品单价:<span id="w_price"><?php echo ($list["w_price"]); ?></span></span><br>
            <span>购买数量:
                <span>
                    <input id="decrease" type="button" value="-">
                    <input id="b_num"  type="number" value="1">
                    <input id="increase" type="button" value="+">
                </span>
            </span><br>
            <span>小计:￥
                <span id="m_count" ><?php echo ($list["w_price"]); ?></span>元
            </span><br>
            <span>
                <a id="buy" href="javascript:void(0)">确认购买</a>
            </span>
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
<script>
    $(function () {
    // 下单确认开启
        $("a[id='to']").each(function () {
            $(this).bind('click',function () {
                $("#show_paid").show()
                let w_id=$(this).data("wid")
                let up_id=$(this).data("upid")
                let w_stock=$(this).data("wstock")
                let p_count=$(this).data("scount")
                let w_name=this.getAttribute("data-wname")
                let w_price=this.getAttribute("data-wprice")
                $("#w_price").html(w_price)
                $("#m_count").html(w_price*p_count)
                $("#wname").html(w_name)
                $("#w_id").html(w_id)
                $("#up_id").html(up_id)
                $("#w_stock").html(w_stock)
                $("#b_num").val(p_count)

            })
        })
        // 下单关闭
        $(".close").click(function () {
            $("#show_paid").hide()
        })
        //限制购买数量正数
        $("#b_num").change(function () {
            if(this.value < 1){
                this.value = 1
            }
            let w_stock=parseInt($("#w_stock").html())
            if (this.value>w_stock){
                this.value=w_stock
            }
            let m_count=this.value*parseInt($("#w_price").html())
            $("#m_count").html(m_count)
        })
        //增减按钮
        $("#decrease").click(function () {
            let w_stock= parseInt($("#b_num").val());
            if (w_stock<2){
                $("#b_num").val(1)
            }else {
                $("#b_num").val(w_stock-1)
            }
            let m_count=$("#b_num").val()*parseInt($("#w_price").html())
            $("#m_count").html(m_count.toFixed(2))
        })
        $("#increase").click(function () {
            let b_num= $("#b_num").val();
            let w_stock = $("#w_stock").html();
            if (parseInt(b_num)>=parseInt(w_stock)) {
                $("#b_num").val(w_stock)
            }else {
                $("#b_num").val((parseInt(b_num)+1).toString())
            }
            let m_count=$("#b_num").val()*parseInt($("#w_price").html())
            $("#m_count").html(m_count.toFixed(2))
        })
        //单个购买
        $("#buy").click(function () {
            let w_stock = $("#w_stock").html();
            let w_id=$("#w_id").html();
            let u_id=$("#u_id").html();
            let up_id=$("#up_id").html();
            let p_count=$("#b_num").val();
            if (p_count>w_stock){
                alert("购买数量超过库存，请确认后下单");
            }else {
                location.href="/tp/index.php/Admin/Wares/gopaid?fr=unpaid&w_id="+w_id+"&u_id="+u_id+"&p_count="+p_count+"&up_id="+up_id
            }
        })
        //混合全选择及价格总计显示
        $("#select_all").click(function () {
            let statu=$(this).prop('checked')
            $("input[type='checkbox']").prop('checked',statu)
            $("input[type='checkbox']:gt(0)").each(function () {
                let w_stock=parseInt($(this).data("stock"))
                let p_count=parseInt($(this).data("pcount"))
                if (p_count>w_stock){
                    $(this).prop('checked',false)
                    alert("库存不足")
                }else {
                    let up_id=parseInt($(this).data("upid"))
                    let w_price=parseInt($(this).data("wprice"))
                    let w_id=parseInt($(this).data("wid"))
                    if ($(this).is(":checked")){
                        $("#mix_price").html(parseInt($("#mix_price").html())+(w_price*p_count))
                        let mixid=$("#mix_price").data("mixid")
                        mixid+=(','+w_id+"="+p_count+"="+up_id)
                        $("#mix_price").data("mixid",mixid)
                    }
                    if (!$(this).is(":checked")){
                        $("#mix_price").html(parseInt($("#mix_price").html())-(w_price*p_count))
                        $("#mix_price").data("mixid",'')
                    }
                }
            })
        })
        //混合单个选择及价格总计显示
        $("input[type='checkbox']:gt(0)").each(function () {
            $(this).bind('click',function () {
                let w_stock=parseInt($(this).data("stock"))
                let p_count=parseInt($(this).data("pcount"))
                if (p_count>w_stock){
                    $(this).prop('checked',false)
                    alert("库存不足")
                }else {
                    let up_id=parseInt($(this).data("upid"))
                    let w_price=parseInt($(this).data("wprice"))
                    let w_id=parseInt($(this).data("wid"))
                    if ($(this).is(":checked")){
                        $("#mix_price").html(parseInt($("#mix_price").html())+(w_price*p_count))
                        let mixid=$("#mix_price").data("mixid")
                        mixid+=(','+w_id+"="+p_count+"="+up_id)
                        $("#mix_price").data("mixid",mixid)
                    }
                    if (!$(this).is(":checked")){
                        $("#mix_price").html(parseInt($("#mix_price").html())-(w_price*p_count))
                        let mixid=$("#mix_price").data("mixid")
                        mixid=mixid.replace(','+w_id+"="+p_count+"="+up_id,'')
                        $("#mix_price").data("mixid",mixid)
                    }
                }
            })
        })
        //提交修改保存
        $("#mix_paid").click(function () {
            let mixid=$("#mix_price").data("mixid")
            if (mixid==null||(mixid).length==0){
                alert("请先选择商品!")
            }else {
                let u_id=$("#u_id").html();
                location.href="/tp/index.php/Admin/Wares/mixtopaid?mixid="+mixid+"&u_id="+u_id;
            }
        })
        // //限制混合购买数量正数
        // $(".mix_countinput").change(function () {
        //     if(this.value < 1){
        //         this.value = 1
        //     }
        //     let w_stock=parseInt($("#w_stock").html())
        //     if (this.value>w_stock){
        //         this.value=w_stock
        //     }
        // })
        // //增减按钮
        // $(".mix_decrease").click(function () {
        //     let w_stock= parseInt($("#b_num").val());
        //     if (w_stock<2){
        //         $("#b_num").val(1)
        //     }else {
        //         $("#b_num").val(w_stock-1)
        //     }
        //     let m_count=$("#b_num").val()*parseInt($("#w_price").html())
        //     $("#m_count").html(m_count.toFixed(2))
        // })
        // $(".mix_increase").click(function () {
        //     let b_num= $("#b_num").val();
        //     let w_stock = $("#w_stock").html();
        //     if (parseInt(b_num)>=parseInt(w_stock)) {
        //         $("#b_num").val(w_stock)
        //     }else {
        //         $("#b_num").val((parseInt(b_num)+1).toString())
        //     }
        //     let m_count=$("#b_num").val()*parseInt($("#w_price").html())
        //     $("#m_count").html(m_count.toFixed(2))
        // })

    })
</script>
</body>
</html>