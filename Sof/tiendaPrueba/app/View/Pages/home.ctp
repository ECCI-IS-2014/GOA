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
                        
                        <div style="position:absolute; z-index:10;">
                            <?php echo $this->fetch('sidebar1'); ?>
                        </div>

                        <div style="position:absolute; z-index:5;">
                            <div id="panel">

                                <div id="panel_boundaries">
                                    <?php echo $this->fetch('panel1'); ?>
                                </div>
                                
                            </div>
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