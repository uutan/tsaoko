<tr class="<?php echo $index % 2 ? 'ui-table-split' : ''; ?> ">
	<td>
	<?php echo CHtml::link($data->title,array('/service/view','id'=>$data->id)); ?>
	<p>分类：<?php echo $data->category->name; ?></p>
	</td>
	<td><?php echo $data->views; ?></td>
	<td width="130"><?php echo date('Y-m-d H:i:s',$data->updated); ?></td>
</tr>