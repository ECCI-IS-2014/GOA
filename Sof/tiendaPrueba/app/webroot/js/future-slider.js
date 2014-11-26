
function FutureSlider(container, element_width, element_height){

   // Add object properties 
   this.container = container;
   this.button_left;
   this.button_right;
   this.num_items = $(container + " > div").length;
   this.element_width = element_width;
   this.element_height = element_height;
   this.total_width = this.element_width * this.num_items + 10;
   this.total_height = this.element_height;
   this.interval = '';
   this.linear_duration = 20;
   this.linear_step = 4;
   this.linear_distance = 0;
   this.animation_in_progress = false;
   this.animation_duration = 1500;
   this.animation_duration_fast = 800;
   this.animation_easing = "easeOutQuart";
   this.isSliding = false;

   // Positioning setup
   $(this.container).css("position", "absolute");
   $(this.container).css("left", 0);
   $(this.container).css("width", this.total_width + "px");
   $(this.container).css("height", this.total_height + "px");
   $(this.container).parent().css("height", this.total_height + 30 + "px");

   //$(this.container).css("background-color", "gray");

   // Check if slider is necessary and if so, start animation
   if($(this.container).outerWidth() > $(this.container).parent().outerWidth()) {
      this.has_slider = true;
      this.start();
   }
   else {
      this.has_slider = false;
      this.stop();
   }

}

FutureSlider.prototype = {

    animationStarted : function() {
        this.animation_in_progress = true;
    },

    animationCompleted : function() {
        this.animation_in_progress = false;
    },

    slide : function(callback) {

    },

    slideForward : function(callback) {
        if(this.has_slider == true && this.is_playing == true && this.animation_in_progress == false) {
            this.animationStarted();

            if(this.linear_distance == 0) {
                $(this.container).prepend($(this.container).find("div.catalog_item").last());
                $(this.container).css("left", "-=" + this.element_width + "px");
            } 
            
            $(this.container).css("left", "+=" + this.linear_step + "px");
            this.linear_distance += this.linear_step;
            
            if(this.linear_distance > this.element_width) {
                $(this.container).css("left", "0px");
                this.linear_distance = 0;
                callback();
            }

            this.animationCompleted();
        }
    },

    slideBackwards : function(callback) {
        if(this.has_slider == true && this.is_playing == true && this.animation_in_progress == false) {
            this.animationStarted();

            $(this.container).css("left", "-=" + this.linear_step + "px");
            this.linear_distance -= this.linear_step;

            if(this.linear_distance < -1*this.element_width) {
                $(this.container).append($(this.container).find("div.catalog_item").first());
                $(this.container).css("left", "0px");
                this.linear_distance = 0;
                callback();
            }

            this.animationCompleted();
        }
    },

    moveForward : function(move_fast) {
        if(this.has_slider == true && this.is_playing == true && this.animation_in_progress == false) {
            var dur = this.animation_duration;
            var myself = this;
            if(move_fast == true) {
              dur = this.animation_duration_fast;
            }
            this.animationStarted();
            $(this.container).stop().animate({
                left: "-=" + this.element_width,
            }, dur, this.animation_easing, function() {
                $(this).append($(this).find("div.catalog_item").first());
                $(this).css("left", (parseInt($(this).css("left")) + myself.element_width) + "px");
                myself.animationCompleted();
            });
        }
    },

    moveBackwards : function(move_fast) {
        if(this.has_slider == true && this.is_playing == true && this.animation_in_progress == false) {
            var dur = this.animation_duration;
            var myself = this;
            if(move_fast == true) {
              dur = this.animation_duration_fast;
            }
            this.animationStarted();
            $(this.container).css("left", "-=" + this.element_width + 'px' );
            $(this.container).prepend($(this.container).find("div.catalog_item").last());
            $(this.container).stop().animate({
                left: "+=" + this.element_width,
            }, dur, this.animation_easing, function() {
                myself.animationCompleted();
            });
        }
    },

    startSlidingLeft : function() {
        if(this.isSliding == false && this.has_slider == true) {
            var myself = this;
            this.isSliding = true;
            this.completedSliding = false; 
            this.interval = setInterval(function(){
                myself.slideForward(function(){
                    if(myself.isSliding != true) {
                        clearInterval(myself.interval);
                        this.completedSliding = true; 
                    }
                });
            }, this.linear_duration);    
        }
    },

    startSlidingRight : function() {
        if(this.isSliding == false && this.has_slider == true) {
            var myself = this;
            this.isSliding = true;
            this.completedSliding = false; 
            this.interval = setInterval(function(){
                myself.slideBackwards(function(){
                    if(myself.isSliding != true) {
                      clearInterval(myself.interval);
                      this.completedSliding = true;
                    }
                });
            }, this.linear_duration);    
        }
    },

    stopSliding : function() {
        if(this.has_slider == true) {
            this.isSliding = false;
        }
    },

    start : function() {
         this.is_playing = true;
    },

    stop : function() {
         this.is_playing = false;
    },

    setButtons : function(button_left, button_right) {

        var myself = this;

        if(this.has_slider != true) {
            $(this.container).parent().parent().find(".slider_btn_left").remove();
            $(this.container).parent().parent().find(".slider_btn_right").remove();
        }
        else {
            this.button_left = $(this.container).parent().parent().find(".slider_btn_left");
            this.button_right = $(this.container).parent().parent().find(".slider_btn_right");

            this.button_left.click(function(){
                myself.moveBackwards(true);
            });

            this.button_right.click(function(){
                myself.moveForward(true);
            });

        }

    }

}
