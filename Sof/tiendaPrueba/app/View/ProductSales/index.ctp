<div class="productSales index">
	<h2><?php echo __('Product Sales'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('sale_id'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('discount'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($productSales as $productSale): ?>
	<tr>
		<td><?php echo h($productSale['ProductSale']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($productSale['Sale']['id'], array('controller' => 'sales', 'action' => 'view', $productSale['Sale']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($productSale['Product']['name'], array('controller' => 'products', 'action' => 'view', $productSale['Product']['id'])); ?>
		</td>
		<td><?php echo h($productSale['ProductSale']['quantity']); ?>&nbsp;</td>
		<td><?php echo h($productSale['ProductSale']['price']); ?>&nbsp;</td>
		<td><?php echo h($productSale['ProductSale']['discount']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $productSale['ProductSale']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $productSale['ProductSale']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $productSale['ProductSale']['id']), array(), __('Are you sure you want to delete # %s?', $productSale['ProductSale']['id'])); ?>
		</td>
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
		<li><?php echo $this->Html->link(__('New Product Sale'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sales'), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale'), array('controller' => 'sales', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
