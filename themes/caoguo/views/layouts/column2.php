<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="section-wrap">
	<div class="container">
		
		<div class="col-md-3">

		<?php if( $this->menu ): ?>
		<ul class="nav nav-secondary">
            <li class="nav-heading">THIS IS HEADINGS</li>
            <?php foreach($this->menu as $item): ?>
            <li><?php echo CHtml::link($item['label'],$item['url']); ?></li>
        	<?php endforeach; ?>
        </ul>
		<?php endif; ?>



		</div>


		<div class="col-md-9">
			
		<?php echo $content; ?>


		</div>

</div>
<?php $this->endContent(); ?>