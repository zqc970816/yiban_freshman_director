<?php
$token = isset($token) ? $token : $_GET['token'];
if(!empty($_POST['ksh'])){
    $ksh=$_POST['ksh'];
    $xh=$_POST['xh'];
    $xm=$_POST['xm'];
    $xb=$_POST['gender'];
    $info=array(
    'ksh' => $ksh,
    'xh'  => $xh,
    'xm'  => $xm,
    'xb'  => $xb
);
//var_dump($info);
}
/**
 * 包含SDK
 */
require("../classes/yb-globals.inc.php");
// 配置文件
require_once 'config.php';

//初始化配置信息，并获取token
$api = YBOpenApi::getInstance()->init($config['AppID'], $config['AppSecret'], $config['CallBack']);
$api->bind($token);
$stu=new Student($api);
$stu->getYBConfig();
$stu->setStuConfig($info);
$result=$stu->submit();
if($result['status']){
    $url = "success.php?token=".$token;
?>
    <script language='javascript' type='text/javascript'>window.location.href='<?=$url?>'</script>
<?php 
}else{
    if($result['error_code']==101){
         $url = "error.php?Msg=".$result['Msg'];
    ?>
   <script language='javascript' type='text/javascript'>window.location.href='<?=$url?>'</script>
    }
   
   <?php
}elseif ($result['error_code']==102) {
    ?>
    <script language='javascript' type='text/javascript'>alert('<?=$result['Msg']?>');window.history.back()</script>
    <?php
}
}