<?php 
Yii::app()->clientScript->registerCoreScript('jquery');
 ?><!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/zui.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/zui-theme.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" rel="stylesheet">
  <!-- ZUI Javascript组件 -->
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/zui.min.js"></script>
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
  </head>
  <body>
    <!--[if lt IE 8]>
        <div class="alert alert-danger">您正在使用 <strong>过时的</strong> 浏览器. 是时候 <a href="http://browsehappy.com/">更换一个更好的浏览器</a> 来提升用户体验.</div>
    <![endif]-->
    <?php $this->renderPartial('//layouts/_header'); ?>
  
    <?php echo $content; ?>
  
    <?php $this->renderPartial('//layouts/_footer'); ?>
</body>
</html>
