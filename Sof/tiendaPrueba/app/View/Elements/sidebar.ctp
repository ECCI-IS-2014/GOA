<?php $this->start('sidebar1'); ?>

	<div id="sidebar">

	    <div id="sidebar_content">

            <div id="sidebar_frame">
                
                <div id="sidebar_top"></div>
                <div id="sidebar_content_interior">

                    <div id="sidebar_keyword">
                        <label class="title" for="txt1">By keyword</label>
                        <input type="text" class="sidebar_keyword future_store_textbar3" id="txt1">
                    </div>

                    <div id="sidebar_field">
                        <div>
                            <label class="title" for="cmbx1">By field</label>
                            <select class="future_store_combobox" id="cmbx1">
                                <option>Any</option>
                                <option>Price</option>
                                <option>Rating</option>
                                <option>Weight</option>
                                <option>Volume</option>
                            </select>    
                        </div>
                        <div>
                            <div class="l3">
                                <label class="label" for="txt2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Equal to </label><input type="text" class="sidebar_field_et future_store_textbar3" id="txt2">    
                            </div>  
                            <div class="l1" style="display: none">
                                <label class="label" for="txt3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Greater than </label><input type="text" class="sidebar_field_gt future_store_textbar3" id="txt3">
                            </div>
                            <div class="l2" style="display: none">
                                <label class="label" for="txt4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lesser than </label><input type="text" class="sidebar_field_lt future_store_textbar3" id="txt4">    
                            </div>  
                        </div>
                        
                    </div>

                    <div id="sidebar_category">
                        <div>
                            <label class="title" for="cmbx2">In category</label>
                            <select class="future_store_combobox" id="cmbx2">
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

                    <div id="sidebar_options">
                        <div class="l4">
                            <input type="checkbox" name="chbx1" value="" id="chbx1"><label for="chbx1">Show only if ALL fields are matched</label>  
                        </div>
                        <div class="l5">
                            <input type="checkbox" name="chbx2" value="" id="chbx2"><label for="chbx2">Match within interval</label>  
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
        	closeSidebarInstantly();
            setFieldTextboxes();

            if(getUrlParameter('op') == 'search') {
                startWithSearch = true;
            }

        	$("#sidebar #buttontog").click(function() {
        		toggleSidebar();
        	});

            $("#search_btn").click(function(){
                //gotoPanel("search_results", true);

                var match_all = false;
                if($("input#chbx1").is(':checked')) {
                    match_all = true;
                }

                $("#"+activePanel).removeClass("active").addClass("inactive");
                $("#loading").removeClass("inactive").addClass("active");

                if(sidebarIsOpen == true) {
                    closeSidebar(700);
                }   

                if(!$("input#chbx2").is(':checked')) {
                    //search equal: gotoSearch(keyword, cate_id, attribute, match_val, match_all)
                    gotoSearchEquals(
                        $("#txt1").val(),
                        $("#cmbx2").val(),
                        $("#cmbx1").val(),
                        $("#txt2").val(),
                        match_all
                    );
                }
                else {
                    //search by range: gotoSearch(keyword, cate_id, attribute, match_greater_than, match_lesser_than, match_all)
                    gotoSearchRange(
                        $("#txt1").val(),
                        $("#cmbx2").val(),
                        $("#cmbx1").val(),
                        $("#txt3").val(),
                        $("#txt4").val(),
                        match_all
                    );
                }


            });

            $("input#chbx2").change(function() {
                setFieldTextboxes();
            });

            //Validación de campo de texto
            $('#sidebar_keyword input[type="text"]').keyup(function () { 
                this.value = this.value.replace(/[^0-9a-zA-Z\.]/g,'');
            });

            //Validación de campos numéricos
            $('.l1 input[type="text"]').keyup(function () { 
                this.value = this.value.replace(/[^0-9\.]/g,'');
            });

            $('.l2 input[type="text"]').keyup(function () { 
                this.value = this.value.replace(/[^0-9\.]/g,'');
            });

            $('.l3 input[type="text"]').keyup(function () { 
                this.value = this.value.replace(/[^0-9\.]/g,'');
            });

            if(startWithSearch == true) {
                gotoPanel("search_results", true);
            }

         });

        function setFieldTextboxes() {
            if ($("input#chbx2").is(':checked')) {
                    $("div.l1").css("display", "block");
                    $("div.l2").css("display", "block");
                    $("div.l3").css("display", "none");
                }
                else {
                    $("div.l1").css("display", "none");
                    $("div.l2").css("display", "none");
                    $("div.l3").css("display", "block");
                }
        }

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