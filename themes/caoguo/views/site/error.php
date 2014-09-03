<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - 出错了';
$this->breadcrumbs=array(
	'出错了',
);
?>

<div class="error_section section-wrap">
	<div class="section">
		

	<div class="col-md-12">

		<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/404.jpg">
	
		<p><?php echo CHtml::encode($message); ?></p>
		
	</div>
	


	</div>
</div>