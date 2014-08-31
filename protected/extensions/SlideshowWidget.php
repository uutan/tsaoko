<?php
/**
 * @version $Id: SlideshowWidget.php 4702 2013-01-28 05:51:47Z lonestone $
 *
 * This extension have to be installed into:
 * <Yii-Application>/proected/extensions
 *
 * Usage:
 * <?php $this->widget('ext.SlideshowWidget',array(
 * 			"model"			=>	$pages,
 * 			"property"		=>	'content',
 * 			"height"		=>	'400px',
 * 			"width"			=>	'100%',
 * ) ); ?>
 */

class SlideshowWidget extends CWidget
{
	public $height = "100%";
	public $width = "100%";
	public $token;
	public $asbg = true;
	public $vertical = false;

	public function run()
	{
	    if(!isset($this->token)){
			throw new CHttpException(500,'"token" have to be set!');
		}
		
		$cs=Yii::app()->getClientScript();
		$cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.tools.min.js', CClientScript::POS_END);
        $cs->registerScript('slideshow',"$(\".boxImg\").scrollable({circular: true, vertical: ".($this->vertical ? 'true':'false')."}).autoscroll({ autoplay: true }).navigator({navi:'._num', activeClass: 'current'});");
        
        $data = Slideshow::model()->findAllByAttributes(array('token'=>$this->token), array('limit'=>5, 'order'=>'sortnum DESC'));
        $slides = '';
        $btns = '';
        foreach($data as $index=>$item)
        {
            if($this->asbg)
            {
                $slides .= '<li style="display: block; width: 100%;">
                        <div style="position: relative; height: '.$this->height.'; width:100%; background: url('.Yii::app()->baseUrl.$item->image.') no-repeat scroll center top transparent;">
                        <a style="top: 0px; left: 0px; width: 100%; height: '.$this->height.'; background-position: 0px 0px; position: absolute;" href="'.$item->url.'" target="_blank"></a>
                        </div></li>';
            }
            else
            {
                $slides .= '<li class="left_f"><a href="'.$item->url.'" target="_blank"><img width="'.$this->width.'" height="'.$this->height.'" src="'.Yii::app()->baseUrl.$item->image.'"></a></li>';
            }
            
            $btns .= '<a class="'.($index==0 ? 'current' : '').'"><span class="none_f">'.($index+1).'</span></a>';
        }
        
        if($this->vertical)
        {
            $style = 'width:100%; height:'.($this->height*count($data)).'px';
        }
        else
        {
            $style = 'width:'.($this->width*(count($data)+1)).'px';
        }
        
        echo <<<EOF
       <div style="width: {$this->width}; height: {$this->height}; position:relative; overflow:hidden;" class="boxImg">
			<ul style="position: absolute; {$style}; display: inline-block;" class="_img items">
				{$slides}
			</ul>
		</div>
		<div class="_num adType1 ">
			{$btns}
		</div>
EOF;
	}
	
}
?>