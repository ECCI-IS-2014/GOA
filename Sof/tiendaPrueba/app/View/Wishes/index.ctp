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



<div id="bodyWish">
    <?php
    if (count($wishesPro) > 0) {
            echo $this->CatalogGenerator->formatWishes($wishesPro, 12 );
        } else { ?>
             <div>

                <h1 style="font-size: 18px; text-align: center;"> Your Wishlist is empty in this moment, what are you waiting to add some items here!<h1>
                 <h1 style="font-size: 18px; text-align: center;"><img src = "http://i.imgur.com/8aJ7iIZ.gif" /><h1>
             </div>

        <?php } ?>
</div>


<div id="footWish">

    <?php echo $this->fetch('footer1'); ?>
</div>
