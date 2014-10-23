<div class="products view">
	<h2><?php echo __('Product'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($product['Product']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($product['Category']['name'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($product['Product']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($product['Product']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($product['Product']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weight'); ?></dt>
		<dd>
			<?php echo h($this->StringFormatter->formatWeight($product['Product']['weight'], 'kg') ); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Volume'); ?></dt>
		<dd>
			<?php echo $this->StringFormatter->formatVolume($product['Product']['volume'], 'cm'); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php if ( $product['Product']['image'] != null ): ?>
                <?php echo $this->Html->image('product_icons/' . $product['Product']['image'], array('alt' => 'CakePHP')); ?>
            <?php endif; ?>
            &nbsp;
		</dd>
        <dt><?php echo __('Description'); ?></dt>
        <dd>
            <?php echo h($product['Product']['description']); ?>
            &nbsp;
        </dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php if ( $product['Product']['enable_product'] == '1'): ?>
				<?php echo h('Enabled'); ?>
			<?php else: ?>
				<?php echo h('Disabled'); ?>
			<?php endif; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rating'); ?></dt>
        <dd>
            <?php if ( $product['Rating']['enable_rating'] == '1' ): ?>
                <?php echo h($product['Product']['rating']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Product'), array('action' => 'edit', $product['Product']['id'])); ?> </li>
		<li>
			<?php if ( $product['Product']['enable_product'] == '1'): ?>
				<?php echo $this->Form->postLink(__('Disable Product'), array('action' => 'disable', $product['Product']['id']), array(), __('Are you sure you want to disable # %s?', $product['Product']['id'])); ?>
			<?php else: ?>
				<?php echo $this->Form->postLink(__('Enable Product'), array('action' => 'enable', $product['Product']['id']), array(), __('Are you sure you want to enable # %s?', $product['Product']['id'])); ?>
			<?php endif; ?>
		</li>
		<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?> </li>
	</ul>
</div>

<div class="related">
	<br/>
	<?php if (!empty($product['Rating']) && $product['Rating']['enable_rating'] == '1'): ?>
	<h3><?php echo __('Total Ratings'); ?></h3>
		<dl>
			<dt><?php echo __('1 Star'); ?></dt>
			<dd>
				<?php echo $product['Rating']['rating1']; ?>
				&nbsp;
			</dd>
			<dt><?php echo __('2 Stars'); ?></dt>
			<dd>
				<?php echo $product['Rating']['rating2']; ?>
				&nbsp;
			</dd>
			<dt><?php echo __('3 Stars'); ?></dt>
			<dd>
				<?php echo $product['Rating']['rating3']; ?>
				&nbsp;
			</dd>
			<dt><?php echo __('4 Stars'); ?></dt>
			<dd>
				<?php echo $product['Rating']['rating4']; ?>
				&nbsp;
			</dd>
			<dt><?php echo __('5 Stars'); ?></dt>
			<dd>
				<?php echo $product['Rating']['rating5']; ?>
				&nbsp;
			</dd>
		</dl>
	<?php endif; ?>
</div>
