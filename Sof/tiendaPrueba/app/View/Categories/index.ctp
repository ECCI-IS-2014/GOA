<!DOCTYPE html>
<html>
    <head>
         <?php echo $this->element('footers'); ?>
         <?php echo $this->element('headers'); ?>
         <?php echo $this->Html->css('footers'); ?>
         <?php echo $this->Html->css('headers'); ?>
    </head>

    <div id="head"> <?php echo $this->fetch('headerAdmin'); ?> </div>

    <?php  if($this->Session->read('Auth.User.role')== 'admin') { // if is admin  ?>
    
    <div id="content">

        <div id="content_wrapper" style="position:relative;">

			<div class="categories index">
				<h2><?php echo __('Categories'); ?></h2>
				<table cellpadding="0" cellspacing="0">
				<thead>
				<tr>
						<th><?php echo $this->Paginator->sort('name'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
					<?php foreach ($categories as $category): ?>
					<?php if ( $category['Category']['id'] != '0' && $category['Category']['father_category_id'] == '0'): ?>
						<?php $id1 = $category['Category']['id']; ?>
						<tr>
							<td><?php echo h($category['Category']['name']); ?>&nbsp;</td>
							<td class="actions">
								<?php echo $this->Html->link(__('View'), array('action' => 'view', $category['Category']['id'])); ?>
								<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['Category']['id'])); ?>
								<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['Category']['id']), array(), __('Are you sure you want to delete %s?', $category['Category']['name'])); ?>
							</td>
						</tr>
						<?php foreach ($categories as $category_child1): ?>
						<?php if ( $category_child1['Category']['father_category_id'] == $id1): ?>
							<?php $id2 = $category_child1['Category']['id']; ?>
							<tr>
								<td>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<?php echo h($category_child1['Category']['name']); ?>
									&nbsp;
								</td>
								<td class="actions">
									<?php echo $this->Html->link(__('View'), array('action' => 'view', $category_child1['Category']['id'])); ?>
									<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category_child1['Category']['id'])); ?>
									<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category_child1['Category']['id']), array(), __('Are you sure you want to delete %s?', $category_child1['Category']['name'])); ?>
								</td>
							</tr>
							<?php foreach ($categories as $category_child2): ?>
							<?php if ( $category_child2['Category']['father_category_id'] == $id2): ?>
								<tr>
									<td>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<?php echo h($category_child2['Category']['name']); ?>
										&nbsp;
									</td>
									<td class="actions">
										<?php echo $this->Html->link(__('View'), array('action' => 'view', $category_child2['Category']['id'])); ?>
										<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category_child2['Category']['id'])); ?>
										<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category_child2['Category']['id']), array(), __('Are you sure you want to delete %s?', $category_child2['Category']['name'])); ?>
									</td>
								</tr>
							<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
					<?php endforeach; ?>
				</tbody>
				</table>
				
				<p>
				<?php
				echo $this->Paginator->counter(array(
				'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
				));
				?>
				</p>
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
					<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?></li>
					<li><?php echo $this->Html->link(__('New Product'), array('controller'=>'products', 'action' => 'add')); ?></li>
				</ul>
			</div>

		</div>

    </div>

    <?php } else { ?>


        <div id="mich" style= "text-align: center; background-color: black; color: black">
            <p>
                <img src = "http://i.imgur.com/Q8RbYmC.png" />
            </p>
        </div>
        
    <?php } ?>
    
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