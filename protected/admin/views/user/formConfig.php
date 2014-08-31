<?php 
return array(
	'activeForm'=> array(
		'id'=>'edit-form',
		'enableAjaxValidation'=>true,
		'htmlOptions'=> array('enctype'=>'multipart/form-data','class'=>'pure-form pure-form-stacked'),
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
        
        'username'=>array(
            'type'=>'text',
        ),
        'level'=>array(
            'type'=>'dropdownlist',
            'items' => User::levelOptions(),
        ),
        'email'=>array(
            'type'=>'text',
        ),
        'mobile'=>array(
            'type'=>'text',
        ),
        'phone'=>array(
            'type'=>'text',
        ),
        'nickname'=>array(
            'type'=>'text',
        ),
        'job'=>array(
            'type'=>'text',
        ),
        'avatar'=>array(
            'type'=>'ext.FileFieldWidget',
			'enableAjaxValidation'=>false,
			'thumbOptions'=>array('fullimage'=>true, 'width'=>200, 'height'=>200),
        ),
        'gender'=>array(
            'type'=>'text',
        ),
        'both'=>array(
            'type'=>'text',
        ),
        'info'=>array(
            'type'=>'textarea',
        ),
        'credit'=>array(
            'type'=>'text',
        ),
        'money'=>array(
            'type'=>'text',
        ),
        
           	),      
	'buttons'=>array(
        'btnsubmit'=>array(
            'type'=>'submit',
            'label'=>'确定',
    		'class'=>'pure-button pure-button-primary',
        ),
    ),
);  