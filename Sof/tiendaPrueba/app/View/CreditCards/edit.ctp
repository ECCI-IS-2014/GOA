<div class="creditCards form">
<?php echo $this->Form->create('CreditCard'); ?>
	<fieldset>
		<legend><?php echo __('Edit Credit Card'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('brand');
		echo $this->Form->input('card_number');
		echo $this->Form->input('card_name');
		echo $this->Form->input('expiration_date');
		echo $this->Form->input('verification_number');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('CreditCard.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('CreditCard.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Credit Cards'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
