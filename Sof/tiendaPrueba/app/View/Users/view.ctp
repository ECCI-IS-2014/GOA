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

        <div id="content_wrapper" style="position:relative; overflow: hidden;">

			<div class="users view">
			<h2><?php echo __('User'); ?></h2>
				<dl>
					<dt><?php echo __('Id'); ?></dt>
					<dd>
						<?php echo h($user['User']['id']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Username'); ?></dt>
					<dd>
						<?php echo h($user['User']['username']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Role'); ?></dt>
			        <dd>
			            <?php if ( $user['User']['role'] == '1'): ?>
			                <?php echo h('Admin'); ?>
			            <?php else: ?>
			                <?php echo h('User'); ?>
			            <?php endif; ?>
			            &nbsp;
			        </dd>
					<dt><?php echo __('Created'); ?></dt>
					<dd>
						<?php echo h($user['User']['created']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Modified'); ?></dt>
					<dd>
						<?php echo h($user['User']['modified']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Name'); ?></dt>
					<dd>
						<?php echo h($user['User']['name']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Last Name'); ?></dt>
					<dd>
						<?php echo h($user['User']['last_name']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Phone'); ?></dt>
					<dd>
						<?php echo h($user['User']['phone']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Address'); ?></dt>
					<dd>
						<?php echo h($user['User']['address']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Email'); ?></dt>
					<dd>
						<?php echo h($user['User']['email']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Gender'); ?></dt>
					<dd>
						<?php echo h($user['User']['gender']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Birth Date'); ?></dt>
					<dd>
						<?php echo h($user['User']['birth_date']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Status'); ?></dt>
			        <dd>
			            <?php if ( $user['User']['status'] == '1'): ?>
			                <?php echo h('Enabled'); ?>
			            <?php else: ?>
			                <?php echo h('Disabled'); ?>
			            <?php endif; ?>
			            &nbsp;
			        </dd>
				</dl>
			</div>

			<div class="actions">
				<h3><?php echo __('Actions'); ?></h3>
				<ul>
					<li>
						<?php if ( $user['User']['status'] == '1'): ?>
							<?php echo $this->Form->postLink(__('Disable User'), array('action' => 'disable', $user['User']['id']), array(), __('Are you sure you want to disable # %s?', $user['User']['id'])); ?>
						<?php else: ?>
							<?php echo $this->Form->postLink(__('Enable User'), array('action' => 'enable', $user['User']['id']), array(), __('Are you sure you want to enable # %s?', $user['User']['id'])); ?>
						<?php endif; ?>
					</li>
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

