<?php $this->start('sidebar1'); ?>

	<div id="sidebar">

	    <div id="sidebar_content">

            <div id="sidebar_frame">
                
                <div id="sidebar_top"></div>
                <div id="sidebar_content_interior">

                    <div id="sidebar_keyword">
                        <span class="title">By keyword</span>
                        <input type="text" class="sidebar_keyword future_store_textbar3">
                    </div>

                    <div id="sidebar_field">
                        <div>
                            <span class="title">By field</span>
                            <select class="future_store_combobox">
                                <option>Any</option>
                                <option>Price</option>
                                <option>Rating</option>
                                <option>Weight</option>
                                <option>Volume</option>
                            </select>    
                        </div>
                        <div>
                            <div class="l1">
                                <span class="label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Greater than </span><input type="text" class="sidebar_field_gt future_store_textbar3">
                            </div>
                            <div class="l2">
                                <span class="label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lesser than </span><input type="text" class="sidebar_field_lt future_store_textbar3">    
                            </div>  
                        </div>
                        
                    </div>

                    <div id="sidebar_category">
                        <div>
                            <span class="title">In category</span>
                            <select class="future_store_combobox">
                                <?php
                                    $categories = ClassRegistry::init('Category')->listCategoriesForHome();
                                    $this->set(compact('categories'));
                                    foreach ($categories as $id=>$category) {
                                        echo '<option value = "' . $id . '">' . $category . '</option>';
                                    }
                                ?>
                            </select>    
                        </div>
                        
                    </div>
                    
                    <input type="button" id="search_btn" value="Search" class="future_store_basic_orange_button"/>

                </div>
                <div id="sidebar_bottom"></div>

            </div>

            <button type="button" id="buttontog">Advanced search</button>

	    </div>

    </div>


<?php $this->end(); ?>

   <script type="text/javascript">

   		var sidebarIsOpen = true;
        var sidebarWidth = 0;
        var startWithSearch = false;

        $(document).ready(function () {

        	sidebarWidth = $("#sidebar #sidebar_content_interior").outerWidth();
        	//closeSidebarInstantly();

            if(getUrlParameter('op') == 'search') {
                startWithSearch = true;
            }

        	$("#sidebar #buttontog").click(function() {
        		toggleSidebar();
        	});

            $("#search_btn").click(function(){
                //gotoPanel("search_results", true);
                gotoSearch( "la", -1 );
            });

            if(startWithSearch == true) {
                gotoPanel("search_results", true);
            }

         });

        function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1);
            var sURLVariables = sPageURL.split('&');
            for (var i = 0; i < sURLVariables.length; i++) 
            {
                var sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] == sParam) 
                {
                    return sParameterName[1];
                }
            }
        }  

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
            $("#sidebar").animate({
                marginLeft: '+=' + sidebarWidth + 'px'
            }, ms, "easeOutQuart", function() {
                sidebarIsOpen = true;
            });
        }

        //Close sidebar with animation for ms miliseconds
        function closeSidebar(ms) {
            $("#sidebar").animate({
                marginLeft: '-=' + sidebarWidth + 'px'
            }, ms, "easeOutQuart", function() {
                sidebarIsOpen = false;
            });
        }

        //Open sidebar without animation
        function openSidebarInstantly() {
        	$("#sidebar").css("margin-left", '0');
        	sidebarIsOpen = true;
        }

        //Close sidebar without animation
        function closeSidebarInstantly() {
        	$("#sidebar").css("margin-left", -1*sidebarWidth + 'px');
        	sidebarIsOpen = false;
        }


   </script>

<?php /*TERMINA SIDEBAR1*/ ?>