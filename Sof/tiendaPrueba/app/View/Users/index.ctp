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
			
			<div class="users index">
				<h2><?php echo __('Users'); ?></h2>
				<table cellpadding="0" cellspacing="0">
				<thead>
				<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('username'); ?></th>
						<th><?php echo $this->Paginator->sort('role'); ?></th>
						<th><?php echo $this->Paginator->sort('name'); ?></th>
						<th><?php echo $this->Paginator->sort('last_name'); ?></th>
						<th><?php echo $this->Paginator->sort('phone'); ?></th>
						<th><?php echo $this->Paginator->sort('email'); ?></th>
						<th><?php echo $this->Paginator->sort('status'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($users as $user): ?>
					<tr>
						
						<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
						<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
						<td><?php if ( $user['User']['role'] == '1'): ?>
								<?php echo h('Admin'); ?>
							<?php else: ?>
								<?php echo h('User'); ?>
							<?php endif; ?>&nbsp;
						</td>
						<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
						<td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>
						<td><?php echo h($user['User']['phone']); ?>&nbsp;</td>
						<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
						<td><?php if ( $user['User']['status'] == '1'): ?>
								<?php echo h('Enabled'); ?>
							<?php else: ?>
								<?php echo h('Disabled'); ?>
							<?php endif; ?>&nbsp;
						</td>
						<td class="actions">
		
							<?php if ( $user['User']['role'] == '0'): ?>
								<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
								<?php if ( $user['User']['status'] == '1'): ?>
									<?php echo $this->Form->postLink(__('Disable'), array('action' => 'disable', $user['User']['id']), array(), __('Are you sure you want to disable # %s?', $user['User']['id'])); ?>
								<?php else: ?>
									<?php echo $this->Form->postLink(__('Enable'), array('action' => 'enable', $user['User']['id']), array(), __('Are you sure you want to enable # %s?', $user['User']['id'])); ?>
								<?php endif; ?>
							<?php endif; ?>
						</td>
						
					</tr>
					
				<?php endforeach; ?>
				</tbody>
				</table>
				<p>
				<?php
				echo $this->Paginator->counter(array(
				'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
				));
				?>	</p>
				<div class="paging">
				<?php
					echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
					echo $this->Paginator->numbers(array('separator' => ''));
					echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
				?>
				</div>
			</div>
			<div class="actions">
				<h3><?php echo __('Actions'); ?></h3>
				<ul>
					<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
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

        /*function resizeContent() {
            $("#content_wrapper").height( $(window).height() - $("#head").outerHeight() - $("#foot").outerHeight() );
            $("#content_wrapper").width( $(window).width() );
            $("#panel").height( $(window).height() - $("#head").outerHeight() - $("#foot").outerHeight() );
            $("#panel").width( $(window).width() );
        }*/

    </script>

</html>
