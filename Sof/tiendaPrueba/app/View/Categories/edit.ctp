<!DOCTYPE html>
<html>
    <head>
         <?php echo $this->element('footers'); ?>
         <?php echo $this->element('headers'); ?>
         <?php echo $this->Html->css('footers'); ?>
         <?php echo $this->Html->css('headers'); ?>
    </head>

    <div id="head"> <?php echo $this->fetch('headerAdmin'); ?> </div>

    <div id="content">

        <div id="content_wrapper" style="position:relative;">

			<div class="categories form">
			<?php echo $this->Form->create('Category'); ?>
				<fieldset>
					<legend><?php echo __('Edit Category'); ?></legend>
				<?php
					echo $this->Form->input('Category.id');
					echo $this->Form->input('Category.name');
					echo $this->Form->input('Category.father_category_id',array(
			        'type' => 'select',
			        'options' => $categories,
			        'empty' => false,
			        'selected' => $father_id
			        ));
				?>
				</fieldset>
			<?php echo $this->Form->end(__('Submit')); ?>
			</div>
			<div class="actions">
				<h3><?php echo __('Actions'); ?></h3>
				<ul>
					<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Category.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Category.id'))); ?></li>
				</ul>
			</div>

		</div>

    </div>

    <div style="clear:both"></div>

    <div id="foot"> <?php echo $this->fetch('footerAdmin'); ?> </div>

    <script type="text/javascript">

        $(document).ready(function() {
            resizeContent();
        });

        $(window).resize(function(){
            resizeContent();
        });

    </script>

</html>
