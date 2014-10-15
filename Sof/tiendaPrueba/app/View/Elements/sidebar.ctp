<?php $this->start('sidebar1'); ?>

	<div id="sidebar">

	    <div id="sidebar_content">
	    	<div id="sidebar_content_interior">
	    		<h3>Search</h1>

	    		<h3>Category</h2>

	    		<h3>Price</h3>

	    		<h3>Rating</h3>
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

         });

        //Open or close sidebar with animation
        function toggleSidebar() {

        	if(sidebarIsOpen == true) {
        		//close
        		$("#sidebar #sidebar_content").animate({
        			marginLeft: '-=' + sidebarWidth + 'px'
        		}, 400, "linear", function() {
        			sidebarIsOpen = false;
        		});
        	}
        	else {
        		//open
        		$("#sidebar #sidebar_content").animate({
        			marginLeft: '+=' + sidebarWidth + 'px'
        		}, 400, "linear", function() {
        			sidebarIsOpen = true;
        		});
        	}

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