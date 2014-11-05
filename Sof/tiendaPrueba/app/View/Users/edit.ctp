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
            		<legend><?php echo __('Edit User'); ?></legend>
            	   <?php
            		echo $this->Form->input('name');
            		echo $this->Form->input('last_name');
            		echo $this->Form->input('phone');
            		echo $this->Form->input('address');
            		echo $this->Form->input('email');
            	   ?>
            	</fieldset>
                <?php echo $this->Form->end(__('Submit')); ?>
            </div>

            <div class="actions">
            	<h3><?php echo __('Actions'); ?></h3>
            	<ul>
            		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
                    <li><?php echo $this->Form->postLink(__('Back to your Profile'), array('action' => 'profile')); ?></li>
            	</ul>
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

        /*function resizeContent() {
            $("#content_wrapper").height( $(window).height() - $("#head").outerHeight() - $("#foot").outerHeight() );
            $("#content_wrapper").width( $(window).width() );
            $("#panel").height( $(window).height() - $("#head").outerHeight() - $("#foot").outerHeight() );
            $("#panel").width( $(window).width() );
        }*/

    </script>

</html>