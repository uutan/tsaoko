<?php
$this->breadcrumbs=array(
	'幻灯管理',
);

$this->menu=array(
	array('label'=>'管理幻灯', 'url'=>array('slideshow/index')),
	array('label'=>'添加幻灯', 'url'=>array('slideshow/create')),
);

?>
    
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>