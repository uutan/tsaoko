<?php
/* @var $this ArticleController */
$this->pageTitle = $model->title;


$this->breadcrumbs=array(
	'项目展示'=>array('/product'),
	$model->title,
);
?>

<div class="ui-title" style="margin-bottom:20px;">
项目展示 - <?php echo $model->title; ?>
</div>


<table class="ui-table ui-table-noborder mb10 ui-product-view">
	<tr>
		<td rowspan="6" width="230">
<?php $this->widget('ext.CacheThumbImageWidget',array('path'=>$model->getHomeimage(),'width'=>220,'height'=>220)) ?>
		</td>
		<th width="80">项目展示</th>
		<td><?php echo $model->title; ?></td>
	</tr>
	<tr>
		<th>型号</th>
		<td><?php echo $model->type; ?></td>
	</tr>
	<tr>
		<th>规格</th>
		<td><?php echo $model->standard; ?></td>
	</tr>
	<tr>
		<th>品牌</th>
		<td><?php echo $model->brand; ?></td>
	</tr>	
	<tr>
		<th>所属分类</th>
		<td><?php echo $model->category->name; ?></td>
	</tr>
	<tr>
		<th></th>
		<td>
			<?php echo CHtml::link('我要订购/咨询',array('/product/order','id'=>$model->id),array('class'=>'ui-button ui-button-mgreen')); ?>
		</td>
	</tr>
</table>


<div class="ui-title" style="margin-bottom:20px;">
详细说明
</div>


<div class="ui-article-view">

<div class="ui-article-content">
<?php echo $model->content; ?>
</div>

</div>


<div class="ui-title" style="margin-bottom:20px;">
相关项目
</div>


<ul id="ui-product-list">
<?php foreach($products as $data): ?>
<li>
	<a href="<?php echo $this->createUrl('/product/view',array('id'=>$data->id)); ?>">
	<?php $this->widget('ext.CacheThumbImageWidget',array('path'=>$data->getHomeimage(),'width'=>220,'height'=>220)) ?>
	</a>
	<p><a href="<?php echo $this->createUrl('/product/view',array('id'=>$data->id)); ?>"><?php echo $data->title; ?></a></p>
</li>
<?php endforeach; ?>
</ul>
