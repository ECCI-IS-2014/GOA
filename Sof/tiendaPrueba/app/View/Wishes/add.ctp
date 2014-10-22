<div class="wishes form">
<?php echo $this->Form->create('Wish'); ?>
	<fieldset>
		<legend><?php echo __('Add Wish'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('product_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Wishes'), array('action' => 'index')); ?></li>
	</ul>
</div>
