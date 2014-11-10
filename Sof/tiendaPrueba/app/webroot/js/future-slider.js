
function FutureSlider(container, element_width, element_height){

   // Add object properties 
   this.container = container;
   this.num_items = $(container + " > div").length;
   this.element_width = element_width;
   this.element_height = element_height;
   this.total_width = this.element_width * this.num_items + 10;
   this.total_height = this.element_height;
   this.interval = '';

   // Positioning setup
   $(this.container).css("position", "absolute");
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

    dummy : function () {
        alert('werks');
    },

    moveForward : function() {
      if(this.has_slider == true && this.is_playing == true) {
         $(this.container).animate({
            left: "-=" + this.element_width,
         }, 2500, "easeOutQuart", function() {
            $(this).append($(this).find("div.catalog_item").first());
            //$(this).find("div.catalog_item").first().remove();
            $(this).css("left", "0px");
         });
      }
    },

    start : function() {
         this.is_playing = true;
    },

    stop : function() {
         this.is_playing = false;
         //clearInterval(this.interval);
    }

}

/*FutureSlider.prototype.moveForward = function(){
   $(this.container + " > div[type='catalog_content']").animate({
      left: "-=50",
   }, 1000, function() {
      // Animation complete.
   });
};

// Add methods like this.
FutureSlider.prototype.addElement = function(elem){
    jQuery("this.container").append(elem);
};

FutureSlider.prototype.putContentsInSlider = function(){

	this.num_items = $(this.container + " .catalog_item").length;

	$(this.container + " .catalog_item").each(function(index) {
		$(this).css("position", "absolute");
		$(this).css("left", (index * this.element_width) + "px");
	})


	//alert(this.num_items);
	//$(this.container).css()

};*/