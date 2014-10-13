<?php $this->start('button1'); ?>

<button type="button" id="button1">Filters</button>
<?php $this->end(); ?>


<?php/*
    INSERTAR JS DE BUTTON1 AQUI
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


                $("[href='http://localhost/GOA/Sof/tiendaPrueba/Products/productInside']").click(function()
                {
                    var string = $(this).html();
                    string = string.slice(4);
                    alert(string);


                });



             });





     </script>


<?php /*TERMINA BUTTON1*/ ?>