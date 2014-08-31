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
        'name'=>array(
            'type'=>'text',
        ),
        'desc'=>array(
            'type'=>'textarea',
			'attributes'=>array('class'=>'ckeditor'),
        ),
        'sort_order'=>array(
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