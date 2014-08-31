<?php 
return array(
	'activeForm'=> array(
		'id'=>'edit-form',
		'enableAjaxValidation'=>true,
		'htmlOptions'=> array('enctype'=>'multipart/form-data'),
		'clientOptions'=>array(
			'validateOnSubmit'=>true, 
			'validateOnChange'=>true,
			'beforeValidate'=>'js:function(form){
				$.each(CKEDITOR.instances, function(i, editor){
					editor.updateElement();
				});
				return true;
			}',
		),
	),
	'elements'=>array(
       
        'unit'=>array(
            'type'=>'text',
        ),
        'category_id'=>array(
            'type'=>'dropdownlist',
            'items' => ProductCategory::getAll(),
        ),
        'title'=>array(
            'type'=>'text',
            'attributes' => array('style'=>'width:300px;'),
        ),
        'image' => array(
            'type'=>'ext.FilefieldWidget',
            'enableAjaxValidation'=>false,
            'thumbOptions'=>array('fullimage'=>true, 'width'=>200, 'height'=>200),
        ),
        'type'=>array(
            'type'=>'text',
        ),
        'standard'=>array(
            'type'=>'text',
        ),
        'brand'=>array(
            'type'=>'text',
        ),
        'content'=>array(
            'type'=>'textarea',
			'attributes'=>array('class'=>'ckeditor'),
        ),
        'is_del'=>array(
            'type'=>'dropdownlist',
            'items' => array('0'=>'否','1'=>'是'),
        ),
        'views'=>array(
            'type'=>'text',
        ),
        'is_rec'=>array(
            'type'=>'dropdownlist',
            'items' => array('0'=>'否','1'=>'是'),
        ),
           	),      
	'buttons'=>array(
        'btnsubmit'=>array(
            'type'=>'submit',
            'label'=>'确定',
    		'class'=>'btn',
        ),
    ),
);  