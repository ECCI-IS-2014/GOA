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
                 <?php echo $this->Html->css('catalogs'); ?>
                 <?php echo $this->fetch('header1'); ?>


</head>

<div id="headWish">

</div>

<div id="bodyWish">
    hola
    <?php

                echo $this->CatalogGenerator->formatWishes($wishesPro, 12 );

    ?>
</div>


<div id="footWish">

    <?php echo $this->fetch('footer1'); ?>
</div>
