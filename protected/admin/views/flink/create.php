<?php
$this->breadcrumbs=array(
	'友情链接管理',
);

$this->menu=array(
	array('label'=>'管理友链', 'url'=>array('flink/index')),
	array('label'=>'添加友链', 'url'=>array('flink/create')),
	array('label'=>'自动检查', 'url'=>array('flink/check')),
);

?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>