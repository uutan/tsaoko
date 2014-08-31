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
            'attributes' => array(
                'class' => 'pure-input-1-3',
            ),
        ),
        /*'image'=>array(
            'type'=>'ext.FileFieldWidget',
			'enableAjaxValidation'=>false,
			'thumbOptions'=>array('fullimage'=>true, 'width'=>200, 'height'=>200),
        ),*/
        'desc'=>array(
            'type'=>'textarea',
			'attributes'=>array('class'=>'ckeditor'),
        ),
        'url'=>array(
            'type'=>'text',
        ),
        'sort_order'=>array(
            'type'=>'text',
        ),
        'is_show'=>array(
            'type'=>'dropdownlist',
            'items' => array('0' => '不显示','1' => '显示'),
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