<?php
$label = CActiveRecord::model('User')->modelName;

$this->breadcrumbs=array(
	$label.'管理',
    '查看'.$label,
);

$this->menu=array(
	array('label'=>'管理'.$label, 'url'=>array('index')),
	array('label'=>'修改'.$label, 'url'=>array('update','id'=>$model->id)),
	array('label'=>'查看'.$label, 'url'=>array('view','id'=>$model->id), 'active'=>true),
    array('label'=>'删除'.$label, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'您确定要删除该项目吗？', 'csrf'=>true)),
);
?>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions' => array('class'=>'pure-table pure-table-bordered'),
	'itemCssClass' => array('pure-table-odd', ''),
	'itemTemplate' => '<tr class="{class}" ><td class="td21">{label}：</td><td>{value}</td></tr>',
	'attributes'=>array(
		'id',
		'is_real:boolean',
		'username',
		'level',
		'password',
		'role',
		'email',
		'mobile',
		'phone',
		'nickname',
		'job',
		'created:datetime',
		'last_login_time:datetime',
		'this_login_time:boolean',
		'last_login_ip',
		'this_login_ip:boolean',
		'avatar:image',
		'gender',
		'both',
		'info',
		'credit',
		'money',
		'active',
	),
)); ?>