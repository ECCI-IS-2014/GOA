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
     <?php echo $this->Html->css('review'); ?>


</head>

<div id="head">
		<?php echo $this->fetch('header1'); ?>
</div>


<div id="content">

  <h2 class="mtitle">Write a review for <?php echo $prod_name; ?></h2>


    <div id="starHolder">

        <div class="starHugger starGraphicEmpty starg" id="star1"></div>
        <div class="starHugger starGraphicEmpty starg" id="star2"></div>
        <div class="starHugger starGraphicEmpty starg" id="star3"></div>
        <div class="starHugger starGraphicEmpty starg" id="star4"></div>
        <div class="starHugger starGraphicEmpty starg" id="star5"></div>

        <!--<img src="https://animationfascination.files.wordpress.com/2014/10/review-star.jpg"> -->

    </div>
    <div id="reviewHolder">
        <textarea rows="8" maxlength=5000 id="ReviewDescription">Tell us what you think of this product</textarea>
    </div>

    <a id="save_btn" href="">Save Review</a>

</div>

<div id="foot">
		<?php echo $this->fetch('footer1'); ?>
</div>

     <script type="text/javascript">

        function resetStars(rating) {
          index = 0;
          for(index = rating+1; index < 6; index++) {
            $("#star" + index).removeClass("starGraphicFull").addClass('starGraphicEmpty');
          }
        }

         $(document).ready(function() {

                    starText = $("<p style=\"display: inline;\"></p>")[0];
                    product_id = "<?php echo $prod_id; ?>";
                    s1c = false;
                    s2c = false;
                    s3c = false;
                    s4c = false;
                    s5c = false;
                    clicked = false;
                    rating = 0;
                    default_desc = true;
                    save_btn = $("#save_btn");

                    $("#ReviewDescription").click(function(){
                      if(default_desc == true) {
                        default_desc = false;
                        $(this).html("");
                      }
                    });

                    $("#starHolder").append(starText);

                    $("#save_btn").click(function(){
                      var txt = '<?php echo $this->Html->url(array("controller"=>"reviews", "action"=>"save_review", "id"=>$prod_id, "description"=>"")); ?>';
                      var desc = $("#ReviewDescription").html();
                      var url = txt + "'" + desc + "'";
                      alert(url);
                    });

                    $("#star1").mouseenter(function()
                    {
                        $("#star1").removeClass('starGraphicEmpty').addClass('starGraphicFull');
                        starText.textContent = "Don't buy it!";
                    });

                    $("#star1").mouseleave(function()
                     {

                      if(rating < 1) {
                        $("#star1").removeClass("starGraphicFull").addClass("starGraphicEmpty");
                      }

                      starText.textContent = "";

                     });

                    $("#star1").click(function()
                    {
                        rating=1;
                        clicked = true;
                        s1c = true;
                        resetStars(rating);
                    });

                     $("#star2").mouseenter(function()
                     {
                       $("#star1").removeClass('starGraphicEmpty').addClass('starGraphicFull');
                       $("#star2").removeClass('starGraphicEmpty').addClass('starGraphicFull');
                       
                       starText.textContent = "Order something else!";
                     });

                     $("#star2").mouseleave(function()
                     {

                        if(rating < 2) {
                          $("#star2").removeClass("starGraphicFull").addClass("starGraphicEmpty");

                          if(rating < 1) {
                            $("#star1").removeClass("starGraphicFull").addClass("starGraphicEmpty");
                          }
                        }

                         starText.textContent = "";

                     });

                     $("#star2").click(function()
                     {
                        rating=2;
                        clicked = true;
                        s2c = true;
                        s1c = true;
                        resetStars(rating);
                     });

                     $("#star3").mouseenter(function()
                     {
                       $("#star1").removeClass('starGraphicEmpty').addClass('starGraphicFull');
                       $("#star2").removeClass('starGraphicEmpty').addClass('starGraphicFull');
                       $("#star3").removeClass('starGraphicEmpty').addClass('starGraphicFull');

                       starText.textContent = "You get what u paid for!";
                     });

                     $("#star3").mouseleave(function()
                     {

                      if(rating < 3) {
                        $("#star3").removeClass("starGraphicFull").addClass("starGraphicEmpty");
                        if(rating < 2) {
                          $("#star2").removeClass("starGraphicFull").addClass("starGraphicEmpty");
                          if(rating < 1) {
                            $("#star1").removeClass("starGraphicFull").addClass("starGraphicEmpty");
                          }
                        }
                      }

                      starText.textContent = "";

                     });

                     $("#star3").click(function()
                      {
                          rating=3;
                          clicked = true;
                          s3c = true;
                          s1c = true;
                          resetStars(rating);
                      });

                      $("#star4").mouseenter(function()
                      {
                        $("#star1").removeClass("starGraphicEmpty").addClass("starGraphicFull");
                        $("#star2").removeClass("starGraphicEmpty").addClass("starGraphicFull");
                        $("#star3").removeClass("starGraphicEmpty").addClass("starGraphicFull");
                        $("#star4").removeClass("starGraphicEmpty").addClass("starGraphicFull");

                        starText.textContent = "Really nice product!";
                      });

                      $("#star4").mouseleave(function()
                      {

                        if(rating < 4) {
                          $("#star4").removeClass("starGraphicFull").addClass("starGraphicEmpty");
                          if(rating < 3) {
                            $("#star3").removeClass("starGraphicFull").addClass("starGraphicEmpty");
                            if(rating < 2) {
                              $("#star2").removeClass("starGraphicFull").addClass("starGraphicEmpty");
                              if(rating < 1) {
                                $("#star1").removeClass("starGraphicFull").addClass("starGraphicEmpty");
                              }
                            }
                          }
                        }

                        starText.textContent = "";

                      });

                      $("#star4").click(function()
                      {
                          s4c = true;
                          rating=4;
                          clicked = true;
                          s1c = true;
                          resetStars(rating);
                      });

                      $("#star5").mouseenter(function()
                      {
                        $("#star1").removeClass("starGraphicEmpty").addClass("starGraphicFull");
                        $("#star2").removeClass("starGraphicEmpty").addClass("starGraphicFull");
                        $("#star3").removeClass("starGraphicEmpty").addClass("starGraphicFull");
                        $("#star4").removeClass("starGraphicEmpty").addClass("starGraphicFull");
                        $("#star5").removeClass("starGraphicEmpty").addClass("starGraphicFull");

                        starText.textContent = "Damn it's amazing!";
                      });

                      $("#star5").mouseleave(function()
                      {
                        if(rating < 5) {
                          $("#star5").removeClass("starGraphicFull").addClass("starGraphicEmpty");
                          if(rating < 4) {
                            $("#star4").removeClass("starGraphicFull").addClass("starGraphicEmpty");
                            if(rating < 3) {
                              $("#star3").removeClass("starGraphicFull").addClass("starGraphicEmpty");
                              if(rating < 2) {
                                $("#star2").removeClass("starGraphicFull").addClass("starGraphicEmpty");
                                if(rating < 1) {
                                  $("#star1").removeClass("starGraphicFull").addClass("starGraphicEmpty");
                                }
                              }
                            }
                          }
                        }
                         starText.textContent = "";
                      });

                      $("#star5").click(function()
                      {
                        s5c = true;
                        rating=5;
                        clicked = true;
                        s1c = true;
                        resetStars(rating);
                      });

                });

     </script>
