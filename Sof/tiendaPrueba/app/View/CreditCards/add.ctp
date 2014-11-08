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

		<div class="creditCards form">
		<?php echo $this->Form->create('CreditCard'); ?>
			<fieldset>
				<legend><?php echo __('Add Credit Card'); ?></legend>
			<?php
				echo $this->Form->input('brand', array('type'=>'select','options'=>$card_brands));
				echo $this->Form->input('card_number');
				echo $this->Form->input('card_name');
				echo $this->Form->input('expiration_date', 
					array('type' => 'date','minYear' => 2012,'maxYear'=>2024,'dateFormat'=>'MY')
				);
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
