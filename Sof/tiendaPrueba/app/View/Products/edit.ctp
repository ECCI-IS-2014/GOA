<div class="products form">
<?php echo $this->Form->create('Product'); ?>
	<fieldset>
		<legend><?php echo __('Edit Product'); ?></legend>
	<?php
		echo $this->Form->input('Product.id');
		echo $this->Form->input('Product.category_id');
		echo $this->Form->input('Product.name');
		echo $this->Form->input('Product.price');
		echo $this->Form->input('Product.quantity');
		//echo $this->Form->input('Product.image');
        echo $this->Form->input('Product.description', array('type' => 'textarea'));
		echo $this->Form->input('Product.enable_product');
		echo $this->Form->input('Rating.enable_rating');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
