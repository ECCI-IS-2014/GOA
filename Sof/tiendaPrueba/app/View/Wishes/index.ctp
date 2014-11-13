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
        <?php echo $this->Html->css('catalogs'); ?>    
    </head>

    <div id="headWish">
        <?php echo $this->fetch('header1'); ?>
    </div>

    <div id="content">

        <div id="content_wrapper" style="position:relative;">

            <div id="bodyWish">
                <?php if (count($wishesPro) > 0) : ?>

                    <h1 style="font-size: 18px; text-align: center; margin:15px 0;"> 
                        Welcome to your Wishlist <?php echo $this->Session->read('Auth.User.name'); ?>, add all you like in here! We will keep it for you!
                    </h1>

                    <?php echo $this->CatalogGenerator->formatWishes($wishesPro, 30 ); ?>

                <?php else: ?>
                         
                        <div>
                            <br/>
                            <h1 style="font-size: 18px; text-align: center;">
                                Your Wishlist is empty at the moment, what are you waiting to add some items?!
                            </h1>
                            <div style="font-size: 18px; text-align: center;">
                                <img src = "http://i.imgur.com/8aJ7iIZ.gif" />
                            </div>
                        </div>

                <?php endif ?>
                
            </div>

        </div>

    </div>

    <div id="footWish">
        <?php echo $this->fetch('footer1'); ?>
    </div>
</html>