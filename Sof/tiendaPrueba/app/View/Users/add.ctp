<!DOCTYPE html>
<html>
	<head>
		 <?php echo $this->element('footers'); ?>
		 <?php echo $this->element('headers'); ?>
		 <?php echo $this->element('panel'); ?>
		 <?php echo $this->element('button'); ?>
		 <?php echo $this->element('sidebar'); ?>
		 <?php echo $this->Html->css('sidebar'); ?>
		 <?php echo $this->Html->css('footers'); ?>
		 <?php echo $this->Html->css('headers'); ?>
		 <?php echo $this->Html->css('panel'); ?>
		 <?php echo $this->Html->css('button'); ?>
	</head>

	<div id="head"> <?php echo $this->fetch('header1'); ?> </div>

	<div id="content">

		<div id="content_wrapper" style="position:relative; overflow: hidden;">

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
						echo $this->Form->input('gender', array('options' => array('F' => 'F', 'M' => 'M')));
						echo $this->Form->input('birth_date',array('minYear'=>1930,'maxYear'=>2014));
					?>
				</fieldset>
				<?php echo $this->Form->end(__('Submit')); ?>
			</div>

		</div>

	</div>

	<div style="clear:both"></div>

	<div id="foot"> <?php echo $this->fetch('footer1'); ?> </div>

	<script type="text/javascript">

		$(document).ready(function() {
			resizeContent();
		});

		$(window).resize(function(){
			resizeContent();
		});

	</script>

</html>