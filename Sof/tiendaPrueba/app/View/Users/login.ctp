




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

            <div id="content">

                <div id="head"><?php echo $this->fetch('header1'); ?> </div>

               <div class="users form">
                   <?php echo $this->Session->flash('auth'); ?>
                   <?php echo $this->Form->create('User'); ?>
                       <fieldset>
                           <legend>
                               <p style="color:#1E90FF"> <?php echo __('Please enter your username and password'); ?> <p/>
                           </legend>
                           <?php echo $this->Form->input('username');
                           echo $this->Form->input('password');
                       ?>
                       </fieldset>
                   <?php echo $this->Form->end(__('Login')); ?>
               </div>

                <div style="clear:both"></div>

                <div id="foot"> <?php echo $this->fetch('footer1'); ?> </div>

            </div>
    </html>