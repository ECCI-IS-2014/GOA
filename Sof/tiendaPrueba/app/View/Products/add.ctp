<div class="products form">
<?php echo $this->Form->create('Product', array('action' => 'add', 'type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Product'); ?></legend>
	<?php
		echo $this->Form->input('Product.category_id');
		echo $this->Form->input('Product.name');
		echo $this->Form->input('Product.price');
		echo $this->Form->input('Product.quantity');
        echo $this->Form->input('Product.description', array('type' => 'textarea'));
		echo $this->Form->input('Product.image', array('type' => 'file'));
		echo $this->Form->input('Rating.enable_rating');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Add')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
