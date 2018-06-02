<?php
	$token = isset($token) ? $token : $_GET['token'];
	/**
 	* 包含SDK
 	*/
	require("../classes/yb-globals.inc.php");
	// 配置文件
	require_once 'config.php';
	$api = YBOpenApi::getInstance()->init($config['AppID'], $config['AppSecret'], $config['CallBack']);
	$api->bind($token);
	$stu=new Student($api);
	$stu->getYBConfig();
	$info=$stu->getStuConfig();
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
		<title style="color:black">信息登记</title>
		<script type="text/javascript">
		</script>
	</head>
	<body style="background-color:#FFFAFA" >
		<div id="toptips" class="weui-toptips weui-toptips_warn js_tooltips" style="visibility: visible;">错误提示</div>
		<header>
				<h3 style="vertical-align: middle;text-align:center;font-size:30px"><a>新生个人信息</a></h3>
			</header>
		<div class="weui-form-preview">
            <div class="weui-form-preview__hd">
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">姓名</label>
                    <em class="weui-form-preview__value"><?=$info['xm']?></em>
                </div>
            </div>
            <div class="weui-form-preview__bd">
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">考生号</label>
                    <span class="weui-form-preview__value"><?=$info['ksh']?></span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">学号</label>
                    <span class="weui-form-preview__value"><?=$info['xh']?></span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">性别</label>
                    <span class="weui-form-preview__value"><?=$info['xb']=='M'?'男':'女'?></span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">系部</label>
                    <span class="weui-form-preview__value"><?=$info['department']?></span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">专业</label>
                    <span class="weui-form-preview__value"><?=$info['major']?><?=$info['xl']==31?'本科':'专科'?></span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">宿舍</label>
                    <span class="weui-form-preview__value"><?=$info['dorm']?></span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">辅导员</label>
                    <span class="weui-form-preview__value"><?=$info['instructor']?></span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">辅导员联系方式</label>
                    <span class="weui-form-preview__value"><?=$info['instructor_phone']?></span>
                </div>
            </div>
            <div class="weui-form-preview__ft">
            	<a class="weui-form-preview__btn weui-form-preview__btn_primary" onclick="phone_fun('<?=$info['instructor_phone']?>')">联系辅导员</a>
                <a class="weui-form-preview__btn weui-form-preview__btn_primary" onclick="phone_fun('<?=$TelNumberList['YBKF']?>')">联系工作人员</a>
            </div>
	</body>

</html>