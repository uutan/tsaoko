<li>
	<a href="<?php echo $this->createUrl('/product/view',array('id'=>$data->id)); ?>">
	<?php $this->widget('ext.CacheThumbImageWidget',array('path'=>$data->getHomeimage(),'width'=>220,'height'=>220)) ?>
	</a>
	<p><a href="<?php echo $this->createUrl('/product/view',array('id'=>$data->id)); ?>"><?php echo $data->title; ?></a></p>
</li>