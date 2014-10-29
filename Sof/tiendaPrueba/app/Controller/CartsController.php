<?php
App::uses('AppController', 'Controller');

class CartsController extends AppController {


    public $components = array('Paginator', 'Session');
    public $uses = array('Product','Cart');
    public $helpers = array('CatalogGenerator', 'Html');

    public function index() {
        $cart = $this->Session->read('cart');
        $numProducts = $this->Session->read('numProducts');
        
        $cart_Ids = array();

        for($i = 0; $i < count($cart); $i++) {
            array_push($cart_Ids,$this->Product->find('first', array('conditions'=>array('Product.id'=>$cart[$i]))));
        }

        $this->set('prodCarts',$cart_Ids);
        $this->set('numProducts',$numProducts);

    }

    //lee el array de session le concatena al final el nuevo producto y lo guarda en session de nuevo
    public function add() {

        $prod_id = $this->passedArgs['id'];
        $cart = $this->Session->read('cart');
        $numProducts = $this->Session->read('numProducts');

        $pos = array_search($prod_id,$cart);
        if ( $pos == false ) {
            array_push($cart,$prod_id);
            array_push($numProducts,1);
        } else {
            $numProducts[$pos] = $numProducts[$pos] + 1;
        }
        
        $this->Session->write('cart',$cart);
        $this->Session->write('numProducts',$numProducts);

        $this->Session->setFlash(__('The product has been added to your cart.'));
        return $this->redirect(array('controller' => 'Products', 'action' => 'productInside','id'=>$prod_id));

    }

    //en este metodo parto el array en dos pedazos excluyendo de ambos el indice del elemento que quiero que deje de estar en el array y luego los uno y guardo el nuevo array en session
    public function delete() {
        $prod_id = $this->passedArgs['id'];
        $cart = $this->Session->read('cart');
        $numProducts = $this->Session->read('numProducts');

        $pos = array_search($prod_id,$cart);

        $first_cart = array_slice($cart, 0, $pos);
        $second_cart = array_slice($cart, $pos+1);
        $first_num = array_slice($numProducts, 0, $pos);
        $second_num = array_slice($numProducts, $pos+1);

        for($i = 0; $i<count($second_cart);$i++) {
            array_push($first_cart,$second_cart[$i]);
            array_push($first_num,$second_num[$i]);
        }

        $this->Session->write('cart',$first_cart);
        $this->Session->write('numProducts',$first_num);

        return $this->redirect(array('controller' => 'carts', 'action' => 'index'));
    }

}

