




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


                       <div class="users form">
                       <?php echo $this->Session->flash('auth'); ?>
                       <?php echo $this->Form->create('User'); ?>
                           <fieldset>
                               <legend>
                                   <?php echo __('Please enter your username and password'); ?>
                               </legend>
                               <?php echo $this->Form->input('username');
                               echo $this->Form->input('password');
                           ?>
                           </fieldset>
                       <?php echo $this->Form->end(__('Login')); ?>
                       </div>

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