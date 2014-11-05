<?php $this->start('header1'); ?>

    <div id="topHeader">
        <div id="logoContainer">
            <!--<img src = "http://i.imgur.com/7nXSwKo.png" />-->
        </div>
        <div class="searchBar">
            <form>
                <select>
                    <!-- <option value="id">Category Name</option> -->
                <?php
                    $categories = ClassRegistry::init('Category')->listCategoriesForHome();
                    $this->set(compact('categories'));
                    foreach ($categories as $id=>$category) {
                        echo '<option value = "' . $id . '">' . $category . '</option>';
                    }
                ?>
                </select>
                <input type="text" class="search future_store_textbar">
                <label for="search"></label>
                <input type="button" value="Search" class="future_store_basic_orange_button sbm"/>
            </form> 
        </div>
    </div>

    <div id="menuHeader">

        <div id="menuHeaderInterno">
            <ul>

                <li><a href= <?php echo Router::url(array('controller'=>'Pages','action'=>'home')); ?> >Home</a></li>
                 <li><a href="#">Sales</a></li>
                <li><a href=<?php echo Router::url(array('controller'=>'Sales','action'=>'checkout')); ?>>Your order's</a></li>

                <?php if ($this->Session->read('Auth.User.id') != null): ?>

                    <?php if ($this->Session->read('Auth.User.role') != 'admin'): ?>
                    
                    <li>
                        <a class="drop" href="<?php echo $this->Html->url(array('controller' => 'users','action' => 'profile'));?>" > 
                            <?php echo $this->Session->read('Auth.User.name')?>'s Account
                        </a>
                    </li>


                    <li>
                        <a href="<?php echo $this->Html->url(array('controller' => 'wishes','action' => 'index'));?>">
                            MyWishlist
                        </a>
                    </li>

                    <li>

                        <a href="<?php echo $this->Html->url(array('controller' => 'carts','action' => 'index'));?>">
                            MyCart 
                            <span id="numProductsCart">
                                <?php echo $totalCartProducts = $this->Session->read('totalCartProducts'); ?>
                            </span>
                        </a>
                    </li>

                    <?php else: ?>

                    <li>
                        <a href="<?php echo $this->Html->url(array('controller' => 'products','action' => 'index'));?>">
                            Admin Pages
                        </a>
                    </li>

                    <?php endif; ?>

                    <li>
                        <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?>
                    </li>

                <?php else: ?>

                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'users','action' => 'add'));?>">
                        Register
                    </a>
                </li>

                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'users','action' => 'login'));?>">
                        Login
                    </a>
                </li>

                <?php endif; ?>
             
                <li><a class="endMenuHeader">&nbsp;</a></li>
            </ul>
        </div>

    </div>

    <script type="text/javascript">

        $(document).ready(function () {

          $(".sbm").click(function(){
              gotoSearchBar( $(".searchBar input.search").val(), $(".searchBar select").val() );
          });

          //Validación de campo de texto
            $('.searchBar input.search').keyup(function () { 
                this.value = this.value.replace(/[^0-9a-zA-Z\.]/g,'');
            });

        });

        function getBaseSearchUrl() {

          var url = '<?php
              echo $this->Html->url(array(
                  "controller" => "Pages",
                  "action" => "home",
                  "?" => array("op" => "search")
              ));
            ?>';

          return url;

        }

        function gotoSearchBar(value, cate_id) {
            var url = getBaseSearchUrl() + "&type=1" + "&val=" + value + "&cat=" + cate_id;
            window.location.href = url;
        }

        function gotoSearchEquals(keyword, cate_id, attribute, match_val, match_all) {

            var kword_part = '';
            var cat_part = '';
            var attr_part = '';
            var val_part = '';
            
            //validation of user input
            if(keyword != null && keyword != '') {
                kword_part = "&keyword=" + keyword;
            }

            if(cate_id != null && cate_id != '') {
                cat_part = "&cat=" + cate_id;
            }

            if(attribute != null && attribute != '') {
                attr_part = "&attr=" + attribute;
            }

            if(match_val != null && match_val != '' && attribute != null && attribute != '') {
                val_part = "&match_val=" + match_val;
            }

            var url = getBaseSearchUrl() + "&type=2" + kword_part + cat_part + attr_part + val_part + "&match_all=" + match_all;
            window.location.href = url;

        }

        function gotoSearchRange(keyword, cate_id, attribute, match_greater_than, match_lesser_than, match_all) {

            var kword_part = '';
            var cat_part = '';
            var attr_part = '';
            var gt_part = '';
            var lt_part = '';

            //validation of user input
            if(keyword != null && keyword != '') {
                kword_part = "&keyword=" + keyword;
            }

            if(cate_id != null && cate_id != '') {
                cat_part = "&cat=" + cate_id;
            }

            if(attribute != null && attribute != '') {
                attr_part = "&attr=" + attribute;
            }

            if(match_greater_than != null && match_greater_than != '' && attribute != null && attribute != '') {
                gt_part = "&match_gt=" + match_greater_than;
            }

            if(match_lesser_than != null && match_lesser_than != '' && attribute != null && attribute != '') {
                lt_part = "&match_lt=" + match_lesser_than;
            }

            //alert("search by range: " + keyword + ", " + cate_id + ", " + attribute + ", " + match_greater_than + ", " + match_lesser_than + ", " + match_all);            
            var url = getBaseSearchUrl() + "&type=3" + kword_part + cat_part + attr_part + gt_part + lt_part + "&match_all=" + match_all;
            window.location.href = url;

        }

    </script>

<?php $this->end(); ?>

<?php /*TERMINA HEADER1*/ ?>






<?php $this->start('headerAdmin'); ?>

    <div id="topHeader">
        <div id="logoContainer">
            <!--<img src = "http://i.imgur.com/7nXSwKo.png" />-->
        </div>
    </div>

    <div id="menuHeader">

        <div id="menuHeaderInterno">
            <ul>

                <li><a href="http://localhost/GOA/Sof/tiendaPrueba/Pages/Home">Home</a></li>

                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'products','action' => 'index'));?>">
                        Products
                    </a>
                </li>

                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'categories','action' => 'index'));?>">
                        Categories
                    </a>
                </li>

                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'users','action' => 'index'));?>">
                        Users
                    </a>
                </li>

                <?php if ($this->Session->read('Auth.User.id') != null): ?>
                <li>
                    <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?>
                </li>
                <?php endif; ?>

                <li><a class="endMenuHeader">&nbsp;</a></li>

            </ul>
        </div>

    </div>

<?php $this->end(); ?>

<?php /*TERMINA HEADERADMIN*/ ?>