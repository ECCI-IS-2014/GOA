<div class="categories index">
	<h2><?php echo __('Categories'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('father_category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('enable_category'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($categories as $category): ?>
	<tr>
		<?php if ( $category['Category']['id'] != '0'): ?>
        	<td><?php echo h($category['Category']['id']); ?>&nbsp;</td>
        	<td><?php echo h($category['Category']['name']); ?>&nbsp;</td>
        	
			 <td>
				<?php if ( $category['Category']['father_category_id'] != '0' ): ?>
					<?php foreach ($categories as $father_cate): ?>
						<?php if ( $category['Category']['father_category_id'] == $father_cate['Category']['id']): ?>
							<?php echo $this->Html->link($father_cate['Category']['name'], array('controller' => 'categories', 'action' => 'view', $category['Category']['father_category_id'])); ?>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
				&nbsp;
			</td>
        	<td>
				<?php if ( $category['Category']['enable_category'] == '1'): ?>
        			<?php echo h('Enabled'); ?>
        		<?php else: ?>
        			<?php echo h('Disabled'); ?>
        		<?php endif; ?>&nbsp;
        	</td>
        	<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $category['Category']['id'])); ?>
        		<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['Category']['id'])); ?>
        		<?php echo $this->Form->postLink(__('Disable'), array('action' => 'disable', $category['Category']['id']), array(), __('Are you sure you want to disable # %s?', $category['Category']['id'])); ?>
        	</td>
		<?php endif; ?>
     </tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
	</ul>
</div>
