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

			<div class="products index">
				<h2><?php echo __('Products'); ?></h2>
				<table cellpadding="0" cellspacing="0">
				<thead>
				<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('category_id'); ?></th>
						<th><?php echo $this->Paginator->sort('name'); ?></th>
						<th><?php echo $this->Paginator->sort('price'); ?></th>
						<th><?php echo $this->Paginator->sort('quantity'); ?></th>
						<th><?php echo $this->Paginator->sort('enable_product'); ?></th>
						<th><?php echo $this->Paginator->sort('rating'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($products as $product): ?>
				<tr>
					<td><?php echo h($product['Product']['id']); ?>&nbsp;</td>
					<td>
						<?php echo $this->Html->link($product['Category']['name'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id'])); ?>
					</td>
					<td><?php echo h($product['Product']['name']); ?>&nbsp;</td>
					<td><?php echo h($product['Product']['price']); ?>&nbsp;</td>
					<td><?php echo h($product['Product']['quantity']); ?>&nbsp;</td>
					<td><?php if ( $product['Product']['enable_product'] == '1'): ?>
							<?php echo h('Enabled'); ?>
						<?php else: ?>
							<?php echo h('Disabled'); ?>
						<?php endif; ?>&nbsp;
					</td>
					<td><?php if ( $product['Rating']['enable_rating'] == '1'): ?>
							<?php echo h($product['Product']['rating']).' stars'; ?>
						<?php else: ?>
							<?php echo h('Disabled'); ?>
						<?php endif; ?>&nbsp;
					</td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('action' => 'view', $product['Product']['id'])); ?>
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $product['Product']['id'])); ?>
						<?php if ( $product['Product']['enable_product'] == '1'): ?>
							<?php echo $this->Form->postLink(__('Disable'), array('action' => 'disable', $product['Product']['id']), array(), __('Are you sure you want to disable # %s?', $product['Product']['id'])); ?>
						<?php else: ?>
							<?php echo $this->Form->postLink(__('Enable'), array('action' => 'enable', $product['Product']['id']), array(), __('Are you sure you want to enable # %s?', $product['Product']['id'])); ?>
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
					<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?></li>
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

        /*function resizeContent() {
            $("#content_wrapper").height( $(window).height() - $("#head").outerHeight() - $("#foot").outerHeight() );
            $("#content_wrapper").width( $(window).width() );
            $("#panel").height( $(window).height() - $("#head").outerHeight() - $("#foot").outerHeight() );
            $("#panel").width( $(window).width() );
        }*/

    </script>

</html>

