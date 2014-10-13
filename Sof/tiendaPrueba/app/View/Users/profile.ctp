
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

                <div id="head">
                    <?php echo $this->fetch('header1'); ?>
                </div>

                    <div id="content_wrapper" style="position:relative; overflow: hidden;">

                        <!--<div style="position:absolute; z-index:10;">
                            <?php echo $this->fetch('sidebar1'); ?>
                        </div>

                        <div style="position:absolute; z-index:5;">
                            <div id="panel">

                                <div id="panel_boundaries">
                                    <?php echo $this->fetch('panel1'); ?>
                                </div>

                            </div>
                        </div>-->

                        <!--   ////////////////////////////////////////////////////  -->

                        <div class="users profile">

                        <h2 style="color:#1E90FF;"><?php echo __('Welcome to your Profile ');
                                  echo $this->Session->read('Auth.User.username'); ?></h2>
                        	<dl>
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
                        			<?php echo $this->Session->read('Auth.User.gender'); ?>
                        			&nbsp;
                        		</dd>
                        		<dt><?php echo __('Birth Date'); ?></dt>
                        		<dd>
                        			<?php echo $this->Session->read('Auth.User.birth_date'); ?>
                        			&nbsp;
                        		</dd>
                        	</dl>
                        </div>

                        <div class="actions">
                        	<h3><?php echo __('Actions'); ?></h3>
                        	<ul>
                        		<li><?php echo $this->Html->link(__('Edit user'), array('action' => 'edit', $this->Session->read('Auth.User.id'))); ?> </li>
                        		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $this->Session->read('Auth.User.id'))); ?> </li>
                        	 <li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?> </li>


                        	</ul>
                        </div>

                        <!-- /////////////////////////////////////////////////////////  -->

                    </div>

                    <div style="clear:both"></div>

                    <div id="foot">

                        <?php echo $this->fetch('footer1'); ?>

                    </div>

            </div>

        <script type="text/javascript">

        $(document).ready(function() {
            resizeContent();
        });

        $(window).resize(function(){
            resizeContent();
        });

        function resizeContent() {
            $("#content_wrapper").height( $(window).height() - $("#head").outerHeight() - $("#foot").outerHeight() );
            $("#content_wrapper").width( $(window).width() );
            $("#panel").height( $(window).height() - $("#head").outerHeight() - $("#foot").outerHeight() );
            $("#panel").width( $(window).width() );
        }

        </script>

    </html>

