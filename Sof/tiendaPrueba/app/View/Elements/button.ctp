<?php $this->start('button1'); ?>

<button type="button" id="button1">Filters</button>
<?php $this->end(); ?>


<?php $this->start('reviewButton'); ?>

<?php $this->end(); ?>

<?php $this->start('addCartButton'); ?>

<?php $this->end(); ?>


<?php $this->start('addWishListButton'); ?>

<?php $this->end(); ?>

<?php/*
    INSERTAR JS DE BUTTON AQUI
*/?>


    <script type="text/javascript">
            $(document).ready(function () {


                $("#button1").click (function ()
                {
                    var width = $('#sidebar').width();
                    var parentWidth = $('#sidebar').offsetParent().width();
                    var percent = 100*width/parentWidth;
                    var change=false;
                    if(percent==0){
                     $("#sidebar").animate
                     (
                        {
                            width:'20%'
                        },"slow"
                     );
                     }
                     if(percent>=2)
                     {
                        $("#sidebar").animate
                          (
                            {
                               width:'0%'

                            },"slow"
                          );

                     }
                } );






             });





     </script>


<?php /*TERMINA BUTTON1*/ ?>