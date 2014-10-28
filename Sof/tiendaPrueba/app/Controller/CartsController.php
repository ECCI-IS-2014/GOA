<?php
App::uses('AppController', 'Controller');

class CartsController extends AppController {


    public $components = array('Paginator', 'Session');
    public $uses = array('Product','Cart');
    public $helpers = array('CatalogGenerator', 'Html');

    public function index() {
        $cart = $this->Session->read('cart');
        
        $cart_Ids = array();



        for($i = 0; $i < count($cart); $i++) {
            array_push($cart_Ids,$this->Product->find('first', array('conditions'=>array('Product.id'=>$cart[$i]))));
        }
        $this->set('prodCarts',$cart_Ids);

    }

    /**
     * add method
     *
     * @return void
     */
    //lee el array de session le concatena al final el nuevo producto y lo guarda en session de nuevo
    public function add() {

        $prod_id = $this->passedArgs['id'];
        $cart = $this->Session->read('cart');
        array_push($cart,$prod_id);
        $cart = array_unique($cart);
        $this->Session->write('cart',$cart);
        return $this->redirect(array('controller' => 'Products', 'action' => 'productInside','id'=>$prod_id));

    }
    //en este metodo parto el array en dos pedazos excluyendo de ambos el indice del elemento que quiero que deje de estar en el array y luego los uno y guardo el nuevo array en session
    public function delete() {
        $prod_id = $this->passedArgs['id'];
        $cart = $this->Session->read('cart');
        $pos = array_search($prod_id,$cart);
        $first = array_slice($cart, 0, $pos);
        $second = array_slice($cart, $pos+1);
        for($i = 0; $i<count($second);$i++)
        {
            array_push($first,$second[$i]);
        }
        $this->Session->write('cart',$first);
        return $this->redirect(array('controller' => 'carts', 'action' => 'index'));
    }

}

