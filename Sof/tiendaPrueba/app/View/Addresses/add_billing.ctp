<!DOCTYPE html>
<html>
    <head>
         <?php echo $this->element('footers'); ?>
         <?php echo $this->element('headers'); ?>
         <?php echo $this->Html->css('footers'); ?>
         <?php echo $this->Html->css('headers'); ?>
    </head>

    <div id="head"> <?php echo $this->fetch('header1'); ?> </div>

    <div id="content">

		<div class="addresses form">
		<?php echo $this->Form->create('Address'); ?>
			<fieldset>
				<legend><?php echo __('Add Billing Address'); ?></legend>
			<?php
				echo $this->Form->input('country', array('options' => $this->Countries->getArray()));
				echo $this->Form->input('state');
				echo $this->Form->input('city');
				echo $this->Form->input('street');
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Submit')); ?>
		</div>

		<div class="actions">
			<h3><?php echo __('Actions'); ?></h3>
			<ul>
				<li><?php echo $this->Html->link(__('Return to Profile'), array('controller' => 'users', 'action' => 'profile')); ?> </li>
			</ul>
		</div>
				
	</div> 

    <div style="clear:both"></div>

    <div id="foot"><?php echo $this->fetch('footer1'); ?></div>

</html>
