<?php
    function CostQuery($config){
        $url=$_SERVER['SERVER_NAME']."/yiban/freshman/CURDApi/costquery.php";
        $obj=YBOpenApi::QueryURL($url,$config);
        return $obj;
    }
    $token = isset($token) ? $token : htmlentities($_GET['token'],ENT_QUOTES);
    /**
    * 包含SDK
    */
    require("../classes/yb-globals.inc.php");
    // 配置文件
    require_once 'config.php';
    $api = YBOpenApi::getInstance()->init($config['AppID'], $config['AppSecret'], $config['CallBack']);
    $api->bind($token);
    $stu=new Student($api);
    $StuInfo=$stu->showInfo();
    $OrderInfo=$stu->showOrderInfo();
    if($OrderInfo['status']=='error'){
         $url = "error.php?info=获取订单失败&Msg=".$result['info']['msg'];
    ?>
   <script language='javascript' type='text/javascript'>window.location.href='<?=$url?>'</script>
   <?php
    }
    $cost=CostQuery($OrderInfo['info']);
?>
<!DOCTYPE html>
<html>

    <head style="background-color:#FFFAFA" >
        <meta charset="utf-8">
        <meta content="width=device-width,user-scalable=no" name="viewport">
        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
        <script type="text/javascript" src="../js/navigator.js"></script>
        <script src="https://res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../style/dist/style/weui.css">
        <link rel="stylesheet" type="text/css" href="../style/dist/example/example.css">
        <title style="color:black">个人信息</title>
        <script type="text/javascript">
            function developerinfo(){
                var visibility=document.getElementById("info").style.visibility;
                if(visibility == 'hidden'){
                    //document.getElementById("bg").style.visibility ='visible';
                    document.getElementById("info").style.visibility = 'visible';
                }else{
                    //document.getElementById("bg").style.visibility = 'hidden';
                    document.getElementById("info").style.visibility = 'hidden';
                }
             }
        </script>
    </head>
    <body style="background-color:#FFFAFA" >
        <header>
                <h3 style="margin:15px;vertical-align: middle;text-align:center;font-size:30px"><a>预订单信息</a></h3>
            </header>
        <div class="weui-form-preview">
            <div class="weui-form-preview__hd">
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">姓名</label>
                    <em class="weui-form-preview__value"><?=$StuInfo['xm']?></em>
                </div>
            </div>
            <div class="weui-form-preview__bd">
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">学号</label>
                    <span class="weui-form-preview__value"><?=$StuInfo['xh']?></span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">系部</label>
                    <span class="weui-form-preview__value"><?=$StuInfo['collegename']?></span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">专业</label>
                    <span class="weui-form-preview__value"><?=$StuInfo['classname']?></span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">床上三件套</label>
                    <span class="weui-form-preview__value">
                        <?=$OrderInfo['info']['bedding']=='1'?'<i class="weui-icon-success"></i>':'<i class="weui-icon-circle"></i>'?>
                    </span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">被子</label>
                    <span class="weui-form-preview__value">
                        <?=$OrderInfo['info']['quilt']=='1'?'<i class="weui-icon-success"></i>':'<i class="weui-icon-circle"></i>'?>
                    </span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">褥子</label>
                    <span class="weui-form-preview__value">
                        <?=$OrderInfo['info']['puff']=='1'?'<i class="weui-icon-success"></i>':'<i class="weui-icon-circle"></i>'?>
                    </span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">床垫</label>
                    <span class="weui-form-preview__value">
                        <?=$OrderInfo['info']['mattress']=='1'?'<i class="weui-icon-success"></i>':'<i class="weui-icon-circle"></i>'?>
                    </span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">枕头</label>
                    <span class="weui-form-preview__value">
                        <?=$OrderInfo['info']['pillow']=='1'?'<i class="weui-icon-success"></i>':'<i class="weui-icon-circle"></i>'?>
                    </span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">马扎</label>
                    <span class="weui-form-preview__value">
                        <?=$OrderInfo['info']['stool']=='1'?'<i class="weui-icon-success"></i>':'<i class="weui-icon-circle"></i>'?>
                    </span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">军训服尺码</label>
                    <span class="weui-form-preview__value"><?=$OrderInfo['info']['size']?></span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">备注</label>
                    <span class="weui-form-preview__value"><?=$OrderInfo['info']['comment']?></span>
                </div>
            </div>
            <div class="weui-form-preview__ft">
                <a style="color:orange;" class="weui-form-preview__btn weui-form-preview__btn_primary" onclick="javascript:window.location.href='pricedetail.php'">共<?=$cost?>元(点击查看详情)</a>
                <a class="weui-form-preview__btn weui-form-preview__btn_primary" onclick="phone_fun('<?=$TelNumberList['YBKF']?>')">联系工作人员</a>
            </div>
    </body>

</html>