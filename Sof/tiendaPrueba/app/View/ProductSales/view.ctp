<div class="productSales view">
<h2><?php echo __('Product Sale'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productSale['ProductSale']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sale'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productSale['Sale']['id'], array('controller' => 'sales', 'action' => 'view', $productSale['Sale']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productSale['Product']['name'], array('controller' => 'products', 'action' => 'view', $productSale['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($productSale['ProductSale']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($productSale['ProductSale']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Discount'); ?></dt>
		<dd>
			<?php echo h($productSale['ProductSale']['discount']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Product Sale'), array('action' => 'edit', $productSale['ProductSale']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product Sale'), array('action' => 'delete', $productSale['ProductSale']['id']), array(), __('Are you sure you want to delete # %s?', $productSale['ProductSale']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Sales'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Sale'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales'), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale'), array('controller' => 'sales', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
