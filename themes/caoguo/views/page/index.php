<?php
/* @var $this AboutController */
$this->pageTitle = $model->title.' - '.Yii::app()->name;

$this->breadcrumbs=array(
	$model->category,
	$model->title, 
);
?>

<div class="section-wrap">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<ul class="nav nav-secondary" style="margin-top:15px;">
				    <li class="nav-heading"><?php echo $model->category; ?></li>
				    <?php foreach($this->pages($model->category) as $item): ?>
				    <li <?php if($name == $item['name']): ?>class="active"<?php endif; ?>><?php echo CHtml::link($item['title'],array('/page/index','name'=>$item['name'])); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="col-md-12 clearfix">
				<div class="col-md-6"></div>
				<div class="col-md-6">
					<h1 class="pull-right"><?php echo $model->title; ?></h1>
				</div>
			</div>

			<div class="col-md-12">
				
				<div class="ui-article-content">
					<?php echo $model->content; ?>
				</div>

			</div>
		</div>



	</div>
</div>