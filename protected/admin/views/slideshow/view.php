<?php
$this->breadcrumbs=array(
	'幻灯管理',
);

$this->menu=array(
	array('label'=>'管理幻灯', 'url'=>array('slideshow/index')),
	array('label'=>'添加幻灯', 'url'=>array('slideshow/create')),
	array('label'=>'修改幻灯', 'url'=>array('slideshow/update', 'id'=>$model->id)),
	array('label'=>'删除幻灯', 'url'=>'#', 'linkOptions'=>array('submit'=>array('slideshow/delete','id'=>$model->id),'confirm'=>'您确定要删除该项目吗？', 'csrf'=>true)),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'url',
		'image:image',
		'token',
		'sortnum',
		'created:datetime',
	),
)); ?>
