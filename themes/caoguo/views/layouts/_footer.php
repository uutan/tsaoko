<!--底部-->
<footer class="bs-footer" role="contentinfo">
  <div class="container">
	<div class="row" id="footer_nav">
	  <div class="col-md-2 col-xs-4 col-sm-4">

<ul>
<li class="header"><?php echo Page::CATEGORY_1; ?></li>
<?php foreach($this->pages(Page::CATEGORY_1) as $item): ?>
<li><?php echo CHtml::link($item['title'],array('/page/view','name'=>$item['name'])); ?></li>
<?php endforeach; ?>
</ul>

	  </div>
	  <div class="col-md-2 col-xs-4 col-sm-4">

<ul>
<li class="header"><?php echo Page::CATEGORY_2; ?></li>
<?php foreach($this->pages(Page::CATEGORY_2) as $item): ?>
<li><?php echo CHtml::link($item['title'],array('/page/view','name'=>$item['name'])); ?></li>
<?php endforeach; ?>
</ul>

	  </div>
	  <div class="col-md-2 col-xs-4 col-sm-4">
<ul>
<li class="header"><?php echo Page::CATEGORY_3; ?></li>
<?php foreach($this->pages(Page::CATEGORY_3) as $item): ?>
<li><?php echo CHtml::link($item['title'],array('/page/view','name'=>$item['name'])); ?></li>
<?php endforeach; ?>
</ul>
	  </div>
	  <div class="col-md-6 hidden-xs hidden-sm" style="text-align:right;">
<p>Powered By <?php echo Yii::app()->name; ?></p>
<p>&copy; 2014 caoguo.com</p>
<?php echo Yii::app()->config->get('footer_info'); ?>
<?php echo Yii::app()->config->get('stats_code'); ?>
	  </div>
	</div>
  </div>
</footer>