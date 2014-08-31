<?php
$label = CActiveRecord::model('Suppliers')->modelName;

$this->breadcrumbs=array(
	$label.'管理',
    '新增'.$label,
);

$this->menu=array(
	array('label'=>'管理'.$label, 'url'=>array('index')),
	array('label'=>'新增'.$label, 'url'=>array('create'), 'active'=>true),
);
?>

    
<?php echo $form; ?>