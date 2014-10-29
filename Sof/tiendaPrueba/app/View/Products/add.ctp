<!DOCTYPE html>
<html>
    <head>
         <?php echo $this->element('footers'); ?>
         <?php echo $this->element('headers'); ?>
         <?php echo $this->Html->css('footers'); ?>
         <?php echo $this->Html->css('headers'); ?>
    </head>
    <?php
    if($this->Session->read('Auth.User.role')== 'admin') { // if is admin
    ?>
    <div id="head"> <?php echo $this->fetch('headerAdmin'); ?> </div>

    <div id="content">

        <div id="content_wrapper" style="position:relative;">

			<div class="products form">
			<?php echo $this->Form->create('Product', array('action' => 'add', 'type' => 'file')); ?>
				<fieldset>
					<legend><?php echo __('Add Product'); ?></legend>
				<?php
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
					echo $this->Form->input('Product.image', array('type' => 'file'));
					echo $this->Form->input('Rating.enable_rating');
				?>
				</fieldset>
			<?php echo $this->Form->end(__('Add')); ?>
			</div>
			<div class="actions">
				<h3><?php echo __('Actions'); ?></h3>
				<ul>
					<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
				</ul>
			</div>

		</div>

    </div>

    <?php } else {
               ?>

                    <div id="head"> <?php echo $this->fetch('header1'); ?> </div>
                    <div id="mich" style= "text-align: center; background-color: black; color: black">
                    <p>
                            <img src = "http://i.imgur.com/Q8RbYmC.png" />
                     </p>
                     </div>
                <?php
    }
    ?>
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
