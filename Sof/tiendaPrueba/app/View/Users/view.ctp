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
						<?php if ($user['User']['gender'] == 'M'): ?>
							<?php echo h('Male'); ?>
						<?php else: ?>
							<?php echo h('Female'); ?>
						<?php endif ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Birth Date'); ?></dt>
					<dd>
						<?php echo h($this->StringFormatter->formatDateMDY($user['User']['birth_date'])); ?>
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

			<?php if ( $user['User']['role'] == '0'): ?>
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

			<div class="related" style="margin:0 15px;">
				<br/><br/>
				<h3><?php echo __('Credit Card Information'); ?></h3>
				<?php if (!empty($user['CreditCard'])): ?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>
					<th><?php echo __('Brand'); ?></th>
					<th><?php echo __('Card Number'); ?></th>
					<th><?php echo __('Card Name'); ?></th>
					<th><?php echo __('Expiration Date'); ?></th>
				</tr>
				<?php foreach ($user['CreditCard'] as $creditCard): ?>
					<tr>
						<td><?php echo $creditCard['brand']; ?></td>
						<td><?php echo $this->StringFormatter->formatCardNumber($creditCard['card_number'], '-'); ?></td>
						<td><?php echo $creditCard['card_name']; ?></td>
						<td><?php echo $this->StringFormatter->formatDateMY($creditCard['expiration_date']); ?></td>
					</tr>
				<?php endforeach; ?>
				</table>
			<?php endif; ?>
			</div>
			
			<?php endif; ?>

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

