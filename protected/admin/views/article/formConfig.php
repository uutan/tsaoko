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
        'cate_id'=>array(
            'type'=>'dropdownlist',
            'items' => array(''=>'请选择')+ArticleCategory::getAll()
        ),
        
        'title'=>array(
            'type'=>'text',
            'attributes' => array('style'=>"width:80%;")
        ),
        'iscommend'=>array(
            'type'=>'dropdownlist',
            'items' => array(
                '0' => '否',
                '1' => '是',
            )
        ),
        'isheadline'=>array(
            'type'=>'dropdownlist',
            'items' => array(
                '0' => '否',
                '1' => '是',
            )
        ),
        'writer'=>array(
            'type'=>'text',
        ),
        'source'=>array(
            'type'=>'text',
        ),
        'image'=>array(
            'type'=>'ext.FilefieldWidget',
			'enableAjaxValidation'=>false,
			'thumbOptions'=>array('fullimage'=>true, 'width'=>200, 'height'=>200),
        ),
        'description'=>array(
            'type'=>'textarea',
			'attributes'=>array('class'=>'ckeditor'),
        ),
        'keywords'=>array(
            'type'=>'text',
        ),
        'content'=>array(
            'type'=>'textarea',
			'attributes'=>array('class'=>'ckeditor'),
        ),
        'ischecked'=>array(
            'type'=>'dropdownlist',
            'items' => array(
                '0' => '否',
                '1' => '是',
            )
        ),
        'sortnum'=>array(
            'type'=>'text',
        ),
        'sourceurl'=>array(
            'type'=>'text',
        ),
        'istopic'=>array(
            'type'=>'dropdownlist',
            'items' => array(
                '0' => '否',
                '1' => '是',
            )
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