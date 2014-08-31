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
        'product_id'=>array(
            'type'=>'text',
        ),
        'ishome'=>array(
            'type'=>'text',
        ),
        'image'=>array(
            'type'=>'ext.FileFieldWidget',
			'enableAjaxValidation'=>false,
			'thumbOptions'=>array('fullimage'=>true, 'width'=>200, 'height'=>200),
        ),
        'sortnum'=>array(
            'type'=>'text',
        ),
        'sk'=>array(
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