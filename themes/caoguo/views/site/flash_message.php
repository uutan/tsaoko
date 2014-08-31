<?php
$this->pageTitle='系统提示信息';
$this->breadcrumbs=array(
	'系统提示信息'
);

if(!isset($window)) $window = 'self';
?>
<style>
#loginsuc{ font-size:14px; width:550px; height:60px; line-height:30px; color:#497F07; font-weight:bold; margin:50px auto; padding:20px 20px 20px 70px; text-align:left; border:#d0e4bc solid 1px; border-radius:3px; background:#f6feef url(/img/common/icon5.png) 20px center no-repeat; _background:#f6feef url(/img/common/icon5.gif) 20px center no-repeat;}
html {overflow-y:hidden;}
#loginsuc a{text-decoration:underline;color: #F1640C;}
</style>
<div id="loginsuc" class="no_result break-word">
<?php 
if(isset($script)) echo $script; 
?>
<script type="text/javascript">setTimeout('<?php echo $window; ?>.location.href="<?php echo is_array($redirect_url) ? CHtml::normalizeUrl($redirect_url) : $redirect_url; ?>"',<?php echo isset($timeout) ? $timeout : '2000';?>);</script>
<?php echo $message; ?>
<br>
如果您的浏览器没有自动跳转，
<a href="<?php echo is_array($redirect_url) ? CHtml::normalizeUrl($redirect_url) : $redirect_url; ?>">请点击此链接</a>
</div>

<div class="clear"></div>