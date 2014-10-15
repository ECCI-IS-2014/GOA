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


                     <div id="imagePanel">

                        <?php echo $this->fetch('imagePanel'); ?>

                     </div>

                     <div id="descriptionPanel">

                        <?php echo $this->fetch('descriptionPanel'); ?>

                     </div>


                     <div id="optionsPanel">

                        <?php echo $this->fetch('optionsPanel'); ?>

                     </div>

                    <div style="clear:both"></div>

                    <div id="reviewsPanel">

                        <?php echo $this->fetch('reviewsPanel'); ?>

                    </div>

                    <div id="foot">

                        <?php echo $this->fetch('footer1'); ?>

                    </div>

            </div>





    </html>