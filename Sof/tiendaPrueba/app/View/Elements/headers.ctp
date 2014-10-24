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
    			<input type="text" class="search">
    			<label for="search"></label>
    			<input type="button" value="Search" class="sbm"/>
    		</form> 
        </div>
    </div>

    <div id="menuHeader">

            <div id="menuHeaderInterno">
             <ul>
               <li><a href="http://localhost/GOA/Sof/tiendaPrueba/Pages/Home">Home</a></li>

               <li><a href="http://localhost/GOA/Sof/tiendaPrueba/Users/Profile" class="drop">Account</a></li>
               <!-- <ul class="dropDown">
                            <li><a href="#">Management</a></li>

                            <li><a href="#">Checkout</a></li>
                </ul>-->

               <li><a href="<?php echo $this->Html->url(array('controller' => 'wishes','action' => 'index'));?>">MyWishlist</a></li>
               <li><a href="#">MyCart</a></li>
               <li><a href="#">Sales</a></li>
               <?php if ($this->Session->read('Auth.User.id') == null): ?>
                    <li><a href="http://localhost/GOA/Sof/tiendaPrueba/users/add">Register</a></li>
                    <li><a href="http://localhost/GOA/Sof/tiendaPrueba/users/login">Sign In</a></li>
                <? else: ?>
                    <li>Welcome <?php $this->Session->read('Auth.User.name') ?> </li>
                 <?php endif; ?>
                <li><a class="endMenuHeader">&nbsp;</a></li>
                </ul>
            </div>

    </div>

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

                <li><a class="endMenuHeader">&nbsp;</a></li>

            </ul>
        </div>

    </div>

<?php $this->end(); ?>

<?php /*TERMINA HEADERADMIN*/ ?>