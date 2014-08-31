<?php
/**
 * 文件上传
 * 
 */
class FilefieldWidget extends CInputWidget
{
	/**
	 * 缩略图属性
	 * @var array
	 */
	public $thumbOptions;
	
	/**
	 * 是否渲染删除文件复选框
	 * @var boolean
	 */
	public $renderDeleteCheckbox = false;
	
	public function run()
	{
		echo CHtml::activeFileField($this->model, $this->attribute, $this->htmlOptions);
		echo '<br />';
		$attr= $this->attribute;
		$path = $this->model->$attr;
		
		if($path)
		{
			$ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
			if(in_array($ext, array('jpg', 'gif', 'png')))
			{
				echo CHtml::openTag('a', array('rel'=>'fancybox', 'href'=>$path));
				$this->getController()->widget('ext.CacheThumbImageWidget', array(
												'path' => $path, 
				                                'fullimage'=> $this->thumbOptions['fullimage'],
												"width" => $this->thumbOptions['width'], 
												"height" => $this->thumbOptions['height'],
												'class'=>'img_bd',
											));
				echo CHtml::closeTag('a');
			}
			else
			{
				echo CHtml::link('点击下载', $path, array('target'=>'_blank'));
			}
			
			if($this->renderDeleteCheckbox)
			{
				echo '<br />';
				echo CHtml::checkBox('delete_'.$this->attribute, false, array('id'=>'delete_'.$this->attribute));
				echo '&nbsp;';
				echo CHtml::label('删除已上传', 'delete_'.$this->attribute, array('style'=>'float:none; width:auto; text-align:left; font-weight:normal;font-size:12px'));
			}
		}
	}
}