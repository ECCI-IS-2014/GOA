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

			<div class="sales view">
			<h2><?php echo __('Sale'); ?></h2>
				<dl>
					<dt><?php echo __('User'); ?></dt>
					<dd>
						<?php echo $this->Html->link($sale['User']['name'], array('controller' => 'users', 'action' => 'view', $sale['User']['id'])); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Payment Method'); ?></dt>
					<dd>
						<?php
							App::import('Model', 'CreditCard');
						    $this->CreditCard = new CreditCard();
						    $card = $this->CreditCard->find('first', array(
						    	'conditions' => array('CreditCard.id' => $sale['Sale']['method_payment_id'])
						    ));
					    ?>
						<?php echo h($card['CreditCard']['brand']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Subtotal'); ?></dt>
					<dd>
						<?php echo h($sale['Sale']['subtotal']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Tax'); ?></dt>
					<dd>
						<?php echo h($sale['Sale']['tax']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Discount'); ?></dt>
					<dd>
						<?php echo h($sale['Sale']['frequenly_costumer_discount']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Total'); ?></dt>
					<dd>
						<?php echo h($sale['Sale']['total']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Currency'); ?></dt>
					<dd>
						<?php echo h($sale['Sale']['currency']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('Created'); ?></dt>
					<dd>
						<?php echo h($sale['Sale']['created']); ?>
						&nbsp;
					</dd>
				</dl>
			</div>

			<div style="clear:both"><br/><br/></div>

			<div class="related" style="margin: 0 20px;">
				<h3><?php echo __('Products Sold'); ?></h3>
				<?php if (!empty($sale['ProductSale'])): ?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>
					<th><?php echo __('Product'); ?></th>
					<th><?php echo __('Quantity'); ?></th>
					<th><?php echo __('Price'); ?></th>
					<th><?php echo __('Discount'); ?></th>
				</tr>
				<?php foreach ($sale['ProductSale'] as $productSale): ?>
					<tr>
						<?php
							App::import('Model', 'Product');
						    $this->Product = new Product();
						    $prod = $this->Product->find('first', array(
						    	'conditions' => array('Product.id' => $productSale['product_id'])
						    ));
					    ?>
						<td><?php echo $prod['Product']['name']; ?></td>
						<td><?php echo $productSale['quantity']; ?></td>
						<td><?php echo $productSale['price']; ?></td>
						<td><?php echo $productSale['discount']; ?></td>
					</tr>
				<?php endforeach; ?>
				</table>
				<?php endif; ?>
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
