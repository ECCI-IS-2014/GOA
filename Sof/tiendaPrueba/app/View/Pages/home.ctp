<!DOCTYPE html>
<html>
    <head>
         <?php echo $this->element('footers'); ?>
         <?php echo $this->element('headers'); ?>
         <?php echo $this->Html->css('footers'); ?>
         <?php echo $this->Html->css('headers'); ?>
    </head>




        <div id="content">

            <div id="head">

                <p>SOY EL HEAD</p>
                <?php echo $this->fetch('header1'); ?>

            </div>


                 <div id="content2">

                    <p>SOY EL CUERPO</p>

                 </div>






                <div id="foot">
                    <p>SOY EL FOOT</p>
                    <?php echo $this->fetch('footer1'); ?>

                </div>

        </div>







</html>