
<?php $this->start('header1'); ?>

    <div id="topHeader">
      <div id="logoContainer">
        <img src = "http://i.imgur.com/7nXSwKo.png" />
      </div>
      <div class="searchBar">
        <form>
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

               <li><a href="http://localhost/GOA/Sof/tiendaPrueba/Users/Profile" class="drop">Account</a>
               <!-- <ul class="dropDown">
                            <li><a href="#">Management</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">Checkout</a></li>
                </ul>-->
               </li>

               <li><a href="#">MyCart</a></li>
               <li><a href="#">Sales</a></li>
               <li><a href="#">Contact</a></li>
               <?php if ($this->Session->read('Auth.User.id') == null): ?>
                    <li><a href="http://localhost/GOA/Sof/tiendaPrueba/users/add">Register</a></li>
                    <li><a href="http://localhost/GOA/Sof/tiendaPrueba/users/login">Sign In</a></li>
                <? else: ?>
                    <li>Welcome <?php $this->Session->read('Auth.User.name') ?> </li>
                 <?php endif; ?>
                </ul>
            </div>



    </div>

<?php $this->end(); ?>

<?php /*TERMINA HEADER1*/ ?>