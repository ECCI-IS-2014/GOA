<?php
App::uses('AppController', 'Controller');

class CartsController extends AppController {


    public $components = array('Paginator', 'Session');
    public $uses = array('Product','Cart');
    public $helpers = array('CatalogGenerator', 'Html');

    public function index() {
        $cart = $this->Session->read('cart');
        //$tam = count($cart);
        $cart_Ids = array();
        /*for($i = 0; $i<$tam; $i++)
        {
            array_push($cart_Ids,$cart[$i]);
        }*/


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
    public function add() {

        $prod_id = $this->passedArgs['id'];
        $cart = $this->Session->read('cart');
        array_push($cart,$prod_id);
        $this->Session->write('cart',$cart);
        return $this->redirect(array('controller' => 'Products', 'action' => 'productInside','id'=>$prod_id));

    }

}

