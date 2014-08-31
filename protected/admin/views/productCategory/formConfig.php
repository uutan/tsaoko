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
        'parent_id'=>array(
            'type'=>'dropdownlist',
            'items' => array('0'=>'设为根分类')+ProductCategory::getAll(0)
        ),
        'name'=>array(
            'type'=>'text',
        ),
        'keywords'=>array(
            'type'=>'textarea',
        ),
        'description'=>array(
            'type'=>'textarea',
			'attributes'=>array('class'=>'ckeditor'),
        ),
        'sortnum'=>array(
            'type'=>'text',
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