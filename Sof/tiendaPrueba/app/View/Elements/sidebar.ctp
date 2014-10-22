<?php $this->start('sidebar1'); ?>

	<div id="sidebar">

	    <div id="sidebar_content">
	    	<div id="sidebar_content_interior">
	    		<h3>Search</h1>

	    		<h3>Category</h2>

	    		<h3>Price</h3>

	    		<h3>Rating</h3>

                <a href="#" id="search_btn">Search</a>

	    	</div>
	    </div>

	    <button type="button" id="buttontog">Order by</button>

    </div>


<?php $this->end(); ?>

   <script type="text/javascript">

   		var sidebarIsOpen = true;
        var sidebarWidth = 0;


        $(document).ready(function () {

        	sidebarWidth = $("#sidebar #sidebar_content").outerWidth();
        	closeSidebarInstantly();

        	$("#sidebar #buttontog").click(function() {
        		toggleSidebar();
        	});

            $("#search_btn").click(function(){
                gotoPanel("search_results", true);
            });

            if(startWithSearch == true) {
                gotoPanel("search_results", true);
            }

         });

        //Go to panel with id "name". Displays a loading screen if loading_screen is true or doesn't display one if it's not
        function gotoPanel(name, loading_screen) {

            $("#"+activePanel).removeClass("active").addClass("inactive");

            if(sidebarIsOpen == true) {
                closeSidebar(700);
            }

            if(loading_screen == true) {
                
                $("#loading").removeClass("inactive").addClass("active");

                setTimeout(function () {
                    $("#loading").removeClass("active").addClass("inactive");
                    $("#"+name).removeClass("inactive").addClass("active");
                }, 750);

            }
            else {
                $("#"+name).removeClass("inactive").addClass("active");
            }

            activePanel = name;

        }


        //Open or close sidebar with animation
        function toggleSidebar() {

        	if(sidebarIsOpen == true) {
        		closeSidebar(700);
        	}
        	else {
        		openSidebar(700);
        	}

        }

        //Open sidebar with animation for ms miliseconds
        function openSidebar(ms) {
            $("#sidebar #sidebar_content").animate({
                marginLeft: '+=' + sidebarWidth + 'px'
            }, ms, "easeOutQuart", function() {
                sidebarIsOpen = true;
            });
        }

        //Close sidebar with animation for ms miliseconds
        function closeSidebar(ms) {
            $("#sidebar #sidebar_content").animate({
                marginLeft: '-=' + sidebarWidth + 'px'
            }, ms, "easeOutQuart", function() {
                sidebarIsOpen = false;
            });
        }

        //Open sidebar without animation
        function openSidebarInstantly() {
        	$("#sidebar_content").css("margin-left", '0');
        	sidebarIsOpen = true;
        }

        //Close sidebar without animation
        function closeSidebarInstantly() {
        	$("#sidebar_content").css("margin-left", -1*sidebarWidth + 'px');
        	sidebarIsOpen = false;
        }


   </script>

<?php /*TERMINA SIDEBAR1*/ ?>