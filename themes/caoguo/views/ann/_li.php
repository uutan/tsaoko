<tr class="<?php echo $index % 2 ? 'ui-table-split' : ''; ?> ">
	<td><?php echo CHtml::link($data->title,array('/ann/view','id'=>$data->id)); ?></td>
	<td></td>
	<td width="130"><?php echo date('Y-m-d H:i:s',$data->updated); ?></td>
</tr>