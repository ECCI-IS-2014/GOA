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

<div id="head">
		<?php echo $this->fetch('header1'); ?>
</div>


<div id="content">


    <div id="starHolder">

        <img src="http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png" class="starHugger" id="star1">
        <img src="http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png" class="starHugger" id="star2">
        <img src="http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png" class="starHugger" id="star3">
        <img src="http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png" class="starHugger" id="star4">
        <img src="http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png" class="starHugger" id="star5">

        <!--<img src="https://animationfascination.files.wordpress.com/2014/10/review-star.jpg"> -->

    </div>
    <div id="reviewHolder">


        <input type="text" id="ReviewDescription" value="No description provided">

    </div>


</div>

<div id="foot">
		<?php echo $this->fetch('footer1'); ?>
</div>

     <script type="text/javascript">
         $(document).ready(function() {

                    starText = $("<p style=\"display: inline;\"></p>")[0];
                    product_id = "<?php echo $prod_id; ?>";
                    s1c = false;
                    s2c = false;
                    s3c = false;
                    s4c = false;
                    s5c = false;
                    clicked = false;
                    $("#starHolder").append(starText);

                    $("#star1").mouseenter(function()
                    {
                        $("#star1").attr('src', 'https://animationfascination.files.wordpress.com/2014/10/review-star.jpg');
                        $("#star1").click(function()
                        {
                            rating=1;
                            clicked = true;
                            s1c = true;

                            var butt = "<button id='saveReview'><a id = 'lin' href = 'http://localhost/GOA/Sof/tiendaPrueba/reviews/save_review/id:"+product_id+"/rating:1'>Save</a></button>";
                            $("#ReviewDescription").after(butt);
                            $("#lin").click(function()
                            {
                                var t = $("#ReviewDescription").value;
                                $("#lin").attr('href', 'http://localhost/GOA/Sof/tiendaPrueba/reviews/save_review/id:'+product_id+'/rating:1/description:'+t);
                            });
                        });
                        if(clicked==false){starText.textContent = "Don't buy it!";}
                    });

                    $("#star1").mouseleave(function()
                     {
                       if(clicked==false)
                       {
                            $("#star1").attr('src', 'http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png');

                            starText.textContent = "";
                       }

                     });

                     $("#star2").mouseenter(function()
                     {
                       $("#star1").attr('src', 'https://animationfascination.files.wordpress.com/2014/10/review-star.jpg');
                       $("#star2").attr('src', 'https://animationfascination.files.wordpress.com/2014/10/review-star.jpg');
                       $("#star2").click(function()
                       {
                          rating=2;
                          clicked = true;
                          s2c = true;
                           s1c = true;
                                                         var butt = "<button id='saveReview'><a id = 'lin' href = 'http://localhost/GOA/Sof/tiendaPrueba/reviews/save_review/id:"+product_id+"/rating:2'>Save</a></button>";
                                                      $("#ReviewDescription").after(butt);
                                                       $("#lin").click(function()
                                                                                  {
                                                                                      var t = $("#ReviewDescription").value;
                                                                                      $("#lin").attr('href', 'http://localhost/GOA/Sof/tiendaPrueba/reviews/save_review/id:'+product_id+'/rating:2/description:'+t);
                                                                                  });

                       });
                       if(clicked==false){starText.textContent = "Order something else!";}
                     });

                     $("#star2").mouseleave(function()
                     {
                       if(clicked==false)
                       {
                          $("#star1").attr('src', 'http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png');
                          $("#star2").attr('src', 'http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png');
                           starText.textContent = "";
                       }
                     });

                     $("#star3").mouseenter(function()
                     {
                       $("#star1").attr('src', 'https://animationfascination.files.wordpress.com/2014/10/review-star.jpg');
                       $("#star2").attr('src', 'https://animationfascination.files.wordpress.com/2014/10/review-star.jpg');
                       $("#star3").attr('src', 'https://animationfascination.files.wordpress.com/2014/10/review-star.jpg');
                       $("#star3").click(function()
                                                                      {
                                                                          rating=3;
                                                                          clicked = true;
                                                                          s3c = true;
                                                                           s1c = true;
                                                                             var butt = "<button id='saveReview'><a id = 'lin' href = 'http://localhost/GOA/Sof/tiendaPrueba/reviews/save_review/id:"+product_id+"/rating:3'>Save</a></button>";
                                                                                                      $("#ReviewDescription").after(butt);
                                                                                                       $("#lin").click(function()
                                                                                                                                  {
                                                                                                                                      var t = $("#ReviewDescription").value;
                                                                                                                                      $("#lin").attr('href', 'http://localhost/GOA/Sof/tiendaPrueba/reviews/save_review/id:'+product_id+'/rating:3/description:'+t);
                                                                                                                                  });

                                                                      });

                       if(clicked==false){starText.textContent = "You get what u paid for!";}
                     });

                     $("#star3").mouseleave(function()
                     {
                        if(clicked==false)
                        {
                          $("#star1").attr('src', 'http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png');
                          $("#star2").attr('src', 'http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png');
                          $("#star3").attr('src', 'http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png');
                          starText.textContent = "";
                        }

                     });

                      $("#star4").mouseenter(function()
                     {
                       $("#star1").attr('src', 'https://animationfascination.files.wordpress.com/2014/10/review-star.jpg');
                       $("#star2").attr('src', 'https://animationfascination.files.wordpress.com/2014/10/review-star.jpg');
                       $("#star3").attr('src', 'https://animationfascination.files.wordpress.com/2014/10/review-star.jpg');
                       $("#star4").attr('src', 'https://animationfascination.files.wordpress.com/2014/10/review-star.jpg');
                        $("#star4").click(function()
                        {
                            s4c = true;
                            rating=4;
                            clicked = true;
                             s1c = true;

                               var butt = "<button id='saveReview'><a id = 'lin' href = 'http://localhost/GOA/Sof/tiendaPrueba/reviews/save_review/id:"+product_id+"/rating:4'>Save</a></button>";
                                                        $("#ReviewDescription").after(butt);
                                                         $("#lin").click(function()
                                                                                    {
                                                                                        var t = $("#ReviewDescription").value;
                                                                                        $("#lin").attr('href', 'http://localhost/GOA/Sof/tiendaPrueba/reviews/save_review/id:'+product_id+'/rating:4/description:'+t);
                                                                                    });
                        });
                       if(clicked==false){starText.textContent = "Really nice product!";}
                     });

                      $("#star4").mouseleave(function()
                      {
                        if(clicked==false){ $("#star1").attr('src', 'http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png');
                        $("#star2").attr('src', 'http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png');
                        $("#star3").attr('src', 'http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png');
                        $("#star4").attr('src', 'http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png');
                         starText.textContent = "";
                         }
                      });

                      $("#star5").mouseenter(function()
                      {
                        $("#star1").attr('src', 'https://animationfascination.files.wordpress.com/2014/10/review-star.jpg');
                        $("#star2").attr('src', 'https://animationfascination.files.wordpress.com/2014/10/review-star.jpg');
                        $("#star3").attr('src', 'https://animationfascination.files.wordpress.com/2014/10/review-star.jpg');
                        $("#star4").attr('src', 'https://animationfascination.files.wordpress.com/2014/10/review-star.jpg');
                        $("#star5").attr('src', 'https://animationfascination.files.wordpress.com/2014/10/review-star.jpg');
                        $("#star5").click(function()
                        {
                            s5c = true;
                            rating=5;
                            clicked = true;
                             s1c = true;
                                 var butt = "<button id='saveReview'><a id = 'lin' href = 'http://localhost/GOA/Sof/tiendaPrueba/reviews/save_review/id:"+product_id+"/rating:5'>Save</a></button>";
                                                        $("#ReviewDescription").after(butt);
                                                         $("#lin").click(function()
                                                                                    {
                                                                                        var t = $("#ReviewDescription").value;
                                                                                        $("#lin").attr('href', 'http://localhost/GOA/Sof/tiendaPrueba/reviews/save_review/id:'+product_id+'/rating:5/description:'+t);
                                                                                    });
                        });

                        if(clicked==false){starText.textContent = "Damn it's amazing!";}
                      });

                      $("#star5").mouseleave(function()
                      {
                        if(clicked==false){$("#star1").attr('src', 'http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png');
                        $("#star2").attr('src', 'http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png');
                        $("#star3").attr('src', 'http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png');
                        $("#star4").attr('src', 'http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png');
                        $("#star5").attr('src', 'http://static.b2bmarketing.net/sites/default/files/image/articles/empty%20star_0.png');
                         starText.textContent = "";}
                      });

                });

     </script>
