<div class="wishes view">
<h2><?php echo __('Wish'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($wish['Wish']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($wish['User']['name'], array('controller' => 'users', 'action' => 'view', $wish['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($wish['Product']['name'], array('controller' => 'products', 'action' => 'view', $wish['Product']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Wish'), array('action' => 'edit', $wish['Wish']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Wish'), array('action' => 'delete', $wish['Wish']['id']), array(), __('Are you sure you want to delete # %s?', $wish['Wish']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Wishes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Wish'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
