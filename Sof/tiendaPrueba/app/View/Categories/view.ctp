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

			<div class="categories view">
			<h2><?php echo __('Category'); ?></h2>
				<dl>
					<dt><?php echo __('Id'); ?></dt>
					<dd>
						<?php echo h($category['Category']['id']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Name'); ?></dt>
					<dd>
						<?php echo h($category['Category']['name']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Parent Category'); ?></dt>
					<dd>
					    <?php if ( $category['Category']['father_category_id'] == '0'): ?>
							<?php echo h('No parent category.'); ?>
						<?php else: ?>
							<?php echo h($category['Category']['father_category_id']); ?>
						<?php endif; ?>
			            &nbsp;
			        </dd>
				</dl>
			</div>

			<div class="actions">
				<h3><?php echo __('Actions'); ?></h3>
				<ul>
					<li><?php echo $this->Html->link(__('Edit Category'), array('action' => 'edit', $category['Category']['id'])); ?> </li>
					<li><?php echo $this->Form->postLink(__('Delete Category'), array('action' => 'delete', $category['Category']['id']), array(), __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?> </li>
					<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?> </li>
	
				</ul>
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
			<div style="clear:both"><br/><br/><br/></div>

			<div class="related" style="margin: 0 20px;">
				<h3><?php echo __('Related Products'); ?></h3>
				<?php if (!empty($category['Product'])): ?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>
					<th><?php echo __('Id'); ?></th>
					<th><?php echo __('Name'); ?></th>
					<th><?php echo __('Price'); ?></th>
					<th><?php echo __('Quantity'); ?></th>
					<th><?php echo __('Weight'); ?></th>
					<th><?php echo __('Status'); ?></th>
					<th><?php echo __('Rating'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				<?php foreach ($category['Product'] as $product): ?>
					<tr>
						<td><?php echo $product['id']; ?></td>
						<td><?php echo $product['name']; ?></td>
						<td><?php echo $product['price']; ?></td>
						<td><?php echo $product['quantity']; ?></td>
						<td><?php echo $this->StringFormatter->formatWeight($product['weight'], 'kg') ; ?></td>
						<td>
							<?php if ( $product['enable_product'] == '1'): ?>
								<?php echo h('Enabled'); ?>
							<?php else: ?>
								<?php echo h('Disabled'); ?>
							<?php endif; ?>
						</td>
						<td><?php echo $product['rating']; ?></td>
						<td class="actions">
							<?php echo $this->Html->link(__('View'), array('controller' => 'products', 'action' => 'view', $product['id'])); ?>
							<?php echo $this->Html->link(__('Edit'), array('controller' => 'products', 'action' => 'edit', $product['id'])); ?>
							<?php echo $this->Form->postLink(__('Disable'), array('controller' => 'products', 'action' => 'disable', $product['id']), array(), __('Are you sure you want to disable # %s?', $product['id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</table>
				<?php endif; ?>

				<div class="actions">
					<ul>
						<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
					</ul>
				</div>
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
