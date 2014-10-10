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


                     <div id="content2">



                     </div>

                    <div id="sidebar">
                        <?php echo $this->fetch('sidebar1'); ?>

                    </div>

                    <?php echo $this->fetch('button1'); ?>


                    <div id="panel">
                        <?php echo $this->fetch('panel1'); ?>



                    </div>

                    <div style="clear:both"></div>

                    <div id="foot">

                        <?php echo $this->fetch('footer1'); ?>

                    </div>

            </div>







    </html>