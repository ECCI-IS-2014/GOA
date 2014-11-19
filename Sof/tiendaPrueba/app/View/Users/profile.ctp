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

        <div class="users form">
            <h1 style="color:#1E90FF; font-size: 24px;">
                <?php echo 'Welcome to your profile ' . $this->Session->read('Auth.User.username') . '!'; ?>
            </h1>

            <dl width=700px; margin= 0 auto;>
                <dt><?php echo __('Name'); ?></dt>
                <dd>
                    <?php echo $this->Session->read('Auth.User.name'); ?>
                    &nbsp;
                </dd>

                <dt><?php echo __('Last Name'); ?></dt>
                <dd>
                    <?php echo $this->Session->read('Auth.User.last_name'); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Phone'); ?></dt>
                <dd>
                    <?php echo $this->Session->read('Auth.User.phone'); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Address'); ?></dt>
                <dd>
                    <?php echo $this->Session->read('Auth.User.address'); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Email'); ?></dt>
                <dd>
                    <?php echo $this->Session->read('Auth.User.email'); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Gender'); ?></dt>
                <dd>
                    <?php if ($this->Session->read('Auth.User.gender') == 'M'): ?>
                        <?php echo h('Male'); ?>
                    <?php else: ?>
                        <?php echo h('Female'); ?>
                    <?php endif ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Birth Date'); ?></dt>
                <dd>
                    <?php echo $this->StringFormatter->formatDateMDY($this->Session->read('Auth.User.birth_date')); ?>
                    &nbsp;
                </dd>
            </dl>
        </div>

        <div class="actions">
		 <?php
              if ($frecuentuser) {?>
                <h1 style="font-size: 0px; text-align: auto;"><img src = "http://i.imgur.com/xJafY27.png" /><h1>
         <?php  } ?>
            <h3><?php echo __('Actions'); ?></h3>
            <ul>
                <li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $this->Session->read('Auth.User.id'))); ?> </li>
                <li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $this->Session->read('Auth.User.id')),array(), __('Are you sure you want to delete your user?')); ?> </li>
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
                <th class="actions"><?php echo __(' '); ?></th>
            </tr>
            <?php foreach ($user['CreditCard'] as $creditCard): ?>
                <tr>
                    <td><?php echo $creditCard['brand']; ?></td>
                    <td><?php echo $this->StringFormatter->formatCardNumber($this->StringFormatter->hideCardNumber($creditCard['card_number']), '-'); ?></td>
                    <td><?php echo $creditCard['card_name']; ?></td>
                    <td><?php echo $this->StringFormatter->formatDateMY($creditCard['expiration_date']); ?></td>
                    <td class="actions">
                        <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'credit_cards', 'action' => 'delete', $creditCard['id']), array(), __('Are you sure you want to delete this credit card?')); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table>
            <?php endif; ?>

            <div class="actions">
                <ul>
                    <li><?php echo $this->Html->link(__('New Credit Card'), array('controller' => 'credit_cards', 'action' => 'add')); ?> </li>
                </ul>
            </div>
        </div>


        <div class="related" style="margin:0 15px;">
            <br/><br/>
            <h3><?php echo __('Addresses'); ?></h3>
            <?php if (/*!empty($user['CreditCard'])*/1): ?>

            <h4 style="color: #2c6877"><?php echo __('Billing address'); ?></h4>
            <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Country'); ?></th>
                <th><?php echo __('State/Province'); ?></th>
                <th><?php echo __('Detail'); ?></th>
                <th><?php echo __('ZIP code'); ?></th>
                <th class="actions"><?php echo __(' '); ?></th>
            </tr>
                <tr>
                    <td>Costa Rica</td>
                    <td>San José</td>
                    <td>Contiguo al palo de mango</td>
                    <td>11111</td>
                    <td class="actions">
                        <?php echo $this->Form->postLink(__('Edit'), array('controller' => 'addresses', 'action' => 'edit', 1), array()); ?>
                    </td>
                </tr>
            </table>

            <br /><br /><br />

            <h4 style="color: #2c6877"><?php echo __('Shipping addresses'); ?></h4>
            <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Country'); ?></th>
                <th><?php echo __('State/Province'); ?></th>
                <th><?php echo __('Detail'); ?></th>
                <th><?php echo __('ZIP code'); ?></th>
                <th class="actions"><?php echo __(' '); ?></th>
            </tr>
            <?php /*foreach ($user['CreditCard'] as $creditCard):*/ ?>
                <tr>
                    <td>Costa Rica</td>
                    <td>San José</td>
                    <td>Contiguo al palo de mango</td>
                    <td>11111</td>
                    <td class="actions">
                        <?php echo $this->Form->postLink(__('Edit'), array('controller' => 'addresses', 'action' => 'edit', 1), array()); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'addresses', 'action' => 'delete', 1), array(), __('Are you sure you want to delete this address?')); ?>
                    </td>
                </tr>
            <?php /*endforeach;*/ ?>
            </table>

            <?php endif; ?>

            <div class="actions">
                <ul>
                    <li><?php echo $this->Html->link(__('New Address'), array('controller' => 'addresses', 'action' => 'add')); ?> </li>
                </ul>
            </div>
        </div>

    </div> 

    <div style="clear:both"></div>

    <div id="foot"><?php echo $this->fetch('footer1'); ?></div>

</html>

