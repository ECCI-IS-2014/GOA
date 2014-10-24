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
        
			<div class="products form">
			<?php echo $this->Form->create('Product'); ?>
				<fieldset>
					<legend><?php echo __('Edit Product'); ?></legend>
				<?php
					echo $this->Form->input('Product.id');
					echo $this->Form->input('Product.category_id',array(
					'type' => 'select',
					'options' => $categories,
					'empty' => false
					));
					echo $this->Form->input('Product.name');
					echo $this->Form->input('Product.price');
					echo $this->Form->input('Product.quantity');
					echo $this->Form->input('Product.weight');
					echo $this->Form->input('Product.volume');
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
			        <li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?> </li>
					<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
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