<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('confirm_password',array('type'=>'password'));
		echo $this->Form->input('name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('phone');
		echo $this->Form->input('address');
		echo $this->Form->input('email');
		// echo $this->Form->input('role');
		echo $this->Form->input('gender', array(
                    'options' => array('F' => 'F', 'M' => 'M')
        ));
		echo $this->Form->input('birth_date',array('minYear'=>1930,'maxYear'=>2014));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
