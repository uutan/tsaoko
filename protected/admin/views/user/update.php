<?php
$label = CActiveRecord::model('User')->modelName;

$this->breadcrumbs=array(
	$label.'管理',
    '修改'.$label,
);

$this->menu=array(
	array('label'=>'管理'.$label, 'url'=>array('index')),
	array('label'=>'修改'.$label, 'url'=>array('update','id'=>$form->model->id), 'active'=>true),
	array('label'=>'查看'.$label, 'url'=>array('view','id'=>$form->model->id)),
	array('label' => '删除'.$label, 'url' => '#', 'linkOptions' => array(
		'submit' => array('delete', 'id' => $model->id),
		'confirm' => '您真的要删除这条数据吗？',
	)),
);

?>


<?php echo $form; ?>
