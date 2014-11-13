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

			<div class="sales index">
				<h2><?php echo __('Sales'); ?></h2>
				<table cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('user_id'); ?></th>
						<th><?php echo $this->Paginator->sort('subtotal'); ?></th>
						<th><?php echo $this->Paginator->sort('tax'); ?></th>
						<th><?php echo $this->Paginator->sort('discount'); ?></th>
						<th><?php echo $this->Paginator->sort('total'); ?></th>
						<th><?php echo $this->Paginator->sort('currency'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($sales as $sale): ?>
					<tr>
						<td><?php echo h($sale['Sale']['id']); ?>&nbsp;</td>
						<td>
							<?php echo $this->Html->link($sale['User']['name'], array('controller' => 'users', 'action' => 'view', $sale['User']['id'])); ?>
						</td>
						<td><?php echo h($sale['Sale']['subtotal']); ?>&nbsp;</td>
						<td><?php echo h($sale['Sale']['tax']); ?>&nbsp;</td>
						<td><?php echo h($sale['Sale']['frequenly_costumer_discount']); ?>&nbsp;</td>
						<td><?php echo h($sale['Sale']['total']); ?>&nbsp;</td>
						<td><?php echo h($sale['Sale']['currency']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link(__('View'), array('action' => 'view', $sale['Sale']['id'])); ?>
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